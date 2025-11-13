@extends('cell-version.search')
@section('cont')
<script src="{{asset('js/splide.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/splide.min.css')}}">
<style>
.splide__arrow{
    background:rgba(256,256,256,.2);
   
}
.splide__arrow svg{
    fill:rgba(0,0,0,.2);
}
    



.my-carousel-progress-bar {
  background: #b10000;
  height: 4px;
  transition: width 400ms ease;
  width: 0;
}
  .splide__slide img {
  width: 100%;
  height: auto;
}
</style>          
<style type="text/css">
   .checkmark__circle {
  stroke-dasharray: 166;
  stroke-dashoffset: 166;
  stroke-width: 2;
  stroke-miterlimit: 10;
  stroke: #ba1f1f;
  fill: none;
  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  display: block;
  stroke-width: 2;
  stroke: #fff;
  stroke-miterlimit: 10;
  margin: 10% auto;
  box-shadow: inset 0px 0px 0px #ba1f1f;
  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
}

.checkmark__check {
  transform-origin: 50% 50%;
  stroke-dasharray: 48;
  stroke-dashoffset: 48;
  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}
@keyframes scale {
  0%, 100% {
    transform: none;
  }
  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}
@keyframes fill {
  100% {
    box-shadow: inset 0px 0px 0px 30px #ba1f1f;
  }
}
h5{
    margin:0;
}
</style>

     @if (session()->has('success'))
<div style="position: absolute;width: 100%;height: 100vh;z-index: 9999;top:0px;left: 0px;" id="notificacion"  class="content" >
    <div style="position:relative;display: block;margin: auto;width: 80%;height:100px;background:rgba(186,47,47,.7);top:250px;padding:20px;box-sizing:border-box;border-radius: 10px;">
         <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" style="position: relative; margin: 0px;float: left;">
            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
            </svg>     
       
        <h6 style="font-size: 20px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;position: relative;/* width: 100%; */margin: 0px;font-weight: 100;margin-top: 10px;color: white;margin-left: 20px;/* padding-left: 20px; */float: left;top: 7px;">{{session('success') }} </h6>        
    </div>
</div>
    
@endif    

<script>
    window.addEventListener('load', function(){
       var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
       var url = "{{asset('busco/')}}"+"/"+{{$searches->id}};
       if (isMobile) {
        console.log("es mobil");
       document.getElementById("body").style.display= "block";
       }
       else {

       window.location.replace(url);

}
})

