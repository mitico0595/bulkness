{{-- resources/views/admin/envios/index.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Envíos | Admin</title>
  @include ('global.icon')
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <style>
    :root{
      --bg:#f6f7fb; --panel:#ffffff; --muted:#7b8aa3; --text:#1f2937; --sub:#0f172a;
      --border:#e5e7eb; --shadow:0 10px 30px rgba(32,41,63,.08); --radius:14px; --r8:10px;
      --accent:#ff4242; --accent-2:#c21a1a; --good:#16a34a; --bad:#e11d48; --info:#2563eb;
    }
    input{outline:none}
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;background:var(--bg);color:var(--text)}
    a{color:inherit;text-decoration:none}

    /* Layout principal */
    .app{display:grid;grid-template-columns:260px 1fr;min-height:100vh}
    .wrap{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1fr 360px;gap:18px}

    /* Sidebar */
    .sidebar{color:#fff; padding:24px 16px}
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
    .btn-primary{background:linear-gradient(180deg,var(--accent),var(--accent-2));color:#fff}
    .btn-primary:hover{filter:brightness(.97)}
    /* Topbar fija */
    .topbar{
      position:sticky; top:0; z-index:30;
      background:#fff; border-bottom:1px solid var(--border);
      display:flex; align-items:center; justify-content:space-between;
      padding:12px 18px;
    }
    .left{display:flex;align-items:center;gap:10px}
    .burger{display:none}
    .page-title{font-weight:800}
    .sub{color:var(--muted);font-size:13px}
    .user{display:flex;align-items:center;gap:10px}
    .avatar{width:36px;height:36px;border-radius:10px;background:#ffd4d4;color:#b40909;display:grid;place-items:center;font-weight:800}

    .panel{padding:14px}
    .thead{display:grid;grid-template-columns:16px 160px 1fr 120px 1fr 140px 52px;gap:12px;padding:6px 6px 10px;color:var(--muted);font-size:12px;border-bottom:1px solid #eef2ff}
    .rows{display:flex;flex-direction:column;gap:12px}
    .row{cursor:pointer;background:white;border-radius:15px;display:grid;grid-template-columns:16px 160px 1fr 120px 1fr 140px 52px;align-items:center;gap:12px;padding:12px 8px;border-top:1px solid #f1f5f9}
    .row.is-active{background:#ffebb0;color:#fff}
    .dot{border-radius:999px;background:#9ca3af;}
    .code{font-weight:800}
    .dest{color:#334155}
    .status{justify-self:start;border-radius:999px;padding:6px 10px;font-size:12px;font-weight:700}
    .st-label{background:#fff7ed;color:#c2410c}
    .st-transit{background:#eef6ff;color:#2563eb}
    .st-out{background:#ecfeff;color:#155e75}
    .st-delivered{background:#ecfdf5;color:#065f46}
    .st-failed{background:#ffe4e6;color:#be123c}
    .st-returned{background:#f5f3ff;color:#6d28d9}
    .st-pending{background:#f3f4f6;color:#6b7280}
    .st-pickup{background:#e0f2fe;color:#0369a1}
    .actions{position:relative;justify-self:end}
    .btn-3dots{all:unset;cursor:pointer;border-radius:10px;padding:6px;display:grid;place-items:center}
    .btn-3dots:hover{background:#f3f4f6}
    .menu{position:absolute;right:0;top:36px;background:#fff;border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow);min-width:180px;padding:6px;display:none;z-index:5}
    .menu button{all:unset;display:flex;align-items:center;gap:8px;width:100%;padding:10px;border-radius:8px;cursor:pointer;color:#374151}
    .menu button:hover{background:#f3f4f6}

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
    .btn-use{display:block;width:100%;height:42px;border:none;border-radius:12px;background:linear-gradient(180deg,var(--accent),var(--accent-2));color:#fff;font-weight:800;cursor:pointer}

    .backdrop{position:fixed;inset:0;background:rgba(15,23,42,.45);display:none;align-items:center;justify-content:center;padding:20px;z-index:50}
    .modal{background:#fff;border-radius:16px;max-width:920px;width:100%;max-height:90vh;overflow:auto;border:1px solid var(--border);box-shadow:var(--shadow)}
    .modal-hd{position:sticky;backdrop-filter:blur(1px);background:rgba(265,256,256,.5);top:0; display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-bottom:1px solid var(--border)}
    .modal-bd{padding:16px}
    .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    .table{width:100%;border-collapse:collapse;background:#fff;border:1px solid var(--border);border-radius:12px;overflow:hidden}
    .table th,.table td{padding:10px;border-bottom:1px solid var(--border);font-size:14px}
    .input{width:100%;border:1px solid var(--border);border-radius:10px;padding:10px}
    .select{width:100%;border:1px solid var(--border);border-radius:10px;padding:10px;background:#fff}

    .pager{display:flex;align-items:center;justify-content:space-between;margin-top:14px;gap:10px}
    .pager-info{color:#7b8aa3;font-size:13px}
    .pager-list{list-style:none;display:flex;gap:6px;margin:0;padding:0}
    .pager-list a,.pager-list span{
      display:grid;place-items:center;min-width:38px;height:38px;padding:0 12px;
      border:1px solid #e5e7eb;border-radius:12px;background:#fff;color:#1f2937;text-decoration:none
    }
    .pager-list .active span{background:linear-gradient(180deg, #ff3f00, #f10101);color:#fff;border-color:transparent;font-weight:800}
    .pager-list .disabled span{opacity:.45;background:#f3f4f6;color:#6b7280}

    @media (max-width:1100px){ .app{grid-template-columns:1fr} .sidebar{display:none} .wrap{grid-template-columns:1fr} }
    @media (max-width:760px){
      .thead{display:none}
      .row{grid-template-columns:1fr;gap:8px;padding:12px;border:1px solid #eef2ff}
      .wrap{grid-template-columns:1fr;gap:12px;padding:0 12px}
      .aside{padding-top:0}
      .kv{grid-template-columns:1fr}
      .pager{flex-direction:column;align-items:flex-start}
      .pager-list{flex-wrap:wrap}
    }
    @media (min-width:1101px){
      .app{grid-template-columns:260px 1fr!important}
      .sidebar{display:block!important;position:sticky!important;top:0!important;height:100vh!important;width:260px!important;min-width:260px!important;transform:none!important;overflow-y:auto!important;padding:24px 16px!important;border-radius:0!important}
      .wrap{max-width:1240px!important;margin:0 auto!important;grid-template-columns:1fr 360px!important;gap:18px!important;padding:0!important}
      .thead{display:grid!important}
      .row{display:grid!important;grid-template-columns:16px 160px 1fr 120px 1fr 140px 52px!important;align-items:center!important;gap:12px!important;padding:12px 8px!important;border:0!important}
    }
    html, body{ overflow-x:hidden }
    /* Paquetes (idsub) en modal de contenido */
.paquete-group{background:#fff;border-radius:16px;margin-bottom:14px;border:1px solid #e9ecef;overflow:hidden}
.paquete-header{background:#f8f9fa;padding:12px 14px;font-weight:700;color:#495057;border-bottom:1px solid #e9ecef}
.products-list{padding:0}
.product-item{display:flex;align-items:center;gap:12px;padding:10px 14px;border-bottom:1px solid #f1f3f4}
.product-item:last-child{border-bottom:0}
.product-image{width:56px;height:56px;border-radius:12px;background:#f8f9fa;display:grid;place-items:center;overflow:hidden;border:1px solid #e9ecef;flex-shrink:0}
.product-name{font-weight:700}
.product-details{font-size:12px;color:#6b7280}
.product-price{margin-left:auto;text-align:right}
.paquete-total{background:#f8f9fa;padding:12px 14px;display:flex;justify-content:space-between;border-top:1px solid #e9ecef;font-weight:700}
/* ====== Bloque rojo de edición de meta ====== */
.edit-meta{
  background: linear-gradient(164deg, #d77e3f 0%, #a65423 39%, #9f1d1d 100%);
  color:#fff;
  border-radius:16px;
  padding:14px;
  border:1px solid #ffd1d1;
  box-shadow: var(--shadow);
  margin-bottom:14px;
}
.edit-meta h5{
  margin:0 0 10px;
  font-size:15px;
  font-weight:800;
  color:#fff;
}
.edit-meta .dim{ color:#fff; opacity:.9 }
.edit-grid{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:12px;
}
.edit-meta .input{
  background:#fff;
  border-color:rgba(255,255,255,.5);
  color:#1f2937;
}
.edit-actions{
  display:flex;
  justify-content:flex-end;
  margin-top:10px;
}

/* ====== Tarjeta blanca para actualizar estado ====== */
.status-card{
  background:#fff;
  border:1px solid var(--border);
  border-radius:16px;
  padding:14px;
}
.status-card h5{
  margin:0 0 10px;
  font-size:15px;
  font-weight:800;
  color:var(--sub);
}

/* Responsive */
@media (max-width:760px){
  .edit-grid{ grid-template-columns:1fr; }
}
.sb-foot{color:#ffe9e2;opacity:.85;font-size:12px;text-align:center;position: absolute;    bottom: 5px;    right: 28px;}

  </style>
</head>
<body>
  <div class="app">
    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
      <div class="inner" style="border-radius:20px;padding:15px;position:relative;height:100%;display:flex;flex-direction:column;justify-content:center;background:#ffebb0">
        <div class="brand" style="position:absolute;top:10px;left:15px">
          <a href="{{asset('/')}}"><img src="{{asset('image/logo.webp')}}" alt="" style="width:50%"></a>
        </div>
        <nav class="nav">
          <a href="{{route('admin.dashboard')}}" ><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
          <a href="{{ url('admin/ventas') }}"><span class="material-symbols-outlined">attach_money</span>Ventas</a>
          <a href="#" class="active"><span class="material-symbols-outlined">local_shipping</span>Envíos</a>
          <a href="{{ route('admin.index_images.index') }}" ><span class="material-symbols-outlined">photo_library</span>Editor</a>
          <a href="#"><span class="material-symbols-outlined">shopping_cart</span>Compras</a>
          <a href="{{ url('admin/productos') }}"><span class="material-symbols-outlined">barcode_scanner</span>Inventario</a>
          
          <a href="#"><span class="material-symbols-outlined">confirmation_number</span>Cupones</a>
          <a href="{{ url('admin/usuarios') }}"><span class="material-symbols-outlined">contacts_product</span>Usuarios</a>
          
          <a href="#"><span class="material-symbols-outlined">settings</span>Configuración</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" style="color:white;cursor:pointer;position:absolute;right:25%;background:none;border:1px solid white;padding:10px;width:50%;border-radius:10px;bottom:35px;">
            Logout
          </button>
        </form>
        <div class="sb-foot">© {{ date('Y') }} {{env('DEVELOPER_NAME')}}</div>
      </div>
    </aside>

    {{-- MAIN --}}
    <main class="main">
      {{-- TOP USER BAR --}}
      <div class="topbar" style="position:relative;background:none;box-shadow:none;border:none;margin-top:8px;justify-content:flex-end;gap:20px">
        <div class="venti" style="background:white;border-radius:15px;padding:10px;height:56px;width:200px">
          <div class="top-ttl">Envíos</div>
          <div class="subhead">{{ number_format($shipments->total()) }} envíos</div>
        </div>
        <div class="user" style="padding:10px;background:#ffebb0;border-radius:15px;color:white">
          <div class="avatar" title="{{ Auth::user()->name ?? 'Admin' }}" style="background:none;color:#656565">
            {{ strtoupper(mb_substr(Auth::user()->name ?? 'A',0,1)) }}
          </div>
          <div style="display:flex;flex-direction:column;line-height:1">
            <strong>Admin</strong>
            <span class="sub" style="color:#656565">{{ Auth::user()->email ?? '' }}</span>
          </div>
        </div>
      </div>

      {{-- TOP FILTER BAR --}}
      <div class="topbar" style="margin:20px;top:20px;border-radius:15px;margin-top:0;background:rgba(256,256,256,.5);backdrop-filter:blur(3px)">
        <form method="get" action="{{ route('admin.envios.index') }}" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;width:100%">
          <div class="search-wrap" style="flex:1 1 260px">
            <input class="search" type="text" name="q" placeholder="Buscar por código, tracking, email..." value="{{ $q ?? '' }}">
            <span class="search-ico">⌕</span>
          </div>
          <select class="chip" name="status" style="appearance:none">
            <option value="">Estado</option>
            @php $statuses = ['label_created'=>'Etiqueta','pickup_ready' => 'Listo para recojo','in_transit'=>'En tránsito','out_for_delivery'=>'En reparto','delivered'=>'Entregado','failed'=>'Fallido','returned'=>'Devuelto','pending'=>'Pendiente']; @endphp
            @foreach($statuses as $k=>$v)
              <option value="{{ $k }}" @selected(($status ?? '')===$k)>{{ $v }}</option>
            @endforeach
          </select>
          <input class="chip" type="text" name="carrier" placeholder="Courier" value="{{ $carrier ?? '' }}">
          <input class="chip" type="date" name="from" value="{{ $from ?? '' }}">
          <input class="chip" type="date" name="to" value="{{ $to ?? '' }}">
          <button class="btn btn-ghost" type="submit"><span class="material-symbols-outlined">output</span></button>
          <a class="btn btn-ghost" href="{{ route('admin.envios.index') }}"><span class="material-symbols-outlined">cleaning_services</span></a>
        </form>
      </div>

      {{-- GRID --}}
      <div class="wrap">
        {{-- LISTA --}}
        <section class="panel">
          <div class="thead">
            <div></div>
            <div>Código</div>
            <div>Tracking</div>
            <div>Items</div>
            <div>Destino</div>
            <div>Estado</div>
            <div></div>
          </div>

          <div class="rows" id="rows">
            @foreach($shipments as $s)
              @php
                $venta = $s->venta;
                $destino = trim(implode(', ', array_filter([$venta->distrito ?? null, $venta->provincia ?? null, $venta->departamento ?? null])), ', ');
                if(!$destino && is_array($s->address_to ?? null)){
                  $destino = trim(implode(', ', array_filter([
                    $s->address_to['distrito'] ?? null,
                    $s->address_to['provincia'] ?? null,
                    $s->address_to['departamento'] ?? null,
                    $s->address_to['city'] ?? null
                  ])), ', ');
                }
                $badge = match($s->status){
                  'label_created' => 'st-label',
                  'pickup_ready' => 'st-pickup',
                  'in_transit' => 'st-transit',
                  'out_for_delivery' => 'st-out',
                  'delivered' => 'st-delivered',
                  'failed' => 'st-failed',
                  'returned' => 'st-returned',
                  default => 'st-pending',
                };
                $txt = [
                  'label_created'=>'Etiqueta creada','pickup_ready' => 'Listo para recojo','in_transit'=>'En tránsito','out_for_delivery'=>'En reparto',
                  'delivered'=>'Entregado','failed'=>'Fallido','returned'=>'Devuelto','pending'=>'Pendiente'
                ][$s->status] ?? ucfirst($s->status);
              @endphp
              <div class="row envio-row" data-id="{{ $s->id }}">
                <div class="dot"></div>
                <div class="code">{{ $venta->codigo ?? ('V#'.$s->venta_id) }}</div>
                <div class="dest">{{ $s->tracking_number ?: '—' }} {!! $s->tracking_url ? ' · <a href="'.$s->tracking_url.'" target="_blank">abrir</a>' : '' !!}</div>
                <div class="count">{{ $venta->lineas_count ?? 0 }}</div>
                <div class="dest">{{ $destino ?: ($venta->email ?? '—') }}</div>
                <div><span class="status {{ $badge }}">{{ $txt }}</span></div>
                <div class="actions">
                  <button class="btn-3dots" aria-haspopup="menu" aria-expanded="false">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
                    </svg>
                  </button>
                  <div class="menu" role="menu">
                    <button data-action="ver" data-id="{{ $s->id }}">Ver</button>
                    <button data-action="estado" data-id="{{ $s->id }}">Cambiar estado</button>
                    <button data-action="contenido" data-id="{{ $s->id }}">Ver contenido</button>
                    @if($s->tracking_number)
                      <button data-action="copiar" data-id="{{ $s->id }}">Copiar tracking</button>
                    @endif
                    @if($s->tracking_url)
                      <a href="{{ $s->tracking_url }}" target="_blank" style="all:unset;display:block;padding:10px;border-radius:8px;cursor:pointer;color:#374151">Abrir tracking</a>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          <div class="pager">
            <div class="pager-info">
              Mostrando página {{ $shipments->currentPage() }} de {{ $shipments->lastPage() }}
            </div>
            {{ $shipments->onEachSide(1)->links('vendor.pagination.adler') }}
          </div>
        </section>

        {{-- ASIDE --}}
        <aside class="aside" style="padding-top:40px">
          <div class="card">
            <h4>Resumen de envío</h4>
            <div class="kv">
              <div class="kv-row"><div class="key">Código</div><div id="kvCode">—</div></div>
              <div class="kv-row"><div class="key">Tracking</div><div id="kvTrack">—</div></div>
              <div class="kv-row"><div class="key">Estado</div><div id="kvStatus">—</div></div>
              <div class="kv-row"><div class="key">Courier</div><div id="kvCarrier">—</div></div>
              <div class="kv-row"><div class="key">Servicio</div><div id="kvService">—</div></div>
              <div class="kv-row"><div class="key">Costo envío</div><div id="kvCost">—</div></div>
              <div class="kv-row"><div class="key">Peso</div><div id="kvWeight">—</div></div>
              <div class="kv-row"><div class="key">Fechas</div><div id="kvDates" class="dim">—</div></div>
              <div class="kv-row"><div class="key">Destino</div><div id="kvDestino">—</div></div>
            </div>
          </div>

          <div class="card">
            <h4>Items</h4>
            <div id="listItems" style="display:grid;gap:10px">
              <div class="dim">Selecciona un envío…</div>
            </div>
          </div>
        </aside>
      </div>
    </main>
  </div>

  {{-- MODAL --}}
  <div id="modal-backdrop" class="backdrop">
    <div class="modal">
      <div class="modal-hd">
        <h3 id="m-title" style="margin:0;font-weight:800">Envío</h3>
        <button class="btn btn-ghost" onclick="closeModal()">Cerrar</button>
      </div>
      <div class="modal-bd">
        <div id="m-content"></div>
        <hr style="margin:18px 0;border:none;border-top:1px solid var(--border)">

<!-- ========== BLOQUE ROJO: EDITAR META DEL ENVÍO ========== -->
<div class="edit-meta">
  <h5>Datos de envío</h5>

  <div class="edit-grid">
    <div>
      <label class="dim">Carrier</label>
      <input id="m-carrier" class="input" type="text" placeholder="Olva, Shalom, Urbano…">
    </div>
    <div>
      <label class="dim">Service</label>
      <input id="m-service" class="input" type="text" placeholder="Económico, Express…">
    </div>

    <div>
      <label class="dim">Tracking number</label>
      <input id="m-track" class="input" type="text" placeholder="ABC123456PE">
    </div>
    <div>
      <label class="dim">Tracking URL</label>
      <input id="m-url" class="input" type="url" placeholder="https://…">
    </div>

    <div>
      <label class="dim">Weight (kg)</label>
      <input id="m-weight" class="input" type="number" step="0.001" min="0" placeholder="1.250">
    </div>
  </div>

  <div class="edit-actions">
    <button class="btn btn-primary" onclick="saveShipmentMeta()">Guardar datos</button>
  </div>
</div>

<!-- ========== TARJETA BLANCA: CAMBIAR ESTADO ========== -->
<div class="status-card">
  <h5>Cambiar estado</h5>
  <div class="grid-2">
    <div>
      <label class="dim">Estado</label>
      <select id="m-status" class="select">
        <option value="label_created">Etiqueta creada</option>
        <option value="in_transit">En tránsito</option>
        <option value="out_for_delivery">En reparto</option>
        <option value="delivered">Entregado</option>
        <option value="failed">Fallido</option>
        <option value="returned">Devuelto</option>
      </select>
    </div>
    <div style="display:flex;align-items:flex-end;justify-content:flex-end;gap:8px">
      <button class="btn btn-primary" onclick="updateStatus()">Actualizar</button>
    </div>
  </div>
</div>

<div id="m-flash" class="dim" style="margin-top:10px;display:none;color:#166534">Actualizado.</div>

      </div>
    </div>
  </div>
  <!-- MODAL CONTENIDO (paquetes por idsub) -->
<div id="modal-content-backdrop" class="backdrop">
  <div class="modal">
    <div class="modal-hd">
      <h3 id="mc-title" style="margin:0;font-weight:800">Contenido del envío</h3>
      <button class="btn btn-ghost" onclick="closeContentModal()">Cerrar</button>
    </div>
    <div class="modal-bd" id="mc-content"></div>
  </div>
</div>
                
  <script>
    const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    

    let currentShipmentId = null;

    function statusBadge(st){
      switch(st){
        case 'label_created': return {cls:'st-label', txt:'Etiqueta creada'};
        case 'in_transit': return {cls:'st-transit', txt:'En tránsito'};
        case 'out_for_delivery': return {cls:'st-out', txt:'En reparto'};
        case 'delivered': return {cls:'st-delivered', txt:'Entregado'};
        case 'failed': return {cls:'st-failed', txt:'Fallido'};
        case 'returned': return {cls:'st-returned', txt:'Devuelto'};
        case 'pickup_ready': return {cls:'st-pickup', txt:'Listo para recojo'};
        default: return {cls:'st-pending', txt: st || 'Pendiente'};
      }
    }

    function selectShipment(id, rowEl){
      fetch(`{{ url('admin/envios') }}/${id}`, { headers: { 'Accept':'application/json' }})
      .then(r => r.json())
      .then(({shipment, venta}) => {
        fillAside(shipment, venta);
        if(rowEl){
          document.querySelectorAll('.envio-row').forEach(x=>x.classList.remove('is-active'));
          rowEl.classList.add('is-active');
        }
      })
      .catch(()=> console.warn('No se pudo cargar el envío.'));
    }

    function fillAside(sh, venta){
      const kv = (id, v) => document.getElementById(id).textContent = v ?? '—';
      kv('kvCode', venta?.codigo ?? ('V#'+(sh?.venta_id ?? '—')));
      const tk = sh?.tracking_number ? sh.tracking_number + (sh?.tracking_url ? ' · ' : '') : '—';
      document.getElementById('kvTrack').innerHTML = tk + (sh?.tracking_url ? `<a href="${sh.tracking_url}" target="_blank">abrir</a>` : '');
      const sb = statusBadge(sh?.status);
      document.getElementById('kvStatus').innerHTML = `<span class="status ${sb.cls}">${sb.txt}</span>`;
      kv('kvCarrier', sh?.carrier);
      kv('kvService', sh?.service);
      kv('kvCost', sh?.shipping_cost ? 'S/ '+Number(sh.shipping_cost).toFixed(2) : '—');
      kv('kvWeight', sh?.weight_kg ? Number(sh.weight_kg).toFixed(3)+' kg' : '—');

      const fechas = [];
      if(sh?.created_at) fechas.push('Creado: '+sh.created_at.substring(0,16).replace('T',' '));
      if(sh?.shipped_at) fechas.push('Envío: '+sh.shipped_at.substring(0,16).replace('T',' '));
      if(sh?.delivered_at) fechas.push('Entrega: '+sh.delivered_at.substring(0,16).replace('T',' '));
      document.getElementById('kvDates').textContent = fechas.join(' · ') || '—';

      const destino = [venta?.distrito, venta?.provincia, venta?.departamento].filter(Boolean).join(', ');
      if(destino) document.getElementById('kvDestino').textContent = destino;
      else if(sh?.address_to){ try{
        const a = typeof sh.address_to==='string' ? JSON.parse(sh.address_to) : sh.address_to;
        const d = [a?.address, a?.city, a?.distrito, a?.provincia, a?.departamento].filter(Boolean).join(', ');
        document.getElementById('kvDestino').textContent = d || '—';
      }catch{ document.getElementById('kvDestino').textContent = '—'; } }

      // Items
      const itemsWrap = document.getElementById('listItems');
      itemsWrap.innerHTML = '';
      const det = Array.isArray(venta?.detalle) ? venta.detalle : [];
      if(det.length === 0){
        itemsWrap.innerHTML = '<div class="dim">Sin items.</div>';
      }else{
        det.forEach(d=>{
          const el = document.createElement('div');
          el.className = 'item-card';
          const precio = Number(d.precio || d.price || 0);
          const cantidad = Number(d.qty || d.cantidad || 1);
          const subtotal = Number(d.subtotal || (precio*cantidad));
          el.innerHTML = `
            <div class="thumb"><img src="{{ asset('image/productos') }}/${d.articulo?.image ?? ''}" alt=""></div>
            <div style="flex:1">
              <div class="item-title">${d.articulo?.name ?? ('ID '+(d.idarticulo ?? ''))}</div>
              <div class="dim">Cant: ${cantidad} · S/ ${precio.toFixed(2)}</div>
            </div>
            <div class="dim">S/ ${subtotal.toFixed(2)}</div>`;
          itemsWrap.appendChild(el);
        });
      }
    }

    // Fila + menú
    document.querySelectorAll('.envio-row').forEach(row=>{
      row.addEventListener('click', (e)=>{
        if(e.target.closest('.actions')) return;
        selectShipment(row.dataset.id, row);
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
      if(verBtn){
        verBtn.addEventListener('click', ev=>{
          ev.stopPropagation();
          openDetalle(verBtn.dataset.id);
          menu.style.display='none';
        });
      }

      const contenidoBtn = row.querySelector('[data-action="contenido"]');
      if(contenidoBtn){
        contenidoBtn.addEventListener('click', ev=>{
          ev.stopPropagation();
          openContenido(contenidoBtn.dataset.id);
          menu.style.display='none';
        });
      }
      const edBtn = row.querySelector('[data-action="estado"]');
      if(edBtn){
        edBtn.addEventListener('click', ev=>{
          ev.stopPropagation();
          openDetalle(edBtn.dataset.id, true);
          menu.style.display='none';
        });
      }
      const cpBtn = row.querySelector('[data-action="copiar"]');
      if(cpBtn){
        cpBtn.addEventListener('click', async ev=>{
          ev.stopPropagation();
          const id = cpBtn.dataset.id;
          const r = await fetch(`{{ url('admin/envios') }}/${id}`, { headers: {'Accept':'application/json'} });
          const { shipment } = await r.json();
          if(shipment?.tracking_number){
            await navigator.clipboard.writeText(shipment.tracking_number);
            alert('Tracking copiado.');
          }
        });
      }
    });

    function openDetalle(id, focusStatus=false){
  currentShipmentId = id;

  fetch(`{{ url('admin/envios') }}/${id}`, { headers: { 'Accept':'application/json' }})
    .then(async r => {
      if(!r.ok) throw new Error('No se pudo cargar el envío.');
      const data = await r.json();
      // útil para depurar si algo no coincide:
      console.debug('envio.show payload', data);
      return data;
    })
    .then(({shipment, venta, grupos})=>{
      fillAside(shipment, venta);

      // ===== prellenar selects e inputs de meta
      document.getElementById('m-status').value  = shipment.status ?? 'label_created';
      const iCarrier = document.getElementById('m-carrier');
      const iService = document.getElementById('m-service');
      const iTrack   = document.getElementById('m-track');
      const iUrl     = document.getElementById('m-url');
      const iWeight  = document.getElementById('m-weight');
      if (iCarrier) iCarrier.value = shipment.carrier ?? '';
      if (iService) iService.value = shipment.service ?? '';
      if (iTrack)   iTrack.value   = shipment.tracking_number ?? '';
      if (iUrl)     iUrl.value     = shipment.tracking_url ?? '';
      if (iWeight)  iWeight.value  = shipment.weight_kg ?? '';

      // ===== cabecera del modal
      const sb = statusBadge(shipment.status);
      const headerHtml = `
        <div class="grid-2">
          <div>
            <div class="item-title" style="margin-bottom:8px">Datos de envío</div>
            <p><strong>Código:</strong> ${venta?.codigo ?? ('V#'+shipment.venta_id)}</p>
            <p><strong>Estado:</strong> <span class="status ${sb.cls}">${sb.txt}</span></p>
            <p><strong>Tracking:</strong> ${shipment.tracking_number ?? '—'} ${shipment.tracking_url ? ' · <a href="${shipment.tracking_url}" target="_blank">abrir</a>' : ''}</p>
            <p><strong>Courier:</strong> ${shipment.carrier ?? '—'} · ${shipment.service ?? ''}</p>
            <p><strong>Costo/Peso:</strong> ${shipment.shipping_cost ? 'S/ '+Number(shipment.shipping_cost).toFixed(2) : '—'} · ${shipment.weight_kg ? Number(shipment.weight_kg).toFixed(3)+' kg' : '—'}</p>
          </div>
          <div>
            <div class="item-title" style="margin-bottom:8px">Cliente</div>
            <p>${venta?.nombre ?? ''} ${venta?.apellido ?? ''}</p>
            <p>${venta?.email ?? ''}</p>
            <p>${venta?.domicilio ?? ''}</p>
            <p>${[venta?.distrito, venta?.provincia, venta?.departamento].filter(Boolean).join(', ')}</p>
            <p>DNI: ${venta?.dni ?? ''}</p>
          </div>
        </div>
      `;

      // ===== grupos: usa los que vienen; si no, agrupa en el front a partir de venta.detalle
      const lines = Array.isArray(venta?.detalle) ? venta.detalle : [];
      let groups = Array.isArray(grupos) ? grupos : [];
      if (!groups.length && lines.length) {
        const map = {};
        for (const d of lines) {
          const k = d.idsub ?? 1;
          if (!map[k]) map[k] = { idsub:k, total:0, items:[] };
          const precio   = Number(d.precio || 0);
          const cantidad = Number(d.qty || d.cantidad || 1);
          const subtotal = Number(d.subtotal || (precio*cantidad));
          map[k].items.push({
            ...d,
            precio, qty:cantidad, subtotal
          });
          map[k].total += subtotal;
        }
        groups = Object.values(map);
      }

      const groupsHtml = groups.length
        ? groups.map(g => `
            <div class="item-title" style="margin:14px 0 6px">Paquete ${g.idsub}</div>
            <div style="display:grid;gap:10px">
              ${
                (g.items || []).map(d => {
                  const precio   = Number(d.precio || 0);
                  const cantidad = Number(d.qty || d.cantidad || 1);
                  const subtotal = Number(d.subtotal || (precio * cantidad));
                  const name = d?.articulo?.name ?? ('ID '+(d.idarticulo ?? ''));
                  const img  = d?.articulo?.image ? `{{ asset('image/productos') }}/${d.articulo.image}` : '';
                  return `
                    <div class="item-card">
                      <div class="thumb">${img ? `<img src="${img}" alt="">` : ''}</div>
                      <div style="flex:1">
                        <div class="item-title">${name}</div>
                        <div class="dim">Cant: ${cantidad} · S/ ${precio.toFixed(2)}</div>
                      </div>
                      <div class="dim">S/ ${subtotal.toFixed(2)}</div>
                    </div>
                  `;
                }).join('')
              }
              <div class="kv-row" style="margin-top:4px">
                <div class="key">Total del paquete</div>
                <div><strong>S/ ${Number(g.total || 0).toFixed(2)}</strong></div>
              </div>
            </div>
          `).join('')
        : '<div class="dim" style="margin-top:10px">Sin items.</div>';

      document.getElementById('m-title').innerText = 'Envío #'+shipment.id;
      document.getElementById('m-content').innerHTML = headerHtml + groupsHtml;

      document.getElementById('modal-backdrop').style.display = 'flex';
      if(focusStatus) document.getElementById('m-status').focus();
    })
    .catch(err=> alert(err.message));
}
    function saveShipmentMeta(){
        const body = {
          carrier:         (document.getElementById('m-carrier').value || null),
          service:         (document.getElementById('m-service').value || null),
          tracking_number: (document.getElementById('m-track').value || null),
          tracking_url:    (document.getElementById('m-url').value || null),
          weight_kg:       (document.getElementById('m-weight').value || null),
        };

        fetch(`{{ url('admin/envios') }}/${currentShipmentId}`, {
          method: 'PATCH',
          headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': CSRF },
          body: JSON.stringify(body)
        })
        .then(async r => {
          const data = await r.json().catch(()=> ({}));
          if(!r.ok){
            const msg = data?.message || data?.error || 'No se pudo guardar.';
            throw new Error(msg);
          }
          document.getElementById('m-flash').innerText = 'Datos guardados.';
          document.getElementById('m-flash').style.display = 'block';

          // refrescar la columna de tracking en la fila
          const row = document.querySelector(`.envio-row[data-id="${currentShipmentId}"]`);
          if(row){
            const destEl = row.querySelectorAll('.dest')[0];
            const tk  = data?.shipment?.tracking_number || '—';
            const url = data?.shipment?.tracking_url || '';
            if(destEl){
              destEl.innerHTML = tk + (url ? ` · <a href="${url}" target="_blank">abrir</a>` : '');
            }
          }
        })
        .catch(err => alert(err.message));
      }

function openContenido(id){
  fetch(`{{ url('admin/envios') }}/${id}`, { headers: { 'Accept':'application/json' }})
    .then(async r => {
      if(!r.ok) throw new Error('No se pudo cargar el contenido.');
      return r.json();
    })
    .then(({ shipment, venta, grupos }) => {
      // 1) normalizo "grupos" sin importar si viene array (backend) u objeto (front fallback)
      const normalized = normalizeGrupos(grupos, venta?.detalle);

      // 2) pinto
      const mon = n => Number(n||0).toFixed(2);
      let html = '';
      console.log(normalized);
      if (normalized.length === 0) {
        html = '<div class="dim">Sin contenido.</div>';
      } else {
        html = normalized.map(g => `
          <div class="paquete-group">
            <div class="paquete-header">Paquete ${g.idsub}</div>
            <div class="products-list">
              ${
                (g.items || []).map(d => {
                  const qty = Number(d.qty ?? d.cantidad ?? 1);
                  const p   = Number(d.precio ?? 0);
                  const sub = Number(d.subtotal ?? qty*p);
                  const name = d?.articulo?.name ?? ('ID '+(d.idarticulo ?? ''));
                  const img  = d?.articulo?.image ? `{{ asset('image/productos') }}/${d.articulo.image}` : '';

                  return `
                    <div class="product-item">
                      <div class="product-image">
                        ${ img
                          ? `<img src="${img}" alt="${name}" style="width:100%;height:100%;object-fit:cover;border-radius:12px">`
                          : '📦' }
                      </div>
                      <div>
                        <div class="product-name">${name}</div>
                        <div class="product-details">x${qty} · S/ ${mon(p)} c/u</div>
                      </div>
                      <div class="product-price">
                        <div class="product-details">Subtotal</div>
                        <div><strong>S/ ${mon(sub)}</strong></div>
                      </div>
                    </div>
                  `;
                }).join('')
              }
            </div>
            <div class="paquete-total">
              <span>Total del Paquete</span>
              <span>S/ ${mon(g.total)}</span>
            </div>
          </div>
        `).join('');
      }

      document.getElementById('mc-title').innerText =
        `Contenido · Envío #${shipment.id} · ${venta?.codigo ?? ''}`;
      document.getElementById('mc-content').innerHTML = html;
      document.getElementById('modal-content-backdrop').style.display = 'flex';
    })
    .catch(err => alert(err.message));
}
function normalizeGrupos(grupos, detalle){
  // Caso A: backend nos envía array [{idsub, total, items:[...]}]
  if (Array.isArray(grupos) && grupos.length) {
    return grupos.slice().sort((a,b)=> Number(a.idsub)-Number(b.idsub));
  }

  // Caso B: generamos en el front agrupando detalle (objeto -> array)
  if (Array.isArray(detalle) && detalle.length){
    const map = {};
    for (const d of detalle){
      const k  = d.idsub ?? 1;
      const q  = Number(d.qty ?? d.cantidad ?? 1);
      const p  = Number(d.precio ?? 0);
      const sb = Number(d.subtotal ?? q*p);
      if (!map[k]) map[k] = { idsub:k, total:0, items:[] };
      map[k].items.push(d);
      map[k].total += sb;
    }
    return Object.values(map).sort((a,b)=> Number(a.idsub)-Number(b.idsub));
  }

  // Nada para mostrar
  return [];
}
function closeContentModal(){
  document.getElementById('modal-content-backdrop').style.display = 'none';
}

function groupByIdsub(detalle){
  const g = {};
  (detalle||[]).forEach(d=>{
    const idsub = d.idsub ?? 1;
    const qty   = Number(d.qty||d.cantidad||1);
    const p     = Number(d.precio||0);
    const sub   = Number(d.subtotal||qty*p);
    (g[idsub] ||= { total:0, items:[] });
    g[idsub].items.push(d);
    g[idsub].total += sub;
  });
  return g;
}

    function updateStatus(){
      const to = document.getElementById('m-status').value;
      fetch(`{{ url('admin/envios') }}/${currentShipmentId}/status`, {
        method: 'PATCH',
        headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ status: to })
      })
      .then(r => r.ok ? r.json() : Promise.reject())
      .then(({status})=>{
        document.getElementById('m-flash').style.display = 'block';
        // refresco fila seleccionada
        const active = document.querySelector(`.envio-row[data-id="${currentShipmentId}"]`);
        if(active){
          const badge = statusBadge(status);
          active.querySelector('.status').className = 'status '+badge.cls;
          active.querySelector('.status').textContent = badge.txt;
        }
      })
      .catch(()=> alert('No se pudo actualizar el estado.'));
    }

    function closeModal(){
      document.getElementById('modal-backdrop').style.display = 'none';
      const f = document.getElementById('m-flash');
      if(f) f.style.display = 'none';
    }

    // Autoselección
    window.addEventListener('DOMContentLoaded', ()=>{
      const first = document.querySelector('.envio-row');
      if(first) selectShipment(first.dataset.id, first);
    });
  </script>
</body>
</html>
