@extends ('blackboard')
@section ('contenido')
<link rel="stylesheet" href="{{asset('css/sty.css')}} ">
<style type="text/css">
    .creation h4{
        width: 100%;
        font-family: 'Kanit';
        font-size: 15px;
        text-align: right;
        font-weight: bold;
        color:#fff;
    }
    .subcreation h4{
        width: 100%;
        font-family: 'Kanit';
        font-size: 15px;
        text-align: left;
        color:#fff;
    }
</style>
<div style="width: 822px;position: relative;display: block;margin: auto;height: 200px;background: #f2f2f2;border-radius: 10px;">
	<div style="width: 220px;height: 100%;display: block;float: left;">
        <div style="width:105px;height: 105px;border-radius: 100px;  background: #35afe1;position: relative;margin: auto;margin-top: 25px;">
            <h2 style="text-align: center;line-height: 105px; color: white;font-family: 'Kanit'; font-weight: 100;font-size: 60px;text-transform:uppercase">{!! substr(($personas->name),0,1) !!}{!! substr(($personas->lastname),0,1) !!}</h2>
        </div>
        <div style="width: 65px; border-radius: 7px;height: 17px;background: #35afe1;position: absolute;left: 30px;bottom: 35px;text-align: center;color:#fff;line-height: 16px;font-size: 10px;">Edit photo</div>
        <div style="width: 65px; border-radius: 7px;height: 17px;background: #9fda22;position: absolute;left: 120px;bottom: 35px;text-align: center;color:#fff;line-height: 16px;font-size: 10px;">Notify</div>
    </div>
    <div style="width: 500px;position: relative;float: left;display: block;padding-left: 30px;padding-top: 20px;">
    	<h1 style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px">{{$personas->name}} {{$personas->lastname}} </h1>
    	<h1 style="font-family:'Dosis';font-size: 20px;font-weight: 100;color: #1ca77f;text-transform: uppercase;font-size: 10px; ">{{$personas->distrito}} - {{$personas->provincia}} - {{$personas->ciudad}} </h1>
    	<h1 style="font-family:'Dosis';font-size: 20px;font-weight: 100;color: #000;font-size: 20px;margin-top: 20px;margin-bottom: 0px; ">
    		@if ($clientes == NULL)
    		 0 años</h1>
    		 @else
    		{{\Carbon\Carbon::parse($clientes->cumpleanos)->age ?? '0'}} años</h1>
    		@endif
    		@if ($clientes == NULL)
    		<h1 style="font-family:'Kanit';font-size: 20px;font-weight: 100;color: #1ca77f;font-size: 12px; "> sin date</h1>
    		 @else
    		
    		
    	<h1 style="font-family:'Kanit';font-size: 20px;font-weight: 100;color: #1ca77f;font-size: 12px; ">{{$clientes->fecha}} de 
            @if($clientes->month ==1)
            Enero
            @endif
            @if($clientes->month ==2)
            Febrero
            @endif
            @if($clientes->month ==3)
            Marzo
            @endif
            @if($clientes->month ==4)
            Abril
            @endif
            @if($clientes->month ==5)
            Mayo
            @endif
            @if($clientes->month ==6)
            Junio
            @endif
            @if($clientes->month ==7)
            Julio
            @endif
            @if($clientes->month ==8)
            Agosto
            @endif
            @if($clientes->month ==9)
            Setiembre
            @endif
            @if($clientes->month ==10)
            Octubre
            @endif
            @if($clientes->month ==11)
            Noviembre
            @endif
            @if($clientes->month ==12)
            Diciembre
            @endif de {{$clientes->year}}</h1>
            @endif
    </div>
    <div style="width: 500px;position: relative;float: left;display: inline-block;padding-left: 30px;">
        <div style="width: 100px;position: relative;float: left;display: inline-block;">
            <div style="width: 90px;position: relative;margin: auto;display: block;text-align: center;font-size: 9px;color:#000;margin-top: 10px;">Cantidad productos</div>
            
            <div style="width: 90px;position: relative;margin: auto;display: block;text-align: center;font-size: 20px;color:#1ca77f;margin-top: 2px;">
            @if ($clientes == NULL)
            0
            @else
            {{$clientes->conteog}}
            @endif</div>
        </div>
        <div style="width: 100px;position: relative;float: left;display: inline-block;">
            <div style="width: 90px;position: relative;margin: auto;display: block;text-align: center;font-size: 9px;color:#000;margin-top: 10px;">Compras realizadas</div>
            <div style="width: 90px;position: relative;margin: auto;display: block;text-align: center;font-size: 20px;color:#1ca77f;margin-top: 2px;">
                @if ($clientes == NULL)
                0
                @else
                {{$conteo->conteot}}
                @endif
                </div>
            
        </div>
        <div style="width: 100px;position: relative;float: left;display: inline-block;">
            <div style="width: 90px;position: relative;margin: auto;display: block;text-align: center;font-size: 9px;color:#000;margin-top: 10px;">Tiempo Antique - M</div>
            <div style="width: 90px;position: relative;margin: auto;display: block;text-align: center;font-size: 20px;color:#1ca77f;margin-top: 2px;">{{(\Carbon\Carbon::parse($personas->created_at)->age)*12+$personas->month }}
            </div>
        </div>


    </div>
    <div style="position: absolute;top:0px;right: 0px;padding-right: 10px; ">
        @if($personas->type == 0)
        <h1 style="font-size: 40px;font-family: 'Dosis-extra';font-weight: 100;color:#1ca77f">CLIENTE</h1>
        
        @endif
        @if($personas->type == 1)
        <h1 style="font-size: 40px;font-family: 'Dosis-extra';font-weight: 100;color:#1ca77f">ADMIN</h1>
        @endif
    </div>

