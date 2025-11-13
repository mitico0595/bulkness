<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Search;
use App\Calificacion;
use App\Valoras;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Exceptions\MPApiException;
use App\Carto;
use App\Venta;
use App\DetalleVenta;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use Session;
use Auth;
use Niubiz;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\CuponReserva;
use App\Cupon;
use Illuminate\Support\Facades\Log;

use App\Mail\ClienteCompraExitosa;
use App\Mail\AdminNuevaVenta;


use Exception;





class CartController extends Controller
{
    public function outStock(Request $request, $id){
        $search = Search::findOrFail($id);

        $search->stock = 0;
        $search->update();




        //dd($request->session()->get('cart'));
        $name = 'Sin Stock';


        return redirect()->back()->with('success',$name);
            # code...return redirect()->back()->with(['success' => $name,'motivo' => $motivo]);

    }
    public function getCarto(){
    if(!Session::has('carto')){
        return view('shop.carro-compras', ['searches'=>null]);
    }
    $oldCart = Session::get('carto');
    $cart = new Carto($oldCart);

    // --------- RECUPERAR Y RECALCULAR CUPÓN ---------
    $subtotalAntes = (float)$cart->totalPrice;
    $cuponDescuento  = 0.0;
    $cuponCodigo     = null;
    $cuponExpiresIso = null;

    $rid = session('cupon_reserva_id');
    if ($rid) {
        $res = CuponReserva::with('cupon')->find($rid);
        if ($res && $res->estado === 'reservado' && $res->expires_at && $res->expires_at->isFuture()) {
            $cupon = $res->cupon;
            if ($cupon && $cupon->ventanaActivaAhora()) {
                $subtotalCents = (int) round($subtotalAntes * 100);
                $cumpleMinimo = !($cupon->min_subtotal) || $subtotalCents >= (int)$cupon->min_subtotal;
                $descuentoCents = $cumpleMinimo ? (int)$cupon->calcularDescuento($subtotalCents) : 0;

                $cuponDescuento  = $descuentoCents / 100.0;
                $cuponCodigo     = $cupon->codigo;
                $cuponExpiresIso = $res->expires_at->toIso8601String();

                session([
                    'cupon_codigo'             => $cuponCodigo,
                    'cupon_expires_at'         => $cuponExpiresIso,
                    'cupon_descuento_centavos' => $descuentoCents,
                ]);

                if ((int)$res->descuento_aplicado !== (int)$descuentoCents) {
                    $res->update(['descuento_aplicado' => $descuentoCents]);
                }
            } else {
                $res->update(['estado' => 'caducado']);
                session()->forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
            }
        } else {
            if ($res && $res->estado === 'reservado' && $res->expires_at && $res->expires_at->isPast()) {
                $res->update(['estado' => 'caducado']);
            }
            session()->forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
        }
    }
    $totalNeto = max(0, $subtotalAntes - $cuponDescuento);

    // Pasar ambas cifras
    return view('shop.carro-compras', [
        'searches'        => $cart->items,
        'totalPrice'      => $subtotalAntes,   // Subtotal antes de cupón
        'totalNet'        => $totalNeto,       // Total después de cupón
        'cupon_descuento' => $cuponDescuento,
        'cupon_codigo'    => $cuponCodigo,
        'cupon_expires'   => $cuponExpiresIso,

        // lo demás que ya pasabas
        'Bprice'       => $cart->Bprice,
        'BpriceV'      => $cart->BpriceV,
        'BpriceLocal'  => $cart->BpriceLocal,
        'charge'       => $cart->charge,
        'send'         => $cart->send,
        'sendV'        => $cart->sendV,
        'totalPrecio'  => $cart->totalPrice,
        'totalPrecioProv' => $cart->totalPrecioProv,
        'chargeProv'   => $cart->chargeProv,
        'transfer'     => $cart->transfer,
    ]);
}





