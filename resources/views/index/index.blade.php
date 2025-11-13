<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="canonical" href="https://oberlu.com/" />
        <meta property="og:url" content="https://www.oberlu.com" />
        <meta property="og:title" content="Oberlu.com . Just low price, just quality" />
        <meta property="og:description" content="Solo calidad al mejor precio del mercado, garantia anual de variedad de productos tecnologicos de ultima generacion. Liquidaciones trimestrales." />
        <meta property="og:image" content="https://www.oberlu.com/image/oberlulog.png" />      
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>@include ('title')</title>
        @include ('logo')
        <link rel="stylesheet" href="{{asset('css/mobile.css')}} ">
        <link rel="stylesheet" href="{{asset('css/lightslider.css')}}">
      	<link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <link rel="stylesheet" href="{{asset('css/glider.css')}} ">
      	<link rel="stylesheet" href="{{asset('css/footer.css')}} ">
      	<link rel="stylesheet" href="{{asset('css/splide.min.css')}} ">
    </head>

    <body id="bod">
    <style type="text/css">
        .lds-dual-ring {
  display: inline-block;
  width: 80px;
  height: 80px;
}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 8px;
  border-radius: 50%;
  border: 6px solid #fff;
  border-color: #fff transparent #fff transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

    </style>
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

        }
        .slidi {
            height: 380px;
        }
    </style>

    <div class="top1" style="background:#ba1f1f" >
                <div class="top1contenido" style="max-width:1200px;">
                    <div class="top1position">
                    <div><a href="{{url('terminos/garantia')}} ">Proteccion del comprador</a></div>
                    <div><a href="{{url('soporte')}} ">Ayuda</a></div>


                    @if (Auth::check())
                    <div><a href="{{url('login')}}">Hola, {{ Auth::user()->name }}</a></div>
                    @else
                    <div><a href="{{url('login')}}">Mi cuenta</a></div>
                    @endif
                    </div>
                </div>
    </div>

      <div class="top" id="topi2" style="">
          <a href="https://wa.me/message/TFPQK4IEKVTFH1" style="position: fixed;bottom:70px;right:20px;" class="whatsapp"><img src="{{asset('image/whatsapp.png')}} " alt="" style="width: 50px;"></a>
         
          <div class="subtop" style="max-width:1200px;position:relative">
              <div class="logo" style="margin-left: 20px;">
                  <img src="{{asset('image/oberlu_logo.png')}} " class="logo1" style="">
              </div>
              <div id="ratio" style="width:40px;position:absolute;left:235px;top:24px;background:#b10000;height:40px;border-radius:50px;cursor:pointer;z-index:99999" onclick="categora()">
                <img src="{{asset('image/svg/menus.svg')}} " id="vera" style="width: 18px;position:relative;display:block;margin:auto;line-height:30px;margin-top:11px;" >
                <img src="{{asset('image/svg/close.svg')}} " id="cerrara" style="width: 18px;position:relative;display:block;margin:auto;line-height:30px;margin-top:11px;display:none" >
              <!-- include('layouts.categoria')------------------->
              </div>
                    <div class="subsearch" id="desk-search">
                        {{ Form::open(['route' => 'item', 'method'=> 'GET' ])}}
                        <div class="input-field" style="left: 250px;">
                            <input type="text" class="" id="searchid" placeholder="Buscar Producto" name="name" value="" autocomplete="off" style="border-radius: 5px;  border: #ba1f1f solid 1px;  height: 35px;background:white;">
                        </div>

                        <!--CREAR INFORMACION en el descuadre----------------------------------------------------------->

                        <div class="button" style="background: #ba1f1f;left:700px;border-radius: 0 5px 5px 0; top: 25px;height:35px;border-radius:0px 5px 5px 0px">
                            <button type="submit" class="btn" style="cursor:pointer;">
                                <span class="material-icons" style="color:#fff;font-size: 18px;margin-top:5px;">search</span>
                            </button>

                        </div>


                        {{ Form::close()}}
                    </div>
                    
                    <div class="shoppcart" style="">

                    <a href="{{route('product.carro-compras')}} "><img src="{{asset('image/svg/supermercado.svg')}} "></a>
                    <span class="contador_fav" style="color:#ba1f1f"> {{Session::has('cart') ? Session::get('cart')->totalQty : '0' }} </span>

                </div>
          </div>
            <div id="ron" style="display: none">

          @include('layouts.categoria')
            </div>
      </div>

      <!-- PRIMER SLIDER-->

        <div class="" style="position:relative;display:block;margin:auto">
            @include('index.slider')
            
        </div>
        <div class="" style="position:relative;margin:auto;width:1200px;background:none;margin-top:30px" id="metodos">
            
            <div class="splide" id="slidin" style="background:none">
                <div class="splide__track" style="background:none" >
                    <ul class="splide__list" style="background:none">
                        <li class="splide__slide" ><a href=""><img src="{{asset('image/slider/yapeplin.png')}}" style="width:300px;background:none" ></a></li>
                        <li class="splide__slide" ><a href=""><img src="{{asset('image/slider/garantia.png')}}" style="width:300px;bakground:none"></a></li>
                        <li class="splide__slide" ><a href=""><img src="{{asset('image/slider/fabrica.png')}}" style="width:300px;background:none"></a></li>
                        <li class="splide__slide" ><a href=""><img src="{{asset('image/slider/binance.png')}}" style="width:300px;bakground:none"></a></li>
            </ul>
            </div>
            </div>
        </div>
        
        <!-- SEGUNDO SLIDER-->
         

         <!-- MOBILE VERSION  --------------------->
        <div class="mobile-version">
            <div style="width:100%;position:relative;height:4rem">
                <div style="position:fixed;top:0px;width:100%;z-index:999;background:white">
                <div style="display:flex;align-items:center;flex-direction:row;height:4rem;padding:0px 10px">
                    <div style="display:flex;align-items:center;flex-direction:row;">
                        <div onclick="inicio()" id="iniciot" style="transition-duration: 0.1s;position:relative; width:90px;font-size:17px;font-family:sans-serif;border-bottom: 2px solid #b10000">
                            <img src="https://oberlu.com/image/oberlu_logo.png "  style="width:100%;">
                        </div>
                        <div onclick="explorar()" id="explorart" style="transition-duration: 0.1s;margin-left:10px;text-align:center;position:relative; width:100px;font-size:17px;font-family:sans-serif">Explorar</div>
                    </div>
                    <div style="display:flex;align-items:center;flex-direction:row;justify-content:flex-end;width:100%;">
                        <div style="">
                            <img src="{{ asset('image/svg/ubicacion.svg') }}" alt="" style="width:25px">
                        </div>
                    </div>
                </div>
                <div style="position:relative;height:4rem;width:100%;">
                    <div style="position:relative;margin:auto;width:95%;height:4rem;align-items:center;display:flex">
                        <div style="width:100%;border-radius:50px;border:2px solid black;height:50px;display:flex;align-items:center;">
                            {{ Form::open(['route' => 'subitem', 'method'=> 'GET','style'=>'width:95%' ])}}
                            <div class="input-field" style="position:relative;top:0px;left:0px;">
                                <input type="text" id="searchid" placeholder="Buscar producto" name="name" autocomplete="off" style="width:100%;padding:10px;border:none;background:none;font-size:16px">
                            
                            </div>
                            <div class="buttoni" style="position:absolute;right:2px;top:12px; ">
                                <button type="submit" class="btn" style="margin-right:2px;border:none;background:black;height:40px;cursor:pointer;border-radius:0px 20px 20px 0px">
                                    <span class="material-icons" style="color:#fff;font-size: 18px;">search</span>
                                </button>
        
                            </div>
                            {{ Form::close()}}
                        </div>
                    </div>
                </div>
                </div>
        
                <div id="oberlu" style="margin-top:150px;">
                <div style="margin-top:15px;">
                    <div class="splide" id="spliderin" role="group" aria-label="Splide Basic HTML Example">
                        <div class="splide__track" >
                              <ul class="splide__list"  >
                                <li class="splide__slide" style="padding-left:5px;padding-right:5px">
                                    <img src="{{ asset('image/berlu.jpg')}} " style="width:100%;box-sizing:border-box;border-radius:10px">
                                  </li>  
                                  <li class="splide__slide" style="padding-left:5px;padding-right:5px">
                                    <img src="{{ asset('image/wiz.jpg')}} " style="width:100%;box-sizing:border-box;border-radius:10px">
                                  </li>    
                                  <li class="splide__slide" style="padding-left:5px;padding-right:5px">
                                    <img src="{{ asset('image/izi.jpg')}} " style="width:100%;box-sizing:border-box;border-radius:10px;">
                                  </li>  
                                                        
                              </ul>
                        </div>
                      </div>
                </div>
                
                
                <div style="width:100%;position:relative;display:inline-block;margin-top:20px;background:#ededed;padding-bottom:65px;">
                    <div style="margin-left:2.5%;margin-top:15px;font-weight:bold;margin-bottom:15px;">Te va a gustar</div>
                    <div style="width:95%;margin:auto;background:black;">
                        @foreach ($loqu as $comp)
                        <a href="{{asset('finde/'.$comp->id)}} " style="text-decoration: none">
                        <div style="margin-top:7px;width:48%;position:relative;display:inline-block;float:left;margin-left:1%;border-radius:10px;background:white">
                            <img src="{{asset('images/'.$comp->image)}}" alt="" style="width:100%;border-radius:10px">
                            <div style="padding:0 10px 10px">
                                <div style="color:black;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; height: 28px;line-height: 14px;font-size: 10px;color: #666;margin: 4px 0;">
                                    {{$comp -> name}}
                                </div>
                                <div style="display:flex;align-items:center;">
                                   <div style="font-size:16px;font-weight:bold;font-style:italic">S/. {{$comp -> precio}}</div>
                                   <div style="margin-left:20px;text-decoration:line-through;font-size:11px;justify-content:center;color:#a7a7a7;align-text:center">S/. {{$comp -> preciof}}</div>
                                </div>
                                <div style="color:#666;font-size:12px;margin-bottom:8px">
                                    @if($comp->stock >= "1")
                                    Stock
                                    @else
                                    <span style="color:#b10000">Sin stock</span>    
                                    @endif
                                </div>
                                <div style="position:absolute;right:10px;bottom:5px;display:flex;justify-content:flex-end;align-items:center">
                                    @if ($comp->oferta == "1")
                                    <div style="color:blue;font-size:12px;border: 1px solid blue;padding:1px 5px;border-radius:3px">Oferta</div>
                                    @endif
                                    @if ($comp->preventab == "1")
                                    <div style="color:#b10000;font-size:12px;border: 1px solid #b10000;padding:1px 5px;border-radius:3px;margin-left:5px;">Preventa</div>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                        </a>
                        @endforeach
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
                </div>
                
                <!-- Explorar  --------------------->
                <div id="explorar" style="width:100%;position:relative;display:none;margin-top:20px;background:#ededed;padding-bottom:65px;">
                    <div style="margin-top:150px;">
                        <div style="margin-left:2.5%;margin-top:15px;font-weight:bold;margin-bottom:15px;">Ofertas Tiempo Limitado</div>
                        <div style="width:95%;margin:auto;background:black;">
                            
                            <div style="margin-top:7px;width:48%;position:relative;display:inline-block;float:left;margin-left:1%;border-radius:10px;background:white">
                                <img src="https://oberlu.com/images/1658787361_samsung.jpg" alt="" style="width:100%;border-radius:10px">
                                <div style="padding:0 10px 10px">
                                    <div style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; height: 28px;line-height: 14px;font-size: 10px;color: #666;margin: 4px 0;">
                                        RAM DDR4 Samsung 3200Mhz
                                    </div>
                                    <div style="display:flex;align-items:center;">
                                       <div style="font-size:16px;font-weight:bold;font-style:italic">S/. 1500.00</div>
                                       <div style="margin-left:20px;text-decoration:line-through;font-size:11px;justify-content:center;color:#a7a7a7;align-text:center">S/. 599.00</div>
                                    </div>
                                    <div style="color:#666;font-size:12px;margin-bottom:8px">Stock</div>
                                    <div style="position:absolute;right:10px;bottom:5px;display:flex;justify-content:flex-end;align-items:center">
                                        <div style="color:blue;font-size:12px;border: 1px solid blue;padding:1px 5px;border-radius:3px">Oferta</div>
                                        <div style="color:#b10000;font-size:12px;border: 1px solid #b10000;padding:1px 5px;border-radius:3px;margin-left:5px;">Preventa</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
        
                </div>
        
        
        
            </div>
        </div>

         <!-- MOBILE VERSION END  --------------------->

      <div class="dispositives" style="max-width:1200px;margin:auto;">

            <div class="computacion" style= "width: 100%;left:0px" >
                <div class="ancla" id="computacion"></div>
                <div class="subcomputacion" style="display: inline-block">
                    <div class="vermas">
                        <h1>Nuevos productos</h1>
                        <a href="">Ver mas</a>
                    </div>

                </div>
                <div class="splide" id="splide">
                    <div class="splide__track slidi" style="" >
                        <ul class="splide__list" style="display: flex">

                @foreach ($loqu as $comp)
                <li class="splide__slide">
                <a href="{{asset('busco/'.$comp->id)}} ">
                <div class="principal_c">
                    <div class="backwhite"></div>
                    <img src="{{asset('images/'.$comp->image)}}">
                    <p class="titlesubcat">{{$comp -> name}} </p>
                    <p class="actualprice">S/. {{$comp -> precio}}</p>
                    <p class="beforeprice" >S/. {{$comp -> preciof}}</p>
                    <p class="suboferta">{{FLOOR(number_format( 100-($comp->precio*100/$comp->preciof),2 ))}}% OFF</p>
                    @if ($comp->preventab == "1")
                            <div style="position: absolute;top:10px;right:10px;width:60px;text-align:center;border:1px solid #b10000;color:#b10000;border-radius:3px;font-size:9px;padding:2px 0px">Preventa</div>

                    @endif
                </div>
                </a>
                </li>
                 @endforeach
                </ul>
                </div>
                </div>
            </div>

        </div>
        



        <!--  OFERTAS ESPECIALES --->
        <div style="position:relative;width:100%;background:black;height:300px;margin-bottom:30px" id="ofertas">
            <div style="position:relative;max-width:1200px;margin:auto;display:block;color:white;height:100%;">
                <div style="display:flex;position:relative;align-items:center;justify-content:center;height:100%;">
                <div style="width:25%;display:inline-block;position:relative;">
                    <h2 style="text-align:left;font-size:30px; font-weight:100;font-family:sans-serif;text-transform:uppercase;width:100px">Ofertas Limitadas de la semana</h2>
                </div>
                <div style="width:75%;margin-top:30px;" >
                        <div class="splide" id="sliderofer">
                            <div class="splide__track slidi" style="" >
                                <ul class="splide__list" style="display: flex">
        
                        @foreach ($oferta as $comp)
                        <li class="splide__slide">
                        <a href="{{asset('busco/'.$comp->id)}} ">
                        <div class="principal_c" style="width:210px;">
                            <div class="backwhite" style="width:210px;"></div>
                            <img src="{{asset('images/'.$comp->image)}}">
                            <p class="titlesubcat">{{$comp -> name}} </p>
                            <p class="actualprice">S/. {{$comp -> precio}}</p>
                            <p class="beforeprice" >S/. {{$comp -> preciof}}</p>
                            <p class="suboferta">{{FLOOR(number_format( 100-($comp->precio*100/$comp->preciof),2 ))}}% OFF</p>
                            @if ($comp->preventab == "1")
                                    <div style="position: absolute;top:10px;right:10px;width:60px;text-align:center;border:1px solid #b10000;color:#b10000;border-radius:3px;font-size:9px;padding:2px 0px">Preventa</div>
        
                            @endif
                        </div>
                        </a>
                        </li>
                         @endforeach
                        </ul>
                        </div>
                        </div>
                </div>
            </div>
            </div>
        </div>
        
        
        <!--  OFERTAS ESPECIALES ENDINASD  --->
        
        
        <script src="{{asset('js/jquery.min.js')}} "></script>
    <script src="{{asset('js/splide.js')}} "></script>
    <script src="{{asset('js/glider.min.js')}} "></script>
    <script src="{{asset('js/lightslider.js')}} "></script>
    <script src="{{asset('js/splide-extension-grid.js')}} "></script>
        <div class="tienda" style="position:relative; width:100%;">
            <div class="subtienda" style="position:relative;width:100%;margin:auto;display:block;max-width:1200px;height:auto">
                @foreach ($tiendas as $tienda)
                <div class="tidi" style="position: relative;display:inline-block;width:100%;margin-top:20px;">
                    <div class="vermas" >
                        <h1 style="background: #282828;padding:0px 20px 0px 20px;color:white;border-radius:5px 0px 0px 5px">{{$tienda -> name}} </h1>
                        <h1 style="padding:0px 20px 0px 20px;color:black;background:white;border-radius:0px 5px 5px 0px">Ver todo</h1>
                    </div>
                    <div style="position:relative;width:100%;display:inline-block;">
                    <div class="splide" id="splicer{{$tienda->id}}">
                        <div class="splide__track slidi" style="" >
                            <ul class="splide__list" style="display: flex">

                    @foreach ($some as $comp)
                    @if( $comp->tienda == $tienda->id)
                    <li class="splide__slide">
                    <a href="{{asset('busco/'.$comp->id)}} ">
                    <div class="principal_c">
                        <div class="backwhite"></div>
                        <img src="{{asset('images/'.$comp->image)}}">
                        <p class="titlesubcat">{{$comp -> name}} </p>
                        <p class="actualprice">S/. {{$comp -> precio}}</p>
                        <p class="beforeprice" >S/. {{$comp -> preciof}}</p>
                        <p class="suboferta">{{FLOOR(number_format( 100-($comp->precio*100/$comp->preciof),2 ))}}% OFF</p>
                    </div>
                    </a>
                    
                    </li>
                    @endif
                     @endforeach

                    </ul>
                    
                    </div>
                    </div>
                    </div>
                </div>
                <script>
                    new Splide( '#splicer{{$tienda->id}}', {
                    type   : 'loop',
                	perPage: 5,
                	rewind : true,
                    perMove: 1, 
                    autoHeight: true,
                    autoplay: true,
                    pagination: false,
                    resetProgress: false,
                    rewind:true,
                    rewindSpeed:2000,
                    }).mount();
                </script>
                @endforeach


            </div>
        </div>
        <div class="allforall">
            <div class="suball">
                <div class="subbase">
                <img class="usuario" src="{{asset('image/svg/hogarpurple.svg')}} ">
                <h6 style="color:#b10000;">Home</h6>
                </div>
                <div class="subbase">
                <a href="https://oberlu.com/categorias"><img class="usuario" src="{{asset('image/svg/barmenu.svg')}} " style="width:25px;    padding: 3px;">
                <h6>Categorias</h6></a>
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
        <a href="https://wa.me/message/TFPQK4IEKVTFH1" style="position: fixed;bottom:70px;right:20px;" class="whatsapp"><img src="https://oberlu.com/image/whatsapp.png " alt="" style="width: 50px;"></a>
        <footer class="footer-distributed" style="background:#cecece; position: absolute; font-family:'Dosis'; " >
            <div style="position:relative; margin:auto;display:block;max-width:1200px;">
            <div class="footer-left">


               <h2 style="font-family: 'Dosis', sans-serif; color:#808080;font-size: 20px;margin-top:10px;margin-bottom: 20px;">Acerca de OBERLU</h2>
               <a href=""style="">Historia</a>
               <a href="">Productos</a>
               <a href="">Ubicacion</a>
               <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d1160.0296107852266!2d-77.02561579448685!3d-12.053223309905855!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2spe!4v1572204531215!5m2!1ses-419!2spe" width="250" height="150" frameborder="0" style="border:0;margin-top: 10px;filter:grayscale(100%)" allowfullscreen=""></iframe>
            </div>

            <div class="footer-center">

                <h2 style="font-family: 'Dosis', sans-serif; color:#808080;font-size: 20px;margin-top:10px;margin-bottom: 20px;">Terminos y Condiciones</h2>
               <a href=""style="">Terminos y condiciones de Garantia</a>
               <a href="">Condiciones de Contraentrega</a>
               <a href="">Condiciones de Envio</a>
               <a href="">Condiciones de Uso</a>
               <a href="">Terminos para usuario premium</a>

            </div>

            <div class="footer-right">

                <h5>Siguenos en:</h5>
                    <div class="social-media">
                        <a href=""><img  src="{{asset('image/svg/facebook.svg')}} " style="width:30px ;margin-left:10px;"></a>
                        <a href=""><img src="{{asset('image/svg/instagram.svg')}} " style="width:30px ;margin-left:10px;"></a>
                        <a href=""><img src="{{asset('image/svg/youtube.svg')}} " style="width:30px ;margin-left:10px;"></a>
                        <a href=""><img src="{{asset('image/svg/whatsapp.svg')}} " style="width:30px ;margin-left:10px;"></a>
                    </div>

            </div>

           </div>
           <div style="width: 100%;background:black;position:absolute;left:0px;">
            <div class="rights" style="max-width:1200px;position: relative;margin:auto;bottom:0px;background:none">
              <a href="">Politica de privacidad</a> <a href="">Term of Use and Legal Information</a><a href="">Mapa del sitio Web  </a><h1>©️ 2016-2022 oberlu.com. Todos los derechos reservados.</h1>
           </div>
            </div>
        </footer>








 <script >
            window.addEventListener('load', () => {
            document.getElementById('carga').style.opacity = '0';
            document.getElementById('carga').style.zIndex = '-9999';
            })
            var ra=0;
            function categora(){
                console.log(ra);
                if(ra%2 === 0 ){
                document.getElementById('vera').style.display = 'none';
                document.getElementById('cerrara').style.display = 'block';
                document.getElementById('ron').style.display = 'block';
                document.getElementById('bod').style.overflowY = 'hidden';
                }else{
                document.getElementById('vera').style.display = 'block';
                 document.getElementById('cerrara').style.display = 'none';
                 document.getElementById('ron').style.display = 'none';
                 document.getElementById('bod').style.overflowY = 'auto';
                }
                ra= ra+ 1;
            }
            function left() {
                document.getElementById("catt").style.Left = "-400px";
                document.getElementById("close").style.opacity = "0";
                document.getElementById("menu").style.display="block";
                document.getElementById("close").style.transform = "rotate(-180deg)";
                document.getElementById("slidersecondo").style.top = "100px";
                }
            function right(){
                document.getElementById("catt").style.Left = "70px";
                document.getElementById("close").style.opacity = "1";
                document.getElementById("menu").style.display="none";
                document.getElementById("close").style.transform = "rotate(0deg)";
                document.getElementById("slidersecondo").style.top = "0px";
            }
            var h=0;

     </script>
 



    <script>
    new Splide( '#splide', {
    type   : 'loop',
	perPage: 5,
	rewind : true,
    perMove: 1,
    autoHeight: true,
    autoplay: true,
    pagination: false,
    resetProgress: false,
    rewind:true,
    rewindSpeed:2000,

} ).mount();
    </script>
    <script>
    new Splide( '#sliderofer', {
    type   : 'loop',
	perPage: 4,
	rewind : true,
    perMove: 1,
    autoHeight: true,
    autoplay: true,
    pagination: false,
    resetProgress: false,
    rewind:true,
    arrows: false,
    rewindSpeed:2300,

} ).mount();
    </script>
    <script>
        new Splide( '#splid',{
    heightRatio: 0.5,
    autoHeight: true,
    pagination: false,
    autoplay: true,
    arrows: false,
    resetProgress: false,
    rewind:true,
} ).mount();
    </script>
    <script>
        new Splide( '.splide',{
    type   : 'loop',
    
    focus    : 'center',
    autoWidth: true,
    pagination: false,
    autoplay: true,
    arrows: true,
    resetProgress: false,
    rewind:true,
} ).mount();
    </script>
