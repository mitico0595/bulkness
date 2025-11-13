<title>@include ('title')</title>
        @include ('logo')


        <link rel="stylesheet" href="{{asset('css/estilos.css')}}" >
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fuggles&display=swap" rel="stylesheet">
<style type="text/css">
    .checkmark__circle {
   stroke-dasharray: 500;
   stroke-dashoffset: 500;
   stroke-width: 2;
   stroke-miterlimit: 10;
   stroke: #ba1f1f;
   fill: none;
   animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
 }

 .checkmark {
   width: 60px;
   height: 60px;
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
     transform: scale3d(1.4, 1.4, 1);
   }
 }
 @keyframes fill {
   100% {
     box-shadow: inset 0px 0px 0px 30px #ba1f1f;
   }
 }
 </style>
<style type="text/css">
	.input{
		border:1px solid #cecece;
		background: none;
		border-radius: 5px;
		width: 200px;
		padding: 5px 10px;
		margin-top: 5px;
	}
	.input:focus {
		outline: 0;
		border-bottom: 2px solid #297abc;
	}
    body{
        position: relative;
        margin: auto;
        max-width: 1200px;
        min-width: 1200px;
    }
    .envio{
        line-height:50px;
        padding:0px 20px;
        position: relative;
        float: left;width:250px;
        height:50px;
        background: #dcf7cb;
        border-radius: 3px;
        border: 1px solid #ba1f1f;
        color: #ba1f1f;
        font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
        cursor: pointer;
    }
    .envio:hover{
        background: #45a00a;
        color:white;
    }
    .done{background: white}
    .done:hover{
        background: #ba1f1f;
        color:white;
    }
    .labelt{
        font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
        font-size: .9rem;

    }
    .inputn{
        width:100%;
        padding: 8px 8px;
        margin-top:10px;
        font-size: .9rem;
        background: #f7f7f7 ;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    #datar{
        display:block;
    }
    #posstarget{
        display:none;
    }
    #dirr{
        display: none;
        color: #ba1f1f;
    }
    .coverr:hover #dirr{
        color: white;
    }
    .coverr:hover{
        background: #ba1f1f;
    }

</style>
<div style="position:fixed;width:100%;left:0px;height:100px;background:white;border-bottom:1px solid #eee;z-index:9999">
    <div style="position: relative; margin: auto;max-width: 1200px;height:100%">
        <a href="{{url('/')}}"><img src="{{asset('image/oberlu_logo.png')}} " style="position: relative;float:left;width: 190px;z-index: 999;margin-top:10px;"></a>
        <div style="position:relative;float:right;display:inline-block">
            <div style="position: relative;float:left;width:180px;height:100%;">
                <img src="{{asset('image/svg/call-centeri.svg')}} " alt="" style="width: 30px;margin-top:35px;">
                <h4 style="position: relative;float:right;display:inline-block;font-weight:100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;line-height:95px;color:#666;margin:0">Asesoría telefónica</h4>
            </div>
            <div style="position: relative;float:left;width:155px;margin-left:25px;height:100%;background:white;">
                <img src="{{asset('image/svg/seguro.svg')}} " alt="" style="width: 30px;margin-top:35px;">
                <h4 style="position: relative;float:right;display:inline-block;font-weight:100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;line-height:95px;color:#666;margin:0">Compra seguro</h4>

            </div>
        </div>
    </div>
</div>

<div style="box-sizing:border-box;width: 100%; position: relative;display: inline-block;margin:0px;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;border:none;margin-top:150px;height:100px;border: 1px solid #cacaca;border-radius:5px;box-shadow:1px 1px 4px #cacaca" >
    <img src="{{asset('image/thumb/cart-p4.png ')}}" alt="" style="width:530px" id="imgsen">
    <img src="{{asset('image/thumb/cart-p6.png ')}}" alt="" style="width:530px;display: none"  id="imgtar">
    <div style="width: 200px;right: 35px;position: absolute;z-index:1;top:27px;">
        <h2 style="font-size: 15px;font-weight:100" id="textover">Ver detalle de compra</h2>
    </div>
    <img src="{{asset('image/svg/menu2.svg')}} " style="width: 17px;right: 10px;top:25px;position: absolute;z-index: 99999;padding: 15px;border-radius: 50px;background: #282828;cursor: pointer;" onclick="abrir()" id="circlever">

