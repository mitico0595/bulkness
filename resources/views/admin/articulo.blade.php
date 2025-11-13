@extends ('layouts.admin')
@section ('content')
<!-- wallet Analysis------>.
<style>
        .content-container {
            
            height: 90%;
            overflow: hidden;
            
            position: relative;
        }

        .scroll-content {
            transition: transform 0.3s ease;
        }

        .slider-container {
            width: 5px;
            height: 100%;
            position: absolute;
            right: 10px;
            top: 10px;
            background: linear-gradient(to bottom, hsla(0,0%,19%,1) 0%,hsla(358,41%,38%,0.66) 26%,hsla(359,79%,28%,0.3) 54%,hsla(359,79%,28%,0) 77%); 
            border-radius: 10px;
        }

        .slider-progress {
            width: 100%;
            height: 0;
            background: rgba(179, 20, 20, .5);
            position: absolute;
            top: 0;
            border-radius: 10px;
        }

        .slider-thumb {
            width: 100%;
            width: 15px;
            left:-5px;
            height: 15px;
            background: rgba(179, 20, 20, .9);
            position: absolute;
            top: 0;
            cursor: pointer;
            border-radius: 10px;
        }
    </style>
<div  id="crudart" style="display:flex;width:96%;flex-direction:row;align-items:flex-start;justify-content:flex-start;height:50px;padding:15px;height:80%;">
<input id="buscador" type="text" v-model="name"  class="buscador" placeholder="Buscar" style="display:none">

<div   id="wallet-content" style="display:flex;width:100%;flex-direction:row;align-items:flex-start;justify-content:flex-start;height:50px;padding:15px;height:100%;">
                    <div style="width:75%;height:100%;flex-direction:column;align-items:flex-start;justify-content:flex-start;min-width:700px">
                        <div style="display:flex;width:100%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;min-width:700px">
                            <h5 style="width:7%;text-align:left;">RANK</h5>
                            <h5 style="width:25%;min-width:130px;">PRODUCTO</h5>
                            <h5 style="width:8%;text-align:center;">CANTIDAD</h5>
                            <h5 style="width:10%;text-align:center;">PRECIO</h5>
                        </div>
                        <div class="content-container" id="scroll-index" >
                           <div class="scroll-content" id="scroll-content">
                            <div v-for="item in searchSearch" style="display:flex;width:100%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;min-width:700px">
                                <div style="display:flex;width:7%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;gap:5px;">
                                    <span class="material-symbols-outlined" style="color:green;">arrow_drop_up</span>
                                    <h5 style="font-size:14px;font-family:'Arial'">1</h5>
                                </div>
                                <div style="display:flex;width:25%;height:50px;flex-direction:row;align-items:center;justify-content:flex-start;gap:5px;min-width:130px;">
                                    <div ><img :src="'/images/'+item.image" alt="image" / class="profile-image"></div>
                                    <div style="display:flex; flex-direction:column;width:75%">
                                        <div id="profile1" style="font-size:13px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">@{{item.name}} </div>  
                                        <div style="font-size:11px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;font-weight:bold">ALCH05</div>       
                                    </div>
                                                            
                                </div>
                                <div style="display:flex;width:8%;height:50px;flex-direction:row;align-items:center;justify-content:center;gap:5px;">                                
                                    <h5 style="font-size:14px;font-family:'Arial'">x 100</h5>                            
                                </div>
                                <div style="display:flex;width:10%;height:50px;flex-direction:row;align-items:center;justify-content:center;gap:5px;">                                
                                    <div style="display:flex; flex-direction:column;width:100%">
                                        <div style="font-size:14px;font-weight:bold">S/. 1050.00</div>  
                                        <div style="font-size:11px;">S/. 1050.00</div>       
                                    </div>                         
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
                            
                        </div>
                        
                    </div>
                    <div style="width:30px;height:100%;position:relative">
                                <div class="slider-container" id="slider-container" >
                                    <div class="slider-progress" id="slider-progress"></div>
                                    <div class="slider-thumb" id="slider-thumb"></div>
                                </div>
                    </div>
                    
                    <div style="width:24%; background:black; height:100%;border-radius:15px">

                    </div>
                    <!--   <div>
                        <div id="profile1">abcde12345klmno</div>
                        <div id="image1" class="profile-image"></div>

                            <div id="profile2">fghij67890pqrst</div>
                            <div id="image2" class="profile-image"></div>
                                                        

                    </div>-->


</div>
</div>                
                 <!-- wallet Analysis END  ------>
                 <script src="{{asset('js/app.js')}}"></script>
                 <script src="{{asset('js/slide-adler.js')}}"></script>
                 
@endsection