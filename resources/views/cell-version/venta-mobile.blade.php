<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Oberlu Admin</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty-mobile.css')}} "> 

        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <link rel="stylesheet" href="{{asset('css/articulo.css')}} ">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
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


<div style="position: fixed;background: #fff;height: 60px;width: 100%;z-index: 999;top:0px">
        <div style="position: absolute;width:40px;top:10px ;left:10px;">            
                <svg class="h-6 w-6" stroke="#282828" fill="none" viewBox="0 0 24 24" onclick="force()">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />                                     
                </svg>            
        </div>
        <div id="soli" style="line-height: 60px;position: absolute;left: 60px;font-size: 18px;" >Ventas</div>
        <a href="venta-create" class="add_ad" style="background: none;font-size: 25px;color:#282828;line-height: 55px;z-index: 1000;position: fixed;top: 0px;" data-toggle="modal" data-target="#formarticulo" >
        +</a>
</div>
{!! Form::open(array('url'=>'venta-mobile','method'=>'GET','autocomplete'=>'off','role'=>'search','class'=>'buscador' )) !!}
<div class="input-field" style="width: 100%;right: none;">
          <input type="text" id="searchid" name="searchText" value="" autocomplete="off" style="border-bottom: none;z-index: 1000; position: absolute;left: 0px;padding: 10px;border: none;" onclick="hid()">
</div>        
          <button type="submit" class="" style="background: none;border:none;position: absolute;right: 60px;top:20px;"><span class="material-icons" style="margin-left: -30px;z-index: 9;position: relative;font-size: 20px;">search</span></button>
{{Form::close()}}

<div class="tabla_ventas" style="padding:20px;padding-top: 70px;position: relative;">
  @foreach ($ventas as $ven)
    <div style="position:relative;width:100%;margin:auto;display:flex;height:100px;background-image:radial-gradient(circle farthest-side at 457px -50px ,#e17256  50%, rgba(199, 212, 16, 0) 50%,#e43c30  50%);align-items:center;justify-content:center;border-radius:10px;margin-top:10px;">
        <div style="width:30%;display:flex;flex-direction:column;">
            <div style="text-align: center;color:white;font-size:15px;">{{ $ven -> purchaseNumber}}</div>
            <div style="text-align: center;color:rgb(191, 191, 191);font-size:13px;margin-top:-5px">{{ $ven -> idventa}}-{{ $ven -> payment_id ?? '00'}}</div>
        </div>
        <div style="width:40%;display:flex;flex-direction:column;">
            <div style="width:100%;display:flex;flex-direction:column;">
                <div style="text-align: left;color:white;font-size:15px;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">{{ $ven -> name}} {{ $ven -> lastname}}</div>
                <div style="text-align: left;color:rgb(191, 191, 191);font-size:13px;margin-top:-5px">{{ $ven -> dni ?? '00'}}</div>
            </div>
            <div style="width:100%;display:flex;flex-direction:column;">
                <div style="text-align: left;color:white;font-size:15px;white-space: nowrap;text-overflow: ellipsis;overflow: hidden;">{{ $ven -> email ?? 'none@gmail.com'}}</div>
                <div style="text-align: left;color:rgb(191, 191, 191);font-size:13px;margin-top:-5px">{{ $ven -> cell}}</div>

            </div>
        </div>
        <div style="width:30%;text-align:center;color:white;font-size:18px">S/. {{ $ven -> total_venta}}</div>
        <div style="position:absolute; top:5px;right:5px;text-align: left;color:rgb(191, 191, 191);font-size:10px;margin-top:-5px">{{ $ven -> tipo_venta ?? 'VERIFICAR SISTEMA'}}</div>

    </div>
    <div style="position: relative;display:flex;width:100%;margin-top:3px;">
        <div style="position:relative;height:25px;background:#f9a513;font-size:12px;line-height:25px;width:50%;text-align:center;border-radius:10px 0px 0px 10px;color:white"><a href="{{URL::action('VentaController@showMobile',$ven->idventa)}}" >INVOICE</a></div>
        <div style="position:relative;height:25px;background:#13a3f7;line-height:25px;font-size:12px;width:50%;text-align:center;border-radius:0px 10px 10px 0px;color:white"><a href="{{URL::action('VentaController@edit',$ven->idventa)}}">EDITAR</a></div>
    </div>
    @endforeach
                    
                 
        {{$ventas->render()}}
</div>        
<div id="menum" style="position: fixed;top:0px;z-index: 9999999;height: 100vh;background:  linear-gradient(135deg, rgba(19,84,122,1) 0%,rgba(3,150,255,1) 100%);border-radius: 0px;width: 100%;color:white; ">
            <img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 30px;position: absolute;top:20px;right: 20px;" onclick="leftclose()">
            <div id="menu-cont" style="position: absolute;width: 100%;transition: .5s;">
            <div style="position: relative;">
            <a href="{{url('admin-mobile')}} ">Home</a>
            <a onclick="detail_inv()" id="inv" >Inversion</a>

            <a onclick="detail_ven()" style="font-weight: bold;">Ventas</a> 
            <a href="{{url('usuario-mobile')}}">Usuarios</a>                        
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
            
            <a  id="inv" style="font-weight: bold;">Ventas</a>

            <a href="{{url('envio-mobile')}} " >Envios</a> 
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript">
            $(document).ready(function(){                
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('ventsearch')!!}',
                    success:function(response){
                        console.log(response);
                    //material.css
                    //convert to object
                    var custArray = response;
                    var dataCust ={};
                    var dataCust2 ={};
                    for (var i=0; i< custArray.length;i++){
                        dataCust[custArray[i].lastname] = null;
                        dataCust2[custArray[i].lastname] = custArray[i];
                    }
                    console.log( "dataCust2");
                    console.log(dataCust2);
                    $('input#searchid').autocomplete({
                        data: dataCust,
                        onAutocomplete:function(reqdata){
                            console.log(reqdata);   
                        }

                        
                    });
                    }
                })
            });
</script>
<script type="text/javascript">
    function hid(){
                document.getElementById("soli").style.display = "none";
                document.getElementById("finder").placeholder = "Busque item";
            }
</script>
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