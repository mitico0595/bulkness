@extends ('layouts.supplier-app')
@section ('usuario')
<style>
    +{
        margin: 0;
        padding: 0;
        
    }
    body{
        background: #ededed;
    }
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
<div style="position:absolute; width:70%;min-width:800px;left:15%;top:200px;">     
    <style type="text/css">
    	.not{
    		user-select: none;
    	}
    </style>

	<div class="row" >
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3 style="color:#808080">STORE LUZAPAY E.I.R.L.</h3>
			<h5 style="color:#808080; margin-top:-9px; ">Jirón Cuzco 440 - Stand 502</h5>


			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div>
			{!!Form::open(array('url'=>'ingresos','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
		<div class="row">	
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			    <div class="form-group">
				    <label for="">Cliente</label>
				    <select style="" type="" name="idpersona" id="idpersona" class="form-control selectpicker" data-live-search="true">
					    @foreach ($tienda as $persona)
					    <option style=""  value="{{$persona->id}}">{{$persona->name}}</option>
					    @endforeach

				    </select>
				</div>

				
			</div>
			

		</div>

		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
						<div class="form-group">
							<label>Articulo</label>
							<select name="pidarticulo" class="form-control selectpicker"  id="pidarticulo" data-live-search="true">
								@foreach($articulos as $articulo)
								<option value="{{$articulo->id}}_{{$articulo->stock}}">{{$articulo->articulo}}</option>
								@endforeach
							</select>
						</div>	
					</div>

					<div class="col-lg-2 col-sm- col-md-2 col-xs-12">
						<div class="form-group">
							<label for="cantidad">Cantidad</label>
							<input type="number" name ="pcantidad"  id="pcantidad"  class="form-control" placeholder="cantidad">
	
						</div>	
					</div>
					<div class="col-lg-2 col-sm- col-md-2 col-xs-12">
						<div class="form-group">
							<label for="stock">Stock</label>
							<input type="number" disabled name ="pstock"  id="pstock"  class="form-control" placeholder="Stock">
	
						</div>	
					</div>
					
					
					
					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
						<div class="form-group">
							<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
						</div>
					</div>

					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
							<thead style="background-color: #e5e5e5">
								<th>Opciones</th>
								<th>Articulo</th>
								<th>Cantidad</th>																
								

							</thead>
							
							
						</table>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset" >Cancelar</button>
				</div>
			</div>
		</div>

			
			

			{!!Form::close()!!}


</div>
<script> 

	$(document).ready(function(){$('#bt_add').click(function(){
		agregar();
		});
	});

	var cont=0;	
	
	$("#guardar").hide();

	$("#pidarticulo").change(mostrarValores);
	function mostrarValores(){
		datosArticulo=document.getElementById('pidarticulo').value.split('_');
		
		
		$("#pstock").val(datosArticulo[1]);
		

	}

	function agregar() {
		datosArticulo=document.getElementById('pidarticulo').value.split('_');
		
		idarticulo= datosArticulo[0];
		articulo=$("#pidarticulo option:selected").text();
		
		cantidad=parseInt($("#pcantidad").val());		
		stock=parseInt($("#pstock").val());


		if (idarticulo!="" && cantidad!="" && cantidad>0 )
		{if (stock>cantidad){		

			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning " onclick="eliminar('+cont+');">X</button></td><td><input   type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td> <td><input class="not" readonly="readonly" type="number" name="cantidad[]" value="'+cantidad+'" ></td></tr>';
			cont++;
			limpiar();			
			
			$('#detalles').append(fila);
			}
			else{
				alert('La cantidad a vender supera el stock')
			}
			
		}
		else {alert("Error al ingresar los detalles de la venta, revise los datos del articulo");}
	}


	function limpiar() {
		$("#pcantidad").val("");
		

	}
	

	function eliminar(index){
		
		$("#fila" + index).remove();
		evaluar();

	}

</script>


@endsection	