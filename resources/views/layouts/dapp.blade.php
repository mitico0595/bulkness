<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapp LSAI</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="{{asset('css/dapp.css') }}">
    <link rel="stylesheet" href="{{asset('css/load.css') }}">
    <link rel="shortcut icon" href="{{ asset('image/logo.png') }}">
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
            
            <h5 style="color:#09ca36;font-weight:bold;font-size:13px;">LSAI</h5>
        </div>
        
    </div>


    <div class="body" style="width:100%;display:flex;align-items:center;justify-content:center;height:100vh;">
        <div class="sbody" style="width:90%;display:flex;align-items:center;justify-content:center;height:85vh;border-radius:15px;gap:15px;">
            <nav id="nav" style="display:flex;flex-direction:row;align-items:center;justify-content:center;height:100%;">
                <div style="display:flex;flex-direction:column;align-items:center;justify-content:flex-start; width:95%;height:98%;background:rgba(0,250,10,.1);backdrop-filter:blur(5px);border-radius:12px;">
                  
                    <div style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:100%;min-height:50px;margin-top:15px;gap:10px;">
                      <div style="display:flex;flex-direction:row;align-items:center;justify-content:center;">
                        <img src="{{ asset('image/logow.png')}}" alt="" style="width:30px;">
                      </div>
                      <div class="hidden" style="flex-direction:row;align-items:center;justify-content:flex-start; ">
                          <h4 style="color:white;text-transform:uppercase">Ledger Smart AI  ™</h4>
                      </div>
                    </div> 
                    
                    <div class="color-hover" id="dashboard" onclick="menuActive('dashboard')" style="display:flex;flex-direction:row;align-items:center;justify-content:center; width:100%;min-height:50px;margin-top:25px;background: rgba(0, 100, 0, .9);transform: scale(1.05);border-radius: 5px;">
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
            <div id="zindex" style="width:85%;background:rgba(0,250,10,.1);backdrop-filter:blur(5px);height:98%;display:flex;flex-direction:column;align-items:center;justify-content:flex-start;border-radius:15px;">
                <div style="width:100%;display:flex;flex-direction:row;align-items:center;justify-content:space-between;height:50px;border-bottom: 2px solid rgba(0, 0, 0, .1);">
                    <div style="display:flex;flex-direction:row;align-items:center;justify-content:flex-start;width:85%;height:100%;">
                      <span class="material-symbols-outlined" style="position:absolute;left: 13px;font-size: 17px; color: rgba(0, 250, 0, .9);">search</span>
                      <input type="search" style="width: 50%;margin-left: 10px; border: none; background: rgba(0, 0, 0, .5); padding: 7px 25px; color: rgba(0, 250, 0, .9); border-radius: 5px;" placeholder="Search wallet or token 0xe082ad...">
                    </div>

                    <div style="display:flex;flex-direction:row;align-items:center;justify-content:flex-end;width:15%;height:100%;margin-right:15px;gap:10px;">
                        <div id="wallet-root"></div>
                        <span id="menu_open" onclick="toggleMenu()" class="material-symbols-outlined" style="color:rgba(0, 250, 0, .9);cursor:pointer;transition:.5s" >menu_open</span>
                        <span id="menu" onclick="toggleMenu()" class="material-symbols-outlined" style="color:rgba(0, 250, 0, .9);cursor:pointer;transition:.5s">menu</span>
                        <span id="news_close" onclick="newsMenu()" class="material-symbols-outlined" style="color:rgba(0, 250, 0, .9);cursor:pointer;transition:.5s;position:absolute;right:15px;top:60px;z-index:9;display:none;">collapse_all</span>
                        <span id="news_open" onclick="newsMenu()" class="material-symbols-outlined" style="color:rgba(0, 250, 0, .9);cursor:pointer;transition:.5s;position:absolute;right:15px;top:60px;z-index:9">feed</span>
                    </div>
                </div>
                <div style="width:100%;display:flex;flex-direction:row;align-items:center;justify-content:space-between;height:50px;padding:2%;margin-top:20px;">
                    <h4 id="dashboard-title" style="color:#09ca36;font-weight:bold;font-size:25px;">DASHBOARD</h4>
                    <h4 id="wallet-title" style="color:#09ca36;font-weight:bold;font-size:25px;">WALLET ANALYSIS</h4>
                </div>
                <!-- DASHBOARD ------>
                <div  class="hidden-menu" id="dashboard-content" style="width:96%;flex-direction:row;align-items:center;justify-content:flex-start;height:50px;padding:15px;height:80%;">
                  <div style="width:50%;display:flex;flex-direction:column;align-items:center;justify-content:flex-start;height:50px;height:100%;">
                      <!-- PLANS DASHBOARD -->
                      <div style="width:100%;display:flex;flex-direction:row;align-items:center;justify-content:flex-start;gap:10px;">
                          <div style="border-radius:7px;width:33%;display:flex;flex-direction:column;align-items:center;justify-content:flex-start; flex-wrap:wrap;gap:10px; height:50px;padding:15px;height:100%;background:rgba(0,0,0,1);min-width:150px;">
                              <div style="display:flex;align-items:center;justify-content:center;position:relative;height:100px;width:100%;">
                                <div style="position:absolute;top:-20px;left:25%;width:50%;">
                                    <img src="{{ asset('image/animated/back.png') }}" alt="" style="position:absolute;top:0px;left:10%;z-index:1;width:80%" class="float-d">
                                    <img src="{{ asset('image/animated/front2.png') }}" alt="" style="position:absolute;top:0px;left:10%;z-index:9;width:80%" class="float-slow-top">
                                </div>
                                
                              </div>
                              <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;width:100%;margin-top:0px;">
                                 <h4 style="font-size:15px;font-weight:bold;">HOLDERS</h4>
                                 <h5 style="font-size:9px;font-weight:100;padding-top:5px;padding-bottom:5px;margin-top:10px;border-bottom:1px solid rgba(0,250,0,.2);border-top:1px solid rgba(0,250,0,.2);width:100%;text-align:center;">FULL WEB PLATFORM ACCESS</h5>
                                 <h5 style="font-size:9px;font-weight:100;padding-top:5px;padding-bottom:5px;border-bottom:1px solid rgba(0,250,0,.2);width:100%;text-align:center;">DEDICATED TELEGRAM BOT SERVICE</h5>
                                 <h2 style="margin-top:10px;color:rgba(0,250,10,.8);font-weight:bold;font-size:15px;">200,000 LSAI</h2>
                                 <h7 style="margin-top:10px;color:rgba(0,250,10,.8);font-weight:100;font-size:11px;">HOLD PLAN</h7>
                              </div>  
                          </div>
                          <div style="border-radius:7px;width:33%;display:flex;flex-direction:column;align-items:center;justify-content:flex-start; flex-wrap:wrap;gap:10px; height:50px;padding:15px;height:100%;background:rgba(0,0,0,1);min-width:150px;">
                              <div style="display:flex;align-items:center;justify-content:center;position:relative;height:100px;width:100%;">
                                <div style="position:absolute;top:-20px;left:35%;width:50%;">
                                    <img src="{{ asset('image/animated/back.png') }}" alt="" style="position:absolute;top:0px;left:10%;z-index:1;width:60%" class="float-exp">
                                    <img src="{{ asset('image/animated/front2.png') }}" alt="" style="position:absolute;top:0px;left:10%;z-index:9;width:60%" class="float-slow">
                                </div>
                                <div style="position:absolute;top:0px;left:25%;width:50%;">
                                    <img src="{{ asset('image/animated/back.png') }}" alt="" style="position:absolute;top:0px;left:10%;z-index:1;width:60%" class="float-c">
                                    <img src="{{ asset('image/animated/front2.png') }}" alt="" style="position:absolute;top:0px;left:10%;z-index:9;width:60%" class="float-slow-time">
                                </div>
                              </div>
                              <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;width:100%;margin-top:0px;">
                                 <h4 style="font-size:15px;font-weight:bold;">MONTHLY</h4>
                                 <h5 style="font-size:9px;font-weight:100;padding-top:5px;padding-bottom:5px;margin-top:10px;border-bottom:1px solid rgba(0,250,0,.2);border-top:1px solid rgba(0,250,0,.2);width:100%;text-align:center;">ALL HOLDERS BENEFIT</h5>
                                 <h5 style="font-size:9px;font-weight:100;padding-top:5px;padding-bottom:5px;border-bottom:1px solid rgba(0,250,0,.2);width:100%;text-align:center;">EXCLUSIVE GROUP MEMBERSHIP</h5>
                                 <h5 style="font-size:9px;font-weight:100;padding-top:5px;padding-bottom:5px;border-bottom:1px solid rgba(0,250,0,.2);width:100%;text-align:center;">ACCESS TO ALL FUTURE FEATURES</h5>
                                 <h2 style="margin-top:10px;color:rgba(0,250,10,.8);font-weight:bold;font-size:15px;">10,000 LSAI</h2>
                                 <h5 style="margin-top:10px;color:rgba(0,250,10,.8);font-weight:100;font-size:11px;">PURCHASE PLAN</h5>
                              </div>  
                          </div>

                          <div style="border-radius:7px;width:33%;display:flex;flex-direction:column;align-items:center;justify-content:flex-start; flex-wrap:wrap;gap:10px; height:50px;padding:15px;height:100%;background:rgba(0,0,0,1);min-width:150px;">
                              <div style="display:flex;align-items:center;justify-content:center;position:relative;height:100px;width:100%;">
                                      <div style="position:absolute;top:-10px;left:35%;width:50%;">
                                        <img src="{{ asset('image/animated/back.png') }}" alt="" style="position:absolute;top:0px;left:0px;z-index:1;width:45%" class="float-d">
                                        <img src="{{ asset('image/animated/front2.png') }}" alt="" style="position:absolute;top:0px;left:0px;z-index:9;width:45%" class="float-slow-top">
                                      </div>
                                      <div style="position:absolute;top:10px;left:22%;width:50%;">
                                          <img src="{{ asset('image/animated/back.png') }}" alt="" style="position:absolute;top:0px;left:0px;z-index:1;width:45%" class="float-c">
                                          <img src="{{ asset('image/animated/front.png') }}" alt="" style="position:absolute;top:0px;left:0px;z-index:9;width:45%" class="float-slow-time">        
                                      </div>
                                      <div style="position:absolute;top:10px;left:45%;width:50%;">
                                          <img src="{{ asset('image/animated/back.png') }}" alt="" style="position:absolute;top:0px;left:0px;z-index:1;width:45%" class="float-exp">
                                          <img src="{{ asset('image/animated/front2.png') }}" alt="" style="position:absolute;top:0px;left:0px;z-index:9;width:45%" class="float-slow">        
                                      </div>
                                      <div style="position:absolute;top:35px;left:35%;width:50%;">
                                          <img src="{{ asset('image/animated/back.png') }}" alt="" style="position:absolute;top:0px;left:0px;z-index:1;width:45%" class="float-b">
                                          <img src="{{ asset('image/animated/front.png') }}" alt="" style="position:absolute;top:0px;left:0px;z-index:9;width:45%" class="float">        
                                      </div>  
                                
                              </div>
                              <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;width:100%;margin-top:0px;">
                                 <h4 style="font-size:15px;font-weight:bold;">LIFETIME</h4>
                                 <h5 style="font-size:9px;font-weight:100;padding-top:5px;padding-bottom:5px;margin-top:10px;border-bottom:1px solid rgba(0,250,0,.2);border-top:1px solid rgba(0,250,0,.2);width:100%;text-align:center;">ALL HOLDERS BENEFIT</h5>
                                 <h5 style="font-size:9px;font-weight:100;padding-top:5px;padding-bottom:5px;border-bottom:1px solid rgba(0,250,0,.2);width:100%;text-align:center;">EXCLUSIVE GROUP MEMBERSHIP</h5>
                                 <h5 style="font-size:9px;font-weight:100;padding-top:5px;padding-bottom:5px;border-bottom:1px solid rgba(0,250,0,.2);width:100%;text-align:center;">LIFETIME ACCESS TO ALL FUTURE FEATURES</h5>
                                 <h2 style="margin-top:10px;color:rgba(0,250,10,.8);font-weight:bold;font-size:15px;">100,000 LSAI</h2>
                                 <h5 style="margin-top:10px;color:rgba(0,250,10,.8);font-weight:100;font-size:11px;">PURCHASE PLAN</h5>
                              </div>  
                          </div>
                      </div>
                      <!-- PLANS DASHBOARD END ------------->
                      
                      <div style="display:flex;flex-direction:column;align-items:flex-start;justify-content:flex-start;position:relative;width:100%;margin-top:10px;height:100%;" >
                            <h5 style="width:100%;font-size:25px;color:#09ca36">Relevant Crypto News</h5>
                            <div style="display:flex;flex-direction:row;width:100%;margin-top:10px;align-items:flex-start;justify-content:flex-start;gap:10px;">
                                    <a href=""  style="width:30%;"><img class="scale" src="{{ asset('image/news/1.jpg')}}" alt="" style="width:100%;border-radius:5px;"></a>
                                    <a href="" style="width:30%;"><img class="scale" src="{{ asset('image/news/2.jpg')}}" alt="" style="width:100%;border-radius:5px;"></a>
                            </div>
                      </div>
                      
                  </div>
                  <div style="width:50%;display:flex;flex-direction:row;align-items:flex-start;justify-content:flex-start;position:relative;height:100%;">
                      <div style="display:flex;flex-direction:column;width:75%;border-radius:5px;margin-top:5px;height:100%;margin-left:10px;padding:10px;position:relative;padding-top:0px;">
                          <h4 style="color:#bababa;font-size:13px;font-weight:bold;position:absolute;top:8px;left:20px;">Simple Bitcoin Technical Analysis</h4>
                          <div style="position:absolute;top:5px;right:12px;color:#bababa;padding:3px 7px;border-radius:0px 10px 0px 0px;font-size:11px;font-family:'Arial'" id="utcClock"></div>
                          <canvas id="btcChart" style="background: black;padding: 10px;border-radius: 10px;height:180px;padding-top:25px;"></canvas>
                          <div style="display:flex;flex-direction:row;width:100%;align-items:flex-start;justify-content:flex-start;gap:1%;flex-wrap:wrap">
                              <div id="supportDiv" onclick="toggleAnnotations('support', ['simpleSupport', 'bigSupport'],'line')" class="inactive" style="display:flex;flex-direction:column;width:32%;padding:10px;border-radius:5px;margin-top:10px;">
                                 <h3 style="color:white;font-size:13px;border-bottom:2px solid rgba(250,250,250,.5);font-family:'Arial';padding-bottom:5px;">Support</h3>
                                 <div style="width:100%;display:flex;flex-wrap:wrap;align-items:center;justify-content:center;margin-top:5px;">
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">Simple:</span>
                                    <h5 id="simpleSupport" style="width:50%;text-align:center;font-family:'Arial';font-size:10px">60000</h5>
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">Big:</span>
                                    <h5 id="bigSupport" style="width:50%;text-align:center;font-family:'Arial';font-size:10px">55000</h5>
                                 </div>                                 
                              </div>
                              <div id="resistanceDiv" class="inactive" style="display:flex;flex-direction:column;width:32%;padding:10px;border-radius:5px;margin-top:10px;">
                                 <h3 style="color:white;font-size:13px;border-bottom:2px solid rgba(250,250,250,.5);font-family:'Arial';padding-bottom:5px;">Resistance</h3>
                                 <div style="width:100%;display:flex;flex-wrap:wrap;align-items:center;justify-content:center;margin-top:5px;">
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">Simple:</span>
                                    <h5 id="simpleResistance" style="width:50%;text-align:center;font-family:'Arial';font-size:10px">70000</h5>
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">Big:</span>
                                    <h5 id="bigResistance" style="width:50%;text-align:center;font-family:'Arial';font-size:10px">73000</h5>
                                 </div>                                 
                              </div>
                              <div id="liquidationDiv"  class="inactive" style="display:flex;flex-direction:column;width:33%;padding:10px;border-radius:5px;margin-top:10px;">
                                 <h3 style="color:white;font-size:13px;border-bottom:2px solid rgba(250,250,250,.5);font-family:'Arial';padding-bottom:5px;">Liquidation Lvl</h3>
                                 <div style="width:100%;display:flex;flex-wrap:wrap;align-items:center;justify-content:center;margin-top:5px;">
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">Short:</span>
                                    <h5 id="shortLiquidation" style="width:50%;text-align:center;font-family:'Arial';font-size:10px">63500</h5>
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">Long:</span>
                                    <h5 id="longLiquidation" style="width:50%;text-align:center;font-family:'Arial';font-size:10px">67450</h5>
                                 </div>                                 
                              </div>  
                              <div  id="emaDiv" onclick="toggleAnnotations('ema', ['ema200', 'ema100', 'ema50'],'point');" class="inactive" style="display:flex;flex-direction:column;width:24%;padding:10px;border-radius:5px;margin-top:6px;">
                                 <h3 style="color:white;font-size:15px;border-bottom:2px solid rgba(250,250,250,.5);font-family:'Arial';padding-bottom:5px;">EMA 1D</h3>
                                 <div style="width:100%;display:flex;flex-wrap:wrap;align-items:center;justify-content:center;margin-top:5px;">
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial';">200:</span>
                                    <h5 id="ema200" style="width:50%;text-align:center;font-family:'Arial';font-size:10px">52999</h5>
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">100:</span>
                                    <h5 id="ema100" style="width:50%;text-align:center;font-family:'Arial';font-size:10px">60305</h5>
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">50:</span>
                                    <h5 id="ema50" style="width:50%;text-align:center;font-family:'Arial';font-size:10px">63357</h5>
                                 </div>                                 
                              </div>
                              <div style="display:flex;flex-direction:column;width:24%;padding:10px;background:black;border-radius:5px;margin-top:6px;">
                                 <h3 style="color:white;font-size:15px;border-bottom:2px solid rgba(250,250,250,.5);font-family:'Arial';padding-bottom:5px;">MA 1D</h3>
                                 <div style="width:100%;display:flex;flex-wrap:wrap;align-items:center;justify-content:center;margin-top:5px;">
                                 <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">MA 200:</span>
                                    <h5 style="width:50%;text-align:center;font-family:'Arial';font-size:10px">51065</h5>
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">MA 100:</span>
                                    <h5 style="width:50%;text-align:center;font-family:'Arial';font-size:10px">61741</h5>
                                    <span style="width:50%;text-align:left;font-size:10px;font-family:'Arial'">MA 50:</span>
                                    <h5 style="width:50%;text-align:center;font-family:'Arial';font-size:10px">65496</h5>
                                 </div>                                 
                              </div>
                          </div>
                          
                      </div>
                      <div style="width:25%;height:100%;padding:5px;display:flex;align-items:flex-start;justify-content:flex-start;min-width:143px;flex-direction:column;gap:10px;">
                        
                          <div style="display:flex;gap:10px;flex-direction:row;align-items:center;justify-content:space-between;width:100%;padding:5px;background:none;height:50px;position:relative;border:2px solid rgba(0,250,10,.5);border-radius:5px;">
                              <img src="{{ asset('image/svg/btc.svg')}} " alt="" style="width:25px;">
                              <h5 style="font-size:13px;color:rgba(0,250,10,.5);font-weight:bold;" >BTC</h5>
                              <div id="bitcoinRate" style="font-family:'Arial';font-size:13px;color:rgba(0,250,10,.5);text-align:center;" ></div>
                          </div>
                          <div style="display:flex;gap:10px;flex-direction:row;align-items:center;justify-content:space-between;width:100%;padding:5px;background:none;height:50px;position:relative;border:2px solid rgba(0,250,10,.5);border-radius:5px;">
                              <img src="{{ asset('image/svg/eth.svg')}} " alt="" style="width:25px;">
                              <h5 style="font-size:13px;color:rgba(0,250,10,.5);font-weight:bold;" >ETH</h5>
                              <div id="ethRate" style="font-family:'Arial';font-size:13px;color:rgba(0,250,10,.5);text-align:center;" ></div>
                          </div>
                          <div style="display:flex;gap:10px;flex-direction:row;align-items:center;justify-content:space-between;width:100%;padding:5px;background:none;height:50px;position:relative;border:2px solid rgba(0,250,10,.5);border-radius:5px;">
                              <img src="{{ asset('image/svg/btcd.svg')}} " alt="" style="width:25px;">
                              <h5 style="font-size:13px;color:rgba(0,250,10,.5);font-weight:bold;" >BTC.D</h5>
                              <div id="btcDominance" style="font-family:'Arial';font-size:13px;color:rgba(0,250,10,.5);text-align:center;" ></div>
                          </div>
                          <div style="display:flex;gap:10px;flex-direction:row;align-items:center;justify-content:space-between;width:100%;padding:5px;background:none;height:50px;position:relative;border:2px solid rgba(0,250,10,.5);border-radius:5px;">
                              <img src="{{ asset('image/svg/total.svg')}} " alt="" style="width:25px;">
                              <h5 style="font-size:13px;color:rgba(0,250,10,.5);font-weight:bold;" >TOTAL</h5>
                              <div id="totalMarketCap" style="font-family:'Arial';font-size:13px;color:rgba(0,250,10,.5);text-align:center;" ></div>
                          </div>
                          <div style="display:flex;gap:10px;flex-direction:row;align-items:center;justify-content:space-between;width:100%;padding:5px;background:none;height:50px;position:relative;border:2px solid rgba(0,250,10,.5);border-radius:5px;">
                              <img src="{{ asset('image/svg/total3.svg')}} " alt="" style="width:25px;">
                              <h5 style="font-size:13px;color:rgba(0,250,10,.5);font-weight:bold;" >TOTAL3</h5>
                              <div id="totalt" style="font-family:'Arial';font-size:13px;color:rgba(0,250,10,.5);text-align:center;" ></div>
                          </div>
                          <div style="display:flex;gap:10px;flex-direction:row;align-items:center;justify-content:space-between;width:100%;padding:5px;background:none;height:50px;position:relative;border:2px solid rgba(0,250,10,.5);border-radius:5px;">
                              <img src="{{ asset('image/svg/sentiment.svg')}} " alt="" style="width:25px;">
                              <h5 style="font-size:11px;color:rgba(0,250,10,.5);font-weight:bold;" >FEAR & GREED</h5>
                              <div style="display:flex;flex-direction:column;text-align:center;">
                                <div id="sentiment" style="font-family:'Arial';font-size:13px;color:rgba(0,250,10,.5);text-align:center;" > </div>
                                <div id="value-sentiment" style="font-family:'Arial';font-size:13px;color:rgba(0,250,10,.5);text-align:center;" > </div>
                              </div>
                              
                          </div>
                          <div style="display:flex;gap:15px;flex-direction:column;align-items:center;justify-content:center;width:100%;padding:5px;background:none;height:100%;position:relative;border-radius:5px;">
                              <img src="{{ asset('image/logo.png')}} " alt="" style="width:50%;">
                              <h5 style="font-size:11px;color:rgba(0,250,10,.5);font-weight:bold;text-align:center;" >LEDGER SMART AI SENTIMENT</h5>
                              <div style="display:flex;flex-direction:column;text-align:center;gap:10px;">
                                <div style="font-family:'Arial';font-size:13px;color:rgba(0,250,10,.5);text-align:center;" >Short-term: Accumulative</div>
                                <div style="font-family:'Arial';font-size:13px;color:rgba(0,250,10,.5);text-align:center;" >Long-term: Bullish</div>
                              </div>
                              
                          </div>
                      </div>
                  </div>
              
                </div>
                 <!-- DASHBOARD END ------>
                 
                 <!-- wallet Analysis------>
                 <div class="hidden-menu"  id="wallet-content" style="width:96%;flex-direction:row;align-items:flex-start;justify-content:flex-start;height:50px;padding:15px;height:80%;">
                    <div style="width:55%;height:auto;flex-direction:column;align-items:flex-start;justify-content:flex-start;">
                        <div style="display:flex;width:100%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;">
                            <h5 style="width:10%;text-align:left;">RANK</h5>
                            <h5 style="width:25%;min-width:130px;">WALLET</h5>
                            <h5 style="width:20%;text-align:center;">LIQUIDITY</h5>
                            <h5 style="width:20%;text-align:center;">REALIZED PROFITS</h5>
                        </div>
                        <div style="display:flex;width:100%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;">
                            <div style="display:flex;width:10%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;gap:5px;">
                                <span class="material-symbols-outlined" style="color:green;">arrow_drop_up</span>
                                <h5 style="font-size:14px;font-family:'Arial'">1</h5>
                            </div>
                            <div style="display:flex;width:25%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;gap:5px;min-width:130px;">
                                <div id="image1" class="profile-image"></div>
                                <div id="profile1">0x2f2...72a35</div>                                
                            </div>
                            <div style="display:flex;width:20%;height:50px;flex-direction:row;align-items:center;justify-content:center;gap:5px;">
                                
                                <h5 style="font-size:14px;font-family:'Arial'">$ 1,250,025.04</h5>                            
                            </div>
                            <div style="display:flex;width:20%;height:50px;flex-direction:row;align-items:center;justify-content:center;gap:5px;">                                
                                <h5 style="font-size:14px;font-family:'Arial'">$ 255,125.04</h5>                            
                            </div>
                            <div style="display:flex;width:25%;height:50px;flex-direction:row;align-items:center;justify-content:center;gap:5px;margin-left:10px;">                                
                                <div style="display:flex;width:45px;height:40px;flex-direction:column;align-items:center;justify-content:center;gap:1px;border:2px solid rgba(0,250,0,.5);border-radius:5px;">
                                    <span class="material-symbols-outlined" style="font-size:20px;color:rgba(0,250,0,.5)">monitoring</span>
                                    <h5 style="font-size:8px;font-family:'Arial';color:rgba(0,250,0,.5)">Graphics</h5> 
                                </div>      
                                <div style="display:flex;width:45px;height:40px;flex-direction:column;align-items:center;justify-content:center;gap:1px;border:2px solid rgba(0,250,0,.5);border-radius:5px;">
                                    <span class="material-symbols-outlined" style="font-size:20px;color:rgba(0,250,0,.5)">library_books</span>
                                    <h5 style="font-size:8px;font-family:'Arial';color:rgba(0,250,0,.5)">Strategy</h5> 
                                </div>     
                                <div style="display:flex;width:45px;height:40px;flex-direction:column;align-items:center;justify-content:center;gap:1px;border:2px solid rgba(0,250,0,.5);border-radius:5px;">
                                    <span class="material-symbols-outlined" style="font-size:20px;color:rgba(0,250,0,.5)">robot_2</span>
                                    <h5 style="font-size:8px;font-family:'Arial';color:rgba(0,250,0,.5)">AI</h5> 
                                </div>                   
                            </div>   
                        </div>
                        <div style="display:flex;width:100%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;">
                            <div style="display:flex;width:10%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;gap:5px;">
                                <span class="material-symbols-outlined" style="color:green;">arrow_drop_up</span>
                                <h5 style="font-size:14px;font-family:'Arial'">2</h5>
                            </div>
                            <div style="display:flex;width:25%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;gap:5px;min-width:130px;">
                                <div id="image2" class="profile-image"></div>
                                <div id="profile2">0xbd5...cd9ca4</div>                                
                            </div>
                            <div style="display:flex;width:20%;height:50px;flex-direction:row;align-items:center;justify-content:center;gap:5px;">
                                
                                <h5 style="font-size:14px;font-family:'Arial'">$ 1,250,025.04</h5>                            
                            </div>
                            <div style="display:flex;width:20%;height:50px;flex-direction:row;align-items:center;justify-content:center;gap:5px;">                                
                                <h5 style="font-size:14px;font-family:'Arial'">$ 255,125.04</h5>                            
                            </div>
                            <div style="display:flex;width:25%;height:50px;flex-direction:row;align-items:center;justify-content:center;gap:5px;margin-left:10px;">                                
                                <div style="display:flex;width:45px;height:40px;flex-direction:column;align-items:center;justify-content:center;gap:1px;border:2px solid rgba(0,250,0,.5);border-radius:5px;">
                                    <span class="material-symbols-outlined" style="font-size:20px;color:rgba(0,250,0,.5)">monitoring</span>
                                    <h5 style="font-size:8px;font-family:'Arial';color:rgba(0,250,0,.5)">Graphics</h5> 
                                </div>      
                                <div style="display:flex;width:45px;height:40px;flex-direction:column;align-items:center;justify-content:center;gap:1px;border:2px solid rgba(0,250,0,.5);border-radius:5px;">
                                    <span class="material-symbols-outlined" style="font-size:20px;color:rgba(0,250,0,.5)">library_books</span>
                                    <h5 style="font-size:8px;font-family:'Arial';color:rgba(0,250,0,.5)">Strategy</h5> 
                                </div>     
                                <div style="display:flex;width:45px;height:40px;flex-direction:column;align-items:center;justify-content:center;gap:1px;border:2px solid rgba(0,250,0,.5);border-radius:5px;">
                                    <span class="material-symbols-outlined" style="font-size:20px;color:rgba(0,250,0,.5)">robot_2</span>
                                    <h5 style="font-size:8px;font-family:'Arial';color:rgba(0,250,0,.5)">AI</h5> 
                                </div>                   
                            </div>   
                        </div>
                        
                    </div>
                 
                    <!--   <div>
                        <div id="profile1">abcde12345klmno</div>
                        <div id="image1" class="profile-image"></div>

                            <div id="profile2">fghij67890pqrst</div>
                            <div id="image2" class="profile-image"></div>
                                                        

                    </div>-->


                 </div>
                 
                 <!-- wallet Analysis END  ------>
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
