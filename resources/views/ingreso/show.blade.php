
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 
    <style type="text/css">
    	.co{
    		margin-top: 50px;
    	}
    	.co p{
    		margin:0px;
    	}
		h6{
			margin:0px;
		}
		body{
		    background:#e53d3d;
		}
    </style>


<div style="position:relative;width:1000px; margin:auto;display:block;margin-top:20px;box-shadow: 1px 2px 2px #ccc;margin-bottom:20px;background:white">
	<div style="position:relative;display:block;width:100%"> 
		<img src="{{asset('image/facturatop.jpg') }} " alt="" style="width:100%">
		<h5 style="position:absolute;bottom:-25px;right:145px;font-size:17px;font-weight:300;z-index:9999">NV: 01-00{{$venta->idventa}}</h5>
	</div>
	<div style="position:relative;display:flex;width:100%;background:white"> 
		<div style="position:relative;display:flex;width:625px;padding:30px;padding-top:50px"> 
			<div style="position:relative;float:left;width:20%">
				<h6 style="font-size:15px;">Nombre:</h6>
				<h6 style="font-size:15px;">Correo:</h6>
				<h6 style="font-size:15px;">D.N.I.:</h6>
				<h6 style="font-size:15px;">Celular:</h6>
				<h6 style="font-size:15px;">Ciudad:</h6>
				<h6 style="font-size:15px;">Direccion:</h6>
			</div>
			<div style="position:relative;float:left;width:80%;">
				<h6 style="font-size:15px;">{{$venta->name}} {{$venta->lastname}}</h6>
				<h6 style="font-size:15px;">{{$venta->email ?? 'no found'}}</h6>
				<h6 style="font-size:15px;">{{$venta->dni}}</h6>
				<h6 style="font-size:15px;">{{$venta->cell}}</h6>
				<h6 style="font-size:15px;">{{$venta->distrito ?? 'no found'}} / {{$venta->provincia ?? ' '}}</h6>
				<h6 style="font-size:15px;">{{$venta->domicilio}}</h6>
			</div>
		</div>
		<div style="position:relative;display:flex;width:375px;justify-content:center;align-items:center"> 
			<div style="position:relative;float:left;width:50%">
				<h6 style="font-size:15px;color:#d2140c">NUMERO DE VENTA:</h6>
				<h6 style="font-size:15px;color:#d2140c">FECHA:</h6>
				
			</div>
			<div style="position:relative;float:left;width:50%;">
				<h6 style="font-size:15px;color:#d2140c">{{$venta->purchaseNumber ?? '00-00'}}</h6>
				<h6 style="font-size:15px;color:#d2140c">{{$venta->fecha}}</h6>
				
			</div>
			<div style="position:absolute;height:50px;width:8px;border-radius:5px;background:#d2140c;left:-25px;">

			</div>
		</div>


	</div>
	<div style="position:relative;width:940px;margin:auto;display:block;margin-top:40px;background:white">
		<div style="position:relative;display:flex;width:100%;border-bottom:2px solid #e7e7e7;margin-bottom:20px;">			
			<h5 style="width:80px;text-align:center;">Cantidad</h5>
			<h5 style="width:470px;padding-left:50px;">Descripcion</h5>
			<h5 style="width:90px;text-align:center;">Precio</h5>
			<h5 style="width:300px;padding-left:180px;text-align:center">Subtotal</h5>
		</div>
		@foreach($detalles as $det) 
		<div style="position:relative;display:flex;width:100%;">			
			<h5 style="width:80px;text-align:center;">{{number_format( $det->cantidad,0)}}</h5>
			<h5 style="width:470px;padding-left:50px;">{{$det->articulo}}</h5>
			<h5 style="width:90px;text-align:center;">S/. {{number_format($det->precio_venta,2)}}</h5>
			<h5 style="width:300px;padding-left:180px;text-align:center">S/. {{number_format($det->cantidad*$det->precio_venta,2)}}</h5>
		</div>
		@endforeach
		
		<div style="position:relative;display:flex;width:100%;border-top:2px solid #e7e7e7;margin-top:20px;">			
			<h5 style="width:80px;text-align:center;"></h5>
			<h5 style="width:465px;padding-left:50px;"></h5>
			<h5 style="width:130px;text-align:center;">Gastos logisticos</h5>
			<h5 style="width:270px;padding-left:15%;text-align:center">S/. {{number_format($venta->total_venta - $submont,2)}}</h5>
		</div>
		<div style="position:relative;display:flex;width:100%;">
			<div style="position:absolute;width:370px;height:30px;right:-30px;background:#d2140c;top:10px">
			
			</div>
				<h5 style="width:80px;text-align:center;"></h5>
				<h5 style="width:465px;padding-left:50px;"></h5>
				<h5 style="width:130px;text-align:center;z-index:1;color:white;padding:5px 20px;font-size:18px;padding-left:80px">TOTAL</h5>
				<h5 style="width:270px;padding-left:15%;text-align:center;z-index:1;color:white;padding-top:5px;font-size:18px">S/. {{$venta->total_venta}} </h5>
				<div style="position:absolute;width:370px;height:40px;right:-30px;background:#d2140c;top:2px;z-index:-1"></div>
				<div style="position:absolute;height:40px;width:8px;border-radius:5px;background:#d2140c;right:350px;top:2px">

				</div>
		</div>
		<div style="position:relative;display:flex;width:100%;">			
			<h5 style="width:80px;text-align:center;"></h5>
			<h5 style="width:465px;padding-left:50px;margin-top:-20px">Verificador unico de documento</h5>
			<h5 style="width:130px;text-align:center;"></h5>
			<h5 style="width:270px;padding-left:15%;text-align:center"></h5>
		</div>
		<div style="position:relative;display:flex;width:100%;margin-top:20px">			
			<h5 style="width:80px;text-align:center;"></h5>
			<h5 style="width:465px;padding-left:82px;margin-top:-20px;"><img src="{{ asset('image/qrcode.png') }} " alt="" style="width:120px;"></h5>
			<h5 style="width:130px;text-align:center;"></h5>
			<h5 style="width:270px;padding-left:15%;text-align:center"></h5>
		</div>
		<div style="position:relative;display:flex;width:100%;margin-top:50px;margin-left:-80px;margin-top:100px;">			
			<h5 style="width:80px;text-align:center;"></h5>
			<h5 style="width:500px;padding-left:50px;margin-top:-20px;color:#d2140c;  ">Terminos y condiciones</h5>
			<h5 style="width:150px;margin-top:-20px;color:#d2140c;padding-left:100px;   ">Contacto</h5>
			<h5 style="width:70px;padding-left:15%;text-align:center"></h5>
		</div>
		<div style="position:relative;display:flex;width:100%;margin-top:0px;margin-left:-80px;margin-bottom:30px;">			
			<h5 style="width:80px;text-align:center;"></h5>
			<h5 style="width:500px;padding-left:50px;margin-top:-20px;color:#808080;font-size:13px; ">Las propiedades de uso del presente documento, asi como su validez esta sujeto a los terminos y condiciones de oberlu.com.</h5>
			<h5 style="width:150px;margin-top:-20px;color:#808080;font-size:13px;padding-left:100px; ">www.oberlu.com/soporte</h5>
			<h5 style="width:70px;padding-left:15%;text-align:center"></h5>
		</div>
	</div>


</div>


	
