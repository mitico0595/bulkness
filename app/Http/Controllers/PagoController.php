<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Niubiz;
use App\Search;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Cart;
use App\Venta;

use App\DetalleVenta;
use DB;
use Carbon\Carbon;
use Response;

use Session;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email;
use Illuminate\Mail\Mailable;
 
        
        
        
class PagoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        
    }    
    public function show ($purchaseNumber){
        
        $domil = Session::get('domil');
        
        $email = Auth::user()->email;
        $date = Carbon::now()->setTimezone('UTC');
        $date= $date->toDateTimeString();
        $date= substr($date,0,4).substr($date,5,2).substr($date,8,2).substr($date,11,2).substr($date,14,2).substr($date,17,2);
        
        $venta =  DB::table('venta as v')->where('v.purchaseNumber','=',$purchaseNumber)->first();
        $id = $venta->idventa;
        $idpersona = $venta->idpersona;
        $idauth= Auth::user()->id;
        $protected =0;
        if ($idpersona == $idauth){
            $protected = 1;
        }
        $totalProduct = $venta->total_parcial;
        $detalles=DB::table('detalle_venta as d')
            ->join('searches as a','d.idarticulo','=','a.id')
            ->select('a.name as name','a.codigo as code','a.description as descrip','d.cantidad','d.precio_venta','a.image as image','a.categoria as categoria','a.precio as precio')
            ->where('d.idventa','=',$id)
            ->get();
        $amount = $venta->total_venta;
        $payment_id = $this->generatePurchaseIzi();
        $amounty = $amount*100;
        $dni = $venta->dni;
        $cell = $venta->celular;
        $fecha = $venta->fecha_hora;
        $direccion = $venta->domicilio;
        $distrito = $venta->distrito;
        $provincia = $venta->provincia;
        $ciudad = $venta->departamento;
        $verify = $venta->bverifi;
        $content_signature = "";
        $params = array(
         'vads_action_mode' => 'INTERACTIVE',
         'vads_amount' => $amounty,
         'vads_ctx_mode' => 'PRODUCTION',
         'vads_currency' => '604',
         'vads_page_action' => 'PAYMENT',
         'vads_payment_config' => 'SINGLE',
         'vads_site_id' => '37752659',
         'vads_trans_date' => $date,
         'vads_trans_id' => $payment_id,
         'vads_version' => 'V2',
        );
        $key = 'TMTa7GInLfIxDdsc';
         ksort ($params);
        foreach ($params as $nom=>$value) {
            if  (substr ($nom,0,5) == 'vads_') {
                $content_signature = $content_signature.$value."+";
             }
        }

        $content_signature = $content_signature.$key;

       $hash= base64_encode(hash_hmac('sha256', $content_signature, $key, true));
       
        $envios = Venta::findOrFail($id);
        $envios->payment_id = $payment_id;
        $envios->email = $email;
       $envios->save();
       
        return view('datain', ['amount' => $amount ,'protected'=>$protected ,'verify'=> $verify, 'amounty' => $amounty ,'date'=>$date, 'payment_id'=>$payment_id,'hash'=>$hash,'detalles'=>$detalles,'totalProduct'=>$totalProduct,'dni'=>$dni,'cell'=>$cell,'fecha'=>$fecha,'direccion'=>$direccion,'distrito'=>$distrito,'provincia'=>$provincia,'ciudad'=>$ciudad,'email'=>$email,]);
    }
    
    // BINANCE PAY --------------------------//
    
    public function binanceGetPay(){
        if(!Session::has('cart')){
            return view('shop.carro-compras', ['searches'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->BpriceLocal;
        $totalp = $cart->Bprice;
        $searches = $cart->items;
        $send = $cart->send;
        $tc = $cart->tc;
        return view('binance.checkout',['total'=>$total,'searches'=>$cart->items,'send'=>$send,'tc'=>$tc,'totalp'=>$totalp ]);
    }
    public function binanceGetTransfer(){
        if(!Session::has('cart')){
            return view('shop.carro-compras', ['searches'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->Bprice;
        $totalp = $cart->Bprice;
        $searches = $cart->items;
        $send = '0.00';
        $tc = $cart->tc;
        return view('binance.transfer',['total'=>$total,'searches'=>$cart->items,'send'=>$send,'tc'=>$tc,'totalp'=>$totalp ]);
    }
    public function binanceGetCity(){
        if(!Session::has('cart')){
            return view('shop.carro-compras', ['searches'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->BpriceV;
        $totalp = $cart->Bprice;
        $searches = $cart->items;
        $send = $cart->sendV;
        $tc = $cart->tc;
        return view('binance.checkoutcity',['total'=>$total,'searches'=>$cart->items,'send'=>$send,'tc'=>$tc,'totalp'=>$totalp ]);
    }
    function binancePostCity(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = $cart->items;
        $email = Auth::user()->email;
         $k =0;
        $n=0;
    
        foreach ($searches as $search){
            $sear[$k][$n] = $search['item']['id'];
            $sear[$k][$n+1] = $search['qty'];
            $sear[$k][$n+2] = $search['item']['precio'];
            
            ++$k;
            $n=0;
        }
        $k =0;
        $n=0;
      
        
        
        $amount = $cart->BpriceV;
        $purchaseNumber = $this->generatePurchaseNumber();
        $name = "Pago con Envio Departamento";
        $result = $this->binancePay($purchaseNumber,$amount,$name);
        $qr=$result['data']["qrcodeLink"];
        $checkoutUrl=$result['data']["checkoutUrl"];

       
        try{

            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_pago=$cart->BpriceV;
            $venta->total_venta=$cart->totalPrecioProv;
            $venta->total_parcial=$cart->totalPrecioProv;
            $venta->tc = $cart->tc;
            $venta->domicilio = $request->get('detalle');
            $venta->name = $request->get('name');
            $venta->tipo_venta = "BINANCE_PAY";
            $venta->distrito = $request->get('distrito');
            $venta->provincia = 'Lima';
            $venta->departamento = 'Lima' ;
            $venta->celular = $request->get('cell');
            $venta->dni = $request->get('dni');
            $venta->referencia = $request->get('referencia');
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->purchaseNumber = $purchaseNumber; //
            $venta->qr=$qr;
            $venta->checkoutUrl = $checkoutUrl;
            $venta->option_select= 'Envio Lima 10 PEN';
            $venta->save();



            $cont = 0;

            while($cont < count($cart->items)){
                $id=$sear[$cont][0];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$sear[$cont][0];
                $detalle->cantidad=$sear[$cont][1];
                $detalle->precio_venta=$sear[$cont][2];
                $detalle->ganancia= $sear[$cont][1]*($sear[$cont][2]-$costo[$cont]);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('crypto/checkoutcity')->with('error', $e->getMessage());

        }
        
        // EMAIL
        
        $idorder = $venta->idventa;
        Mail::to($email)->send(new Email($idorder)); 
        
        // end email
        Session::forget('cart');
        return Redirect::to($checkoutUrl);

    }
    function binancePostPay(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = $cart->items;
        $email = Auth::user()->email;
         $k =0;
        $n=0;
    
        foreach ($searches as $search){
            $sear[$k][$n] = $search['item']['id'];
            $sear[$k][$n+1] = $search['qty'];
            $sear[$k][$n+2] = $search['item']['precio'];
            
            ++$k;
            $n=0;
        }
        $k =0;
        $n=0;
      
        
        
        $amount = $cart->BpriceLocal;
        $purchaseNumber = $this->generatePurchaseNumber();
        $name = "Pago con Envio Lima";
        $result = $this->binancePay($purchaseNumber,$amount,$name);
        $qr=$result['data']["qrcodeLink"];
        $checkoutUrl=$result['data']["checkoutUrl"];

       
        try{

            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_pago=$cart->BpriceLocal;
            $venta->total_venta=$cart->totalPrecio;
            $venta->total_parcial=$cart->totalPrice;
            $venta->tc = $cart->tc;
            $venta->domicilio = $request->get('detalle');
            $venta->name = $request->get('name');
            $venta->tipo_venta = "BINANCE_PAY";
            $venta->distrito = $request->get('distrito');
            $venta->provincia = 'Lima';
            $venta->departamento = 'Lima' ;
            $venta->celular = $request->get('cell');
            $venta->dni = $request->get('dni');
            $venta->referencia = $request->get('referencia');
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->purchaseNumber = $purchaseNumber; //
            $venta->qr=$qr;
            $venta->checkoutUrl = $checkoutUrl;
            $venta->option_select= 'Envio Lima 10 PEN';
            $venta->save();



            $cont = 0;

            while($cont < count($cart->items)){
                $id=$sear[$cont][0];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$sear[$cont][0];
                $detalle->cantidad=$sear[$cont][1];
                $detalle->precio_venta=$sear[$cont][2];
                $detalle->ganancia= $sear[$cont][1]*($sear[$cont][2]-$costo[$cont]);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('crypto/checkout')->with('error', $e->getMessage());

        }
        // EMAIL
        
        $idorder = $venta->idventa;
        Mail::to($email)->send(new Email($idorder)); 
        
        // end email
        Session::forget('cart');
        return Redirect::to($checkoutUrl);

    }
    
    
    function binancePostTransfer(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = $cart->items;
        $email = Auth::user()->email;
        
         $k =0;
        $n=0;
    
        foreach ($searches as $search){
            $sear[$k][$n] = $search['item']['id'];
            $sear[$k][$n+1] = $search['qty'];
            $sear[$k][$n+2] = $search['item']['precio'];
            
            ++$k;
            $n=0;
        }
        $k =0;
        $n=0;
      
        
        
        $amount = $cart->Bprice;
        $purchaseNumber = $this->generatePurchaseNumber();
        $name = "Sin pago de Envio";
        $result = $this->binancePay($purchaseNumber,$amount,$name);
        $qr=$result['data']["qrcodeLink"];
        $checkoutUrl=$result['data']["checkoutUrl"];

       
        try{

            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona = Auth::user()->id;
            $venta->total_pago=$cart->Bprice;
            $venta->total_venta=$cart->totalPrice;
            $venta->total_parcial=$cart->totalPrice;
            $venta->tc = $cart->tc;
            $venta->domicilio = $request->get('detalle');
            $venta->name = $request->get('name');
            $venta->tipo_venta = "BINANCE_PAY";
            $venta->distrito = $request->get('distrito');
            $venta->provincia = $request->get('provincia');
            $venta->departamento = $request->get('distrito');
            $venta->celular = $request->get('cell');
            $venta->dni = $request->get('dni');
            $venta->referencia = $request->get('referencia');
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->purchaseNumber = $purchaseNumber; //
            $venta->qr=$qr;
            $venta->checkoutUrl = $checkoutUrl;
            $venta->option_select= 'No pagado';
            $venta->save();



            $cont = 0;

            while($cont < count($cart->items)){
                $id=$sear[$cont][0];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$sear[$cont][0];
                $detalle->cantidad=$sear[$cont][1];
                $detalle->precio_venta=$sear[$cont][2];
                $detalle->ganancia= $sear[$cont][1]*($sear[$cont][2]-$costo[$cont]);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('checkout')->with('error', $e->getMessage());

        }
        // EMAIL
        
        $idorder = $venta->idventa;
        Mail::to($email)->send(new Email($idorder)); 
        
        // end email
        Session::forget('cart');
        return Redirect::to($checkoutUrl);

    }
    function binancePay($purchaseNumber,$amount,$name){
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $nonce = '';
        $amount = number_format($amount,2);
        $url= "https://oberlu.com/binance/".$amount;
        for($i=1; $i <= 32; $i++)
        {
            $pos = mt_rand(0, strlen($chars) - 1);
            $char = $chars[$pos];
            $nonce .= $char;
        }
        $binance_pay = "sudhaeohrjnhvdncro4tziukwissar1eh7zjqagvezgfpvghvjwzonnnwkbcq2f9";
        $binance_pay_secret = "ep5qpoi65moqicyb7xexwjshp5fyyrptyechvvbznwjf3rrpuvsnqz0lxadvovrz";

        $ch = curl_init();
        $timestamp = round(microtime(true) * 1000);

        $request = array(
            "env"=>array("terminalType"=>"WEB"),
            "merchantTradeNo"=> $purchaseNumber,
            "orderAmount"=> $amount ,
            "currency"=>"USDT",
            "goods"=>
            array(
            "goodsType"=>"01",
            "goodsCategory"=>"0000",
            "referenceGoodsId"=>"abc001",
            "goodsName"=> $name,
            "goodsDetail" =>"QR generado exitosamente",
            "goodsUnitAmount"=>array("currency"=>"USDT","amount"=>1.00)
            ),
            "shipping"=>array("shippingName"=>array("firstName"=>"Joe","lastName"=>"Don"),
            "shippingAddress"=>array("region"=>"PE")),
            "buyer"=>array("buyerName"=>array("firstName"=>"Anonymous","lastName"=>"none")
        ),
            "cancelUrl"=>"https://oberlu.com/",
            "returnUrl"=> $url,
        );

        $json_request = json_encode($request);
        $payload = $timestamp."\n".$nonce."\n".$json_request."\n";
        $signature = strtoupper(hash_hmac('SHA512',$payload,$binance_pay_secret));


        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "BinancePay-Timestamp: $timestamp";
        $headers[] = "BinancePay-Nonce: $nonce";
        $headers[] = "BinancePay-Certificate-SN: $binance_pay";
        $headers[] = "BinancePay-Signature: $signature";

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, "https://bpay.binanceapi.com/binancepay/openapi/v2/order");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_request);

        $result = curl_exec($ch);
        if (curl_errno($ch)) { echo 'Error:' . curl_error($ch); }

        curl_close ($ch);
        $result = json_decode($result, TRUE);


        return $result;

        }
        function binanceOrder($merchTrade){

        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $nonce = '';
        for($i=1; $i <= 32; $i++)
        {
            $pos = mt_rand(0, strlen($chars) - 1);
            $char = $chars[$pos];
            $nonce .= $char;
        }
        $binance_pay = "sudhaeohrjnhvdncro4tziukwissar1eh7zjqagvezgfpvghvjwzonnnwkbcq2f9";
        $binance_pay_secret = "ep5qpoi65moqicyb7xexwjshp5fyyrptyechvvbznwjf3rrpuvsnqz0lxadvovrz";

        $ch = curl_init();
        $timestamp = round(microtime(true) * 1000);
        // Request body
        $request = array(
            "merchantTradeNo" => $merchTrade,
        );

        $json_request = json_encode($request);
        $payload = $timestamp."\n".$nonce."\n".$json_request."\n";
        $signature = strtoupper(hash_hmac('SHA512',$payload,$binance_pay_secret));


        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "BinancePay-Timestamp: $timestamp";
        $headers[] = "BinancePay-Nonce: $nonce";
        $headers[] = "BinancePay-Certificate-SN: $binance_pay";
        $headers[] = "BinancePay-Signature: $signature";

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, "https://bpay.binanceapi.com/binancepay/openapi/v2/order/query");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_request);

        $result = curl_exec($ch);
        if (curl_errno($ch)) { echo 'Error:' . curl_error($ch); }
        echo $result;
        curl_close ($ch);

    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // ------------------------------------------------------ //
    
    
    
    
    public function indexMobile (Request $request){
        $domil = Session::get('domil');
        if(!Session::has('cart')){
            return view('shop.carro-compras', ['searches'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrecio;
        return view('cell-version.pagos-mobile', ['domil' => $domil,'searches'=>$cart->items,'totalProduct'=>$cart->totalPrice,'total'=>$total]);

    }
    public function store(Request $request) {
        $request->session()->forget('domil');
        $domil = (object)array(
            'name' => $request->name,
            'cell' => $request->cell,
            'dni' => $request->dni,
            'detalle' => $request->detalle,
            'referencia' => $request->referencia,
            'domicilio' => $request->domicilio,
            'distrito' => $request->distrito,
            'provincia' => "Lima",
            'ciudad' => "Lima",
        );
        Session::push('domil',$domil);
        $var = Session::get('domil');
        
        return redirect('checkout');
    }
   // public function storeMobile(Request $request) {
    //    $request->session()->forget('domil');
   //     $domil = (object)array(
  //          'name' => $request->name,
  //          'cell' => $request->celular,
  //          'dni' => $request->dni,
 //           'detalle' => $request->nota,
 //           'referencia' => $request->referencia,
 //           'domicilio' => $request->domicilio,
  //          'distrito' => $request->distrito,
 //           'provincia' => "Lima",
 //           'ciudad' => "Lima",
//        );
///        Session::push('domil',$domil);
//        $var = Session::get('domil');
//        
//        return redirect('checkout-mobile');
//    }
    
    public function storeMobile(Request $request){
       
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = ['searches'=>$cart->items];
        $purchaseNumber = $this->generatePurchaseIzi(); 
        $email = Auth::user()->email;
        $ref = $oldCart->items;
        $c = 0;
        foreach($ref as $re)
        {   
            $iditem[$c] = $re['item']['id']; 
            $qtyitem[$c]= $re['qty'];   
            $subitem[$c] = $re['precio'];    
            $c=$c+1;
        }
        try{
            
            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_venta=$cart->totalPrecio;
            $venta->name = $request->get('name');
            $venta->domicilio = $request->get('domicilio');
            $venta->purchaseNumber = $purchaseNumber;
            $venta->distrito = $request->get('distrito');
            $venta->provincia = "Lima";
            $venta->total_parcial=$cart->totalPrice;
            $venta->cargos = (number_format($cart->charge, 2));
            $venta->departamento = "Lima";
            $venta->option_select = "Envio Lima- 10.00";
            $venta->celular = $request->get('celular');
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
                $id=$iditem[$cont];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$iditem[$cont];
                $detalle->cantidad=$qtyitem[$cont];
                $detalle->precio_venta=$subitem[$cont];
                $detalle->ganancia= $subitem[$cont]-($qtyitem[$cont]*$costo[$cont]);
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
        return redirect('pagos/'.$purchaseNumber);
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
    
    
    // STORE PROV MOBILE --------------------------------------------------------------------------
    public function storeProvMobile(Request $request){
       
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = ['searches'=>$cart->items];
        $purchaseNumber = $this->generatePurchaseIzi(); 
        $ref = $oldCart->items;
        $c = 0;
        foreach($ref as $re)
        {   
            $iditem[$c] = $re['item']['id']; 
            $qtyitem[$c]= $re['qty'];   
            $subitem[$c] = $re['precio'];    
            $c=$c+1;
        }
        try{
            
            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_venta=$cart->totalPrecioProv;
            $venta->name = $request->get('name');
            $venta->domicilio = $request->get('domicilio');
            $venta->purchaseNumber = $purchaseNumber;
            $venta->distrito = $request->get('distrito');
            $venta->provincia = $request->get('provincia');
            $venta->total_parcial=$cart->totalPrice;
            $venta->cargos = (number_format($cart->charge, 2));
            $venta->departamento = $request->get('ciudad');
            $venta->option_select = "Envio Departamento - 14.90";
            $venta->celular = $request->get('celular');
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
                $id=$iditem[$cont];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$iditem[$cont];
                $detalle->cantidad=$qtyitem[$cont];
                $detalle->precio_venta=$subitem[$cont];
                $detalle->ganancia= $subitem[$cont]-($qtyitem[$cont]*$costo[$cont]);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('checkout-mobile')->with('error', $e->getMessage());
    
        }

        Session::forget('cart');
        return redirect('pagos/'.$purchaseNumber);
    }
    
   
    
    
    
    // ---------------------------------------------------------- STORE END MOBILE ---------------------------------------------------
    function finalizar (Request $request, $purchaseNumber, $amount){
        
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = ['searches'=>$cart->items];
        $loli= Session::get('domil');
        $transactionToken = $request->post('transactionToken');
        
        $token = $this->generateToken();

        $data = $this->generateAuthorization($amount, $purchaseNumber, $transactionToken, $token);
        
            
        $ref = $oldCart->items;
        $c = 0;
        foreach($ref as $re)
        {   
            $iditem[$c] = $re['item']['id']; 
            $qtyitem[$c]= $re['qty'];   
            $subitem[$c] = $re['precio'];    
            $c=$c+1;
        }

        try{
            
            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_venta=$cart->totalPrecio;
            $venta->domicilio = $loli[0]->detalle;
            $venta->name = $loli[0]->name;

            $venta->distrito = $loli[0]->distrito;
            $venta->provincia = $loli[0]->provincia;
            $venta->total_parcial=$cart->totalPrice;
            $venta->cargos = (number_format($cart->charge, 2));
            $venta->departamento = $loli[0]->ciudad;
            $venta->option_select = "Envio Lima- 10.00";
            $venta->celular = $loli[0]->cell;
            $venta->domicilio = $loli[0]->domicilio;
            $venta->dni = $loli[0]->dni;
            $venta->referencia = $loli[0]->referencia;
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->save();

            

            $cont = 0;

            while($cont < count($cart->items)){
                $id=$iditem[$cont];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$iditem[$cont];
                $detalle->cantidad=$qtyitem[$cont];
                $detalle->precio_venta=$subitem[$cont];
                $detalle->ganancia= $subitem[$cont]-($qtyitem[$cont]*$costo[$cont]);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('checkout')->with('error', $e->getMessage());

        }

        Session::forget('cart');
        Session::forget('domil');
        return view('finalizar',['data'=>$data,'amount'=>$amount, 'purchaseNumber'=>$purchaseNumber]);
        

    }
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
    
   function finalizarMobile (Request $request){
        
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = ['searches'=>$cart->items];
        $loli= Session::get('domil');
        $ref = $oldCart->items;
        $c = 0;
        foreach($ref as $re)
        {   
            $iditem[$c] = $re['item']['id']; 
            $qtyitem[$c]= $re['qty'];   
            $subitem[$c] = $re['precio'];    
            $c=$c+1;
        }

        try{
            
            DB::beginTransaction();
            $venta= new Venta;
            $venta->idpersona= Auth::user()->id;
            $venta->total_venta=$amount;
            $venta->domicilio = $loli[0]->domicilio;
            $venta->name = $loli[0]->name;

            $venta->distrito = $loli[0]->distrito;
            $venta->provincia = $loli[0]->provincia;
            $venta->total_parcial=$cart->totalPrice;
            $venta->cargos = (number_format($cart->charge, 2));
            $venta->departamento = $loli[0]->ciudad;
            $venta->option_select = $amount-$cart->totalPrice;
            $venta->celular = $loli[0]->cell;
            $venta->dni = $loli[0]->dni;
            $venta->referencia=$loli[0]->referencia;
            $venta->detalle=$loli[0]->detalle;
            $venta->purchaseNumber=$purchaseNumber;
            $mytime = Carbon::now('America/Lima');
            $venta->fecha_hora =$mytime->toDateTimeString();
            $venta->save();

            

            $cont = 0;

            while($cont < count($cart->items)){
                $id=$iditem[$cont];
                $searches=DB::table('searches as s')
                ->select('s.id','s.costo')
                ->where('s.id','=',$id)
                ->groupBy('s.id','s.costo')
                ->first();
                $costo[$cont] = $searches->costo;
                $detalle=new DetalleVenta();
                $detalle->idventa=$venta->idventa;
                $detalle->idarticulo=$iditem[$cont];
                $detalle->cantidad=$qtyitem[$cont];
                $detalle->precio_venta=$subitem[$cont];
                $detalle->ganancia= $subitem[$cont]-($qtyitem[$cont]*$costo[$cont]);
                $detalle->save();
                $cont=$cont+1;

            }


            DB::commit();

        }catch (\Exception $e){
            return redirect()->route('checkout-mobile')->with('error', $e->getMessage());

        }

        Session::forget('cart');
        Session::forget('domil');
        return view('finalizar',['data'=>$data]);
        

    }
    
 //   function generateAuthorization($amount, $purchaseNumber, $transactionToken, $token) {
 //       $data = array(
 //           'antifraud' => null,
 //           'captureType' => 'manual',
 //           'channel' => 'web',
 //           'countable' => true,
//            'order' => array(
//                'amount' => $amount,
//                'currency' => 'PEN',
//               'purchaseNumber' => $purchaseNumber,
//                'tokenId' => $transactionToken
//            ),
 //           'recurrence' => null,
//            'sponsored' => null
 //       );
//        $json = json_encode($data);
//
//        $session = json_decode($this->postRequest(Niubiz::VISA_URL_AUTHORIZATION, $json, $token));
//
//        return $session;
//    }

 //   function postRequest($url, $postData, $token) {
 //       $curl = curl_init();
 //       curl_setopt_array($curl, array(
  //          CURLOPT_URL => $url,
 //           CURLOPT_RETURNTRANSFER => true,
 //           CURLOPT_ENCODING => "",
 //           CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 //           CURLOPT_CUSTOMREQUEST => "POST",
 //           CURLOPT_HTTPHEADER => array(
 //               'Authorization: '.$token,
  //              'Content-Type: application/json'
 //           ),
  //          CURLOPT_POSTFIELDS => $postData
  //      ));
//        $response = curl_exec($curl);
//
 //       curl_close($curl);
 //       return $response;
 //   }
    public function generatePurchaseNumber(){
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
    
}
