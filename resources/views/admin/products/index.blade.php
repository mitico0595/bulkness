<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Productos | Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @include ('global.icon')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <style>
    :root{
      --bg:#f6f7fb;
      --panel:#ffffff;
      --muted:#7b8aa3;
      --text:#1f2937;
      --sub:#0f172a;
      --border:#e5e7eb;
      --shadow:0 10px 30px rgba(32,41,63,.08);
      --radius:14px;
      --r8:10px;

      /* acentos estilo Ventas */
      --accent:#fff296; --accent-2:#c8b600; --accent-3:#c2bd55;

      --good:#16a34a; --bad:#e11d48; --info:#2563eb;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;background:var(--bg);color:var(--text)}
    a{color:inherit;text-decoration:none}

    /* ====== LAYOUT principal ====== */
    .app{display:grid;grid-template-columns:260px 1fr;min-height:100vh}
    .wrap{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1fr 360px;gap:18px}

    /* ====== SIDEBAR con overlay móvil ====== */
    .sidebar{
      color:#fff; padding:24px 16px;
      position:sticky; top:0; height:100vh; z-index:40;
    }
    .sidebar .inner{
      height:100%;
      display:flex;flex-direction:column;justify-content:center;
      background:#ffebb0;
      padding:20px;border-radius:20px
    }
    .brand{display:flex;align-items:center;gap:10px;margin-bottom:24px;position:absolute;top:30px}
    .brand a img{width:120px;max-width:100%}
    .nav{display:flex;flex-direction:column;gap:6px}
    .nav a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:#363636;opacity:.95}
    .nav a.active,.nav a:hover{background:rgba(255,255,255,.34);color:#aaaaaa}
    .sb-foot{color:#000000c4;opacity:.85;font-size:12px;text-align:center;position: absolute;    bottom: 35px;    right: 28px;}

    .backdrop-nav{display:none;position:fixed;inset:0;background:rgba(15,23,42,.45);z-index:35}

    /* ====== TOPBAR ====== */
    .topbar{
       top:0; z-index:30;
      background:#fff; border-bottom:1px solid var(--border);
      display:flex; align-items:center; justify-content:space-between;
      padding:12px 18px;
    }
    .left{display:flex;align-items:center;gap:10px}
    .burger{display:none}
    @media (max-width:760px){
      .burger{display:inline-grid;place-items:center;width:40px;height:40px;border:1px solid var(--border);border-radius:10px;background:#fff;cursor:pointer}
    }
    .page-title{font-weight:800}
    .sub{color:var(--muted);font-size:13px}
    .user{display:flex;align-items:center;gap:10px}
    .avatar{width:36px;height:36px;border-radius:10px;background:#ffd4d4;color:#b40909;display:grid;place-items:center;font-weight:800}

    .topbar-2{
      margin: 20px; top: 25px; border-radius: 15px; margin-top: 0px;
      background: rgba(256, 256, 256, .55);  backdrop-filter: blur(3px);
      display:flex; align-items:center; justify-content:space-between; padding:12px 16px;
      border:1px solid var(--border);position:sticky;
      z-index: 99;
    }

    .search-wrap{position:relative;min-width:280px}
    .search{width:100%;background:#fff;border:1px solid var(--border);border-radius:12px;padding:12px 44px 12px 14px;font-size:14px;box-shadow:var(--shadow)}
    .search-ico{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:32px;height:32px;border-radius:10px;background:linear-gradient(180deg,var(--accent),var(--accent-2));display:grid;place-items:center;color:#fff;font-weight:800}
    .chip{background:#fff;border:1px solid var(--border);border-radius:999px;padding:10px 14px;font-size:14px;color:#1f2937;cursor:pointer}
    .btn{border:0;border-radius:12px;padding:10px 14px;font-weight:600;cursor:pointer}
    .btn-ghost{background:#fff;border:1px solid var(--border)}
    .btn-primary{background:linear-gradient(180deg,var(--accent),var(--accent-2));color:#fff}
    .btn-primary:hover{filter:brightness(.97)}

    /* ====== LISTA izquierda ====== */
    .panel{padding:14px}
    .thead{
  display:grid;
  grid-template-columns:16px 1.6fr 1fr 110px 100px 120px 52px; /* DESPUÉS (7 cols, sin Fecha) */
  gap:12px;padding:6px 6px 10px;color:var(--muted);font-size:12px;border-bottom:1px solid #eef2ff
}
    .rows{display:flex;flex-direction:column;gap:12px}
    .row{
  cursor:pointer;background:white;border-radius:15px;
  display:grid;grid-template-columns:16px 1.6fr 1fr 110px 100px 120px 52px; /* DESPUÉS */
  align-items:center;gap:12px;padding:12px 8px;border-top:1px solid #f1f5f9
}
    .row:first-child{border-top:none}
    .row.is-active{background:#ffebb0;}
    .dot{border-radius:999px;background:#9ca3af;}
    .p-name{font-weight:800}
    .p-cat{color:#475569}
    .price{font-weight:800}
    .stock{color:#475569}
    .status{justify-self:start;border-radius:999px;padding:6px 10px;font-size:12px;font-weight:700}
    .st-in{background:#dcfce7;color:#166534}
    .st-low{background:#ffedd5;color:#9a3412}
    .st-out{background:#ffecef;color:#e11d48}
    .actions{position:relative;justify-self:end}
    .btn-3dots{all:unset;cursor:pointer;border-radius:10px;padding:6px;display:grid;place-items:center}
    .btn-3dots:hover{background:#f3f4f6}
    .menu{position:absolute;right:0;top:36px;background:#fff;border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow);min-width:180px;padding:6px;display:none;z-index:5}
    .menu button,.menu a{all:unset;display:flex;align-items:center;gap:8px;width:100%;padding:10px;border-radius:8px;cursor:pointer;color:#374151}
    .menu button:hover,.menu a:hover{background:#f3f4f6}
    .eye{width:18px;height:18px}
    .thumb{width:42px;height:42px;border-radius:10px;background:#f3f4f6;object-fit:cover}

    /* ====== ASIDE derecho ====== */
    .aside{display:flex;flex-direction:column;gap:14px;padding-top:40px}
    .card{background:#fff;border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);padding:14px}
    .card h4{margin:0 0 12px;font-size:15px}
    .kv{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    .kv-row{display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:14px}
    .key{color:var(--muted)}
    .imgbox{display:flex;gap:12px;align-items:center}
    .imgbox .big{width:92px;height:92px;border-radius:14px;border:1px solid var(--border);object-fit:cover;background:#f8fafc}
    .tag{display:inline-block;padding:4px 10px;border-radius:999px;background:#f1f5f9;color:#334155;font-size:12px;font-weight:700}

    /* ====== PAGINACIÓN (mismo estilo Ventas) ====== */
    .pager{display:flex;align-items:center;justify-content:space-between;margin-top:14px;gap:10px}
    .pager-info{color:#7b8aa3;font-size:13px}
    .pager-list{list-style:none;display:flex;gap:6px;margin:0;padding:0}
    .pager-list a,.pager-list span{
      display:grid;place-items:center;min-width:38px;height:38px;padding:0 12px;
      border:1px solid #e5e7eb;border-radius:12px;background:#fff;color:#1f2937;text-decoration:none
    }
    .pager-list li:hover a{box-shadow:0 6px 18px rgba(32,41,63,.08)}
    .pager-list .active span{background:linear-gradient(180deg, var(--accent), var(--accent-2));color:#fff;border-color:transparent;font-weight:800}
    .pager-list .disabled span{opacity:.45;background:#f3f4f6;color:#6b7280}

    /* ====== RESPONSIVE ====== */
    @media (max-width:1100px){
      .app{grid-template-columns:1fr}
      /* Sidebar como off-canvas */
      .sidebar{
        position:fixed;left:0;top:0;width:260px;height:100vh;
        transform:translateX(-100%);transition:transform .25s ease;
        padding:16px
      }
      .sidebar.open{transform:translateX(0)}
      .wrap{grid-template-columns:1fr}
      .topbar-2{margin:12px}
      .backdrop-nav.show{display:block}
    }
    @media (max-width:760px){
      .thead{display:none}
      .row{grid-template-columns:16px 1fr;grid-auto-rows:auto}
      .row > *:nth-child(n+3){grid-column:span 2}
      .search-wrap{min-width:0;flex:1}
    }

    /* ====== MODALES (idénticos a tu blade anterior) ======
       No toco estructura ni clases. Solo dejo el CSS que ya traías. */
    .backdrop{position:fixed;inset:0;background:rgba(0,0,0,.5);display:none;align-items:center;justify-content:center;z-index:100}
    .backdrop.open{display:flex}
    .modal{background:#fff;border:1px solid var(--border);border-radius:16px;box-shadow:0 20px 50px rgba(0,0,0,.25);width:min(980px,95vw);max-height:90vh;display:flex;flex-direction:column;overflow:hidden}
    .modal-head{position:sticky;top:0;display:flex;align-items:center;justify-content:space-between;padding:18px 20px;border-bottom:1px solid var(--border);background:#f8fafc}
    .modal-title{font-weight:800;font-size:20px;margin:0}
    .modal-close{border:0;background:transparent;padding:8px;border-radius:10px;cursor:pointer}
    .modal-close:hover{background:#eaeef6}

    .tabs{border-bottom:1px solid var(--border);background:#fff;display:flex}
    .tab-btn{flex:1;display:flex;align-items:center;justify-content:center;gap:8px;padding:14px;cursor:pointer;font-weight:700;color:#64748b;background:#fff;border:0;transition:.15s}
    .tab-btn:hover{background:#f8fafc;color:#334155}
    .tab-btn.active{color:#2563eb;background:#eff6ff;border-bottom:2px solid #2563eb}

    .modal-body{padding:18px;overflow:auto;max-height:calc(90vh - 200px)}
    .tab-pane{display:none}
    .tab-pane.active{display:block}

    .grid2{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .grid3{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
    .grid4{display:grid;grid-template-columns:repeat(4,1fr);gap:12px}
    @media (max-width:860px){ .grid2,.grid3,.grid4{grid-template-columns:1fr} }

    label{display:block;font-size:13px;color:#374151;margin-bottom:4px}
    .inp, textarea.inp{width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:12px;background:#fff}
    .note{font-size:12px;color:#64748b;margin-top:6px}

    .status-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;background:#f8fafc;border:1px solid var(--border);border-radius:12px;padding:12px}
    @media (max-width:860px){ .status-grid{grid-template-columns:repeat(2,1fr)} }
    .status-item{display:flex;align-items:center;gap:10px}
    .status-item input{width:18px;height:18px}

    .panel-pricing{border:1px solid #bfdbfe;background:#eff6ff;border-radius:12px;padding:12px;margin-top:8px}
    .panel-pricing h4{margin:0 0 8px 0;font-size:14px;color:#1e40af}
    .panel-pricing .kpis{display:grid;grid-template-columns:repeat(3,1fr);gap:10px;font-size:14px}
    @media (max-width:860px){ .panel-pricing .kpis{grid-template-columns:1fr} }

    .dropzone{border:2px dashed #cbd5e1;border-radius:12px;padding:24px;text-align:center}
    .dz-title{color:#475569}
    .dz-hint{color:#94a3b8;font-size:12px;margin-top:6px}

    .row-form{display:grid;grid-template-columns:1fr 1fr auto;gap:8px;align-items:center}
    .row-esp{display:grid;grid-template-columns:1.1fr 1fr 1.2fr auto;gap:8px;align-items:center}
    .remove{border:none;color:#ef4444;background:#fff;border-radius:10px;padding:7px 10px;cursor:pointer}

    .modal-foot{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-top:1px solid var(--border);background:#f8fafc}
    .btn-cancel{background:transparent;border:0;color:#64748b;padding:8px 12px;border-radius:10px;cursor:pointer}
    .btn-save{display:inline-flex;align-items:center;gap:8px;padding:10px 16px;border:0;border-radius:10px;background:#2563eb;color:#fff;cursor:pointer}
    .btn-save:disabled{opacity:.6;cursor:not-allowed}
    .prod-row{font-size:12px}
  </style>
</head>
<body>
  <div class="app">
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
      <div class="inner">
        <div>
          <div class="brand">
            <a href="{{asset('/')}}"><img src="{{asset('image/logo.webp')}}" alt="Adler"></a>
          </div>
          <nav class="nav">
            <a href="{{route('admin.dashboard')}}" ><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
            <a  href="{{ route('admin.ventas.index') }}"><span class="material-symbols-outlined">attach_money</span>Ventas</a>
            <a href="{{ url('admin/envios') }}" class=""><span class="material-symbols-outlined">local_shipping</span>Envíos</a>
            <a href="{{ route('admin.index_images.index') }}" ><span class="material-symbols-outlined">photo_library</span>Editor</a>
            <a href="#" class=""><span class="material-symbols-outlined">shopping_cart</span>Compras</a>
            <a class="active" href="{{ route('admin.products.index')}}"><span class="material-symbols-outlined">barcode_scanner</span>Inventario</a>
            
            <a  href="#"><span class="material-symbols-outlined">confirmation_number</span>Cupones</a>
            <a href="{{asset('admin/usuarios')}}"><span class="material-symbols-outlined">contacts_product</span>Usuarios</a>
            <a href="#"><span class="material-symbols-outlined">settings</span>Configuración</a>
          </nav>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn" style=" cursor:pointer;  color:white; position: absolute; right: 25%;  background: none;  border: 1px solid white; padding: 10px;  width: 50%; border-radius: 10px; bottom: 65px;">
                Logout
            </button>
          </form>
        </div>
        <div class="sb-foot">© {{ date('Y') }} {{env('DEVELOPER_NAME')}}</div>
      </div>
    </aside>
    <div id="backdropNav" class="backdrop-nav"></div>

    <!-- MAIN -->
    <main class="main">
      <!-- TOPBAR -->
      <div class="topbar" style="background:none;box-shadow:none;border:none;margin-top:8px">
        <div class="left">
          <button class="burger" id="burger" aria-label="Abrir menú">☰</button>
        </div>
        <div class="user" style="padding: 10px; background: linear-gradient(180deg, var(--accent) 0%, var(--accent-2) 50%, var(--accent-3) 100%); border-radius: 15px; color: white;">
          <div class="avatar" title="{{ Auth::user()->name ?? 'Admin' }}" style="background:none;color:wheat">
            {{ strtoupper(mb_substr(Auth::user()->name ?? 'A',0,1)) }}
          </div>
          <div style="display:flex;flex-direction:column;line-height:1">
            <strong>Admin</strong>
            <span class="sub" style="color:wheat">{{ Auth::user()->email ?? '' }}</span>
          </div>
        </div>
      </div>

      <!-- HEAD acciones -->
      <div class="topbar-2">
        <div>
          <div class="page-title">Productos</div>
          <div class="sub">{{ $products->total() }} productos encontrados</div>
        </div>
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
          <form method="get" action="{{ route('admin.products.index') }}" style="display:flex;align-items:center;gap:10px">
            <div class="search-wrap">
              <input id="q" class="search" type="text" name="q" placeholder="Buscar productos..." value="{{ $q ?? '' }}">

              <span class="search-ico">⌕</span>
            </div>
            
            <a class="btn btn-ghost" href="{{ route('admin.products.index') }}"><span class="material-symbols-outlined">cleaning_services</span></a>
          </form>
          <button class="btn btn-ghost" id="btn-export" type="button"><span class="material-symbols-outlined">download</span></button>
          <button class="btn btn-primary" type="button" onclick="openProductModal()">Crear producto</button>
        </div>
      </div>

      <!-- GRID: listado izquierda + panel derecho -->
      <div class="wrap">
        <!-- LISTA -->
        <section class="panel">
          <div class="thead">
            <div></div>
            <div>Producto</div>
            <div>Categoría</div>
            <div>Precio</div>
            <div>Stock</div>
            <div>Estado</div>
            
            <div></div>
          </div>

          <div class="rows" id="rows">
            @foreach($products as $p)
            @php
              $stk = is_numeric($p->stock) ? (int)$p->stock : (int)preg_replace('/\D/','',$p->stock ?? 0);
              $status = $stk <= 0 ? ['st-out','Sin stock'] : ($stk <= 5 ? ['st-low','Bajo'] : ['st-in','Disponible']);
              
              $img = $p->image ? asset('image/productos/'.$p->image) : asset('image/productos/default.png');
            @endphp
            <div
              class="row prod-row"
              data-id="{{ $p->id }}"
              data-name="{{ $p->name }}"
              data-cat="{{ $p->categoria }}"
              data-price="{{ number_format($p->precio ?? 0,2,'.','') }}"
              data-stock="{{ $p->stock }}"
              data-status-class="{{ $status[0] }}"
              data-status-text="{{ $status[1] }}"
              
              data-img="{{ $img }}"
            >
              <div class="dot"></div>
              <div style="display:flex;align-items:center;gap:10px">
                <img class="thumb" src="{{ $img }}" alt="">
                <div>
                  <div class="p-name">{{ $p->name }}</div>
                  <div class="sub">ID: {{ str_pad($p->id,3,'0',STR_PAD_LEFT) }}</div>
                </div>
              </div>
              <div class="p-cat">{{ $p->categoria }}</div>
              <div class="price">S/ {{ number_format($p->precio ?? 0, 2) }}</div>
              <div class="stock">{{ $p->stock }}</div>
              <div><span class="status {{ $status[0] }}">{{ $status[1] }}</span></div>
              

              <!-- Acciones: tres puntitos -->
              <div class="actions">
                <button class="btn-3dots" aria-haspopup="menu" aria-expanded="false">
                  <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
                  </svg>
                </button>
                <div class="menu" role="menu">
                  <button data-action="ver" data-id="{{ $p->id }}">
                    <svg class="eye" viewBox="0 0 24 24" fill="none" stroke="#334155" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    Ver
                  </button>
                  <button onclick="openProductModal({{ $p->id }})">✏️ Editar</button>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <div style="margin-top:12px">
            {{ $products->onEachSide(1)->links('vendor.pagination.adler') }}
          </div>
        </section>

        <!-- PANEL DERECHO: DETALLE -->
        <aside class="aside" style="position:sticky;bottom:0">
          <div class="card">
            <h4>Detalle del producto</h4>
            <div class="imgbox">
              <img id="pdImg" class="big" src="{{ asset('image/productos/default.png') }}" alt="">
              <div style="flex:1">
                <div id="pdName" style="font-weight:800;font-size:16px">Selecciona un producto</div>
                <div style="margin-top:4px"><span id="pdCat" class="tag">—</span></div>
                <div style="margin-top:6px;color:#64748b" id="pdDate">—</div>
              </div>
            </div>
          </div>

          <div class="card">
            <h4>Resumen</h4>
            <div class="kv">
              <div class="kv-row"><div class="key">Precio</div><div id="pdPrice">—</div></div>
              <div class="kv-row"><div class="key">Stock</div><div id="pdStock">—</div></div>
              <div class="kv-row"><div class="key">Estado</div><div id="pdStatus"><span class="status st-out">—</span></div></div>
            </div>
          </div>

          <div class="card">
            <h4>Acciones rápidas</h4>
            <div style="display:flex;gap:10px;flex-wrap:wrap">
              <button class="btn btn-ghost" type="button" id="pdEdit" onclick="openProductModal(currentProdId)">Editar</button>
              <button class="btn btn-primary" type="button" onclick="alert('Implementa tu acción')">Actualizar stock</button>
              <button class="btn btn-ghost" type="button" onclick="window.print()">Imprimir</button>
            </div>
          </div>
        </aside>
      </div>
    </main>
  </div>

  <!-- ======= TOAST ======= -->
  <div id="toast" style="position:fixed;right:16px;bottom:16px;background:#111827;color:#fff;padding:10px 12px;border-radius:10px;opacity:0;transform:translateY(8px);transition:all .2s;z-index:120">Saved</div>

  <!-- ======= MODAL CREA/EDITA: MISMO QUE TU BLADE ======= -->
  <div id="product-modal" class="backdrop">
    <div class="modal">
      <!-- Header -->
      <div class="modal-head">
        <h3 id="pm-title" class="modal-title">New Product</h3>
        <button class="modal-close" onclick="closeProductModal()">
          <span class="material-symbols-outlined">close</span>
        </button>
      </div>

      <!-- Tabs -->
      <div class="tabs" id="pm-tabs">
        <button class="tab-btn active" data-tab="basic">
          <span class="material-symbols-outlined">package_2</span>
          <span class="t-md">Información Básica</span>
        </button>
        <button class="tab-btn" data-tab="pricing">
          <span class="material-symbols-outlined">payments</span>
          <span class="t-md">Precios & Stock</span>
        </button>
        <button class="tab-btn" data-tab="images">
          <span class="material-symbols-outlined">image</span>
          <span class="t-md">Imágenes</span>
        </button>
        <button class="tab-btn" data-tab="details">
          <span class="material-symbols-outlined">tune</span>
          <span class="t-md">Detalles</span>
        </button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form id="pm-form" enctype="multipart/form-data" onsubmit="event.preventDefault(); pmSave();">

          <input type="hidden" id="pm-id">

          <!-- BASIC -->
          <div id="tab-basic" class="tab-pane active">
            <div class="grid2">
              <div><label>Nombre del Producto</label><input id="pm-name" class="inp" placeholder="Ej: Termómetro digital" required></div>
              <div><label>Código</label><input id="pm-codigo" class="inp" placeholder="Ej: OX12"></div>
            </div>
            <div class="grid2" style="margin-top:12px">
              <div><label>Tipo</label><input id="pm-tipo" type="number" class="inp"></div>
              <div><label>Categoría</label><input id="pm-categoria" class="inp"></div>
            </div>

            <div style="margin-top:14px">
              <label>Estado del Producto</label>
              <div class="status-grid">
                <label class="status-item"><input id="pm-oferta" type="checkbox"><span>En oferta</span></label>
                <label class="status-item"><input id="pm-preventab" type="checkbox"><span>Pre-venta</span></label>
                <label class="status-item"><input id="pm-impropio" type="checkbox"><span>Inapropiado</span></label>
                <label class="status-item"><input id="pm-soli" type="checkbox"><span>Solicitado</span></label>
              </div>
            </div>
          </div>

          <!-- PRICING -->
          <div id="tab-pricing" class="tab-pane">
            <div class="grid3">
              <div>
                <label>Precio de Venta</label>
                <input id="pm-precio" type="number" step="0.01" class="inp" placeholder="0.00" oninput="updateProfit()">
                <div class="note">Precio principal del producto</div>
              </div>
              <div>
                <label>Costo</label>
                <input id="pm-costo" type="number" step="0.01" class="inp" placeholder="0.00" oninput="updateProfit()">
                <div class="note">Costo de adquisición</div>
              </div>
              <div>
                <label>Precio de Oferta</label>
                <input id="pm-preciof" type="number" step="0.01" class="inp" placeholder="0.00">
                <div class="note">Precio promocional</div>
              </div>
            </div>

            <div class="grid3" style="margin-top:12px">
              <div><label>Stock Disponible</label><input id="pm-stock" class="inp" placeholder="0"></div>
              <div><label>Volumen</label><input id="pm-volumen" type="number" step="0.01" class="inp"></div>
              <div><label>Puntos</label><input id="pm-puntos" class="inp" type="number"></div>
            </div>

            <div id="profit-panel" class="panel-pricing" style="display:none">
              <h4>Análisis de Rentabilidad</h4>
              <div class="kpis">
                <div><span style="color:#2563eb">Margen:</span> <b id="pf-margin">$0.00</b></div>
                <div><span style="color:#2563eb">Margen %:</span> <b id="pf-marginp">0.0%</b></div>
                <div><span style="color:#2563eb">ROI:</span> <b id="pf-roi">0.0%</b></div>
              </div>
            </div>
          </div>

          <!-- IMAGES -->
                    <!-- IMAGES -->
          <div id="tab-images" class="tab-pane">
            <div class="grid2">
              <div>
                <label>Imagen Principal</label>
                <input id="pm-image-file" name="image_file" type="file" accept="image/*" class="inp">
                <div class="note">Se guardará en <code>public/image/productos/</code>.</div>
                <input id="pm-image" class="inp" placeholder="nombre-del-archivo.jpg" style="margin-top:8px">
              </div>
              <div>
                <label>Miniatura</label>
                <input id="pm-thumb-file" name="thumb_file" type="file" accept="image/*" class="inp">
                <div class="note">Opcional. Si no subes nada, se puede reutilizar la principal.</div>
                <input id="pm-thumb" class="inp" placeholder="thumb.jpg" style="margin-top:8px">
              </div>
            </div>

              <div class="grid3" style="margin-top:12px">
                <div>
                  <label>Image 1</label>
                  <input id="pm-image1-file" name="image1_file" type="file" accept="image/*" class="inp">
                  <input id="pm-image1" class="inp" placeholder="image1.jpg" style="margin-top:8px">
                </div>
                <div>
                  <label>Image 2</label>
                  <input id="pm-image2-file" name="image2_file" type="file" accept="image/*" class="inp">
                  <input id="pm-image2" class="inp" placeholder="image2.jpg" style="margin-top:8px">
                </div>
                <div>
                  <label>Image 3</label>
                  <input id="pm-image3-file" name="image3_file" type="file" accept="image/*" class="inp">
                  <input id="pm-image3" class="inp" placeholder="image3.jpg" style="margin-top:8px">
                </div>
              </div>


            <div class="dropzone" style="margin-top:14px">
              <div class="dz-title">Arrastra y suelta imágenes aquí o <b style="color:#2563eb">selecciona archivos</b></div>
              <div class="dz-hint">Formatos soportados: JPG, PNG, WebP (máx. 5MB)</div>
            </div>
          </div>


          <!-- DETAILS -->
          <div id="tab-details" class="tab-pane">
            <div>
              <label>Descripción del Producto</label>
              <textarea id="pm-description" rows="4" class="inp" placeholder="Describe características y beneficios..."></textarea>
            </div>

            <div style="margin-top:14px">
              <label>Características (simple)</label>
              <textarea id="pm-caracteristicas_raw" rows="3" class="inp" placeholder="Una por línea o separadas por comas"></textarea>
            </div>

            <div style="margin-top:18px">
              <h3 style="margin:0 0 8px 0">Características 2</h3>
              <div id="pm-car2-list" style="display:flex;flex-direction:column;gap:10px"></div>
              <button type="button" class="btn" onclick="pmAddCar2()">+ Add row</button>
            </div>

            <div style="margin-top:18px">
              <h3 style="margin:0 0 8px 0">Especificaciones</h3>
              <div id="pm-esp-list" style="display:flex;flex-direction:column;gap:10px"></div>
              <button type="button" class="btn" onclick="pmAddEsp()">+ Add row</button>
              <small class="note">“Imagen” es la ruta a un .svg opcional, por ejemplo <code>icons/peso.svg</code>.</small>
            </div>

            <div style="margin-top:12px">
              <label>Fecha</label>
              <input id="pm-fecha" class="inp" placeholder="YYYY-MM-DD">
            </div>
          </div>

          <!-- Footer -->
          <div class="modal-foot">
            <button type="button" class="btn-cancel" onclick="closeProductModal()">Cancelar</button>
            <button type="submit" class="btn-save">
              <span class="material-symbols-outlined">save</span>
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
<script>
  // ====== Buscador en tiempo real ======
  const qInput = document.getElementById('q');

  function cleanTxt(s=''){
    return String(s).normalize('NFD').replace(/[\u0300-\u036f]/g,'').toLowerCase().trim();
  }

  function filterRowsRealtime(){
    const q = cleanTxt(qInput.value);
    const rows = document.querySelectorAll('.prod-row');
    if(!rows.length) return;

    rows.forEach(row=>{
      const name  = cleanTxt(row.dataset.name);
      const cat   = cleanTxt(row.dataset.cat);
      const price = cleanTxt(row.dataset.price);
      const stock = cleanTxt(row.dataset.stock);
      const state = cleanTxt(row.dataset.statusText);

      const match = !q || name.includes(q) || cat.includes(q) || price.includes(q) || stock.includes(q) || state.includes(q);
      row.style.display = match ? '' : 'none';
    });
  }

  // En vivo
  qInput?.addEventListener('input', filterRowsRealtime);

  // Aplica el filtro inicial si viene q del servidor
  window.addEventListener('DOMContentLoaded', filterRowsRealtime);
</script>

<script>
  // ====== Helpers ======
  function toast(msg='Saved'){
    const t=document.getElementById('toast');
    t.textContent=msg; t.style.opacity=1; t.style.transform='translateY(0)';
    setTimeout(()=>{ t.style.opacity=0; t.style.transform='translateY(8px)'; },1400);
  }

  // ====== Sidebar móvil (off-canvas) ======
  const burger = document.getElementById('burger');
  const sidebar = document.getElementById('sidebar');
  const backdropNav = document.getElementById('backdropNav');
  burger?.addEventListener('click', ()=>{
    sidebar.classList.toggle('open');
    backdropNav.classList.toggle('show', sidebar.classList.contains('open'));
  });
  backdropNav?.addEventListener('click', ()=>{
    sidebar.classList.remove('open'); backdropNav.classList.remove('show');
  });
  // ====== Path helpers (fix para imágenes que se pierden tras guardar) ======
const IMG_BASE = "{{ asset('image/productos') }}";    // sin slash final
const FALLBACK_IMG = "{{ asset('image/productos/default.png') }}";
const FRONT_SHOW_BASE = "{{ asset('busco') }}";       // /busco/{id} público

function resolveImg(path){
  if(!path) return FALLBACK_IMG;
  const s = String(path);
  if(/^https?:\/\//i.test(s) || s.startsWith('/')) return s;
  return IMG_BASE + '/' + s;
}

  // ====== Rutas ======
  const routes = {
    store:  "{{ route('admin.products.store') }}",
    show:   (id) => "{{ route('admin.products.show', 0) }}".replace('/0','/'+id),
    update: (id) => "{{ route('admin.products.update', 0) }}".replace('/0','/'+id),
    destroy:(id) => "{{ route('admin.products.destroy',0) }}".replace('/0','/'+id),
  };
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // ====== Detalle lateral (sin tocar modales) ======
  let currentProdId = null;

  function selectProdFromRow(rowEl){
    const p = {
      id: rowEl.dataset.id,
      name: rowEl.dataset.name,
      cat: rowEl.dataset.cat,
      price: Number(rowEl.dataset.price||0),
      stock: rowEl.dataset.stock,
      statusClass: rowEl.dataset.statusClass,
      statusText: rowEl.dataset.statusText,
      fecha: rowEl.dataset.fecha,
      img: rowEl.dataset.img
    };
    currentProdId = p.id;
    fillAside(p);
    document.querySelectorAll('.prod-row').forEach(x=>x.classList.remove('is-active'));
    rowEl.classList.add('is-active');
  }

  function fillAside(p){
    document.getElementById('pdImg').src = resolveImg(p.img);
    document.getElementById('pdName').textContent = p.name || '—';
    document.getElementById('pdCat').textContent = p.cat || '—';
    document.getElementById('pdDate').textContent = p.fecha || '—';
    document.getElementById('pdPrice').textContent = 'S/ ' + (Number(p.price||0)).toFixed(2);
    document.getElementById('pdStock').textContent = p.stock ?? '—';

    const stWrap = document.getElementById('pdStatus');
    stWrap.innerHTML = '';
    const chip = document.createElement('span');
    chip.className = 'status ' + (p.statusClass || 'st-out');
    chip.textContent = p.statusText || '—';
    stWrap.appendChild(chip);
  }
  ['pdImg','pdName'].forEach(id=>{
      const el = document.getElementById(id);
      if(!el) return;
      el.style.cursor = 'pointer';
      el.title = 'Ver en la tienda';
      el.addEventListener('click', ()=>{
        if (currentProdId) {
          // abre en esta pestaña; si quieres nueva, usa window.open(..., '_blank')
          window.location.href = `${FRONT_SHOW_BASE}/${currentProdId}`;
        }
      });
    });
  document.querySelectorAll('.prod-row').forEach(row=>{
    row.addEventListener('click', (e)=>{
      if(e.target.closest('.actions')) return;
      selectProdFromRow(row);
    });

    const btn = row.querySelector('.btn-3dots');
    const menu = row.querySelector('.menu');
    btn.addEventListener('click', ev=>{
      ev.stopPropagation();
      document.querySelectorAll('.menu').forEach(m=>m.style.display='none');
      menu.style.display = 'block';
      document.addEventListener('click',()=> menu.style.display='none', {once:true});
    });

    const verBtn = row.querySelector('[data-action="ver"]');
    verBtn.addEventListener('click', ev=>{
      ev.stopPropagation();
      selectProdFromRow(row);
      menu.style.display='none';
    });
  });

  window.addEventListener('DOMContentLoaded', ()=>{
    const first = document.querySelector('.prod-row');
    if(first){ selectProdFromRow(first); }
  });

  // ====== MODALES: MISMAS FUNCIONES QUE TU BLADE ======
  function showPMTab(id){
    document.querySelectorAll('.tab-btn').forEach(b=>b.classList.toggle('active', b.dataset.tab===id));
    document.querySelectorAll('.tab-pane').forEach(p=>p.classList.toggle('active', p.id==='tab-'+id));
  }
  document.getElementById('pm-tabs').addEventListener('click', (e)=>{
    const btn=e.target.closest('.tab-btn'); if(!btn) return;
    showPMTab(btn.dataset.tab);
  });

  function updateProfit(){
    const price=parseFloat(document.getElementById('pm-precio').value)||0;
    const cost =parseFloat(document.getElementById('pm-costo').value)||0;
    const panel=document.getElementById('profit-panel');
    if(price>0 && cost>0){
      panel.style.display='block';
      const m=price-cost;
      document.getElementById('pf-margin').textContent = '$'+m.toFixed(2);
      document.getElementById('pf-marginp').textContent = ((m/price)*100).toFixed(1)+'%';
      document.getElementById('pf-roi').textContent = ((m/cost)*100).toFixed(1)+'%';
    }else{
      panel.style.display='none';
    }
  }

  function openProductModal(id=null){
    document.body.style.overflow = "hidden";
    resetProductForm();
    showPMTab('basic');
    const bd=document.getElementById('product-modal');
    if(id){
      document.getElementById('pm-title').textContent='Edit Product #' + id;
      document.getElementById('pm-id').value = id;
      fetch(routes.show(id), {headers:{'Accept':'application/json'}})
        .then(r=>r.json()).then(fillProductForm)
        .then(()=>{ if(!document.querySelector('#pm-car2-list .row-form')) pmAddCar2();
                    if(!document.querySelector('#pm-esp-list .row-esp')) pmAddEsp();
                    updateProfit();
                    bd.classList.add('open'); })
        .catch(()=>toast('Failed to load'));
    } else {
      document.getElementById('pm-title').textContent='Add Product';
      pmAddCar2(); pmAddEsp();
      updateProfit();
      bd.classList.add('open');
    }
  }
  function closeProductModal(){
    document.body.style.overflow = "";
    document.getElementById('product-modal').classList.remove('open');
  }

  function resetProductForm(){
    const ids=['pm-id','pm-name','pm-tipo','pm-categoria','pm-codigo','pm-precio','pm-costo','pm-preciof','pm-stock','pm-volumen','pm-puntos','pm-fecha','pm-image','pm-thumb','pm-image1','pm-image2','pm-image3','pm-description','pm-caracteristicas_raw'];
    ids.forEach(id=>{ const el=document.getElementById(id); if(el) el.value=''; });
    ['pm-oferta','pm-preventab','pm-impropio','pm-soli'].forEach(id=>{ const el=document.getElementById(id); if(el) el.checked=false; });
    document.getElementById('pm-car2-list').innerHTML='';
    document.getElementById('pm-esp-list').innerHTML='';
    ['pm-image-file','pm-thumb-file','pm-image1-file','pm-image2-file','pm-image3-file'].forEach(id => {
      const el = document.getElementById(id);
      if (el) el.value = '';
    });
  }

  function fillProductForm(d){
    const set=(id,v)=>{ const el=document.getElementById(id); if(el) el.value = v ?? ''; };
    set('pm-name',d.name); set('pm-tipo',d.tipo); set('pm-categoria',d.categoria); set('pm-codigo',d.codigo);
    set('pm-precio',d.precio); set('pm-costo',d.costo); set('pm-preciof',d.preciof); set('pm-stock',d.stock);
    set('pm-volumen',d.volumen); set('pm-puntos',d.puntos); set('pm-fecha',d.fecha);
    set('pm-image',d.image); set('pm-thumb',d.thumb); set('pm-image1',d.image1); set('pm-image2',d.image2); set('pm-image3',d.image3);
    set('pm-description',d.description); set('pm-caracteristicas_raw',d.caracteristicas);
    document.getElementById('pm-oferta').checked = !!d.oferta;
    document.getElementById('pm-preventab').checked = !!d.preventab;
    document.getElementById('pm-impropio').checked = !!d.impropio;
    document.getElementById('pm-soli').checked = !!d.soli;

    const car2 = Array.isArray(d.caracteristicas2) ? d.caracteristicas2 : [];
    const esp  = Array.isArray(d.especificaciones) ? d.especificaciones : [];
    car2.forEach(i=>pmAddCar2(i.titulo ?? '', i.valor ?? ''));
    esp.forEach(i=>pmAddEsp(i.imagen ?? '', i.titulo ?? '', i.valor ?? ''));
  }

  function pmAddCar2(titulo='',valor=''){
    const wrap=document.getElementById('pm-car2-list');
    const row=document.createElement('div');
    row.className='row-form';
    row.innerHTML=`
      <input class="inp pm-car2-t" placeholder="Title" value="${titulo}">
      <input class="inp pm-car2-v" placeholder="Value" value="${valor}">
      <button type="button" class="remove" onclick="this.parentElement.remove()">Remove</button>`;
    wrap.appendChild(row);
  }
  function pmAddEsp(img='',tit='',val=''){
    const wrap=document.getElementById('pm-esp-list');
    const row=document.createElement('div');
    row.className='row-esp';
    row.innerHTML=`
      <input class="inp pm-esp-i" placeholder="image.svg (optional)" value="${img}">
      <input class="inp pm-esp-t" placeholder="Title" value="${tit}">
      <input class="inp pm-esp-v" placeholder="Value" value="${val}">
      <button type="button" class="remove" onclick="this.parentElement.remove()">Remove</button>`;
    wrap.appendChild(row);
  }

  function pmSerialize(){
    const get=(id)=>document.getElementById(id)?.value?.trim() ?? '';
    const car2=Array.from(document.querySelectorAll('#pm-car2-list .row-form')).map(r=>({
      titulo:r.querySelector('.pm-car2-t').value.trim(),
      valor :r.querySelector('.pm-car2-v').value.trim()
    }));
    const esp=Array.from(document.querySelectorAll('#pm-esp-list .row-esp')).map(r=>({
      imagen:r.querySelector('.pm-esp-i').value.trim(),
      titulo:r.querySelector('.pm-esp-t').value.trim(),
      valor :r.querySelector('.pm-esp-v').value.trim()
    }));
    return {
      tipo:get('pm-tipo') || null,
      name:get('pm-name'),
      volumen:get('pm-volumen') || null,
      codigo:get('pm-codigo'),
      stock:get('pm-stock'),
      categoria:get('pm-categoria'),
      image:get('pm-image'),
      thumb:get('pm-thumb'),
      precio:get('pm-precio') || null,
      costo:get('pm-costo') || null,
      preciof:get('pm-preciof') || null,
      description:get('pm-description'),
      caracteristicas_raw:get('pm-caracteristicas_raw'),
      puntos:get('pm-puntos'),
      image1:get('pm-image1'),
      image2:get('pm-image2'),
      image3:get('pm-image3'),
      impropio: document.getElementById('pm-impropio').checked ? 1 : 0,
      soli:     document.getElementById('pm-soli').checked ? 1 : 0,
      fecha:get('pm-fecha'),
      preventa:get('pm-preventa') || null,
      preventab:document.getElementById('pm-preventab').checked ? 1 : 0,
      oferta:   document.getElementById('pm-oferta').checked ? 1 : 0,
      car2, esp
    };
  }

  async function pmSave(){
  const id = document.getElementById('pm-id').value;
  const isEdit = !!id;
  const url = isEdit ? routes.update(id) : routes.store;

  const payload = pmSerialize();
  const fd = new FormData();

  // Campos simples (todo menos car2 y esp)
  Object.entries(payload).forEach(([key, value]) => {
    if (key === 'car2' || key === 'esp') return;
    if (value === null || value === undefined) return;
    fd.append(key, value);
  });

  // car2 como array de objetos
  payload.car2.forEach((item, index) => {
    fd.append(`car2[${index}][titulo]`, item.titulo || '');
    fd.append(`car2[${index}][valor]`, item.valor || '');
  });

  // esp como array de objetos
  payload.esp.forEach((item, index) => {
    fd.append(`esp[${index}][imagen]`, item.imagen || '');
    fd.append(`esp[${index}][titulo]`, item.titulo || '');
    fd.append(`esp[${index}][valor]`, item.valor || '');
  });

  // Archivos
  const mainFile  = document.getElementById('pm-image-file')?.files[0];
  const thumbFile = document.getElementById('pm-thumb-file')?.files[0];
  const img1File   = document.getElementById('pm-image1-file')?.files[0];
  const img2File   = document.getElementById('pm-image2-file')?.files[0];
  const img3File   = document.getElementById('pm-image3-file')?.files[0];

  if (mainFile)  fd.append('image_file', mainFile);
  if (thumbFile) fd.append('thumb_file', thumbFile);
  if (img1File)  fd.append('image1_file', img1File);
  if (img2File)  fd.append('image2_file', img2File);
  if (img3File)  fd.append('image3_file', img3File);
  // Para update usamos POST + _method = PUT
  if (isEdit) {
    fd.append('_method', 'PUT');
  }

  try {
    const res = await fetch(url, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrf,
        'Accept': 'application/json',
      },
      body: fd,
    });

    const data = await res.json().catch(() => ({}));
    if (!res.ok) {
      toast(data.message || 'Save failed');
      return;
    }

    upsertRow(data.item);
    closeProductModal();
    toast(isEdit ? 'Updated' : 'Created');
  } catch (e) {
    toast('Network error');
  }
}


  function rowTemplate(p){
      const stk = parseInt(String(p.stock||'0').replace(/\D/g,''))||0;
      const status = stk<=0?'Sin stock':(stk<=5?'Bajo':'Disponible');
      const statusClass = stk<=0?'st-out':(stk<=5?'st-low':'st-in');
      const img = resolveImg(p.image || p.thumb);

      return `
        <div class="row prod-row"
          data-id="${p.id}" data-name="${p.name||''}" data-cat="${p.categoria||''}"
          data-price="${(parseFloat(p.precio||0)).toFixed(2)}" data-stock="${p.stock||0}"
          data-status-class="${statusClass}" data-status-text="${status}"
          data-img="${img}">
          <div class="dot"></div>
          <div style="display:flex;align-items:center;gap:10px">
            <img class="thumb" src="${img}" alt="${p.name||''}">
            <div>
              <div class="p-name">${p.name||''}</div>
              <div class="sub">ID: ${String(p.id).padStart(3,'0')}</div>
            </div>
          </div>
          <div class="p-cat">${p.categoria||''}</div>
          <div class="price">S/ ${(parseFloat(p.precio||0)).toFixed(2)}</div>
          <div class="stock">${p.stock||0}</div>
          <div><span class="status ${statusClass}">${status}</span></div>
          <div class="actions">
            <button class="btn-3dots" aria-haspopup="menu" aria-expanded="false">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
              </svg>
            </button>
            <div class="menu" role="menu">
              <button data-action="ver" data-id="${p.id}">👁 Ver</button>
              <button onclick="openProductModal(${p.id})">✏️ Editar</button>
            </div>
          </div>
        </div>`;
    }


  function upsertRow(p){
    const list=document.getElementById('rows');
    let row=list.querySelector(`.prod-row[data-id="${p.id}"]`);
    if(!row){
      const wrapper=document.createElement('div');
      wrapper.innerHTML=rowTemplate(p);
      row = wrapper.firstElementChild;
      list.prepend(row);
      // bind events mínimos para la fila nueva
      row.addEventListener('click',(e)=>{ if(!e.target.closest('.actions')) selectProdFromRow(row); });
      row.querySelector('.btn-3dots').addEventListener('click', ev=>{
        ev.stopPropagation();
        const menu=row.querySelector('.menu');
        document.querySelectorAll('.menu').forEach(m=>m.style.display='none');
        menu.style.display='block';
        document.addEventListener('click',()=> menu.style.display='none', {once:true});
      });
      row.querySelector('[data-action="ver"]').addEventListener('click', ev=>{
        ev.stopPropagation(); selectProdFromRow(row); row.querySelector('.menu').style.display='none';
      });
      return;
    }
    // update dataset y celdas visibles
    const img = resolveImg(p.image || p.thumb);
    const stk = parseInt(String(p.stock||'0').replace(/\D/g,''))||0;
    const status = stk<=0?'Sin stock':(stk<=5?'Bajo':'Disponible');
    const statusClass = stk<=0?'st-out':(stk<=5?'st-low':'st-in');
    row.dataset.name = p.name||'';
    row.dataset.cat = p.categoria||'';
    row.dataset.price = (parseFloat(p.precio||0)).toFixed(2);
    row.dataset.stock = p.stock||0;
    row.dataset.statusClass = statusClass;
    row.dataset.statusText = status;
    row.dataset.img = img;
    row.querySelector('.thumb').src = img;
    row.querySelector('.p-name').textContent = p.name||'';
    row.querySelector('.p-cat').textContent = p.categoria||'';
    row.querySelector('.price').textContent = 'S/ ' + (parseFloat(p.precio||0)).toFixed(2);
    row.querySelector('.stock').textContent = p.stock||0;
    const pill = row.querySelector('.status');
    pill.className = 'status ' + statusClass;
    pill.textContent = status;
    if (String(currentProdId) === String(p.id)) {
  selectProdFromRow(row);
  }
 }
  // Guardar y borrar (mismos endpoints)
  async function deleteProduct(id){
    if(!confirm('Delete product?')) return;
    try{
      const res=await fetch(routes.destroy(id),{method:'DELETE',headers:{'Accept':'application/json','X-CSRF-TOKEN':csrf}});
      if(!res.ok){ toast('Delete failed'); return; }
      const row=document.querySelector(`.prod-row[data-id="${id}"]`); if(row) row.remove();
      toast('Deleted');
    }catch(e){ toast('Network error'); }
  }
</script>
</body>
</html>
