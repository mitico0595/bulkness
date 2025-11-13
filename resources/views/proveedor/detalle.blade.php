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
<div style="position:absolute; width:70%;min-width:800px;left:15%;top:200px;">
    <div style="position:relative; ">
        <h1 style="font-size:24px;">Reporte por productos</h1>
        <h5>Rango de fecha - Oberlu</h5>
    </div>
    <div style="position:relative;display:block;background:white;padding:30px;margin-top:25px;">
        <div style="position:relative;">
            {!! Form::open(array('url'=>'detalle-producto','method'=>'GET','autocomplete'=>'off','role'=>'search','class'=>'buscador')) !!}
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
                    <h1 style="font-size:19px;text-align:center">Ingreso Total</h1>
                    <h1 style="font-size:19px;text-align:center">S/. {{number_format($sum,2)}}</h1>
                </div>
            </div>
            {{Form::close()}}
        </div>
        <div style="position:relative;width:100%;display:flex;margin-top:40px;justify-content: center;margin-bottom:20px;background:#b54f4f;padding:10px;">
            <div style="width:50px;text-align:center;line-height:35px;color:white">Codigo</div>
            <div style="width:450px;margin-left:20px;text-align:center;line-height:35px;color:white">Nombre</div>
            <div style="width:75px;text-align:center;margin-left:20px;line-height:35px;color:white">Cantidad</div>
            <div style="width:75px;text-align:center;margin-left:20px;color:white">Precio Venta</div>
            <div style="width:75px;text-align:center;margin-left:20px;color:white">Total Vendido</div>
        </div>
        @foreach ($pedido as $p )
        <div style="position:relative;width:100%;display:flex;margin-top:0px;justify-content: center;padding:10px">
            <div style="width:50px;text-align:center;line-height:35px;font-size:13px;">{{$p->codigo}} </div>
            <div style="width:450px;margin-left:20px;text-align:left;line-height:35px;font-size:13px;">{{$p->name}}</div>
            <div style="width:75px;text-align:center;margin-left:20px;line-height:35px;font-size:13px;">{{number_format($p->cantidad,0)}}</div>
            <div style="width:75px;text-align:center;margin-left:20px;line-height:35px;font-size:13px;">{{number_format($p->precio_venta,2)}}</div>
            <div style="width:75px;text-align:center;margin-left:20px;line-height:35px;font-size:13px;">{{number_format($p->subtotal,2)}}</div>
        </div>
        @endforeach
    </div>
</div>
@endsection
