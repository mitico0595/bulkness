<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@include ('title')</title>
        @include ('logo')
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty.css')}} ">

    </head>
    <style type="text/css">
        .hover-menu:hover {
            background: #e5e5e5;
            cursor: pointer;

        }
        .top{
        	border-bottom: none;
        }

        .not{
    		user-select: none;
    	}
    </style>

<body>

    <div class="top" id="" style="position: fixed;z-index: 999;display: inline-block;border-bottom: none">
       <div class="subtop" >

            <div class="brand" style="margin-top:0">
                <div class="subbrand">
                    <a href="{{url('/')}} "><img src="{{asset('image/oberlu_logo.png')}} "></a>
                </div>
                <div class="search">
                    <div class="subsearch">
                        {{Form::open(['route' => 'item', 'method'=> 'GET' ])}}
                        <div class="input-field">
                            <input type="text" class="" id="searchid" placeholder="Buscar Producto" name="name" value="" autocomplete="off" style="">
                        </div>
                        <div class="selectCat">
                            <select name="categoria" class="select-css">
                                    <option value="" style="">Seleccione una categoria</option>
                                    <option value="Computacion y ensamblaje">Computacion y ensamblaje</option>
                                    <option value="Celulares">Celulares</option>
                                    <option value="Salud y Belleza">Salud y Belleza</option>
                                    <option value="Electronica Smart">Electronica Smart</option>
                                    <option value="Casa y electro">Casa y electro</option>
                                    <option value="Productos Médicos">Productos Médicos</option>
                            </select>

                        </div>
                        <!--CREAR INFORMACION en el descuadre----------------------------------------------------------->

                        <div class="button">
                            <button type="submit" class="btn" style="cursor:pointer;">
                                <span class="material-icons" style="color:#fff;">search</span>
                            </button>

                        </div>

                        <div class="searchrect2"></div>
                        {{ Form::close()}}
                    </div>

                </div>

                <div class="shoppcart" style="margin-left: 80px;">

                    <a href="{{route('product.carro-compras')}} "><img src="{{asset('image/svg/supermercado.svg')}} "></a>
                    <span class="contador_fav"> {{Session::has('cart') ? Session::get('cart')->totalQty : '0' }} </span>

                </div>
            </div>

        </div>
     </div>
     <div style="position: fixed;top:100px;z-index: 999;height: 30px; background: linear-gradient(135deg, rgba(199,152,16,1) 0%,rgba(234,185,45,1) 100%);width: 100%;">
         <div style="position: relative;width:85%;margin: auto;display: block;">
             <h2 style="position: relative;float: left;width: 100px;text-align: center;color: #fff;font-size: 15px;line-height: 30px; font-family:'Dosis-extra';margin:0 ">Almacen</h2>
             <h2 style="position: relative;float: left;width: 100px;text-align: center;color: #fff;font-size: 15px;line-height: 30px; font-family:'Dosis-extra';margin:0 ">Mensajes</h2>
             <h2 style="position: relative;float: left;width: 100px;text-align: center;color: #fff;font-size: 15px;line-height: 30px; font-family:'Dosis-extra';margin:0 ">Solicitudes</h2>
             <h2 style="position: relative;float: right;width: 150px;text-align: center;color: #fff;font-size: 15px;line-height: 30px; font-family:'Dosis-extra';background: rgba(0,0,0,0.5);margin:0 " onmouseover="hoverin()">Hola, {{Auth::user()->name}} </h2>
         </div>
     </div>
     <div style="position: fixed;width:150px; height: 215px;right: 7.5%;top:130px;background: #fff;z-index: 99999;border-radius: 0px 0px 10px 10px;display: none"  onmouseover="hoverin()" id="drop-menu" onmouseout="hoverinout()">
         <div style="position: relative;width: 100%;display: inline-block;height: 30px;margin-top: 20px;padding-left: 20px;padding-right: 20px;z-index: 99999" class="hover-menu">
             <h3 style="width: 100%;text-align: center;font-size: 15px; line-height: 30px;border-bottom: 1px solid #e5e5e5;box-sizing: border-box;font-family:'Dosis-extra';margin:0 " >Inicio</h3>
         </div>
         <div style="position: relative;width: 100%;display: inline-block;height: 30px;padding-left: 20px;padding-right: 20px;" class="hover-menu">
             <h3 style="width: 100%;text-align: center;font-size: 15px; line-height: 30px;border-bottom: 1px solid #e5e5e5;box-sizing: border-box;font-family:'Dosis-extra';margin:0 ">Almacen</h3>
         </div>

         <div style="position: relative;width: 100%;display: inline-block;height: 30px;padding-left: 20px;padding-right: 20px;" class="hover-menu">
             <h3 style="width: 100%;text-align: center;font-size: 15px; line-height: 30px;border-bottom: 1px solid #e5e5e5;box-sizing: border-box;font-family:'Dosis-extra';margin:0 ">Solicitud</h3>
         </div>
         <div style="position: relative;width: 100%;display: inline-block;height: 30px;padding-left: 20px;padding-right: 20px;" class="hover-menu">
             <h3 style="width: 100%;text-align: center;font-size: 15px; line-height: 30px;border-bottom: 1px solid #e5e5e5;box-sizing: border-box;font-family:'Dosis-extra';margin:0 ">Mensajes</h3>
         </div>
         <div style="position: relative;width: 100%;display: inline-block;height: 30px;padding-left: 20px;padding-right: 20px;" class="hover-menu">
             <h3 style="width: 100%;text-align: center;font-size: 15px; line-height: 30px;box-sizing: border-box;font-family:'Dosis-extra';margin:0 ">Soporte</h3>
         </div>
     </div>

