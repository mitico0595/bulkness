@extends ('layouts.supplier-app')
@section ('usuario')
<style>
    +{
        margin: 0;
        padding: 0;
        
    }
    body{
        background: #ededed;
    }
</style>
<style type="text/css">
    *{
        margin: 0;
        padding:0;
        font-family:'Kanit';
        font-weight: 100;
    }
.logo{
            position: relative;
            float: left;
            width:20%;
            box-sizing: border-box;
            display: inline-block;
        }
        .logo1{
            position: absolute;
            width:80px;
            top:12px;
        }
        body{ 
      background: #ededed;
        }
        .search{
            margin-left: 150px;
        }.button{
            line-height: 42px;
        }
        .input-field{
            top:22px;
        }
        a{
            text-decoration: none;
        }
        .dashi{
        	padding-top:150px;
        	padding-left: 100px;
        }
        .mapi{
        	width: 150px;
        	transition: .5s;
        	border-radius: 150px 0px 0px 150px;        	
        	position: relative;
        	display: block;
        	float: right;
        	box-sizing: border-box;

        }

        .mapi:hover{
        	width: 100%;
        	border-radius: 0px 0px 0px 0px;
        }
</style>
<div style="position:absolute; width:70%;min-width:800px;left:15%;top:200px;">
    <div style="position:relative; ">
        <h1 style="font-size:24px;">Ingresos</h1>
        <h5>Tienda/Almacen - Oberlu</h5>
    </div>
    <div style="position:relative;display:block;background:white;padding:30px;margin-top:25px;margin-bottom:50px">
        <div style="position:relative;">
            

            <div style="position:relative;display:block;background:white;padding:30px;margin-top:-10px;">
                <div style="position:relative;">
                {!! Form::open(array('url'=>'ingresos','method'=>'GET','autocomplete'=>'off','role'=>'search','class'=>'')) !!}
                <div style="display:flex;width:100%;position:relative;align-items: center;">
                <div style="width:40%;">
                    <h1 style="font-size:19px;">Tienda</h1>
                    <div class="form-group">
                        
                        <select type="" name="tienda" id="tienda" class="form-control selectpicker" data-live-search="true" style="padding:10px">
                            <option style=""  value="">Seleccione Opcion</option>
                            @foreach ($tiendas as $persona)
                            <option style=""  value="{{$persona->id}}">{{$persona->name}}</option>
                            @endforeach
    
                        </select>
                    </div>
                </div>
                
            </div>
                <div style="display:flex;width:100%;position:relative;align-items: center;">
                    
                    <div style="width:25%;">
                        <h1 style="font-size:19px;">Fecha inicio</h1>
                        <input type="date" id="searchid" value="{{$searchIni}}" name="searchIni" style="padding:10px;margin-top:10px;">
                        <label for="">{{ date_format(date_create($searchIni),"d/m/Y")}} </label>
                    </div>
                    <div style="width:25%;">
                        <h1 style="font-size:19px;">Fecha Final</h1>
                        <input type="date" id="searchid"  value="{{$searchFin}}" name="searchFin"  style="padding:10px;margin-top:10px;">
                        <label for="">{{ date_format(date_create($searchFin),"d/m/Y")}} </label>
                    </div>
                    <div style="width:25%;">
                        <button style="font-size:18px; background:#b10000;border:none;color:white;width:75%;padding:10px 20px;text-align:center;position:relative;margin:auto;display:block;border-radius:5px;">Consultar</button>
                    </div>
                    <div style="width:25%;border-left:1px solid #cecece">
        
                        <a href="ingresos/create" class=""  data-toggle="modal" data-target="#formarticulo" style="position:relative;background:linear-gradient(135deg, rgba(199,152,16,1) 0%,rgba(234,185,45,1) 100%);border-radius:5px; padding:5px 15px;display:block;width:75%;margin:auto;text-decoration:none;text-align:center;color:white">SALE</a>
                    </div>
                </div>
                {{Form::close()}}
        
                </div>
            </div>

        </div>
        <div style="position:relative;width:100%;display:flex;margin-top:40px;justify-content: center;margin-bottom:20px;background:#b54f4f;padding:10px;">
            <div style="width:130px;text-align:center;line-height:35px;color:white">Fecha</div>
            <div style="width:75px;;margin-left:20px;text-align:center;line-height:35px;color:white">Codigo</div>
            <div style="width:75px;;margin-left:20px;text-align:center;line-height:35px;color:white">Place</div>    
            <div style="width:450px;margin-left:20px;text-align:center;line-height:35px;color:white">Nombre</div>
            <div style="width:75px;text-align:center;margin-left:20px;line-height:35px;color:white">Cantidad</div>
            <div style="width:75px;text-align:center;margin-left:20px;line-height:35px;color:white">Stock</div>
        </div>
        @foreach ($ingresos as $ing )
        <div style="position:relative;width:100%;display:flex;margin-top:0px;justify-content: center;padding:10px">
            <div style="width:130px;text-align:center;line-height:35px;font-size:13px;">{{ $ing->fecha }}</div>
            <div style="width:75px;margin-left:20px;text-align:left;line-height:35px;font-size:13px;">{{ $ing->codigo }}</div>
            <div style="width:75px;margin-left:20px;text-align:left;line-height:35px;font-size:13px;">{{ $ing->tienda }}</div>
            <div style="width:450px;text-align:center;margin-left:20px;line-height:35px;font-size:13px;">{{ $ing->name }}</div>
            <div style="width:75px;text-align:center;margin-left:20px;line-height:35px;font-size:13px;">{{number_format( $ing->cantidad,0)}}</div>
            <div style="width:75px;text-align:center;margin-left:20px;line-height:35px;color:black">{{number_format( $ing->stock,0)}}</div>
        </div>    
        @endforeach
        
    </div>
</div>

@endsection