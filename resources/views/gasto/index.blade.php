@extends ('blackboard')
@section ('contenido')

    
<link rel="stylesheet" href="{{asset ('css/articulo.css')}}" >
<style type="text/css">
	.blackboard{
		background: #f2f2f2;
	}
	.tittletop{
		position: relative;
    	width: 100%;
    	display: block;
    	margin: auto;
    	padding: 10px;
	}
	.tittletop h5{
		position: relative;
		float:left;
		width: 120px;
		font-size: 12px;
		text-align: center;
	}
	.grid_envio {
		position: relative;
		display: inline-block;
		width: 100%;
		background: #fff;
	}
	.subgrid{
		position: relative;
		display: block;
		width: 100%;
		padding: 20px 10px;
	}
	.subgrid h3 {
		line-height: 0px;
		position: relative;
		float:left;
		width: 120px;
		font-size: 12px;
		text-align: center; 
	}
	.inputcreate{
		width: 100px;
		margin-top: 20px;
		position: relative;
		display: inline-block;
	}
	.inputcreate input{
		border:none;
		border-bottom: 2px solid #282828;
		width: 80px;
		padding: 15px 20px 4px 8px;
		font-size: 14px;
	}
	.inputcreate span{
		position: absolute;
		font-size: 11px;

	}
	.inputcreate input:focus{
		outline: 0;
	}
</style>
<div id="crudgasto" class="con_articulo" style="width:70%; position: absolute; display: block;">
	<h1>LUZAPAY </h1>
	<div class="titulo"><h1 class="page-head">Registro de articulos</h1></div>
	<a href="" class="add_ad" style="" data-toggle="modal" data-target="#create">
		Add item</a>
	<div class="subcon_articulo" style="margin-top:50px;">
			<div class="tittletop">
				<h5 >Fecha y Hora</h5>
				<h5 class="" style="width:250px;">Nombre Producto</h5>
				<h5 class="" style="width:70px;">Costo</h5>
				<h5 class="" style="width:70px;">Cambio V.</h5>
				<h5 class="" style="width:70px;">Cantidad</h5>
				<h5 class="" style="width:70px;float: right;">Gasto Total</h5>
			</div>
				<div v-for="item in gastos" class="grid_envio" > 
					<div class="subgrid">
					<h3 >@{{item.created_at | formatDate}}</h3>
					<h3 class="" style="width:250px;">@{{item.name}}</h3>
					<h3 class="" style="width:70px;">@{{item.costo}} USD</h3>
					<h3 class="" style="width:70px;">@{{item.tipousd}}</h3>
					<h3 class="" style="width:70px;">@{{item.cantidad}}</h3>
					<h3 class="" style="width:70px;float: right;">@{{item.gasto_total}} PEN</h3>
					
					
					<!-- DATA SHOW -->	
					</div>
				</div>		
				
				
				
		 
			
	</div>
	@include('gasto.create')	
</div>
	<script src="{{asset('js/app.js')}}"></script>
	
@endsection 