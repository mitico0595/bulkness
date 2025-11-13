<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Oberlu Admin</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty-mobile.css')}} "> 

        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <link rel="stylesheet" href="{{asset('css/articulo.css')}} ">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">


       <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty.css')}} ">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
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
            margin-left: 150px;
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
 <div style="background-color: #eaeaea;position: relative;width: 100%;min-width:400px; margin: auto;display: block;max-width:700px;margin-top:150px">

		<div class="" style="position: relative;width: 100%; background: #000;padding: 10px;height: 40px">
			<a href="javascript: history.go(-1)" style="float:left;">
                  <img src="{{asset('image/svg/arrow.svg')}} " class="logo1" style="width: 20px;"></a>
			<h3 style="position: relative;font-size: 15px;margin:0px;margin-left: 50px;color:#fff;font-family:'Kanit';float: left; ">EDITAR DETALLE DE ENVIO {{$venta->idventa}}</h3>
			@if (count($errors)>0)
			<div class="">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>


			{!!Form::model($venta,['method'=>'PATCH','route'=>['ingreso.update',$venta->idventa]])!!}
			{{Form::token()}}
		    <input type="text" name ="name" id="name" required value="{{$venta->name}}"  class="form-control" style="display: block"  placeholder="Nombre">
		    <input type="number" name ="dni" id="dni"  value="{{$venta->dni}}"  class="form-control" style="display: block" placeholder="DNI" >
            <input type="text" name ="celular" id="celular" required value="{{$venta->celular}}"  class="form-control" style="display: block" placeholder="Celular" >
		    <input type="text" name ="email" id="email"  value="{{$venta->email}}"  class="form-control" style="display: block" placeholder="e-mail" >
		    <input type="text" name ="domicilio" id="domicilio"  value="{{$venta->domicilio}}"  class="form-control" style="display: block" placeholder="Dirección entrega" >
		    <input type="text" name ="distrito" id="distrito"  value="{{$venta->distrito}}"  class="form-control" style="display: block;width:33%;position:relative;float:left" placeholder="Distrito" >
		    <input type="text" name ="provincia" id="provincia"  value="{{$venta->provincia}}"  class="form-control" style="display: block;width:33%;position:relative;float:left;" placeholder="Provincia" >
		    <input type="text" name ="departamento" id="departamento" value="{{$venta->departamento}}"  class="form-control" style="display: block;width:33%;position:relative;float:left;" placeholder="Departamento" >
		    
		    <button class="" type="submit" style="position: relative;padding: 8px 10px; box-decoration-break: none;border: none;  background: #d2140c;color: #fff;border-radius: 5px; width: 100%;">Guardar</button>
					
			{!!Form::close()!!}
			<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
			

    </div>
</body>
</html>