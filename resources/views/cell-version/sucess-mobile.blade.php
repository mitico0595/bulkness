<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@include ('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/cart-mobile.css')}} ">  
        <link rel="stylesheet" href="{{asset('css/sty.css')}} ">      
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <link rel="stylesheet" href="{{asset('css/sty-mobile.css')}} ">  
    </head>
<body>
	<div class="tops">
		Orden procesada correctamente
	</div>

	@if (Auth::user()->id == $venta->idpersona)
      	<div class="order-item" style="margin-top: 50px;" >
      		<div class="order-item-top">
      			<div class="order-itemid">
      				<span style="color:#898b92">Numero de orden: </span>00{{$venta->idventa }}
      			</div>
      			<div class="order-itemid">
      				<span style="color:#898b92">Fecha de pedido: </span>{{$venta->fecha_hora}}
      			</div>
                
                    
      		</div>
         	
         	@foreach($detalles as $det)
         	@if($venta->idventa == $det->idventa)
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
         				S/. {{ $det->precio_venta}} x{{ $det->cantidad}}
         			</div>
                    @if ($venta->bentrega == true)
                    @if ($det->valoracion == NULL)
                    <a href="{{URL::action('SellController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#8b07c4"><img src="{{asset('image/svg/starpurples.svg')}} " style="width: 20px;"></a>
                    @else
                    <a href="{{URL::action('SellController@edit',$det->id_dventa)}}" style="position: absolute;right:20px;color:#8b07c4"><img src="{{asset('image/svg/starpurple.svg')}} " style="width: 20px;"></a>
                    @endif
                    @endif
         		</div>
                
         	</div>
          </a>
         			
         	@endif
         	@endforeach
         	<div class="total-cancelado">
         		<div class="total-detalle">
         			<span style="font-size: 18px;">Monto Total:</span><span style="float: right; margin-right: 8px;font-weight: bold;font-size: 20px;">S/. {{ $venta->total_venta}}</span>
         		</div>	
         	</div>
            <div style="width: 100%;position: relative;">
                
            </div>
         </div>
         @endif

         <a href="{{asset('detail-mobile/'.$venta->idventa)}}"><div class="verpedido">
         	Ver pedido
         </div></a>
         <div class="suggest">
         	<div class="title-s">
         		Seguro te gusta
         	</div>
         	<div class="item-suggest" style="height: auto;display: inline-block;width: 100%;margin-bottom: 50px">
         		 <div class="computacion" >
            
                @foreach ($searches as $search)
                <a href="{{asset('finde/'.$search->id)}} "><div class="recomendation-column">
                     
                    <div class="product-container">
                        <div class="image-container">
                            <img class="product-image" src="{{asset('images/'.$search->image)}}">
                        </div>
                        <div class="product-info">
                            <div class="product-title">
                                {{$search -> name}}
                            </div>
                            <div class="product-price">S/. {{$search -> precio}} <span class="beforeprice">S/. {{$search -> preciof}}</span></div>
                            <div class="product-stock">Stock</div>
                        </div>
                    </div>
                    
                </div ></a>
                @endforeach
                
                
                
         	</div>
         </div>
       </div>
       <a href="{{asset('cell-version')}}"><div class="continuar">
       	Seguir comprando
       </div></a>
</body>

</html>