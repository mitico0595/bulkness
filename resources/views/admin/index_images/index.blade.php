{{-- resources/views/admin/index_images/index.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editor Home - Creacion | Admin</title>
    @include('global.icon')
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

        .app{display:grid;grid-template-columns:260px 1fr;min-height:100vh}
        .wrap{max-width:1240px;margin:0 auto;display:grid;grid-template-columns:1fr 360px;gap:18px}

        /* Sidebar */
        .sidebar{color:#fff; padding:24px 16px}
        .nav{display:flex;flex-direction:column;gap:6px}
        .nav a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:10px;color:#363636;opacity:.95}
        .nav a.active,.nav a:hover{background:rgba(255,255,255,.34);color:#aaaaaa}

        /* Topbar */
        .topbar{display:flex;align-items:center;justify-content:space-between;margin-bottom:12px}
        .topbar{
          position:sticky; top:0; z-index:30;
          background:#fff; border-bottom:1px solid var(--border);
          display:flex; align-items:center; justify-content:space-between;
          padding:12px 18px;
        }
        .top-ttl{font-weight:800;font-size:22px;color:var(--sub)}
        .subhead{color:var(--muted);font-size:12px;}
        .sub{color:var(--muted);font-size:13px}
        .user{display:flex;align-items:center;gap:10px}
        .avatar{width:36px;height:36px;border-radius:10px;background:#ffd4d4;color:#b40909;display:grid;place-items:center;font-weight:800}

        .btn{border:0;border-radius:12px;padding:10px 14px;font-weight:600;cursor:pointer}
        .btn-ghost{background:#fff;border:1px solid var(--border)}
        .btn-primary{background:linear-gradient(180deg,var(--accent),var(--accent-2));color:#fff}
        .btn-primary:hover{filter:brightness(.97)}
        .btn-sm{padding:6px 10px;font-size:12px;border-radius:10px}
        .btn-danger{background:var(--bad);color:#fff}

        .panel{padding:14px}
        /* Ajustamos las columnas para imágenes */
        .thead{
          display:grid;
          grid-template-columns:16px 80px 160px 1fr 1fr 140px 120px;
          gap:12px;
          padding:6px 6px 10px;
          color:var(--muted);
          font-size:12px;
          border-bottom:1px solid #eef2ff
        }
        .rows{display:flex;flex-direction:column;gap:12px}
        .row{
          cursor:pointer;
          background:white;
          border-radius:15px;
          display:grid;
          grid-template-columns:16px 80px 160px 1fr 1fr 140px 120px;
          align-items:center;
          gap:12px;
          padding:12px 8px;
          border-top:1px solid #f1f5f9
        }
        .row.is-active{background:#ffebb0;color:#fff}
        .dot{border-radius:999px;background:#9ca3af;height:0px;width:0px;margin-left:4px}
        .code{font-weight:800}
        .dest{color:#334155;font-size:14px}
        .dim{font-size:12px;color:var(--muted)}

        .thumb{width:120px;height:80px;border-radius:12px;background:#f3f4f6;overflow:hidden}
        .thumb img{width:100%;height:100%;object-fit:cover}

        .status{justify-self:start;border-radius:999px;padding:6px 10px;font-size:12px;font-weight:700}
        .st-active{background:#ecfdf5;color:#166534}
        .st-inactive{background:#f3f4f6;color:#6b7280}

        .actions{justify-self:end;display:flex;gap:6px}

        .aside{display:flex;flex-direction:column;gap:14px}
        .card{background:#fff;border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--shadow);padding:14px}
        .card h4{margin:0 0 12px;font-size:15px}
        .chip{background:#fff;border:1px solid var(--border);border-radius:999px;padding:6px 10px;font-size:12px;color:#1f2937;display:inline-flex;align-items:center;gap:6px}
        .chip button{all:unset;cursor:pointer;font-size:14px;line-height:1}

        .pager{display:flex;align-items:center;justify-content:space-between;margin-top:14px;gap:10px}
        .pager-info{color:#7b8aa3;font-size:13px}

        /* Backdrop + modal (mismo sistema que envíos) */
        .backdrop{
          position:fixed;inset:0;background:rgba(15,23,42,.45);
          display:none;align-items:center;justify-content:center;padding:20px;z-index:50
        }
        .modal{
          background:#fff;border-radius:16px;max-width:900px;width:100%;
          max-height:90vh;overflow:auto;border:1px solid var(--border);box-shadow:var(--shadow)
        }
        .modal-hd{
          position:sticky;backdrop-filter:blur(1px);background:rgba(265,256,256,.5);
          top:0; display:flex;align-items:center;justify-content:space-between;
          padding:14px 16px;border-bottom:1px solid var(--border)
        }
        .modal-bd{padding:16px}
        .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
        .input{width:100%;border:1px solid var(--border);border-radius:10px;padding:10px;font-size:14px}
        .select{width:100%;border:1px solid var(--border);border-radius:10px;padding:10px;background:#fff;font-size:14px}

        .search-results{
          border:1px solid var(--border);
          border-radius:12px;
          margin-top:6px;
          background:#fff;
          max-height:180px;
          overflow:auto;
          display:none;
        }
        .search-result-item{
          padding:6px 8px;
          display:flex;
          align-items:center;
          gap:8px;
          cursor:pointer;
        }
        .search-result-item:hover{background:#f3f4f6}
        .search-result-thumb{
          width:32px;height:32px;border-radius:6px;
          object-fit:cover;background:#e5e7eb;
        }
        .search-result-name{font-size:13px}
        .search-result-price{font-size:11px;color:#6b7280}

        .selected-chips{margin-top:6px;display:flex;flex-wrap:wrap;gap:6px}

        @media (max-width:1100px){
          .app{grid-template-columns:1fr}
          .sidebar{display:none}
          .wrap{grid-template-columns:1fr}
        }
        @media (max-width:760px){
          .thead{display:none}
          .row{
            grid-template-columns:1fr;
            gap:8px;
            padding:12px;
            border:1px solid #eef2ff
          }
          .wrap{grid-template-columns:1fr;gap:12px;padding:0 12px}
          .aside{padding-top:0}
          .grid-2{grid-template-columns:1fr}
        }

        .sb-foot{color:#ffe9e2;opacity:.85;font-size:12px;text-align:center;position:absolute;bottom:5px;right:28px;}
    </style>
</head>
<body>
<div class="app">
    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <div class="inner" style="border-radius:20px;padding:15px;position:relative;height:100%;display:flex;flex-direction:column;justify-content:center;background:#ffebb0">
            <div class="brand" style="position:absolute;top:10px;left:15px">
                <a href="{{ asset('/') }}"><img src="{{ asset('image/logo.webp') }}" alt="" style="width:50%"></a>
            </div>
            <nav class="nav">
                <a href="{{ route('admin.dashboard') }}"><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
                <a href="{{ url('admin/ventas') }}"><span class="material-symbols-outlined">attach_money</span>Ventas</a>
                <a href="{{ url('admin/envios') }}"><span class="material-symbols-outlined">local_shipping</span>Envíos</a>
                <a href="{{ route('admin.index_images.index') }}" class="active"><span class="material-symbols-outlined">photo_library</span>Editor</a>
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
            <div class="venti" style="background:white;border-radius:15px;padding:10px;height:56px;width:220px">
                <div class="top-ttl">Home index</div>
                <div class="subhead">{{ $images->count() }} imágenes</div>
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

        {{-- TOP ACTION BAR --}}
        <div class="topbar" style="margin:20px;top:20px;border-radius:15px;margin-top:0;background:rgba(256,256,256,.5);backdrop-filter:blur(3px)">
            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;width:100%;justify-content:space-between">
                <div class="subhead">Gestiona las imágenes principales y campañas del home.</div>
                <button class="btn btn-primary btn-sm" type="button" onclick="openCreateModal()">
                    <span class="material-symbols-outlined" style="font-size:18px;vertical-align:middle;margin-right:4px">add</span>
                    Nueva imagen
                </button>
            </div>
        </div>

        {{-- GRID --}}
        <div class="wrap">
            {{-- LISTA --}}
            <section class="panel">
                <div class="thead">
                    <div></div>
                    <div>ID</div>
                    <div>Imagen</div>
                    <div>Campaña</div>
                    <div>Relaciones (IDs Search)</div>
                    <div>Estado campaña</div>
                    <div></div>
                </div>

                <div class="rows">
                    @forelse($images as $img)
                        <div class="row image-row"
                             data-id="{{ $img->id }}"
                             data-relacion="{{ is_array($img->relacion) ? implode(',', $img->relacion) : '' }}"
                             data-campaign-id="{{ $img->campaign_id ?? '' }}"
                             data-image-url="{{ $img->image_url }}">
                            <div class="dot"></div>
                            <div class="code">{{ $img->id }}</div>
                            <div>
                                <div class="thumb">
                                    <img src="{{ $img->image_url }}" alt="Preview {{ $img->id }}">
                                </div>
                            </div>
                            <div class="dest">
                                {{ $img->campaign->name ?? 'Sin campaña' }}
                            </div>
                            <div class="dest">
                                @if(is_array($img->relacion) && count($img->relacion))
                                    {{ implode(', ', $img->relacion) }}
                                @else
                                    <span class="dim">Sin productos relacionados</span>
                                @endif
                            </div>
                            <div>
                                @php $active = optional($img->campaign)->is_active; @endphp
                                <span class="status {{ $active ? 'st-active' : 'st-inactive' }}">
                                    {{ $active ? 'Campaña activa' : 'Inactiva' }}
                                </span>
                            </div>
                            <div class="actions">
                                <button type="button"
                                        class="btn btn-ghost btn-sm"
                                        onclick="openEditModal(this)">
                                    Editar
                                </button>

                                <form action="{{ route('admin.index_images.destroy', $img) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar esta imagen y su archivo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="dim">No hay imágenes configuradas aún.</div>
                    @endforelse
                </div>

                {{-- Si quisieras paginar en el futuro, aquí iría la paginación --}}
                <div class="pager">
                    <div class="pager-info">
                        Total: {{ $images->count() }} registros
                    </div>
                </div>
            </section>

            {{-- ASIDE --}}
            <aside class="aside" style="padding-top:40px">
                <div class="card">
                    <h4>Campañas</h4>
                    @forelse($campaigns as $c)
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px">
                            <div>
                                <strong>{{ $c->name }}</strong>
                                @if($c->is_active)
                                    <span class="status st-active" style="padding:3px 8px;font-size:11px;margin-left:6px">Activa</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="dim">No hay campañas creadas.</div>
                    @endforelse
                    <button class="btn btn-ghost btn-sm" type="button" style="margin-top:10px" onclick="openCampaignModal()">
                        + Nueva campaña
                    </button>
                </div>

                <div class="card">
                    <h4>Tips</h4>
                    <div class="dim">
                        • Máximo 3 productos relacionados por imagen.<br>
                        • Solo la campaña marcada como activa filtra el home.<br>
                        • Para cambiar la imagen principal, elimina el registro y crea uno nuevo.
                    </div>
                </div>
            </aside>
        </div>
    </main>
</div>

{{-- MODAL CREAR IMAGEN --}}
<div id="modal-create" class="backdrop">
    <div class="modal">
        <div class="modal-hd">
            <h3 style="margin:0;font-weight:800">Nueva imagen principal</h3>
            <button class="btn btn-ghost btn-sm" type="button" onclick="closeCreateModal()">Cerrar</button>
        </div>
        <div class="modal-bd">
            <form action="{{ route('admin.index_images.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="grid-2">
                    <div>
                        <label class="dim">Imagen principal</label>
                        <input type="file"
                               name="image"
                               class="input"
                               accept="image/*"
                               required>
                        <div class="dim" style="margin-top:6px">
                            Se guardará en <code>public/image/index/</code>.
                        </div>
                    </div>

                    <div>
                        <label class="dim">Productos relacionados (máx 3)</label>
                        <input type="hidden" name="relacion_ids" id="create_relacion_ids">
                        <input type="text"
                               id="create_product_search"
                               class="input"
                               placeholder="Busca por nombre o código…">
                        <div class="dim" style="margin-top:4px">
                            Escribe al menos 2 caracteres para ver resultados.
                        </div>
                        <div id="create_search_results" class="search-results"></div>
                        <div id="create_selected_products" class="selected-chips"></div>
                    </div>
                </div>

                <div class="grid-2" style="margin-top:16px">
                    <div>
                        <label class="dim">Campaña</label>
                        <div style="display:flex;gap:8px;align-items:center">
                            <select name="campaign_id" id="create_campaign_id" class="select">
                                <option value="">Sin campaña</option>
                                @foreach($campaigns as $campaign)
                                    <option value="{{ $campaign->id }}">
                                        {{ $campaign->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-ghost btn-sm" onclick="openCampaignModal()">+</button>
                        </div>
                    </div>
                    <div style="display:flex;align-items:flex-end;justify-content:flex-end">
                        <label style="display:flex;align-items:center;gap:6px">
                            <input type="checkbox" name="activate_campaign" value="1">
                            <span class="dim">Activar esta campaña como campaña del home</span>
                        </label>
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;margin-top:18px;gap:8px">
                    <button type="button" class="btn btn-ghost" onclick="closeCreateModal()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar imagen</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDITAR IMAGEN --}}
<div id="modal-edit" class="backdrop">
    <div class="modal">
        <div class="modal-hd">
            <h3 id="edit_title" style="margin:0;font-weight:800">Editar imagen</h3>
            <button class="btn btn-ghost btn-sm" type="button" onclick="closeEditModal()">Cerrar</button>
        </div>
        <div class="modal-bd">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="grid-2">
                    <div>
                        <label class="dim">Imagen principal (no editable)</label>
                        <div class="thumb" style="width:100%;height:220px;margin-top:4px">
                            <img id="edit_preview" src="" alt="Preview" style="width:100%;height:100%;object-fit:cover">
                        </div>
                        <div class="dim" style="margin-top:6px">
                            Para cambiar la imagen, elimina el registro y crea uno nuevo.
                        </div>
                    </div>
                    <div>
                        <label class="dim">Productos relacionados (máx 3)</label>
                        <input type="hidden" name="relacion_ids" id="edit_relacion_ids">
                        <input type="text"
                               id="edit_product_search"
                               class="input"
                               placeholder="Busca por nombre o código…">
                        <div class="dim" style="margin-top:4px">
                            Escribe al menos 2 caracteres para ver resultados.
                        </div>
                        <div id="edit_search_results" class="search-results"></div>
                        <div id="edit_selected_products" class="selected-chips"></div>

                        <div style="margin-top:16px">
                            <label class="dim">Campaña</label>
                            <div style="display:flex;gap:8px;align-items:center">
                                <select name="campaign_id" id="edit_campaign_id" class="select">
                                    <option value="">Sin campaña</option>
                                    @foreach($campaigns as $campaign)
                                        <option value="{{ $campaign->id }}">
                                            {{ $campaign->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-ghost btn-sm" onclick="openCampaignModal()">+</button>
                            </div>
                        </div>

                        <div style="margin-top:12px">
                            <label style="display:flex;align-items:center;gap:6px">
                                <input type="checkbox" name="activate_campaign" id="edit_activate_campaign" value="1">
                                <span class="dim">Activar esta campaña como campaña del home</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div style="display:flex;justify-content:flex-end;margin-top:18px;gap:8px">
                    <button type="button" class="btn btn-ghost" onclick="closeEditModal()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL CREAR CAMPAÑA --}}
<div id="modal-campaign" class="backdrop">
    <div class="modal">
        <div class="modal-hd">
            <h3 style="margin:0;font-weight:800">Nueva campaña</h3>
            <button class="btn btn-ghost btn-sm" type="button" onclick="closeCampaignModal()">Cerrar</button>
        </div>
        <div class="modal-bd">
            <form action="{{ route('admin.campaigns.store') }}" method="POST">
                @csrf
                <div class="grid-2">
                    <div style="grid-column:1 / -1">
                        <label class="dim">Nombre de campaña</label>
                        <input type="text" name="name" class="input" required>
                    </div>
                    <div style="grid-column:1 / -1;display:flex;align-items:center;justify-content:space-between;margin-top:8px">
                        <label style="display:flex;align-items:center;gap:6px">
                            <input type="checkbox" name="is_active" value="1">
                            <span class="dim">Marcar como campaña activa del home</span>
                        </label>
                        <span class="dim">Desactivará otras campañas activas.</span>
                    </div>
                </div>
                <div style="display:flex;justify-content:flex-end;margin-top:18px;gap:8px">
                    <button type="button" class="btn btn-ghost" onclick="closeCampaignModal()">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear campaña</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const searchProductsUrl = "{{ route('admin.index_images.search_products') }}";
    const editActionTemplate = "{{ route('admin.index_images.update', '__ID__') }}";

    // ----- helpers modales -----
    function openCreateModal() {
        document.getElementById('modal-create').style.display = 'flex';
    }
    function closeCreateModal() {
        document.getElementById('modal-create').style.display = 'none';
        resetCreateSelector();
    }
    function openEditModal(btn) {
        const row = btn.closest('.image-row');
        if (!row) return;
        const id          = row.dataset.id;
        const relacion    = row.dataset.relacion || '';
        const campaignId  = row.dataset.campaignId || '';
        const imageUrl    = row.dataset.imageUrl;

        const form = document.getElementById('editForm');
        form.action = editActionTemplate.replace('__ID__', id);
        document.getElementById('edit_title').innerText = 'Editar imagen #' + id;
        document.getElementById('edit_preview').src = imageUrl;
        document.getElementById('edit_campaign_id').value = campaignId || '';
        document.getElementById('edit_activate_campaign').checked = false;

        // reconstruir seleccionados desde IDs
        editSelected = [];
        if (relacion.trim().length) {
            relacion.split(',').forEach(v => {
                const pid = parseInt(v.trim());
                if (!isNaN(pid) && pid > 0) {
                    editSelected.push({id: pid, name: 'ID ' + pid});
                }
            });
        }
        renderEditSelected();
        syncEditHidden();
        document.getElementById('edit_search_results').style.display = 'none';
        document.getElementById('edit_search_results').innerHTML = '';
        document.getElementById('edit_product_search').value = '';

        document.getElementById('modal-edit').style.display = 'flex';
    }
    function closeEditModal() {
        document.getElementById('modal-edit').style.display = 'none';
        resetEditSelector();
    }
    function openCampaignModal() {
        document.getElementById('modal-campaign').style.display = 'flex';
    }
    function closeCampaignModal() {
        document.getElementById('modal-campaign').style.display = 'none';
    }

    // ----- selector productos: CREATE -----
    let createSelected = [];
    const createHiddenInput = document.getElementById('create_relacion_ids');
    const createSearchInput = document.getElementById('create_product_search');
    const createResultsBox  = document.getElementById('create_search_results');
    const createSelectedBox = document.getElementById('create_selected_products');
    let createSearchTimeout = null;

    function renderCreateSelected() {
        createSelectedBox.innerHTML = '';
        createSelected.forEach(prod => {
            const chip = document.createElement('div');
            chip.className = 'chip';
            chip.innerHTML = `<span>${prod.name ?? ('ID '+prod.id)}</span><button type="button" data-id="${prod.id}">&times;</button>`;
            chip.querySelector('button').addEventListener('click', () => removeCreateProduct(prod.id));
            createSelectedBox.appendChild(chip);
        });
    }
    function syncCreateHidden() {
        createHiddenInput.value = createSelected.map(p => p.id).join(',');
    }
    function addCreateProduct(prod) {
        if (createSelected.length >= 3) return;
        if (createSelected.some(p => p.id === prod.id)) return;
        createSelected.push(prod);
        renderCreateSelected();
        syncCreateHidden();
    }
    function removeCreateProduct(id) {
        createSelected = createSelected.filter(p => p.id !== id);
        renderCreateSelected();
        syncCreateHidden();
    }
    function resetCreateSelector() {
        createSelected = [];
        renderCreateSelected();
        syncCreateHidden();
        if (createSearchInput) createSearchInput.value = '';
        createResultsBox.innerHTML = '';
        createResultsBox.style.display = 'none';
    }

    function doCreateSearch(term) {
        fetch(searchProductsUrl + '?q=' + encodeURIComponent(term))
            .then(r => r.json())
            .then(data => {
                createResultsBox.innerHTML = '';
                if (!data.length) {
                    createResultsBox.style.display = 'none';
                    return;
                }
                data.forEach(prod => {
                    const item = document.createElement('div');
                    item.className = 'search-result-item';
                    item.innerHTML = `
                        <img src="${prod.image_url}" class="search-result-thumb">
                        <div>
                            <div class="search-result-name">${prod.name}</div>
                            <div class="search-result-price">ID ${prod.id} · S/ ${Number(prod.precio).toFixed(2)}</div>
                        </div>
                    `;
                    item.addEventListener('click', () => {
                        addCreateProduct(prod);
                        createResultsBox.style.display = 'none';
                        createResultsBox.innerHTML = '';
                        createSearchInput.value = '';
                    });
                    createResultsBox.appendChild(item);
                });
                createResultsBox.style.display = 'block';
            }).catch(() => {});
    }

    if (createSearchInput) {
        createSearchInput.addEventListener('input', () => {
            const term = createSearchInput.value.trim();
            clearTimeout(createSearchTimeout);
            if (term.length < 2) {
                createResultsBox.innerHTML = '';
                createResultsBox.style.display = 'none';
                return;
            }
            createSearchTimeout = setTimeout(() => doCreateSearch(term), 250);
        });
    }

    // ----- selector productos: EDIT -----
    let editSelected = [];
    const editHiddenInput = document.getElementById('edit_relacion_ids');
    const editSearchInput = document.getElementById('edit_product_search');
    const editResultsBox  = document.getElementById('edit_search_results');
    const editSelectedBox = document.getElementById('edit_selected_products');
    let editSearchTimeout = null;

    function renderEditSelected() {
        editSelectedBox.innerHTML = '';
        editSelected.forEach(prod => {
            const chip = document.createElement('div');
            chip.className = 'chip';
            chip.innerHTML = `<span>${prod.name ?? ('ID '+prod.id)}</span><button type="button" data-id="${prod.id}">&times;</button>`;
            chip.querySelector('button').addEventListener('click', () => removeEditProduct(prod.id));
            editSelectedBox.appendChild(chip);
        });
    }
    function syncEditHidden() {
        editHiddenInput.value = editSelected.map(p => p.id).join(',');
    }
    function addEditProduct(prod) {
        if (editSelected.length >= 3) return;
        if (editSelected.some(p => p.id === prod.id)) return;
        editSelected.push(prod);
        renderEditSelected();
        syncEditHidden();
    }
    function removeEditProduct(id) {
        editSelected = editSelected.filter(p => p.id !== id);
        renderEditSelected();
        syncEditHidden();
    }
    function resetEditSelector() {
        editSelected = [];
        renderEditSelected();
        syncEditHidden();
        if (editSearchInput) editSearchInput.value = '';
        editResultsBox.innerHTML = '';
        editResultsBox.style.display = 'none';
    }

    function doEditSearch(term) {
        fetch(searchProductsUrl + '?q=' + encodeURIComponent(term))
            .then(r => r.json())
            .then(data => {
                editResultsBox.innerHTML = '';
                if (!data.length) {
                    editResultsBox.style.display = 'none';
                    return;
                }
                data.forEach(prod => {
                    const item = document.createElement('div');
                    item.className = 'search-result-item';
                    item.innerHTML = `
                        <img src="${prod.image_url}" class="search-result-thumb">
                        <div>
                            <div class="search-result-name">${prod.name}</div>
                            <div class="search-result-price">ID ${prod.id} · S/ ${Number(prod.precio).toFixed(2)}</div>
                        </div>
                    `;
                    item.addEventListener('click', () => {
                        addEditProduct(prod);
                        editResultsBox.style.display = 'none';
                        editResultsBox.innerHTML = '';
                        editSearchInput.value = '';
                    });
                    editResultsBox.appendChild(item);
                });
                editResultsBox.style.display = 'block';
            }).catch(() => {});
    }

    if (editSearchInput) {
        editSearchInput.addEventListener('input', () => {
            const term = editSearchInput.value.trim();
            clearTimeout(editSearchTimeout);
            if (term.length < 2) {
                editResultsBox.innerHTML = '';
                editResultsBox.style.display = 'none';
                return;
            }
            editSearchTimeout = setTimeout(() => doEditSearch(term), 250);
        });
    }
</script>
</body>
</html>
