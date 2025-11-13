{{-- resources/views/admin/compras/index.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Compras | Admin</title>
  @include ('global.icon')
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
      --accent:#ff4242; --accent-2:#c21a1a;
      --good:#16a34a; --bad:#e11d48; --info:#2563eb;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;background:var(--bg);color:var(--text)}
    a{color:inherit;text-decoration:none}

    /* Layout principal */
    .app{display:grid;grid-template-columns:260px 1fr;min-height:100vh}
    .wrap{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1fr 360px;gap:18px}

    /* Sidebar */
    .sidebar{
      color:#fff; padding:24px 16px;
      position:sticky; top:0; height:100vh; z-index:40;
    }
    .sidebar .inner{
      height:100%;
      
      display:flex;flex-direction:column;justify-content:center;
      background:#ffebb0;
      padding:20px;border-radius:20px;
      border-radius:20px;padding:15px;position:relative;height:100%;display:flex;flex-direction:column;justify-content:center;
    }
    .brand{display:flex;align-items:center;gap:10px;margin-bottom:24px}
    .brand-logo{width:34px;height:34px;border-radius:10px;background:rgba(255,255,255,.9);display:grid;place-items:center;color:#ff6b3d;font-weight:800}
    .brand-name{font-weight:800;font-size:20px;letter-spacing:.2px}
    .nav{display:flex;flex-direction:column;gap:6px}
    .nav a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:#363636;opacity:.95}
    .nav a.active,.nav a:hover{background:rgba(255,255,255,.34);color:#aaaaaa}

    /* Topbar */
    .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
    .top-ttl{font-weight:800;font-size:22px;color:var(--sub)}
    .subhead{color:var(--muted);font-size:12px;}

    .search-wrap{position:relative;min-width:320px}
    .search{width:100%;background:#fff;border:1px solid var(--border);border-radius:12px;padding:12px 44px 12px 14px;font-size:14px;box-shadow:var(--shadow)}
    .search-ico{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:32px;height:32px;border-radius:10px;background:#ffebb0;display:grid;place-items:center;color:#fff;font-weight:800}
    .chip{background:#fff;border:1px solid var(--border);border-radius:999px;padding:10px 14px;font-size:14px;color:#1f2937;cursor:pointer}
    .btn{border:0;border-radius:12px;padding:10px 14px;font-weight:600;cursor:pointer}
    .btn-ghost{background:#fff;border:1px solid var(--border)}
    .btn-primary{background:#ffebb0;color:#656565}
    .btn-primary:hover{filter:brightness(.97)}

    /* Lista izquierda */
    .panel{padding:14px}
    .thead{display:grid;grid-template-columns:16px 160px 1fr 90px 1fr 120px 52px;gap:12px;padding:6px 6px 10px;color:var(--muted);font-size:12px;border-bottom:1px solid #eef2ff}
    .rows{display:flex;flex-direction:column;gap:12px}
    .row{font-size:12px;cursor:pointer;background:white;border-radius:15px;display:grid;grid-template-columns:16px 160px 1fr 90px 1fr 120px 52px;align-items:center;gap:12px;padding:12px 8px;border-top:1px solid #f1f5f9}
    .row:first-child{border-top:none;background:white;border-radius:15px}
    .row.is-active{background:#ffebb0;border-radius:15px}
    .dot{border-radius:999px;background:#9ca3af}
    .code{font-weight:800}
    .priority{font-weight:600;color:#ff6b3d;background:#fff3ed;border:1px solid #ffd7c7;padding:4px 10px;border-radius:999px;justify-self:start}
    .count{color:var(--muted);text-align:center}
    .dest{color:#334155}
    .status{justify-self:start;border-radius:999px;padding:6px 10px;font-size:12px;font-weight:700}
    .st-paid{background:#eef2ff;color:#3730a3}
    .st-ready{background:#eef6ff;color:#2563eb}
    .st-cancelled{background:#ffecef;color:#e11d48}
    .st-vacia{background:#f3f4f6;color:#6b7280}
    .actions{position:relative;justify-self:end}
    .btn-3dots{all:unset;cursor:pointer;border-radius:10px;padding:6px;display:grid;place-items:center}
    .btn-3dots:hover{background:#f3f4f6}
    .menu{position:absolute;right:0;top:36px;background:#fff;border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow);min-width:160px;padding:6px;display:none;z-index:5}
    .menu button{all:unset;display:flex;align-items:center;gap:8px;width:100%;padding:10px;border-radius:8px;cursor:pointer;color:#374151}
    .menu button:hover{background:#f3f4f6}
    .eye{width:18px;height:18px}

    /* Panel derecho */
    .aside{display:flex;flex-direction:column;gap:14px}
    .card{background:#fff;border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);padding:14px}
    .card h4{margin:0 0 12px;font-size:15px}
    .item-card{display:flex;gap:10px;align-items:center;justify-content:space-between;border:1px solid #f1f5f9;border-radius:12px;padding:10px}
    .thumb{width:62px;height:46px;border-radius:10px;background:linear-gradient(135deg,#e5ecff,#cfe0ff);overflow:hidden}
    .thumb img{width:100%;height:100%;object-fit:cover}
    .item-title{font-weight:700}
    .dim{font-size:12px;color:var(--muted)}
    .kv{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    .kv-row{display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:14px}
    .key{color:var(--muted)}
    .box{display:flex;gap:10px;align-items:center;border:1px dashed #cbd5e1;border-radius:12px;padding:12px}
    .box-ico{width:68px;height:52px;border-radius:10px;background:linear-gradient(135deg,#ffe9d8,#ffd1bb)}
    .btn-use{display:block;width:100%;height:42px;border:none;border-radius:12px;background:linear-gradient(180deg,var(--accent),var(--accent-2));color:#fff;font-weight:800;cursor:pointer}

    /* Modal */
    .backdrop{position:fixed;inset:0;background:rgba(15,23,42,.45);display:none;align-items:center;justify-content:center;padding:20px;z-index:50}
    .modal{background:#fff;border-radius:16px;max-width:920px;width:100%;max-height:90vh;overflow:auto;border:1px solid var(--border);box-shadow:var(--shadow)}
    .modal-hd{display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-bottom:1px solid var(--border)}
    .modal-bd{padding:16px}
    .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    .table{width:100%;border-collapse:collapse;background:#fff;border:1px solid var(--border);border-radius:12px;overflow:hidden}
    .table th,.table td{padding:10px;border-bottom:1px solid var(--border);font-size:14px}
    .input{width:100%;border:1px solid var(--border);border-radius:10px;padding:10px}
    .flash-ok{margin-top:8px;color:#166534;display:none}

    /* Topbar fija */
    .topbar{
      position:sticky; top:0; z-index:30;
      background:#fff; border-bottom:1px solid var(--border);
      display:flex; align-items:center; justify-content:space-between;
      padding:12px 18px;
      justify-content: end;
    }
    .left{display:flex;align-items:center;gap:10px}
    .burger{display:none}
    .page-title{font-weight:800}
    .sub{color:var(--muted);font-size:13px}
    .user{display:flex;align-items:center;gap:10px}
    .avatar{width:36px;height:36px;border-radius:10px;background:#ffd4d4;color:#b40909;display:grid;place-items:center;font-weight:800}

    /* Paginación */
    .pager{display:flex;align-items:center;justify-content:space-between;margin-top:14px;gap:10px}
    .pager-info{color:#7b8aa3;font-size:13px}
    .pager-list{list-style:none;display:flex;gap:6px;margin:0;padding:0}
    .pager-list a,.pager-list span{
      display:grid;place-items:center;min-width:38px;height:38px;padding:0 12px;
      border:1px solid #e5e7eb;border-radius:12px;background:#fff;color:#1f2937;text-decoration:none
    }
    .pager-list li:hover a{box-shadow:0 6px 18px rgba(32,41,63,.08)}
    .pager-list .active span{background:linear-gradient(180deg, #ff3f00, #f10101);color:#fff;border-color:transparent;font-weight:800}
    .pager-list .disabled span{opacity:.45;background:#f3f4f6;color:#6b7280}

    /* ====================== Responsive ====================== */

    /* Tablet: escondo sidebar, una sola columna de contenido */
    @media (max-width:1100px){
      .app{grid-template-columns:1fr}
      .sidebar{
        position:fixed;left:0;top:0;width:260px;height:100vh;
        transform:translateX(-100%);transition:transform .25s ease;
        padding:16px
      }
      .sidebar.open{transform:translateX(0)}
      .wrap{grid-template-columns:1fr}
    }

    /* Móvil: sidebar off-canvas, filas tipo tarjeta, inputs compactos */
    @media (max-width:760px){
      /* Off-canvas sidebar */
      .sidebar{
        display:block;
        position:fixed; inset:0 auto 0 0; 
        width:260px; transform:translateX(-100%);
        transition:transform .25s ease; z-index:60; padding:0;
        padding:16px

      }
      
      .sidebar .nav a{padding:12px 14px}
      .sidebar .brand{position:static;margin:16px}
      .sidebar .inner{
        height:100%; display:flex; flex-direction:column; justify-content:center;
        background:linear-gradient(180deg, #fb4949 0%, #ff1e1e 50%, #ff4a4a 100%); padding:20px; border-radius:20px
      }
      .sidebar.is-open{transform:translateX(0)}
      .sidebar-backdrop{
        position:fixed; inset:0; background:rgba(0,0,0,.35); z-index:55; display:none;
      }
      .sidebar-backdrop.is-open{display:block}

      .burger{display:inline-grid;place-items:center;width:40px;height:40px;border:1px solid var(--border);border-radius:10px;background:#fff;cursor:pointer}

      /* Topbars */
      .topbar{padding:10px 12px;justify-content: space-between;}
      .search-wrap{min-width:unset; width:100%}
      .search{padding:10px 40px 10px 12px; font-size:13px}
      .chip{padding:8px 10px; font-size:12px}

      /* Grid principal: listado arriba, aside debajo */
      .wrap{grid-template-columns:1fr; gap:12px; padding:0 12px}

      /* Encabezado de la "tabla" fuera en móvil */
      .thead{display:none}

      /* Cada row se vuelve tarjeta con layout propio */
      .row{
        grid-template-columns:1fr;
        grid-auto-rows:auto;
        gap:8px;
        padding:12px;
        border:1px solid #eef2ff;
      }
      .row .dot{display:none}
      .row .code{font-size:16px}
      .row .priority{justify-self:start}
      .row .count,.row .dest{justify-self:start;text-align:left}

      /* Distribución dentro de la tarjeta: cabecera, meta y estado/acciones */
      .row{
        display:grid;
        grid-template-areas:
          "code"
          "meta"
          "state"
          "actions";
      }
      .row .code{grid-area:code}
      .row .priority,.row .count,.row .dest{grid-area:meta}
      .row .status{grid-area:state}
      .row .actions{grid-area:actions; justify-self:stretch}
      .row .actions .btn-3dots{width:100%; border:1px solid var(--border);box-sizing: border-box;}

      /* Meta en una sola línea flexible */
      .row .priority,
      .row .count,
      .row .dest{
        display:inline-block;
        margin-right:8px;
      }

      /* Panel derecho: tarjetas compactas */
      .aside{padding-top:0}
      .item-card{align-items:flex-start}
      .thumb{width:56px;height:42px}
      .kv{grid-template-columns:1fr}

      /* Paginación: en columna, wrap */
      .pager{flex-direction:column;align-items:flex-start}
      .pager-list{flex-wrap:wrap}
    }

    /* Móvil chico: más compactación */
    @media (max-width:450px){
      .btn{padding:8px 10px}
      .btn-ghost{font-size:13px}
      .btn-primary{font-size:13px}
      .user{gap:8px}
      .avatar{width:32px;height:32px}
      .card{padding:12px}
      .grid-2{grid-template-columns:1fr; gap:12px}
      .search-ico{width:28px;height:28px}
      .venti{display:none}
    }
/* ===== FIX DEFINITIVO: Sidebar estable en ESCRITORIO (>=1101px) ===== */
@media (min-width:1101px){
  /* Grid de la app: reserva 260px para el sidebar sí o sí */
  .app{
    grid-template-columns: 260px 1fr !important;
  }

  /* Sidebar visible, con ancho fijo y pegado al top */
  .sidebar{
    display:block !important;
    position: sticky !important;
    top: 0 !important;
    height: 100vh !important;

    width: 260px !important;
    min-width: 260px !important;
    transform: none !important;   /* anula el off-canvas */
   
    overflow-y: auto !important;

    padding: 24px 16px !important;
    
    border-radius: 0 !important;  /* evita bordes raros del móvil */
    
  }

  /* Backdrop del off-canvas: inexistente en desktop */
  .sidebar-backdrop{ display:none !important; }

  /* Contenido interior del sidebar: layout vertical normal */
  

  /* La marca no debe ser absoluta en desktop */
  .brand{
    
    margin: 0 0 24px 0 !important;
  }

  /* Lista + panel derecho mantienen su grilla */
  .wrap{
    max-width: 1240px !important;
    margin: 0 auto !important;
    grid-template-columns: 1fr 360px !important;
    gap: 18px !important;
    padding: 0 !important;
  }

  /* Reestablece la “tabla” en filas */
  .thead{ display:grid !important; }
  .row{
    display:grid !important;
    grid-template-columns: 16px 160px 1fr 90px 1fr 120px 52px !important;
    align-items: center !important;
    gap: 12px !important;
    padding: 12px 8px !important;
    border: 0 !important;
  }
  .row .dot{ display:block !important;  }
  .row .actions{ justify-self:end !important; }
  .row .priority, .row .count, .row .dest{
    display:unset !important;
    margin-right:0 !important;
  }

  /* Formularios y KV vuelven a su densidad de desktop */
  .search-wrap{ min-width: 320px !important; }
  .kv{ grid-template-columns: 1fr 1fr !important; }
  .grid-2{ grid-template-columns: 1fr 1fr !important; }

  /* Paginación horizontal en desktop */
  .pager{ flex-direction: row !important; align-items: center !important; }
  .pager-list{ flex-wrap: nowrap !important; }
}

/* Extra de cortesía: evita scroll horizontal por desplazamientos del off-canvas */
html, body{ overflow-x: hidden; }

    .st-ok{background:#eef6ff;color:#2563eb}
    .st-null{background:#f3f4f6;color:#6b7280}
    .tag{display:inline-block;background:#eef2ff;color:#3730a3;padding:2px 8px;border-radius:9999px;font-size:12px}
    .muted{color:#7b8aa3}
    .w-100{width:100%}
    .table-sm td input{width:100%;border:1px solid #e5e7eb;border-radius:8px;padding:6px 8px}
    .pill{background:#fff3ed;border:1px solid #ffd7c7;border-radius:9999px;padding:2px 8px;font-weight:600;color:#ff6b3d}
    .sb-foot{color:#ffe9e2;opacity:.85;font-size:12px;text-align:center;position: absolute;    bottom: 5px;    right: 28px;}

  </style>
</head>
<body>
<div class="app">
  {{-- SIDEBAR (idéntico a Ventas, cambiando activo a "Compras" si tienes item) --}}
  <aside class="sidebar" id="sidebar">
    <div class="inner" style="">
      <div class="brand" style="position:absolute;top:10px;left:15px">
        <a href="{{asset('/')}}"><img src="{{asset('image/logo.webp')}}" alt="" style="width:50%"></a>
      </div>
      <nav class="nav">
        <a href="{{route('admin.dashboard')}}" ><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
        <a href="{{asset('admin/ventas')}}"><span class="material-symbols-outlined">attach_money</span>Ventas</a>
        <a href="{{asset('admin/envios')}}" class=""><span class="material-symbols-outlined">local_shipping</span>Envíos</a>
        <a href="#" class="active"><span class="material-symbols-outlined">shopping_cart</span>Compras</a>
        <a href="{{asset('admin/productos')}}"><span class="material-symbols-outlined">barcode_scanner</span>Inventario</a>
        
        <a href="{{ route('admin.cupones.index') }}"><span class="material-symbols-outlined">confirmation_number</span>Cupones</a>
        <a href="{{asset('admin/usuarios')}}"><span class="material-symbols-outlined">contacts_product</span>Usuarios</a>
        
        <a href="#"><span class="material-symbols-outlined">settings</span>Configuración</a>
      </nav>
      <form method="POST" action="{{ route('logout') }}">
            @csrf
        <button type="submit" class="logout-btn" style=" cursor:pointer; color:white;  position: absolute; right: 25%;  background: none;  border: 1px solid white; padding: 10px;  width: 50%; border-radius: 10px; bottom: 35px;">
            Logout
        </button>
      </form>
      <div class="sb-foot">© {{ date('Y') }} {{env('DEVELOPER_NAME')}}</div>
    </div>
    
  </aside>
  <div class="sidebar-backdrop" id="sidebar-backdrop"></div>

  {{-- MAIN --}}
  <main class="main">
    {{-- TOP USER BAR --}}
    <div class="topbar" style="position: relative;background:none;box-shadow:none;border:none;margin-top:8px;gap:20px">
      <div class="left"><button class="burger" id="burger" aria-label="Abrir menú">☰</button></div>
      <div class="venti" style="background:white;border-radius:15px;padding:10px;height:56px;width:200px;">
        <div class="top-ttl">Compras</div>
        <div class="subhead">{{ $compras->total() }} compras encontradas</div>
      </div>
      <div class="user" style="padding:10px;background:#ffebb0;border-radius:15px;color:white;">
        <div class="avatar" style="background:none;color:#656565">{{ strtoupper(mb_substr(Auth::user()->name ?? 'A',0,1)) }}</div>
        <div style="display:flex;flex-direction:column;line-height:1">
          <strong>Admin</strong>
          <span class="sub" style="color:#656565">{{ Auth::user()->email ?? '' }}</span>
        </div>
      </div>
    </div>

    {{-- FILTER BAR --}}
    <div class="topbar" style="margin:20px;top:20px;border-radius:15px;margin-top:0;background:rgba(256,256,256,.5);backdrop-filter:blur(3px);">
      <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;flex-direction:row;width:100%">
        <form method="get" action="{{ route('admin.compras.index') }}" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;width:100%">
          <div class="search-wrap" style="flex:1 1 260px">
            <input class="search" type="text" name="q" placeholder="Buscar compras (código, proveedor, factura)..." value="{{ $q ?? '' }}">
            <span class="search-ico">⌕</span>
          </div>
          <input class="chip" type="date" name="from" value="{{ $from ?? '' }}">
          <input class="chip" type="date" name="to" value="{{ $to ?? '' }}">
          <button class="btn btn-ghost" type="submit"><span class="material-symbols-outlined">output</span></button>
          <a class="btn btn-ghost" href="{{ route('admin.compras.index') }}"><span class="material-symbols-outlined">cleaning_services</span></a>
          <div style="display:flex;gap:10px;justify-content:flex-end;flex-direction:row">
            <button class="btn btn-ghost" onclick="window.print()" type="button"><span class="material-symbols-outlined">download</span></button>
            <button class="btn btn-primary" type="button" id="btn-open-create">Crear compra</button>
          </div>
        </form>
      </div>
    </div>

    {{-- GRID --}}
    <div class="wrap">
      {{-- LISTA IZQUIERDA --}}
      <section class="panel">
        <div class="thead">
          <div></div>
          <div>Código</div>
          <div>Proveedor</div>
          <div>Items</div>
          <div>Fecha</div>
          <div>Factura</div>
          <div></div>
        </div>

        <div class="rows" id="rows">
          @foreach($compras as $c)
          <div class="row compra-row" data-id="{{ $c->idcompra }}">
            <div class="dot"></div>
            <div class="code">{{ $c->codigo }}</div>
            <div><span class="priority">{{ $c->proveedor ?? '—' }}</span></div>
            <div class="count">{{ $c->detalles_count }}</div>
            <div class="dest">{{ \Illuminate\Support\Carbon::parse($c->fecha)->format('d/m/Y H:i') }}</div>
            <div>
              @php
                $hasFact = $c->factura_numero || $c->factura_path;
              @endphp
              <span class="status {{ $hasFact ? 'st-ok' : 'st-null' }}">{{ $hasFact ? 'Con factura' : 'Sin factura' }}</span>
            </div>
            <div class="actions">
              <button class="btn-3dots" aria-haspopup="menu" aria-expanded="false">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
                </svg>
              </button>
              <div class="menu" role="menu">
                <button data-action="ver" data-id="{{ $c->idcompra }}">
                  <svg class="eye" viewBox="0 0 24 24" fill="none" stroke="#334155" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/>
                  </svg>
                  Ver
                </button>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="pager">
          <div class="pager-info">Mostrando página {{ $compras->currentPage() }} de {{ $compras->lastPage() }}</div>
          {{ $compras->onEachSide(1)->links('vendor.pagination.adler') }}
        </div>
      </section>

      {{-- PANEL DERECHO --}}
      <aside class="aside" style="padding-top:40px">
        <div class="card">
          <h4>Items</h4>
          <div id="listItems" style="display:grid;gap:10px">
            <div class="dim">Selecciona una compra de la lista…</div>
          </div>
        </div>

        <div class="card">
          <h4>Resumen</h4>
          <div class="kv">
            <div class="kv-row"><div class="key">Código</div><div id="kvCode">—</div></div>
            <div class="kv-row"><div class="key">Proveedor</div><div id="kvProv">—</div></div>
            <div class="kv-row"><div class="key">Fecha</div><div id="kvFecha">—</div></div>
            <div class="kv-row"><div class="key">Items</div><div id="kvCount">—</div></div>
            <div class="kv-row"><div class="key">Total</div><div id="kvTotal">—</div></div>
          </div>
        </div>

        <div class="card">
          <h4>Factura</h4>
          <div id="kvFactura" class="dim">—</div>
        </div>
      </aside>
    </div>
  </main>
</div>

{{-- MODAL: CREAR COMPRA --}}
<div id="modal-create" class="backdrop">
  <div class="modal">
    <div class="modal-hd">
      <h3 style="margin:0;font-weight:800">Crear compra</h3>
      <button class="btn btn-ghost" onclick="closeCreate()">Cerrar</button>
    </div>
    <div class="modal-bd">
      <div class="grid-2">
        <div>
          <label class="dim">Proveedor</label>
          <input type="text" id="c-proveedor" class="input" placeholder="Opcional">
        </div>
        <div>
          <label class="dim">Fecha</label>
          <input type="datetime-local" id="c-fecha" class="input" value="{{ now()->format('Y-m-d\\TH:i') }}">
        </div>
        <div>
          <label class="dim">Factura (número)</label>
          <input type="text" id="c-fact-nro" class="input" placeholder="Opcional">
        </div>
        <div>
          <label class="dim">Factura (archivo)</label>
          <input type="file" id="c-fact-file" class="input" accept=".pdf,.jpg,.jpeg,.png">
        </div>
      </div>

      <hr style="margin:14px 0;border:none;border-top:1px solid #e5e7eb">

      {{-- Buscador de productos --}}
      <div>
        <label class="dim">Agregar productos</label>
        <div style="display:flex;gap:8px;align-items:center">
          <input type="text" id="prod-q" class="input" placeholder="Buscar por nombre o código...">
          <button class="btn btn-ghost" type="button" id="prod-btn">Buscar</button>
        </div>
        <div id="prod-results" class="card" style="margin-top:8px;display:none"></div>
      </div>

      {{-- Tabla de items --}}
      <div style="margin-top:12px">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Producto</th><th style="width:90px">Stock</th><th style="width:90px">Cant.</th><th style="width:120px">Costo</th><th style="width:120px">Subtotal</th><th style="width:40px"></th>
            </tr>
          </thead>
          <tbody id="c-items"></tbody>
          <tfoot>
            <tr>
              <td colspan="4" style="text-align:right"><strong>Subtotal</strong></td>
              <td id="c-subtotal" style="text-align:right">0.00</td><td></td>
            </tr>
            <tr>
              <td colspan="4" style="text-align:right"><strong>Impuesto</strong></td>
              <td id="c-impuesto" style="text-align:right">0.00</td><td></td>
            </tr>
            <tr>
              <td colspan="4" style="text-align:right"><strong>Total</strong></td>
              <td id="c-total" style="text-align:right">0.00</td><td></td>
            </tr>
          </tfoot>
        </table>
      </div>

      <div style="display:flex;align-items:center;gap:10px;margin-top:12px">
        <button class="btn btn-primary" type="button" id="btn-save-compra">Guardar compra</button>
        <div id="c-flash" class="flash-ok">Creada.</div>
      </div>
    </div>
  </div>
</div>

{{-- MODAL: DETALLE COMPRA --}}
<div id="modal-backdrop" class="backdrop">
  <div class="modal">
    <div class="modal-hd">
      <h3 id="m-title" style="margin:0;font-weight:800">Compra</h3>
      <button class="btn btn-ghost" onclick="closeDetalle()">Cerrar</button>
    </div>
    <div class="modal-bd">
      <div id="m-content"></div>
    </div>
  </div>
</div>

<script>
/* ================= Utilidades ================= */
const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const qs = sel => document.querySelector(sel);
const qsa = sel => Array.from(document.querySelectorAll(sel));

function debounce(fn, ms=300){
  let t; return (...args)=>{ clearTimeout(t); t=setTimeout(()=>fn(...args), ms); };
}

/* Manejo robusto de respuestas:
   - Si viene JSON -> parsea JSON
   - Si viene HTML/texto:
       * si r.ok lo tratamos como éxito "fallback" (caso redirección a HTML)
       * si r.noOk mostramos el HTML como error real
*/
async function parseSmart(r){
  const ct = r.headers.get('content-type') || '';
  if (ct.includes('application/json')) {
    const data = await r.json();
    if (!r.ok) {
      const msg = data?.message || (data?.errors ? Object.values(data.errors).flat().join('\n') : 'Error');
      throw new Error(msg);
    }
    return data;
  } else {
    const html = await r.text();
    if (!r.ok) {
      // error real en HTML (419/422/500/...); muestralo
      throw new Error(html.replace(/<[^>]+>/g,' ').slice(0,400));
    }
    // ok con HTML (probable redirect a una vista) -> considera éxito "fallback"
    return { ok: true, fallback: true, html };
  }
}

/* ================= Estado global ================= */
let currentCompraId = null;

/* ================= Sidebar off-canvas ================= */
const burger = qs('#burger');
const sidebar = qs('#sidebar');
const sbBackdrop = qs('#sidebar-backdrop');
if (burger) burger.addEventListener('click', ()=>{ sidebar.classList.add('is-open'); sbBackdrop.classList.add('is-open'); });
if (sbBackdrop) sbBackdrop.addEventListener('click', ()=>{ sidebar.classList.remove('is-open'); sbBackdrop.classList.remove('is-open'); });

/* ================= Render/acciones de filas ================= */
function bindRowEvents(){
  qsa('.compra-row').forEach(row=>{
    row.addEventListener('click', (e)=>{
      if(e.target.closest('.actions')) return;
      selectCompra(row.dataset.id, row);
    });
    const btn = row.querySelector('.btn-3dots');
    const menu = row.querySelector('.menu');
    if(btn && menu){
      btn.addEventListener('click', ev=>{
        ev.stopPropagation();
        qsa('.menu').forEach(m=>m.style.display='none');
        menu.style.display='block';
        document.addEventListener('click',()=> menu.style.display='none',{once:true});
      });
      const verBtn = row.querySelector('[data-action="ver"]');
      if (verBtn){
        verBtn.addEventListener('click', ev=>{
          ev.stopPropagation(); openDetalle(verBtn.dataset.id); menu.style.display='none';
        });
      }
    }
  });
}

function selectCompra(id, rowEl){
  fetch(`{{ url('admin/compras') }}/${id}`, {
    headers:{ 'Accept':'application/json', 'X-Requested-With':'XMLHttpRequest' },
    credentials:'same-origin'
  })
  .then(parseSmart)
  .then(({compra})=>{
    fillAside(compra);
    if(rowEl){
      qsa('.compra-row').forEach(x=>x.classList.remove('is-active'));
      rowEl.classList.add('is-active');
    }
  })
  .catch(err=>console.warn('No se pudo cargar la compra:', err.message));
}

function fillAside(c){
  const itemsWrap = qs('#listItems'); itemsWrap.innerHTML='';
  const det = Array.isArray(c.detalles) ? c.detalles : [];
  if(det.length===0){
    itemsWrap.innerHTML = '<div class="dim">Sin items.</div>';
  } else {
    det.forEach(d=>{
      const el = document.createElement('div');
      el.className = 'item-card';
      el.innerHTML = `
        <div class="thumb"><img src="{{ asset('image/productos') }}/${d.producto?.image ?? ''}" alt=""></div>
        <div style="flex:1">
          <div class="item-title">${d.producto?.name ?? ('ID '+d.search_id)}</div>
          <div class="dim">Cant: ${d.qty} · S/ ${(Number(d.costo)||0).toFixed(2)}</div>
        </div>
        <div class="dim">S/ ${(Number(d.subtotal)||0).toFixed(2)}</div>`;
      itemsWrap.appendChild(el);
    });
  }
  qs('#kvCode').textContent  = c.codigo || '—';
  qs('#kvProv').textContent  = c.proveedor || '—';
  qs('#kvFecha').textContent = (c.fecha ?? '').replace('T',' ').substring(0,16);
  qs('#kvCount').textContent = det.length;
  qs('#kvTotal').textContent = (Number(c.total)||0).toFixed(2);
  const urlVer = `${"{{ url('admin/compras') }}"}/${encodeURIComponent(c.idcompra)}/factura/ver`;
  const f = (c.factura_numero ? 'N° '+c.factura_numero : '—') + (c.factura_path ? ` · <a href="${urlVer}" target="_blank">archivo</a>` : '');
  qs('#kvFactura').innerHTML = f || '—';
}

/* ================= Carga inicial ================= */
window.addEventListener('DOMContentLoaded', ()=>{
  bindRowEvents();
  const first = qs('.compra-row');
  if(first){ selectCompra(first.dataset.id, first); }
});

/* ================= Crear compra (modal) ================= */
const mc = qs('#modal-create');
qs('#btn-open-create').addEventListener('click', ()=> mc.style.display='flex');
function closeCreate(){ mc.style.display='none'; const f=qs('#c-flash'); if(f) f.style.display='none'; }

const prodQ = qs('#prod-q');
const prodBtn = qs('#prod-btn');
const prodResults = qs('#prod-results');
const cItems = qs('#c-items');

function renderTotals(){
  let subtotal=0;
  qsa('#c-items tr').forEach(tr=>{
    const qty = Number(tr.querySelector('.i-qty').value)||0;
    const cost= Number(tr.querySelector('.i-cost').value)||0;
    const st = qty*cost; subtotal += st;
    tr.querySelector('.i-sub').textContent = st.toFixed(2);
  });
  qs('#c-subtotal').textContent = subtotal.toFixed(2);
  qs('#c-impuesto').textContent = (0).toFixed(2);
  qs('#c-total').textContent    = subtotal.toFixed(2);
}

function addItemRow(p){
  if (cItems.querySelector(`tr[data-id="${p.id}"]`)) return; // evita duplicado
  const tr = document.createElement('tr');
  tr.dataset.id = p.id;
  tr.innerHTML = `
    <td><div style="font-weight:700">${p.name}</div><div class="muted">ID ${p.id}</div></td>
    <td class="muted">${p.stock ?? 0}</td>
    <td><input type="number" class="i-qty" value="1" min="1"></td>
    <td><input type="number" class="i-cost" value="${Number(p.price||0).toFixed(2)}" min="0" step="0.01"></td>
    <td style="text-align:right"><span class="i-sub">0.00</span></td>
    <td><button type="button" class="btn btn-ghost btn-del">✕</button></td>
  `;
  cItems.appendChild(tr);
  tr.querySelectorAll('.i-qty,.i-cost').forEach(inp=> inp.addEventListener('input', renderTotals));
  tr.querySelector('.btn-del').addEventListener('click', ()=>{ tr.remove(); renderTotals(); });
  renderTotals();
}

function searchProducts(){
  const q = prodQ.value.trim();
  if(!q){ prodResults.style.display='none'; prodResults.innerHTML=''; return; }
  fetch(`{{ route('admin.searches.index') }}?q=${encodeURIComponent(q)}`, {
    headers:{ 'Accept':'application/json','X-Requested-With':'XMLHttpRequest' },
    credentials:'same-origin'
  })
  .then(parseSmart)
  .then(({data})=>{
    prodResults.innerHTML = data.length ? data.map(p=>`
      <div class="item-card">
        <div class="thumb"><img src="{{ asset('image/productos') }}/${p.image ?? ''}" alt=""></div>
        <div style="flex:1">
          <div class="item-title">${p.name}</div>
          <div class="dim">Stock: ${p.stock ?? 0} · Precio ref: S/ ${(Number(p.price)||0).toFixed(2)}</div>
        </div>
        <button type="button" class="btn btn-primary btn-add" data-id="${p.id}" data-name="${p.name}" data-price="${Number(p.price)||0}" data-stock="${p.stock ?? 0}">Agregar</button>
      </div>
    `).join('') : '<div class="dim">Sin resultados</div>';
    prodResults.style.display='block';
    prodResults.querySelectorAll('.btn-add').forEach(b=>{
      b.addEventListener('click', ()=>{
        addItemRow({
          id: Number(b.dataset.id),
          name: b.dataset.name,
          price: Number(b.dataset.price),
          stock: Number(b.dataset.stock)
        });
      });
    });
  })
  .catch(err=>{ prodResults.style.display='block'; prodResults.innerHTML=`<div class="dim">Error buscando: ${err.message}</div>`; });
}
prodBtn.addEventListener('click', searchProducts);
prodQ.addEventListener('input', debounce(searchProducts, 300));

qs('#btn-save-compra').addEventListener('click', ()=>{
  const rows = qsa('#c-items tr');
  if(rows.length===0){ alert('Agrega al menos un producto.'); return; }

  const items = rows.map(tr=>({
    search_id: Number(tr.dataset.id),
    qty:       Number(tr.querySelector('.i-qty').value)||0,
    costo:     Number(tr.querySelector('.i-cost').value)||0
  }));
  if(items.some(x=>x.qty<=0 || x.costo<0)){ alert('Cantidades o costos inválidos.'); return; }

  const fd = new FormData();
  fd.append('_token', CSRF);
  fd.append('fecha', qs('#c-fecha').value);
  fd.append('proveedor', qs('#c-proveedor').value);
  fd.append('factura_numero', qs('#c-fact-nro').value);
  const file = qs('#c-fact-file').files[0];
  if(file) fd.append('factura', file);
  items.forEach((it, i)=>{
    fd.append(`items[${i}][search_id]`, it.search_id);
    fd.append(`items[${i}][qty]`, it.qty);
    fd.append(`items[${i}][costo]`, it.costo);
  });

  fetch(`{{ route('admin.compras.store') }}`, {
    method:'POST',
    body: fd,
    credentials:'same-origin',
    headers: {
      'Accept':'application/json',
      'X-Requested-With':'XMLHttpRequest',
      'X-CSRF-TOKEN': CSRF // redundante pero útil si quitas _token del FormData
    }
  })
  .then(parseSmart)
  .then((resp)=>{
    // Si vino JSON con {ok:true} o vino HTML ok
    qs('#c-flash').textContent = 'Compra creada' + (resp?.codigo ? (': '+resp.codigo) : '');
    qs('#c-flash').style.display = 'block';
    setTimeout(()=> location.reload(), 600);
  })
  .catch(e=> alert(e.message || 'No se pudo crear.'));
});

/* ================= Modal Detalle ================= */
const md = qs('#modal-backdrop');
function openDetalle(id){
  currentCompraId = id;
  fetch(`{{ url('admin/compras') }}/${id}`, {
    headers: {'Accept':'application/json','X-Requested-With':'XMLHttpRequest'},
    credentials:'same-origin'
  })
  .then(parseSmart)
  .then(({compra})=>{
    const det = compra.detalles||[];
    const items = det.map(d=>`
      <tr>
        <td>${d.producto?.name ?? ('ID '+d.search_id)}</td>
        <td style="text-align:right">${d.qty}</td>
        <td style="text-align:right">${Number(d.costo).toFixed(2)}</td>
        <td style="text-align:right">${Number(d.subtotal).toFixed(2)}</td>
      </tr>
    `).join('');
   const facturaUrl = `${"{{ url('admin/compras') }}"}/${encodeURIComponent(compra.idcompra)}/factura`;
   

const facturaLink = (compra.factura_path || compra.factura_numero)
  ? `<a href="${facturaUrl}" target="_blank" rel="noopener">Ver archivo</a>`
  : '—';

const html = `
  <div class="grid-2">
    <div>
      <div class="item-title" style="margin-bottom:8px">Datos de compra</div>
      <p><span class="tag">${compra.codigo}</span></p>
      <p><strong>Fecha:</strong> ${(compra.fecha ?? '').replace('T',' ').substring(0,16)}</p>
      <p><strong>Proveedor:</strong> ${compra.proveedor ?? '—'}</p>
    </div>
    <div>
      <div class="item-title" style="margin-bottom:8px">Factura</div>
      <p>${compra.factura_numero ? ('N° '+compra.factura_numero) : '—'}</p>
      <p>${facturaLink}</p>
    </div>
  </div>
  <div class="item-title" style="margin:14px 0 6px">Detalle</div>
  <table class="table">
    <thead>
      <tr><th>Producto</th><th style="text-align:right">Cant.</th><th style="text-align:right">Costo</th><th style="text-align:right">Subtotal</th></tr>
    </thead>
    <tbody>${items}</tbody>
    <tfoot>
      <tr><td colspan="3" style="text-align:right"><strong>Subtotal</strong></td><td style="text-align:right">${Number(compra.subtotal).toFixed(2)}</td></tr>
      <tr><td colspan="3" style="text-align:right"><strong>Impuesto</strong></td><td style="text-align:right">${Number(compra.impuesto).toFixed(2)}</td></tr>
      <tr><td colspan="3" style="text-align:right"><strong>Total</strong></td><td style="text-align:right">${Number(compra.total).toFixed(2)}</td></tr>
    </tfoot>
  </table>
`;

    qs('#m-title').innerText = 'Compra ' + compra.codigo;
    qs('#m-content').innerHTML = html;
    md.style.display='flex';
  })
  .catch(()=> alert('No se pudo cargar la compra.'));
}
function closeDetalle(){ md.style.display='none'; }

/* ================= Búsqueda en tiempo real + paginación AJAX ================= */
const searchInput = document.querySelector('input.search[name="q"]');
const fromInput   = document.querySelector('input[name="from"]');
const toInput     = document.querySelector('input[name="to"]');

function buildQuery(page=null){
  const p = new URLSearchParams();
  if (searchInput && searchInput.value.trim()) p.set('q', searchInput.value.trim());
  if (fromInput && fromInput.value) p.set('from', fromInput.value);
  if (toInput && toInput.value)     p.set('to', toInput.value);
  if (page) p.set('page', page);
  return p.toString();
}

function renderListAjax(payload){
  // payload: {compras: {data:[], current_page, last_page, total}}
  const { compras } = payload;
  // título y conteo
  const venti = document.querySelector('.venti .subhead');
  if (venti) venti.textContent = `${compras.total} compras encontradas`;

  // lista
  const rows = document.getElementById('rows');
  rows.innerHTML = compras.data.map(c=>`
    <div class="row compra-row" data-id="${c.idcompra}">
      <div class="dot"></div>
      <div class="code">${c.codigo}</div>
      <div><span class="priority">${c.proveedor ?? '—'}</span></div>
      <div class="count">${c.detalles_count}</div>
      <div class="dest">${(c.fecha ?? '').replace('T',' ').substring(0,16)}</div>
      <div><span class="status ${ (c.factura_numero || c.factura_path) ? 'st-ok':'st-null'}">${ (c.factura_numero || c.factura_path) ? 'Con factura' : 'Sin factura'}</span></div>
      <div class="actions">
        <button class="btn-3dots" aria-haspopup="menu" aria-expanded="false">
          <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
          </svg>
        </button>
        <div class="menu" role="menu">
          <button data-action="ver" data-id="${c.idcompra}">
            <svg class="eye" viewBox="0 0 24 24" fill="none" stroke="#334155" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/>
            </svg>
            Ver
          </button>
        </div>
      </div>
    </div>
  `).join('');

  // paginación (simple, numérica)
  const pager = document.querySelector('.pager');
  const cur = compras.current_page;
  const last = compras.last_page;

  function pageLink(p, label, active=false, disabled=false){
    if (disabled) return `<li class="disabled"><span>${label}</span></li>`;
    if (active)   return `<li class="active"><span>${label}</span></li>`;
    return `<li><a href="?${buildQuery(p)}" data-page="${p}">${label}</a></li>`;
  }

  const pages = [];
  pages.push(pageLink(Math.max(1,cur-1), '‹', false, cur===1));
  for (let p=Math.max(1,cur-1); p<=Math.min(last,cur+1); p++){
    pages.push(pageLink(p, String(p), p===cur, false));
  }
  pages.push(pageLink(Math.min(last,cur+1), '›', false, cur===last));

  pager.innerHTML = `
    <div class="pager-info">Mostrando página ${cur} de ${last}</div>
    <ul class="pager-list">${pages.join('')}</ul>
  `;

  // volver a enlazar filas y auto-seleccionar
  bindRowEvents();
  const first = document.querySelector('.compra-row');
  if(first){ selectCompra(first.dataset.id, first); }

  // intercepta clicks de paginación
  pager.querySelectorAll('a[data-page]').forEach(a=>{
    a.addEventListener('click', (ev)=>{
      ev.preventDefault();
      const p = a.getAttribute('data-page');
      fetchList(p);
      history.replaceState({}, '', `?${buildQuery(p)}`);
    });
  });
}

function fetchList(page=null){
  const q = buildQuery(page);
  const url = `{{ route('admin.compras.index') }}${q ? ('?'+q) : ''}`;
  fetch(url, {
    headers: {'Accept':'application/json','X-Requested-With':'XMLHttpRequest'},
    credentials:'same-origin'
  })
  .then(parseSmart)
  .then(renderListAjax)
  .catch(err=>console.warn('Error refrescando lista:', err.message));
}

// eventos de búsqueda en tiempo real
if (searchInput) searchInput.addEventListener('input', debounce(()=>{ fetchList(1); history.replaceState({}, '', `?${buildQuery(1)}`); }, 300));
if (fromInput)   fromInput.addEventListener('change', ()=>{ fetchList(1); history.replaceState({}, '', `?${buildQuery(1)}`); });
if (toInput)     toInput.addEventListener('change',   ()=>{ fetchList(1); history.replaceState({}, '', `?${buildQuery(1)}`); });

// intercepta submit del form de filtros para que no recargue toda la página
const filterForm = document.querySelector('form[action="{{ route('admin.compras.index') }}"]');
if (filterForm) filterForm.addEventListener('submit', (e)=>{ e.preventDefault(); fetchList(1); history.replaceState({}, '', `?${buildQuery(1)}`); });

</script>

</body>
</html>
