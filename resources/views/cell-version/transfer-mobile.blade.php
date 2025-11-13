<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@include ('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/checkout-mobile.css')}} ">        
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        
    </head>
<body>
	<div class="sticky-top" style="z-index: 99;">
        <a href="javascript: history.go(-1)" style="float:left;margin-top: 10px;margin-left: 20px;margin-right: 20px;">
                  <img src="{{asset('image/svg/arrow.svg')}} " class="logo1" style="width: 20px;"></a><h2 class="confirm">Confirmacion del pedido</h2>
    </div>
    <form action="{{route('transfer-mobile')}}" method="post" id="checkout-form" style="">
    <div class="address-content">
        <div class="ubicacion-image">
            <img src="{{asset('image/svg/mapi.svg')}} " class="image-ub">
        </div>
        <div class="address-modify">
            <input type="text" name="name" value="{{Auth::user()->name}} {{Auth::user()->lastname}}" style="border:none" readonly id="namo">
            <input type="text" name="dni" value="{{Auth::user()->dni}}" style="border:none" readonly id="dnio">
            <input type="" name="domicilio" value="{{Auth::user()->direccion}}" style="border:none;width: 80%;color:#808080" readonly id="diro">
            <input type="" name="distrito" value="{{ Auth::user()->distrito}}" style="border:none;width: 80%;color:#808080;text-transform: uppercase;font-size: 10px;" readonly id="disto">
            <input type="" name="provincia" value="{{ Auth::user()->provincia}}," style="border:none;width: 80%;color:#808080;text-transform: uppercase;font-size: 10px;display: block;position: relative;float: left;" readonly id="provo"> 
            <input type="" name="ciudad" value=" {{ Auth::user()->ciudad}}" style="border:none;width: 80%;color:#000;text-transform: uppercase;font-size: 12px;display: block;position: relative;float: left;margin-left: -2px;margin-top:8px; font-weight: bold;" readonly id="ciuo">
            <input type="" name="celular" value="+51 {{Auth::user()->cell}}" style="border:none;width: 80%;color:#808080" readonly id="cello">
            <h4 style="position: absolute;text-transform: uppercase;position: absolute;bottom:0px;right:-20px;color:#5fbae8;" onclick="datadat()">Modificar</h4>
        </div>
    </div>
    <div class="address-content" style="margin-top: 10px">
        <div class="ubicacion-image">
            <img src="{{asset('image/svg/debit-card.svg')}} " class="image-ub">
        </div>
        <div class="address-modify">
            <input type="" name="" value="Pago añadido" style="border:none;display: none;font-size: 15px;color: green;text-transform: uppercase;" readonly  id="pay-ss">
            <img src="{{asset('image/svg/visa.svg')}}" style="width: 40px;">
            <img src="{{asset('image/svg/american-express.svg')}}" style="width: 40px;margin-left: 20px;">
            <img src="{{asset('image/svg/tarjeta-mastercard.svg')}}" style="width: 40px;margin-left: 20px;">
            <h4 style="position: absolute;text-transform: uppercase;position: absolute;bottom:0px;right:-20px;color:#5fbae8;" onclick="showcard()">Ver formas de transferencias</h4>
        </div>
    </div>

    <div class="mobile-product">
        @foreach ($searches as $search)
            <div class="each">
            <img src="{{asset('images/'.$search['item']['image'])}} " class="image-b">
            <div class="right-content">
                <div class="title-p">
                    <h4>{{$search['item']['name'] }}</h4>
                    <input type="number" name="idarticulo[]" value="{{$search['item']['id']}}" style="display: none;color:#fff" >
                    <input type="number" name="cantidad[]" value="{{$search['qty']}}" style="display: none;" >
                    <input type="number" name="precio_venta[]" value="{{$search['item']['precio']}}" style="display: none;" >
                </div>
                <div class="categoria">
                    <h5>{{$search['item']['categoria']}}</h5>
                </div>
                <div class="precio">
                    <h6> S/. {{$search['item']['precio']}} </h6>
                </div>
                <div class="subtotal">
                    <h6> SUB-TOTAL: S/. {{number_format($search['precio'],2)}} </h6>
                    <div class="command">
                        <a href="{{route('product.reduceByOne',['id'=>$search['item']['id']])}}" class="less">-</a>
                        <div class="qtyty">{{$search['qty']}}</div>
                        <a href="{{route('product.addToCart',['id'=>$search['item']['id']])}}" class="plus">+</a>
                    </div>
                </div>
                
            </div>
            </div>
        @endforeach
    </div>
    <div class="address-content" style="margin-top: 10px">
        <div class="ubicacion-image">
            <img src="{{asset('image/svg/edit.svg')}} " class="image-ub">
        </div>
        <div class="address-modify">
            <span style="color:#808080">Nota:</span> <input type="" name="nota" value="" placeholder="Escribir nota para LUZAPAY" style="padding: 5px; margin-left: 10px;width: 100%;margin-top: 10px;border:none; border-bottom: 1px solid #282828;" autocomplete="off" >            
        
        </div>
    </div>
    <div class="address-content" style="margin-top: 10px;margin-bottom: 60px;">
        <div class="ubicacion-image" style="width: 100%;">
            Resumen del pedido: ({{Session::has('cart') ? Session::get('cart')->totalQty : '0' }} artículos)
        </div>
        <div class="address-modify" style="width: 100%;display: inline-block;">
           <div class="detail-resume"  id="card-lima">
                <div class="left-resume">
                    <div class="">Total parcial:</div>
                    <div class="">Sin cargos:</div>
                    <div class="">Envio:</div>
                    <div style="font-weight: bold;">Cantidad final:</div>
                </div>
                <div class="right-resume">
                    <div class="">S/. {{number_format($totalProduct,2)}}</div>
                    <div class="">S/. 0.00</div>
                    <div class="">S/. 0.00</div>
                    <div class="" style="font-weight: bold;">S/. {{number_format($total,2)}}</div>
                </div>
                <input type="text" name="option_select" value="Envio - 10.00" id="tipo_venta" style="display: none;">
            <input type="number" name="cargos" value="00.00" id="tipo_venta" style="display: none;">
            <input type="text" name="tipo_venta" value="Transferencia" id="tipo_venta" style="display: none;">
            <input type="number" name="shcost" value="00.00" id="shcost" style="display: none;">
            <input type="text" name="total_pago" value="{{$total}} " id="total_pago" style="display: none;">
            <input type="text" name="lat" value="" id="idlat" style="display: none;"><input type="text" name="lon" value="" id="idlon" style="display: none;">
                <input type="text" name="ipid" value="" id="ipcon" style="display: none;">  
            </div>           
            
        </div>
        <div style="width:100%; padding:5px 10px;background: #e0e0e0; display: inline-block; font-size: 12px">
            Al hacer clic en PAGAR o HACER PEDIDO, confirmo haber leído <a href=""><span>los términos y condiciones</span></a>
        </div>
    </div>
    <!-- DATA SENDE----------------------------------------->

    <div style="height: 100vh;background: white;width: 100%;position: fixed;z-index: 99;top:0px;left: 0px;display: none" id="data-send">
        <div class="sticky-top" style="z-index: 99;">
        <h2 class="confirm">Editar Direccion</h2>
        </div>
        <div style="width: 90%;position: relative;margin: auto;display: block;padding: 10px;margin-top: 50px;">
        <div style="width: 100%;position: relative;margin-top: 50px;">
            <input type="text" name="" value="{{Auth::user()->name}} {{Auth::user()->lastname}}" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;"  onchange="namefunc()" id="namesub" >
            <input type="text" name="" value="{{Auth::user()->dni}}" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px"  onchange="dnifunc()" id="dnisub" >
            <input type="text" name="" value="{{Auth::user()->cell}} " style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px;"  onchange="cellfunc()" id="cellsub" >
            <input type="text" name="" value="{{Auth::user()->direccion}} " style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px;"  onchange="dirfunc()" id="dirsub" >
            <input type="text" name="" value="" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px;"  onchange="distfunc()" id="distsub" placeholder="Distrito" >
            <input type="text" name="" value="" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px;"  onchange="provfunc()" id="provsub" placeholder="Provincia" >
            <input type="text" name="" value="" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px;"  onchange="ciufunc()" id="ciusub" placeholder="Departamento" >
        </div>
        </div>

        <h5 style="position: absolute;bottom:0px; width: 80%;left:10%;padding: 10px;text-align: center; font-size: 20px;background: #282828;border-radius: 10px; color: #fff;" onclick="closedata()">Guardar</h5>
    </div>
    <div style="height: 100vh;background: white;width: 100%;position: fixed;z-index: 99;top:0px;left: 0px;display: none" id="card-send">
        <div class="sticky-top" style="z-index: 99;">
        <h2 class="confirm">Formas de transferencia</h2>
        </div>
        <div style="width: 100%;position: relative;float:left;display: inline-block;height: 240px;border-radius: 10px;margin-top: 65px;">
                        <h2 style="padding-left:20px;margin:0px;padding-top: 10px;font-size: 15px;font-weight: 100;font-family: 'Dosis' ">Transferencias Debito y alternativos</h2>
                        <img src="{{asset('image/svg/tarjeta-de-credito.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
                        <img src="{{asset('image/svg/visa.svg')}} " style="width:40px;position: absolute;right: 60px;top:5px;">
                        <img src="{{asset('image/svg/tarjeta-mastercard.svg')}} " style="width:30px;position: absolute;right: 110px;top:10px;">
                        <img src="{{asset('image/svg/american-express.svg')}} " style="width:30px;position: absolute;right: 150px;top:10px;">
                        <div style="position: relative;width: 100%;display: inline-block;padding-left:20px;padding-right: 20px;box-sizing: border-box;"><p style="width:100%;text-align: justify;line-height: 15px;font-size: 15px;padding-top: 35px;">Efectue el pago mediante transferencia de forma segura, aceptamos transferencia desde BCP, Interbank, BBVA, Scotiabank y aceptamos metodos alternativos los cuales son: Yape y Plin dede contactarse al siguiente número (965 258 365) por whatsapp haga click en el siguiente botón:</p></div>
                       
                        <a href="" style="position:relative;margin:auto;width: 70%;text-align: center;color:white;background: #019900;font-size: 18px;line-height: 20px;display: block;padding: 7px;border-radius: 5px;margin-top: 10px;">Whatsapp</a>
                        
                        
                        
                        
                        

                       
        </div>
        <h5 style="position: absolute;bottom:30px; width: 80%;left:10%;padding: 10px;text-align: center; font-size: 20px;background: #282828;border-radius: 10px; color: #fff;" onclick="datacard()">Listo</h5>
    </div>
    <!-- ------------------------------------------>

    <div style="position: fixed; bottom:0px;width: 100%;background: white;height: 50px;">
        <div style="color:black;position: relative;display: inline-block;float: left;margin-top: 15px;margin-left: 15px;"><span style="font-weight: bold;">PEN</span> S/. {{number_format($total,2)}} </div>
        {{ csrf_field() }}
        <button type="submit" style="position:absolute; padding: 5px 10px; width: 150px;background: #a305fa;color:white;right: 15px;top:10px;font-family: 'Kanit';text-align: center; " >
            HACER PEDIDO
        </button>
    </div>

    </form>
    <script src="{{asset('js/jquery.min.js')}} "></script>
   
    <script type="text/javascript">
        function namefunc(){
            document.getElementById('namo').value = document.getElementById('namesub').value;
        }
        function dnifunc(){
            document.getElementById('dnio').value = document.getElementById('dnisub').value;
        }
        function cellfunc(){
            document.getElementById('cello').value = document.getElementById('cellsub').value;
        }
        function dirfunc(){
            document.getElementById('diro').value = document.getElementById('dirsub').value;
        }
        function distfunc(){
            document.getElementById('disto').value = document.getElementById('distsub').value;
        }
        function provfunc(){
            document.getElementById('provo').value = document.getElementById('provsub').value;
        }
        function ciufunc(){
            document.getElementById('ciuo').value = document.getElementById('ciusub').value;
        }
        function datadat(){
            document.getElementById('data-send').style.display= "block";
        }
        function closedata(){
            document.getElementById('data-send').style.display= "none";
        }
        function datacard(){
            document.getElementById('card-send').style.display= "none";
            document.getElementById('pay-ss').style.display= "block";
        }
        function showcard(){
            document.getElementById('card-send').style.display= "block";
        }
    </script>
   
</body>
</html>