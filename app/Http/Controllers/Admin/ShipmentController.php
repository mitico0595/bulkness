<?php
// app/Http/Controllers/Admin/ShipmentController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shipment;
use App\Venta;
use Illuminate\Validation\Rule;
use App\OrderStatusLog;

class ShipmentController extends Controller
{
    public function index(Request $req)
    {
        $q      = trim((string)$req->get('q'));
        $status = $req->get('status');
        $from   = $req->get('from');
        $to     = $req->get('to');

        $shipments = Shipment::query()
            ->with(['venta' => function($qv){
                $qv->select('idventa','codigo','distrito','provincia','departamento','email',
                            'subtotal','cargo_envio','total_venta','fecha_hora','tipo')->withCount('lineas');
            }])
            ->when($q, function($qq) use ($q){
                $qq->where('tracking_number','like',"%$q%")
                   ->orWhereHas('venta', function($v) use ($q){
                       $v->where('codigo','like',"%$q%")
                         ->orWhere('email','like',"%$q%");
                   });
            })
            ->when($status, fn($qq)=> $qq->where('status',$status))
            ->when($from,   fn($qq)=> $qq->whereDate('created_at','>=',$from))
            ->when($to,     fn($qq)=> $qq->whereDate('created_at','<=',$to))
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        return view('admin.envios.index', compact('shipments','q','status','from','to'));
    }

    public function show($id)
{
    // Cargar venta + líneas con articulo y ordenado por idsub/iddetalle
    $envio = Shipment::with(['venta.lineas' => function($q){
        $q->with('articulo')->orderBy('idsub')->orderBy('iddetalle');
    }])->findOrFail($id);

    $venta = $envio->venta;

    // Normalizo las líneas (lineas) a un arreglo 'detalle' para el front
    $detalle = collect($venta->lineas ?? [])
        ->map(function($d){
            return [
                'iddetalle'  => $d->iddetalle,
                'idsub'      => $d->idsub,
                'idarticulo' => $d->idarticulo,
                'qty'        => (int)($d->qty ?? $d->cantidad ?? 1),
                'precio'     => (float)($d->precio ?? 0),
                'subtotal'   => (float)($d->subtotal ?? 0),
                'articulo'   => [
                    'name'  => optional($d->articulo)->name,   // ajusta si tu modelo usa 'nombre'
                    'image' => optional($d->articulo)->image,  // ajusta si es otra columna
                ],
            ];
        })
        ->values()
        ->all();

    // Agrupación por paquete (idsub) -> array de objetos [{ idsub, total, items:[] }]
    $grupos = collect($detalle)
        ->groupBy('idsub')
        ->map(function($items, $idsub){
            return [
                'idsub' => (int)$idsub,
                'total' => collect($items)->sum('subtotal'),
                'items' => array_values($items->all()),
            ];
        })
        ->values()
        ->all();

    // Logs (si quieres mostrar timeline)
    $logs = OrderStatusLog::where('venta_id', $venta->idventa)
        ->where('domain','shipment')
        ->orderByDesc('occurred_at')
        ->limit(50)
        ->get(['from_status','to_status','note','occurred_at','meta']);

    return response()->json([
        'shipment' => [
            'id'              => $envio->id,
            'venta_id'        => $envio->venta_id,
            'status'          => $envio->status,
            'carrier'         => $envio->carrier,
            'service'         => $envio->service,
            'tracking_number' => $envio->tracking_number,
            'tracking_url'    => $envio->tracking_url,
            'shipping_cost'   => $envio->shipping_cost,
            'weight_kg'       => $envio->weight_kg,
            'address_to'      => $envio->address_to,
            'shipped_at'      => optional($envio->shipped_at)->toDateTimeString(),
            'delivered_at'    => optional($envio->delivered_at)->toDateTimeString(),
            'created_at'      => optional($envio->created_at)->toDateTimeString(),
        ],
        'venta' => [
            'idventa'      => $venta->idventa,
            'codigo'       => $venta->codigo,
            'email'        => $venta->email,
            'tipo'         => $venta->tipo,
            'subtotal'     => $venta->subtotal,
            'cargo_envio'  => $venta->cargo_envio,
            'total_venta'  => $venta->total_venta,
            'fecha_hora'   => optional($venta->fecha_hora)->toDateTimeString(),
            'nombre'       => $venta->nombre,
            'apellido'     => $venta->apellido,
            'domicilio'    => $venta->domicilio,
            'distrito'     => $venta->distrito,
            'provincia'    => $venta->provincia,
            'departamento' => $venta->departamento,
            'dni'          => $venta->dni,

            // para el front:
            'detalle'      => $detalle,  // <- aquí viajan las líneas ya normalizadas
        ],
        'grupos' => $grupos,  // <- raíz, por si quieres pintarlos directo
        'logs'   => $logs,
        ]);
        }



