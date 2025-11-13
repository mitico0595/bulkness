<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios | Admin</title>
  @include ('global.icon')
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <style>
    :root{
      --bg:#f6f7fb; --panel:#ffffff; --muted:#7b8aa3; --text:#1f2937; --sub:#0f172a;
      --border:#e5e7eb; --shadow:0 10px 30px rgba(32,41,63,.08);
      --radius:14px; --r8:10px; --accent:#ff4242; --accent-2:#c21a1a;
      --good:#16a34a; --bad:#e11d48; --info:#2563eb;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif;background:var(--bg);color:var(--text)}
    a{color:inherit;text-decoration:none}

    /* Layout */
    .app{display:grid;grid-template-columns:260px 1fr;min-height:100vh}
    .wrap{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1fr 360px;gap:18px}

    /* Sidebar */
    .sidebar{color:#fff; padding:24px 16px}
    .brand{display:flex;align-items:center;gap:10px;margin-bottom:24px}
    .nav{display:flex;flex-direction:column;gap:6px}
    .nav a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:#363636;opacity:.95}
    .nav a.active,.nav a:hover{background:rgba(255,255,255,.34);color:#aaaaaa}

    /* Topbar */
    .topbar{position:sticky; top:0; z-index:30; background:#fff; border-bottom:1px solid var(--border);
      display:flex; align-items:center; justify-content:space-between; padding:12px 18px}
    .user{display:flex;align-items:center;gap:10px}
    .avatar{width:36px;height:36px;border-radius:10px;background:#ffd4d4;color:#b40909;display:grid;place-items:center;font-weight:800}
    .page-title{font-weight:800}
    .sub{color:var(--muted);font-size:13px}
    .burger{display:none}

    /* Buscador y botones */
    .search-wrap{position:relative;min-width:320px}
    .search{width:100%;background:#fff;border:1px solid var(--border);border-radius:12px;padding:12px 44px 12px 14px;font-size:14px;box-shadow:var(--shadow)}
    .search-ico{position:absolute;right:8px;top:50%;transform:translateY(-50%);width:32px;height:32px;border-radius:10px;background:#ffebb0;display:grid;place-items:center;color:#fff;font-weight:800}
    .btn{border:0;border-radius:12px;padding:10px 14px;font-weight:600;cursor:pointer}
    .btn-ghost{background:#fff;border:1px solid var(--border)}
    .btn-primary{background:#ffebb0;color:#fff}
    .btn-primary:hover{filter:brightness(.97)}

    /* Lista izquierda (usuarios) */
    .panel{padding:14px}
    .thead{display:grid;grid-template-columns:16px 160px 1fr 90px 1fr 120px 52px;gap:12px;padding:6px 6px 10px;color:var(--muted);font-size:12px;border-bottom:1px solid #eef2ff}
    .rows{display:flex;flex-direction:column;gap:12px}
    .row{cursor:pointer;background:white;border-radius:15px;display:grid;grid-template-columns:16px 160px 1fr 90px 1fr 120px 52px;align-items:center;gap:12px;padding:12px 8px;border-top:1px solid #f1f5f9}
    .row:first-child{border-top:none;background:white;border-radius:15px}
    .row.is-active{background:#ffebb0;color:#fff}
    .row.banned{background:#f3f4f6}
    .dot{border-radius:999px;background:#9ca3af;}
    .name{font-weight:800}
    .email{color:#374151}
    .role{font-weight:600;color:#ff6b3d;background:#fff3ed;border:1px solid #ffd7c7;padding:4px 10px;border-radius:999px;justify-self:start}
    .total{color:#0f172a;font-weight:800; text-align:right}
    .status{justify-self:start;border-radius:999px;padding:6px 10px;font-size:12px;font-weight:700}
    .st-activo{background:#eef2ff;color:#3730a3}
    .st-ban{background:#ffecef;color:#e11d48}
    .actions{position:relative;justify-self:end}
    .btn-3dots{all:unset;cursor:pointer;border-radius:10px;padding:6px;display:grid;place-items:center}
    .btn-3dots:hover{background:#f3f4f6}
    .menu{position:absolute;right:0;top:36px;background:#fff;border:1px solid var(--border);border-radius:12px;box-shadow:var(--shadow);min-width:160px;padding:6px;display:none;z-index:5}
    .menu button{all:unset;display:flex;align-items:center;gap:8px;width:100%;padding:10px;border-radius:8px;cursor:pointer;color:#374151}
    .menu button:hover{background:#f3f4f6}

    /* Aside derecho */
    .aside{display:flex;flex-direction:column;gap:14px}
    .card{background:#fff;border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);padding:14px}
    .card h4{margin:0 0 12px;font-size:15px}
    .kv{display:grid;grid-template-columns:1fr 1fr;gap:10px}
    .kv-row{display:grid;grid-template-columns:1fr 1fr;gap:8px;font-size:14px}
    .key{color:var(--muted)}
    .avatar-big{width:80px;height:80px;border-radius:20px;background:#111827;color:#fff;display:grid;place-items:center;font-size:28px;font-weight:800}

    /* Modales (reusamos tu funcionalidad) */
    .backdrop{position:fixed;inset:0;background:rgba(15,23,42,.45);display:none;align-items:center;justify-content:center;padding:20px;z-index:60}
    .modal{background:#fff;border-radius:16px;max-width:920px;width:100%;max-height:90vh;overflow:auto;border:1px solid var(--border);box-shadow:var(--shadow)}
    .modal-hd{display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-bottom:1px solid var(--border)}
    .modal-bd{padding:16px}
    .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .input{width:100%;border:1px solid var(--border);border-radius:10px;padding:10px}
    .select{width:100%;border:1px solid var(--border);border-radius:10px;padding:10px;background:#fff}

    /* Responsive principales */
    @media (max-width:1100px){ .app{grid-template-columns:1fr} .sidebar{display:none} .wrap{grid-template-columns:1fr} }
    @media (max-width:760px){
      .topbar{padding:10px 12px}
      .wrap{grid-template-columns:1fr; gap:12px; padding:0 12px}
      .thead{display:none}
      .row{grid-template-columns:1fr; gap:8px; padding:12px; border:1px solid #eef2ff}
      .total{text-align:left}
      .kv{grid-template-columns:1fr}
      .form-grid{grid-template-columns:1fr}
    }

    /* Sidebar estable desktop */
    @media (min-width:1101px){
      .app{grid-template-columns: 260px 1fr !important;}
      .sidebar{
        display:block !important; position:sticky !important; top:0 !important; height:100vh !important;
        width:260px !important; min-width:260px !important; transform:none !important;
        overflow-y:auto !important; padding:24px 16px !important; border-radius:0 !important;
      }
    }
    html, body{ overflow-x:hidden; }
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
    .sb-foot{color:#ffe9e2;opacity:.85;font-size:12px;text-align:center;position: absolute;    bottom: 5px;    right: 28px;}
  </style>
</head>
<body>
  <div class="app">
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
      <div class="inner" style="border-radius:20px;padding:15px;position:relative;height:100%;display:flex;flex-direction:column;justify-content:center;background:#ffebb0">
        <div class="brand" style="position:absolute;top:10px;left:15px">
          <a href="{{asset('/')}}"><img src="{{asset('image/logo.webp')}}" alt="" style="width:50%"></a>
        </div>
        <nav class="nav">
          <a href="{{route('admin.dashboard')}}" ><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
          <a href="{{ url('admin/ventas') }}"><span class="material-symbols-outlined">attach_money</span>Ventas</a>
          <a href="{{ url('admin/envios') }}" class=""><span class="material-symbols-outlined">local_shipping</span>Envíos</a>
          <a href="{{ route('admin.index_images.index') }}" ><span class="material-symbols-outlined">photo_library</span>Editor</a>
          <a href="#" ><span class="material-symbols-outlined">shopping_cart</span>Compras</a>
          <a href="{{ url('admin/productos') }}"><span class="material-symbols-outlined">barcode_scanner</span>Inventario</a>
          
          <a  href="#"><span class="material-symbols-outlined">confirmation_number</span>Cupones</a>
          <a href="{{ route('admin.usuarios.index') }}" class="active"><span class="material-symbols-outlined">contacts_product</span>Usuarios</a>
          
          <a href="{{ url('admin/config') }}"><span class="material-symbols-outlined">settings</span>Configuración</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
          <button type="submit" class="logout-btn" style=" cursor:pointer;color:white;   position: absolute; right: 25%;  background: none;  border: 1px solid white; padding: 10px;  width: 50%; border-radius: 10px; bottom: 35px;">
              Logout
          </button>
        </form>
        <div class="sb-foot">© {{ date('Y') }} {{env('DEVELOPER_NAME')}}</div>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="main">
      <!-- TOPBAR superior -->
      <div class="topbar" style="background:none;border:none;box-shadow:none;justify-content:flex-end;gap:20px;position:relative">
        <div class="page-title" style="background:#fff;border-radius:15px;padding:10px; height:56px; width:200px; display:grid;place-content:center">
          <div>Usuarios</div>
          <div class="sub" style="text-align:center">{{ count($personas) }} usuarios</div>
        </div>
        <div class="user" style="padding:10px;background:#ffebb0;border-radius:15px;color:white;">
          <div class="avatar" title="{{ Auth::user()->name ?? 'Admin' }}" style="background:none;color:#363636">
            {{ strtoupper(mb_substr(Auth::user()->name ?? 'A',0,1)) }}
          </div>
          <div style="display:flex;flex-direction:column;line-height:1">
            <strong>Admin</strong>
            <span class="sub" style="color:#363636">{{ Auth::user()->email ?? '' }}</span>
          </div>
        </div>
      </div>

      <!-- TOPBAR filtros -->
      <div class="topbar" style="margin:20px; top:20px; border-radius:15px; margin-top:0; background:rgba(256,256,256,.5); backdrop-filter: blur(3px);">
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;width:100%">
          <div class="search-wrap" style="flex:1 1 260px">
            <input id="searchInput" class="search" type="text" placeholder="Buscar usuarios... nombre, email, DNI">
            <span class="search-ico">⌕</span>
          </div>
          <button id="searchClear" class="btn btn-ghost" type="button" title="Limpiar"><span class="material-symbols-outlined">cleaning_services</span></button>
          <button id="btnExport" class="btn btn-ghost" type="button" onclick="window.print()" title="Imprimir"><span class="material-symbols-outlined">download</span></button>
          <button id="btnEditTop" class="btn btn-primary" type="button" style="display:flex;align-items:center">Editar seleccionado</button>
        </div>
      </div>

      <!-- GRID -->
      <div class="wrap">
        <!-- LISTA -->
        <section class="panel">
          <div class="thead">
            <div></div>
            <div>Nombre</div>
            <div>Email</div>
            <div>Órdenes</div>
            <div>Total</div>
            <div>Estado</div>
            <div></div>
          </div>

          <div class="rows" id="userList">
            @foreach($personas as $p)
              @php
                $banned = (bool)$p->ban;
                $tot = number_format((float)($p->total_gastado ?? 0), 2, '.', '');
                $rowPayload = [
                  'id'            => $p->id,
                  'name'          => $p->name,
                  'lastname'      => $p->lastname,
                  'email'         => $p->email,
                  'dni'           => $p->dni,
                  'cell'          => $p->cell,
                  'direccion'     => $p->direccion,
                  'ciudad'        => $p->ciudad,
                  'provincia'     => $p->provincia,
                  'distrito'      => $p->distrito,
                  'cumpleanos'    => $p->cumpleanos,
                  'type'          => $p->type,
                  'role_label'    => $p->role_label,
                  'ban'           => (bool)$p->ban,
                  'ventas_count'  => $p->ventas_count ?? 0,
                  'total_gastado' => $p->total_gastado ?? 0,
                  'initials'      => $p->initials,
                  'avatar_url'    => $p->avatar_url,
                ];
              @endphp
              <div class="row {{ $banned ? 'banned' : '' }}"
                   data-id="{{ $p->id }}"
                   data-json='@json($rowPayload)'>
                <div class="dot"></div>
                <div class="name" style="font-size:12px">{{ $p->name }} {{ $p->lastname }}</div>
                <div class="email" style="font-size:12px">{{ $p->email }}</div>
                <div style="text-align:center" style="font-size:12px">{{ $p->ventas_count ?? 0 }}</div>
                <div class="total" style="font-size:12px" >S/ {{ $tot }}</div>
                <div>
                  @if($banned)
                    <span class="status st-ban">Baneado</span>
                  @else
                    <span class="status st-activo">Activo</span>
                  @endif
                </div>
                <div class="actions">
                  <button class="btn-3dots" aria-haspopup="menu" aria-expanded="false">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="5" cy="12" r="1"/><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/>
                    </svg>
                  </button>
                  <div class="menu" role="menu">
                    <button data-action="ver">Ver</button>
                    <button data-action="editar">Editar</button>
                    <button data-action="ban">{{ $banned ? 'Quitar ban' : 'Banear' }}</button>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          
        </section>

        <!-- ASIDE -->
        <aside class="aside" style="padding-top:40px">
          <div class="card">
            <h4>Detalle del usuario</h4>
            <div style="display:flex; gap:14px; align-items:center;">
              <div class="avatar-big" id="dAvatar">{{ $selected?->initials }}</div>
              <div>
                <div style="font-weight:800; font-size:18px;" id="dName">{{ $selected?->name }} {{ $selected?->lastname }}</div>
                <div class="sub" id="dEmail">{{ $selected?->email }}</div>
                <div style="margin-top:6px;">
                  <span id="dRole" class="role" style="border:0;background:#eef2ff;color:#3730a3">{{ $selected?->role_label ?? 'Usuario' }}</span>
                  <span id="dBan" class="{{ $selected && $selected->ban ? 'status st-ban' : '' }}">
                    {{ $selected && $selected->ban ? 'BANEADO' : '' }}
                  </span>
                </div>
              </div>
            </div>
            <div class="kv" style="margin-top:14px">
              <div class="kv-row"><div class="key">DNI</div><div id="dDni">{{ $selected?->dni ?: '—' }}</div></div>
              <div class="kv-row"><div class="key">Celular</div><div id="dCell">{{ $selected?->cell ?: '—' }}</div></div>
              <div class="kv-row"><div class="key">Dirección</div><div id="dDir">{{ $selected?->direccion ?: '—' }}</div></div>
              <div class="kv-row"><div class="key">Ciudad</div><div id="dCiu">{{ $selected?->ciudad ?: '—' }}</div></div>
              <div class="kv-row"><div class="key">Provincia</div><div id="dProv">{{ $selected?->provincia ?: '—' }}</div></div>
              <div class="kv-row"><div class="key">Distrito</div><div id="dDist">{{ $selected?->distrito ?: '—' }}</div></div>
              <div class="kv-row"><div class="key">Cumpleaños</div><div id="dBirth">{{ $selected?->cumpleanos ?: '—' }}</div></div>
              <div class="kv-row"><div class="key">Órdenes</div><div id="dOrders">{{ $selected?->ventas_count ?? 0 }}</div></div>
            </div>
          </div>

          <div class="card">
            <h4>Resumen</h4>
            <div class="kv">
              <div class="kv-row"><div class="key">Total gastado</div>
                <div id="dSpent" style="font-weight:800">S/ {{ number_format((float)($selected?->total_gastado ?? 0), 2, '.', '') }}</div>
              </div>
              <div class="kv-row"><div class="key">Estado</div>
                <div id="dStatus">
                  @if($selected && $selected->ban)
                    <span class="status st-ban">BANEADO</span>
                  @else
                    <span class="status st-activo">Activo</span>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <h4>Acciones rápidas</h4>
            <div style="display:flex; gap:10px;">
              <button class="btn btn-primary" id="btnEdit">Editar</button>
              <button class="btn btn-ghost" id="btnView">Ver</button>
              <button class="btn btn-ghost" id="btnBan">Ban / Unban</button>
            </div>
            <input type="hidden" id="selectedId" value="{{ $selected?->id }}">
          </div>
        </aside>
      </div>
    </main>
  </div>

  <!-- MODAL VER -->
  <div id="viewModal" class="backdrop">
    <div class="modal">
      <div class="modal-hd">
        <h3 style="margin:0;font-weight:800">Usuario</h3>
        <button class="btn btn-ghost" data-close="#viewModal">Cerrar</button>
      </div>
      <div class="modal-bd">
        <div id="viewBody"></div>
      </div>
    </div>
  </div>

  <!-- MODAL EDITAR -->
  <div id="editModal" class="backdrop">
    <div class="modal">
      <div class="modal-hd">
        <h3 style="margin:0;font-weight:800">Editar usuario</h3>
        <button class="btn btn-ghost" data-close="#editModal">Cerrar</button>
      </div>
      <div class="modal-bd">
        <form id="editForm" method="POST">
          @csrf
          @method('PUT')
          <div class="form-grid">
            <div><label>Nombre</label><input name="name" class="input" required ></div>
            <div><label>Apellido</label><input name="lastname" class="input"></div>
            <div><label>Email</label><input name="email" type="email" class="input" required></div>
            <div><label>DNI</label><input name="dni" class="input"></div>
            <div><label>Celular</label><input name="cell" class="input"></div>
            <div><label>Dirección</label><input name="direccion" class="input"></div>
            <div><label>Ciudad</label><input name="ciudad" class="input"></div>
            <div><label>Provincia</label><input name="provincia" class="input"></div>
            <div><label>Distrito</label><input name="distrito" class="input"></div>
            <div><label>Cumpleaños</label><input name="cumpleanos" class="input" placeholder="YYYY-MM-DD"></div>
            <div>
              <label>Rol</label>
              <select name="type" class="select">
                <option value="0">Usuario</option>
                <option value="1">Admin</option>
                <option value="2">Almacén</option>
              </select>
            </div>
            <div>
              <label>Ban</label>
              <select name="ban" class="select">
                <option value="0">No</option>
                <option value="1">Sí</option>
              </select>
            </div>
            <div><label>Contraseña (opcional)</label><input name="password" type="password" class="input"></div>
            <div><label>Confirmar contraseña</label><input name="password_confirmation" type="password" class="input"></div>
          </div>
          <div style="margin-top:14px; display:flex; gap:10px; justify-content:flex-end;">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <button type="button" class="btn btn-ghost" data-close="#editModal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const userList = document.getElementById('userList');
    const selectedId = document.getElementById('selectedId');

    function soles(n){ return 'S/ ' + Number(n||0).toFixed(2); }

    function fillDetail(u){
      if(!u) return;
      selectedId.value = u.id;

      const av = document.getElementById('dAvatar');
      if(u.avatar_url){
        av.innerHTML = '<img src="'+u.avatar_url+'" alt="avatar" style="width:80px;height:80px;border-radius:20px;object-fit:cover;">';
      } else {
        av.textContent = u.initials || 'U';
      }

      document.getElementById('dName').textContent = (u.name||'') + ' ' + (u.lastname||'');
      document.getElementById('dEmail').textContent = u.email || '—';
      document.getElementById('dRole').textContent = u.role_label || 'Usuario';
      const dBan = document.getElementById('dBan');
      dBan.className = u.ban ? 'status st-ban' : '';
      dBan.textContent = u.ban ? 'BANEADO' : '';
      document.getElementById('dDni').textContent = u.dni || '—';
      document.getElementById('dCell').textContent = u.cell || '—';
      document.getElementById('dDir').textContent = u.direccion || '—';
      document.getElementById('dCiu').textContent = u.ciudad || '—';
      document.getElementById('dProv').textContent = u.provincia || '—';
      document.getElementById('dDist').textContent = u.distrito || '—';
      document.getElementById('dBirth').textContent = u.cumpleanos || '—';
      document.getElementById('dOrders').textContent = u.ventas_count ?? 0;
      document.getElementById('dSpent').textContent = soles(u.total_gastado||0);
      document.getElementById('dStatus').innerHTML = u.ban
        ? '<span class="status st-ban">BANEADO</span>'
        : '<span class="status st-activo">Activo</span>';
    }

    // Fila clic -> detalle
    userList.addEventListener('click', (e)=>{
      const row = e.target.closest('.row');
      if(!row) return;
      const data = row.getAttribute('data-json');
      try {
        const u = JSON.parse(data);
        fillDetail(u);
        document.querySelectorAll('.row').forEach(r=>r.classList.remove('is-active'));
        row.classList.add('is-active');
      } catch {
        fetch(`{{ route('admin.usuarios.show','') }}/${row.dataset.id}`)
          .then(r=>r.json()).then(u=>{
            fillDetail(u);
            document.querySelectorAll('.row').forEach(r=>r.classList.remove('is-active'));
            row.classList.add('is-active');
          });
      }
    });

    // Menú 3 puntos
    document.querySelectorAll('.row .btn-3dots').forEach(btn=>{
      btn.addEventListener('click', ev=>{
        ev.stopPropagation();
        const menu = btn.parentElement.querySelector('.menu');
        document.querySelectorAll('.menu').forEach(m=> m.style.display='none');
        menu.style.display = 'block';
        document.addEventListener('click', ()=> menu.style.display='none', {once:true});
      });
    });

    // Acciones menú
    document.querySelectorAll('.row .menu').forEach(menu=>{
      menu.addEventListener('click', (ev)=>{
        const act = ev.target.closest('button')?.dataset.action;
        const row = menu.closest('.row');
        if(!act || !row) return;
        const id = row.dataset.id;
        const data = JSON.parse(row.getAttribute('data-json'));
        if(act==='ver'){ openView(data); }
        if(act==='editar'){ openEdit(id); }
        if(act==='ban'){ toggleBan(id); }
      });
    });

    // Buscar
    const input = document.getElementById('searchInput');
    const clear = document.getElementById('searchClear');
    input.addEventListener('input', ()=>{
      const term = input.value.toLowerCase();
      document.querySelectorAll('#userList .row').forEach(r=>{
        const j = JSON.parse(r.getAttribute('data-json'));
        const hay = [j.name,j.lastname,j.email,j.dni].join(' ').toLowerCase();
        r.style.display = hay.includes(term) ? '' : 'none';
      });
    });
    clear.addEventListener('click', ()=>{ input.value=''; input.dispatchEvent(new Event('input')); });
    document.getElementById('btnEditTop').addEventListener('click', ()=>{ if(selectedId.value) openEdit(selectedId.value); });

    // Modales
    function openModal(sel){ document.querySelector(sel).style.display='flex'; }
    document.querySelectorAll('[data-close]').forEach(btn=>{
      btn.addEventListener('click', ()=>{ document.querySelector(btn.dataset.close).style.display='none'; });
    });
    window.addEventListener('keydown', e=>{ if(e.key==='Escape'){ document.querySelectorAll('.backdrop').forEach(m=>m.style.display='none'); }});

    function openView(u){
      const v = document.getElementById('viewBody');
      v.innerHTML = `
        <div style="display:flex; gap:14px; align-items:center;">
          <div class="avatar-big">${u.initials || 'U'}</div>
          <div>
            <div style="font-weight:800; font-size:18px;">${u.name||''} ${u.lastname||''}</div>
            <div class="sub">${u.email||'—'}</div>
            <div style="margin-top:6px;">
              <span class="status st-activo">${u.role_label||'Usuario'}</span>
              ${u.ban ? '<span class="status st-ban" style="margin-left:8px">BANEADO</span>' : ''}
            </div>
          </div>
        </div>
        <div class="kv" style="margin-top:14px">
          <div class="kv-row"><div class="key">DNI</div><div>${u.dni||'—'}</div></div>
          <div class="kv-row"><div class="key">Celular</div><div>${u.cell||'—'}</div></div>
          <div class="kv-row"><div class="key">Dirección</div><div>${u.direccion||'—'}</div></div>
          <div class="kv-row"><div class="key">Ciudad</div><div>${u.ciudad||'—'}</div></div>
          <div class="kv-row"><div class="key">Provincia</div><div>${u.provincia||'—'}</div></div>
          <div class="kv-row"><div class="key">Distrito</div><div>${u.distrito||'—'}</div></div>
          <div class="kv-row"><div class="key">Órdenes</div><div>${u.ventas_count||0}</div></div>
          <div class="kv-row"><div class="key">Total gastado</div><div>${soles(u.total_gastado||0)}</div></div>
        </div>`;
      openModal('#viewModal');
    }

    function openEdit(id){
      fetch(`{{ route('admin.usuarios.show','') }}/${id}`).then(r=>r.json()).then(u=>{
        const f = document.getElementById('editForm');
        f.action = `{{ route('admin.usuarios.update','') }}/${id}`;
        f.name.value = u.name || '';
        f.lastname.value = u.lastname || '';
        f.email.value = u.email || '';
        f.dni.value = u.dni || '';
        f.cell.value = u.cell || '';
        f.direccion.value = u.direccion || '';
        f.ciudad.value = u.ciudad || '';
        f.provincia.value = u.provincia || '';
        f.distrito.value = u.distrito || '';
        f.cumpleanos.value = u.cumpleanos || '';
        f.type.value = u.type ?? 0;
        f.ban.value = u.ban ? 1 : 0;
        f.password.value = '';
        f.password_confirmation.value = '';
        openModal('#editModal');
      });
    }

    function toggleBan(id){
      fetch(`{{ route('admin.usuarios.ban','') }}/${id}`,{
        method:'POST',
        headers:{'Content-Type':'application/x-www-form-urlencoded','X-CSRF-TOKEN':csrf},
        body:`ban=${document.getElementById('dBan').textContent ? 0 : 1}`
      }).then(r=>r.json()).then(res=>{
        if(res.ok){
          fetch(`{{ route('admin.usuarios.show','') }}/${id}`).then(r=>r.json()).then(u=>{
            fillDetail(u);
            const row = document.querySelector(`.row[data-id="${id}"]`);
            if(row){
              const j = JSON.parse(row.getAttribute('data-json'));
              j.ban = u.ban; row.setAttribute('data-json', JSON.stringify(j));
              row.classList.toggle('banned', !!u.ban);
              // actualizar texto del menú
              const btn = row.querySelector('.menu [data-action="ban"]');
              if(btn) btn.textContent = u.ban ? 'Quitar ban' : 'Banear';
            }
          });
        }
      });
    }

    // Autoselección del primero
    @php
      $selectedPayload = $selected ? [
        'id'=>$selected->id,'name'=>$selected->name,'lastname'=>$selected->lastname,'email'=>$selected->email,
        'dni'=>$selected->dni,'cell'=>$selected->cell,'direccion'=>$selected->direccion,'ciudad'=>$selected->ciudad,
        'provincia'=>$selected->provincia,'distrito'=>$selected->distrito,'cumpleanos'=>$selected->cumpleanos,
        'type'=>$selected->type,'role_label'=>$selected->role_label,'ban'=>(bool)$selected->ban,
        'ventas_count'=>$selected->ventas_count ?? 0,'total_gastado'=>$selected->total_gastado ?? 0,
        'initials'=>$selected->initials,'avatar_url'=>$selected->avatar_url,
      ] : null;
    @endphp
    @if($selectedPayload)
      const firstUser = @json($selectedPayload);
      fillDetail(firstUser);
    @endif
  </script>
</body>
</html>