<script>
    var splide = new Splide( '#spliderin', {
    type   : 'loop',
    padding: '3rem',
    pagination: false,
    arrows: false,
    autoplay: true,
    } );
    splide.mount();
</script>

<script>
        new Splide( '#slidin',{
            type   : 'loop',
            autoWidth: true,
            autoHeight: true,
            pagination: false,
            autoplay: true,
            arrows: false,
            resetProgress: false,
            rewind:true,
        } ).mount();
        </script>
 

    <script >

        window.addEventListener('load', function(){
         let slider = new Glider(document.querySelector('.glider'), {
            slidesToScroll: 1,
            slidesToShow: 1,
            draggable: true,
            scrollLock: true,
            rewind: true,
            dots: false,
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            }
            });
         let autoplayDelay = 10000;

            let autoplay = setInterval(() => {
            slider.scrollItem('next')
            }, autoplayDelay);

            element.addEventListener('mouseover', (event) => {
            if (autoplay != null) {
            clearInterval(autoplay);
            autoplay = null;
            }
                }, 300);

        element.addEventListener('mouseout', (event) => {
        if (autoplay == null) {
        autoplay = setInterval(() => {
          slider.scrollItem('next')
        }, autoplayDelay);
        }
        }, 300);
    })
     </script>
     <script >

        window.addEventListener('load', function(){
         let slider = new Glider(document.querySelector('.gliderin'), {
            slidesToScroll: 1,
            slidesToShow: 1,
            draggable: true,
            scrollLock: true,
            rewind: true,
            dots: false,
            arrows: {
                prev: '.glider-prev',
                next: '.glider-next'
            }
            });
         let autoplayDelay = 10000;

            let autoplay = setInterval(() => {
            slider.scrollItem('next')
            }, autoplayDelay);

            element.addEventListener('mouseover', (event) => {
            if (autoplay != null) {
            clearInterval(autoplay);
            autoplay = null;
            }
                }, 300);

        element.addEventListener('mouseout', (event) => {
        if (autoplay == null) {
        autoplay = setInterval(() => {
          slider.scrollItem('next')
        }, autoplayDelay);
        }
        }, 300);
    })
     </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('busca')!!}',
                    success:function(response){

                    //material.css
                    //convert to object
                    var custArray = response;
                    var dataCust ={};
                    var dataCust2 ={};
                    for (var i=0; i< custArray.length;i++){
                        dataCust[custArray[i].name] = null;
                        dataCust2[custArray[i].name] = custArray[i];
                    }

                    $('input#searchid').autocomplete({
                        data: dataCust,
                        onAutocomplete:function(reqdata){
                            console.log(reqdata);
                        }
                    });
                    }
                })
            });
        </script>
    <script>
        function inicio(){
            document.getElementById("oberlu").style.display ="block";
            document.getElementById("explorar").style.display ="none";
            document.getElementById("explorart").style.borderBottom ="none";
            document.getElementById("iniciot").style.borderBottom ="2px solid #b10000";
            document.getElementById("explorart").style.paddingBottom ="0px";
            document.getElementById("explorart").style.color ="#000";
            document.getElementById("explorart").style.fontWeight ="100";
        }
        function explorar(){
            document.getElementById("oberlu").style.display ="none";
            document.getElementById("explorar").style.display ="inline-block";
            document.getElementById("explorart").style.borderBottom ="3px solid #b10000";
            document.getElementById("explorart").style.paddingBottom ="10px";
            document.getElementById("explorart").style.color ="#b10000";
            document.getElementById("explorart").style.fontWeight ="bold";
            document.getElementById("iniciot").style.borderBottom ="none";
        }
    </script>

</body>
</html>
