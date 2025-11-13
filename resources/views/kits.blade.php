<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kits – Galería</title>
  @include('global.icon')
  <style>
    html, body {
  width: 100%;
  height: 100%;
  overflow-x: hidden;           /* fallback */
  overscroll-behavior: none;    /* evita rebote en Android/Chrome */
}
@supports (overflow: clip) {
  html, body { overflow-x: clip; }  /* si está, recorta sin generar scroll */
}
body {
  min-height: 100vh;   /* fallback */
  overflow-y: hidden;  /* lo que ya querías */
}
@supports (height: 100dvh) {
  body { min-height: 100dvh; }
}
.stage { max-width: 100vw; overflow: hidden; }
.carousel-shell { max-width: 100vw; overflow: hidden; }
.card { -webkit-backface-visibility: hidden; backface-visibility: hidden; }
.carousel-shell { -webkit-transform-style: preserve-3d; transform-style: preserve-3d; }
    :root{
      --stone-200:#e7e5e4; --stone-300:#d6d3d1; --stone-400:#a8a29e;
      --stone-500:#78716c; --stone-600:#57534e; --stone-700:#44403c;
      --stone-800:#292524; --stone-900:#1c1917;
      --accent:#b10000;
      --white:#ffffff; --black:#000000;
      --shadow-lg: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -2px rgba(0,0,0,.05);
      --shadow-2xl: 0 25px 50px -12px rgba(0,0,0,.25);
      --radius-2xl: 1rem; --radius-3xl: 1.5rem;
      --glass: rgba(255,255,255,.8);
      --t-main: 560ms; --t-thumbs: 380ms;
      --ease-main: cubic-bezier(0.22, 0.61, 0.36, 1);
      --ease-pop: cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    *{box-sizing:border-box} html,body{height:100%}
    body{
      margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial,"Apple Color Emoji","Segoe UI Emoji";
      background: radial-gradient(ellipse at center, hsla(2,68%,45%,1) 0%,hsla(359,61%,42%,1) 44%,hsla(356,58%,36%,1) 100%);
      min-height:100vh;display:flex;align-items:center;justify-content:center;color:var(--stone-700);overflow:hidden;
    }

    /* ===== Fondo “ping-pong” (5 rectángulos) ===== */
    .bg-room{position:fixed;inset:0;opacity:.6;pointer-events:none;z-index:0}
    .float-rect{
      position:absolute;border-radius:12px;
      background: rgba(255,255,255,.08); /* translúcido y sutil */
      box-shadow: 0 10px 30px rgba(0,0,0,.08);
      filter: saturate(.9);
      will-change: transform;
    }

    /* ===== Layout principal responsive ===== */
    .stage{position:relative;width:min(1200px, 100%);padding:0 clamp(8px, 3vw, 16px); z-index:1}
    .side-actions{
      position:fixed;left:clamp(8px, 4vw, 3rem);top:50%;transform:translateY(-50%);
      display:flex;flex-direction:column;gap:1rem;z-index:10
    }
    .fab{width:48px;height:48px;background:var(--glass);backdrop-filter:blur(6px);border-radius:999px;display:flex;align-items:center;justify-content:center;box-shadow:var(--shadow-lg);transition:background .2s}
    .fab:hover{background:#1b000061}

    .carousel-shell{
      position:relative;
      height:clamp(380px, 58vh, 520px); /* se adapta al alto disponible */
      display:flex;align-items:center;justify-content:center;perspective:2000px
    }
    .carousel-shell.animating{pointer-events:none}

    .card{
      position:absolute;
      width:clamp(260px, 75vw, 380px);
      height:clamp(340px, 70vh, 440px);
      transform-style:preserve-3d;will-change:transform,opacity,filter;
      transition:transform var(--t-main) var(--ease-main),opacity var(--t-main) var(--ease-main),filter var(--t-main) var(--ease-main)
    }
    .card.bounce{transition-timing-function:var(--ease-pop)}
    .card.leaving{transition-timing-function:cubic-bezier(.2,.8,.2,1);filter:blur(1px) saturate(.95)}
    .card.off{opacity:0!important;pointer-events:none!important}
    .card-inner{position:relative;width:100%;height:100%;background:rgb(194 53 53 / 53%);backdrop-filter:blur(12px);border-radius:var(--radius-3xl);box-shadow:var(--shadow-2xl);overflow:hidden}
    .card-img{position:absolute;inset:0}
    .card-img img{width:100%;object-fit:cover;display:block}
    .card-img::after{content:"";position:absolute;inset:0;background:linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0), rgb(0 0 0 / 29%));}
    .card-content{position:absolute;left:0;right:0;bottom:0;padding:1.1rem 1.25rem;color:#fff}
    .title{font-weight:800;font-size:clamp(1.05rem, 2.5vw, 1.5rem);margin:0 0 .25rem}
    .quote{font-size:clamp(.8rem, 1.8vw, .95rem);color:#f1f5f9cc;font-style:italic;margin:0 0 .5rem}
    .loc{font-size:.8rem;color:#e2e8f0b3;margin:0}
    .btn-top{position:absolute;top:.6rem;right:.6rem;width:40px;height:40px;border-radius:999px;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.3);backdrop-filter:blur(4px);transition:background .2s}
    .btn-top:hover{background:rgba(0,0,0,.5)}

    .artist-bar{display:flex;align-items:center;justify-content:center;gap:.8rem;margin-top:1.2rem;margin-bottom:1.4rem}
    .nav-round{width:40px;height:40px;border-radius:999px;background:var(--glass);backdrop-filter:blur(6px);display:flex;align-items:center;justify-content:center;box-shadow:var(--shadow-lg);transition:background .2s}
    .nav-round:hover{background:#1b000061}
    .artist-chip{display:flex;align-items:center;gap:.75rem;background:rgba(214,211,209,.7);backdrop-filter:blur(8px);border-radius:calc(var(--radius-2xl) + .25rem);padding:.65rem .9rem;box-shadow:var(--shadow-lg)}
    .avatar{width:40px;height:40px;border-radius:999px;display:flex;align-items:center;justify-content:center;background:linear-gradient(135deg,#2dd4bf,#0891b2);color:#fff;font-weight:800}
    .artist-name{font-weight:700;color:var(--stone-800);font-size:.95rem;margin:0}
    .artist-sub{font-size:.75rem;color:var(--stone-600);margin:0}

    /* ===== Carrusel de miniaturas (máx 10 visibles) ===== */
    .related-shell{
      position:relative;height:96px;overflow:hidden; /* oculta excedentes */
    }
    .related-edges::before,
    .related-edges::after{
      content:""; position:absolute; top:0; height:100%; width:60px; z-index:3; pointer-events:none;
      background: linear-gradient(to right, rgba(255,255,255,0.0), rgba(255,255,255,0.0)); /* se ajusta vía JS a un ligero fade */
    }
    .related-edges.fade::before{ left:0; background:linear-gradient(to right, rgba(41,37,36,.65), rgba(41,37,36,0)); }
    .related-edges.fade::after{ right:0; background:linear-gradient(to left, rgba(41,37,36,.65), rgba(41,37,36,0)); }

    .related-row{justify-content:center; position:absolute; inset:0; display:flex; align-items:center; gap:.75rem; padding:0 .25rem; will-change: transform; transition: transform 360ms var(--ease-main); }
    .thumb{width:80px;height:80px;border-radius:.75rem;overflow:hidden;box-shadow:var(--shadow-lg);will-change:transform,opacity;transition:opacity var(--t-thumbs) var(--ease-main),transform var(--t-thumbs) var(--ease-main)}
    .thumb img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .3s var(--ease-main);cursor:pointer}
    .thumb img:hover{transform:scale(1.08)}
    .thumb.dim{opacity:.45;filter:saturate(.85)}
    .related-row.moving-out .thumb{opacity:0;transform:translateY(-160px) scale(.6)}

    .thumb-nav{
      position:absolute; top:50%; transform:translateY(-50%);
      width:38px; height:38px; display:grid; place-items:center; border:none; border-radius:10px;
      background: rgba(255,255,255,.9); box-shadow: var(--shadow-lg); z-index:4; cursor:pointer;
    }
    .thumb-prev{ left:.25rem } .thumb-next{ right:.25rem }
    .thumb-nav:disabled{ opacity:.45; cursor:not-allowed }

    /* Dots */
    .dots{display:flex;justify-content:center;gap:.5rem;margin-top:1rem}
    .dot{height:6px;border-radius:999px;border:none;background:var(--stone-400);width:6px;transition:width .28s var(--ease-main),background .28s var(--ease-main),opacity .28s var(--ease-main)}
    .dot.active{width:32px;background:var(--accent);border:none}

    .stack-actions{position:fixed;right:clamp(8px, 4vw, 2rem);bottom:clamp(8px, 4vw, 2rem);display:flex;flex-direction:column;gap:.75rem;z-index:10}
    .stack-btn{width:56px;height:56px;border-radius:1rem;background:rgba(255,255,255,.9);backdrop-filter:blur(8px);display:flex;align-items:center;justify-content:center;box-shadow:var(--shadow-lg);transition:background .2s}
    .stack-btn:hover{background:#fff}

    .hidden{display:none!important} .disabled{opacity:.5;pointer-events:none} .text-center{text-align:center}
    .icon{width:20px;height:20px;stroke:white;fill:none;stroke-width:2} .icon-lg{width:24px;height:24px}
    .thumb.pre-in{opacity:0;transform:translateY(-160px) scale(.6)}

    /* ===== Breakpoints finos ===== */
    @media (max-width: 820px){
      .side-actions{left:8px}
      .avatar{width:36px;height:36px}
      .artist-bar{gap:.6rem}
      .nav-round{width:36px;height:36px}
      .thumb-nav{width:34px;height:34px}
    }
    @media (max-width: 520px){
      .thumb{width:68px;height:68px}
      .related-shell{height:82px}
    }
    .icon-apple {
     background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(2px);
    -webkit-backdrop-filter: blur(2px);
    border: 1px solid transparent;
    background-clip: padding-box;
    border-radius: 24px;
    display: flex;
    justify-content: space-around;
    padding: 12px 8px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3), inset 0 1px 0 rgba(255, 255, 255, 0.2), inset 0 -1px 0 rgba(255, 255, 255, 0.1);
    overflow: hidden;}
    .thumb a { display:block; width:100%; height:100%; }
  </style>
</head>
<body>
  <!-- Fondo animado -->
   <a href="{{asset('/')}}"><div style="display:flex;align-items:center;flex-direction:row;position:absolute;top:15px;left:22px">
                    <div style="transition-duration: 0.1s;position:relative; width:120px;font-size:17px;font-family:sans-serif">
                        <img src="http://127.0.0.1:8000/image/logo1_BN.png  " class="logo1" style="width:100%;">
                    </div>
               </div></a>
  <div class="bg-room" id="bgRoom" aria-hidden="true"></div>

  <div class="side-actions">
    <button class="fab icon-apple" title="Compartir"><svg class="icon text-stone-700" viewBox="0 0 24 24"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="M8.59 13.51l6.83 3.98"/><path d="M15.41 6.51L8.59 10.49"/></svg></button>
    <a class="fab icon-apple" href="{{asset('adler-venta')}}" title="Personalizar"><svg class="nav-icon" fill="white" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg></a>
    <a class="fab icon-apple" href="{{asset('login')}}" title="Perfil"><svg class="icon text-stone-700" viewBox="0 0 24 24"><path d="M20 21a8 8 0 10-16 0"/><circle cx="12" cy="7" r="4"/></svg></a>
  </div>

  <div class="stage">
    <div id="carousel" class="carousel-shell"></div>

    <div class="artist-bar ">
      <button id="btnPrev" class="nav-round icon-apple" title="Anterior"><svg class="icon" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg></button>

      <div class="artist-chip icon-apple">
        <div id="avatar" class="avatar icon-apple">KT</div>
        <div>
          <p id="artistName" class="artist-name">Kit</p>
          <p id="artistSub" class="artist-sub">—</p>
        </div>
      </div>

      <button id="btnNext" class="nav-round icon-apple" title="Siguiente"><svg class="icon" viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></svg></button>
    </div>

    <!-- Carrusel de miniaturas -->
    <div class="related-shell related-edges" id="relatedShell">
      <button class="thumb-nav thumb-prev" id="thumbPrev" aria-label="Miniaturas anteriores">
        <svg class="icon" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
      </button>
      <div id="relatedRow" class="related-row"></div>
      <button class="thumb-nav thumb-next" id="thumbNext" aria-label="Miniaturas siguientes">
        <svg class="icon" viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></svg>
      </button>
    </div>

    <div id="dots" class="dots"></div>
  </div>

  
<script>
(function(){
  'use strict';

  /* ===== Datos del servidor ===== */
  const artworks = @json($artworks, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) ?? [];
  const BUSCO_BASE = @json(url('busco')); 
  if (!Array.isArray(artworks) || artworks.length === 0) {
    document.getElementById('carousel').innerHTML = '<div class="text-center" style="color:white">No hay kits disponibles.</div>';
    return;
  }

  /* ===== Fondo: 5 rectángulos ping-pong ===== */
  const bgRoom = document.getElementById('bgRoom');
  const RECT_COUNT = 5;
  const rects = [];
  function rand(min,max){ return Math.random()*(max-min)+min; }

  function createRects(){
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

  function tickRects(t){
    const vw = window.innerWidth, vh = window.innerHeight;
    for(const r of rects){
      r.x += r.vx; r.y += r.vy;
      if(r.x <= 0 || r.x + r.w >= vw){ r.vx *= -1; r.x = Math.max(0, Math.min(vw - r.w, r.x)); }
      if(r.y <= 0 || r.y + r.h >= vh){ r.vy *= -1; r.y = Math.max(0, Math.min(vh - r.h, r.y)); }
      // leve “respiración”
      const s = 1 + Math.sin(t/900 + r.phase)*0.06;
      r.el.style.transform = `translate(${r.x}px, ${r.y}px) scale(${s})`;
    }
    requestAnimationFrame(tickRects);
  }

  createRects();
  requestAnimationFrame(tickRects);
  window.addEventListener('resize', createRects);

  /* ===== Carrusel principal ===== */
  const CARD_MS = 560;
  const $ = s => document.querySelector(s);
  function initials(name){ return String(name||'K').split(/\s+/).filter(Boolean).map(n=>n[0]).join('').toUpperCase(); }
  function cityFromLocation(loc){ const parts = String(loc||'').split(','); return parts.length>1? parts[1].trim(): String(loc||''); }
  function baseX(){ return Math.max(220, Math.min(360, window.innerWidth * 0.28)); } // spacing responsive
  function getCardPosition(index,currentIndex){
    const diff = index - currentIndex, total = artworks.length;
    let position = diff;
    if (diff > total/2) position = diff - total;
    if (diff < -total/2) position = diff + total;
    return position;
  }

  let currentIndex = 0, isTransitioning = false;
  const carousel   = $('#carousel');
  const relatedRow = $('#relatedRow');
  const relatedShell = $('#relatedShell');
  const dots       = $('#dots');
  const btnPrev    = $('#btnPrev');
  const btnNext    = $('#btnNext');

  // Tarjetas persistentes
  const cardEls = artworks.map(art => {
    const card = document.createElement('div');
    card.className = 'card';
    const BUSCO_BASE = @json(url('busco')); // o @json(asset('busco'))

    function kitHref(id){ return id ? `${BUSCO_BASE}/${id}` : '#'; }

    card.innerHTML = `
    <div class="card-inner">
      <div class="card-img"><img src="${art.image}" alt="${art.title||'Kit'}"></div>
      <div class="card-content">
        <h2 class="title">${art.title||'Kit'}</h2>
        <p class="quote">S/. ${art.price||'—'}</p>
        <p class="loc">${art.location||''}</p>
      </div>
      <a class="btn-top icon-apple" href="${kitHref(art.searchid)}" title="Expandir">
        <svg class="icon text-white" viewBox="0 0 24 24">
          <path d="M15 3h6v6"/><path d="M21 3l-7 7"/><path d="M9 21H3v-6"/><path d="M3 21l7-7"/>
        </svg>
      </a>
    </div>`;
    carousel.appendChild(card);
    return card;
  });

  function placeCard(card, position){
    const visible = Math.abs(position) <= 2;
    card.classList.toggle('off', !visible);
    const translateX = position * baseX();
    const rotateY = position * -45;
    const scale = position === 0 ? 1 : (Math.abs(position) === 1 ? 0.85 : 0.72);
    const tz = position === 0 ? 0 : (Math.abs(position) === 1 ? -80 : -140);
    const opacity = position === 0 ? 1 : (Math.abs(position) === 1 ? 0.78 : 0.45);
    const zIndex = position === 0 ? 30 : (Math.abs(position) === 1 ? 20 : 10);
    const blur = position === 0 ? 0 : (Math.abs(position) === 1 ? 0.6 : 1.2);
    card.style.transform = `translateX(${translateX}px) translateZ(${tz}px) rotateY(${rotateY}deg) scale(${scale})`;
    card.style.opacity = String(opacity);
    card.style.zIndex = String(zIndex);
    card.style.filter = `blur(${blur}px)`;
  }
  function renderCardsPositions(){ for(let i=0;i<cardEls.length;i++){ placeCard(cardEls[i], getCardPosition(i, currentIndex)); } }
  function renderArtistBar(){
    const art = artworks[currentIndex];
    $('#avatar').textContent = initials(art.artist||art.title);
    $('#artistName').textContent = art.artist || art.title || 'Kit';
    $('#artistSub').textContent = (art.year ? art.year : '—') + ' · ' + (cityFromLocation(art.location)||'');
  }

  /* ===== Miniaturas: carrusel con máx 10 visibles, flechas y swipe ===== */
  const THUMB_W = () => (window.innerWidth <= 520 ? 68 : 80);
  const GAP = 12;
  let thumbStart = 0; // índice del primer visible
  let visibleMax = 10;

  const btnThumbPrev = $('#thumbPrev');
  const btnThumbNext = $('#thumbNext');

  function renderRelated(preIn){
    const art = artworks[currentIndex];
    relatedRow.innerHTML = '';
    const imgs = art.relatedImages || [];

    imgs.forEach((it, i) => {
        const src = typeof it === 'string' ? it : it.src;
        const sid = typeof it === 'object' && it ? it.id : null;

        const d = document.createElement('div');
        d.className = 'thumb' + (preIn ? ' pre-in' : '');
        d.style.transitionDelay = (i * 40) + 'ms';

        const href = sid ? `${BUSCO_BASE}/${sid}` : '#';
        d.innerHTML = `<a class="thumb-link" href="${href}" aria-label="Producto ${i+1}">
                        <img src="${src}" alt="Producto asignado ${i+1}">
                    </a>`;
        relatedRow.appendChild(d);
    });

    updateThumbViewport(true);
    }


  function updateThumbViewport(firstPaint=false){
    const total = relatedRow.children.length;
    const vw = relatedShell.clientWidth;
    const maxByWidth = Math.max(1, Math.floor((vw - 120) / (THUMB_W() + GAP))); // deja espacio para flechas
    visibleMax = Math.min(10, maxByWidth);
    thumbStart = Math.max(0, Math.min(thumbStart, Math.max(0, total - visibleMax)));

    // offset
    const offset = -thumbStart * (THUMB_W() + GAP);
    relatedRow.style.transform = `translateX(${offset}px)`;

    // dim extremos fuera
    for(let i=0;i<total;i++){
      const el = relatedRow.children[i];
      el.classList.toggle('dim', (i < thumbStart || i >= thumbStart + visibleMax));
      if(firstPaint) el.classList.remove('pre-in');
    }

    // flechas habilitadas
    btnThumbPrev.disabled = (thumbStart === 0);
    btnThumbNext.disabled = (thumbStart + visibleMax >= total);

    // faders
    relatedShell.classList.toggle('fade', total > visibleMax);
  }

  btnThumbPrev.addEventListener('click', () => {
    thumbStart = Math.max(0, thumbStart - Math.max(1, Math.floor(visibleMax/2)));
    updateThumbViewport();
  });
  btnThumbNext.addEventListener('click', () => {
    const total = relatedRow.children.length;
    thumbStart = Math.min(total - visibleMax, thumbStart + Math.max(1, Math.floor(visibleMax/2)));
    updateThumbViewport();
  });

  // arrastre táctil en miniaturas
  (function enableThumbSwipe(){
    let startX=0, deltaX=0, dragging=false;
    relatedShell.addEventListener('touchstart', e=>{
      dragging=true; startX = e.touches[0].clientX; deltaX=0;
    }, {passive:true});
    relatedShell.addEventListener('touchmove', e=>{
      if(!dragging) return;
      deltaX = e.touches[0].clientX - startX;
    }, {passive:true});
    relatedShell.addEventListener('touchend', ()=>{
      if(!dragging) return; dragging=false;
      const step = Math.max(1, Math.floor(visibleMax/2));
      if(Math.abs(deltaX) > 40){
        if(deltaX < 0) btnThumbNext.click(); else btnThumbPrev.click();
      }
    });
  })();

  /* ===== Render y navegación ===== */
  function renderDots(){
    dots.innerHTML = '';
    for(let i=0;i<artworks.length;i++){
      const b = document.createElement('button');
      b.className = 'dot' + (i===currentIndex ? ' active' : '');
      b.addEventListener('click', function(){
        if (isTransitioning || i===currentIndex) return;
        startTransition(()=> currentIndex = i);
      });
      dots.appendChild(b);
    }
  }

  function renderAll(){
    renderCardsPositions();
    renderArtistBar();
    renderRelated(true);
    renderDots();
  }

  function startTransition(mutator){
    if (isTransitioning) return;
    isTransitioning = true;
    carousel.classList.add('animating');
    btnPrev.classList.add('disabled'); btnNext.classList.add('disabled');
    relatedRow.classList.add('moving-out');

    const oldActive = cardEls[currentIndex];
    if (oldActive) oldActive.classList.add('leaving');

    mutator(); // cambia índice
    renderCardsPositions();
    renderArtistBar();

    const newActive = cardEls[currentIndex];
    if (newActive){
      newActive.classList.add('bounce');
      setTimeout(()=> newActive.classList.remove('bounce'), CARD_MS + 120);
    }
    if (oldActive) oldActive.classList.remove('leaving');

    setTimeout(function(){
      renderRelated(true);
      relatedRow.classList.remove('moving-out');
    }, 380);

    setTimeout(function(){
      isTransitioning = false;
      carousel.classList.remove('animating');
      btnPrev.classList.remove('disabled'); btnNext.classList.remove('disabled');
      renderDots();
    }, CARD_MS + 40);
  }

  btnPrev.addEventListener('click', ()=> startTransition(()=> currentIndex = (currentIndex - 1 + artworks.length) % artworks.length));
  btnNext.addEventListener('click', ()=> startTransition(()=> currentIndex = (currentIndex + 1) % artworks.length));
  
  

  // Swipe en tarjetas principales
  (function enableMainSwipe(){
    let sx=0, dx=0, dragging=false;
    carousel.addEventListener('touchstart', e=>{ dragging=true; sx=e.touches[0].clientX; dx=0; }, {passive:true});
    carousel.addEventListener('touchmove', e=>{ if(!dragging) return; dx = e.touches[0].clientX - sx; }, {passive:true});
    carousel.addEventListener('touchend', ()=>{
      if(!dragging) return; dragging=false;
      if(Math.abs(dx) > 40){ dx<0 ? btnNext.click() : btnPrev.click(); }
    });
  })();

  // Recalcular al cambiar tamaño (espacios y thumbnails)
  window.addEventListener('resize', ()=>{
    renderCardsPositions();
    updateThumbViewport();
  }, {passive:true});

  // Init
  renderAll();
})();
</script>
</body>
</html>