    public function getAddToCarto(Request $request, $id){
        $search = Search::find($id);
        $oldCart = Session::has('carto') ? Session::get('carto') : null;
        $carto = new Carto($oldCart);
        $carto->add($search, $search->id);

        $request->session()->put('carto',$carto);
        //dd($request->session()->get('cart'));
        $name = 'Agregado con exito';


        return redirect()->back()->with('success',$name);
            # code...return redirect()->back()->with(['success' => $name,'motivo' => $motivo]);

    }
    public function getReduceByOneCarto($id){

        $oldCart = Session::has('carto') ? Session::get('carto') : null;
        $carto = new Carto($oldCart);
        $carto->reduceByOne($id);

        if(count($carto->items) > 0){
            Session::put('carto',$carto);
        }
        else{
            Session::forget('carto');
        }
        return redirect()->back();
    }
    public function getRemoveCarto($id){
        $oldCart = Session::has('carto') ? Session::get('carto') : null;
        $carto = new Carto($oldCart);
        $carto->removeItem($id);
        if(count($carto->items) > 0){
            Session::put('carto',$carto);
        }
        else{
            Session::forget('carto');
        }

        return redirect()->back();
    }

   public function show(Request $request)
    {
    // 1) Carrito
    $oldCarto = Session::get('carto');
    if (!$oldCarto) {
        // Si no hay carrito, manda a la ruta del pago (o a tu carrito principal)
        return redirect()->route('mp.pago'); // ajusta si quieres otra ruta
    }
    $carto = new Carto($oldCarto);

    // 2) Leer cookie delivery (si existe)
    $json = $request->cookie('delivery_enc');
    $delivery = json_decode($json ?? '[]', true) ?: [];

    // Email visible
    $email = $delivery['email'] ?? ($delivery['f-email'] ?? (auth()->user()->email ?? null));

    // 3) Subtotal base desde carrito
    $subtotal = (float)$carto->totalPrice;

    // 4) Descuento de cupón (misma lógica que usas en DeliveryCarto/resumenCarto)
    $cuponDescuento = 0.0;
    $rid = session('cupon_reserva_id');
    if ($rid) {
        $res = \App\CuponReserva::with('cupon')->find($rid);
        if ($res && $res->estado === 'reservado' && $res->expires_at && $res->expires_at->isFuture()) {
            $cupon = $res->cupon;
            if ($cupon && $cupon->ventanaActivaAhora()) {
                $subtotalCents = (int) round($subtotal * 100);
                $cumpleMinimo = !($cupon->min_subtotal) || $subtotalCents >= (int)$cupon->min_subtotal;
                $descuentoCents = $cumpleMinimo ? (int)$cupon->calcularDescuento($subtotalCents) : 0;

                $cuponDescuento = $descuentoCents / 100.0;

                // refrescar sesión del timer (opcional)
                session([
                    'cupon_codigo'             => $cupon->codigo,
                    'cupon_expires_at'         => $res->expires_at->toIso8601String(),
                    'cupon_descuento_centavos' => $descuentoCents,
                ]);

                if ((int)$res->descuento_aplicado !== (int)$descuentoCents) {
                    $res->update(['descuento_aplicado' => $descuentoCents]);
                }
            }
        }
    }

    // 5) Envío (si hay cookie)
    $envio = (float)($delivery['costo'] ?? 0.0);

    // 6) Neto y total a cobrar
    $neto   = max(0.0, $subtotal - $cuponDescuento);
    // NO confíes en delivery['total_carto'] (podría estar viejo): reházlo aquí
    $amount = round($neto + $envio, 2);

    // 7) Cantidad de productos (si quieres mostrarlo)
    $qty = (int)$carto->totalQty;

    // 8) Render de la vista correcta (usa la que pegaste: pasarela/pago.blade.php)
    return view('pasarela.pagocart', [
        'items'           => $carto->items,
        'total'           => $subtotal,        // Subtotal antes de descuento
        'envio'           => $envio,
        'email'           => $email,
        'productos'       => $qty,
        'amount'          => $amount,          // Total a cobrar (neto + envío)
        'cupon_descuento' => $cuponDescuento,  // Para pintar el -S/.
        // Mercado Pago
        'mp_public_key'   => env('MP_TEST_BRIC_KEY'),
    ]);
    }


