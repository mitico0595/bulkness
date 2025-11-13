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
</style>




<div style="position: relative;width:50%;max-width:1200px;min-width:700px;margin:auto;display:block;background:white; margin-top:50px;box-shadow: 0 1px 2px 0 rgb(0 0 0 / 12%);border-radius: 6px;border-bottom: 1px solid #eee;">
    <h5 style="font-family: sans-serif;padding:20px 20px;font-size:25px;border-bottom: 1px solid #eee;display:inline:block;" >PDF Creator</h5>

    <div style="width:100%;margin-top:50px;display:block;background:white;position: relative;margin-bottom:20px;padding:0px 0px;border-top: 4px solid #eee;">
        @foreach ($pdfs as $p)
            <div style="width: 100%;position: relative;padding:10px;border-bottom: 4px solid #eee;">
                <h5 style="display: inline-block;position: relative;font-size:12px;width:20px;">{{$p->id}} </h5>
                <h5 style="display: inline-block;position: relative;font-size:12px;width:200px;text-align:center;font-weight:100;">{{$p->titulo}} </h5>
                <h5 style="display: inline-block;position: relative;font-size:12px;width:200px;text-align:center;font-weight:100;">{{$p->name}} </h5>
                <div style="position: relative;float:right;margin-right:50px;">
                <a href="{{asset('pdfauth/'.$p->id.'/edit')}} " style="position: relative;display:inline-block;width:50px;background:#b10000;padding:5px;font-size:12px;text-decoration:none;color:white;text-align:center;border-radius:5px;line-height:20px;">Editar</a>
                <a href="{{asset('download-pdf/'.$p->id)}}" style="position: relative;display:inline-block;width:100px;background:#b10000;padding:5px;font-size:12px;text-decoration:none;color:white;text-align:center;border-radius:5px;line-height:20px;">PDF Reload <img src="{{asset('image/svg/pdf.svg')}} " alt="" style="width:17px;margin-left:5px;"></a>
                </div>
            </div>
        @endforeach
        <a href="{{url('pdfauth/create')}}" style="text-decoration: none;"><h5 style="position: relative;width:50%;padding:10px;background: #b10000;text-align:center;border-radius:2px;color:white;margin:auto;display:block;font-weight:100;margin-top:20px;cursor:pointer; font-size:17px;">Agregar</h5></a>
    </div>
</div>


@endsection
