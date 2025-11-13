<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MisPedidosController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminVentaController;
use App\Http\Controllers\AdminUsuarioController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Admin\CompraController;
use App\Http\Controllers\Admin\SearchApiController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Webhooks\PaymentsWebhookController;
use App\Http\Controllers\Admin\CuponController as AdminCuponController;
use App\Http\Controllers\Admin\KitController;
use App\Http\Controllers\KitPublicController;
use App\Http\Controllers\CouponCartoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Admin\IndexImageController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Admin\CampaignController;


/*
Route::get('/test-email', function () {
    Mail::raw('Este es un correo de prueba desde Laravel usando Hostinger SMTP.', function ($message) {
        $message->to('miangelsp11@gmail.com')
                ->subject('Correo de prueba - Amigurumis.pe');
    });

    return 'Correo de prueba enviado (si no falló el SMTP).';
});
//MANUAL
*/
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//MERCADOPAGO


Route::get('/sitemap.xml', function () {
    $urls = [
        // LANDING PRINCIPAL
        ['loc' => url('/'), 'priority' => '1.0'],

        // SECCIONES PRINCIPALES
                
        ['loc' => url('/busco'), 'priority' => '0.9'],        
        ['loc' => url('/pasarela-pago'), 'priority' => '0.7'],
        ['loc' => url('/login'), 'priority' => '0.5'],
        ['loc' => url('/soporte'), 'priority' => '0.5'],
        ['loc' => url('/ubicanos'), 'priority' => '0.5'],

        // PÁGINAS DE POLÍTICAS Y TÉRMINOS (para SEO de confianza)
        ['loc' => url('/terminos/garantia'), 'priority' => '0.3'],
        ['loc' => url('/terminos/uso'), 'priority' => '0.3'],
        ['loc' => url('/terminos/condiciones-envio'), 'priority' => '0.3'],
        ['loc' => url('/terminos/politica'), 'priority' => '0.3'],
        ['loc' => url('/terminos/informacion-legal'), 'priority' => '0.3'],
        ['loc' => url('/terminos/condiciones-proveedor'), 'priority' => '0.3'],
    ];

    // incluir dinámicamente productos si existen
    if (class_exists(\App\Models\Search::class)) {
        $productos = \App\Models\Search::select('id','updated_at')->get();
        foreach ($productos as $p) {
            $urls[] = [
                'loc' => url('/busco/'.$p->id),
                'lastmod' => optional($p->updated_at)->toDateString(),
                'priority' => '0.7',
            ];
        }
    }

    return response()->view('sitemap', compact('urls'))
        ->header('Content-Type', 'application/xml');
});

// Home
Route::get('/', [LandingController::class, 'index'])->name('home');

// Admin Campaña
Route::middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Imágenes del index
        Route::get('index-images', [IndexImageController::class, 'index'])
            ->name('index_images.index');

        Route::post('index-images', [IndexImageController::class, 'store'])
            ->name('index_images.store');

        Route::put('index-images/{indexImage}', [IndexImageController::class, 'update'])
            ->name('index_images.update');

        Route::delete('index-images/{indexImage}', [IndexImageController::class, 'destroy'])
            ->name('index_images.destroy');

        // Búsqueda AJAX de productos (Search)
        Route::get('index-images/search-products', [IndexImageController::class, 'searchProducts'])
            ->name('index_images.search_products');

        // Crear campañas
        Route::post('campaigns', [CampaignController::class, 'store'])
            ->name('campaigns.store');
    });

//DASHBOARD ADMIN
Route::middleware(['auth','is_admin']) // añade tu middleware de admin si lo tienes: 'can:admin'
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // API liviana para el dashboard
        Route::get('/dashboard/data', [DashboardController::class, 'data'])->name('admin.dashboard.data');             // ventas, kpis, top, cupones, flow
        Route::get('/dashboard/inventory', [DashboardController::class, 'inventory'])->name('admin.dashboard.inv');    // inventario por rango + low stock + top
        Route::get('/dashboard/ratios', [DashboardController::class, 'ratios'])->name('admin.dashboard.ratios');       // logística + rotación
    });




