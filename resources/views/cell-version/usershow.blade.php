<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@include ('title')</title>
    @include ('logo') 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{asset('css/fonts.css') }} " rel="stylesheet">
    <!-- Styles -->
    
    <style>
        *{
            padding: 0;
            margin:0;
            box-sizing: border-box;
            font-family: 'Kanit';
        }
    </style>
</head>
<body>
    <div style="border-radius:0px 0px 20px 20px; box-shadow: 2px 2px 15px #569ee1; width:100%;background-image: radial-gradient(circle farthest-side at 530px 6px,#569ee1  50%,rgba(199, 212, 16, 0) 50% ,#0f23d8  50%,#3060e4  50%);padding:20px 20px 0px 20px;  " >
        <div style="display:flex;width:100%;" >
            <div style="width:50%" ><img src="{{ asset('image/svg/arrow-white.svg') }} " alt="" style="width:25px"></div>
            <div style="color:white;font-size:17px">Profile</div>
            <div style="width:50%"><img src="{{ asset('image/svg/menu2.svg')}} " alt="" style="width:25px;float:right"></div>
        </div >
        
        <div style="width:100%;margin-top:20px">
            <div style="width:80px;height:80px;background:white;border-radius:40px;margin:auto;" >
                <h2 style="color:#808080;text-align:center;line-height:80px;text-transform:uppercase" >{!! substr(($personas->name),0,1) !!}{!! substr(($personas->lastname),0,1) !!}</h2>
            </div>
        </div>
        <div style="width:100%;margin-top:12px;text-align:center;color:white;font-size:18px">
            {{$personas->name}} {{$personas->lastname}}
        </div>
        <div style="width:100%;margin-top:0px;text-align:center;color:white;font-size:14px">
            {{(\Carbon\Carbon::parse($personas->created_at)->diffInMonths($hoy))}} meses
        </div>
        <div style="display:flex;width:100%;align-items:center;justify-content:center;height:50px;margin-top:30px " >
            <div id="user" onclick="us()" style="transition: .2s; width:30%;text-align:center;font-size:22px;border-bottom:#fff solid 5px;color:white;padding-bottom: 13px;" >Info</div>
            <div id="supplier" onclick="sup()" style="transition: .2s;width:30%;text-align:center;font-size:22px;color:white">Stata</div>
            <div id="admin" onclick="adm()" style="transition: .2s;width:30%;text-align:center;font-size:22px;color:white">Permisos</div>
        </div>
    </div>
    <div id="users" style="position:relative;width:100%;padding:10px;margin-top:15px">           
        <!--  section each ---------------->
        
        <div style="display:flex;flex-direction: column; width:90%;margin:auto;align-items:center;justify-content:center; " >
            <div style="display:flex;width:100%;height:80px;border-bottom:1px solid #dbdbdb;margin-top:10px" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/email.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        E-mail
                    </div>
                    <div style="display:block;width:100%;font-size:17px" >
                        {{$personas->email ?? 'Email no ingresado'}}
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;height:80px;border-bottom:1px solid #dbdbdb;margin-top:10px" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/dni.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        DNI
                    </div>
                    <div style="display:block;width:100%;font-size:17px" >
                        {!! substr(($personas->dni),0,4) !!} {!! substr(($personas->dni),4,8) !!} 
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;height:80px;border-bottom:1px solid #dbdbdb;margin-top:10px" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/charlar.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        Celular
                    </div>
                    <div style="display:block;width:100%;font-size:17px" >
                        (+51) {!! substr(($personas->cell),0,3) !!} {!! substr(($personas->cell),3,3) !!} {!! substr(($personas->cell),6,3) !!}
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;height:80px;border-bottom:1px solid #dbdbdb;margin-top:10px" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/calendario.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        Fecha nacimiento
                    </div>
                    <div style="display:block;width:100%;font-size:17px" >
                        {{$personas->fecha}} de 
            @if($personas->month ==1)
            Enero
            @endif
            @if($personas->month ==2)
            Febrero
            @endif
            @if($personas->month ==3)
            Marzo
            @endif
            @if($personas->month ==4)
            Abril
            @endif
            @if($personas->month ==5)
            Mayo
            @endif
            @if($personas->month ==6)
            Junio
            @endif
            @if($personas->month ==7)
            Julio
            @endif
            @if($personas->month ==8)
            Agosto
            @endif
            @if($personas->month ==9)
            Setiembre
            @endif
            @if($personas->month ==10)
            Octubre
            @endif
            @if($personas->month ==11)
            Noviembre
            @endif
            @if($personas->month ==12)
            Diciembre
            @endif de {{$personas->year}} / {{\Carbon\Carbon::parse($personas->cumpleanos)->age}} años
                    </div>
                </div>
            </div> 
            <div style="display:flex;width:100%;height:80px;border-bottom:1px solid #dbdbdb;margin-top:10px" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/ubicacion.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        Ubicación
                    </div>
                    <div style="display:block;width:100%;font-size:17px" >
                        {{$personas->direccion}}
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;height:80px;border-bottom:1px solid #dbdbdb;margin-top:10px" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/peru.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        Distrito - Provincia - Departamento
                    </div>
                    <div style="display:block;width:100%;font-size:17px" >
                        {{$personas->distrito}} - {{$personas->provincia}} - {{$personas->ciudad}}
                    </div>
                </div>
            </div>
        </div>  
    
        <!--  ----------------------------------------------------------->
    </div> 
    
    <div id="suppliers" style="display:none;position:relative;width:100%;height:150px;padding:10px;margin-top:15px;">   
        
        <!--  section each ---------------->
        
        <div style="position:relative; float: left; margin-left:2.5%; display:flex;width:45%;height:100%;border-radius:20px;align-items:center;justify-content:center;background-image: radial-gradient(circle farthest-side at 5px 48px,#7bd5f5  50%,rgba(199, 212, 16, 0) 50% ,#48d4ff  50%);box-shadow:2px 2px 9px #bababa " >
            <div style="width:40%;" >
                <img src="{{ asset('image/svg/ventasa.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
            <div style="width:60%;text-align:center;font-size:20px;color:white" >
                {{number_format($clientes->total ?? 0 ,2)  }} PEN
            </div>
            <div style="position:absolute;top:5px;left:10px;color:#ebebeb" >TOTAL VENTA</div>
        </div>  
        <div style="position:relative; float: left; margin-left:2.5%; display:flex;width:45%;height:100%;border-radius:20px;align-items:center;justify-content:center;background-image: radial-gradient(circle farthest-side at 5px 48px,#787ff6  50%,rgba(199, 212, 16, 0) 50% ,#4f4dff  50%);box-shadow:2px 2px 9px #bababa " >
            <div style="width:40%;" >
                <img src="{{ asset('image/svg/gananciasa.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
            <div style="width:60%;text-align:center;font-size:20px;color:white" >
                {{number_format($clientes->ganancia ?? 0 ,2)  }} PEN
            </div>
            <div style="position:absolute;top:5px;left:10px;color:#ebebeb" >GANANCIAS</div>
        </div>   
        <div style="position:relative; float: left; margin-left:2.5%; display:flex;width:45%;height:100%;border-radius:20px;align-items:center;justify-content:center;background-image: radial-gradient(circle farthest-side at 5px 48px,#4adede 50%,rgba(199, 212, 16, 0) 50% ,#3ac2c7  50%);box-shadow:2px 2px 9px #bababa;margin-top:15px " >
            <div style="width:40%;" >
                <img src="{{ asset('image/svg/cajas.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
            <div style="width:60%;text-align:center;font-size:25px;color:white" >
                {{$conteo->conteot ?? 0}}
            </div>
            <div style="position:absolute;top:5px;left:10px;color:#ebebeb" >NUMERO VENTAS</div>
        </div>
        <div style="position:relative; float: left; margin-left:2.5%; display:flex;width:45%;height:100%;border-radius:20px;align-items:center;justify-content:center;background-image: radial-gradient(circle farthest-side at 5px 48px,#1ca7ec 50%,rgba(199, 212, 16, 0) 50% ,#1094d6  50%);box-shadow:2px 2px 9px #bababa;margin-top:15px " >
            <div style="width:40%;" >
                <img src="{{ asset('image/svg/bolsi.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
            <div style="width:60%;text-align:center;font-size:25px;color:white" >
                {{$clientes->conteog ?? 0}}
            </div>
            <div style="position:absolute;top:5px;left:10px;color:#ebebeb" >NUMERO PRODUCTOS</div>
        </div>
        <!--  ----------------------------------------------------------->
    </div> 
    <div id="admins" style="display:none;position:relative;width:100%;height:70px;padding:10px;margin-top:15px;">   
        
        <!--  section each ---------------->
        
        
        <div style="background-image: radial-gradient(circle farthest-side at 437px 150px ,#f2f2f2  50%, rgba(199, 212, 16, 0) 50%,#808080  50%);display:flex;width:85%;margin:auto;height:100%;border-radius:10px;align-items:center;box-shadow: 4px 5px 7px #808080;margin-top:15px " >
            <div style="width:20%;" >
                <img src="{{ asset('image/svg/editara.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
            <div style="width:60%;color:white;font-size:20px" >
                Editar
            </div>
            <div style="width:20%;" >
                <img src="{{ asset('image/svg/flecha.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
        </div> 
        <div style="background-image: radial-gradient(circle farthest-side at 440px 81px ,#f2f2f2  50%, rgba(199, 212, 16, 0) 50%,#808080  50%);display:flex;width:85%;margin:auto;height:100%;border-radius:10px;align-items:center;box-shadow: 4px 5px 7px #808080;margin-top:15px " >
            <div style="width:20%;" >
                <img src="{{ asset('image/svg/prohibido.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
            <div style="width:60%;color:white;font-size:20px" >
                Bannear
            </div>
            <div style="width:20%;" >
                <img src="{{ asset('image/svg/flecha.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
        </div> 
        <div style="background-image: radial-gradient(circle farthest-side at 444px 11px ,#f2f2f2  50%, rgba(199, 212, 16, 0) 50%,#808080  50%);display:flex;width:85%;margin:auto;height:100%;border-radius:10px;align-items:center;box-shadow: 4px 5px 7px #808080;margin-top:15px " >
            <div style="width:20%;" >
                <img src="{{ asset('image/svg/tipo.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
            <div style="width:60%;color:white;font-size:20px" >
                Tipo de cuenta
            </div>
            <div style="width:20%;" >
                <img src="{{ asset('image/svg/flecha.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
        </div> 
        <div style="background-image: radial-gradient(circle farthest-side at 445px -55px ,#f2f2f2  50%, rgba(199, 212, 16, 0) 50%,#808080  50%);display:flex;width:85%;margin:auto;height:100%;border-radius:10px;align-items:center;box-shadow: 4px 5px 7px #808080;margin-top:15px " >
            <div style="width:20%;" >
                <img src="{{ asset('image/svg/prima.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
            <div style="width:60%;color:white;font-size:20px" >
                Premium
            </div>
            <div style="width:20%;" >
                <img src="{{ asset('image/svg/flecha.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
        </div> 
        <div style="background-image: radial-gradient(circle farthest-side at 436px -124px ,#f2f2f2  50%, rgba(199, 212, 16, 0) 50%,#808080  50%);display:flex;width:85%;margin:auto;height:100%;border-radius:10px;align-items:center;box-shadow: 4px 5px 7px #808080;margin-top:15px " >
            <div style="width:20%;" >
                <img src="{{ asset('image/svg/regalo.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
            <div style="width:60%;color:white;font-size:20px" >
                Regalos
            </div>
            <div style="width:20%;" >
                <img src="{{ asset('image/svg/flecha.svg') }} " alt="" style="width:50%;display:block;margin:auto" >
            </div>
        </div>
        <!--  ----------------------------------------------------------->
    </div> 
    <div style="">               
    </div>
    <script type="text/javascript">
        function us(){
            document.getElementById("user").style.borderBottom = "#fff solid 5px";
            document.getElementById("user").style.paddingBottom = "13px";
            document.getElementById("supplier").style.borderBottom = "none";
            document.getElementById("supplier").style.paddingBottom = "0px";
            document.getElementById("admin").style.borderBottom = "none";
            document.getElementById("admin").style.paddingBottom = "0px";
            document.getElementById("users").style.display = "block";
            document.getElementById("suppliers").style.display = "none";
            document.getElementById("admins").style.display = "none";
        }
        function sup(){
            document.getElementById("supplier").style.borderBottom = "#fff solid 5px";
            document.getElementById("supplier").style.paddingBottom = "13px";
            document.getElementById("user").style.borderBottom = "none";
            document.getElementById("user").style.paddingBottom = "0px";
            document.getElementById("admin").style.borderBottom = "none";
            document.getElementById("admin").style.paddingBottom = "0px";
            document.getElementById("users").style.display = "none";
            document.getElementById("suppliers").style.display = "block";
            document.getElementById("admins").style.display = "none";
        }
        function adm(){
            document.getElementById("admin").style.borderBottom = "#fff solid 5px";
            document.getElementById("admin").style.paddingBottom = "13px";
            document.getElementById("user").style.borderBottom = "none";
            document.getElementById("user").style.paddingBottom = "0px";
            document.getElementById("supplier").style.borderBottom = "none";
            document.getElementById("supplier").style.paddingBottom = "0px";
            document.getElementById("admins").style.display = "block";
            document.getElementById("users").style.display = "none";
            document.getElementById("suppliers").style.display = "none";
        }



    </script>
</body>
</html>