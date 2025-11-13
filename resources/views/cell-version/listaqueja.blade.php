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
<body style="background-color:#ededed">
	<div style="margin-top:50px;">
		<h5 style="font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial;font-size:20px;text-align: center;">Lista de quejas de Greycy</h5>
@foreach ($messages as $mes)
<div style="width:100%;position: relative;float: left;padding: 10px;box-sizing: border-box;border: 1px solid #ededed;background: white;">
	<div style="width:50px;text-align: center;position: relative;float: left;display: inline-block;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial;font-size:15px">{{$mes -> id}}</div>
	<div style="width:100px;text-align: center;position: relative;float: left;display: inline-block;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial;font-size:15px">{{$mes -> motivo }} -

	</div>
	<div style="width:100px;text-align: center;position: relative;float: left;display: inline-block;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial;font-size:15px">{{$mes -> rest }} -

	</div>
	<div style="width:100px;text-align: center;position: relative;float: left;display: inline-block;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial;font-size:15px">{{$mes -> number }} -

	</div>
	<div style="width:200px;text-align: center;position: relative;float: left;display: inline-block;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial;font-size:15px">{{$mes -> mensaje}}</div>
</div>
	
 
@endforeach
</div>
</body>
</html>