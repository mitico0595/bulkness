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
                  <img src="{{asset('image/svg/arrow.svg')}} " class="logo1" style="width: 20px;"></a><h2 class="confirm">Relizando pago</h2>
    </div>
    
    
    

    <div class="mobile-product" style="margin-top:70px;">
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
                        <a href="{{route('product.reduceByOne',['id'=>$search['item']['id']])}}" class="less">-</a>
                        <div class="qtyty">{{$search['qty']}}</div>
                        <a href="{{route('product.addToCart',['id'=>$search['item']['id']])}}" class="plus">+</a>
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
            <span style="color:#808080">Detalles Pedido:</span> 
            <p class="nombre">{{Auth::user()->name}}</p>
            <p class="label">Fecha compra: {{$lol}}</p>
            <p class="numero">{{$purchaseNumber}} </p>
							
        </div>
    </div>
    <div class="address-content" style="margin-top: 10px;margin-bottom: 0px;">
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

    
    
    <!-- ------------------------------------------>
    <div class="address-content" style="margin-top:0px;margin-bottom:60px;">
        <input type="checkbox" name="ckbTerms" id="ckbTerms" onclick="visaNetEc3()"> <label for="ckbTerms">Acepto los <a href="#" target="_blank">Términos y condiciones</a></label>
        
        <form id="frmVisaNet" method="post" action=""  >               
            
        
            


        </form>   
    </div>
    <div style="position: fixed; bottom:0px;width: 100%;background: white;height: 50px;">
        <div style="color:black;position: relative;display: inline-block;float: left;margin-top: 15px;margin-left: 15px;"><span style="font-weight: bold;">PEN</span> S/. {{number_format($total,2)}} </div>
        {{ csrf_field() }}
        <a href="{{asset('pagos-mobile')}} " style="position:absolute; padding: 5px 10px; width: 200px;background: #b10000;color:white;right: 15px;top:10px;font-family: 'Kanit';text-align: center; " >
            Modificar Domicilio
        </a>
    </div>

    
    
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script>
    var frmVisa = document.getElementById('frmVisaNet');

if (document.body.contains(frmVisa)) {
    document.getElementById('frmVisaNet').setAttribute("style", "display:none");
}
function visaNetEc3() {
    if (document.getElementById('ckbTerms').checked) {
        document.getElementById('frmVisaNet').setAttribute("style", "display:auto");
    } else {
        document.getElementById('frmVisaNet').setAttribute("style", "display:none");
    }
}
</script>
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