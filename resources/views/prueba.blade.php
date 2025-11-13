<!DOCTYPE html>
<html lang="es-PE">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amigurumis Peru</title>
    @include('global.icon')
    <meta name="description" content="Compra amigurumis con nosotros, amigurumis personalizados. Hacemos envios a nivel nacional, calidad garantizada en cada producto.">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ url('/amigurumis-peru') }}">
    <link rel="alternate" hreflang="es-PE" href="{{ url('/amigurumis-peru') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('/amigurumis-peru') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Amigurumis en Perú | Amigurumis.pe">
    <meta property="og:description" content="Amigurumis personalizados. Envíos a todo el Perú.">
    <meta property="og:url" content="{{ url('/amigurumis-peru') }}">
    <meta property="og:image" content="{{ asset('/image/productos/amigu1.webp') }}">

    <script type="application/ld+json">
    {
    "@context":"https://schema.org",
    "@graph":[
        {
        "@type":"WebSite",
        "name":"AmigurumisPeru",
        "url":"https://amigurumis.pe",
        "potentialAction":{
            "@type":"SearchAction",
            "target":"https://amigurumis.pe/item?name={search_term_string}",
            "query-input":"required name=search_term_string"
        }
        },
        {
        "@type":"Organization",
        "name":"AmigurumisPeru",
        "url":"https://amigurumis.pe",
        "logo":"https://amigurumis.pe/image/logo.webp"
        },
        {
        "@type":"BreadcrumbList",
        "itemListElement":[
            {"@type":"ListItem","position":1,"name":"Inicio","item":"https://amigurumis.pe"},
            {"@type":"ListItem","position":2,"name":"Amigu","item":"https://amigurumis.pe/amigurumis-peru"}
        ]
        }
    ]
    }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }
        html{overflow:hidden}
        body {
        width: 100vw;
        height: 100vh;
        overflow: hidden;              /* ya lo tenías */
        position: relative;
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial;

        /* fondo principal */
        background-image: url('image/backamigurumi.png');
        background-repeat: no-repeat;
        background-position: center center; /* centro por defecto */
        background-size: cover;             /* escala y recorta para llenar pantalla */
        background-color: #0f172a;          /* fallback si la imagen falta o tarda en cargar */

        /* opcional: suavizar píxeles cuando se escala */
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        }
        @media (max-width: 640px) and (orientation: portrait) {
  body {
    /* centra horizontalmente, pero sube el recorte para evitar cortar la parte superior importante */
    background-position: center 20%;
  }
}