</div>
<div id="charge-error">{{Session::get('error')}} </div>

<div style="position:relative; min-width:850px;max-width:850px; box-sizing:border-box; padding:20px 20px 30px; width: 100%; position: relative;display: inline-block;margin:0px;margin-top: 20px;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;border:none;float:left" id="clicka" >
    <h2 style="margin:0px;padding-top: 10px;font-size: 20px;font-weight: 100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif " id="dir">COMPRA REALIZADA CON ÉXITO</h2>
     <div id="datar">

    <div style="position: relative;width:100%;margin-top:20px">
        <a href=""><div class="envio done" style="">
            Ver pedido <img src="{{asset('image/svg/ver-pedido.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
        </div></a>
        <a href="{{url('busco')}} "><div class="envio done" style="margin-left:15px;">
            Continuar comprando <img src="{{asset('image/svg/continuar-comprando.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
        </div></a>
        <div class="envio done" style="margin-top:15px;">
            Tiempo de procesamiento <img src="{{asset('image/svg/tiempo.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
        </div>
        <div class="envio done" style="margin-left:15px;margin-top:15px">
            Suscribirme Premium<img src="{{asset('image/svg/suscripcion.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
        </div>
    </div>


    </div>
    <div style="position: absolute;top:0px;right:100px; " id="notificacion"  class="content" >
        <div style="position:absolute;display: block;margin: auto;width: 30%;height:100px;padding:20px;box-sizing:border-box;border-radius: 10px;">
             <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" style="position: relative; margin: 0px;float: left;">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>

            <h6 style="font-size: 20px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;position: relative;/* width: 100%; */margin: 0px;font-weight: 100;margin-top: 10px;color: white;margin-left: 40px;/* padding-left: 20px; */float: left;top: 7px;">{{session('success') }} </h6>
        </div>
    </div>


    <!-- - - - -- ------------------------- ------  -------------- -->
    


    
