@extends ('layouts.admin')
@section ('content')
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
@endsection