@extends ('blackboard')
@section ('contenido')
<link rel="stylesheet" href="{{asset('css/sty.css')}} ">
<style type="text/css">
	.mes{
		font-size: 35px;
		font-family:'Kanit';
		font-weight: 100;
		color: #fff;
		margin:0;
	}
</style>
<div style="position: fixed;z-index: 999999; top:12px; left:250px;font-family: 'Kanit';color:black;font-size: 30px;"> 
@if ($hoy==1)
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
@endif
{{$year}} </div>
<div style="min-width: 822px;width:80%; position: relative;display: block;margin: auto;height: 300px;background: #2a3143;border-radius: 10px;margin-bottom: 20px;"> 
	<div style="position: relative;width:350px;height: 100%;float: left;margin: 0px;padding: 20px;">
		<div style="position: relative;display: block;width: 100%;">
			<h1 style="font-size: 16px;font-family:'Kanit';padding: 0px;margin: 0px;color:#fff">Estadisticas Generales {{$year}} </h1>
			@foreach ($ganancias as $gan) 
			@if ($gan->Mes == $hoy)
			@if ($gan->Mes == 1)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES ENERO</h2>
			@endif
			@if ($gan->Mes == 2)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES FEBRERO</h2>
			@endif
			
			@if ($gan->Mes == 3)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES MARZO</h2>
			@endif
			
			@if ($gan->Mes == 4)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES ABRIL</h2>
			@endif
			
			@if ($gan->Mes == 5)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES MAYO</h2>
			@endif
			
			@if ($gan->Mes == 6)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES JUNIO</h2>
			@endif
			
			@if ($gan->Mes == 7)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES JULIO</h2>
			@endif
			
			@if ($gan->Mes == 8)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES AGOSTO</h2>
			@endif
			
			@if ($gan->Mes == 9)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES SETIEMBRE</h2>
			@endif
			
			@if ($gan->Mes == 10)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES OCTUBRE</h2>
			@endif
			
			@if ($gan->Mes == 11)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES NOVIEMBRE</h2>
			@endif
			
			@if ($gan->Mes == 12)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">VISTA MES DICIEMBRE</h2>
			@endif


			@endif
			@endforeach
		</div>
		<div style="position: relative;display: block;width: 100%;padding-top: 20px;">
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
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">GANANCIAS DEL MES</h2>
		</div>
		<div style="position: relative;display: block;width: 100%;padding-top: 0px;">
			@foreach ($productos as $prod)
			@if(substr($prod->mes,0,4) == $year )
			@if(substr($prod->mes,4,2) == $hoy)
			<h3 class="mes" style="text-align: center;width: 100px; ">{{$prod->conteo ?? '0'}} </h3>

			@endif
			@endif
			@endforeach
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">CANTIDAD PRODUCTOS</h2>
		</div>
		<div style="position: relative;display: block;width: 100%;padding-top: 0px;">
			@foreach ($ventas as $vent)
			@if(substr($vent->mes,0,4) == $year )
			@if(substr($vent->mes,4,2) == $hoy)
			<h3 class="mes" style="text-align: center;width: 100px; ">{{$vent->conteo ?? '0' }} </h3>

			@endif
			@endif
			@endforeach
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">CANTIDAD VENTAS</h2>
		</div>

	</div>
	<div style="position: absolute;top:20px;right: 20px;">
                <canvas id="myChart" style="width: 500px;"></canvas>
    </div>