</div>
<div style="width: 822px;position: relative;display: block;margin: auto;height: 150px;background: #f2f2f2;border-radius: 10px;margin-top: 20px;padding-top: 50px;padding-left: 30px;">
    <h1 style="width: 600px;font-size: 22px;position: relative;float: left;line-height: 30px;font-family:'Dosis-extra' "> {{$personas->direccion}} </h1>
    <h1 style="font-family:'Dosis';font-size: 20px;font-weight: 100;color: #1ca77f;text-transform: uppercase;font-size: 10px;width: 100%;float: left;display:block; ">{{$personas->distrito}} - {{$personas->provincia}} - {{$personas->ciudad}} </h1>
    <div style="position: absolute;top:0px;right: 0px;padding-right: 10px; ">
        
        <h1 style="font-size: 40px;font-family: 'Dosis-extra';font-weight: 100;color:#1ca77f">ADDRESS</h1>
    </div>
    <div style="position: absolute;bottom:0px;right: 0px;padding-right: 10px; ">
        
        <h1 style="font-size: 20px;font-family: 'Dosis-extra';font-weight: 100;color:#1ca77f">Opcion preferencial: ENVIO TERCIARIZADO</h1>
    </div>
</div>
<div style="width: 822px;position: relative;display: block;margin: auto;height: 150px;border-radius: 10px;margin-top: 20px;">
    <div style="position: relative;display: block;float: left;width: 250px;height: 120px;padding:10px;background: #f2f2f2;border-radius: 10px;">
        
    </div>
    <div style="position: relative;display: block;float: left;width: 260px;height: 120px;padding:10px;background: #979797;margin-left: 25px;border-radius: 10px;">
        <h1 style="position: relative;display: block;width: 100%;font-family: 'Dosis-extra';font-size: 15px; color: #fff;">TOTAL COMPRAS REALIZADAS</h1>
        <h1 style="position: relative;display: block;width: 100%; text-align: center;font-family: 'Dosis-extra'; color:#fff">
            @if ($clientes == NULL)
            S/. 0.00
            @else
            S/. {{number_format($clientes->total,2) }} 
            @endif
            </h1>
    </div>
    <div style="position: relative;display: block;float: left;width: 260px;height: 120px;padding:10px;background: #3fbc99;margin-left: 25px;border-radius: 10px;">
        <h1 style="position: relative;display: block;width: 100%;font-family: 'Dosis-extra';font-size: 15px; color: #fff;">GANANCIAS PRODUCIDAS</h1>
        <h1 style="position: relative;display: block;width: 100%; text-align: center;font-family: 'Dosis-extra'; color:#fff">
             @if ($clientes == NULL)
             S/. 00.00
             @else
             S/. {{$clientes->ganancia}} 
             @endif
             </h1>
    </div>
