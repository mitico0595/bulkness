

<div style="position:absolute;height:100vh;width:100%;background:rgba(0,0,0,0.5);z-index:9;top:85px;">
    <div style="width:100%;position:relative;display:block;margin:auto;background:white; height:450px;max-width:1200px;min-width:750px;">
        <div style="position:relative;display:inline-block;float: left;width:25%;min-width:200px;height:100%;">
            <div id="nuevo" style="cursor: pointer; position:relative;width:100%;line-height:45px;font-size:18px;text-align:center;background:white;border-bottom:1px solid#e2e2e2;background:#b10000;color:white" onmouseover="producto()">Nuevos Productos</div>
            @foreach ($tiendas as $tienda)
            <a href="{{url('buscando?name=&categoria='.$tienda->name)}} "><div id="pro{{$tienda->id}}" style="cursor: pointer;position:relative;width:100%;line-height:45px;font-size:18px;text-align:center;background:white;border-bottom:#acacac;border-bottom:1px solid#e2e2e2" onmouseover="block{{$tienda->id}}()">{{$tienda->name}} </div></a>
            @endforeach
        </div>
        <div style="position:relative;display:inline-block;float: left;width:75%;min-width:600px;height:100%;">
            <div style="display:block;width:100%;padding:15px;height:440px;overflow-y:auto;position: absolute;left:0px;top:0px;" id="productn">
                @foreach ($loqu as $comp)

                <li class="splide__slide">
                <a href="{{asset('busco/'.$comp->id)}} ">
                <div class="principal_c" style="width:48%;min-width:340px;height:90px;margin-bottom:10px;margin-top:0px;">

                    <img src="{{asset('images/'.$comp->image)}}" style="width:70px;position:absolute;left:20px;top:0px;top:10px;border-bottom:0px">
                    <p class="" style="position:absolute;left:120px;color:black">{{$comp -> name}} </p>
                    <p class="actualprice" style="bottom:-10px;left:120px;font-size:16px;">S/. {{$comp -> precio}}</p>
                    <p class="beforeprice" style="left:200px;bottom:0px;" >S/. {{$comp -> preciof}}</p>
                    <p class="suboferta" style="right:5px;bottom:-15px">{{FLOOR(number_format( 100-($comp->precio*100/$comp->preciof),2 ))}}% OFF</p>
                </div>
                </a>
                </li>

             @endforeach
             <li class="splide__slide">
                <a href="/ ">
                <div class="principal_c" style="width:48%;min-width:340px;height:90px;margin-bottom:10px;margin-top:0px;border:1px solid #b10000">

                        <img src="{{asset('image/ofertas.jpg')}}" alt="" style="width: 100%;height:90px;left:0px;">
                </div>
                </a>
                </li>
            </div>
            @foreach ($tiendas as $tienda)
            <div id="produ{{$tienda->id}}" style="width:100%;padding:15px;height:440px;overflow-y:auto;position: absolute;left:0px;top:0px;display:none" >
                @foreach ($some as $comp)
                @if( $comp->tienda == $tienda->id)
                <li class="splide__slide">
                <a href="{{asset('busco/'.$comp->id)}} ">
                <div class="principal_c" style="width:48%;min-width:340px;height:90px;margin-bottom:10px;margin-top:0px;">

                    <img src="{{asset('images/'.$comp->image)}}" style="width:70px;position:absolute;left:20px;top:0px;top:10px;border-bottom:0px">
                    <p class="" style="position:absolute;left:120px;color:black">{{$comp -> name}} </p>
                    <p class="actualprice" style="bottom:-10px;left:120px;font-size:16px;">S/. {{$comp -> precio}}</p>
                    <p class="beforeprice" style="left:200px;bottom:0px;" >S/. {{$comp -> preciof}}</p>
                    <p class="suboferta" style="right:5px;bottom:-15px">{{FLOOR(number_format( 100-($comp->precio*100/$comp->preciof),2 ))}}% OFF</p>
                </div>
                </a>
                </li>
                @endif
             @endforeach
             <li class="splide__slide">
                <a href="/ ">
                <div class="principal_c" style="width:48%;min-width:340px;height:90px;margin-bottom:10px;margin-top:0px;border:1px solid #b10000">

                        <img src="{{asset('image/ofertas.jpg')}}" alt="" style="width: 100%;height:90px;left:0px;">
                </div>
                </a>
                </li>
            </div>

            @endforeach


            <script>
                function producto(){
                    document.getElementById('productn').style.display = 'block';
                    document.getElementById('nuevo').style.background = '#b10000';
                    document.getElementById('nuevo').style.color = 'white';
                    @foreach ($tiendas as $tienda)
                        document.getElementById('produ{{$tienda->id}}').style.display = 'none';
                        document.getElementById('pro{{$tienda->id}}').style.background = 'none';
                        document.getElementById('pro{{$tienda->id}}').style.color = 'black';
                    @endforeach
                }

                @foreach ($tiendas as $tien)
                    function block{{$tien->id}}(){
                        document.getElementById('productn').style.display = 'none';
                        document.getElementById('nuevo').style.background = 'white';
                        document.getElementById('nuevo').style.color = 'black';
                        @foreach ($tiendas as $tienda)
                        @if ($tien->id != $tienda->id)
                        document.getElementById('produ{{$tienda->id}}').style.display = 'none';
                        document.getElementById('pro{{$tienda->id}}').style.background = 'none';
                        document.getElementById('pro{{$tienda->id}}').style.color = 'black';
                        @endif
                        @endforeach
                        document.getElementById('produ{{$tien->id}}').style.display = 'block';
                        document.getElementById('pro{{$tien->id}}').style.background = '#b10000';
                        document.getElementById('pro{{$tien->id}}').style.color = 'white';

                    }
                @endforeach
            </script>
        </div>
    </div>
</div>