</script>
    <div class="" style="width: 100%;box-sizing: border-box;position: relative;display: inline-block;float:left;height:auto;margin-bottom:10px;">
            <section id="main-carousel" class="splide"  >
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                        @if ($searches->tipo == '1')
                            <img src="{{asset('image/'.$searches->thumb )}}" style="width: 100%;">
                        @else
                            @if ($searches->tipo == '2')
                            <img src="{{asset('images/kits'.$searches->thumb )}}"  style="width: 100%;">
                            @else
                            <img src="{{asset('image/productos/'.$searches->image )}}"  style="width: 100%">
                            @endif
                        @endif   
                            
                        </li>
                        
                    </ul>
                </div>
                

                <!-- Add the progress bar element -->
                <div class="my-carousel-progress">
                    <div class="my-carousel-progress-bar"></div>
                </div>
        </section>
    	
    </div>
    <div class="" style="width: 100%;padding-top:20px;padding-bottom: 20px;background: white;margin-top: -5px;">
    	<div class="" style="width: 100%;position: relative;display: block;margin: auto;">
    		<!--   PREVENTA -->
            @if($searches->preventab == 1)
            <div style="width:100%;text-align:center;padding:4px 0px;background:rgb(248, 168, 102);color:white;font-size:12px " >Compra en preventa al mejor precio!</div>
    		<div style="width: 100%;position: relative;display: block;line-height:60px">
                <img src="{{asset('image/preventa.jpg')}} " alt="" style="position: absolute;left:0px;top:0px;width:100%">
                <div style="position:absolute;right:10px; width:80px;height:60px">
                    <div style="position:relative;display:flex;justify-content:center;align-items:center;flex-direction:column">
                        <div style="color:white;font-size:11px;line-height:12px;text-align:center;margin-top:12px">Preventa termina en:</div>

                        <div style="margin-top: 5px">
                            <div style="position:relative;display:flex;justify-content:center;align-items:center;line-height:12px;color:white">
                                <span id="dd" style="display:flex;margin-right:10px;">
                                    <span id="days" style="text-align: center;font-size:14px"></span>
                                     <span style="text-align: center;font-size:9px;margin-left:3px">d</span>
                                 </span>
                                 <span id="" style="display:flex;margin-right:2px;flex-direction: column;">
                                     <div style="display:flex;justify-content:center;align-items:center;">
                                         <span id="dig" style="text-align: center;font-size:14px">0</span>
                                         <span id="hours" style="text-align: center;font-size:14px"></span>
                                     </div>

                                  </span>
                                  <span>:</span>
                                  <span id="" style="display:flex;margin-right:2px;flex-direction: column;margin-left:2px">
                                     <div style="display:flex;justify-content:center;align-items:center;">
                                         <span id="digil" style="text-align: center;font-size:14px">0</span>
                                         <span id="minutes" style="text-align: center;font-size:14px"></span>
                                     </div>

                                  </span>
                                  <span>:</span>
                                  <span id="" style="display:flex;margin-right:2px;flex-direction: column;margin-left:2px">
                                     <div style="display:flex;justify-content:center;align-items:center;">
                                         <span id="digi" style="text-align: center;font-size:14px">0</span>
                                         <span id="seconds" style="text-align: center;font-size:14px"></span>
                                     </div>

                                  </span>


                             </div>
                        </div>
                    </div>
                </div>
                <div style="width: 90%;margin:auto; position: relative;display: block;">

                    <div class="" style="width: 140px;font-size: 25px;font-family: Open Sans,Roboto,Arial,Helvetica,sans-serif,SimSun;color:#fff;display: inline-block;vertical-align: middle;">S/. {{$searches -> precio}}
                    </div>
                    <div style="display: inline-block;vertical-align: middle;margin-right: .16rem;text-decoration: line-through;color:rgb(148, 148, 148)">{{$searches -> preciof}}
                    </div>
                    <div style="display: inline-block;vertical-align: middle;color: rgb(255, 195, 195);">-{{FLOOR(number_format( 100-($searches->precio*100/$searches->preciof),2 ))}}%
                    </div>
                </div>
    		</div>
            @else
            <div style="width: 90%;margin:auto; position: relative;display: block;">

                <div class="" style="width: 140px;font-size: 25px;font-family: Open Sans,Roboto,Arial,Helvetica,sans-serif,SimSun;color:#000;display: inline-block;vertical-align: middle;">S/. {{$searches -> precio}}
                </div>
                <div style="display: inline-block;vertical-align: middle;margin-right: .16rem;text-decoration: line-through;color:#808080">{{$searches -> preciof}}
                </div>
                <div style="display: inline-block;vertical-align: middle;color: red">-{{FLOOR(number_format( 100-($searches->precio*100/$searches->preciof),2 ))}}%
                </div>
            </div>
            @endif
            <!--   END preventa -->
            
    			<div style="width: 90%;margin:auto;position: relative;display: block;margin-top: 10px;text-align: justify;font-size:20px;font-weight:bold ;text-transform:uppercase;font-family: 'kanit';line-height: 20px;">{{$searches -> name}}</div>
    			@if($searches->stock == "0")
    			<div style="display: block;color: #666;font-size: 15px;line-height: .53333rem;width: 90%;margin:auto;margin-top:8px">Agotado</div>
                @else
                <div style="display: block;color: #666;font-size: 15px;line-height: .53333rem;width: 90%;margin:auto;margin-top:8px">En Stock</div>
                @endif
    			<div style="display: inline-block;color: #666;font-size: 15px;line-height: .53333rem;position: relative;float: right;margin-top: 20px;color: #808080;margin-right:5%;">Code: {{$searches->codigo}} </div>
    			<div style="position: relative;">
    				<div style="width: 200px;margin-top: 10px;padding-bottom: 7px;">
                    @foreach ($calificaciones as $cal )

                    @if ($searches->id == $cal->id)
                    @if ($cal->promedio <= 5 && $cal->promedio > 4.50 )
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
    				<h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 4.5 && $cal->promedio >4.0 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 4 && $cal->promedio >3.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 3.5 && $cal->promedio >3 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 3 && $cal->promedio >2.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio<= 2.5 && $cal->promedio >2 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 2 && $cal->promedio>1.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 1.5 && $cal->promedio >1 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 1 && $cal->promedio >0.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @endif
                    @endforeach

    				</div>
    			</div>
    	</div>

    	
    </div>
    <div style="position:relative;display: block;width: 100%;background: #fff;background:#ba1f1f;margin-top: 10px; " >
    	<div style="position: relative;display: block;width: 90%;margin: auto;" onclick="seleccionar()">
    		<h5 style="margin: 0px;padding-top: 15px;padding-bottom: 15px;color:#fff; font-size: 15px;font-family: 'Kanit';font-weight: 100;">Seleccione opciones de compra </h5>
    		 <img src="{{asset('image/svg/down.svg')}} " style="width:15px;position: absolute;right: 20px;top:20px;transform: rotate(-90deg);">
    	</div>
    	
    </div>
    <div id="seleccion" style="display:none">
    <div style="position:relative;display: flex;width: 100%;background: rgb(233, 233, 233);flex-direction:column;margin:0px;background:white;margin-bottom:10px" >
        <div style="position: relative;display:flex;line-height:12px;margin-top:10px">
            <h5 style="padding: 10px 20px">Color:</h5>
            <h5 style="padding: 8px 0px;border-radius:5px; text-align:center;width:80px;color:white;font-weight:100;background:#ba1f1f">Unico</h5>
            <h5 style="padding: 8px 0px;border-radius:5px; text-align:center;width:80px;color:#b10000;font-weight:100;border:1px solid #ba1f1f;margin-left:10px;text-decoration:line-through;">Otros</h5>
        </div>
        <div style="position: relative;display:flex;line-height:12px;margin-top:10px">
            <h5 style="padding: 10px 20px">Envio:</h5>
            <h5 style="padding: 8px 0px;border-radius:5px; text-align:center;width:150px;color:white;font-weight:100;background:#ba1f1f">Seleccionar en canasta</h5>

        </div>
        <div style="position: relative;display:flex;line-height:12px;margin-top:10px;margin-bottom:20px">
            <h5 style="padding: 10px 20px">Procedencia:</h5>
            <h5 style="padding: 8px 0px;border-radius:5px; text-align:center;width:80px;color:white;font-weight:100;background:#ba1f1f">Peru</h5>
            <h5 style="padding: 8px 0px;border-radius:5px; text-align:center;width:80px;color:#b10000;font-weight:100;border:1px solid #ba1f1f;margin-left:10px;text-decoration:line-through;">Panama</h5>
        </div>

    </div>
    </div>
    <div style="position:relative;display: block;width: 100%;background: #fff " >
    	<div style="position: relative;display: block;width: 90%;margin: auto;">
    		<h5 style="margin: 0px;padding-top: 15px;padding-bottom: 15px; font-size: 15px;font-family: 'Kanit';font-weight: 100; color: #ba1f1f;font-weight: 600">Garantía 24 meses ADLER EMERGENCY</h5>
    		<img src="{{asset('image/svg/shield.svg')}} " style="width:40px;position: absolute;right: 20px;top:5px;">
    	</div>
    	
    </div>
