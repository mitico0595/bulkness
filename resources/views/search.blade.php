<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@include ('global.name')</title>
    @include ('global.icon')

    <!-- Fuentes y CSS existentes de tu proyecto -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
   

    <style>
      /* ===== Paleta / variables rápidas ===== */
      :root{
        --text:#111827;
        --muted-600:#4b5563;
        --line-100:#e5e7eb;
        --bg:#f3f4f6;
        --emerald-500:#10b981;
        --emerald-600:#059669;
      }

      *{ box-sizing:border-box; font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Ubuntu,"Helvetica Neue",Arial,sans-serif; }
      body{ background:var(--bg); margin:0; }

      .container{ max-width:1200px; margin:0 auto; padding:0 16px; }

      /* ===== TOP BAR (franja roja) ===== */
      .top-bar{ background:#000000cf; color:#fff; }
      .top-bar .top-bar-content{
        display:flex; justify-content:flex-end; align-items:center;
        gap:24px; min-height:40px; font-size:14px;
      }
      .top-bar a{ color:#fff; text-decoration:none; opacity:.95 }
      .top-bar a:hover{ opacity:1 }

      /* ===== HEADER nuevo ===== */
      header{ position:relative; z-index:10; border-bottom:1px solid var(--line-100); padding:10px 0; background:#fff; }
      .header-row{ display:flex; align-items:center; justify-content:space-between; padding:12px 8px; }
      nav a{ color:var(--muted-600); font-weight:600; text-decoration:none; margin-right:24px; }
      nav a:hover{ color:var(--text) }

      .icon-btn{
        width:40px; height:40px; display:grid; place-items:center; border-radius:999px;
        background:transparent; border:0; cursor:pointer; transition:background .2s ease;
      }
      .icon-btn:hover{ background:rgba(0,0,0,.06) }

      .svg{ width:22px; height:22px; stroke:var(--text); fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }

      .cart-badge{
        position:absolute; top: 24px;    right: 15px; width:20px; height:20px;
        font-size:10px; font-weight:800; color:#fff; background:var(--emerald-500);
        display:grid; place-items:center; border-radius:999px;
      }

      /* Buscador (cápsula) */
      .search-container{
        display:flex; align-items:center;width:100%;
        background:#fff; border:1px solid var(--line-100); border-radius:12px; padding:10px 14px;
      }
      .search-input{
        outline:none; border:0; background:transparent; width:100%;
        font-size:14px; color:#374151;
      }
      .search-input::placeholder{ color:#9ca3af; }

      /* Responsive pequeño: ocultar menú de enlaces */
      @media (max-width: 900px){
        .hide-mobile{ display:none }
        .search-container{ width:100%; max-width: none; }
      }
      
      /* ===== Footer nuevo ===== */
      footer{ background:#1f2937; color:#d1d5db; padding:64px 0 32px; margin-top:60px; }
      .footer-content{ display:grid; gap:48px; }
      @media (min-width:768px){ .footer-content{ grid-template-columns:1fr 1fr 1fr 1fr } }
      .footer-section h4{ color:#fff; font-weight:800; margin:0 0 20px; }
      .footer-section p{ margin:0; }
      .footer-section ul{ list-style:none; padding:0; margin:0; }
      .footer-section li{ margin-bottom:12px; }
      .footer-section a{ color:#d1d5db; text-decoration:none; font-size:14px; }
      .footer-section a:hover{ color:#fff; }
      .footer-bottom{
        border-top:1px solid #374151; margin-top:48px; padding-top:24px;
        display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;
      }
      .footer-bottom p{ margin:0; font-size:14px; }
      .libro-btn{
        background:var(--emerald-600); color:#fff; padding:12px 24px; border-radius:12px;
        text-decoration:none; font-weight:600; transition:background .2s ease;
      }
      .libro-btn:hover{ background:var(--emerald-500); }

      /* Área de contenido donde se hace*/
      .page-wrap{ position:relative; display:block; width:100%; min-height:600px; max-width:1200px; margin:24px auto; }
      
    </style>
  </head>

  <body id="body">
    <!-- ===== Top Bar ===== -->
    <div class="top-bar">
      <div class="container">
        <div class="top-bar-content">
          <a href="#">Protección del comprador</a>
          <a href="#">Ayuda</a>
          @if (Auth::check())
            <a href="{{ url('login') }}">Hola, {{ Auth::user()->name }}</a>
          @else
            <a href="{{ url('login') }}">Mi cuenta</a>
          @endif
        </div>
      </div>
    </div>

    <!-- ===== Header ===== -->
    <header>
      <div class="container header-row">
        <div style="display:flex; align-items:center; gap:48px;">
          <a href="{{ url('/') }}"><img src="{{ asset('image/logo.webp') }}" alt="Adler" style="width:70px;"></a>
          <nav class="hide-mobile">
            <a href="{{ asset('/') }}">Inicio</a>
            <a href="{{ asset('buscando') }}">Productos</a>
            <a href="/who">Nosotros</a>
          </nav>
        </div>

        <div style="display:flex; align-items:center; gap:16px; position:relative;">
          <form action="{{ route('item') }}" method="GET" class="search-container">
            @csrf
            <input type="text" id="searchid" name="name" autocomplete="off" placeholder="Buscar Producto" class="search-input">
            <button type="submit" class="icon-btn" aria-label="Buscar" style="margin-left:-2px;">
              <svg class="svg" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
          </form>

          <a href="{{ asset('login') }}" class="icon-btn" aria-label="Cuenta" title="Mi cuenta" style="text-decoration:none;">
            <svg class="svg" viewBox="0 0 24 24"><path d="M20 21a8 8 0 0 0-16 0"></path><circle cx="12" cy="7" r="4"></circle></svg>
          </a>

         <!-- <a href="{{ route('product.pasarela-pago') }}" class="icon-btn" aria-label="Carrito" title="Carrito" style="position:relative;">
             
            <svg width="24" height="24" fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
              <circle cx="9" cy="21" r="1"></circle>
              <circle cx="20" cy="21" r="1"></circle>
              <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <span class="cart-badge">{{ Session::has('carto') ? Session::get('carto')->totalQty : '0' }}</span>
          </a>-->
        </div>
      </div>
    </header>

    <!-- ===== Contenido de páginas hijas ===== -->
    <div class="page-wrap">
      @yield('cont')
    </div>

    <!-- ===== Footer ===== -->
    <footer>
      <div class="container">
        <div class="footer-content">
          <!-- Columna 1 -->
          <div class="footer-section">
            <h4>Bulkness Peru</h4>
            <p style="margin:0 0 16px; color:#9ca3af; font-size:14px; line-height:1.6;">
              Tu tienda confiable de ropa.
            </p>
            <div style="display:flex; gap:12px; margin-top:20px;">
              <a href="#" style="width:40px; height:40px; background:#374151; border-radius:8px; display:grid; place-items:center; color:#d1d5db;">
                <!-- Facebook -->
                <svg style="width:20px; height:20px;" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M24 12.073c0-6.627-5.373-12-12-12S0 5.446 0 12.073C0 18.063 4.388 23.027 10.125 23.927v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
              </a>
              <a href="#" style="width:40px; height:40px; background:#374151; border-radius:8px; display:grid; place-items:center; color:#d1d5db;">
                <!-- Instagram -->
                <svg style="width:20px; height:20px;" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.014 5.367 18.647.001 12.017.001zM8.449 16.988c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348zm7.718 0c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348z"/>
                </svg>
              </a>
            </div>
          </div>

          <!-- Columna 2 -->
          <div class="footer-section">
            <h4>Enlaces Útiles</h4>
            <ul>
              <li><a href="#">Términos y Condiciones</a></li>
              <li><a href="#">Política de Privacidad</a></li>
              <li><a href="#">Política de Devoluciones</a></li>
              <li><a href="#">Preguntas Frecuentes</a></li>
              <li><a href="#">Envíos y Entregas</a></li>
              <li><a href="#">Métodos de Pago</a></li>
            </ul>
          </div>

          <!-- Columna 3 -->
          <div class="footer-section">
            <h4>Atención al Cliente</h4>
            <ul>
              <li style="display:flex; align-items:center; gap:8px;">
                <svg style="width:16px; height:16px;" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                </svg>
                <span>{{env('SUPPORT_PHONE')}}</span>
              </li>
              <li style="display:flex; align-items:center; gap:8px;">
                <svg style="width:16px; height:16px;" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                  <polyline points="22,6 12,13 2,6"/>
                </svg>
                <span>{{env('SUPPORT_MAIL')}}</span>
              </li>
              <li style="display:flex; align-items:flex-start; gap:8px;">
                <svg style="width:16px; height:16px; margin-top:2px;" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                  <circle cx="12" cy="10" r="3"/>
                </svg>
                <span>{{env('SUPPORT_ADDRESS')}}<br>{{env('SUPPORT_CITY')}}</span>
              </li>
            </ul>
          </div>

          <!-- Columna 4 -->
          <div class="footer-section">
            <h4>Horarios de Atención</h4>
            <ul>
              <li style="color:#9ca3af; font-size:14px;">
                <strong style="color:#d1d5db;">Martes a Viernes:</strong><br>10:00 AM - 10:00 PM
              </li>
              <li style="color:#9ca3af; font-size:14px;">
                <strong style="color:#d1d5db;">Sábados:</strong><br>10:00 AM - 2:00 PM
              </li>
              <li style="color:#9ca3af; font-size:14px;">
                <strong style="color:#d1d5db;">Domingos:</strong><br>Sin atencion
              </li>
            </ul>

            <div style="margin-top:24px;">
              <h4 style="margin-bottom:12px; font-size:14px;">Certificaciones</h4>
              <div style="display:flex; gap:8px; flex-wrap:wrap;">
                <div style="background:#374151; padding:4px 8px; border-radius:4px; font-size:10px; font-weight:600;">-</div>
                <div style="background:#374151; padding:4px 8px; border-radius:4px; font-size:10px; font-weight:600;">-</div>
                <div style="background:#374151; padding:4px 8px; border-radius:4px; font-size:10px; font-weight:600;">-</div>
              </div>
            </div>
          </div>
        </div>

        <div class="footer-bottom">
          <div>
            <p>&copy; 2026 angelbernedo.com .Todos los derechos reservados.</p>
            <p style="font-size:12px; color:#9ca3af; margin:4px 0 0;">
              RUC: - | Razón Social: -.
            </p>
          </div>

          <a href="#" class="libro-btn" style="display:flex; align-items:center; gap:8px;">
            <svg style="width:18px; height:18px;" viewBox="0 0 24 24" stroke="currentColor" fill="none">
              <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
              <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
            </svg>
            Libro de Reclamaciones
          </a>
        </div>
      </div>
    </footer>
  </body>
</html>
