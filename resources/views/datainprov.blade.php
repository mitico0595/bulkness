<title>@include ('title')</title>
        @include ('logo')

        <link rel="stylesheet" href="{{asset('css/estilos.css')}}" >
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="{{asset('css/boton.css')}}" >
<link href="https://fonts.googleapis.com/css2?family=Fuggles&display=swap" rel="stylesheet">
<style type="text/css">
	.input{
		border:1px solid #cecece;
		background: none;
		border-radius: 5px;
		width: 200px;
		padding: 5px 10px;
		margin-top: 5px;
	}
	.input:focus { 
		outline: 0;
		border-bottom: 2px solid #297abc;
	}
    body{
        position: relative;
        margin: auto;
        max-width: 1200px;
        min-width: 1200px;
    }
    .envio{
        line-height:50px;
        padding:0px 20px;
        position: relative;
        float: left;width:250px;
        height:50px;
        background: #dcf7cb;
        border-radius: 3px;
        border: 1px solid #45a00a;
        color: #45a00a;
        font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
        cursor: pointer;
    }
    .envio:hover{
        background: #45a00a;
        color:white;
    }
    .done{background: white}
    .done:hover{
        background: #45a00a;
        color:white;
    }
    .labelt{
        font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
        font-size: .9rem;

    }
    .inputn{
        width:100%;
        padding: 8px 8px;
        margin-top:10px;
        font-size: .9rem;
        background: #f7f7f7 ;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
    #datar{
        display:block;
    }
    #posstarget{
        display:none;
    }
    #dirr{
        display: none;
        color: #ba1f1f;
    }
    .coverr:hover #dirr{
        color: white;
    }
    .coverr:hover{
        background: #ba1f1f;
    }
    button{
        
    z-index: 999;
    right: 0;
   
    }
</style>
<div style="position:fixed;width:100%;left:0px;height:100px;background:white;border-bottom:1px solid #eee;z-index:9999">
    <div style="position: relative; margin: auto;max-width: 1200px;height:100%">
        <a href="{{url('/')}}"><img src="{{asset('image/oberlu_logo.png')}} " style="position: relative;float:left;width: 190px;z-index: 999;margin-top:10px;"></a>
        <div style="position:relative;float:right;display:inline-block">
            <div style="position: relative;float:left;width:180px;height:100%;">
                <img src="{{asset('image/svg/call-centeri.svg')}} " alt="" style="width: 30px;margin-top:35px;">
                <h4 style="position: relative;float:right;display:inline-block;font-weight:100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;line-height:95px;color:#666;margin:0">Asesoría telefónica</h4>
            </div>
            <div style="position: relative;float:left;width:155px;margin-left:25px;height:100%;background:white;">
                <img src="{{asset('image/svg/seguro.svg')}} " alt="" style="width: 30px;margin-top:35px;">
                <h4 style="position: relative;float:right;display:inline-block;font-weight:100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;line-height:95px;color:#666;margin:0">Compra seguro</h4>

            </div>
        </div>
    </div>
</div>
@if(Session::has('cart'))

<div style="box-sizing:border-box;width: 100%; position: relative;display: inline-block;margin:0px;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;border:none;margin-top:150px;height:100px;border: 1px solid #cacaca;border-radius:5px;box-shadow:1px 1px 4px #cacaca" >
    <img src="{{asset('image/thumb/cart-p2.png ')}}" alt="" style="width:530px" id="imgsen">
    <img src="{{asset('image/thumb/cart-p3.png ')}}" alt="" style="width:530px;display: none"  id="imgtar">
    <div style="width: 200px;right: 35px;position: absolute;z-index:1;top:27px;">
        <h2 style="font-size: 15px;font-weight:100" id="textover">Ver detalle de compra</h2>
    </div>
    <img src="{{asset('image/svg/menu2.svg')}} " style="width: 17px;right: 10px;top:25px;position: absolute;padding: 15px;border-radius: 50px;background: #282828;cursor: pointer;" onclick="abrir()" id="circlever">

</div>
<div id="charge-error">{{Session::get('error')}} </div> 