</div>
<div style="min-width: 822px;width:80%; position: relative;display: block;margin: auto;height: 400px;background: none;border-radius: 10px;margin-bottom: 20px;"> 
	<div style="min-width: 400px;width:50%; position: relative;display: block;height: 400px;background: #2a3143;border-radius: 10px;float:left;margin:0;">
		<div style="position: relative;display: block;width: 100%;padding:20px; ">
			<h1 style="font-size: 16px;font-family:'Kanit';padding: 0px;margin: 0px;color:#fff">Movimiento mensual</h1>
			@foreach ($ventam as $venm)
			@if(substr($venm->mes,0,4) == $year) 

			@if (substr($venm->mes,4,2) == $hoy)
			
			@if (substr($venm->mes,4,2) == '01')
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO ENERO</h2>
			@endif
			@if ($venm->mes == 2)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO FEBRERO</h2>
			@endif
			
			@if ($venm->mes == 3)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO MARZO</h2>
			@endif
			
			@if ($venm->mes == 4)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO ABRIL</h2>
			@endif
			
			@if ($venm->mes == 5)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO MAYO</h2>
			@endif
			
			@if ($venm->mes == 6)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO JUNIO</h2>
			@endif
			
			@if ($venm->mes == 7)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO JULIO</h2>
			@endif
			
			@if ($venm->mes == 8)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO AGOSTO</h2>
			@endif
			
			@if ($venm->mes == 9)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO SETIEMBRE</h2>
			@endif
			
			@if ($venm->mes == 10)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO OCTUBRE</h2>
			@endif
			
			@if ($venm->mes == 11)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO NOVIEMBRE</h2>
			@endif
			
			@if ($venm->mes == 12)
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MOVIMIENTO DICIEMBRE</h2>
			@endif

			@endif
			@endif
			@endforeach
		</div>
		<div style="position: relative;display: block;width: 100%;padding: 20px;">
			@foreach ($ventam as $venm)
			@if(substr($venm->mes,0,4) == $year) 
			@if (substr($venm->mes,4,2) == $hoy)
			<h3 class="mes">S/. {{$venm->ventas ?? '0.00'}} </h3>

			@endif			
			@endif
			
			
			@endforeach
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">TOTAL VENTAS</h2>
		</div>
		<div style="position: absolute;top:190px;left: 40px;">
                <canvas id="myCharti" style="width: 500px;"></canvas>
          </div>
	</div>
	<div style="min-width: 400px;width:48%; position: relative;display: block;height: 200px;background: #2a3143;border-radius: 10px;float:right;margin:0;">
		<div style="position: relative;display: block;width: 100%;padding:20px; ">
			<h1 style="font-size: 16px;font-family:'Kanit';padding: 0px;margin: 0px;color:#fff">Mercaderia total</h1>
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">TOTAL LQD</h2>
		</div>
		<div style="position: relative;display: block;width: 100%;padding: 20px;">
			@foreach ($mercaderia as $mer)
			<div  style="width: 50%;position: relative;display: block;float: left;">
				<h3 class="mes">S/. {{number_format($mer->actual,2) }} </h3>
				<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MERCADERIA ACTUAL</h2>
			</div>			
			<div style="width: 50%;position: relative;display: block;float: left;color:#808080">
				<h3 class="mes" style="color:#808080" >S/. {{number_format($mer->potencial,2) }} </h3>
				<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">MERCADERIA POTENCIAL</h2>
			</div>
			
			@endforeach
			
		</div>

	</div>
	<div style="min-width: 400px;width:48%; position: relative;display: block;height: 180px;background: #2a3143;border-radius: 10px;float:right;margin:0;margin-top: 20px;">
		<div style="position: relative;display: block;width: 100%;padding:20px;padding-bottom: 0px; ">
			<h1 style="font-size: 16px;font-family:'Kanit';padding: 0px;margin: 0px;color:#fff">Articulos mas vendidos por mes</h1>
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">LOS TRES MAS VENDIDOS </h2>
		</div>
		<div style="position: relative;display: block;width: 100%;padding: 20px;padding-top: 0px;">
			<h3 style="font-size: 10px;color: #808080;font-family: 'Kanit';padding: 5px;width: 100px;float:left;text-align: center;font-weight: bold;margin: 0px;padding-left: 20px;">ID ARTICULO</h3>
			<h3 style="font-size: 10px;color: #808080;font-family: 'Kanit';padding: 5px;width: 100px;float:left;text-align: center;font-weight: bold;margin: 0px;padding-left: 20px;">GANANCIAS</h3>
			<h3 style="font-size: 10px;color: #808080;font-family: 'Kanit';padding: 5px;width: 100px;float:left;text-align: center;font-weight: bold;margin: 0px;padding-left: 20px;">CANTIDAD </h3>
			<h3 style="font-size: 10px;color: #808080;font-family: 'Kanit';padding: 5px;width: 100px;float:left;text-align: center;font-weight: bold;margin: 0px;padding-left: 20px;">VENTAS TOTAL</h3>
			@foreach ($artmonth as $art)
			
			<div  style="width: 100%;position: relative;display: block;float: left;padding-left: 10px;">

				<h3 class="mes" style="font-size: 15px;padding: 5px;width: 100px;float:left;text-align: center;font-weight: bold">{{$art->id}} </h3>
				<h3 class="mes" style="font-size: 13px;padding: 5px;width: 100px;float:left;text-align: center;">S/. {{$art->ganancia}} </h3>
				<h3 class="mes" style="font-size: 13px;padding: 5px;float: left;width: 100px;text-align: center;">{{$art->cantidad}} </h3>
				<h3 class="mes" style="font-size: 13px;padding: 5px;float: left;width: 100px;">S/. {{number_format($art->ventas,2) }} </h3>
			</div>			
			
			
			@endforeach
			
		</div>



	</div>

