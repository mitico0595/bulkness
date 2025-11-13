<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@include ('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('logo')
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
            font-size:15px;
            font-family:sans-serif;
            border-radius:5px;
            border:2px solid #b10000;
        }
        .boton:hover{
            background:#b10000;
            color:white;
        }
    </style>
</head>
<body >
    <div style="position: relative; width:50%;max-width:1200px;min-width:700px;margin:auto;display:block;background:white; margin-top:50px;box-shadow: 0 1px 2px 0 rgb(0 0 0 / 12%);margin-bottom:50px;border-radius: 6px;border-bottom: 1px solid #eee;">
        <img src="{{asset('image/ubicanos.jpg')}} " alt="" style="width: 100%;border-radius:10px 10px 0px 0px;">

        <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;border-top: 4px solid #eee;display:inline-block;">
            <div style="position: relative;float:right;width:180px;height:100%;display:inline-block">
                <img src="https://oberlu.com/image/svg/mapi.svg " alt="" style="width: 30px;margin-top:30px;">
                <h4 style="position: relative;float:right;font-weight:100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;line-height:95px;color:#666;margin:0">Ubícanos Central</h4>
            </div>
            <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;display:inline-block;" >

                <h5 style="font-family: sans-serif;font-size:20px;font-weight:100;margin-bottom:20px;color:#b10000">Llámenos:</h5>
                <div style="display: flex;">
                    <img src="{{asset('image/svg/mobile-phone.svg')}} " alt="" style="width: 40px;">
                    <div  style="margin-left: 20px;">
                    <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0;line-height:40px;color:#b10000">(+51) 983 814 992</h5>

                    </div>
                </div>

            </div>
            <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;display:inline-block;" >

                <h5 style="font-family: sans-serif;font-size:20px;font-weight:100;margin-bottom:20px;color:#848484">Horario de atención San Miguel:</h5>
                <div style="display: flex;">
                    <img src="{{asset('image/svg/fecha-limite.svg')}} " alt="" style="width: 40px;">
                    <div  style="margin-left: 20px;">
                    <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0">Martes a Domingo:</h5>
                    <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0">2 p.m. - 8 p.m.</h5>
                    </div>
                </div>

            </div>
            <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;display:inline-block;" >

                <h5 style="font-family: sans-serif;font-size:20px;font-weight:100;margin-bottom:20px;color:#848484">Horario de atención Lima Cercado:</h5>
                <div style="display: flex;">
                    <img src="{{asset('image/svg/fecha-limite.svg')}} " alt="" style="width: 40px;">
                    <div  style="margin-left: 20px;">
                    <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0">Lunes a Sábado:</h5>
                    <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0">10 a.m. - 1 p.m.</h5>
                    </div>
                </div>

            </div>
            <div>

            </div>
            
            <div style="width:100%;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 20px;display:inline-block;" >

                <h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin-bottom:20px;color:#848484">Facebook: Comuniquese con alguno de nuestros agentes o con OBERLU BOT</h5>
                <div style="display: flex;">
                    <img src="{{asset('image/svg/facebook.svg')}} " alt="" style="width: 40px;">
                    <div  style="margin-left: 20px;">
                        <a href="https://www.facebook.com/" style="text-decoration: none;color:rgb(37, 150, 150);line-height:40px;"><h5 style="font-family: sans-serif;font-size:15px;font-weight:100;margin:0">www.facebook.com/</h5></a>

                    </div>
                </div>

            </div>
            <a href="{{asset('busco')}}" style="position: absolute;top:35px;left:20px;padding:8px 20px;" class="boton">Continuar comprando</a>
        </div>
    </div>
    <script>
        window.addEventListener('load', function(){
        var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
        if (isMobile) {

            window.location.replace("http://www.oberlu.com/ubicanos-mobile");

        }
        else {
            console.log("Es una pc");

        }
        })
    </script>
</body>
</html>
