<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Venta;
use Illuminate\Support\Facades\Schema;

class AdminUsuarioController extends Controller
{
   public function index(Request $request)
{
    $q = trim((string)$request->get('q'));

    // Detecta la tabla y una columna válida para el total
    $ventaTable = (new Venta)->getTable(); // en tu caso devuelve 'venta'
    $candidatas = ['total', 'total_venta', 'monto', 'monto_total', 'importe', 'totalPagar'];
    $colTotal = null;
    foreach ($candidatas as $c) {
        if (Schema::hasColumn($ventaTable, $c)) { $colTotal = $c; break; }
    }

    if ($colTotal) {
        // Camino óptimo con subconsulta
        $personas = Persona::query()
            ->when($q, function($qry) use ($q) {
                $qry->where(function($w) use ($q) {
                    $w->where('name','like',"%$q%")
                      ->orWhere('lastname','like',"%$q%")
                      ->orWhere('email','like',"%$q%")
                      ->orWhere('dni','like',"%$q%");
                });
            })
            ->withSum(['ventas as total_gastado'], $colTotal)
            ->withCount('ventas')
            ->orderByDesc('total_gastado')
            ->get(); 
    } else {
        // Plan B: calcula por usuario (N consultas, pero no se cae)
        $personas = Persona::query()
            ->when($q, function($qry) use ($q) {
                $qry->where(function($w) use ($q) {
                    $w->where('name','like',"%$q%")
                      ->orWhere('lastname','like',"%$q%")
                      ->orWhere('email','like',"%$q%")
                      ->orWhere('dni','like',"%$q%");
                });
            })
            ->withCount('ventas')
            ->get();

        foreach ($personas as $p) {
            // último recurso: suma 0 porque no sabemos la columna
            $p->total_gastado = 0;
        }

        // ordénalos igual por total_gastado (que será 0)
        $personas = $personas->sortByDesc('total_gastado')->values();
    }

    $selected = $personas->first();

    return view('admin.usuarios.index', compact('personas','selected','q'));
}

    public function show($id)
    {
        $persona = Persona::query()
            ->withSum(['ventas as total_gastado'], 'total_venta')
            ->withCount('ventas')
            ->findOrFail($id);

        // Asegurar campos calculados amigables
        $persona->role_label = $persona->role_label;
        $persona->initials   = $persona->initials;
        $persona->avatar_url = $persona->avatar_url;
        $persona->age        = $persona->getAge();

        return response()->json($persona);
    }

    public function update(Request $request, $id)
    {
        $persona = Persona::findOrFail($id);

        $data = $request->validate([
            'name'       => 'required|string|max:120',
            'lastname'   => 'nullable|string|max:120',
            'email'      => 'required|email|max:120|unique:personas,email,'.$persona->id,
            'dni'        => 'nullable|string|max:20',
            'cell'       => 'nullable|string|max:20',
            'direccion'  => 'nullable|string|max:200',
            'ciudad'     => 'nullable|string|max:50',
            'provincia'  => 'nullable|string|max:50',
            'distrito'   => 'nullable|string|max:50',
            'cumpleanos' => 'nullable|string|max:20', // ajusta si usas date
            'type'       => 'required|in:0,1,2',
            'ban'        => 'required|boolean',
            'password'   => 'nullable|string|min:8|confirmed',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $persona->fill($data)->save();

        return redirect()->back()->with('ok','Usuario actualizado');
    }

    public function toggleBan(Request $request, $id)
    {
        $persona = Persona::findOrFail($id);
        $persona->ban = $request->boolean('ban');
        $persona->save();

        return response()->json([
            'ok'  => true,
            'ban' => (bool)$persona->ban
        ]);
    }
}
