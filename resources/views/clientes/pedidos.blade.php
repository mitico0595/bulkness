<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Adler - Mis Pedidos</title>
    @include ('global.icon')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    :root{
      --red: #efc444ff; --red-600: #ccb416dd; --muted:#6b7280; --border:#e5e7eb;
      --bg:#f9fafb; --white:#ffffff; --text:#111827;
      --blue-50:#eff6ff; --blue-500:#3b82f6;
    }
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Inter,Helvetica,Arial,sans-serif;background:var(--bg);color:var(--text);min-height:100vh}

    /* Header */
    .header{background:var(--white);border-bottom:1px solid var(--border)}
    .header-inner{max-width:1120px;margin:0 auto;padding:0 1rem;height:64px;display:flex;align-items:center;justify-content:space-between}
    .brand{font-weight:800;font-size:20px}
    .search{position:relative;max-width:420px;flex:1;margin:0 1rem}
    .search input{width:100%;padding:.6rem .9rem .6rem 2.2rem;border:1px solid var(--border);border-radius:10px;font-size:.9rem}
    .search input:focus{outline:none;border-color:var(--red);box-shadow:0 0 0 3px rgb(239 210 68 / 12%)}
    .search .icon{position:absolute;left:.6rem;top:50%;transform:translateY(-50%);opacity:.5}
    .user{display:flex;align-items:center;gap:.6rem}
    .avatar{width:32px;height:32px;border-radius:999px;background:var(--red);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700}

    /* Nav */
    .nav{background:var(--red);color:#fff}
    .nav-inner{max-width:1120px;margin:0 auto;padding:0 1rem;display:flex;gap:1rem}
    .nav button{padding:.9rem 1rem;border:none;background:transparent;color:#fff;cursor:pointer;border-radius:8px}
    .nav button.active,.nav button:hover{background:var(--red-600)}

    /* Layout */
    .page{min-height:calc(100vh - 64px)}
    .wrap{max-width:1120px;margin:0 auto;padding:1rem}
    .grid{display:grid;grid-template-columns:1fr;gap:1rem}
    @media(min-width:1024px){.grid{grid-template-columns:2fr 1fr}}

    /* Cards y tipografía */
    .card{background:var(--white);border:1px solid var(--border);border-radius:12px;box-shadow:0 1px 2px rgba(0,0,0,.04)}
    .card-head{padding:1rem;border-bottom:1px solid var(--border)}
    .title{font-size:1.1rem;font-weight:700}
    .meta{font-size:.9rem;color:var(--muted)}

    /* Lista */
    .list .row{padding:1rem;cursor:pointer;transition:background .12s}
    .list .row + .row{border-top:1px solid var(--border)}
    .row:hover{background:#f3f4f6}
    .row.active{background:var(--blue-50);border-left:4px solid var(--blue-500)}
    .thumbs{display:flex;gap:.3rem;margin-top:.5rem}
    .thumbs img{width:40px;height:40px;border-radius:8px;border:2px solid #fff;object-fit:cover;box-shadow:0 1px 3px rgba(0,0,0,.08)}
    .thumb-more{width:40px;height:40px;border-radius:8px;background:#f3f4f6;border:2px solid #fff;display:flex;align-items:center;justify-content:center;font-size:.75rem;color:#6b7280}

    .badge{display:inline-flex;align-items:center;gap:.35rem;padding:.15rem .55rem;border-radius:999px;font-size:.75rem;font-weight:600}
    .b-pend{background:#fef3c7;color:#a16207}
    .b-proc{background:#dbeafe;color:#1d4ed8}
    .b-env{background:#ffedd5;color:#c2410c}
    .b-ent{background:#dcfce7;color:#166534}

    /* Detalle */
    .details{padding:1rem}
    .block + .block{margin-top:1rem}
    .product{display:flex;gap:.75rem;align-items:center}
    .product img{width:64px;height:64px;object-fit:cover;border-radius:10px;border:1px solid var(--border)}
    .total{display:flex;justify-content:space-between;font-weight:700;font-size:1.05rem;border-top:1px solid var(--border);padding-top:.75rem;margin-top:.75rem}
    .pill{display:flex;gap:.4rem;align-items:center;font-weight:600;margin-bottom:.5rem}

    /* Modal móvil */
    .overlay{position:fixed;inset:0;background:rgba(0,0,0,.5);display:none;z-index:40}
    .overlay.show{display:block}
    .sheet{position:fixed;left:0;right:0;bottom:0;background:#fff;border-top-left-radius:14px;border-top-right-radius:14px;max-height:85vh;overflow:auto;transform:translateY(100%);transition:transform .25s ease;z-index:41}
    .sheet.open{transform:translateY(0)}
    .sheet-head{position:sticky;top:0;background:#fff;border-bottom:1px solid var(--border);padding:.8rem 1rem;display:flex;justify-content:space-between;align-items:center}
    .xbtn{background:transparent;border:none;font-size:1.1rem;cursor:pointer;padding:.3rem .5rem;border-radius:8px}
    .xbtn:hover{background:#f3f4f6}
    /* Botón hamburguesa */
        .hamburger {
            width: 60px;
            height: 60px;
            background: transparent;
            border: none;
            cursor: pointer;
            position: fixed;
            top: 2px;
            right: 6px;
            z-index: 1001;
            padding: 0;
            display:none;
        }
        
        .hamburger span {
            display: block;
            width: 35px;
            height: 3px;
            background: #333;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            transition: all 0.3s ease;
        }

        .hamburger span:nth-child(1) { top: 20px; }
        .hamburger span:nth-child(2) { top: 28px; }
        .hamburger span:nth-child(3) { top: 36px; }

        .hamburger.active span:nth-child(1) {
            top: 28px;
            transform: translateX(-50%) rotate(45deg);
            background: #333;
        }
        
        .hamburger.active span:nth-child(2) {
            transform: translateX(-100px);
            opacity: 0;
        }
        
        .hamburger.active span:nth-child(3) {
            top: 28px;
            transform: translateX(-50%) rotate(-45deg);
            background: #333;
        }

        /* Panel del menú */
        .menu-panel {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: white;
            z-index: 999;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 80px 40px 40px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .menu-panel.active {
            opacity: 1;
            visibility: visible;
        }

        /* Opciones del menú */
        .menu-options {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .menu-option {
            font-size: 28px;
            font-weight: 300;
            color: #333;
            text-decoration: none;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .menu-option:hover {
            color: #007bff;
            padding-left: 20px;
        }

        /* Botón logout */
        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.3s ease;
            align-self: center;
            width: fit-content;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
        }
             .user{
  position: relative;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.user .meta{
  color:#6b7280;
  font-size:.9rem;
}

.user-name{
  font-weight:700;
  cursor:pointer;
}

.avatar{
  width:36px; height:36px;
  display:grid; place-items:center;
  background:#111827; color:#fff;
  border-radius:9999px;
  font-weight:700;
  cursor:pointer; user-select:none;
}

.user-menu{
  position:absolute;
  top:42px; right:-3px;
  min-width:180px;
  display:flex; flex-direction:column; gap:10px;
  color:white;
  background:rgba(17,24,39,.82);
  backdrop-filter:blur(10px);
  -webkit-backdrop-filter:blur(10px);
  padding:10px;
  border-radius:12px;
  text-align:center;
  align-items:center; justify-content:center;
  box-shadow:0 10px 30px rgba(0,0,0,.15);
  z-index:50;

  /* animación de entrada/salida */
  opacity:0; visibility:hidden;
  transform:translateY(-6px) scale(.98);
  transition:opacity .18s ease, transform .18s ease, visibility .18s ease;
}

.user.is-open .user-menu{
  opacity:1; visibility:visible;
  transform:translateY(0) scale(1);
}

.user-menu__item{
  width:100%;
  padding:.6rem .8rem;
  border-radius:10px;
  cursor:pointer;
  transition:background .15s ease, transform .05s ease;
}

.user-menu__item:hover{ background:rgba(255,255,255,.12); }
.user-menu__item:active{ transform:scale(.99); }
a{text-decoration:none;}
     @media(max-width:768px){
        .search{display:none}
        .user{display:none}
        .hamburger{display:block}
        .nav{display:none}
     }

  </style>
</head>
<body>

  <!-- Header -->
  <div class="header" style="position: sticky; top: 0; z-index: 999;backdrop-filter:blur(3px);background:rgba(256,256,256,.7)">
    <div class="header-inner">
      <div class="logo" >
                    <a href="{{url('/')}} " style="display:flex"><img src="{{asset('image/logo.webp')}}" style="width:140px;"></a>
      </div>
      <div class="search">
        <svg class="icon" width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
        <input id="buscador" type="text" placeholder="Buscar por código o producto...">
      </div>
      <div class="user">
        <span class="meta">Hola,</span>
        <strong class="user-name">{{ $user->name ?? 'Cliente' }}</strong>
        <div class="avatar">{{ strtoupper(substr($user->name ?? 'C',0,1)) }}</div>

        <div class="user-menu" aria-hidden="true">
          <div class="user-menu__item"><a href="{{asset('usuario')}}" style="color:white;">Mi perfil</a></div>
          <div class="user-menu__item"><a href="" style="color:white;">Mis pedidos</a></div>
          <div class="user-menu__item">
            <form method="POST" action="{{ route('logout') }}">
                    @csrf
                <button type="submit" style="background:none;border:none;color:#b10000;font-size:15px;cursor:pointer" >
                    Cerrar sesion
                </button>
              </form>
          </div>
        </div>
      </div>

      
    </div>
    
  </div>

  <!-- Nav -->
  <div class="nav">
    <div class="nav-inner">
      <button class="active">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" style="margin-right:.35rem">
          <path d="M6 7h12l-1 12H7L6 7z" stroke="currentColor" stroke-width="2"/><path d="M9 7a3 3 0 1 1 6 0" stroke="currentColor" stroke-width="2"/>
        </svg>
        Mis Pedidos
      </button>
      <button>Mensajes</button>
      <button>Lista de Deseos</button>
    </div>
  </div>

  <div class="page">
    <div class="wrap">
      <div class="grid">
        <!-- Columna izquierda: Lista -->
        <div class="card list" id="listaPedidos">
          <div class="card-head">
            <div class="title">Mis Pedidos</div>
            <div class="meta">Gestiona y rastrea tus compras</div>
          </div>

          @php $primero = true; @endphp

          @forelse ($ventas as $venta)
            @php
              $detalleGroups = collect($venta->detalle)->groupBy('idsub');

              // Tomamos el último envío ya cargado
              $shipment = $venta->latestShipment ?? null;

              // Normalizamos status a etiquetas en español que ya usas en las badges
              $map = [
                'pending'    => 'pendiente',
                'processing' => 'procesando',
                'shipped'    => 'enviado',
                'delivered'  => 'entregado',
                'cancelled'  => 'cancelado',
              ];
              $estado = $shipment ? ($map[strtolower($shipment->status)] ?? 'procesando') : 'procesando';

              $estadoClass = [
                'pendiente'=>'badge b-pend',
                'procesando'=>'badge b-proc',
                'enviado'=>'badge b-env',
                'entregado'=>'badge b-ent',
                'cancelado'=>'badge b-pend',
              ][$estado] ?? 'badge';

              // Para filtrar por productos en el buscador
              $productosTexto = strtolower(
                ($venta->detalle ?? collect())
                  ->map(fn($d) => optional($d->articulo)->name ?? ('Producto '.$d->idarticulo))
                  ->implode(' ')
              );
            @endphp


            <div class="row pedido-item {{ $primero ? 'active':'' }}"
                 data-id="venta-{{ $venta->idventa }}"
                 data-codigo="{{ $venta->codigo }}"
                 data-productos="{{ $productosTexto }}">
              <div style="display:flex;justify-content:space-between;gap:1rem">
                <div style="flex:1">
                  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:.25rem">
                    <strong>Pedido #{{ $venta->codigo }}</strong>
                    <span class="{{ $estadoClass }}">
                      @if($estado==='pendiente')
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M12 8v5l3 2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                      @elseif($estado==='procesando')
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M3 7h18l-1 12H4L3 7z" stroke="currentColor" stroke-width="2"/></svg>
                      @elseif($estado==='enviado')
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M10 17h7l2-5H13V7h3l3 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                      @else
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                      @endif
                      {{ ucfirst($estado) }}
                    </span>
                  </div>

                  <div class="meta" style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem">
                    <div>Fecha: {{ optional($venta->fecha_hora ?? $venta->created_at)->format('d M Y H:i') }}</div>
                    <div>Total: S/. {{ number_format($venta->total_venta, 2) }}</div>
                  </div>

                  <div class="thumbs">
                    @php $thumbs = ($venta->detalle ?? collect())->take(3); @endphp
                    @foreach($thumbs as $d)
                      @php
                        $art = optional($d->articulo);
                        $raw = $art->image ?? $art->image1 ?? null;
                        $img = $raw
                          ? (str_starts_with($raw, 'http') ? $raw : asset('image/productos/'.$raw))
                          : asset('images/placeholder-40.png');
                      @endphp
                      <img src="{{ $img }}" alt="{{ $art->name ?? ('Producto '.$d->idarticulo) }}">
                    @endforeach
                    @if(($venta->detalle?->count() ?? 0) > 3)
                      <div class="thumb-more">+{{ $venta->detalle->count() - 3 }}</div>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            @php $primero = false; @endphp
          @empty
            <div style="padding:1rem">
              <p class="meta">No encontramos pedidos vinculados a tu cuenta.</p>
            </div>
          @endforelse
        </div>

        <!-- Columna derecha: Detalle dinámico -->
        <div id="detailsRight" class="card" style="align-self:start;display:none;position: sticky; top: 80px;overflow:auto;max-height:700px;">
          <div style="padding:2rem;text-align:center">
            <div class="meta">Selecciona un pedido para ver sus detalles.</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Contenedor oculto con TODOS los paneles de detalle (se mueven al costado en desktop) -->
  <div id="allDetails" style="display:none">
    @foreach ($ventas as $venta)
      @php $detalleGroups = collect($venta->detalle)->groupBy('idsub'); @endphp
      <div id="venta-{{ $venta->idventa }}" class="details card">
        <div class="block">
          <div class="title" style="margin-bottom:.25rem">Detalles del Pedido</div>
          <div class="meta" style="margin-bottom:.5rem">
            Comprador: {{ $venta->nombre }} {{ $venta->apellido }}
            • {{ $venta->email ?? $venta->getAttribute('user-mail') }}
          </div>

          @foreach($detalleGroups as $idx => $grupo)
            <div class="card" style="padding:1rem;margin-top:.75rem">
              <div class="pill">Paquete #{{ $idx }}</div>
              <div style="display:flex;flex-direction:column;gap:.75rem">
                @foreach($grupo as $item)
                  @php
                    $art = optional($item->articulo);
                    $raw = $art->image ?? $art->image1 ?? null;
                    $img = $raw
                      ? (str_starts_with($raw, 'http') ? $raw : asset('image/productos/'.$raw))
                      : asset('images/placeholder-64.png');
                  @endphp
                  <div class="product">
                    <img src="{{ $img }}" alt="{{ $art->name ?? ('Producto #'.$item->idarticulo) }}">
                    <div style="flex:1">
                      <div style="font-weight:600">{{ $art->name ?? ('Producto #'.$item->idarticulo) }}</div>
                      <div class="meta">Cantidad: {{ $item->qty }}</div>
                    </div>
                    <div style="text-align:right;font-weight:700">S/. {{ number_format($item->precio,2) }}</div>
                  </div>
                @endforeach
              </div>
            </div>
          @endforeach

          <div class="total">
            <span>Total</span>
            <span>S/. {{ number_format($venta->total_venta, 2) }}</span>
          </div>
        </div>

        @php $shipment = $venta->latestShipment ?? null; @endphp

          @if($shipment)
            <div class="block card" style="padding:1rem">
              <div class="title" style="font-size:1rem">Seguimiento</div>
              <div class="meta" style="margin:.5rem 0 1rem">
                Estado: 
                @php
                  $map = ['pending'=>'Pendiente','processing'=>'Procesando','shipped'=>'Enviado','delivered'=>'Entregado','cancelled'=>'Cancelado'];
                  $estadoLegible = $map[strtolower($shipment->status)] ?? ucfirst($shipment->status);
                @endphp
                <strong>{{ $estadoLegible }}</strong>
              </div>

              <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem">
                @if($shipment->carrier)
                  <div class="meta"><strong>Carrier:</strong> {{ $shipment->carrier }} @if($shipment->service) ({{ $shipment->service }}) @endif</div>
                @endif

                @if($shipment->tracking_number)
                  <div class="meta">
                    <strong>Tracking:</strong>
                    @if($shipment->tracking_url)
                      <a href="{{ $shipment->tracking_url }}" target="_blank" rel="noopener">{{ $shipment->tracking_number }}</a>
                    @else
                      {{ $shipment->tracking_number }}
                    @endif
                  </div>
                @endif

                @if($shipment->shipping_cost)
                  <div class="meta"><strong>Costo envío:</strong> S/. {{ number_format($shipment->shipping_cost, 2) }}</div>
                @endif

                @if($shipment->weight_kg)
                  <div class="meta"><strong>Peso:</strong> {{ rtrim(rtrim(number_format($shipment->weight_kg,2), '0'), '.') }} kg</div>
                @endif

                @if($shipment->shipped_at)
                  <div class="meta"><strong>Fecha de envío:</strong> {{ $shipment->shipped_at->format('d M Y H:i') }}</div>
                @endif

                @if($shipment->delivered_at)
                  <div class="meta"><strong>Entregado:</strong> {{ $shipment->delivered_at->format('d M Y H:i') }}</div>
                @endif
              </div>

              @php
                $addr = $shipment->address_to ?? [];
                // Si tu JSON trae claves tipo 'line1','line2','district','province','department'
                $linea = trim(($addr['line1'] ?? '').' '.($addr['line2'] ?? ''));
                $ubigeo = trim(implode(' • ', array_filter([
                  $addr['district'] ?? $venta->distrito,
                  $addr['province'] ?? $venta->provincia,
                  $addr['department'] ?? $venta->departamento,
                ])));
              @endphp

              @if($linea || $ubigeo)
                <div class="meta" style="margin-top:.75rem">
                  <strong>Destino:</strong>
                  {{ $linea }} @if($linea && $ubigeo) • @endif {{ $ubigeo }}
                </div>
              @endif
            </div>
          @endif


        <div class="block card" style="padding:1rem">
          <div class="title" style="font-size:1rem">Acciones</div>
          <div style="display:flex;flex-direction:column;gap:.5rem;margin-top:.5rem">
            <a href="{{asset('soporte')}}" style="text-decoration:none;text-align:center;padding:.6rem;border:1px solid #b9af1c;color:#b9af1c;border-radius:10px;background:#fff;cursor:pointer">Contactar Soporte</a>
            <button style="padding:.6rem;border:1px solid var(--border);color:#374151;border-radius:10px;background:#fff;cursor:pointer">Devolver Producto</button>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Sheet móvil -->
  <div id="overlay" class="overlay"></div>
  <div id="sheet" class="sheet">
    <div class="sheet-head">
      <strong id="sheetTitle">Pedido</strong>
      <button id="sheetClose" class="xbtn" aria-label="Cerrar">✕</button>
    </div>
    <div id="sheetBody" style="padding:1rem"></div>
  </div>

   <button class="hamburger" onclick="toggleMenu()" >
        <span></span>
        <span></span>
        <span></span>
    </button>
    <div class="menu-panel" id="menuPanel">
        <div class="menu-options">
            <a href="{{asset('/')}}" class="menu-option">Inicio</a>
            <a href="{{asset('usuario')}}" class="menu-option">Perfil</a>
            <a href="{{asset('compras')}}" class="menu-option">Mis Pedidos</a>
        </div>
        
        <button class="logout-btn" onclick="logout()">
            Logout
        </button>
    </div>

  <script>
  const BP_DESKTOP = 1024;

  const detailsRight = document.getElementById('detailsRight');
  const allDetails   = document.getElementById('allDetails');
  const buscador     = document.getElementById('buscador');

  const overlay = document.getElementById('overlay');
  const sheet   = document.getElementById('sheet');
  const sheetBody  = document.getElementById('sheetBody');
  const sheetTitle = document.getElementById('sheetTitle');
  const sheetClose = document.getElementById('sheetClose');

  // ---------- helpers ----------
  function isVisible(el){ return el && el.style.display !== 'none'; }

  function firstVisibleItem(){
    const rows = document.querySelectorAll('.pedido-item');
    for (const el of rows){ if (isVisible(el)) return el; }
    return null;
  }

  function clearActive(){
    document.querySelectorAll('.pedido-item').forEach(r => r.classList.remove('active'));
  }

  function getSourcePanel(id){
    // Los paneles fuente SIEMPRE viven en #allDetails
    return allDetails.querySelector('#' + CSS.escape(id));
  }

  function renderRightById(id){
    const src = getSourcePanel(id);
    if (!src) return;
    detailsRight.style.display = 'block';
    detailsRight.innerHTML = '';                 // limpia el contenedor de destino
    detailsRight.appendChild(src.cloneNode(true)); // CLONA, no muevas
  }

  function openSheetFromId(id, codigo){
    const src = getSourcePanel(id);
    if (!src) return;
    sheetTitle.textContent = 'Pedido #' + (codigo || '');
    sheetBody.innerHTML = src.innerHTML; // en móvil vale clonar como HTML
    overlay.classList.add('show');
    sheet.classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function openPedido(id, codigo){
    clearActive();
    const row = document.querySelector(`.pedido-item[data-id="${id}"]`);
    if (row) row.classList.add('active');

    if (window.innerWidth >= BP_DESKTOP){
      renderRightById(id);
    } else {
      openSheetFromId(id, codigo);
    }
  }

  // ---------- init ----------
  (function init(){
    const first = firstVisibleItem();
    if (first && window.innerWidth >= BP_DESKTOP){
      openPedido(first.dataset.id, first.dataset.codigo);
    } else if (!first) {
      detailsRight.style.display = 'block';
      detailsRight.innerHTML = `
        <div style="padding:2rem;text-align:center">
          <div class="meta">No encontramos pedidos vinculados a tu cuenta.</div>
        </div>`;
    }
  })();

  // ---------- eventos de lista ----------
  document.querySelectorAll('.pedido-item').forEach(el => {
    el.addEventListener('click', () => openPedido(el.dataset.id, el.dataset.codigo));
  });

  // ---------- buscador ----------
  buscador.addEventListener('input', function(){
    const q = this.value.trim().toLowerCase();
    document.querySelectorAll('.pedido-item').forEach(el => {
      const byCode = (el.dataset.codigo || '').toLowerCase().includes(q);
      const byProd = (el.dataset.productos || '').includes(q);
      el.style.display = (q === '' || byCode || byProd) ? '' : 'none';
    });

    // En desktop, si el activo desapareció con el filtro, carga el primero visible
    if (window.innerWidth >= BP_DESKTOP){
      const active = document.querySelector('.pedido-item.active');
      if (!active || active.style.display === 'none'){
        const first = firstVisibleItem();
        if (first) openPedido(first.dataset.id, first.dataset.codigo);
        else {
          detailsRight.style.display = 'block';
          detailsRight.innerHTML = `
            <div style="padding:2rem;text-align:center">
              <div class="meta">Sin resultados. Ajusta el buscador.</div>
            </div>`;
        }
      } else {
        // Re-render por si el panel derecho quedó desfasado
        renderRightById(active.dataset.id);
      }
    }
  });

  // ---------- sheet móvil ----------
  function closeSheet(){
    overlay.classList.remove('show');
    sheet.classList.remove('open');
    document.body.style.overflow = '';
  }
  sheetClose.addEventListener('click', closeSheet);
  overlay.addEventListener('click', closeSheet);
  window.addEventListener('keydown', e => { if (e.key === 'Escape') closeSheet(); });

  // ---------- resize ----------
  window.addEventListener('resize', () => {
    if (window.innerWidth >= BP_DESKTOP){
      // al pasar a desktop, cierra sheet y asegura un detalle visible
      closeSheet();
      const active = document.querySelector('.pedido-item.active');
      if (active) renderRightById(active.dataset.id);
      else {
        const first = firstVisibleItem();
        if (first) openPedido(first.dataset.id, first.dataset.codigo);
      }
    }
  });
</script>
<script>
        
        function toggleMenu() {
            const hamburger = document.querySelector('.hamburger');
            const menuPanel = document.getElementById('menuPanel');
         
         
            
            hamburger.classList.toggle('active');
            menuPanel.classList.toggle('active');
            
        }
     
        function logout() {
            alert('Cerrando sesión...');
            // Aquí puedes agregar la lógica de logout
        }

        // Cerrar menú al hacer clic fuera del botón
        document.addEventListener('click', function(event) {
            const hamburger = document.querySelector('.hamburger');
            const menuPanel = document.getElementById('menuPanel');
           
            if (!hamburger.contains(event.target) && !menuPanel.contains(event.target)) {
                hamburger.classList.remove('active');
                menuPanel.classList.remove('active');
                
            }
        });
    </script>
<script>
    (function(){
      function setupUserMenu(userEl){
        if(!userEl) return;
        const nameEl   = userEl.querySelector('.user-name');
        const avatarEl = userEl.querySelector('.avatar');
        const menuEl   = userEl.querySelector('.user-menu');

        const open = () => {
          userEl.classList.add('is-open');
          if(menuEl) menuEl.setAttribute('aria-hidden','false');
        };
        const close = () => {
          userEl.classList.remove('is-open');
          if(menuEl) menuEl.setAttribute('aria-hidden','true');
        };
        const toggle = () => {
          userEl.classList.contains('is-open') ? close() : open();
        };

        // Abrir/cerrar con clic en nombre o avatar
        [nameEl, avatarEl].forEach(el=>{
          if(!el) return;
          el.addEventListener('click', toggle);
          el.setAttribute('role','button');
          el.setAttribute('tabindex','0');
          el.addEventListener('keydown', e=>{
            if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); }
          });
        });

        // Cerrar al hacer clic fuera
        document.addEventListener('click', e=>{
          if(!userEl.contains(e.target)) close();
        });

        // Cerrar con Escape
        document.addEventListener('keydown', e=>{
          if(e.key === 'Escape') close();
        });
      }

      document.querySelectorAll('.user').forEach(setupUserMenu);
    })();
</script>

</body>
</html>