<div style="padding: 20px;background: #fff;margin-top: 10px;margin-bottom: 10px; position: relative;float: left;width: 100% ">
	<h5 style="font-size: 20px;font-weight: bold;font-family:'Kanit';margin:0px;">Descripción:</h5>
	{!! nl2br(e($searches->description)) !!} 
    <div style="    position: relative; width: 100%; float: left; display: block;height: auto;"> 
        @if($searches->image1 != NULL) 
          <img src="{{asset('images/'.$searches->image1)}} " style="width: 85%;position: relative;margin: auto;display: block;">
          @endif
          @if($searches->image2 != NULL)
          <img src="{{asset('images/'.$searches->image2)}} " style="width: 85%;position: relative;margin: auto;display: block;">
          @endif
            @if($searches->image3 != NULL)
          <img src="{{asset('images/'.$searches->image3)}} " style="width: 85%;position: relative;margin: auto;display: block;">
          @endif
    </div>
</div>
<div style="padding: 20px;background: #fff; margin-bottom: 50px; padding-bottom: 70px;position: relative;float: left;width: 100%; ">
    <h5 style="font-size: 20px;font-weight: bold;font-family:'Kanit';margin:0px;">Valoraciones:</h5>
    @foreach( $valoras as $val)
    @if($val->valoracion != NULL)
    @if ($searches->id == $val->idarticulo)
        <div style="position: relative;width: 100%;display: block;margin-top: 10px;padding-bottom: 30px;border-bottom: 1px solid #ededed;padding-top: 30px;">
            <div style="width: 100%;position: relative;display:inline-block;">
            <div style="position: relative;width:50%;float: left;display: inline-block;">
                <h3 style="font-family: 'Kanit';font-size: 15px; font-weight: 100;margin: 0px;padding-left: 20px; ">{!! substr(($val->name),0,3) !!}***  </h3> </div>
                <div style="position: relative;width: 100px;display: block;float: right;">
                    @if ($val->valoracion <= 5 && $val->valoracion > 4.50 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    
                    @endif
                    @if ($val->valoracion <= 4.5 && $val->valoracion >4.0 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    
                    @endif
                    @if ($val->valoracion <= 4 && $val->valoracion >3.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    
                    @endif
                    @if ($val->valoracion <= 3.5 && $val->valoracion >3 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    
                    @endif
                    @if ($val->valoracion <= 3 && $val->valoracion >2.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    
                    @endif
                    @if ($val->valoracion<= 2.5 && $val->valoracion >2 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                   
                    @endif
                    @if ($val->valoracion <= 2 && $val->valoracion>1.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    
                    @endif
                    @if ($val->valoracion <= 1.5 && $val->valoracion >1 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    
                    @endif
                    @if ($val->valoracion <= 1 && $val->valoracion >0.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    
                    @endif
                </div>
                </div>


                <div style="display: block;position: relative;width: 100%;margin: auto; padding:0px 20px;text-align: justify;font-size: 15px;">
                    {{$val->opinion}}
                </div>
        </div>

    @endif
    @endif
    @endforeach
</div>

    <div class="suggest">
            <div class="title-s" style="margin-left: 10px;font-family:'Kanit';font-size: 20px; ">
                Ultimos agregados
            </div>
            <div class="item-suggest" style="height: auto;display: inline-block;width: 100%;margin-bottom: 50px">
                 <div class="computacion" >
            
                @foreach ($sear as $search)
                <a href="{{asset('finde/'.$search->id)}} "><div class="recomendation-column">
                     
                    <div class="product-container">
                        <div class="image-container">
                        @if ($search->tipo == '1')
                            <img src="{{asset('image/'.$search->thumb )}}" class="product-image" style="width: 100%;">
                        @else
                            @if ($search->tipo == '2')
                            <img src="{{asset('images/kits'.$search->thumb )}}" class="product-image" style="width: 100%;">
                            @else
                            <img src="{{asset('image/productos/'.$search->image )}}" class="product-image" style="width: 100%">
                            @endif
                        @endif 
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
    <div class="allforall">
            <div class="suball" style="width: 100%;">
                <div class="subbase" style="width:10%;box-sizing: border-box;min-width: 0;">
                <a href="{{url('/')}} "><img class="usuario" src="{{asset('image/svg/hogar.svg')}} "> </a>               
                </div>
                <div class="subbase" style="width:40%;box-sizing: border-box;">                
                    @if($searches->stock == "0")

                        @if ($searches->preventa == "0" || $searches->preventa == NULL)
                        <h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;color:#ba1f1f;font-size: 17px	;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Agotado</h6>
                        @else
                            @if($searches->preventab == 1)
                                @if ($searches->tipo == '1')
                                <a href="{{asset('adler-venta-mobile')}}"><h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;color:#ba1f1f;font-size: 17px	;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Añadir Preventa</h6></a>
                            
                                @else
                                    @if ($searches->tipo == '2')
                                    <a href="{{asset('adler-venta-mobile')}}"><h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;color:#ba1f1f;font-size: 17px	;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Añadir Preventa</h6></a>
                                    @else
                                    <a href="{{route('product.addToCart',['id'=>$searches->id] )}}"><h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;color:#ba1f1f;font-size: 17px	;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Añadir Preventa</h6></a>
                            
                                    @endif
                                @endif 
                            @else  
                                @if ($searches->tipo == '1')
                                <a href="{{asset('adler-venta-mobile')}}"><h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;color:#ba1f1f;font-size: 17px	;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Añadir Preventa</h6></a>
                            
                                @else
                                    @if ($searches->tipo == '2')
                                    <a href="{{asset('adler-venta-mobile')}}"><h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;color:#ba1f1f;font-size: 17px	;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Añadir Preventa</h6></a>
                                    @else
                                    <a href="{{route('product.addToCart',['id'=>$searches->id] )}}"><h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;color:#ba1f1f;font-size: 17px	;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Añadir Preventa</h6></a>
                            
                                    @endif
                                @endif
                            @endif
                        @endif
                        @else  
                                @if ($searches->tipo == '1')
                                <a href="{{asset('adler-venta-mobile')}}"><h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;color:#ba1f1f;font-size: 17px	;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Agregar BackPack</h6></a>
                            
                                @else
                                    @if ($searches->tipo == '2')
                                    <a href="{{asset('adler-venta-mobile')}}"><h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;color:#ba1f1f;font-size: 17px	;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Agregar Kit</h6></a>
                                    @else
                                    <a href="{{route('product.addToCart',['id'=>$searches->id] )}}"><h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;color:#ba1f1f;font-size: 17px	;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Agregar a la cesta</h6></a>
                            
                                    @endif
                                @endif
                    
                        
                    @endif
                </div>
                <a href="{{route('product.cart-mobile')}} "><div class="subbase" style="width:50%;box-sizing: border-box;">                
                <h6 style="width: 100%;width: 100%;line-height: 55px;margin-top: 0px;background: #ba1f1f;font-size: 17px;color: #fff;font-weight: 600;float: left;position: relative;font-family: 'Kanit';width: 100%;text-align: center;top:0px">Ver cesta {{Session::has('cart') ? Session::get('cart')->totalQty : '0' }}</h6></a>
                </div>
               
            </div>
       </div>
       <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $(".content").fadeOut(1500);
    },2000);
});
</script>
<script>
    var r =0;
    function seleccionar(){
        if( r%2 == 0){
        document.getElementById('seleccion').style.display = "block";
        r++;
        }
        else{
        document.getElementById('seleccion').style.display = "none";
        r++;
        }
    }

</script>
@if ($d != 0)
<input type="text" value="{{ $d }}" id="datetime" style="display: none">

<script src="{{asset('js/clock.js')}} "></script>

@endif
<script>
    var splide = new Splide('#main-carousel', {
                            arrows: {
                                // Opciones para las flechas
                                size: 'small', // Tamaño: 'small', 'medium', 'large'
                                color: '#b10000', // Color
                                background: '#000', // Fondo
                            },
                            autoplay: {
                                pauseOnHover: false, // Don't pause on hover
                                interval: 2000, // Change interval to 3 seconds
                            },
                            rewind    : true,
                            pagination: false,
                            
                        });
    var bar    = splide.root.querySelector('.my-carousel-progress-bar');
    
    // Updates the bar width whenever the carousel moves:
    splide.on( 'mounted move', function () {
        var end  = splide.Components.Controller.getEnd() + 1;
        var rate = Math.min( ( splide.index + 1 ) / end, 1 );
        bar.style.width = String( 100 * rate ) + '%';
    } );
    
    splide.mount();
</script>
@endsection        