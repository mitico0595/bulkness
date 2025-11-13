<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Cupon;
use App\CuponReserva;

class CuponController extends Controller
{
    public function index(Request $req)
    {
        $q      = trim((string)$req->get('q'));
        $tipo   = $req->get('tipo');        // percent|fixed
        $activo = $req->get('activo');      // 1|0 (opcional)

        $cupones = Cupon::query()
            ->when($q, function($qq) use ($q){
                $qq->where('codigo','like',"%$q%")
                   ->orWhere('nombre','like',"%$q%");
            })
            ->when(in_array($tipo,['percent','fixed'],true), fn($qq)=> $qq->where('tipo',$tipo))
            ->when($activo !== null && $activo !== '', fn($qq)=> $qq->where('activo', (int)$activo))
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        // métricas rápidas por fila
        $now = now();
        $reservas = CuponReserva::select('cupon_id', DB::raw("count(*) as rsv"))
            ->where('estado','reservado')->where('expires_at','>',$now)
            ->groupBy('cupon_id')->pluck('rsv','cupon_id');

        return view('admin.cupones.index', compact('cupones','q','tipo','activo','reservas'));
    }

    public function show($id)
    {
        $c = Cupon::findOrFail($id);
        return response()->json([
            'cupon' => [
                'id'                     => $c->id,
                'codigo'                 => $c->codigo,
                'nombre'                 => $c->nombre,
                'tipo'                   => $c->tipo,
                'valor'                  => $c->valor,            // OJO: en percent = 0-100, en fixed = centavos
                'emitidos'               => $c->emitidos,
                'reclamados'             => $c->reclamados,
                'por_usuario'            => $c->por_usuario,
                'min_subtotal'           => $c->min_subtotal,      // centavos
                'aplica_solo_subtotal'   => (bool)$c->aplica_solo_subtotal,
                'activo'                 => (bool)$c->activo,
                'inicia_at'              => optional($c->inicia_at)->toIso8601String(),
                'caduca_at'              => optional($c->caduca_at)->toIso8601String(),
                'duracion_minutos'       => $c->duracion_minutos,
                'notas'                  => $c->notas,
                // extras de ayuda
                'reservas_activas'       => $c->activosReservados(),
                'disponibles'            => $c->disponibles(),
            ],
        ]);
    }

    public function store(Request $req)
    {
        $data = $this->validateData($req);

        // Convertir dinero a centavos donde aplique
        $valor = $data['tipo'] === 'percent'
               ? max(0, min(100, (int)$data['valor']))
               : (int) round(((float)$data['valor']) * 100);

        $min = $data['min_subtotal'] !== null
             ? (int) round(((float)$data['min_subtotal']) * 100)
             : null;

        $c = Cupon::create([
            'codigo'               => $data['codigo'],
            'nombre'               => $data['nombre'] ?? null,
            'tipo'                 => $data['tipo'],
            'valor'                => $valor,
            'emitidos'             => (int)$data['emitidos'],
            'reclamados'           => 0,
            'por_usuario'          => (int)($data['por_usuario'] ?? 1),
            'min_subtotal'         => $min,
            'aplica_solo_subtotal' => (bool)($data['aplica_solo_subtotal'] ?? true),
            'activo'               => (bool)($data['activo'] ?? true),
            'inicia_at'            => $data['inicia_at'] ? date('Y-m-d H:i:s', strtotime($data['inicia_at'])) : null,
            'caduca_at'            => $data['caduca_at'] ? date('Y-m-d H:i:s', strtotime($data['caduca_at'])) : null,
            'duracion_minutos'     => (int)($data['duracion_minutos'] ?? 20),
            'notas'                => $data['notas'] ?? null,
        ]);

        return response()->json(['ok'=>true,'id'=>$c->id]);
    }

    public function update(Request $req, $id)
    {
        $c = Cupon::findOrFail($id);
        $data = $this->validateData($req, $id);

        $valor = $data['tipo'] === 'percent'
               ? max(0, min(100, (int)$data['valor']))
               : (int) round(((float)$data['valor']) * 100);

        $min = $data['min_subtotal'] !== null
             ? (int) round(((float)$data['min_subtotal']) * 100)
             : null;

        $c->update([
            'codigo'               => $data['codigo'],
            'nombre'               => $data['nombre'] ?? null,
            'tipo'                 => $data['tipo'],
            'valor'                => $valor,
            'emitidos'             => (int)$data['emitidos'],
            'por_usuario'          => (int)($data['por_usuario'] ?? 1),
            'min_subtotal'         => $min,
            'aplica_solo_subtotal' => (bool)($data['aplica_solo_subtotal'] ?? true),
            'activo'               => (bool)($data['activo'] ?? true),
            'inicia_at'            => $data['inicia_at'] ? date('Y-m-d H:i:s', strtotime($data['inicia_at'])) : null,
            'caduca_at'            => $data['caduca_at'] ? date('Y-m-d H:i:s', strtotime($data['caduca_at'])) : null,
            'duracion_minutos'     => (int)($data['duracion_minutos'] ?? 20),
            'notas'                => $data['notas'] ?? null,
        ]);

        return response()->json(['ok'=>true]);
    }

    public function toggle($id)
    {
        $c = Cupon::findOrFail($id);
        $c->activo = !$c->activo;
        $c->save();
        return response()->json(['ok'=>true,'activo'=>$c->activo]);
    }

    public function destroy($id)
    {
        $c = Cupon::findOrFail($id);

        // opcional: impedir borrar si ya tiene consumos
        $consumos = CuponReserva::where('cupon_id',$c->id)->where('estado','consumido')->count();
        if ($consumos > 0) {
            return response()->json(['ok'=>false,'msg'=>'No puedes borrar un cupón con consumos. Desactívalo.'], 409);
        }

        $c->delete();
        return response()->json(['ok'=>true]);
    }

    private function validateData(Request $req, $id = null): array
    {
        return $req->validate([
            'codigo'               => ['required','string','max:50', Rule::unique('cupones','codigo')->ignore($id)],
            'nombre'               => ['nullable','string','max:100'],
            'tipo'                 => ['required', Rule::in(['percent','fixed'])],
            // NOTA: en percent envía 0..100; en fixed envía S/ (decimal) — luego convierto a centavos
            'valor'                => ['required'],
            'emitidos'             => ['required','integer','min:1'],
            'por_usuario'          => ['nullable','integer','min:0'],
            // UI envía S/ decimal — convierto a centavos
            'min_subtotal'         => ['nullable'],
            'aplica_solo_subtotal' => ['nullable','boolean'],
            'activo'               => ['nullable','boolean'],
            'inicia_at'            => ['nullable','date'],
            'caduca_at'            => ['nullable','date','after_or_equal:inicia_at'],
            'duracion_minutos'     => ['nullable','integer','min:1','max:1440'],
            'notas'                => ['nullable','string','max:1000'],
        ]);
    }
}