    public function DeliveryCarto(Request $request)
{
    // 1) Carrito CARTO
    $oldCarto = Session::get('carto');
    
    if (!$oldCarto) {
        return redirect()->route('pasarela-pago'); // o la ruta que uses cuando no hay carrito
    }

    $carto = new Carto($oldCarto);

    // 2) Totales y desglose (lineal)
    $total  = (float)$carto->totalPrice;
    $qty    = (int)$carto->totalQty;
    // 2.1) Descuento de cupón (si existe)
    $cuponDescuento = 0.0;
    $rid = session('cupon_reserva_id');
    if ($rid) {
        $res = \App\CuponReserva::with('cupon')->find($rid);
        if ($res && $res->estado === 'reservado' && $res->expires_at && $res->expires_at->isFuture()) {
            $cupon = $res->cupon;
            if ($cupon && $cupon->ventanaActivaAhora()) {
                $subtotalCents = (int) round($total * 100);
                $cumpleMinimo = !($cupon->min_subtotal) || $subtotalCents >= (int)$cupon->min_subtotal;
                $descuentoCents = $cumpleMinimo ? (int)$cupon->calcularDescuento($subtotalCents) : 0;
                $cuponDescuento = $descuentoCents / 100.0;

                // refrescar sesión para el timer
                session([
                    'cupon_codigo'             => $cupon->codigo,
                    'cupon_expires_at'         => $res->expires_at->toIso8601String(),
                    'cupon_descuento_centavos' => $descuentoCents,
                ]);

                if ((int)$res->descuento_aplicado !== (int)$descuentoCents) {
                    $res->update(['descuento_aplicado' => $descuentoCents]);
                }
            }
        }
    }

    $neto = max(0.0, $total - $cuponDescuento);

///////
    $totalkit = 0; // CARTO no usa kits, lo dejamos 0 para que el blade no reviente
    $totalmochila = 0;
    $totalarticulo = 0;
    $idsCatalogo = [];

    if (!empty($carto->items)) {
        foreach ($carto->items as $pid => $it) {
            $lineTotal = (float)$it['precio']; // en Carto ya es precio * qty
            // tu “regla por rangos” para pintar resumen
            if ($pid >= 1 && $pid <= 5) {
                $totalmochila += $lineTotal;
            } elseif ($pid >= 20) {
                $totalarticulo += $lineTotal;
            }
            $idsCatalogo[] = (int)$pid;
        }
    }

    $catalogo = Search::whereIn('id', array_unique($idsCatalogo))
        ->get()
        ->keyBy('id');

    // 3) Leer y ajustar cookie delivery
    $delivery = null;
    if ($request->isMethod('get')) {
        $json = $request->cookie('delivery_enc');
        $delivery = json_decode($json ?? '[]', true);
        if (!is_array($delivery)) $delivery = [];
    }

    // fuerza el flow a carto
    $delivery['flow'] = 'carto';

    $costo_delivery = (float)($delivery['costo'] ?? 0.0);
    $delivery['subtotal']    = round($neto, 2);
    $delivery['total_carto'] = round($neto + $costo_delivery, 2);

    // por si el pago quiere preliminarmente un email visible
    $email = $delivery['email'] ?? ($delivery['f-email'] ?? (auth()->user()->email ?? null));

    // 4) Datos de catálogo por si pintas widgets al costado
    $paquetes  = Search::where('tipo', 2)->select('id','name','precio','image')->get();
    $articulos = Search::where('tipo', 3)->select('id','name','precio','image')->get();

    // 5) Render de la vista (delivery de CARTO) y set cookie
    $minutes = 60 * 24 * 30;
    return response()
        ->view('pasarela.deliverycarto', [
            // resumen
            'total'           => $total,
            'qty'             => $qty,
            'totalesPorGrupo' => [],        // CARTO no usa grupos, lo dejas vacío
            'totalmochila'    => $totalmochila,
            'totalarticulo'   => $totalarticulo,
            'totalkit'        => $totalkit,
            'paquetes'        => $paquetes,
            'articulos'       => $articulos,
            'catalogo'        => $catalogo,

            // delivery cookie
            'delivery'        => $delivery,
            'email'           => $email,
            'amount'          => $delivery['total_carto'], 
            'envio'           => $costo_delivery,
            'cupon_descuento' => $cuponDescuento,
            'subtotal'        => $total,
            'total'           => $neto,
        ])
        ->cookie(
            'delivery_enc',
            json_encode($delivery, JSON_UNESCAPED_UNICODE),
            $minutes,
            '/',
            null,
            $request->isSecure(),
            true,
            false,
            'Lax'
        );
}
    private function calcularCosto(string $ciudad, string $provincia, string $distrito): int
    {
        $ci = $this->normaliza($ciudad);
        $pr = $this->normaliza($provincia);
        $di = $this->normaliza($distrito);

        $base10 = [
            'san miguel','pueblo libre','magdalena','san isidro',
            'miraflores','san borja','lince','brena','lima' 
        ];

        if ($ci === 'lima' && $pr === 'lima') {
            return in_array($di, $base10, true) ? 10 : 18;
        }
        return 29;
    }

