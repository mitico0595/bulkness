<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use App\Calificacion;
use App\Valoras;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Cart;
use App\CuponReserva;
use App\Cupon;
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
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Client\Common\RequestOptions;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    private function toCents($soles): int { return (int) round($soles * 100); }
    private function toSoles($cents): float { return round($cents / 100, 2); }

    private function mpAuth(): void
    {
        MercadoPagoConfig::setAccessToken(config('app.mp_access_token', env('MP_ACCESS_TOKEN')));
    }

    public function index(Request $request)  { 
            $name      = (string) $request->get('name', '');
            $categoria = (string) $request->get('categoria', '');

            $searches = Search::orderBy('id', 'DESC')
                ->name($name)
                ->categoria($categoria)
                ->where('soli', '1')
                ->paginate(20)
                ->appends(['name' => $name, 'categoria' => $categoria]);

            // Mapper a objeto JS (lo usaremos 2 veces)
            $mapToJs = function ($p) {
                $imgCandidate = $p->thumb ?: $p->image ?: $p->image1 ?: $p->image2 ?: $p->image3 ?: '';
                $image = $imgCandidate
                    ? (\Illuminate\Support\Str::startsWith($imgCandidate, ['http://','https://','/'])
                        ? $imgCandidate
                        : asset('image/productos/'.$imgCandidate))
                    : asset('images/placeholder-800x600.png');

                $price         = (float) ($p->precio ?? 0);
                $originalPrice = isset($p->preciof) ? (float) $p->preciof : null;
                $isOffer       = (bool) (($p->oferta ?? null) == 1 || ($originalPrice && $originalPrice > $price));

                $rating = (float) ($p->puntos ?? 0);
                if ($rating < 0) $rating = 0;
                if ($rating > 5) $rating = 5;

                return [
                    'id'            => (int) $p->id,
                    'name'          => (string) $p->name,
                    'price'         => $price,
                    'originalPrice' => $originalPrice,
                    'image'         => $image,
                    'category'      => (string) ($p->categoria ?? 'Otros'),
                    'rating'        => $rating,
                    'reviews'       => (int) ($p->volumen ?? 0),
                    'inStock'       => (bool) ((int) ($p->stock ?? 0) > 0),
                    'isOffer'       => $isOffer,
                ];
            };

            // Subset paginado (si lo sigues mostrando en la vista)
            $productsJs = $searches->getCollection()->map($mapToJs)->values();

            // TODO el catálogo para el buscador en tiempo real (sin filtros name/categoria)
            $allProductsJs = Search::where('soli', '1')->orderBy('id', 'DESC')
                ->select('id','name','thumb','image','image1','image2','image3','precio','preciof','categoria','puntos','volumen','stock','oferta')
                ->get()
                ->map($mapToJs)
                ->values();

            return view('searches', [
                'searches'       => $searches,
                'name'           => $name,
                'categoria'      => $categoria,
                'productsJs'     => $productsJs,     // por si lo usas en la tabla/paginación
                'allProductsJs'  => $allProductsJs,  // ESTE es el que usará el front para filtrar todo
            ]);
        }




    public function outStock(Request $request, $id){
        $search = Search::findOrFail($id);

        $search->stock = 0;
        $search->update();
        //dd($request->session()->get('cart'));
        $name = 'Sin Stock';


        return redirect()->back()->with('success',$name);
            # code...return redirect()->back()->with(['success' => $name,'motivo' => $motivo]);

    }
    public function getAddToCart(Request $request, $id){
        $search = Search::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($search, $search->id);

        $request->session()->put('cart',$cart);
        //dd($request->session()->get('cart'));
        $name = 'Agregado con exito';


        return redirect()->back()->with('success',$name);
            # code...return redirect()->back()->with(['success' => $name,'motivo' => $motivo]);

    }

    public function getMochila(Request $request)    {    
    if (Session::has('cart')) {
        
        return redirect()->route('adler-venta-detalle');
    }
    
    return view('adlerventa', [
        'red'   => 0,
        'blue'  => 0,
        'black' => 0,
    ]);
    }

    public function getMochilaMobile(){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);        
        return view('cell-version.adlerventa-mobile',['red'=>$cart->red,'blue'=>$cart->blue,'black'=>$cart->black]);
    }
// ----------------------Agregar MOCHILA INICIO ---------------------------------------------------------
function AgregarMochila(Request $request){        
         $oldCart = Session::has('cart') ? Session::get('cart') : null;
    $cart = new Cart($oldCart);

    $red   = (int) $request->red;
    $blue  = (int) $request->blue;
    $black = (int) $request->black;

    
    $colorToArticulo = ['red'=>1, 'blue'=>2, 'black'=>3];
    $idsNecesarios = array_values($colorToArticulo);

    
    $productos = Search::whereIn('id', $idsNecesarios)->get()->keyBy('id');
        
    for ($i = 0; $i < $red; $i++) {
        $mId = $cart->nuevaMochila('red');
        $articulo = $productos[$colorToArticulo['red']] ?? null;
        if ($articulo) {
            $cart->addItem($mId, [
                'id' => $articulo->id,
                'name' => $articulo->name ?? 'Producto',
                'image' => $articulo->image, 
                'precio' => $articulo->precio 
            ], 1);
        }
    }
    for ($i = 0; $i < $blue; $i++) {
        $mId = $cart->nuevaMochila('blue');
        $articulo = $productos[$colorToArticulo['blue']] ?? null;
        if ($articulo) {
            $cart->addItem($mId, [
                'id' => $articulo->id,
                'name' => $articulo->name ?? 'Producto',
                'image' => $articulo->image,
                'precio' => $articulo->precio,
            ], 1);
        }
    }
    for ($i = 0; $i < $black; $i++) {
        $mId = $cart->nuevaMochila('black');
        $articulo = $productos[$colorToArticulo['black']] ?? null;
        if ($articulo) {
            $cart->addItem($mId, [
                'id' => $articulo->id,
                'name' => $articulo->name ?? 'Producto',
                'image' => $articulo->image,
                'precio' => $articulo->precio ,
            ], 1);
        }
    }

    Session::put('cart', $cart);
    
    return redirect()->route('adler-venta-detalle')->with('success', true);        
        
    }
