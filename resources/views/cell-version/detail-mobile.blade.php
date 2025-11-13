<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Luzapay</title>

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
            margin-left: 10px;
    margin-top: -4px;
        }
        .logo1{
            position: absolute;
            width:80px;
            top:12px;
        }
        .detalle{
      width: 70%;
    position: relative;
    text-align: center;
    background: #ba1f1f;
    padding: 5px 10px;
    color: #fff;
    margin: auto;
    margin-top: 20px;
    border-radius: 5px;
    font-size: 17px;
}
.input-field{
    position: absolute;
    top: 0;
    left: 50px;
    width: 150px;
}
button{
    left: 310px;
    position: relative;
}
    </style>
    </head>
    <body style="background-color: #eaeaea">
    	<div class="top" style="background: #000;position: inherit;" >
          <div class="subtop">
              <div class="logo">
                <a href="javascript: history.go(-1)">
                  <img src="{{asset('image/svg/arrow.svg')}} " class="logo1" style="width: 20px;"></a>
              </div>
              
                    <div class="subsearch">
                        {{ Form::open(['route' => 'detail', 'method'=> 'GET','autocomplete'=>'off','role'=>'search' ])}}
                        <div class="input-field" style="color:#fff;background: none;border-radius: 0px;border-bottom:2px solid #ba1f1f">
                            <input type="text" class="" id="searchid" placeholder="Id orden" name="searchText" value="" autocomplete="off" style="background: none;color:#fff;font-size: 14px;">
                        </div>
                        
                        <!--CREAR INFORMACION en el descuadre----------------------------------------------------------->

                        <div class="button" style="background: none;">
                            <button type="submit" class="btn" style="cursor:pointer;">
                                <span class="material-icons" style="color:#fff;font-size: 18px;">search</span>
                            </button>
                            
                        </div>
                        
                        
                        {{ Form::close()}}
                    </div>

               
          </div>

      </div>

      	@foreach($venta as $vent)
      	@if (Auth::user()->email == $vent->email)
      	<div class="order-item" style="margin-bottom:0px;margin-top:10px;">
      		<div class="order-item-top">
      			<div class="order-itemid">
      				<span style="color:#898b92">Numero de orden: </span>00{{$vent->idventa }}
      			</div>
      			<div class="order-itemid">
      				<span style="color:#898b92">Fecha de pedido: </span>{{$vent->fecha_hora}}
      			</div>
                <a href="#" class="" data-toggle="modal" data-target="{{ '#modal'.$vent->idventa}}" style="position: absolute;top: 17px;width: 35px;right: 20px;">
                <img src="{{Asset('image/svg/camion.svg')}} " style="width: 100%;"></a>

