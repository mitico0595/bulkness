<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        }
       .bag{
        width:33%;
        display:flex;
        flex-direction:column;
        border-radius:10px; 
       }
       h6{
        color:#808080;
       }
       input:focus {
        outline: none;
        }
        .usual-class{
            display:flex;
            align-items:center;
            justify-content:center;
        }
    </style>
</head>
<body>
<form action="{{route('adlerventa-mobile')}}" method="post"  >
    <div style="width:100%;position:fixed;height:100vh;">
        <div class="usual-class" style="flex-direction:column;">

            <div class="usual-class" style="flex-direction:row;height:5vh;background:linear-gradient(45deg, #b10000 0%,#e54c49 36%,#b10000 73%,#c22330 100%);width:90%;height:60px;margin-top:12px;border-radius:10px;">
                <div style="display:flex;align-items:center;flex-direction:row;height:4rem;padding:0px 10px;width:100%;">
                    <div style="display:flex;align-items:center;flex-direction:row;">
                        <div style="transition-duration: 0.1s;position:relative; width:90px;font-size:17px;font-family:sans-serif">
                           <a href="{{asset('/')}}"><img src="{{asset('image/logo1_BN.png')}}" class="logo1" style="width:100%;margin-top:7px;"></a> 
                        </div>
                        
                    </div>
                    <div style="display:flex;align-items:center;flex-direction:row;justify-content:flex-end;width:100%;">
                        <div style="">
                        <span class="material-symbols-outlined" style="color:white;font-size:25px;">menu</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="usual-class" style="flex-direction:column;height:95vh;width:100%;">
                <div class="usual-class" style="height:30vh;flex-direction:row;width:100%;">
                    <div class="usual-class" style="flex-direction:row;width:90%;background:#b10000;height:95%;border-radius:10px;">
                        <img src="{{asset('image/bagred.png')}}" alt="" style="width:40%;">
                        <div class="usual-class" style="flex-direction:column;width:40%;" >
                            <div style="display:flex;width:100%;align-items:center;justify-content:center;;height:35px;border-radius:5px;">
                                <h4 style="font-size:20px;margin-right:20px;color:white;font-weight:100" >S/. 59,90</h4>
                                <h6 style="text-decoration:line-through">S/. 89,90</h6>
                            </div>
                            <div style="display:flex;width:100%;align-items:center;justify-content:center;height:35px;border-radius:5px;margin-top:5px;">
                                <input  id="red" name="red" value="{{$red}} " style="text-align:center;color:white;background:#282828;width:100%;font-size:30px;border:none;background:none;appareance:none;font-weight:100">
                            </div>
                        </div>
                        <div class="usual-class" style="flex-direction:column;width:20%;" >
                            <div onclick="incrementar('red', 59.90)" style="border-radius:50px;display:flex;justify-content:center;align-items:center;width:40px;height:40px;background:white;cursor:pointer;"  >
                                <span class="material-symbols-outlined" style="color:white;display:flex;justify-content:center;align-items:center;background:#b10000;width:30px;height:30px;border-radius:20px;box-shadow:2px 2px 5px #282828;">add</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="usual-class" style="height:30vh;flex-direction:row;width:100%;">
                    <div class="usual-class" style="width:90%;background:#243cb1;height:95%;border-radius:10px;">
                        <img src="{{asset('image/bagblue.png')}}" alt="" style="width:40%;">
                        <div class="usual-class" style="flex-direction:column;width:60%;" >
                            <div style="display:flex;width:100%;align-items:center;justify-content:center;;height:35px;border-radius:5px;">
                                <h4 style="font-size:20px;margin-right:20px;color:white;font-weight:100" >S/. 59,90</h4>
                                <h6 style="text-decoration:line-through">S/. 89,90</h6>
                            </div>
                            <div style="display:flex;width:100%;align-items:center;justify-content:center;height:35px;border-radius:5px;margin-top:5px;">
                                <input  id="blue" name="blue" value="{{$blue}}" style="text-align:center;color:white;background:#282828;width:100%;font-size:30px;border:none;background:none;appareance:none;font-weight:100">
                            </div>
                        </div>
                        <div class="usual-class" style="flex-direction:column;width:20%;" >
                            <div onclick="incrementar('blue', 59.90)" style="border-radius:50px;display:flex;justify-content:center;align-items:center;width:40px;height:40px;background:white;cursor:pointer;"  >
                            <span class="material-symbols-outlined" style="color:white;display:flex;justify-content:center;align-items:center;background:#243cb1;width:30px;height:30px;border-radius:20px;box-shadow:2px 2px 5px #282828;">add</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="usual-class" style="height:30vh;flex-direction:row;width:100%;">
                    <div class="usual-class" style="width:90%;background:#282828;height:95%;border-radius:10px;">
                        <img src="{{asset('image/bagblack.png')}}" alt="" style="width:40%;">
                        <div class="usual-class" style="flex-direction:column;width:60%;" >
                            <div style="display:flex;width:100%;align-items:center;justify-content:center;;height:35px;border-radius:5px;">
                                <h4 style="font-size:20px;margin-right:20px;color:white;font-weight:100" >S/. 79,90</h4>
                                <h6 style="text-decoration:line-through">S/. 99,90</h6>
                            </div>
                            <div style="display:flex;width:100%;align-items:center;justify-content:center;height:35px;border-radius:5px;margin-top:5px;">
                                <input  id="black" name="black" value="{{$black}}" style="text-align:center;color:white;background:#282828;width:100%;font-size:30px;border:none;background:none;appareance:none;font-weight:100">
                            </div>
                        </div>
                        <div class="usual-class" style="flex-direction:column;width:20%;" >
                            <div onclick="incrementar('black', 79.90)" style="border-radius:50px;display:flex;justify-content:center;align-items:center;width:40px;height:40px;background:white;cursor:pointer;"  >
                                <span class="material-symbols-outlined" style="color:white;display:flex;justify-content:center;align-items:center;background:#282828;width:30px;height:30px;border-radius:20px;box-shadow:2px 2px 5px #282828;">add</span>
                            </div>
                        </div>
                    </div>                    
                </div>
                <div class="usual-class" style="height:10vh;flex-direction:row;width:100%;">
                    <div class="usual-class" style="height:50px;width:90%;border-radius:10px;background:#282828;margin-top:-35px;">
                        <div style="display:flex;flex-direction:column;justify-content:center;align-items:center">                                
                                <div class="usual-class" style="flex-direction:row">
                                    <h6>S/.</h6>
                                    <input id="total" value="0" style="text-align:center;color:white;background:#282828;width:50%;font-size:18px;border:none;background:none;appareance:none;width:50%">
                                </div>
                                <h5 style="color:white;font-weight:100;font-size:13px;color:#cecece">SUBTOTAL</h5>
                        </div>
                        {{ csrf_field() }}

                        <button id="botonContinuar" style="background:#b10000;padding:5px 20px;color:white;height: 100%;border: none;margin-right:3px;">Modificar</button>
                        <button id="botonContinuar" style="background:#b10000;padding:5px 20px;border-radius:5px;color:white;height: 100%;border: none;border-radius: 0px 10px 10px 0px;">Continuar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </form>
    <script>
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

            var valor = document.getElementById('total').value;
            var boton = document.getElementById('botonContinuar');
            
            if (valor === "0" || valor === "" || valor === "0.00" ) {
                boton.disabled = true;
                console.log(valor);
            } else {
                boton.disabled = false;
                console.log(valor);
        }
        }
        
        // Agregar evento 'input' a cada campo de cantidad
        document.getElementById('red').addEventListener('input', calcularTotal);
        document.getElementById('blue').addEventListener('input', calcularTotal);
        document.getElementById('black').addEventListener('input', calcularTotal);
        document.getElementById('total').addEventListener('input', calcularTotal);
        // Inicializar el cálculo del total al cargar la página
        window.onload = calcularTotal;
        
    </script>
    

    <script src="{{asset('js/kit.js')}} "></script>
</body>
</html>