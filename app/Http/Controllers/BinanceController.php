<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Niubiz;
use Carbon\Carbon;
use App\Cart;
use App\Venta;
use App\DetalleVenta;
use Session;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;

class BinanceController extends Controller
{




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


    function binancePostPay(Request $request){
        if(!Session::has('cart')){
            return redirect()->route('item');
        }
        $oldCart = Session::get('cart');
        $cart= new Cart($oldCart);
        $searches = $cart->items;
        $amount = $cart->BpriceLocal;
        $purchaseNumber = $this->generatePurchaseNumber();
        $result = $this->binancePay($purchaseNumber,$amount);
        $qr=$result['data']["qrcodeLink"];
        $checkoutUrl=$result['data']["checkoutUrl"];

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
            $venta->codigo = $purchaseNumber; //
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
            return redirect()->route('checkout')->with('error', $e->getMessage());

        }

        Session::forget('cart');
        return Redirect::to($checkoutUrl);

    }

    function binancePay($purchaseNumber,$amount){
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
            "goodsName"=>"Tableta",
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

    function exitoso($id){
        return view ('binance.index', ['id'=>$id]);
    }

    function finalizar (Request $request){
        $amount = 1;
        $purchaseNumber= 415415747;

        $transactionToken = $request->post('transactionToken');

        $token = $this->generateToken();

        $data = $this->generateAuthorization($amount, $purchaseNumber, $transactionToken, $token);
        dd($data);
        return $request;

    }
    function generateSesion($amount, $token) {
        $session = array(
            'amount' => $amount,
            'antifraud' => array(
                'clientIp' => $_SERVER['REMOTE_ADDR'],
                'merchantDefineData' => array(
                    'MDD4' => "mail@domain.com",
                    'MDD33' => "DNI",
                    'MDD34' => '87654321'
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
        $archivo = '\txt\purchaseNumber.txt';
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
}
