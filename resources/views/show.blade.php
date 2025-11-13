<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>@include ('global.name') — {{$searches->name}}</title>
   @include ('global.icon')
  <style>
    :root{
      --bg-start:#ede9fe; /* purple-100 */
      --bg-mid:#eff6ff;   /* blue-50   */
      --bg-end:#e0e7ff;   /* indigo-100 */
      --text:#111827;     /* gray-900 */
      --muted:#6b7280;    /* gray-500 */
      --muted-600:#4b5563;/* gray-600 */
      --card:#ffffff;
      --line:#e5e7eb;     /* gray-200 */
      --line-100:#f3f4f6; /* gray-100 */
      --emerald-50:#ecfdf5;
      --emerald-100:#d1fae5;
      --emerald-500:#10b981;
      --emerald-600:#059669;
      --blue-500:#3b82f6;
      --purple-600:#7c3aed;
      --yellow-400:#f59e0b;
      --red-50:#fef2f2;
      --red-100:#fee2e2;
      --red-600:#dc2626;
      --shadow-lg:0 10px 25px rgba(0,0,0,.08);
      --shadow-xl:0 12px 30px rgba(0,0,0,.12);
      --radius-xl:24px;
      --radius-2xl:28px;
      --radius-3xl:32px;
      --radius-full:999px;
      --container:1200px;
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Inter,system-ui,Arial,sans-serif;
      color:var(--text);
      background: #f2f2f2ff;
      min-height:100%;
    }
    a{
        text-decoration:none
    }
    /* Layout helpers */
    .container{max-width:var(--container); margin:0 auto; padding:0 24px}
    .btn{
      display:inline-flex; align-items:center; justify-content:center;
      border:0; cursor:pointer; transition:transform .15s ease,background .2s ease,box-shadow .2s ease;
      font-weight:700; border-radius:18px;
    }
    .btn:active{transform:scale(.98)}
    .chip{
      display:inline-flex; align-items:center; gap:8px;
      background:var(--emerald-100); color:var(--emerald-600);
      padding:6px 12px; border-radius:999px; font-weight:600; font-size:14px;
    }
    .card{
      background:var(--card); border-radius:var(--radius-3xl); box-shadow:var(--shadow-xl); overflow:hidden;
    }
    .muted{color:var(--muted)}
    .muted-600{color:var(--muted-600)}

    /* Header */
    header{position:relative; z-index:10; border-bottom:1px solid var(--line-100);padding:10px}
    .header-row{display:flex; align-items:center; justify-content:space-between; padding:12px 0}
    nav a{
      color:var(--muted-600); font-weight:600; text-decoration:none;
    }
    nav a:hover{color:var(--text)}
    .icon-btn{
      width:40px; height:40px; display:grid; place-items:center;
      border-radius:999px; background:transparent; border:0; cursor:pointer;
      transition:background .2s ease;
      
    }
    .icon-btn:hover{background:rgba(255,255,255,.6)}
    .cart-badge{
      position:absolute; top:26px; left:0px; width:20px; height:20px;
      font-size:10px; font-weight:800; color:#fff; background:var(--emerald-500);
      display:grid; place-items:center; border-radius:999px;
    }

    /* Grid principal */
    .hero{padding:32px}
    .hero-grid{
      display:grid; grid-template-columns:1fr; min-height:600px;
    }
    
    
    .hide-mobile{display:none}
    @media(min-width:1024px){
      .hero-grid{grid-template-columns:1fr 1fr}
      .hide-mobile{display:flex}
      
    }
    
    /* Columna izquierda */
    .left{padding:48px 48px}
    @media(min-width:1024px){.left{padding:64px 48px}}
    h1.title{font-size:40px; line-height:1.1; margin:8px 0 0}
    
    .stars{display:flex; gap:4px; align-items:center}
    .star svg{width:20px; height:20px}
    .star.full path{fill:var(--yellow-400); stroke:var(--yellow-400)}
    .star.empty path{stroke:#d1d5db}
    .kpis{display:flex; gap:32px; margin:16px 0 0}
    .kpis .kpi{text-align:center}
    .kpis .kpi .v{font-size:24px; font-weight:800}
    .kpis .kpi .l{font-size:12px; color:var(--muted)}

    .features{margin-top:16px; display:grid; gap:10px}
    .feature{display:flex; align-items:center; gap:12px}
    .bullet{
      width:24px; height:24px; border-radius:999px;
      display:grid; place-items:center; background:var(--emerald-100);
    }
    .bullet svg{width:16px; height:16px; stroke:var(--emerald-600)}

    .qty-wishlist{display:flex; gap:16px; align-items:center; margin-top:16px}
    .qty{
      display:flex; align-items:center; border:2px solid var(--line); border-radius:14px; overflow:hidden;
    }
    .qty button{
      width:44px; height:44px; background:#fff; border:0; cursor:not-allowed; /* sin JS */
    }
    .qty input{
      width:72px; height:44px; text-align:center; border:0; font-size:18px; font-weight:800;
      -moz-appearance:textfield;
    }
    .qty input::-webkit-outer-spin-button,
    .qty input::-webkit-inner-spin-button{ -webkit-appearance: none; margin: 0; }

    /* Wishlist sólo con CSS */
    .wish{
      position:relative; width:46px; height:46px; border:2px solid var(--line);
      border-radius:14px; display:grid; place-items:center; cursor:pointer; transition:border .2s, background .2s, color .2s;
      color:#6b7280; /* gray-600 */
    }
    .wish:hover{border-color:#d1d5db}
    .wish input{position:absolute; inset:0; opacity:0; cursor:pointer}
    .wish svg{width:20px; height:20px; transition:fill .2s, color .2s}
    .wish input:checked ~ .icon{color:var(--red-600)}
    .wish input:checked ~ .bg{opacity:1}
    .wish .bg{
      position:absolute; inset:0; background:var(--red-50); border-radius:14px; opacity:0; transition:opacity .2s;
      z-index:-1;
    }
    .price{
      margin-top:12px; display:flex; align-items:baseline; gap:12px; flex-wrap:wrap;
    }
    .price .now{font-size:28px; font-weight:900}
    .price .old{color:#9ca3af; text-decoration:line-through; font-size:18px}
    .discount{
      background:var(--red-100); color:var(--red-600); font-weight:800; font-size:12px;
      padding:4px 8px; border-radius:999px;
    }
    .per-unit{font-size:12px; color:var(--muted)}

    /* Columna derecha visual */
    .right{
      position:relative; padding:48px; display:flex; align-items:center; justify-content:center;
      
   
  background: linear-gradient(135deg, #e2cd64, #afa409, #6f6a00);;

      overflow:hidden;
    }
    .bubble{position:absolute; background:rgba(255,255,255,.12); border-radius:999px}
    .b1{top:32px; right:32px; width:80px; height:80px}
    .b2{bottom:48px; left:32px; width:48px; height:48px}
    .b3{top:50%; left:32px; transform:translateY(-50%); width:24px; height:24px; background:rgba(255,255,255,.2)}
    .b4{ top:22%; left:60%; width:36px; height:36px; background:rgba(255,255,255,.16) }
    .b5{ top:68%; left:72%; width:22px; height:22px; background:rgba(255,255,255,.18) }
    .b6{ top:12%; left:15%; width:28px; height:28px; background:rgba(255,255,255,.14) }  
    .circle-wrap{
      position:relative; width:320px; height:320px; border-radius:999px;
      backdrop-filter: blur(6px); border:1px solid rgba(255,255,255,.3);
      background:rgba(255,255,255,.18);
      display:grid; place-items:center;
    }
    .circle-inner{
      width:256px; height:256px; border-radius:999px; 
      @if($searches->tipo===1)
        background:white;
      @elseif($searches->tipo===2) 
        background:none;
      @else
      background:black;
      @endif
       display:grid; place-items:center; box-shadow:var(--shadow-xl)
    }
    .product-img{
      width:192px; height:192px; object-fit:contain;
    }
    .float-card{
      position:absolute; background:#fff; border-radius:16px; padding:12px 14px; box-shadow:var(--shadow-lg);
      display:flex; align-items:center; gap:10px; min-width:140px;
    }
    .float-top-right{top:-12px; right:-12px}
    .float-bottom-left{bottom:-12px; left:-12px}
    .float-title{font-size:12px; font-weight:800; color:var(--text)}
    .float-sub{font-size:11px; color:var(--muted)}  
    .search-container {
            flex: 1;
            max-width: 32rem;
            position: relative;
            display:flex
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 3rem 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: #111827;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            width: 1.25rem;
            height: 1.25rem;
            margin-left:-40px;
        }
    .stamp{
      position:absolute; top:48px; left:48px; color:rgba(255,255,255,.92)
    }
    .stamp .big{font-size:56px; font-weight:900; line-height:.95}
    .stamp .sub{margin-top:8px; font-size:16px; font-weight:600; color:rgba(255,255,255,.8)}
    .badge-right{
      position:absolute; bottom:48px; right:48px; text-align:right; color:rgba(255,255,255,.92)
    }
    .badge-right .val{font-size:36px; font-weight:900}
    .badge-right .lbl{font-size:13px; color:rgba(255,255,255,.8)}
    /* --- Zoom y contención --- */

.product-img{
  width:192px; height:192px; object-fit:contain;
  transition: transform .35s ease, filter .35s ease;
  transform-origin: center center;
  cursor: zoom-in;
  z-index: 2;
}
.product-img.zoomed{
  transform: scale(1.2);
  filter: drop-shadow(0 18px 40px rgba(0,0,0,.35));
  cursor: zoom-out;
}
.circle-inner{
  transition: transform .35s ease;
  overflow:hidden  /* ← añade esta línea si no estaba */
}
.circle-inner.zoomed{
  transform: scale(1.2);              /* ← el círculo también escala a 2 */
}
/* --- Miniaturas en columna (inferior izquierda) --- */
.thumbs-col{
  position: absolute;
  left: 18px;
  bottom: 18px;
  display: flex;
  flex-direction: column;
  gap: 8px;
  z-index: 3;
  backdrop-filter: blur(6px);
  -webkit-backdrop-filter: blur(6px);
}
.thumb{
  width: 52px; height: 52px;
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,.28);
  background: rgba(255,255,255,.10);
  padding: 4px;
  display: grid; place-items: center;
  cursor: pointer;
  transition: transform .15s ease, box-shadow .2s ease, border-color .2s ease;
}
.thumb img{ width:100%; height:100%; object-fit: contain; }
.thumb:hover{ transform: translateY(-2px); box-shadow: 0 8px 22px rgba(0,0,0,.25); }
.thumb.active{ border-color: rgba(255,255,255,.7); }

/* --- Burbujas con animación eficiente --- */
.bubble{ will-change: transform; } /* mejora rendimiento */

    /* Barra inferior acciones */
    .bar{
      background:#f9fafb; padding:20px 48px; display:flex; align-items:center; justify-content:space-between; gap:16px;
      flex-wrap:wrap;
    }
    .bar .info{
      display:flex; align-items:center; gap:12px; color:var(--muted-600); font-size:14px; flex-wrap:wrap;
    }
    .dot{width:8px; height:8px; border-radius:999px; background:var(--emerald-500)}
    .btn-primary{
      background:#111827; color:#fff; padding:14px 28px; border-radius:18px; box-shadow:var(--shadow-lg);
    }
    .btn-primary:hover{background:#1f2937}

    /* Nuevas secciones */
    .section{padding:56px 0}
    .section h2{font-size:32px; font-weight:900; margin:0 0 32px; text-align:center}
    .section h3{font-size:24px; font-weight:800; margin:0 0 16px}
    
    /* Pestañas de información */
    .tabs{margin-bottom:32px}
    .tab-nav{
      display:flex; gap:4px; background:var(--line-100); border-radius:16px; padding:4px;
      overflow-x:auto;
    }
    .tab-btn{
      padding:12px 24px; border:0; background:transparent; cursor:pointer;
      font-weight:600; border-radius:12px; transition:all .2s ease; white-space:nowrap;
      color:var(--muted-600);
    }
    .tab-btn.active{background:#fff; color:var(--text); box-shadow:var(--shadow-lg)}
    .tab-content{display:none}
    .tab-content.active{display:block}

    /* Descripción */
    .description{
      background:#fff; border-radius:var(--radius-3xl); padding:48px; box-shadow:var(--shadow-xl);
      line-height:1.7;
    }
    .description p{margin:0 0 20px}
    .description p:last-child{margin:0}
    
    .highlight-box{
      background:var(--emerald-50); border-radius:20px; padding:24px; margin:24px 0;
      border-left:4px solid var(--emerald-500);
    }

    /* Especificaciones */
    .specs{
      background:#fff; border-radius:var(--radius-3xl); padding:48px; box-shadow:var(--shadow-xl);
    }
    .specs-grid{display:grid; gap:24px}
    @media(min-width:768px){
      .specs-grid{grid-template-columns:1fr 1fr}
    }
    .spec-item{
      display:flex; align-items:flex-start; gap:16px; padding:20px; background:var(--line-100); border-radius:16px;
    }
    .spec-icon{
      width:40px; height:40px; background:var(--emerald-100); border-radius:12px;
      display:grid; place-items:center; flex-shrink:0;
    }
    .spec-icon svg{width:20px; height:20px; stroke:var(--emerald-600)}
    .spec-content h4{margin:0 0 4px; font-weight:700}
    .spec-content p{margin:0; color:var(--muted-600); font-size:14px}

    /* Reseñas */
    .reviews{
      background:#fff; border-radius:var(--radius-3xl); padding:48px; box-shadow:var(--shadow-xl);
    }
    .review-summary{
      display:flex; gap:48px; align-items:center; margin-bottom:40px; padding-bottom:32px;
      border-bottom:1px solid var(--line);
    }
    .rating-overview{text-align:center}
    .big-rating{font-size:48px; font-weight:900; margin:0}
    .rating-bars{flex:1; max-width:300px}
    .rating-bar{display:flex; align-items:center; gap:12px; margin-bottom:8px}
    .rating-bar span{font-size:14px; color:var(--muted-600); min-width:20px}
    .bar-bg{flex:1; height:8px; background:var(--line); border-radius:999px; overflow:hidden}
    .bar-fill{height:100%; background:var(--yellow-400); border-radius:999px}

    .review-list{display:grid; gap:24px}
    .review-item{
      padding:24px; background:var(--line-100); border-radius:20px;
    }
    .review-header{display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px}
    .reviewer{
      display:flex; align-items:center; gap:12px;
    }
    .avatar{
      width:40px; height:40px; background:var(--emerald-500); border-radius:999px;
      display:grid; place-items:center; color:#fff; font-weight:700;
    }
    .reviewer-info h5{margin:0; font-weight:700}
    .reviewer-info .date{font-size:12px; color:var(--muted)}
    .review-stars{display:flex; gap:2px}
    .review-text{margin:12px 0 0; line-height:1.6}

    /* Garantía */
    .warranty{
      background:#fff; border-radius:var(--radius-3xl); padding:48px; box-shadow:var(--shadow-xl);
    }
    .warranty-grid{display:grid; gap:24px}
    @media(min-width:768px){
      .warranty-grid{grid-template-columns:repeat(2,1fr)}
    }
    .warranty-item{
      padding:24px; background:var(--line-100); border-radius:20px; text-align:center;
    }
    .warranty-icon{
      width:64px; height:64px; background:var(--emerald-100); border-radius:16px;
      display:grid; place-items:center; margin:0 auto 16px;
    }
    .warranty-icon svg{width:32px; height:32px; stroke:var(--emerald-600)}
    .warranty-item h4{margin:0 0 8px; font-weight:800}
    .warranty-item p{margin:0; color:var(--muted-600); font-size:14px}

    /* Productos Relacionados */
    .related{padding:56px 0 72px}
    .related h2{font-size:28px; text-align:center; margin:0 0 32px}
    /* Rejilla responsiva con mínimo 2 columnas */
      .grid{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr)); /* ← mínimo 2 siempre */
        gap: 20px;                                        /* puedes dejar 24px si quieres */
      }

      /* A partir de tablet: 3 columnas */
      @media (min-width: 768px){
        .grid{
          grid-template-columns: repeat(3, minmax(0, 1fr));
        }
      }

      /* Escritorio ancho: 4 columnas elegantes */
      @media (min-width: 1200px){
        .grid{
          grid-template-columns: repeat(4, minmax(0, 1fr));
        }
      }


    .p-card{
      background:#fff; border-radius:20px; overflow:hidden; box-shadow:var(--shadow-lg);
      transition:transform .18s ease, box-shadow .18s ease; cursor:pointer;
    }
    .p-card:hover{transform:translateY(-6px); box-shadow:0 18px 40px rgba(0,0,0,.14)}
    .p-visual{
      height:190px; display:flex; align-items:center; justify-content:center; position:relative; padding:24px; color:#fff;
    }
    .grad-blue{background:linear-gradient(135deg, #60a5fa, #2563eb)}
    .grad-purple{background:linear-gradient(135deg, #a78bfa, #7c3aed)}
    .grad-pink{background:linear-gradient(135deg, #fb7185, #db2777)}
    .p-visual img{width:128px; height:128px; object-fit:contain; filter:drop-shadow(0 10px 22px rgba(0,0,0,.25))}
    .p-like{
      position:absolute; top:14px; right:14px; background:rgba(255,255,255,.22); backdrop-filter: blur(4px);
      width:36px; height:36px; display:grid; place-items:center; border-radius:999px;
    }
    .p-body{padding:20px; display:grid; gap:14px}
    .p-name{font-weight:800; font-size:18px}
    .p-row{display:flex; align-items:center; justify-content:space-between}
    .p-price{display:grid; gap:4px}
    .p-price .now{font-size:22px; font-weight:900}
    .p-price .old{font-size:13px; color:#9ca3af; text-decoration:line-through}
    .tiny{font-size:12px; color:var(--muted)}
    .icon-plus-btn{
      width:44px; height:44px; border-radius:14px; background:#111827; color:#fff; display:grid; place-items:center;
    }

    /* Footer */
    footer{
      background:#1f2937; color:#d1d5db; padding:64px 0 32px;
    }
    .footer-content{
      display:grid; gap:48px;
    }
    @media(min-width:768px){
      .footer-content{grid-template-columns:1fr 1fr 1fr 1fr}
    }
    .footer-section h4{color:#fff; font-weight:800; margin:0 0 20px}
    .footer-section ul{list-style:none; padding:0; margin:0}
    .footer-section li{margin-bottom:12px}
    .footer-section a{color:#d1d5db; text-decoration:none; font-size:14px}
    .footer-section a:hover{color:#fff}
    .footer-bottom{
      border-top:1px solid #374151; margin-top:48px; padding-top:24px;
      display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;
    }
    .footer-bottom p{margin:0; font-size:14px}
    .libro-btn{
      background:var(--emerald-600); color:#fff; padding:12px 24px; border-radius:12px;
      text-decoration:none; font-weight:600; transition:background .2s ease;
    }
    .libro-btn:hover{background:var(--emerald-500)}

    /* SVG helpers */
    .svg{display:block; width:20px; height:20px; stroke:currentColor; fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round}
    .svg.fill path{fill:currentColor; stroke:currentColor}

    /* JavaScript para pestañas */
    .tab-content{animation:fadeIn .3s ease}
    @keyframes fadeIn{
      from{opacity:0; transform:translateY(10px)}
      to{opacity:1; transform:translateY(0)}
    }
     /* Top Bar */
        .top-bar {
            background-color: #000000cf;
            color: white;
            padding: 0.5rem 0;
        }

        .top-bar-content {
            display: flex;
            justify-content: flex-end;
            gap: 1.5rem;
            font-size: 0.875rem;
        }

        .top-bar-link {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .top-bar-link:hover {
            color: #fecaca;
        }

        /* Bottom Navigation */
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
            display:none
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
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .nav-item.active {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            transform: translateY(-2px);
            box-shadow: 
                0 6px 20px rgba(255, 25, 0, 0.3),
                inset 0 1px 0 rgba(255,255,255,0.3),
                inset 0 -1px 0 rgba(255, 25, 0, 0.2);
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
            filter: drop-shadow(0 0 15px rgba(255, 106, 0, 0.5));
        }

        .nav-label {
            font-size: 11px;
            font-weight: 500;
            opacity: 0.7;
            transition: all 0.3s ease;
            text-shadow: 0 0 8px rgba(255,255,255,0.1);
            color:#282828;
        }

        .nav-item.active .nav-label {
            opacity: 1;
            font-weight: 600;
            color: #ab2f16ff;
            text-shadow: 0 0 12px rgba(255,215,0,0.4);
        }

        .nav-item:hover .nav-label {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 120px;
            right: 30px;
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid transparent;
            border-radius: 50%;
            color: white;
            font-size: 24px;
            font-weight: 300;
            cursor: pointer;
            box-shadow: 
                0 8px 32px rgba(0,0,0,0.3),
                inset 0 1px 0 rgba(255,255,255,0.2);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            position: relative;
            overflow: hidden;
        }

        .fab::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 50%;
            padding: 1px;
            background: linear-gradient(
                135deg, 
                rgba(255,255,255,0.4) 0%, 
                rgba(255,64,129,0.3) 30%, 
                rgba(33,150,243,0.3) 70%, 
                rgba(255,255,255,0.2) 100%
            );
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: xor;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            pointer-events: none;
        }

        .fab:hover {
            transform: scale(1.15) translateY(-3px);
            background: rgba(255,255,255,0.2);
            box-shadow: 
                0 12px 40px rgba(0,0,0,0.4),
                inset 0 1px 0 rgba(255,255,255,0.3);
        }

    
    /* Utility spacing tweaks mobile */
    @media(max-width:480px){
      .left{padding:28px 20px}
      .right{padding:28px}
      .bar{padding:16px 20px}
      .circle-wrap{width:280px; height:280px}
      .circle-inner{width:220px; height:220px}
      .product-img{width:170px; height:170px}
      .stamp .big{font-size:42px}
      .badge-right .val{font-size:28px}
      .description, .specs, .reviews, .warranty{padding:28px 20px}
      .review-summary{flex-direction:column; gap:24px; text-align:center}
      .header-row {position: fixed;left:0;width:100%;top:0;background:white;padding:15px}
      .hero{margin-top:30px}
      .login {display:none}
      .carrito {display:none}
    }
    @media (max-width:720px){
        h1.title{font-size:20px}
        .hero{padding:15px}
        .stamp .big {font-size:17px}
        .stamp {top:28px;left:28px}
        .stamp .sub{margin:0;}
        .float-top-right{display:none}
        .badge-right {bottom:28px;right:28px}
        .agregando{position: fixed;bottom: 100px;    width: 90%;left: 5%;background: rgb(137 128 16 / 67%);
        z-index: 999;}
        .allforall {display:flex}
        .section{padding:15px}
        .grid{padding:15px}
        .bottom-nav{display:flex}
    }
.description { 
  white-space: pre-wrap;   /* respeta \n, \r\n, espacios y hace wrap */
  word-wrap: break-word;   /* por si meten testamentos sin espacios */
}
.social-box {
    
    padding: 12px;
    display: flex;
    flex-direction: column;
    gap: 21px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2),
                inset 0 -1px 0 rgba(255, 255, 255, 0.1);
    border: 1px solid transparent;
    backdrop-filter: blur(2px);
    
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
/* ===== Toast carrito ===== */
.toast{
  position: fixed;
  left: 50%;
  bottom: 24px;
  transform: translateX(-50%) translateY(16px);
  opacity: 0;
  pointer-events: none;
  transition: transform .28s ease, opacity .28s ease;
  z-index: 99999;
}

.toast[aria-hidden="false"]{
  pointer-events: auto;
}

.toast.show{
  opacity: 1;
  transform: translateX(-50%) translateY(0);
}

.toast.hide{
  opacity: 0;
  transform: translateX(-50%) translateY(12px);
}

.toast-inner{
  display: flex;
  gap: 12px;
  align-items: center;
  padding: 12px 16px;
  border-radius: 14px;
  background: rgb(63 146 3 / 46%);
  color: #fff;
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
  border: 1px solid rgba(255,255,255, .12);
  box-shadow: 0 12px 40px rgba(0,0,0,.25), inset 0 1px 0 rgba(255,255,255,.1);
}

.toast-icon{
  display: inline-grid;
  place-items: center;
  width: 28px;
  height: 28px;
  border-radius: 999px;
  background: rgba(255,255,255, .12);
  color: #10b981; /* emerald-500 */
}

.toast-title{
  display: block;
  font-weight: 800;
  line-height: 1.1;
}

.toast-sub{
  font-size: 12px;
  opacity: .9;
}

/* Para pantallas pequeñas: que no tape la bottom-nav */
@media (max-width: 720px){
  .toast{ bottom: 88px; } /* súbelo un poco para no chocar con la barra inferior */
}
/* HERO PRODUCTO ROPA */

.pdp-hero {
    padding: 32px 16px;
    background: #f5f5f7;
}

.pdp-hero-card {
    max-width: 1120px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 24px;
    padding: 24px 24px 20px;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.08);
}

.pdp-hero * {
    box-sizing: border-box;
    font-family: "Kantumruy Pro", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
}

/* GRID */

.pdp-hero-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.25fr) minmax(0, 1fr);
    gap: 32px;
    align-items: stretch;
}

.pdp-hero-left,
.pdp-hero-right {
    min-width: 0;
}

/* HEADER */

.pdp-header {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 20px;
}

.pdp-chip {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .12em;
    background: #f3f4f6;
    color: #4b5563;
}

.pdp-title {
    font-size: clamp(24px, 2.4vw, 32px);
    line-height: 1.15;
    color: #111827;
    font-weight: 600;
}

.pdp-subtitle {
    font-size: 13px;
    color: #6b7280;
}

/* META / KPIs */

.pdp-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 16px;
}

.pdp-meta-item {
    min-width: 90px;
    padding: 8px 10px;
    border-radius: 999px;
    background: #f9fafb;
}

.pdp-meta-value {
    font-size: 12px;
    font-weight: 600;
    color: #111827;
}

.pdp-meta-label {
    font-size: 11px;
    color: #9ca3af;
}

/* FEATURES */

.pdp-feature-list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin: 0 0 18px;
    padding: 0;
}

.pdp-feature-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: #4b5563;
}

.pdp-feature-dot {
    width: 6px;
    height: 6px;
    border-radius: 999px;
    background: #111827;
}

/* QTY + FAVORITO */

.pdp-qty-fav-row {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 18px;
}

.pdp-qty-control {
    display: inline-flex;
    align-items: center;
    border-radius: 999px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    padding: 2px;
    gap: 2px;
}

.pdp-qty-control input[type="number"] {
    width: 48px;
    border: 0;
    background: transparent;
    text-align: center;
    font-size: 13px;
    color: #111827;
    outline: none;
    -moz-appearance: textfield;
}

.pdp-qty-control input::-webkit-outer-spin-button,
.pdp-qty-control input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.pdp-qty-btn {
    width: 28px;
    height: 28px;
    border-radius: 999px;
    border: 0;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    color: #6b7280;
    cursor: default;
}

.pdp-qty-btn svg {
    width: 14px;
    height: 14px;
    stroke: currentColor;
    fill: none;
    stroke-width: 1.8;
}

/* FAVORITOS */

.pdp-fav-toggle {
    position: relative;
    display: inline-flex;
    align-items: center;
    cursor: pointer;
}

.pdp-fav-toggle input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.pdp-fav-bg {
    width: 32px;
    height: 32px;
    border-radius: 999px;
    border: 1px solid #e5e7eb;
    background: #ffffff;
    display: inline-block;
    transition: background .2s, border-color .2s;
}

.pdp-fav-icon {
    position: absolute;
    inset: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.pdp-fav-icon svg {
    width: 16px;
    height: 16px;
    fill: none;
    stroke: #6b7280;
    stroke-width: 1.8;
}

.pdp-fav-toggle input:checked + .pdp-fav-bg {
    background: #111827;
    border-color: #111827;
}

.pdp-fav-toggle input:checked ~ .pdp-fav-icon svg {
    fill: #ffffff;
    stroke: #ffffff;
}

/* PRECIO */

.pdp-price-block {
    margin-top: 8px;
}

.pdp-price-row {
    display: inline-flex;
    align-items: baseline;
    gap: 10px;
    flex-wrap: wrap;
}

.pdp-price-now {
    font-size: 22px;
    font-weight: 600;
    color: #111827;
}

.pdp-price-old {
    font-size: 13px;
    color: #9ca3af;
    text-decoration: line-through;
}

.pdp-price-discount {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .12em;
    padding: 2px 8px;
    border-radius: 999px;
    background: #e11d48;
    color: #ffffff;
}

.pdp-price-note {
    margin-top: 4px;
    font-size: 11px;
    color: #9ca3af;
}

/* IMÁGENES */

.pdp-image-layout {
    display: grid;
    grid-template-columns: auto minmax(0, 1fr);
    gap: 16px;
    align-items: center;
}

.pdp-thumbs-col {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.pdp-thumb {
    border: 0;
    padding: 0;
    background: transparent;
    border-radius: 14px;
    overflow: hidden;
    cursor: pointer;
    outline: none;
    border: 1px solid transparent;
}

.pdp-thumb img {
    display: block;
    width: 72px;
    height: 96px;
    object-fit: cover;
    transition: transform .25s ease;
}

.pdp-thumb:hover img {
    transform: scale(1.03);
}

.pdp-thumb.is-active {
    border-color: #111827;
}

.pdp-main-image-wrap {
    position: relative;
}

.pdp-main-image-inner {
    border-radius: 20px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    padding: 12px;
}

.pdp-main-image {
    width: 100%;
    max-height: 420px;
    object-fit: cover;
    border-radius: 16px;
}

/* FLOAT CARDS */

.pdp-float-card {
    position: absolute;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 10px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.92);
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.18);
    backdrop-filter: blur(10px);
}

.pdp-float-card img {
    width: 18px;
    height: 18px;
    object-fit: contain;
}

.pdp-float-title {
    font-size: 11px;
    font-weight: 600;
    color: #111827;
}

.pdp-float-sub {
    font-size: 11px;
    color: #6b7280;
}

.pdp-float-top-right {
    top: 12px;
    right: 12px;
}

.pdp-float-bottom-left {
    bottom: 12px;
    left: 12px;
}

/* SELLO TIPO / COLECCIÓN */

.pdp-type-stamp {
    position: absolute;
    bottom: 14px;
    right: 16px;
    text-align: right;
    padding: 6px 0;
}

.pdp-type-main {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: .16em;
    color: #6b7280;
}

.pdp-type-sub {
    font-size: 12px;
    font-weight: 500;
    color: #111827;
}

/* GARANTÍA */

.pdp-guarantee-badge {
    margin-top: 14px;
    display: inline-flex;
    flex-direction: column;
    align-items: flex-end;
    text-align: right;
}

.pdp-guarantee-value {
    font-size: 15px;
    font-weight: 600;
    color: #111827;
}

.pdp-guarantee-label {
    font-size: 11px;
    color: #9ca3af;
}

/* BOTTOM BAR */

.pdp-bottom-bar {
    margin-top: 22px;
    padding-top: 14px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 12px;
    justify-content: space-between;
}

.pdp-stock-info {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: #4b5563;
}

.pdp-stock-dot {
    width: 8px;
    height: 8px;
    border-radius: 999px;
    background: #9ca3af;
}

.pdp-stock-dot.is-available {
    background: #16a34a;
}

.pdp-stock-dot.is-out {
    background: #e11d48;
}

/* BOTONES */

.pdp-actions {
    display: inline-flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: flex-end;
}

.pdp-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 18px;
    border-radius: 999px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .12em;
    font-weight: 500;
    border: 1px solid transparent;
    cursor: pointer;
    text-decoration: none;
    white-space: nowrap;
}

.pdp-btn-primary {
    background: #111827;
    border-color: #111827;
    color: #ffffff;
}

.pdp-btn-primary:hover {
    background: #020617;
    border-color: #020617;
}

.pdp-btn-disabled {
    background: #e5e7eb;
    border-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

/* RESPONSIVE */

@media (max-width: 900px) {
    .pdp-hero-card {
        padding: 18px 16px 16px;
        border-radius: 18px;
    }

    .pdp-hero-grid {
        grid-template-columns: minmax(0, 1fr);
        gap: 20px;
    }

    .pdp-image-layout {
        grid-template-columns: minmax(0, 1fr);
    }

    .pdp-thumbs-col {
        flex-direction: row;
        order: 2;
    }

    .pdp-thumb img {
        width: 64px;
        height: 80px;
    }

    .pdp-guarantee-badge {
        align-items: flex-start;
        text-align: left;
        margin-top: 10px;
    }

    .pdp-bottom-bar {
        flex-direction: column;
        align-items: flex-start;
    }

    .pdp-actions {
        width: 100%;
        justify-content: stretch;
    }

    .pdp-btn {
        width: 100%;
        justify-content: center;
    }
}

  </style>
</head>
<body>
<div style="display:flex;flex-direction:column;width:85px;position:fixed;height:100vh;justify-content:center;right:0;top:0;z-index:9;padding:10px">
        <div class="social-box bottom-nav" style="width:60px;bottom:inherit;left:inherit;right:0">
            <a href="{{ env('SUPPORT_WHATSAPP') }}"  class="social-link">
                <img src="{{ asset('image/svg/whatsappn.svg') }}" fetchpriority="high" decoding="async" alt="WhatsApp" class="social-icon">
            </a>
          <!--  <a href="{{ env('MAIL_INSTAGRAM_URL') }}"  class="social-link">
                <img src="{{ asset('image/svg/instagramn.svg') }}" fetchpriority="high" decoding="async" alt="Instagram" class="social-icon">
            </a>
            <a href="{{ env('MAIL_FACEBOOK_URL') }}"  class="social-link">
                <img src="{{ asset('image/svg/facebookn.svg') }}" fetchpriority="high" decoding="async" alt="Facebook" class="social-icon">
            </a>-->
        </div>
    </div>
  <!-- Header -->
   <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <a href="#" class="top-bar-link">Protección del comprador</a>
                <a href="#" class="top-bar-link">Ayuda</a>
                <a href="{{asset('login')}}" class="top-bar-link">Mi cuenta</a>
            </div>
        </div>
    </div>
  <header>
    <div class="container header-row">
      <div style="display:flex; align-items:center; gap:48px">
        <a href="{{asset('/')}}"><img src="{{asset('image/logo.webp')}}" alt="" style="width:70px;"></a>
        <nav class="hide-mobile" style="gap:18px">
          <a href="{{asset('/')}}">Inicio</a>
          <a href="{{asset('/buscando')}}">Productos</a>
          <a href="{{asset('/who')}} ">Quienes somos</a>
        </nav>
      </div>

      <div style="display:flex; align-items:center; gap:16px; position:relative">
        
        <form action="{{ route('item') }}" method="GET" class="search-container" >
                        @csrf
            <input type="text" class="search-input" id="searchid" placeholder="Buscar Producto" name="name" value="" autocomplete="off" style="background:none">
            <button type="submit" class="icon-btn" style="cursor:pointer;margin-left:-40px;">
                 <svg class="svg" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button> 
        </form>

        <a href="{{asset('login')}}" class="icon-btn login" aria-label="Cuenta" style="text-decoration:none;color:black">
          <!-- User -->
          <svg class="svg" viewBox="0 0 24 24"><path d="M20 21a8 8 0 0 0-16 0"></path><circle cx="12" cy="7" r="4"></circle></svg>
        </a>
        <!-- 
        <a  href="{{route('product.pasarela-pago')}} " class="icon-btn carrito" aria-label="Carrito" style="position:relative">
          
         <svg  width="24" height="24"  fill="none" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
    
          <span class="cart-badge">{{Session::has('carto') ? Session::get('carto')->totalQty : '0' }} </span>
        </a>-->
        
      </div>
    </div>
  </header>

  <!-- Main Product -->
 <section class="pdp-hero">
    <div class="pdp-hero-card">
        @php
            // Galería de imágenes del producto
            $galleryRaw = [
                data_get($searches, 'image'),
                data_get($searches, 'image2'),
                data_get($searches, 'image3'),
                data_get($searches, 'image4'),
            ];

            $gallery = array_values(array_filter($galleryRaw, fn($x) => filled($x)));

            $resolveProductSrc = function ($path) {
                if (!$path) return '';
                return \Illuminate\Support\Str::startsWith($path, ['http://','https://','/'])
                    ? $path
                    : asset('image/productos/'.$path);
            };

            // Especiales / badges pequeños
            $espSample = collect($esp ?? [])->shuffle()->take(2)->values();
            $espTop = $espSample->get(0);
            $espBottom = $espSample->get(1);

            $resolveEspSrc = function ($path) {
                if (!$path) return '';
                return \Illuminate\Support\Str::startsWith($path, ['http://','https://','/'])
                    ? $path
                    : asset($path);
            };

            // Descuento
            $discount = ($searches->preciof ?? 0) > 0
                ? max(0, floor(100 - ($searches->precio * 100 / $searches->preciof)))
                : 0;
        @endphp

        <div class="pdp-hero-grid">
            {{-- COLUMNA IZQUIERDA --}}
            <div class="pdp-hero-left">
                <div class="pdp-header">
                    <span class="pdp-chip">
                        Colección exclusiva
                    </span>
                    <h1 class="pdp-title">{{ $searches->name }}</h1>

                    @if(!empty($searches->categoria))
                        <p class="pdp-subtitle">
                            {{ $searches->categoria }}
                        </p>
                    @endif
                </div>

                @if(!empty($car2))
                    <div class="pdp-meta">
                        @foreach($car2 as $row)
                            <div class="pdp-meta-item">
                                <div class="pdp-meta-value">{{ $row['valor'] ?? '' }}</div>
                                <div class="pdp-meta-label">{{ $row['titulo'] ?? '' }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(isset($caracts) && $caracts->count())
                    <ul class="pdp-feature-list">
                        @foreach($caracts as $c)
                            <li class="pdp-feature-item">
                                <span class="pdp-feature-dot"></span>
                                <span>{{ $c }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="pdp-qty-fav-row">
                    <div class="pdp-qty-control" aria-label="Cantidad">
                        <button class="pdp-qty-btn" type="button" title="Menos" disabled>
                            <svg viewBox="0 0 24 24">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                        <input type="number" min="1" value="1" aria-label="Cantidad de unidades">
                        <button class="pdp-qty-btn" type="button" title="Más" disabled>
                            <svg viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                    </div>

                    <label class="pdp-fav-toggle" title="Añadir a favoritos">
                        <input type="checkbox">
                        <span class="pdp-fav-bg"></span>
                        <span class="pdp-fav-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-.96-1.06a5.5 5.5 0 0 0-7.78 7.78l.96.96L12 21.23l7.78-7.88.96-.96a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        </span>
                    </label>
                </div>

                <div class="pdp-price-block">
                    <div class="pdp-price-row">
                        <span class="pdp-price-now">S/. {{ number_format($searches->precio, 2) }}</span>
                        @if(($searches->preciof ?? 0) > 0 && $searches->preciof > $searches->precio)
                            <span class="pdp-price-old">S/. {{ number_format($searches->preciof, 2) }}</span>
                            @if($discount > 0)
                                <span class="pdp-price-discount">-{{ $discount }}%</span>
                            @endif
                        @endif
                    </div>
                    <div class="pdp-price-note">Precio por unidad</div>
                </div>
            </div>

            {{-- COLUMNA DERECHA --}}
            <div class="pdp-hero-right">
                <div class="pdp-image-layout">
                    @if(count($gallery) > 1)
                        <div class="pdp-thumbs-col">
                            @foreach(array_slice($gallery, 0, 4) as $idx => $thumb)
                                @php $src = $resolveProductSrc($thumb); @endphp
                                @if($src)
                                    <button
                                        type="button"
                                        class="pdp-thumb {{ $idx === 0 ? 'is-active' : '' }}"
                                        data-src="{{ $src }}"
                                        aria-label="Cambiar imagen"
                                    >
                                        <img src="{{ $src }}" alt="Vista {{ $idx + 1 }} de {{ $searches->name }}" loading="lazy">
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <div class="pdp-main-image-wrap">
                        <div class="pdp-main-image-inner">
                            <img
                                id="pdpMainImage"
                                class="pdp-main-image"
                                src="{{ $resolveProductSrc($gallery[0] ?? data_get($searches,'image')) }}"
                                alt="{{ $searches->name }}"
                            >
                        </div>

                        {{-- Badges flotantes opcionales --}}
                        @if($espTop)
                            @php $src = $resolveEspSrc($espTop['imagen'] ?? ''); @endphp
                            <div class="pdp-float-card pdp-float-top-right">
                                @if($src)
                                    <img src="{{ $src }}" alt="{{ $espTop['titulo'] ?? 'icono' }}">
                                @endif
                                <div>
                                    <div class="pdp-float-title">{{ $espTop['titulo'] ?? '' }}</div>
                                    <div class="pdp-float-sub">{{ $espTop['valor'] ?? '' }}</div>
                                </div>
                            </div>
                        @endif

                        @if($espBottom)
                            @php $src = $resolveEspSrc($espBottom['imagen'] ?? ''); @endphp
                            <div class="pdp-float-card pdp-float-bottom-left">
                                @if($src)
                                    <img src="{{ $src }}" alt="{{ $espBottom['titulo'] ?? 'icono' }}">
                                @endif
                                <div>
                                    <div class="pdp-float-title">{{ $espBottom['titulo'] ?? '' }}</div>
                                    <div class="pdp-float-sub">{{ $espBottom['valor'] ?? '' }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="pdp-type-stamp">
                            <div class="pdp-type-main">
                                @if ($searches->tipo === 1)
                                    Colección
                                @elseif ($searches->tipo === 2)
                                    Set
                                @else
                                    {{ \Illuminate\Support\Str::of($searches->name)->explode(' ')->first() }}
                                @endif
                            </div>
                            <div class="pdp-type-sub">
                                {{ $searches->name }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pdp-guarantee-badge">
                    <div class="pdp-guarantee-value">100%</div>
                    <div class="pdp-guarantee-label">Garantía del producto</div>
                </div>
            </div>
        </div>

        {{-- BARRA INFERIOR --}}
        <div class="pdp-bottom-bar">
            <div class="pdp-stock-info">
                <span class="pdp-stock-dot {{ $searches->stock > 0 ? 'is-available' : 'is-out' }}"></span>
                <span>
                    @if  ($searches->stock > 0)
                        En stock · Envío rápido
                    @else
                        Sin stock
                    @endif
                </span>
            </div>

            <div class="pdp-actions">
                @if($searches->impropio === 0)
                    @if  ($searches->stock > 0)
                     <!--   <a href="{{ route('product.addToCarto',['id'=>$searches->id]) }}" -->
                        <a 
                          href="{{ env('SUPPORT_WHATSAPP') . '?text=' . urlencode('Hola quisiera consultar por este producto: https://bulkness.com/busco/'.$searches->id) }}"
                          target="_blank"
                          rel="noopener" class="pdp-btn pdp-btn-primary"
                      >
                          Consultar por WhatsApp
                      </a>
                    @else
                        <div class="pdp-btn pdp-btn-disabled">Sin stock</div>
                    @endif
                @endif

                @if ($searches->impropio === 1)
                    <a href="{{ route('adler-venta-detalle')}}"
                       class="pdp-btn pdp-btn-primary">
                        Comprar ahora
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- JS mínimo para que cambien las imágenes de la galería --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mainImg = document.getElementById('pdpMainImage');
        const thumbs = document.querySelectorAll('.pdp-thumb');

        if (!mainImg || !thumbs.length) return;

        thumbs.forEach(btn => {
            btn.addEventListener('click', () => {
                const src = btn.getAttribute('data-src');
                if (!src) return;

                mainImg.src = src;
                thumbs.forEach(t => t.classList.remove('is-active'));
                btn.classList.add('is-active');
            });
        });
    });
</script>


  <!-- Información del Producto con Pestañas -->
  <section class="container section">
    <div class="tabs">
      <div class="tab-nav">
        <button class="tab-btn active" onclick="showTab('description')">Descripción</button>
        <button class="tab-btn" onclick="showTab('specs')">Especificaciones</button>
        <button class="tab-btn" onclick="showTab('reviews')">Reseñas</button>
        <button class="tab-btn" onclick="showTab('warranty')">Garantía</button>
      </div>
    </div>

    <!-- Descripción -->
    <div id="description" class="tab-content active">
      <div class="description">
        <h3>Descripción del Producto</h3>
        {{$searches->description}}
      </div>
    </div>

    <!-- Especificaciones -->
    <div id="specs" class="tab-content">
      <div class="specs">
        <h3>Especificaciones Técnicas</h3>
        @if(!empty($esp))
        <div class="specs-grid">
         @foreach($esp as $row)  
          <div class="spec-item">
            <div class="spec-icon">
              <!-- Target -->
               @php $img = $row['imagen'] ?? ''; @endphp
               @if(!empty($img))
                <img src="{{ $img }}" alt="{{ $row['titulo'] ?? 'icono' }}" style="width:22px;height:22px;object-fit:contain">
               @else
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
           
               @endif
              </div>
            <div class="spec-content">
              <h4>{{ $row['titulo'] ?? '' }}</h4>
              <p>{{ $row['valor'] ?? '' }}</p>
            </div>
          </div>
        @endforeach
        </div>
        @endif
      </div>
    </div>

    <!-- Reseñas -->
    <div id="reviews" class="tab-content">
      <div class="reviews">
        <h3>Reseñas de Clientes</h3>
        
        <div class="review-summary">
          <div class="rating-overview">
            <div class="big-rating">4.8</div>
            <div class="stars" style="justify-content: center; margin: 8px 0">
              <span class="star full"><svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
              <span class="star full"><svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
              <span class="star full"><svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
              <span class="star full"><svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
              <span class="star full"><svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
            </div>
            <p style="margin: 0; font-size: 14px; color: var(--muted)">4 reseñas</p>
          </div>

          <div class="rating-bars">
            <div class="rating-bar">
              <span>5</span>
              <div class="bar-bg"><div class="bar-fill" style="width: 75%"></div></div>
              <span style="color: var(--muted)">93</span>
            </div>
            <div class="rating-bar">
              <span>4</span>
              <div class="bar-bg"><div class="bar-fill" style="width: 20%"></div></div>
              <span style="color: var(--muted)">25</span>
            </div>
            <div class="rating-bar">
              <span>3</span>
              <div class="bar-bg"><div class="bar-fill" style="width: 4%"></div></div>
              <span style="color: var(--muted)">5</span>
            </div>
            <div class="rating-bar">
              <span>2</span>
              <div class="bar-bg"><div class="bar-fill" style="width: 1%"></div></div>
              <span style="color: var(--muted)">1</span>
            </div>
            <div class="rating-bar">
              <span>1</span>
              <div class="bar-bg"><div class="bar-fill" style="width: 0%"></div></div>
              <span style="color: var(--muted)">0</span>
            </div>
          </div>
        </div>

        <div class="review-list">
         

          

<!--      <div class="review-item">
            <div class="review-header">
              <div class="reviewer">
                <div class="avatar">L</div>
                <div class="reviewer-info">
                  <h5>Lucía Ramírez</h5>
                  <div class="date">Hace 1 semana</div>
                </div>
              </div>
              <div class="review-stars">
                <span class="star full"><svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
                <span class="star full"><svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
                <span class="star full"><svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
                <span class="star full"><svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
                <span class="star empty"><svg viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg></span>
              </div>
            </div> 
            <div class="review-text">
              Muy buen producto por el precio. La medición es rápida y parece precisa. La pantalla podría ser un poco más grande, pero en general estoy satisfecha con la compra. Perfecto para tener en casa.
            </div>
          </div>-->
        </div>
      </div>
    </div>

    <!-- Garantía 
    <div id="warranty" class="tab-content">
      <div class="warranty">
        <h3>Garantía y Servicios</h3>
        
        <div class="warranty-grid">
          <div class="warranty-item">
            <div class="warranty-icon">
          
              <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><polyline points="9 12 10.5 13.5 15 9"></polyline></svg>
            </div>
            <h4>Garantía de 12 Meses</h4>
            <p>Cobertura completa contra defectos de fabricación y mal funcionamiento del dispositivo.</p>
          </div>

          <div class="warranty-item">
            <div class="warranty-icon">
             
              <svg viewBox="0 0 24 24"><polyline points="23 4 23 10 17 10"></polyline><polyline points="1 20 1 14 7 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
            </div>
            <h4>Cambio Gratuito</h4>
            <p>Si el producto presenta fallas en los primeros 30 días, lo cambiamos sin costo adicional.</p>
          </div>

          <div class="warranty-item">
            <div class="warranty-icon">
             
              <svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
            </div>
            <h4>Soporte Técnico</h4>
            <p>Asistencia técnica especializada para resolver dudas sobre el uso y mantenimiento.</p>
          </div>

          <div class="warranty-item">
            <div class="warranty-icon">
             
              <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
            </div>
            <h4>Certificación Médica</h4>
            <p>Producto certificado para uso médico profesional y doméstico por autoridades sanitarias.</p>
          </div>
        </div>
-->
       <!-- <div style="margin-top: 32px; padding: 24px; background: var(--emerald-50); border-radius: 20px; border-left: 4px solid var(--emerald-500)">
          <h4 style="margin: 0 0 12px; color: var(--emerald-600)">Condiciones de Garantía:</h4>
          <ul style="margin: 0; padding-left: 20px; color: var(--muted-600)">
            <li>La garantía cubre defectos de fabricación y mal funcionamiento del dispositivo.</li>
            <li>No cubre daños por mal uso, caídas o contacto con líquidos.</li>
            <li>Para hacer válida la garantía, conserve el comprobante de compra.</li>
            <li>El servicio técnico debe ser realizado únicamente por personal autorizado.</li>
            <li>La garantía es válida únicamente en territorio peruano.</li>
          </ul>
        </div>-->
      </div>
    </div>
  </section>

  <!-- Related products -->
  <section class="container related">
    <h2>Productos Relacionados</h2>
    <div class="grid">
      <!-- Card 1 -->
       @foreach ($sear as $search)
      <a href="{{asset('busco/'.$search->id)}}" style="color:black"><article class="p-card">
        <div class="p-visual grad-blue" style="background:white">
          <img src="{{asset('image/productos/'.$search->image)}}" alt="Kit Esencial Médico" />
          <div class="p-like">
            <!-- Heart -->
            <svg class="svg" viewBox="0 0 24 24" style="color:#fff">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-.96-1.06a5.5 5.5 0 0 0-7.78 7.78l.96.96L12 21.23l7.78-7.88.96-.96a5.5 5.5 0 0 0 0-7.78z"/>
            </svg>
          </div>
        </div>
        <div class="p-body">
          <div class="p-name">{{$search->name}}</div>
          <div class="p-row">
            <div class="p-price">
              <div class="now">{{$search->precio}}</div>
              <div class="old">{{$search->preciof}}</div>
              <div class="tiny">por unidad</div>
            </div>
            <div class="icon-plus-btn" title="Añadir">
              <!-- Plus -->
              <svg class="svg" viewBox="0 0 24 24" style="color:#fff"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            </div>
          </div>
        </div>
      </article></a>
      @endforeach
      
    </div>
  </section>
          <nav class="bottom-nav" style="z-index:9999">
            <a href="{{asset('/')}}" class="nav-item" style="position: relative; overflow: hidden;margin-right:0">
                <svg class="nav-icon" fill="#282828" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path>
                </svg>
                <span class="nav-label">Inicio</span>
            </a>
            
            <a href="{{asset('buscando')}}"><div class="nav-item" style="position: relative; overflow: hidden;">
                <svg class="nav-icon" fill="#282828" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <span class="nav-label">Productos</span>
            </div></a>
            
         <!--   <a href="{{asset('pasarela-pago')}}"><div class="nav-item" style="position: relative; overflow: hidden;">
                <svg class="nav-icon" fill="#282828" viewBox="0 0 24 24">
                    <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                </svg>
                <span class="nav-label">Cart</span>-->
            </div></a>
            
            <a href="{{asset('login')}}" class="nav-item" style="position: relative; overflow: hidden;margin-right:0">
             
                <svg class="nav-icon" fill="#282828" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                </svg>
                <span class="nav-label">Mi cuenta</span>
              
            </a>
          </nav>
  <!--    Footer -->
  <footer>
    <div class="container">
      <div class="footer-content">
        <!-- Columna 1: Sobre MediShop -->
        <div class="footer-section">
          <h4>BulkNess</h4>
          <p style="margin: 0 0 16px; color: #9ca3af; font-size: 14px; line-height: 1.6;">
            Tu tienda confiable de ropa.
          </p>
          <div style="display: flex; gap: 12px; margin-top: 20px;">
            <a href="#" style="width: 40px; height: 40px; background: #374151; border-radius: 8px; display: grid; place-items: center; color: #d1d5db;">
              <!-- Facebook -->
              <svg style="width: 20px; height: 20px;" viewBox="0 0 24 24" fill="currentColor">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
              </svg>
            </a>
            <a href="#" style="width: 40px; height: 40px; background: #374151; border-radius: 8px; display: grid; place-items: center; color: #d1d5db;">
              <!-- Instagram -->
              <svg style="width: 20px; height: 20px;" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.014 5.367 18.647.001 12.017.001zM8.449 16.988c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348zm7.718 0c-1.297 0-2.348-1.051-2.348-2.348s1.051-2.348 2.348-2.348 2.348 1.051 2.348 2.348-1.051 2.348-2.348 2.348z"/>
              </svg>
            </a>
          </div>
        </div>

        <!-- Columna 2: Enlaces Útiles -->
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

        <!-- Columna 3: Atención al Cliente -->
        <div class="footer-section">
          <h4>Atención al Cliente</h4>
          <ul>
            <li style="display: flex; align-items: center; gap: 8px;">
              <!-- Phone -->
              <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
              </svg>
              <span>{{env('SUPPORT_PHONE')}}</span>
            </li>
            <li style="display: flex; align-items: center; gap: 8px;">
              <!-- Mail -->
              <svg style="width: 16px; height: 16px;" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
              </svg>
              <span>{{env('SUPPORT_MAIL')}}</span>
            </li>
            <li style="display: flex; align-items: flex-start; gap: 8px;">
              <!-- Map Pin -->
              <svg style="width: 16px; height: 16px; margin-top: 2px;" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
              <span>{{env('SUPPORT_ADDRESS')}}<br>{{env('SUPPORT_CITY')}}</span>
            </li>
          </ul>
        </div>

        <!-- Columna 4: Horarios y Certificaciones -->
        <div class="footer-section">
          <h4>Horarios de Atención</h4>
          <ul>
            <li style="color: #9ca3af; font-size: 14px;">
              <strong style="color: #d1d5db;">Martes a Viernes:</strong><br>
              10:00 AM - 10:00 PM
            </li>
            <li style="color: #9ca3af; font-size: 14px;">
              <strong style="color: #d1d5db;">Sábados:</strong><br>
              10:00 AM - 2:00 PM
            </li>
            <li style="color: #9ca3af; font-size: 14px;">
              <strong style="color: #d1d5db;">Domingos:</strong><br>
              Sin atencion
            </li>
          </ul>
          
          
        </div>
      </div>

      <div class="footer-bottom">
        <div>
          <p>&copy; 2026 angelbernedo.com .Todos los derechos reservados.</p>
          <p style="font-size: 12px; color: #9ca3af; margin: 4px 0 0;">
            RUC: - | Razón Social: -
          </p>
        </div>
        
        <a href="#" class="libro-btn" style="display: flex; align-items: center; gap: 8px;">
          <!-- Book -->
          <svg style="width: 18px; height: 18px;" viewBox="0 0 24 24" stroke="currentColor" fill="none">
            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
          </svg>
          Libro de Reclamaciones
        </a>
      </div>
    </div>
  </footer>

  <!-- JavaScript para pestañas -->
  <script>
    function showTab(tabName) {
      // Ocultar todas las pestañas
      const tabs = document.querySelectorAll('.tab-content');
      tabs.forEach(tab => {
        tab.classList.remove('active');
      });
      
      // Remover clase active de todos los botones
      const buttons = document.querySelectorAll('.tab-btn');
      buttons.forEach(btn => {
        btn.classList.remove('active');
      });
      
      // Mostrar la pestaña seleccionada
      document.getElementById(tabName).classList.add('active');
      
      // Activar el botón correspondiente
      event.target.classList.add('active');
    }
  </script>
  <script>
  // --- 1) Zoom con click sobre la imagen principal (escala imagen y círculo) ---
  (function(){
    const img = document.getElementById('productImg');
    if(!img) return;
    const circleInner = img.closest('.circle-inner');

    img.addEventListener('click', () => {
      const active = img.classList.toggle('zoomed');
      if (circleInner) circleInner.classList.toggle('zoomed', active);
    });
  })();

  // --- 2) Miniaturas: cambian la imagen principal y resetean zoom ---
  (function(){
    const img = document.getElementById('productImg');
    const thumbs = document.querySelectorAll('.thumb');
    if(!img || !thumbs.length) return;
    const circleInner = img.closest('.circle-inner');

    thumbs.forEach(btn => {
      const src = btn.dataset.src || '';
      if(!src) return;

      btn.addEventListener('click', () => {
        // cambiar imagen principal
        img.src = src;
        // quitar zoom al cambiar
        img.classList.remove('zoomed');
        if (circleInner) circleInner.classList.remove('zoomed');
        // estado activo visual en miniaturas
        thumbs.forEach(t => t.classList.remove('active'));
        btn.classList.add('active');
      });
    });
  })();

  // --- 3) Ping-pong burbujas (se mantiene igual) ---
  (function(){
    const container = document.querySelector('.right');
    if(!container) return;

    const balls = Array.from(container.querySelectorAll('.bubble'));
    if(!balls.length) return;

    const W = () => container.clientWidth;
    const H = () => container.clientHeight;

    const state = balls.map((el) => {
      const x = el.offsetLeft || 0;
      const y = el.offsetTop || 0;
      const vx = (Math.random()*0.6 + 0.4) * (Math.random()<.5 ? 1 : -1);
      const vy = (Math.random()*0.6 + 0.4) * (Math.random()<.5 ? 1 : -1);
      return { el, x, y, vx, vy };
    });

    function step(){
      const maxW = W(), maxH = H();
      state.forEach(s => {
        const bw = s.el.offsetWidth, bh = s.el.offsetHeight;
        s.x += s.vx;
        s.y += s.vy;

        if (s.x <= 0 || s.x + bw >= maxW){ s.vx *= -1; s.x = Math.max(0, Math.min(maxW - bw, s.x)); }
        if (s.y <= 0 || s.y + bh >= maxH){ s.vy *= -1; s.y = Math.max(0, Math.min(maxH - bh, s.y)); }

        s.el.style.transform = `translate(${s.x}px, ${s.y}px)`;
      });
      requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
  })();
</script>

<!-- Toast “Agregado al carrito” -->
<div id="cart-toast" class="toast" role="status" aria-live="polite" aria-atomic="true" hidden>
  <div class="toast-inner">
    <span class="toast-icon" aria-hidden="true">
      <!-- Check -->
      <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
        <polyline points="20 6 9 17 4 12"></polyline>
      </svg>
    </span>
    <div class="toast-content">
      <strong class="toast-title">Agregado al carrito</strong>
      <div id="toast-msg" class="toast-sub"></div>
    </div>
  </div>
</div>
<script>
(function(){
  const btn = document.querySelector('.js-add-to-cart');
  const toast = document.getElementById('cart-toast');
  const toastMsg = document.getElementById('toast-msg');
  const badge = document.querySelector('.cart-badge');

  if(!btn || !toast) return;

  // Utilidad: mostrar toast con auto-hide
  let toastTimer = null;
  function showToast(text, ms = 2200){
    toastMsg.textContent = text || '';
    toast.hidden = false;
    toast.setAttribute('aria-hidden','false');
    toast.classList.remove('hide');
    // fuerza reflow para que la animación entre bien
    // eslint-disable-next-line no-unused-expressions
    toast.offsetHeight;
    toast.classList.add('show');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
      toast.classList.remove('show');
      toast.classList.add('hide');
      setTimeout(() => {
        toast.hidden = true;
        toast.setAttribute('aria-hidden','true');
        toast.classList.remove('hide');
      }, 260);
    }, ms);
  }

  // Incrementa visualmente el contador del cart si existe
  function bumpBadge(){
    if(!badge) return;
    const n = parseInt(badge.textContent.trim(), 10);
    const next = isNaN(n) ? 1 : Math.max(0, n + 1);
    badge.textContent = String(next);
  }

  // Spinner temporal en el botón
  const originalHTML = btn.innerHTML;
  function setBusy(state){
    if(state){
      btn.setAttribute('aria-disabled','true');
      btn.style.opacity = .8;
      btn.style.pointerEvents = 'none';
      btn.innerHTML = `
        <svg viewBox="0 0 100 100" width="18" height="18" style="margin-right:8px;animation:spin .8s linear infinite">
          <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="10" fill="none" stroke-linecap="round"
                  stroke-dasharray="62.8 188.8"></circle>
        </svg> Procesando...`;
    } else {
      btn.removeAttribute('aria-disabled');
      btn.style.opacity = '';
      btn.style.pointerEvents = '';
      btn.innerHTML = originalHTML;
    }
  }
  // animación del spinner
  const style = document.createElement('style');
  style.textContent = `@keyframes spin{to{transform:rotate(360deg)}}`;
  document.head.appendChild(style);

  btn.addEventListener('click', async (e) => {
    // Solo si marcamos data-ajax
    if(btn.dataset.ajax !== '1') return;
    e.preventDefault();

    const url = btn.getAttribute('href');
    const productName = btn.dataset.name || 'Producto';

    try{
      setBusy(true);

      // GET a la ruta de agregar. Si tu ruta redirige, fetch seguirá el 302 y
      // devolverá 200 con HTML. Nos basta con ok=true para dar feedback inmediato.
      const res = await fetch(url, {
        method: 'GET',
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
        credentials: 'same-origin'
      });

      if(!res.ok){
        // Si algo se rompe, hacemos fallback a navegación normal
        window.location.href = url;
        return;
      }

      // Éxito visual inmediato
      bumpBadge();
      showToast(`Se añadió: ${productName}`);

      // Pequeña vibración táctil en móviles (si está disponible)
      if(navigator.vibrate){ navigator.vibrate(20); }
    }catch(err){
      // Si falla el fetch, navega normal para que igual agregue en servidor
      window.location.href = url;
    }finally{
      setBusy(false);
    }
  });
})();
</script>

</body>
</html>












