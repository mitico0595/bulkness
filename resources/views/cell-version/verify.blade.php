
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Oberlu Admin</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty-mobile.css')}} ">        
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <link rel="stylesheet" href="{{asset('css/articulo.css')}} ">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <style type="text/css">
        	img {
        		max-width: 200px;
        		max-height: 200px;
        	}
        </style>
         
    </head>
 
<body style=""> 

<div style="position: fixed;background: #fff;height: 60px;width: 100%;z-index: 999;top:0px">
        
        <div id="soli" style="line-height: 60px;position: absolute;left: 60px;font-size: 18px;" >Edicion Usuario</div>
        
</div>
{!!Form::model($personas,['method'=>'POST','route'=>['usuario-mobile.updateMobile',$personas->id]])!!}
			{{Form::token()}}	
<div style="position: relative;float: left;margin-top: 70px;display: inline-block;width: 100%;transform-style: preserve-3d;">
	@if($personas->verify == "1" )
	<div style="position: relative;float: left;width: 90%;margin-left: 5%;background: #278904;box-shadow: 10px 16px 40px -5px rgb(0 0 0 / 75%)">
	@endif
	@if($personas->verify == "0" || $personas->verify == "")
	<div style="position: relative;float: left;width: 90%;margin-left: 5%;background: #c40f0f;box-shadow: 10px 16px 40px -5px rgb(0 0 0 / 75%)">
	@endif	
		<div style="width:60px;height: 60px;border-radius: 50px; color:#282828;  background: white;position: relative;margin: auto;margin-top: 20px;">	 	
			<h2 style="text-align: center;line-height: 60px;font-family: 'Kanit'; font-weight: bold;font-size: 30px;text-transform: uppercase;">{!! substr(($personas->name),0,1) !!}{!! substr(($personas->lastname),0,1) !!}</h2>
        </div>
        @if($personas->verify == "0" || $personas->verify == "")
        <div style="width: 100%;position: relative;float: left;display: block;">
        	<h5 style="font-size: 20px;font-family: 'Kanit'; border:1px solid white;border-radius: 5px; line-height: 22px;padding: 5px;color:white; width: 180px;position: relative;display: block;margin:auto;text-align: center;margin-top: 10px;margin-bottom: 15px;" onclick="verify()">Verificar usuario</h5>
        </div>
        @endif
        @if($personas->verify == "1")
        <div style="width: 100%;position: relative;float: left;display: block;">
        	<h5 style="font-size: 20px;font-family: 'Kanit'; border:1px solid white;border-radius: 5px; line-height: 22px;padding: 5px;color:white; width: 180px;position: relative;display: block;margin:auto;text-align: center;margin-top: 10px;margin-bottom: 15px;" onclick="ban()">Banear usuario</h5>
        </div>
        @endif
	</div>
	

	<div style="position: relative;float: left;display: inline-block;width: 90%;margin-top: 25px;background: white; box-shadow: 10px 16px 40px -5px rgb(0 0 0 / 75%);margin-left: 5%;padding-bottom: 20px;">
        	
      			<div style="width: 100%;position: relative;float: left;display: block;padding-left: 30px;padding-top: 20px;">
      				<div style="font-size: 25px;margin-bottom: 20px;font-weight: 500;">Informacion personal</div>
    				<input type="text" style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px;border:none; border-left: 2px solid #35afe1;width: 120px;background: none;" name="name" value="{{$personas->name}}" class="person" autocomplete="off">
    				<input type="text" style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px;border:none; border-left: 2px solid #35afe1;width: 120px;background: none;" name="lastname" value="{{$personas->lastname}}" class="person" autocomplete="off">    	
    			</div>      			
    		
    		<div style="width: 100%;position: relative;float: left;display: block;padding-left: 30px;">
    			<input type="text" name="distrito" style="font-family:'Dosis';font-size: 20px;font-weight: 100;color: #1ca77f;text-transform: uppercase;font-size: 10px;border:none; border-left: 2px solid #35afe1;width: 30px;background: none;" class="person" value="{{$personas->distrito}}" autocomplete="off">-
    			<input type="text" name="provincia" style="font-family:'Dosis';font-size: 20px;font-weight: 100;color: #1ca77f;text-transform: uppercase;font-size: 10px;border:none; border-left: 0px solid #35afe1;width: 30px;background: none;" class="person" value="{{$personas->provincia}}" autocomplete="off">-
    			<input type="text" name="ciudad" style="font-family:'Dosis';font-size: 20px;font-weight: 100;color: #1ca77f;text-transform: uppercase;font-size: 10px;border:none; border-left: 0px solid #35afe1;width: 30px;background: none;" class="person" value="{{$personas->ciudad}}" autocomplete="off">
    		</div>
    		<div style="width: 100%;position: relative;float: left;display: block;padding-left: 30px;padding-top: 20px;">
    	<input type="date" style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px;border:none; border-left: 2px solid #35afe1;width: 180px;background: none;" name="cumpleanos" value="{{$personas->cumpleanos}}" class="person" autocomplete="off" placeholder="Cumpleaños">
    	
    	
    </div>
    <div style="width: 250px;position: relative;float: left;display: block;padding-left: 30px;padding-top: 20px;">
    	<input type="text" style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px;border:none; border-left: 2px solid #35afe1;width: 180px;background: none;width: 240px;" name="email" value="{{$personas->email}}" class="person" autocomplete="off"  placeholder="Email">
    	
    	
    </div>
    <div style="width: 350px;position: relative;float: left;display: block;padding-left: 30px;padding-top: 20px;">
    	<input type="text" style="font-family:'Dosis';font-size: 20px;font-weight: 100; margin:0px;border:none; border-left: 2px solid #35afe1;width: 180px;background: none;width: 100px;" name="dni" value="{{$personas->dni}}" class="person" autocomplete="off" placeholder="DNI">
    </div>
    <div style="position: relative;float: left;width: 90%;margin-left: 5%;margin-top: 20px;">
    	<div style="font-size: 25px;margin-bottom: 20px;font-weight: 500;">Informacion target</div>
    <input type="text" name="direccion" style="width: 100%;font-size: 15px;position: relative;float: left;line-height: 30px;font-family:'Kanit';border:none;border-left: 2px solid #35afe1;background: none;" value="{{$personas->direccion}}" class="person" autocomplete="off" placeholder="Direccion">
	<input type="text" name="cell" style="font-family:'Dosis';font-weight: 100;color: #1ca77f;text-transform: uppercase;font-size: 20px;border:none; border-left: 2px solid #35afe1;width: 150px;background: none;margin-top: 20px;" class="person" value="{{$personas->cell}}" autocomplete="off" placeholder="Celular">
	</div>
	<div style="position: absolute;bottom:15px;right: 15px; margin: auto;display: block;padding-top: 25px;">
        <button class="" type="submit" style="position: relative;display: block;margin: auto;background: none;border:none"><img src="{{asset('image/svg/disco-flexible.svg')}} " style="width: 35px;position: relative;display: block;margin: auto;cursor: pointer;"></button>
        
    </div>	
    </div>


