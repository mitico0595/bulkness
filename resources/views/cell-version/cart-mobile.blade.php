<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@include ('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/cart-mobile.css')}} ">
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">

    </head>
<body>
@if(Session::has('cart'))
	<div class="sticky-top" style="z-index: 99;">
		<h2 class="cesta">Cesta ({{Session::has('cart') ? Session::get('cart')->totalQty : '0' }})</h2>
	</div>

	<div class="mobile-product">
		@foreach ($searches as $search)
			<div class="each">
			<img src="{{asset('images/'.$search['item']['image'])}} " class="image-b">
			<div class="right-content">
				<div class="title-p">
					<h4>{{$search['item']['name'] }} </h4>
				</div>
				<div class="categoria">
					<h5>{{$search['item']['categoria'] }}</h5>
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
				<a href="{{route('product.remove',['id'=>$search['item']['id']])}}" style="position: absolute;width:15px;right:5px;top:0px;"><img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 100%;"></a>
			</div>
			</div>
		@endforeach
	</div>
	<div class="total-b" style="z-index: 999;">
		<select name="select-option"  id="selectid" class="option-select" onchange="jsfunc1()" >
						<option value="0">Seleccione una opcion</option>
						<option value="1">Pago con tarjeta + Envio Lima</option>
						<option value="2">Pago con tarjeta + Envio Provincia</option>
						<option value="3">Realizar pedido</option>
		</select>
		<h5 class="precio-transfer" onclick="desliz1()" id="default"> S/. 0.00 <img src="{{asset('image/svg/up-arrow.svg')}}" style="width:13px;transform: rotate(180deg);" ></h5>
		<h5 class="precio-transfer" onclick="desliz1()" style="display: none" id="card-lima-total"> S/. {{number_format($totalPrecio,2)}} <img src="{{asset('image/svg/up-arrow.svg')}}" style="width:13px;transform: rotate(180deg);" ></h5>
		<h5 class="precio-transfer" onclick="desliz1()" style="display: none" id="card-prov-total"> S/. {{number_format($totalPrecioProv,2)}} <img src="{{asset('image/svg/up-arrow.svg')}}" style="width:13px;transform: rotate(180deg);" ></h5>
		<h5 class="precio-transfer" onclick="desliz1()" style="display: none" id="transfer-total"> S/. {{number_format($transfer,2)}} <img src="{{asset('image/svg/up-arrow.svg')}}" style="width:13px;transform: rotate(180deg);" ></h5>

		<a  class="button-pay" style="background: #808080" id="default-pay">Pagar</a>
		<a href="{{url('pagos-mobile')}} " class="button-pay" style="background: #b10000;display: none" id="lima-pay" >Pagar</a>
		<a href="{{url('pagas-mobile')}} " class="button-pay" style="background: #b10000;display: none" id="prov-pay" >Pagar</a>
		<div id="trans-pay" style="display:none;">
		@if( (Auth::check() == true) && (Auth::user()->verify == "1")  )
		<a href="{{route('transfer-mobile')}}" class="button-pay" style="background: #b10000;"  >Ordenar</a>
		@else
		<a  class="button-pay" style="background: #b10000;font-size: 15px;"  onclick="ordenar()">Ordenar</a>
		@endif
		</div>
	</div>
	<div style="position:absolute; width: 100%; height:100vh; top:0px;left:0px;background:rgba(0,0,0,.3);display: none;" id="ordenar">
		<div style="position:absolute; width:100%;top:200px;left:0px;">
			<div style="position:relative;display: block;margin: 0px;padding: 20px;box-sizing: border-box;">
				<div style="position:relative;width: 70%;background: white;display: block; margin: auto;padding-bottom: 10px;padding-top: 20px;">
					<h5 style="font-size: 14px;color:black;text-align:justify;font-family: 'Kanit';padding: 10px;line-height: 15px;font-weight: 100;"> No puede realizar ordenes, debe iniciar sesión. Si la sesión fue iniciada debe contactarse con soporte para verificar su perfil, todo procedimiento es por la seguridad del cliente.</h5>
					<h5 style="font-size: 14px;color:black;text-align:justify;font-family: 'Kanit';padding: 10px;line-height: 15px;font-weight: 100;">Contactese al (+51) 983 814 992 o haga click aquí: </h5>
					<a href="https://wa.me/message/TFPQK4IEKVTFH1" style="position:relative;margin:auto;width: 70%;text-align: center;color:white;background: #019900;font-size: 18px;line-height: 20px;display: block;padding: 7px;border-radius: 5px;margin-top: 10px;">Whatsapp</a>
					<div style="width:50%;border:2px solid black; border-radius: 5px; background:none; color: black;text-align: center;margin-left: 25%;margin-bottom: 10px;margin-top: 20px;" onclick="order_close()">Cerrar</div>
				</div>
			</div>
		</div>
	</div>
	<div class="resume" style="z-index: 100;display: none;" id="back-black">
	</div>
		<div class="sub-resume" style="padding-bottom: 20px;z-index: 100;bottom:-100px;border-radius:5px;" id="desliz1" >
			<div class="resume-title">Resumen
				<a  style="position: absolute;width:15px;right:10px;top:10px;"><img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 100%;" onclick="closec()"></a>
			</div>
			<div class="detail-resume" style="display: none" id="defaults">
				<div class="left-resume">

				</div>
				<div class="right-resume">

				</div>
			</div>
			<div class="detail-resume" style="display: none" id="transferencia">
				<div class="left-resume">
					<div class="">Total parcial</div>
					<div class="">Sin cargos</div>
					<div class="">Envio</div>
				</div>
				<div class="right-resume">
					<div class="">S/. {{number_format($totalPrice,2)}}</div>
					<div class="">S/. 0.00</div>
					<div class="">S/. 0.00</div>
				</div>
			</div>
			<div class="detail-resume" style="display: none" id="card-lima">
				<div class="left-resume">
					<div class="">Total parcial</div>
					<div class="">Cargos 0,01%</div>
					<div class="">Envio</div>
				</div>
				<div class="right-resume">
					<div class="">S/. {{number_format($totalPrice,2)}}</div>
					<div class="">S/. 0.00</div>
					<div class="">S/. 10.00</div>
				</div>
			</div>
			<div class="detail-resume" style="display: none" id="card-prov">
				<div class="left-resume">
					<div class="">Total parcial</div>
					<div class="">Cargos 2,99%</div>
					<div class="">Envio</div>
				</div>
				<div class="right-resume">
					<div class="">S/. {{number_format($totalPrice,2)}}</div>
					<div class="">S/. 0.00</div>
					<div class="">S/. 14.90</div>
				</div>
			</div>
		</div>




	@else
	<div style="width: 95%;position: relative;display: block;margin: auto;margin-top: 100px;padding: 20px;border-radius: 10px;border:1px solid #cecece;box-shadow: 1px 1px 3px #a9a9a9;background: #fff">
			<img src="{{asset('image/bolsa.png')}} " style="width: 200px;position: relative;display: block;margin: auto;">
			<h3 style="color:#b10000;font-size: 25px;font-family: 'Dosis';font-weight: 100;width: 100%;text-align: center;padding-top: 10px;line-height: 25px;text-shadow: 0 0px 5px inset #808080 ">UPS!! No hay productos en la cesta...</h3>
			<a href="{{url('cell-version')}} " style="width:80%;position: relative;padding: 10px 5px;margin: auto;display: block;background:#b10000;text-align: center;border-radius: 10px;margin-top: 20px;color:#fff; " class="butt">CONTINUAR COMPRANDO</a>
		</div>
	@endif
	<div class="allforall" style="z-index: 999;">
            <div class="suball">
                <div class="subbase">
               <a href="{{url('/')}} "> <img class="usuario" src="{{asset('image/svg/hogar.svg')}} "></a>
                <h6 >Home</h6>
                </div>
                <div class="subbase">
                <img class="usuario" src="{{asset('image/svg/barmenu.svg')}} " style="padding:5px;">
                <h6>Categorias</h6>
                </div>
                <div class="subbase">
                <img class="usuario" src="{{asset('image/svg/carro-purple.svg')}} ">
                <h6 style="color:#b10000;">Cart</h6>
                </div>
                <div class="subbase">
                <a href="{{url('index-profile')}} "><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                <h6 >Mi cuenta</h6>
                </div>
            </div>
	</div>
	<script type="text/javascript">
		function desliz1(){
			document.getElementById('desliz1').style.bottom ="120px";
			document.getElementById('back-black').style.display ="block";
		}
		function closec(){
			document.getElementById('desliz1').style.bottom ="-100px";
			document.getElementById('back-black').style.display ="none";
		}
		function ordenar(){
			document.getElementById('ordenar').style.display ="block";
		}
		function order_close(){
			document.getElementById('ordenar').style.display ="none";
		}
		function jsfunc1(){
		if(document.getElementById('selectid').value == "0"){
			document.getElementById('default').style.display ="block";
			document.getElementById('defaults').style.display ="block";
			document.getElementById('default-pay').style.display ="block";
			document.getElementById('card-lima-total').style.display ="none";
			document.getElementById('card-lima').style.display ="none";
			document.getElementById('lima-pay').style.display ="none";
			document.getElementById('card-prov-total').style.display ="none";
			document.getElementById('card-prov').style.display ="none";
			document.getElementById('prov-pay').style.display ="none";
			document.getElementById('transfer-total').style.display ="none";
			document.getElementById('transferencia').style.display ="none";
			document.getElementById('trans-pay').style.display ="none";
		}
		if(document.getElementById('selectid').value == "1"){
			document.getElementById('default').style.display ="none";
			document.getElementById('defaults').style.display ="none";
			document.getElementById('default-pay').style.display ="none";
			document.getElementById('card-lima-total').style.display ="block";
			document.getElementById('card-lima').style.display ="block";
			document.getElementById('lima-pay').style.display ="block";
			document.getElementById('card-prov-total').style.display ="none";
			document.getElementById('card-prov').style.display ="none";
			document.getElementById('prov-pay').style.display ="none";
			document.getElementById('transfer-total').style.display ="none";
			document.getElementById('transferencia').style.display ="none";
			document.getElementById('trans-pay').style.display ="none";
		}

		if(document.getElementById('selectid').value == "2"){
			document.getElementById('default').style.display ="none";
			document.getElementById('defaults').style.display ="none";
			document.getElementById('default-pay').style.display ="none";
			document.getElementById('card-lima-total').style.display ="none";
			document.getElementById('card-lima').style.display ="none";
			document.getElementById('lima-pay').style.display ="none";
			document.getElementById('card-prov-total').style.display ="block";
			document.getElementById('card-prov').style.display ="block";
			document.getElementById('prov-pay').style.display ="block";
			document.getElementById('transfer-total').style.display ="none";
			document.getElementById('transferencia').style.display ="none";
			document.getElementById('trans-pay').style.display ="none";
		}
		if(document.getElementById('selectid').value == "3"){
			document.getElementById('default').style.display ="none";
			document.getElementById('defaults').style.display ="none";
			document.getElementById('default-pay').style.display ="none";
			document.getElementById('card-lima-total').style.display ="none";
			document.getElementById('card-lima').style.display ="none";
			document.getElementById('lima-pay').style.display ="none";
			document.getElementById('card-prov-total').style.display ="none";
			document.getElementById('card-prov').style.display ="none";
			document.getElementById('prov-pay').style.display ="none";
			document.getElementById('transfer-total').style.display ="block";
			document.getElementById('transferencia').style.display ="block";
			document.getElementById('trans-pay').style.display ="block";
		}
	}
	</script>
</body>

</html>
