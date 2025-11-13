<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        @include ('global.icon')
        
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset ('css/app.css')}}" >
        <style type="text/css">
        	*{
        		list-style: none;
            text-decoration: none;
			margin:0
        	}
        	.activecolor{
        		color:#b10000;
        		font-weight: bold;
        	}
        	.inactivecolor{
        		color:#808080;
        	}
          .names a:hover{
            text-decoration: none;
          }
        </style>
        
        
    </head>
    <body>
    	<div @if (request()->is('app')) style="height: 75px; width: 100%;position: fixed;background: #b10000;top:0px;z-index: 11;" @else style="height: 75px; width: 100%;position: absolute;background: #b10000;top:0px;z-index: 11;" @endif >
    		<a href="{{url('/')}} "><img src="{{asset('image/logo1_BN.png')}} " class="logo1" style="width:100px;margin-left:25px;margin-top:10px"></a>
    		<div style="position: relative;float:right;display: inline-block;width:250px;">
    		
			<div  style="display:flex;align-items:center;justify-content:center;flex-direction:column;height:75px;">
		  		<h3 style="font-size:15px;">Bienvenido</h3>
				<h1 style="font-size: 12px;font-weight: 100;text-align: center;color: #fff;" >{{ Auth::user()->lastname }}, {{ Auth::user()->name }}  </h1>  		
			
    		</div>
			</div>
    	</div>
    	<div  style="position: fixed;width:250px;height: 100vh;top:0px;transition: .5s;z-index: 10;display: none;background: none;"  id="coall" onmouseover="over()" id="all" onmouseout="out()" class="names">
    		<div style="margin-top: 97px;margin-left: 60px;opacity: 1;transition: 1s;height: 80px;font-weight: 500;color:#b7b7b7" id="topi" >
    			Mi cuenta
        		
              
        	</div>
        	<div style="position: relative;margin-left: 17px;"><a href="{{url('app')}}" style="color:#808080;margin-left: 40px;">Home</a></div>
        	<div style="position: relative;margin-left: 17px;margin-top: 30px;"><a style="color:#808080;margin-left: 40px;cursor: pointer;">Inversion</a></div>
        	<div style="position: relative;margin-left: 17px;margin-top: 5px;"><a href="{{url('almacen')}}" @if (request()->is('almacen')) class="activecolor" @else class="inactivecolor" @endif  style="margin-left: 40px;cursor: pointer;">Compras</a></div>
        	<div style="position: relative;margin-left: 17px;margin-top: 0px;"><a   href="{{url('articulo')}}" @if (request()->is('articulo')) class="activecolor" @else class="inactivecolor" @endif style="margin-left: 40px;cursor: pointer;">Productos</a></div>
            <div style="position: relative;margin-left: 17px;margin-top: 0px;"><a   href="{{url('tiendas')}}" @if (request()->is('tiendas')) class="activecolor" @else class="inactivecolor" @endif style="margin-left: 40px;cursor: pointer;">Tiendas</a></div>
        	<div style="position: relative;margin-left: 17px;margin-top: 0px;"><a   href="{{url('pdfauth')}}" @if (request()->is('pdfauth')) class="activecolor" @else class="inactivecolor" @endif style="margin-left: 40px;cursor: pointer;">Catalogos</a></div>

        	<div style="position: relative;margin-left: 17px;margin-top: 30px;"><a style="color:#808080;margin-left: 40px;cursor: pointer;">Ventas</a></div>
    
        	<div style="position: relative;margin-left: 17px;margin-top: 5px;"  ><a href="{{url('ingreso')}}" @if (request()->is('ingreso')) class="activecolor" @else class="inactivecolor" @endif style="margin-left: 40px;cursor: pointer;" >Ventas</a></div>
        	<div style="position: relative;margin-left: 17px;margin-top: 0px;"><a href="{{url('lista')}}" @if (request()->is('lista')) class="activecolor" @else class="inactivecolor" @endif style="margin-left: 40px;cursor: pointer;">Envios</a></div>
        	<div style="position: relative;margin-left: 17px;margin-top: 30px;"><a href="{{url('clientes')}}" @if (request()->is('clientes')) class="activecolor" @else class="inactivecolor" @endif style="margin-left: 40px;cursor: pointer;">Usuarios</a></div>
        	<div style="position: relative;margin-left: 17px;margin-top: 30px;"><a style="color:#808080;margin-left: 40px;cursor: pointer;">Configuracion</a></div>
    	</div>
    	<div @if (request()->is('app')) style="position: fixed;width:55px;background: #2a3143;height: 100vh;top:0px;transition: .5s;z-index: 9" @else style="position: fixed;width:55px;background: #f2f2f2;height: 100vh;top:0px;transition: .5s;z-index: 9" @endif onmouseover="over()" id="all" onmouseout="out()">
    		<div><img src="{{asset ('image/svg/menu.svg')}}" class="fas" id="menu"  style="position: absolute;width: 25px; left: 15px; top: 100px; z-index: 99;">
    			 <img src="{{asset ('image/svg/cerrar2.svg')}}" class="fas" id="close"  style="position: absolute;width: 15px; left: 20px; top: 100px;opacity:0;transition: .5s;z-index: 9999">
    		</div>

    		<div style="position: absolute;margin-top: 175px;margin-left: 17px;"><img src="{{asset ('image/svg/home.svg')}}" style="width: 20px;">
    		</div>
    		<div style="position: absolute;margin-top: 230px;margin-left: 17px;"><img src="{{asset ('image/svg/pedido.svg')}}" style="width: 20px;">
    		</div>
    		<div style="position: absolute;margin-top: 380px;margin-left: 17px;"><img src="{{asset ('image/svg/almacen.svg')}}" style="width: 20px;">
    		</div>
    		<div style="position: absolute;margin-top: 490px;margin-left: 17px;"><img src="{{asset ('image/svg/usuario.svg')}}" style="width: 20px;">
    		</div>
    		<div style="position: absolute;margin-top: 545px;margin-left: 17px;"><img src="{{asset ('image/svg/config.svg')}}" style="width: 20px;">
    		</div>
    		
    		


    	</div>
    	<div style="width: 100%;height: 100vh;background: rgba(0,0,0,.5);z-index: -1;position: fixed;top:0px;opacity: 0;transition: .5s" id="sombra"></div>

        <div  class="" id="" @if (request()->is('app')) style="padding-top: 100px;padding-left: 100px;background: #252734;height: 1200px;" @else style="padding-top: 100px;padding-left: 100px;" @endif   >
           
            @yield ('contenido')

        </div>
   	
        	
          <script type="text/javascript">
          	function over(){
          		document.getElementById("all").style.width = "250px";
          		document.getElementById("menu").style.display = "none";
          		document.getElementById("close").style.opacity = "1";
          		document.getElementById("close").style.transform = "rotate(180deg)";
          		document.getElementById("topi").style.opacity = "1";
          		document.getElementById("coall").style.display= "block";
          		document.getElementById("sombra").style.opacity= "1";
          		document.getElementById("sombra").style.zIndex= "4";
          		document.getElementById("all").style.boxShadow= "1px 2px 10px #000";
          	}
          	function out(){
          		document.getElementById("all").style.width = "55px";
          		document.getElementById("menu").style.display = "block";
          		document.getElementById("close").style.opacity = "0";          		
          		document.getElementById("close").style.transform = "rotate(360deg)";
          		document.getElementById("topi").style.opacity= "0";
          		document.getElementById("coall").style.display = "none";
          		document.getElementById("sombra").style.opacity= "0";
          		document.getElementById("sombra").style.zIndex= "-1";
          		document.getElementById("all").style.boxShadow= "none";

          	}



          </script>
          <script type="text/javascript">
    console.clear();
  </script> 
            
    </body>
</html>