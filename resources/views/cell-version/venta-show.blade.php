<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Oberlu Admin</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/cart-mobile.css')}} ">
        <link rel="stylesheet" href="{{asset('css/sty.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
       <style type="text/css">
        body{
          background: #ededed;
        }
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
        .detallepago{
          position: relative;
    padding-left: 20px;
    padding-top: 15px;
    font-size: 17px;
    line-height: 20px;
    box-sizing: border-box;
    color: #282828;
    /* font-family: 'Dosis-extra'; */
    font-weight: bold;
    margin-bottom: 20px;
        }
        
    </style>
       <style type="text/css">
           #menum{
    position: absolute;
    height: 35vh;
    display: block;
    width: 320px; 
    margin-left: -500px;
    color: #282828;
    transition: .5s;
    background: rgba(256,256,256,0.90);
    top: 60px;
    border-radius: 20px;
    padding: 20px;
}
#menum a{
    width: 100%;
    position: relative;
    display: block;
    padding: 10px;
}
.config h4{
    line-height: 40px;
}
.precioreal{
   top:65px; left:120px;
}
.stock{
    top:65px;
    left: 200px;
}
.codigo{
    left: 120px;
    top:95px;
}
#searchid {
    background: none;
    width: 200px;
    margin-left: 60px;
    margin-top: 15px;
    transition: .5s;
    margin:0px;
    margin-left: 60px;
    
}
#searchid:focus{
    background: white;
    width: 100%;
    margin-left: 0px;
    margin-top: 0px;
    padding: 18px;
}
#menum{
    padding-top: 150px;
}
#menum a{
    color: #fff;
    font-size: 20px;
    text-align: center;
}
.cerrar-sesion{
    position: relative;
    float:left;width: 130px;
     padding:5px;font-family:'Dosis';
     font-size: 18px;
     background: none; 
     text-align: center;
     color:#000;
     font-weight: bold;margin:0px;
     border-radius: 20px;border: 2px solid #000; 
}
.numbers{
	position: absolute;
    top: -20px;
}
.inputnumbers{
	width:100px;
	position: relative;
}
.form-control{
	width: 100px;
}
.addname{
	width: 100%;
}
.buscador{
    z-index: 999999;
    position: absolute;
    left: 0px;
    margin: 0px;
    width: 100%;
    border: none;
}
.subfecha2{
    position: absolute;top:20px;left: 40px;
}
       </style>
    </head>
<body>
<div style="position: fixed;background: #fff;height: 60px;width: 100%;z-index: 999;top:0px">
        <div style="position: absolute;width:40px;top:10px ;left:10px;">            
                <svg class="h-6 w-6" stroke="#282828" fill="none" viewBox="0 0 24 24" onclick="force()">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />                                     
                </svg>            
        </div>
        <div id="soli" style="line-height: 60px;position: absolute;left: 60px;font-size: 18px;" >Detalle venta {{$venta->idventa}} </div>
        <a href="{{url('venta-mobile')}} "><img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 30px;position: absolute;top:20px;right: 20px;" ></a>
        
</div>


