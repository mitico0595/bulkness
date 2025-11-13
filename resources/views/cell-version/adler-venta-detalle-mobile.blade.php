<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include ('global.icon')
    <script src="https://oberlu.com/js/splide.js"></script>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    
    
    <link rel="stylesheet" href="{{asset('css/adler.css')}}">
    <style>
        body{
            background:#ededed;
            user-select: none;
            
        }
        *{
            box-sizing:border-box;
            margin:0;
            padding:0;
            font-weight:100;
            text-decoration:none;
        }
        
       .bags{
        width:100%;
        display:flex;
        flex-direction:column;
        border-radius:10px; 
       }
       .detalle{
        width:34%;
        display:flex;
        flex-direction:column;
        border-radius:10px; 
        padding:10px;
        color:white;
       }
       h6{
        color:#808080;
       }
       input:focus {
        outline: none;
        }
        .row{
            display:flex;
            flex-direction:row;
            align-items:center;
            justify-content:space-between;
        }
        .column{
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }
        .usual-class{
            display:flex;
            align-items:center;
            justify-content:center;
        }
        
    </style>
</head>
<body>
    <nav style="width:90%;margin:auto;height:70px;position:fixed;z-index:9999;left:5%">
            <div class="usual-class" style="flex-direction:row;height:5vh;background:linear-gradient(45deg, #b10000 0%,#e54c49 36%,#b10000 73%,#c22330 100%);width:100%;height:60px;margin-top:12px;border-radius:10px;">
                <div style="display:flex;align-items:center;flex-direction:row;height:4rem;padding:0px 10px;width:100%;">
                    <div style="display:flex;align-items:center;flex-direction:row;">
                        <div style="transition-duration: 0.1s;position:relative; width:90px;font-size:17px;font-family:sans-serif">
                           <a href="{{asset('/')}}"><img src="{{asset('image/logo1_BN.png')}}" class="logo1" style="width:100%;margin-top:7px;"></a> 
                        </div>
                        
                    </div>
                    <div style="display:flex;align-items:center;flex-direction:row;justify-content:flex-end;width:100%;">
                        <div style="">
                            <span id="menudetalle" class="material-symbols-outlined" style="color:white;font-size:25px;" onclick="detallecompra()">menu</span>
                            <span id="closedetalle" class="material-symbols-outlined" style="color:white;font-size:25px;display:none" onclick="closedetalle()">close</span>
                        </div>
                    </div>
                </div>
            </div>
        
    </nav>
    <form action="{{route('adler-venta-detalle')}}" method="post"  > 
    <div style="width:100%;padding:1rem;margin:auto;position;relative;margin-bottom:70px;padding-top:70px;">
        <div style="display:flex;flex-direction:row;width:100%;justify-content:center;gap:0.8rem;border-radius:10px;">
            <div class="bags" style="position:relative;padding:10px;display:flex;flex-direction:column;gap:15px;">
            <!--- PRODUCTO FOREACH -->
        
            @foreach ($items as $tipo => $detalles)
            
            <div style="display:flex;flex-direction:column;gap:5px;width:100%;background:white;border-radius:10px;padding:5px;box-shadow:2px 2px 5px #282828">
                @foreach ($detalles as $id => $detalle)
                @php
                    $colorFondo = '';
                    
                    if ($id == 1) {
                        $colorFondo = '#b10000';
                    } elseif ($id == 2) {
                        $colorFondo = '#243cb1';
                    } elseif ($id == 3) {
                        $colorFondo = '#282828';
                    }
                    
                @endphp 
               
                <!--- MOCHILA PRODUCTO FOREACH -->
                @if ($id>= 1 && $id<= 5)
                    <div style="display:flex;flex-direction:row;gap:0.8rem;width:100%;background:white;padding:5px;border-radius:5px;justify-content:space-between;">
                        <div style="display:flex;flex-direction:row;gap:0.8rem;width:70%"> 
                            <img src="{{asset('/image/thumb/bag/'.$detalle['item']->image)}}" alt="" style="width:40%">
                            <div style="display:flex;flex-direction:column;width:60%;" >
                                <h3 style="width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:13px;">{{$detalle['item']->name}} </h3>
                                <h5 style="font-size:10px;">{{$detalle['item']->categoria}}</h5>
                            </div>
                        </div>
                        <div style="display:flex;flex-direction:row;justify-content:center;align-items:center;gap:5px;width:30%;">                            
                            <div style=" display:flex;flex-direction:column;background:{{ $colorFondo }};padding:5px;text-align:center;border-radius:5px;width:80%">
                                <h3 style="color:white;font-size:10px;">S/. {{ number_format($totalesPorGrupo[$tipo], 2) }}</h3>
                                <h6 style="color:white;font-size:9px">SUBTOTAL</h6>
                            </div>
                            <div style="display:flex;flex-direction:column;justify-content:center;align-items:center;gap:5px;">
                                <div onclick="ventana({{ $tipo }})" style="background:{{ $colorFondo }};cursor:pointer;border-radius:5px;align-items:center;text-align:center;display:flex;justify-content:center;color:white;box-shadow:2px 2px 3px #282828;padding:3px;font-size:18px;"><span class="material-symbols-outlined">add</span></div>
                                <div onclick="toggleElement({{ $tipo }})" style="background:#282828;cursor:pointer;border-radius:5px;align-items:center;text-align:center;display:flex;justify-content:center;color:white;box-shadow:2px 2px 3px #282828;padding:3px;font-size:18px">
                                    <span id="menu{{ $tipo}}" class="material-symbols-outlined">menu</span>
                                    <span id="remove{{ $tipo}}" class="material-symbols-outlined" style="display:none;">remove</span>
                                </div>
                                
                            </div> 
                        </div>
                         
                    </div>
                @endif
                <!--- endFOREACH -->
                @if ($id>= 10 && $id< 20)    
                <!--- PAQUETE PRODUCTO FOREACH -->
               
                    <div style="display:flex;flex-direction:row;gap:0.8rem;width:100%;border:1px solid white;padding:5px;border-radius:5px;justify-content:space-between;border: 1px solid #282828;border-radius:5px;">
                        <div style="display:flex;flex-direction:row;gap:0.8rem;width:60%;">
                            <img src="{{asset('/image/thumb/bag/red.png')}}" alt="">
                            <div style="display:flex;flex-direction:column;">
                                <h3 style="width:100px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#282828;text-transform:uppercase;font-size:13px; ">{{$detalle['item']->name}}</h3>
                                <h5 style="color:#cecece;font-size:10px;">Paquete emergencia</h5>
                            </div>
                        </div>
                        <div style="display:flex;flex-direction:row;justify-content:center;align-items:center;gap:5px;width:40%;">                            
                            <div style=" display:flex;flex-direction:column;background:white;text-align:center;border-radius:5px;width:80%;">
                                <h3  style="font-size:13px;">S/. {{$detalle['item']->precio}}</h3>
                                <h6 style="font-size:10px;">PRECIO</h6>
                            </div>
                            <div style="display:flex;flex-direction:column;justify-content:center;align-items:center;gap:5px;">
                                <a href="{{ route('eliminar', ['ids'=>$tipo, 'idarticulo'=>$id]) }} "><div style="background:#282828;cursor:pointer;border-radius:5px;align-items:center;text-align:center;display:flex;justify-content:center;color:white;box-shadow:2px 2px 3px #282828;padding:3px;font-size:18px"><span class="material-symbols-outlined">close</span></div></a> 
                                
                            </div> 
                        </div>
                    </div>
                @endif
                <!--- endFOREACH -->

                <!--- ARTICULO PRODUCTO FOREACH -->
                
                <!--- endFOREACH -->
                @endforeach
                @php
                    $mostrarDiv = false;
                    foreach ($detalles as $id => $detalle) {
                        if ($id >= 20) {
                            $mostrarDiv = true;
                            break; // Salir del bucle una vez que se encuentra un elemento correspondiente
                        }
                    }
                @endphp
                    <div id="miElemento{{$tipo}}"  style="display:{{ $mostrarDiv ? 'flex' : 'none' }};gap:0.8rem;width:100%;border:1px solid white;padding:10px;border-radius:5px;justify-content:space-between;background:#282828;flex-wrap:wrap;flex-direction:row">
                    @foreach ($detalles as $id => $detalle)
                    @if ($id>= 20)    
                    
                        
                    
                        <div style="width:47.5%;background:white;border-radius:5px;padding:10px;position:relative">
                            <div style="display:flex;flex-direction:row;gap:5px;width:100%;">
                                <img src="https://farmaciauniversal.com/assets/sources/PRODUCTOS/17423-Alcohol-Medicinal-70%C2%B0_120ml-farmacia-universal.jpg" alt="" style="width:25%;">
                                <div style="display:flex;flex-direction:column;width:75%;" >
                                    <h3 style="width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#282828;font-size:12px;">{{$detalle['item']->name}}</h3>
                                    <h5>S/. {{$detalle['item']->precio}}</h5>
                                </div>
                            </div>
                            <div style="display:flex;flex-direction:row;justify-content:center;align-items:center;gap:5px;">                            
                                
                                   <a href="{{route('disminuirarticulo',['ids'=>$tipo,'idarticulo'=>$id])}}" style="display:flex"><span class="material-symbols-outlined" style="background:#282828;border-radius:25px;color:white;font-size:20px;">remove</span></a>
                                    <div style="width: 20px;text-align: center; border: none; font-size: 18px;">{{$detalle['qty']}}</div>
                                   <a href="{{ route('agregararticulo',['ids'=>$tipo,'idarticulo'=>$id])}}" style="display:flex"><span class="material-symbols-outlined" style="background:#282828;border-radius:25px;color:white;font-size:20px;">add</span></a>
                                    
                                   
                            </div>
                            <a href="{{route('eliminar',['ids'=>$tipo,'idarticulo'=>$id])}} " style="position:absolute;right:0;bottom:0;color:#282828;text-decoration:none;"><span class="material-symbols-outlined">delete</span></a>
                        </div>
                        
                    @endif
                    @endforeach
                    </div>
                  

                </div>