/* si quieres que en tablet/móvil el recorte sea ligeramente distinto (opcional) */
@media (max-width: 900px) {
  body {
    background-position: center 18%;
  }
}
        /* SVG defs no visibles, solo para el efecto visual */
        .svg--defs {
            position: absolute;
            width: 0;
            height: 0;
            pointer-events: none;
        }

        /* Burbuja base, usada por las 7 con imagen y las decorativas */
        .burbuja {
            position: absolute;
            width: 80px;   /* valor base, luego se sobreescribe desde JS */
            height: 80px;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%,
                        rgba(255, 255, 255, 0.28),
                        rgba(255, 255, 255, 0.12) 50%,
                        rgba(255, 255, 255, 0.03));
            border: 2px solid rgba(255, 255, 255, 0.28);
            box-shadow:
                inset 0 -10px 24px rgba(0, 0, 0, 0.16),
                0 8px 28px rgba(0, 0, 0, 0.22);
            cursor: pointer;
            transition: transform 0.18s ease, opacity 0.25s ease;
            z-index: 1001;
            overflow: hidden;
            opacity:.5;
            will-change: transform, left, top, opacity;
        }

        .burbuja:hover {
            transform: scale(1.08);
        }

        /* Imagen esférica dentro de la burbuja */
        .burbuja-imagen {
            position: absolute;
            top: 50%;
            left: 50%;
            opacity:.7;
            transform: translate(-50%, -50%) scale(1.05);
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            pointer-events: none;
            filter: saturate(1.08) contrast(1.03) brightness(0.96);
            -webkit-mask-image: radial-gradient(circle at 50% 38%,
                rgba(0,0,0,1) 55%,
                rgba(0,0,0,0.8) 78%,
                rgba(0,0,0,0) 100%);
                    mask-image: radial-gradient(circle at 50% 38%,
                rgba(0,0,0,1) 55%,
                rgba(0,0,0,0.8) 78%,
                rgba(0,0,0,0) 100%);
        }

        /* Overlay SVG con el efecto de burbuja que pasaste */
        .bubble-overlay {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            mix-blend-mode: screen;
            opacity: 0.95;
        }

        /* Extra borde interno y reflejo inferior para más 3D */
        .burbuja .rim {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            box-shadow:
                inset 0 10px 18px rgba(255,255,255,0.04),
                inset 0 -14px 24px rgba(0,0,0,0.35);
            pointer-events: none;
            mix-blend-mode: overlay;
        }

        .burbuja .lower-reflect {
            position: absolute;
            right: 12%;
            bottom: 10%;
            width: 18%;
            height: 12%;
            border-radius: 50%;
            background: rgba(255,255,255,0.12);
            filter: blur(3px);
            pointer-events: none;
        }

        /* Brillos clásicos que ya tenías */
        .burbuja::before {
            content: '';
            position: absolute;
            top: 15%;
            left: 20%;
            width: 25px;
            height: 25px;
            background: rgba(255, 255, 255, 0.55);
            border-radius: 50%;
            filter: blur(5px);
            pointer-events: none;
        }

        .burbuja::after {
            content: '';
            position: absolute;
            bottom: 20%;
            right: 25%;
            width: 15px;
            height: 15px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            filter: blur(3px);
            pointer-events: none;
        }

        /* Animación de reventar */
        @keyframes reventar {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.3);
                opacity: 0.5;
            }
            100% {
                transform: scale(0);
                opacity: 0;
            }
        }

        .reventando {
            animation: reventar 0.4s ease-out forwards;
        }
        /* Search Bar */
        .search-container {
            padding: 24px;
            position: relative;
            display:none
        }

        .search-bar {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 25px;
            color: white;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .search-bar::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .search-bar:focus {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.4);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        .search-icon {
            position: absolute;
            right: 36px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            opacity: 0.7;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .search-icon:hover {
            opacity: 1;
        }
        /* Partículas */
        .particula {
            position: absolute;
            width: 10px;
            height: 10px;
            background: radial-gradient(circle at 30% 30%,
                        rgba(255,255,255,0.95),
                        rgba(255,255,255,0.5) 50%,
                        rgba(255,255,255,0));
            border-radius: 50%;
            pointer-events: none;
            z-index: 1500;
        }

        @keyframes particula-explotar {
            0% {
                transform: translate(0, 0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translate(var(--tx), var(--ty)) scale(0);
                opacity: 0;
            }
        }

        .particula {
            animation: particula-explotar 0.6s ease-out forwards;
        }

        /* Imagen central */
        .imagen-central {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 500px;
            max-height: 500px;
            border-radius: 20px;
            
            opacity: 0;
            transition: opacity 0.5s ease;
            z-index: 1000;
            pointer-events: none;
            
        }

        .imagen-central.visible {
            opacity: 1;
        }

        .hint {
            position: fixed;
            left: 12px;
            bottom: 12px;
            padding: 8px 10px;
            border-radius: 8px;
            background: rgba(0,0,0,0.2);
            color: #fff;
            font-size: 13px;
            z-index: 2000;
            pointer-events: none;
        }

        @media (prefers-reduced-motion: reduce) {
            .burbuja:hover { transform:none; }
        }
        .social-box {
    border-radius: 10px;
    padding: 12px;
    display: flex;
    flex-direction: column;
    gap: 21px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2),
                inset 0 -1px 0 rgba(255, 255, 255, 0.1);
    border: 1px solid transparent;
    backdrop-filter: blur(2px);
    background: rgba(255, 255, 255, 0.1);
}

.social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: transform 0.25s ease, filter 0.25s ease;
}

.social-icon {
    width: 100%;
    padding: 5px;
    transition: transform 0.25s ease, filter 0.25s ease;
    filter: drop-shadow(0 0 5px rgba(255,255,255,0.2));
}

.social-link:hover .social-icon {
    transform: scale(1.2);
    filter: drop-shadow(0 0 10px rgba(255,255,255,0.4));
}
.icon{
    width: 72px; height: 72px;
    border-radius: 18px;
    display: grid; place-items: center;
    
    margin-bottom: 12px;
    color: var(--accent);
  }
   .topf{
            width:180px;
            font-weight: bold;
        }
  .bottom-nav {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            max-width: 380px;
            width: calc(100% - 40px);
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
            border: 1px solid transparent;
            background-clip: padding-box;
            border-radius: 24px;
            display: flex;
            justify-content: space-around;
            padding: 12px 8px;
            box-shadow: 
                0 8px 32px rgba(0,0,0,0.3),
                inset 0 1px 0 rgba(255,255,255,0.2),
                inset 0 -1px 0 rgba(255,255,255,0.1);
            
            overflow: hidden;
        }

        .bottom-nav::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 24px;
            padding: 1px;
            background: linear-gradient(
                135deg, 
                rgba(255,255,255,0.3) 0%, 
                rgba(255,255,255,0.1) 25%, 
                rgba(255,64,129,0.2) 50%, 
                rgba(33,150,243,0.2) 75%, 
                rgba(255,255,255,0.1) 100%
            );
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: xor;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            pointer-events: none;
        }
      .menutop{
        display:flex;
        width:70%
      }
      a{text-decoration:none}
    .adlr-search-overlay{
    position: fixed;
    inset: 0;
    background: #9b823661;
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity .2s ease, visibility .2s ease;
  }
  .adlr-search-overlay.is-open{
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
  }

  .adlr-search-box{
    position: relative;
    width: min(900px, 92vw);
    
    background: rgba(255,255,255,.96);
    border-radius: 18px;
    box-shadow: 0 25px 60px rgba(0,0,0,.25);
    padding: 28px 28px 30px;
    transform: translateY(10px) scale(.98);
    transition: transform .18s ease;
  }
  .adlr-search-overlay.is-open .adlr-search-box{
    transform: translateY(0) scale(1);
  }

  .adlr-search-title{
    font: 700 20px/1.2 system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    color: #111827;
    margin-bottom: 14px;
    letter-spacing: .2px;
  }

  .adlr-input-wrap{
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .adlr-input-icon{
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    width: 28px;
    height: 28px;
    color: white;
    pointer-events: none;
  }

  .adlr-search-input{
    width: 100%;
    height: 72px;
    padding: 0 150px 0 27px; /* espacio para icono y botón */
    font: 600 24px/1 system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    
    background: #fff;
    border: 1px solid #dbdbdb47;
    border-radius: 14px;
    outline: none;
    color:white;
    transition: border-color .15s ease, box-shadow .15s ease;
        text-transform: uppercase;
  }
  .adlr-search-input::placeholder{ color:#9ca3af; font-weight:500; }
  .adlr-search-input:focus{
    border-color: #efdb44ff;
    box-shadow: 0 0 0 3px rgba(196, 176, 0, 0.15);
  }

  .adlr-submit{
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    height: 56px;
    padding: 0 30px;
    border: 0;
    border-radius: 12px;
    background: none;
    color: #fff;
    font: 700 16px/1 system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
    cursor: pointer;
    transition: filter .15s ease, transform .03s ease;
  }
  .adlr-submit:active{ transform: translateY(calc(-50% + 1px)); }
  .adlr-submit:hover{ filter: brightness(.95); }

  .adlr-close{
    position: absolute;
    top: 10px;
    right: 10px;
    height: 36px;
    width: 36px;
    border: 0;
    border-radius: 10px;
    background: #f3f4f6;
    color: #1f2937;
    font-size: 20px;
    cursor: pointer;
  }
  .adlr-close:hover{ background:#e5e7eb; }
  #lateral{display:flex;}
  .logo1{width:150%}
   .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 2px 12px;
            border-radius: 16px;
            position: relative;
            background: transparent;
            border: 1px solid transparent;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 16px;
            background: rgba(255,255,255,0.05);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .nav-item:hover::before {
            opacity: 1;
        }

        .nav-item:hover {
            transform: translateY(-3px) scale(1.05);
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 
                0 8px 25px rgba(0,0,0,0.25),
                inset 0 1px 0 rgba(255,255,255,0.2);
        }

        .nav-item.active {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            transform: translateY(-2px);
            box-shadow: 
                0 6px 20px rgba(255,215,0,0.3),
                inset 0 1px 0 rgba(255,255,255,0.3),
                inset 0 -1px 0 rgba(255,215,0,0.2);
        }

        .nav-item.active::before {
            background: linear-gradient(135deg, 
                rgba(255,215,0,0.1) 0%, 
                rgba(255,193,7,0.05) 100%);
            opacity: 1;
        }

        .nav-icon {
            width: 22px;
            height: 22px;
            opacity: 0.8;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 0 8px rgba(255,255,255,0.1));
        }

        .nav-item:hover .nav-icon,
        .nav-item.active .nav-icon {
            opacity: 1;
            transform: scale(1.1);
            filter: drop-shadow(0 0 12px rgba(255,255,255,0.3));
        }

        .nav-item.active .nav-icon {
            filter: drop-shadow(0 0 15px rgba(255,215,0,0.5));
        }

        .nav-label {
            font-size: 11px;
            font-weight: 500;
            opacity: 0.7;
            transition: all 0.3s ease;
            text-shadow: 0 0 8px rgba(255,255,255,0.1);
            color:white
        }

        .nav-item.active .nav-label {
            opacity: 1;
            font-weight: 600;
            color: #FFD700;
            text-shadow: 0 0 12px rgba(255,215,0,0.4);
        }

        .nav-item:hover .nav-label {
            opacity: 0.9;
            transform: translateY(-1px);
        }
   .bottom-nav{display:none}     
  @media (max-width:480px){
     #lateral,.menutop{display:none}
      .logo1{width:200%}
      .bottom-nav{display:flex} 
      .search-container{display:block}
  }

    </style>
</head>
<body>
  <div class="adlr-search-overlay" id="adlrSearch" aria-hidden="true" role="dialog" aria-modal="true" style="display: flex;justify-content: center;align-items: center;">
            <div class="adlr-search-box" role="document" style="background:none">
                
                <form action="{{ route('item') }}" method="GET" class="adlr-search-form" autocomplete="off">
                @csrf
                <div class="adlr-input-wrap">
                    
                    <input id="adlrSearchInput" style="background:none" class="adlr-search-input" type="text" name="name"  placeholder="Buscar producto" inputmode="search"
                    autocapitalize="none" spellcheck="false"/>
                    <button class="adlr-submit" type="submit"><svg class="adlr-input-icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28h.79l5 5L20.5 19l-5-5zm-6 0A4.5 4.5 0 1 1 14 9.5 4.505 4.505 0 0 1 9.5 14z"/>
                    </svg></button>
                </div>
                </form>
            </div>
  </div>
  <div style="display:flex;flex-direction:column;width:85px;position:absolute;height:100vh;justify-content:center;left:0;top:0;z-index:99999;padding:10px">
      <div class="social-box">
          <a href="{{ env('MAIL_WHATSAPP_URL') }}" class="social-link">
              <img src="{{ asset('image/svg/whatsapp.svg') }}" fetchpriority="high" decoding="async" alt="WhatsApp" class="social-icon">
          </a>
          <a href="{{ env('MAIL_INSTAGRAM_URL') }}" class="social-link">
              <img src="{{ asset('image/svg/instagram.svg') }}" fetchpriority="high" decoding="async" alt="Instagram" class="social-icon">
          </a>
          <a href="{{ env('MAIL_FACEBOOK_URL') }}" class="social-link">
              <img src="{{ asset('image/svg/facebook.svg') }}" fetchpriority="high" decoding="async" alt="Facebook" class="social-icon">
          </a>
      </div>
  </div>
  <div  style="z-index:9999;position:fixed;right:20px;width:85px;height:100vh;background: linear-gradient(to bottom, hsla(59, 98%, 77%, 0.58) 0%,hsla(43, 100%, 88%, 0.25) 62%,hsla(48, 100%, 82%, 0.00) 100%);top:0px;flex-direction:column;align-items:center;backdrop-filter:blur(5px);justify-content:center" id="lateral">
            <div class="bottom-nav" style="display:flex;position:relative;flex-direction:column;align-items:center;width:100%">
                    <div style="color:white;height:85px;line-height:105px;"><img src="{{asset('image/svg/barra.svg')}} " alt="" style="width:30px;transform: rotate(180deg);"></div>
                    <a href="#" data-open="#entryModal"><div class="icon" style="color:white;height:85px;line-height:105px;"><img src="{{asset('image/svg/bolsa.svg')}} " alt="" style="width:20px;"></div></a>
                    <div class="icon" style="color:white;height:85px;line-height:105px;"><img src="{{asset('image/svg/compartir1.svg')}} " alt="" style="width:20px;"></div>
                <a href="{{ asset('login')}} "><div class="icon" style="color:white;height:85px;line-height:105px;"><img src="{{asset('image/svg/perfil.svg')}} " alt="" style="width:20px;"></div></a> 
                    <div class="icon" style="cursor:pointer;color:white;height:85px;line-height:105px;"><img src="{{asset('image/svg/lupa.svg')}} " alt="" style="width:20px;"></div>
            </div>
  </div>
        <!-- NAV TOP -->

  <div style="position:fixed;top:20px;width:100%;z-index:999;background:none">
            <div style="display:flex;align-items:center;flex-direction:row;padding:0px 10px">
                <div style="display:flex;align-items:center;flex-direction:row;width:20%">
                    <div  style="transition-duration: 0.1s;position:relative; width:120px;font-size:17px;font-family:sans-serif">
                        <img src="{{asset('image/logo.png')}}  " class="logo1" alt="Adler logo " >
                    </div>
               </div>
               
               <div style="justify-content:center;align-items:center" class="menutop">
                
                    <a href="{{asset('busco')}}" style="width:25%"><div class="topf" style="text-align:center;color:white;width:100%">PRODUCTOS</div></a>
                    <a href="/" style="width:25%"><div class="topf" style="text-align:center;color:white;width:100%">IA AMIGURUMI</div></a>
                    <a href="/" style="width:25%"><div class="topf" style="text-align:center;color:white;width:100%">UNETE</div></a>
                    
               </div>
                
                
            </div> 
            <form action="{{ route('item') }}" method="GET" style="width:95%">
                          @csrf
                            
                            <div class="search-container">
                                <input type="text" id="searchid" name="name" class="search-bar" placeholder="Buscar producto">
                                <svg class="search-icon" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                                </svg>
                            </div>
            </form>
    </div>
    <!-- Definiciones SVG del efecto de burbuja (las que pasaste) -->
    <svg class="svg svg--defs" aria-hidden="true">
        <defs>
            <!-- Transparencia básica de la burbuja -->
            <radialGradient id="grad--bw" fx="25%" fy="25%">
                <stop offset="0%"  stop-color="black"/>
                <stop offset="30%" stop-color="black" stop-opacity=".2"/>
                <stop offset="97%" stop-color="white" stop-opacity=".4"/>
                <stop offset="100%" stop-color="black"/>
            </radialGradient>

            <mask id="mask" maskContentUnits="objectBoundingBox">
                <rect fill="url(#grad--bw)" width="1" height="1"></rect>
            </mask>

            <!-- Manchas de luz -->
            <radialGradient id="grad--spot" fx="50%" fy="20%">
                <stop offset="10%" stop-color="white" stop-opacity=".7"/>
                <stop offset="70%" stop-color="white" stop-opacity="0"/>
            </radialGradient>

            <!-- Luz arriba / abajo -->
            <radialGradient id="grad--bw-light" fy="10%">
                <stop offset="60%" stop-color="black" stop-opacity="0"/>
                <stop offset="90%" stop-color="white" stop-opacity=".25"/>
                <stop offset="100%" stop-color="black"/>
            </radialGradient>

            <mask id="mask--light-top" maskContentUnits="objectBoundingBox">
                <rect fill="url(#grad--bw-light)"
                      width="1" height="1"
                      transform="rotate(180, .5, .5)"></rect>
            </mask>

            <mask id="mask--light-bottom" maskContentUnits="objectBoundingBox">
                <rect fill="url(#grad--bw-light)" width="1" height="1"></rect>
            </mask>

            <!-- Degradado de color arcoíris -->
            <linearGradient id="grad" x1="0" y1="100%" x2="100%" y2="0">
                <stop offset="0%"   stop-color="dodgerblue"/>
                <stop offset="50%"  stop-color="fuchsia"/>
                <stop offset="100%" stop-color="yellow"/>
            </linearGradient>
        </defs>
    </svg>
    @php
    // Convierte la colección $some en un array de URLs públicas
    $imgUrls = collect($some)->map(function($item){
        // Ajusta los nombres de campo según tu tabla: image | imagen | foto
        if(isset($item->image) && $item->image) {
            return asset('image/productos/' . $item->image);
        }
        if(isset($item->imagen) && $item->imagen) {
            return asset('image/productos/' . $item->imagen);
        }
        if(isset($item->foto) && $item->foto) {
            return asset('image/productos/' . $item->foto);
        }
        // Si el campo ya contiene URL completa:
        if(isset($item->url) && $item->url) {
            return $item->url;
        }
        // fallback (imagen por defecto si faltan datos)
        return asset('image/productos/default.png');
    })->values()->toArray();
  @endphp  
    <img id="imagenCentral" class="imagen-central" src="" alt="">
    <nav class="bottom-nav">
            <div class="nav-item active" style="position: relative; overflow: hidden;">
                <svg class="nav-icon" fill="white" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path>
                </svg>
                <span class="nav-label">Inicio</span>
            </div>
            
            <a href="{{asset('buscando')}}"><div class="nav-item" style="position: relative; overflow: hidden;">
                <svg class="nav-icon" fill="white" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <span class="nav-label">Productos</span>
            </div></a>
            
            <a href="#" data-open="#entryModal"><div class="nav-item" style="position: relative; overflow: hidden;">
                <svg class="nav-icon" fill="white" viewBox="0 0 24 24">
                    <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                </svg>
                <span class="nav-label">Cart</span>
            </div></a>
            
            <a href="{{asset('login')}}"><div class="nav-item" style="position: relative; overflow: hidden;">
                <svg class="nav-icon" fill="white" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                </svg>
                <span class="nav-label">Mi cuenta</span>
            </div></a>
    </nav>
    <script>
        // ------------- Utilidades -------------
        function rand(a, b) { return a + Math.random() * (b - a); }
        function clamp(v, a, b) { return Math.max(a, Math.min(b, v)); }

        // ------------- Definición de imágenes -------------
        const todasLasImagenes = @json($imgUrls);

        // fallback si por alguna razón quedó vacío (opcional)
        if (!todasLasImagenes || !todasLasImagenes.length) {
          for (let i=1; i<=12; i++){
            todasLasImagenes.push(`https://picsum.photos/400/400?random=${i}`);
          }
        }

        let imagenesDisponibles = [...todasLasImagenes];
        let imagenEnCentro = null;

        const imagenCentral = document.getElementById('imagenCentral');

        function mostrarImagenCentral(nuevaImagenUrl) {
            if (imagenEnCentro !== null) {
                imagenesDisponibles.push(imagenEnCentro);
            }

            imagenCentral.classList.remove('visible');

            setTimeout(() => {
                imagenCentral.src = nuevaImagenUrl;
                imagenEnCentro = nuevaImagenUrl;
                imagenCentral.classList.add('visible');
            }, 250);
        }

        function obtenerImagenAleatoria() {
            if (imagenesDisponibles.length === 0) return null;
            const i = Math.floor(Math.random() * imagenesDisponibles.length);
            const img = imagenesDisponibles[i];
            imagenesDisponibles.splice(i, 1);
            return img;
        }

        // ------------- Partículas -------------
        function crearParticulasEn(x, y, num = 10) {
            for (let i = 0; i < num; i++) {
                const particula = document.createElement('div');
                particula.className = 'particula';
                particula.style.left = x + 'px';
                particula.style.top = y + 'px';

                const angulo = Math.random() * Math.PI * 2;
                const distancia = 40 + Math.random() * 60;
                const tx = Math.cos(angulo) * distancia;
                const ty = Math.sin(angulo) * distancia;

                particula.style.setProperty('--tx', tx + 'px');
                particula.style.setProperty('--ty', ty + 'px');

                document.body.appendChild(particula);

                setTimeout(() => particula.remove(), 700);
            }
        }

        // ------------- Overlay SVG de burbuja realista -------------
        function crearOverlaySVG() {
            const svgns = 'http://www.w3.org/2000/svg';
            const svg = document.createElementNS(svgns, 'svg');
            svg.setAttribute('class', 'bubble-overlay');
            svg.setAttribute('viewBox', '0 0 200 200');
            svg.setAttribute('aria-hidden', 'true');
            svg.innerHTML = `
                <g class="bubble__group">
                    <ellipse rx="20%" ry="10%"
                        cx="150" cy="150"
                        fill="url(#grad--spot)"
                        transform="rotate(-225,150,150)"></ellipse>
                    <circle r="50%" cx="50%" cy="50%"
                        fill="aqua"
                        mask="url(#mask--light-bottom)"></circle>
                    <circle r="50%" cx="50%" cy="50%"
                        fill="yellow"
                        mask="url(#mask--light-top)"></circle>
                    <ellipse rx="55" ry="25"
                        cx="55" cy="55"
                        fill="url(#grad--spot)"
                        transform="rotate(-45,55,55)"></ellipse>
                    <circle r="50%" cx="50%" cy="50%"
                        fill="url(#grad)"
                        mask="url(#mask)"></circle>
                </g>
            `;
            return svg;
        }

        // ------------- Clase Burbuja principal (con imagen) -------------
        class Burbuja {
            constructor(x, y, imagenUrl, size) {
                this.size = size;
                this.radio = size / 2;

                this.x = x;
                this.y = y;
                this.vx = (Math.random() - 0.5) * 2;
                this.vy = (Math.random() - 0.5) * 2;
                this.ax = 0;
                this.ay = 0;
                this.tiempo = Math.random() * 1000;
                this.imagenUrl = imagenUrl;

                this.elemento = document.createElement('div');
                this.elemento.className = 'burbuja';
                this.elemento.style.width = this.size + 'px';
                this.elemento.style.height = this.size + 'px';
                this.elemento.style.left = this.x + 'px';
                this.elemento.style.top = this.y + 'px';

                const img = document.createElement('img');
                img.className = 'burbuja-imagen';
                img.src = imagenUrl;
                this.elemento.appendChild(img);

                // Overlay SVG de efecto burbuja
                const overlay = crearOverlaySVG();
                this.elemento.appendChild(overlay);

                const rim = document.createElement('div');
                rim.className = 'rim';
                this.elemento.appendChild(rim);

                const lower = document.createElement('div');
                lower.className = 'lower-reflect';
                this.elemento.appendChild(lower);

                document.body.appendChild(this.elemento);

                this.elemento.addEventListener('click', () => this.reventar());
            }

            mover() {
                this.tiempo += 0.016;

                this.ax = Math.sin(this.tiempo * 0.5) * 0.04 +
                          Math.sin(this.tiempo * 1.2) * 0.02;
                this.ay = Math.cos(this.tiempo * 0.7) * 0.03 +
                          Math.sin(this.tiempo * 0.9) * 0.015;

                this.vx += this.ax;
                this.vy += this.ay;

                this.vx *= 0.985;
                this.vy *= 0.985;

                const velocidadMax = 3;
                const velocidad = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
                if (velocidad > velocidadMax) {
                    this.vx = (this.vx / velocidad) * velocidadMax;
                    this.vy = (this.vy / velocidad) * velocidadMax;
                }

                this.x += this.vx;
                this.y += this.vy;

                if (this.x - this.radio <= 0 || this.x + this.radio >= window.innerWidth) {
                    this.vx *= -0.7;
                    this.x = Math.max(this.radio, Math.min(window.innerWidth - this.radio, this.x));
                }

                if (this.y - this.radio <= 0 || this.y + this.radio >= window.innerHeight) {
                    this.vy *= -0.7;
                    this.y = Math.max(this.radio, Math.min(window.innerHeight - this.radio, this.y));
                }

                this.elemento.style.left = this.x + 'px';
                this.elemento.style.top = this.y + 'px';
            }

            reventar() {
                this.elemento.classList.add('reventando');

                const cx = this.x + this.radio;
                const cy = this.y + this.radio;
                crearParticulasEn(cx, cy, 10);

                mostrarImagenCentral(this.imagenUrl);

                setTimeout(() => {
                    this.elemento.remove();
                    const index = burbujas.indexOf(this);
                    if (index > -1) {
                        burbujas.splice(index, 1);
                    }
                    crearBurbuja();
                }, 400);
            }
        }

        // ------------- Burbujas decorativas (click en fondo, 10s de vida) -------------
        class DecorBurbuja {
            constructor(x, y, size) {
                this.size = size;
                this.radio = size / 2;

                this.x = x - this.radio;
                this.y = y - this.radio;
                this.vx = (Math.random() - 0.5) * 2;
                this.vy = (Math.random() - 0.5) * 2;
                this.ax = 0;
                this.ay = 0;
                this.tiempo = Math.random() * 1000;
                this.birth = performance.now();
                this.life = 10000; // 10s

                this.elemento = document.createElement('div');
                this.elemento.className = 'burbuja';
                this.elemento.style.width = this.size + 'px';
                this.elemento.style.height = this.size + 'px';
                this.elemento.style.left = this.x + 'px';
                this.elemento.style.top = this.y + 'px';

                // un poco más tenue y sin imagen
                this.elemento.style.background = 'radial-gradient(circle at 30% 30%, rgba(255,255,255,0.22), rgba(255,255,255,0.10) 45%, rgba(255,255,255,0.02))';
                this.elemento.style.borderColor = 'rgba(255,255,255,0.18)';

                const overlay = crearOverlaySVG();
                this.elemento.appendChild(overlay);

                const rim = document.createElement('div');
                rim.className = 'rim';
                this.elemento.appendChild(rim);

                const lower = document.createElement('div');
                lower.className = 'lower-reflect';
                this.elemento.appendChild(lower);

                document.body.appendChild(this.elemento);
            }

            mover() {
                const now = performance.now();
                const edad = now - this.birth;

                this.tiempo += 0.016;

                this.ax = Math.sin(this.tiempo * 0.5) * 0.04 +
                          Math.sin(this.tiempo * 1.1) * 0.02;
                this.ay = Math.cos(this.tiempo * 0.6) * 0.03 +
                          Math.sin(this.tiempo * 0.9) * 0.015;

                this.vx += this.ax;
                this.vy += this.ay;

                this.vx *= 0.987;
                this.vy *= 0.987;

                const velocidadMax = 3;
                const velocidad = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
                if (velocidad > velocidadMax) {
                    this.vx = (this.vx / velocidad) * velocidadMax;
                    this.vy = (this.vy / velocidad) * velocidadMax;
                }

                this.x += this.vx;
                this.y += this.vy;

                if (this.x - this.radio <= 0 || this.x + this.radio >= window.innerWidth) {
                    this.vx *= -0.7;
                    this.x = Math.max(this.radio, Math.min(window.innerWidth - this.radio, this.x));
                }

                if (this.y - this.radio <= 0 || this.y + this.radio >= window.innerHeight) {
                    this.vy *= -0.7;
                    this.y = Math.max(this.radio, Math.min(window.innerHeight - this.radio, this.y));
                }

                this.elemento.style.left = this.x + 'px';
                this.elemento.style.top = this.y + 'px';

                if (edad >= this.life) {
                    this.explotarAuto();
                }
            }

            explotarAuto() {
                if (!this.elemento) return;
                this.elemento.classList.add('reventando');
                const cx = this.x + this.radio;
                const cy = this.y + this.radio;
                crearParticulasEn(cx, cy, 8);
                setTimeout(() => {
                    if (this.elemento) this.elemento.remove();
                }, 400);
                const idx = decorBurbujas.indexOf(this);
                if (idx > -1) decorBurbujas.splice(idx, 1);
                this.elemento = null;
            }
        }

        const burbujas = [];
        const decorBurbujas = [];

        function crearBurbuja() {
            const imagenUrl = obtenerImagenAleatoria();
            if (imagenUrl === null) return;

            const size = rand(80, 120); // 80 a 120px
            const margen = size;
            const x = Math.random() * (window.innerWidth - margen * 2) + margen;
            const y = Math.random() * (window.innerHeight - margen * 2) + margen;

            burbujas.push(new Burbuja(x, y, imagenUrl, size));
        }

        // Crear 7 burbujas iniciales (todas con tamaño aleatorio)
        for (let i = 0; i < 7; i++) crearBurbuja();

        // Clic en fondo: burbujas decorativas
        document.addEventListener('click', (e) => {
            if (e.target.closest('.burbuja')) return;

            const x = e.clientX;
            const y = e.clientY;
            const cantidad = 2 + Math.floor(Math.random() * 3);

            for (let i = 0; i < cantidad; i++) {
                const size = rand(30, 80);
                const d = new DecorBurbuja(
                    x + rand(-20, 20),
                    y + rand(-20, 20),
                    size
                );
                decorBurbujas.push(d);
            }
        });

        // Animación global
        function animar() {
            burbujas.forEach(b => b.mover());
            for (let i = decorBurbujas.length - 1; i >= 0; i--) {
                decorBurbujas[i].mover();
            }
            requestAnimationFrame(animar);
        }

        animar();
    </script>
        <script>
  // ===== Lógica de apertura/cierre =====
  (function(){
    const overlay = document.getElementById('adlrSearch');
    const input   = document.getElementById('adlrSearchInput');
    const closeBtn = overlay.querySelector('.adlr-close');

    // Intentamos enganchar la lupa que mencionaste. Si hay varias .icon, agarramos la que contiene "lupa.svg".
    const openTrigger =
      document.querySelector('.icon img[src*="lupa.svg"]')?.closest('.icon')
      || document.querySelector('.icon');

    function openSearch(){
      overlay.classList.add('is-open');
      overlay.setAttribute('aria-hidden','false');
      // bloquea scroll del body mientras está abierto
      document.documentElement.style.overflow = 'hidden';
      document.body.style.overflow = 'hidden';
      // enfocamos input tras pintar
      setTimeout(() => input && input.focus(), 10);
    }

    function closeSearch(){
      overlay.classList.remove('is-open');
      overlay.setAttribute('aria-hidden','true');
      document.documentElement.style.overflow = '';
      document.body.style.overflow = '';
    }

    // abrir
    openTrigger && openTrigger.addEventListener('click', function(e){
      e.preventDefault();
      openSearch();
    });

    // cerrar con botón
   

    // cerrar al hacer clic fuera de la caja
    overlay.addEventListener('click', function(e){
      if (e.target === overlay) closeSearch();
    });

    // cerrar con Escape
    document.addEventListener('keydown', function(e){
      if (e.key === 'Escape' && overlay.classList.contains('is-open')) {
        closeSearch();
      }
    });
  })();
</script>
</body>
</html>