<div style="position: relative;width: 100%;box-sizing: border-box;padding: 20px;display: inline-block;float: left;height: auto;background: white;margin-top: 50px;">
          <div style="width: 100%;display: inline-block;">
            <div style="width: 100%;position: relative;">
             <div style="position: relative;box-sizing: border-box;width:100px;float: left;">
                <h6 style="position: relative;float: left;width: 100%;text-align: right;font-size: 13px;margin:0">N° de pedido:</h6>
                <h6 style="position: relative;float: left;width: 100%;text-align: right;font-size: 13px;margin:0">Estado:</h6>
                <h6 style="position: relative;float: left;width: 100%;text-align: right;font-size: 13px;margin:0">Recuerda:</h6>
             </div>
             <div style="position: relative;box-sizing: border-box;width: 60%; min-width:250px;float: left;">
                <h6 style="position: relative;float: left;width: 100%;text-align: left;font-size: 13px;margin:0;margin-left: 10px;color:#808080">00{{$venta->idventa}} </h6>
                <h6 style="position: relative;float: left;width: 100%;text-align: left;font-size: 13px;margin:0;margin-left: 10px;">
                  @if($venta->bverifi==0 && $venta->bembale ==0)
                   VERIFICACION DE PAGO
                  @endif
                  @if( ($venta->bverifi==1 || $venta->bembale ==1) && $venta->bsend ==0 && $venta->bcontra==0)
                      Proceso de embale
                  @endif
                  @if($venta->bentrega==0 && ( $venta->bsend ==1 || $venta->bcontra==1 )) 
                      <span style="color:green">Se envio tu pedido</span>
                  @endif
                  @if($venta->bentrega==1)  
                      <span style="color:green">Completado</span>
                  @endif
                </h6>
                <h6 style="position: relative;float: left;width: 100%;text-align: left;font-size: 10px;margin:0;margin-left: 10px;line-height: 12px;margin-top: 3px;">Tu compra se concretará en un lapso máximo de 48 horas para Lima Metropolitana y en un lapso de 96 horas para Provincias, luego de realizado el pago. Sujeto a Terminos y condiciones de LUZAPAY. </h6>
             </div>
            </div>

            <!-- PRODUCTOS-->
            <div style="width: 100%;position: relative;display: inline-block;">
              <div style="position: relative;width: 90%;display: inline-block;padding: 20px;">
                @foreach($detalles as $det)
                <a href="{{asset('busco/'.$det->idarticulo)}}">
                  <div class="detalle-orden">             
                    <div class="left-parte">
                      <img class="left-parte-image" src="{{asset('images/'.$det->image )}} ">
                    </div>
                  <div class="right-parte">
                  <div class="order-title">
                        {{ $det->articulo}}                        
                  </div>
                  <div class="sku">
                      {{$det->code }}
                  </div>
                  <div class="price-q">
                      S/. {{ $det->precio_venta}} x{{ number_format($det->cantidad,0) }}
                  </div>                    
                  </div>
                     @if ($venta->bentrega == true)
                    @if ($det->valoracion == NULL)
                    <a href="{{URL::action('SellController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#8b07c4">Valorar</a>
                    @else
                    <a href="{{URL::action('SellController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#8b07c4">Ver valoracion</a>
                    @endif
                    @endif
                  </div>
                   
                </a>
                 
                @endforeach
                </div>
            </div>

          </div>