    private function normaliza(string $s): string    
    {
        $s = strtolower(trim($s));
        $converted = @iconv('UTF-8', 'ASCII//TRANSLIT', $s);
        if ($converted !== false) $s = $converted;
        $s = preg_replace('/[^a-z0-9\s]/', '', $s);
        $s = preg_replace('/\s+/', ' ', $s);
        return trim($s);
    }

    public function GuardarDelivery(Request $request)
    {
        if ($request->isMethod('get')) {
            // Leer cookie (Laravel la desencripta si está en el grupo 'web')
            $json = $request->cookie('delivery_enc');
            return response()->json([
                'delivery' => $json ? json_decode($json, true) : null,
            ]);
        }
        

        // --- POST ---
        $tipo = (int) $request->input('tipo', 1); // 0 = recojo, 1 = delivery
        $fmail = $request->input('f-email');
        
        if ($tipo === 0) {
            // RECOJO: Solo validar tipo
            $validatedData = $request->validate([
                'tipo' => ['required','in:0,1'],
            ]);
            
            $data = [
                'tipo' => $tipo,
                'costo' => 0, 
                'f-email' => $fmail, 
            ];
            
        } else {
            // DELIVERY: Validar todos los campos (excluir f-email)
            $data = $request->validate([
                'tipo'      => ['required','in:0,1'],
                'email'     => ['required','email'],
                'ciudad'    => ['required','string'],
                'provincia' => ['required','string'],
                'distrito'  => ['required','string'],
                'dni'       => ['required','digits:8'],
                'celular'   => ['required','digits:9'],
                'nombres'   => ['required','string','max:100'],
                'apellidos' => ['required','string','max:100'],
                'direccion' => ['required','string','max:255'],
                'referencia' => ['string','max:255'],
            ]);

            // Calcular costo solo para delivery
            $data['costo'] = $this->calcularCosto($data['ciudad'], $data['provincia'], $data['distrito']);
            $data['tipo'] = $tipo; // Asegurar que el tipo esté en los datos
        }
        // Calcular total completo
        $oldCarto = Session::get('carto');
        $carto = new Carto($oldCarto);
        $total = $carto->totalPrice;

        // Aquí metes descuento si lo tienes en sesión o en otra variable
        

                // DESCUENTO DE CUPÓN para total_carto en cookie:
        $cuponDescuento = 0.0;
        $rid = session('cupon_reserva_id');
        if ($rid) {
            $res = \App\CuponReserva::with('cupon')->find($rid);
            if ($res && $res->estado === 'reservado' && $res->expires_at && $res->expires_at->isFuture()) {
                $cupon = $res->cupon;
                if ($cupon && $cupon->ventanaActivaAhora()) {
                    $subtotalCents = (int) round($total * 100);
                    $cumpleMinimo = !($cupon->min_subtotal) || $subtotalCents >= (int)$cupon->min_subtotal;
                    $descuentoCents = $cumpleMinimo ? (int)$cupon->calcularDescuento($subtotalCents) : 0;

                    $cuponDescuento = $descuentoCents / 100.0;

                    // refresco de sesión (opcional)
                    session([
                        'cupon_codigo'             => $cupon->codigo,
                        'cupon_expires_at'         => $res->expires_at->toIso8601String(),
                        'cupon_descuento_centavos' => $descuentoCents,
                    ]);

                    if ((int)$res->descuento_aplicado !== (int)$descuentoCents) {
                        $res->update(['descuento_aplicado' => $descuentoCents]);
                    }
                }
            }
        }

        // Recalcular neto + envío para la cookie:
        $neto = max(0.0, $total - $cuponDescuento);
        $data['total_carto'] = round($neto + (float)$data['costo'], 2);
        // Guardar cookie por 30 días (en minutos)
        $minutes = 60 * 24 * 30;

        return response()
            ->json(['ok' => true, 'delivery' => $data])
            ->cookie(
                'delivery_enc',                                 // nombre
                json_encode($data, JSON_UNESCAPED_UNICODE),     // valor
                $minutes,                                       // minutos
                '/',                                            // path
                null,                                           // domain
                $request->isSecure(),                           // secure (true si HTTPS)
                true,                                           // httpOnly (recomendado)
                false,                                          // raw
                'Lax'                                           // sameSite
            );
    }
    