/* *WEEBHOOOK */ 

Route::post('webhooks/pagos', [PaymentsWebhookController::class, 'handle'])
    ->name('webhooks.pagos.handle');  




// VENTA ADMIN
Route::middleware(['auth','is_admin'])
    ->prefix('admin/ventas')
    ->name('admin.ventas.')
    ->group(function () {

    
	
	
        Route::get('/',             [AdminVentaController::class, 'index'])->name('index');
        Route::get('/crear',        [AdminVentaController::class, 'create'])->name('create');
        Route::post('/',            [AdminVentaController::class, 'store'])->name('store');

        // 👇 específicas primero
        Route::post('/{venta}/email', [AdminVentaController::class, 'sendEmail'])->name('email');
        Route::patch('/{venta}/meta', [AdminVentaController::class, 'updateMeta'])->name('meta');
        Route::post('/{venta}/meta',  [AdminVentaController::class, 'updateMeta']);

        // 👇 genéricas al final
        Route::get('/{venta}',      [AdminVentaController::class, 'show'])->name('show');
        Route::delete('/{venta}',   [AdminVentaController::class, 'destroy'])->name('destroy');
});
Route::middleware(['auth','is_admin'])->prefix('admin')->group(function () {
    Route::get('personas/lookup', [AdminVentaController::class,'lookupPersona'])->name('admin.personas.lookup');
    Route::get('personas/search', [AdminVentaController::class,'searchPersonas'])->name('admin.personas.search');
});

/////user admin //////


Route::middleware(['auth','is_admin'])->prefix('admin/usuarios')->name('admin.usuarios.')->group(function () {
    Route::get('/',        [AdminUsuarioController::class,'index'])->name('index');
    Route::get('/{id}',    [AdminUsuarioController::class,'show'])->name('show');           // JSON
    Route::put('/{id}',    [AdminUsuarioController::class,'update'])->name('update');       // Editar
    Route::post('/{id}/ban',[AdminUsuarioController::class,'toggleBan'])->name('ban');      // Toggle ban (AJAX)
});

