<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear venta | Admin</title>
   @include ('global.icon')
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg:#f6f7fb; --panel:#ffffff; --muted:#7b8aa3; --text:#1f2937; --sub:#0f172a;
      --border:#e5e7eb; --shadow:0 10px 30px rgba(32,41,63,.08);
      --radius:14px; --r8:10px;
      --accent:#ff4242; --accent-2:#c21a1a;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{margin:0;background:var(--bg);color:var(--text);font-family:Inter,system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,sans-serif}
    a{text-decoration:none}

    /* ====== LAYOUT ====== */
    .layout{display:grid;grid-template-columns:240px 1fr;min-height:100vh}
    @media (max-width:1100px){ .layout{grid-template-columns:88px 1fr} }
    @media (max-width:760px){ .layout{grid-template-columns:0 1fr} .sidebar{transform:translateX(-100%)} .sidebar.open{transform:none} .backdrop-nav{display:block} }

    /* Sidebar */
    .sidebar{
      position:sticky; top:0; height:100vh; z-index:40;
      background:linear-gradient(180deg, #fb4949 0%, #ff1e1e 50%, #ff4a4a 100%);
      color:#fff; padding:22px 14px; transition:.25s transform;
    }
    .brand{display:flex;align-items:center;gap:10px;margin-bottom:18px}
    .brand-logo{width:34px;height:34px;border-radius:10px;background:#fff;display:grid;place-items:center;color:#ff6b3d;font-weight:800}
    .brand-name{font-weight:800;font-size:20px}
    .nav{display:flex;flex-direction:column;gap:8px;margin-top:10px}
    .nav a{display:block;padding:12px 14px;border-radius:12px;color:#ffece6;opacity:.95}
    .nav a:hover{background:rgba(255,255,255,.14);color:#fff}
    .nav a.active{background:rgba(255,255,255,.28);color:#fff}
    .sidebar-footer{margin-top:auto;padding-top:12px;color:#ffece6;font-size:12px;opacity:.9}

    /* Topbar */
    .topbar{
      position:sticky; top:0; z-index:30;
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

    /* Content wrapper */
    .main{padding:18px}
    .content{max-width:1280px;margin:0 auto}

    /* Grid: izquierda formulario, derecha resumen */
    .form-grid{display:grid;grid-template-columns:1fr 360px;gap:18px}
    @media (max-width:1100px){ .form-grid{grid-template-columns:1fr} }

    /* Cards / controls */
    .card{background:var(--panel);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow)}
    .card-hd{padding:14px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
    .card-bd{padding:16px}
    .card-ft{padding:12px 16px;border-top:1px solid var(--border);display:flex;gap:10px;justify-content:flex-end}
    .btn{border:0;border-radius:12px;padding:10px 14px;font-weight:700;cursor:pointer}
    .btn-ghost{background:#fff;border:1px solid var(--border);display:block;text-align:center;color:var(--accent)}
    .btn-primary{background:linear-gradient(180deg,var(--accent),var(--accent-2));color:#fff}

    .field{display:flex;flex-direction:column;gap:6px}
    label{font-size:13px;color:#475569}
    .input,.select,textarea{width:100%;border:1px solid var(--border);border-radius:12px;padding:10px 12px;background:#fff}
    .input:focus,.select:focus,textarea:focus{outline:none;box-shadow:0 0 0 3px rgba(255,133,79,.15);border-color:#ffd1bb}

    /* Grillas fluidas para datos del cliente */
    .grid-row-2{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .grid-row-3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px}
    @media (max-width:860px){ .grid-row-3{grid-template-columns:1fr 1fr} }
    @media (max-width:520px){ .grid-row-2,.grid-row-3{grid-template-columns:1fr} }

    /* Items builder */
    .builder{display:grid;grid-template-columns:1.4fr .5fr .6fr 150px;gap:10px}
    .add{height:44px;border:none;border-radius:12px;background:linear-gradient(180deg,var(--accent),var(--accent-2));color:#fff;font-weight:800;cursor:pointer}
    @media (max-width:1024px){ .builder{grid-template-columns:1fr 1fr 1fr} .add{grid-column:1/-1} }
    @media (max-width:640px){ .builder{grid-template-columns:1fr} }

    .table-wrap{overflow-x:auto}
    .table{width:100%;border-collapse:collapse;margin-top:12px;background:#fff;border:1px solid var(--border);border-radius:12px;overflow:hidden}
    .table th,.table td{padding:10px;border-bottom:1px solid var(--border);font-size:14px;white-space:nowrap}
    .del{all:unset;cursor:pointer;padding:6px;border-radius:8px}
    .del:hover{background:#f3f4f6}

    /* Aside summary (fondo visible siempre) */
    .aside{display:flex;flex-direction:column;gap:14px;position:relative;z-index:1}
    .aside .card{background:#fff;border:1px solid var(--border);box-shadow:var(--shadow)}
    @media (min-width:1101px){ .aside{position:sticky; top:82px; height:fit-content} }
    .sum-row{display:flex;align-items:center;justify-content:space-between;padding:8px 0}
    .total{font-size:22px;font-weight:800}
    .note{font-size:12px;color:var(--muted)}

    /* Backdrop nav */
    .backdrop-nav{display:none;position:fixed;inset:0;background:rgba(15,23,42,.45);z-index:35}

    /* ===== Paso (Cliente -> Items) SIN depender del viewport ===== */
    #step-items{ display:none; }                            /* Oculto por defecto */
    body.step-items #step-client{ display:none; }          /* Al pasar, ocultar Cliente */
    body.step-items #step-items{ display:block; }          /* Al pasar, mostrar Items */

    /* Mini resumen del cliente aparece solo en Items */
    #cliente-mini{ display:none; }
    body.step-items #cliente-mini{ display:block; }

    /* Mini card */
    .mini{
      background:#fff;border:1px solid var(--border);border-radius:12px;padding:12px;box-shadow:var(--shadow);font-size:14px;cursor:pointer
    }
    .mini h5{margin:0 0 8px;font-size:14px}
    .mini .line{color:#475569;margin:2px 0}
  </style>
</head>
<body>
  <div class="layout">
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
      <div class="brand">
        <div class="brand-logo">A</div>
        <div class="brand-name">Adler</div>
      </div>
      <nav class="nav">
        <a class="active" href="{{ route('admin.ventas.index') }}">Ventas</a>
        <a href="#">Inventario</a>
        <a href="#">Usuarios</a>
        <a href="#">Configuración</a>
      </nav>
      <div class="sidebar-footer">© {{ date('Y') }} Adler</div>
    </aside>
    <div class="backdrop-nav" id="backdropNav"></div>

    <!-- CONTENT -->
    <div>
      <!-- TOPBAR -->
      <div class="topbar">
        <div class="left">
          <button class="burger" id="burger" aria-label="Abrir menú">☰</button>
          <div>
            <div class="page-title">Crear venta</div>
            <div class="sub">Registra los datos del cliente y luego agrega ítems</div>
          </div>
        </div>
        <div class="user">
          <div class="avatar" title="{{ Auth::user()->name ?? 'Admin' }}">
            {{ strtoupper(mb_substr(Auth::user()->name ?? 'A',0,1)) }}
          </div>
          <div style="display:flex;flex-direction:column;line-height:1">
            <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
            <span class="sub">{{ Auth::user()->email ?? '' }}</span>
          </div>
        </div>
      </div>

      <!-- MAIN -->
      <main class="main">
        <div class="content">
          <form id="venta-form" class="form-grid" method="post" action="{{ route('admin.ventas.store') }}" onsubmit="return prepareItems()">
            @csrf

            <!-- LEFT COLUMN -->
            <section style="display:grid;gap:16px">
              <!-- Paso 1: Cliente -->
              <div class="card" id="step-client">
                <div class="card-hd"><div style="font-weight:800">Cliente</div></div>
                <div class="card-bd">
                  <!-- Nombre y Apellido -->
                  <div class="grid-row-2">
                    <div class="field"><label>Nombre</label><input class="input" name="nombre" required></div>
                    <div class="field"><label>Apellido</label><input class="input" name="apellido"></div>
                  </div>

                  <!-- Contacto -->
                  <div class="grid-row-2" style="margin-top:12px">
                    <div class="field"><label>Email</label><input class="input" name="email" type="email"></div>
                    <div class="field"><label>Celular</label><input class="input" name="celular"></div>
                  </div>

                  <!-- Dirección -->
                  <div class="field" style="margin-top:12px">
                    <label>Domicilio</label><input class="input" name="domicilio">
                  </div>

                  <!-- Distrito / Provincia / Depto -->
                  <div class="grid-row-3" style="margin-top:12px">
                    <div class="field"><label>Distrito</label><input class="input" name="distrito"></div>
                    <div class="field"><label>Provincia</label><input class="input" name="provincia"></div>
                    <div class="field"><label>Departamento</label><input class="input" name="departamento"></div>
                  </div>

                  <!-- DNI y Referencia -->
                  <div class="grid-row-2" style="margin-top:12px">
                    <div class="field"><label>DNI</label><input class="input" name="dni"></div>
                    <div class="field"><label>Referencia</label><input class="input" name="referencia"></div>
                  </div>

                  <!-- Tipo y Envío -->
                  <div class="grid-row-2" style="margin-top:12px">
                    <div class="field"><label>Tipo</label><input class="input" name="tipo" value="manual"></div>
                    <div class="field"><label>Cargo envío (S/)</label><input id="cargo_envio" class="input" name="cargo_envio" type="number" step="0.01" value="0"></div>
                  </div>
                </div>
                <!-- Botón continuar SIEMPRE visible desde el inicio -->
                <div class="card-ft">
                  <button type="button" class="btn btn-primary" id="btnContinuar">Continuar</button>
                </div>
              </div>

              <!-- Paso 2: Items (oculto al cargar) -->
              <div class="card" id="step-items">
                <div class="card-hd"><div style="font-weight:800">Items</div></div>
                <div class="card-bd">
                  <div class="builder">
                    <select id="bProd" class="select">
                      <option value="">Selecciona artículo…</option>
                    </select>
                    <input id="bCant" class="input" type="number" min="1" value="1" placeholder="Cant.">
                    <input id="bPrec" class="input" type="number" step="0.01" min="0" placeholder="Precio">
                    <button class="add" type="button" onclick="addItem()">Agregar ítem</button>
                  </div>

                  <div class="table-wrap">
                    <table class="table" id="items-table">
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
                      <tbody id="items-body"></tbody>
                      <tfoot>
                        <tr><td colspan="4" style="text-align:right">Subtotal</td><td id="tSub" style="text-align:right">0.00</td><td></td></tr>
                        <tr><td colspan="4" style="text-align:right">Cargo envío</td><td id="tEnv" style="text-align:right">0.00</td><td></td></tr>
                        <tr><td colspan="4" style="text-align:right">Total</td><td id="tTot" style="text-align:right">0.00</td><td></td></tr>
                      </tfoot>
                    </table>
                  </div>

                  <input type="hidden" name="items" id="items-json">
                </div>
                <!-- Botón guardar al final de Items -->
                <div class="card-ft">
                  <button class="btn btn-primary" type="submit" style="width:100%">Guardar venta</button>
                </div>
              </div>
            </section>

            <!-- RIGHT SUMMARY -->
            <aside class="aside">
              <div class="card">
                <div class="card-hd"><div style="font-weight:800">Resumen</div></div>
                <div class="card-bd">
                  <div class="sum-row"><span>Items</span><strong id="sumItems">0</strong></div>
                  <div class="sum-row"><span>Subtotal</span><strong id="sumSub">S/ 0.00</strong></div>
                  <div class="sum-row"><span>Envío</span><strong id="sumEnv">S/ 0.00</strong></div>
                  <hr style="border:none;border-top:1px solid var(--border);margin:10px 0">
                  <div class="sum-row"><span class="total">Total</span><span class="total" id="sumTot">S/ 0.00</span></div>
                  <p class="note">Se actualiza al modificar ítems o envío.</p>
                  <!-- Guardar también aquí por si el aside está visible -->
                  <button class="btn btn-primary" type="submit" style="width:100%;margin-top:8px">Guardar venta</button>
                  <a class="btn btn-ghost" href="{{ route('admin.ventas.index') }}" style="width:100%;margin-top:6px">Cancelar</a>
                </div>
              </div>

              <!-- Mini resumen del cliente (clic = volver a editar cliente) -->
              <div id="cliente-mini" class="mini">
                <h5 style="display:flex;justify-content:space-between;align-items:center">
                  <span>Cliente</span>
                  <span style="font-weight:700;font-size:12px;color:#ff4242">Editar</span>
                </h5>
                <div id="cMiniNombre" class="line" style="font-weight:700">—</div>
                <div id="cMiniContacto" class="line">—</div>
                <div id="cMiniDestino" class="line">—</div>
              </div>
            </aside>
          </form>
        </div>
      </main>
    </div>
  </div>

  <script>
    // Sidebar móvil
    const burger = document.getElementById('burger');
    const sidebar = document.getElementById('sidebar');
    const backdropNav = document.getElementById('backdropNav');
    if(burger){
      burger.addEventListener('click', ()=>{
        sidebar.classList.toggle('open');
        if(backdropNav) backdropNav.style.display = sidebar.classList.contains('open') ? 'block' : 'none';
      });
      backdropNav?.addEventListener('click', ()=>{
        sidebar.classList.remove('open'); backdropNav.style.display='none';
      });
    }

    // ===== Helpers
    const v = name => (document.querySelector(`[name="${name}"]`)?.value || '').trim();
    function fmt(n){ return Number(n||0).toFixed(2); }

    // ===== Flujo Cliente -> Items
    const btnContinuar = document.getElementById('btnContinuar');
    const mini = document.getElementById('cliente-mini');

    function renderMiniCliente(){
      const nombre   = [v('nombre'), v('apellido')].filter(Boolean).join(' ');
      const contacto = [v('email'),  v('celular')].filter(Boolean).join(' · ');
      const destino  = [v('distrito'), v('provincia'), v('departamento')].filter(Boolean).join(', ') || v('domicilio');

      document.getElementById('cMiniNombre').textContent   = nombre   || '—';
      document.getElementById('cMiniContacto').textContent = contacto || '—';
      document.getElementById('cMiniDestino').textContent  = destino  || '—';
    }

    function goToItems(){
      if(!v('nombre')){ alert('Nombre es requerido.'); return; }
      renderMiniCliente();
      document.body.classList.add('step-items');  // activa Items, oculta Cliente y muestra mini
      window.scrollTo({top:0, behavior:'smooth'});
      recalc(); // asegurar totales
    }

    function backToCliente(){
      document.body.classList.remove('step-items');
      window.scrollTo({top:0, behavior:'smooth'});
    }

    btnContinuar?.addEventListener('click', goToItems);
    mini?.addEventListener('click', backToCliente);

    // ===== Builder / Totales
    const ARTICULOS = @json($articulos ?? []);
    const tbody = document.getElementById('items-body');
    const envEl = document.getElementById('cargo_envio');

    (function fillSelect(){
      const sel = document.getElementById('bProd');
      sel.innerHTML = '<option value=\"\">Selecciona artículo…</option>' +
        ARTICULOS.map(a=>{
          const price = a.price ?? a.precio ?? 0;
          const name = a.name ?? a.nombre ?? ('ID '+a.id);
          return `<option value=\"${a.id}\" data-price=\"${price}\">${name} (S/ ${fmt(price)})</option>`;
        }).join('');
      sel.addEventListener('change', ()=>{
        const opt = sel.selectedOptions[0];
        if(opt && opt.dataset.price){ document.getElementById('bPrec').value = Number(opt.dataset.price); }
      });
    })();

    const items = [];

    function addItem(){
      const sel = document.getElementById('bProd');
      const id = parseInt(sel.value || '0', 10);
      const cant = parseInt(document.getElementById('bCant').value || '1', 10);
      const precio = parseFloat(document.getElementById('bPrec').value || '0');
      if(!id){ alert('Selecciona un artículo.'); return; }
      if(cant < 1){ alert('Cantidad inválida.'); return; }
      if(precio < 0){ alert('Precio inválido.'); return; }

      const art = ARTICULOS.find(a => (a.id == id)) || {};
      const name = art.name ?? art.nombre ?? ('ID '+id);
      items.push({ idarticulo:id, name, qty:cant, precio });
      sel.value=''; document.getElementById('bCant').value=1; document.getElementById('bPrec').value='';
      renderItems();
    }

    function removeItem(i){ items.splice(i,1); renderItems(); }

    function onEdit(i, field, el){
      const val = field === 'qty' ? parseInt(el.value||'1',10) : parseFloat(el.value||'0');
      if(isNaN(val)) return;
      items[i][field] = val;
      recalc();
      const st = items[i].qty * items[i].precio;
      el.closest('tr').querySelector('.st').textContent = fmt(st);
    }

    function renderItems(){
      tbody.innerHTML = '';
      items.forEach((it,i)=>{
        const st = it.qty * it.precio;
        tbody.insertAdjacentHTML('beforeend', `
          <tr>
            <td style="text-align:center">${i+1}</td>
            <td>${it.name}</td>
            <td style="text-align:right">
              <input type="number" min="1" value="${it.qty}" class="input" style="height:36px;width:90px"
                     oninput="onEdit(${i}, 'qty', this)">
            </td>
            <td style="text-align:right">
              <input type="number" step="0.01" min="0" value="${fmt(it.precio)}" class="input" style="height:36px;width:120px"
                     oninput="onEdit(${i}, 'precio', this)">
            </td>
            <td class="st" style="text-align:right">${fmt(st)}</td>
            <td style="text-align:right"><button type="button" class="del" onclick="removeItem(${i})">🗑️</button></td>
          </tr>
        `);
      });
      recalc();
    }

    function recalc(){
      const sub = items.reduce((a,b)=> a + (Number(b.qty)*Number(b.precio)), 0);
      const env = Number(envEl.value || 0);
      const tot = sub + env;
      document.getElementById('tSub').textContent = fmt(sub);
      document.getElementById('tEnv').textContent = fmt(env);
      document.getElementById('tTot').textContent = fmt(tot);
      document.getElementById('sumItems').textContent = items.length;
      document.getElementById('sumSub').textContent = 'S/ ' + fmt(sub);
      document.getElementById('sumEnv').textContent = 'S/ ' + fmt(env);
      document.getElementById('sumTot').textContent = 'S/ ' + fmt(tot);
    }

    envEl.addEventListener('input', recalc);

    function prepareItems(){
      if(items.length === 0){ alert('Agrega al menos un ítem.'); return false; }
      for(const it of items){
        if(!it.idarticulo || it.qty < 1){ alert('Hay ítems inválidos.'); return false; }
      }
      document.getElementById('items-json').value = JSON.stringify(items.map(it=>({
        idarticulo: it.idarticulo, qty: Number(it.qty), precio: Number(it.precio)
      })));
      return true;
    }
  </script>
</body>
</html>
