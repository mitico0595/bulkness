<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@include ('title')</title>
        @include ('logo')
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/mobile.css')}} ">
        <style type="text/css">
        	*{
        		list-style: none;
            text-decoration: none;
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
   <body style="">
    <div class="subtop" style="max-width:1200px;position:relative;width:100%;">
        <a href="/"><div class="logo" >
            <img src="{{asset('image/oberlu_logo.png')}} " class="logo1" style="width:150px;position:relative:width:200px;display:block;margin:auto">
        </div></a>




    </div>
    <div class="" id="mobile-search" style="position:sticky;top:0px;margin-top:0px;width:100%;height:60px;background:white;z-index:999">
        <div style="position:relative;float:left;display:inline-block;width:90%;">
      {{ Form::open(['route' => 'subitem', 'method'=> 'GET' ])}}
        <div class="" >
            <input type="text" class="" id="searchid" placeholder="Buscar Producto" name="name" value="" autocomplete="off" style="height: 60px; width: 100%; border: none; padding-left: 15px;">
        </div>

        <!--CREAR INFORMACION en el descuadre----------------------------------------------------------->
      </div>
        <div class="" style="position:relative;float:left;display:inline-block;width:10%;background:#b10000;height:60px;line-height:70px">
            <button type="submit" class="btn" style="cursor:pointer;background:none;border:none">
                <span class="material-icons" style="color:#fff;font-size: 25px;">search</span>
            </button>

        </div>


        {{ Form::close()}}
    </div>
        <div style="position: relative;width:100%;height:100vh;display:block;z-index:99;background:white;margin-top:10px;">
            @foreach ( $tiendas as $t)
                <a href="{{url('buscando?name=&categoria='.$t->name)}} "><div style="color:black; position: relative;width:100%;display:block;height:80px;line-height:90px;text-align:center;font-size:25px; font-family:BlinkMacSystemFont,Roboto, Oxygen-Sans, Ubuntu, Cantarell, sans-serif;border-bottom:1px solid #cacaca">
                    {{$t->name}}
                </div></a>
            @endforeach

        </div>
        <div class="allforall">
            <div class="suball">
                <div class="subbase">
                <img class="usuario" src="{{asset('image/svg/hogar.svg')}} ">
                <a href="/"><h6 style="color:black;">Home</h6></a>
                </div>
                <div class="subbase">
                <img class="usuario" src="{{asset('image/svg/barmenu-red.svg')}} " style="width:25px;    padding: 3px;">
                <h6 style="color:#b10000;">Categorias</h6>
                </div>
                <div class="subbase">
                <a href="{{route('product.cart-mobile')}} "><img class="usuario" src="{{asset('image/svg/carro.svg')}} ">
                <h6>Cart</h6></a>
                </div>
                <div class="subbase">

                    @if (Auth::check() && auth()->user()->type == "1")
                    <a href="{{url('admin-mobile')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                    @endif
                    @if (Auth::check() == false )
                    <a href="{{url('login')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                    @endif
                    @if (Auth::check() == true && auth()->user()->type == "0" )
                    <a href="{{url('index-profile')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                    @endif
                    @if (Auth::check() && auth()->user()->type == "2" )
                    <a href="{{url('prov-mobile')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                    @endif
                    <h6>Mi cuenta</h6>
                </div>
            </div>
        </div>
   </body>
   </html>
