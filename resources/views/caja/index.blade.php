<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oberlu</title>
    <link rel="shortcut icon" href="https://oberlu.com/image/oberlu.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="UmOFMXgUENBKhvkGn0mHKUv5OINEyd69Iox5iHog">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://oberlu.com/css/fonts.css " rel="stylesheet">
    <!-- Styles -->

    <style>
        *{
            padding: 0;
            margin:0;
            box-sizing: border-box;
            font-family: 'Kanit';
            text-decoration:none;
        }
    </style>
        <style type="text/css">
        img {
            max-width:  200px;
            max-height: 200px;
        }


           #menum{
    position: absolute;
    height: 35vh;
    display: block;
    width: 320px;
    margin-left: -500px;
    color: #282828;
    transition: .5s;
    background: rgba(256,256,256,0.90);
    top: 60px;
    border-radius: 20px;
    padding: 20px;
}
#menum a{
    width: 100%;
    position: relative;
    display: block;
    padding: 10px;
}
.config h4{
    line-height: 40px;
}
.precioreal{
   top:65px; left:120px;
}
.stock{
    top:65px;
    left: 200px;
}
.codigo{
    left: 120px;
    top:95px;
}
#finder {
    background: none;
    width: 200px;
    margin-left: 60px;
    margin-top: 15px;


}
#finder:focus{
    background: white;
    width: 100%;
    margin-left: 0px;
    margin-top: 0px;
    padding: 18px;
}
#menum{
    padding-top: 150px;
}
#menum a{
    color: #fff;
    font-size: 20px;
    text-align: center;
}
.cerrar-sesion{
    position: relative;
    float:left;width: 130px;
     padding:5px;font-family:'Dosis';
     font-size: 18px;
     background: none;
     text-align: center;
     color:#000;
     font-weight: bold;margin:0px;
     border-radius: 20px;border: 2px solid #000;
}
.numbers{
    position: absolute;
    top: -20px;
}
.inputnumbers{
    width:100px;
    position: relative;
}
.form-control{
    width: 100px;
}
.addname{
    width: 100%;
}
.grid_articulo:hover {
    background: #f2f2f2;
    box-shadow: 1px 1px 4px #dedede;
    border-radius: 0px;
}
        .le{
            position: relative;width: 50%;box-sizing: border-box;float: left;
        }
        .le h5{
            font-size: 15px;
            padding-left: 20px;
        }
        .ri{
            position: relative;width: 50%;box-sizing: border-box;float: right;
        }
        .ri h5{
            font-size: 15px;

        }
       </style>
       <style type="text/css">
           #menum{
    position: absolute;
    height: 35vh;
    display: block;
    width: 320px;
    margin-left: -500px;
    color: #282828;
    transition: .5s;
    background: rgba(256,256,256,0.90);
    top: 60px;
    border-radius: 20px;
    padding: 20px;
}
#menum a{
    width: 100%;
    position: relative;
    display: block;
    padding: 10px;
}
.config h4{
    line-height: 40px;
}
.precioreal{
   top:65px; left:120px;
}
.stock{
    top:65px;
    left: 200px;
}
.codigo{
    left: 120px;
    top:95px;
}
#searchid {
    background: none;
    width: 200px;
    margin-left: 60px;
    margin-top: 15px;
    transition: .5s;
    margin:0px;
    margin-left: 60px;

}
#searchid:focus{
    background: white;
    width: 100%;
    margin-left: 0px;
    margin-top: 0px;
    padding: 18px;
}
#menum{
    padding-top: 150px;
}
#menum a{
    color: #fff;
    font-size: 20px;
    text-align: center;
}
.cerrar-sesion{
    position: relative;
    float:left;width: 130px;
     padding:5px;font-family:'Dosis';
     font-size: 18px;
     background: none;
     text-align: center;
     color:#000;
     font-weight: bold;margin:0px;
     border-radius: 20px;border: 2px solid #000;
}
.numbers{
    position: absolute;
    top: -20px;
}
.inputnumbers{
    width:100px;
    position: relative;
}
.form-control{
    width: 100px;
}
.addname{
    width: 100%;
}
.buscador{
    z-index: 999999;
    position: absolute;
    left: 0px;
    margin: 0px;
    width: 100%;
    border: none;
}
.subfecha2{
    position: absolute;top:20px;left: 40px;
}
       </style>
<style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style></head>