</div>
<div style="position: relative;width: 100%;box-sizing: border-box;padding: 0px;padding-top: 0px; display: inline-block;float: left;height: auto;background: white;margin-top: 20px;">
          <div style="width: 100%;padding: 0px;display: inline-block;box-sizing: border-box;">
            <div style="position: relative;float: left;margin: 0;width:100%;height:30px; box-sizing: border-box;">
                <h6 style="position: relative; padding-left: 20px;padding-top: 15px; font-size: 17px;line-height: 20px;box-sizing: border-box;color:#282828;font-family:'Dosis-extra';font-weight: bold">Detalles de seguimiento</h6>
            </div>
            <div style="position: relative;float: left;display: inline-block;width: 100%;padding: 20px;">
                <div style="position: relative;box-sizing: border-box;width:30%;min-width: 200px;float: left;display: inline-block; ">
                  <div style="position: relative;width: 100%;padding:5px; box-sizing: border-box; float: left;margin: 0;    border-right: 1px solid #dedede;padding-right: 20px;">
                      
                      <div style="position: relative;box-sizing: border-box;display: inline-block;width: 100%;">
                        <div style="width: 40%;position: relative;float: left;box-sizing: border-box;display: inline-block;">
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: right;margin:0">Nombre:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: right;margin:0">Apellido:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: right;margin:0">DNI o CE:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: right;margin:0">Celular:</h6>
                          
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: right;margin:0">Distrito:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: right;margin:0">Provincia:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: right;margin:0">Departamento:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: right;margin:0">Domicilio:</h6>
                          
                        </div>

                        <div style="width: 60%;position: relative;float: left;box-sizing: border-box;display: inline-block;">
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: left;padding-left: 10px; margin:0">{{$venta->name ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: left;padding-left: 10px; margin:0">{{$venta->lastname ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: left;padding-left: 10px; margin:0">{{$venta->dni ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: left;margin:0;padding-left: 10px;">{{$venta->celular ?? "--"}}</h6>
                          
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: left;padding-left: 10px; margin:0">{{$venta->distrito ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: left;padding-left: 10px; margin:0">{{$venta->provincia ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: left;padding-left: 10px; margin:0">{{$venta->departamento ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Dosis';text-align: left;padding-left: 10px; margin:0">{{$venta->domicilio ?? "--"}}</h6>
                          
                        </div>

                      </div>
                  </div>
                </div>
            </div>

          </div>
        </div>


        <div style="position: relative;width: 100%;background: white;display: inline-block;margin-top: 20px;margin-bottom: 20px;padding-bottom: 20px">
          <div class="detallepago">Detalle de pago</div>
          <div class="detail-resume" style="display: block" id="transferencia">
             <div class="left-resume">
                <div class="">Total parcial</div>
                <div class="">Cargos 0,00%</div>
                <div class="">Envio</div>
                <div class="" style="font-weight: bold;">Total cancelado</div>
              </div>
              <div class="right-resume">
                <div class="" >S/. {{number_format($venta->total_parcial,2) }}</div>
                <div class="">S/. {{number_format($venta->cargos,2) }}</div>
                <div class="">@if( $venta->payment_id == 'cardlima') 
                S/. 10.00
              @endif</div>
                <div style="font-weight: bold;">S/. {{number_format($venta->total_venta,2) }}</div>
              </div>
          </div>
          
        </div>


        <div id="menum" style="position: fixed;top:0px;z-index: 9999999;height: 100vh;background:  linear-gradient(135deg, rgba(19,84,122,1) 0%,rgba(3,150,255,1) 100%);border-radius: 0px;width: 100%;color:white; ">
            <img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 30px;position: absolute;top:20px;right: 20px;" onclick="leftclose()">
            <div id="menu-cont" style="position: absolute;width: 100%;transition: .5s;">
            <div style="position: relative;">
            <a href="{{url('admin-mobile')}} ">Home</a>
            <a onclick="detail_inv()" id="inv" >Inversion</a>

            <a onclick="detail_ven()" style="font-weight: bold;">Ventas</a> 
            <a >Usuarios</a>                        
            <a >Configuracion</a>
            </div>
            </div>
            <div id="menu-sub1" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
            <div style="position: relative;">
            
            <a  id="inv" href="{{url('compras-mobile')}} ">Compras</a>

            <a href="{{url('product-mobile')}}">Productos</a> 
            <a onclick="back1()" style="color:black">Back</a>
            </div>
            </div>
            <div id="menu-sub2" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
            <div style="position: relative;">
            
            <a  id="inv" style="font-weight: bold;">Ventas</a>

            <a >Envios</a> 
            <a onclick="back2()" style="color:black">Back</a>
            </div>
            </div>
            <div style="position: absolute;bottom:50px;left: 0px;width: 100%;">
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="width: 150px;position: relative;display: block;margin: auto;"> 
                <div style="" class="cerrar-sesion">Cerrar Sesion</div>
            </a>
            </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                        </form>
            
          
    </div>
        <script type="text/javascript">
    function detail_inv(){
        document.getElementById("menu-cont").style.left = "-500px";
        document.getElementById("menu-sub1").style.right = "0px";
    }
    function back1(){
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub1").style.right = "-500px";
    }
    function detail_ven(){
        document.getElementById("menu-cont").style.left = "-500px";
        document.getElementById("menu-sub2").style.right = "0px";
    }
    function back2(){
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub2").style.right = "-500px";
    }
    function leftclose(){
        document.getElementById("menum").style.marginLeft = "-500px";
        document.getElementById("menu-sub1").style.right = "-1000px";
        document.getElementById("menu-sub2").style.right = "-1000px";
    }
    function force(){              
        document.getElementById("menum").style.marginLeft = "0px";  
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub2").style.right = "-500px";
        document.getElementById("menu-sub1").style.right = "-500px";         
            
    }
</script>
</body>
</html>