<form  method="post" action="{{url('pagas') }}"  >      
@csrf
   
    
<div style="min-width:850px;max-width:850px; box-sizing:border-box; padding:20px 20px 30px; width: 100%; position: relative;display: inline-block;margin:0px;margin-top: 20px;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;border:none;border: 1px solid #cacaca;border-radius:5px;box-shadow:1px 1px 4px #cacaca;float:left;margin-bottom:100px;" id="clicka" >
    <h2 style="margin:0px;padding-top: 10px;font-size: 20px;font-weight: 100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif " id="dir">Dirección de envío</h2>
    <h2 style="margin:0px;padding-top: 10px;font-size: 20px;font-weight: 100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif" id="dirr" onclick="modify()" >Modificar datos de envío</h2>
    <div id="datar">

    <div style="position: relative;width:100%;margin-top:20px">
        <a href="{{url('pagos')}}"><div class="envio done" style="">
            Envío Lima Metropolitana <img src="{{asset('image/svg/delivery_black.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
        </div></a>
        <div class="envio" style="margin-left:10px">
            Envío Departamentos <img src="{{asset('image/svg/delivery_black.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
        </div>
    </div>
    <div style="position: relative;display:inline-block;width:100%;max-width:1000px;min-width:900px;">
        <div style="width:260px;position: relative;display: inline-block;margin-top: 20px;box-sizing:border-box;">
            <label for="name" class="labelt" style="">Nombre de quien recibe</label>
            <input type="text" name="name" id="name" required="" class="inputn" value=" {{Auth::user()->name}} {{Auth::user()->lastname}}">
        </div>
        <div style="width:260px;position: relative;display: inline-block;margin-top: 20px;box-sizing:border-box;margin-left:10px">
            <label for="cell" class="labelt" style="">Teléfono o Celular</label>
            <input type="text" name="cell" id="cellnumber" required="" class="inputn" value="{{ Auth::user()->cell}}">
        </div>
        <div style="width:260px;position: relative;display: inline-block;margin-top: 20px;box-sizing:border-box;margin-left:10px">
            <label for="dni" class="labelt" style="">DNI</label>
            <input type="text" name="dni" id="dni" required="" class="inputn" value="{{ Auth::user()->dni}}">
        </div>
        <div style="width:535px;position: relative;display: inline-block;margin-top: 20px;box-sizing:border-box;">
            <label for="detalle" class="labelt" style="">Dirección de envío</label>
            <input type="text" name="detalle" id="detalle" required="" class="inputn" value=" {{Auth::user()->direccion}}" style="">
        </div>
        <div style="width:260px;position: relative;display: inline-block;margin-top: 20px;box-sizing:border-box;margin-left:10px">
            <label  class="labelt" style="">Referencia</label>
            <input type="text" name="referencia" id="referencia" required="" class="inputn" value="-">
        </div>



        <div style="width:260px;position: relative;display: inline-block;margin-top: 20px;box-sizing:border-box;">
            <label for="distrito" class="labelt" style="">Distrito</label>
            <input type="text" name="distrito" id="distrito" required="" class="inputn" value="{{ Auth::user()->distrito}}">
        </div>
        <div style="width:260px;position: relative;display: inline-block;margin-top: 20px;box-sizing:border-box;margin-left:10px">
            <label for="provincia" class="labelt" style="">Provincia</label>
            <input type="text" name="provincia" id="provincia" required="" class="inputn" value="{{ Auth::user()->provincia}}" required placeholder="Provincia">
        </div>
        <div style="width:260px;position: relative;display: inline-block;margin-top: 20px;box-sizing:border-box;margin-left:10px">
            <label for="ciudad" class="labelt" style="">Ciudad</label>
            <select style="" name="ciudad" id="ciudad" for="ciudad" class="inputn">
               
                <option value="Lambayeque">Lima</option>
                <option value="Amazonas">Amazonas</option>
                <option value="Ancash">Ancash</option>
                <option value="Apurimac">Apurimac</option>
                <option value="Arequipa">Arequipa</option>
                <option value="Ayacucho">Ayacucho</option>
                <option value="Cajamarca">Cajamarca</option>
                <option value="Cusco">Cusco</option>
                <option value="Huancavelica">Huancavelica</option>
                <option value="Huanuco">Huanuco</option>
                <option value="Ica">Ica</option>
                <option value="Junin">Junin</option>
                <option value="La Libertad">La Libertad</option>
                <option value="Lambayeque">Lambayeque</option>
                <option value="Loreto">Loreto</option>
                <option value="Madre de Dios">Madre de Dios</option>
                <option value="Moqueguea">Moquegua</option>
                <option value="Pasco">Pasco</option>
                <option value="Piura">Piura</option>
                <option value="Pasco">Pasco</option>
                <option value="Piura">Piura</option>
                <option value="Puno">Puno</option>
                <option value="San Martin">San Martin</option>
                <option value="Tacna">Tacna</option>
                <option value="Tumbes">Tumbes</option>
                <option value="Ucayali">Ucayali</option>


            </select>

        </div>
        <a href="{{url('busco')}} "><div style="width:260px;position: relative;display: inline-block;margin-top: 20px;box-sizing:border-box;margin-top: 20px; box-sizing: border-box; color:#ba1f1f;
        line-height: 40px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;text-align:center;font-weight:600;cursor:pointer">
            Continuar comprando
        </div></a>
        
        <button class="boton cuatro"><span>Continuar con el pago</span></button> </div>

    </div>
</div>


