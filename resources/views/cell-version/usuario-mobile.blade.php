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
</head>
<body>
    <div style="box-shadow: 2px 2px 15px #b10000; width:100%;background: linear-gradient(to right, #c60122 0%,#ff0004 100%);height:130px;padding:20px 20px 0px 20px;  " >
        <div style="display:flex;width:100%;" >
            <div style="width:50%" ><img src="{{ asset('image/svg/arrow-white.svg') }} " alt="" style="width:25px"></div>
            <div onclick="force()" style="width:50%"><img src="{{ asset('image/svg/menu2.svg')}} " alt="" style="width:25px;float:right"></div>
        </div>
        <div style="display:flex;width:100%;align-items:center;justify-content:center;height:50px;margin-top:30px " >
            <div id="user" onclick="us()" style="transition: .2s; width:30%;text-align:center;font-size:22px;border-bottom:#fff solid 5px;color:white;padding-bottom: 13px;" >Users</div>
            <div id="supplier" onclick="sup()" style="transition: .2s;width:30%;text-align:center;font-size:22px;color:white">Suppliers</div>
            <div id="admin" onclick="adm()" style="transition: .2s;width:30%;text-align:center;font-size:22px;color:white">Admin</div>
        </div>
    </div>
    <div id="users" style="position:relative;width:100%;padding:10px;margin-top:15px;margin-bottom:50px">   
        
        <!--  section each ---------------->
        @foreach ($users as $user)
        @if($user->type == "0")
        <a href="{{url('user-mobile/'.$user->id.'/showMobile')}} "><div style=" background-image: radial-gradient(circle farthest-side at 437px 150px ,#569ee1  50%, rgba(199, 212, 16, 0) 50%,#3060e4  50%);display:flex;width:85%;margin:auto;height:140px;border-radius:20px;align-items:center;justify-content:center;box-shadow: 4px 5px 7px #808080;margin-top:15px; " >
            <div style="width:25%;margin-top:-40px">
                <div style="width:60px;height:60px;background:white;border-radius:30px;margin:auto;" >
                    <h2 style="color:#808080;text-align:center;line-height:60px;text-transform:uppercase" >{!! substr(($user->name),0,1) !!}{!! substr(($user->lastname),0,1) !!} </h2>
                </div>
            </div>
            <div style="width:50%;">
                <div style="width:100%;display:block;font-size:15px;color:white">
                    {{$user->name}} {{$user->lastname}}
                </div>
                <div style="width:100%;display:block;font-size:12px;color:white">
                    Cell: {!! substr(($user->cell),0,3) !!} {!! substr(($user->cell),3,3) !!} {!! substr(($user->cell),6,3) !!}
                </div>
                <div style="width:100%;display:flex;height:40px;margin-top:20px" >
                    <div style="width:30%;text-align:center;" >
                        <div style="width:100%;font-size:12px;color:white" >250</div>
                        <div style="width:100%;font-size:10px;color:white" >Ganancia</div>
                    </div>
                    <div style="width:30%;text-align:center;" >
                        <div style="width:100%;font-size:12px;color:white" >25</div>
                        <div style="width:100%;font-size:10px;color:white" >Ventas</div>
                    </div>
                    <div style="width:30%;text-align:center;" >
                        <div style="width:100%;font-size:12px;color:white" >10</div>
                        <div style="width:100%;font-size:10px;color:white" >Individual</div>
                    </div>
                    
                </div>
            </div>
            <div style="width:25%;text-align:center;" >
                <div style="width:100%;font-size:15px;color:white" >{{ $user->dni }}</div>
                <div style="width:100%;font-size:10px;color:white" >Indentificador</div>
            </div>
        </div>  
        </a> 
        @endif
        @endforeach
        <!--  ----------------------------------------------------------->
    </div> 
    
    <div id="suppliers" style="display:none;position:relative;width:100%;padding:10px;margin-top:15px;margin-bottom:50px">   
        
        <!--  section each ---------------->
        @foreach ($users as $user)
        @if($user->type == "2")
        <a href="{{url('user-mobile/'.$user->id.'/showMobile')}} "><div style="background-image: radial-gradient(circle farthest-side at 437px 150px ,#e1cc56  50%, rgba(199, 212, 16, 0) 50%,#e4d830  50%);display:flex;width:85%;margin:auto;height:140px;border-radius:20px;align-items:center;justify-content:center;box-shadow: 4px 5px 7px #808080;margin-top:15px; " >
            <div style="width:25%;margin-top:-40px">
                <div style="width:60px;height:60px;background:white;border-radius:30px;margin:auto;" >
                    <h2 style="color:#808080;text-align:center;line-height:60px;text-transform:uppercase" >{!! substr(($user->name),0,1) !!}{!! substr(($user->lastname),0,1) !!} </h2>
                </div>
            </div>
            <div style="width:50%;">
                <div style="width:100%;display:block;font-size:15px;color:white">
                    {{$user->name}} {{$user->lastname}}
                </div>
                <div style="width:100%;display:block;font-size:12px;color:white">
                    Cell: {!! substr(($user->cell),0,3) !!} {!! substr(($user->cell),3,3) !!} {!! substr(($user->cell),6,3) !!}
                </div>
                <div style="width:100%;display:flex;height:40px;margin-top:20px" >
                    <div style="width:30%;text-align:center;" >
                        <div style="width:100%;font-size:12px;color:white" >250</div>
                        <div style="width:100%;font-size:10px;color:white" >Ganancia</div>
                    </div>
                    <div style="width:30%;text-align:center;" >
                        <div style="width:100%;font-size:12px;color:white" >25</div>
                        <div style="width:100%;font-size:10px;color:white" >Ventas</div>
                    </div>
                    <div style="width:30%;text-align:center;" >
                        <div style="width:100%;font-size:12px;color:white" >10</div>
                        <div style="width:100%;font-size:10px;color:white" >Individual</div>
                    </div>
                    
                </div>
            </div>
            <div style="width:25%;text-align:center;" >
                <div style="width:100%;font-size:15px;color:white" >{{ $user->dni }}</div>
                <div style="width:100%;font-size:10px;color:white" >Indentificador</div>
            </div>
        </div> 
        </a>
        @endif
        @endforeach
         
    
        <!--  ----------------------------------------------------------->
    </div> 
    <div id="admins" style="display:none;position:relative;width:100%;padding:10px;margin-top:15px;margin-bottom:50px">   
        
        <!--  section each ---------------->
        @foreach ($users as $user)
        @if($user->type == "1")
        <a href="{{url('user-mobile/'.$user->id.'/showMobile')}} "><div style="background-image: radial-gradient(circle farthest-side at 437px 150px ,#e17256  50%, rgba(199, 212, 16, 0) 50%,#e43c30  50%);display:flex;width:85%;margin:auto;height:140px;border-radius:20px;align-items:center;justify-content:center;box-shadow: 4px 5px 7px #808080;margin-top:15px " >
            <div style="width:25%;margin-top:-40px">
                <div style="width:60px;height:60px;background:white;border-radius:30px;margin:auto;" >
                    <h2 style="color:#808080;text-align:center;line-height:60px;text-transform:uppercase" >{!! substr(($user->name),0,1) !!}{!! substr(($user->lastname),0,1) !!} </h2>
                </div>
            </div>
            <div style="width:50%;">
                <div style="width:100%;display:block;font-size:15px;color:white">
                    {{$user->name}} {{$user->lastname}}
                </div>
                <div style="width:100%;display:block;font-size:12px;color:white">
                    Cell: {!! substr(($user->cell),0,3) !!} {!! substr(($user->cell),3,3) !!} {!! substr(($user->cell),6,3) !!}
                </div>
                <div style="width:100%;display:flex;height:40px;margin-top:20px" >
                    <div style="width:30%;text-align:center;" >
                        <div style="width:100%;font-size:12px;color:white" >250</div>
                        <div style="width:100%;font-size:10px;color:white" >Ganancia</div>
                    </div>
                    <div style="width:30%;text-align:center;" >
                        <div style="width:100%;font-size:12px;color:white" >25</div>
                        <div style="width:100%;font-size:10px;color:white" >Ventas</div>
                    </div>
                    <div style="width:30%;text-align:center;" >
                        <div style="width:100%;font-size:12px;color:white" >10</div>
                        <div style="width:100%;font-size:10px;color:white" >Individual</div>
                    </div>
                    
                </div>
            </div>
            <div style="width:25%;text-align:center;" >
                <div style="width:100%;font-size:15px;color:white" >{{ $user->dni }}</div>
                <div style="width:100%;font-size:10px;color:white" >Indentificador</div>
            </div>
        </div>
        </a>
        @endif
        @endforeach
        
    
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
        <div id="menum" style="position: fixed;top:0px;z-index: 9999999;height: 100vh;background:  linear-gradient(135deg, rgba(19,84,122,1) 0%,rgba(3,150,255,1) 100%);border-radius: 0px;width: 100%;color:white; ">
        <img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 30px;position: absolute;top:20px;right: 20px;" onclick="leftclose()">
        <div id="menu-cont" style="position: absolute;width: 100%;transition: .5s;">
        <div style="position: relative;">
        <a href="{{url('admin-mobile')}} ">Home</a>
        <a onclick="detail_inv()" id="inv" >Inversion</a>

        <a onclick="detail_ven()" >Ventas</a> 
        <a  style="font-weight: bold;" >Usuarios</a>                        
        <a >Configuracion</a>
        </div>
        </div>
        <div id="menu-sub1" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
        <div style="position: relative;">
        
        <a  id="inv" href="{{url('compras-mobile')}} ">Compras</a>

        <a href="{{url('product-mobile')}}">Productos</a> 
        <a onclick="back1()" style="color:black">Back</a>
        </div>
        </div>
        <div id="menu-sub2" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
        <div style="position: relative;">
        
        <a  id="inv" href="{{url('venta-mobile')}} ">Ventas</a>

        <a  href="{{url('envio-mobile')}} ">Envios</a> 
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