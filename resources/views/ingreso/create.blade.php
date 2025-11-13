@extends('blackboard')
@section('contenido')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
<div style="position: relative;padding-top: 10px;padding-left: 0px;width: 85%;margin: auto;display: block;padding: 50px;box-sizing: border-box;box-shadow: 5px 5px 25px #dbdbdb">
     
    <style type="text/css">
    	.not{
    		user-select: none;
    	}
    	input:focus{
    	    outline:none;
    	}
    </style>

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3 style="color:#808080">STORE OBERLU E.I.R.L.</h3>
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
			{!!Form::open(array('url'=>'ingreso','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
		<div class="row">	
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			    <div class="form-group" style="width:320px;float:left;">
				    <label for="">Seleccionar cliente</label>
				    <select style="" type="" name="idpersona" id="idpersona" class="form-control selectpicker" data-live-search="true">
					    @foreach ($personas as $persona)
					    <option style=""  value="{{$persona->id}}_{{$persona->name ?? 'k'}} {{$persona->lastname ?? 'k'}}_{{$persona->dni ?? 'k'}}_{{$persona->direccion ?? 'k'}}_{{$persona->cell ?? 'k'}}_{{$persona->distrito ?? 'k'}}_{{$persona->provincia ?? 'k'}}_{{$persona->ciudad ?? 'k'}}_{{$persona->email ?? 'k'}}">{{$persona->dni}} - {{$persona->name}} {{$persona->lastname}}</option>
					    @endforeach
				    </select>
				</div>
                <div class="form-group" style="width:100px;float:left;margin-left:15px">
				    <label for="">Entrega</label>
				    <select style="" type="" name="" id="idsend" class="form-control selectpicker" data-live-search="true" >
				        <option style="" value="">Seleccionar</option>
					    <option style="" value="envio">Envio - Lima</option>
					    <option style="" value="departamento">Envio - Departamento</option>
					    <option style="" value="contraentrega">Contraentrega</option>
					    <option style="" value="recojo">Recojo</option>
				    </select>
				</div>
				<input type="text" name="option" id="option" style="border:none;width: 100%;font-size: 14px;display:none"   autocomplete="off" >
                        
				<div class="form-group" style="width:150px;float:left;margin-left:15px">
				    <label for="">Modo de pago</label>
				    <select style="" type="" name="tipo" id="" class="form-control selectpicker" data-live-search="true" >
				        <option style="" value="EFECTIVO - system">Efectivo</option>
					    <option style="" value="YAPE / PLIN - system">Yape / Plin</option>
					    <option style="" value="TRANSFERENCIA - system">Transferencia bancaria</option>
					    <option style="" value="CREDITO - system">Credito</option>
				    </select>
				</div>
			</div>
			<div style="position:relative; width:100%;display:inline-block">
			   
            </div>  
              
			 <div class="address-content" style="position: relative;margin-top: 20px;border:1px solid #337ab7;border-radius:5px;padding:10px;margin-bottom:10px;">
			     <h5 style="font-size: 17px;width:100%;height:25px;line-height:25px;color:white;position:absolute;top:0px;left:0px;background:#337ab7;padding-left:10px;margin:0px;">DETALLES DE ENVIO</h5>
                <div class="ubicacion-image" style="position: absolute;right: 10px;top: 10px;">
                    <img src="{{asset('image/svg/mapi.svg')}} " class="image-ub" style="width: 20px;">
        
                </div>
                
                <div class="address-modify" style="margin-top:35px" >
                    <div style="width:50%;position:relative;float:left;display:inline-block">
                	<div style="width:20%;position:relative;float:left;display:inline-block">
                	    <h5 style="width:100%;position:relative;display:inline-block;text-align:left;margin:0;line-height:22px">Nombre:</h5>
                	    <h5 style="width:100%;position:relative;display:inline-block;text-align:left;margin:0;line-height:22px">DNI:</h5>
                	    <h5 style="width:100%;position:relative;display:inline-block;text-align:left;margin:0;line-height:22px">Celular:</h5>
                	    <h5 style="width:100%;position:relative;display:inline-block;text-align:left;margin:0;line-height:22px">Direccion:</h5>
                	</div>
                	<div style="width:80%;position:relative;float:left;display:inline-block">
                	    <input type="text" name="name"  style="border:none;width: 100%;font-size: 14px;"  id="namo" autocomplete="off" required="required">
                        <input type="text" name="dni" style="border:none;font-size: 14px;"  id="dnio" autocomplete="off" required="required">
                        <input type="text" name="celular" style="border:none;width: 80%;color:#808080;font-size: 14px;"  id="cello" autocomplete="off" required="required">
                        <input type="text" name="direccion" style="font-size: 14px;border:none;width: 80%;color:#808080"  id="diro" autocomplete="off" >
                    </div>
                    </div>
                    <div style="width:50%;position:relative;float:left;display:inline-block">
                    	<div style="width:20%;position:relative;float:left;display:inline-block">
                    	    <h5 style="width:100%;position:relative;display:inline-block;text-align:left;margin:0;line-height:22px">Distrito:</h5>
                    	    <h5 style="width:100%;position:relative;display:inline-block;text-align:left;margin:0;line-height:22px">Provincia:</h5>
                    	    <h5 style="width:100%;position:relative;display:inline-block;text-align:left;margin:0;line-height:22px">Departamento:</h5>
                    	    <h5 style="width:100%;position:relative;display:inline-block;text-align:left;margin:0;line-height:22px">e-mail:</h5>
                    	</div>
                    	<div style="width:80%;position:relative;float:left;display:inline-block">
                            <input type="" name="distrito" value="" style="border:none;width: 80%;color:#808080;text-transform: uppercase;font-size: 14px;"  id="disto" autocomplete="off">
                            <input type="" name="provincia" value="" style="border:none;width: 80%;color:#808080;text-transform: uppercase;font-size: 14px;display: block;position: relative;float: left;"  id="provo" autocomplete="off" required="required"> 
                            <input type="" name="ciudad" value=" " style="border:none;width: 80%;color:#000;text-transform: uppercase;font-size: 14px;display: block;position: relative;float: left;margin-left: -2px;margin-top:0px; font-weight: bold;"  id="ciuo" autocomplete="off" required="required">
                            <input type="" name="email" value=" " style="border:none;width: 80%;color:#000;text-transform: lowercase;font-size: 14px;display: block;position: relative;float: left;margin-left: -2px;margin-top:0px; font-weight: 100;"  id="mailo" autocomplete="off" required="required">
                        
                        </div>
                        
                    </div>
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
								<option value="{{$articulo->id}}_{{$articulo->stock}}_{{$articulo->precio}}_{{$articulo->costo}}">{{$articulo->articulo}}</option>
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
							<label for="precio_venta">Precio Venta</label>
							<input type="number" name ="precio_venta"  name="pprecio_venta" id="pprecio_venta"  class="form-control" placeholder="Precio venta">
	
						</div>
						
					</div>
					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group" style="display: none;">
							<label for="costo">Costo</label>
							<input type="number" name ="costo"  name="pcosto" id="pcosto"  class="form-control" placeholder="Costo" >
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
								<th>Precio Venta</th>								
								<th>Subtotal</th>

							</thead>
							<tfoot>
								<th>TOTAL</th>
								<th></th>
								<th></th>
								<th>
								    <h4 id="lim" style="background:#337ab7;padding:3px;color:white;text-align:center;font-size:13px;border-radius:5px;display:none"> S/. 10.00 - Envio Lima</h4>
								    <h4 id="dep" style="background:#337ab7;padding:3px;color:white;text-align:center;font-size:13px;border-radius:5px;display:none"> S/. 14.90 - Envio Dep.</h4>
								</th>
								
								<th><h4 id="total"> S/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
							</tfoot>
							<tbody>
								
							</tbody>
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
	var total=0;
	
	
	ganancia=0;
	subtotal=[];
	$("#guardar").hide();

	$("#pidarticulo").change(mostrarValores);
	function mostrarValores(){
		datosArticulo=document.getElementById('pidarticulo').value.split('_');
		
		$("#pprecio_venta").val(datosArticulo[2]);
		$("#pstock").val(datosArticulo[1]);
		$("#pcosto").val(datosArticulo[3]);

	}

	function agregar() {
		datosArticulo=document.getElementById('pidarticulo').value.split('_');
		
		idarticulo= datosArticulo[0];
		articulo=$("#pidarticulo option:selected").text();
		costo=$("#pcosto").val();
		cantidad=parseInt($("#pcantidad").val());
		precio_venta=$("#pprecio_venta").val();
		stock=parseInt($("#pstock").val());
        total = parseFloat($("#total_venta").val());

		if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_venta!="")
		{if (stock>cantidad){
			subtotal[cont]=(cantidad*precio_venta);

			ganancia = (precio_venta-costo)*cantidad;
			total=total+subtotal[cont];
			


			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning " onclick="eliminar('+cont+');">X</button></td><td><input   type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td> <td><input class="not" readonly="readonly" type="number" name="cantidad[]" value="'+cantidad+'" ></td><td><input type="number" readonly="readonly" class="not" name="precio_venta[]" value="'+precio_venta+'" ></td><td>'+subtotal[cont]+'</td> </tr> <td><input type="number" readonly="readonly" class="not" style="display:none;" name="ganancia[]" value="'+ganancia+'" ></td>';
			cont++;
			limpiar();
			$("#total").html("S/." + total);
			$("#total_venta").val(total);
			evaluar();
			$('#detalles').append(fila);
			}
			else{
				alert('La cantidad a vender supera el stock')
			}
			if(precio_venta<costo){
				alert('Corregir costo del producto')
			}
		}
		else {alert("Error al ingresar los detalles de la venta, revise los datos del articulo");}
	}


	function limpiar() {
		$("#pcantidad").val("");
		$("#pcosto").val("");
		$("#pprecio_venta").val("");

	}
	function evaluar(){
		if (total>0){
			$("#guardar").show();


		}
		else {
			$("#guardar").hide();
		}
	}

	function eliminar(index){
		total=total-subtotal[index];
		$("#total").html("S/."+total);
		$("#total_venta").val(total);
		$("#fila" + index).remove();
		evaluar();

	}

</script>
<script>
        $("#idsend").change(mostrarEnvio);
        function mostrarEnvio(){
            k = document.getElementById('idsend').value;
            
            datosUsuario = document.getElementById('idpersona').value.split('_');
            if (k == "recojo"){
        		$("#diro").val('Margarita Praxedes 120');
        		$("#disto").val('San Miguel');
        		$("#provo").val('Lima');
        		$("#ciuo").val('Lima');
        		
        	}
        	if (k == "envio"){
        		$("#diro").val(datosUsuario[3]);
        		$("#disto").val(datosUsuario[5]);
        		$("#provo").val(datosUsuario[6]);
        		$("#ciuo").val(datosUsuario[7]);
        		n = parseFloat($("#total_venta").val());
        		n = n + 10;
        		if ($("#total_venta").val() == 0){
        		    n = 10;
        		    
        		}
        		
        		$("#total_venta").val(n);
        		$("#total").html("S/."+n);
        		document.getElementById("idsend").disabled = "true";
        		document.getElementById("lim").style.display = "block";
        	}
        	if (k == "departamento"){
        		$("#diro").val(datosUsuario[3]);
        		$("#disto").val(datosUsuario[5]);
        		$("#provo").val(datosUsuario[6]);
        		$("#ciuo").val(datosUsuario[7]);
        		n = parseFloat($("#total_venta").val());
        		n = n + 14.9;
        		if ($("#total_venta").val() == 0){
        		    n = 14.9;
        		    
        		}
        		
        		$("#total_venta").val(n);
        		$("#total").html("S/."+n);
        		document.getElementById("idsend").disabled = "true";
        		document.getElementById("dep").style.display = "block";
        	}
        	if (k == "contraentrega"){
        		$("#diro").val(' ');
        		$("#disto").val(' ');
        		$("#provo").val('Lima');
        		$("#ciuo").val('Lima');
        	}
        	r = $("#idsend").val();
        	$("#option").val(r);  
        }
	 
</script>
<script> 

	$("#idpersona").change(mostrarUsuario);
	function mostrarUsuario(){
		datosUsuario = document.getElementById('idpersona').value.split('_');		
		$("#namo").val(datosUsuario[1]);
		$("#dnio").val(datosUsuario[2]);
		$("#diro").val(datosUsuario[3]);
		$("#cello").val(datosUsuario[4]);
		$("#disto").val(datosUsuario[5]);
		$("#provo").val(datosUsuario[6]);
		$("#ciuo").val(datosUsuario[7]);
		$("#mailo").val(datosUsuario[8]);
	}

</script>



@endsection	