<div  style="position:fixed;width:250px;height: 100vh;top:95px;transition: .5s;z-index: 10;display: none;background: none;"  id="coall" onmouseover="over()" id="all" onmouseout="out()" class="names">
            <div style="margin-top: 97px;margin-left: 60px;opacity: 1;transition: 1s;height: 80px;font-weight: 500;color:#b7b7b7;font-family:'Kanit' " id="topi" >

                Proveedor

            </div>
            <div style="position: relative;margin-left: 17px;"><a href="{{url('supplier')}}"  @if (request()->is('supplier')) style="color:#b10000;margin-left: 40px;font-family:'Kanit'; text-decoration: none;" @else style="color:#808080;margin-left: 40px;font-family:'Kanit'; text-decoration: none;" @endif >Mi perfil</a></div>
            <div style="position: relative;margin-left: 17px;margin-top: 30px;"><a href="{{url('supplier-stock')}}"  @if (request()->is('supplier-stock')) style="color:#b10000;margin-left: 40px;cursor: pointer;text-decoration:none;" @else style="color:#808080;margin-left: 40px;cursor: pointer;text-decoration:none;" @endif>Almacen</a></div>

            <div style="position: relative;margin-left: 17px;margin-top: 40px;"><a href="{{url('pedidos')}}" @if (request()->is('pedidos')) style="color:#b10000;margin-left: 40px;cursor: pointer;text-decoration:none;" @else style="color:#808080;margin-left: 40px;cursor: pointer;text-decoration:none;" @endif>Ventas</a></div>
            <div style="position: relative;margin-left: 17px;margin-top: 30px;"><a href="{{url('detalle-producto')}}" @if (request()->is('detalle-producto')) style="color:#b10000;margin-left: 40px;cursor: pointer;text-decoration:none;" @else style="color:#808080;margin-left: 40px;cursor: pointer;text-decoration:none;" @endif>Reportes</a></div>


            <div style="position: relative;margin-left: 17px;margin-top: 62px;"><a style="color:#808080;margin-left: 40px;cursor: pointer;">Configuracion</a></div>
 </div>
 <div style="position: fixed;top:0px; width:55px;background: #f2f2f2;height: 100vh;top:100px;transition: .5s;z-index: 9" onmouseover="over()" id="all" onmouseout="out()" >
            <div><img src="{{asset ('image/svg/menu.svg')}}" class="fas" id="menu"  style="position: absolute;width: 25px; left: 15px; top: 100px; z-index: 99;">
                 <img src="{{asset ('image/svg/cerrar2.svg')}}" class="fas" id="close"  style="position: absolute;width: 15px; left: 20px; top: 100px;opacity:0;transition: .5s;z-index: 9999">
            </div>

            <div style="position: absolute;margin-top: 175px;margin-left: 17px;"><img src="{{asset ('image/svg/home.svg')}}" style="width: 20px;">
            </div>
            <div style="position: absolute;margin-top: 230px;margin-left: 17px;"><img src="{{asset ('image/svg/pedido.svg')}}" style="width: 20px;">
            </div>
            <div style="position: absolute;margin-top: 282px;margin-left: 17px;"><img src="{{asset ('image/svg/venta.svg')}}" style="width: 20px;">
            </div>
            <div style="position: absolute;margin-top: 332px;margin-left: 17px;"><img src="{{asset ('image/svg/reporte.svg')}}" style="width: 20px;">
            </div>
            <div style="position: absolute;margin-top: 410px;margin-left: 17px;"><img src="{{asset ('image/svg/config.svg')}}" style="width: 20px;">
            </div>

</div>
<div style="width: 100%;height: 100vh;background: rgba(0,0,0,.5);z-index: -1;position: fixed;top:0px;opacity: 0;transition: .5s" id="sombra"></div>
    <div>
        @yield ('usuario')
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
            function hoverin(){
                document.getElementById("drop-menu").style.display ="block";
            }
            function hoverinout(){
                document.getElementById("drop-menu").style.display ="none";
            }



          </script>


    </body>

</html>
