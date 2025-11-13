<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oberlu</title>
    <script src="https://oberlu.com/js/splide.js"></script>
    <link rel="stylesheet" href="https://oberlu.com/css/splide.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <title>@include ('title')</title>
    @include ('logo')
    <link rel="stylesheet" href="{{asset('css/mobile.css')}} ">
    <link rel="stylesheet" href="{{asset('css/lightslider.css')}}">
      <link rel="stylesheet" href="{{asset('css/materialize.css')}} ">
    <link rel="stylesheet" href="{{asset('css/glider.css')}} ">
      <link rel="stylesheet" href="{{asset('css/footer.css')}} ">
      <link rel="stylesheet" href="{{asset('css/splide.min.css')}} ">
    <style>
        *{
            margin:0px;
            
            font-weight: 100;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
        }
        input:focus-visible{
            outline:none;
        }
        body{
            background:white;
        }
        .allforall{
            position: fixed;
            bottom: 0px;
            width: 100%;
            height: 54px;
            background: #fff;
            box-shadow: 1px -2px 5px #cecece;
            z-index: 99999;
        }
        .suball{
            position: relative;
            width: 85%;
            display: block;
            margin: auto;
            height: 100%;
        }
        .subbase{
            position: relative;
            float: left;
            box-sizing: border-box;
            width: 25%;
            min-width: 50px;
        }
        .usuario{
            width: 25px;
            position: relative;
            margin: auto;
            display: block;
            margin-top: 10px;
        }
        .subbase h6{
            font-size: 12px;
            color: #000;
            font-weight: 100;
            float: left;
            position: absolute;
            top: 35px;
            font-family: 'Kanit';
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    
    
    <div style="width:100%;position:relative;height:4rem">
        <div style="position:fixed;top:0px;width:100%;z-index:999;background:white">
        <div style="display:flex;align-items:center;flex-direction:row;height:4rem;padding:0px 10px">
            <div style="display:flex;align-items:center;flex-direction:row;">
                <div onclick="inicio()" id="iniciot" style="transition-duration: 0.1s;position:relative; width:90px;font-size:17px;font-family:sans-serif;border-bottom: 2px solid #b10000">
                    <img src="https://oberlu.com/image/oberlu_logo.png " class="logo1" style="width:100%;">
                </div>
                <div onclick="explorar()" id="explorart" style="transition-duration: 0.1s;margin-left:10px;text-align:center;position:relative; width:100px;font-size:17px;font-family:sans-serif">Explorar</div>
            </div>
            <div style="display:flex;align-items:center;flex-direction:row;justify-content:flex-end;width:100%;">
                <div style="">
                    <img src="{{ asset('image/svg/ubicacion.svg') }}" alt="" style="width:25px">
                </div>
            </div>
        </div>
        <div style="position:relative;height:4rem;width:100%;">
            <div style="position:relative;margin:auto;width:95%;height:4rem;align-items:center;display:flex">
                <div style="width:100%;border-radius:50px;border:2px solid black;height:50px;display:flex;align-items:center;">
                    <input type="text" style="width:100%;padding:10px;border:none;background:none;font-size:16px">
                    <div class="buttoni">
                        <button type="submit" class="btn" style="margin-right:2px;border:none;background:black;height:40px;cursor:pointer;border-radius:0px 20px 20px 0px">
                            <span class="material-icons" style="color:#fff;font-size: 18px;">search</span>
                        </button>

                    </div>
                </div>
            </div>
        </div>
        </div>

        <div id="oberlu" style="margin-top:150px;">
        <div style="margin-top:15px;">
            <div class="splide" role="group" aria-label="Splide Basic HTML Example">
                <div class="splide__track" >
                      <ul class="splide__list"  >
                        <li class="splide__slide" style="padding-left:5px;padding-right:5px">
                            <img src="{{ asset('image/berlu.jpg')}} " style="width:100%;box-sizing:border-box;border-radius:10px">
                          </li>  
                          <li class="splide__slide" style="padding-left:5px;padding-right:5px">
                            <img src="{{ asset('image/wiz.jpg')}} " style="width:100%;box-sizing:border-box;border-radius:10px">
                          </li>    
                          <li class="splide__slide" style="padding-left:5px;padding-right:5px">
                            <img src="{{ asset('image/izi.jpg')}} " style="width:100%;box-sizing:border-box;border-radius:10px;">
                          </li>  
                                                
                      </ul>
                </div>
              </div>
        </div>
        
        
        <div style="width:100%;position:relative;display:inline-block;margin-top:20px;background:#ededed;padding-bottom:65px;">
            <div style="margin-left:2.5%;margin-top:15px;font-weight:bold;margin-bottom:15px;">Te va a gustar</div>
            <div style="width:95%;margin:auto;background:black;">
                <div style="margin-top:7px;width:48%;position:relative;display:inline-block;float:left;margin-left:1%;border-radius:10px;background:white">
                    <img src="https://oberlu.com/images/1658787361_samsung.jpg" alt="" style="width:100%;border-radius:10px">
                    <div style="padding:0 10px 10px">
                        <div style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; height: 28px;line-height: 14px;font-size: 10px;color: #666;margin: 4px 0;">
                            RAM DDR4 Samsung 3200Mhz
                        </div>
                        <div style="display:flex;align-items:center;">
                           <div style="font-size:16px;font-weight:bold;font-style:italic">S/. 1500.00</div>
                           <div style="margin-left:20px;text-decoration:line-through;font-size:11px;justify-content:center;color:#a7a7a7;align-text:center">S/. 599.00</div>
                        </div>
                        <div style="color:#666;font-size:12px;margin-bottom:8px">Stock</div>
                        <div style="position:absolute;right:10px;bottom:5px;display:flex;justify-content:flex-end;align-items:center">
                            <div style="color:blue;font-size:12px;border: 1px solid blue;padding:1px 5px;border-radius:3px">Oferta</div>
                            <div style="color:#b10000;font-size:12px;border: 1px solid #b10000;padding:1px 5px;border-radius:3px;margin-left:5px;">Preventa</div>
                        </div>
                        
                    </div>
                </div>
                <div style="margin-top:7px;width:48%;position:relative;display:inline-block;float:left;margin-left:1%;border-radius:10px;background:white">
                    <img src="https://oberlu.com/images/1658787361_samsung.jpg" alt="" style="width:100%;border-radius:10px">
                    <div style="padding:0 10px 10px">
                        <div style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; height: 28px;line-height: 14px;font-size: 10px;color: #666;margin: 4px 0;">
                            RAM DDR4 Samsung 3200Mhz
                        </div>
                        <div style="display:flex;align-items:center;">
                           <div style="font-size:16px;font-weight:bold;font-style:italic">S/. 1500.00</div>
                           <div style="margin-left:20px;text-decoration:line-through;font-size:11px;justify-content:center;color:#a7a7a7;align-text:center">S/. 599.00</div>
                        </div>
                        <div style="color:#666;font-size:12px;margin-bottom:8px">Stock</div>
                        
                        
                    </div>
                </div>
                
                
                
                
                
            </div>
        </div>
        </div>
        
        <!-- Explorar  --------------------->
        <div id="explorar" style="width:100%;position:relative;display:none;margin-top:20px;background:#ededed;padding-bottom:65px;">
            <div style="margin-top:150px;">
                <div style="margin-left:2.5%;margin-top:15px;font-weight:bold;margin-bottom:15px;">Ofertas Tiempo Limitado</div>
                <div style="width:95%;margin:auto;background:black;">
                    
                    <div style="margin-top:7px;width:48%;position:relative;display:inline-block;float:left;margin-left:1%;border-radius:10px;background:white">
                        <img src="https://oberlu.com/images/1658787361_samsung.jpg" alt="" style="width:100%;border-radius:10px">
                        <div style="padding:0 10px 10px">
                            <div style="display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; height: 28px;line-height: 14px;font-size: 10px;color: #666;margin: 4px 0;">
                                RAM DDR4 Samsung 3200Mhz
                            </div>
                            <div style="display:flex;align-items:center;">
                               <div style="font-size:16px;font-weight:bold;font-style:italic">S/. 1500.00</div>
                               <div style="margin-left:20px;text-decoration:line-through;font-size:11px;justify-content:center;color:#a7a7a7;align-text:center">S/. 599.00</div>
                            </div>
                            <div style="color:#666;font-size:12px;margin-bottom:8px">Stock</div>
                            <div style="position:absolute;right:10px;bottom:5px;display:flex;justify-content:flex-end;align-items:center">
                                <div style="color:blue;font-size:12px;border: 1px solid blue;padding:1px 5px;border-radius:3px">Oferta</div>
                                <div style="color:#b10000;font-size:12px;border: 1px solid #b10000;padding:1px 5px;border-radius:3px;margin-left:5px;">Preventa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 

        </div>



    </div>
    
    <div class="allforall" >
        <div class="suball" >
            <div class="subbase">
            <img class="usuario" src="https://oberlu.com/image/svg/hogarpurple.svg ">
            <h6 style="color:#b10000;">Home</h6>
            </div>
            <div class="subbase">
            <a href="https://oberlu.com/categorias"><img class="usuario" src="https://oberlu.com/image/svg/barmenu.svg " style="width:25px;    padding: 3px;">
            <h6>Categorias</h6></a>
            </div>
            <div class="subbase">
            <a href="https://oberlu.com/cart-mobile ">
            <img class="usuario" src="https://oberlu.com/image/svg/carro.svg ">
            <h6>Cart</h6></a>
            </div>
            <div class="subbase">
            <a href="https://oberlu.com/login">
                <img class="usuario" src="https://oberlu.com/image/svg/usuario.svg "></a>
            <h6>Mi cuenta</h6>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>
        var splide = new Splide( '.splide', {
        type   : 'loop',
        padding: '3rem',
        pagination: false,
        arrows: false,
        autoplay: true,
        } );
        splide.mount();
    </script>
    <script>
        function inicio(){
            document.getElementById("oberlu").style.display ="block";
            document.getElementById("explorar").style.display ="none";
            document.getElementById("explorart").style.borderBottom ="none";
            document.getElementById("iniciot").style.borderBottom ="2px solid #b10000";
            document.getElementById("explorart").style.paddingBottom ="0px";
            document.getElementById("explorart").style.color ="#000";
            document.getElementById("explorart").style.fontWeight ="100";
        }
        function explorar(){
            document.getElementById("oberlu").style.display ="none";
            document.getElementById("explorar").style.display ="inline-block";
            document.getElementById("explorart").style.borderBottom ="3px solid #b10000";
            document.getElementById("explorart").style.paddingBottom ="10px";
            document.getElementById("explorart").style.color ="#b10000";
            document.getElementById("explorart").style.fontWeight ="bold";
            document.getElementById("iniciot").style.borderBottom ="none";
        }
    </script>
</body>
</html>