    public function process(Request $request)
{
    $data = $request->all();
    Log::info('MP Payment - Payload recibido (carto)', ['data' => $data]);

    // 1) VALIDAR incluyendo el cupón que puede venir del Brick
    try {
        $validated = $request->validate([
            'transaction_amount'               => 'required|numeric|min:1',
            'payment_method_id'                => 'required|string',
            'payer.email'                      => 'required|email',
            'token'                            => 'nullable|string',
            'installments'                     => 'nullable|integer|min:1',
            'issuer_id'                        => 'nullable|string',
            'payer.identification.type'        => 'nullable|string',
            'payer.identification.number'      => 'nullable|string',
            'coupon_reservation_id'            => 'nullable|integer',  // ← ESTE FALTABA
        ]);
    } catch (\Illuminate\Validation\ValidationException $ex) {
        Log::error('MP Payment - Validación fallida (carto)', [
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

    // 2) LEER DELIVERY PARA TENER LA COOKIE A MANO
    $json     = $request->cookie('delivery_enc');
    $delivery = json_decode($json ?? '[]', true) ?? [];

    // 3) RESOLVER EL CUPÓN: body → sesión → cookie
    $couponReservationId = (int) ($request->input('coupon_reservation_id') ?? 0);
    if (!$couponReservationId) {
        $couponReservationId = (int) (session('cupon_reserva_id') ?? 0);
    }
    if (!$couponReservationId) {
        $couponReservationId = (int) ($delivery['coupon_reservation_id'] ?? 0);
    }

    // 4) CONFIGURAR MP IGUAL QUE EN EL OTRO CONTROLADOR
    $accessToken = config('services.mercadopago.access_token'); 
    if (!$accessToken) {
        Log::error('MP Payment (carto) - MP_TEST_API_ACCESS_TOKEN no configurado');
        return response()->json([
            'error'   => true,
            'message' => 'MP_ACCESS_TOKEN no configurado'
        ], 500);
    }

    MercadoPagoConfig::setAccessToken($accessToken);
    // este era el truco que en el otro sí estaba
    

    $client = new PaymentClient();
    $opts   = new RequestOptions();

    // 5) ARMAR PAYLOAD PARA MP
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

    Log::info('MP Payment - Payload enviado a MP (carto)', ['payload' => $payload]);

    try {
        // 6) ENVIAR A MP
        $payment = $client->create($payload, $opts);
        Log::info('MP Payment - Respuesta de MP (carto)', ['payment' => $payment]);

        $resp = [
            'id'            => $payment->id ?? null,
            'status'        => $payment->status ?? null,
            'status_detail' => $payment->status_detail ?? null,
            'payment_method'=> $payment->payment_method_id ?? null,
        ];

        // 7) SI APROBÓ HACEMOS TODO EL FLOW
        if (($payment->status ?? null) === 'approved') {

            // inyectamos el cupón en el request con el nombre que tu persistVentaFromCart usa al final
            if ($couponReservationId) {
                $request->merge([
                    'couponReservationId' => $couponReservationId,
                ]);
                // y lo metemos a sesión porque tu finalizeCouponReservation()
                // solo mira session('cupon_reserva_id')
                session(['cupon_reserva_id' => $couponReservationId]);
            }

            // persistir venta
            $venta = $this->persistVentaFromCart($request, $delivery);

            // matar el carrito de carto, no el otro
            Session::forget('carto');

            // marcar el cupón como consumido (usa el que dejamos en sesión recién)
            $this->finalizeCouponReservation($venta->idventa);

            // armar recibo y cachearlo
            $receipt = $this->buildReceipt($venta);
            $this->cacheReceiptForSession($receipt);

            // enviar correos
            $this->sendSuccessEmails($venta, $receipt, $delivery);

            return response()->json([
                'success'  => true,
                'redirect' => route('yape.success'),
            ]);
        }

        // 8) NO APROBADO, devolvemos info que sirva al front
        $tx = $payment->point_of_interaction->transaction_data ?? null;
        if ($tx) {
            $resp['ticket_url']      = $tx->ticket_url ?? null;
            $resp['qr_code']         = $tx->qr_code ?? null;
            $resp['qr_code_base64']  = $tx->qr_code_base64 ?? null;
            $resp['bank_info'] = [
                'transfer_reference' => $tx->bank_transfer_reference->reference_id ?? null,
                'display_name'       => $tx->bank_info->display_name ?? null,
            ];
        }

        return response()->json($resp);

    } catch (MPApiException $e) {
        Log::error('MP API error (carto)', [
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
        Log::error('MP general error (carto)', [
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
            // delivery
            $json = $request->cookie('delivery_enc');
            $delivery = json_decode($json ?? '[]', true) ?? [];

            // Persistir venta
            $venta = $this->persistVentaFromCart($request, $delivery);

            // Matar cart
            Session::forget('carto');
            $this->finalizeCouponReservation($venta->idventa);
            // Cachear recibo 30 min
            $receipt = $this->buildReceipt($venta);
            $this->cacheReceiptForSession($receipt);

            $this->sendSuccessEmails($venta, $receipt, $delivery);
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
    $oldCarto = Session::get('carto');
    if (!$oldCarto) {
        throw new \RuntimeException('Carrito vacío al intentar persistir venta.');
    }

    // Tomar items sin asumir clase exacta
    $items = null;
    if (is_object($oldCarto) && property_exists($oldCarto, 'items')) {
        $items = $oldCarto->items;
    } elseif (is_array($oldCarto) && array_key_exists('items', $oldCarto)) {
        $items = $oldCarto['items'];
    }
    if (empty($items) || !is_array($items)) {
        throw new \RuntimeException('Estructura de carrito inválida: no hay items.');
    }
    // ================= CUPÓN COMO EN MercadoPagoController =================
    $sessionId = $request->session()->getId();
    $couponCode = null;
    $couponReservationId = null;

    // 1) si ya guardaste el id en sesión (tu flow de carto lo hace)
    $rid = session('cupon_reserva_id');

    if ($rid) {
        $reserva = \App\CuponReserva::with('cupon')->find($rid);
    } else {
        // 2) copiar lógica del otro controller: buscar por session_id
        $reserva = \App\CuponReserva::where('session_id', $sessionId)
            ->where('estado', 'reservado')
            ->latest('id')
            ->first();
    }

    if ($reserva && $reserva->expires_at && $reserva->expires_at->isFuture()) {
        $couponReservationId = $reserva->id;
        if ($reserva->cupon) {
            $couponCode = $reserva->cupon->codigo;
        }
    }

    // ESTE JSON va al campo ventas.detalle
    $detalleJson = null;
    if ($couponCode) {
        $detalleJson = json_encode([
            'coupon_code'          => $couponCode,
            'coupon_reservation_id'=> $couponReservationId,
        ], JSON_UNESCAPED_UNICODE);
    }
    // Campos desde cookie (no tocamos esto)
    $tipo         = (int)($delivery['tipo'] ?? 1);
    $email        = $delivery['email'] ?? $delivery['f-email'] ?? null;
    $user_mail    = Auth::user()->email ?? null;
    $nombres      = $delivery['nombres'] ?? '';
    $apellidos    = $delivery['apellidos'] ?? '';
    $dni          = $delivery['dni'] ?? '';
    $celular      = $delivery['celular'] ?? '';
    $domicilio    = $delivery['direccion'] ?? '';
    $referencia   = $delivery['referencia'] ?? '';
    $distrito     = $delivery['distrito'] ?? '';
    $provincia    = $delivery['provincia'] ?? '';
    $departamento = $delivery['ciudad'] ?? ($delivery['departamento'] ?? '');
    $cargoEnvio   = (float)($delivery['costo'] ?? 0);
    $totalCookie  = (float)($delivery['total_carto'] ?? 0);

    $userId = auth()->id() ?: 1;
    $codigo = 'V-'.date('YmdHis').'-'.Str::upper(Str::random(6));

    // Calcular subtotal a partir de cada renglón del carrito
    // Ojo: en tu Carto $row['precio'] es ACUMULADO. El unitario está en $row['item']->precio.
    $subtotalVenta = 0.0;

    foreach ($items as $pid => $row) {
        $qty = (int)($row['qty'] ?? 0);
        if ($qty <= 0) continue;

        $product = null;
        if (isset($row['item']) && $row['item'] instanceof Search) {
            $product = $row['item'];
        } else {
            $product = Search::find($pid);
        }

        // Precio unitario: primero el del modelo; si no, cae a acumulado/qty
        $unit = null;
        if ($product && isset($product->precio)) {
            $unit = (float)$product->precio;
        } else {
            $acc = (float)($row['precio'] ?? 0);
            $unit = $qty > 0 ? $acc / $qty : 0.0;
        }

        $subtotalVenta += $unit * $qty;
    }

    // Total final respetando total_complete si vino en cookie
    $totalVenta = $totalCookie > 0 ? $totalCookie : ($subtotalVenta + $cargoEnvio);

    // Guardar cabecera (igual que antes, solo cambiamos subtotal/total ya calculados)
    // armar detalle JSON con cupón si existe
        $detalleJson = null;
        $ridSession  = session('cupon_reserva_id');
        $codeSession = session('cupon_codigo');

        if ($ridSession) {
            $detalleJson = json_encode([
                'coupon_code'           => $codeSession,
                'coupon_reservation_id' => (int) $ridSession,
            ], JSON_UNESCAPED_UNICODE);
        }

        // Guardar cabecera
        $venta = Venta::create([
            'iduser'       => $userId,
            'codigo'       => $codigo,
            'subtotal'     => $subtotalVenta,
            'total_venta'  => $totalVenta,
            'tipo'         => $tipo,
            'cargo_envio'  => $cargoEnvio,
            'detalle'      => $detalleJson,
            'fecha_hora'   => now(),
            'nombre'       => $nombres,
            'email'        => $email,
            'user-mail'    => $user_mail,
            'apellido'     => $apellidos,
            'domicilio'    => $domicilio,
            'celular'      => $celular,
            'distrito'     => $distrito,
            'provincia'    => $provincia,
            'departamento' => $departamento,
            'dni'          => $dni,
            'referencia'   => $referencia,
        ]);


    // Detalle: carrito plano. Usamos un solo grupo (idsub = 1) porque ya no hay “paquetes”.
    $idsub = 1;

    foreach ($items as $pid => $row) {
        $qty = (int)($row['qty'] ?? 0);
        if ($qty <= 0) continue;

        $product = null;
        if (isset($row['item']) && $row['item'] instanceof Search) {
            $product = $row['item'];
        } else {
            $product = Search::find($pid);
        }

        $unit = null;
        if ($product && isset($product->precio)) {
            $unit = (float)$product->precio; // ← unitario correcto desde DB
        } else {
            // fallback decente si por alguna razón no vino el modelo
            $acc  = (float)($row['precio'] ?? 0);
            $unit = $qty > 0 ? $acc / $qty : 0.0;
        }

        DetalleVenta::create([
            'idventa'    => $venta->idventa,
            'idsub'      => $idsub,           // un solo grupo
            'idarticulo' => (int)($product->id ?? $pid),
            'qty'        => $qty,
            'precio'     => $unit,            // ← unitario, NO acumulado
            'subtotal'   => $unit * $qty,     // ← calculado
            'opinion'    => null,
            'valoracion' => null,
        ]);
    }

    return $venta;
    }

    private function buildReceipt(Venta $venta): array
{
    $detalles = $venta->detalle()
        ->orderBy('idsub')
        ->get(['idsub','idarticulo','qty','precio','subtotal']);

    $grupos = [];
    foreach ($detalles as $d) {
        $articulo = Search::where('id', $d->idarticulo)
            ->select('name','image')
            ->first();

        $grupos[$d->idsub][] = [
            'idarticulo' => (int)$d->idarticulo,
            'name'       => $articulo->name  ?? ('Artículo #'.$d->idarticulo),
            'image'      => $articulo->image ?? null,
            'qty'        => (int)$d->qty,
            'precio'     => (float)$d->precio,   // unitario guardado en detalle
            'subtotal'   => (float)$d->subtotal, // unitario * qty
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
        'grupos' => $grupos, // ahora será un único grupo (idsub = 1)
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
    private function finalizeCouponReservation($ventaId): void
    {
    $rid = session('cupon_reserva_id');
    if (!$rid) return;

    \DB::transaction(function() use ($rid, $ventaId) {
        $r = \App\CuponReserva::with('cupon')->lockForUpdate()->find($rid);
        if (!$r) return;

        // venció?
        if (!($r->expires_at && $r->expires_at->isFuture()) || $r->estado !== 'reservado') {
            $r->estado = 'caducado';
            $r->save();
            return;
        }

        // marcar consumido
        $r->estado       = 'consumido';
        $r->consumido_at = now();
        $r->venta_id     = $ventaId;
        $r->save();

        // incrementar reclamados
        if ($r->cupon) {
            $r->cupon()->lockForUpdate()->first()?->increment('reclamados');
        }

        // guardar rastro en la venta
        $venta = \App\Venta::find($ventaId);
        if ($venta) {
            $old = $venta->detalle ? json_decode($venta->detalle, true) : [];
            if (!is_array($old)) $old = [];

            $old['coupon_code']           = $r->cupon->codigo ?? null;
            $old['coupon_reservation_id'] = $r->id;

            $venta->detalle = json_encode($old, JSON_UNESCAPED_UNICODE);
            $venta->save();
        }
    });

    // limpiar sesión
    session()->forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
    }

public function resumenCarto(\Illuminate\Http\Request $request)
{
    // 1) Carrito
    $oldCarto = \Session::get('carto');
    if (!$oldCarto) {
        // Sin carrito: todo en cero para no tirar 500
        return response()->json([
            'summary' => [
                'subtotal'  => 0.00,
                'envio'     => 0.00,
                'descuento' => 0.00,
                'total'     => 0.00,
            ]
        ]);
    }
    $carto = new \App\Carto($oldCarto);

    // 2) Subtotal base
    $subtotal = (float) $carto->totalPrice;

    // 3) Descuento de cupón (idéntico a lo que ya haces)
    $cuponDescuento = 0.0;
    $rid = session('cupon_reserva_id');
    if ($rid) {
        $res = \App\CuponReserva::with('cupon')->find($rid);
        if ($res && $res->estado === 'reservado' && $res->expires_at && $res->expires_at->isFuture()) {
            $cupon = $res->cupon;
            if ($cupon && $cupon->ventanaActivaAhora()) {
                $subtotalCents = (int) round($subtotal * 100);
                $cumpleMinimo = !($cupon->min_subtotal) || $subtotalCents >= (int)$cupon->min_subtotal;
                $descuentoCents = $cumpleMinimo ? (int)$cupon->calcularDescuento($subtotalCents) : 0;

                $cuponDescuento = $descuentoCents / 100.0;

                // refrescar sesión para el timer, igual que en tus otros métodos
                session([
                    'cupon_codigo'             => $cupon->codigo,
                    'cupon_expires_at'         => $res->expires_at->toIso8601String(),
                    'cupon_descuento_centavos' => $descuentoCents,
                ]);

                if ((int)$res->descuento_aplicado !== (int)$descuentoCents) {
                    $res->update(['descuento_aplicado' => $descuentoCents]);
                }
            } else {
                // cupon fuera de ventana
                if ($res->estado === 'reservado' && $res->expires_at && $res->expires_at->isPast()) {
                    $res->update(['estado' => 'caducado']);
                }
                session()->forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
            }
        } else {
            if ($res && $res->estado === 'reservado' && $res->expires_at && $res->expires_at->isPast()) {
                $res->update(['estado' => 'caducado']);
            }
            session()->forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
        }
    }

    // 4) Envío desde cookie
    $json = $request->cookie('delivery_enc');
    $delivery = json_decode($json ?? '[]', true) ?: [];
    $envio = (float) ($delivery['costo'] ?? 0.0);

    // 5) Total neto
    $neto = max(0.0, $subtotal - $cuponDescuento) + $envio;

    return response()->json([
        'summary' => [
            'subtotal'  => round($subtotal, 2),
            'envio'     => round($envio, 2),
            'descuento' => round($cuponDescuento, 2),
            'total'     => round($neto, 2),
        ]
    ]);
}

private function sendSuccessEmails(Venta $venta, array $receipt, array $delivery = []): void
{
    try {
        // email del cliente: cookie → venta
        $clienteEmail = $delivery['email']
            ?? $delivery['f-email']
            ?? $venta->email
            ?? null;

        // email del admin / ventas
        $adminEmail = config('services.sales_email')
            ?? env('SALES_EMAIL', 'miangelsp11@gmail.com');

        // forzamos smtp porque ya lo tienes configurado
        $mailer = 'smtp';

        if ($clienteEmail) {
            \Mail::mailer($mailer)
                ->to($clienteEmail)
                ->send(new ClienteCompraExitosa($venta, $receipt, $delivery));
        }

        if ($adminEmail) {
            \Mail::mailer($mailer)
                ->to($adminEmail)
                ->send(new AdminNuevaVenta($venta, $receipt, $delivery));
        }
    } catch (\Throwable $e) {
        \Log::error('Error enviando correos de venta (carto): '.$e->getMessage(), [
            'venta_id' => $venta->idventa ?? null,
        ]);
    }
}

}
