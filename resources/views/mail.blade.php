<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style type="text/css">
        .logo{
            position: relative;
            float: left;
            width:20%;
            box-sizing: border-box;
            display: inline-block;
        }
        .logo1{
            position: absolute;
            width:80px;
            top:12px;
        }
        body{
      background: #ededed;
   	 	}
   	 	.search{

   	 	}.button{
   	 		line-height: 42px;
   	 	}
   	 	.input-field{
   	 		top:22px;
   	 	}
   	 	a{
   	 		text-decoration: none;
   	 	}
    </style>
</head>
<body>
<div style="margin:0 auto;min-width:480px;max-width:600px;background:white;margin-top:20px;">
    <div style="position:relative;display:block">
        <img src="{{asset('image/mail/topi.jpg')}} " alt="" style="position:relative;width:100%;max-width:600px;">
    </div>
    <div style="position:relative;display:block;max-width:550px;margin:auto;border: 1px solid #f6f6f6;padding:20px">
         <div style="border-left: 3px solid #ea2323;position: relative;display: block;margin-bottom: 14px;padding-bottom: 12px;background: #fff;box-shadow: 0 1px 2px 0 rgb(0 0 0 / 24%);">

            <div  style="height: 72px;background: #fff; width: 100%;padding: 16px 16px;font-size: 14px; border-bottom: 1px solid #ebebec;box-sizing: border-box;position: relative;">
                <div  style="line-height: 20px;color: #000;">
                    <span style="color:#898b92">Numero de orden: </span>00{{$order->id}}
                </div>
                <div style="line-height: 20px;color: #000;">
                    <span style="color:#898b92">Fecha de pedido: </span>{{$order->fecha}}
                </div>
              
            </div>

           @foreach($order as $det)
            <a href="{{asset('busco/'.$det->idarticulo)}}">
          <div style="height: 132px;display: flex;align-items: center; border-bottom: 1px solid #ebebec;">
               <div style="height: 100px;float: left;margin: 0 16px;">
                   <img  src="{{asset('images/'.$det->image)}}"  style="width: 100px;height: 100px;">
               </div>
               <div class="right-parte">
                   <div class="order-title" style="color: #3a3e4a;letter-spacing: 0;line-height: 20px;display: -webkit-box;-webkit-line-clamp: 2; -webkit-box-orient: vertical;overflow: hidden;font-size: 14px;padding: 0 4px 4px 0;">
                       {{ $det->articulo}}
                   </div>
                   <div  style="line-height: 20px;display: -webkit-box;color: #b0b2b7;letter-spacing: 0;">
                       {{$det->code }}
                   </div>
                   <div  style="color: #3a3e4a; line-height: 16px; margin-top: 8px;font-weight: 600;">
                       S/. {{ $det->precio_venta}} x{{ number_format($det->cantidad,0) }}
                   </div>



               </div>

           </div>
        </a>

           @endforeach
           <div class="total-cancelado" style="padding: 16px 16px 0 16px;font-size: 14px;">
               <div class="total-detalle" style="    line-height: 18px;color: #b10000;margin-bottom: 5px;">
                   <span style="font-size: 18px;">Monto Total:</span><span style="float: right; margin-right: 8px;font-weight: bold;font-size: 20px;">S/. {{ number_format($order->total,2) }}</span>
               </div>
           </div>
          <div style="width: 100%;position: relative;">
              <div style="width: 85%;position: relative;display: block;margin: auto;margin-top: 10px;">
                <a href= "" style="width:250px;padding: 3px;position: relative;margin: auto;display: block;text-align: center;background: #ba1f1f; color:#fff;text-decoration: none;border-radius: 5px;line-height: 20px;">Ver detalle</a>
              </div>
          </div>
       </div>


    </div>
    <div style="position: relative;margin:auto;display:block;max-width:550px;margin-top:20px;margin-bottom:30px">
        
        @if ($order->tipo_venta =="BINANCE_PAY")
        <a href="{{$order->checkout}}">
        <img src="{{asset('image/mail/binancepay.jpg')}} " alt="" style="width: 100%;position:relative;max-width:600px;">
        </a>
        @else
        <a href="{{url('pagos/'.$order->purchaseNumber)}}">
        <img src="{{asset('image/mail/izipay.jpg')}} " alt="" style="width: 100%;position:relative;max-width:600px;">
        </a>
        @endif
        
    </div>
    <div style="position:relative;background:#f7f7f7;max-width:600px;display:block;margin:auto;padding-top:20px;padding-bottom:20px;">
        <div class="social-media" style="width: 180px;margin:auto;display:block;">
            <a href="https://www.facebook.com/oberlu"><img src=" {{asset('image/facebook.png')}}" style="width:30px ;margin-left:10px;"></a>
            <a href=""><img src=" {{asset('image/instagram.png')}}" style="width:30px ;margin-left:10px;"></a>
            <a href=""><img src=" {{asset('image/youtube.png')}}" style="width:30px;margin-left:10px;"></a>
            <a href="https://wa.me/51983814992"><img src=" {{asset('image/whatsapp1.png')}}" style="width:30px ;margin-left:10px;"></a>
        </div>
        <div style="max-width: 600px;padding:25px;color:#808080;margin-bottom:20px;">
            <h6>TODOS LOS DERECHOS RESERVADOS OBERLU.COM 2016-2022.</h6>
            <h6>TODA INFORMACION PROPORCIONADA POR OBERLU.COM ESTA ESTRICTAMENTE RESTRINGIDA POR LOS TERMINOS Y
                CONDICIONES, PUEDE VERIFICAR LA INFORMACION EN WWW.OBERLU.COM/TERMINOS/USO</h6>
        </div>
    </div>
</div>
</body>
</html>

