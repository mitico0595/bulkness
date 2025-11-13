<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@include ('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/checkout-mobile.css')}} ">        
        <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
        
    </head>
<body>
	<div class="sticky-top" style="z-index: 99;">
        <a href="javascript: history.go(-1)" style="float:left;margin-top: 10px;margin-left: 20px;margin-right: 20px;">
                  <img src="{{asset('image/svg/arrow.svg')}} " class="logo1" style="width: 20px;"></a><h2 class="confirm">Confirmacion del pedido</h2>
    </div>
    <form action="{{url('pa-mobile')}}" method="post" id="checkout-form" style="">
        @csrf
    <div class="address-content">
        <div class="ubicacion-image">
            <img src="{{asset('image/svg/mapi.svg')}} " class="image-ub">
        </div>
        <div class="address-modify">
            <input type="text" name="name" value="{{Auth::user()->name}} {{Auth::user()->lastname}}" style="border:none" readonly id="namo">
            <input type="text" name="dni" value="{{Auth::user()->dni}}" style="border:none" readonly id="dnio">
            <input type="text" name="domicilio" value="{{Auth::user()->direccion}}" style="border:none;width: 80%;color:#808080" readonly id="diro">
            <input type="text" name="distrito" value="{{ Auth::user()->distrito}}" style="border:none;width: 80%;color:#808080;text-transform: uppercase;font-size: 10px;" readonly id="disto">
            <input type="text" name="provincia" value="{{ Auth::user()->provincia}}," style="border:none;width: 80%;color:#808080;text-transform: uppercase;font-size: 10px;display: block;position: relative;float: left;" readonly id="provo"> 
            <input type="text" name="ciudad" value=" {{ Auth::user()->ciudad}}" style="border:none;width: 80%;color:#000;text-transform: uppercase;font-size: 12px;display: block;position: relative;float: left;margin-left: -2px;margin-top:8px; font-weight: bold;" readonly id="ciuo">
            <input type="text" name="celular" value="{{Auth::user()->cell}}" style="border:none;width: 80%;color:#808080" readonly id="cello">
            <h4 style="position: absolute;text-transform: uppercase;position: absolute;bottom:0px;right:-20px;color:#5fbae8;" onclick="datadat()">Modificar</h4>
        </div>
    </div>
    

        @foreach ($searches as $search)
            <div class="each">
            <img src="{{asset('images/'.$search['item']['image'])}} " class="image-b">
            <div class="right-content">
                <div class="title-p">
                    <h4>{{$search['item']['name'] }}</h4>
                    <input type="number" name="idarticulo[]" value="{{$search['item']['id']}}" style="display: none;color:#fff" >
                    <input type="number" name="cantidad[]" value="{{$search['qty']}}" style="display: none;" >
                    <input type="number" name="precio_venta[]" value="{{$search['item']['precio']}}" style="display: none;" >
                </div>
                <div class="categoria">
                    <h5>{{$search['item']['categoria']}}</h5>
                </div>
                <div class="precio">
                    <h6> S/. {{$search['item']['precio']}} </h6>
                </div>
                <div class="subtotal">
                    <h6> SUB-TOTAL: S/. {{number_format($search['precio'],2)}} </h6>
                    <div class="command">
                        
                        <div class="qtyty">x{{$search['qty']}}</div>
                        
                    </div>
                </div>
                
            </div>
            </div>
        @endforeach
    </div>
    <div class="address-content" style="margin-top: 10px">
        <div class="ubicacion-image">
            <img src="{{asset('image/svg/edit.svg')}} " class="image-ub">
        </div>
        <div class="address-modify">
            <span style="color:#808080">Nota:</span> <input type="" name="nota" placeholder="Escribir nota para OBERLU" style="padding: 5px; margin-left: 10px;width: 100%;margin-top: 10px;border:none; border-bottom: 1px solid #282828;" autocomplete="off" value="{{$domil[0]->detalle ?? "--"}} ">            
        
        </div>
    </div>
    <div class="address-content" style="margin-top: 10px;margin-bottom: 60px;">
        <div class="ubicacion-image" style="width: 100%;">
            Resumen del pedido: ({{Session::has('cart') ? Session::get('cart')->totalQty : '0' }} artículos)
        </div>
        <div class="address-modify" style="width: 100%;display: inline-block;">
           <div class="detail-resume"  id="card-lima">
                <div class="left-resume">
                    <div class="">Total parcial:</div>
                    <div class="">Cargos 0.00%:</div>
                    <div class="">Envio:</div>
                    <div style="font-weight: bold;">Cantidad final:</div>
                </div>
                <div class="right-resume">
                    <div class="">S/. {{number_format($totalProduct,2)}}</div>
                    <div class="">S/. 0.00</div>
                    <div class="">S/. 10.00</div>
                    <div class="" style="font-weight: bold;">S/. {{number_format($total,2)}}</div>
                </div>
            </div>           
            
        </div>
        <div style="width:100%; padding:5px 10px;background: #e0e0e0; display: inline-block; font-size: 12px">
            Al hacer clic en PAGAR o HACER PEDIDO, confirmo haber leído <a href=""><span>los términos y condiciones</span></a>
        </div>
    </div>
    <!-- DATA SENDE----------------------------------------->

    <div style="height: 100vh;background: white;width: 100%;position: fixed;z-index: 99;top:0px;left: 0px;display: none" id="data-send">
        <div class="sticky-top" style="z-index: 99;">
        <h2 class="confirm">Editar Direccion</h2>
        </div>
        <div style="width: 90%;position: relative;margin: auto;display: block;padding: 10px;margin-top: 50px;">
        <div style="width: 100%;position: relative;margin-top: 50px;">
            <input type="text"  value="{{Auth::user()->name}} {{Auth::user()->lastname}}" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;"  onchange="namefunc()" id="namesub" >
            <input type="text"  value="{{Auth::user()->dni}}" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px"  onchange="dnifunc()" id="dnisub" >
            <input type="text" name="celular" value="{{Auth::user()->cell}} " style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px;"  onchange="cellfunc()" id="cellsub" >
            <input type="text" name="domicilio" value="{{Auth::user()->direccion}} " style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px;"  onchange="dirfunc()" id="dirsub" >
            <input type="text"  value="" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px;"  onchange="distfunc()" id="distsub" placeholder="Distrito" >
            <input type="text"  value="" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px;"  onchange="provfunc()" id="provsub" placeholder="Provincia" >
            <input type="text"  value="" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 20px;"  onchange="ciufunc()" id="ciusub" placeholder="Departamento" >
            <input type="text" name="referencia" value="" style="border:none;border-bottom: 1px solid #808080; padding-bottom: 10px; width: 100%;font-size: 15px;margin-top: 40px;"   placeholder="Referencia" >
        
        </div>
        </div>

        <h5 style="position: absolute;bottom:50px; width: 80%;left:10%;padding: 10px;text-align: center; font-size: 20px;background: #282828;border-radius: 10px; color: #fff;" onclick="closedata()">Guardar</h5>
    </div>
    
    <!-- ------------------------------------------>

    <div style="position: fixed; bottom:0px;width: 100%;background: white;height: 50px;">
        <div style="color:black;position: relative;display: inline-block;float: left;margin-top: 15px;margin-left: 15px;"><span style="font-weight: bold;">PEN</span> S/. {{number_format($total,2)}} </div>
        
        <button type="submit" style="position:absolute; padding: 5px 10px; width: 150px;background: #b10000;color:white;right: 15px;top:10px;font-family: 'Kanit';text-align: center; " >
            Guardar y pagar
        </button>
    </div>

    </form>
    <script src="{{asset('js/jquery.min.js')}} "></script>
    <script src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        function namefunc(){
            document.getElementById('namo').value = document.getElementById('namesub').value;
        }
        function dnifunc(){
            document.getElementById('dnio').value = document.getElementById('dnisub').value;
        }
        function cellfunc(){
            document.getElementById('cello').value = document.getElementById('cellsub').value;
        }
        function dirfunc(){
            document.getElementById('diro').value = document.getElementById('dirsub').value;
        }
        function distfunc(){
            document.getElementById('disto').value = document.getElementById('distsub').value;
        }
        function provfunc(){
            document.getElementById('provo').value = document.getElementById('provsub').value;
        }
        function ciufunc(){
            document.getElementById('ciuo').value = document.getElementById('ciusub').value;
        }
        function datadat(){
            document.getElementById('data-send').style.display= "block";
        }
        function closedata(){
            document.getElementById('data-send').style.display= "none";
        }
        function datacard(){
            document.getElementById('card-send').style.display= "none";
            document.getElementById('pay-ss').style.display= "block";
        }
        function showcard(){
            document.getElementById('card-send').style.display= "block";
        }
    </script>
   
</body>
</html>