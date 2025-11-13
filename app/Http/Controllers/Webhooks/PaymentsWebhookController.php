<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Venta;

class PaymentsWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // 1) OPCIONAL: verifica firma si tu pasarela manda header (ajústalo a tu proveedor)
        $secret = config('services.webhooks.payments_secret'); // .env -> SERVICES_WEBHOOKS_PAYMENTS_SECRET
        if ($secret) {
            $sig = $request->header('X-Webhook-Signature');
            $calc = hash_hmac('sha256', $request->getContent(), $secret);
            if (!hash_equals($calc, (string)$sig)) {
                return response()->json(['error'=>'invalid_signature'], 401);
            }
        }

        // 2) Normaliza el payload (aceptamos varias formas comunes)
        $payload = $request->all();

        // Identificar venta por id o por código
        $ventaId = $payload['venta_id'] ?? $payload['order_id'] ?? null;
        $codigo  = $payload['codigo']   ?? $payload['order_code'] ?? null;

        /** @var \App\Venta|null $venta */
        $venta = null;
        if ($ventaId) {
            $venta = Venta::where('idventa', $ventaId)->first();
        }
        if (!$venta && $codigo) {
            $venta = Venta::where('codigo', $codigo)->first();
        }
        if (!$venta) {
            return response()->json(['error'=>'venta_not_found'], 404);
        }

        // Estado de pago del proveedor
        $paidValues = ['paid','succeeded','approved','completed','captured']; // mapea a tu PSP
        $incomingPayment = strtolower((string)($payload['payment_status'] ?? $payload['status'] ?? ''));
        $isPaid = in_array($incomingPayment, $paidValues, true);

        // Método de cumplimiento: delivery o pickup
        $method = strtolower((string)($payload['fulfillment_method'] ?? $payload['shipping_method'] ?? 'delivery'));
        if (!in_array($method, ['delivery','pickup'], true)) $method = 'delivery';

        // 3) Actualiza venta: pagada + método
        if ($isPaid) {
            $venta->payment_status = 'paid';
            if (empty($venta->paid_at)) $venta->paid_at = now();
        }
        $venta->fulfillment_method = $method;
        $venta->save();

        // 4) Decide transición logística
        //    - delivery  => ready_to_ship  (crea shipment automáticamente)
        //    - pickup    => ready_for_pickup
        if ($isPaid) {
            if ($method === 'delivery') {
                $venta->transitionFulfillment('ready_to_ship');      // crea shipment por ensureShipment()
            } else {
                $venta->transitionFulfillment('ready_for_pickup');   // para recojo en tienda
            }
        }

        // 5) Opcional: setear tracking si te lo manda el proveedor logístico
        if (!empty($payload['tracking_number'])) {
            $shipment = $venta->shipments()->latest('id')->first();
            if ($shipment) {
                $shipment->tracking_number = $payload['tracking_number'];
                $shipment->tracking_url    = $payload['tracking_url'] ?? null;
                $shipment->carrier         = $payload['carrier'] ?? $shipment->carrier;
                $shipment->service         = $payload['service'] ?? $shipment->service;
                $shipment->save();
            }
        }

        return response()->json(['ok'=>true]);
    }
}
