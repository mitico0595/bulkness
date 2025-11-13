@extends ('blackboard')
@section ('contenido')


<link rel="stylesheet" href="{{asset ('css/articulo.css')}}" >
<style type="text/css">
body{
    background: #ededed;
}
	.blackboard{
		background: #f2f2f2;
	}
	.tittletop{
		position: relative;
    	width: 100%;
    	display: block;
    	margin: auto;
    	padding: 10px;
	}
	.tittletop h5{
		position: relative;
		float:left;
		width: 120px;
		font-size: 12px;
		text-align: center;
	}
	.grid_envio {
		position: relative;
		display: inline-block;
		width: 100%;
		background: #fff;
	}
	.subgrid{
		position: relative;
		display: block;
		width: 100%;
		padding: 20px 10px;
	}
	.subgrid h3 {
		line-height: 0px;
		position: relative;
		float:left;
		width: 120px;
		font-size: 12px;
		text-align: center;
	}
	.inputcreate{
		width: 100px;
		margin-top: 20px;
		position: relative;
		display: inline-block;
	}
	.inputcreate input{
		border:none;
		border-bottom: 2px solid #282828;
		width: 80px;
		padding: 15px 20px 4px 8px;
		font-size: 14px;
	}
	.inputcreate span{
		position: absolute;
		font-size: 11px;

	}
	.inputcreate input:focus{
		outline: 0;
	}
</style>
<div id="crudgasto" class="con_articulo" style="width:80%; position: relative; display: block;background:white;padding:20px;box-shadow: 1px 2px 15px #808080;min-width:1200px;margin:auto">
	<h1>OBERLU</h1>
	<div class="titulo"><h1 class="page-head">Registro de tiendas especializadas</h1></div>
	<a href="" class="add_ad" style="" data-toggle="modal" data-target="#create">
		Add item</a>
	<div class="subcon_articulo" style="margin-top:50px;max-width:800px;width:100%;display:inline-block">

            @foreach ($tiendas as $tienda)

                <div style="position:relative;float:left;width:350px;height:100px;border: 1px solid #282828;border-radius:10px;margin-left:15px;margin-top:15px">
                    <form method="POST" action="{{url("tiendas/{$tienda->id}") }}"  >
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="deleted" style="border:none"><span class="material-icons deletedspan">close</span></button>
                    </form>
                    <div style="position: relative; float:left;padding-top:20px; font-size: 35px; text-align:center;width: 50px;color:black;display:inline-block;margin:0;height:100%">{{$tienda -> id}}</div>
                    <div style="position: relative; float:left; padding-top:15px; font-size: 15px; text-align:center;width: 150px;color:black;display:inline-block;margin:0;height:100%;">{{$tienda -> name}}</div>
                </div>

            @endforeach




	</div>
	@include('almacen.create')
</div>
	<script src="{{asset('js/app.js')}}"></script>

@endsection