// ---------------------------------------------- FIN AGREGAR MOCHILA INICIO ------------------------------


    public function NuevaMochilaItem(Request $request, $idarticulo, $color = null)
    {
    // 1) Cargar/crear carrito
    $cart = new Cart(Session::get('cart'));

    // 2) Traer el artículo que será el *item* de la mochila
    $producto = Search::findOrFail((int)$idarticulo);

    // 3) Color opcional (de la URL o del form)
    $color = $color ?? $request->input('color', 'black');

    // 4) Agregar 1 mochila al final con ese item
    $mochilaId = $cart->addMochilaConItem([
        'id'     => $producto->id,
        'name'   => $producto->name ?? 'Producto',
        'image'   => $producto->image ?? 'null',
        'precio' => (float) $producto->precio,
    ], $color, 1);

    // 5) Guardar sesión
    Session::put('cart', $cart);

    // 6) Responder
    if ($request->wantsJson()) {
        return response()->json([
            'ok'         => true,
            'mochilaId'  => $mochilaId,
            'totalQty'   => $cart->totalQty,    // +1
            'totalPrice' => $cart->totalPrice,  // + precio del item
            'mochilas'   => $cart->mochilas,    // verás la nueva al final
        ]);
    }

    return redirect()->route('adler-venta-detalle')->with('success', true);
}
    public function AgregarMochilaMobile(Request $request){        
        $oldCart = Session::has('cart') ? Session::get('cart') : null;        
                
        $cart = new Cart(null);
        
        $red = $request->red;
        $blue = $request->blue;
        $black = $request->black;
        $cart->red = $red;
        $cart->blue = $blue;
        $cart->black = $black;
        $n = 0;
        $totalQty = $red+$blue+$black;
        
        
        for ($i = 0; $i < $red; $i++) {
            $n++;
            $ids=$n;
            $idarticulo = 1;
            $item = Search::find($idarticulo);             
            $qty=1;
            $cart->agregar($ids,$idarticulo,$item,$qty);
            
        }
        for ($i = 0; $i < $blue; $i++) {
            $n++;
            $ids=$n;
            $idarticulo = 2;
            $item = Search::find($idarticulo); 
            $qty=1;
            $cart->agregar($ids,$idarticulo,$item,$qty);
        }
        for ($i = 0; $i < $black; $i++) {
            $n++;
            $ids=$n;
            $idarticulo = 3;
            $item = Search::find($idarticulo); 
            $qty=1;
            $cart->agregar($ids,$idarticulo,$item,$qty);
        }
        
        $request->session()->put('cart',$cart);      
        
        return redirect()->route('adler-venta-detalle-mobile')->with('success');
        
    }