////LOGINGOOGLE
Route::get('auth/google', [SocialLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback'])->name('google.callback');
/////////

///CUPONES

Route::prefix('cupones')->group(function() {
    Route::post('/apply',   [CouponController::class, 'apply'])->name('cupon.apply');
    Route::post('/validate',[CouponController::class, 'validateReservation'])->name('cupon.validate');
    Route::delete('/remove',[CouponController::class, 'remove'])->name('cupon.remove');
    Route::post('/finalize',[CouponController::class, 'finalize'])->name('cupon.finalize');
});
///Creacion cupones
Route::middleware(['auth','is_admin'])->prefix('admin/cupones')->name('admin.cupones.')->group(function () {
    Route::get('/',            [AdminCuponController::class, 'index'])->name('index');
    Route::get('/{id}',        [AdminCuponController::class, 'show'])->name('show');         
    Route::post('/',           [AdminCuponController::class, 'store'])->name('store');       
    Route::patch('/{id}',      [AdminCuponController::class, 'update'])->name('update');      
    Route::patch('/{id}/toggle',[AdminCuponController::class, 'toggle'])->name('toggle');     
    Route::delete('/{id}',     [AdminCuponController::class, 'destroy'])->name('destroy');    
});

/////////////////////

///// ENVIO ///
Route::middleware(['auth','is_admin'])
  ->prefix('admin/envios')->name('admin.envios.')
  ->group(function () {
    Route::get('/',       [ShipmentController::class, 'index'])->name('index');
    Route::get('/{id}',   [ShipmentController::class, 'show'])->name('show');

    // Cambiar estado (POST o PATCH desde fetch)
    Route::post ('/{id}/status', [ShipmentController::class, 'updateStatus'])->name('status');
    Route::patch('/{id}/status', [ShipmentController::class, 'updateStatus']);

    // Editar meta (carrier, service, tracking, url, weight)
    Route::post ('/{id}', [ShipmentController::class, 'updateMeta'])->name('update');
    Route::patch('/{id}', [ShipmentController::class, 'updateMeta']);
});



///COMPRAS

Route::middleware(['web','auth','is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('compras', CompraController::class)->only(['index','show','store']);
    Route::get('searches', [SearchApiController::class, 'index'])->name('searches.index'); // live-search productos
	// descarga/visualización protegida de la factura
    Route::get('compras/{compra}/factura', [CompraController::class, 'downloadFactura'])
            ->name('compras.factura');
	Route::get('compras/{compra}/factura/ver', [CompraController::class, 'verFactura'])
    ->name('compras.factura.ver');
});

////

///KITS

Route::middleware(['auth','is_admin'])->prefix('admin')->group(function () {
    Route::get('kits',            [KitController::class, 'index'])->name('admin.kits.index');
    Route::get('kits/{kit}',      [KitController::class, 'show'])->name('admin.kits.show');
    Route::post('kits',           [KitController::class, 'store'])->name('admin.kits.store');
    Route::put('kits/{kit}',      [KitController::class, 'update'])->name('admin.kits.update');
    Route::delete('kits/{kit}',   [KitController::class, 'destroy'])->name('admin.kits.destroy');

    // endpoint para buscar productos (searches) vía AJAX
    Route::get('kits-searches',   [KitController::class, 'searches'])->name('admin.kits.searches');
});



//////

///CARTO COUPON

Route::post('/cupones-carto/apply',    [CouponCartoController::class,'apply'])->name('cupon.apply.carto');
Route::post('/cupones-carto/validate', [CouponCartoController::class,'validateReservation'])->name('cupon.validate.carto');
Route::delete('/cupones-carto/remove', [CouponCartoController::class,'remove'])->name('cupon.remove.carto');
Route::post('/cupones-carto/finalize', [CouponCartoController::class,'finalize'])->name('cupon.finalize.carto');


//////////////////
Route::post('/mp/create-preference', [
    'uses' => 'MercadoPagoController@createPreference',
    'as'   => 'mp.create'
]);

Route::get('/pago', [
    'uses' => 'MercadoPagoController@show',
    'as'   => 'mp.form',
]);
Route::get('/pago/coupon/check', [
    'uses' => 'MercadoPagoController@checkCoupon',
    'as'   => 'mp.coupon.check',
]);

Route::post('/process_payment', [
    'uses' => 'MercadoPagoController@process',
    'as'   => 'mp.process',
]);

Route::post('/mp/yape', [
    'uses' => 'MercadoPagoController@yape',
    'as'   => 'mp.yape',
]);


Route::get('/yape/success', [
    'uses' => 'MercadoPagoController@successView',
    'as'   => 'yape.success',
])->middleware(['throttle:20,1','nocache']);









//CART SESSION

Route::get('/add-to-carto/{id}',[
	'uses'=>'CartController@getAddToCarto',
	'as' =>'product.addToCarto'
]);
Route::get('/reduce-carto/{id}',[
	'uses'=>'CartController@getReduceByOneCarto',
	'as' =>'product.reduceCarto'
]);
Route::get('/remove-carto/{id}',[
	'uses'=>'CartController@getRemoveCarto',
	'as' =>'product.removeCarto'
]);

Route::post('/process_pay', [
    'uses' => 'CartController@process',
    'as'   => 'mp.processpay',
]);

Route::post('/mp/ya', [
    'uses' => 'CartController@yape',
    'as'   => 'mp.ya',
]);

Route::get('/pasarela/pago', [
    'uses' => 'CartController@show',
    'as'   => 'mp.pago',
]);

// DELIVERY (captura y persistencia de datos)
Route::get('/carto/delivery', [CartController::class, 'DeliveryCarto'])->name('carto.delivery');
Route::match(['get','post'], 'cliente/carto/delivery', [
  'uses' => 'CartController@GuardarDelivery',  // <- sin App\Http\Controllers\
  'as'   => 'cliente.carto.delivery',
]);
// Resumen JSON (subtotal, envío, descuento, total)
Route::get('/carto/resumen', [CartController::class, 'resumenCarto'])
    ->name('carto.resumen');
// routes/web.php
Route::get('/pasarela/resumen-carto', [\App\Http\Controllers\CartController::class,'resumenCarto'])
    ->name('pasarela.resumen');

// ÉXITO
Route::get('/success-gate', [MercadoPagoController::class, 'gate'])->name('success.gate');


Route::get('/add-to-cart/{id}',[
	'uses'=>'SearchController@getAddToCart',
	'as' =>'product.addToCart'
]);
Route::get('carro-compras',[
	'uses'=>'SearchController@getCart',
	'as' =>'product.carro-compras'
]);
Route::get('pasarela-pago',[
	'uses'=>'CartController@getCarto',
	'as' =>'product.pasarela-pago'
]);



Route::get('envio',[
	'uses'=>'SearchController@envio',
	'as' =>'product.envio'
]);
Route::get('/reduce/{id}',[
	'uses'=>'SearchController@getReduceByOne',
	'as' =>'product.reduceByOne'
]);

Route::get('/remove/{id}',[
	'uses'=>'SearchController@getRemoveItem',
	'as' =>'product.remove'
]);




Route::post('checkout.post',[
	'uses'=>'SearchController@postCheckout',
	'as' =>'checkout.post',
	'middleware' => 'auth'
]);

Route::post('transfer-mobile.post',[
	'uses'=>'SearchController@postTransferMobile',
	'as' =>'transfer-mobile.post',
	'middleware' => 'auth'
]);
Route::post('checkoutcity.post',[
	'uses'=>'SearchController@postCheckoutcity',
	'as' =>'checkoutcity.post',
	'middleware' => 'auth'
]);
Route::post('transfer.post',[
	'uses'=>'SearchController@postTransfer',
	'as' =>'transfer.post',
	'middleware' => 'auth'
]);
Route::get('success',[
	'uses'=>'SuccessController@index',
	'as' =>'success'
	
]);
Route::get('success-mobile',[
	'uses'=>'SuccessController@mobile',
	'as' =>'success-mobile',
	'middleware' => 'auth'
]);
// CLIENTE VER PEDIDOS
Route::middleware('auth')->group(function () {
    Route::get('compras', [MisPedidosController::class, 'index'])->name('compras');
});

//------------ 
Route::get('clientes', 'UserController@index')->name('userin');
Route::get('find','UserController@getName' );
Route::get('verify/{id}','UserController@editMobile');
Route::get('user-mobile/{id}/showMobile','UserController@showMobile')->name('user-mobile.showMobile');

Route::resource('messages','MessageController');
Route::resource('pdfauth','DataController');
Route::post('pdfcreater.post','DataController@store')->name('pdfcreater.post');
Route::get('pdfcreater','DataController@store')->name('pdfcreater');


Route::get('libro-reclamaciones','MessageController@create')->name('messages');
Route::post('libro-reclamaciones.post','MessageController@store')->name('messages.post');

Route::resource('personas','UserController');
Route::resource('detail', 'SellController');

Route::resource('tasks','TaskController',['except'=>'show']);

Route::resource('detail-mobile', 'SellMobileController');


Route::resource('ingreso','VentaController');
Route::get('venta-mobile','VentaController@mobileindex');
Route::post('venta-mobile.post','VentaController@search');
Route::get('venta-mobile/{id}','VentaController@showMobile')->name('venta-show.showMobile');
Route::get('ventsearch','VentaController@ventaBusca');
Route::get('venta-create','VentaController@createMobile')->name('venta-create.createMobile');
Route::post('storeMobile','VentaController@storeMobile')->name('venta-create.storeMobile');



Route::get('blackboard', 'BoardController@index')->name('blackboard');
Route::get('ganancia','BoardController@getGanancia');
Route::get('monto','BoardController@getMonto');
Route::resource('app','BoardController');
Route::get('admin-mobile','BoardController@indexmobile');
Route::resource('searches','ArticuloController');
Route::get('articulos/pagination','SearchcellController@pagination');

Route::get('articulo', 'ArticuloController@subindex')->name('articulo');
Route::get('product-mobile', 'ArticuloController@mobileindex')->name('product-mobile');
Route::get('product-mobile/{id}/editMobile','ArticuloController@editMobile')->name('product-mobile.imageEnvio');
Route::post('product-mobile/{id}','ArticuloController@imageMobile')->name('product-mobile.imageEnvio.post');
Route::get('createart', 'ArticuloController@rollperson')->name('createart');


Route::resource('envios','EnvioController');
Route::get('lista', 'EnvioController@subindex')->name('lista');
Route::get('envio-mobile', 'EnvioController@indexMobile')->name('envio-mobile');

Route::resource('gastos','GastoController');
Route::get('almacen', 'GastoController@gastoindex')->name('almacen');


Route::get('usuario', 'UsuarioController@index')->name('usuario');
Route::get('usuario-mobile', 'UserController@indexMobile')->name('usuario-mobile');
Route::post('usuario-mobile', 'UserController@indexMobile')->name('usuario-mobile.post');
Route::get('usuario-mobile/{id}/editMobile','UserController@editMobile')->name('usuario-mobile.editMobile');
Route::post('usuario-mobile/{id}','UserController@updateMobile')->name('usuario-mobile.updateMobile');

Route::get('index-profile', 'UsuarioController@subindex')->name('index-profile');
Route::get('ifauth', 'IfauthController@index')->name('ifauth');

Route::get('workers', function(){
    return view('clientes.workers');
});
Route::get('noauth', function(){
    return view('noautorized');
});

Route::get('buscando', 'SearchController@index')->name('item');
Route::get('busca','SearchController@getItem' )->name('busca');
Route::resource('busco','SearchController'); 
Route::get('/upload','UpdateController@uploadForm' );
Route::post('upload','UpdateController@uploadFile')->name('uploadFile');
Route::get('cell-version', 'SearchcellController@index')->name('subitem');
Route::resource('finde','SearchcellController'); 


Route::post('articulo','ArticuloController@imagePost');
Route::post('suppli','SupplierstockController@imagePost');
Route::post('lista/{id}','EnvioController@imageEnvio')->name('lista.imageEnvio');
Route::get('envio-mobile/{id}/editMobile','EnvioController@editMobile')->name('envio-mobile.imageEnvio');
Route::post('envio-mobile/{id}','EnvioController@imageMobile')->name('envio-mobile.imageEnvio.post');

Auth::routes();


Route::resource('supplier','SupplierController');
Route::resource('suppliers','SupplierstockController');
Route::get('supplier-stock','SupplierstockController@subindex')->name('supplier-stock');
Route::get('prov-mobile','SupplierstockController@supmobile')->name('prov-mobile');

Route::get('register-v', function(){
    return view('layouts.register-version');
});



Route::resource('tiendas','TiendaController');
Route::resource('pagos','PagoController');
Route::resource('pagas','PagoProvController');
Route::get('pagos-mobile','PagoController@indexMobile');
Route::get('pagas-mobile','PagoProvController@indexMobile');
Route::post('pa-mobile.post','PagoController@storeMobile')->name('pa-mobile.post');
Route::get('pa-mobile','PagoController@storeMobile')->name('pa-mobile');
Route::post('pav-mobile.post','PagoController@storeProvMobile')->name('pav-mobile.post');
Route::get('pav-mobile','PagoController@storeProvMobile')->name('pav-mobile');

Route::post('/finalizar/{purchaseNumber}/{amount}','PagoController@finalizar')->name('finalizar.post');
Route::get('/finalizar/{purchaseNumber}/{amount}','PagoController@finalizar')->name('finalizar');
Route::post('/finalizarmobile/{purchaseNumber}/{amount}','PagoController@finalizarMobile')->name('finalizarmobile.post');
Route::get('/finalizarmobile/{purchaseNumber}/{amount}','PagoController@finalizarMobile')->name('finalizarmobile');

Route::get('terminos/garantia', function(){
    return view('terminos.index1');
});
Route::get('terminos/uso', function(){
    return view('terminos.index2');
});
Route::get('terminos/contra-entrega', function(){
    return view('terminos.index3');
});
Route::get('terminos/condiciones-envio', function(){
    return view('terminos.index4');
});
Route::get('terminos/condicion-premium', function(){
    return view('terminos.index5');
});
Route::get('terminos/politica', function(){
    return view('terminos.index6');
});
Route::get('terminos/informacion-legal', function(){
    return view('terminos.index7');
});
Route::get('terminos/propiedad-intelectual', function(){
    return view('terminos.index8');
});
Route::get('terminos/condiciones-proveedor', function(){
    return view('terminos.index9');
});
Route::get('terminos/proteccion-laboral', function(){
    return view('terminos.index10');
});

Route::get('/out-stock/{id}',[
	'uses'=>'SearchController@outStock',
	'as' =>'product.outStock'
]);
Route::post('/out-stock/{id}',[
	'uses'=>'SearchController@outStock',
	'as' =>'product.outStock.post'
]);


Route::resource('pdf','DataController');
Route::get('/download-pdf/{id}', 'DataController@downloadPDF');


Route::view('/soporte', 'support')->name('support.page');

Route::get('soporte-mobile', function(){
    return view('soporte-mobile');
});

Route::get('ubicanos', function(){
    return view('ubicanos');
});

Route::resource('categorias','CateCellController');

Route::resource('pedidos','DetalleController');
Route::get('detalle-producto', 'DetalleController@productos')->name('detalle-producto');

Route::resource('entradas','CajaController');
Route::get('/egreso/create','CajaController@egresocreate')->name('egreso/create');
Route::post('salida','CajaController@egresostore')->name('salida');



Route::get('binancepay','PagoController@binancepay')->name('binancepay');
Route::post('binancepay','PagoController@binancepay')->name('binancepay.post');

Route::get('binanceorder','PagoController@binanceOrder')->name('binanceorder');
Route::post('binanceorder','PagoController@binanceOrder')->name('binanceorder.post');

Route::get('tipocambio','PagoController@tipoCambio')->name('tipocambio');
Route::post('tipocambio','PagoController@tipoCambio')->name('tipocambio.post');

Route::get('binance/{id}','PagoController@exitoso');





Route::get('/mail', [MailController::class, 'sendMail']);





//mochilas agregar

Route::match(['get','post'], 'nuevamochila-item/{idarticulo}/{color?}', [
    'uses' => 'SearchController@NuevaMochilaItem',
    'as'   => 'nuevamochila.item',
]);

Route::get('delivery',[
	'uses'=>'SearchController@Delivery',
	'as' =>'delivery'
]);

Route::get('/agregararticulo/{ids}/{idarticulo}',[
	'uses'=>'SearchController@AgregarArticulo',
	'as' =>'agregararticulo'
]);
Route::get('/disminuirarticulo/{ids}/{idarticulo}',[
	'uses'=>'SearchController@DisminuirArticulo',
	'as' =>'disminuirarticulo'
]);
Route::get('/eliminar/{ids}/{idarticulo}',[
	'uses'=>'SearchController@eliminar',
	'as' =>'eliminar'
]);
Route::get('mochila/eliminar/{mochilaId}', [
    'uses' => 'SearchController@EliminarMochila',
    'as'   => 'mochila.eliminar.get'
]);
Route::match(['get','post'], 'cliente/delivery', [
  'uses' => 'SearchController@GuardarDelivery',  // <- sin App\Http\Controllers\
  'as'   => 'cliente.delivery',
]);
//mochilas mobile agregar



//PRODUCTOS SISTEMA 
Route::middleware(['auth','is_admin'])
    ->prefix('admin')->name('admin.')
    ->group(function () {
        Route::redirect('/', '/admin/productos');
        Route::get('/productos', [ProductController::class, 'index'])->name('products.index');

        // Endpoints usados por AJAX desde el mismo index
        Route::post('/productos', [ProductController::class, 'store'])->name('products.store');
        Route::get('/productos/{search}', [ProductController::class, 'show'])->name('products.show'); // JSON
        Route::put('/productos/{search}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/productos/{search}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

