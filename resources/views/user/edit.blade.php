@extends ('blackboard')
@section ('contenido')
@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
@endif
<style type="text/css">
	.person:focus{
		outline: 0;

	}
	button{
		background: none;
		border:none;
	}
</style>

			{!!Form::model($personas,['method'=>'PATCH','route'=>['personas.update',$personas->id]])!!}
			{{Form::token()}}
<div style="width: 822px;position: relative;display: block;margin: auto;height: 200px;background: #f2f2f2;border-radius: 10px;">
	<div style="width: 220px;height: 100%;display: block;float: left;">
        <div style="width:105px;height: 105px;border-radius: 100px;  background: #35afe1;position: relative;margin: auto;margin-top: 25px;">
            <h2 style="text-align: center;line-height: 105px; color: white;font-family: 'Kanit'; font-weight: 100;font-size: 60px;">{!! substr(($personas->name),0,1) !!}{!! substr(($personas->lastname),0,1) !!}</h2>
        </div>
        <div style="width: 65px; border-radius: 7px;height: 17px;background: #35afe1;position: absolute;left: 30px;bottom: 35px;text-align: center;color:#fff;line-height: 16px;font-size: 10px;">Edit photo</div>
        <div style="width: 65px; border-radius: 7px;height: 17px;background: #9fda22;position: absolute;left: 120px;bottom: 35px;text-align: center;color:#fff;line-height: 16px;font-size: 10px;">Notify</div>
    </div>
    <div style="width: 500px;position: relative;float: left;display: block;padding-left: 30px;padding-top: 20px;">
    	<input type="text" style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px;border:none; border-left: 2px solid #35afe1;width: 120px;background: none;" name="name" value="{{$personas->name}}" class="person" autocomplete="off">
    	<input type="text" style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px;border:none; border-left: 2px solid #35afe1;width: 120px;background: none;" name="lastname" value="{{$personas->lastname}}" class="person" autocomplete="off">
    	
    </div>
    <div style="width: 500px;position: relative;float: left;display: block;padding-left: 30px;">
    	<input type="text" name="distrito" style="font-family:'Dosis';font-size: 20px;font-weight: 100;color: #1ca77f;text-transform: uppercase;font-size: 10px;border:none; border-left: 2px solid #35afe1;width: 30px;background: none;" class="person" value="{{$personas->distrito}}" autocomplete="off">-
    	<input type="text" name="provincia" style="font-family:'Dosis';font-size: 20px;font-weight: 100;color: #1ca77f;text-transform: uppercase;font-size: 10px;border:none; border-left: 0px solid #35afe1;width: 30px;background: none;" class="person" value="{{$personas->provincia}}" autocomplete="off">-
    	<input type="text" name="ciudad" style="font-family:'Dosis';font-size: 20px;font-weight: 100;color: #1ca77f;text-transform: uppercase;font-size: 10px;border:none; border-left: 0px solid #35afe1;width: 30px;background: none;" class="person" value="{{$personas->ciudad}}" autocomplete="off">
    </div>
    <div style="width: 500px;position: relative;float: left;display: block;padding-left: 30px;padding-top: 20px;">
    	<input type="date" style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px;border:none; border-left: 2px solid #35afe1;width: 180px;background: none;" name="cumpleanos" value="{{$personas->cumpleanos}}" class="person" autocomplete="off" placeholder="Cumpleaños">
    	
    	
    </div>
    <div style="width: 250px;position: relative;float: left;display: block;padding-left: 30px;padding-top: 20px;">
    	<input type="text" style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px;border:none; border-left: 2px solid #35afe1;width: 180px;background: none;width: 240px;" name="email" value="{{$personas->email}}" class="person" autocomplete="off"  placeholder="Email">
    	
    	
    </div>
    <div style="width: 350px;position: relative;float: left;display: block;padding-left: 30px;padding-top: 20px;">
    	<input type="text" style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px;border:none; border-left: 2px solid #35afe1;width: 180px;background: none;width: 100px;" name="dni" value="{{$personas->dni}}" class="person" autocomplete="off" placeholder="DNI">
    	
    	
    </div>

</div>
<div style="width: 822px;position: relative;display: block;margin: auto;height: 150px;background: #f2f2f2;border-radius: 10px;margin-top: 20px;padding-top: 50px;padding-left: 30px;">
	<input type="text" name="direccion" style="width: 600px;font-size: 22px;position: relative;float: left;line-height: 30px;font-family:'Kanit';border:none;border-left: 2px solid #35afe1;background: none;" value="{{$personas->direccion}}" class="person" autocomplete="off" placeholder="Direccion">
	<input type="text" name="cell" style="font-family:'Dosis';font-weight: 100;color: #1ca77f;text-transform: uppercase;font-size: 30px;border:none; border-left: 2px solid #35afe1;width: 150px;background: none;" class="person" value="{{$personas->cell}}" autocomplete="off" placeholder="Celular">
    <div style="position: absolute;top:0px;right: 0px;padding-right: 10px; ">
        
        <h1 style="font-size: 40px;font-family: 'Kanit';font-weight: 100;color:#1ca77f">ADDRESS</h1>
    </div>
    
</div>
<div style="width: 822px;position: relative;display: block;margin: auto;height: 150px;border-radius: 10px;margin-top: 40px;background: none">
    <div style="position: relative;float: left;width: 100px;display: block;">
        <a href="{{url('personas')}} "><img src="{{asset('image/svg/hogar.svg')}} " style="width: 30px;position: relative;display: block;margin: auto;cursor: pointer;"></a>
        <h1 style="font-size: 12px;color:#808080;width: 100%;font-family: 'Kanit';text-align: center;margin-top: 10px; ">Home</h1>
    </div>
    <div style="position: relative;float: left;width: 100px;display: block;">
        <a href="/personas/{{$personas->id}}/edit "><img src="{{asset('image/svg/usuarioedit.svg')}} " style="width: 35px;position: relative;display: block;margin: auto;cursor: pointer;"></a>
        <h1 style="font-size: 12px;color:#1ca77f;font-weight: bold; width: 100%;font-family: 'Kanit';text-align: center;margin-top: 5px; ">Editar usuario</h1>
    </div>
    <div style="position: relative;float: left;width: 100px;display: block;">
        <a href="{{url('')}} "><img src="{{asset('image/svg/verificado.svg')}} " style="width: 35px;position: relative;display: block;margin: auto;cursor: pointer;"></a>
        <h1 style="font-size: 12px;color:#808080;width: 100%;font-family: 'Kanit';text-align: center;margin-top: 5px; ">Verificar usuario</h1>
    </div>
    <div style="position: relative;float: left;width: 100px;display: block;">
        <a href="{{URL::action('UserController@show',$personas->id)}}"><img src="{{asset('image/svg/personal-information.svg')}} " style="width: 35px;position: relative;display: block;margin: auto;cursor: pointer;"></a>
        <h1 style="font-size: 12px;color:#808080;width: 100%;font-family: 'Kanit';text-align: center;margin-top: 5px; ">Mostrar usuario</h1>
    </div>
    <div style="position: relative;float: right;width: 100px;display: block;position: relative;">
        <button class="" type="submit" style="position: relative;display: block;margin: auto"><img src="{{asset('image/svg/disco-flexible.svg')}} " style="width: 35px;position: relative;display: block;margin: auto;cursor: pointer;"></button>
        <h1 style="font-size: 12px;color:#1bb568;width: 100%;font-family: 'Kanit';text-align: center;margin-top: 5px; ">Guardar</h1>
    </div>
    

    
</div>

	
{!!Form::close()!!}
			
		
@endsection