<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Luzapay</title>
        <link rel="stylesheet" href="{{asset('css/mobile.css')}} ">
        <link rel="stylesheet" href="{{asset('css/lightslider.css')}}">
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <link rel="stylesheet" href="{{asset('css/glider.css')}} ">
        <link rel="stylesheet" href="{{asset('css/footer.css')}} ">

    </head>
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
  <body>

      <div id="closing" style="width:100%;background:rgba(0,0,0,.5);height: 100vh;position: absolute;top:0px;left:-100vh;z-index: 999999;transition: .5s;" >
            <div style="width: 100%;position: absolute;top:40vh;left: 0px;">
                <div style="position: relative;display: block;width: 60%;min-width:250px; border-radius: 10px;background: #fff;margin: auto;padding:10px;height: 120px;">
                    <h5 style="font-family:'Kanit';font-size: 20px;text-align: center;margin:0px; ">¿Desea cerrar sesion?</h5>
                    <div style="position: relative;width: 100%;padding: 5px;display: block;margin-top: 15px;">
                        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> <div style="position: relative;float:left;width: 100px; padding:5px;font-family:'Kanit';font-size: 18px;background: #b10000;color:#000; text-align: center;color:#fff;font-weight: bold;margin:0px;border-radius: 10px;border: 2px solid #b10000; ">Cerrar</div></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                        </form>
                        <div style="position: relative;float:right;width: 100px; padding:5px;font-family:'Kanit';font-size: 18px;border: 2px solid #b10000;  color:#b10000; text-align: center;font-weight: bold;margin:0px;border-radius: 10px; " onclick="cancelar()">Cancelar</div>

                    </div>
                </div>
            </div>
        </div>





        <div class="micuenta-content" id="micuenta">
            <div class="micuenta-text" id="micuentacont">
                <div style="width: 90%;position: relative;display: block;margin: auto;">
                    <h6>{{Auth::user()->name}}</h6>

                    <img src="{{asset('image/usuario.png')}} ">
                    <div class="photo-user"></div>
                </div>
                <div style="width: 90%;position: relative;display: block;margin: auto;">

                </div>
            </div>
            <div class="micuenta-info">
                <div style="" class="item-first">
                    	<h5>Lista de deseos <span class="material-icons" style="position: absolute;right: 20px;text-shadow: 1px 1px 3px #000; font-size: 35px;top:12px">favorite_border</span></h5>
                </div>
                <div class="listado"><h4>Pendientes de envio</h4></div>
                <a href="{{url('detail-mobile')}}"><div class="listado"><h4>Todos mis pedidos</h4></div></a>
                <div class="listado"><h4>Mis valoraciones</h4></div>
                <div class="listado"><h4>Metodos de pago</h4></div>

            </div>
            <div class="micuenta-info-sub" style="height: 20vh">
                <div style="" class="item-secondo">
                	<a href="{{url('/')}}"><img class="usuario" src="{{asset('image/svg/config.svg')}} " style="width: 35px;"></a>
                	<h6 >Configuracion</h6>

                 </div>
                 <div  style="float:right;"  class="item-secondo" >
                	<a href="{{url('soporte-mobile')}}"><img class="usuario" src="{{asset('image/svg/call-center.svg')}} " style="width: 35px;"></a>
                	<h6 >Soporte</h6>

                 </div>

            </div>
            <div class="micuenta-off">
                <img class="cerrar-sesion" src="{{asset('image/svg/apagar.svg')}} " onclick="cerrar()">
            </div>
        </div>





        <div class="allforall">
            <div class="suball">
                <div class="subbase">
                <a href="{{url('/')}}"><img class="usuario" src="{{asset('image/svg/hogar.svg')}} "></a>
                <h6 >Home</h6>
                </div>
                <div class="subbase">
                <img class="usuario" src="{{asset('image/svg/barmenu.svg')}} " style="width:25px;">
                <h6>Categorias</h6>
                </div>
                <div class="subbase">
                <a href="{{url('cart-mobile')}} "><img class="usuario" src="{{asset('image/svg/carro.svg')}} "></a>
                <h6>Cart</h6>
                </div>
                <div class="subbase">
                    @if (Auth::check())
                    <a ><img class="usuario" src="{{asset('image/svg/usuariopurple.svg')}} " ></a>

                @else
                <a href="{{url('login')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                @endif
                <h6 style="color:#b10000;">Mi cuenta</h6>
                </div >
            </div>
        </div>


        <script type="text/javascript">
            function cerrar(){
                document.getElementById("closing").style.left= "0px";
            }
            function cancelar(){
                document.getElementById("closing").style.left= "-100vh";
            }
        </script>









  </body>
</html>