<!---MODAL --->
                <div id="modal{{$tipo}}" style="position:fixed;overflow:hidden;width:100%;height:100vh;background:rgba(0,0,0,.5);top:-2000px;left:0px;z-index:999;opacity:0;transition: opacity 400ms ease-in;backdrop-filter:blur(5px)">
                    <div style="display:flex;align-items:center;justify-content:center;flex-direction:row;height:100vh;backdrop-filter:blur(5px)">
                        <div style="display:flex;background:white;width:90%;height:80%;border-radius:10px;flex-direction:column;transition: all 500ms ease-in;">
                            
                            
                            <div style="position:relative;border-radius:5px;padding:15px;,margin-top:15px;">
                                <span onclick="cerrarmodal({{$tipo}})" class="material-symbols-outlined" style="cursor:pointer;color:black;position:absolute;right:0px;top:5px;">close</span>
                                <div style="display:flex;flex-direction:row;flex-wrap:wrap;width:100%;justify-content:center;align-items:center;border-radius:5px;background:white;">
                                <!--- MODAL PAQUETES FOREACH -->
                                @foreach($paquetes as $paquete)
                                  <a href="{{ route('paquete', ['ids' => $tipo, 'idarticulo' => $paquete->id]) }}" style="width:49%;"  ><div id="miEle" onmouseover="cambiarFondo(this, '#c6c6c6')" onmouseout="cambiar(this, 'white')" class="column" style="width:100%;padding:10px;border-radius:10px;">
                                        <img src="https://farmaciauniversal.com/assets/sources/PRODUCTOS/17423-Alcohol-Medicinal-70%C2%B0_120ml-farmacia-universal.jpg" alt="" style="width:100%;border-radius:10px;">
                                        <h3 style="text-align:center;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#b10000;width:80%;text-transform:uppercase;font-size:13px;">{{$paquete->name}} </h3>
                                        <div style="display:flex;width:75%;align-items:center;justify-content:center;height:35px;flex-direction:column;">
                                            <h6 style="text-decoration:line-through">S/. {{$paquete->preciof}}</h6>
                                            <h4 style="font-size:17px;font-weight:bold;color:#b10000">S/. {{$paquete->precio}}</h4>
                                            
                                        </div>
                                    </div> 
                                    </a> 
                                @endforeach
                                 <!--- endFOREACH -->   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!---end MODAL --->
