<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@include ('title')</title>
        @include ('logo')  
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        
    </head>
<body>
@if (session()->has('success'))
<div style="position: absolute;width: 100%;height: 100vh;background: rgba(0, 0, 0, 0.4);z-index: 9999;top:0px;left: 0px;" id="cerrar">
    <div style="position:relative;display: block;margin: auto;width: 80%;height:200px;background:white;top:250px;padding:20px;box-sizing:border-box;">
        <h5 style="font-size:18px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;position: relative;width: 100%;margin: 0px;font-weight: bold;color: #2b8c17;;">Reclamo enviado correctamente!</h5>
        
        <h6 style="font-size:16px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;position: relative;width: 100%;margin: 0px;font-weight: 100;margin-top: 20px;">Motivo: {{session('motivo') }} </h6>
        <h6 style="font-size:16px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;position: relative;width: 100%;margin: 0px;font-weight: 100;margin-top: 10px;">Queja: {{session('success') }} </h6>
        <a style="padding:5px 20px;font-size: 20px;text-align: center;width: 50%;position: absolute;margin: auto;display: block;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial;border:1px solid black;border-radius: 10px;bottom:10px;left:20%;" onclick="cerrar()">Cerrar</a>
    </div>
</div>
    
@endif

<div style="position:relative;width: 100%;height: auto;">
	<div style="position:relative;width: 100%;">
		 <div class="logo">
                  <img src="{{asset('image/oberlu_logo.png')}} " class="logo1" style="top:0px;width: 100px;">
              </div>
	 </div>
	<h5 style="position:relative;margin:auto;display: block;width: 80%;text-align:center;font-size:20px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;margin-top: 50px; " id="libr">Libro de reclamaciones</h5>	
    <h5 style="position:relative;margin:auto;display: block;width: 80%;text-align:center;font-size:20px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;margin-top: 50px; display: none;" id="lib">Libro del Perdon</h5>

<form action="{{route('messages')}}" method="post" id="checkout-form" style="padding-left: 25px;">
    <div style="width:100%">
	<select name="motivo" class="select-css" style="border-top: none; border-right: none; border-bottom: 2px solid #ba1f1f; border-left: none; border-image: initial; margin-top: 10px; border-radius: 0px; padding: 5px; background: none;" onchange="val()" id="vall">
		<option value="">Seleccione motivo</option> 
		<option value="Me gusta quejarme" id="1">Me gusta quejarme</option>
        <option value="comida" id="2">Me gusta comer rico</option>  

	</select>
    </div>
    <input type="text" name="rest" id="rest" style="position:relative;float: left;width: 50%;margin-top: 20px;border:none;border-bottom: 1px solid #000;display: none;" placeholder="Ingrese nombre restaurant">
    <input type="text" name="number" id="number" style="position:relative;float: left;width: 50%;margin-top: 20px;border:none;border-bottom: 1px solid #000;display: none;" placeholder="Numero del restaurant">
    <h5 style="font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-size: 15px;color: black;width: 100%;position: relative;float: left;margin-top: 30px;margin-bottom: 0;display: none;" id="ped">Ingrese detalles de su pedido:</h5>
	<textarea rows="6" cols="50" name="mensaje" autocomplete="off" class="form-control textnumber" style="margin-top: 20px;width:85%;"></textarea>
	
	{{ csrf_field() }}
        <button type="submit" style="position:relative; padding: 10px 10px; width: 50%;background: #ba1f1f;color:white;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;text-align: center;border:none;display: block;margin: auto;margin-top: 50px; " >
            Enviar
        </button>
   
   </form>
   <h5 style="font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-size: 15px;color: black;width: 100%;position: relative;float: left;margin-top: 30px;margin-bottom: 0;text-align: center;display: none;" id="dev">Devuelveme el orgullo #porqueteamo #teperdono #megustahacerlocontrario</h5>
   <img src="{{asset('image/libro-de-reclamaciones.jpg')}} " style="width:100%;position: relative;float: left;display: block;margin-top: 50px;" id="image">
   </div>
   <script type="text/javascript">
       function cerrar(){

        document.getElementById('cerrar').style.display= "none";
       }
       function val(){
        var e = document.getElementById('vall').value;
        if (e == 'comida')             { 
                document.getElementById('rest').style.display="block";
                document.getElementById('dev').style.display="block";
                document.getElementById('number').style.display="block";
                document.getElementById('image').style.display="none";
                document.getElementById('ped').style.display="block";
                document.getElementById('libr').style.display="none";
                document.getElementById('lib').style.display="block";
            }
        if (e != 'comida')             { 
                document.getElementById('rest').style.display="none";
                document.getElementById('number').style.display="none";
                document.getElementById('dev').style.display="none";
                document.getElementById('image').style.display="block";
                document.getElementById('ped').style.display="none";
                document.getElementById('libr').style.display="block";
                document.getElementById('lib').style.display="none";
            }    
       }
   </script>
</body>
</html>


