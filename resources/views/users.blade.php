@extends ('blackboard')
@section ('contenido')

        <title>LUZAPAY | CLIENTES</title>
        
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        <!-- Styles -->
    <style type="text/css">
        input {
                width: 300px;
                height: 40px;
                border: 2px solid #ccc;
                line-height: 40px;
                font-family: Verdana;
                font-size: 16px;
                color: #333;
                padding: 5px;
            }
            body{
                background:#f2f2f2;
            }
    input:focus { 
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6);
        border-color: rgb(102, 175, 233);
        }
        .client:hover{
            box-shadow: 1px 2px 6px #d3d3d3;
            transform: scale(1.02);
            z-index: 9999;
            transition: .2s;
        }
        .nombre{
                position: absolute;
    top: 80px;
    right: 300px;
    width: 150px;
    font-size: 12px;
    border: none;
    border-bottom: 1px solid;
        }
        .nombre:focus{
            outline: 0;
            box-shadow: none;
        }
        .email{
        position: absolute;
        top: 80px;
        right: 150px;
        width: 150px;
        font-size: 12px;
        border: none;
        border-bottom: 1px solid;
        }
        .email:focus{
          outline: 0;
            box-shadow: none;  
        }
        .dni{
        position: absolute;
        top: 80px;
        right: 70px;
        width: 80px;
        font-size: 12px;
        border: none;
        border-bottom: 1px solid;
        }
        .dni:focus{
          outline: 0;
            box-shadow: none;  
        }
        .search{
        position: absolute;
        top: 90px;
        right: 40px;
        width: 20px;
        font-size: 12px;
        line-height: 30px;
        }
        .ahover:hover{
            text-decoration: none;
            background: #cecece;
        }
        .detalles:hover{
        transform: scale(1.01,1.01);
        box-shadow: 1px 2px 10px #808080;
    }
    </style>
        





        <div  class="container">
           
        <div class="page-header">
                       
                            {{ Form::open(['route' => 'userin', 'method'=> 'GET', 'class' => 'form-inline pull-right' ])}}
                               <div class="form-group">

                                        <div class="input-field">
                                            <input type="text" class="nombre" id="searchid" placeholder="Buscar por apellido" name="searchText" value="" autocomplete="off">
                                        </div>
                                                                                                                                                                            
                                            
                                        <div class="form-group">
                                    {{ Form::text('email', null, ['class'=> 'email', 'placeholder' => 'Email','autocomplete' => 'off' ])}}
                                    
                                </div>
                                    <div class="form-group">
                                    {{ Form::text('dni', null, ['class'=> 'dni', 'placeholder' => 'DNI', 'autocomplete' => 'off'])}}
                                    
                                    </div>
                                 <!--<input list="nombre" name="name" type="text"  placeholder="Elige un nombre">
                                 <datalist name='name' class="" id="nombre"  >
                                        
                                    
                                </datalist>--> 
                                </div>
                               
                                 
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">
                                        <img src="{{asset('image/svg/search.svg')}} " class="search">
                                    </button>

                                </div>
                            {{ Form::close()}}
                       </h1>
                          
        </div>


	<div style="width:100%;width:1200px;margin:auto;display:block;margin-top:60px;">
	    
	     <div style="width:100%; max-width:1100px;margin:auto;display:block;background:#ec1438;padding:10px;border-radius:10px;position:relative">
        <h5 style="font-size:1.6em;margin:0;color:white;font-weight:100">Listado de clientes
        </h5>
        <a href="ingreso/create" class="add_ad" style="position:absolute;right:0px;top:7px;font-family:Helvetica" data-toggle="modal" data-target="#formarticulo">
		SALE</a>

    </div>
    <div style="background:white;border-bottom: 2px solid #ddd; width:100%;width:1100px;margin:auto;display:flex;padding:10px;align-items:center;justify-content:center;margin-top:30px;margin-bottom:20px;">
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:150px;text-align:center">DNI</h5>
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:210px;text-align:center">Usuario</h5>
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:210px;text-align:center">Email</h5>
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:120px;text-align:center">Celular</h5>
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:184px;text-align:center">Ciudad</h5>
        <h5 style="font-weight:100;font-size:1em;margin:0;color:#bababa;width:184px;text-align:center"></h5>
    </div>
    @foreach ($users as $user)
    <div class="detalles" style="background:white;width:100%;width:1100px;margin:auto;display:flex;padding:10px;align-items:center;justify-content:center;border-bottom: 1px solid rgb(231, 231, 231)">
        <div style="display:flex;align-items:center;justify-content:center;flex-direction: column;">
           <a href=""><h5 style="font-weight:bold;font-size:15px;margin:0;color:#ec1438;width:150px;text-align:left">{{ $user -> dni ?? 'None'}}</h5></a>
            <h5 style="font-size:13px;margin:0;color:#808080;width:150px;text-align:left">{!! substr(($user->name),0,1) !!}{!! substr(($user->lastname),0,1) !!}-{{ $user -> dni ?? 'solicitar'}} </h5>
        </div>
        <div style="display:flex;align-items:center;justify-content:center;flex-direction: column;">
            <h5 style="font-weight:bold;font-size:15px;margin:0;color:black;width:210px;text-align:left">{{ $user -> name}} {{ $user -> lastname}}</h5>
            <h5 style="font-size:13px;margin:0;color:#808080;width:210px;text-align:left">{{ $user -> dni ?? 'none'}}</h5>
        </div>
        <div style="display:flex;align-items:center;justify-content:center;flex-direction: column;">
            <h5 style="font-weight:bold;font-size:15px;margin:0;color:black;width:210px;text-align:left">{{ $user -> email }}</h5>
            <h5 style="font-size:13px;margin:0;color:#808080;width:210px;text-align:left">{{ $user -> cell ?? 'none'}}</h5>
        </div>
        <div style="display:flex;align-items:center;justify-content:center;flex-direction: column;">
            <h5 style="font-size:13px;margin:0;color:black;width:120px;text-align:center;padding:5px">{{ $user -> cell ?? 'none'}}</h5>
        </div>
        <h5 style="font-size:15px;margin:0;color:black;width:184px;text-align:center;text-transform:uppercase">{{ $user -> ciudad ?? 'none'}}</h5>
        <div style="display:flex;align-items:center;justify-content:center;flex-direction: row;">
           <a href="{{URL::action('UserController@show',$user->id)}}"> <h5 style="font-size:15px;margin:0;color:white;width:100px;text-align:center;padding:5px;background:#f9a513;border-radius:5px;margin-right: 10px;">Usuario</h5></a>
           <a href="/personas/{{$user->id}}/edit "> <h5 style="margin-left:10px;font-size:15px;margin:0;color:white;width:100px;text-align:center;padding:5px;background:#13a3f7;border-radius:5px;margin-right;10px">Editar</h5></a>
           
        </div>
    </div>
    @endforeach
    
                     {{ $users->render() }}
                
           
        


       
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('find')!!}',
                    success:function(response){
                        console.log(response);
                    //material.css
                    //convert to object
                    var custArray = response;
                    var dataCust ={};
                    var dataCust2 ={};
                    for (var i=0; i< custArray.length;i++){
                        dataCust[custArray[i].lastname] = null;
                        dataCust2[custArray[i].name] = custArray[i];
                    }
                    
                    $('input#searchid').autocomplete({
                        data: dataCust,
                        onAutocomplete:function(reqdata){
                            console.log(reqdata);   
                        }

                        
                    });
                    }

                })


            });



        </script>

    @endsection 