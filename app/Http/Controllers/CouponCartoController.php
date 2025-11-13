<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Carto;
use App\Cupon;
use App\CuponReserva;

class CouponCartoController extends Controller
{
    /** POST /cupones-carto/apply */
    public function apply(Request $req)
    {
        $data = $req->validate(['code' => 'required|string|max:50']);

        // Si ya hay reserva activa en sesión, no dupliques
        if (Session::has('cupon_reserva_id')) {
            $r = CuponReserva::find(Session::get('cupon_reserva_id'));
            if ($r && $r->estado === 'reservado' && $r->expires_at?->isFuture()) {
                return response()->json(['ok' => false, 'msg' => 'Ya tienes un cupón activo.'], 409);
            }
            Session::forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
        }

        // Subtotal actual desde Carto
        $oldCarto = Session::get('carto');
        if (!$oldCarto) return response()->json(['ok'=>false,'msg'=>'Tu carrito está vacío.'], 409);
        $carto = new Carto($oldCarto);
        $subtotalCents = (int) round(((float)$carto->totalPrice) * 100);

        $sessionId = $req->session()->getId();
        $ip = $req->ip();
        $ua = (string) $req->userAgent();
        $userId = auth()->id();

        return DB::transaction(function() use ($data, $sessionId, $ip, $ua, $userId, $subtotalCents) {
            $now = now();

            /** @var Cupon|null $cupon */
            $cupon = Cupon::where('codigo', $data['code'])->lockForUpdate()->first();
            if (!$cupon || !$cupon->ventanaActivaAhora()) {
                return response()->json(['ok'=>false,'msg'=>'Cupón inválido o fuera de vigencia.'], 404);
            }

            if ($cupon->min_subtotal && $subtotalCents < (int)$cupon->min_subtotal) {
                return response()->json(['ok'=>false,'msg'=>'El subtotal no cumple el mínimo para este cupón.'], 409);
            }

            if ($cupon->por_usuario && $cupon->por_usuario > 0 && $userId) {
                $usados = CuponReserva::where('cupon_id',$cupon->id)
                    ->where('user_id',$userId)
                    ->where('estado','consumido')->count();
                if ($usados >= (int)$cupon->por_usuario) {
                    return response()->json(['ok'=>false,'msg'=>'Límite por usuario alcanzado.'], 409);
                }
            }

            $activeHolds = CuponReserva::where('cupon_id',$cupon->id)
                ->where('estado','reservado')->where('expires_at','>', $now)->count();
            $disponibles = (int)$cupon->emitidos - (int)$cupon->reclamados - $activeHolds;
            if ($disponibles <= 0) {
                return response()->json(['ok'=>false,'msg'=>'Todos los cupones fueron usados.'], 409);
            }

            $minutos = max(1, (int)($cupon->duracion_minutos ?: 20));
            $descuentoCent = (int) $cupon->calcularDescuento($subtotalCents);

            $res = CuponReserva::create([
                'cupon_id'           => $cupon->id,
                'user_id'            => $userId,
                'session_id'         => $sessionId,
                'ip'                 => $ip,
                'ua'                 => $ua,
                'estado'             => 'reservado',
                'reserved_at'        => $now,
                'expires_at'         => $now->copy()->addMinutes($minutos),
                'descuento_aplicado' => $descuentoCent,
            ]);

            Session::put('cupon_reserva_id', $res->id);
            Session::put('cupon_codigo', $cupon->codigo);
            Session::put('cupon_expires_at', $res->expires_at->toIso8601String());
            Session::put('cupon_descuento_centavos', $descuentoCent);

            return response()->json([
                'ok'         => true,
                'code'       => $cupon->codigo,
                'expires_at' => $res->expires_at->toIso8601String(),
                'discount'   => number_format($descuentoCent / 100, 2),
                'new_total'  => number_format(max(0, $subtotalCents - $descuentoCent) / 100, 2),
            ]);
        });
    }

    /** POST /cupones-carto/validate */
    public function validateReservation(Request $req)
    {
        $rid = Session::get('cupon_reserva_id');
        if (!$rid) return response()->json(['active'=>false]);

        $r = CuponReserva::with('cupon')->find($rid);
        if (!$r) {
            Session::forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
            return response()->json(['active'=>false]);
        }

        if ($r->estado === 'reservado' && $r->expires_at?->isPast()) {
            $r->update(['estado'=>'caducado']);
            Session::forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
            return response()->json(['active'=>false]);
        }

        if ($r->estado !== 'reservado') {
            Session::forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
            return response()->json(['active'=>false]);
        }

        return response()->json([
            'active'     => true,
            'code'       => Session::get('cupon_codigo'),
            'expires_at' => Session::get('cupon_expires_at'),
            'discount'   => number_format(((int)Session::get('cupon_descuento_centavos',0))/100, 2),
        ]);
    }

    /** DELETE /cupones-carto/remove */
    public function remove(Request $req)
    {
        $rid = Session::get('cupon_reserva_id');
        if ($rid) {
            $r = CuponReserva::find($rid);
            if ($r && $r->estado === 'reservado' && $r->expires_at?->isFuture()) {
                $r->update(['estado'=>'cancelado']);
            }
        }
        Session::forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
        return response()->json(['ok'=>true]);
    }

    /** POST /cupones-carto/finalize (opcional si no lo haces en CartController tras aprobar pago) */
    public function finalize(Request $req)
    {
        $ventaId = $req->input('venta_id');
        $rid = Session::get('cupon_reserva_id');
        if (!$rid) return response()->json(['ok'=>false,'msg'=>'Sin cupón activo.'], 400);

        return DB::transaction(function() use ($rid, $ventaId) {
            $r = CuponReserva::with('cupon')->lockForUpdate()->find($rid);
            if (!$r || $r->estado !== 'reservado' || $r->expires_at?->isPast()) {
                return response()->json(['ok'=>false,'msg'=>'La reserva no es válida.'], 409);
            }
            $cupon = $r->cupon()->lockForUpdate()->first();

            $r->update([
                'estado'      => 'consumido',
                'consumido_at'=> now(),
                'venta_id'    => $ventaId,
            ]);
            $cupon->increment('reclamados');

            Session::forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
            return response()->json(['ok'=>true]);
        });
    }
}