</div>
@if($personas->verify =="0" || $personas->verify == "" )
<div style="position: absolute;width: 100%;bottom:0px;height:60px; background: #c40f0f;transition: .5s;" id="veri">
		<input type="checkbox" name="verify" value="" style="height: 30px;width: 30px;position: absolute;right: 50px;top:15px;border: none;"id="vv" onchange="comprobar(this)"
		> 
        <select name="type" class="" style="border:none;margin-top:10px; border-radius:0px;padding:5px; background: none; border-bottom: 2px solid #282828;position: absolute;left: 180px;">
                    <option value="{{$personas->type}} " style="">Dar permisos</option>
                    <option value="1">Master</option>
                    <option value="0">User</option>
                    <option value="2">Proveedor</option>
                    
    </select>
		<div style="position: absolute;font-family:'Kanit';top:17px;left:30px;color:white; ">Verificación de usuario</div>
</div>
@else 
<div style="position: absolute;width: 100%;bottom:0px;height:60px; background: #278904;transition: .5s;" id="ban">
	<input type="checkbox" name="verify" value="1" style="height: 30px;width: 30px;position: absolute;right: 50px;top:15px;border: none;" checked="true" id="bann" onchange="compro(this)">
	<div style="position: absolute;font-family:'Kanit';top:17px;left:30px;color:white; ">Baneo de usuario</div>
    <select name="type" class="" style="border:none;margin-top:10px; border-radius:0px;padding:5px; background: none; border-bottom: 2px solid #282828;position: absolute;left: 180px;">
                    <option value="{{$personas->type}} " style="">Dar permisos</option>
                    <option value="1">Master</option>
                    <option value="0">User</option>
                    <option value="2">Proveedor</option>
                    
    </select>
