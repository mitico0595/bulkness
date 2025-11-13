<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@include ('title')</title>
    @include ('logo')
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}" >
</head>
<body style="background:black">



<div style="position:fixed;width:100%;left:0px;height:100px;z-index:9999">
<div style="position: relative; margin: auto;max-width: 1200px;height:100%">

    <div style="position:relative;float:right;display:inline-block">
        <div style="position: relative;float:left;width:180px;height:100%;">
            <img src="{{asset('image/svg/call-centeri.svg')}} " alt="" style="width: 30px;margin-top:35px;">
            <h4 style="position: relative;float:right;display:inline-block;font-weight:100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;line-height:95px;color:#666;margin:0">Asesoría telefónica</h4>
        </div>
        <div style="position: relative;float:left;width:155px;margin-left:25px;height:100%;">
            <img src="{{asset('image/svg/seguro.svg')}} " alt="" style="width: 30px;margin-top:35px;">
            <h4 style="position: relative;float:right;display:inline-block;font-weight:100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;line-height:95px;color:#666;margin:0">Compra seguro</h4>

        </div>
    </div>

    <div style="position:relative;width:100%;height:auto;display:inline-block;margin-top:20px;">
        <div style="position:relative;width:100%;margin:auto;display:block; ">
            <div style="position:relative:width:100%;display:block; ">
                <div style="display:flex;position:relative;justify-content:center;align-items:center;width:100%">

                        <img src="{{asset('image/oberlu_logo.png')}}" style="width:450px" alt="">

                    <div style="display:flex;justify-content:center;align-items:center;width:450px">
                        <img src="{{asset('image/binance.png')}}" style="width:150px" alt="">
                        <h1 style="width:250px;font-size:35px;margin-left:20px;color:white;font-family:'Kanit'">BINANCE PAY</h1>
                    </div>

                </div>
            </div>
            <div style="position:relative;width:650px;height:200px;border-radius:20px;border: 3px solid #f2d42e;margin:auto;margin-top:150px " >
                <h2 style="position:relative;font-size:25px;width:100%;text-align:center;color:white;margin:0;margin-top:20px" >PAGO REALIZADO CON EXITO</h2>
                <h2 style="position:relative;font-size:45px;width:100%;text-align:center;color:white" >{{$id}} USDT </h2>
                <div style="position: relative;margin:auto;background:black;width:300px;height:50px;margin:auto;border:3px solid #f2d42e;border-radius:10px;color:white;text-align:center;line-height:50px;font-size:20px" >
                    VER PEDIDO
                </div>
            </div>
        </div>
    </div>
</div>
</div>












<!------------------------------------ ----------------- ---------------- - - - - - --- - - ---------------------------->




<!-- --------------------------------------------------------------->




</body>
</html>