<body>

    <div style="box-shadow: 2px 2px 15px #2176dd; width:100%;background: linear-gradient(to right, #2176dd 0%,#1257a5 100%);height:130px;padding:20px 20px 0px 20px;  ">
        <div style="display:flex;width:100%;">
            <div style="width:20%"><img src="https://oberlu.com/image/svg/arrow-white.svg " alt="" style="width:25px"></div>
            <div id="monto" style="width:60%;text-align:center;font-size:25px;color:#1f7ce8;border:1px solid #1f7ce8;border-radius:5px" >{{number_format($ingreso,2) }} </div>
            <div id="egg" style="width:60%;text-align:center;font-size:25px;color:#1f7ce8;border:1px solid #1f7ce8;border-radius:5px;display:none">{{number_format($egreso,2) }} </div>
            <div onclick="" style="width:10%"><a href="{{url('entradas/create')}} "><img src="{{asset('image/svg/agregar.svg')}} " alt="" style="width:25px;float:right"></a></div>
            <div onclick="force()" style="width:10%"><img src="https://oberlu.com/image/svg/menu2.svg" alt="" style="width:25px;float:right"></div>

        </div>
        <div style="display:flex;width:100%;align-items:center;justify-content:center;height:50px;margin-top:30px ">
            <div id="user" onclick="us()" style="transition: .2s; width:30%;text-align:center;font-size:22px;border-bottom:#fff solid 5px;color:white;padding-bottom: 13px;">Ingresos</div>
            <div id="supplier" onclick="sup()" style="transition: .2s;width:30%;text-align:center;font-size:22px;color:white">Egresos</div>

        </div>
    </div>
    <div id="users" style="position:relative;margin-top:50px;width:100%;">
        <div style="position:relative;margin:auto;display:flex;width:85%">
            <div style="width:60%;text-align:center;color:#808080">
                Detalle
            </div>
            <div style="width:40%;text-align:center;color:#808080">
                Monto
            </div>
        </div>
        <!-- FOR EEACH -->
        @foreach ($entradas as $entrada)
        <div style="background-image: radial-gradient(circle farthest-side at 398px 95px ,#2176dd 50%, rgba(199, 212, 16, 0) 50%,#fff 50%); position:relative;margin:auto;margin-top:15px;width:85%;border:1px solid #cacaca;padding:10px;box-shadow:1px 1px 6px #cacaca;border-radius:10px;display:flex;justify-content:center;align-items:center">

            <div style="width:60%;text-align:justify;display:flex;flex-direction:column">
                <div style="font-size:12px;text-align:left;margin-bottom:5px">
                   {{$entrada->created_at}}
                </div>
                {{$entrada->detalle}}
            </div>
            <div style="width:40%;text-align:right;color:white;">
                {{number_format($entrada->monto,2)}} PEN
            </div>
        </div>
        @endforeach


        <!-- END ------------------------ FOR EEACH -->
    </div>

    <div id="suppliers" style="display:none; position:relative;margin-top:50px;width:100%;">
        <div style="position:relative;margin:auto;display:flex;width:85%">
            <div style="width:60%;text-align:center;color:#808080">
                Detalle
            </div>
            <div style="width:40%;text-align:center;color:#808080">
                Monto
            </div>
        </div>
        <!-- FOR EEACH -->
        @foreach ($salidas as $salida)
        <div style="background-image: radial-gradient(circle farthest-side at 398px 95px ,#2176dd 50%, rgba(199, 212, 16, 0) 50%,#fff 50%); position:relative;margin:auto;margin-top:15px;width:85%;border:1px solid #cacaca;padding:10px;box-shadow:1px 1px 6px #cacaca;border-radius:10px;display:flex;justify-content:center;align-items:center">

            <div style="width:60%;text-align:justify;display:flex;flex-direction:column">
                <div style="font-size:12px;text-align:left;margin-bottom:5px">
                    {{$salida->created_at}}
                </div>
                {{$salida->detalle}}
            </div>
            <div style="width:40%;text-align:right;color:white;">
                {{number_format($salida->monto,2)}} PEN
            </div>
        </div>
        @endforeach
        <!-- END ------------------------ FOR EEACH -->
    </div>

    <script type="text/javascript">
        function us(){
            document.getElementById("user").style.borderBottom = "#fff solid 5px";
            document.getElementById("user").style.paddingBottom = "13px";
            document.getElementById("supplier").style.borderBottom = "none";
            document.getElementById("supplier").style.paddingBottom = "0px";

            document.getElementById("users").style.display = "block";
            document.getElementById("suppliers").style.display = "none";

            document.getElementById("egg").style.display = "none";
            document.getElementById("monto").style.display = "block";
        }
        function sup(){
            document.getElementById("supplier").style.borderBottom = "#fff solid 5px";
            document.getElementById("supplier").style.paddingBottom = "13px";
            document.getElementById("user").style.borderBottom = "none";
            document.getElementById("user").style.paddingBottom = "0px";

            document.getElementById("users").style.display = "none";
            document.getElementById("suppliers").style.display = "block";

            document.getElementById("egg").style.display = "block";
            document.getElementById("monto").style.display = "none";
        }




    </script>
</body>
</html>
