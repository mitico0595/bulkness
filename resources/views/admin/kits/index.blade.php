{{-- resources/views/admin/kits/index.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Kits | Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @include ('global.icon')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <style>
    :root{
      --bg:#f6f7fb; --panel:#ffffff; --muted:#7b8aa3; --text:#1f2937; --sub:#0f172a; --border:#e5e7eb;
      --shadow:0 10px 30px rgba(32,41,63,.08); --radius:14px; --r8:10px;
      --accent:#fb4949; --accent-2:#ff1e1e; --accent-3:#ff4a4a;
      --good:#16a34a; --bad:#e11d48; --info:#2563eb;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;background:var(--bg);color:var(--text)}
    a{color:inherit;text-decoration:none}

    .app{display:grid;grid-template-columns:260px 1fr;min-height:100vh}
    .wrap{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1fr 360px;gap:18px}

    .sidebar{color:#fff;padding:24px 16px;position:sticky;top:0;height:100vh;z-index:40}
    .sidebar .inner{height:100%;display:flex;flex-direction:column;justify-content:center;
      background:linear-gradient(180deg, var(--accent) 0%, var(--accent-2) 50%, var(--accent-3) 100%);
      padding:20px;border-radius:20px}
    .brand{display:flex;align-items:center;gap:10px;margin-bottom:24px;position:absolute;top:30px}
    .brand a img{width:120px;max-width:100%}
    .nav{display:flex;flex-direction:column;gap:6px}
    .nav a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:#ffe9e2;opacity:.95}
    .nav a.active,.nav a:hover{background:rgba(255,255,255,.34);color:#fff}
    .sb-foot{color:#ffe9e2;opacity:.85;font-size:12px;text-align:center;position:absolute;bottom:35px;right:28px}
    .backdrop-nav{display:none;position:fixed;inset:0;background:rgba(15,23,42,.45);z-index:35}

    .topbar{top:0;z-index:30;background:#fff;border-bottom:1px solid var(--border);
      display:flex;align-items:center;justify-content:space-between;padding:12px 18px}
    .left{display:flex;align-items:center;gap:10px}
    .burger{display:none}
    @media (max-width:760px){ .burger{display:inline-grid;place-items:center;width:40px;height:40px;border:1px solid var(--border);border-radius:10px;background:#fff;cursor:pointer} }
    .page-title{font-weight:800}
    .sub{color:var(--muted);font-size:13px}
    .user{display:flex;align-items:center;gap:10px}
    .avatar{width:36px;height:36px;border-radius:10px;background:#ffd4d4;color:#b40909;display:grid;place-items:center;font-weight:800}

    .topbar-2{margin:20px;top:25px;border-radius:15px;margin-top:0;background:rgba(256,256,256,.55);backdrop-filter:blur(3px);
      display:flex;align-items:center;justify-content:space-between;padding:12px 16px;border:1px solid var(--border);position:sticky}

    .search-wrap{position:relative;min-width:280px}
    .search{width:100%;background:#fff;border:1px solid var(--border);border-radius:12px;padding:12px 44px 12px 14px;font-size:14px;box-shadow:var(--shadow)}
    .search-ico{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:32px;height:32px;border-radius:10px;background:linear-gradient(180deg,var(--accent),var(--accent-2));display:grid;place-items:center;color:#fff;font-weight:800}
    .btn{border:0;border-radius:12px;padding:10px 14px;font-weight:600;cursor:pointer}
    .btn-ghost{background:#fff;border:1px solid var(--border)}
    .btn-primary{background:linear-gradient(180deg,var(--accent),var(--accent-2));color:#fff}

    .panel{padding:14px}
    .thead{display:grid;grid-template-columns:16px 1.6fr 1fr 100px 70px 52px;gap:12px;padding:6px 6px 10px;color:var(--muted);font-size:12px;border-bottom:1px solid #eef2ff}
    .rows{display:flex;flex-direction:column;gap:12px}
    .row{cursor:pointer;background:white;border-radius:15px;display:grid;grid-template-columns:16px 1.6fr 1fr 100px 70px 52px;align-items:center;gap:12px;padding:12px 8px;border-top:1px solid #f1f5f9}
    .row:first-child{border-top:none}
    .row.is-active{background:#ff5959}
    .dot{width:8px;height:8px;border-radius:999px;background:#9ca3af}
    .thumb{width:42px;height:42px;border-radius:10px;background:#f3f4f6;object-fit:cover}
    .p-name{font-weight:800}
    .p-cat{color:#475569}
    .pill{display:inline-block;border-radius:999px;padding:4px 8px;font-size:12px;background:#eff6ff;color:#1e40af}
    .actions{position:relative;justify-self:end}
    .btn-3dots{all:unset;cursor:pointer;border-radius:10px;padding:6px;display:grid;place-items:center}
    .btn-3dots:hover{background:#f3f4f6}
    .menu{position:absolute;right:0;top:36px;background:#fff;border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow);min-width:180px;padding:6px;display:none;z-index:5}
    .menu button{all:unset;display:flex;align-items:center;gap:8px;width:100%;padding:10px;border-radius:8px;cursor:pointer;color:#374151}
    .menu button:hover{background:#f3f4f6}

    .aside{display:flex;flex-direction:column;gap:14px;padding-top:40px}
    .card{background:#fff;border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);padding:14px}
    .card h4{margin:0 0 12px;font-size:15px}
    .kv{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    .kv-row{display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:14px}
    .key{color:var(--muted)}
    .imgbox{display:flex;gap:12px;align-items:center}
    .imgbox .big{width:92px;height:92px;border-radius:14px;border:1px solid var(--border);object-fit:cover;background:#f8fafc}
    .mini{display:flex;flex-wrap:wrap;gap:8px}
    .mini img{width:42px;height:42px;border-radius:10px;object-fit:cover;border:1px solid var(--border);background:#f8fafc}

    .pager{display:flex;align-items:center;justify-content:space-between;margin-top:14px;gap:10px}

    @media (max-width:1100px){
      .app{grid-template-columns:1fr}
      .sidebar{position:fixed;left:0;top:0;width:260px;height:100vh;transform:translateX(-100%);transition:transform .25s ease;padding:16px}
      .sidebar.open{transform:translateX(0)}
      .wrap{grid-template-columns:1fr}
      .topbar-2{margin:12px}
      .backdrop-nav.show{display:block}
      .thead{display:none}
      .row{grid-template-columns:16px 1fr;grid-auto-rows:auto}
      .row > *:nth-child(n+3){grid-column:span 2}
      .search-wrap{min-width:0;flex:1}
    }

    .backdrop{position:fixed;inset:0;background:rgba(0,0,0,.5);display:none;align-items:center;justify-content:center;z-index:100}
    .backdrop.open{display:flex}
    .modal{background:#fff;border:1px solid var(--border);border-radius:16px;box-shadow:0 20px 50px rgba(0,0,0,.25);width:min(980px,95vw);max-height:90vh;display:flex;flex-direction:column;overflow:hidden}
    .modal-head{position:sticky;top:0;display:flex;align-items:center;justify-content:space-between;padding:18px 20px;border-bottom:1px solid var(--border);background:#f8fafc}
    .modal-title{font-weight:800;font-size:20px;margin:0}
    .modal-close{border:0;background:transparent;padding:8px;border-radius:10px;cursor:pointer}
    .modal-close:hover{background:#eaeef6}
    .modal-body{padding:18px;overflow:auto;max-height:calc(90vh - 120px)}
    .modal-foot{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-top:1px solid var(--border);background:#f8fafc}
    label{display:block;font-size:13px;color:#374151;margin-bottom:4px}
    .inp{width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:12px;background:#fff}

    .list-suggest{position:absolute;inset:auto 0 0 0;transform:translateY(100%);background:#fff;border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow);max-height:240px;overflow:auto;display:none;z-index:20}
    .item-suggest{display:flex;align-items:center;gap:10px;padding:8px 10px;border-bottom:1px solid #f3f4f6;cursor:pointer}
    .item-suggest:last-child{border-bottom:none}
    .item-suggest:hover{background:#f8fafc}

    .comp-row{display:grid;grid-template-columns:1fr 80px 40px;gap:8px;align-items:center}
    .xbtn{border:none;background:#fff;border:1px solid var(--border);padding:8px;border-radius:10px;cursor:pointer}
  </style>
</head>
<body>
<div class="app">
  <aside class="sidebar" id="sidebar">
    <div class="inner">
      <div>
        <div class="brand">
          <a href="{{asset('/')}}"><img src="{{asset('image/logo1_BN.png')}}" alt="Adler"></a>
        </div>
        <nav class="nav">
          <a href="{{route('admin.dashboard')}}" ><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
          <a href="{{ route('admin.ventas.index') }}"><span class="material-symbols-outlined">attach_money</span>Ventas</a>
          <a href="{{ url('admin/envios') }}"><span class="material-symbols-outlined">local_shipping</span>Envíos</a>
          <a href="{{ route('admin.compras.index') }}"><span class="material-symbols-outlined">shopping_cart</span>Compras</a>
          <a href="{{ route('admin.products.index')}}"><span class="material-symbols-outlined">barcode_scanner</span>Inventario</a>
          <a class="active" href="{{ route('admin.kits.index') }}"><span class="material-symbols-outlined">widgets</span>Kits</a>
          <a href="{{ route('admin.cupones.index') }}"><span class="material-symbols-outlined">confirmation_number</span>Cupones</a>
          
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

  <main class="main">
    <div class="topbar" style="background:none;box-shadow:none;border:none;margin-top:8px">
      <div class="left"><button class="burger" id="burger" aria-label="Abrir menú">☰</button></div>
      <div class="user" style="padding:10px;background:linear-gradient(180deg,var(--accent) 0%,var(--accent-2) 50%,var(--accent-3) 100%);border-radius:15px;color:white;">
        <div class="avatar" title="{{ Auth::user()->name ?? 'Admin' }}" style="background:none;color:wheat">{{ strtoupper(mb_substr(Auth::user()->name ?? 'A',0,1)) }}</div>
        <div style="display:flex;flex-direction:column;line-height:1"><strong>Admin</strong><span class="sub" style="color:wheat">{{ Auth::user()->email ?? '' }}</span></div>
      </div>
    </div>

    <div class="topbar-2">
      <div>
        <div class="page-title">Kits</div>
        <div class="sub">{{ $kits->total() }} kits encontrados</div>
      </div>
      <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap">
        <form method="get" action="{{ route('admin.kits.index') }}" style="display:flex;align-items:center;gap:10px">
          <div class="search-wrap">
            <input id="q" class="search" type="text" name="q" placeholder="Buscar por producto principal..." value="{{ $q ?? '' }}">
            <span class="search-ico">⌕</span>
          </div>
          <a class="btn btn-ghost" href="{{ route('admin.kits.index') }}"><span class="material-symbols-outlined">cleaning_services</span></a>
        </form>
        <button class="btn btn-primary" type="button" onclick="openKitModal()">Crear kit</button>
      </div>
    </div>

    <div class="wrap">
      <section class="panel">
        <div class="thead">
          <div></div><div>Kit (principal)</div><div>Categoría</div><div>Items</div><div>ID</div><div></div>
        </div>
        <div class="rows" id="rows">
          @foreach($kits as $k)
          @php
            $p = $k->principal;
            $img = ($p->image ? asset('image/productos/'.$p->image) : ($p->thumb ? asset('image/productos/'.$p->thumb) : asset('image/productos/default.png')));
          @endphp
          <div class="row kit-row"
               data-id="{{ $k->id }}"
               data-principal-id="{{ $p->id }}"
               data-principal-name="{{ $p->name }}"
               data-principal-cat="{{ $p->categoria }}"
               data-principal-image="{{ $img }}"
               data-items-count="{{ $k->products->count() }}">
            <div class="dot"></div>
            <div style="display:flex;align-items:center;gap:10px">
              <img class="thumb" src="{{ $img }}" alt="">
              <div>
                <div class="p-name">{{ $k->name ?: $p->name }}</div>
                <div class="sub">Principal: {{ $p->name }}</div>
              </div>
            </div>
            <div class="p-cat">{{ $p->categoria }}</div>
            <div><span class="pill">{{ $k->products->count() }}</span></div>
            <div class="sub">{{ $k->id }}</div>
            <div class="actions">
              <button class="btn-3dots" aria-haspopup="menu" aria-expanded="false">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
                </svg>
              </button>
              <div class="menu" role="menu">
                <button data-action="ver" data-id="{{ $k->id }}">👁 Ver</button>
                <button onclick="openKitModal({{ $k->id }})">✏️ Editar</button>
                <button onclick="deleteKit({{ $k->id }})" style="color:#e11d48">🗑 Eliminar</button>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <div style="margin-top:12px">{{ $kits->onEachSide(1)->links('vendor.pagination.adler') }}</div>
      </section>

      <aside class="aside">
        <div class="card">
          <h4>Detalle del kit</h4>
          <div class="imgbox">
            <img id="kdImg" class="big" src="{{ asset('image/productos/default.png') }}" alt="">
            <div style="flex:1">
              <div id="kdName" style="font-weight:800;font-size:16px">Selecciona un kit</div>
              <div style="margin-top:4px"><span id="kdCat" class="pill">—</span></div>
              <div style="margin-top:6px;color:#64748b" id="kdId">—</div>
            </div>
          </div>
        </div>

        <div class="card">
          <h4>Principal</h4>
          <div class="kv">
            <div class="kv-row"><div class="key">Producto</div><div id="kpName">—</div></div>
            <div class="kv-row"><div class="key">Categoría</div><div id="kpCat">—</div></div>
            <div class="kv-row"><div class="key">Precio</div><div id="kpPrice">—</div></div>
          </div>
        </div>

        <div class="card">
          <h4>Componentes</h4>
          <div id="kThumbs" class="mini"></div>
        </div>
      </aside>
    </div>
  </main>
</div>

<div id="toast" style="position:fixed;right:16px;bottom:16px;background:#111827;color:#fff;padding:10px 12px;border-radius:10px;opacity:0;transform:translateY(8px);transition:all .2s;z-index:120">Saved</div>

{{-- MODAL crear/editar kit --}}
<div id="kit-modal" class="backdrop">
  <div class="modal">
    <div class="modal-head">
      <h3 id="km-title" class="modal-title">Nuevo kit</h3>
      <button class="modal-close" onclick="closeKitModal()"><span class="material-symbols-outlined">close</span></button>
    </div>
    <div class="modal-body">
      <form id="km-form" onsubmit="event.preventDefault(); kitSave();">
        <input type="hidden" id="km-id">

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">
          <div>
            <label>Nombre del kit (opcional)</label>
            <input id="km-name" class="inp" placeholder="Si lo dejas vacío, toma el del principal">
          </div>
          <div>
            <label>Precio override (opcional)</label>
            <input id="km-price" type="number" step="0.01" min="0" class="inp" placeholder="0.00">
          </div>
        </div>

        <div style="margin-top:16px">
          <label>Producto principal</label>
          <div class="search-wrap" style="position:relative">
            <input id="km-principal" class="inp" placeholder="Buscar producto...">
            <input type="hidden" id="km-principal-id">
            <div id="principal-list" class="list-suggest"></div>
          </div>
          <small class="sub">El principal es el que representará visualmente al kit.</small>
        </div>

        <div style="margin-top:20px">
          <label>Agregar componentes (productos de la tabla searches)</label>
          <div class="search-wrap" style="position:relative">
            <input id="km-comp-q" class="inp" placeholder="Buscar y hacer clic para añadir...">
            <div id="comp-list" class="list-suggest"></div>
          </div>
          <div id="km-comp-rows" style="display:flex;flex-direction:column;gap:8px;margin-top:10px"></div>
        </div>
      </form>
    </div>
    <div class="modal-foot">
      <button type="button" class="btn-ghost" onclick="closeKitModal()">Cancelar</button>
      <button type="submit" form="km-form" class="btn btn-primary"><span class="material-symbols-outlined">save</span> Guardar</button>
    </div>
  </div>
</div>

<script>
  const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const routes = {
    index:  "{{ route('admin.kits.index') }}",
    store:  "{{ route('admin.kits.store') }}",
    show:   (id) => "{{ route('admin.kits.show', 0) }}".replace('/0','/'+id),
    update: (id) => "{{ route('admin.kits.update', 0) }}".replace('/0','/'+id),
    destroy:(id) => "{{ route('admin.kits.destroy',0) }}".replace('/0','/'+id),
    find:   "{{ route('admin.kits.searches') }}",
  };

  function toast(msg='Saved'){
    const t=document.getElementById('toast');
    t.textContent=msg; t.style.opacity=1; t.style.transform='translateY(0)';
    setTimeout(()=>{ t.style.opacity=0; t.style.transform='translateY(8px)'; },1400);
  }

  // Sidebar móvil
  const burger = document.getElementById('burger');
  const sidebar = document.getElementById('sidebar');
  const backdropNav = document.getElementById('backdropNav');
  burger?.addEventListener('click', ()=>{ sidebar.classList.toggle('open'); backdropNav.classList.toggle('show', sidebar.classList.contains('open')); });
  backdropNav?.addEventListener('click', ()=>{ sidebar.classList.remove('open'); backdropNav.classList.remove('show'); });

  /* =================== Listado: selección y menú =================== */
  let currentKitId = null;

  function selectKitRow(rowEl){
    const id = rowEl.dataset.id;
    currentKitId = id;
    document.querySelectorAll('.kit-row').forEach(x=>x.classList.remove('is-active'));
    rowEl.classList.add('is-active');

    // aside inmediato
    document.getElementById('kdImg').src = rowEl.dataset.principalImage;
    document.getElementById('kdName').textContent = rowEl.querySelector('.p-name').textContent;
    document.getElementById('kdCat').textContent = rowEl.dataset.principalCat || '—';
    document.getElementById('kdId').textContent  = 'Kit #' + id;

    // carga completa para thumbs, precios, etc.
    fetch(routes.show(id), {headers:{'Accept':'application/json'}})
      .then(r=>r.json()).then(d=>{
        document.getElementById('kpName').textContent  = d.principal?.name || '—';
        document.getElementById('kpCat').textContent   = d.principal?.categoria || '—';
        document.getElementById('kpPrice').textContent = d.principal?.precio != null ? ('S/ ' + Number(d.principal.precio).toFixed(2)) : '—';
        const box = document.getElementById('kThumbs'); box.innerHTML = '';
        (d.items||[]).forEach(it=>{
          const img = document.createElement('img');
          img.src = it.search.image; img.title = it.search.name + ' x'+it.qty;
          box.appendChild(img);
        });
      }).catch(()=>{});
  }

  document.querySelectorAll('.kit-row').forEach(row=>{
    row.addEventListener('click', (e)=>{ if(e.target.closest('.actions')) return; selectKitRow(row); });
    const btn = row.querySelector('.btn-3dots');
    const menu = row.querySelector('.menu');
    btn.addEventListener('click', ev=>{
      ev.stopPropagation();
      document.querySelectorAll('.menu').forEach(m=>m.style.display='none');
      menu.style.display='block';
      document.addEventListener('click',()=> menu.style.display='none', {once:true});
    });
    row.querySelector('[data-action="ver"]').addEventListener('click', ev=>{
      ev.stopPropagation(); selectKitRow(row); menu.style.display='none';
    });
  });

  window.addEventListener('DOMContentLoaded', ()=>{ const first = document.querySelector('.kit-row'); if(first) selectKitRow(first); });

  /* =================== Modal Crear/Editar =================== */
  function openKitModal(id=null){
    document.body.style.overflow = "hidden";
    resetKitForm();
    const bd = document.getElementById('kit-modal');
    if(id){
      document.getElementById('km-title').textContent='Editar kit #' + id;
      document.getElementById('km-id').value = id;
      fetch(routes.show(id), {headers:{'Accept':'application/json'}})
        .then(r=>r.json()).then(fillKitForm)
        .then(()=> bd.classList.add('open'))
        .catch(()=>toast('Error al cargar'));
    } else {
      document.getElementById('km-title').textContent='Crear kit';
      bd.classList.add('open');
    }
  }
  function closeKitModal(){ document.body.style.overflow = ""; document.getElementById('kit-modal').classList.remove('open'); }
  function resetKitForm(){
    ['km-id','km-name','km-price','km-principal','km-principal-id','km-comp-q'].forEach(id=>{ const el=document.getElementById(id); if(el) el.value=''; });
    document.getElementById('km-comp-rows').innerHTML='';
    document.getElementById('principal-list').style.display='none';
    document.getElementById('comp-list').style.display='none';
  }
  function fillKitForm(d){
    document.getElementById('km-name').value  = d.name || '';
    document.getElementById('km-price').value = d.price || '';
    document.getElementById('km-principal').value = d.principal?.name || '';
    document.getElementById('km-principal-id').value = d.principal?.id || '';
    const wrap = document.getElementById('km-comp-rows');
    (d.items||[]).forEach(it=>{
      addCompRow({id: it.search.id, name: it.search.name, qty: it.qty});
    });
  }

  function addCompRow({id, name, qty=1}){
    if(!id || !name) return;
    // evita duplicados
    const exists = document.querySelector(`.comp-row[data-id="${id}"]`);
    if(exists){ const q = exists.querySelector('.qty'); q.value = parseInt(q.value||1)+parseInt(qty||1); return; }
    const row = document.createElement('div');
    row.className = 'comp-row'; row.dataset.id = id;
    row.innerHTML = `
      <input class="inp" value="${name}" disabled>
      <input class="inp qty" type="number" min="1" value="${qty}">
      <button type="button" class="xbtn" title="Quitar">✕</button>
    `;
    row.querySelector('.xbtn').addEventListener('click', ()=> row.remove());
    document.getElementById('km-comp-rows').appendChild(row);
  }

  function kitSerialize(){
    const id  = document.getElementById('km-id').value;
    const nm  = document.getElementById('km-name').value.trim();
    const pr  = document.getElementById('km-price').value;
    const ps  = parseFloat(pr);
    const sid = parseInt(document.getElementById('km-principal-id').value||0);
    const items = Array.from(document.querySelectorAll('#km-comp-rows .comp-row')).map(r=>({
      search_id: parseInt(r.dataset.id),
      qty: Math.max(1, parseInt(r.querySelector('.qty').value || 1))
    }));
    return {
      id: id || null,
      name: nm || null,
      price: isFinite(ps) ? ps : null,
      search_id: sid,
      items
    };
  }

  async function kitSave(){
    const payload = kitSerialize();
    if(!payload.search_id){ toast('Selecciona el producto principal'); return; }
    const isEdit = !!payload.id;
    const url = isEdit ? routes.update(payload.id) : routes.store;
    const method = isEdit ? 'PUT' : 'POST';
    try{
      const res = await fetch(url, {
        method, headers:{'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':csrf},
        body: JSON.stringify(payload)
      });
      if(!res.ok){ const d=await res.json().catch(()=>({})); toast(d.message || 'Error al guardar'); return; }
      const json = await res.json();
      upsertRow(json.item);
      closeKitModal();
      toast(isEdit ? 'Kit actualizado' : 'Kit creado');
    }catch(e){ toast('Network error'); }
  }

  async function deleteKit(id){
    if(!confirm('¿Eliminar kit?')) return;
    try{
      const res=await fetch(routes.destroy(id), {method:'DELETE', headers:{'Accept':'application/json','X-CSRF-TOKEN':csrf}});
      if(!res.ok){ toast('No se pudo eliminar'); return; }
      const row=document.querySelector(`.kit-row[data-id="${id}"]`); if(row) row.remove();
      toast('Eliminado');
    }catch(e){ toast('Network error'); }
  }

  function rowTemplate(k){
    const img = k.principal?.image || "{{ asset('image/productos/default.png') }}";
    return `
      <div class="row kit-row"
           data-id="${k.id}"
           data-principal-id="${k.principal?.id||''}"
           data-principal-name="${k.principal?.name||''}"
           data-principal-cat="${k.principal?.categoria||''}"
           data-principal-image="${img}"
           data-items-count="${k.items_count||0}">
        <div class="dot"></div>
        <div style="display:flex;align-items:center;gap:10px">
          <img class="thumb" src="${img}" alt="">
          <div>
            <div class="p-name">${k.name || (k.principal?.name||'Kit')}</div>
            <div class="sub">Principal: ${k.principal?.name||'—'}</div>
          </div>
        </div>
        <div class="p-cat">${k.principal?.categoria||''}</div>
        <div><span class="pill">${k.items_count||0}</span></div>
        <div class="sub">${k.id}</div>
        <div class="actions">
          <button class="btn-3dots" aria-haspopup="menu" aria-expanded="false">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
            </svg>
          </button>
          <div class="menu" role="menu">
            <button data-action="ver" data-id="${k.id}">👁 Ver</button>
            <button onclick="openKitModal(${k.id})">✏️ Editar</button>
            <button onclick="deleteKit(${k.id})" style="color:#e11d48">🗑 Eliminar</button>
          </div>
        </div>
      </div>`;
  }

  function upsertRow(k){
    const list=document.getElementById('rows');
    let row=list.querySelector(`.kit-row[data-id="${k.id}"]`);
    if(!row){
      const w=document.createElement('div'); w.innerHTML=rowTemplate(k);
      row = w.firstElementChild; list.prepend(row);
      // bind
      row.addEventListener('click',(e)=>{ if(!e.target.closest('.actions')) selectKitRow(row); });
      row.querySelector('.btn-3dots').addEventListener('click', ev=>{
        ev.stopPropagation();
        const menu=row.querySelector('.menu');
        document.querySelectorAll('.menu').forEach(m=>m.style.display='none');
        menu.style.display='block';
        document.addEventListener('click',()=> menu.style.display='none', {once:true});
      });
      row.querySelector('[data-action="ver"]').addEventListener('click', ev=>{
        ev.stopPropagation(); selectKitRow(row); row.querySelector('.menu').style.display='none';
      });
      return;
    }
    // update
    row.querySelector('.p-name').textContent = k.name || (k.principal?.name||'Kit');
    row.dataset.principalId    = k.principal?.id||'';
    row.dataset.principalName  = k.principal?.name||'';
    row.dataset.principalCat   = k.principal?.categoria||'';
    row.dataset.principalImage = k.principal?.image||'';
    row.dataset.itemsCount     = k.items_count||0;
    row.querySelector('.p-cat').textContent = k.principal?.categoria || '';
    row.querySelector('.pill').textContent  = k.items_count||0;
    const img = k.principal?.image || "{{ asset('image/productos/default.png') }}";
    row.querySelector('.thumb').src = img;
    // refresca aside si es el seleccionado
    if(currentKitId && String(currentKitId) === String(k.id)) selectKitRow(row);
  }

  /* =================== Buscadores AJAX =================== */
  let findTimer = null;
  function findSearches(q, excludeIds=[], cb){
    clearTimeout(findTimer);
    findTimer = setTimeout(()=>{
      const url = new URL(routes.find, window.location.origin);
      url.searchParams.set('q', q||'');
      if(excludeIds.length) url.searchParams.set('exclude', excludeIds.join(','));
      fetch(url.toString(), {headers:{'Accept':'application/json'}})
        .then(r=>r.json()).then(cb).catch(()=>cb({data:[]}));
    }, 180);
  }

  // principal
  const inpP = document.getElementById('km-principal');
  const listP= document.getElementById('principal-list');
  inpP.addEventListener('input', ()=>{
    const q = inpP.value.trim();
    findSearches(q, [], (res)=>{
      listP.innerHTML = '';
      (res.data||[]).forEach(it=>{
        const div = document.createElement('div'); div.className='item-suggest';
        div.innerHTML = `<img src="${it.image}" style="width:36px;height:36px;border-radius:8px;object-fit:cover"> <div style="flex:1"><div style="font-weight:700">${it.name}</div><div class="sub">${it.codigo||''} · ${it.categoria||''}</div></div><div>S/ ${Number(it.precio||0).toFixed(2)}</div>`;
        div.addEventListener('click', ()=>{
          document.getElementById('km-principal-id').value = it.id;
          inpP.value = it.name;
          listP.style.display='none';
        });
        listP.appendChild(div);
      });
      listP.style.display = (res.data||[]).length ? 'block' : 'none';
    });
  });
  inpP.addEventListener('blur', ()=> setTimeout(()=> listP.style.display='none', 120));

  // componentes
  const inpC = document.getElementById('km-comp-q');
  const listC= document.getElementById('comp-list');
  function currentCompIds(){
    const ids = Array.from(document.querySelectorAll('#km-comp-rows .comp-row')).map(r=>parseInt(r.dataset.id));
    const principalId = parseInt(document.getElementById('km-principal-id').value||0);
    if(principalId) ids.push(principalId);
    return ids.filter(Boolean);
  }
  inpC.addEventListener('input', ()=>{
    const q = inpC.value.trim();
    findSearches(q, currentCompIds(), (res)=>{
      listC.innerHTML = '';
      (res.data||[]).forEach(it=>{
        const div = document.createElement('div'); div.className='item-suggest';
        div.innerHTML = `<img src="${it.image}" style="width:36px;height:36px;border-radius:8px;object-fit:cover"> <div style="flex:1"><div style="font-weight:700">${it.name}</div><div class="sub">${it.codigo||''} · ${it.categoria||''}</div></div><div>S/ ${Number(it.precio||0).toFixed(2)}</div>`;
        div.addEventListener('click', ()=>{
          addCompRow({id: it.id, name: it.name, qty: 1});
          listC.style.display='none';
          inpC.value='';
        });
        listC.appendChild(div);
      });
      listC.style.display = (res.data||[]).length ? 'block' : 'none';
    });
  });
  inpC.addEventListener('blur', ()=> setTimeout(()=> listC.style.display='none', 120));
</script>
</body>
</html>