// ver Proceso de venta 
    public function VerVentaDetalle(Request $request)
{
    $oldCart = Session::get('cart');
    if (!$oldCart) {
        return redirect()->route('adler-venta');
    }

    $cart = new Cart($oldCart);

    $paquetes  = Search::where('tipo', 2)->select('id','name','precio','image')->get();
    $articulos = Search::where('tipo', 3)->select('id','name','precio','image')->get();

    $totalesPorGrupo = [];   // clave = id de mochila (mch_...)
    $total = 0;              // subtotal general (antes de cupón)
    $qty = 0;
    $totalkit = 0;
    $totalarticulo = 0;
    $totalmochila = 0;

    // Para mostrar nombre/imagen/categoría en el blade
    $idsCatalogo = [];

    foreach ($cart->mochilas as $mId => $m) {
        $totalesPorGrupo[$mId] = $m['subTotalPrice'];
        $total += $m['subTotalPrice'];
        $qty   += $m['subTotalQty'];

        if (!empty($m['kit'])) {
            $totalkit += $m['kit']['precio'] * ($m['kit']['qty'] ?? 1);
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

    $catalogo = Search::whereIn('id', array_unique($idsCatalogo))->get()->keyBy('id');

    // ---- subtotal ANTES de cupón (lo guardamos por si lo quieres mostrar) ----
    $subtotalAntesCupon = $total;

    // ------------------ RE-CALCULAR DESCUENTO DE CUPÓN AQUÍ ------------------
    $cuponDescuento  = 0.00;       // en soles
    $cuponExpiresIso = null;
    $cuponCodigo     = null;

    $rid = session('cupon_reserva_id');
    if ($rid) {
        // Traemos la reserva + cupón
        $reserva = CuponReserva::with('cupon')->find($rid);

        // Reserva válida y no vencida
        if ($reserva && $reserva->estado === 'reservado' && $reserva->expires_at && $reserva->expires_at->isFuture()) {
            $cupon = $reserva->cupon;

            // Además, la "ventana" del cupón debe estar activa (inicia_at/caduca_at/activo)
            if ($cupon && $cupon->ventanaActivaAhora()) {

                // Subtotal ACTUAL del carrito en centavos
                $subtotalCents = (int) round($subtotalAntesCupon * 100);

                // Si hay mínimo de subtotal, validar
                $cumpleMinimo = true;
                if (!empty($cupon->min_subtotal)) {
                    $cumpleMinimo = $subtotalCents >= (int) $cupon->min_subtotal;
                }

                if ($subtotalCents > 0 && $cumpleMinimo) {
                    // Descuento recalculado con el subtotal actual
                    $descuentoCents = (int) $cupon->calcularDescuento($subtotalCents);
                } else {
                    // No cumple mínimo o no hay subtotal => no hay descuento
                    $descuentoCents = 0;
                }

                // Convertimos a soles
                $cuponDescuento  = $descuentoCents / 100.0;
                $cuponCodigo     = $cupon->codigo;
                $cuponExpiresIso = $reserva->expires_at->toIso8601String();

                // Refrescamos valores en sesión (para que Delivery/Pago lean lo último)
                session([
                    'cupon_codigo'               => $cuponCodigo,
                    'cupon_expires_at'           => $cuponExpiresIso,
                    'cupon_descuento_centavos'   => $descuentoCents,
                ]);

                // (Opcional) Persistir el descuento nuevo en la reserva para auditoría
                if ((int)$reserva->descuento_aplicado !== (int)$descuentoCents) {
                    $reserva->update(['descuento_aplicado' => $descuentoCents]);
                }

            } else {
                // Cupón ya no está activo: caducamos y limpiamos
                $reserva->update(['estado' => 'caducado']);
                session()->forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
            }

        } else {
            // No hay reserva válida o venció: marcamos y limpiamos
            if ($reserva && $reserva->estado === 'reservado' && $reserva->expires_at && $reserva->expires_at->isPast()) {
                $reserva->update(['estado' => 'caducado']);
            }
            session()->forget(['cupon_reserva_id','cupon_codigo','cupon_expires_at','cupon_descuento_centavos']);
        }
    }
    // ---------------- FIN RE-CÁLCULO DEL DESCUENTO ----------------

    // Total NETO a pagar en la vista del carrito (subtotal - descuento)
    $totalNeto = max(0, $subtotalAntesCupon - $cuponDescuento);

    // Actualizamos el cart: si quieres que el Cart guarde el neto
    $cart->totalPrice = $totalNeto;
    $cart->totalQty   = $qty;
    Session::put('cart', $cart);

    return view('adler-venta-detalle', [
        'items'             => $cart->mochilas,
        'totalesPorGrupo'   => $totalesPorGrupo,
        'totalmochila'      => $totalmochila,
        'totalarticulo'     => $totalarticulo,
        'totalkit'          => $totalkit,

        // si quieres mostrar ambos:
        'subtotal'          => $subtotalAntesCupon,   // antes de cupón
        'total'             => $totalNeto,            // después de cupón

        'cupon_codigo'      => $cuponCodigo,
        'cupon_descuento'   => $cuponDescuento,       // en soles
        'cupon_expires'     => $cuponExpiresIso,

        'productos'         => $qty,
        'paquetes'          => $paquetes,
        'articulos'         => $articulos,
        'catalogo'          => $catalogo,
    ]);
}

public function Delivery(Request $request)
{
    // 1) Cart requerido
    $oldCart = Session::get('cart');
    if (!$oldCart) {
        // si llega un POST sin cart, devuelves 422 en vez de redirigir
        if ($request->ajax()) {
            return response()->json(['ok' => false, 'msg' => 'Carrito vacío'], 422);
        }
        return redirect()->route('adler-venta-detalle');
    }

    $cart = new Cart($oldCart);

    // 2) Armar subtotal de productos (antes de cupón)
    $paquetes  = Search::where('tipo', 2)->select('id','name','precio','image')->get();
    $articulos = Search::where('tipo', 3)->select('id','name','precio','image')->get();

    $totalesPorGrupo = [];
    $subtotal = 0.0;  // subtotal productos, SIN cupón
    $qty = 0;
    $totalkit = 0;
    $totalarticulo = 0;
    $totalmochila = 0;
    $idsCatalogo = [];

    foreach ($cart->mochilas as $mId => $m) {
        $totalesPorGrupo[$mId] = $m['subTotalPrice'];
        $subtotal             += $m['subTotalPrice'];
        $qty                  += $m['subTotalQty'];

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
        ->get()->keyBy('id');

    /*
     * 3) CUPÓN
     * La clave está acá: SOLO en GET hacemos la parte agresiva de "si no hay reserva, limpio sesión".
     * En POST NO lo tocamos, porque el usuario solo está cambiando direccion/correo.
     */
    $descCents   = (int) session('cupon_descuento_centavos', 0);
    $cuponCodigo = session('cupon_codigo');
    $cuponExpires = session('cupon_expires_at');
    $rid          = session('cupon_reserva_id');

    if ($request->isMethod('get')) {
        if ($rid && $cuponExpires && \Carbon\Carbon::parse($cuponExpires)->isFuture()) {
            $reserva = \App\CuponReserva::with('cupon')->find($rid);
            if ($reserva && $reserva->estado === 'reservado' && $reserva->expires_at && $reserva->expires_at->isFuture()) {
                $cupon = $reserva->cupon;
                if (!($cupon && $cupon->ventanaActivaAhora())) {
                    // ventana no activa → limpiar
                    $descCents = 0;
                    session()->forget([
                        'cupon_reserva_id',
                        'cupon_codigo',
                        'cupon_expires_at',
                        'cupon_descuento_centavos'
                    ]);
                    $cuponCodigo  = null;
                    $cuponExpires = null;
                }
            } else {
                // reserva inválida/expirada → limpiar
                $descCents = 0;
                session()->forget([
                    'cupon_reserva_id',
                    'cupon_codigo',
                    'cupon_expires_at',
                    'cupon_descuento_centavos'
                ]);
                $cuponCodigo  = null;
                $cuponExpires = null;
            }
        } else {
            // en GET si no hay reserva lo puedes limpiar, como ya hacías
            // si no quieres ser tan agresivo, comenta estas 5 líneas
            $descCents = 0;
            session()->forget([
                'cupon_reserva_id',
                'cupon_codigo',
                'cupon_expires_at',
                'cupon_descuento_centavos'
            ]);
            $cuponCodigo  = null;
            $cuponExpires = null;
        }
    }
    // en POST llegas hasta aquí sin limpiar el cupón

    $descuento = $descCents / 100.0;
    $neto      = max(0, $subtotal - $descuento);

    // 4) leer cookie de delivery
    $deliveryCookie = $request->cookie('delivery_enc');
    $delivery = $deliveryCookie ? json_decode($deliveryCookie, true) : [];
    if (!is_array($delivery)) {
        $delivery = [];
    }

    // si viene POST, actualizamos SOLO lo de delivery (tipo, dirección, correo)
    if ($request->isMethod('post')) {
        $tipo = $request->input('tipo');  // '0' recojo, '1' delivery
        $delivery['tipo'] = (int) $tipo;

        if ($tipo == '0') {
            // recojo
            if ($request->filled('f-email')) {
                $delivery['f-email'] = $request->input('f-email');
            }
            // recojo suele ser gratis
            $delivery['costo'] = 0;
        } else {
            // delivery
            $delivery['email']     = $request->input('email');
            $delivery['nombres']   = $request->input('nombres');
            $delivery['apellidos'] = $request->input('apellidos');
            $delivery['dni']       = $request->input('dni');
            $delivery['celular']   = $request->input('celular');
            $delivery['direccion'] = $request->input('direccion');
            $delivery['ciudad']    = $request->input('ciudad');
            $delivery['provincia'] = $request->input('provincia');
            $delivery['distrito']  = $request->input('distrito');
            $delivery['referencia']= $request->input('referencia');

            // acá puedes recalcular costo de envío según ciudad/distrito
            // por ahora, si ya tenía costo lo respetamos
            $delivery['costo'] = isset($delivery['costo']) ? (float)$delivery['costo'] : 0.0;
        }
    }

    // costo final
    $costo_delivery = (float) ($delivery['costo'] ?? 0);
    $totalFinal     = $neto + $costo_delivery;

    // reinyectamos lo que la UI necesita
    $delivery['subtotal']         = $subtotal;
    $delivery['descuento']        = $descuento;
    $delivery['neto']             = $neto;
    $delivery['costo']            = $costo_delivery;
    $delivery['total_complete']   = $totalFinal;
    $delivery['cupon']            = $cuponCodigo;
    $delivery['cupon_expires_at'] = $cuponExpires;

    // si es POST (AJAX) devolvemos JSON
    if ($request->isMethod('post')) {
        return response()
            ->json([
                'ok'       => true,
                'delivery' => $delivery
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

    // si es GET, devolvemos la vista
    return response()
        ->view('delivery', [
            'items'           => $cart->mochilas,
            'totalesPorGrupo' => $totalesPorGrupo,
            'totalmochila'    => $totalmochila,
            'totalarticulo'   => $totalarticulo,
            'totalkit'        => $totalkit,
            'total'           => $subtotal,
            'productos'       => $qty,
            'paquetes'        => $paquetes,
            'articulos'       => $articulos,
            'catalogo'        => $catalogo,
            'descuento'       => $descuento,
            'subtotal_neto'   => $neto,
            'costo_envio'     => $costo_delivery,
            'total_final'     => $totalFinal,
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


// -------------------- DELIVERY COSTOS DE ENVIO
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
    // 1. Leer lo que ya había en la cookie (para no perderlo)
    $json = $request->cookie('delivery_enc');
    $old = $json ? json_decode($json, true) : [];
    if (!is_array($old)) {
        $old = [];
    }

    // -------- GET: solo devolver lo que hay --------
    if ($request->isMethod('get')) {
        return response()->json([
            'delivery' => $old ?: null,
        ]);
    }

    // -------- POST --------
    $tipo  = (int) $request->input('tipo', 1);
    $fmail = $request->input('f-email');

    if ($tipo === 0) {
        // ========== RECOJO ==========
        // NO BORRAR lo anterior, solo forzar este estado
        $old['tipo']  = 0;
        $old['costo'] = 0;          // recojo siempre gratis

        if ($fmail) {
            $old['f-email'] = $fmail;
        }

        // recalcular totales usando lo que tengas en sesión
        [$subtotal, $descuento, $totalFinal] = $this->recalcularTotalesDesdeSesion($old);

        $old['subtotal']       = $subtotal;
        $old['descuento']      = $descuento;
        $old['total_complete'] = $totalFinal;

        $minutes = 60 * 24 * 30;
        return response()
            ->json(['ok' => true, 'delivery' => $old])
            ->cookie(
                'delivery_enc',
                json_encode($old, JSON_UNESCAPED_UNICODE),
                $minutes,
                '/',
                null,
                $request->isSecure(),
                true,
                false,
                'Lax'
            );
    }

    // ========== DELIVERY ==========
    // referencia debe ser OPCIONAL
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
        'referencia' => ['nullable','string','max:255'], // ← aquí el cambio
    ]);

    // calcular costo de envío
    $data['costo'] = $this->calcularCosto($data['ciudad'], $data['provincia'], $data['distrito']);
    $data['tipo']  = 1;

    // MERGE con lo anterior (para no perder f-email, por ejemplo)
    $merged = array_merge($old, $data);

    // recalcular totales
    [$subtotal, $descuento, $totalFinal] = $this->recalcularTotalesDesdeSesion($merged);

    $merged['subtotal']       = $subtotal;
    $merged['descuento']      = $descuento;
    $merged['total_complete'] = $totalFinal;

    $minutes = 60 * 24 * 30;
    return response()
        ->json(['ok' => true, 'delivery' => $merged])
        ->cookie(
            'delivery_enc',
            json_encode($merged, JSON_UNESCAPED_UNICODE),
            $minutes,
            '/',
            null,
            $request->isSecure(),
            true,
            false,
            'Lax'
        );
}

private function recalcularTotalesDesdeSesion(array $delivery): array
{
    // leer carrito de la sesión (como en tu método Delivery grande)
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);

    // subtotal de productos SIN cupón
    $subtotal = $cart->totalPrice ?? 0;

    // cupón desde sesión (mismas keys que usas en Delivery())
    $descCents = (int) session('cupon_descuento_centavos', 0);
    $descuento = $descCents / 100.0;

    // costo de envío que venga (si es recojo será 0)
    $costo = (float) ($delivery['costo'] ?? 0);

    $totalFinal = max(0, $subtotal - $descuento) + $costo;

    return [$subtotal, $descuento, $totalFinal];
}


    public function AgregarDetalleMobile(Request $request){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        if ($oldCart === null) {
            return redirect()->route('adler-venta-mobile');
        }
        $cart = new Cart($oldCart);
        $paquetes = Search::where('tipo', 2)->get();
        $articulos = Search::where('tipo', 3)->get();
        $total= 0;
        $qty = 0;
        $totalkit = 0;
        $totalarticulo = 0;

        foreach ($cart->items as $ids => $itemDetails) {
            foreach ($itemDetails as $idArticulo => $detalle) {
                $total += $detalle['precio'];
                $qty += $detalle['qty'];

                if($idArticulo>=10 && $idArticulo<20){
                    $totalkit += $detalle['precio'];
                }
                if($idArticulo>=20){
                    $totalarticulo += $detalle['precio'];
                }
            }
        }

        foreach ($cart->items as $ids => $itemDetails) {
            // Inicializar la suma para este grupo
            if (!isset($totalesPorGrupo[$ids])) {
                $totalesPorGrupo[$ids] = 0;
            }
        
            foreach ($itemDetails as $idArticulo => $detalle) {
                $totalesPorGrupo[$ids] += $detalle['precio'];
            }
        } 
        
        $cart->totalPrice = $total;
        $cart->totalQty = $qty;

        if ($cart->isDirty()) { 
        Session::put('cart', $cart);
        }

        $preciored=Search::find(1)->precio;
        $precioblue=Search::find(2)->precio;
        $precioblack=Search::find(3)->precio;     
        $totalmochila = $cart->red*$preciored+$cart->blue*$precioblue+$cart->black*$precioblack; 
         
        
        return view('cell-version.adler-venta-detalle-mobile',['totalesPorGrupo' => $totalesPorGrupo,'totalmochila'=>$totalmochila,'totalarticulo'=>$totalarticulo,'totalkit'=>$totalkit,'items'=>$cart->items,'total'=>$total,'productos'=>$cart->totalQty,'paquetes'=>$paquetes,'articulos'=>$articulos]);   
    }
// AGREGAR KIT EMERGENCY 
    public function AgregarPaquete(string $ids, int $idarticulo)    {
        $oldCart = Session::get('cart');
        if (!$oldCart) return back();

        $cart = new Cart($oldCart);

        $p = Search::findOrFail($idarticulo);

        $cart->setKit($ids, [
            'id'     => $p->id,
            'name'   => $p->name ?? $p->titulo ?? 'Kit',
            'precio' => $p->precio,
            'image'     => $p->image ?? null,
        ], 1);

        Session::put('cart', $cart);
        return back()->with('success', true);
    }
    public function EliminarKit(string $ids){
        $oldCart = Session::get('cart');
        if (!$oldCart) return back();

        $cart = new Cart($oldCart);

        $cart->removeKit($ids);

        if (
            isset($cart->mochilas[$ids]) &&
            empty($cart->mochilas[$ids]['items']) &&
            empty($cart->mochilas[$ids]['kit'])
        ) {
            $cart->removeMochila($ids);
        }

        if (empty($cart->mochilas)) {
            Session::forget('cart');
        } else {
            Session::put('cart', $cart);
        }

        return back()->with('success', true);
    }
    public function AgregarArticulo(string $ids, int $idarticulo)    {
        $oldCart = Session::get('cart');
        if (!$oldCart) return back();

        $cart = new Cart($oldCart);

        $p = Search::findOrFail($idarticulo);

        $cart->addItem($ids, [
            'id'        => $p->id,
            'name'      => $p->name ?? $p->titulo ?? 'Producto',
            'precio'    => $p->precio, 
            'image'     => $p->image ?? null,
            'categoria' => $p->categoria ?? null,
        ], 1);

        Session::put('cart', $cart);
        return back()->with('success', true);
    }

    public function DisminuirArticulo(string $ids, int $idarticulo){
        $oldCart = Session::get('cart');
        if (!$oldCart) return back();

        $cart = new Cart($oldCart);

        // baja en 1; si queda 0 lo saca
        $cart->decrementItem($ids, $idarticulo, 1);

        // si la mochila quedó vacía (sin items y sin kit), bórrala
        if (
            isset($cart->mochilas[$ids]) &&
            empty($cart->mochilas[$ids]['items']) &&
            empty($cart->mochilas[$ids]['kit'])
        ) {
            $cart->removeMochila($ids);
        }

        // si el carrito quedó vacío, limpia sesión
        if (empty($cart->mochilas)) {
            Session::forget('cart');
        } else {
            Session::put('cart', $cart);
        }

        return back()->with('success', true);
    }
    public function eliminar(string $ids, int $idarticulo)
    {
        $oldCart = Session::get('cart');
        if (!$oldCart) return back();

        $cart = new Cart($oldCart);

        $cart->removeItem($ids, $idarticulo);

        if (
            isset($cart->mochilas[$ids]) &&
            empty($cart->mochilas[$ids]['items']) &&
            empty($cart->mochilas[$ids]['kit'])
        ) {
            $cart->removeMochila($ids);
        }

        if (empty($cart->mochilas)) {
            Session::forget('cart');
        } else {
            Session::put('cart', $cart);
        }

        return back()->with('success', true);
    }
    public function EliminarMochila(Request $request, string $mochilaId)
{
    $cart = new Cart(Session::get('cart'));

    if (!isset($cart->mochilas[$mochilaId])) {
        if ($request->wantsJson()) {
            return response()->json(['ok' => false, 'error' => 'Mochila no existe'], 404);
        }
        return back()->with('error', 'La mochila no existe');
    }

    $cart->removeMochila($mochilaId);      // esto ya recalcula totales
    Session::put('cart', $cart);

    if ($request->wantsJson()) {
        return response()->json([
            'ok'         => true,
            'totalQty'   => $cart->totalQty,
            'totalPrice' => $cart->totalPrice,
            'mochilas'   => $cart->mochilas,
        ]);
    }

    return back()->with('success', true);
}
    public function getReduceByOne($id){

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);

        if(count($cart->items) > 0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();
    }


    public function getRemoveItem($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }

        return redirect()->back();
    }

    public function envio(Request $request){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->totalEnvio = $request->get('envio');
        $request->session()->put('cart',$cart);
        //dd($request->session()->get('cart'));
        return redirect()->back();
    }


    public function getCart(){
        if(!Session::has('cart')){
            return view('shop.carro-compras', ['searches'=>null]);        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.carro-compras',['searches'=>$cart->items,'totalPrice'=> $cart->totalPrice,'totalPrecio'=>$cart->totalPrecio,'charge'=>$cart->charge,'Bprice'=>$cart->Bprice,'BpriceV'=>$cart->BpriceV, 'BpriceLocal'=>$cart->BpriceLocal,'send'=>$cart->send, 'sendV'=>$cart->sendV,'totalPrecioProv'=>$cart->totalPrecioProv,'chargeProv'=>$cart->chargeProv,'transfer'=>$cart->transfer ]);
    }
    
    public function getCartMobile(){
        if(!Session::has('cart')){
            return view('cell-version.cart-mobile', ['searches'=>null]);        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('cell-version.cart-mobile',['searches'=>$cart->items,'totalPrice'=> $cart->totalPrice,'totalPrecio'=>$cart->totalPrecio,'charge'=>$cart->charge,'totalPrecioProv'=>$cart->totalPrecioProv,'chargeProv'=>$cart->chargeProv,'transfer'=>$cart->transfer ]);
    }

    

    
   

 
    public function getTransfer(){
        if(!Session::has('cart')){
            return view('shop.carro-compras', ['searches'=>null]);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->transfer;
        return view('transfer',['total'=>$total,'searches'=>$cart->items,'totalProduct'=>$cart->totalPrice]);

    }
    public function getTransferMobile(){
        if(!Session::has('cart')){
            return view('cell-version.cart-mobile', ['searches'=>null]);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->transfer;
        return view('cell-version.transfer-mobile',['total'=>$total,'searches'=>$cart->items,'totalProduct'=>$cart->totalPrice]);

    }


//------------------------------
public function getCheckoutcity(){
    if(!Session::has('cart')){
        return view('shop.carro-compras', ['searches'=>null]);
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $total = $cart->totalPrecioProv;
    
   
    $amount = $cart->totalPrecioProv;
    $detallePago = "Detalle de pago";
        
    
    $lol = Carbon::now();    
    return view('checkoutcity',[ 'lol'=>$lol,'total'=>$total,'searches'=>$cart->items,'totalProduct'=>$cart->totalPrice,'cargo'=>$cart->charge ,'amount' => $amount ]);
}  

public function getCheckout(){
    if(!Session::has('cart')){
        return view('shop.carro-compras', ['searches'=>null]);
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $total = $cart->totalPrice;
    
    
    $amount = $cart->totalPrecio;
    $detallePago = "Detalle de pago";
    
    
       
   
    $lol = Carbon::now();    
    return view('checkout',[ 'lol'=>$lol,'total'=>$total,'searches'=>$cart->items,'totalProduct'=>$cart->totalPrice,'cargo'=>$cart->charge ,'amount' => $amount ]);
}    

public function getCheckoutMobile(){
    if(!Session::has('cart')){
        return view('cell-version.cart-mobile', ['searches'=>null]);
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $total = $cart->totalPrecio;
    
    $pagos = Niubiz::VISA_PRD_URL_SESSION;
    $amount = $cart->totalPrecio; 
    $detallePago = "Compra Mobile";
    
     
      
    $purchaseNumber = $this->generatePurchaseNumber();
    $lol = Carbon::now();    
    return view('cell-version.checkout-mobile',[ 'lol'=>$lol,'total'=>$total,'searches'=>$cart->items,'totalProduct'=>$cart->totalPrice,'cargo'=>$cart->charge,'pagos'=>$pagos, 'amount' => $amount , 'detallePago' => $detallePago,'purchaseNumber'=>$purchaseNumber ]);

        
    
}

public function getCheckoutCityMobile(){
    if(!Session::has('cart')){
        return view('cell-version.cart-mobile', ['searches'=>null]);
    }
    $oldCart = Session::get('cart');
    $cart = new Cart($oldCart);
    $total = $cart->totalPrecioProv;
    
    $pagos = Niubiz::VISA_PRD_URL_SESSION;
    $amount = $cart->totalPrecioProv; 
    $detallePago = "Compra Mobile";
    $token = $this->generateToken();
     
    $sesion = $this->generateSesion($amount, $token);    
    $purchaseNumber = $this->generatePurchaseNumber();
    $lol = Carbon::now();    
    return view('cell-version.checkoutcity-mobile',[ 'lol'=>$lol,'total'=>$total,'searches'=>$cart->items,'totalProduct'=>$cart->totalPrice,'cargo'=>$cart->charge,'pagos'=>$pagos, 'amount' => $amount , 'detallePago' => $detallePago, 'token'=>$token,'sesion'=>$sesion,'purchaseNumber'=>$purchaseNumber ]);
}
  

    function generateToken() {
        $curl = curl_init();
        curl_setopt_array($curl, array (
            CURLOPT_URL => Niubiz::VISA_URL_SECURITY,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            'Authorization: '.'Basic '.base64_encode(Niubiz::VISA_USER.":".Niubiz::VISA_PWD)
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

   
    function generateSesion($amount, $token) {
        $daysn = Auth::user()->created_at;
        $daysn = $daysn->diffInDays();         
        $lol = Carbon::now();
        $year = $lol->format('y');
        $year = '20'.$year;
        $lol = $lol->format('m');    
        $id= Auth::user()->id;
        $venta = Venta::where('idpersona',$id)->whereMonth('venta.fecha_hora','=',$lol)->whereYear('venta.fecha_hora','=',$year)->get();
        $cc= count($venta);
        if ($cc > 1){
            $cc = 1;
        }
        if( $cc < 2 ){
            $cc = 0;
        }
        $session = array(
            'amount' => $amount,
            'antifraud' => array(
                'clientIp' => $_SERVER['REMOTE_ADDR'],
                'merchantDefineData' => array(
                    'MDD4' => Auth::user()->email,
                    'MDD21' => $cc,
                    'MDD32' => Auth::user()->id,
                    'MDD75' => 'Registrado',
                    'MDD77' => $daysn
                ),
            ),
            'channel' => 'web',
        );
        $json = json_encode($session);
        
        $response = json_decode($this->postRequest(Niubiz::VISA_URL_SESSION, $json, $token));
        return $response->sessionKey;
    }
    function generateAuthorization($amount, $purchaseNumber, $transactionToken, $token) {
        $data = array(
            'antifraud' => null,
            'captureType' => 'manual',
            'channel' => 'web',
            'countable' => true,
            'order' => array(
                'amount' => $amount,
                'currency' => 'PEN',
                'purchaseNumber' => $purchaseNumber,
                'tokenId' => $transactionToken
            ),
            'recurrence' => null,
            'sponsored' => null
        );
        $json = json_encode($data);

        $session = json_decode($this->postRequest(Niubiz::VISA_URL_AUTHORIZATION, $json, $token));

        return $session;
    }

    function postRequest($url, $postData, $token) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$token,
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => $postData
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    function generatePurchaseNumber(){
        $archivo = '/txt/purchaseNumber.txt';
        $purchaseNumber = 222;
        $fp = fopen(storage_path().$archivo,'r');
        $purchaseNumber = fgets($fp, 100);
        fclose($fp);
        ++$purchaseNumber;
        $fp = fopen(storage_path().$archivo,"w+");
        fwrite($fp, $purchaseNumber, 100);
        fclose($fp);
        return $purchaseNumber;
    }



//-------------------------------------/


    function generatePurchaseIzi(){
        $archivo = '/txt/izipay.txt';
        $purchaseNumber = 222;
        $fp = fopen(storage_path().$archivo,'r');
        $purchaseNumber = fgets($fp, 100);
        fclose($fp);
        ++$purchaseNumber;
        $fp = fopen(storage_path().$archivo,"w+");
        fwrite($fp, $purchaseNumber, 100);
        fclose($fp);
        return $purchaseNumber;
    }
    




    public function postCheckout(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        dd($oldCart);
        $cart= new Cart($oldCart);
        $searches = ['searches'=>$cart->items];
        $purchaseNumber = $this->generatePurchaseIzi(); 
        $email = Auth::user()->email;
        try{
            
            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_venta=$cart->totalPrecio;
            $venta->domicilio = $request->get('detalle');
            $venta->name = $request->get('name');
            $venta->purchaseNumber = $purchaseNumber;
            $venta->distrito = $request->get('distrito');
            $venta->provincia = "Lima";
            $venta->total_parcial=$cart->totalPrice;
            $venta->cargos = (number_format($cart->charge, 2));
            $venta->departamento = "Lima";
            $venta->option_select = "Envio Lima- 10.00";
            $venta->celular = $request->get('cell');
            $venta->dni = $request->get('dni');
            $venta->referencia = $request->get('referencia');
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->tipo_venta = "IZI_PAY_CELL";
            $venta->save();
            
            
            
            
            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while($cont < count($cart->items)){
                $id=$idarticulo[$cont];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->ganancia= $cantidad[$cont]*($precio_venta[$cont]-$costo[$cont]);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('checkout')->with('error', $e->getMessage());

        }
        
        // EMAIL 
        $idorder = $venta->idventa;
        Mail::to("miangelsp11@gmail.com")->send(new Email($idorder)); 
        Mail::to($email)->send(new Email($idorder)); 
        
        // end email
        
        Session::forget('cart');
        return redirect('pagos/'.$purchaseNumber);
    }
    
    
    public function postCheckoutcity(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = ['searches'=>$cart->items];
        $purchaseNumber = $this->generatePurchaseIzi(); 
        $email = Auth::user()->email;
        try{
            
            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_venta=$cart->totalPrecioProv;
            $venta->domicilio = $request->get('detalle');
            $venta->name = $request->get('name');
            $venta->purchaseNumber = $purchaseNumber;
            $venta->distrito = $request->get('distrito');
            $venta->provincia = $request->get('provincia');
            $venta->total_parcial=$cart->totalPrice;
            $venta->cargos = (number_format($cart->charge, 2));
            $venta->departamento = $request->get('ciudad');
            $venta->option_select = "Envio Prov- 14.90";
            $venta->celular = $request->get('cell');
            $venta->dni = $request->get('dni');
            $venta->referencia = $request->get('referencia');
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->tipo_venta = "IZI_PAY_CELL";
            $venta->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while($cont < count($cart->items)){
                $id=$idarticulo[$cont];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->ganancia= $cantidad[$cont]*($precio_venta[$cont]-$costo[$cont]);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('checkoutcity')->with('error', $e->getMessage());

        }
        // EMAIL 
        
        $idorder = $venta->idventa;
        Mail::to("miangelsp11@gmail.com")->send(new Email($idorder)); 
        
        Mail::to($email)->send(new Email($idorder)); 
        
        // end email
        Session::forget('cart');
        return redirect('pagos/'.$purchaseNumber);
    }
//Mobil--------------------------------------------------------------------------------

    public function postCheckoutMobile(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = ['searches'=>$cart->items];
        $purchaseNumber = $this->generatePurchaseIzi(); 
        $email = Auth::user()->email;
        try{
            
            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_venta=$cart->totalPrecio;
            $venta->total_parcial=$cart->totalPrice;
            $venta->domicilio = $request->get('domicilio');
            $venta->detalle = $request->get('nota');
            $venta->purchaseNumber = $purchaseNumber;
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->name = $request->get('name');
            $venta->dni = $request->get('dni');
            $venta->payment_id = "cardlima";
            $venta->cargos = (number_format($cart->charge, 2));
            $venta->detalle = $request->get('nota');
            $venta->celular = $request->get('celular');
            $venta->distrito = $request->get('distrito');
            $venta->provincia = "Lima";
            $venta->departamento = "Lima";
            $venta->tipo_venta = "IZI_PAY_CELL";
            $venta->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while($cont < count($cart->items)){
                $id=$idarticulo[$cont];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->ganancia= $cantidad[$cont]*($precio_venta[$cont]-$costo[$cont]);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('checkout-mobile')->with('error', $e->getMessage());

        }
        // EMAIL 
        
        $idorder = $venta->idventa;
        Mail::to("miangelsp11@gmail.com")->send(new Email($idorder)); 
        
        Mail::to($email)->send(new Email($idorder)); 
        
        // end email
        Session::forget('cart');
        return redirect()->route('success-mobile');
    }
    public function postCheckoutCityMobile(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = ['searches'=>$cart->items];
        $purchaseNumber = $this->generatePurchaseIzi(); 
        $email = Auth::user()->email;
        
        try{
            
            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_venta=$cart->totalPrecioProv;
            $venta->total_parcial=$cart->totalPrice;
            $venta->domicilio = $request->get('domicilio');
            $venta->detalle = $request->get('nota');
            $venta->purchaseNumber = $purchaseNumber;
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->name = $request->get('name');
            $venta->dni = $request->get('dni');
            $venta->payment_id = "cardlima";
            $venta->cargos = (number_format($cart->chargeProv, 2));
            $venta->detalle = $request->get('nota');
            $venta->celular = $request->get('celular');
            $venta->distrito = $request->get('distrito');
            $venta->provincia = $request->get('provincia');
            $venta->departamento = $request->get('ciudad');
            $venta->tipo_venta = "IZI_PAY_CELL";
            $venta->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while($cont < count($cart->items)){
                $id=$idarticulo[$cont];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->ganancia= $cantidad[$cont]*($precio_venta[$cont]-$costo[$cont]);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('checkoutcity-mobile')->with('error', $e->getMessage());

        }
        // EMAIL 
        
        
        $idorder = $venta->idventa;
        Mail::to("miangelsp11@gmail.com")->send(new Email($idorder)); 
        
        Mail::to($email)->send(new Email($idorder)); 
        
        // end email
        Session::forget('cart');
        return redirect()->route('success-mobile');
    }

    
    public function postTransferMobile(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = ['searches'=>$cart->items];
        $purchaseNumber = $this->generatePurchaseIzi(); 
        $email = Auth::user()->email;
        try{

            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_venta=$cart->totalPrice;
            $venta->total_parcial=$cart->totalPrice;

            $venta->detalle = $request->get('detalle');
            $venta->purchaseNumber = $purchaseNumber;
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();

            $venta->lat = $request->get('lat');
            $venta->lon = $request->get('lon');
            $venta->ipid = $request->get('ipid');
            $venta->tipo_venta = $request->get('tipo_venta');
            
            $venta->banco = $request->get('banco');
            


            $venta->name = $request->get('name');
            $venta->lastname = $request->get('lastname');
            $venta->dni = $request->get('dni');
            $venta->celular = $request->get('celular');
            $venta->distrito = $request->get('distrito');
            $venta->domicilio=$request->get('domicilio');
            $venta->provincia = $request->get('provincia');
            $venta->departamento = $request->get('ciudad');
            $venta->option_select = 'Transfer - 0.00';
            $venta->cargos = '0.00';
            $venta->tipo_venta = "TRANSFERENCIA";
            $venta->email=$email;
            $venta->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while($cont < count($cart->items)){
                $id=$idarticulo[$cont];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->ganancia= $cantidad[$cont]*($precio_venta[$cont]-$costo);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('transfer-mobile')->with('error', $e->getMessage());

        }
        // EMAIL 
        
        
        $idorder = $venta->idventa;
        Mail::to("miangelsp11@gmail.com")->send(new Email($idorder)); 
        
        Mail::to($email)->send(new Email($idorder)); 
        
        // end email
        Session::forget('cart');
        return redirect()->route('success-mobile');
    }
    public function postTransfer(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = ['searches'=>$cart->items];
        $purchaseNumber = $this->generatePurchaseIzi(); 
        $email = Auth::user()->email;
        try{

            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_venta=$cart->totalPrice;
            $venta->purchaseNumber = $purchaseNumber;
            $venta->domicilio= $request->get('detalle');

            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->lat = $request->get('lat');
            $venta->lon = $request->get('lon');
            $venta->ipid = $request->get('ipid');
            $venta->tipo_venta = "Transferencia";
            $venta->referencia = $request->get('referencia');
            $venta->total_parcial = $cart->totalPrice;
            $venta->cargos = '0.00';

            $venta->name = $request->get('name');
            $venta->lastname = $request->get('lastname');
            $venta->dni = $request->get('dni');
            $venta->celular = $request->get('cell');
            $venta->distrito = $request->get('distrito');
            $venta->provincia = $request->get('provincia');
            $venta->departamento = $request->get('ciudad');
            $venta->option_select = $request->get('card-name').' '.$request->get('card-lastname');
            $venta->tipo_venta = "TRANSFERENCIA";
            $venta->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while($cont < count($cart->items)){
                $id=$idarticulo[$cont];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$idarticulo[$cont];
                $detalle->cantidad=$cantidad[$cont];
                $detalle->precio_venta=$precio_venta[$cont];
                $detalle->ganancia= $cantidad[$cont]*($precio_venta[$cont]-$costo);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('transfer')->with('error', $e->getMessage());

        }
        // EMAIL 
        
        
        $idorder = $venta->idventa;
        Mail::to("miangelsp11@gmail.com")->send(new Email($idorder)); 
        
        Mail::to($email)->send(new Email($idorder)); 
        
        // end email
        Session::forget('cart');
        return redirect()->route('success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    // Producto
    $searches = DB::table('searches as s')
        ->where('s.id', '=', $id)
        ->first();

    if (!$searches) {
        abort(404);
    }

    // Fecha formateada como usabas
    $d = null;
    if (!empty($searches->fecha) && strlen($searches->fecha) >= 10) {
        $d  = substr($searches->fecha,5,2).'/'.substr($searches->fecha,8,2).'/'.substr($searches->fecha,0,4);
    }

    // Lo demás tal cual lo tenías
    $detalles = DB::table('detalle_venta')->get();
    $calificaciones = DB::table('calificaciones')->get();

    $califica = DB::table('calificaciones as c')
        ->where('c.id', '=', $id)
        ->first();

    $valoras = DB::table('valoras')->get();

    $sear = \App\Search::where('soli', 1)
        ->orderByDesc('id')
        ->take(6)
        ->get();

    // ===== NUEVO: parseo para la vista =====

    // 1) 'caracteristicas' (varchar): lo convierto a "chips" (array) separando por |, coma o salto de línea
    $caracts = collect(preg_split('/\s*\|\s*|,|\r\n|\n/', (string) $searches->caracteristicas))
        ->map(fn($s) => trim($s))
        ->filter()
        ->values();

    // 2) 'caracteristicas2' (longtext json)
    $car2 = json_decode((string) ($searches->caracteristicas2 ?? '[]'), true);
    if (!is_array($car2)) $car2 = [];

    // 3) 'especificaciones' (longtext json)
    $esp = json_decode((string) ($searches->especificaciones ?? '[]'), true);
    if (!is_array($esp)) $esp = [];

    return view('show', [
        'searches'        => $searches,
        'sear'            => $sear,
        'detalles'        => $detalles,
        'calificaciones'  => $calificaciones,
        'valoras'         => $valoras,
        'califica'        => $califica,
        'd'               => $d,

        // Lo nuevo para tu blade
        'caracts'         => $caracts,
        'car2'            => $car2,
        'esp'             => $esp,
    ]);
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    //MERCADO PAGO 



    /**
     * Checkout por API (cuando mandas items desde el front)
     */
    public function createPreference(Request $request)
    {
        $this->mpAuth();

        $items = collect($request->input('items', []))->map(function ($it) {
            return [
                "title"       => $it['title'] ?? 'Producto',
                "description" => $it['description'] ?? null,
                "quantity"    => (int)($it['quantity'] ?? 1),
                "currency_id" => "PEN",
                "unit_price"  => (float)($it['unit_price'] ?? 1),
                "id"          => $it['id'] ?? null,
            ];
        })->values()->all();

        $payer = [
            "email"   => $request->user()->email ?? 'test_user@example.com',
            "name"    => $request->user()->name ?? null,
        ];

        $backUrls = [
            "success" => env('MP_SUCCESS_URL'),
            "failure" => env('MP_FAILURE_URL'),
            "pending" => env('MP_PENDING_URL'),
        ];

        $req = [
            "items"              => $items,
            "payer"              => $payer,
            "back_urls"          => $backUrls,
            "auto_return"        => "approved",
            "external_reference" => Str::uuid()->toString(),
            "statement_descriptor"=> "TU_TIENDA",
        ];

        $client = new PreferenceClient();
        $opts   = new RequestOptions();
        $opts->setCustomHeaders(["X-Idempotency-Key: " . Str::uuid()->toString()]);
        $pref   = $client->create($req, $opts);

        return response()->json([
            "preference_id" => $pref->id,
            "init_point"    => $pref->init_point,
        ]);
    }

    public function success(Request $request)
    {
        return view('mp.success');
    }

    public function failure(Request $request)
    {
        return view('mp.failure');
    }

    public function pending(Request $request)
    {
        return view('mp.pending');
    }

    public function webhook(Request $request)
    {
        $sigHeader  = $request->header('x-signature');
        $requestId  = $request->header('x-request-id');
        $secret     = env('MP_WEBHOOK_SECRET');
        $paymentId  = $request->query('id') ?? $request->query('data.id');

        if (!$paymentId || !$sigHeader || !$requestId || !$secret) {
            Log::warning('MP webhook missing headers or id', ['q' => $request->query(), 'h' => $request->headers->all()]);
            return response()->noContent(400);
        }

        if (!$this->verifyMpSignature($sigHeader, $requestId, $paymentId, $secret)) {
            Log::warning('MP webhook signature failed', ['id' => $paymentId]);
            return response()->noContent(401);
        }

        $this->mpAuth();
        $payClient = new PaymentClient();
        $payment   = $payClient->get($paymentId);

        Log::info('MP payment status', ['id' => $paymentId, 'status' => $payment->status]);

        return response()->noContent();
    }

    private function verifyMpSignature(string $signature, string $requestId, string $id, string $secret): bool
    {
        $ts = null; $v1 = null;
        foreach (explode(',', $signature) as $part) {
            [$k, $v] = array_map('trim', explode('=', $part, 2));
            if ($k === 'ts') $ts = $v;
            if ($k === 'v1') $v1 = $v;
        }
        if (!$ts || !$v1) return false;

        $manifest = "id:{$id};request-id:{$requestId};ts:{$ts};";
        $calc = hash_hmac('sha256', $manifest, $secret);
        return hash_equals($calc, $v1);
    }

    private function generatePurchase()
    {
        return strtoupper(Str::random(10));
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
