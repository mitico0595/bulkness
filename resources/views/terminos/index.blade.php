<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>@include ('title')</title>
    @include ('logo')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/terminos.css')}} ">
</head>
<body>
    <div class="top-sear">
        <div class="sub-object">
            <a href="{{url('/')}}"><img src="{{asset('image/oberlu_logo.png')}} " style="position: relative;float:left;width: 190px;z-index: 999;margin-top:10px;"></a>
            
        </div>
    </div>
    <div class="bottom-sec">
        <div class="sub-object" >
            <div class="flex1" style="height:1000px" >
                <ul class="lista" style="position:sticky;display:inline-block;top:-20px;">
                    <a href="{{url('terminos/garantia')}}" style="text-decoration:none;color:black"><li @if (request()->is('terminos/garantia')) style="color:#d81c1c;" @endif><span style="">1.</span><h5 @if (request()->is('terminos/garantia')) style="font-weight:600;" @endif>Términos y condiciones de garantía</h5></li></a> 
                    <a href="{{url('terminos/uso')}}" style="text-decoration:none;color:black"><li @if (request()->is('terminos/uso')) style="color:#d81c1c;" @endif><span style=";">2.</span><h5 @if (request()->is('terminos/uso')) style="font-weight:600;" @endif>Términos y condiciones de uso</h5></li></a>
                    <a href="{{url('terminos/contra-entrega')}}" style="text-decoration:none;color:black"><li @if (request()->is('terminos/contra-entrega')) style="color:#d81c1c;" @endif><span style=";">3.</span><h5 @if (request()->is('terminos/contra-entrega')) style="font-weight:600;" @endif>Condiciones de Contra-entrega</h5></li></a>
                    <a href="{{url('terminos/condiciones-envio')}}" style="text-decoration:none;color:black"><li @if (request()->is('terminos/condiciones-envio')) style="color:#d81c1c;" @endif><span style=";">4.</span><h5 @if (request()->is('terminos/condiciones-envio')) style="font-weight:600;" @endif>Condiciones de envío</h5></li></a>
                    <a href="{{url('terminos/condicion-premium')}}" style="text-decoration:none;color:black"><li @if (request()->is('terminos/condicion-premium')) style="color:#d81c1c;" @endif><span style=";">5.</span><h5 @if (request()->is('terminos/condicion-premium')) style="font-weight:600;" @endif>Terminos y condiciones Usuarios Premium</h5></li></a>
                    <a href="{{url('terminos/politica')}}" style="text-decoration:none;color:black"><li @if (request()->is('terminos/politica')) style="color:#d81c1c;" @endif><span style=";">6.</span><h5 @if (request()->is('terminos/politica')) style="font-weight:600;" @endif>Política de privacidad</h5></li></a>
                    <a href="{{url('terminos/informacion-legal')}}" style="text-decoration:none;color:black"><li @if (request()->is('terminos/informacion-legal')) style="color:#d81c1c;" @endif><span style=";">7.</span><h5 @if (request()->is('terminos/informacion-legal')) style="font-weight:600;" @endif>Información de terminos legales</h5></li></a>
                    <a href="{{url('terminos/propiedad-intelectual')}}" style="text-decoration:none;color:black"><li @if (request()->is('terminos/propiedad-intelectual')) style="color:#d81c1c;" @endif><span style=";">8.</span><h5 @if (request()->is('terminos/propiedad-intelectual')) style="font-weight:600;" @endif>Derechos de propiedad intelectual</h5></li></a>
                    <a href="{{url('terminos/condiciones-proveedor')}}" style="text-decoration:none;color:black"><li @if (request()->is('terminos/condiciones-proveedor')) style="color:#d81c1c;" @endif><span style=";">9.</span><h5 @if (request()->is('terminos/condiciones-proveedor')) style="font-weight:600;" @endif>Términos y condiciones proveedores</h5></li></a>
                    <a href="{{url('terminos/proteccion-laboral')}}" style="text-decoration:none;color:black"><li @if (request()->is('terminos/proteccion-laboral')) style="color:#d81c1c;" @endif><span style=";">10.</span><h5 @if (request()->is('terminos/proteccion-laboral')) style="font-weight:600;" @endif>Términos y condiciones de protección laboral</h5></li></a>
                    
                </ul>
            </div>
            <div class="flex2" >
            <div >
                @yield ('contenido')     
            </div>
        </div>
       
    </div>
</div>
</body>
</html>