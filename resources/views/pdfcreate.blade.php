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


    <h5 style="font-family: sans-serif;padding:20px 30px;font-size:25px;" >Nuevo PDF</h5>
    <form   action="{{route('pdfcreater')}} " method="post" style="padding: 10px 25px;" enctype="multipart/form-data">
        <input type="text" name="titulo" style="position:relative;float: left;width: 50%;margin-top: 20px;border:none;border-bottom: 1px solid #000;" placeholder="Ingrese Titulo" autocomplete="off" required>
        <input type="text" name="name"  style="position:relative;float: left;width: 50%;margin-top: 20px;border:none;border-bottom: 1px solid #000;" placeholder="Nombre PDF" autocomplete="off" required>
        <h5 style="font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-size: 15px;color: black;width: 100%;position: relative;float: left;margin-top: 30px;margin-bottom: 0;" id="ped">Fotos principales</h5>
        <input type="file" name="portada" id="filer" style="position:relative;float: left;width: 50%;margin-top: 20px;border:none;border-bottom: 1px solid #000;"  required>
        <input type="file" name="trama" id="trama" style="position:relative;float: left;width: 50%;margin-top: 20px;border:none;border-bottom: 1px solid #000;" required>


            <button type="submit" style="margin: auto;margin-top:200px;position:relative; padding: 10px 10px; width: 50%;background: #ba1f1f;color:white;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;text-align: center;border:none;display: block; " >
                Enviar
            </button>
            {{ csrf_field() }}
       </form>

    </div>
</div>


@endsection
