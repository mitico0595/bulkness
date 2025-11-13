
@extends ('userblackboard')
@section ('usuario-cont')

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
    <div style="position: relative;width: 50%;min-width: 400px; display: block;margin: auto;padding-top: 150px;">
    	<div class="top" style="border-bottom: 0px;margin-bottom: 20px; min-width: 100px; position: inherit;height: 50px;width: 100%;" >
          <div class="subtop">
              <div class="logo">
                <a href="javascript: history.go(-1)">
                  <img src="{{asset('image/svg/arrow.svg')}} " class="logo1" style="width: 20px;"></a>
              </div>

                    <div class="subsearch">
                        {{ Form::open(['route' => 'detail', 'method'=> 'GET','autocomplete'=>'off','role'=>'search' ])}}
                        <div class="input-field" style="color:#282828;background: none;border-radius: 0px;border-bottom:2px solid #ba1f1f;top:10px;">
                            <input type="text" class="" id="searchid" placeholder="Buscar por Id orden" name="searchText" value="" autocomplete="off" style="background: none;color:#282828;font-size: 14px;">
                        </div>

                        <!--CREAR INFORMACION en el descuadre----------------------------------------------------------->

                        <div class="button" style="background: none;top:0px;">
                            <button type="submit" class="btn" style="cursor:pointer;">
                                <span class="material-icons" style="color:#fff;font-size: 18px;">search</span>
                            </button>

                        </div>


                        {{ Form::close()}}
                    </div>


          </div>

      </div>

      	@foreach($venta as $vent)
      	@if (Auth::user()->id == $vent->idpersona)
      	<div class="order-item" @if($vent->bverifi == 0) style="border-left: 3px solid #ea2323;position: relative;display: block;margin-bottom:0px;margin-top:10px"@endif
          @if($vent->bverifi == 1 && $vent->bentrega == 0 ) style="border-left: 3px solid #ba1f1f;margin-bottom:0px;margin-top:10px"@endif
          @if($vent->bverifi == 1 && $vent->bentrega == 1 ) style="border-left: 3px solid #707070;margin-bottom:0px;margin-top:10px"@endif
          >

      		<div class="order-item-top">
      			<div class="order-itemid">
      				<span style="color:#898b92">Numero de orden: </span>00{{$vent->idventa }}
              @if($vent->bverifi == 1 && $vent->bentrega == 1 ) <span style="color:#808080"> - Pedido entregado</span>
              @endif
              @if($vent->bverifi == 1 && $vent->bentrega == 0 ) <span style="color:#808080"> - Proceso de entrega</span>
              @endif
              @if($vent->bverifi == 0)  <span style="color:#808080"> - En verificación</span>
              @endif
      			</div>
      			<div class="order-itemid">
      				<span style="color:#898b92">Fecha de pedido: </span>{{$vent->fecha_hora}}
      			</div>
                <a href="#" class="" data-toggle="modal" data-target="{{ '#modal'.$vent->idventa}}" style="position: absolute;top: 17px;width: 35px;right: 20px;">
                <img src="{{Asset('image/svg/camion.svg')}} " style="width: 100%;"></a>

<!-- Modal -->



<div class="modal fade" id="{{ 'modal'.$vent->idventa}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog" role="document" style="position: relative;margin: auto;width: 500px;display: block;">
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
          <a href="{{asset('busco/'.$det->idarticulo)}}">
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
         				S/. {{ $det->precio_venta}} x{{ number_format($det->cantidad,0) }}
         			</div>
                    @if ($vent->bentrega == true)
                    @if ($det->valoracion == NULL)
                    <a href="{{URL::action('SellController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#ba1f1f"><img src="{{asset('image/svg/star#ba1f1fs.svg')}} " style="width: 20px;"></a>
                    @else
                    <a href="{{URL::action('SellController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#ba1f1f"><img src="{{asset('image/svg/starpurple.svg')}} " style="width: 20px;"></a>
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
            <div style="width: 100%;position: relative;">
                <div style="width: 85%;position: relative;display: block;margin: auto;margin-top: 10px;">
                  <a href= "{{asset('detail/'.$vent->idventa)}}" style="width:250px;padding: 3px;position: relative;margin: auto;display: block;text-align: center;background: #ba1f1f; color:#fff;text-decoration: none;border-radius: 5px;">Ver detalle</a>
                  
                </div>
                
            </div>
            
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

</div>

@endsection
