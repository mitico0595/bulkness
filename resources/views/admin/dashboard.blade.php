<?php
/**
* =============================================================
* resources/views/admin/dashboard.blade.php
* (Blade FINAL: mismo layout/animaciones que tu HTML; ahora consume endpoints reales)
* - Endpoints esperados (GET):
*   • route('admin.dashboard.data')      ?range=day|week|month|ytd|7d|30d|qtr
*   • route('admin.dashboard.inv')       ?range=7d|30d|qtr|ytd
*   • route('admin.dashboard.ratios')
* - Si no hay datos suficientes: muestra "Datos no establecidos aún" + requisito mínimo.
* =============================================================
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard | Admin</title>
  @include ('global.icon')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.6"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link rel="stylesheet" href="{{ asset('css/ui-slider.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    :root{
      --bg:#f6f7fb;
      --panel:#ffffff;
      --muted:#7b8aa3;
      --text:white;
      --sub:#0f172a;
      --border:#fdef563b;
      --shadow:0 10px 30px rgba(32,41,63,.08);
      --radius:16px;
      --accent:#fb4949;
      --accent-2:#ff1e1e;
      --t-main:560ms;
      --ease-main:cubic-bezier(0.22,0.61,0.36,1);
      /* scrollbar */
      --sb-size: 10px;
      --sb-radius: 999px;
      --sb-track: rgba(0,0,0,.06);
      --sb-thumb: rgba(17,24,39,.38);
      --sb-thumb-hover: rgba(17,24,39,.55);
      --sb-thumb-active: rgba(17,24,39,.75);
      --sb-corner: transparent;
      /* tablas */
      --row-line:#fff7b080;
      --thead-bg:#fff7b080;
      --thead-fg:#fff7b0;
    }

    /* Scrollbars */
    *{scrollbar-width:thin; scrollbar-color:var(--sb-thumb) var(--sb-track);}
    *::-webkit-scrollbar{ width:var(--sb-size); height:var(--sb-size);}
    *::-webkit-scrollbar-track{ background:var(--sb-track); border-radius:var(--sb-radius);}
    *::-webkit-scrollbar-thumb{ background-clip:padding-box; border:2px solid transparent; background-color:var(--sb-thumb); border-radius:var(--sb-radius);}
    *::-webkit-scrollbar-thumb:hover{ background-color:var(--sb-thumb-hover);}
    *::-webkit-scrollbar-thumb:active{ background-color:var(--sb-thumb-active);}
    *::-webkit-scrollbar-corner{ background:var(--sb-corner);}
    @media (hover:hover){
      *::-webkit-scrollbar-thumb:hover{
        background-image:linear-gradient(180deg,var(--accent),var(--accent-2));
        background-color:transparent;
      }
    }
    :where(.table-container,.sales-table-wrap,.inv-table-wrap,.rot-table,.ratios-table-wrap){ --sb-size:12px; }
    .no-custom-scrollbar, .no-custom-scrollbar *{ scrollbar-width:auto; scrollbar-color:auto; }
    .no-custom-scrollbar::-webkit-scrollbar{ width:initial; height:initial; }
    .no-custom-scrollbar::-webkit-scrollbar-thumb{ background:initial; border:none; border-radius:initial; }

    *{box-sizing:border-box}
    body{
      margin:0; font-family:Inter,system-ui,Segoe UI,Roboto,Arial,sans-serif; color:var(--text);
      background: radial-gradient(ellipse at center, hsl(49.13deg 68% 45%) 0%, hsl(44.82deg 61% 42%) 44%, hsl(59.87deg 58% 36%) 100%);
      min-height:100vh;
    }

    /* Fondo animado de rectángulos */
    .bg-room{position:fixed; inset:0; opacity:.6; pointer-events:none; z-index:0}
    .float-rect{ position:absolute; border-radius:12px; background:rgba(255,255,255,.08); box-shadow:0 10px 30px rgba(0,0,0,.08); filter:saturate(.9); will-change:transform; }

    .app{display:grid; grid-template-columns:260px 1fr; min-height:100vh; position:relative; z-index:1}

    /* Sidebar rojo */
    .sidebar{position:sticky; top:0; height:100vh; padding:16px}
    .sidebar .inner{
      height:100%; display:flex; flex-direction:column; justify-content:flex-start;
      background:linear-gradient(180deg, #fbec4945 0%, #ffe21e47 60%, #ff4a4a00 100%);
      border-radius:20px; padding:20px; color:#fff; position:relative
    }
    .brand{display:flex; align-items:center; gap:10px; margin:6px 0 18px}
    .nav{display:flex; flex-direction:column; gap:6px; margin-top:100px}
    .nav a{display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:12px; color:#111827; opacity:.95; text-decoration:none}
    .nav a.active,.nav a:hover{background:rgba(255,255,255,.34); color:#fff}
    .sb-foot{color:#ffe9e2; opacity:.85; font-size:12px; text-align:center; margin-top:auto}

    /* Main */
    .main{padding:18px}
    .topbar{display:flex; align-items:center; justify-content:space-between; margin-bottom:14px}
    .user{display:flex; align-items:center; gap:10px; background:linear-gradient(180deg,var(--accent),var(--accent-2)); color:#fff; padding:10px 12px; border-radius:14px}
    .avatar{width:36px; height:36px; border-radius:10px; background:#ffd4d4; color:#b40909; display:grid; place-items:center; font-weight:800}

    /* Header filtros */
    .header{display:flex; align-items:center; justify-content:space-between; margin:10px 0 18px}
    .range-switch{display:flex; gap:8px; flex-wrap:wrap}
    .seg{padding:8px 14px; border:none; border-radius:10px; background:#ffffff2e; color:white; cursor:pointer; font-weight:100}
    .seg.active{background:#72727229; color:#fff}
    .btn{display:inline-flex; align-items:center; gap:8px; padding:10px 14px; border-radius:12px; border:1px solid var(--border); background:#fff; cursor:pointer}

    /* KPI CAROUSEL */
    .kpi-carousel{position:relative; perspective:1600px; margin-bottom:8px}
    .kpi-stage{position:relative; height:118px}
    .kpi-nav{ position:absolute; top:50%; transform:translateY(-50%); width:38px; height:38px; border:none; border-radius:10px; cursor:pointer; background:rgba(255,255,255,0.09); box-shadow:var(--shadow); display:grid; place-items:center; z-index:2 }
    .kpi-prev{left:-6px} .kpi-next{right:-6px}
    .kpi-nav svg{width:18px; height:18px; stroke:#111827; fill:none; stroke-width:2}
    .stats-grid{display:block; gap:14px}
    .stats-grid.kpi-mode{position:relative; height:118px}
    .stats-grid.kpi-mode .stat-card{
      position:absolute; top:0; left:50%; transform:translateX(-50%);
      width:min(520px,92vw); will-change:transform,opacity,filter;
      transition:transform var(--t-main) var(--ease-main), opacity var(--t-main) var(--ease-main), filter var(--t-main) var(--ease-main)
    }

    /* Cards KPI */
    .stat-card{background:#fff; border:1px solid var(--border); border-radius:16px; padding:18px; position:relative}
    .stat-title{font-size:12px; letter-spacing:.06em; color:white; text-transform:uppercase; margin-bottom:6px; text-align:center}
    .stat-amount{font-size:28px; font-weight:800; color:white; text-align:center}
    .stat-sub{font-size:12px; color:#ffdca4; margin-top:6px; text-align:center}
    .spark{position:relative; width:100%; height:40px; opacity:.5}

    /* Cards y tablas */
    .grid-3{display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:16px; margin-top:16px}
    .card{border:1px solid var(--border); border-radius:16px; padding:18px}
    .card-hd{display:flex; align-items:center; justify-content:space-between; margin-bottom:10px}
    .card-title{font-weight:800}
    .table-container{overflow:auto}
    table{width:100%; border-collapse:collapse; font-size:14px}
    thead th{padding:10px 12px; text-align:left; color:var(--thead-fg)!important; font-size:12px; text-transform:uppercase; border-bottom:1px solid var(--thead-bg)}
    tbody td{padding:10px 12px; border-bottom:1px solid #f3f4f6}
    tbody tr:hover{background:#00000047}

    /* Bloques principales */
    .sales-block,.ratios-block,.inventory-block{border:1px solid var(--border); border-radius:16px; padding:14px; width:100%; margin-top:40px}
    .sales-flex,.inv-flex{display:grid; grid-template-columns:1.1fr .9fr; gap:14px; align-items:start}
    .sales-side,.inv-side{max-height:260px; padding-right:6px}
    .sales-table-wrap,.inv-table-wrap{overflow:auto; height:300px}
    .sales-table-wrap .table-container,.inv-table-wrap .table-container{overflow:visible}
    .sales-kpis,.mini-kpis,.inv-kpis{display:flex; gap:10px; flex-wrap:wrap; margin-top:10px}
    .sales-kpis .k,.mini-kpis .k,.inv-kpis .k{background:none; border:1px solid #eef2ff; border-radius:10px; padding:8px 10px; font-size:12px}
    .note{color:#6b7280; font-size:12px; margin-top:8px}

    /* Tabs de ratios */
    .inner-tabs{display:flex; gap:8px; margin:8px 0}
    .inner-tabs .seg{padding:8px 14px; border:1px solid var(--border); border-radius:10px; background:#fff; color:#6b7280; cursor:pointer; font-weight:600}
    .inner-tabs .seg.active{background:#111827; color:#fff; border-color:#111827}
    .tab-panel{margin-top:10px}

    /* Layout ratios 2 cols */
    .ratios-flex{display:grid; grid-template-columns:1.1fr .9fr; gap:14px; align-items:start; width:100%}
    .ratios-side{max-height:260px; padding-right:6px}
    .ratios-table-wrap{overflow:auto; height:300px}
    .ratios-table-wrap .table-container{overflow:visible}

    /* TOP panels */
    .panel-tabs{display:flex; gap:8px; align-items:center}
    .seg.small{padding:6px 10px; font-size:12px; border-radius:8px}
    .sales-top-grid{display:grid; grid-template-columns:1.4fr 1fr 1fr; gap:14px}
    .inv-top-grid{display:grid; grid-template-columns:1.2fr 1fr; gap:14px}
    @media (max-width:1100px){
      .app{grid-template-columns:1fr}
      .sidebar{position:fixed; inset:0 auto 0 0; width:260px; transform:translateX(-100%); transition:.25s; z-index:60}
      .sidebar.open{transform:translateX(0)}
      .main{padding:12px}
      .sales-flex,.ratios-grid,.inv-flex{grid-template-columns:1fr}
      .sales-side,.inv-side{max-height:unset; padding-right:0}
      .sales-table-wrap,.inv-table-wrap{height:auto}
      .kpi-prev{left:-4px}.kpi-next{right:-4px}
      .ratios-flex{grid-template-columns:1fr}
      .ratios-side{max-height:unset; padding-right:0}
      .ratios-table-wrap{height:auto}
      .sales-top-grid{grid-template-columns:1fr}
      .inv-top-grid{grid-template-columns:1fr}
    }

    .muted{color:#ee9e00b5}
    .icon-apple{
      background:rgba(255,255,255,0.1);
      backdrop-filter:blur(2px); -webkit-backdrop-filter:blur(2px);
      border:1px solid transparent; background-clip:padding-box; border-radius:24px;
      box-shadow:0 8px 32px rgba(0,0,0,0.3), inset 0 1px 0 rgba(255,255,255,0.2), inset 0 -1px 0 rgba(255,255,255,0.1);
      overflow:hidden;
    }

    /* Líneas de filas más sutiles */
    table { border-collapse:collapse; border-spacing:0; }
    tbody td, tbody th { border:0; }
    tbody tr > * { border-top:1px solid var(--row-line, var(--border)); }
    tbody tr:first-child > * { border-top:0; }
    tbody tr:last-child > * { border-bottom:1px solid var(--row-line, var(--border)); }

    /* Animaciones */
    .gone{display:none}
    .anim-in{animation:fadeInUp .28s ease-out both}
    .anim-out{animation:fadeOutDown .2s ease-in both}
    @keyframes fadeInUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
    @keyframes fadeOutDown{from{opacity:1;transform:translateY(0)}to{opacity:0;transform:translateY(8px)}}

    /* Empty states sobre charts/tablas */
    .empty{
      display:flex; align-items:center; justify-content:center; text-align:center;
      min-height:180px; padding:14px; border:1px dashed #ffffff4a; border-radius:14px; color:#ffe9e2; background:rgba(255,255,255,0.06);
    }
    .empty small{display:block; opacity:.85; margin-top:6px}
  </style>
</head>
<body>
  <!-- Fondo animado de rectángulos -->
  <div class="bg-room" id="bgRoom" aria-hidden="true"></div>

  <div class="app">
    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
      <div class="inner">
        <div class="brand" style="position:absolute;top:10px;left:15px">
          <a href="{{asset('/')}}"><img src="{{asset('image/logo.webp')}}" alt="" style="width:50%"></a>
        </div>
        <nav class="nav">
          <a href="{{route('admin.dashboard')}}" class="active"><span class="material-symbols-outlined">dashboard</span>Dashboard</a>
          <a href="{{asset('admin/ventas')}}"><span class="material-symbols-outlined">attach_money</span>Ventas</a>
          <a href="{{asset('admin/envios')}}"><span class="material-symbols-outlined">local_shipping</span>Envíos</a>
          <a href="{{ route('admin.index_images.index') }}" ><span class="material-symbols-outlined">photo_library</span>Editor</a>
          <a href="#"><span class="material-symbols-outlined">shopping_cart</span>Compras</a>
          <a href="{{asset('admin/productos')}}"><span class="material-symbols-outlined">barcode_scanner</span>Inventario</a>
          
          <a href="#"><span class="material-symbols-outlined">confirmation_number</span>Cupones</a>
          
          <a href="{{asset('admin/usuarios')}}"><span class="material-symbols-outlined">contacts_product</span>Usuarios</a>
          <a href="#"><span class="material-symbols-outlined">settings</span>Configuración</a>
        </nav>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="logout-btn" style="cursor:pointer;color:white;position:absolute;right:25%;background:none;border:1px solid white;padding:10px;width:50%;border-radius:10px;bottom:35px;">
            Logout
          </button>
        </form>
        <div class="sb-foot">© {{ date('Y') }} {{env('DEVELOPER_NAME')}}</div>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="main">
      <div class="topbar">
        <div style="display:flex;align-items:center;gap:10px">
          <div style="font-weight:800;font-size:22px;color:var(--sub)">Dashboard</div>
          <div style="color:var(--muted);font-size:12px" id="rangeLabel">Análisis: Hoy</div>
        </div>
        <div class="user icon-apple">
          <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}</div>
          <div style="display:flex;flex-direction:column;line-height:1">
            <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
            <span style="opacity:.9">{{ auth()->user()->email ?? 'admin@correo.com' }}</span>
          </div>
        </div>
      </div>

      <div class="header">
        <div class="range-switch" id="rangeSwitch">
          <button class="seg active" data-range="day">Día</button>
          <button class="seg" data-range="week">Semana</button>
          <button class="seg" data-range="month">Mes</button>
          <button class="seg" data-range="ytd">YTD</button>
        </div>
        <div><button class="btn" id="btnRefresh">Actualizar</button></div>
      </div>

      <!-- KPIs en carrusel -->
      <div class="kpi-carousel">
        <button class="kpi-nav kpi-prev" id="kpiPrev" aria-label="Anterior">
          <svg viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
        </button>

        <div class="kpi-stage">
          <div class="stats-grid kpi-mode" id="kpiGrid">
            <div id="stataVenta" class="stat-card icon-apple" style="cursor:pointer">
              <div class="stat-title">Ventas</div>
              <div class="stat-amount" id="kpiSales">S/ 0</div>
              <div class="stat-sub"><span id="kpiOrders">0 órdenes</span> · neto sin envío</div>
              <canvas id="sparkSales" class="spark"></canvas>
            </div>
            <div id="stataRatios" class="stat-card icon-apple" style="cursor:pointer">
              <div class="stat-title">Ratios</div>
              <div class="stat-amount" id="kpis">Ratio rotación</div>
              <div class="stat-sub" id="kpiCogsPerOrder">Ratios en general</div>
              <canvas id="sparkCogs" class="spark"></canvas>
            </div>
            <div id="stataInventario" class="stat-card icon-apple" style="cursor:pointer">
              <div class="stat-title">Inventario</div>
              <div class="stat-amount" id="kpiLiquid">S/ 0</div>
              <div class="stat-sub" id="kpiSpend">Gasto campañas: S/ 0</div>
              <canvas id="sparkLiquid" class="spark"></canvas>
            </div>
          </div>
        </div>

        <button class="kpi-nav kpi-next" id="kpiNext" aria-label="Siguiente">
          <svg viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></svg>
        </button>
      </div>

      <!-- Bloques integrados -->
      <div style="display:flex;width:100%;padding:14px 0;flex-direction:column;gap:14px">

        <!-- BLOQUE 1: Ventas por rango -->
        <div class="sales-block icon-apple" id="salesBlock">
          <div class="card-hd" style="margin-bottom:12px">
            <div class="card-title">Ventas por rango</div>
            <div class="panel-tabs">
              <div class="range-switch" id="salesRangeControls">
                <button class="seg active" data-range="7d">7 días</button>
                <button class="seg" data-range="30d">30 días</button>
                <button class="seg" data-range="qtr">Trimestral</button>
                <button class="seg" data-range="ytd">YTD</button>
              </div>
              <button class="seg" id="btnSalesTop">TOP</button>
            </div>
          </div>

          <!-- Slider demo (mantengo tu control) -->
          <div style="margin:8px 0 6px">
            <label for="descuentoInput" style="display:block;font-size:12px;color:#6b7280;margin-bottom:6px">Descuento</label>
            <div class="ui-slider ui-slider--sm" data-min="0" data-max="100" data-step="5" data-value="35" data-autoshow data-min-height="60">
              <input id="descuentoInput" class="ui-slider__input" type="range" name="descuento" min="0" max="100" step="5" value="35" aria-label="Descuento">
              <div class="ui-slider__track"><div class="ui-slider__fill"></div><div class="ui-slider__thumb"></div></div>
              <output class="ui-slider__value">35</output>
            </div>
          </div>

          <!-- Serie -->
          <div class="sales-flex" id="salesSeriePanel">
            <div class="sales-side">
              <div id="salesChartWrap" style="height:220px; position:relative">
                <canvas id="salesChart2"></canvas>
                <div class="empty gone" id="salesEmpty">Datos no establecidos aún
                  <small>Se requieren al menos 3 órdenes en el periodo para mostrar el gráfico.</small>
                </div>
              </div>
              <div class="sales-kpis">
                <div class="k">Pedidos: <strong id="srKpiOrders">0</strong></div>
                <div class="k">Ingresos: <strong id="srKpiRevenue">S/ 0</strong></div>
                <div class="k">Ticket medio: <strong id="srKpiAOV">S/ 0</strong></div>
              </div>
              <div class="note" id="srRangeNote">Rango: últimos 7 días</div>
            </div>
            <div class="sales-table-wrap">
              <div class="table-container">
                <table id="salesTable2">
                  <thead>
                    <tr>
                      <th>Periodo</th>
                      <th style="text-align:right">Pedidos</th>
                      <th style="text-align:right">Ingresos</th>
                      <th style="text-align:right">Ticket medio</th>
                    </tr>
                  </thead>
                  <tbody id="salesTBody">
                    <tr class="emptyRow"><td colspan="4" style="padding:18px 12px; color:#ffe9e2; background:rgba(255,255,255,0.06); border-radius:12px;">Datos no establecidos aún</td></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- TOP -->
          <div class="gone" id="salesTopPanel">
            <div class="sales-top-grid">
              <!-- Últimas 10 ventas -->
              <div class="card">
                <div class="card-hd"><div class="card-title">Últimas 10 ventas</div></div>
                <div class="table-container" style="max-height:342px;overflow:auto">
                  <table>
                    <thead>
                      <tr><th>Fecha</th><th>Cliente</th><th>Items</th><th>Total productos</th><th>Método</th><th>Cupón</th></tr>
                    </thead>
                    <tbody id="srLast10Body">
                      <tr class="emptyRow"><td colspan="6" style="padding:18px 12px; color:#ffe9e2; background:rgba(255,255,255,0.06); border-radius:12px;">Datos no establecidos aún</td></tr>
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Top clientes -->
              <div class="card">
                <div class="card-hd" style="gap:8px"><div class="card-title">Top clientes</div></div>
                <div class="range-switch" id="custTopRangeControls" style="margin-bottom:8px">
                  <button class="seg small active" data-range="7d">7d</button>
                  <button class="seg small" data-range="30d">30d</button>
                  <button class="seg small" data-range="qtr">Trimestral</button>
                  <button class="seg small" data-range="ytd">YTD</button>
                </div>
                <div class="panel-tabs" id="custMetricSwitch" style="margin-bottom:8px">
                  <button class="seg small active" data-metric="orders">Órdenes</button>
                  <button class="seg small" data-metric="spend">Gasto</button>
                </div>
                <div style="height:240px; position:relative">
                  <canvas id="custPie"></canvas>
                  <div class="empty gone" id="custEmpty">Datos no establecidos aún
                    <small>Se requieren al menos 3 clientes con órdenes en el periodo.</small>
                  </div>
                </div>
                <div class="note" id="custNote" style="margin-top:8px">Top 5 por órdenes</div>
              </div>

              <!-- Top cupones (90 días) -->
              <div class="card">
                <div class="card-hd"><div class="card-title">Top cupones (90 días)</div></div>
                <div style="height:240px; position:relative">
                  <canvas id="couponPie90"></canvas>
                  <div class="empty gone" id="couponEmpty">Datos no establecidos aún
                    <small>Se requieren al menos 2 usos de cupones en los últimos 90 días.</small>
                  </div>
                </div>
                <div class="note">Top 5 por usos</div>
              </div>
            </div>
          </div>
        </div>

        <!-- BLOQUE 2: Ratios -->
        <div class="ratios-block gone icon-apple" id="ratiosBlock">
          <div class="card-hd" style="margin-bottom:8px">
            <div class="card-title">Ratios (general)</div>
            <div class="k" id="rtGeneral" style="border:1px solid #eef2ff;border-radius:10px;padding:6px 10px;font-size:12px">
              Rotación 0.0x
            </div>
          </div>

          <div class="inner-tabs" id="ratiosTabs">
            <button class="seg active" data-tab="log">Logística</button>
            <button class="seg" data-tab="inv">Inventario</button>
          </div>

          <!-- LOGÍSTICA -->
          <div class="tab-panel" id="tabLog">
            <div style="height:220px; margin-bottom:10px; position:relative">
              <canvas id="logChart"></canvas>
              <div class="empty gone" id="logEmpty">Datos no establecidos aún
                <small>Se requieren al menos 3 órdenes por semana en las últimas 8 semanas.</small>
              </div>
            </div>
            <div class="mini-kpis">
              <div class="k">Costo envío/orden: <strong id="lgAvgShip">S/ 0</strong></div>
              <div class="k">% envío gratis: <strong id="lgFreePct">0%</strong></div>
              <div class="k">Costo envío total: <strong id="lgTotalShip">S/ 0</strong></div>
            </div>
          </div>

          <!-- INVENTARIO (dentro de Ratios) -->
          <div class="tab-panel gone" id="tabInv">
            <div class="ratios-flex">
              <div class="ratios-side">
                <div style="height:220px; position:relative">
                  <canvas id="invChart"></canvas>
                  <div class="empty gone" id="invRotEmpty">Datos no establecidos aún
                    <small>Se requieren ventas en los últimos 30 días para calcular rotación.</small>
                  </div>
                </div>
                <div class="mini-kpis" style="margin-top:10px">
                  <div class="k">Rotación global (30d): <strong id="invRotGlobal">0.0x</strong></div>
                  <div class="k">DOH prom. top 5: <strong id="invDOH">0 días</strong></div>
                  <div class="k">Stock total: <strong id="invStock">0 u.</strong></div>
                </div>
              </div>
              <div class="ratios-table-wrap">
                <div class="table-container">
                  <table>
                    <thead>
                      <tr>
                        <th>SKU</th>
                        <th>Stock</th>
                        <th>Vendidas (30d)</th>
                        <th>Días restantes</th>
                        <th>Rotación 30d (x)</th>
                      </tr>
                    </thead>
                    <tbody id="rotBody">
                      <tr class="emptyRow"><td colspan="5" style="padding:18px 12px; color:#ffe9e2; background:rgba(255,255,255,0.06); border-radius:12px;">Datos no establecidos aún</td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- BLOQUE 3: Inventarios por rango -->
        <div class="inventory-block gone icon-apple" id="inventoryBlock">
          <div class="card-hd" style="margin-bottom:12px">
            <div class="card-title">Inventarios por rango</div>
            <div class="panel-tabs">
              <div class="range-switch" id="invRangeControls2">
                <button class="seg active" data-range="7d">7 días</button>
                <button class="seg" data-range="30d">30 días</button>
                <button class="seg" data-range="qtr">Trimestral</button>
                <button class="seg" data-range="ytd">YTD</button>
              </div>
              <button class="seg" id="btnInvTop">TOP</button>
            </div>
          </div>

          <!-- Serie -->
          <div class="inv-flex" id="invSeriePanel">
            <div class="inv-side">
              <div style="height:220px; position:relative">
                <canvas id="invChart2"></canvas>
                <div class="empty gone" id="invEmpty">Datos no establecidos aún
                  <small>Se requieren al menos 2 periodos con ventas para mostrar COGS y unidades.</small>
                </div>
              </div>
              <div class="inv-kpis">
                <div class="k">Unidades vendidas: <strong id="invKpiUnits">0</strong></div>
                <div class="k">COGS: <strong id="invKpiCogs">S/ 0</strong></div>
                <div class="k">Costo prom. u.: <strong id="invKpiCPU">S/ 0</strong></div>
              </div>
              <div class="note" id="invRangeNote">Rango: últimos 7 días</div>
            </div>
            <div class="inv-table-wrap">
              <div class="table-container">
                <table id="invTable2">
                  <thead>
                    <tr>
                      <th>Periodo</th>
                      <th style="text-align:right">Unidades</th>
                      <th style="text-align:right">COGS</th>
                      <th style="text-align:right">Costo prom. u.</th>
                    </tr>
                  </thead>
                  <tbody id="invTBody">
                    <tr class="emptyRow"><td colspan="4" style="padding:18px 12px; color:#ffe9e2; background:rgba(255,255,255,0.06); border-radius:12px;">Datos no establecidos aún</td></tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- TOP inventario -->
          <div class="gone" id="invTopPanel">
            <div class="inv-top-grid">
              <div class="card">
                <div class="card-hd" style="gap:8px">
                  <div class="card-title">Top 7 productos</div>
                </div>
                <div class="panel-tabs" id="invMetricSwitch" style="margin-bottom:8px">
                  <button class="seg small active" data-metric="units">Cantidad</button>
                  <button class="seg small" data-metric="cogs">PEN</button>
                </div>
                <div style="height:260px; position:relative">
                  <canvas id="invTopPie"></canvas>
                  <div class="empty gone" id="invTopEmpty">Datos no establecidos aún
                    <small>Se requieren ventas en el rango seleccionado.</small>
                  </div>
                </div>
                <div class="note" id="invTopNote">Top 7 por cantidad</div>
              </div>

              <div class="card">
                <div class="card-hd"><div class="card-title">10 productos con menor stock</div></div>
                <div class="table-container" style="max-height:320px;overflow:auto">
                  <table>
                    <thead><tr><th>SKU</th><th>Producto</th><th style="text-align:right">Stock</th></tr></thead>
                    <tbody id="invLow10Body">
                      <tr class="emptyRow"><td colspan="3" style="padding:18px 12px; color:#ffe9e2; background:rgba(255,255,255,0.06); border-radius:12px;">Datos no establecidos aún</td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div><!-- /inventory-block -->
      </div><!-- /bloques -->

    </main>
  </div><!-- /app -->

  <!-- Fondo animado -->
  <script>
    (function(){
      const bgRoom = document.getElementById('bgRoom');
      const RECT_COUNT = 5;
      const rects = [];
      function rand(min,max){ return Math.random()*(max-min)+min; }
      function createRects(){
        if(!bgRoom) return;
        bgRoom.innerHTML = '';
        rects.length = 0;
        const vw = window.innerWidth, vh = window.innerHeight;
        for(let i=0;i<RECT_COUNT;i++){
          const w = Math.round(rand(80, 180));
          const h = Math.round(rand(90, 200));
          const x = Math.round(rand(0, vw - w));
          const y = Math.round(rand(0, vh - h));
          const vx = rand(0.45, 1.2) * (Math.random()<.5?-1:1);
          const vy = rand(0.45, 1.2) * (Math.random()<.5?-1:1);
          const el = document.createElement('div');
          el.className = 'float-rect';
          el.style.width = w+'px'; el.style.height = h+'px';
          bgRoom.appendChild(el);
          rects.push({el,x,y,w,h,vx,vy,phase: rand(0,Math.PI*2)});
        }
      }
      function tick(t){
        const vw = window.innerWidth, vh = window.innerHeight;
        for(const r of rects){
          r.x += r.vx; r.y += r.vy;
          if(r.x <= 0 || r.x + r.w >= vw){ r.vx *= -1; r.x = Math.max(0, Math.min(vw - r.w, r.x)); }
          if(r.y <= 0 || r.y + r.h >= vh){ r.vy *= -1; r.y = Math.max(0, Math.min(vh - r.h, r.y)); }
          const s = 1 + Math.sin(t/900 + r.phase)*0.06;
          r.el.style.transform = `translate(${r.x}px, ${r.y}px) scale(${s})`;
        }
        requestAnimationFrame(tick);
      }
      createRects();
      requestAnimationFrame(tick);
      window.addEventListener('resize', createRects, {passive:true});
    })();
  </script>

  <!-- ====== JS funcional con datos reales ====== -->
  <script>
    /* ================== Utils ================== */
    const PENf = new Intl.NumberFormat('es-PE',{style:'currency',currency:'PEN',maximumFractionDigits:0});
    const INTf = new Intl.NumberFormat('es-PE',{maximumFractionDigits:0});
    const $ = s => document.querySelector(s);
    const byId = id => document.getElementById(id);
    const show = (el,flag) => el.classList[flag?'remove':'add']('gone');
    const setText = (id,txt) => { const el=byId(id); if(el) el.textContent = txt; };
    const fetchJSON = async (url, params={})=>{
      const u = new URL(url, window.location.origin);
      Object.entries(params).forEach(([k,v])=> u.searchParams.set(k,v));
      const r = await fetch(u.toString(), { headers:{'X-Requested-With':'XMLHttpRequest'}});
      if(!r.ok) throw new Error('Error '+r.status);
      return await r.json();
    };
    const hasMinOrders = (ordersArr, min=3) => (ordersArr||[]).reduce((a,b)=>a+(+b||0),0) >= min;
    const nonEmpty = arr => Array.isArray(arr) && arr.length>0;
    const last = arr => (arr && arr.length ? arr[arr.length-1] : null);

    /* ================== Paleta para Chart.js ================== */
    const PALETTE = {
      legend:'rgba(216, 193, 17, 0.14)',
      text:'#656009cc',
      muted:'#ffffffff',
      grid:'#655a0915',
      bar:'#937e075f',
      line:'#6b7280',
      barA:'#111827',
      doughnut: ['#111827','#2563eb','#fb4949','#059669','#a855f7','#f59e0b','#ef4444']
    };

    /* ================== Sparkline manual ================== */
    function drawSpark(id, data){
      const c = byId(id); if(!c) return;
      const ctx = c.getContext('2d');
      const dpr = window.devicePixelRatio || 1;
      const cssW = c.clientWidth || 300;
      const cssH = c.clientHeight || 40;
      c.width = Math.max(1, Math.floor(cssW * dpr));
      c.height= Math.max(1, Math.floor(cssH * dpr));
      ctx.setTransform(dpr,0,0,dpr,0,0);
      const w=cssW, h=cssH, pad=6;
      const arr = (data||[]).map(v=>+v||0);
      const max=Math.max(...arr,1), min=Math.min(...arr,0);
      const sx=(w-2*pad)/Math.max(1,arr.length-1), sy=(h-2*pad)/(max-min || 1);
      ctx.clearRect(0,0,w,h);
      ctx.beginPath(); ctx.lineWidth=1.5; ctx.strokeStyle='#111827';
      arr.forEach((v,i)=>{const x=pad+i*sx, y=h-pad-((v-min)*sy); if(i===0) ctx.moveTo(x,y); else ctx.lineTo(x,y);});
      ctx.stroke();
      const grd=ctx.createLinearGradient(0,pad,0,h); grd.addColorStop(0,'rgba(17,24,39,.08)'); grd.addColorStop(1,'rgba(17,24,39,0)');
      ctx.lineTo(w-pad,h-pad); ctx.lineTo(pad,h-pad); ctx.closePath(); ctx.fillStyle=grd; ctx.fill();
    }

    /* ================== Estado de rangos ================== */
    let kpiRangeKey = 'day';     // Día | Semana | Mes | YTD (para tarjetas KPI)
    let salesRangeKey = '7d';    // 7d | 30d | qtr | ytd (para bloque Ventas)
    let invRangeKey   = '7d';    // 7d | 30d | qtr | ytd (para bloque Inventario)
    let ratiosCache   = null;

    function labelFromRange(k){
      if(k==='day') return 'Análisis: Hoy';
      if(k==='week') return 'Análisis: Semana';
      if(k==='month') return 'Análisis: Mes';
      if(k==='ytd') return 'Análisis: YTD';
      return 'Análisis';
    }

    /* ================== CHARTS refs ================== */
    let salesChart2, custPie, couponPie, logChart, invChartBar, invChart2, invTopPie;

    /* ================== Carga KPIs + ventas TOP (endpoint data) ================== */
    async function loadKPIAndSales(rangeKeyForKpi, rangeKeyForSales){
      // KPIs + ventas serie consumen el mismo endpoint /data con el rango deseado
      const data = await fetchJSON(`{{ route('admin.dashboard.data') }}`, { range: rangeKeyForSales || rangeKeyForKpi });

      // KPIs
      const k = data.kpis || {};
      setText('kpiSales', PENf.format(Math.round(k.revenue || 0)));
      setText('kpiOrders', `${INTf.format(k.orders || 0)} órdenes`);
      setText('kpiLiquid', PENf.format(Math.round(k.inventory || 0)));
      setText('kpiSpend', 'Gasto campañas: ' + PENf.format(Math.round(k.campaign_spend || 0)));

      // Sparklines
      drawSpark('sparkSales', (data.sales?.revenue||[]).slice(-12));
      drawSpark('sparkCogs',  (data.sales?.cogs||[]).slice(-12));
      drawSpark('sparkLiquid',[k.inventory||0]);

      // Ratio global desde /ratios una única vez
      const inv = await loadRatiosOnce();
      if(inv){ setText('kpis', `Ratio: ${(inv.rot_global||0).toFixed(1)}x`); }

      // Bloque Ventas por rango (serie + tabla)
      renderSalesBlockFromData(data, rangeKeyForSales);
      // Bloque TOP: últimas 10, top clientes, cupones
      renderSalesTopFromData(data);
    }

    function ensureDoughnut(ctx){
      return new Chart(ctx, { type:'doughnut', data:{labels:[],datasets:[{data:[], backgroundColor:PALETTE.doughnut, borderColor:'#ffffff19'}]}, options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'bottom'}}} });
    }

    function renderSalesTopFromData(data){
      // Últimas 10 ventas
      const last = data.last10 || [];
      const lastBody = byId('srLast10Body');
      if(!nonEmpty(last)){
        lastBody.innerHTML = `<tr class="emptyRow"><td colspan="6" style="padding:18px 12px; color:#ffe9e2; background:rgba(255,255,255,0.06); border-radius:12px;">Datos no establecidos aún</td></tr>`;
      } else {
        lastBody.innerHTML = last.map(v=>{
          const fecha = new Date(v.fecha_hora);
          const dt = fecha.toLocaleString('es-PE',{day:'2-digit',month:'short',hour:'2-digit',minute:'2-digit'});
          return `<tr>
            <td class="muted">${dt}</td>
            <td style="font-weight:700;color:#111827">${v.cliente || 'Cliente'}</td>
            <td>${INTf.format(v.items||0)}</td>
            <td>${PENf.format(Math.round(v.total||0))}</td>
            <td class="muted">${v.metodo || '—'}</td>
            <td class="muted">${v.cupon || '—'}</td>
          </tr>`;
        }).join('');
      }

      // Top clientes default por gasto (puedes alternar con los botones)
      const topC = (data.top_customers||[]).slice(0,5);
      const custEmpty = byId('custEmpty');
      if(!nonEmpty(topC)){
        show(custEmpty,true);
        if(!custPie) custPie = ensureDoughnut(byId('custPie').getContext('2d'));
        custPie.data.labels = ['Sin datos'];
        custPie.data.datasets[0].data = [1];
        custPie.update();
      } else {
        show(custEmpty,false);
        if(!custPie) custPie = ensureDoughnut(byId('custPie').getContext('2d'));
        custPie.data.labels = topC.map(x=>x.nombre||'Cliente');
        custPie.data.datasets[0].data = topC.map(x=>Math.round(x.spend||0));
        custPie.update();
        setText('custNote','Top 5 por gasto');
      }

      // Top cupones 90 días
      const t90 = (data.top_coupons_90||[]).slice(0,5);
      const couponEmpty = byId('couponEmpty');
      if(!nonEmpty(t90)){
        show(couponEmpty,true);
        if(!couponPie) couponPie = ensureDoughnut(byId('couponPie90').getContext('2d'));
        couponPie.data.labels=['Sin datos'];
        couponPie.data.datasets[0].data=[1];
        couponPie.update();
      } else {
        show(couponEmpty,false);
        if(!couponPie) couponPie = ensureDoughnut(byId('couponPie90').getContext('2d'));
        couponPie.data.labels=t90.map(x=>x.codigo||'—');
        couponPie.data.datasets[0].data=t90.map(x=>x.usos||0);
        couponPie.update();
      }
    }

    function renderSalesBlockFromData(data, rangeKey){
      const labels = data.sales?.labels || [];
      const revenue = data.sales?.revenue || [];
      const orders  = data.sales?.orders  || [];
      const table   = data.sales?.table   || [];
      // Chart
      const ctx2 = byId('salesChart2').getContext('2d');
      const empty = byId('salesEmpty');
      const canShow = nonEmpty(labels) && hasMinOrders(orders, 3);
      show(empty, !canShow);
      if(!canShow){
        if(salesChart2){ salesChart2.destroy(); salesChart2=null; }
      } else {
        if(!salesChart2){
          salesChart2 = new Chart(ctx2, {
            data:{ labels, datasets:[
              {type:'bar', label:'Ingresos', data:revenue, yAxisID:'y', backgroundColor:PALETTE.bar, borderWidth:0, borderRadius:6},
              {type:'line', label:'Pedidos', data:orders, yAxisID:'y1', borderColor:PALETTE.line, backgroundColor:PALETTE.line, tension:.35, borderWidth:2, pointRadius:2}
            ]},
            options:{responsive:true, maintainAspectRatio:false, interaction:{mode:'index', intersect:false},
              plugins:{legend:{labels:{boxWidth:12}}},
              scales:{
                y:{position:'left', ticks:{callback:v=>PENf.format(v)} , grid:{color:PALETTE.grid}},
                y1:{position:'right', beginAtZero:true, ticks:{callback:v=>INTf.format(v)}, grid:{drawOnChartArea:false}},
                x:{grid:{display:false}}
              }
            }
          });
        } else {
          salesChart2.data.labels = labels;
          salesChart2.data.datasets[0].data = revenue;
          salesChart2.data.datasets[1].data = orders;
          salesChart2.update();
        }
      }

      // Tabla + KPIs
      const tbody = byId('salesTBody');
      if(!nonEmpty(table)){
        tbody.innerHTML = `<tr class="emptyRow"><td colspan="4" style="padding:18px 12px; color:#ffe9e2; background:rgba(255,255,255,0.06); border-radius:12px;">Datos no establecidos aún</td></tr>`;
        setText('srKpiOrders','0');
        setText('srKpiRevenue','S/ 0');
        setText('srKpiAOV','S/ 0');
      } else {
        tbody.innerHTML = '';
        let tOrders=0,tRevenue=0;
        table.forEach(r=>{
          tOrders += r.orders||0; tRevenue += r.revenue||0;
          const aov = r.orders ? Math.round((r.revenue||0)/r.orders) : 0;
          const tr = document.createElement('tr');
          tr.innerHTML = `<td>${r.period}</td>
            <td style="text-align:right">${INTf.format(r.orders||0)}</td>
            <td style="text-align:right">${PENf.format(Math.round(r.revenue||0))}</td>
            <td style="text-align:right">${PENf.format(Math.round(aov))}</td>`;
          tbody.appendChild(tr);
        });
        setText('srKpiOrders', INTf.format(tOrders));
        setText('srKpiRevenue', PENf.format(Math.round(tRevenue)));
        setText('srKpiAOV', PENf.format(Math.round(tOrders? tRevenue/tOrders : 0)));
      }

      // Nota del rango
      if(rangeKey==='7d') setText('srRangeNote','Rango: últimos 7 días');
      else if(rangeKey==='30d') setText('srRangeNote','Rango: últimos 30 días');
      else if(rangeKey==='qtr') setText('srRangeNote','Rango: Trimestral (semanas)');
      else if(rangeKey==='ytd') setText('srRangeNote',`Rango: YTD ${new Date().getFullYear()}`);
    }

    /* ================== Inventarios por rango ================== */
    async function loadInventory(rangeKey){
      const inv = await fetchJSON(`{{ route('admin.dashboard.inv') }}`, {range: rangeKey});
      const labels = inv.serie?.labels || [];
      const units  = inv.serie?.units  || [];
      const cogs   = inv.serie?.cogs   || [];
      const table  = inv.table || [];

      // Chart
      const ctx = byId('invChart2').getContext('2d');
      const empty = byId('invEmpty');
      const canShow = nonEmpty(labels) && (labels.length >= 2);
      show(empty, !canShow);
      if(!canShow){
        if(invChart2){ invChart2.destroy(); invChart2=null; }
      } else {
        if(!invChart2){
          invChart2 = new Chart(ctx, {
            data:{labels, datasets:[
              {type:'bar', label:'COGS', data:cogs, yAxisID:'y', backgroundColor:PALETTE.bar, borderRadius:6},
              {type:'line', label:'Unidades', data:units, yAxisID:'y1', borderColor:PALETTE.line, backgroundColor:PALETTE.line, tension:.35, borderWidth:2, pointRadius:2}
            ]},
            options:{responsive:true, maintainAspectRatio:false, interaction:{mode:'index',intersect:false},
              scales:{ y:{ticks:{callback:v=>PENf.format(v)}, grid:{color:PALETTE.grid}},
                       y1:{position:'right', beginAtZero:true, ticks:{callback:v=>INTf.format(v)}, grid:{drawOnChartArea:false}},
                       x:{grid:{display:false}}}
            }
          });
        } else {
          invChart2.data.labels = labels;
          invChart2.data.datasets[0].data = cogs;
          invChart2.data.datasets[1].data = units;
          invChart2.update();
        }
      }

      // Tabla y KPIs
      const tbody = byId('invTBody');
      if(!nonEmpty(table)){
        tbody.innerHTML = `<tr class="emptyRow"><td colspan="4" style="padding:18px 12px; color:#ffe9e2; background:rgba(255,255,255,0.06); border-radius:12px;">Datos no establecidos aún</td></tr>`;
        setText('invKpiUnits','0'); setText('invKpiCogs','S/ 0'); setText('invKpiCPU','S/ 0');
      } else {
        tbody.innerHTML = '';
        let tU=0, tC=0;
        table.forEach(r=>{
          tU += r.units||0; tC += r.cogs||0;
          const tr = document.createElement('tr');
          tr.innerHTML = `<td>${r.period}</td>
            <td style="text-align:right">${INTf.format(r.units||0)}</td>
            <td style="text-align:right">${PENf.format(Math.round(r.cogs||0))}</td>
            <td style="text-align:right">${PENf.format(Math.round(r.cpu||0))}</td>`;
          tbody.appendChild(tr);
        });
        setText('invKpiUnits', INTf.format(tU));
        setText('invKpiCogs', PENf.format(Math.round(tC)));
        setText('invKpiCPU',  PENf.format((tU? Math.round(tC/tU):0)));
      }

      if(rangeKey==='7d') setText('invRangeNote','Rango: últimos 7 días');
      else if(rangeKey==='30d') setText('invRangeNote','Rango: últimos 30 días');
      else if(rangeKey==='qtr') setText('invRangeNote','Rango: Trimestral (semanas)');
      else if(rangeKey==='ytd') setText('invRangeNote',`Rango: YTD ${new Date().getFullYear()}`);

      // TOP inv + low stock
      // Pie
      const listUnits = (inv.top?.units||[]).slice(0,7);
      const listCogs  = (inv.top?.cogs ||[]).slice(0,7);
      const metricBtn = $('#invMetricSwitch .seg.active')?.dataset.metric || 'units';
      const chartList = metricBtn==='units' ? listUnits : listCogs;
      const invTopEmpty = byId('invTopEmpty');
      if(!nonEmpty(chartList)){
        show(invTopEmpty,true);
        if(!invTopPie){ invTopPie = ensureDoughnut(byId('invTopPie').getContext('2d')); }
        invTopPie.data.labels=['Sin datos']; invTopPie.data.datasets[0].data=[1]; invTopPie.update();
      } else {
        show(invTopEmpty,false);
        if(!invTopPie){ invTopPie = ensureDoughnut(byId('invTopPie').getContext('2d')); }
        invTopPie.data.labels = chartList.map(x=>x.name || 'Producto');
        invTopPie.data.datasets[0].data = metricBtn==='units'
          ? chartList.map(x=>x.units||0)
          : chartList.map(x=>Math.round(x.cogs||0));
        invTopPie.update();
        setText('invTopNote',`Top 7 por ${metricBtn==='units'?'cantidad':'PEN'} (${rangeKey.toUpperCase()})`);
      }

      // Low stock
      const low = inv.low_stock || [];
      const lowBody = byId('invLow10Body');
      if(!nonEmpty(low)){
        lowBody.innerHTML = `<tr class="emptyRow"><td colspan="3" style="padding:18px 12px; color:#ffe9e2; background:rgba(255,255,255,0.06); border-radius:12px;">Datos no establecidos aún</td></tr>`;
      } else {
        lowBody.innerHTML = low.map(p=>`
          <tr><td>${p.sku || 'SKU'}</td><td>${p.name || 'Producto'}</td><td style="text-align:right">${INTf.format(p.stock || 0)}</td></tr>
        `).join('');
      }
    }

    /* ================== Ratios (logística + rotación) ================== */
    async function loadRatiosOnce(){
      if(ratiosCache) return ratiosCache.inventory;
      ratiosCache = await fetchJSON(`{{ route('admin.dashboard.ratios') }}`);
      // LOGÍSTICA
      const labels = ratiosCache.logistics?.labels || [];
      const avgShip= ratiosCache.logistics?.avgShip || [];
      const freePct= ratiosCache.logistics?.freePct || [];
      const empty = byId('logEmpty');
      const canShow = nonEmpty(labels) && (labels.length>=2);
      show(empty, !canShow);
      if(!canShow){
        if(logChart){ logChart.destroy(); logChart=null; }
      } else {
        const ctx = byId('logChart').getContext('2d');
        if(!logChart){
          logChart = new Chart(ctx, {
            data:{labels, datasets:[
              {type:'bar', label:'Costo envío prom./orden', data: avgShip.map(v=>Math.round(v||0)), yAxisID:'y', backgroundColor:PALETTE.bar, borderRadius:6},
              {type:'line', label:'% envíos gratis', data: freePct.map(v=>+v||0), yAxisID:'y1', borderColor:PALETTE.line, backgroundColor:PALETTE.line, tension:.35, borderWidth:2, pointRadius:2}
            ]},
            options:{responsive:true, maintainAspectRatio:false, interaction:{mode:'index',intersect:false},
              scales:{ y:{ticks:{callback:v=>PENf.format(v)}, grid:{color:PALETTE.grid}},
                       y1:{position:'right', beginAtZero:true, ticks:{callback:v=>v+'%'}, grid:{drawOnChartArea:false}},
                       x:{grid:{display:false}}}
            }
          });
        } else {
          logChart.data.labels = labels;
          logChart.data.datasets[0].data = avgShip;
          logChart.data.datasets[1].data = freePct;
          logChart.update();
        }
      }
      setText('lgAvgShip', PENf.format(Math.round(ratiosCache.logistics?.totals?.avgShipLast || 0)));
      setText('lgFreePct', `${(ratiosCache.logistics?.totals?.freePctLast || 0)}%`);
      setText('lgTotalShip', PENf.format(Math.round(ratiosCache.logistics?.totals?.shipSumLast || 0)));

      // INVENTARIO ratios
      const inv = ratiosCache.inventory || {};
      setText('invRotGlobal', (inv.rot_global||0).toFixed(1)+'x');
      setText('invDOH', (inv.doh_avg||0)+' días');
      setText('invStock', INTf.format(inv.stock_total||0)+' u.');
      setText('rtGeneral', `Ratio rotación: ${(inv.rot_global||0).toFixed(1)}x`);

      // Tabla rotación
      const rows = inv.rows || [];
      const rotBody = byId('rotBody');
      if(!nonEmpty(rows)){
        rotBody.innerHTML = `<tr class="emptyRow"><td colspan="5" style="padding:18px 12px; color:#ffe9e2; background:rgba(255,255,255,0.06); border-radius:12px;">Datos no establecidos aún</td></tr>`;
        show(byId('invRotEmpty'), true);
      } else {
        rotBody.innerHTML = rows.map(r=>`
          <tr><td>${r.sku}</td><td>${INTf.format(r.stock)}</td><td>${INTf.format(r.sold30)}</td><td>${r.days}</td><td>${(+r.rot||0).toFixed(2)}x</td></tr>
        `).join('');
        // Barra top 10 rotación
        const ctxB = byId('invChart').getContext('2d');
        const labelsB = rows.slice(0,10).map(r=>r.sku);
        const dataB   = rows.slice(0,10).map(r=>+r.rot||0);
        show(byId('invRotEmpty'), false);
        if(!invChartBar){
          invChartBar = new Chart(ctxB, { type:'bar', data:{labels:labelsB, datasets:[{label:'Rotación 30d (x)', data:dataB, backgroundColor:PALETTE.bar, borderRadius:6}]}, options:{responsive:true, maintainAspectRatio:false, scales:{y:{beginAtZero:true}, x:{grid:{display:false}}}, plugins:{legend:{display:false}}} });
        } else {
          invChartBar.data.labels = labelsB;
          invChartBar.data.datasets[0].data = dataB;
          invChartBar.update();
        }
      }
      return inv;
    }

    /* ================== UI: switches y carrusel ================== */
    // Rango cabecera KPIs
    const rangeSwitch = byId('rangeSwitch');
    rangeSwitch.addEventListener('click', async (e)=>{
      const b=e.target.closest('.seg'); if(!b) return;
      rangeSwitch.querySelectorAll('.seg').forEach(x=>x.classList.remove('active'));
      b.classList.add('active');
      kpiRangeKey = b.dataset.range;
      setText('rangeLabel', labelFromRange(kpiRangeKey));
      await loadKPIAndSales(kpiRangeKey, salesRangeKey);
    });

    // Ventas rango
    const salesControls = byId('salesRangeControls');
    salesControls.addEventListener('click', async (e)=>{
      const b=e.target.closest('.seg'); if(!b) return;
      salesControls.querySelectorAll('.seg').forEach(x=>x.classList.remove('active'));
      b.classList.add('active');
      salesRangeKey = b.dataset.range;
      await loadKPIAndSales(kpiRangeKey, salesRangeKey);
    });

    // Inventario rango
    const invControls = byId('invRangeControls2');
    invControls.addEventListener('click', async (e)=>{
      const b=e.target.closest('.seg'); if(!b) return;
      invControls.querySelectorAll('.seg').forEach(x=>x.classList.remove('active'));
      b.classList.add('active');
      invRangeKey = b.dataset.range;
      await loadInventory(invRangeKey);
      if(!byId('invTopPanel').classList.contains('gone')) await loadInventory(invRangeKey);
    });

    // KPI Carrusel simpático (3 tarjetas)
    const KPICarousel = (function(){
      const grid = byId('kpiGrid');
      const cards = [byId('stataVenta'), byId('stataRatios'), byId('stataInventario')];
      const btnPrev = byId('kpiPrev');
      const btnNext = byId('kpiNext');
      let index = 0;
      function diffPos(i){ const d=(i-index+3)%3; if(d===0) return 0; if(d===1) return 1; return -1; }
      function layout(){
        const stageW = grid.clientWidth || 900;
        const gap = Math.max(180, Math.min(stageW * 0.28, 320));
        cards.forEach((card,i)=>{
          const p = diffPos(i);
          const tx = p===0?0:(p===1?gap:-gap);
          const ry = p===0?0:(p===1?-12:12);
          const sc = p===0?1:0.78;
          const op = p===0?1:0.5;
          const bl = p===0?0:0.4;
          card.style.transform = `translateX(calc(-50% + ${tx}px)) rotateY(${ry}deg) scale(${sc})`;
          card.style.opacity = String(op);
          card.style.zIndex = String(p===0?30:20);
          card.style.filter = `blur(${bl}px)`;
        });
      }
      function syncContent(){
        if(index===0) showBlock('sales');
        if(index===1) showBlock('ratios');
        if(index===2) showBlock('inventory');
      }
      function go(to){ index=(to+3)%3; layout(); syncContent(); }
      byId('kpiPrev').addEventListener('click', ()=>go(index-1));
      byId('kpiNext').addEventListener('click', ()=>go(index+1));
      cards.forEach((c,i)=> c.addEventListener('click', ()=> go(i)));
      window.addEventListener('load', ()=>{ layout(); syncContent(); });
      window.addEventListener('resize', layout);
      return { go, layout };
    })();

    // Toggle paneles dentro de Sales e Inventory
    byId('btnSalesTop').addEventListener('click', ()=>{
      const serie=byId('salesSeriePanel'); const top=byId('salesTopPanel');
      if(top.classList.contains('gone')){ serie.classList.add('gone'); top.classList.remove('gone'); }
      else { top.classList.add('gone'); serie.classList.remove('gone'); }
    });
    byId('btnInvTop').addEventListener('click', async ()=>{
      const serie=byId('invSeriePanel'); const top=byId('invTopPanel');
      if(top.classList.contains('gone')){ serie.classList.add('gone'); top.classList.remove('gone'); await loadInventory(invRangeKey); }
      else { top.classList.add('gone'); serie.classList.remove('gone'); }
    });

    // Métrica top clientes (orders/spend) reprocesada desde endpoint cuando cambias métrica o rango (simple re-fetch del data endpoint con el rango elegido)
    let custMetric='orders', custRangeKey='7d';
    byId('custMetricSwitch').addEventListener('click', async e=>{
      const b=e.target.closest('.seg'); if(!b) return;
      $('#custMetricSwitch .seg.active')?.classList.remove('active'); b.classList.add('active');
      custMetric=b.dataset.metric;
      const data = await fetchJSON(`{{ route('admin.dashboard.data') }}`, { range: custRangeKey });
      const top = (data.top_customers||[]).slice(0,5);
      const custEmpty = byId('custEmpty');
      if(!nonEmpty(top)){
        show(custEmpty,true);
        if(!custPie){ custPie = ensureDoughnut(byId('custPie').getContext('2d')); }
        custPie.data.labels=['Sin datos']; custPie.data.datasets[0].data=[1]; custPie.update();
        return;
      }
      show(custEmpty,false);
      if(!custPie){ custPie = ensureDoughnut(byId('custPie').getContext('2d')); }
      custPie.data.labels = top.map(x=>x.nombre||'Cliente');
      custPie.data.datasets[0].data = custMetric==='orders' ? top.map(x=>x.orders||0) : top.map(x=>Math.round(x.spend||0));
      custPie.update();
      setText('custNote',`Top 5 por ${custMetric==='orders'?'órdenes':'gasto'} (${custRangeKey.toUpperCase()})`);
    });
    byId('custTopRangeControls').addEventListener('click', async e=>{
      const b=e.target.closest('.seg'); if(!b) return;
      $('#custTopRangeControls .seg.active')?.classList.remove('active'); b.classList.add('active');
      custRangeKey=b.dataset.range;
      const data = await fetchJSON(`{{ route('admin.dashboard.data') }}`, { range: custRangeKey });
      const top = (data.top_customers||[]).slice(0,5);
      const custEmpty = byId('custEmpty');
      if(!nonEmpty(top)){
        show(custEmpty,true);
        if(!custPie){ custPie = ensureDoughnut(byId('custPie').getContext('2d')); }
        custPie.data.labels=['Sin datos']; custPie.data.datasets[0].data=[1]; custPie.update();
        return;
      }
      show(custEmpty,false);
      if(!custPie){ custPie = ensureDoughnut(byId('custPie').getContext('2d')); }
      custPie.data.labels = top.map(x=>x.nombre||'Cliente');
      custPie.data.datasets[0].data = custMetric==='orders' ? top.map(x=>x.orders||0) : top.map(x=>Math.round(x.spend||0));
      custPie.update();
      setText('custNote',`Top 5 por ${custMetric==='orders'?'órdenes':'gasto'} (${custRangeKey.toUpperCase()})`);
    });

    /* ================== Mostrar bloques principales ================== */
    const salesBlockEl   = byId('salesBlock');
    const ratiosBlockEl  = byId('ratiosBlock');
    const inventoryBlockEl = byId('inventoryBlock');
    function showBlock(which){
      const map = { sales: salesBlockEl, ratios: ratiosBlockEl, inventory: inventoryBlockEl };
      const showEl = map[which]; if(!showEl) return;
      Object.values(map).forEach(el=>{
        if(el!==showEl && !el.classList.contains('gone')){
          el.classList.remove('anim-in'); el.classList.add('anim-out');
          el.addEventListener('animationend', function h(){ el.classList.add('gone'); el.classList.remove('anim-out'); el.removeEventListener('animationend', h); });
        }
      });
      if(showEl.classList.contains('gone')){
        showEl.classList.add('anim-in'); showEl.classList.remove('gone');
        showEl.addEventListener('animationend', function h(){ showEl.classList.remove('anim-in'); showEl.removeEventListener('animationend', h); });
      }
      if(which==='ratios'){ loadRatiosOnce(); }
      if(which==='inventory'){ loadInventory(invRangeKey); }
      if(which==='sales'){ /* nada extra */ }
    }

    /* ================== Botón actualizar ================== */
    byId('btnRefresh').addEventListener('click', async ()=>{
      ratiosCache = null; // cache corto
      await loadKPIAndSales(kpiRangeKey, salesRangeKey);
      await loadInventory(invRangeKey);
      await loadRatiosOnce();
    });

    /* ================== Primera carga ================== */
    (async function init(){
      setText('rangeLabel', labelFromRange(kpiRangeKey));
      await loadKPIAndSales(kpiRangeKey, salesRangeKey);
      await loadInventory(invRangeKey);
      await loadRatiosOnce();
      showBlock('sales');
    })();
  </script>

  <script defer src="{{ asset('js/ui-slider.js') }}"></script>
</body>
</html>
