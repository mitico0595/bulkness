<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@include ('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('logo')
    <link rel="stylesheet" type="text/css" href="{{asset('css/auth.css')}} ">
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
        }
        body{
            background: #ededed;
            margin: 0px;
        }
        .boton{
            background:white;
            text-decoration:none;
            color:#b10000;
            font-size:13px;
            font-family:sans-serif;
            border-radius:5px;
            border:2px solid #b10000;
        }
        .boton:hover{
            background:#b10000;
            color:white;
        }
    </style>
    <style type="text/css">

        .allforall{
            position: fixed;
            bottom:0px;
            width: 100%;
            height: 70px;
            background: #fff;
            box-shadow: 1px -2px 5px #cecece;
            left:0px;
        }
        .suball{
            position: relative;
            width:85%;
            display:block;
            margin: auto;
            height: 100%
        }
        .subbase{
            position: relative;
            float: left;
            box-sizing: border-box;
            width:25%;
            min-width: 50px;
        }
        .subbase h6{
            font-size: 12px;
            color: #000;
            font-weight: 100;
            float: left;
            position: absolute;

            bottom:-25px;
            font-family: 'Kanit';

            width: 100%;
            text-align: center;
        }
        .usuario{
            width:30px;
            position: relative;
            margin: auto;
            display: block;
            margin-top: 10px;
        }
        </style>
</head>
<body >
    <div style="position: relative; width:100%;margin:auto;display:block;background:white;box-shadow: 0 1px 2px 0 rgb(0 0 0 / 12%);margin-bottom:70px;">
        <img src="{{asset('image/soporte.jpg')}} " alt="" style="width: 100%;border-radius:10px 10px 0px 0px;">

        <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;border-top: 4px solid #eee;display:inline-block;">
            <div style="position: relative;float:right;width:180px;height:100%;display:inline-block">
                <img src="https://oberlu.com/image/svg/call-centeri.svg " alt="" style="width: 30px;margin-top:35px;">
                <h4 style="position: relative;float:right;font-weight:100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;line-height:95px;color:#666;margin:0">Atención telefónica</h4>
            </div>
            <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;display:inline-block;border:2px solid #b10000;padding:10px;border-radius:5px;" >

                <h5 style="font-family: sans-serif;font-size:20px;font-weight:100;margin-bottom:20px;color:#b10000">Numero empresa:</h5>
                <div style="display: flex;">
                    <img src="{{asset('image/svg/mobile-phone.svg')}} " alt="" style="width: 40px;">
                    <div  style="margin-left: 20px;">
                    <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0;line-height:40px;color:#b10000">(+51) 983 814 992</h5>

                    </div>
                </div>

            </div>
            <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;display:inline-block;" >

                <h5 style="font-family: sans-serif;font-size:20px;font-weight:100;margin-bottom:20px;color:#848484">Horario de atención de Centro de llamadas:</h5>
                <div style="display: flex;">
                    <img src="{{asset('image/svg/fecha-limite.svg')}} " alt="" style="width: 40px;">
                    <div  style="margin-left: 20px;">
                    <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0">Martes a Domingo:</h5>
                    <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0">10 a.m. - 5 p.m.</h5>
                    </div>
                </div>

            </div>
            <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;display:inline-block;" >

                <h5 style="font-family: sans-serif;font-size:20px;font-weight:100;margin-bottom:20px;color:#848484">Canales virtuales:</h5>
                <div style="display: flex;">
                    <img src="{{asset('image/svg/fecha-limite.svg')}} " alt="" style="width: 40px;">
                    <div  style="margin-left: 20px;">
                    <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0">Lunes a Domingo:</h5>
                    <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0">10 a.m. - 10 p.m.</h5>
                    </div>
                </div>

            </div>
            <div>

            </div>
            <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;display:inline-block;" >

                <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin-bottom:20px;color:#848484">Whatsapp: Haga clic en el siguiente botón</h5>
                <div style="display: flex;">

                    <div  style="width:20%;position:relative;margin:auto">
                        <a href="https://wa.me/message/TFPQK4IEKVTFH1"><img src="{{asset('image/whatsapp.jpg')}} " alt="" style="width: 50px;"></a>
                    </div>
                </div>

            </div>
            <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;display:inline-block;" >

                <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin-bottom:20px;color:#848484">Facebook: Comuniquese con alguno de nuestros agentes o con OBERLU BOT</h5>
                <div style="display: flex;">
                    <img src="{{asset('image/svg/facebook.svg')}} " alt="" style="width: 40px;">
                    <div  style="margin-left: 20px;">
                        <a href="https://www.facebook.com/oberlu" style="text-decoration: none;color:rgb(37, 150, 150);line-height:40px;"><h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0">www.facebook.com/oberlu</h5></a>

                    </div>
                </div>

            </div>

        </div>
    </div>
    <div class="allforall">
        <div class="suball">
            <div class="subbase">
           <a href="{{url('/')}} "> <img class="usuario" src="{{asset('image/svg/hogar.svg')}} "></a>
            <h6 >Home</h6>
            </div>
            <div class="subbase">
            <img class="usuario" src="{{asset('image/svg/barmenu.svg')}} " style="padding:5px;">
            <h6>Categorias</h6>
            </div>
            <div class="subbase">
            <img class="usuario" src="{{asset('image/svg/carro.svg')}} ">
            <h6>Cart</h6>
            </div>
            <div class="subbase">
                @if (Auth::check() && auth()->user()->type == "1")
                    <a href="{{url('admin-mobile')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                    @endif
                    @if (Auth::check() == false )
                    <a href="{{url('login')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                    @endif
                    @if (Auth::check() == true && auth()->user()->type == "0" )
                    <a href="{{url('index-profile')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                    @endif
                    @if (Auth::check() && auth()->user()->type == "2" )
                    <a href="{{url('prov-mobile')}}"><img class="usuario" src="{{asset('image/svg/usuario.svg')}} "></a>
                    @endif
            <h6 style="color:black;">Mi cuenta</h6>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', function(){
        var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
        if (isMobile) {
            console.log("Es una movil");


        }
        else {
            window.location.replace("http://www.oberlu.com/soporte");
        }
        })
    </script>
</body>
</html>
