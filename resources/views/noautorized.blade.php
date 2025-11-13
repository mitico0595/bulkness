<!DOCTYPE html>
<html>
<head>
	<title>@include ('title')</title>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:ital@1&display=swap" rel="stylesheet">
</head>
<body>
	<style type="text/css">
		body {
			margin:0;
			width:100%;
			height: 100%;

		}
		.content{
			width:100%;
			height:25%;

		}
		.subcontent{
			width:50%;
			background: #f6f6f6;
			border-radius: 5px;
			border:1px solid #dedede;
			margin: auto;
			margin-top: 10%;
			padding: 20px;
		}
		img {
			width: 250px;
			margin:auto;
		}
		.message {
			text-align: center;
			font-size: 25px;
			font-family: 'Raleway';
			text-transform: uppercase;
		}
		.boton {
			text-decoration: none;
			padding: 5px 30px;
			font-family: 'Raleway';
			font-size: 20px;
			text-align: center;
			background: #282828;
			color:#fff;
			display: block;
			border:2px solid #282828;
			transition: .5s;
			border-radius: 5px;
			width:20%;
			margin:auto;
		}
		.boton:hover{
			background: #fff;
			color:#282828;
			text-decoration: none;
			border: 2px solid #282828;
		}
	</style>
	<div class="content">
		<div class="subcontent">
			<div align="center">
			<img src="{{asset('image/logo1.png')}}">
			<img src="{{asset('image/danger.png')}} " style="width:80px;margin-left: -20px;">
			</div>
			<h1 class="message">Usted no está autorizado. Ingrese con otras credenciales.</h1>
			<a class="boton" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
        </form>
		</div>
		
	</div>
	 

</body>
</html>