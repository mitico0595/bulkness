<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Oberlu Admin</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty-mobile.css')}} "> 
	 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	   	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <link rel="stylesheet" href="{{asset('css/articulo.css')}} ">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        
       <style type="text/css">
       	* {
       		box-sizing: border-box;
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
		.not{
		    		user-select: none;
		    	}
    	.bootstrap-select{
      	border:none;
      	box-shadow: none;
      	position: relative;
    	width: 200px;
    	margin-bottom: 15px;
      	
    	}
    	.filter-option{
    	font-size: 15px;
      	font-family: 'Kanit';	
    	}
    	.lera{
    		position: relative;
    		
    		float: left;
    		display: block;
    		text-align: center;
    		line-height: 12px;
    	}
    	.lera input{
    		position: relative;
    		width:50px;
    		float: left;
    		display: block;
    		text-align: center;
    		line-height: 12px;
    	}
    	.address-modify{
    	padding: 20px;
	    border: 1px solid #337ab7;
	    border-radius: 5px;
	    margin-bottom: 20px;
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
        <div id="soli" style="line-height: 60px;position: absolute;left: 60px;font-size: 18px;" >Nueva venta</div>
        <a href="{{url('venta-mobile')}} "><img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 30px;position: absolute;top:20px;right: 20px;" ></a>
</div>

<div style="position: absolute;top:70px;width: 100%;padding: 20px; box-sizing: border-box;">   
   @if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

	
			{!!Form::open(array('url'=>'storeMobile','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
		<div class="">	
			<div class="">
			    <div class="form-group" style="float:left;">
				    <label for="">Seleccionar cliente</label>
				    <select style="" type="" name="idpersona" id="idpersona" class="form-control selectpicker" data-live-search="true">
					    @foreach ($personas as $persona)
					    <option style=""  value="{{$persona->id}}_{{$persona->name ?? 'k'}} {{$persona->lastname ?? 'k'}}_{{$persona->dni ?? 'k'}}_{{$persona->direccion ?? 'k'}}_{{$persona->cell ?? 'k'}}_{{$persona->distrito ?? 'k'}}_{{$persona->provincia ?? 'k'}}_{{$persona->ciudad ?? 'k'}}_{{$persona->email ?? 'k'}}">{{$persona->dni}} - {{$persona->name}} {{$persona->lastname}}</option>
					    @endforeach
				    </select>
				</div>
				<div class="form-group" style="">
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
                        
				<div class="form-group" style="">
				    <label for="">Modo de pago</label>
				    <select style="" type="" name="tipo" id="" class="form-control selectpicker" data-live-search="true" >
				        <option style="" value="EFECTIVO - system">Efectivo</option>
					    <option style="" value="YAPE / PLIN - system">Yape / Plin</option>
					    <option style="" value="TRANSFERENCIA - system">Transferencia bancaria</option>
					    <option style="" value="CREDITO - system">Credito</option>
				    </select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="panel panel-primary" style="margin-bottom: 0px;">
				<div class="panel-body" style="padding-bottom: 40px;">
					<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
						<div class="form-group" style="width: 300px;">
							<label>Articulo</label>
							<select name="pidarticulo" class="form-control selectpicker"  id="pidarticulo" data-live-search="true">
								@foreach($articulos as $articulo)
								<option value="{{$articulo->id}}_{{$articulo->stock}}_{{$articulo->precio}}_{{$articulo->costo}}">{{$articulo->articulo}}</option>
								@endforeach
							</select>
						</div>	
					</div>

					<div class="col-lg-2 col-sm- col-md-2 col-xs-12" style="position: relative;width: 100px;float: left;margin-left: 15px;">
						<div class="form-group">
							<label for="cantidad">Cantidad</label>
							<input type="number" name ="pcantidad"  id="pcantidad"  class="form-control" placeholder="cantidad">
	
						</div>	
					</div>
					<div class="col-lg-2 col-sm- col-md-2 col-xs-12" style="position: relative;width: 100px;float: left;margin-left: 15px;">
						<div class="form-group">
							<label for="stock">Stock</label>
							<input type="number" disabled name ="pstock"  id="pstock"  class="form-control" placeholder="Stock">
	
						</div>	
					</div>
					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12" style="position: relative;width: 100px;float: left;margin-left: 15px;">
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

					<div class="" style="position: relative;float: left;width: 100%;
					display: inline-block;">
						<div id="detalles" class="">
							<div style="background-color: #e5e5e5;position: relative;width: 100%;height: 25px;display: block;">
								<div style="position: relative;width:50px;float: left;display: block;text-align: center;line-height: 12px;margin-top:5px;">Delete</div>
								<div style="position: relative;width:150px;float: left;display: block;text-align: center;line-height: 12px;margin-top:5px;">Articulo</div>
								<div style="position: relative;width:50px;float: left;display: block;text-align: center;line-height: 12px;margin-top:5px;">Cantidad</div>
								<div style="position: relative;width:50px;float: left;display: block;text-align: center;line-height: 12px;">Precio Venta</div>								
								<div style="position: relative;width:50px;float: left;display: block;text-align: center;line-height: 12px;margin-top: 5px;">Subtotal</div>

							</div>
							<div style="position: absolute;bottom:0px;right: 150px;">
							    <h4 id="lim" style="background:#337ab7;padding:3px;color:white;text-align:center;font-size:13px;border-radius:5px;position:absolute;left: -180px;top: 5px;width:150px;display:none"> S/. 10.00 - Envio Lima</h4>
								<h4 id="dep" style="background:#337ab7;padding:3px;color:white;text-align:center;font-size:13px;border-radius:5px;position:absolute;left: -180px;top: 5px;width:150px;display:none"> S/. 14.90 - Envio Dep.</h4>
								   
								<div style="position: absolute;left: 0px;top: 0px;font-size: 17px;">TOTAL</div>	
								<h4 id="total" style="position: absolute;left: 60px;top: 2px;font-size: 17px;width: 80px;"> S/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta">
							</div>
							<tbody>
								
							</tbody>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="address-content" style="position: relative;margin-top: 20px;">
        <div class="ubicacion-image" style="position: absolute;right: 10px;top: 10px;">
            <img src="{{asset('image/svg/mapi.svg')}} " class="image-ub" style="width: 20px;">

        </div>

        <div class="address-modify">
        	<h5 style="font-size: 17px;">Tarjeta de envio</h5>
            <input type="text" name="name" value="" style="border:none;width: 100%;font-size: 14px;"  id="namo">
            <input type="text" name="dni" value="" style="border:none;font-size: 14px;"  id="dnio">
            <input type="text" name="direccion" value="" style="font-size: 14px;border:none;width: 80%;color:#808080"  id="diro">
            <input type="" name="distrito" value="" style="border:none;width: 80%;color:#808080;text-transform: uppercase;font-size: 10px;"  id="disto">
            <input type="" name="provincia" value="" style="border:none;width: 80%;color:#808080;text-transform: uppercase;font-size: 10px;display: block;position: relative;float: left;"  id="provo"> 
            <input type="" name="ciudad" value=" " style="border:none;width: 80%;color:#000;text-transform: uppercase;font-size: 12px;display: block;position: relative;float: left;margin-left: -2px;margin-top:0px; font-weight: bold;" id="ciuo">
            <input type="" name="celular" value="" style="border:none;width: 80%;color:#808080;font-size: 14px;"  id="cello">
            <input type="" name="email" value=" " style="border:none;width: 80%;color:#000;text-transform: lowercase;font-size: 14px;display: block;position: relative;float: left;margin-left: -2px;margin-top:0px; font-weight: 100;"  id="mailo" autocomplete="off" required="required">
                        
            
        </div>
    </div>
		<input name="_token" value="{{ csrf_token() }}" type="hidden">

					<button class="" type="submit" style="position: relative;width: 100%;background: #3087c1;border:none; padding:10px 5px;font-size: 17px;border-radius: 10px;color:white;">Guardar</button>
		
			

			{!!Form::close()!!}


</div>
	

<div id="menum" style="position: fixed;top:0px;z-index: 9999999;height: 100vh;background:  linear-gradient(135deg, rgba(19,84,122,1) 0%,rgba(3,150,255,1) 100%);border-radius: 0px;width: 100%;color:white; ">
            <img src="{{asset('image/svg/cerrar2.svg')}} " style="width: 30px;position: absolute;top:20px;right: 20px;" onclick="leftclose()">
            <div id="menu-cont" style="position: absolute;width: 100%;transition: .5s;">
            <div style="position: relative;">
            <a href="{{url('admin-mobile')}} ">Home</a>
            <a onclick="detail_inv()" id="inv" >Inversion</a>

            <a onclick="detail_ven()" style="font-weight: bold;">Ventas</a> 
            <a >Usuarios</a>                        
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

            <a >Envios</a> 
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


<script> 

	$(document).ready(function(){$('#bt_add').click(function(){
		agregar();
		});
	});

	var cont=0;
	total=0;
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
			var stotal= total.toFixed(2);


			var fila='<div class="selected" style="height:30px;margin-top:5px;" id="fila'+cont+'"><div class="lera" style="width:50px"><button type="button" class="btn btn-warning " onclick="eliminar('+cont+');">X</button></div><div class="lera" style="width:150px"><input  type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</div> <div class="lera" style="width:50px"><input class="not" readonly="readonly" type="number" name="cantidad[]" value="'+cantidad+'" ></div><div class="lera"><input type="number" readonly="readonly" class="not" name="precio_venta[]" value="'+precio_venta+'" ></div><div class="lera"><input type="number" readonly="readonly" class="not" style="display:none;" name="ganancia[]" value="'+ganancia+'" ></div> <div style="width:50px;text-align:center" class="lera">'+subtotal[cont]+'</div></div>';
			cont++;
			limpiar();
			$("#total").html("S/." + stotal);
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
<script type="text/javascript">
	 
         
        function datadat(){
            document.getElementById('data-send').style.display= "block";
        }
        function closedata(){
            document.getElementById('data-send').style.display= "none";
        }
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
