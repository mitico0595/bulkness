@extends ('blackboard')
@section ('contenido')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Zen+Kaku+Gothic+Antique&display=swap" rel="stylesheet">

<style>
    *{
        box-sizing: border-box;

    }
    body{
        background: #ededed;
    }
    input:focus {
		outline: 0;
		border-bottom: 5px solid #297abc;
	}
</style>

<div style="position: relative;width:50%;max-width:1200px;min-width:700px;margin:auto;height:100px;display:block;background:white; margin-top:50px;box-shadow: 0 1px 2px 0 rgb(0 0 0 / 12%);border-radius: 6px;border-bottom: 1px solid #eee;">
    <div style="display: inline-block;height: auto;width:100%;background:white;">


    <h5 style="font-family: sans-serif;padding:20px 30px;font-size:25px;" >Editar PDF</h5>
    {!!Form::model($pdfs,['method'=>'PATCH','route'=>['pdfauth.update',$pdfs->id],'enctype'=>'multipart/form-data'])!!}
	{{Form::token()}}
        <input type="text" name="titulo" style="position:relative;float: left;width: 50%;margin-top: 20px;border:none;border-bottom: 1px solid #000;padding-left:20px;" placeholder="Ingrese Titulo" autocomplete="off" required value="{{$pdfs->titulo}} ">
        <input type="text" name="name"  style="position:relative;float: left;width: 50%;margin-top: 20px;border:none;border-bottom: 1px solid #000;padding-left:20px;" placeholder="Nombre PDF" autocomplete="off" required value="{{$pdfs->name}} ">
        <h5 style="font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-size: 15px;color: black;width: 100%;position: relative;float: left;margin-top: 30px;margin-bottom: 0;padding-left:20px;" id="ped">Fotos principales Portada / Trama</h5>
        <input type="file" name="portada" id="filer" style="position:relative;float: left;width: 50%;margin-top: 20px;border:none;border-bottom: 1px solid #000;"  >
        <input type="file" name="trama" id="trama" style="position:relative;float: left;width: 50%;margin-top: 20px;border:none;border-bottom: 1px solid #000;" >
        @php
            $p = 0
        @endphp
        <h5 style="font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-size: 15px;color: black;width: 100%;position: relative;float: left;margin-top: 30px;margin-bottom: 0;padding-left:20px;" id="ped">Imagenes Top Portada (Format: .jpg)</h5>

        @foreach ($tienda as $t)
        <div style="position: relative;display:inline-block;width:50%;padding:20px;float: left;">
            <h6>{{$t->name}}</h6>
            <input type="file" name="portada{{$p}}" id="trama" style="position:relative;float: left;width: 100%;margin-top: 20px;border:none;border-bottom: 1px solid #000;padding:10px 20px;" >
            @if($e[$p] == true)
                <div style="position:absolute;background:green;color:white;padding:5px;right:20px;top:20px;font-size:12px;">Existe</div>

            @endif
        </div>
            @php
            $p = $p+1;
        @endphp
        @endforeach
            <button type="submit" style="margin: auto;position:relative;margin-left:25%; margin-top:20px;margin-bottom:20px; padding: 10px 10px; width: 50%;background: #ba1f1f;color:white;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;text-align: center;border:none;display: inline-block; " >
                Enviar
            </button>
    {!!Form::close()!!}

    </div>
</div>


@endsection