<!-- Modal -->
<div class="modal fade" id="{{ 'modal'.$vent->idventa}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
 <div class="modal-dialog" role="document" >
   <div class="modal-content" style="height: 100vh;">
    <div class="modal-header" style="padding:10px; background: #ba1f1f">
        <a href="#" class="" data-dismiss="modal" style="">
                        <img src="{{asset('image/svg/arrow-white.svg')}} " class="logo1" style="width: 20px;top:10px;">
                                    </a>
     <h5 style="width: 100%;text-align: center;font-size: 16px;margin:0px;color:#fff;font-weight: 100 ">Tracking information order <span> {{$vent->idventa }}</span></h5>
     
      </div>
      <div class="modal-body" style="background: #eaeaea">
        <div class="" style="position: relative;display: block;width: 90%;margin: auto;">
            <div style="width: 100%;position: relative;display: block;height: 80px;margin-top: 20px;">
                <div style="width: 23%;position: relative;margin: 0px;height: 70px;float: left;">
                    <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/check.svg')}} "></div>
                    <div style="width: 3px;height: 85px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 35px;top: 50px;"></div>
                </div>
                <div style="width: 76%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #fff">
                    <h5 style="font-size: 18px;font-family:'Kanit';margin: 0px; ">Orden Realizada</h5>
                    <h5 style="font-size: 13px;font-family:'Kanit';color:#939393; ">{{$vent->fecha_hora}}</h5>
                    <h5 style="font-size: 10px;font-family:'Kanit';color:#939393; text-align: justify; ">Pronto realizaremos el embale de su compra, esperenos que pronto llegará a sus manos.</h5>
                </div>
            </div>
            @if ($vent->bembale == false )
             <!-- Embale -->
            <div style="width: 100%;position: relative;display: block;height: 80px;margin-top: 20px;">
                <div style="width: 23%;position: relative;margin: 0px;height: 70px;float: left;">
                    <div style="width: 15px;height: 15px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 29.5px;top: 30px;"></div>
                    <div style="width: 3px;height: 85px;background: #cecece;border-radius: 25px; position: absolute;left: 35px;top: 45px;"></div>
                </div>
                <div style="width: 76%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #f3f3f3">
                    <h5 style="font-size: 18px;font-family:'Kanit';margin: 0px; ">En proceso de embale</h5>
                    <h5 style="font-size: 13px;font-family:'Kanit';color:#939393; ">-</h5>
                    <h5 style="font-size: 10px;font-family:'Kanit';color:#939393; text-align: justify; ">El embalaje se realiza con total cuidado, a su vez el embolsado de su producto si recoje en tienda. </h5>
                </div>
            </div>
            @endif

            @if ($vent->bembale == true )
             <!-- Embale -->
            <div style="width: 100%;position: relative;display: block;height: 80px;margin-top: 20px;">

                
                <div style="width: 23%;position: relative;margin: 0px;height: 70px;float: left;">
                    
                    <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><a href="#" class="" data-toggle="modal" data-target="{{ '#image'.$vent->idventa}}" ><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/embalaje.svg')}} "></a></div>

                    <div class="modal fade" id="{{ 'image'.$vent->idventa}}" tabindex="-1" role="dialog" aria-labelledby="myModalImage">
                        <div class="modal-dialog" role="document" >
                            <div class="modal-content" >
                                <img src="{{asset('images/envios/'.$vent->idventa.'/'.$vent->cembale)}}" style="width:100%;margin-top: 30px;margin-bottom: 30px;padding: 10px;">
                                <h6 style="width: 100%;font-size: 12px;padding:10px;color:#808080;text-align: right;">Presione afuera para cerrar</h6>
                            </div>
                        </div>
                    </div>



                    <div style="width: 3px;height: 85px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 35px;top: 50px;"></div>
                </div>

                <div style="width: 76%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #fff">
                    <h5 style="font-size: 18px;font-family:'Kanit';margin: 0px; ">Embalado</h5>
                    <h5 style="font-size: 13px;font-family:'Kanit';color:#939393; ">{{$vent->fecha_embale}}</h5>
                    <h5 style="font-size: 10px;font-family:'Kanit';color:#939393; text-align: justify; ">El embalaje se realiza con total cuidado, a su vez el embolsado de su producto si recoje en tienda. </h5>
                </div>
            </div>
            @endif



            <!-- Contraentrega - envio -->
            @if ($vent->bcontra == false &&  $vent->bsend == false)
             <div style="width: 100%;position: relative;display: block;height: 80px;margin-top: 20px;">
                <div style="width: 23%;position: relative;margin: 0px;height: 70px;float: left;">
                    <div style="width: 15px;height: 15px;background: #cecece;border-radius: 25px; position: absolute;left: 29.5px;top: 30px;"></div>
                    <div style="width: 3px;height: 85px;background: #cecece;border-radius: 25px; position: absolute;left: 35px;top: 45px;"></div>
                </div>
                <div style="width: 76%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #f3f3f3">
                    <h5 style="font-size: 18px;font-family:'Kanit';margin: 0px; ">None</h5>
                    <h5 style="font-size: 13px;font-family:'Kanit';color:#939393; ">None</h5>
                    <h5 style="font-size: 10px;font-family:'Kanit';color:#939393; text-align: justify; ">None</h5>
                </div>
            </div>
            @endif

            @if ($vent->bcontra == true)
             <div style="width: 100%;position: relative;display: block;height: 80px;margin-top: 20px;">
                <div style="width: 23%;position: relative;margin: 0px;height: 70px;float: left;">
                    <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><a href="#" class="" data-toggle="modal" data-target="{{ '#contra'.$vent->idventa}}" ><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/delivery.svg')}} "></a></div>

                     <div class="modal fade" id="{{ 'contra'.$vent->idventa}}" tabindex="-1" role="dialog" aria-labelledby="myModalImage">
                        <div class="modal-dialog" role="document" >
                            <div class="modal-content" >
                                <img src="{{asset('images/envios/'.$vent->idventa.'/'.$vent->csend)}}" style="width:100%;margin-top: 30px;margin-bottom: 30px;padding: 10px;max-height: 400px;">
                                <h6 style="width: 100%;font-size: 12px;padding:10px;color:#808080;text-align: right;">Presione afuera para cerrar</h6>
                            </div>
                        </div>
                    </div>



                    <div style="width: 3px;height: 85px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 35px;top: 50px;"></div>
                </div>
                <div style="width: 76%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #fff">
                    <h5 style="font-size: 18px;font-family:'Kanit';margin: 0px; ">Envio Luzapay</h5>
                    <h5 style="font-size: 13px;font-family:'Kanit';color:#939393; "> {{$vent->fecha_contra}}</h5>
                    <h5 style="font-size: 12px;font-family:'Kanit';color:#939393; text-align: justify; ">{{$vent->detalle}}</h5>
                </div>
            </div>
            @endif

            @if ($vent->bsend == true)
             <div style="width: 100%;position: relative;display: block;height: 80px;margin-top: 20px;">
                <div style="width: 23%;position: relative;margin: 0px;height: 70px;float: left;">
                    <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><a href="#" class="" data-toggle="modal" data-target="{{ '#envio'.$vent->idventa}}" > <img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/delivery.svg')}} "></a></div>
                    <div class="modal fade" id="{{ 'envio'.$vent->idventa}}" tabindex="-1" role="dialog" aria-labelledby="myModalImage">
                        <div class="modal-dialog" role="document" >
                            <div class="modal-content" >
                                <img src="{{asset('images/envios/'.$vent->idventa.'/'.$vent->csend)}}" style="width:100%;margin-top: 30px;margin-bottom: 30px;padding: 10px;max-height: 400px;">
                                <h6 style="width: 100%;font-size: 12px;padding:10px;color:#808080;text-align: right;">Presione afuera para cerrar</h6>
                            </div>
                        </div>
                    </div>
                    <div style="width: 3px;height: 85px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 35px;top: 50px;"></div>
                </div>
                <div style="width: 76%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #fff">
                    <h5 style="font-size: 18px;font-family:'Kanit';margin: 0px; ">Envio terciarizado</h5>
                    <h5 style="font-size: 13px;font-family:'Kanit';color:#939393; "> {{$vent->fecha_envio}}</h5>
                    <h5 style="font-size: 12px;font-family:'Kanit';color:#939393; text-align: justify; margin:0">{{$vent->detalle}}</h5>
                    @if ($vent->nseg != ' ')
                    <h5 style="font-size: 12px;font-family:'Kanit';color:#939393; text-align: justify; ">Numero de seguimiento: {{$vent->nseg}}</h5>
                    @endif
                </div>
            </div>
            @endif
             <!-- Entrega exitosa -->
             @if ($vent->bentrega == false)
             <div style="width: 100%;position: relative;display: block;height: 80px;margin-top: 20px;">
                <div style="width: 23%;position: relative;margin: 0px;height: 70px;float: left;">
                    <div style="width: 15px;height: 15px;background: #cecece;border-radius: 25px; position: absolute;left: 29.5px;top: 30px;"></div>
                </div>
                <div style="width: 76%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #f3f3f3">
                    <h5 style="font-size: 18px;font-family:'Kanit';margin: 0px; ">None</h5>
                    <h5 style="font-size: 13px;font-family:'Kanit';color:#939393; ">None</h5>
                    <h5 style="font-size: 10px;font-family:'Kanit';color:#939393; text-align: justify; ">None</h5>
                </div>
            </div>
            @endif
            @if ($vent->bentrega == true)
             <div style="width: 100%;position: relative;display: block;height: 80px;margin-top: 20px;">
                <div style="width: 23%;position: relative;margin: 0px;height: 70px;float: left;">
                    <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/paquete.svg')}} "></div>
                    
                </div>
                <div style="width: 76%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #ba1f1f">
                    <h5 style="font-size: 18px;font-family:'Kanit';margin: 0px;color:#fff; ">Entregado</h5>
                    <h5 style="font-size: 13px;font-family:'Kanit';color:#f1f1f1; ">  {{$vent->fecha_entrega}}</h5>
                    <h5 style="font-size: 10px;font-family:'Kanit';color:#939393; text-align: justify; ">  </h5>
                </div>
            </div>
            @endif
        </div>
      </div>
    </div>
   </div>
  </div>

