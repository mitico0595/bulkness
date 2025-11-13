<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ventas | Admin</title>
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
      --shipped-bg:#c3ffdb;         /* verde claro */
      --shipped-active:#79c79a ;     /* verde más oscuro al seleccionar */
      --delivered-bg:#e2e2e2;       /* plomo claro */
      --delivered-active:#8c8c8c;   /* plomo más oscuro al seleccionar */
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
    .brand{display:flex;align-items:center;gap:10px;margin-bottom:24px;position:absolute;top:30px}
    .brand a img{width:120px;max-width:100%}
    .nav{display:flex;flex-direction:column;gap:6px}
    .nav a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:#363636;opacity:.95}
    .nav a.active,.nav a:hover{background:rgba(255,255,255,.34);color:#aaaaaa}
    .sb-foot{color:#ffe9e2;opacity:.85;font-size:12px;text-align:center;position: absolute;    bottom: 35px;    right: 28px;}

    .backdrop-nav{display:none;position:fixed;inset:0;background:rgba(15,23,42,.45);z-index:35}

    /* Topbar */
    .topbar{display:flex;align-items:center;justify-content:end;gap:10px;margin-bottom:12px}
    .top-ttl{font-weight:800;font-size:22px;color:var(--sub)}
    .subhead{color:var(--muted);font-size:12px;}

    .search-wrap{position:relative;min-width:320px}
    .search{width:100%;background:#fff;border:1px solid var(--border);border-radius:12px;padding:12px 44px 12px 14px;font-size:14px;box-shadow:var(--shadow)}
    .search-ico{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:32px;height:32px;border-radius:10px;background:#ffebb0;display:grid;place-items:center;color:#fff;font-weight:800}
    .chip{background:#fff;border:1px solid var(--border);border-radius:999px;padding:10px 14px;font-size:14px;color:#1f2937;cursor:pointer}
    .btn{border:0;border-radius:12px;padding:10px 14px;font-weight:600;cursor:pointer}
    .btn-ghost{background:#fff;border:1px solid var(--border)}
    .btn-primary{background:linear-gradient(180deg,var(--accent),var(--accent-2));color:#fff}
    .btn-primary:hover{filter:brightness(.97)}

    /* Lista izquierda */
    .panel{padding:14px}
    .thead{display:grid;grid-template-columns:16px 160px 1fr 90px 1fr 120px 52px;gap:12px;padding:6px 6px 10px;color:var(--muted);font-size:12px;border-bottom:1px solid #eef2ff}
    .rows{display:flex;flex-direction:column;gap:12px}
    .row{cursor:pointer;background:white;border-radius:15px;display:grid;grid-template-columns:16px 160px 1fr 90px 1fr 120px 52px;align-items:center;gap:12px;padding:12px 8px;border-top:1px solid #f1f5f9}
    .row:first-child{border-top:none;background:white;border-radius:15px}
    .row.is-active{background:#ffebb0;border-radius:15px}
    


/* Envío creado (no entregado) */
.row.shipped{ background:var(--shipped-bg); }
.row.shipped.is-active{ background:var(--shipped-active) !important; }

/* Entregado */
.row.delivered{ background:var(--delivered-bg); }
.row.delivered.is-active{ background:var(--delivered-active) !important; }
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
    .btn-use{display:block;width:100%;height:42px;border:none;border-radius:12px;background:#ffebb0;font-weight:800;cursor:pointer}

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
      display:flex; align-items:center; 
      padding:12px 18px;
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
      .topbar{padding:10px 12px;justify-content:space-between}
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
.sb-foot{color:#ffe9e2;opacity:.85;font-size:12px;text-align:center;position: absolute;    bottom: 5px;    right: 28px;}
/* Autocomplete simple */
.dd-wrap{position:relative}
.dd-list{
  position:absolute; left:0; right:0; top:100%; margin-top:6px;
  background:#fff; border:1px solid var(--border); border-radius:12px;
  box-shadow:var(--shadow); max-height:240px; overflow:auto; display:none; z-index:70
}
.dd-item{padding:10px 12px; cursor:pointer; display:flex; align-items:center; gap:8px; font-size:14px}
.dd-item:hover{background:#f8fafc}
.badge-green{
  background:#dcfce7;color:#166534;border:1px solid #bbf7d0;
  padding:8px 10px;border-radius:10px;font-size:13px;margin-top:8px
}
.lock{opacity:.7; pointer-events:none}

  </style>
</head>
<body>
  <div class="app">
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar" >
      <div class="inner" style="">
        <div class="brand" style="position:absolute;top:10px;left:15px">
          <a href="{{asset('/')}}"><img src="{{asset('image/logo.webp')}}" alt="" style="width:50%"></a>
        </div>
        <nav class="nav">
          <a href="{{route('admin.dashboard')}}" ><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
          <a href="#" class="active"><span class="material-symbols-outlined">attach_money</span>Ventas</a>
          <a href="{{ url('admin/envios') }}" class=""><span class="material-symbols-outlined">local_shipping</span>Envíos</a>
          <a href="{{ route('admin.index_images.index') }}" ><span class="material-symbols-outlined">photo_library</span>Editor</a>
          <a href="#" ><span class="material-symbols-outlined">shopping_cart</span>Compras</a>
          <a href="{{asset('admin/productos')}}"><span class="material-symbols-outlined">barcode_scanner</span>Inventario</a>
          
          <a  href="#"><span class="material-symbols-outlined">confirmation_number</span>Cupones</a>
          <a href="{{asset('admin/usuarios')}}"><span class="material-symbols-outlined">contacts_product</span>Usuarios</a>

          <a href="#"><span class="material-symbols-outlined">settings</span>Configuración</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
          <button type="submit" class="logout-btn" style="color:white; cursor:pointer;   position: absolute; right: 25%;  background: none;  border: 1px solid white; padding: 10px;  width: 50%; border-radius: 10px; bottom: 35px;">
              Logout
          </button>
        </form>
        <div class="sb-foot">© {{ date('Y') }} {{env('DEVELOPER_NAME')}}</div>
      </div>
    </aside>
    <div class="sidebar-backdrop" id="sidebar-backdrop"></div>

    <!-- MAIN -->
    <main class="main">
      <!-- TOPBAR -->
      <div class="topbar" style="background:none;box-shadow:none;border:none;margin-top:8px;position:relative">
        <div class="left">
          <button class="burger" id="burger" aria-label="Abrir menú">☰</button>
        </div>
        <div class="venti" style="    background: white; border-radius: 15px; padding: 10px; height: 56px; width: 200px;">
          <div class="top-ttl">Ventas</div>
          <div class="subhead">19 ventas encontradas</div>
        </div>
        <div class="user" style="padding: 10px; background: #ffebb0; border-radius: 15px; color: white;">
          <div class="avatar" title="{{ Auth::user()->name ?? 'Admin' }}" style="background:none;color:#656565">
            {{ strtoupper(mb_substr(Auth::user()->name ?? 'A',0,1)) }}
          </div>
          <div style="display:flex;flex-direction:column;line-height:1">
            <strong>Admin</strong>
            <span class="sub" style="color:#656565">{{ Auth::user()->email ?? '' }}</span>
          </div>
        </div>
      </div>

      <div class="topbar" style="margin: 20px; top: 20px; border-radius: 15px; margin-top: 0px; background: rgba(256, 256, 256, .5); backdrop-filter: blur(3px);">
        
        <div style="display:flex;align-items:center;gap:10px; flex-wrap:wrap;flex-direction:row;width:100%">
          <form method="get" action="{{ route('admin.ventas.index') }}" style="display:flex;align-items:center;gap:10px; flex-wrap:wrap; width:100%; ">
            <div class="search-wrap" style="flex:1 1 260px">
              <input class="search" type="text" name="q" placeholder="Buscar ventas..." value="{{ $q ?? '' }}">
              <span class="search-ico">⌕</span>
            </div>
            <input class="chip" type="date" name="from" value="{{ $from ?? '' }}">
            <input class="chip" type="date" name="to" value="{{ $to ?? '' }}">
            <button class="btn btn-ghost" type="submit"><span class="material-symbols-outlined">output</span></button>
            <a class="btn btn-ghost" href="{{ route('admin.ventas.index') }}"><span class="material-symbols-outlined">cleaning_services</span></a>
            <div style="display:flex; gap:10px; justify-content:flex-end;flex-direction:row">
                <button class="btn btn-ghost" onclick="window.print()"><span class="material-symbols-outlined">download</span></button>
                <button type="button" class="btn btn-primary" id="btnOpenCreate" style="display:flex;align-items:center;background:#ffebb0;color:#363636">Crear venta</button>

            </div>
          </form>
          
        </div>
      </div>

      <!-- GRID -->
      <div class="wrap">
        <!-- LISTA -->
        <section class="panel">
          <div class="thead">
            <div></div>
            <div>Código</div>
            <div>Prioridad</div>
            <div>Items</div>
            <div>Destino</div>
            <div>Estado</div>
            <div></div>
          </div>

          <div class="rows" id="rows">
            @foreach($ventas as $v)
            @php
              // Entregado si viene de shipments o si la propia venta está marcada
              $isDelivered = ($v->delivered_count ?? 0) > 0
                            || ($v->fulfillment_status ?? null) === 'delivered'
                            || !empty($v->delivered_at);

              // Con envío si NO está entregado y tiene al menos un shipment
              $isShipped = !$isDelivered && (($v->shipments_count ?? 0) > 0);
            @endphp
            <div
              class="row venta-row {{ $isDelivered ? 'delivered' : ($isShipped ? 'shipped' : '') }}"
              data-id="{{ $v->idventa }}"
              data-code="{{ $v->codigo }}"
              data-prioridad="{{ $v->tipo ?? 'manual' }}"
              data-items="{{ $v->detalle_count ?? 0 }}"
              data-destino="{{ trim(($v->distrito ?? '').' '.($v->provincia ?? ''), ' ,') }}"
              data-shipped="{{ $isShipped ? '1' : '0' }}"
              data-delivered="{{ $isDelivered ? '1' : '0' }}"
            >
              <div class="dot"></div>
              <div class="code">{{ $v->codigo }}</div>
              <div><span class="priority">{{ $v->tipo ?? 'manual' }}</span></div>
              <div class="count">{{ $v->detalle_count ?? 0 }}</div>
              <div class="dest">{{ $v->distrito ?? $v->email ?? '—' }}</div>
              <div>
                @php
                  $st = ($v->detalle_count ?? 0) > 0 ? 'st-paid' : 'st-vacia';
                  $txt = ($v->detalle_count ?? 0) > 0 ? 'Pagado' : 'Vacía';
                @endphp
                <span class="status {{ $st }}">{{ $txt }}</span>
              </div>
              <div class="actions">
                <button class="btn-3dots" aria-haspopup="menu" aria-expanded="false">
                  <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
                  </svg>
                </button>
                <div class="menu" role="menu">
                  <button data-action="ver" data-id="{{ $v->idventa }}">
                    <svg class="eye" viewBox="0 0 24 24" fill="none" stroke="#334155" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    Ver
                  </button>
                  <button data-action="editar" data-id="{{ $v->idventa }}">
                    <span class="material-symbols-outlined">edit</span> Editar
                  </button>
                  <button data-action="mail" data-id="{{ $v->idventa }}">
                    <span class="material-symbols-outlined">mail</span> Enviar correo
                  </button>
                </div>
              </div>
            </div>
            @endforeach
          </div>

          <div class="pager">
            <div class="pager-info">Mostrando página {{ $ventas->currentPage() }} de {{ $ventas->lastPage() }}</div>
            {{ $ventas->onEachSide(1)->links('vendor.pagination.adler') }}
          </div>
        </section>

        <!-- ASIDE -->
        <aside class="aside" style="padding-top:40px">
          <div class="card">
            <h4>Items</h4>
            <div id="listItems" style="display:grid;gap:10px">
              <div class="dim">Selecciona una venta de la lista…</div>
            </div>
          </div>

          <div class="card">
            <h4>Resumen</h4>
            <div class="kv">
              <div class="kv-row"><div class="key">Código</div><div id="kvCode">—</div></div>
              <div class="kv-row"><div class="key">Prioridad</div><div id="kvPriority">—</div></div>
              <div class="kv-row"><div class="key">Cantidad</div><div id="kvCount">—</div></div>
              <div class="kv-row"><div class="key">Destino</div><div id="kvDestino">—</div></div>
            </div>
          </div>

          <div class="card">
            <h4>Caja recomendada</h4>
            <div class="box">
              <div class="box-ico"></div>
              <div style="flex:1">
                <div style="font-weight:800">Caja Grande</div>
                <div class="dim">Dimensión 16m x 11m</div>
              </div>
            </div>
            <button class="btn-use" type="button">Usar esta caja</button>
          </div>
        </aside>
      </div>
    </main>
  </div>

  <!-- MODAL -->
  <div id="modal-backdrop" class="backdrop">
    <div class="modal">
      <div class="modal-hd">
        <h3 id="m-title" style="margin:0;font-weight:800">Venta</h3>
        <button class="btn btn-ghost" onclick="closeModal()">Cerrar</button>
      </div>
      <div class="modal-bd">
        <div id="m-content"></div>
        <hr style="margin:18px 0;border:none;border-top:1px solid var(--border)">
        <div class="grid-2">
          <div>
            <label class="dim">Enviar a email</label>
            <input id="m-email" type="email" class="input" placeholder="cliente@correo.com">
          </div>
          <div style="display:flex;align-items:flex-end;gap:8px">
            <button class="btn btn-primary" onclick="sendEmail()">Enviar comprobante</button>
          </div>
        </div>
        <div id="m-flash" class="flash-ok">Correo enviado.</div>
      </div>
    </div>
  </div>
  <!-- MODAL EDIT -->
<div id="modal-edit-backdrop" class="backdrop">
  <div class="modal">
    <div class="modal-hd">
      <h3 id="me-title" style="margin:0;font-weight:800">Editar venta</h3>
      <button class="btn btn-ghost" onclick="closeEditModal()">Cerrar</button>
    </div>
    <div class="modal-bd">
      <div class="grid-2">
        <div>
          <label class="dim">Estado de pago</label>
          <select id="me-payment" class="input" style="appearance:auto">
            <option value="">(sin cambio)</option>
            <option value="paid">Pagado</option>
            <option value="unpaid">No pagado</option>
            <option value="refunded">Reembolsado</option>
          </select>
        </div>
        <div>
          <label class="dim">Método de cumplimiento</label>
          <select id="me-method" class="input" style="appearance:auto">
            <option value="">(sin cambio)</option>
            <option value="delivery">Delivery</option>
            <option value="pickup">Recojo</option>
          </select>
        </div>
      </div>

      <div class="grid-2" style="margin-top:12px">
        <div>
          <label class="dim">Transición logística</label>
          <select id="me-transition" class="input" style="appearance:auto">
            <option value="">(no cambiar)</option>
            <option value="ready_to_ship">Listo para envío</option>
            <option value="ready_for_pickup">Listo para recojo</option>
            <option value="cancelled">Cancelado</option>
          </select>
        </div>
        <div style="display:flex;align-items:flex-end;gap:8px">
          <button class="btn btn-primary" onclick="saveEdit()">Guardar</button>
        </div>
      </div>

      <div id="me-flash" class="flash-ok">Guardado.</div>
    </div>
  </div>
</div>
<!-- MODAL CREAR VENTA -->
<div id="cv-backdrop" class="backdrop">
  <div class="modal" style="max-width:980px">
    <div class="modal-hd">
      <h3 style="margin:0;font-weight:800">Crear venta</h3>
      <button class="btn btn-ghost" onclick="CV_close()">Cerrar</button>
    </div>
    <div class="modal-bd">
      <form id="cv-form" method="post" action="{{ route('admin.ventas.store') }}" onsubmit="return CV_prepareItems()">
        @csrf
        <input type="hidden" name="items" id="cv-items-json">
        <input type="hidden" name="persona_id" id="cv-persona-id">

        <!-- PASO 1: Cliente -->
        <section id="cv-step-client">
          <div class="card" style="margin-bottom:14px">
            <div class="card-hd"><div style="font-weight:800">Tipo de cumplimiento</div></div>
            <div class="card-bd">
              <label style="display:inline-flex;align-items:center;gap:8px;margin-right:12px">
                <input type="radio" name="fulfillment_method" value="pickup" checked onclick="CV_toggleDelivery()"> Recojo
              </label>
              <label style="display:inline-flex;align-items:center;gap:8px">
                <input type="radio" name="fulfillment_method" value="delivery" onclick="CV_toggleDelivery()"> Envío
              </label>
            </div>
          </div>
        
          <div class="card" style="margin-bottom:14px">
  <div class="card-hd"><div style="font-weight:800">Cliente</div></div>
  <div class="card-bd">
    <!-- Buscador en tiempo real -->
    <div class="grid-2">
      <div class="field dd-wrap">
        <label>Buscar cliente (DNI o correo)</label>
        <input class="input" id="cv-user-q" placeholder="Escribe al menos 2 caracteres">
        <div id="cv-user-dd" class="dd-list"></div>
        <small class="dim">Selecciona un cliente de la lista. Si no existe, podrás crearlo abajo.</small>
      </div>

      <!-- Email seleccionado, bloqueado si el usuario existe -->
      <div class="field">
        <label>Email</label>
        <div style="display:flex;gap:8px">
          <input class="input" name="email" id="cv-email" placeholder="cliente@correo.com">
          <button type="button" id="cv-user-edit" class="btn btn-ghost" style="display:none">Modificar</button>
        </div>
        <input type="hidden" name="persona_id" id="cv-persona-id">
      </div>
    </div>

    <!-- Si no hay resultados: mini-form para nuevo usuario -->
    <div id="cv-newuser-wrap" style="display:none; margin-top:12px">
      <div class="grid-2">
        <div class="field"><label>Nombre</label><input class="input" id="cv-nu-name" placeholder="Nombre"></div>
        <div class="field"><label>Apellido</label><input class="input" id="cv-nu-lastname" placeholder="Apellido"></div>
      </div>
      <div class="grid-2" style="margin-top:12px">
        <div class="field"><label>Email</label><input class="input" id="cv-nu-email" placeholder="cliente@correo.com"></div>
        <div class="field" style="display:flex;align-items:flex-end">
          <button type="button" class="btn btn-primary" id="cv-nu-use">Usar estos datos</button>
        </div>
      </div>
      <div id="cv-nu-ok" class="badge-green" style="display:none">Usuario se guardará al finalizar la venta.</div>
    </div>

    <!-- Cargo envío -->
    <div class="grid-2" style="margin-top:14px">
      <div class="field">
        <label>Cargo envío (S/)</label>
        <input class="input" name="cargo_envio" id="cv-envio" type="number" step="0.01" value="0">
      </div>
      <div class="field">
        <label>Tipo</label>
        <input class="input" name="tipo" value="manual">
      </div>
    </div>

    <!-- Campos de entrega (solo envío) -->
    <div id="cv-delivery-fields" style="margin-top:12px">
      <div class="grid-2">
        <div class="field"><label>Nombre</label><input class="input" name="nombre" id="cv-nombre"></div>
        <div class="field"><label>Apellido</label><input class="input" name="apellido" id="cv-apellido"></div>
      </div>
      <div class="grid-2" style="margin-top:12px">
        <div class="field"><label>Celular</label><input class="input" name="celular" id="cv-cel"></div>
        <div class="field"><label>DNI</label><input class="input" name="dni" id="cv-dni"></div>
      </div>
      <div class="field" style="margin-top:12px"><label>Domicilio</label><input class="input" name="domicilio" id="cv-dom"></div>
      <div class="grid-2" style="margin-top:12px">
        <div class="field"><label>Distrito</label><input class="input" name="distrito" id="cv-dis"></div>
        <div class="field"><label>Provincia</label><input class="input" name="provincia" id="cv-pro"></div>
      </div>
      <div class="field" style="margin-top:12px"><label>Departamento</label><input class="input" name="departamento" id="cv-dep"></div>
      <div class="field" style="margin-top:12px"><label>Referencia</label><input class="input" name="referencia" id="cv-ref"></div>
    </div>

    <div style="display:flex;justify-content:flex-end;margin-top:14px">
      <button class="btn btn-primary" type="button" onclick="CV_next()">Siguiente</button>
    </div>
  </div>
</div>


          <!-- Mini resumen cliente para el paso 2 -->
          <div id="cv-mini" class="mini" style="display:none;margin-bottom:14px">
            <h5 style="display:flex;justify-content:space-between;align-items:center">
              <span>Cliente</span><span style="font-weight:700;font-size:12px;color:#ff4242">Editar</span>
            </h5>
            <div id="cv-mini-nombre" class="line" style="font-weight:700">—</div>
            <div id="cv-mini-contacto" class="line">—</div>
            <div id="cv-mini-destino" class="line">—</div>
          </div>
        </section>

        <!-- PASO 2: Items -->
        <section id="cv-step-items" style="display:none">
          <div class="card">
            <div class="card-hd"><div style="font-weight:800">Items</div></div>
            <div class="card-bd">
              <div class="builder" style="grid-template-columns:1.6fr .6fr .6fr 150px">
                <div class="field dd-wrap" style="grid-column:1 / -1">
                  <input id="cv-item-q" class="input" placeholder="Buscar producto por nombre...">
                  <div id="cv-item-dd" class="dd-list"></div>
                  <small class="dim">Escribe para filtrar. Selecciona un producto para agregarlo con precio y cantidad por defecto.</small>
                </div>

                <!-- Estos inputs quedan para edición rápida del último seleccionado, pero ya NO agregan directamente -->
                <input id="cv-bCant" class="input" type="number" min="1" value="1" placeholder="Cant." readonly>
                <input id="cv-bPrec" class="input" type="number" step="0.01" min="0" placeholder="Precio" readonly>
                <button class="add" type="button" onclick="alert('Primero selecciona un producto del buscador');">Agregar ítem</button>
              </div>

              <div class="table-wrap">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width:56px">#</th>
                      <th>Artículo</th>
                      <th style="text-align:right;width:110px">Cant.</th>
                      <th style="text-align:right;width:140px">Precio</th>
                      <th style="text-align:right;width:140px">Subtotal</th>
                      <th style="width:70px"></th>
                    </tr>
                  </thead>
                  <tbody id="cv-items-body"></tbody>
                  <tfoot>
                    <tr><td colspan="4" style="text-align:right">Subtotal</td><td id="cv-tSub" style="text-align:right">0.00</td><td></td></tr>
                    <tr><td colspan="4" style="text-align:right">Cargo envío</td><td id="cv-tEnv" style="text-align:right">0.00</td><td></td></tr>
                    <tr><td colspan="4" style="text-align:right">Total</td><td id="cv-tTot" style="text-align:right">0.00</td><td></td></tr>
                  </tfoot>
                </table>
              </div>
              <div class="card-ft" style="padding:0;margin-top:12px;display:flex;gap:8px;justify-content:flex-end">
                <button class="btn btn-ghost" type="button" onclick="CV_back()">Volver</button>
                <button class="btn btn-primary" type="submit">Guardar venta</button>
              </div>
            </div>
          </div>
        </section>

      </form>
    </div>
  </div>
</div>
<!-- MODAL ENVIAR CORREO MANUAL -->
<div id="mail-backdrop" class="backdrop">
  <div class="modal" style="max-width:420px">
    <div class="modal-hd">
      <h3 style="margin:0;font-weight:800">Enviar correo</h3>
      <button class="btn btn-ghost" onclick="closeMailModal()">Cerrar</button>
    </div>
    <div class="modal-bd">
      <label class="dim" for="mail-email">Digite un correo</label>
      <input id="mail-email" type="email" class="input" placeholder="cliente@correo.com">
      <div style="margin-top:14px;display:flex;justify-content:flex-end;gap:8px">
        <button class="btn btn-primary" onclick="sendMailManual()">Enviar</button>
      </div>
    </div>
  </div>
</div>
<div id="toast-mail" style="
  position:fixed;
  top:16px;
  right:16px;
  background:#dcfce7;
  color:#166534;
  border:1px solid #bbf7d0;
  border-radius:14px;
  padding:10px 14px 10px 44px;
  font-weight:600;
  box-shadow:0 10px 30px rgba(15,23,42,.12);
  display:none;
  z-index:9999;
  min-width:240px;
">
  <span style="
    position:absolute;
    left:12px;
    top:50%;
    transform:translateY(-50%);
    width:22px;
    height:22px;
    border-radius:999px;
    background:#166534;
    display:grid;
    place-items:center;
    color:white;
    font-size:14px;
  ">✓</span>
  <span id="toast-mail-txt">correo enviado con éxito</span>
</div>

  <script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let currentVentaId = null;
    let editingVentaId = null;
    let mailVentaId = null;
    // Sidebar off-canvas
    const burger = document.getElementById('burger');
    const sidebar = document.getElementById('sidebar');
    const sbBackdrop = document.getElementById('sidebar-backdrop');
    if(burger){
      burger.addEventListener('click', ()=>{
        sidebar.classList.add('is-open');
        sbBackdrop.classList.add('is-open');
      });
    }
    if(sbBackdrop){
      sbBackdrop.addEventListener('click', ()=>{
        sidebar.classList.remove('is-open');
        sbBackdrop.classList.remove('is-open');
      });
    }
    function applyRowState(row){
  // Limpia clases de estado antes de aplicar
        row.classList.remove('shipped','delivered');

        const isDelivered = row.dataset.delivered === '1';
        const isShipped   = row.dataset.shipped === '1';

        if (isDelivered) row.classList.add('delivered');
        else if (isShipped) row.classList.add('shipped');
      }

      // Al cargar, sincroniza todas
      window.addEventListener('DOMContentLoaded', ()=>{
        document.querySelectorAll('.venta-row').forEach(applyRowState);
      });
    // Selección de fila -> carga panel derecho
    function selectVenta(id, rowEl){
      fetch(`{{ url('admin/ventas') }}/${id}`, { headers: {'Accept': 'application/json'} })
        .then(r => r.json())
        .then(({venta, shipments_count, delivered}) => {
          fillAside(venta);

          if(rowEl){
            document.querySelectorAll('.venta-row').forEach(x=>x.classList.remove('is-active'));
            rowEl.classList.add('is-active');

            // refresca flags desde backend
            rowEl.dataset.delivered = delivered ? '1' : '0';
            rowEl.dataset.shipped   = (!delivered && Number(shipments_count) > 0) ? '1' : '0';
            applyRowState(rowEl);   // vuelve a aplicar clases .shipped / .delivered
          }
        })
        .catch(()=> console.warn('No se pudo cargar la venta para el panel.'));
    }
    document.addEventListener('visibilitychange', () => {
  if (document.visibilityState === 'visible') {
    const active = document.querySelector('.venta-row.is-active');
    if (active) selectVenta(active.dataset.id, active);
  }
});

// Extra de cortesía por si el navegador no dispara visibilitychange:
window.addEventListener('focus', () => {
  const active = document.querySelector('.venta-row.is-active');
  if (active) selectVenta(active.dataset.id, active);
});

    function fillAside(venta){
      const itemsWrap = document.getElementById('listItems');
      itemsWrap.innerHTML = '';
      const det = Array.isArray(venta.detalle) ? venta.detalle : [];

      if(det.length === 0){
        itemsWrap.innerHTML = '<div class="dim">Sin items.</div>';
      }else{
        det.forEach(d=>{
          const el = document.createElement('div');
          el.className = 'item-card';
          el.innerHTML = `
            <div class="thumb"><img src="{{ asset('image/productos') }}/${d.articulo?.image}" alt=""></div>
            <div style="flex:1">
              <div class="item-title">${d.articulo?.name ?? ('ID ' + d.idarticulo)}</div>
              <div class="dim">Cant: ${d.qty ?? d.cantidad ?? 1} · S/ ${(Number(d.precio)||0).toFixed(2)}</div>
            </div>
            <div class="dim">S/ ${(Number(d.subtotal)||0).toFixed(2)}</div>`;
          itemsWrap.appendChild(el);
        });
      }

      document.getElementById('kvCode').textContent = venta.codigo || '—';
      document.getElementById('kvPriority').textContent = venta.tipo || 'manual';
      document.getElementById('kvCount').textContent = det.length;
      const destino = [venta.distrito, venta.provincia, venta.departamento].filter(Boolean).join(', ');
      document.getElementById('kvDestino').textContent = destino || (venta.email ?? '—');
    }

    // Menús de tres puntitos + evento de filas
    document.querySelectorAll('.venta-row').forEach(row=>{
      row.addEventListener('click', (e)=>{
        if(e.target.closest('.actions')) return;
        selectVenta(row.dataset.id, row);
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
        openDetalle(verBtn.dataset.id);
        menu.style.display='none';
      });
      const editBtn = row.querySelector('[data-action="editar"]');

      const mailBtn = row.querySelector('[data-action="mail"]');
      if (mailBtn) {
        mailBtn.addEventListener('click', ev => {
        ev.preventDefault();
          ev.stopPropagation();
          openMailModal(mailBtn.dataset.id);
          menu.style.display='none';
        });
      }
      if (editBtn) {
        editBtn.addEventListener('click', ev=>{
          ev.stopPropagation();
          openEditModal(editBtn.dataset.id);
          menu.style.display='none';
        });
      }

    });
    function openMailModal(id){
      mailVentaId = id;
      document.getElementById('mail-email').value = '';
      document.getElementById('mail-backdrop').style.display = 'flex';
    }

    function closeMailModal(){
      document.getElementById('mail-backdrop').style.display = 'none';
    }

    function showMailToast(msg = 'Correo enviado con éxito'){
      const t = document.getElementById('toast-mail');
      const txt = document.getElementById('toast-mail-txt');
      txt.textContent = msg;
      t.style.display = 'block';
      setTimeout(()=> t.style.display = 'none', 3800);
    }

    function sendMailManual(){
      const email = document.getElementById('mail-email').value.trim();
      if (!email){
        alert('Digite un correo');
        return;
      }
      fetch(`{{ url('admin/ventas') }}/${mailVentaId}/email`, {
        method: 'POST',
        headers: {
          'Content-Type':'application/json',
          'X-CSRF-TOKEN': CSRF
        },
        body: JSON.stringify({ to: email })
      })
      .then(r => r.ok ? r.json() : Promise.reject())
      .then(() => {
        closeMailModal();
        showMailToast('Correo enviado con éxito');
      })
      .catch(() => {
        showMailToast('No se pudo enviar el correo');
      });
    }

    // Modal
    function openDetalle(id) {
      currentVentaId = id;
      fetch(`{{ url('admin/ventas') }}/${id}`, { headers: {'Accept': 'application/json'} })
        .then(r => r.json())
        .then(({venta, shipments_count, delivered}) => {
          fillAside(venta);
          const rowEl = document.querySelector(`.venta-row[data-id="${id}"]`);
          if (rowEl){
            rowEl.dataset.delivered = delivered ? '1' : '0';
            rowEl.dataset.shipped   = (!delivered && Number(shipments_count) > 0) ? '1' : '0';
            applyRowState(rowEl);
          }
          const items = (venta.detalle || []).map(d => `
            <tr>
              <td>${d.idsub}</td>
              <td>${d.articulo?.name ?? ('ID '+d.idarticulo)}</td>
              <td style="text-align:right">${d.qty ?? d.cantidad ?? 1}</td>
              <td style="text-align:right">${Number(d.precio).toFixed(2)}</td>
              <td style="text-align:right">${Number(d.subtotal).toFixed(2)}</td>
            </tr>
          `).join('');

          const html = `
            <div class="grid-2">
              <div>
                <div class="item-title" style="margin-bottom:8px">Datos de venta</div>
                <p><span style="display:inline-block;background:#eef2ff;color:#3730a3;padding:2px 8px;border-radius:9999px;font-size:12px">${venta.codigo}</span></p>
                <p><strong>Fecha:</strong> ${(venta.fecha_hora ?? '').replace('T',' ').substring(0,16)}</p>
                <p><strong>Total:</strong> S/ ${Number(venta.total_venta).toFixed(2)}</p>
                <p><strong>Envío:</strong> S/ ${Number(venta.cargo_envio ?? 0).toFixed(2)}</p>
              </div>
              <div>
                <div class="item-title" style="margin-bottom:8px">Cliente</div>
                <p>${venta.nombre ?? ''} ${venta.apellido ?? ''}</p>
                <p>${venta.email ?? ''}</p>
                <p>${venta.domicilio ?? ''}</p>
                <p>${venta.distrito ?? ''}, ${venta.provincia ?? ''}, ${venta.departamento ?? ''}</p>
                <p>DNI: ${venta.dni ?? ''}</p>
              </div>
            </div>

            <div class="item-title" style="margin:14px 0 6px">Detalle</div>
            <table class="table">
              <thead>
                <tr>
                  <th>#</th><th>Producto</th>
                  <th style="text-align:right">Cant.</th>
                  <th style="text-align:right">Precio</th>
                  <th style="text-align:right">Subtotal</th>
                </tr>
              </thead>
              <tbody>${items}</tbody>
              <tfoot>
                <tr><td colspan="4" style="text-align:right"><strong>Subtotal</strong></td>
                    <td style="text-align:right">${Number(venta.subtotal).toFixed(2)}</td></tr>
                <tr><td colspan="4" style="text-align:right"><strong>Cargo envío</strong></td>
                    <td style="text-align:right">${Number(venta.cargo_envio ?? 0).toFixed(2)}</td></tr>
                <tr><td colspan="4" style="text-align:right"><strong>Total</strong></td>
                    <td style="text-align:right">${Number(venta.total_venta).toFixed(2)}</td></tr>
              </tfoot>
            </table>
          `;
          document.getElementById('m-title').innerText = 'Venta ' + venta.codigo;
          document.getElementById('m-content').innerHTML = html;
          document.getElementById('modal-backdrop').style.display = 'flex';
          
        })
        .catch(() => alert('No se pudo cargar la venta.'));
    }

    function closeModal(){
      document.getElementById('modal-backdrop').style.display = 'none';
      const f = document.getElementById('m-flash');
      const i = document.getElementById('m-email');
      if(f) f.style.display = 'none';
      if(i) i.value = '';
    }

    function sendEmail(){
      const to = document.getElementById('m-email').value.trim();
      if(!to){ alert('Ingresa un correo.'); return; }

      fetch(`{{ url('admin/ventas') }}/${currentVentaId}/email`, {
        method:'POST',
        headers:{ 'Content-Type':'application/json','X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ to })
      })
      .then(r => r.ok ? r.json() : Promise.reject())
      .then(() => {
        const f = document.getElementById('m-flash');
        f.innerText = 'Correo enviado.';
        f.style.display = 'block';
      })
      .catch(() => alert('No se pudo enviar el correo.'));
    }

    // Autoselección inicial
    window.addEventListener('DOMContentLoaded', ()=>{
      const first = document.querySelector('.venta-row');
      if(first){ selectVenta(first.dataset.id, first); }
    });
    function openEditModal(id){
  editingVentaId = id;
  // cargo venta actual para prellenar selects
  fetch(`{{ url('admin/ventas') }}/${id}`, { headers: {'Accept':'application/json'} })
    .then(r => r.json())
    .then(({venta})=>{
      document.getElementById('me-title').innerText = 'Editar ' + (venta.codigo || ('V#'+id));
      // set valores actuales si existen; si no, deja "(sin cambio)"
      const p = document.getElementById('me-payment');
      const m = document.getElementById('me-method');
      const t = document.getElementById('me-transition');
      p.value = venta.payment_status || '';
      m.value = venta.fulfillment_method || '';
      t.value = '';
      document.getElementById('me-flash').style.display = 'none';
      document.getElementById('modal-edit-backdrop').style.display = 'flex';
    })
    .catch(()=> alert('No se pudo cargar la venta.'));
}

function closeEditModal(){
  document.getElementById('modal-edit-backdrop').style.display = 'none';
}

function saveEdit(){
  const body = {
    payment_status: document.getElementById('me-payment').value || null,
    fulfillment_method: document.getElementById('me-method').value || null,
    transition: document.getElementById('me-transition').value || null,
  };

  fetch(`{{ url('admin/ventas') }}/${editingVentaId}/meta`, {
    method: 'PATCH',
    headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': CSRF },
    body: JSON.stringify(body)
  })
  .then(async r => {
    if (!r.ok) {
      const data = await r.json().catch(()=> ({}));
      const msg = data?.error || 'No se pudo guardar.';
      throw new Error(msg);
    }
    return r.json();
  })
  .then(({ok, venta, shipments_count, delivered})=>{
  const row = document.querySelector(`.venta-row[data-id="${venta.idventa}"]`);
  if (row) {
    // Actualiza texto existente (ya lo haces)
    const pr = row.querySelector('.priority');
    if (pr) pr.textContent = venta.tipo || 'manual';
    const d = [venta.distrito, venta.provincia].filter(Boolean).join(' ');
    const dest = row.querySelector('.dest');
    if (dest) dest.textContent = d || (venta.email ?? '—');

    // Actualiza flags visuales según respuesta
    row.dataset.shipped   = (Number(shipments_count) > 0 && !Boolean(delivered)) ? '1' : '0';
    row.dataset.delivered = Boolean(delivered) ? '1' : '0';

    applyRowState(row);
  }

  const flash = document.getElementById('me-flash');
  flash.innerText = 'Guardado' + (shipments_count > 0 ? ' · envío creado' : '') + (delivered ? ' · entregado' : '') + '.';
  flash.style.display = 'block';
})

  .catch(err=> alert(err.message));
}

  </script>
  <script>
  const CV_CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const CV_ARTS = @json($articulos ?? []);

  // Estado local
  const CV_items = [];
  function CV_fmt(n){ return Number(n||0).toFixed(2); }
  function CV_isDelivery(){ return document.querySelector('input[name="fulfillment_method"][value="delivery"]').checked; }

  // Abrir/cerrar
  document.getElementById('btnOpenCreate')?.addEventListener('click', ()=>{
    document.getElementById('cv-backdrop').style.display='flex';
    CV_reset();
  });
  function CV_close(){ document.getElementById('cv-backdrop').style.display='none'; }

  // Mostrar/ocultar campos delivery
  function CV_toggleDelivery(){
    const box = document.getElementById('cv-delivery-fields');
    const envio = document.getElementById('cv-envio');
    if(CV_isDelivery()){
      box.style.display = '';
      envio.removeAttribute('readonly');
    } else {
      box.style.display = 'none';
      envio.value = '0';
      envio.setAttribute('readonly','readonly');
    }
    CV_recalc();
  }

  // Lookup por email

// ========== Utils ==========
const CV_DEBOUNCE = (fn, ms=220) => {
  let t; return (...args)=>{ clearTimeout(t); t=setTimeout(()=>fn(...args), ms); };
};
function CV_htmlEscape(s){ return (s||'').replace(/[&<>"']/g, m=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[m])); }

// ========== Fulfillment toggle ==========
function CV_toggleDelivery(){
  const box = document.getElementById('cv-delivery-fields');
  const envio = document.getElementById('cv-envio');
  const isDelivery = CV_isDelivery();
  box.style.display = isDelivery ? '' : 'none';
  if(!isDelivery){ envio.value = '0'; envio.setAttribute('readonly','readonly'); }
  else { envio.removeAttribute('readonly'); }
  CV_recalc();
}

// ========== AUTOCOMPLETE PERSONA ==========
const userQ = document.getElementById('cv-user-q');
const userDD = document.getElementById('cv-user-dd');
const userEditBtn = document.getElementById('cv-user-edit');

userQ.addEventListener('input', CV_DEBOUNCE(async ()=>{
  const q = userQ.value.trim();
  document.getElementById('cv-nu-ok').style.display='none';
  if(q.length < 2){ userDD.style.display='none'; document.getElementById('cv-newuser-wrap').style.display='none'; return; }

  // buscar
  const url = new URL('{{ route('admin.personas.search') }}', window.location.origin);
  url.searchParams.set('q', q);
  let list = [];
  try{
    const r = await fetch(url, {headers:{'Accept':'application/json'}});
    list = await r.json();
  }catch{}

  if(Array.isArray(list) && list.length){
    userDD.innerHTML = list.map(p=>{
      const name = [p.name, p.lastname].filter(Boolean).join(' ') || '(Sin nombre)';
      return `<div class="dd-item" data-id="${p.id}" data-email="${CV_htmlEscape(p.email||'')}"
                data-name="${CV_htmlEscape(p.name||'')}" data-lastname="${CV_htmlEscape(p.lastname||'')}"
                data-cell="${CV_htmlEscape(p.cell||'')}" data-dni="${CV_htmlEscape(p.dni||'')}"
                data-direccion="${CV_htmlEscape(p.direccion||'')}" data-distrito="${CV_htmlEscape(p.distrito||'')}"
                data-provincia="${CV_htmlEscape(p.provincia||'')}">
                <span style="font-weight:700">${CV_htmlEscape(name)}</span>
                <span class="dim" style="margin-left:auto">${CV_htmlEscape(p.email||'')}</span>
                <span class="dim">${CV_htmlEscape(p.dni||'')}</span>
              </div>`;
    }).join('');
    userDD.style.display='block';
    document.getElementById('cv-newuser-wrap').style.display='none';
  } else {
    // cero resultados: muestra form para nuevo usuario
    userDD.style.display='none';
    document.getElementById('cv-newuser-wrap').style.display='block';
    document.getElementById('cv-nu-email').value = q.includes('@') ? q : '';
  }
}, 220));

userDD.addEventListener('click', ev=>{
  const it = ev.target.closest('.dd-item'); if(!it) return;
  CV_pickPersona({
    id: it.dataset.id,
    email: it.dataset.email || '',
    name: it.dataset.name || '',
    lastname: it.dataset.lastname || '',
    cell: it.dataset.cell || '',
    dni: it.dataset.dni || '',
    direccion: it.dataset.direccion || '',
    distrito: it.dataset.distrito || '',
    provincia: it.dataset.provincia || ''
  });
  userDD.style.display='none';
});

function CV_pickPersona(p){
  // set persona seleccionada
  document.getElementById('cv-persona-id').value = p.id;
  document.getElementById('cv-email').value = p.email;
  document.getElementById('cv-email').setAttribute('readonly','readonly');
  userEditBtn.style.display='inline-block';
  userQ.value = [p.name, p.lastname].filter(Boolean).join(' ');
  userQ.classList.add('lock');

  // prellenar envío si corresponde
  document.getElementById('cv-nombre').value = p.name || '';
  document.getElementById('cv-apellido').value = p.lastname || '';
  document.getElementById('cv-cel').value = p.cell || '';
  document.getElementById('cv-dni').value = p.dni || '';
  document.getElementById('cv-dom').value = p.direccion || '';
  document.getElementById('cv-dis').value = p.distrito || '';
  document.getElementById('cv-pro').value = p.provincia || '';
  // departamento según tu esquema si aplica

  document.getElementById('cv-newuser-wrap').style.display='none';
  document.getElementById('cv-nu-ok').style.display='none';
}

userEditBtn.addEventListener('click', ()=>{
  // desbloquear búsqueda
  document.getElementById('cv-persona-id').value = '';
  document.getElementById('cv-email').removeAttribute('readonly');
  userEditBtn.style.display='none';
  userQ.classList.remove('lock');
  userQ.focus();
});

// “Usar estos datos” en nuevo usuario (no crea aún; solo setea valores para el store)
document.getElementById('cv-nu-use').addEventListener('click', ()=>{
  const n = document.getElementById('cv-nu-name').value.trim();
  const l = document.getElementById('cv-nu-lastname').value.trim();
  const e = document.getElementById('cv-nu-email').value.trim();
  if(!e){ alert('Email es obligatorio'); return; }

  document.getElementById('cv-persona-id').value = ''; // no existe
  document.getElementById('cv-email').value = e;
  document.getElementById('cv-nombre').value = document.getElementById('cv-nombre').value || n;
  document.getElementById('cv-apellido').value = document.getElementById('cv-apellido').value || l;

  document.getElementById('cv-nu-ok').style.display='block';
});

// ========== AUTOCOMPLETE ITEMS ==========
const itemQ = document.getElementById('cv-item-q');
const itemDD = document.getElementById('cv-item-dd');

itemQ.addEventListener('input', CV_DEBOUNCE(()=>{
  const q = itemQ.value.trim().toLowerCase();
  if(q.length < 1){ itemDD.style.display='none'; return; }
  const list = (CV_ARTS || []).filter(a => (a.name||'').toLowerCase().includes(q)).slice(0,15);
  if(list.length){
    itemDD.innerHTML = list.map(a=>{
      const price = a.price ?? a.precio ?? 0;
      return `<div class="dd-item" data-id="${a.id}" data-price="${price}" data-name="${CV_htmlEscape(a.name||('ID '+a.id))}">
                <span style="font-weight:700">${CV_htmlEscape(a.name||('ID '+a.id))}</span>
                <span class="dim" style="margin-left:auto">S/ ${CV_fmt(price)}</span>
              </div>`;
    }).join('');
    itemDD.style.display='block';
  } else {
    itemDD.style.display='none';
  }
}, 180));

itemDD.addEventListener('click', ev=>{
  const it = ev.target.closest('.dd-item'); if(!it) return;
  const id = parseInt(it.dataset.id,10);
  const price = parseFloat(it.dataset.price||'0');
  const name = it.dataset.name;
  // agrega de inmediato con qty=1
  CV_items.push({ idarticulo:id, name, qty:1, precio:price });
  CV_renderItems();
  itemQ.value = '';
  itemDD.style.display='none';
});

// ========== Paso siguiente igual que antes ==========
function CV_next(){
  const email = document.getElementById('cv-email').value.trim();

  if(!CV_isDelivery()){
    if(!email){ alert('Para recojo, email es obligatorio.'); return; }
  } else {
    const req = ['cv-nombre','cv-dom','cv-cel','cv-dis','cv-pro','cv-dep','cv-dni'];
    for(const id of req){
      const el = document.getElementById(id);
      if(!el.value.trim()){ alert('Completa los datos de envío.'); el.focus(); return; }
    }
  }

  // Render mini (como ya tenías)
  const nombre = [document.getElementById('cv-nombre').value, document.getElementById('cv-apellido').value].filter(Boolean).join(' ').trim() || '—';
  const contacto = [email, document.getElementById('cv-cel').value].filter(Boolean).join(' · ') || '—';
  const dest = CV_isDelivery()
    ? [document.getElementById('cv-dis').value, document.getElementById('cv-pro').value, document.getElementById('cv-dep').value].filter(Boolean).join(', ') || document.getElementById('cv-dom').value || '—'
    : '(Recojo)';
  document.getElementById('cv-mini-nombre').textContent = nombre;
  document.getElementById('cv-mini-contacto').textContent = contacto;
  document.getElementById('cv-mini-destino').textContent = dest;

  document.getElementById('cv-mini').style.display = 'block';
  document.getElementById('cv-step-client').style.display = 'none';
  document.getElementById('cv-step-items').style.display = 'block';
  CV_recalc();
}


  function CV_back(){
    document.getElementById('cv-step-items').style.display = 'none';
    document.getElementById('cv-step-client').style.display = 'block';
  }

  // Builder
  function CV_fillSelect(){
    const sel = document.getElementById('cv-bProd');
    if(!sel.dataset.filled){
      sel.innerHTML = '<option value="">Selecciona artículo…</option>' +
        CV_ARTS.map(a=>{
          const price = a.price ?? a.precio ?? 0;
          const name = a.name ?? ('ID '+a.id);
          return `<option value="${a.id}" data-price="${price}">${name} (S/ ${CV_fmt(price)})</option>`;
        }).join('');
      sel.addEventListener('change', ()=>{
        const opt = sel.selectedOptions[0];
        if(opt && opt.dataset.price){ document.getElementById('cv-bPrec').value = Number(opt.dataset.price); }
      });
      sel.dataset.filled = '1';
    }
  }

  function CV_addItem(){
    const sel = document.getElementById('cv-bProd');
    const id = parseInt(sel.value || '0', 10);
    const cant = parseInt(document.getElementById('cv-bCant').value || '1', 10);
    const precio = parseFloat(document.getElementById('cv-bPrec').value || '0');
    if(!id){ alert('Selecciona un artículo.'); return; }
    if(cant < 1){ alert('Cantidad inválida.'); return; }
    if(precio < 0){ alert('Precio inválido.'); return; }

    const art = CV_ARTS.find(a => (a.id == id)) || {};
    const name = art.name ?? ('ID '+id);
    CV_items.push({ idarticulo:id, name, qty:cant, precio });
    sel.value=''; document.getElementById('cv-bCant').value=1; document.getElementById('cv-bPrec').value='';
    CV_renderItems();
  }
  function CV_removeItem(i){ CV_items.splice(i,1); CV_renderItems(); }

  function CV_onEdit(i, field, el){
    const val = field === 'qty' ? parseInt(el.value||'1',10) : parseFloat(el.value||'0');
    if(isNaN(val)) return;
    CV_items[i][field] = val;
    const st = CV_items[i].qty * CV_items[i].precio;
    el.closest('tr').querySelector('.cv-st').textContent = CV_fmt(st);
    CV_recalc();
  }

  function CV_renderItems(){
    const tbody = document.getElementById('cv-items-body');
    tbody.innerHTML = '';
    CV_items.forEach((it,i)=>{
      const st = it.qty * it.precio;
      tbody.insertAdjacentHTML('beforeend', `
        <tr>
          <td style="text-align:center">${i+1}</td>
          <td>${it.name}</td>
          <td style="text-align:right">
            <input type="number" min="1" value="${it.qty}" class="input" style="height:36px;width:90px"
                   oninput="CV_onEdit(${i}, 'qty', this)">
          </td>
          <td style="text-align:right">
            <input type="number" step="0.01" min="0" value="${CV_fmt(it.precio)}" class="input" style="height:36px;width:120px"
                   oninput="CV_onEdit(${i}, 'precio', this)">
          </td>
          <td class="cv-st" style="text-align:right">${CV_fmt(st)}</td>
          <td style="text-align:right"><button type="button" class="del" onclick="CV_removeItem(${i})">🗑️</button></td>
        </tr>
      `);
    });
    CV_recalc();
  }

  function CV_recalc(){
    const sub = CV_items.reduce((a,b)=> a + (Number(b.qty)*Number(b.precio)), 0);
    const env = Number(document.getElementById('cv-envio').value || 0);
    const tot = sub + (CV_isDelivery() ? env : 0);
    document.getElementById('cv-tSub').textContent = CV_fmt(sub);
    document.getElementById('cv-tEnv').textContent = CV_fmt(CV_isDelivery() ? env : 0);
    document.getElementById('cv-tTot').textContent = CV_fmt(tot);
  }

  function CV_prepareItems(){
    if(CV_items.length === 0){ alert('Agrega al menos un ítem.'); return false; }
    for(const it of CV_items){
      if(!it.idarticulo || it.qty < 1){ alert('Hay ítems inválidos.'); return false; }
    }
    document.getElementById('cv-items-json').value = JSON.stringify(CV_items.map(it=>({
      idarticulo: it.idarticulo, qty: Number(it.qty), precio: Number(it.precio)
    })));
    return true;
  }

  function CV_reset(){
    // limpia campos básicos, no me voy a poner místico
    document.getElementById('cv-form').reset();
    document.getElementById('cv-persona-id').value = '';
    document.getElementById('cv-mini').style.display = 'none';
    document.getElementById('cv-step-client').style.display = 'block';
    document.getElementById('cv-step-items').style.display = 'none';
    CV_items.splice(0, CV_items.length);
    document.getElementById('cv-items-body').innerHTML = '';
    CV_toggleDelivery();
    CV_recalc();
  }
</script>

</body>
</html>