</div>
<div style="margin-left:20px; box-sizing:border-box;width: 330px; position: relative;display: inline-block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;border:none;margin-top:20px;height:100px;" >
    <img src="{{asset('image/svg/cerrar.svg')}} " style="width: 17px;right: 10px;top:10px;position: absolute;z-index: 99999;display: none;cursor: pointer;"  onclick="closes()" id="cerrar">
    @if (isset($data->dataMap)) 
            @if ($data->dataMap->ACTION_CODE == "000")  

    <div style="position: absolute;right: 0px; display: block;box-sizing:border-box; width:330px;top:-20px;padding:30px;border:1px solid #cecece;padding-top: 20px;border-radius: 7px;margin-top: 20px;background: white;display: block;border: 1px solid #cacaca;border-radius:5px;box-shadow:1px 1px 4px #cacaca" id="todo">

        <div style="position: absolute;top:20px;font-size: 12px;color:#282828"> Compra Exitosa</div>
        @php
        $c = preg_split('//', $data->dataMap->TRANSACTION_DATE, -1, PREG_SPLIT_NO_EMPTY)
        @endphp

        
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 20px;">
            <div style="font-size: 15px;line-height: 15px;color:#282828;letter-spacing: 0;line-height: 15px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; margin: 0px;">{{$data->dataMap->ACTION_DESCRIPTION}}</div>
            <div style="font-size: 10px;line-height: 10px;color:#282828;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif ">{{$purchaseNumber}}</div>
            
           
            <div style="color:#282828;text-align: center;font-size: 11px;font-weight: 100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">{{$data->dataMap->CARD." (".$data->dataMap->BRAND.")"}}</div>

        </div>

             <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 10px;padding-top: 0;border-bottom: 1px solid #808080;box-sizing: border-box;">
                <h1 style="position: relative;width: 100%;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:black;font-size: 15px; margin: 0;text-align:center; ">TOTAL CANCELADO: </h1>
                <h1 style="position: relative;width: 100%;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:black;font-size: 15px; margin: 0;text-align:center">{{number_format($data->order->amount,2). " ".$data->order->currency}} </h1>
                <div style="position:absolute;bottom:-20px;right:0px; font-size: 10px;line-height: 10px;color:#282828;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif ">{{$c[4].$c[5]."/".$c[2].$c[3]."/".$c[0].$c[1]." ".$c[6].$c[7].":".$c[8].$c[9].":".$c[10].$c[11]}}</div>
            
            </div>
    </div>
        @endif

    @else
    <div style="position: absolute;right: 0px; display: block;box-sizing:border-box; width:330px;top:-20px;padding:30px;border:1px solid #cecece;padding-top: 20px;border-radius: 7px;margin-top: 20px;background: white;display: block;border: 1px solid #cacaca;border-radius:5px;box-shadow:1px 1px 4px #cacaca" id="todo">

        
        @php
        $c = preg_split('//', $data->data->TRANSACTION_DATE, -1, PREG_SPLIT_NO_EMPTY)
        @endphp

        
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 20px;">
            <div style="font-size: 15px;line-height: 15px;color:#282828;letter-spacing: 0;line-height: 15px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; margin: 0px;">{{$data->data->ACTION_DESCRIPTION}}</div>
            <div style="font-size: 10px;line-height: 10px;color:#282828;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif ">{{$purchaseNumber}}</div>
            
           
            <div style="color:#282828;text-align: center;font-size: 11px;font-weight: 100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">{{$data->data->CARD." (".$data->data->BRAND.")"}}</div>

        </div>

             <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 10px;padding-top: 0;border-bottom: 1px solid #808080;box-sizing: border-box;">
                <div style="position:absolute;bottom:-20px;right:0px; font-size: 10px;line-height: 10px;color:#282828;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif ">{{$c[4].$c[5]."/".$c[2].$c[3]."/".$c[0].$c[1]." ".$c[6].$c[7].":".$c[8].$c[9].":".$c[10].$c[11]}}</div>
            
            </div>
    </div>
    @endif    
</div>
<script src="{{asset('js/jquery.min.js')}} "></script>

<script src="{{asset('js/main2.js')}} "></script>

<script type="text/javascript">
	function abrir(){
		document.getElementById('todo').style.display="block";
		document.getElementById('cerrar').style.display="block";
		document.getElementById('textover').style.display="none";
		document.getElementById('circlever').style.display="none";
	}
	function closes(){
		document.getElementById('todo').style.display="none";
		document.getElementById('cerrar').style.display="none";
		document.getElementById('textover').style.display="block";
		document.getElementById('circlever').style.display="block";
	}

    function targetinfo(){
        document.getElementById('datar').style.display="none";
        document.getElementById('dir').style.display="none";
        document.getElementById('dirr').style.display="block";
        document.getElementById('posstarget').style.display="block";
        document.getElementById('clicka').style.border="2px solid #ba1f1f";
        document.getElementById('clicka').style.boxShadow="1px 1px 4px #ba1f1f";
        document.getElementById('clicka').style.cursor ="pointer";
        document.getElementById('dirr').style.fontWeight="600";
        document.getElementById('imgtar').style.display="block";
        document.getElementById('imgsen').style.display="none";
        $('#clicka').addClass("coverr");
    }
    function modify(){
        document.getElementById('datar').style.display="block";
        document.getElementById('dir').style.display="block";
        document.getElementById('dirr').style.display="none";
        document.getElementById('posstarget').style.display="none";
        document.getElementById('clicka').style.border="1px solid #cacaca";
        document.getElementById('clicka').style.boxShadow="1px 1px 4px #cacaca";
        document.getElementById('clicka').style.cursor ="auto";
        document.getElementById('dirr').style.fontWeight="600";
        document.getElementById('imgtar').style.display="none";
        document.getElementById('imgsen').style.display="block";
        $('#clicka').removeClass("coverr");
    }
</script>



