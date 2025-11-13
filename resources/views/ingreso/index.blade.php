@extends('blackboard')
@section('contenido')
<style>
    *{
        margin:0px;
        font-family:Helvetica;
        font-weight: 100;
        box-sizing: border-box;
        
    }
    body{
        background:#f2f2f2;
    }
    .detalles:hover{
        transform: scale(1.01,1.01);
        box-shadow: 1px 2px 10px #808080;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('css/adminventa.css')}}">
	<div class="">
		<div class="contenedor">
		
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">

		

		{!! Form::open(array('url'=>'ingreso','method'=>'GET','autocomplete'=>'off','role'=>'search','class'=>'buscador')) !!}
				<div class="form-group">
					<div class="input-group">
						
						<div class="input-field">
							<input type="number" id="" placeholder="N°" name="searchLast" value="" autocomplete="off" style="width: 50px;" autofocus>
                            <input type="text" id="searchid" placeholder="Buscar apellido" name="searchText" value="" autocomplete="off"> 
                            
                        </div>
						<button type="submit" class="" style="background: none;border:none;"><span class="material-icons" style="margin-left: -30px;z-index: 9;position: relative;font-size: 15px;">search</span></button>
						
						
					</div>
				</div>
		{{Form::close()}}
		
		</div>
	</div>
	<div style="width:100%;max-width:1200px;margin:auto;display:block;margin-top:60px;">
    
    <div style="width:100%; max-width:1100px;margin:auto;display:block;background:#ec1438;padding:10px;border-radius:10px;position:relative">
        <h5 style="font-size:1.6em;margin:0;color:white;font-weight:100">Listado de ventas 
        </h5>
        <a href="ingreso/create" class="add_ad" style="position:absolute;right:0px;top:7px;font-family:Helvetica" data-toggle="modal" data-target="#formarticulo">
		SALE</a>

    </div>
    <div style="background:white;border-bottom: 2px solid #ddd; width:100%;width:1100px;margin:auto;display:flex;padding:10px;align-items:center;justify-content:center;margin-top:30px;margin-bottom:20px;">
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:150px;text-align:center">Numero de venta</h5>
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:210px;text-align:center">Cliente</h5>
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:210px;text-align:center">Contacto</h5>
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:120px;text-align:center">Tipo de venta</h5>
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:184px;text-align:center">Venta</h5>
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:184px;text-align:center"></h5>
    </div>
    @foreach ($ventas as $ven)
    <div class="detalles" style="background:white;width:100%;width:1100px;margin:auto;display:flex;padding:10px;align-items:center;justify-content:center;border-bottom: 1px solid rgb(231, 231, 231)">
        <div style="display:flex;align-items:center;justify-content:center;flex-direction: column;">
           <a href="{{asset('pagos/'.$ven -> purchaseNumber)}}"><h5 style="font-weight:bold;font-size:15px;margin:0;color:#ec1438;width:150px;text-align:left">{{ $ven -> purchaseNumber ?? 'None'}}</h5></a>
            <h5 style="font-size:13px;margin:0;color:#808080;width:150px;text-align:left">{{ $ven -> idventa}}-{{ $ven -> payment_id ?? '00'}} </h5>
        </div>
        <div style="display:flex;align-items:center;justify-content:center;flex-direction: column;">
            <h5 style="font-weight:bold;font-size:15px;margin:0;color:black;width:210px;text-align:left">{{ $ven -> name}} {{ $ven -> lastname}}</h5>
            <h5 style="font-size:13px;margin:0;color:#808080;width:210px;text-align:left">{{ $ven -> dni ?? 'none'}}</h5>
        </div>
        <div style="display:flex;align-items:center;justify-content:center;flex-direction: column;">
            <h5 style="font-weight:bold;font-size:15px;margin:0;color:black;width:210px;text-align:left">{{ $ven -> email }}</h5>
            <h5 style="font-size:13px;margin:0;color:#808080;width:210px;text-align:left">{{ $ven -> cell ?? 'none'}}</h5>
        </div>
        <div style="display:flex;align-items:center;justify-content:center;flex-direction: column;">
            <h5 style="font-size:13px;margin:0;color:black;width:120px;text-align:center;padding:5px">{{ $ven -> tipo_venta ?? 'none'}}</h5>
        </div>
        <h5 style="font-size:15px;margin:0;color:black;width:184px;text-align:center">S/. {{ $ven -> total_venta ?? 'none'}}</h5>
        <div style="display:flex;align-items:center;justify-content:center;flex-direction: row;">
           <a href="{{URL::action('VentaController@show',$ven->idventa)}}"> <h5 style="font-size:15px;margin:0;color:white;width:100px;text-align:center;padding:5px;background:#f9a513;border-radius:5px;margin-right: 10px;">Invoice</h5></a>
           <a href="{{URL::action('VentaController@edit',$ven->idventa)}}"> <h5 style="margin-left:10px;font-size:15px;margin:0;color:white;width:100px;text-align:center;padding:5px;background:#13a3f7;border-radius:5px;margin-right;10px">Editar</h5></a>
           
        </div>
    </div>
    @endforeach
    {{$ventas->render()}}
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
	

@endsection