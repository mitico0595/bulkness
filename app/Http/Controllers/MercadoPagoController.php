<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Exceptions\MPApiException;
use App\Cart;
use Session;
use Carbon\Carbon;
use App\Search;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Venta;
use App\DetalleVenta;
use Illuminate\Support\Facades\Cache;
use App\Cupon;
use App\CuponReserva;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClienteCompraExitosa;
use App\Mail\AdminNuevaVenta;

class MercadoPagoController extends Controller
{

public function show(Request $request)
{
    // 1. leer cookie de delivery
    $json     = $request->cookie('delivery_enc');
    $delivery = json_decode($json ?? '[]', true) ?? [];

    // 2. carrito obligatorio
    $oldCart = Session::get('cart');
    if (!$oldCart) {
        return redirect()->route('adler-venta-detalle');
    }
    $cart = new Cart($oldCart);

    // 3. reconstruir totales igual que siempre
    $paquetes  = Search::where('tipo', 2)->select('id','name','precio','image')->get();
    $articulos = Search::where('tipo', 3)->select('id','name','precio','image')->get();

    $totalesPorGrupo = [];
    $total           = 0;   // subtotal productos
    $qty             = 0;
    $totalkit        = 0;
    $totalarticulo   = 0;
    $totalmochila    = 0;
    $idsCatalogo     = [];

    foreach ($cart->mochilas as $mId => $m) {
        $totalesPorGrupo[$mId] = $m['subTotalPrice'];
        $total                 += $m['subTotalPrice'];
        $qty                   += $m['subTotalQty'];

        if (!empty($m['kit'])) {
            $totalkit     += $m['kit']['precio'] * ($m['kit']['qty'] ?? 1);
            $idsCatalogo[] = $m['kit']['id'];
        }

        foreach ($m['items'] as $pid => $it) {
            if ($pid >= 1 && $pid <= 5) {
                $totalmochila += $it['precio'] * $it['qty'];
            } elseif ($pid >= 20) {
                $totalarticulo += $it['precio'] * $it['qty'];
            }
            $idsCatalogo[] = $pid;
        }
    }

    $catalogo = Search::whereIn('id', array_unique($idsCatalogo))
        ->get()
        ->keyBy('id');

    // actualizo el cart en sesión
    $cart->totalPrice = $total;
$cart->totalQty   = $qty;
Session::put('cart', $cart);

$envio = (float)($delivery['costo'] ?? 0);
$email = $delivery['email'] ?? $delivery['f-email'] ?? null;

// ===== CUPÓN / DESCUENTO =====
$subtotalCents       = (int) round($total * 100);
$couponSecondsLeft   = 0;
$couponExpiresAtIso  = null;
$couponReservationId = null;
$couponDiscountCents = 0;
$descuentoSoles      = 0.0;

// 1) Fuente principal: reserva viva en BD
$reserva = \App\CuponReserva::where('session_id', $request->session()->getId())
    ->where('estado', 'reservado')
    ->latest('id')
    ->first();

if ($reserva && $reserva->expires_at && $reserva->expires_at->isFuture()) {
    $couponSecondsLeft   = $reserva->expires_at->diffInSeconds(now());
    $couponExpiresAtIso  = $reserva->expires_at->toIso8601String();
    $couponReservationId = $reserva->id;

    if ($cupon = \App\Cupon::find($reserva->cupon_id)) {
        // descuento en CENTAVOS sobre el subtotal actual
        $couponDiscountCents = (int) $cupon->calcularDescuento($subtotalCents);
        $descuentoSoles      = $couponDiscountCents / 100;
    }
}

// 2) Fallback: si no pudimos calcular pero la cookie trae descuento no vencido
if ($descuentoSoles <= 0 && !empty($delivery['descuento'])) {
    $cookieExp = $delivery['cupon_expires_at'] ?? null;
    if (!$cookieExp || \Carbon\Carbon::parse($cookieExp)->isFuture()) {
        $descuentoSoles      = (float) $delivery['descuento'];
        $couponDiscountCents = (int) round($descuentoSoles * 100);
    } else {
        // cookie vieja: limpiar
        $delivery['descuento'] = 0;
        unset($delivery['cupon_expires_at']);
    }
}

// 3) Monto final con la única resta válida
$amount = max(0, $total + $envio - $descuentoSoles);

// 4) Reescribir cookie para que F5 muestre el total correcto
$delivery['subtotal']       = $total;
$delivery['descuento']      = $descuentoSoles;
$delivery['costo']          = $envio;
$delivery['total_complete'] = $amount;
if ($couponExpiresAtIso) {
    $delivery['cupon_expires_at'] = $couponExpiresAtIso;
} else {
    unset($delivery['cupon_expires_at']);
}

if ($couponReservationId) {
    $delivery['coupon_reservation_id'] = $couponReservationId;
}
// 5) Render + cookie
return response()
  ->view('pasarela/pago', [
      'items'                 => $cart->mochilas,
      'totalesPorGrupo'       => $totalesPorGrupo,
      'totalmochila'          => $totalmochila,
      'totalarticulo'         => $totalarticulo,
      'totalkit'              => $totalkit,
      'total'                 => $total,
      'envio'                 => $envio,
      'email'                 => $email,
      'productos'             => $qty,
      'paquetes'              => $paquetes,
      'articulos'             => $articulos,
      'catalogo'              => $catalogo,

      'mp_public_key'         => config('services.mercadopago.public_key'),
      'amount'                => $amount,

      'subtotal_cents'        => $subtotalCents,
      'descuento_cents'       => $couponDiscountCents,
      'coupon_seconds_left'   => $couponSecondsLeft,
      'coupon_expires_at_iso' => $couponExpiresAtIso,
      'coupon_discount_cents' => $couponDiscountCents,
      'coupon_reservation_id' => $couponReservationId,
  ])
  ->cookie(
      'delivery_enc',
      json_encode($delivery, JSON_UNESCAPED_UNICODE),
      60 * 24 * 30,
      '/',
      null,
      $request->isSecure(),
      true,
      false,
      'Lax'
  );
}
    public function process(Request $request)
{
    Log::info('MP Payment - Payload recibido', ['data' => $request->all()]);

    // 1) VALIDAR con los nombres que realmente manda el Brick
    try {
        $validated = $request->validate([
            'transaction_amount'              => 'required|numeric|min:1',
            'payment_method_id'               => 'required|string',
            'payer.email'                     => 'required|email',
            'token'                           => 'nullable|string',
            'installments'                    => 'nullable|integer|min:1',
            'issuer_id'                       => 'nullable|string',
            'payer.identification.type'       => 'nullable|string',
            'payer.identification.number'     => 'nullable|string',
            // el Brick lo manda así:
            'coupon_reservation_id'           => 'nullable|integer',
        ]);
    } catch (\Illuminate\Validation\ValidationException $ex) {
        Log::error('MP Payment - Validación fallida', [
            'errors' => $ex->errors(),
            'input'  => $request->all()
        ]);
        return response()->json([
            'error'   => true,
            'message' => 'Error de validación',
            'errors'  => $ex->errors(),
            'input'   => $request->all()
        ], 422);
    }

    // 2) LEER COOKIE DE DELIVERY (la vamos a necesitar sí o sí)
    $deliveryJson = $request->cookie('delivery_enc');
    $delivery     = json_decode($deliveryJson ?? '[]', true) ?? [];

    // 3) CUPÓN: body → sesión → cookie
    $couponReservationId = (int) ($request->input('coupon_reservation_id') ?? 0);
    if (!$couponReservationId) {
        $couponReservationId = (int) (session('cupon_reserva_id') ?? 0);
    }
    if (!$couponReservationId) {
        $couponReservationId = (int) ($delivery['coupon_reservation_id'] ?? 0);
    }

    // 4) CONFIGURAR MP con el truco del SSL LOCAL que ya habíamos usado
    $accessToken = config('services.mercadopago.access_token');
    if (!$accessToken) {
        Log::error('MP Payment - access token no configurado');
        return response()->json([
            'error'   => true,
            'message' => 'MP_ACCESS_TOKEN no configurado'
        ], 500);
    } 

    MercadoPagoConfig::setAccessToken($accessToken);
    // esto fue lo que te quitó el error de “unable to get local issuer certificate”
    

    $client = new PaymentClient();
    $opts   = new RequestOptions();

    $data = $request->all();

    // 5) ARMAR PAYLOAD exactamente como antes
    $payload = [
        'transaction_amount' => (float) $data['transaction_amount'],
        'payment_method_id'  => $data['payment_method_id'],
        'payer' => [
            'email' => $data['payer']['email'],
        ],
    ];

    if (!empty($data['token'])) {
        $payload['token']        = $data['token'];
        $payload['installments'] = isset($data['installments']) ? (int)$data['installments'] : 1;

        if (!empty($data['issuer_id'])) {
            $payload['issuer_id'] = $data['issuer_id'];
        }

        if (!empty($data['payer']['identification']['type']) && !empty($data['payer']['identification']['number'])) {
            $payload['payer']['identification'] = [
                'type'   => $data['payer']['identification']['type'],
                'number' => $data['payer']['identification']['number'],
            ];
        }
    }

    Log::info('MP Payment - Payload enviado a MP', ['payload' => $payload]);

    try {
        // 6) ENVIAR A MP
        $payment = $client->create($payload, $opts);

        Log::info('MP Payment - Respuesta de MP', ['payment' => $payment]);

        // respuesta base
        $resp = [
            'id'            => $payment->id ?? null,
            'status'        => $payment->status ?? null,
            'status_detail' => $payment->status_detail ?? null,
            'payment_method'=> $payment->payment_method_id ?? null,
        ];

        // 7) SI APROBÓ, AHORA SÍ: PERSISTIR VENTA + MARCAR CUPÓN
        if (($payment->status ?? null) === 'approved') {

            // inyectamos el cupón en el request con el nombre que sí lee persistVentaFromCart
            // (tú ahí estás usando camelCase: couponReservationId)
            $request->merge([
                'couponReservationId' => $couponReservationId,
            ]);

            // persistir
            $venta = $this->persistVentaFromCart($request, $delivery);

            // finalizar en BD (pasa a consumido)
            if ($couponReservationId) {
                $this->finalizeCoupon(
                    $couponReservationId,
                    $venta,
                    (int) round($venta->subtotal * 100)
                );
            }

            // matar carrito
            Session::forget('cart');

            // armar recibo y cachearlo
            $receipt = $this->buildReceipt($venta);
            $this->cacheReceiptForSession($receipt);

            // mandar correos igual que Yape
            $this->sendSuccessEmails($venta, $receipt, $delivery);

            return response()->json([
                'success'  => true,
                'redirect' => route('yape.success'),
            ]);
        }

        // 8) SI NO APROBÓ, devolvemos lo que vino de MP
        $tx = $payment->point_of_interaction->transaction_data ?? null;
        if ($tx) {
            $resp['ticket_url']     = $tx->ticket_url ?? null;
            $resp['qr_code']        = $tx->qr_code ?? null;
            $resp['qr_code_base64'] = $tx->qr_code_base64 ?? null;
            $resp['bank_info']      = [
                'transfer_reference' => $tx->bank_transfer_reference->reference_id ?? null,
                'display_name'       => $tx->bank_info->display_name ?? null,
            ];
        }

        return response()->json($resp);

    } catch (MPApiException $e) {
        Log::error('MP API error (tarjeta)', [
            'status' => $e->getApiResponse()->getStatusCode(),
            'body'   => $e->getApiResponse()->getContent(),
        ]);
        return response()->json([
            'error'     => true,
            'message'   => 'No se pudo procesar el pago.',
            'mp_status' => $e->getApiResponse()->getStatusCode(),
            'mp_body'   => $e->getApiResponse()->getContent(),
        ], 422);

    } catch (\Throwable $e) {
        Log::error('MP general error (tarjeta)', [
            'msg'   => $e->getMessage(),
            'line'  => $e->getLine(),
            'file'  => $e->getFile(),
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json([
            'error'   => true,
            'message' => 'Error inesperado.',
            'detalle' => $e->getMessage(),
        ], 500);
    }
}


    public function yape(Request $request){
    \Log::info('=== INICIO YAPE REQUEST ===');
    \Log::info('Request completo:', $request->all());
    
    try {
        \Log::info('Iniciando validación...');
        
        $data = $request->validate([
            'transactionAmount' => 'required|numeric|min:1',
            'paymentMethodId'   => 'required|string|in:yape',
            'token'             => 'required|string',
            'email'             => 'required|email',
            'couponReservationId' => 'nullable|integer',
        ]);
        
        \Log::info('Validación exitosa:', $data);

        // Verificar variables de entorno
        $accessToken = config('services.mercadopago.access_token');
        \Log::info('Access token configurado: ' . (!empty($accessToken) ? 'SÍ' : 'NO'));
        
        if (!$accessToken) {
            \Log::error('MP_ACCESS_TOKEN no configurado');
            return response()->json([
                'error' => true,
                'message' => 'MP_ACCESS_TOKEN no configurado'
            ], 500);
        }

        \Log::info('Configurando MercadoPago...');
        
        // Configurar MercadoPago
        MercadoPagoConfig::setAccessToken($accessToken);
       
        $client = new PaymentClient();

        $payload = [
            'description'        => 'Pago con Yape',
            'transaction_amount' => (float) $data['transactionAmount'],
            'payment_method_id'  => 'yape',
            'token'              => $data['token'],
            'installments'       => 1,
            'payer'              => ['email' => $data['email']],
        ];

        \Log::info('Payload a enviar:', $payload);
        \Log::info('Enviando request a MercadoPago...');

        // Enviar sin RequestOptions
        $payment = $client->create($payload);
        
        \Log::info('Respuesta de MercadoPago exitosa:', [
            'id' => $payment->id ?? 'null',
            'status' => $payment->status ?? 'null',
            'status_detail' => $payment->status_detail ?? 'null'
        ]);
       
        
        if (($payment->status ?? null) === 'approved') {
            // 1. delivery (datos del cliente y envío)
            $json = $request->cookie('delivery_enc');
            $delivery = json_decode($json ?? '[]', true) ?? [];

            // 2. Persistir venta
            $venta = $this->persistVentaFromCart($request, $delivery);

            // 3. finalizar cupón
            
            $couponReservationId = (int) ($request->input('couponReservationId') ?? 0);
            if (!$couponReservationId) {
                $couponReservationId = (int) (session('cupon_reserva_id') ?? 0);
            }
            if (!$couponReservationId) {
                $couponReservationId = (int) ($delivery['coupon_reservation_id'] ?? 0);
            }
            $this->finalizeCoupon($couponReservationId, $venta, (int) round($venta->subtotal * 100));


            // 4. matar cart
            Session::forget('cart');

            // 5. armar recibo (lo usaremos para email y para la vista)
            $receipt = $this->buildReceipt($venta);

            // 6. ENVIAR CORREOS
            $this->sendSuccessEmails($venta, $receipt, $delivery);

            // 7. cachear para la vista success
            $this->cacheReceiptForSession($receipt);

            return response()->json([
                'success'  => true,
                'redirect' => route('yape.success'),
            ]);
        }

        return response()->json([
            'id'            => $payment->id ?? null,
            'status'        => $payment->status ?? null,
            'status_detail' => $payment->status_detail ?? null,
            'success'       => true
        ]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        \Log::error('Error de validación:', $e->errors());
        return response()->json([
            'error' => true,
            'message' => 'Error de validación',
            'errors' => $e->errors()
        ], 422);
        
    } catch (MPApiException $e) {
        \Log::error('MercadoPago API Error:', [
            'status_code' => $e->getApiResponse()->getStatusCode(),
            'content' => $e->getApiResponse()->getContent(),
            'message' => $e->getMessage()
        ]);

        return response()->json([
            'error'     => true,
            'message'   => 'Error de MercadoPago API',
            'mp_status' => $e->getApiResponse()->getStatusCode(),
            'mp_body'   => $e->getApiResponse()->getContent(),
        ], 422);

    } catch (Exception $e) {
        \Log::error('Error general en Yape:', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'error' => true,
            'message' => 'Error interno del servidor: ' . $e->getMessage()
        ], 500);
    }

    }

    public function successView(Request $request)
    {
        $receipt = $this->pullReceiptFromCacheOrGate();
        if (!$receipt) {
            return redirect()->route('success.gate');
        }
       
        // Renderiza tu blade 'pasarela.success' con el recibo
        return view('pasarela.success', ['receipt' => $receipt]);
    }


    private function persistVentaFromCart(Request $request, array $delivery): Venta
    {
        $oldCart = Session::get('cart');
        if (!$oldCart) {
            throw new \RuntimeException('Carrito vacío al intentar persistir venta.');
        }
        $cart = new Cart($oldCart);

        // Campos de cookie (con defaults decentes)
        $tipo       = (int)($delivery['tipo'] ?? 1);
        $email      = $delivery['email'] ?? $delivery['f-email'] ?? null;   
        $user_mail =  Auth::user()->email ?? null;
        $nombres    = $delivery['nombres'] ?? '';
        $apellidos  = $delivery['apellidos'] ?? '';
        $dni        = $delivery['dni'] ?? '';
        $celular    = $delivery['celular'] ?? '';
        $domicilio  = $delivery['direccion'] ?? '';
        $referencia = $delivery['referencia'] ?? '';
        $distrito   = $delivery['distrito'] ?? '';
        $provincia  = $delivery['provincia'] ?? '';
        $departamento = $delivery['ciudad'] ?? ($delivery['departamento'] ?? '');
        $cargoEnvio = (float)($delivery['costo'] ?? 0);
        $totalComplete = (float)($delivery['total_complete'] ?? 0);

        // Totales del cart
        $subtotalVenta = (float)$cart->totalPrice;    // tu “subtotal” (sin envío)
        $totalVenta    = $totalComplete > 0 ? $totalComplete : $subtotalVenta + $cargoEnvio;

        $userId = auth()->id() ?: 1; // 1 si no logueado

        // Código único de venta
        $codigo = 'V-'.date('YmdHis').'-'.Str::upper(Str::random(6));
        // ========== CUPÓN: buscar en 3 lugares ==========
        // 1) request (lo ideal)
        $couponReservationId = (int) $request->input('couponReservationId', 0);

        // 2) sesión (como en el CartController)
        if (!$couponReservationId) {
            $couponReservationId = (int) (session('cupon_reserva_id') ?? 0);
        }

        // 3) cookie delivery (por si el front es flojo)
        if (!$couponReservationId) {
            $couponReservationId = (int) ($delivery['coupon_reservation_id'] ?? 0);
        }

        $detalleJson = null;
        if ($couponReservationId) {
            $res = \App\CuponReserva::with('cupon')->find($couponReservationId);
            if ($res) {
                $detalleJson = json_encode([
                    'coupon_code'           => optional($res->cupon)->codigo,
                    'coupon_reservation_id' => $couponReservationId,
                ], JSON_UNESCAPED_UNICODE);
            }
        }
        // Guarda cabecera
        $venta = Venta::create([
            'iduser'      => $userId,
            'codigo'      => $codigo,
            'subtotal'    => $subtotalVenta,
            'total_venta' => $totalVenta,
            'tipo'        => $tipo,                // 0 recojo, 1 delivery
            'cargo_envio' => $cargoEnvio,
            'detalle'     => $detalleJson,
            'fecha_hora'  => now(),

            'nombre'      => $nombres,
            'email'       => $email,
            'user-mail'   => $user_mail,
            'apellido'    => $apellidos,
            'domicilio'   => $domicilio,
            'celular'     => $celular,
            'distrito'    => $distrito,
            'provincia'   => $provincia,
            'departamento'=> $departamento,
            'dni'         => $dni,
            'referencia'  => $referencia,
        ]);

        // Detalle: idsub por cada mochila (paquete) “mch_*”
        $idsub = 1;
        foreach ($cart->mochilas as $mId => $m) {

            // kit (si hay)
            if (!empty($m['kit'])) {
                $kit = $m['kit'];
                $qty = (int)($kit['qty'] ?? 1);
                $precio = (float)$kit['precio'];
                DetalleVenta::create([
                    'idventa'   => $venta->idventa,
                    'idsub'     => $idsub, 
                    'idarticulo'=> (int)$kit['id'],
                    'qty'       => $qty,
                    'precio'    => $precio,
                    'subtotal'  => $precio * $qty,
                    'opinion'   => null,
                    'valoracion'=> null,
                ]);
            }

            // items
            foreach ($m['items'] as $pid => $it) {
                $qty = (int)($it['qty'] ?? 1);
                $precio = (float)$it['precio'];
                DetalleVenta::create([
                    'idventa'   => $venta->idventa,
                    'idsub'     => $idsub,
                    'idarticulo'=> (int)$pid,
                    'qty'       => $qty,
                    'precio'    => $precio,
                    'subtotal'  => $precio * $qty,
                    'opinion'   => null,
                    'valoracion'=> null,
                ]);
            }

            $idsub++;
        }

        return $venta;
    }

    private function buildReceipt(Venta $venta): array
    {
        // Trae detalle
        $detalles = $venta->detalle()
            ->orderBy('idsub')->get(['idsub','idarticulo','qty','precio','subtotal']);
        
        
        // Agrupa por idsub para reconstruir “paquetes”
        $grupos = [];
        foreach ($detalles as $d) {
             $articulo = Search::where('id', $d->idarticulo)->select('name','image')->first(); // ← no get()
            $grupos[$d->idsub][] = [
                'idarticulo' => (int)$d->idarticulo,
                 'name'       => $articulo->name  ?? ('Artículo #'.$d->idarticulo),
                'image'      => $articulo->image ?? null,
                'qty'        => (int)$d->qty,
                'precio'     => (float)$d->precio,
                'subtotal'   => (float)$d->subtotal,
            ];
        }

        return [
            'venta' => [
                'idventa'     => (int)$venta->idventa,
                'codigo'      => $venta->codigo,
                'subtotal'    => (float)$venta->subtotal,
                'cargo_envio' => (float)$venta->cargo_envio,
                'total'       => (float)$venta->total_venta,
                'fecha'       => $venta->fecha_hora?->toDateTimeString(),
                'detalle'     => $venta->detalle,
            ],
            'cliente' => [
                'nombre'   => $venta->nombre,
                'apellido' => $venta->apellido,
                'email'    => $venta->email,
                'dni'      => $venta->dni,
                'celular'  => $venta->celular,
                'envio'    => [
                    'domicilio'    => $venta->domicilio,
                    'distrito'     => $venta->distrito,
                    'provincia'    => $venta->provincia,
                    'departamento' => $venta->departamento,
                    'referencia'   => $venta->referencia,
                ],
                'tipo' => (int)$venta->tipo,
            ],
            'grupos' => $grupos, // cada idsub => líneas
        ];
    }

    private function cacheReceiptForSession(array $receipt): void
    {
        $sid = session()->getId();
        $uaHash = hash('sha256', (string)request()->userAgent());
        $key = "receipt:{$sid}";
        Cache::put($key, [
            'ua'      => $uaHash,
            'receipt' => $receipt,
        ], now()->addMinutes(30));

        // Ventana de acceso en sesión (para /yape/success)
        session()->put('success_window', [
            'sid'   => $sid,
            'ua'    => $uaHash,
            'until' => now()->addMinutes(30)->timestamp,
        ]);
    }
    private function finalizeCoupon(?int $reservationId, Venta $venta, int $subtotalCents): void
    {
    if (!$reservationId) return;

    DB::transaction(function () use ($reservationId, $venta, $subtotalCents) {
        $res = CuponReserva::lockForUpdate()->find($reservationId);
        if (!$res) return;
        if ($res->session_id !== session()->getId()) return;

        if ($res->estado !== 'reservado' || $res->expires_at->lte(now())) {
            $res->estado = 'expirado';
            $res->save();
            return;
        }

        $cupon = Cupon::lockForUpdate()->find($res->cupon_id);
        if (!$cupon) return;

        $descuento = $cupon->calcularDescuento($subtotalCents);

        $res->estado          = 'consumido';
        $res->venta_id        = $venta->idventa;
        $res->consumido_at    = now();
        $res->descuento_aplicado = $descuento;
        $res->save();

        $cupon->reclamados = $cupon->reclamados + 1;
        $cupon->save();

        // Si ya agregaste las columnas en ventas, guarda el rastro
        if (\Schema::hasColumn('ventas','coupon_id')) {
            $venta->coupon_id      = $cupon->id;
            $venta->coupon_code    = $cupon->codigo;
            $venta->discount_cents = $descuento;
            $venta->save();
        }
    });
    }

    /** Gate común: si no hay ventana o cambió dispositivo, manda al gate. */
    private function pullReceiptFromCacheOrGate()
    {
        $win = session('success_window');
        if (!$win || ($win['until'] ?? 0) < time()) {
            session()->forget('success_window');
            return null;
        }
        $sid = $win['sid'] ?? session()->getId();
        $cached = Cache::get("receipt:{$sid}");
        if (!$cached) return null;

        $uaNow = hash('sha256', (string)request()->userAgent());
        if (($cached['ua'] ?? '') !== $uaNow || ($win['ua'] ?? '') !== $uaNow) {
            return null; // otro dispositivo/UA
        }
        return $cached['receipt'] ?? null;
    }
    public function gate(){
    return view('pasarela.success_gate');
    }
    public function checkCoupon(Request $request)
{
    $sid = $request->session()->getId();

    // leemos cookie de delivery
    $deliveryJson = $request->cookie('delivery_enc');
    $delivery     = json_decode($deliveryJson ?? '[]', true) ?? [];

    // leemos carrito
    $oldCart  = Session::get('cart');
    $subtotal = 0;
    if ($oldCart) {
        $cart    = new Cart($oldCart);
        $subtotal= (float)$cart->totalPrice;
    }

    $envio = (float)($delivery['costo'] ?? 0);

    // buscamos la reserva
    $reserva = CuponReserva::where('session_id', $sid)
        ->where('estado', 'reservado')
        ->orderByDesc('id')
        ->first();

    // si no hay reserva, devolvemos total normal
    if (!$reserva) {
        $delivery['descuento']      = 0;
        $delivery['total_complete'] = $subtotal + $envio;

        return response()->json([
            'active'    => false,
            'expired'   => true,
            'descuento' => 0,
            'total'     => $delivery['total_complete'],
        ])->withCookie(cookie('delivery_enc', json_encode($delivery), 60 * 24));
    }

    // si todavía NO expiró, devolvemos cuánto le queda
    if ($reserva->expires_at && $reserva->expires_at->gt(now())) {
        $cupon = Cupon::find($reserva->cupon_id);
        $discountCents = 0;
        if ($cupon) {
            $discountCents = $cupon->calcularDescuento((int)round($subtotal * 100));
        }
        $totalConDescuento = $subtotal + $envio - ($discountCents / 100);

        // actualizamos cookie para que tenga el total real
        $delivery['descuento']      = ($discountCents / 100);
        $delivery['total_complete'] = $totalConDescuento;

        return response()->json([
            'active'       => true,
            'expired'      => false,
            'seconds_left' => $reserva->expires_at->diffInSeconds(now()),
            'descuento'    => ($discountCents / 100),
            'total'        => $totalConDescuento,
        ])->withCookie(cookie('delivery_enc', json_encode($delivery), 60 * 24));
    }

    // si ya EXPIRÓ → marcarla y devolver total sin descuento
    $reserva->estado = 'expirado';
    $reserva->save();

    $delivery['descuento']      = 0;
    $delivery['total_complete'] = $subtotal + $envio;

    return response()->json([
        'active'    => false,
        'expired'   => true,
        'descuento' => 0,
        'total'     => $delivery['total_complete'],
    ])->withCookie(cookie('delivery_enc', json_encode($delivery), 60 * 24));
}
private function sendSuccessEmails(Venta $venta, array $receipt, array $delivery = []): void
{
    try {
        $clienteEmail = $delivery['email']
            ?? $delivery['f-email']
            ?? $venta->email
            ?? null;

        $adminEmail = config('services.sales_email')
            ?? env('SALES_EMAIL', 'miangelsp11@gmail.com');

        // forzamos smtp porque ya probaste que Brevo funciona
        $mailer = 'smtp';

        if ($clienteEmail) {
            \Mail::mailer($mailer)->to($clienteEmail)->send(
                new \App\Mail\ClienteCompraExitosa($venta, $receipt, $delivery)
            );
        }

        if ($adminEmail) {
            \Mail::mailer($mailer)->to($adminEmail)->send(
                new \App\Mail\AdminNuevaVenta($venta, $receipt, $delivery)
            );
        }
    } catch (\Throwable $e) {
        \Log::error('Error enviando correos de venta: '.$e->getMessage(), [
            'venta_id' => $venta->idventa ?? null,
        ]);
    }
}

}