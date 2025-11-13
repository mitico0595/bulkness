<?php

namespace App\Http\Controllers;

use App\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MisPedidosController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        abort_unless($user, 403);

        $authEmail = Auth::user()->email;
        $authId    = Auth::id();

       $ventas = Venta::query()
        ->select([
            'idventa','iduser','codigo','subtotal','total_venta','tipo','cargo_envio',
            // 'detalle',  // <- NO la traigas para no pisar la relación
            'fecha_hora','nombre','email','user-mail','apellido','domicilio','celular',
            'distrito','provincia','departamento','dni','referencia','created_at','updated_at',
        ])
        ->with([
            'detalle' => function ($q) {
                $q->with('articulo')
                ->orderBy('idsub')
                ->orderBy('iddetalle');
            },
             'latestShipment',
        ])
        ->where(function ($q) use ($authId, $authEmail) {
            $q->where('iduser', $authId)
            ->orWhere('email', $authEmail)
            ->orWhere('user-mail', $authEmail);
        })
        ->orderByDesc(DB::raw('COALESCE(fecha_hora, created_at)'))
        ->get();
        return view('clientes.pedidos', compact('user','ventas'));
    }
}
