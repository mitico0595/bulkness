<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include ('global.icon')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
        width:66%;
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
       h6{ color:#808080; }
       input:focus { outline: none; }
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

        /* NEW STYLE PRODUCTS RESPONSIVE*/
        .cart-section { width:100%; margin: 0 auto; }
        .main-product {
            background: white; border: 2px solid #e3f2fd; border-radius: 12px; padding: 16px; position: relative;
        }
        .main-product::after {
            content: ''; position: absolute; top: -2px; left: -2px; right: -2px; bottom: -2px;
            background: linear-gradient(135deg, #e3f2fd, #f3e5f5, #e8f5e8); border-radius: 12px; z-index: -1;
        }
        .product-header { display:flex; align-items:center; gap:12px; margin-bottom:16px; justify-content:space-between; margin-top:10px; }
        .main-image { width: 52px; height: 52px; background: linear-gradient(135deg, #f5f7fa, #c3cfe2); border-radius: 8px; display:flex; align-items:center; justify-content:center; font-size:24px; flex-shrink:0; }
        .main-details { flex: 1; }
        .main-name { font-size:16px; font-weight:600; color:#333; margin-bottom:2px; }
        .main-description { font-size:13px; color:#666; margin-bottom:4px; }
        .main-price { font-size:16px; font-weight:700; color:#1976d2; }
        .main-actions { display:flex; align-items:center; gap:8px; }

        .contained-items { border-left:3px solid #e3f2fd; padding-left:16px; margin-left:26px; }
        .contained-label { font-size:11px; color:#888; font-weight:500; margin-bottom:8px; text-transform:uppercase; letter-spacing:.5px; }
        .contained-item { background:#fafafa; border:1px solid #e8e8e8; border-radius:10px; padding:10px; margin-bottom:6px; display:flex; align-items:center; gap:10px; transition:all .15s ease; }
        .contained-item:hover { border-color:#d0d0d0; box-shadow:0 1px 4px rgba(0,0,0,0.08); }
        .contained-item.featured { background:linear-gradient(135deg,#fff3e0 0%,#fce4ec 100%); border-color:#ffb74d; position:relative; }
        .contained-item.featured::before { content:"★"; position:absolute; top:-2px; right:-2px; background:#ff9800; color:#fff; width:16px; height:16px; border-radius:50%; font-size:10px; display:flex; align-items:center; justify-content:center; }
        .contained-image { width: 50px; background:#f8f9fa; border-radius:4px; display:flex; align-items:center; justify-content:center; font-size:16px; flex-shrink:0; }
        .contained-details { flex:1; min-width:0; }
        .contained-name { font-size:13px; font-weight:500; color:#555; line-height:1.3; }
        .contained-price { font-size:12px; color:#888; margin-top:1px; }
        .contained-actions { display:flex; align-items:center; gap:6px; }
        .quantity-controls{ display:flex; align-items:center; background:#f8f9fa; border-radius:16px; padding:2px; }
        .qty-btn{ width:22px; height:22px; border:none; background:white; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:500; color:#666; transition:all .15s ease; }
        .qty-btn:hover{ background:#333; color:#fff; }
        .quantity{ margin:0 6px; font-size:11px; font-weight:500; min-width:14px; text-align:center; color:#333; }
        .remove-btn{ width:18px; height:18px; border:none; background:none; color:#ccc; cursor:pointer; font-size:14px; display:flex; align-items:center; justify-content:center; transition:color .15s ease; }
        .remove-btn:hover{ color:#ff4444; }

        .main-quantity-controls{ display:flex; align-items:center; background:#f0f7ff; border-radius:20px; padding:3px; }
        .main-qty-btn{ width:26px; height:26px; border:none; background:white; border-radius:50%; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:600; color:#1976d2; transition:all .15s ease; box-shadow:0 1px 3px rgba(0,0,0,0.1); }
        .main-qty-btn:hover{ background:#1976d2; color:white; }
        .main-quantity{ margin:0 10px; font-size:13px; font-weight:600; min-width:18px; text-align:center; color:#1976d2; }
        .main-remove-btn{ width:22px; height:22px; border:none; background:none; color:#bbb; cursor:pointer; font-size:16px; display:flex; align-items:center; justify-content:center; transition:color .15s ease; }
        .main-remove-btn:hover{ color:#ff4444; }

        .mochila{ max-width:1200px; width: 80%; }
        .bottom-nav{
            position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
            max-width: 380px; width: calc(100% - 40px);
            background: rgba(255,255,255,0.1); backdrop-filter: blur(2px); -webkit-backdrop-filter: blur(2px);
            border: 1px solid transparent; background-clip: padding-box; border-radius: 24px;
            display: none; justify-content: space-around; padding: 1px 8px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.2), inset 0 -1px 0 rgba(255,255,255,0.1);
            overflow: hidden;
        }
        .bottom-nav::before{
            content:''; position:absolute; inset:0; border-radius:24px; padding:1px;
            background: linear-gradient(135deg, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0.1) 25%, rgba(255,64,129,0.2) 50%, rgba(33,150,243,0.2) 75%, rgba(255,255,255,0.1) 100%);
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: xor; -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor; pointer-events:none;
        }
        .subtotal-wrap{ position:fixed; right:16px; bottom:16px; z-index:50; width:min(360px, 92vw); }
        .subtotal-card{ display:flex; flex-direction:column; justify-content:center; align-items:center; border-radius:10px; min-width:280px; }
        .subtotal-row{ display:flex; flex-direction:row; width:100%; justify-content:center; align-items:center; gap:0px; }
        .subtotal-row h5{ color:#e3e3e3; font-weight:100; font-size:14px; margin:0 }
        .subtotal-input{ text-align:center; color:#fff; background:none; border:none; appearance:none; width:35%; font-size:24px; }
        .btn{ background:#b10000; padding: 4px 20px; border-radius:9px; color:#fff; border:none; cursor:pointer; width:100% }
        .btn[disabled]{ opacity:.55; cursor:not-allowed; filter:grayscale(.2) }
        .btn-link{ background:#b10000; padding:8px 20px; border-radius:6px; color:#fff; text-decoration:none; display:inline-block; }

        .hidden-input{position:absolute;left:-9999px;opacity:0;width:1px;height:1px}
        .mochila{margin:auto}
        @media (max-width:1200px){ .mochila{ width:100%; margin-bottom:150px } }
        @media (max-width:930px){ .price-m{ font-size:14px } }
        @media (max-width:800px){
            .detalle{ display:none; }
            .bags{width:100%}
            footer{display:none}
            .categoria {font-size:10px}
            .bottom-nav{display:flex}
        }

        /* Animaciones */
        @keyframes pulseScale { 0%{transform:scale(1)} 50%{transform:scale(1.2)} 100%{transform:scale(1)} }
        @keyframes bobY { 0%{transform:translateY(0)} 50%{transform:translateY(5px)} 100%{transform:translateY(0)} }
        .wiggly-icon{ display:inline-flex; align-items:center; justify-content:center; cursor:pointer; transform-origin:50% 50%; animation:pulseScale 1.6s ease-in-out infinite; will-change:transform; font-variation-settings:"wght" 500,"opsz" 24; transition:filter .2s ease; }
        .wiggly-icon:hover{ animation:pulseScale 1.6s ease-in-out infinite, bobY .9s ease-in-out infinite; filter:brightness(1.05); }
        @media (prefers-reduced-motion: reduce){ .wiggly-icon, .wiggly-icon:hover{ animation:none; transform:none; } }
        .toggle-arrow{ transition: transform .25s ease; user-select:none; }
        .toggle-arrow.rotated{ transform: rotate(180deg); }
        .dv-hidden { display:none; }
        .dv-show { display:block; }

        /* ---------- NUEVO DISEÑO para MODALES de selección (kits / artículos) ---------- */
        .psm-box{
          background:#fff; border-radius:14px; box-shadow:0 20px 50px rgba(0,0,0,.25);
          width:min(1100px,95vw); max-height:90vh; display:flex; flex-direction:column; overflow:hidden;
        }
        .psm-head{
          padding:16px 20px; border-bottom:1px solid #e5e7eb;
          background: linear-gradient(90deg,#eef4ff,#f4f6ff);
        }
        .psm-head-row{ display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; }
        .psm-title{ margin:0; font-size:24px; font-weight:800; color:#111827; }
        .psm-sub{ font-size:13px; color:#64748b; margin-top:4px; }
        .psm-close{ border:0; background:transparent; padding:8px; border-radius:10px; cursor:pointer; }
        .psm-close:hover{ background:#f1f5f9; }

        .psm-controls{
          display:grid;
          grid-template-columns: 1fr; /* solo la barra de búsqueda */
          gap:12px;
        }
        .psm-search{ position:relative; }
        .psm-search input{
          width:100%; padding:11px 12px 11px 36px; border:1px solid #d1d5db; border-radius:10px;
        }
        .psm-search .mi{ position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#94a3b8; }
        .psm-select, .psm-input{
          width:100%; padding:11px 12px; border:1px solid #d1d5db; border-radius:10px; background:#fff;
        }
        .psm-range{ display:flex; align-items:center; gap:8px; }
        .psm-range input{ width:100%; }

        .psm-view{ display:flex; border:1px solid #d1d5db; border-radius:10px; overflow:hidden; }
        .psm-view button{
          flex:1; padding:10px; border:0; background:#fff; color:#475569; cursor:pointer;
        }
        .psm-view button.active{ background:#2563eb; color:#fff; }
        .psm-view button + button{ border-left:1px solid #d1d5db; }

        .psm-body{ padding:18px; overflow:auto; max-height:calc(90vh - 200px); }
        .psm-grid{ display:grid; grid-template-columns: repeat(4,minmax(0,1fr)); gap:16px; }
        @media (max-width:1100px){ .psm-grid{ grid-template-columns: repeat(3,minmax(0,1fr)); } }
        @media (max-width:820px){  .psm-grid{ grid-template-columns: repeat(2,minmax(0,1fr)); } }
        @media (max-width:520px){  .psm-grid{ grid-template-columns: repeat(2,minmax(0,1fr)); } }

        .psm-card{
          border:1px solid #e5e7eb; border-radius:12px; overflow:hidden; background:#fff;
          transition:.15s; cursor:pointer;height:100%
        }
        .psm-card:hover{ box-shadow:0 10px 24px rgba(0,0,0,.08); transform:translateY(-2px); }
        .psm-img{ width:100%; height:180px; object-fit:cover; display:block; }
        .psm-badge{
          position:absolute; top:10px; left:10px; background:#ef4444; color:#fff; font-size:12px; padding:4px 8px; border-radius:8px;
        }
        .psm-chip{ font-size:11px; padding:4px 8px; border-radius:999px; background:#f1f5f9; color:#475569; }
        .psm-meta{ display:flex; align-items:center; justify-content:space-between; margin:6px 0 10px 0; }
        .psm-price{ font-weight:800; font-size:18px; color:#111827; }
        .psm-old{ font-size:12px; color:#9ca3af; text-decoration:line-through; display:block; }
        .psm-rating{ display:flex; align-items:center; gap:4px; color:#f59e0b; }
        .psm-stock{ font-size:12px; font-weight:600; }
        .psm-stock.green{ color:#16a34a; } .psm-stock.yellow{ color:#ca8a04; } .psm-stock.red{ color:#dc2626; }

        .psm-footer{ padding:14px 20px; border-top:1px solid #e5e7eb; background:#f9fafb; display:flex; align-items:center; justify-content:space-between; }
        .psm-btn{ padding:9px 14px; border-radius:10px; border:0; cursor:pointer; }
        .psm-btn.cancel{ background:transparent; color:#374151; }
        .psm-btn.primary{ background:#2563eb; color:#fff; }
        /* Campo de cupón con botón X integrado */
.coupon-field{ position:relative; width:100% }
.coupon-code-input{ padding:10px 36px 10px 10px; border-radius:5px; border:1px solid #cacaca;width:100%; background:#ff9d9d; color:#fff; }
.coupon-clear{
  position:absolute; right:6px; top:50%; transform:translateY(-50%);
  width:28px; height:28px; border:0; background:transparent; cursor:pointer; display:none;
  align-items:center; justify-content:center;
}
.coupon-clear .material-symbols-outlined{ font-size:20px; color:#b10000 }

/* Estados cuando el cupón está aplicado */
.coupon-applied .coupon-code-input{ background:#ffd0d0; color:#333 }
.coupon-applied .coupon-clear{ display:inline-flex }
.coupon-applied .coupon-apply{ opacity:.6; pointer-events:none }

    </style>
</head>
<body>
   
    <nav style="width:100%;height:100px;position:relative;filter:invert(1)">
        <div style="display:flex;align-items:center;height:100px;justify-content:center;">
            <a href="{{url('/')}}"><img src="{{asset('image/logo1_BN.png')}}" class="logo1" style="width:180px;padding-top:5px"></a>
        </div>
        
    </nav>

    <!-- MODAL MOCHILA (sin cambios funcionales) -->
    <div id="modalmochila" style="backdrop-filter: grayscale(1);position:fixed;overflow:hidden;width:100%;height:100vh;background:rgba(0,0,0,.5);top:-2000px;left:0px;z-index:999;opacity:0;transition: opacity 400ms ease-in;">
      <div style="display:flex;align-items:center;justify-content:center;flex-direction:row;height:100vh;">
        <div style="display:flex;flex-direction:column;width:600px;transition: all 500ms ease-in;background:black;border-radius: 20px;">
          <div style="font-size:18px; font-weight:bold;padding:15px;border-radius:10px 10px 0px 0px;color:black;display:flex;flex-direction:row;justify-content:space-between;">
            <h5 style="font-weight:100;color:wheat">Seleccione el kit de su preferencia:</h5>
            <span onclick="cerrarMochila()" class="material-symbols-outlined" style="cursor:pointer;color:wheat">close</span>
          </div>
          <div style="position:relative;border-radius:5px;margin-top:15px;">
            <div style="display:flex;flex-direction:row;flex-wrap:wrap;width:100%;justify-content:center;align-items:center;border-radius:5px;">
              <div style="width:100%;padding:20px">
                <div style="width:100%;display:flex;flex-wrap:wrap;flex-direction:row;justify-content:center;align-content:center;gap:20px;background:black;border-radius:20px">
                  <a href="{{ route('nuevamochila.item', ['idarticulo' => 1, 'color' => 'red']) }}" class="" style="width:30%;">
                    <div class="firststyle" style="background:none;border:none">
                      <img src="{{asset('image/bagi.webp')}}" style="border-radius: 20px;background:black;width:100%" onmouseover="this.style.backgroundColor='wheat'" onmouseout="this.style.backgroundColor='black'" class="imagenp">
                    </div>
                  </a>   
                  <a href="{{ route('nuevamochila.item', ['idarticulo' => 2, 'color' => 'blue']) }}" class="" style="width:30%;">
                    <div class="firststyle" style="background:none;border:none">
                      <img src="{{asset('image/bagi3.webp')}}" style="border-radius: 20px;background:black;width:100%" onmouseover="this.style.backgroundColor='wheat'" onmouseout="this.style.backgroundColor='black'" class="imagenp">
                    </div>                                            
                  </a>  
                  <a href="{{ route('nuevamochila.item', ['idarticulo' => 3, 'color' => 'black']) }}" class="" style="width:30%;">
                    <div class="firststyle" style="background:none;border:none">
                      <img src="{{asset('image/bagi4.webp')}}" style="border-radius: 20px;background:black;width:100%" onmouseover="this.style.backgroundColor='wheat'" onmouseout="this.style.backgroundColor='black'" class="imagenp">
                    </div>                                           
                  </a>  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>      

    <div class="mochila" style="padding:1rem;position;relative;">
      <div style="display:flex;flex-direction:row;width:100%;justify-content:center;gap:0.8rem;border-radius:10px;">
        <div class="bags" style="position:relative;padding:10px;display:flex;flex-direction:column;gap:15px;">
          <div style="display:flex;flex-direction:row;width:100%;justify-content: right;gap:10px">
            <a href="{{asset('busco')}}"><div style="width:fit-content;border:1px solid #b10000;border-radius: 8px;font-size: 15px;color:#b10000;padding: 5px 15px;">Seguir comprando</div></a>
            <div onclick="abrirMochila()" style="cursor:pointer;width:fit-content;background:#b10000;border-radius: 8px;font-size: 15px; color: white;padding: 5px 15px;">Agregar Mochila</div>
          </div>

          <!--- PRODUCTO FOREACH -->
          @foreach ($items as $tipo => $mochila)
          <div class="cart-section">
            <div class="main-product">
              @php
                $colorFondo = ($mochila['color'] === 'red') ? '#b10000' : (($mochila['color'] === 'blue') ? '#243cb1' : '#282828');
              @endphp
              @foreach ($mochila['items'] as $id => $detalle)
                @if ($id>= 1 && $id<= 5)
                  <a href="{{ route('mochila.eliminar.get', $tipo) }}"><span class="material-symbols-outlined" style=" position:absolute;left:0;top:0; background:{{ $colorFondo }};cursor:pointer;border-radius:5px;align-items:center;text-align:center;display:flex;justify-content:center;color:white;box-shadow:2px 2px 3px #282828;padding:3px;font-size:18px;">delete</span></a>

                  <div style="margin-bottom: -20px;z-index:9;display: flex;justify-content: right;border-radius:5px;align-items:center;text-align:center;color:white;padding:3px;font-size:18px;position:absolute;right:0;top:0">
                    <div style=" display:flex;flex-direction:column;padding:5px 10px;text-align:center;border-radius:10px;">
                      <h3 style="color:red;" class="price-m">S/. {{ number_format($totalesPorGrupo[$tipo], 2) }}</h3>
                    </div>
                  </div>

                  <div class="product-header">    
                    <div style="display:flex;flex-direction:row;gap:0.8rem;width:70%"> 
                      <img src="{{ asset('/image/productos/' . ($catalogo[$id]->image ?? 'default.png')) }}" alt="" style="width:20%">
                      <div style="display:flex;flex-direction:column;width:60%;">
                        <h3 style="width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $catalogo[$id]->name ?? 'Producto' }}</h3>
                        <h5 style="color:#929292;" class="categoria">{{ $catalogo[$id]->categoria ?? '' }}</h5>
                      </div>
                    </div>
                    <div style="display:flex;flex-direction:row;justify-content:center;align-items:center;gap:5px;">                            
                      <div style="display:flex;flex-direction:row;justify-content:center;align-items:center;gap:5px;">
                        <div onclick="ventana('{{$tipo}}')" style="background:{{ $colorFondo }};cursor:pointer;border-radius:5px;align-items:center;text-align:center;display:flex;justify-content:center;color:white;box-shadow:2px 2px 3px #282828;padding:3px;font-size:18px;"><span class="material-symbols-outlined">add</span></div>
                      </div> 
                    </div>
                  </div>
                @endif
              @endforeach

              <div class="contained-items">
                @if (!empty($mochila['kit']))
                  @php $kid = $mochila['kit']['id']; @endphp
                  <div class="contained-item featured" style="justify-content: space-between;">
                    <div style="display:flex;flex-direction:row;gap:0.8rem;width:15%;">
                      <img src="{{ asset('/image/productos/'.$catalogo[$kid]->image) }}" alt="" style="width:100%">
                      <div style="display:flex;flex-direction:column;">
                        <h3 style="width:100%;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#282828;text-transform:uppercase">
                          {{ $catalogo[$kid]->name ?? 'Kit' }}
                        </h3>
                        <h5 style="color:#888">S/. {{ number_format($mochila['kit']['precio'], 2) }}</h5>
                      </div>
                    </div>
                    <div style="display:flex;flex-direction:row;justify-content:center;align-items:center;gap:5px;">
                      <div style="display:flex;flex-direction:column;justify-content:center;align-items:center;gap:5px;">
                        <a href="{{ route('eliminar-kit', ['ids' => $tipo]) }}">
                          <div style="background:#282828;cursor:pointer;border-radius:5px;align-items:center;text-align:center;display:flex;justify-content:center;color:white;box-shadow:2px 2px 3px #282828;padding:3px;font-size:18px">
                            <span class="material-symbols-outlined">close</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                @endif

                @php
                  $mostrarDiv = false;
                  foreach ($mochila['items'] as $id => $d) {
                      if ($id >= 20) { $mostrarDiv = true; break; }
                  }
                @endphp

                @foreach ($mochila['items'] as $id => $detalle)
                  @if ($id >= 20)
                  <div class="contained-item">
                    <div class="contained-image">
                      <img src="{{asset('image/productos/'.$catalogo[$id]->image)}}" alt="" style="width:100%;border-radius: 8px;">
                    </div>
                    <div class="contained-details">
                      <div class="contained-name">{{ $catalogo[$id]->name ?? 'Artículo' }}</div>
                      <div class="contained-price">S/. {{ number_format($detalle['precio'], 2) }}</div>
                    </div>
                    <div class="contained-actions">
                      <div class="quantity-controls">
                        <a href="{{ route('disminuirarticulo', ['ids'=>$tipo,'idarticulo'=>$id]) }}" class="qty-btn"><span class="material-symbols-outlined">remove</span></a>
                        <div class="quantity">{{ $detalle['qty'] }}</div>
                        <a href="{{ route('agregararticulo', ['ids'=>$tipo,'idarticulo'=>$id]) }}" class="qty-btn"><span class="material-symbols-outlined">add</span></a>
                      </div>
                    </div>
                    <a href="{{ route('eliminar', ['ids'=>$tipo,'idarticulo'=>$id]) }}" class="remove-btn"><span class="material-symbols-outlined">delete</span></a>
                  </div>
                  @endif
                @endforeach
              </div>

              <!-- ==================== MODAL KIT (nuevo diseño, misma lógica) ==================== -->
              <div id="modal{{$tipo}}" style="backdrop-filter: grayscale(1);position:fixed;overflow:hidden;width:100%;height:100vh;background:rgba(0,0,0,.5);top:-2000px;left:0px;z-index:999;opacity:0;transition: opacity 400ms ease-in;">
                <div style="display:flex;align-items:center;justify-content:center;flex-direction:row;height:100vh;">
                  <div class="psm-box">
                    <!-- Header -->
                    <div class="psm-head">
                      <div class="psm-head-row">
                        <div>
                          <h2 class="psm-title">Seleccionar Kits</h2>
                          <p class="psm-sub">{{ count($paquetes ?? []) }} opciones disponibles</p>
                        </div>
                        <button class="psm-close" onclick="cerrarmodal('{{$tipo}}')"><span class="material-symbols-outlined">close</span></button>
                      </div>
                      <!-- Controles visuales -->
                      <div class="psm-controls">
                        <div class="psm-search">
                          <span class="material-symbols-outlined mi">search</span>
                          <input class="psm-search-input" placeholder="Buscar kits... (mín. 3 letras)" data-grid="#kitsGrid-{{$tipo}}">
                        </div>
                        
                        
                        
                        <div class="psm-view">
                          <button class="active"><span class="material-symbols-outlined">grid_view</span></button>
                          <button><span class="material-symbols-outlined">view_list</span></button>
                        </div>
                      </div>
                    </div>

                    <!-- Body -->
                    <div class="psm-body">
                      <div class="psm-grid" id="kitsGrid-{{$tipo}}">
                        @foreach($paquetes as $paquete)
                          @php
                            $hasOffer = isset($paquete->preciof) && $paquete->preciof > 0 && $paquete->precio > 0;
                            $showPrice = number_format($paquete->precio,2);
                            $showOffer = $hasOffer ? number_format($paquete->preciof,2) : null;
                            $discount = $hasOffer ? max(0, round((1 - ($paquete->preciof / $paquete->precio)) * 100)) : null;
                            $imgKit = "https://unomasuno.pe/wp-content/uploads/2022/03/mafa-001.jpg";
                          @endphp
                          <a href="{{ route('paquete', ['ids' => $tipo, 'idarticulo' => $paquete->id]) }}" style="text-decoration:none;color:inherit;">
                            <div class="psm-card" data-name="{{ strtolower($paquete->name ?? '') }}" data-categoria="kit">
                              <div style="position:relative">
                                <img src="{{asset('image/productos/'.$paquete->image) }}" class="psm-img" alt="{{ $paquete->name }}">
                                @if($discount)
                                  <div class="psm-badge">-{{ $discount }}%</div>
                                @endif
                              </div>
                              <div style="padding:12px">
                                <div style="display:flex;align-items:start;justify-content:space-between;gap:8px">
                                  <h3 style="font-weight:700;color:#0f172a;font-size:14px;line-height:1.25">{{ $paquete->name }}</h3>
                                  <span class="psm-chip">Kit</span>
                                </div>
                                <div class="psm-meta">
                                  <div>
                                    @if($hasOffer)
                                      <span class="psm-old">S/. {{ $showPrice }}</span>
                                      <div class="psm-price">S/. {{ $showOffer }}</div>
                                    @else
                                      <div class="psm-price">S/. {{ $showPrice }}</div>
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                          </a>
                        @endforeach
                      </div>
                    </div>

                    <div class="psm-footer">
                      <span style="font-size:13px;color:#6b7280">Haz clic en una tarjeta para agregar el kit</span>
                      <div>
                        <button class="psm-btn cancel" onclick="cerrarmodal('{{$tipo}}')">Cancelar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ==================== FIN MODAL KIT ==================== -->

              <!-- ==================== MODAL ARTÍCULO (nuevo diseño, misma lógica) ==================== -->
              <div id="articulo{{$tipo}}" style="position:fixed;overflow:hidden;width:100%;height:100vh;background:rgba(0,0,0,.5);top:-2000px;left:0px;z-index:999;opacity:0;transition: opacity 400ms ease-in;">
                <div style="display:flex;align-items:center;justify-content:center;flex-direction:row;height:100vh;">
                  <div class="psm-box">
                    <!-- Header -->
                    <div class="psm-head">
                      <div class="psm-head-row">
                        <div>
                          <h2 class="psm-title">Seleccionar Artículos</h2>
                          <p class="psm-sub">{{ count($articulos ?? []) }} productos disponibles</p>
                        </div>
                        <button class="psm-close" onclick="cerrararticulo('{{$tipo}}')"><span class="material-symbols-outlined">close</span></button>
                      </div>
                      <!-- Controles visuales -->
                      <div class="psm-controls">
                        <div class="psm-search">
                          <span class="material-symbols-outlined mi">search</span>
                          <input class="psm-search-input" placeholder="Buscar productos... (mín. 3 letras)" data-grid="#artsGrid-{{$tipo}}">
                        </div>
                        
                      </div>
                    </div>

                    <!-- Body -->
                    <div class="psm-body">
                      <div class="psm-grid" id="artsGrid-{{$tipo}}">
                        @foreach($articulos as $paquete)
                          @php
                            $hasOffer = isset($paquete->preciof) && $paquete->preciof > 0 && $paquete->precio > 0;
                            $showPrice = number_format($paquete->precio,2);
                            $showOffer = $hasOffer ? number_format($paquete->preciof,2) : null;
                            $discount = $hasOffer ? max(0, round((1 - ($paquete->preciof / $paquete->precio)) * 100)) : null;
                            $imgArt = "https://unomasuno.pe/wp-content/uploads/2022/03/mafa-001.jpg";
                            $stock = isset($paquete->stock) ? (int)$paquete->stock : 0;
                            $stockClass = $stock>20 ? 'green' : ($stock>0 ? 'yellow':'red');
                            $rating = isset($paquete->rating)? $paquete->rating : null;
                          @endphp
                          <a href="{{ route('agregararticulo', ['ids' => $tipo, 'idarticulo' => $paquete->id]) }}" style="text-decoration:none;color:inherit;">
                            <div class="psm-card" data-name="{{ strtolower($paquete->name ?? '') }}"     data-categoria="{{ strtolower($paquete->categoria ?? 'articulo') }}">
                              <div style="position:relative">
                                <img src="{{ asset('image/productos/'.$paquete->image)}}" class="psm-img" alt="{{ $paquete->name }}">
                                @if($discount)
                                  <div class="psm-badge">-{{ $discount }}%</div>
                                @endif
                              </div>
                              <div style="padding:12px">
                                <div style="display:flex;align-items:start;justify-content:space-between;gap:8px">
                                  <h3 style="font-weight:700;color:#0f172a;font-size:14px;line-height:1.25">{{ $paquete->name }}</h3>
                                  <span class="psm-chip">{{ $paquete->categoria ?? 'Artículo' }}</span>
                                </div>
                                <p style="font-size:12px;color:#6b7280;margin:6px 0 10px 0;line-height:1.3;max-height:34px;overflow:hidden;text-overflow:ellipsis;">
                                  {{ $paquete->description ?? ' ' }}
                                </p>

                                <div class="psm-meta">
                                  <div>
                                    @if($hasOffer)
                                      <span class="psm-old">S/. {{ $showPrice }}</span>
                                      <div class="psm-price">S/. {{ $showOffer }}</div>
                                    @else
                                      <div class="psm-price">S/. {{ $showPrice }}</div>
                                    @endif
                                  </div>
                                  <div style="text-align:right">
                                    <div class="psm-rating">
                                      <span class="material-symbols-outlined" style="font-size:18px">star</span>
                                      <span style="font-size:12px;color:#475569">{{ $rating ? number_format($rating,1) : '4.5' }}</span>
                                    </div>
                                    <div class="psm-stock {{ $stockClass }}">{{ $stock>0 ? $stock.' disponibles' : 'Sin stock' }}</div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </a>
                        @endforeach
                      </div>
                    </div>

                    <div class="psm-footer">
                      <span style="font-size:13px;color:#6b7280">Haz clic en una tarjeta para agregar un artículo</span>
                      <div>
                        <button class="psm-btn cancel" onclick="cerrararticulo('{{$tipo}}')">Cancelar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- ==================== FIN MODAL ARTÍCULO ==================== -->

              <!-- Ventana menú (sin cambios) -->
              <div id="ventana{{$tipo}}" style="backdrop-filter: grayscale(1);position:fixed;overflow:hidden;width:100%;height:100vh;background:rgba(0,0,0,.5);top:-2000px;left:0px;z-index:999;opacity:0;transition: opacity 400ms ease-in;">
                <div style="display:flex;align-items:center;justify-content:center;flex-direction:row;height:100vh;">
                  <div style="display:flex;background:white;width:0%;min-width:500px;max-width:1000px;border-radius:15px;flex-direction:column;transition: all 500ms ease-in;padding:10px;padding-bottom: 30px;">
                    <span onclick="cerrarventana('{{$tipo}}')" class="material-symbols-outlined" style="cursor:pointer;display:flex;justify-content:flex-end;">close</span>
                    <div class="row" style="height:90px;padding:10px;justify-content:center;gap:15px;">
                      <div onclick="abrirarticulo('{{$tipo}}')" style="height:100%;display:flex;flex-direction:row;background:#b10000;color:white;padding:10px;border-radius:15px;width:150px;text-align:center;cursor:pointer;">
                        <img src="{{asset('image/svg/boticar.svg')}}" style="width:25%" alt="">
                        <div style="width:75%">Agregar articulo</div>
                      </div>
                      <div onclick="abrirmodal('{{$tipo}}')" style="height:100%;align-items: center;display:flex;flex-direction:row;background:#b10000;color:white;padding:10px;border-radius:15px;width:150px;text-align:center;cursor:pointer;">
                        <img src="{{asset('image/svg/boti.svg')}}" style="width:25%" alt="">
                        <div style="width:75%">Agregar KIT</div>
                      </div>     
                    </div>                            
                  </div>
                </div>
              </div>
              <!-- Fin Ventana -->
            </div>
          </div>
          @endforeach
          <!-- end foreach -->
        </div>   

        <!-- SUBTOTAL flotante -->
        <div id="detalle-venta" class="bottom-nav dv-hidden" style="position:fixed;bottom:188px;background:rgb(255 255 255 / 68%);padding:15px;z-index:9">
          <h4 style="width:80%;">Resumen de compra:</h4>
          <div class="row" style="width:80%;position:relative;margin:auto;color:#808080">
            <h5>Cantidad de productos:</h5>
            <h5>{{$productos}} </h5>
          </div>
          <div class="row" style="width:80%;position:relative;margin:auto;color:#808080">
            <h5>Mochilas:</h5>
            <h5>S/. {{ number_format($totalmochila, 2) }}</h5>
          </div>
          <div class="row" style="width:80%;position:relative;margin:auto;color:#808080">
            <h5>Kits:</h5>
            <h5>S/. {{ number_format($totalkit, 2) }}</h5>
          </div>
          <div class="row" style="width:80%;position:relative;margin:auto;color:#808080">
            <h5>Articulos:</h5>
            <h5>S/. {{ number_format($totalarticulo, 2) }}</h5>
          </div>
          <div class="row" style="width:80%;position:relative;margin:auto;color:#808080;border:1px solid white;padding:3px;border-radius:3px;">
            <h5>Descuento:</h5>
            <h5>S/. {{ number_format($cupon_descuento ?? 0, 2) }}</h5>
          </div>
          <div class="row" style="width:80%;position:relative;margin:auto;color:#808080;background:white;padding:3px;border-radius:3px;margin-top:5px;">
            <h5>Total:</h5>
            <h5>S/. {{ number_format($total,2)}} </h5>
          </div>
        </div>

        <div class="bottom-nav">
          <div class="subtotal-card elemento" style="width:100%">
            <div class="subtotal-row" style="display:flex;flex-direction:column">
              <span class="material-symbols-outlined wiggly-icon toggle-arrow" id="btn-detalle" aria-controls="detalle-venta" aria-expanded="false" role="button" tabindex="0">keyboard_arrow_up</span>
              
              <div style="font-size:32px;font-weight:700;color:#1f2937;display:flex;align-items:center;justify-content:flex-start;gap:8px;">
                <span style="font-size:12px;color:#6b7280;">Subtotal: S/ </span>
                <div id="total" class="subtotal-input" style="font-size:20px;font-weight:700;color:#1f2937;">{{ number_format($total,2) }}</div>
              </div>
            </div>

            <!-- NUEVO: campo cupón para móvil -->
            <div class="subtotal-row" id="coupon_box_mobile" style="width:100%;display:flex;flex-direction:column;gap:6px;margin-top:8px">
              <div class="coupon-field">
                <input type="text" id="coupon_code_m" class="coupon-code-input" placeholder="Cupón">
                <button id="coupon_clear_m" class="coupon-clear" aria-label="Quitar cupón" title="Quitar cupón">
                  <span class="material-symbols-outlined">close</span>
                </button>
              </div>
              <small id="coupon_msg_m" style="color:#b10000;min-height:18px"></small>
            </div>

            {{ csrf_field() }}

            <!-- Botones: Aplicar + Continuar lado a lado -->
            <div class="subtotal-row" style="display:flex;gap:8px;width:100%">
              <button id="btnApplyCouponMobile" class="btn coupon-apply" style="flex:1;border:1px solid #b10000;background:none;color:#b10000">Aplicar</button>
              <a href="{{ url('delivery') }}" id="botonContinuar" class="btn" style="flex:1;text-align:center">Continuar</a>
            </div>
          </div>
        </div>
     
         
        <div class="detalle" style="position:relative;">
          <div id="coupon_timer_wrap" style="display: {{ $cupon_expires ? 'flex':'none' }}; text-align:center;    align-items: center;  right: 23px;position:absolute;top:17px;color:#808080;gap: 7px;
    font-size: 12px;">
            <span class="material-symbols-outlined" style="font-size:15px">nest_clock_farsight_analog</span>
      
                      
                      <strong id="coupon_timer" data-expires="{{ $cupon_expires }}">{{ $cupon_expires ? '' : '' }}</strong>
                    
                      
          </div>           
          <div class="column" style="background:white;border-radius:15px;box-shadow: 0px 0px 3px #dbdbdb;padding:10px;padding-bottom:20px;" >
            <h4 style="width:80%;">Resumen de compra:</h4>
            <div class="row" style="width:80%;position:relative;margin:auto;color:#808080">
              <h5>Cantidad de productos:</h5>
              <h5>{{$productos}} </h5>
            </div>
            <div class="row" style="width:80%;position:relative;margin:auto;color:#808080">
              <h5>Mochilas:</h5>
              <h5>S/. {{ number_format($totalmochila, 2) }}</h5>
            </div>
            <div class="row" style="width:80%;position:relative;margin:auto;color:#808080">
              <h5>Kits:</h5>
              <h5>S/. {{ number_format($totalkit, 2) }}</h5>
            </div>
            <div class="row" style="width:80%;position:relative;margin:auto;color:#808080">
              <h5>Articulos:</h5>
              <h5>S/. {{ number_format($totalarticulo, 2) }}</h5>
            </div>
            <div class="row" style="width:80%;position:relative;margin:auto;color:#808080;border:1px solid white;padding:3px;border-radius:3px;">
              <h5>Descuento:</h5>
              <h5>S/. {{ number_format($cupon_descuento ?? 0, 2) }}</h5>
            </div>
            <div class="row" style="width:80%;position:relative;margin:auto;color:#808080;background:white;padding:3px;border-radius:3px;margin-top:5px;">
              <h5>Total:</h5>
              <h5>S/. {{ number_format($total,2)}} </h5>
            </div>
            <div style="position:relative;width:100%;display:flex;margin-top:20px">
            
              <div class="elemento" style="display:flex;flex-direction: column;justify-content:center;align-items:center;gap:0.8rem;background:white;padding:10px;border-radius:15px;width:100%;box-shadow: 0px 0px 3px #bdbdbd;">

                <!-- Campo + X integrada -->
                <div class="coupon-field" id="coupon_box_desktop">
                  <input type="text" id="coupon_code" class="coupon-code-input" placeholder="Insertar cupón">
                  <button id="coupon_clear" class="coupon-clear" aria-label="Quitar cupón" title="Quitar cupón">
                    <span class="material-symbols-outlined">close</span>
                  </button>
                </div>

                <small id="coupon_msg" style="color:#b10000;min-height:18px">
                  @if($cupon_codigo) Cupón activo: {{ $cupon_codigo }} @endif
                </small>

                <div style="display:flex;gap:8px;margin-top:10px;width:100%">
                  <!-- Unico botón de aplicar -->
                  <button id="btnApplyCouponDesktop" class="btn coupon-apply" style="flex:1;border:1px solid #b10000;background:none;color:#b10000">
                    Aplicar
                  </button>
                  <!-- Continuar se mantiene -->
                  <a href="{{ url('delivery') }}" class="btn" style="flex:1;text-align:center">Continuar</a>
                </div>
              </div>

                
                
              
              </div>
            
          </div>

          

          <div style="margin-top:15px;background:#f7e394;width:100%;border-radius:5px;padding:5px;">
            <h5 style="color:#afa169;font-size:12px;text-align:center;">Solo esta permitido un kit por mochila, los kits no se venden por separado. Al comprar atraves de nuestra web acepta los términos y condiciones.</h5>
          </div>

          <div style="padding: 20px;display: block;border:1px solid rgba(0,0,0,.1);border-radius: 8px;background:white;margin-top:15px;">
            <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 20px;margin:0px;color:#808080">Garantía</h5>
            <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 15px;margin:0px;color:#282828;margin-top: 20px;">Compra procesada y garantia 12 meses por Grupo Oberlu</h5>
            <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 12px;margin:0px;color:#808080;margin-top: 20px;text-align: justify;">Toda compra es procesada por Grupo Oberlu, desde la confirmacion de pago hasta la entrega del producto, brindando adicionalmente el servicio de garantía procesada por Grupo Oberlu,cumpliendo los <a href="">terminos y condiciones de garantia.</a></h5>
            <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 15px;margin:0px;color:#282828;margin-top:20px;">Compra protegida con Adler Emergency</h5>
            <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 12px;margin:0px;color:#808080;margin-top: 20px;text-align: justify;border-bottom:1px solid #d1d1d1;padding-bottom: 20px;">Los pagos realizados a traves del dominio www.adleremergency.com son procesados y verificados por Adler Emergency, quien administra los pagos que usted realice mediante cualquier metodo de pago. Verifique los <a href="">terminos y condiciones Adler Emergency.</a></h5>
            <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 20px;margin:0px;color:#808080;margin-top: 20px;">Medios de pago</h5>
            <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 15px;margin:0px;color:#282828;margin-top: 20px;">Tarjeta de debito y credito | Compra online</h5>
            <div style="width:100%;position: relative;float: left;">
              <img src="{{asset('image/svg/visa.svg')}} " style="width:15%;position:relative;float: left;display: inline-block;">
              <img src="{{asset('image/svg/tarjeta-mastercard.svg')}} " style="width:15%;position:relative;float: left;display: inline-block;margin-left: 15px;">
            </div>
            <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 15px;margin:0px;color:#282828;margin-top: 20px;">Transferencia directa Banco - Banco</h5>
            <div style="width:100%;position: relative;float: left;">
              <img src="{{asset('image/logo-interbank.png')}} " style="width:20%;position:relative;float: left;display: inline-block;margin-top: 10px;">
              <img src="{{asset('image/bcp.jpg')}} " style="width:20%;position:relative;float: left;display: inline-block;margin-left: 15px;margin-top:5px;">
              <img src="{{asset('image/scotiabank.png')}} " style="width:20%;position:relative;float: left;display: inline-block;margin-left: 15px;margin-top:15px;">
            </div>
            <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 15px;margin:0px;color:#282828;margin-top: 20px;">Transferencia rapida</h5>
            <div style="width:100%;position: relative;float: left;margin-top: 10px;">
              <img src="{{asset('image/plin.png')}} " style="width:100px;position:relative;float: left;display: inline-block;margin-left: 15px;margin-top:0px;">
              <img src="{{asset('image/yape.png')}} " style="width:40px;position:relative;float: left;display: inline-block;margin-left: 15px;margin-top:0px;">
            </div>
          </div>        
        </div>
      </div>
    </div>

    <footer  style="font-family:'Kanit';background:#333;padding:10px;">
      <div class="footer">
        <div class="footer-section" style="font-family:'Kanit';">
          <h2 style="font-size:20px;">Informacion</h2>
          <p style="font-size:12px;">Quienes Somos</p>
        </div>
        <div class="footer-section">
          <h2 style="font-size:20px;">Empresa</h2>
          <p style="font-size:12px;">Contactenos</p>
        </div>
        <div class="footer-section">
          <h2 style="font-size:20px;">Soporte</h2>
          <p style="font-size:12px;">Manuales de usuario</p>
        </div>
      </div>
      <div class="footer-copyright">
        <p>&copy; 2023 Powered by Grupo Oberlu. Todos los derechos reservados.</p>
      </div>
    </footer>                

    <script>
  // SOLO lo que usa el Blade actual:
  function abrirMochila(){
    const m = document.getElementById('modalmochila');
    m.style.top = '0';
    m.style.opacity = '1';
    m.style.pointerEvents = 'auto';
    document.body.style.overflow = 'hidden';
  }
  function cerrarMochila(){
    const m = document.getElementById('modalmochila');
    m.style.top = '-2000';
    m.style.opacity = '0';
    m.style.pointerEvents = 'none';
    setTimeout(()=>{ m.style.top = '-2000px'; }, 400);
    document.body.style.overflow = '';
  }
  function toggleElement(index) {
    var elemento = document.getElementById("miElemento" + index);
    var menu = document.getElementById("menu" + index);
    var remove = document.getElementById("remove" + index);
    if (!elemento || !menu || !remove) return;

    const hidden = window.getComputedStyle(elemento).display === "none";
    elemento.style.display = hidden ? "flex" : "none";
    menu.style.display = hidden ? "none" : "block";
    remove.style.display = hidden ? "block" : "none";
  }
  function cambiarFondo(el, color){ if (el) el.style.backgroundColor = color; }
  function cambiar(el, color){ if (el) el.style.backgroundColor = color; }

  // MODALES (kit / artículo / ventana)
  function abrirmodal(index){ const el = document.getElementById("modal"+index); if (el){ el.style.top='0'; el.style.opacity='1'; cerrarventana(index);} }
  function cerrarmodal(index){ const el = document.getElementById("modal"+index); if (el){ el.style.top='-10000px'; el.style.opacity='0'; } }

  function abrirarticulo(index){ const el = document.getElementById("articulo"+index); if (el){ el.style.top='0'; el.style.opacity='1'; cerrarventana(index);} }
  function cerrararticulo(index){ const el = document.getElementById("articulo"+index); if (el){ el.style.top='-10000px'; el.style.opacity='0'; } }

  function ventana(index){ const el = document.getElementById("ventana"+index); if (el){ el.style.top='0'; el.style.opacity='1'; } }
  function cerrarventana(index){ const el = document.getElementById("ventana"+index); if (el){ el.style.top='-10000px'; el.style.opacity='0'; } }
    </script>

    <script>
  // Lógica de botones (envío / tarjeta)
  document.addEventListener('DOMContentLoaded', function() {
    const envioCheck = document.getElementById('envioCheck');
    const pagoTarjetaCheck = document.getElementById('pagoTarjetaCheck');
    const botonA = document.getElementById('botonA');
    const botonB = document.getElementById('botonB');
    const botonC = document.getElementById('botonC');
    const defect = document.getElementById('defect');
    const credit = document.getElementById('credit_card');
    const local  = document.getElementById('local_shipping');
    const backA  = document.getElementById('backA');
    const backB  = document.getElementById('backB');
    const cargo  = document.getElementById('cargo_precio');

    function mostrar(nodo, on){ if (nodo) nodo.style.display = on ? 'block' : 'none'; }
    function flex(nodo, on){ if (nodo) nodo.style.display = on ? 'flex' : 'none'; }

    function actualizarBotones() {
      const envio = envioCheck && envioCheck.checked;
      const tarjeta = pagoTarjetaCheck && pagoTarjetaCheck.checked;

      if (envio && tarjeta) {
        mostrar(botonC, true); mostrar(botonA, false); mostrar(botonB, false); mostrar(defect, false);
        flex(cargo, true);
        if (backA) backA.style.background = '#b10000';
        if (backB) backB.style.background = '#b10000';
        if (credit) credit.style.color = 'white';
        if (local)  local.style.color  = 'white';
        const e = document.getElementById('envio');   if (e) e.style.color = 'white';
        const t = document.getElementById('tarjeta'); if (t) t.style.color = 'white';
      } else if (envio) {
        mostrar(botonA, true); mostrar(botonB, false); mostrar(botonC, false); mostrar(defect, false);
        flex(cargo, true);
        if (backA) backA.style.background = '#b10000';
        if (backB) backB.style.background = 'white';
        if (local)  local.style.color  = 'white';
        if (credit) credit.style.color = '#b10000';
        const e = document.getElementById('envio');   if (e) e.style.color = 'white';
        const t = document.getElementById('tarjeta'); if (t) t.style.color = '#b10000';
      } else if (tarjeta) {
        mostrar(botonB, true); mostrar(botonA, false); mostrar(botonC, false); mostrar(defect, false);
        flex(cargo, false);
        if (backB) backB.style.background = '#b10000';
        if (backA) backA.style.background = 'white';
        if (credit) credit.style.color = 'white';
        if (local)  local.style.color  = '#b10000';
        const t = document.getElementById('tarjeta'); if (t) t.style.color = 'white';
        const e = document.getElementById('envio');   if (e) e.style.color = '#b10000';
      } else {
        mostrar(botonA, false); mostrar(botonB, false); mostrar(botonC, false); mostrar(defect, true);
        flex(cargo, false);
        if (backA) backA.style.background = 'white';
        if (backB) backB.style.background = 'white';
        if (credit) credit.style.color = '#b10000';
        if (local)  local.style.color  = '#b10000';
        const t = document.getElementById('tarjeta'); if (t) t.style.color = '#b10000';
        const e = document.getElementById('envio');   if (e) e.style.color = '#b10000';
      }
    }

    if (envioCheck) envioCheck.addEventListener('change', actualizarBotones);
    if (pagoTarjetaCheck) pagoTarjetaCheck.addEventListener('change', actualizarBotones);
    actualizarBotones();
  });
    </script>

    <script>
  (function(){
    const btn  = document.getElementById('btn-detalle');
    const pane = document.getElementById('detalle-venta');

    function toggleDetalle(){
      const isOpen = pane.classList.toggle('dv-show');
      pane.classList.toggle('dv-hidden', !isOpen);
      btn.classList.toggle('rotated', isOpen);
      btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    }

    btn.addEventListener('click', toggleDetalle);
    btn.addEventListener('keydown', (e)=> {
      if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggleDetalle(); }
    });
  })();
    </script>

    <script src="{{asset('js/kit.js')}} "></script>
    <script>
        (function(){
          const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          // Referencias en Desktop
          const boxD   = document.getElementById('coupon_box_desktop');
          const inputD = document.getElementById('coupon_code');
          const clearD = document.getElementById('coupon_clear');
          const msgD   = document.getElementById('coupon_msg');
          const btnD   = document.getElementById('btnApplyCouponDesktop');

          // Referencias en Móvil
          const boxM   = document.getElementById('coupon_box_mobile');
          const inputM = document.getElementById('coupon_code_m');
          const clearM = document.getElementById('coupon_clear_m');
          const msgM   = document.getElementById('coupon_msg_m');
          const btnM   = document.getElementById('btnApplyCouponMobile');

          // Timer existente
          function startTimer(iso){
            const el = document.getElementById('coupon_timer');
            const wrap = document.getElementById('coupon_timer_wrap');
            if (!iso || !el) return;
            if (wrap) wrap.style.display = 'flex';
            const end = new Date(iso).getTime();
            function tick(){
              const now = Date.now();
              let diff = Math.max(0, Math.floor((end - now)/1000));
              const m = String(Math.floor(diff/60)).padStart(2,'0');
              const s = String(diff%60).padStart(2,'0');
              el.textContent = `${m}:${s}`;
              if (diff <= 0) {
                fetch(`{{ route('cupon.remove') }}`, {method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF_TOKEN}})
                  .finally(()=> location.reload());
                return;
              }
              setTimeout(tick, 1000);
            }
            tick();
          }

          // Actualiza todas las vistas de totales y descuento
          function updateTotals(discount, newTotal){
            // Filas "Descuento" y "Total:" en desktop y móvil (#detalle-venta)
            document.querySelectorAll('.row').forEach(row=>{
              const first = row.querySelector('h5');
              const last  = row.querySelector('h5:last-child');
              if (!first || !last) return;
              if (/Descuento/i.test(first.textContent)) last.textContent = 'S/. ' + (discount ?? '0.00');
              if (/Total:/i.test(first.textContent))    last.textContent = 'S/. ' + (newTotal ?? last.textContent.replace(/[^\d.,]/g,''));
            });
            // Subtotal sticky de abajo
            const totalEl = document.getElementById('total');
            if (totalEl && newTotal != null) totalEl.textContent = newTotal;
          }

          // Estado UI aplicado/no aplicado en ambos lados
          function setCouponUI(active, payload){
            const code = payload?.code || '';
            const discount = payload?.discount;
            const new_total = payload?.new_total;
            const expires_at = payload?.expires_at;
            const message = payload?.msg || (active ? `Cupón aplicado: ${code}` : '');

            // Inputs y contenedores
            [ [boxD,inputD,clearD,msgD,btnD], [boxM,inputM,clearM,msgM,btnM] ].forEach(([box,input,clear,msg,btn])=>{
              if (!input) return;
              if (active){
                box?.classList.add('coupon-applied');
                input.value = code;
                input.disabled = true;
                if (btn) { btn.disabled = true; }
                if (msg) { msg.textContent = message; }
              } else {
                box?.classList.remove('coupon-applied');
                input.disabled = false;
                if (msg) { msg.textContent = ''; }
                if (btn) { btn.disabled = false; }
              }
            });

            // Totales
            if (active){
              updateTotals(discount, new_total);
              if (expires_at) startTimer(expires_at);
            }
          }

          // Aplicar cupón (desde Desktop o Móvil)
          function applyCoupon(code){
            if (!code) return;
            const body = JSON.stringify({code});
            const headers = {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF_TOKEN};
            // Bloqueo rápido de botones mientras aplica
            [btnD, btnM].forEach(b=>{ if(b) b.disabled = true; });

            fetch(`{{ route('cupon.apply') }}`, {method:'POST', headers, body})
              .then(r=>r.json().then(j=>({ok:r.ok, j})))
              .then(({ok,j})=>{
                if (!ok){
                  if (msgD) msgD.textContent = j.msg || 'No se pudo aplicar.';
                  if (msgM) msgM.textContent = j.msg || 'No se pudo aplicar.';
                  [btnD, btnM].forEach(b=>{ if(b) b.disabled = false; });
                  return;
                }
                setCouponUI(true, j);
              })
              .catch(()=>{
                if (msgD) msgD.textContent = 'Error de red.';
                if (msgM) msgM.textContent = 'Error de red.';
                [btnD, btnM].forEach(b=>{ if(b) b.disabled = false; });
              });
          }

          // Quitar cupón (recarga para garantizar sincronía server-side)
          function removeCoupon(){
            fetch(`{{ route('cupon.remove') }}`, {method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF_TOKEN}})
              .then(()=>location.reload());
          }

          // Listeners
          btnD?.addEventListener('click', ()=> applyCoupon(inputD?.value.trim()));
          btnM?.addEventListener('click', ()=> applyCoupon(inputM?.value.trim()));
          clearD?.addEventListener('click', removeCoupon);
          clearM?.addEventListener('click', removeCoupon);

          // Estado inicial: valida en servidor y activa timer/UI si corresponde
          (function boot(){
            // Si el backend ya marcó uno activo, esto lo capturará
            fetch(`{{ route('cupon.validate') }}`, { method:'POST', headers:{'X-CSRF-TOKEN':CSRF_TOKEN} })
              .then(r=>r.json())
              .then(j=>{
                if (j.active){
                  setCouponUI(true, j);
                } else {
                  // Si el Blade dejó un data-expires, respeta solo el timer visual
                  const expires = document.getElementById('coupon_timer')?.dataset?.expires;
                  if (expires) startTimer(expires);
                  setCouponUI(false);
                }
              })
              .catch(()=>{
                const expires = document.getElementById('coupon_timer')?.dataset?.expires;
                if (expires) startTimer(expires);
              });
          })();

        })();
    </script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  function norm(s){
    return (s || '')
      .toString()
      .normalize('NFD')
      .replace(/[\u0300-\u036f]/g,'')
      .toLowerCase().trim();
  }

  function attachLiveSearch(input){
    const gridSel = input.getAttribute('data-grid');
    if(!gridSel) return;
    const grid = document.querySelector(gridSel);
    if(!grid) return;

    const cards = Array.from(grid.querySelectorAll('.psm-card'));
    const wrappers = cards.map(card => card.closest('a') || card); // mostramos/ocultamos el anchor

    input.addEventListener('input', function(){
      const q = norm(input.value);
      const active = q.length >= 3;
      for(let i=0;i<cards.length;i++){
        const c = cards[i];
        const text = norm((c.dataset.name || '') + ' ' + (c.dataset.categoria || ''));
        const show = !active || text.includes(q);
        wrappers[i].style.display = show ? '' : 'none';
      }
    });
  }

  document.querySelectorAll('.psm-search-input').forEach(attachLiveSearch);
});
</script>

</body>
</html>
