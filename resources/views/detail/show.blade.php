
@extends ('userblackboard')
@section ('usuario-cont')
 <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique&display=swap" rel="stylesheet">
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
   	 		margin-left: 150px;
   	 	}.button{
   	 		line-height: 42px;
   	 	}
   	 	.input-field{
   	 		top:22px;
   	 	}
   	 	a{
   	 		text-decoration: none
   	 	}
    </style>


    <div style="position: relative;width: 70%;min-width: 400px; display: block;margin: auto;padding-top: 150px;background: none">
    	<div class="top" style="border-bottom: 0px;margin-bottom: 20px;position: relative;margin-top: 50px;display: inline-block;float: left;height: auto;" >
    		<div style="position: relative;display: inline-block;">
    			<a href="{{url('detail')}} " style="margin-left: 20px;margin-top: 20px;padding-top: 20px;line-height: 40px;font-size: 13px;    text-decoration: none;">Lista de pedidos</a> <span style="font-size: 13px;line-height: 40px;">> Detalle de pedido</span>
    		</div>
    		<div style="position: relative;width: 100%;box-sizing: border-box;padding: 20px;display: inline-block;">
    			@if($venta->bverifi==0 && $venta->bembale ==0)
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #ba1f1f; background: #ba1f1f url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% 0px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Procesando pago</div>

    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #bababa; background: #bababa url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% 0px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Embale</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #bababa; background: #bababa url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% 0px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Procesando envio</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background: #bababa;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Entregado</div>
    			@endif
    			@if( ($venta->bverifi==1 || $venta->bembale ==1) && $venta->bsend ==0 && $venta->bcontra==0 && $venta->bentrega==0)
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #d488e0; background: #eb89e4 url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% -20px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Procesando envio</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color:#ba1f1f; background: #ba1f1f url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% 0px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Embale</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #bababa; background: #bababa url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% 0px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Envio</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background: #bababa;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Entregado</div>
    			@endif
    			@if($venta->bentrega==0 && ( $venta->bsend ==1 || $venta->bcontra==1 ))
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #d488e0; background: #eb89e4 url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% -40px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Procesando envio</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #d488e0; background: #eb89e4 url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% -20px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Embale</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #ba1f1f; background: #ba1f1f url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% 0px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Envio</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background: #bababa;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Entregado</div>
    			@endif
    			@if($venta->bentrega==1)
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #d488e0; background: #eb89e4 url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% -40px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Procesando envio</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #d488e0; background: #eb89e4 url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% -40px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Embale</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background-color: #ba1f1f; background: #eb89e4 url({{asset('image/arrow.png')}}) no-repeat 100% 0; background-position: 100% -20px;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Envio</div>
    			<div style="position: relative;float: left;width: 24.9%;box-sizing: border-box;background: #ba1f1f;color:#fff;text-align: center;font-size: 12px;line-height: 20px;">Entregado</div>
    			@endif

    		</div>
        <div style="position: relative;width: 100%;box-sizing: border-box;padding: 20px;display: inline-block;float: left;height: auto;">
          <div style="border: 1px solid #ba1f1f;width: 100%;padding: 20px;display: inline-block;">
            <div style="width: 100%;position: relative;">
             <div style="position: relative;box-sizing: border-box;width:150px;float: left;">
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
                <h6 style="position: relative;float: left;width: 100%;text-align: left;font-size: 10px;margin:0;margin-left: 10px;line-height: 12px;margin-top: 3px;">Tu compra se concretará en un lapso máximo de 48 horas para Lima Metropolitana y en un lapso de 96 horas para Provincias, luego de realizado el pago. Sujeto a Terminos y condiciones de OBERLU. </h6>
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
                    <a href="{{URL::action('SellController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#ba1f1f">Valorar</a>
                    @else
                    <a href="{{URL::action('SellController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#ba1f1f">Ver valoracion</a>
                    @endif
                    @endif
                  </div>

                </a>

                @endforeach
                </div>
            </div>

          </div>
        </div>
        <div style="position: relative;width: 100%;box-sizing: border-box;padding: 20px;padding-top: 0px; display: inline-block;float: left;height: auto;">
          <div style="border: 1px solid #ba1f1f;width: 100%;padding: 0px;display: inline-block;box-sizing: border-box;">
            <div style="position: relative;float: left;margin: 0;width:100%;height:30px; background: #ba1f1f;box-sizing: border-box;">
                <h6 style="position: relative; padding-left: 20px;padding-top: 5px; font-size: 15px;line-height: 20px;box-sizing: border-box;color:white;font-family:'Zen Kaku Gothic Antique', sans-serif;font-weight: 100">Detalles de seguimiento</h6>
            </div>
            <div style="position: relative;float: left;display: inline-block;width: 100%;padding: 20px;">
                <div style="position: relative;box-sizing: border-box;width:30%;min-width: 200px;float: left;display: inline-block; ">
                  <div style="position: relative;width: 100%;padding:5px; box-sizing: border-box; float: left;margin: 0;    border-right: 1px solid #dedede;padding-right: 20px;">
                      <h6 style="color:#282828; font-size: 15px;">Tarjeta de destinatario</h6>
                      <div style="position: relative;box-sizing: border-box;display: inline-block;width: 100%;">
                        <div style="width: 30%;position: relative;float: left;box-sizing: border-box;display: inline-block;">
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: right;margin:0">Nombre:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: right;margin:0">Apellido:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: right;margin:0">DNI o CE:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: right;margin:0">Celular:</h6>

                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: right;margin:0">Distrito:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: right;margin:0">Provincia:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: right;margin:0">Departamento:</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: right;margin:0">Domicilio:</h6>

                        </div>

                        <div style="width: 70%;position: relative;float: left;box-sizing: border-box;display: inline-block;">
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->name ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->lastname ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->dni ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: left;margin:0;padding-left: 10px;">{{$venta->celular ?? "--"}}</h6>

                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->distrito ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->provincia ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->departamento ?? "--"}}</h6>
                          <h6 style="width: 100%;position: relative;display: inline-block;font-size: 13px; font-family: 'Zen Kaku Gothic Antique', sans-serif;text-align: left;padding-left: 10px; margin:0">{{$venta->domicilio ?? "--"}}</h6>

                        </div>

                      </div>
                  </div>

                </div>
                @if($venta->bembale == false )
                <div style="position: relative;width:70%;height:auto;display:inline-block">
                    <div style="position:relative;width:450px;margin:auto;">
                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/check.svg')}} "></div>
                        <div style="width: 100px;height: 3px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 59px;top: 35px;"></div>
                    </div>

                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 15px;height: 15px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 34px;top: 30px;"></div>
                        <div style="width: 110px;height: 3px;background: #808080;border-radius: 25px; position: absolute;left: 48px;top: 35px;"></div>
                    </div>
                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 15px;height: 15px;background: #808080;border-radius: 25px; position: absolute;left: 34px;top: 30px;"></div>
                        <div style="width: 110px;height: 3px;background: #808080;border-radius: 25px; position: absolute;left: 48px;top: 35px;"></div>
                    </div>
                    <div style="width: 60px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 15px;height: 15px;background: #808080;border-radius: 25px; position: absolute;left: 34px;top: 30px;"></div>
                    </div>
                    <div style="width: 100%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #fff;margin-top:50px;border:2px solid #b10000; ">
                        <h5 style="font-size: 18px;font-family:'Zen Kaku Gothic Antique', sans-serif;margin: 0px;color:#b10000">Orden Realizada</h5>
                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; ">{{$venta->fecha_hora}}</h5>
                        <h5 style="font-size: 10px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; text-align: justify; ">Pronto realizaremos el embale de su compra, esperenos que pronto llegará a sus manos.</h5>
                    </div>
                    </div>
                </div>
                @endif
                @if ($venta->bembale == true && $venta->bcontra == false && $venta->bsend == false)
                <div style="position: relative;width:70%;height:auto;display:inline-block">
                    <div style="position:relative;width:450px;margin:auto;">
                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/check.svg')}} "></div>
                        <div style="width: 100px;height: 3px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 59px;top: 35px;"></div>
                    </div>

                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/embalaje.svg')}} "></div>
                        <div style="width: 100px;height: 3px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 59px;top: 35px;"></div>
                    </div>
                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 15px;height: 15px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 34px;top: 30px;"></div>
                        <div style="width: 110px;height: 3px;background: #808080;border-radius: 25px; position: absolute;left: 48px;top: 35px;"></div>
                    </div>
                    <div style="width: 60px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 15px;height: 15px;background: #808080;border-radius: 25px; position: absolute;left: 34px;top: 30px;"></div>
                    </div>
                    <div style="width: 100%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #fff;margin-top:50px;border:2px solid #b10000; ">
                        <h5 style="font-size: 18px;font-family:'Zen Kaku Gothic Antique', sans-serif;margin: 0px;color:#b10000">Embale Realizado</h5>
                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; ">{{$venta->fecha_embale ?? " " }}</h5>
                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; text-align: justify; ">El embalaje se realiza con total cuidado, a su vez el embolsado de su producto si recoje en tienda.</h5>
                    </div>
                    </div>
                </div>
                @endif

                @if (($venta->bcontra == true || $venta->bsend == true) && $venta->bentrega == false )
                <div style="position: relative;width:70%;height:auto;display:inline-block">
                    <div style="position:relative;width:450px;margin:auto;">
                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/check.svg')}} "></div>
                        <div style="width: 100px;height: 3px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 59px;top: 35px;"></div>
                    </div>

                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/embalaje.svg')}} "></div>
                        <div style="width: 100px;height: 3px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 59px;top: 35px;"></div>
                    </div>
                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/delivery.svg')}} "></div>
                        <div style="width: 100px;height: 3px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 59px;top: 35px;"></div>
                    </div>
                    <div style="width: 60px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 15px;height: 15px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 34px;top: 30px;"></div>
                    </div>
                    @if($venta->bsend == true)
                    <div style="width: 100%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #fff;margin-top:50px;border:2px solid #b10000; ">
                        <h5 style="font-size: 18px;font-family:'Zen Kaku Gothic Antique', sans-serif;margin: 0px;color:#b10000">Envio Terciarizado</h5>
                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; ">{{$venta->fecha_envio ?? " " }}</h5>
                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; text-align: justify; ">Envio Realizado con éxito, espere atentamente su pedido.  </h5>

                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; text-align: justify; "> Su número de seguimiento es: <span style="font-weight: bold;font-size:15px;">{{$venta->nseg ?? "Sin numero"}}</span>  </h5>
                    </div>
                    @endif

                    @if($venta->bcontra== true)
                    <div style="width: 100%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #fff;margin-top:50px;border:2px solid #b10000; ">
                        <h5 style="font-size: 18px;font-family:'Zen Kaku Gothic Antique', sans-serif;margin: 0px;color:#b10000">Contraentrega Coordinada</h5>
                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; ">{{$venta->fecha_contra ?? " " }}</h5>
                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; text-align: justify; ">Contraentrega en proceso, se asignó la fecha, hora y lugar de entrega de su pedido. </h5>

                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; text-align: justify; ">Dirección de entrega: {{$venta->domicilio ?? " "}} </h5>
                    </div>
                    @endif


                    </div>
                </div>
                @endif

                @if ($venta->bentrega ==true )
                <div style="position: relative;width:70%;height:auto;display:inline-block">
                    <div style="position:relative;width:450px;margin:auto;">
                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/check.svg')}} "></div>
                        <div style="width: 100px;height: 3px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 59px;top: 35px;"></div>
                    </div>

                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/embalaje.svg')}} "></div>
                        <div style="width: 100px;height: 3px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 59px;top: 35px;"></div>
                    </div>
                    <div style="width: 120px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/delivery.svg')}} "></div>
                        <div style="width: 100px;height: 3px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 59px;top: 35px;"></div>
                    </div>
                    <div style="width: 60px;position: relative;margin: 0px;height: 70px;float: left;">
                        <div style="width: 50px;height: 50px;background: #ba1f1f;border-radius: 25px; position: absolute;left: 10px;top: 10px;"><img style="position: absolute;width: 32px;left: 10px;top: 10px;" src="{{asset('image/svg/paquete.svg')}} "></div>

                    </div>
                    <div style="width: 100%;position: relative;margin: 0px;float: left;padding:5px 10px;border-radius: 5px; background: #fff;margin-top:50px;border:2px solid #b10000; ">
                        <h5 style="font-size: 18px;font-family:'Zen Kaku Gothic Antique', sans-serif;margin: 0px;color:#b10000">Entrega Exitosa</h5>
                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; ">{{$venta->fecha_entrega ?? " " }}</h5>
                        <h5 style="font-size: 13px;font-family:'Zen Kaku Gothic Antique', sans-serif;color:#939393; text-align: justify; ">Oberlu le agradece por su compra, esté atento a las ofertas próximas.</h5>
                    </div>
                    </div>
                </div>
                @endif
            </div>

          </div>
        </div>


    	</div>



   	</div>




@endsection
