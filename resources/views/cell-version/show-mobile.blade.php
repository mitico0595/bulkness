<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@include ('title')</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/cart-mobile.css')}} ">
        <link rel="stylesheet" href="{{asset('css/sty.css')}}">
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
    </head>
<body style="background-color: #eaeaea">
    <div style="position: absolute;width: 100%;background: black;height: 50px;">
        <div class="logo">
                <a href="javascript: history.go(-1)">
                  <img src="{{asset('image/svg/arrow.svg')}} " class="logo1" style="width: 20px;left: 20px"></a>
          </div>
          <div style="color:white;position: absolute;left:60px;font-size: 20px;top:8px;">
            N° pedido 
          </div>
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
                    <a href="{{URL::action('SellMobileController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#b10000">Valorar</a>
                    @else
                    <a href="{{URL::action('SellMobileController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#b10000">Ver valoracion</a>
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
                <h6 style="position: relative; padding-left: 20px;padding-top: 15px; font-size: 17px;line-height: 20px;box-sizing: border-box;color:#282828;font-family: sans-serif;font-weight: bold">Detalles de seguimiento</h6>
            </div>
            <div style="position: relative;float: left;display: inline-block;width: 100%;padding: 20px;">
                <div style="position: relative;box-sizing: border-box;width:30%;min-width: 200px;float: left;display: inline-block; ">
                  <div style="position: relative;width: 100%;padding:5px; box-sizing: border-box; float: left;margin: 0;    border-right: 1px solid #dedede;padding-right: 20px;">
                      
                      <div style="position: relative;box-sizing: border-box;display: inline-block;width: 100%;">
                        <div style="width: 40%;position: relative;float: left;box-sizing: border-box;display: inline-block;">
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;margin:0;font-weight:100">Nombre:</h6>
                         <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;margin:0;font-weight:100">DNI o CE:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;margin:0;font-weight:100">Celular:</h6>
                          
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;margin:0;font-weight:100">Distrito:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;margin:0;font-weight:100">Provincia:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;margin:0;font-weight:100">Departamento:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align:left;margin:0;font-weight:100">Domicilio:</h6>
                          
                        </div>

                        <div style="width: 60%;position: relative;float: left;box-sizing: border-box;display: inline-block;">
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;padding-left: 10px; margin:0;">{{$venta->name ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->dni ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;margin:0;padding-left:  px;">{{$venta->celular ?? "--"}}</h6>
                          
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->distrito ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->provincia ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->departamento ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->domicilio ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 11px; font-family: sans-serif;text-align: left;padding-left: 10px; margin:0;font-weight: bold;margin-top: 15px;">NOTA: {{$venta->detalle ?? "--"}}</h6>
                          
                        </div>

                      </div>
                  </div>
                </div>
            </div>

          </div>
        </div>


        <div style="position: relative;width: 100%;background: white;display: inline-block;margin-top: 20px;margin-bottom: 20px;padding-bottom: 20px;margin-bottom: 60px;">
          <div class="detallepago">Detalle de pago</div>
          <div class="detail-resume" style="display: block" id="transferencia">
             <div class="left-resume">
                <div class="">Total parcial</div>
                <div class="">Cargos 0,00%</div>
                <div class="">Envio</div>
                <div class="" style="font-weight: bold;">Total cancelado</div>
              </div>
              <div class="right-resume">
                <div class="" >S/. {{number_format($venta->total_parcial,2) ?? "--" }}</div>
                <div class="">S/. 0.00 </div>
                <div class="">S/. {{number_format($venta->total_venta-$venta->total_parcial ,2) ?? "--" }} </div>
                <div style="font-weight: bold;">S/. {{number_format($venta->total_venta,2) ?? "--" }}</div>
              </div>
          </div>
          
        </div>
 <div class="allforall">
            <div class="suball">
                <div class="subbase">
                <a href="{{url('/')}}" style="width: 50px;height: 20px;"><img class="usuario" src="{{asset('image/svg/hogar.svg')}} "></a>
                
                </div>
                <div class="subbase">
                <a href="{{url('detail-mobile')}}" style="width: 50px;height: 20px;"><h6></h6><img class="usuario" src="{{asset('image/svg/todo.svg')}} " style="width:20px;top:5px;"></a>
                
                </div>
                <div class="subbase">
                <a href="{{url('cart-mobile')}} "> <h6></h6><img class="usuario" src="{{asset('image/svg/carro.svg')}} "></a>
               
                </div>
                <div class="subbase">
                    @if (Auth::check())
                    <a href="{{url('index-profile')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} " ></a>
                
                @else
                <a href="{{url('login')}}"><h6 style="color:#a305fa;"></h6><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                @endif
                
                </div >
            </div>
    </div>
    
</body>
</html>