<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@include ('title') Pagos: Comparte el link si deseas que otra persona pague</title>
        @include ('logo')
        <link rel="stylesheet" href="{{asset('css/estilos.css')}}" >
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="{{asset('css/boton.css')}}" >
        <link rel="stylesheet" href="{{asset('css/pagos.css')}}" >
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
    *{
        font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
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
</head>
<body>
  <form  method="post" action="https://secure.micuentaweb.pe/vads-payment/"  >      
@csrf
   <input type="hidden" name="vads_action_mode" value="INTERACTIVE" />
            <input type="hidden" name="vads_amount" value={{$amounty}}  />
            <input type="hidden" name="vads_ctx_mode" value="PRODUCTION" />
            <input type="hidden" name="vads_currency" value="604" />
            <input type="hidden" name="vads_page_action" value="PAYMENT" />
            <input type="hidden" name="vads_payment_config" value="SINGLE" />
            <input type="hidden" name="vads_site_id" value="37752659" />
            <input type="hidden" name="vads_trans_date" value= {{$date}} />
            <input type="hidden" name="vads_trans_id" value={{$payment_id}}  />
            <input type="hidden" name="vads_version" value="V2" />
            <input type="hidden" name="signature" value={{$hash}} />  
<div id="pc">
        
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


<div style="box-sizing:border-box;width: 100%; position: relative;display: inline-block;margin:0px;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;border:none;margin-top:150px;height:100px;border: 1px solid #cacaca;border-radius:5px;box-shadow:1px 1px 4px #cacaca" >
    @if ($verify == 0)
    <img src="{{asset('image/thumb/cart-p3.png ')}}" alt="" style="width:530px" id="imgsen">
    @else
    <img src="{{asset('image/thumb/cart-p4.png ')}}" alt="" style="width:530px" id="imgsen">
    @endif
    
    
    <img src="{{asset('image/thumb/cart-p3.png ')}}" alt="" style="width:530px;display: none"  id="imgtar">
    <div style="width: 200px;right: 35px;position: absolute;z-index:1;top:27px;">
        <h2 style="font-size: 15px;font-weight:100" id="textover">Ver detalle de compra</h2>
    </div>
    <img src="{{asset('image/svg/menu2.svg')}} " style="width: 17px;right: 10px;top:25px;position: absolute;padding: 15px;border-radius: 50px;background: #282828;cursor: pointer;" onclick="abrir()" id="circlever">

</div>
<div id="charge-error">{{Session::get('error')}} </div>


            
    
<div style=" min-width:850px;max-width:850px; box-sizing:border-box; padding:20px 20px 30px; width: 100%; position: relative;display: inline-block;margin:0px;margin-top: 20px;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;border:none;border: 1px solid #cacaca;border-radius:5px;box-shadow:1px 1px 4px #cacaca;float:left;margin-bottom:50px;" id="clicka" >
    <h2 style="margin:0px;padding-top: 10px;font-size: 20px;font-weight: 100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif " id="dir">Resumen de compra</h2>
    <h2 style="margin:0px;padding-top: 10px;font-size: 20px;font-weight: 100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif" id="dirr" onclick="modify()" >Modificar datos de envío</h2>
    <div id="datar">

    <div style="position: relative;width:100%;margin-top:20px">
        @if ($ciudad == "Lima")
        <div class="envio " style="">
            Envío Lima Metropolitana <img src="{{asset('image/svg/delivery_black.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
        </div>
        @else
        <div class="envio done" style="margin-left:0px">
            Envío Departamentos <img src="{{asset('image/svg/delivery_black.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
        </div>
        @endif
        <a href="https://www.izipay.pe/"><div class="envio done" style="margin-left:10px; border:1px solid #ff4240;background:#ff4240;color:white">
            Pago con IZIPAY <img src="{{asset('image/logo.png')}} " style="width:90px;position: absolute;right: 20px;top:10px;">
        </div></a>
        <div class="" style="height:310px;width:292px;background:#282828;position:relative;display:inline-block;margin-top:10px;border:1px solid #282828;border-radius:3px;padding:10px;color:white;font-size:13px;box-sizing:border-box;">
           Tarjeta de envio
            <div style="display:flex;flex-direction: column; width:90%;margin:auto;align-items:center;justify-content:center;font-size:14px " >
            <div style="display:flex;width:100%;border-bottom:1px solid #4c4c4c;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/email.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        E-mail
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                         {!! substr(($email),0,3) ?? 'Email no ingresado'!!}****@****.com
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;border-bottom:1px solid #4c4c4c;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/dni.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        DNI
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                        **{!! substr(($dni),2,2) !!} {!! substr(($dni),4,2) !!}** 
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;border-bottom:1px solid #4c4c4c;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/charlar.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        Celular
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                        (+51) {!! substr(($cell),0,3) !!} {!! substr(($cell),3,2) !!}* ***
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;border-bottom:1px solid #4c4c4c;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/calendario.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        Fecha del pedido
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                        {{$fecha}}
                    </div>
                </div>
            </div> 
            <div style="display:flex;width:100%;border-bottom:1px solid #4c4c4c;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/ubicacion.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        Ubicacion
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                        {{$direccion}}
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/peru.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080;font-size:13px" >
                        Distrito - Provincia - Departamento
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                        {{$distrito}} - {{$provincia}} - {{$ciudad}}
                    </div>
                </div>
            </div>
        </div>  
        </div>
        
        <div class="" style="height:310px;width:292px;background:#282828;margin-left:10px; position:relative;display:inline-block;margin-top:10px;border:1px solid #282828;border-radius:3px;padding:10px;color:white;font-size:13px;box-sizing:border-box;">
           
             <div style="position:relative;display:flex;justify-content:center;align-items:center;height:100px" >
                 No existen recibos
             </div>
        </div>
    </div>
    <div style="position: relative;display:inline-block;width:100%;max-width:1000px;min-width:900px;">
       
        <a href="{{url('busco')}} "><div style="width:260px;position: relative;display: inline-block;margin-top: 20px;box-sizing:border-box;margin-top: 20px; box-sizing: border-box; color:#ba1f1f;
        line-height: 40px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;text-align:center;font-weight:600;cursor:pointer">
            Continuar comprando
        </div></a>
        @if($verify == 0)
        <input class="boton cuatro" type="submit" name="pagar" value="Continuar con el pago"/>
        @else 
        <input style="background:#808080"  class="boton cuatro" type="submit" name="pagar" value="Pago Realizado" disabled/>
        @endif
          </div>

    </div>
</div>


   
<div style="margin-left:20px; box-sizing:border-box;width: 330px; position: relative;display: inline-block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;border:none;margin-top:20px;height:100px;" >
    <img src="{{asset('image/svg/cerrar.svg')}} " style="width: 17px;right: 10px;top:10px;position: absolute;z-index: 99999;display: none;cursor: pointer;"  onclick="closes()" id="cerrar">

    <div style="position: absolute;right: 0px; display: block;box-sizing:border-box; width:330px;top:-20px;padding:30px;border:1px solid #cecece;padding-top: 20px;border-radius: 7px;margin-top: 20px;background: #282828;display: block;min-height:457px;" id="todo">

        <div style="position: absolute;top:20px;font-size: 12px;color:#fff"> DETALLE DE COMPRA</div>

        @if($protected == 1)
        @foreach ($detalles as $search)
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 20px;">
            <div style="width: 90px; position: relative;float:left;display: block;"><img src="{{asset('images/'.$search->image)}} " style="width:100%;border-radius: 50px;"></div>
            <div style="position: absolute;top:10px;left:110px;width: 150px;font-size: 15px;line-height: 15px;color:#fff;letter-spacing: 0;line-height: 15px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; margin: 0px;">{{$search->name }} </div>
            <div style="position: absolute;top:50px;left:110px;width: 150px;font-size: 10px;line-height: 10px;color:#fff;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif ">{{$search->categoria }} </div>
            
            <div style="position: absolute;top:65px;left:110px;color:#fff;font-size: 10px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">x{{$search->cantidad}} </div>
          
            <div style="position: absolute;top:65px;left:135px;width: 150px;color:#fff;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;text-align: center;width: 50px;font-size: 10px">{{$search->precio}} </div>
            
            <div style="position: absolute;top:80px;left:120px;width: 150px;color:#fff;text-align: center;width: 150px;font-size: 11px;font-weight: 100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">SUB-TOTAL S/.  {{number_format($search->precio,2)}} </div>

        </div>
        @endforeach
        @else
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 20px;color:#cacaca;text-align:center;border:1px solid #cacaca;border-radius:5px;">
            Esta parte es privada, solo el propietario del pedido puede visualizarlo
        </div>
        @endif
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 20px;padding-bottom: 0">
            <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Subtotal compras: </h1>
            <h1 style="position: relative;width: 80px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px;margin: 0 ">S/.  {{number_format($totalProduct,2)}} </h1>
        </div>
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 0px;padding-top: 0;padding-bottom: 0 ">
            <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Cargos Logisticos (0,01%): </h1>
            <h1 style="position: relative;width: 80px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">S/.  0.00 </h1>
        </div>
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 0px;padding-top: 0;border-bottom: 1px solid #808080;box-sizing: border-box;">
             @if ($ciudad == "Lima")
            <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Envio Lima Metropolitana: </h1>
            <h1 style="position: relative;width: 50px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">S/. 10.00</h1>
            @else
             <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Envio Departamento: </h1>
            <h1 style="position: relative;width: 50px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">S/. 14.90</h1>
           
            @endif
        </div>
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 10px;padding-top: 0;border-bottom: 1px solid #808080;box-sizing: border-box;">
            <h1 style="position: relative;width: 100%;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 15px; margin: 0;text-align:center;  ">TOTAL A CANCELAR: </h1>
            <h1 style="position: relative;width: 100%;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 15px; margin: 0;text-align:center">S/. {{number_format($amount,2)}}</h1>
        </div>
    </div>

</div>
</div>


<div>
</div>

<div id="cellversion">
    <div style="position:relative;display:inline-block;height:110px;width:100%;">
    <a href="{{url('/')}}"><img src="{{asset('image/oberlu_logo.png')}} " style="position: relative;display:block;margin:auto;width: 190px;z-index: 999;margin-top:10px;"></a>
    </div>
    <div style="position:relative;display:flex;height:40px;width:100%;justify-content:center;align-items:center">
    <div>
         <div style="position: relative;float:left;width:180px;height:100%;">
                <img src="{{asset('image/svg/call-centeri.svg')}} " alt="" style="width: 30px;margin-top:35px;">
                <h4 style="position: relative;float:right;display:inline-block;font-weight:100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;line-height:95px;color:#666;margin:0">Asesoría telefónica</h4>
            </div>
            
    </div>
    <div>
        <div style="position: relative;float:left;width:155px;margin-left:25px;height:100%;background:white;">
                <img src="{{asset('image/svg/seguro.svg')}} " alt="" style="width: 30px;margin-top:35px;">
                <h4 style="position: relative;float:right;display:inline-block;font-weight:100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;line-height:95px;color:#666;margin:0">Compra seguro</h4>

        </div>
    </div>
    </div>
    
    <div style="position:relative;display:block;width:100%;margin-top:20px">
         @if ($verify == 0)
        <img src="{{asset('image/thumb/cart-p3.png ')}}" alt="" style="width:330px;margin:auto;display:block" id="imgsen">
        @else
        <img src="{{asset('image/thumb/cart-p4.png ')}}" alt="" style="width:330px;margin:auto;display:block" id="imgsen">
        @endif   
    </div>
    
    <div style="position:relative;display:block;width:100%;margin-top:20px">
        @if ($ciudad == "Lima")
        <div class="envio " style="position:relative;display:block;margin:auto;float:none">
            Envío Lima Metropolitana <img src="{{asset('image/svg/delivery_black.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
        </div>
        @else
        <div class="envio done" style="margin-left:0px;display:block;margin:auto;float:none">
            Envío Departamentos <img src="{{asset('image/svg/delivery_black.svg')}} " style="width:30px;position: absolute;right: 20px;top:10px;">
        </div>
        @endif
        
        
    </div>
    <div style="position:relative;display:block;width:100%;margin-top:10px">
        <a href="https://www.izipay.pe/" style="text-decoration:none" ><div class="envio done" style="margin-left:0px; border:1px solid #ff4240;background:#ff4240;color:white;display:block;margin:auto;float:none;position:relative;">
            Pago con IZIPAY <img src="{{asset('image/logo.png')}} " style="width:90px;position: absolute;right: 20px;top:10px;">
        </div></a>
        
    </div>
    
    
    <div style="position:relative;display:block;width:100%;margin-top:10px">
        <div class="" style="width:292px;background:#282828;position:relative;display:inline-block;margin-top:10px;border:1px solid #282828;border-radius:3px;padding:10px;color:white;font-size:13px;box-sizing:border-box;float: none;display: block;margin: auto;">
           Tarjeta de envio
            <div style="display:flex;flex-direction: column; width:90%;margin:auto;align-items:center;justify-content:center;font-size:14px " >
            <div style="display:flex;width:100%;border-bottom:1px solid #4c4c4c;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/email.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        E-mail
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                         {!! substr(($email),0,3) ?? 'Email no ingresado'!!}****@****.com
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;border-bottom:1px solid #4c4c4c;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/dni.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        DNI
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                        **{!! substr(($dni),2,2) !!} {!! substr(($dni),4,2) !!}** 
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;border-bottom:1px solid #4c4c4c;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/charlar.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        Celular
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                        (+51) {!! substr(($cell),0,3) !!} {!! substr(($cell),3,2) !!}* ***
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;border-bottom:1px solid #4c4c4c;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/calendario.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        Fecha del pedido
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                        {{$fecha}}
                    </div>
                </div>
            </div> 
            <div style="display:flex;width:100%;border-bottom:1px solid #4c4c4c;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/ubicacion.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080" >
                        Ubicacion
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                        {{$direccion}}
                    </div>
                </div>
            </div>
            <div style="display:flex;width:100%;margin-top:10px;padding-bottom:5px;" >
                <div style="display:block;width:15%" >
                    <img src="{{ asset('image/svg/peru.svg') }} " alt="" style="width:30px" >
                </div>
                <div style="display:block;width:85%">
                    <div style="display:block;width:100%;color:#808080;font-size:13px" >
                        Distrito - Provincia - Departamento
                    </div>
                    <div style="display:block;width:100%;font-size:12px" >
                        {{$distrito}} - {{$provincia}} - {{$ciudad}}
                    </div>
                </div>
            </div>
        </div>  
        </div>
        
    </div>

    <div style="position:relative;display:block;width:100%;margin-top:10px">
        <div class="" style="line-height:26px;text-align:center; height:50px;width:292px;background:#282828;position:relative;display:inline-block;margin-top:0px;border:1px solid #282828;border-radius:3px;padding:10px;color:white;font-size:13px;box-sizing:border-box;display:block;position:relative;margin:auto">
           No existen recibos
             
        </div>
        
    </div>
    <div style="position:relative;display:block;width:100%;margin-top:10px;min-height:410px">
        <div style="box-sizing:border-box;width: 330px; position: relative;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;border:none;margin-top:20px;height:100px;margin:auto" >
        <img src="{{asset('image/svg/cerrar.svg')}} " style="width: 17px;right: 10px;top:10px;position: absolute;z-index: 99999;display: none;cursor: pointer;"  onclick="closes()" id="cerrar">

        <div style="position: absolute;right: 0px; display: block;box-sizing:border-box; width:330px;top:-20px;padding:30px;border:1px solid #cecece;padding-top: 20px;border-radius: 7px;margin-top: 20px;background: #282828;display: block;" id="todo">

        <div style="position: absolute;top:20px;font-size: 12px;color:#fff"> DETALLE DE COMPRA</div>

        @if($protected == 1)
        @foreach ($detalles as $search)
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 20px;">
            <div style="width: 90px; position: relative;float:left;display: block;"><img src="{{asset('images/'.$search->image)}} " style="width:100%;border-radius: 50px;"></div>
            <div style="position: absolute;top:10px;left:110px;width: 150px;font-size: 15px;line-height: 15px;color:#fff;letter-spacing: 0;line-height: 15px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; margin: 0px;">{{$search->name }} </div>
            <div style="position: absolute;top:50px;left:110px;width: 150px;font-size: 10px;line-height: 10px;color:#fff;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif ">{{$search->categoria }} </div>
            
            <div style="position: absolute;top:65px;left:110px;color:#fff;font-size: 10px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">x{{$search->cantidad}} </div>
          
            <div style="position: absolute;top:65px;left:135px;width: 150px;color:#fff;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;text-align: center;width: 50px;font-size: 10px">{{$search->precio}} </div>
            
            <div style="position: absolute;top:80px;left:120px;width: 150px;color:#fff;text-align: center;width: 150px;font-size: 11px;font-weight: 100;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif">SUB-TOTAL S/.  {{number_format($search->precio,2)}} </div>

        </div>
        @endforeach
        @else
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 20px;color:#cacaca;text-align:center;border:1px solid #cacaca;border-radius:5px;">
            Esta parte es privada, solo el propietario del pedido puede visualizarlo
        </div>
        @endif
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 20px;padding-bottom: 0">
            <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Subtotal compras: </h1>
            <h1 style="position: relative;width: 80px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px;margin: 0 ">S/.  {{number_format($totalProduct,2)}} </h1>
        </div>
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 0px;padding-top: 0;padding-bottom: 0 ">
            <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Cargos Logisticos (0,01%): </h1>
            <h1 style="position: relative;width: 80px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">S/.  0.00 </h1>
        </div>
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 0px;padding-top: 0;border-bottom: 1px solid #808080;box-sizing: border-box;">
             @if ($ciudad == "Lima")
            <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Envio Lima Metropolitana: </h1>
            <h1 style="position: relative;width: 50px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">S/. 10.00</h1>
            @else
             <h1 style="position: relative;width: 180px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">Envio Departamento: </h1>
            <h1 style="position: relative;width: 50px;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 12px; margin: 0">S/. 14.90</h1>
           
            @endif
        </div>
        <div style="width: 100%;padding:10px;position: relative;display: inline-block;margin: 0px;margin-top: 10px;padding-top: 0;border-bottom: 1px solid #808080;box-sizing: border-box;">
            <h1 style="position: relative;width: 100%;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 15px; margin: 0;text-align:center;  ">TOTAL A CANCELAR: </h1>
            <h1 style="position: relative;width: 100%;float: left;display: block;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight:100;color:#cecece;font-size: 15px; margin: 0;text-align:center">S/. {{number_format($amount,2)}}</h1>
        </div>
        </div>

        </div>
    </div>
    <div style="position:fixed;display:block;width:100%;bottom:0px;">
    @if($verify == 0)
        <input class="" type="submit" name="pagar" value="Continuar con el pago" style="  width: 100%; height: 50px;border: none; background: #b10000; border-radius: 10px 10px 0px 0px;color: white;font-size: 17px;" />
        @else 
        <input style="background:#808080"  class="" type="submit" name="pagar" value="Pago Realizado" style="  width: 100%; height: 50px;border: none; background: #cacaca; border-radius: 10px 10px 0px 0px;color: white;font-size: 17px;"  disabled/>
        @endif
          </div>
</div>


</form>





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



</body>
</html>