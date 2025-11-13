@extends ('layouts.supplier-app')
@section ('usuario')
<style>
    *{
        margin:0;
        padding:0;
        font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
        font-weight: 100;
    }
    body{
        background:#ededed;
    }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('css/adminventa.css')}}">
<div style="position:absolute; width:70%;min-width:800px;left:15%;top:200px;">
    <div style="position:relative; ">
        <h1 style="font-size:24px;">Ventas realizadas</h1>
        <h5>version beta - Oberlu</h5>
    </div>

	<div style="position:relative;display:block;background:white;padding:30px;margin-top:25px;">
		<div style="position:relative;">
		{!! Form::open(array('url'=>'pedidos','method'=>'GET','autocomplete'=>'off','role'=>'search','class'=>'')) !!}
        <div style="display:flex;width:100%;position:relative;align-items: center;">
            <div style="width:25%;">
                <h1 style="font-size:19px;">Fecha inicio</h1>
                <input type="date" id="searchid" value="{{old('searchIni')}}" name="searchIni" style="padding:10px;margin-top:10px;">
                <label for="">{{ date_format(date_create($searchIni),"d/m/Y")}} </label>
            </div>
            <div style="width:25%;">
                <h1 style="font-size:19px;">Fecha Final</h1>
                <input type="date" id="searchid" value="{{old('searchFin')}}" name="searchFin"  style="padding:10px;margin-top:10px;">
                <label for="">{{ date_format(date_create($searchFin),"d/m/Y")}} </label>
            </div>
            <div style="width:25%;">
                <button style="font-size:18px; background:#b10000;border:none;color:white;width:75%;padding:10px 20px;text-align:center;position:relative;margin:auto;display:block;border-radius:5px;">Consultar</button>
            </div>
            <div style="width:25%;border-left:1px solid #cecece">

                <a href="pedidos/create" class=""  data-toggle="modal" data-target="#formarticulo" style="position:relative;background:linear-gradient(135deg, rgba(199,152,16,1) 0%,rgba(234,185,45,1) 100%);border-radius:5px; padding:5px 15px;display:block;width:75%;margin:auto;text-decoration:none;text-align:center;color:white">SALE</a>
            </div>
		</div>
		{{Form::close()}}

		</div>
        <div style="position:relative;width:100%;display:flex;margin-top:40px;justify-content: center;margin-bottom:20px;background:#d0a017;padding:10px;">
            <div style="width:50px;text-align:center;line-height:35px;color:white">Codigo</div>
            <div style="width:450px;margin-left:20px;text-align:center;line-height:35px;color:white">Nombre</div>
            <div style="width:75px;text-align:center;margin-left:20px;line-height:35px;color:white">Cantidad</div>
            <div style="width:75px;text-align:center;margin-left:20px;color:white">Precio Venta</div>
            <div style="width:75px;text-align:center;margin-left:20px;color:white">Total Vendido</div>
        </div>


					@foreach ($pedido as $ven)
						<div class="detalleSale" style="background:none;">
						<div class="fecha">{{ $ven -> id}}</div>

						@if ($ven->month == 1)	<div class="subfecha2">ENE</div>@endif
						@if ($ven->month == 2)	<div class="subfecha2">FEB</div>@endif
						@if ($ven->month == 3)	<div class="subfecha2">MAR</div>@endif
						@if ($ven->month == 4)	<div class="subfecha2">ABR</div>@endif
						@if ($ven->month == 5)	<div class="subfecha2">MAY</div>@endif
						@if ($ven->month == 6)	<div class="subfecha2">JUN</div>@endif
						@if ($ven->month == 7)	<div class="subfecha2">JUL</div>@endif
						@if ($ven->month == 8)	<div class="subfecha2">AGO</div>@endif
						@if ($ven->month == 9)	<div class="subfecha2">SEP</div>@endif
						@if ($ven->month == 10)	<div class="subfecha2">OCT</div>@endif
						@if ($ven->month == 11)	<div class="subfecha2">NOV</div>@endif
						@if ($ven->month == 12)	<div class="subfecha2">DIC</div>@endif
						<div class="fecha2"></div>

						<div class="intern">
							<div class="subintern" style="width:50px">{{ $ven -> id}}</div>

						</div>

					</div>

					@endforeach



		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


    </div>
</div>
@endsection
