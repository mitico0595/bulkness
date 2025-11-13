<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @include ('logo')
        <title>@include ('title')</title>
    
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty.css')}} ">        
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <link rel="stylesheet" href="{{asset('css/articulo.css')}} ">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <style type="text/css">
         .ellipsis   {
                text-overflow: ellipsis;
                white-space: nowrap;
                overflow: hidden;
                }
         #soli {
            width:260px;
         }
         .boxes{
            position: relative;
            width: 155px;
            background: white;
            float: left;
            margin-left: 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
            height: 80px;
            border-radius: 10px;
            box-shadow: 0px 6px 20px -5px rgb(0 0 0 / 50%);
         }

         .ganancia-h3 h3{
            font-size: 14px;
            font-family: 'Kanit';

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
    <div style="position: absolute;width:40px;top:10px ;left:10px;">            
                <svg class="h-6 w-6" stroke="#282828" fill="none" viewBox="0 0 24 24" onclick="force()">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />                                     
                </svg>            
    </div>    
        <div id="soli" style="line-height: 60px;position: absolute;left: 60px;font-size: 25px;" ><div class="ellipsis">{{Auth::user()->name}} {{Auth::user()->lastname}}</div> </div>
        
    <div style="position: absolute;top:60px; width: 100%;padding:20px;">
        <div style="position: relative;width:330px;display: block;margin: auto;">
            <div class="boxes" style="line-height: 80px;text-align: center;font-size: 22px;color:#969696">@if ($hoy==1)
ENERO 
@endif 
@if ($hoy==2)
FEBRERO
@endif 
@if ($hoy==3)MARZO
@endif 
@if ($hoy==4)ABRIL
@endif 
@if ($hoy==5)MAYO
@endif
 @if ($hoy==6)JUNIO
@endif 
@if ($hoy==7)JULIO
@endif 
@if ($hoy==8)AGOSTO
@endif
 @if ($hoy==9)SETIEMBRE
@endif 
@if ($hoy==10)OCTUBRE
@endif
 @if ($hoy==11)NOVIEMBRE
@endif 
@if ($hoy==12)DICIEMBRE
@endif</div>
            <div class="boxes">
            <img src="{{asset('image/svg/ganancias.svg')}} " style="width: 40px;position: absolute;top:20px;left: 20px;">
            <div style="position: absolute;bottom: 10px;right: 10px;" class="ganancia-h3">
                @foreach ($ganancias as $gan)
			@if ($year == 2021)
			@if ($gan->Mes == $hoy)
			<h3 class="mes">S/. {{$gan->ganancia ?? '0.00'}} </h3>
			@endif
			@endif
			@if ($year == 2022)
			@if ($gan->Mes == $hoy)
			<h3 class="mes">S/. {{$gan->ganancia ?? '0.00'}} </h3>
			@endif
			@endif
			@if ($year == 2023)
			@if ($gan->Mes == $hoy)
			<h3 class="mes">S/. {{$gan->ganancia ?? '0.00'}} </h3>
			@endif
			@endif
            
            @endforeach
            </div>
            <div style="position: absolute;top:20px;right: 10px;font-size: 12px;color:#969696">
                GANANCIAS 
            </div>
            </div>
            <div class="boxes">
            <img src="{{asset('image/svg/caja.svg')}} " style="width: 40px;position: absolute;top:20px;left: 20px;">
            <div style="position: absolute;top:15px;right: 10px;font-size: 12px;color:#969696">
                PRODUCTOS
            </div>
            <div style="position: absolute;bottom: 10px;right: 0px;" class="ganancia-h3">
             @foreach ($productos as $prod)
            @if(substr($prod->mes,0,4) == $year )
            @if(substr($prod->mes,4,2) == $hoy)
            <h3 class="mes" style="text-align: center;width: 100px;font-size: 25px; ">{{$prod->conteo ?? '0'}} </h3>

            @endif
            @endif
            @endforeach
            </div>
            </div>
            <div class="boxes">
            <img src="{{asset('image/svg/ventas.svg')}} " style="width: 40px;position: absolute;top:20px;left: 20px;">
            <div style="position: absolute;top:15px;right: 25px;font-size: 12px;color:#969696">
                VENTAS
            </div>
            <div style="position: absolute;bottom: 10px;right: 0px;" class="ganancia-h3">
                @foreach ($ventas as $vent)
            @if(substr($vent->mes,0,4) == $year )
            @if(substr($vent->mes,4,2) == $hoy)
            <h3 class="mes" style="text-align: center;width: 100px;font-size: 25px; ">{{$vent->conteo ?? '0' }} </h3>

            @endif
            @endif
            @endforeach
            </div>
            </div>
        </div>
    </div>
    
    <div style="position: absolute;top:300px;width: 100%;">
        <div style="position: relative;width:330px;display: block;margin: auto;background: #2176dd ; border-radius: 10px;padding: 20px 10px;box-shadow: 10px 16px 40px -5px rgb(0 0 0 / 75%);padding-top: 50px;">
            <div style="position: absolute;top:10px; left: 20px;color:#fff;text-transform: uppercase;">Ganancias del mes</div>
            <div style="position: absolute;top:30px;font-weight: bold; left: 20px;color:#fff;text-transform: uppercase;font-size: 10px;">State PEN</div>
        <canvas id="myChart" style="width: 320px;"></canvas>
    </div>
    </div>

    <div style="position: absolute;top:550px;width: 100%;">
        <div style="position: relative;width:330px;display: block;margin: auto;background: #2176dd ; border-radius: 10px;padding: 20px 10px;box-shadow: 10px 16px 40px -5px rgb(0 0 0 / 75%);padding-top: 50px;">
            <div style="position: absolute;top:10px; left: 20px;color:#fff;text-transform: uppercase;">Movimiento mensual</div>
            <div style="position: absolute;top:30px;font-weight: bold; left: 20px;color:#fff;text-transform: uppercase;font-size: 10px;">State PEN @foreach ($ventam as $venm)
            @if(substr($venm->mes,0,4) == $year) 
            @if (substr($venm->mes,4,2) == $hoy)
            <h3 class="mes">S/. {{$venm->ventas ?? '0.00'}} </h3>

            @endif          
            @endif
            
            
            @endforeach</div>
        <canvas id="myCharti" style="width: 320px;"></canvas>
    </div>
    </div>

    <div style="position: absolute;top:815px;width: 100%;">
        <div style="position: relative;width:330px;display: block;margin: auto;background: #fff; border-radius: 10px;padding: 20px;box-shadow: 10px 16px 40px -5px rgb(0 0 0 / 75%);padding-top: 50px;height: 120px;">
            <div style="position: absolute;top:10px; left: 20px;color:#fff;text-transform: uppercase;">Mercaderia total</div>
            <div style="position: absolute;top:30px;font-weight: bold; left: 20px;color:#fff;text-transform: uppercase;font-size: 10px;">Own investment</div>
            @foreach ($mercaderia as $mer)
            <div  style="width: 50%;position: relative;display: block;float: left;">
                <h3 class="mes" style="font-size: 20px">S/. {{number_format($mer->actual,2) }} </h3>
                <h2 style="font-size: 10px;color: #808080;font-family: 'dosis';">MERCADERIA ACTUAL</h2>
            </div>          
            <div style="width: 50%;position: relative;display: block;float: left;color:#808080">
                <h3 class="mes" style="color:#808080;font-size: 20px;" >S/. {{number_format($mer->potencial,2) }} </h3>
                <h2 style="font-size: 10px;color: #808080;font-family: 'dosis';">MERCADERIA POTENCIAL</h2>
            </div>
            
            @endforeach
    </div>    

    </div>
    <div style="position: absolute;top:965px;width: 100%;padding-bottom: 50px;">
        <div style="position: relative;width:330px;display: block;margin: auto;background: #2176dd ; border-radius: 10px;padding: 20px 10px;box-shadow: 10px 16px 40px -5px rgb(0 0 0 / 75%);padding-top: 50px;height: 530px;">
            <div style="position: absolute;top:10px; left: 20px;color:#fff;text-transform: uppercase;">Articulos mas vendidos</div>
            <div style="position: absolute;top:30px;font-weight: bold; left: 20px;color:#fff;text-transform: uppercase;font-size: 10px;">top 3</div>
            <div style="position: relative;display: block;width: 100%;padding: 20px;padding-top: 0px;">
            <h3 style="font-size: 10px;color: #fff;font-family: 'dosis';padding: 5px;width: 50px;float:left;text-align: center;font-weight: bold;margin: 0px;">ID ARTICULO</h3>
            <h3 style="font-size: 10px;color: #fff;font-family: 'dosis';padding: 5px;width: 50px;float:left;text-align: center;font-weight: bold;margin: 0px;padding-left: 20px;">GANANCIAS</h3>
            <h3 style="font-size: 10px;color: #fff;font-family: 'dosis';padding: 5px;width: 100px;float:left;text-align: center;font-weight: bold;margin: 0px;padding-left: 20px;">CANTIDAD </h3>
            <h3 style="font-size: 10px;color: #fff;font-family: 'dosis';padding: 5px;width: 50px;float:left;text-align: center;font-weight: bold;margin: 0px;padding-left: 20px;">VENTAS TOTAL</h3>
            @foreach ($artmonth as $art)
            
            <div  style="width: 100%;position: relative;display: block;float: left;padding-left: 10px;">

                <h3 class="mes" style="font-size: 15px;padding: 5px;float:left;text-align: center;font-weight: bold;color:#fff">{{$art->id}} </h3>
                <h3 class="mes" style="font-size: 13px;padding: 5px;width: 100px;float:left;text-align: center;color:white">S/. {{$art->ganancia}} </h3>
                <h3 class="mes" style="font-size: 13px;padding: 5px;width: 50px; float: left;text-align: center;color:white">{{number_format($art->cantidad,0) }} </h3>
                <h3 class="mes" style="font-size: 13px;padding: 5px;float: left;position: absolute;right: 0px;color:white">S/. {{number_format($art->ventas,2) }} </h3>
            </div>
            @endforeach
            
            </div>


            <div style="position: absolute;top:200px;width: 300px;">
                <div style="position: relative;width:330px;display: block;margin: auto;background: #fff; border-radius: 10px;padding: 20px 10px;box-shadow: 10px 16px 40px -5px rgb(0 0 0 / 75%);padding-top: 50px;height: 300px;">
                <div style="position: absolute;top:10px; left: 20px;color:#969696;text-transform: uppercase;">Articulos mas vendidos</div>
                <div style="position: absolute;top:30px;font-weight: bold; left: 20px;color:#969696;text-transform: uppercase;font-size: 10px;">Photo top</div>
                 <div style="width: 300px;position: relative;float: left;margin: 0px;margin-top: 20px;padding-left: 50px;">
                        <div style="position: absolute;font-size: 45px;color:#808080;top:0;left: 25px;font-family:'Poiret One' ">1</div>
                        <div style="position: absolute;font-size: 45px;color:#808080;top:70px;left: 18px;font-family:'Poiret One'">2</div>
                        <div style="position: absolute;font-size: 45px;color:#808080;top:140px;left: 18px;font-family:'Poiret One' ">3</div>
                        @foreach ($artmonth as $art)
                        @foreach ($articulos as $ti)
                        @if($art->id== $ti->id)
                        <div style="width:250px;position: relative;display: inline-block;margin-bottom: 10px;margin-left: 20px;height: 60px;float: left;">
                            <img src="{{asset('images/'.$ti->image)}} " style="width: 50px;padding-bottom:  0px;margin: 0px;border-radius: 50px;display: block;position: relative;float: left;">
                            <div style="width: 200px;position: relative;float:left;height: 60px;">
                            <h2 style="position: relative;display: block;float: left;font-size: 15px;color:#808080;text-transform: uppercase;font-family: 'Kanit';letter-spacing: 0;line-height: 15px;display: -webkit-box; -webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;font-size: 14px;padding: 12px;">{{$ti->name}} </h2>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                </div>
                </div>
            </div>
        

    </div>
    </div>
        
    
    
    <div style="position: absolute;top:1520px;width: 100%;padding-bottom: 50px;">
    <div style="position: relative;width:330px;display: flex;margin: auto;justify-content:center;align-items:center">
          <a href="{{url('entradas/create')}} "> <div class="boxes" style="line-height: 80px;text-align: center;font-size: 22px;color:#fff;background:#2176dd;margin-left:0">Ingreso</div></a>

          <a href="{{url('egreso/create')}}">  <div class="boxes" style="line-height: 80px;text-align: center;font-size: 22px;color:#969696">Gasto</div></a>
    </div>
    </div>
    
    <div style="position: absolute;top:1615px;width: 100%;padding-bottom:50px">
        <div style="position: relative;width:330px;display: flex;margin: auto;background: #fff; border-radius: 10px;padding: 20px;box-shadow: 10px 16px 40px -5px rgb(0 0 0 / 75%);justify-content:center;align-items:center">

            <div style="width: 50%;position: relative;display: block;float: left;">
                <img src="{{asset('image/svg/cajasi.svg') }} " alt="" style="width:50px;margin:auto;display:block">
                <h2 style="font-size: 10px;color: #808080;font-family: 'dosis';text-align:center;margin-top:5px">Flujo Caja</h2>
            </div>
            <a href="{{url('entradas')}}"><div style="width: 50%;position: relative;display: block;float: left;color:#808080">
                <h3 class="mes" style="color:#808080;font-size: 25px;">S/. {{$flujo}}</h3>

            </div></a>

        </div>

         </div>
         <div style="position: absolute;top:1755px;width: 100%;padding-bottom:50px">
        <div style="position: relative;width:330px;display: flex;margin: auto;background: #fff; border-radius: 10px;padding: 20px;box-shadow: 10px 16px 40px -5px rgb(0 0 0 / 75%);justify-content:center;align-items:center">

            <div style="width: 50%;position: relative;display: block;float: left;">
                <img src="{{asset('image/svg/dinero-en-efectivo.svg') }} " alt="" style="width:50px;margin:auto;display:block">
                <h2 style="font-size: 10px;color: #808080;font-family: 'dosis';text-align:center;margin-top:5px">Patrimonio</h2>
            </div>
            <a href="{{url('entradas')}}"><div style="width: 50%;position: relative;display: block;float: left;color:#808080">
                <h3 class="mes" style="color:#808080;font-size: 25px;">S/. {{$flujo}}</h3>

            </div></a>

        </div>

         </div>
    <div style="position: absolute;top:1890px;width: 100%;padding-bottom: 50px;">
    <div style="position: relative;width:330px;display: flex;margin: auto;justify-content:center;align-items:center">
          <a href="{{url('entradas/create')}} "> <div class="boxes" style="line-height: 80px;text-align: center;font-size: 22px;color:#fff;background:#2176dd;margin-left:0">Inversion</div></a>

          <a href="{{url('egreso/create')}}">  <div class="boxes" style="line-height: 80px;text-align: center;font-size: 22px;color:#969696">Liquidacion</div></a>
    </div>
    </div>
    <div id="menum" style="position: fixed;top:0px;z-index: 9999999;height: 100vh;background:  linear-gradient(135deg, rgba(19,84,122,1) 0%,rgba(3,150,255,1) 100%);border-radius: 0px;width: 100%;color:white; ">
            <img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 30px;position: absolute;top:20px;right: 20px;" onclick="leftclose()">
            <div id="menu-cont" style="position: absolute;width: 100%;transition: .5s;">
            <div style="position: relative;">
            <a style="font-weight: bold;">Home</a>
            <a onclick="detail_inv()" id="inv">Inversion</a>

            <a onclick="detail_ven()">Ventas</a> 
            <a href="{{url('usuario-mobile')}}">Usuarios</a>                        
            <a >Configuracion</a>
            </div>
            </div>
            <div id="menu-sub1" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
            <div style="position: relative;">
            
            <a  id="inv" href="{{url('compras-mobile')}} ">Compras</a>

            <a  href="{{url('product-mobile')}}">Productos</a> 
            <a onclick="back1()" style="color:black">Back</a>
            </div>
            </div>
            <div id="menu-sub2" style="position: absolute;width: 100%;padding-top: 22px;right: -1000px;transition: .5s;" >
            <div style="position: relative;">
            
            <a  id="inv" href="{{url('venta-mobile')}}"  >Ventas</a>

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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script type="text/javascript">
     $(document).ready(function(){
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('ganancia')!!}',
                   success:function(response){
                        console.log(response);
                    //material.css
                    //convert to object
                    var ctx = document.getElementById('myChart').getContext('2d');
                    
                    var custArray = response;
                    var dataCust = [];
                    var dataCust2 = [];
                    var dataCust3 = [];
                    var fecha = new Date();
                    var ano = fecha.getFullYear()
                    
                    for (var i=0; i< custArray.length;i++){
                        dataCust[i] = custArray[i].ganancia;
                        if (custArray[i].Mes==1){dataCust2[i] = 'Enero';}
                        if (custArray[i].Mes==2){dataCust2[i] = 'Febrero';}
                        if (custArray[i].Mes==3){dataCust2[i] = 'Marzo';}
                        if (custArray[i].Mes==4){dataCust2[i] = 'Abril';}
                        if (custArray[i].Mes==5){dataCust2[i] = 'Mayo';}
                        if (custArray[i].Mes==6){dataCust2[i] = 'Junio';}
                        if (custArray[i].Mes==7){dataCust2[i] = 'Julio';}
                        if (custArray[i].Mes==8){dataCust2[i] = 'Agosto';}
                        if (custArray[i].Mes==9){dataCust2[i] = 'Setiembre';}
                        if (custArray[i].Mes==10){dataCust2[i] = 'Octubre';}
                        if (custArray[i].Mes==11){dataCust2[i] = 'Noviembre';}
                        if (custArray[i].Mes==12){dataCust2[i] = 'Diciembre';}
                        
                    
                    }
                    
                   
                    var chart = new Chart(ctx, {
                            // The type of chart we want to create
                    type: 'line',

                    // The data for our dataset
                    data: {
                        labels: dataCust2,
                        datasets: [{                                   
                        backgroundColor: 'rgba(0,0,0,0)',                         
                        borderColor: '#fff',
                        data: dataCust,
                        pointRadius: 6,

                        }]
                    },

                    // Configuration options go here
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                display: false,
                                },
                                gridLines: {
                                display: false,
                                },
                            }],
                            xAxes: [{
                                gridLines: {
                                display: false,
                                },
                            }],
                        }, 
                        legend: {
                            display: false,
                        },
                        tooltips: {
                            mode: 'point',
                        }, 
                        
                    },
                    });
                    Chart.defaults.global.defaultFontColor = "#969696";

                   }
                })
            });
