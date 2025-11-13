<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adler: Administracion</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="{{asset('css/dapp.css') }}">
    <link rel="stylesheet" href="{{asset('css/load.css') }}">
    @include('global.icon')
    <!-- first include any tsParticles plugin needed introduce animation: https://codepen.io/matteobruni/pen/LYGMwyZ -->
    <script src="{{ asset('js/load.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Función para cargar el precio de Bitcoin en USD y actualizar el div


    </script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@1.0.2"></script>
    <style>
    .active {
        background: none; 
        border: 2px solid #09ca36;
        color: #09ca36; 
        cursor:pointer;
    }
    .inactive {
        background-color: black;
        border: none;
        cursor:pointer;
    }
    h3 {
        color: white;
        font-size: 12px;
        text-align: left;
        font-family: 'Arial';
        padding-bottom: 5px;
        border-bottom: 2px solid rgba(250, 250, 250, .5);
    }
    .active-menu{
        
        display:flex;
    }
    .hidden-menu{
        display: none;
    }
    button {background:none;}
    </style>

</head>
<body >
  
 
    <div id="loadingDiv" style="display:flex;width:100%;position:fixed;overflow:hidden;height:100vh;background:black;z-index:10000;opacity: 1; transition: opacity 0.5s ease-in-out;">
        <div class="cube">
            <div class="side"></div>
            <div class="side"></div>
            <div class="side"></div>
            <div class="side"></div>
            <div class="side"></div>
            <div class="side"></div>
            
            
        </div>
        
    </div>


    <div class="body" style="width:100%;display:flex;align-items:center;justify-content:center;height:100vh;">
        <div class="sbody" style="width:95%;display:flex;align-items:center;justify-content:center;height:95vh;border-radius:15px;gap:15px;">
            <nav id="nav" style="display:flex;flex-direction:row;align-items:center;justify-content:center;height:100%;">
                <div style="display:flex;flex-direction:column;align-items:center;justify-content:flex-start; width:95%;height:98%;background:hsla(356, 95%, 31%, .80); backdrop-filter:blur(5px);border-radius:12px;">
                  
                    <div style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:100%;min-height:50px;margin-top:15px;gap:10px;">
                      <div style="display:flex;flex-direction:row;align-items:center;justify-content:center;">
                        <img src="{{ asset('image/logo1_BN.png')}}" alt="" style="width:65px;">
                      </div>
                     
                    </div> 
                    
                    <div class="color-hover" id="dashboard" onclick="menuActive('dashboard')" style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:100%;min-height:50px;margin-top:25px;background: rgba(20, 20, 20, .8);transform: scale(1.05);border-radius: 5px;">
                      <div style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:25%;">
                        <span onmouseover="showThumb('dashboard-thumb')" onmouseout="hideThumb('dashboard-thumb')" class="material-symbols-outlined color-hover" style="font-weight:100;font-size:30px;">dashboard</span>
                      </div> 
                      <img id="dashboard-thumb" src="{{ asset('image/thumb/dashboard.png')}}" alt="" style="display:none;position:absolute;right:-95px;z-index:9;width:80px;">
                      
                      <div class="hidden" style="flex-direction:row;align-items:center;justify-content:flex-start; width:75%;">
                          <h4 class="color-hover" >Dashboard</h4>
                          
                      </div>
                    </div> 
                    <div id="wallet" onclick="menuActive('wallet')" style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:100%;min-height:50px;">
                      <div style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:25%;">
                        <span onmouseover="showThumb('wallet-thumb')" onmouseout="hideThumb('wallet-thumb')" class="material-symbols-outlined color-hover" style="font-weight:100;font-size:30px;">account_balance_wallet</span>
                      </div>
                      <img id="wallet-thumb" src="{{ asset('image/thumb/wallet.png')}}" alt="" style="display:none;position:absolute;right:-95px;z-index:9;width:80px;">

                      <div class="hidden" style="flex-direction:row;align-items:center;justify-content:flex-start; width:75%;">
                          <h4 class="color-hover" >Wallet Analysis</h4>
                      </div>
                    </div> 
                    <div style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:100%;min-height:50px;">
                      <div style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:25%;">
                        <span onmouseover="showThumb('token-thumb')" onmouseout="hideThumb('token-thumb')" class="material-symbols-outlined color-hover" style="font-weight:100;font-size:30px;">request_quote</span>
                      </div>
                      <img id="token-thumb" src="{{ asset('image/thumb/token.png')}}" alt="" style="display:none;position:absolute;right:-95px;z-index:9;width:80px;">

                      <div class="hidden" style="flex-direction:row;align-items:center;justify-content:flex-start; width:75%;">
                          <h4 class="color-hover" >Token Analysis</h4>
                      </div>
                    </div> 

                    <div style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:100%;min-height:50px;">
                      <div style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:25%;">
                        <span onmouseover="showThumb('call-thumb')" onmouseout="hideThumb('call-thumb')" class="material-symbols-outlined color-hover" style="font-weight:100;font-size:30px;">campaign</span>
                      </div>
                      <img id="call-thumb" src="{{ asset('image/thumb/calls.png')}}" alt="" style="display:none;position:absolute;right:-95px;z-index:9;width:80px;">

                      <div class="hidden" style="flex-direction:row;align-items:center;justify-content:flex-start; width:75%;">
                          <h4 class="color-hover" >AI Calls</h4>
                      </div>
                    </div> 
                   
                </div>    
                            
            </nav>
            <div id="zindex" style="width:85%;background:white; backdrop-filter:blur(5px);height:98%;display:flex;flex-direction:column;align-items:center;justify-content:flex-start;border-radius:15px;">
                <div style="width:100%;display:flex;flex-direction:row;align-items:center;justify-content:space-between;height:50px;border-bottom: 2px solid rgba(0, 0, 0, .1);background:hsla(356, 95%, 31%, .80);border-radius:10px 10px 0px 0px">
                    <div style="display:flex;flex-direction:row;align-items:center;justify-content:flex-start;width:85%;height:100%;">
                      <span class="material-symbols-outlined" style="position:absolute;left: 13px;font-size: 17px; color: hsla(356, 95%, 31%, .80)">search</span>
                      <input id="busqueda" type="search" style="width: 50%;margin-left: 10px; border: none; background: rgba(0, 0, 0, .5); padding: 7px 25px; color: rgba(0, 250, 0, .9); border-radius: 5px;" placeholder="Search wallet or token 0xe082ad...">
                    </div>

                    <div style="display:flex;flex-direction:row;align-items:center;justify-content:flex-end;width:15%;height:100%;margin-right:15px;gap:10px;">
                        <div id="wallet-root"></div>
                        <span id="menu_open" onclick="toggleMenu()" class="material-symbols-outlined" style="color:#282828;cursor:pointer;transition:.5s" >menu_open</span>
                        <span id="menu" onclick="toggleMenu()" class="material-symbols-outlined" style="color:#282828;cursor:pointer;transition:.5s">menu</span>
                        <span id="news_close" onclick="newsMenu()" class="material-symbols-outlined" style="color:#282828;cursor:pointer;transition:.5s;position:absolute;right:15px;top:60px;z-index:9;display:none;">collapse_all</span>
                        <span id="news_open" onclick="newsMenu()" class="material-symbols-outlined" style="color:#282828;cursor:pointer;transition:.5s;position:absolute;right:15px;top:60px;z-index:9">feed</span>
                    </div>
                </div>
                <div style="width:100%;display:flex;flex-direction:row;align-items:center;justify-content:space-between;height:50px;padding:2%;margin-top:20px;">
                    <h4 id="dashboard-title" style="color:#09ca36;font-weight:bold;font-size:25px;">DASHBOARD</h4>
                    <h4 id="wallet-title" style="color:#09ca36;font-weight:bold;font-size:25px;">WALLET ANALYSIS</h4>
                </div>
                <!-- DASHBOARD ------>
                @yield('content')
                
                 <!-- DASHBOARD END ------>
                 
                 
                <div id="news" style="transition:all 0.5s ease-out;position:absolute;width:20%;right:0px;right:150px;height:100%;background:rgba(250,250,250,.3);border-radius:0px0px;z-index:-99;backdrop-filter:blur(5px)">
                    <div style="display:flex;flex-direction:column;width:100%;">
                      <div style="display:flex;align-items:center;justify-content:flex-start;height:50px;width:100%;border-bottom:2px solid rgba(0,0,0,.1)">
                          <h5 style="font-size:17px;padding:10px;">New features added</h5>
                      </div>
                      <div style="display:flex;flex-direction:row;">
                          <div style="display:flex;flex-direction:column;width:85%;">
                              <div style="display:flex;align-items:center;justify-content:flex-start;flex-direction:column;width:100%;padding:10px;gap:5px;">
                                    <a href="" style="width:100%;">
                                      <div class="scale" style="display:flex;align-items:flex-start;justify-content:flex-start;flex-direction:column;width:100%;background:white;padding:5px;border-radius:5px;cursor:pointer;">
                                          <h5 style="font-size:10px;color:#bababa;font-family:'Arial';width:100%;text-align:right;">05/08/2024 15:00</h5>
                                          <h3 style="font-size:13px;color:#000;font-family:'Arial';width:100%;text-align:justify;margin-top:5px;font-weight:bold;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">NEW AI FEATURES FOR TODAY REMEMBER TIME</h3>
                                          <h4 class="ellipsis-three-lines" style="font-size:12px;color:#282828;font-family:'Arial';width:100%;text-align:justify;margin-top:5px;"> Locale_get_region new features addded AI conversion and reversive entermtaiment with convenient with youurlife the most AI reforce conditions relatives </h4>
                                      </div>
                                    </a>
                                    <a href="" style="width:100%;">
                                      <div class="scale" style="display:flex;align-items:flex-start;justify-content:flex-start;flex-direction:column;width:100%;background:white;padding:5px;border-radius:5px;cursor:pointer;">
                                            <h5 style="font-size:10px;color:#bababa;font-family:'Arial';width:100%;text-align:right;">05/08/2024 15:00</h5>
                                            <h3 style="font-size:13px;color:#000;font-family:'Arial';width:100%;text-align:justify;margin-top:5px;font-weight:bold;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">NEW AI FEATURES FOR TODAY REMEMBER TIME</h3>
                                            <h4 class="ellipsis-three-lines" style="font-size:12px;color:#282828;font-family:'Arial';width:100%;text-align:justify;margin-top:5px;"> Locale_get_region new features addded AI conversion and reversive entermtaiment with convenient with youurlife the most AI reforce conditions relatives </h4>
                                      </div>
                                    </a>
                              </div>
                          </div>
                        <div>

                        </div>
                      </div>
                      
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>


    <!--   <div id="app">    
  </div> Punto de montaje de React -->



    
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('js/dapp.js') }}"></script>
</body>
</html>
