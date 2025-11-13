<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@include ('title')</title>

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty.css')}} ">
        
        	
    </head>
 <body style="background-color: #eaeaea">
		
		<div class="" style="position: relative;width: 100%; background: #000;padding: 10px;height: 40px;box-sizing: border-box;">
			<a href="javascript: history.go(-1)" style="float:left;">
                  <img src="{{asset('image/svg/arrow.svg')}} " class="logo1" style="width: 20px;"></a>
			<h3 style="position: relative;font-size: 15px;margin:0px;margin-left: 50px;color:#fff;font-family:'Kanit';float: left; ">DEJAR VALORACION</h3>
			@if (count($errors)>0)
			<div class="">
				<ul>
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	

			{!!Form::model($detalles,['method'=>'PATCH','route'=>['detail-mobile.update',$detalles->id_dventa]])!!}
			{{Form::token()}}
		<div class="" style="position: relative;padding: 5px;width:100%;position: relative;margin:auto;background: #fff;padding: 20px; box-sizing: border-box;">
			<div style="position: relative;">
				<div style="width: 100%;position: relative;margin: auto;display: block;"><img src="{{asset('images/'.$detalles->image)}} " style="width: 50%;position: relative;display: block;margin: auto;"></div>
				<div style="position: relative;width:100%;margin: 0px;">
				<h1 style=" position: relative; font-family: 'Kanit';line-height: 17px;font-size: 17px; padding: 5px;margin: 0;font-weight:100 ">{{$detalles->articulo}}</h1>
				</div>
				<div style="width: 80%;position: relative;display: block;margin:auto;height: 50px;">
					<div style="position: relative;margin: auto;display: block;width: 100%;">
					<div style="position: relative;display: inline-block;padding: 10px;font-size: 15px;font-family:'Kanit';float: left;text-align: center;border-radius: 10px;background: #282828;color:#fff; ">x{{$detalles->cantidad}}</div>
					<div style="position: relative;display: inline-block;padding: 10px;font-size: 15px;font-family:'Kanit';float: left;text-align: center;border-radius: 10px;background: #b10000;color:#fff; margin-left: 5px; ">S/. {{$detalles->precio_venta}}</div>
					</div>
				</div>
			</div>
			
			
				<div class="" style="width: 100%;">
					<label for="valoracion" style="width: 100%;display: block;font-family: 'Kanit';">Valore el producto:</label>
					
					<input type="number" name ="valoracion" required   class="form-control" style="display: none" id="valoracion">
					

					<div style="position: relative;height: 50px;">
    				<div style="width: 200px;margin-top: 10px;">
    			@if( $detalles->valoracion == NULL  )
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 0px;" id="st" onclick="star1()">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 35px;" id="stt" onclick="star2()">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 70px;" id="sttt" onclick="star3()">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 105px;" id="stttt" onclick="star4()">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 140px;" id="sttttt" onclick="start()">
    				

    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 0px;display: none" id="k" onclick="yk()" >
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 35px;display: none" id="yy" onclick="ys()" >
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 70px;display: none" id="yyy" onclick="yss()" >
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 105px;display: none" id="yyyy" onclick="ysss()" >
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 140px;display: none" id="yyyyy" onclick="yssss()" >
    			@else
    				@if ($detalles->valoracion == 1)
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 0px;" >
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 35px;">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 70px;">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 105px;">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 140px;">
    				@endif
    				@if ($detalles->valoracion == 2)
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 0px;" >
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 35px;">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 70px;">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 105px;">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 140px;">
    				@endif
    				@if ($detalles->valoracion == 3)
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 0px;" >
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 35px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 70px;">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 105px;">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 140px;">
    				@endif
    				@if ($detalles->valoracion == 4)
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 0px;" >
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 35px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 70px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 105px;">
    				<img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 30px;top:0px;left: 140px;">
    				@endif
    				@if ($detalles->valoracion == 5)
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 0px;" >
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 35px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 70px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 105px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 30px;top:0px;left: 140px;">
    				@endif

    			@endif
    				
    				</div>
    				</div>

				</div>
			

			<div class="" style="width: 100%;">
					<label for="valoracion" style="width: 100%;display: block;font-family: 'Kanit';">Opine acerca del producto:</label>
					@if($detalles->opinion == NULL )
					<textarea rows="5" cols="50" name ="opinion"  style="width: 100%;margin-top: 5px;display: block;padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5;color: #495057;background-color: #fff;background-clip: padding-box;  border: 1px solid #ced4da; border-radius: 0.25rem; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;box-sizing: border-box;">{{$detalles->opinion}}</textarea>
					@else
					<h1 style="    position: relative;font-family: 'Kanit';font-size: 13px;line-height: 15px; color: #808080;font-weight: 100">{{$detalles->opinion}} </h1>
					@endif

					
			</div>
			


			
				<div class="f" style="    margin-top: 10px;position: relative;display: block; margin: auto;width: 200px;margin-top: 10px;">
					@if($detalles->valoracion == NULL )
					<button class="" type="submit" style="position: relative;padding: 8px 10px; box-decoration-break: none;border: none;  background: #b10000;color: #fff;border-radius: 5px; width: 100%;">Guardar</button>
					@else
					<h3 class="" type="submit" style="position: relative;padding: 2px 10px; box-decoration-break: none;border: none;  background: #808080;color: #fff;border-radius: 5px; width: 100%;font-weight: 100;font-family:'Kanit';text-align: center ">Valorado</h3>
					@endif
				</div>
			
		</div>

			{!!Form::close()!!}
			<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            
			<script type="text/javascript">
			function start(){
                document.getElementById("k").style.display= "block";
                document.getElementById("yy").style.display= "block";
                document.getElementById("yyy").style.display= "block";
                document.getElementById("yyyy").style.display= "block";
                document.getElementById("yyyyy").style.display= "block";
                document.getElementById("st").style.display= "none";
                document.getElementById("stt").style.display= "none";
                document.getElementById("sttt").style.display= "none";
                document.getElementById("stttt").style.display= "none";
                document.getElementById("sttttt").style.display= "none";
                $("#valoracion").val('5');
            }
            function yssss(){
                document.getElementById("k").style.display= "block";
                document.getElementById("yy").style.display= "block";
                document.getElementById("yyy").style.display= "block";
                document.getElementById("yyyy").style.display= "block";
                document.getElementById("yyyyy").style.display= "block";
                document.getElementById("st").style.display= "none";
                document.getElementById("stt").style.display= "none";
                document.getElementById("sttt").style.display= "none";
                document.getElementById("stttt").style.display= "none";
                document.getElementById("sttttt").style.display= "none";
                $("#valoracion").val('5');
            }

            function star4(){
                document.getElementById("k").style.display= "block";
                document.getElementById("yy").style.display= "block";
                document.getElementById("yyy").style.display= "block";
                document.getElementById("yyyy").style.display= "block";
                document.getElementById("yyyyy").style.display= "none";
                document.getElementById("st").style.display= "none";
                document.getElementById("stt").style.display= "none";
                document.getElementById("sttt").style.display= "none";
                document.getElementById("stttt").style.display= "none";
                document.getElementById("sttttt").style.display= "block";
                $("#valoracion").val('4');
            }
            function ysss(){
                document.getElementById("k").style.display= "block";
                document.getElementById("yy").style.display= "block";
                document.getElementById("yyy").style.display= "block";
                document.getElementById("yyyy").style.display= "block";
                document.getElementById("yyyyy").style.display= "none";
                document.getElementById("st").style.display= "none";
                document.getElementById("stt").style.display= "none";
                document.getElementById("sttt").style.display= "none";
                document.getElementById("stttt").style.display= "none";
                document.getElementById("sttttt").style.display= "block";
                $("#valoracion").val('4');
            }
            
            function star3(){
                document.getElementById("k").style.display= "block";
                document.getElementById("yy").style.display= "block";
                document.getElementById("yyy").style.display= "block";
                document.getElementById("yyyy").style.display= "none";
                document.getElementById("yyyyy").style.display= "none";
                document.getElementById("st").style.display= "none";
                document.getElementById("stt").style.display= "none";
                document.getElementById("sttt").style.display= "none";
                document.getElementById("stttt").style.display= "block";
                document.getElementById("sttttt").style.display= "block";
                $("#valoracion").val('3');
            }
            function yss(){
                document.getElementById("k").style.display= "block";
                document.getElementById("yy").style.display= "block";
                document.getElementById("yyy").style.display= "block";
                document.getElementById("yyyy").style.display= "none";
                document.getElementById("yyyyy").style.display= "none";
                document.getElementById("st").style.display= "none";
                document.getElementById("stt").style.display= "none";
                document.getElementById("sttt").style.display= "none";
                document.getElementById("stttt").style.display= "block";
                document.getElementById("sttttt").style.display= "block";
                $("#valoracion").val('3');
            }

              function star2(){
                document.getElementById("k").style.display= "block";
                document.getElementById("yy").style.display= "block";
                document.getElementById("yyy").style.display= "none";
                document.getElementById("yyyy").style.display= "none";
                document.getElementById("yyyyy").style.display= "none";
                document.getElementById("st").style.display= "none";
                document.getElementById("stt").style.display= "none";
                document.getElementById("sttt").style.display= "block";
                document.getElementById("stttt").style.display= "block";
                document.getElementById("sttttt").style.display= "block";
                $("#valoracion").val('2');
            }
            function ys(){
                document.getElementById("k").style.display= "block";
                document.getElementById("yy").style.display= "block";
                document.getElementById("yyy").style.display= "none";
                document.getElementById("yyyy").style.display= "none";
                document.getElementById("yyyyy").style.display= "none";
                document.getElementById("st").style.display= "none";
                document.getElementById("stt").style.display= "none";
                document.getElementById("sttt").style.display= "block";
                document.getElementById("stttt").style.display= "block";
                document.getElementById("sttttt").style.display= "block";
                $("#valoracion").val('1');
            }
              function star1(){
                document.getElementById("k").style.display= "block";
                document.getElementById("yy").style.display= "none";
                document.getElementById("yyy").style.display= "none";
                document.getElementById("yyyy").style.display= "none";
                document.getElementById("yyyyy").style.display= "none";
                document.getElementById("st").style.display= "none";
                document.getElementById("stt").style.display= "block";
                document.getElementById("sttt").style.display= "block";
                document.getElementById("stttt").style.display= "block";
                document.getElementById("sttttt").style.display= "block";
                $("#valoracion").val('1');
            }
             function yk(){
                document.getElementById("k").style.display= "block";
                document.getElementById("yy").style.display= "none";
                document.getElementById("yyy").style.display= "none";
                document.getElementById("yyyy").style.display= "none";
                document.getElementById("yyyyy").style.display= "none";
                document.getElementById("st").style.display= "none";
                document.getElementById("stt").style.display= "block";
                document.getElementById("sttt").style.display= "block";
                document.getElementById("stttt").style.display= "block";
                document.getElementById("sttttt").style.display= "block";
                $("#valoracion").val('1');
            }
           
			</script>

    </body>
</html>