     public function updateMeta(Request $req, $id)    {
        $data = $req->validate([
            'carrier'         => ['nullable','string','max:60'],
            'service'         => ['nullable','string','max:80'],
            'tracking_number' => ['nullable','string','max:80'],
            'tracking_url'    => ['nullable','url','max:255'],
            'weight_kg'       => ['nullable','numeric','min:0'],
        ]);

        $s = Shipment::findOrFail($id);

        // Asignar sólo lo que llega
        foreach (['carrier','service','tracking_number','tracking_url','weight_kg'] as $f) {
            if (array_key_exists($f, $data)) {
                $s->{$f} = $data[$f];
            }
        }
        $s->save();

        return response()->json([
            'ok'       => true,
            'shipment' => $s->only(['id','carrier','service','tracking_number','tracking_url','weight_kg','status']),
        ]);
    }
    public function updateStatus(Request $req, $id)
    {
        $data = $req->validate([
            'status' => ['required', Rule::in(['label_created','in_transit','out_for_delivery','delivered','failed','returned',
            'pickup_ready'])],
             'note'   => ['nullable','string','max:300'], // opcional: nota del operador
        ]);

        $envio = Shipment::findOrFail($id);

        $allowed = [
            'label_created'   => ['in_transit','failed','returned'],
            'in_transit'      => ['out_for_delivery','delivered','failed','returned'],
            'out_for_delivery'=> ['delivered','failed','returned'],
            'pickup_ready'     => ['delivered'],
            'delivered'       => [],
            'failed'          => [],
            'returned'        => [],
        ];

        $from = $envio->status;
        $to   = $data['status']; // ← ¡ojo! antes usabas $data['to']

        if (!in_array($to, $allowed[$from] ?? [], true)) {
            return response()->json(['error'=>"Transición no permitida: $from → $to"], 422);
        }

        $envio->status = $to;
        if ($to === 'in_transit' && !$envio->shipped_at)   $envio->shipped_at   = now();
        if ($to === 'delivered'  && !$envio->delivered_at) $envio->delivered_at = now();
        $envio->save();
        $venta = $envio->venta; // requiere belongsTo en Shipment: venta() -> Venta
        if ($venta) {
            if ($to === 'delivered') {
                // Marca la orden como entregada
                $venta->fulfillment_status = 'delivered';
                if (empty($venta->delivered_at)) {
                    $venta->delivered_at = now();
                }
                $venta->save();
            }
            // si algún día permites rollback de delivered, aquí manejarías la reversa
        }
        // === LOG DE ESTADO ===
        OrderStatusLog::create([
            'venta_id'    => $envio->venta_id,
            'domain'      => 'shipment',                 // distinguimos del dominio 'venta'
            'from_status' => $from,
            'to_status'   => $to,
            'actor_type'  => 'user',
            'actor_id'    => optional(auth()->user())->id,
            'note'        => $data['note'] ?? null,
            'meta'        => ['shipment_id' => $envio->id],
            'occurred_at' => now(),
        ]);
        return response()->json(['ok'=>true,'status'=>$envio->status]);
    }
}