</div>
<div style="width: 822px;position: relative;display: block;margin: auto;height: 150px;border-radius: 10px;margin-top: 0px;background: none">
    <div style="position: relative;float: left;width: 100px;display: block;">
        <a href="{{url('personas')}} "><img src="{{asset('image/svg/hogar.svg')}} " style="width: 30px;position: relative;display: block;margin: auto;cursor: pointer;"></a>
        <h1 style="font-size: 12px;color:#808080;width: 100%;font-family: 'Kanit';text-align: center;margin-top: 10px; ">Home</h1>
    </div>
    <div style="position: relative;float: left;width: 100px;display: block;">
        <a href="/personas/{{$personas->id}}/edit "><img src="{{asset('image/svg/usuarioedit.svg')}} " style="width: 35px;position: relative;display: block;margin: auto;cursor: pointer;"></a>
        <h1 style="font-size: 12px;color:#808080;width: 100%;font-family: 'Kanit';text-align: center;margin-top: 5px; ">Editar usuario</h1>
    </div>
    <div style="position: relative;float: left;width: 100px;display: block;">
        <a href="{{url('')}} "><img src="{{asset('image/svg/verificado.svg')}} " style="width: 35px;position: relative;display: block;margin: auto;cursor: pointer;"></a>
        <h1 style="font-size: 12px;color:#808080;width: 100%;font-family: 'Kanit';text-align: center;margin-top: 5px; ">Verificar usuario</h1>
    </div>
    <div style="position: relative;float: left;width: 100px;display: block;">
        <img src="{{asset('image/svg/personal-information.svg')}} " onclick="usercont()" style="width: 35px;position: relative;display: block;margin: auto;cursor: pointer;">
        <h1 style="font-size: 12px;color:#808080;width: 100%;font-family: 'Kanit';text-align: center;margin-top: 5px; ">Mostrar usuario</h1>
    </div>
    <div style="position: relative;float: right;width: 100px;display: block;">
        <a href="{{url('')}} "><img src="{{asset('image/svg/remove-user.svg')}} " style="width: 35px;position: relative;display: block;margin: auto;cursor: pointer;"></a>
        <h1 style="font-size: 12px;color:#ce2929;width: 100%;font-family: 'Kanit';text-align: center;margin-top: 5px; ">Banear</h1>
    </div>

    <div style="position: absolute;width: 822px;background: #fff;top:-550px;left:0px;padding-bottom: 20px;background: #000;border-radius: 20px;z-index: -99;opacity: 0;transition: .5s" id="usershow">
        <div style="position: relative;width: 60%;margin: auto;display: block;">
        <div style="position: relative;float: left;display: block;width: 200px;padding-top: 50px;padding-right: 0px;" class="creation">
            <h4>Fecha de Micuenta:</h4>
            <h4>Celular:</h4>
            <h4>DNI:</h4>
            <h4>Correo electronico:</h4>
            <h4>Nombre:</h4>
            <h4>Apellido:</h4>
            <h4>Edad:</h4>
            <h4>Fecha de Nacimiento:</h4>
            <h4 style="line-height: 36px;">Direccion de entrega:</h4>
            <h4>Distrito:</h4>
            <h4>Provincia:</h4>
            <h4>Ciudad:</h4>
            <h4>Opcion de envio:</h4>

        </div>
        <div style="position: relative;float: left;display: block;width: 250px;padding-top: 50px;padding-left: 10px;" class="subcreation">
            <h4>{{$personas->created_at }}</h4>
            <h4>{{$personas->cell ?? 'none'}}</h4>
            <h4>{{$personas->dni ?? 'dni no ingresado'}}</h4>
            <h4>{{$personas->email ?? 'Email no ingresado'}}</h4>
            <h4>{{$personas->name}}</h4>
            <h4>{{$personas->lastname}}</h4>
            <h4>
             @if ($clientes == NULL)
             0
             @else
                {{\Carbon\Carbon::parse($clientes->cumpleanos)->age}}
                @endif</h4>
            <h4>{{$clientes->cumpleanos ?? 'none' }} </h4>
            <h4>{{$personas->direccion}}</h4>
            <h4>{{$personas->distrito}}</h4>
            <h4>{{$personas->provincia}}</h4>
            <h4>{{$personas->ciudad}}</h4>
            <h4>Contraentrega</h4>

        </div>
        </div>
        <div ><img src="{{asset('image/svg/cerrar.svg')}} " onclick="closing()" style="width: 20px;position: absolute;top:20px;right: 20px;cursor: pointer;" ></div>
    </div>
</div>
<script type="text/javascript">
    function usercont(){
        
        document.getElementById("usershow").style.opacity= "1";
        document.getElementById("usershow").style.zIndex= "9999";
    }
    function closing(){
        
        document.getElementById("usershow").style.zIndex= "-99";
        document.getElementById("usershow").style.opacity= "0";
    }
</script>

@endsection