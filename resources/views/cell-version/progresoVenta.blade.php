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
        	img {
        		max-width: 200px;
        		max-height: 200px;
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
        <div id="soli" style="line-height: 60px;position: absolute;left: 60px;font-size: 18px;" >Seguimiento | Fotos {{$envios->idventa}} </div>
        
     </div>
			{!!Form::model($envios,['method'=>'POST','route'=>['envio-mobile.imageEnvio',$envios->idventa],'enctype'=>'multipart/formdata', 'files'=>'true'])!!}
			{{Form::token()}}
	<div class="" style="display: flex;flex-wrap: wrap;">
			<div class="" style="margin-top: 60px;">
				<div class="form-group" style="padding:20px;border:1px solid #bababa;border-radius:10px;position: relative;float: left;width: 90%;margin-left: 5%;">
					<label for="cembale" style="width:100%;font-weight: bold;text-transform: uppercase;">Documento de embale</label>
					<div style="width:50%; position: relative; float: left;box-sizing: border-box;">
	 							<input type="file" name="cembale" style="font-size:12px;font-family:'Arial'" hidden id="filer0">
	 							<label style="font-size: 15px;font-family:'Arial' " class="archv"  for="filer0" id="selector0" >Insertar Foto</label>
	 							<div id="preview0" style="border:1px dashed #acacac"></div>
	 				</div>				

					@if ($envios->cembale != "")
						<img src="{{asset('images/envios/'.$envios->idventa.'/'.$envios->cembale)}}" style="width:40%;max-height:200px;display:block;margin:auto;position: relative;float: left;margin-left: 10%;filter: grayscale(100%);">
					@endif
				</div>
			</div>
			<div class="">
				<div class="form-group" style="padding:20px;border:1px solid #bababa;border-radius:10px;position: relative;float: left;width: 90%;margin-left: 5%;">
					<label for="csend" style="width:100%;font-weight: bold;text-transform: uppercase;">Documento de enviado </label>
					<div style="width:50%; position: relative; float: left;box-sizing: border-box;">
	 							<input type="file" name="csend" style="font-size:12px;font-family:'Arial'" hidden id="filer">
	 							<label style="font-size: 15px;font-family:'Arial' " class="archv"  for="filer" id="selector" >Seleccione archivo</label>
	 							<div id="preview" style="border:1px dashed #acacac"></div>
	 				</div>
					@if ($envios->csend != "")
						<img src="{{asset('images/envios/'.$envios->idventa.'/'.$envios->csend)}}" style="width:40%;max-height:200px;display:block;margin:auto;position: relative;float: left;margin-left: 10%;filter: grayscale(100%);">
					@endif
				</div>
			</div>
			<div class="">
				<div class="form-group" style="padding:20px;border:1px solid #bababa;border-radius:10px;position: relative;float: left;width: 90%;margin-left: 5%;">
					<label for="centrega" style="width:100%;font-weight: bold;text-transform: uppercase;">Documento de entrega</label>
					<div style="width:50%; position: relative; float: left;box-sizing: border-box;">
	 							<input type="file" name="centrega" style="font-size:12px;font-family:'Arial'" hidden id="filer1">
	 							<label style="font-size: 15px;font-family:'Arial' " class="archv"  for="filer1" id="selector1" >Seleccione archivo</label>
	 							<div id="preview1" style="border:1px dashed #acacac"></div>
	 				</div>
					@if ($envios->centrega!="")
						<img src="{{asset('images/envios/'.$envios->idventa.'/'.$envios->centrega)}}" style="width:40%;max-height:200px;display:block;margin:auto;position: relative;float: left;margin-left: 10%;filter: grayscale(100%);">
					@endif
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<a href="{{url('envio-mobile')}} " class="btn btn-danger" type="reset">Cancelar</a>
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

</body>
   
    </html>