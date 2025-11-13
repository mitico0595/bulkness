<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Oberlu</title>
    <link rel="shortcut icon" href="https://oberlu.com/image/oberlu.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="UmOFMXgUENBKhvkGn0mHKUv5OINEyd69Iox5iHog">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://oberlu.com/css/fonts.css " rel="stylesheet">
    <!-- Styles -->


        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/sty-mobile.css')}} ">
	 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	   	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <link rel="stylesheet" href="{{asset('css/articulo.css')}} ">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">


        <style type="text/css">
            * {
                box-sizing: border-box;
            }
          #menum{
         position: absolute;
         height: 35vh;
         display: block;
         width: 320px;
         margin-left: -500px;
         color: #282828;
         transition: .5s;
         background: rgba(256,256,256,0.90);
         top: 60px;
         border-radius: 20px;
         padding: 20px;
         }
         #menum a{
             width: 100%;
             position: relative;
             display: block;
             padding: 10px;
         }
         .config h4{
             line-height: 40px;
         }
         .precioreal{
            top:65px; left:120px;
         }
         .stock{
             top:65px;
             left: 200px;
         }
         .codigo{
             left: 120px;
             top:95px;
         }
         #searchid {
             background: none;
             width: 200px;
             margin-left: 60px;
             margin-top: 15px;
             transition: .5s;
             margin:0px;
             margin-left: 60px;

         }
         #searchid:focus{
             background: white;
             width: 100%;
             margin-left: 0px;
             margin-top: 0px;
             padding: 18px;
         }
         #menum{
             padding-top: 150px;
         }
         #menum a{
             color: #fff;
             font-size: 20px;
             text-align: center;
         }
         .cerrar-sesion{
             position: relative;
             float:left;width: 130px;
              padding:5px;font-family:'Dosis';
              font-size: 18px;
              background: none;
              text-align: center;
              color:#000;
              font-weight: bold;margin:0px;
              border-radius: 20px;border: 2px solid #000;
         }
         .numbers{
             position: absolute;
             top: -20px;
         }
         .inputnumbers{
             width:100px;
             position: relative;
         }
         .form-control{
             width: 100px;
         }
         .addname{
             width: 100%;
         }
         .buscador{
             z-index: 999999;
             position: absolute;
             left: 0px;
             margin: 0px;
             width: 100%;
             border: none;
         }
         .subfecha2{
             position: absolute;top:20px;left: 40px;
         }
         .not{
                     user-select: none;
                 }
         .bootstrap-select{
           border:none;
           box-shadow: none;
           position: relative;
         width: 200px;
         margin-bottom: 15px;

         }
         .filter-option{
         font-size: 15px;
           font-family: 'Kanit';
         }
         .lera{
             position: relative;

             float: left;
             display: block;
             text-align: center;
             line-height: 12px;
         }
         .lera input{
             position: relative;
             width:50px;
             float: left;
             display: block;
             text-align: center;
             line-height: 12px;
         }
         .address-modify{
         padding: 20px;
         border: 1px solid #337ab7;
         border-radius: 5px;
         margin-bottom: 20px;
         }
 </style>
    <style>
        *{
            padding: 0;
            margin:0;
            box-sizing: border-box;
            font-family: 'Kanit';
            text-decoration:none;
        }
    </style>
        <style type="text/css">
        img {
            max-width:  200px;
            max-height: 200px;
        }


           #menum{
    position: absolute;
    height: 35vh;
    display: block;
    width: 320px;
    margin-left: -500px;
    color: #282828;
    transition: .5s;
    background: rgba(256,256,256,0.90);
    top: 60px;
    border-radius: 20px;
    padding: 20px;
}
#menum a{
    width: 100%;
    position: relative;
    display: block;
    padding: 10px;
}
.config h4{
    line-height: 40px;
}
.precioreal{
   top:65px; left:120px;
}
.stock{
    top:65px;
    left: 200px;
}
.codigo{
    left: 120px;
    top:95px;
}
#finder {
    background: none;
    width: 200px;
    margin-left: 60px;
    margin-top: 15px;


}
#finder:focus{
    background: white;
    width: 100%;
    margin-left: 0px;
    margin-top: 0px;
    padding: 18px;
}
#menum{
    padding-top: 150px;
}
#menum a{
    color: #fff;
    font-size: 20px;
    text-align: center;
}
.cerrar-sesion{
    position: relative;
    float:left;width: 130px;
     padding:5px;font-family:'Dosis';
     font-size: 18px;
     background: none;
     text-align: center;
     color:#000;
     font-weight: bold;margin:0px;
     border-radius: 20px;border: 2px solid #000;
}
.numbers{
    position: absolute;
    top: -20px;
}
.inputnumbers{
    width:100px;
    position: relative;
}
.form-control{
    width: 100px;
}
.addname{
    width: 100%;
}
.grid_articulo:hover {
    background: #f2f2f2;
    box-shadow: 1px 1px 4px #dedede;
    border-radius: 0px;
}
        .le{
            position: relative;width: 50%;box-sizing: border-box;float: left;
        }
        .le h5{
            font-size: 15px;
            padding-left: 20px;
        }
        .ri{
            position: relative;width: 50%;box-sizing: border-box;float: right;
        }
        .ri h5{
            font-size: 15px;

        }
       </style>
       <style type="text/css">
           #menum{
    position: absolute;
    height: 35vh;
    display: block;
    width: 320px;
    margin-left: -500px;
    color: #282828;
    transition: .5s;
    background: rgba(256,256,256,0.90);
    top: 60px;
    border-radius: 20px;
    padding: 20px;
}
#menum a{
    width: 100%;
    position: relative;
    display: block;
    padding: 10px;
}
.config h4{
    line-height: 40px;
}
.precioreal{
   top:65px; left:120px;
}
.stock{
    top:65px;
    left: 200px;
}
.codigo{
    left: 120px;
    top:95px;
}
#searchid {
    background: none;
    width: 200px;
    margin-left: 60px;
    margin-top: 15px;
    transition: .5s;
    margin:0px;
    margin-left: 60px;

}
#searchid:focus{
    background: white;
    width: 100%;
    margin-left: 0px;
    margin-top: 0px;
    padding: 18px;
}
#menum{
    padding-top: 150px;
}
#menum a{
    color: #fff;
    font-size: 20px;
    text-align: center;
}
.cerrar-sesion{
    position: relative;
    float:left;width: 130px;
     padding:5px;font-family:'Dosis';
     font-size: 18px;
     background: none;
     text-align: center;
     color:#000;
     font-weight: bold;margin:0px;
     border-radius: 20px;border: 2px solid #000;
}
.numbers{
    position: absolute;
    top: -20px;
}
.inputnumbers{
    width:100px;
    position: relative;
}
.form-control{
    width: 100px;
}
.addname{
    width: 100%;
}
.buscador{
    z-index: 999999;
    position: absolute;
    left: 0px;
    margin: 0px;
    width: 100%;
    border: none;
}
.subfecha2{
    position: absolute;top:20px;left: 40px;
}
       </style>