<!-- End Modal ------------------------------------------------------------->

                    
      		</div>
         	
         	@foreach($detalles as $det)
         	@if($vent->idventa == $det->idventa)
          <a href="{{asset('finde/'.$det->idarticulo)}}">
            <div class="detalle-orden">         		
         		<div class="left-parte">
         			<img class="left-parte-image" src="{{asset('images/'.$det->image )}} " >
         		</div>
         		<div class="right-parte">
         			<div class="order-title">
         				{{ $det->articulo}}
                        
         			</div>
         			<div class="sku">
         				{{$det->code }}
         			</div>
         			<div class="price-q">
         				S/. {{ $det->precio_venta}} x{{ $det->cantidad}}
         			</div>
                    @if ($vent->bentrega == true)
                    @if ($det->valoracion == NULL)
                    <a href="{{URL::action('SellMobileController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#ba1f1f"><img src="{{asset('image/svg/starpurples.svg')}} " style="width: 20px;"></a>
                    @else
                    <a href="{{URL::action('SellMobileController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#ba1f1f"><img src="{{asset('image/svg/starpurple.svg')}} " style="width: 20px;"></a>
                    @endif
                    @endif
         		</div>
                
         	</div>
          </a>
         			
         	@endif
         	@endforeach
         	<div class="total-cancelado">
         		<div class="total-detalle">
         			<span style="font-size: 18px;">Monto Total:</span><span style="float: right; margin-right: 8px;font-weight: bold;font-size: 20px;">S/. {{ $vent->total_venta}}</span>
         		</div>	
         	</div>
            <a href="{{asset('detail-mobile/'.$vent->idventa)}} "><div class="detalle">
                Ver detalle
            </div></a>
         </div>
         @if($vent->bverifi == false)
          <a href="{{asset('pagos/'.$vent->purchaseNumber)}}"><div style="width:100%;position:relative;display:block;">
               <h5 style="text-align:center;background:#b10000;font-size:17px;font-weight:100;padding:5px;border-radius:0px 0px 5px 5px ;box-shadow: 2px 5px 5px #808080;color:white">Realizar pago</h5> 
        </div></a>
        @endif
         @endif
	   	@endforeach     
        <script src="{{asset('js/appnew.js')}}"></script>        
        <script src="{{asset('js/jquery.min.js')}} "></script>
        <script src="{{asset('js/glider.min.js')}} "></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        


    </body>
</html>