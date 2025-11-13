@extends('blackboard')
@section('contenido')
<style type="text/css">
	.archv{
	display: block;
	margin:auto;
	width: 70%;
	border:1px solid #dedede;
	padding: 5px 15px;
	border-radius: 10px;
	color: #282828;
	margin-top: 20px;
	margin-bottom: 20px;
	text-align: center;
	text-transform: uppercase;
	transition: .1s;
}
.archv:hover {
	transform: scale(1.05);
}
.archv.active {
	background: #808080;
	color: #fff;
}
#preview img{
	width: 100px;
	display: block;
	margin:auto;
}
#preview0 img{
	width: 100px;
	display: block;
	margin:auto;
}
#preview1 img{
	width: 100px;
	display: block;
	margin:auto;
}
</style>
	<div class="row">

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Documentos de envio</h3>
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

			{!!Form::model($envios,['method'=>'POST','route'=>['lista.imageEnvio',$envios->idventa],'files'=>'true'])!!}
			{{Form::token()}}
	<div class="row">
			
			
					

			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group" style="padding:20px;border:1px solid #bababa;border-radius:10px;">
					<label for="cembale" style="width:100%;font-weight: bold;text-transform: uppercase;">Documento de embale</label>
					<div style="width:100%; position: relative; float: right;">
	 							<input type="file" name="cembale" style="font-size:12px;font-family:'Arial'" hidden id="filer0">
	 							<label style="font-size: 15px;font-family:'Arial' " class="archv"  for="filer0" id="selector0" >Seleccione archivo</label>
	 							<div id="preview0" style="border:1px dashed #acacac"></div>
	 				</div>				

					@if ($envios->cembale != "")
						<img src="{{asset('images/envios/'.$envios->idventa.'/'.$envios->cembale)}}" style="width:200px;max-height:200px;display:block;margin:auto;">
					@endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group" style="padding:20px;border:1px solid #bababa;border-radius:10px;">
					<label for="csend" style="width:100%;font-weight: bold;text-transform: uppercase;">Documento de enviado </label>
					<div style="width:100%; position: relative; float: right;">
	 							<input type="file" name="csend" style="font-size:12px;font-family:'Arial'" hidden id="filer">
	 							<label style="font-size: 15px;font-family:'Arial' " class="archv"  for="filer" id="selector" >Seleccione archivo</label>
	 							<div id="preview" style="border:1px dashed #acacac"></div>
	 				</div>
					@if ($envios->csend != "")
						<img src="{{asset('images/envios/'.$envios->idventa.'/'.$envios->csend)}}" style="width:200px;max-height:200px;display:block;margin:auto;">
					@endif
				</div>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group" style="padding:20px;border:1px solid #bababa;border-radius:10px;">
					<label for="centrega" style="width:100%;font-weight: bold;text-transform: uppercase;">Documento de entrega</label>
					<div style="width:100%; position: relative; float: right;">
	 							<input type="file" name="centrega" style="font-size:12px;font-family:'Arial'" hidden id="filer1">
	 							<label style="font-size: 15px;font-family:'Arial' " class="archv"  for="filer1" id="selector1" >Seleccione archivo</label>
	 							<div id="preview1" style="border:1px dashed #acacac"></div>
	 				</div>
					@if ($envios->centrega!="")
						<img src="{{asset('images/envios/'.$envios->idventa.'/'.$envios->centrega)}}" style="width:200px;max-height:200px;display:block;margin:auto;">
					@endif
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		document.getElementById("filer").onchange = function(e) { 
  		let reader = new FileReader();
  		reader.readAsDataURL(e.target.files[0]);
  		reader.onload = function(){
   		let preview = document.getElementById('preview'),
        image = document.createElement('img');
    	image.src = reader.result;
   		preview.innerHTML = '';
    	preview.append(image);
  		};}
  		document.getElementById("filer0").onchange = function(e) { 
  		let reader = new FileReader();
  		reader.readAsDataURL(e.target.files[0]);
  		reader.onload = function(){
   		let preview = document.getElementById('preview0'),
        image = document.createElement('img');
    	image.src = reader.result;
   		preview.innerHTML = '';
    	preview.append(image);
  		};}
  		document.getElementById("filer1").onchange = function(e) { 
  		let reader = new FileReader();
  		reader.readAsDataURL(e.target.files[0]);
  		reader.onload = function(){
   		let preview = document.getElementById('preview1'),
        image = document.createElement('img');
    	image.src = reader.result;
   		preview.innerHTML = '';
    	preview.append(image);
  		};}
		var loader= function(e){
			let file=e.target.files;
			let show = "<span> Selected file: </span> " + file[0].name;
			let output=document.getElementById("selector");
			output.innerHTML =show;
			output.classList.add("active");

			};
		let fileInput = document.getElementById("filer");
		fileInput.addEventListener("change",loader);
		var loader0= function(e){
			let file=e.target.files;
			let show = "<span> Selected file: </span> " + file[0].name;
			let output=document.getElementById("selector0");
			output.innerHTML =show;
			output.classList.add("active");

			};
		let fileInput0 = document.getElementById("filer0");
		fileInput0.addEventListener("change",loader0);
		var loader1= function(e){
			let file=e.target.files;
			let show = "<span> Selected file: </span> " + file[0].name;
			let output=document.getElementById("selector1");
			output.innerHTML =show;
			output.classList.add("active");

			};
		let fileInput1 = document.getElementById("filer1");
		fileInput1.addEventListener("change",loader1);
	</script>
			{!!Form::close()!!}
	
@endsection