<!---MODAL ARTICULO--->
                <div id="articulo{{$tipo}}" style="position:fixed;overflow:hidden;width:100%;height:100vh;background:rgba(0,0,0,.5);top:-2000px;left:0px;z-index:999;opacity:0;transition: opacity 400ms ease-in;backdrop-filter:blur(5px)">
                    <div style="display:flex;align-items:center;justify-content:center;flex-direction:row;height:100vh;">
                        <div style="display:flex;background:white;width:80%;max-width:1000px;border-radius:10px;flex-direction:column;transition: all 500ms ease-in;height:80%">
                            
                            
                            <div style="position:relative;border-radius:5px;padding:15px;,margin-top:15px;height:90%;overflow:auto;">
                                <span onclick="cerrararticulo({{$tipo}})" class="material-symbols-outlined" style="cursor:pointer;color:black;position:absolute;right:0px;top:5px;">close</span>
                                <div style="display:flex;flex-direction:row;flex-wrap:wrap;width:100%;justify-content:center;align-items:center;border-radius:5px;background:white;">
                                <!--- MODAL PAQUETES FOREACH -->
                                @foreach($articulos as $paquete)
                                  <a href="{{ route('paquete', ['ids' => $tipo, 'idarticulo' => $paquete->id]) }}" style="width:49%;"  ><div id="miEle" onmouseover="cambiarFondo(this, '#c6c6c6')" onmouseout="cambiar(this, 'white')" class="column" style="width:100%;padding:10px;border-radius:10px;">
                                        <img src="https://farmaciauniversal.com/assets/sources/PRODUCTOS/17423-Alcohol-Medicinal-70%C2%B0_120ml-farmacia-universal.jpg" alt="" style="width:100%;border-radius:10px;">
                                        <h3 style="text-align:center;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#b10000;width:80%;text-transform:uppercase;font-size:12px;">{{$paquete->name}} </h3>
                                        <div style="display:flex;width:75%;align-items:center;justify-content:center;height:35px;flex-direction:column;">
                                            <h6 style="text-decoration:line-through">S/. {{$paquete->preciof}}</h6>
                                            <h4 style="font-size:17px;font-weight:bold;color:#b10000">S/. {{$paquete->precio}}</h4>
                                            
                                        </div>
                                    </div> 
                                    </a> 
                                @endforeach
                                
                                
                               
                                
                            </var>
                                 <!--- endFOREACH -->   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<!---end MODAL --->