</div>
<div style="min-width: 822px;width:80%; position: relative;display: block;margin: auto;height: 300px;background: #2a3143;border-radius: 10px;"> 
	<div style="position: relative;display: block;width: 100%;padding:20px;padding-bottom: 0px; ">
			<h1 style="font-size: 16px;font-family:'Kanit';padding: 0px;margin: 0px;color:#fff">Articulos mas vendidos este mes</h1>
			<h2 style="font-size: 10px;color: #808080;font-family: 'Kanit';">LOS TRES MAS VENDIDOS </h2>
	</div>
	<div style="width: 50%;min-width: 400px;position: relative;float: left;margin: 0px;margin-top: 20px;padding-left: 50px;">
		<div style="position: absolute;font-size: 45px;color:#808080;top:0;left: 25px;font-family:'Poiret One' ">1</div>
		<div style="position: absolute;font-size: 45px;color:#808080;top:70px;left: 18px;font-family:'Poiret One'">2</div
		>
		<div style="position: absolute;font-size: 45px;color:#808080;top:140px;left: 18px;font-family:'Poiret One' ">3</div>
	@foreach ($artmonth as $art)
	@foreach ($articulos as $ti)
		@if($art->id== $ti->id)
			<div style="width:300px;position: relative;display: block;margin-bottom: 10px;margin-left: 20px;height: 60px;">
				<img src="{{asset('images/'.$ti->image)}} " style="width: 60px;padding-bottom:  0px;margin: 0px;border-radius: 50px;display: block;position: relative;float: left;">
				<div style="width: 200px;position: relative;float:left;height: 60px;">
				<h2 style="position: relative;display: block;float: left;font-size: 15px;color:#808080;text-transform: uppercase;font-family: 'Kanit';letter-spacing: 0;line-height: 15px;display: -webkit-box; -webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;font-size: 14px;padding: 12px;">{{$ti->name}} </h2>
				</div>
			</div>
		@endif
	@endforeach
	@endforeach
	</div>
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
            			backgroundColor: 'rgb(102, 115, 219,.2)',
            			borderColor: '#6673db',
           				data: dataCust,
           				pointRadius: 5,
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
    					},
					});
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
            			backgroundColor: 'rgb(102, 115, 219,.2)',
            			borderColor: '#6673db',
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
    					},
					});
                    charti.canvas.parentNode.style.width = '400px';
					charti.canvas.parentNode.style.height = '200px';
                   }
                })
            });   
</script>
@endsection 