</div>
@endif 	
	
<div style="position: fixed;bottom:0px;height: 60px;background: black;width: 100%;">
	<div style="position: relative;box-sizing: border-box;float: left;width: 50%;display: inline-block;background: #979797;color: black;height: 60px;">
		<h5 style="position: absolute;top:5px;left: 5px;font-family: 'Kanit'; color:#fff;font-size: 15px;">Total compras</h5>
			<h5 style="width: 100%;text-align: center;margin-top: 20px;color:white">S/. {{number_format($personas->total,2)  }} </h5>
	</div>
	@if($personas->verify =="0" || $personas->verify == "" )
	<div style="position: relative;box-sizing: border-box;float: left;width: 50%;display: inline-block;background: #c40f0f;height: 60px;">
	@else
	<div style="position: relative;box-sizing: border-box;float: left;width: 50%;display: inline-block;background: #278904;height: 60px;">
	@endif
		
		<h5 style="position: absolute;top:5px;left: 5px;font-family: 'Kanit'; color:#fff;font-size: 15px;">Ganancias</h5>
		<h5 style="width: 100%;text-align: center;margin-top: 20px;color:white">S/. {{$personas->ganancia}} </h5>
	</div>
</div>

{!!Form::close()!!}

<script type="text/javascript">
	function comprobar(obj)
{   
    if (obj.checked){
      
			document.getElementById('vv').value ="1";
    }
    else{
     document.getElementById('vv').value ="0";
    }   
}
    function compro(obj)
{   
    if (obj.checked){      
			document.getElementById('bann').value ="1";
    }
    else{
     document.getElementById('bann').value ="0";
    }   
} 
	function verify(){
		document.getElementById('veri').style.bottom = "60px";
	}
	function ban(){
		document.getElementById('ban').style.bottom = "60px";
	}
</script>
<script type="text/javascript">
    function detail_inv(){
        document.getElementById("menu-cont").style.left = "-500px";
        document.getElementById("menu-sub1").style.right = "0px";
    }
    function back1(){
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub1").style.right = "-500px";
    }
    function detail_ven(){
        document.getElementById("menu-cont").style.left = "-500px";
        document.getElementById("menu-sub2").style.right = "0px";
    }
    function back2(){
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub2").style.right = "-500px";
    }
    function leftclose(){
        document.getElementById("menum").style.marginLeft = "-500px";
        document.getElementById("menu-sub1").style.right = "-1000px";
        document.getElementById("menu-sub2").style.right = "-1000px";
    }
    function force(){              
        document.getElementById("menum").style.marginLeft = "0px";  
        document.getElementById("menu-cont").style.left = "0px";
        document.getElementById("menu-sub2").style.right = "-500px";
        document.getElementById("menu-sub1").style.right = "-500px";         
            
    }
</script>
</body>    
</html>