<style type="text/css">@font-face { font-family: Roboto; src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf"); }</style></head>

<body>

    <div style="box-shadow: 2px 2px 15px #2176dd; width:100%;background: linear-gradient(to right, #2176dd 0%,#1257a5 100%);height:130px;padding:20px 20px 0px 20px;  ">
        <div style="display:flex;width:100%;">
            <div style="width:20%"><img src="https://oberlu.com/image/svg/arrow-white.svg " alt="" style="width:25px"></div>
            <div id="monto" style="width:60%;text-align:center;font-size:25px;color:#1f7ce8;border:1px solid #1f7ce8;border-radius:5px" > </div>

            <div onclick="" style="width:10%"><a href="{{url('egreso/create')}} "><img src="{{asset('image/svg/agregar.svg')}} " alt="" style="width:25px;float:right"></a></div>
            <div onclick="force()" style="width:10%"><img src="https://oberlu.com/image/svg/menu2.svg" alt="" style="width:25px;float:right"></div>

        </div>
        <div style="display:flex;width:100%;align-items:center;justify-content:center;height:50px;margin-top:30px ">
            <div id="user" onclick="us()" style="transition: .2s; width:70%;text-align:center;font-size:22px;border-bottom:#fff solid 5px;color:white;padding-bottom: 13px;">Crear Ingreso</div>


        </div>
    </div>
    <div id="users" style="position:relative;margin-top:50px;width:100%;">
        <div style="position: absolute;top:70px;width: 100%;padding: 20px; box-sizing: border-box;">
            @if (count($errors)>0)
                     <div class="alert alert-danger">
                         <ul>
                         @foreach($errors->all() as $error)
                             <li>{{$error}}</li>
                         @endforeach
                         </ul>
                     </div>
                     @endif


                     {!!Form::open(array('url'=>'entradas','method'=>'POST','autocomplete'=>'off'))!!}
                     {{Form::token()}}

                 <div class="row" style="display: block">
                     <div class="panel panel-primary" style="margin-bottom: 0px;">
                         <div class="panel-body" style="padding-bottom: 40px;">
                             <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                                 <div class="form-group" style="width: 100%;">
                                     <label>Motivo Ingreso</label>
                                     <input type="text" name ="pdetalle"  id="pdetalle"  class="form-control" placeholder="Detalle" style="width:100%" >
                                 </div>
                             </div>

                             <div style="display: flex; justify-content:center;align-items:center;width:100%">
                             <div class="" style="width:30%;">
                                 <div class="form-group">
                                     <label for="monto">Monto</label>
                                     <input type="number" name ="pmonto"  id="pmonto"  class="form-control" placeholder="Monto" >

                                 </div>
                             </div>



                                 <div class="form-group" style="width:70%">
                                     <button type="button" id="bt_add" class="btn btn-primary" style="width:80%;margin:auto;display:block;margin-top:15px" >Agregar</button>
                                 </div>
                            </div>

                             <div class="" style="position: relative;float: left;width: 100%;
                             display: inline-block;">
                                 <div id="detalles" class="">
                                     <div style="background-color: #e5e5e5;position: relative;width: 100%;height: 25px;display: block;">
                                         <div style="position: relative;width:50px;float: left;display: block;text-align: center;line-height: 12px;margin-top:5px;">Delete</div>
                                         <div style="position: relative;width:150px;float: left;display: block;text-align: center;line-height: 12px;margin-top:5px;">Detalle</div>
                                         <div style="position: relative;width:50px;float: left;display: block;text-align: center;line-height: 12px;margin-top:5px;">Monto</div>

                                     </div>
                                     <div style="position: absolute;bottom:0px;right: 150px;">
                                         <div style="position: absolute;left: 0px;top: 0px;font-size: 17px;">TOTAL</div>
                                         <h4 id="total" style="position: absolute;left: 60px;top: 2px;font-size: 17px;width: 80px;"> S/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta">
                                     </div>
                                     <tbody>

                                     </tbody>
                                 </div>
                             </div>
                         </div>
                     </div>

                 </div>
                 <div class="address-content" style="position: relative;margin-top: 20px;">
                 <div class="ubicacion-image" style="position: absolute;right: 10px;top: 10px;">
                     <img src="{{asset('image/svg/mapi.svg')}} " class="image-ub" style="width: 20px;">

                 </div>


             </div>
                 <input name="_token" value="{{ csrf_token() }}" type="hidden">

                             <button class="" type="submit" style="position: relative;width: 100%;background: #3087c1;border:none; padding:10px 5px;font-size: 17px;border-radius: 10px;color:white;">Guardar</button>



                     {!!Form::close()!!}


         </div>

        <!-- END ------------------------ FOR EEACH -->
    </div>
    <script>

        $(document).ready(function(){$('#bt_add').click(function(){
            agregar();
            });
        });

        var cont=0;
        total=0;

        $("#guardar").hide();



        function agregar() {


            detalle= $("#pdetalle").val();
            monto =$("#pmonto").val();



                var fila='<div class="selected" style="height:30px;margin-top:5px;" id="fila'+cont+'"><div class="lera" style="width:50px"><button type="button" class="btn btn-warning " onclick="eliminar('+cont+');">X</button></div><div class="lera" style="width:150px"><input  type="hidden" name="detalle[]" value="'+detalle+'">'+detalle+'</div> <div class="lera" style="width:50px"><input class="not" readonly="readonly" type="number" name="monto[]" value="'+monto+'" ></div></div>';
                cont++;
                limpiar();


                $('#detalles').append(fila);


        }


        function limpiar() {
            $("#pdetalle").val("");
            $("#pmonto").val("");


        }


        function eliminar(index){

            $("#fila" + index).remove();


        }

    </script>

    <script type="text/javascript">
        function us(){
            document.getElementById("user").style.borderBottom = "#fff solid 5px";
            document.getElementById("user").style.paddingBottom = "13px";
            document.getElementById("supplier").style.borderBottom = "none";
            document.getElementById("supplier").style.paddingBottom = "0px";

            document.getElementById("users").style.display = "block";
            document.getElementById("suppliers").style.display = "none";

            document.getElementById("egg").style.display = "none";
            document.getElementById("monto").style.display = "block";
        }
        function sup(){
            document.getElementById("supplier").style.borderBottom = "#fff solid 5px";
            document.getElementById("supplier").style.paddingBottom = "13px";
            document.getElementById("user").style.borderBottom = "none";
            document.getElementById("user").style.paddingBottom = "0px";

            document.getElementById("users").style.display = "none";
            document.getElementById("suppliers").style.display = "block";

            document.getElementById("egg").style.display = "block";
            document.getElementById("monto").style.display = "none";
        }




    </script>
</body>
</html>