<!---MODAL VENTANA--->
                <div id="ventana{{$tipo}}" style="position:fixed;overflow:hidden;width:100%;height:100vh;background:rgba(0,0,0,.5);top:-2000px;left:0px;z-index:999;opacity:0;transition: opacity 400ms ease-in;backdrop-filter:blur(5px)">
                                    <div style="display:flex;align-items:center;justify-content:center;flex-direction:row;height:100vh;">
                                        <div style="display:flex;background:white;max-width:1000px;border-radius:10px;flex-direction:column;transition: all 500ms ease-in;padding:10px;">
                                            <span onclick="cerrarventana({{$tipo}})" class="material-symbols-outlined" style="cursor:pointer;display:flex;justify-content:flex-end;">close</span>
                                            <div class="row" style="padding:10px;justify-content:center;gap:15px;">
                                                <div onclick="abrirarticulo({{$tipo}})" style="background:#b10000;color:white;padding:10px;border-radius:5px;width:150px;text-align:center;cursor:pointer;">Agregar articulo</div>
                                                <div onclick="abrirmodal({{$tipo}})" style="background:#b10000;color:white;padding:10px;border-radius:5px;width:150px;text-align:center;cursor:pointer;">Agregar Kit</div>     
                                            </div>                            
                                        </div>
                                    </div>
                </div>
                <!---end MODAL --->                
            @endforeach
              <!--- endFOREACH --> 

              
        </div>   

            
    </div>




        
    </div>

    </form>
    <div style="position:fixed;width:100%;height:70px;bottom:0px;">
        <div class="usual-class" style="width:100%;flex-direction:row;height:100%;">
            <div class="usual-class" style="width:90%;height:35px;flex-direction:row;background:#b10000;border-radius:10px;">
                <a href=" {{asset('adler-venta-mobile')}}" class="usual-class" style="text-align:center;width:50%;color:white;height:100%;background:#282828;border-radius:10px 0px 0px 10px;">Modificar</a>
                <div class="usual-class" style="text-align:center;width:50%;color:white;height:100%;" onclick="detallecompra()">Continuar</div>
            </div>
        </div>
    </div>  
    <div id="detalle-compra" style="position:fixed; width:100%;height:100vh;    background: rgba(192,70,60,.9);backdrop-filter: blur(5px);top:0px;display:none;">
                <div class="usual-class" style="flex-direction:column;;border-radius:10px;padding:10px;padding-bottom:20px;margin-top:100px;" >
                    <h4 style="width:80%;color:white">Resumen de compra:</h4>
                    <div class="row" style="width:80%;position:relative;margin:auto;color:#808080;color:#cecece;">
                        <h5>Cantidad de productos:</h5>
                        <h5>{{$productos}} </h5>
                    </div>
                    <div class="row" style="width:80%;position:relative;margin:auto;color:#808080;color:#cecece;">
                        <h5>Mochilas:</h5>
                        <h5>S/. {{ number_format($totalmochila, 2) }}</h5>
                    </div>
                    <div class="row" style="width:80%;position:relative;margin:auto;color:#808080;color:#cecece;">
                        <h5>Kits:</h5>
                        <h5>S/. {{ number_format($totalkit, 2) }}</h5>
                    </div>
                    <div class="row" style="width:80%;position:relative;margin:auto;color:#808080;color:#cecece;">
                        <h5>Articulos:</h5>
                        <h5>S/. {{ number_format($totalarticulo, 2) }}</h5>
                    </div>
                    <div class="row" style="width:80%;position:relative;margin:auto;color:#808080;border:1px solid white;padding:3px;border-radius:3px;color:#cecece;">
                        <h5>Descuento:</h5>
                        <h5>S/. 0.00</h5>
                    </div>
                    <div class="row" style="width:80%;position:relative;margin:auto;color:#808080;background:white;padding:3px;border-radius:3px;margin-top:5px;color:#b10000;font-weight:bold;">
                        <h5 style="font-weight:bold;">Total:</h5>
                        <h5 style="font-weight:bold;">S/. {{ number_format($total,2)}} </h5>
                    </div>
                    <div id ="cargo_precio" class="row" style="width:80%;position:relative;margin:auto;color:white;background:#b10000;padding:3px;border-radius:3px;margin-top:5px;color:#cecece;">
                        <h5>Envio:</h5>
                        <h5>S/. {{ number_format(10,2)}} </h5>
                    </div>
                    <label id="backA" style="padding:10px 10px;border: 1px solid #b10000;border-radius:5px;font-size:15px;display:flex;align-items:center;cursor:pointer;margin-top:10px;">
                                        <input type="checkbox" id="envioCheck" style="align-self: stretch;color:#b10000;border:none;">
                                        <span class="material-symbols-outlined" id="local_shipping" style="margin-left:15px;color:#b10000;font-weight:100">local_shipping</span>
                                        <span id="envio" style="margin-left:15px;color:#b10000;" >Envío Nacional</span>
                                        
                    </label>
                                         
                </div>
                <div style="position:absolute;display:block;bottom:0px;width:100%;height:200px">
                    <div class="usual-class">
                        <a href="" style="position: relative;display: block;margin: auto;border:none;color:#fff;border-radius: 50px;cursor: pointer;text-align: center;font-size:14px;background:#b10000;padding:10px" id="botonB">Realizar pago</a>
                        
                        <a href="" style="position: relative;display: none;margin: auto;border:none;color:#fff;border-radius: 50px;cursor: pointer;text-align: center;font-size:14px;background:#b10000;padding:10px" id="botonA">Ingresar datos de envio</a>

                    </div>
                
                </div> 
                
    </div>              
    <script>
        function detallecompra(){
            document.getElementById("detalle-compra").style.display ="block";
            document.getElementById("closedetalle").style.display ="block";
            document.getElementById("menudetalle").style.display ="none";
        }
        function closedetalle(){
            document.getElementById("detalle-compra").style.display ="none";
            document.getElementById("closedetalle").style.display ="none";
            document.getElementById("menudetalle").style.display ="block";
        }
        function plus(){
            document.getElementById("plus").style.rotate ="360deg";
            document.getElementById("plus").style.scale ="1.3";
        }
        function plusout(){
            document.getElementById("plus").style.rotate ="0deg";
            document.getElementById("plus").style.scale ="1";
        }
        function plusb(){
            document.getElementById("plusb").style.rotate ="360deg";
            document.getElementById("plusb").style.scale ="1.3";
        }
        function plusoutb(){
            document.getElementById("plusb").style.rotate ="0deg";
            document.getElementById("plusb").style.scale ="1";
        }
        function black(){
            document.getElementById("plusbl").style.rotate ="360deg";
            document.getElementById("plusbl").style.scale ="1.3";
        }
        function blackout(){
            document.getElementById("plusbl").style.rotate ="0deg";
            document.getElementById("plusbl").style.scale ="1";
        }
        
            // Función para verificar si la entrada es numérica
        function soloNumeros(event) {
            // Expresión regular que coincide solo con números
            var regex = /^[0-9]*$/;
            
            // Verificar si la tecla presionada es numérica
            if (!regex.test(event.key)) {
                // Prevenir la entrada si no es numérica
                event.preventDefault();
            }
        }

        // Obtener todos los elementos input
        var inputs = document.querySelectorAll('input');

        // Asignar el controlador de eventos a cada input
        inputs.forEach(function(input) {
            input.addEventListener('keypress', soloNumeros);
        });


       
        //funcion total
        function incrementar(idProducto, precio) {
        var inputProducto = document.getElementById(idProducto);
        var valorActual = parseInt(inputProducto.value) || 0; // Obtiene el valor actual y asegura que sea numérico
        
        inputProducto.value = valorActual + 1;
        calcularTotal();
        }

        function calcularTotal() {
            var total = 0;
            total += document.getElementById('red').value * 59.90;
            total += document.getElementById('blue').value * 59.90;
            total += document.getElementById('black').value * 79.90;
            
            document.getElementById('total').value = total.toFixed(2);
        }
        
        // Agregar evento 'input' a cada campo de cantidad
        document.getElementById('red').addEventListener('input', calcularTotal);
        document.getElementById('blue').addEventListener('input', calcularTotal);
        document.getElementById('black').addEventListener('input', calcularTotal);
        document.getElementById('total').addEventListener('input', calcularTotal);
        // Inicializar el cálculo del total al cargar la página //
        window.onload = calcularTotal;

        function toggleElement(index) {
            var elemento = document.getElementById("miElemento" + index);
            var menu = document.getElementById("menu" + index);
            var remove = document.getElementById("remove" + index);
            if (window.getComputedStyle(elemento).display === "none") {
                elemento.style.display = "flex";
                menu.style.display = "none";
                remove.style.display = "block";
                
            } else {
                elemento.style.display = "none";
                menu.style.display = "block";
                remove.style.display = "none";
            }
        }

        function cambiarFondo(elemento, color) {
            elemento.style.backgroundColor = color;
        }
        function cambiar(elemento, color) {
            elemento.style.backgroundColor = color;
        }

        //modal
        function abrirmodal(index) {
            var elemento = document.getElementById("modal" + index);
            
            elemento.style.top = '0px';
            elemento.style.opacity = '1';
            cerrarventana(index);
        }
        

        function cerrarmodal(index) {
            var elemento = document.getElementById("modal" + index);
            
            elemento.style.top = '-10000px';
            elemento.style.opacity = '0';
        }
        //MODAL ARTICULO
        function abrirarticulo(index) {
            var elemento = document.getElementById("articulo" + index);
            
            elemento.style.top = '0px';
            elemento.style.opacity = '1';
            cerrarventana(index);
        }
        function cerrararticulo(index) {
            var elemento = document.getElementById("articulo" + index);
            
            elemento.style.top = '-10000px';
            elemento.style.opacity = '0';
        }
        function ventana(index) {
            var elemento = document.getElementById("ventana" + index);
            
            elemento.style.top = '0px';
            elemento.style.opacity = '1';
        }
        function cerrarventana(index) {
            var elemento = document.getElementById("ventana" + index);
            
            elemento.style.top = '-10000px';
            elemento.style.opacity = '0';
        }


    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var envioCheck = document.getElementById('envioCheck');
    var pagoTarjetaCheck = document.getElementById('pagoTarjetaCheck');
    var botonA = document.getElementById('botonA');
    var botonB = document.getElementById('botonB');
    
    
    var backA = document.getElementById('backA');
    

    var cargo = document.getElementById('cargo_precio');
    

    function actualizarBotones() {
        if (envioCheck.checked) {
            
            // Solo está seleccionado el envío, mostrar botón A
            botonA.style.display = 'block';
            botonB.style.display = 'none';
            
            cargo.style.display = 'flex';
            

            backA.style.background = '#b10000';
            
            document.getElementById('envio').style.color= 'white' ;

            
            
            

        } else {
            // Ningún checkbox está seleccionado, no mostrar botones
            botonA.style.display = 'none';
            botonB.style.display = 'block';
            
            cargo.style.display = 'none';
            

            
            
            

            backA.style.background = 'white';
            document.getElementById('envio').style.color= '#b10000';
            
        }
    }

    // Event listeners para los checkboxes
    envioCheck.addEventListener('change', actualizarBotones);
    

    // Actualizar botones al cargar la página
    actualizarBotones();
});

</script>
    <script src="{{asset('js/kit.js')}} "></script>

    
</body>
</html>





