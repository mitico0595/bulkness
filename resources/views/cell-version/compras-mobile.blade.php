<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Oberlu - admin</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset ('css/app.css')}}" >
        <style type="text/css">
            *{
                box-sizing: border-box;
            }
            .subgrid{
                position: relative;
            display: inline-block;
            float: left;
            border: none;
            width: 100%;
            border-bottom: 1px solid #969696;
            margin-top: 60px;
             padding: 10px;
            box-shadow: 0px 6px 20px -5px rgb(0 0 0 / 50%);
            }
            .inputcreate{
                padding: 10px;

            }
            .inputcreate input{
                border:none;
                border-bottom: 1px solid black;
                width: 50px;
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
    padding: 0px;
    padding-top: 150px;
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
       
        </style>
    </head>
    <body>

    <div style="position: absolute;width:40px;top:10px ;left:10px;z-index: 9999999">            
                <svg class="h-6 w-6" stroke="#282828" fill="none" viewBox="0 0 24 24" onclick="force()">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />                                     
                </svg>            
    </div>  
    <div id="soli" style="line-height: 60px;position: absolute;left: 60px;font-size: 25px;" ><div class="ellipsis">Registro de compras</div> 
    </div>
    <a href="" class="add_ad"  data-toggle="modal" data-target="#create" style="position: absolute;right:10px; font-size: 40px;top:-5px;">
        +</a>
    <div id="crudgasto" class="con_articulo" style="width:90%; position: absolute; display: block;margin-top: 0px;padding: 20px;padding-left: 50px;">
        <div v-for="item in gastos" class="grid_envio" style="position: relative;width: 100%;display: block;float: left;"> 
                    <div class="subgrid">
                    <h3 style="font-size: 15px;">@{{item.created_at | formatDate}}</h3>
                    <h3 class="" style="width:100%;">@{{item.name}}</h3>
                    <h3 class="" style="width: 100%;font-size: 17px;">@{{item.costo}} USD</h3>
                    <h3 class="" style="width: 100%;font-size: 17px;">@{{item.tipousd}}</h3>
                    <h3 class="" style="width:70px;">@{{item.cantidad}} u.</h3>
                    <h3 class="" style="width: 100%;text-align: right;padding: 10px;background: rgb(40, 40, 40);color: rgb(255, 255, 255);border-radius: 10px;position: absolute;box-shadow: 0px 6px 20px -5px rgb(0 0 0 / 50%);">@{{item.gasto_total}} PEN</h3>
                    
                    
                    <!-- DATA SHOW -->  
                    </div>
        </div> 
        @include('gasto.create') 
    </div>
    <div id="menum" style="position: fixed;top:0px;z-index: 9999999;height: 100vh;background:  linear-gradient(135deg, rgba(19,84,122,1) 0%,rgba(3,150,255,1) 100%);border-radius: 0px;width: 100%;color:white; ">
            <img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 30px;position: absolute;top:20px;right: 20px;" onclick="leftclose()">
            <div id="menu-cont" style="position: absolute;width: 100%;transition: .5s;">
            <div style="position: relative;">
            <a  href="{{url('admin-mobile')}} ">Home</a>
            <a onclick="detail_inv()"style="font-weight: bold;"  id="inv">Inversion</a>

            <a onclick="detail_ven()">Ventas</a> 
            <a href="{{url('usuario-mobile')}}">Usuarios</a>                        
            <a >Configuracion</a>
            </div>
            </div>
            <div id="menu-sub1" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
            <div style="position: relative;">
            
            <a  id="inv" style="font-weight: bold;">Compras</a>

            <a href="{{url('product-mobile')}} ">Productos</a> 
            <a onclick="back1()" style="color:black">Back</a>
            </div>
            </div>
            <div id="menu-sub2" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
            <div style="position: relative;">
            
            <a  id="inv" href="{{url('venta-mobile')}} ">Ventas</a>

            <a href="{{url('envio-mobile')}}">Envios</a> 
            <a onclick="back2()" style="color:black">Back</a>
            </div>
            </div>
            <div style="position: absolute;bottom:50px;left: 0px;width: 100%;">
            <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" style="width: 150px;position: relative;display: block;margin: auto;"> 
                <div style="" class="cerrar-sesion">Cerrar Sesion</div>
            </a>
            </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                        </form>
            
          
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript">
    function detail_inv(){
        document.getElementById("menu-cont").style.left = "-500px";
        document.getElementById("menu-sub1").style.right = "0px";
    }
    function back1(){
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub1").style.right = "-500px";
    }
    function detail_ven(){
        document.getElementById("menu-cont").style.left = "-500px";
        document.getElementById("menu-sub2").style.right = "0px";
    }
    function back2(){
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub2").style.right = "-500px";
    }
    function leftclose(){
        document.getElementById("menum").style.marginLeft = "-500px";
        document.getElementById("menu-sub1").style.right = "-1000px";
        document.getElementById("menu-sub2").style.right = "-1000px";
    }
    function force(){              
        document.getElementById("menum").style.marginLeft = "0px";  
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub2").style.right = "-500px";
        document.getElementById("menu-sub1").style.right = "-500px";         
            
    }
</script>


</body>
</html>