</script>
<script type="text/javascript">
         $(document).ready(function(){
            
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('monto')!!}',
                   success:function(response){
                        console.log(response);
                    //material.css
                    //convert to object
                    
                    var ctxi = document.getElementById('myCharti').getContext('2d');
                    var custArrayi = response;
                    var dataCusti = [];
                    var dataCusti2 = [];
                    
                    var fecha = new Date();
                    var ano = fecha.getFullYear();
                    
                    for (var i=0; i< custArrayi.length;i++){
                        dataCusti[i] = custArrayi[i].ventas;                        
                        dataCusti2[i] = custArrayi[i].mes;
                    }
                    
                                       
                    var charti = new Chart(ctxi, {
                            // The type of chart we want to create
                    type: 'bar',

                    // The data for our dataset
                    data: {
                        labels: dataCusti2,
                        datasets: [{     
                             
                        backgroundColor: '#fff',                         
                        borderColor: '#fff',
                        data: dataCusti,
                        pointRadius: 10,
                        }]
                    },

                    // Configuration options go here
                    options: {
                        legend: {
                            display: false,
                        },
                        tooltips: {
                            mode: 'point',
                        }, 
                        scales: {
                            yAxes: [{
                                ticks: {
                                display: false,
                                },
                                gridLines: {
                                display: false,
                                },
                            }],
                            xAxes: [{
                                gridLines: {
                                display: false,
                                },
                            }],
                        },  
                    },
                    });
                    charti.canvas.parentNode.style.width = '330px';
                    charti.canvas.parentNode.style.height = '240px';
                   }
                })
            });   
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