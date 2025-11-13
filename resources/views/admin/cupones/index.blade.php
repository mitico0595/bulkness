<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cupones | Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @include ('global.icon')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <style>
    :root{
      --bg:#f6f7fb; --panel:#ffffff; --muted:#7b8aa3; --text:#1f2937; --sub:#0f172a;
      --border:#e5e7eb; --shadow:0 10px 30px rgba(32,41,63,.08); --radius:14px; --r8:10px;
      --accent:#fb4949; --accent-2:#ff1e1e; --accent-3:#ff4a4a;
      --good:#16a34a; --bad:#e11d48; --info:#2563eb;
    }
    *{box-sizing:border-box} html,body{height:100%}
    body{margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;background:var(--bg);color:var(--text)}
    a{color:inherit;text-decoration:none}

    /* ====== LAYOUT ====== */
    .app{display:grid;grid-template-columns:260px 1fr;min-height:100vh}
    .wrap{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1fr 360px;gap:18px}

    /* ====== SIDEBAR ====== */
    .sidebar{color:#fff; padding:24px 16px; position:sticky; top:0; height:100vh; z-index:40}
    .sidebar .inner{height:100%;display:flex;flex-direction:column;justify-content:center;background:#ffebb0;padding:20px;border-radius:20px}
    .brand{display:flex;align-items:center;gap:10px;margin-bottom:24px;position:absolute;top:30px}
    .brand a img{width:120px;max-width:100%}
    .nav{display:flex;flex-direction:column;gap:6px}
    .nav a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:#363636;opacity:.95}
    .nav a.active,.nav a:hover{background:rgba(255,255,255,.34);color:#aaaaaa}
    .sb-foot{color:#ffe9e2;opacity:.85;font-size:12px;text-align:center;position:absolute;bottom:35px;right:28px}
    .backdrop-nav{display:none;position:fixed;inset:0;background:rgba(15,23,42,.45);z-index:35}

    /* ====== TOPBAR ====== */
    .topbar{top:0;z-index:30;background:#fff;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:12px 18px}
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
      margin:20px; top:25px; border-radius:15px; margin-top:0;
      background:rgba(256,256,256,.55); backdrop-filter:blur(3px);
      display:flex; align-items:center; justify-content:space-between; padding:12px 16px;
      border:1px solid var(--border); position:sticky;
    }

    /* ====== CONTROLES ====== */
    .search-wrap{position:relative;min-width:280px}
    .search{width:100%;background:#fff;border:1px solid var(--border);border-radius:12px;padding:12px 44px 12px 14px;font-size:14px;box-shadow:var(--shadow)}
    .search-ico{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:32px;height:32px;border-radius:10px;background:#ffebb0;display:grid;place-items:center;color:#fff;font-weight:800}
    .btn{border:0;border-radius:12px;padding:10px 14px;font-weight:600;cursor:pointer}
    .btn-ghost{background:#fff;border:1px solid var(--border)}
    .btn-primary{background:#ffebb0;color:#fff}
    .btn-primary:hover{filter:brightness(.97)}
    .input,.select,textarea{width:100%;border:1px solid var(--border);border-radius:10px;padding:10px}

    /* ====== LISTA ====== */
    .panel{padding:14px}
    .thead{
      display:grid;
      grid-template-columns:16px 1.6fr 1fr 1.1fr 1.1fr 1fr 52px; /* 7 columnas estilo productos */
      gap:12px;padding:6px 6px 10px;color:var(--muted);font-size:12px;border-bottom:1px solid #eef2ff
    }
    .rows{display:flex;flex-direction:column;gap:12px}
    .row{
      cursor:pointer;background:#fff;border-radius:15px;
      display:grid;grid-template-columns:16px 1.6fr 1fr 1.1fr 1.1fr 1fr 52px;
      align-items:center;gap:12px;padding:12px 8px;border-top:1px solid #f1f5f9
    }
    .row:first-child{border-top:none}
    .row.is-active{background:#ffebb0;color:#fff}
    .dot{border-radius:999px;background:#9ca3af;}
    .code{font-weight:800}
    .badge{border-radius:999px;padding:6px 10px;font-size:12px;font-weight:700}
    .b-act{background:#ecfdf5;color:#065f46}
    .b-inact{background:#f3f4f6;color:#6b7280}
    .b-ventana{background:#eef6ff;color:#2563eb}
    .actions{position:relative;justify-self:end}
    .btn-3dots{all:unset;cursor:pointer;border-radius:10px;padding:6px;display:grid;place-items:center}
    .btn-3dots:hover{background:#f3f4f6}
    .menu{position:absolute;right:0;top:36px;background:#fff;border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow);min-width:180px;padding:6px;display:none;z-index:5}
    .menu button,.menu a{all:unset;display:flex;align-items:center;gap:8px;width:100%;padding:10px;border-radius:8px;cursor:pointer;color:#374151}
    .menu button:hover,.menu a:hover{background:#f3f4f6}

    /* ====== ASIDE ====== */
    .aside{display:flex;flex-direction:column;gap:14px;padding-top:40px}
    .card{background:#fff;border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);padding:14px}
    .card h4{margin:0 0 12px;font-size:15px}
    .kv{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    .kv-row{display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:14px}
    .key{color:var(--muted)}

    /* ====== PAGINACIÓN ====== */
    .pager{display:flex;align-items:center;justify-content:space-between;margin-top:14px;gap:10px}
    .pager-info{color:#7b8aa3;font-size:13px}
    .pager-list{list-style:none;display:flex;gap:6px;margin:0;padding:0}
    .pager-list a,.pager-list span{
      display:grid;place-items:center;min-width:38px;height:38px;padding:0 12px;border:1px solid #e5e7eb;border-radius:12px;background:#fff;color:#1f2937;text-decoration:none
    }
    .pager-list li:hover a{box-shadow:0 6px 18px rgba(32,41,63,.08)}
    .pager-list .active span{background:linear-gradient(180deg,var(--accent),var(--accent-2));color:#fff;border-color:transparent;font-weight:800}
    .pager-list .disabled span{opacity:.45;background:#f3f4f6;color:#6b7280}

    /* ====== MODAL (misma estructura que productos) ====== */
    .backdrop{position:fixed;inset:0;background:rgba(0,0,0,.5);display:none;align-items:center;justify-content:center;z-index:100}
    .backdrop.open{display:flex}
    .modal{background:#fff;border:1px solid var(--border);border-radius:16px;box-shadow:0 20px 50px rgba(0,0,0,.25);width:min(900px,95vw);max-height:90vh;display:flex;flex-direction:column;overflow:hidden}
    .modal-head{position:sticky;top:0;display:flex;align-items:center;justify-content:space-between;padding:18px 20px;border-bottom:1px solid var(--border);background:#f8fafc}
    .modal-title{font-weight:800;font-size:20px;margin:0}
    .modal-close{border:0;background:transparent;padding:8px;border-radius:10px;cursor:pointer}
    .modal-close:hover{background:#eaeef6}
    .modal-body{padding:18px;overflow:auto;max-height:calc(90vh - 140px)}
    .modal-foot{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-top:1px solid var(--border);background:#f8fafc}
    .btn-cancel{background:transparent;border:0;color:#64748b;padding:8px 12px;border-radius:10px;cursor:pointer}
    .btn-save{display:inline-flex;align-items:center;gap:8px;padding:10px 16px;border:0;border-radius:10px;background:#2563eb;color:#fff;cursor:pointer}
    .grid2{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .grid3{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
    @media (max-width:1100px){ .app{grid-template-columns:1fr} .sidebar{position:fixed;left:0;top:0;width:260px;height:100vh;transform:translateX(-100%);transition:transform .25s ease;padding:16px}
      .sidebar.open{transform:translateX(0)} .wrap{grid-template-columns:1fr} .topbar-2{margin:12px} .backdrop-nav.show{display:block} }
    @media (max-width:760px){ .thead{display:none} .row{grid-template-columns:16px 1fr;grid-auto-rows:auto} .row > *:nth-child(n+3){grid-column:span 2} .search-wrap{min-width:0;flex:1} .grid2,.grid3{grid-template-columns:1fr} }
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
          <a href="{{ route('admin.ventas.index') }}"><span class="material-symbols-outlined">attach_money</span>Ventas</a>
          <a href="{{ url('admin/envios') }}"><span class="material-symbols-outlined">local_shipping</span>Envíos</a>
          <a href="{{ route('admin.compras.index') }}"><span class="material-symbols-outlined">shopping_cart</span>Compras</a>
          <a href="{{ route('admin.products.index') }}"><span class="material-symbols-outlined">barcode_scanner</span>Inventario</a>
          
          <a class="active" href="{{ route('admin.cupones.index') }}"><span class="material-symbols-outlined">confirmation_number</span>Cupones</a>
          <a href="{{asset('admin/usuarios')}}"><span class="material-symbols-outlined">contacts_product</span>Usuarios</a>
          
          <a href="#"><span class="material-symbols-outlined">settings</span>Configuración</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-btn" style="cursor:pointer;color:white;position:absolute;right:25%;background:none;border:1px solid white;padding:10px;width:50%;border-radius:10px;bottom:65px;">Logout</button>
        </form>
      </div>
      <div class="sb-foot">© {{ date('Y') }} Adler</div>
    </div>
  </aside>
  <div id="backdropNav" class="backdrop-nav"></div>

  <!-- MAIN -->
  <main class="main">
    <!-- TOPBAR -->
    <div class="topbar" style="background:none;box-shadow:none;border:none;margin-top:8px">
      <div class="left"><button class="burger" id="burger" aria-label="Abrir menú">☰</button></div>
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

    <!-- HEAD acciones -->
    <div class="topbar-2">
      <div>
        <div class="page-title">Cupones</div>
        <div class="sub">{{ $cupones->total() }} cupones encontrados</div>
      </div>
      <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
        <form method="get" action="{{ route('admin.cupones.index') }}" style="display:flex;align-items:center;gap:10px">
          <div class="search-wrap">
            <input id="q" class="search" type="text" name="q" placeholder="Buscar código o nombre..." value="{{ $q ?? '' }}">
            <span class="search-ico">⌕</span>
          </div>
          <a class="btn btn-ghost" href="{{ route('admin.cupones.index') }}"><span class="material-symbols-outlined">cleaning_services</span></a>
        </form>
        <button class="btn btn-primary" type="button" onclick="openCouponModal()">Crear cupón</button>
      </div>
    </div>

    <!-- GRID: listado + aside -->
    <div class="wrap">
      <!-- LISTA -->
      <section class="panel">
        <div class="thead">
          <div></div>
          <div>Cupón</div>
          <div>Tipo · Valor</div>
          <div>Vigencia</div>
          <div>Stock</div>
          <div>Estado</div>
          <div></div>
        </div>

        <div class="rows" id="rows">
          @foreach($cupones as $c)
            @php
              $reserv = (int)($reservas[$c->id] ?? 0);
              $disp = max(0, (int)$c->emitidos - (int)$c->reclamados - $reserv);
              $valorTxt = $c->tipo==='percent' ? ($c->valor.'%') : ('S/ '.number_format($c->valor/100,2));
              $enVentana = $c->ventanaActivaAhora();
              $restr = [];
              if($c->por_usuario) $restr[] = 'x usuario '.$c->por_usuario;
              if($c->min_subtotal) $restr[] = 'mín S/ '.number_format($c->min_subtotal/100,2);
              if($c->aplica_solo_subtotal) $restr[] = 'solo subtotal';
            @endphp
            <div
              class="row cupon-row"
              data-id="{{ $c->id }}"
              data-codigo="{{ $c->codigo }}"
              data-nombre="{{ $c->nombre }}"
              data-tipo="{{ $c->tipo }}"
              data-valor-ui="{{ $c->tipo==='fixed' ? number_format($c->valor/100,2,'.','') : $c->valor }}"
              data-valor-text="{{ $valorTxt }}"
              data-emitidos="{{ (int)$c->emitidos }}"
              data-reclamados="{{ (int)$c->reclamados }}"
              data-reservas="{{ $reserv }}"
              data-disponibles="{{ $disp }}"
              data-por_usuario="{{ (int)$c->por_usuario }}"
              data-min_subtotal-ui="{{ $c->min_subtotal ? number_format($c->min_subtotal/100,2,'.','') : '' }}"
              data-solo_subtotal="{{ $c->aplica_solo_subtotal ? 1 : 0 }}"
              data-activo="{{ $c->activo ? 1 : 0 }}"
              data-inicia="{{ $c->inicia_at?->format('Y-m-d H:i') }}"
              data-caduca="{{ $c->caduca_at?->format('Y-m-d H:i') }}"
              data-duracion="{{ (int)$c->duracion_minutos }}"
              data-notas="{{ $c->notas }}"
              data-ventana="{{ $enVentana ? 1 : 0 }}"
              data-restr="{{ implode(' · ', $restr) }}"
            >
              <div class="dot"></div>
              <div>
                <div class="code">{{ $c->codigo }}</div>
                <div class="sub">{{ $c->nombre ?: '—' }}</div>
              </div>
              <div>{{ strtoupper($c->tipo) }} · {{ $valorTxt }}</div>
              <div class="sub">{{ $c->inicia_at?->format('Y-m-d H:i') ?? '—' }} → {{ $c->caduca_at?->format('Y-m-d H:i') ?? '—' }}</div>
              <div>em: {{ $c->emitidos }} · recl: {{ $c->reclamados }} · disp: {{ $disp }}</div>
              <div>
                <span class="badge {{ $c->activo ? 'b-act':'b-inact' }}">{{ $c->activo ? 'Activo':'Inactivo' }}</span>
                @if($c->activo)<span class="badge b-ventana">{{ $enVentana ? 'En ventana':'Fuera de ventana' }}</span>@endif
              </div>

              <div class="actions">
                <button class="btn-3dots" aria-haspopup="menu" aria-expanded="false">
                  <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
                  </svg>
                </button>
                <div class="menu" role="menu">
                  <button data-action="ver" data-id="{{ $c->id }}">👁 Ver</button>
                  <button onclick="openCouponModal({{ $c->id }})">✏️ Editar</button>
                  <button onclick="toggleCup({{ $c->id }})">{{ $c->activo?'Desactivar':'Activar' }}</button>
                  <button onclick="delCup({{ $c->id }})">🗑 Eliminar</button>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <div style="margin-top:12px">
          {{ $cupones->onEachSide(1)->links('vendor.pagination.adler') }}
        </div>
      </section>

      <!-- ASIDE DERECHO -->
      <aside class="aside">
        <div class="card">
          <h4>Detalle del cupón</h4>
          <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap">
            <div id="adCodigo" class="code">—</div>
            <span id="adActivo" class="badge b-inact">—</span>
            <span id="adVentana" class="badge b-ventana" style="display:none">En ventana</span>
          </div>
          <div style="margin-top:6px;color:#64748b" id="adNombre">Selecciona un cupón</div>
          <div style="margin-top:8px"><span id="adTipoValor" class="badge" style="background:#f1f5f9;color:#334155">—</span></div>
        </div>

        <div class="card">
          <h4>Resumen</h4>
          <div class="kv">
            <div class="kv-row"><div class="key">Emitidos</div><div id="adEmitidos">—</div></div>
            <div class="kv-row"><div class="key">Reclamados</div><div id="adReclamados">—</div></div>
            <div class="kv-row"><div class="key">Reservas activas</div><div id="adReservas">—</div></div>
            <div class="kv-row"><div class="key">Disponibles</div><div id="adDisponibles">—</div></div>
          </div>
        </div>

        <div class="card">
          <h4>Vigencia & restricciones</h4>
          <div class="kv">
            <div class="kv-row"><div class="key">Inicia</div><div id="adInicia">—</div></div>
            <div class="kv-row"><div class="key">Caduca</div><div id="adCaduca">—</div></div>
            <div class="kv-row"><div class="key">Min. subtotal</div><div id="adMin">—</div></div>
            <div class="kv-row"><div class="key">Por usuario</div><div id="adPorUsuario">—</div></div>
            <div class="kv-row"><div class="key">Solo subtotal</div><div id="adSoloSub">—</div></div>
            <div class="kv-row"><div class="key">Duración reserva</div><div id="adDuracion">—</div></div>
            <div class="kv-row"><div class="key">Notas</div><div id="adNotas" class="sub">—</div></div>
          </div>

          <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:10px">
            <button class="btn btn-ghost" type="button" id="adEditar" onclick="openCouponModal(currentId)">Editar</button>
            <button class="btn btn-primary" type="button" onclick="copyCodigo()">Copiar código</button>
          </div>
        </div>
      </aside>
    </div>
  </main>
</div>

<!-- TOAST -->
<div id="toast" style="position:fixed;right:16px;bottom:16px;background:#111827;color:#fff;padding:10px 12px;border-radius:10px;opacity:0;transform:translateY(8px);transition:all .2s;z-index:120">Saved</div>

<!-- MODAL CREAR/EDITAR -->
<div id="cup-modal" class="backdrop">
  <div class="modal">
    <div class="modal-head">
      <h3 id="cm-title" class="modal-title">Nuevo cupón</h3>
      <button class="modal-close" onclick="closeCouponModal()"><span class="material-symbols-outlined">close</span></button>
    </div>
    <div class="modal-body">
      <form id="cm-form" onsubmit="event.preventDefault(); saveCup();">
        <input type="hidden" id="cm-id">

        <div class="grid2">
          <div><label>Código</label><input id="cm-codigo" class="input" maxlength="50" required></div>
          <div><label>Nombre</label><input id="cm-nombre" class="input" maxlength="100"></div>
        </div>

        <div class="grid3" style="margin-top:12px">
          <div>
            <label>Tipo</label>
            <select id="cm-tipo" class="select" onchange="syncValorHelp()">
              <option value="percent">Porcentaje (%)</option>
              <option value="fixed">Monto fijo (S/)</option>
            </select>
          </div>
          <div>
            <label><span id="lbl-valor">Valor (%)</span></label>
            <input id="cm-valor" class="input" type="number" min="0" step="0.01" placeholder="Ej: 10 ó 25.50">
            <div id="help-valor" class="sub" style="margin-top:4px">En <b>percent</b>, 0..100. En <b>fixed</b>, S/ (decimal).</div>
          </div>
          <div>
            <label>Emitidos</label>
            <input id="cm-emitidos" class="input" type="number" min="1" step="1" value="1">
          </div>
        </div>

        <div class="grid3" style="margin-top:12px">
          <div><label>Por usuario</label><input id="cm-por_usuario" class="input" type="number" min="0" step="1" value="1"></div>
          <div><label>Mín. subtotal (S/)</label><input id="cm-min" class="input" type="number" min="0" step="0.01" placeholder="Opcional"></div>
          <div>
            <label>Solo subtotal</label>
            <select id="cm-solo" class="select">
              <option value="1">Sí</option><option value="0">No</option>
            </select>
          </div>
        </div>

        <div class="grid3" style="margin-top:12px">
          <div><label>Inicia</label><input id="cm-inicia" class="input" type="datetime-local"></div>
          <div><label>Caduca</label><input id="cm-caduca" class="input" type="datetime-local"></div>
          <div><label>Duración reserva (min)</label><input id="cm-duracion" class="input" type="number" min="1" max="1440" value="20"></div>
        </div>

        <div class="grid2" style="margin-top:12px">
          <div><label>Activo</label><select id="cm-activo" class="select"><option value="1">Sí</option><option value="0">No</option></select></div>
          <div><label>Notas</label><textarea id="cm-notas" class="input" rows="2"></textarea></div>
        </div>
      </form>
    </div>
    <div class="modal-foot">
      <button type="button" class="btn-cancel" onclick="closeCouponModal()">Cancelar</button>
      <button type="submit" form="cm-form" class="btn-save"><span class="material-symbols-outlined">save</span>Guardar</button>
    </div>
  </div>
</div>

<script>
  // ====== Sidebar móvil ======
  const burger = document.getElementById('burger');
  const sidebar = document.getElementById('sidebar');
  const backdropNav = document.getElementById('backdropNav');
  burger?.addEventListener('click', ()=>{ sidebar.classList.toggle('open'); backdropNav.classList.toggle('show', sidebar.classList.contains('open')); });
  backdropNav?.addEventListener('click', ()=>{ sidebar.classList.remove('open'); backdropNav.classList.remove('show'); });

  // ====== Toast ======
  function toast(msg='Saved'){ const t=document.getElementById('toast'); t.textContent=msg; t.style.opacity=1; t.style.transform='translateY(0)'; setTimeout(()=>{t.style.opacity=0;t.style.transform='translateY(8px)';},1400); }

  // ====== Rutas ======
  const routes = {
    index:  "{{ route('admin.cupones.index') }}",
    store:  "{{ route('admin.cupones.store') }}",
    show:   (id)=> "{{ route('admin.cupones.show',0) }}".replace('/0','/'+id),
    update: (id)=> "{{ route('admin.cupones.update',0) }}".replace('/0','/'+id),
    toggle: (id)=> "{{ route('admin.cupones.toggle',0) }}".replace('/0','/'+id),
    destroy:(id)=> "{{ route('admin.cupones.destroy',0) }}".replace('/0','/'+id),
  };
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // ====== Filtro en vivo ======
  const qInput = document.getElementById('q');
  function cleanTxt(s=''){ return String(s).normalize('NFD').replace(/[\u0300-\u036f]/g,'').toLowerCase().trim(); }
  function filterRowsRealtime(){
    const q=cleanTxt(qInput.value); const rows=document.querySelectorAll('.cupon-row'); if(!rows.length) return;
    rows.forEach(row=>{
      const cod=cleanTxt(row.dataset.codigo), nom=cleanTxt(row.dataset.nombre), tipo=cleanTxt(row.dataset.tipo), val=cleanTxt(row.dataset.valorText||'');
      const match=!q || cod.includes(q) || nom.includes(q) || tipo.includes(q) || val.includes(q);
      row.style.display = match ? '' : 'none';
    });
  }
  qInput?.addEventListener('input', filterRowsRealtime);
  window.addEventListener('DOMContentLoaded', filterRowsRealtime);

  // ====== Aside derecho ======
  let currentId = null;

  function selectRow(rowEl){
    currentId = rowEl.dataset.id;
    document.querySelectorAll('.cupon-row').forEach(x=>x.classList.remove('is-active'));
    rowEl.classList.add('is-active');

    // chips
    const activo = Number(rowEl.dataset.activo)===1;
    const ventana = Number(rowEl.dataset.ventana)===1;
    const adActivo = document.getElementById('adActivo');
    adActivo.textContent = activo ? 'Activo' : 'Inactivo';
    adActivo.className = 'badge ' + (activo ? 'b-act' : 'b-inact');
    document.getElementById('adVentana').style.display = activo ? 'inline-block' : 'none';
    document.getElementById('adVentana').textContent = ventana ? 'En ventana' : 'Fuera de ventana';

    // encabezado
    document.getElementById('adCodigo').textContent = rowEl.dataset.codigo || '—';
    document.getElementById('adNombre').textContent = rowEl.dataset.nombre || '—';
    document.getElementById('adTipoValor').textContent = (rowEl.dataset.tipo||'').toUpperCase() + ' · ' + (rowEl.dataset.valorText || '—');

    // kpis
    document.getElementById('adEmitidos').textContent = rowEl.dataset.emitidos || '0';
    document.getElementById('adReclamados').textContent = rowEl.dataset.reclamados || '0';
    document.getElementById('adReservas').textContent = rowEl.dataset.reservas || '0';
    document.getElementById('adDisponibles').textContent = rowEl.dataset.disponibles || '0';

    // restricciones
    document.getElementById('adInicia').textContent = rowEl.dataset.inicia || '—';
    document.getElementById('adCaduca').textContent = rowEl.dataset.caduca || '—';
    document.getElementById('adMin').textContent = rowEl.dataset.min_subtotalUi ? 'S/ '+Number(rowEl.dataset.min_subtotalUi).toFixed(2) : '—';
    document.getElementById('adPorUsuario').textContent = rowEl.dataset.por_usuario || '—';
    document.getElementById('adSoloSub').textContent = Number(rowEl.dataset.solo_subtotal)===1 ? 'Sí' : 'No';
    document.getElementById('adDuracion').textContent = (rowEl.dataset.duracion||'—') + ' min';
    document.getElementById('adNotas').textContent = rowEl.dataset.notas || '—';
  }

  document.querySelectorAll('.cupon-row').forEach(row=>{
    row.addEventListener('click',(e)=>{ if(e.target.closest('.actions')) return; selectRow(row); });
    const btn=row.querySelector('.btn-3dots'); const menu=row.querySelector('.menu');
    btn.addEventListener('click',ev=>{
      ev.stopPropagation(); document.querySelectorAll('.menu').forEach(m=>m.style.display='none');
      menu.style.display='block'; document.addEventListener('click',()=> menu.style.display='none',{once:true});
    });
    const verBtn=row.querySelector('[data-action="ver"]');
    verBtn.addEventListener('click',ev=>{ ev.stopPropagation(); selectRow(row); menu.style.display='none'; });
  });

  window.addEventListener('DOMContentLoaded', ()=>{
    const first=document.querySelector('.cupon-row'); if(first) selectRow(first);
  });

  // ====== Modal crear/editar ======
  function openCouponModal(id=null){
    resetForm(); syncValorHelp();
    document.body.style.overflow = "hidden";
    const bd=document.getElementById('cup-modal');
    if(id){
      document.getElementById('cm-title').textContent = 'Editar cupón #'+id;
      document.getElementById('cm-id').value = id;
      // usa /show para rellenar con valores exactos (evita problemas de dataset)
      fetch(routes.show(id), {headers:{'Accept':'application/json'}})
        .then(r=>r.json())
        .then(({cupon})=>{
          set('cm-codigo', cupon.codigo);
          set('cm-nombre', cupon.nombre||'');
          set('cm-tipo', cupon.tipo);
          set('cm-valor', cupon.tipo==='fixed' ? (cupon.valor/100).toFixed(2) : cupon.valor);
          set('cm-emitidos', cupon.emitidos);
          set('cm-por_usuario', cupon.por_usuario||1);
          set('cm-min', cupon.min_subtotal ? (cupon.min_subtotal/100).toFixed(2) : '');
          set('cm-solo', cupon.aplica_solo_subtotal ? 1 : 0);
          set('cm-inicia', cupon.inicia_at ? cupon.inicia_at.substring(0,16) : '');
          set('cm-caduca', cupon.caduca_at ? cupon.caduca_at.substring(0,16) : '');
          set('cm-duracion', cupon.duracion_minutos||20);
          set('cm-activo', cupon.activo ? 1 : 0);
          set('cm-notas', cupon.notas||'');
          syncValorHelp();
          bd.classList.add('open');
        })
        .catch(()=> toast('No se pudo cargar'));
    }else{
      document.getElementById('cm-title').textContent = 'Nuevo cupón';
      bd.classList.add('open');
    }
  }
  function closeCouponModal(){ document.body.style.overflow = ""; document.getElementById('cup-modal').classList.remove('open'); }
  function set(id,v){ const el=document.getElementById(id); if(el) el.value=v??''; }
  function resetForm(){
    ['cm-id','cm-codigo','cm-nombre','cm-valor','cm-emitidos','cm-por_usuario','cm-min','cm-inicia','cm-caduca','cm-duracion','cm-notas'].forEach(i=>set(i,''));
    set('cm-tipo','percent'); set('cm-solo','1'); set('cm-activo','1'); set('cm-duracion','20'); set('cm-emitidos','1'); set('cm-por_usuario','1');
  }
  function syncValorHelp(){
    const tipo=document.getElementById('cm-tipo').value;
    document.getElementById('lbl-valor').innerText = tipo==='percent' ? 'Valor (%)' : 'Valor (S/)';
    document.getElementById('help-valor').innerHTML = tipo==='percent' ? 'En <b>percent</b>, 0..100.' : 'En <b>fixed</b>, monto en S/. (decimal).';
  }

  function payload(){
    return {
      codigo: document.getElementById('cm-codigo').value.trim(),
      nombre: document.getElementById('cm-nombre').value.trim(),
      tipo: document.getElementById('cm-tipo').value,
      valor: document.getElementById('cm-valor').value,             // backend convierte a centavos si fixed
      emitidos: Number(document.getElementById('cm-emitidos').value||1),
      por_usuario: Number(document.getElementById('cm-por_usuario').value||1),
      min_subtotal: document.getElementById('cm-min').value,        // backend convierte a centavos
      aplica_solo_subtotal: Number(document.getElementById('cm-solo').value||1),
      inicia_at: document.getElementById('cm-inicia').value || null,
      caduca_at: document.getElementById('cm-caduca').value || null,
      duracion_minutos: Number(document.getElementById('cm-duracion').value||20),
      activo: Number(document.getElementById('cm-activo').value||1),
      notas: document.getElementById('cm-notas').value || null,
    };
  }

  async function saveCup(){
    const id=document.getElementById('cm-id').value;
    const body=payload();
    const url = id ? routes.update(id) : routes.store;
    const method = id ? 'PATCH' : 'POST';
    try{
      const r=await fetch(url,{method,headers:{'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':csrf},body:JSON.stringify(body)});
      const data = await r.json().catch(()=> ({}));
      if(!r.ok){ throw new Error(data?.message || 'Error al guardar'); }
      toast('Guardado'); closeCouponModal(); location.href = routes.index; // recarga para simplificar
    }catch(e){ toast(e.message); }
  }

  // ====== Acciones rápidas ======
  function copyCodigo(){
    const el=document.querySelector('.cupon-row.is-active'); if(!el) return;
    const code=el.dataset.codigo||''; navigator.clipboard.writeText(code).then(()=>toast('Código copiado'));
  }
  function toggleCup(id){
    fetch(routes.toggle(id),{method:'PATCH',headers:{'X-CSRF-TOKEN':csrf}})
      .then(r=>r.ok?r.json():Promise.reject()).then(()=>location.href=routes.index).catch(()=>toast('No se pudo cambiar estado'));
  }
  function delCup(id){
    if(!confirm('¿Eliminar este cupón?')) return;
    fetch(routes.destroy(id),{method:'DELETE',headers:{'X-CSRF-TOKEN':csrf,'Accept':'application/json'}})
      .then(async r=>{ const d=await r.json().catch(()=>({})); if(!r.ok) throw new Error(d?.msg||'No se pudo eliminar'); location.href=routes.index; })
      .catch(e=> toast(e.message));
  }
</script>
</body>
</html>