<div style="margin-left:20px; box-sizing:border-box;width: 330px; position: relative;display: inline-block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;border:none;margin-top:20px;height:100px;" >
    <img src="{{asset('image/svg/cerrar.svg')}} " style="width: 17px;right: 10px;top:10px;position: absolute;z-index: 99999;display: none;cursor: pointer;"  onclick="closes()" id="cerrar">

    <div style="position: absolute;right: 0px; display: block;box-sizing:border-box; width:330px;top:-20px;padding:30px;border:1px solid #cecece;padding-top: 20px;border-radius: 7px;margin-top: 20px;background: #282828;display: block;min-height:457px;" id="todo">

        <div style="position: absolute;top:20px;font-size: 12px;color:#fff"> DETALLE DE COMPRA</div>


        @foreach ($searches as $search)
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 20px;">
            <div style="width: 90px; position: relative;float:left;display: block;"><img src="{{asset('images/'.$search['item']['image'])}} " style="width:100%;border-radius: 50px;"></div>
            <div style="position: absolute;top:10px;left:110px;width: 150px;font-size: 15px;line-height: 15px;color:#fff;letter-spacing: 0;line-height: 15px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; margin: 0px;">{{$search['item']['name'] }} </div>
            <div style="position: absolute;top:50px;left:110px;width: 150px;font-size: 10px;line-height: 10px;color:#fff;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif ">{{$search['item']['categoria'] }} </div>
            <input type="number" name="idarticulo[]" value="{{$search['item']['id']}}" style="display: none;color:#fff" >
            <div style="position: absolute;top:65px;left:110px;color:#fff;font-size: 10px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">x{{$search['qty']}} </div>
            <input type="number" name="cantidad[]" value="{{$search['qty']}}" style="display: none;" >
            <div style="position: absolute;top:65px;left:135px;width: 150px;color:#fff;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;text-align: center;width: 50px;font-size: 10px">{{$search['item']['precio']}} </div>
            <input type="number" name="precio_venta[]" value="{{$search['item']['precio']}}" style="display: none;" >
            <div style="position: absolute;top:80px;left:120px;width: 150px;color:#fff;text-align: center;width: 150px;font-size: 11px;font-weight: 100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">SUB-TOTAL S/.  {{number_format($search['precio'],2)}} </div>

        </div>
        @endforeach
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 20px;padding-bottom: 0">
            <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Subtotal compras: </h1>
            <h1 style="position: relative;width: 80px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px;margin: 0 ">S/.  {{number_format($totalProduct,2)}} </h1>
        </div>
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 0px;padding-top: 0;padding-bottom: 0 ">
            <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Cargos Logisticos (0,01%): </h1>
            <h1 style="position: relative;width: 80px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">S/.  0.00 </h1>
        </div>
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 0px;padding-top: 0;border-bottom: 1px solid #808080;box-sizing: border-box;">
            <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Envio Lima Metropolitana: </h1>
            <h1 style="position: relative;width: 50px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">S/. 14.90</h1>
        </div>
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 10px;padding-top: 0;border-bottom: 1px solid #808080;box-sizing: border-box;">
            <h1 style="position: relative;width: 100%;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 15px; margin: 0;text-align:center;  ">TOTAL A CANCELAR: </h1>
            <h1 style="position: relative;width: 100%;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 15px; margin: 0;text-align:center">S/. {{number_format($total,2)}}</h1>
        </div>
    </div>

</div>




</form>


@else
<div>No items in cart</div>
@endif


<script src="https://code.jquery.com/jquery-3.2.1.js"></script>



<script type="text/javascript">
	function abrir(){
		document.getElementById('todo').style.display="block";
		document.getElementById('cerrar').style.display="block";
		document.getElementById('textover').style.display="none";
		document.getElementById('circlever').style.display="none";
	}
	function closes(){
		document.getElementById('todo').style.display="none";
		document.getElementById('cerrar').style.display="none";
		document.getElementById('textover').style.display="block";
		document.getElementById('circlever').style.display="block";
	}

    function targetinfo(){
        document.getElementById('datar').style.display="none";
        document.getElementById('dir').style.display="none";
        document.getElementById('dirr').style.display="block";
        document.getElementById('posstarget').style.display="block";
        document.getElementById('clicka').style.border="2px solid #ba1f1f";
        document.getElementById('clicka').style.boxShadow="1px 1px 4px #ba1f1f";
        document.getElementById('clicka').style.cursor ="pointer";
        document.getElementById('dirr').style.fontWeight="600";
        document.getElementById('imgtar').style.display="block";
        document.getElementById('imgsen').style.display="none";
        $('#clicka').addClass("coverr");
    }
    function modify(){
        document.getElementById('datar').style.display="block";
        document.getElementById('dir').style.display="block";
        document.getElementById('dirr').style.display="none";
        document.getElementById('posstarget').style.display="none";
        document.getElementById('clicka').style.border="1px solid #cacaca";
        document.getElementById('clicka').style.boxShadow="1px 1px 4px #cacaca";
        document.getElementById('clicka').style.cursor ="auto";
        document.getElementById('dirr').style.fontWeight="600";
        document.getElementById('imgtar').style.display="none";
        document.getElementById('imgsen').style.display="block";
        $('#clicka').removeClass("coverr");
    }
</script>


