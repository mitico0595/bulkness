@foreach ($searches as $search)
                <a href="{{asset('finde/'.$search->id)}} "><div class="recomendation-column">
                     
                    <div class="product-container">
                        <div class="image-container">
                    @if ($search->tipo == '1')
                    <img class="product-image" src="{{asset('image/'.$search->thumb )}}" style="border-radius: 10px;background:none" class="imagenp">
                    @else
                        @if ($search->tipo == '2')
                        <img class="product-image" src="{{asset('images/kits'.$search->thumb )}}" style="border-radius: 10px;background:none" class="imagenp">
                        @else
                        <img class="product-image" src="{{asset('image/productos/'.$search->image )}}" style="border-radius: 10px;background:none" class="imagenp">
                        @endif
                    @endif
            
                    @if ( $search->oferta==1 )
                    <img src="{{asset('image/oferta.png' )}} " class="oferta" style="right:-7px;width:50px;position:absolute">
                   
                    @endif
                        </div>
                        <div class="product-info">
                            <div class="product-title">
                                {{$search -> name}}
                            </div>
                            <div class="product-price">S/. {{$search -> precio}} <span class="beforeprice">S/. {{$search -> preciof}}</span></div>
                            <div class="product-stock">Stock</div>
                        </div>
                    </div>
                    
                </div ></a>
@endforeach