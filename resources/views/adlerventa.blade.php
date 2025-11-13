<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  @include ('global.icon')

  <script src="https://oberlu.com/js/splide.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

  <style>
    :root{
      --red:#ff8e8e;
      --blue:#7d9cff;
      --dark:#b0b0b0;
      --white:#ffffff;
      --muted:#6b7280;
      --accent:#ef4444;
      --shadow:0 18px 40px rgba(0,0,0,.25);
      --radius:16px;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0}
    body{background:#ededed;font-family:ui-sans-serif,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial;}

    /* Escena pantalla completa */
    .stage{
      display:flex;
      width:100vw;
      height:100dvh;
      overflow:hidden;
      position:relative;
    }

    /* Panel base */
    .panel{
      position:relative;
      color:var(--white);
      display:flex;
      align-items:center;
      justify-content:center;
      overflow:hidden;
      transition:width .6s cubic-bezier(.22,1,.36,1), flex-basis .6s cubic-bezier(.22,1,.36,1), transform .35s ease;
      will-change:width,flex-basis,transform;
      cursor:pointer;
    }
    .panel.red{background:var(--red)}
    .panel.blue{background:var(--blue)}
    .panel.dark{background:var(--dark)}

    .content{
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:center;
      gap:18px;
      padding:24px;
      height:100%;
      opacity:0;
      transform:translateY(6px) scale(.98);
      transition:opacity .35s ease, transform .35s ease;
    }
    .panel.active .content{opacity:1;transform:none}

    .product-img{
      width:min(16rem,64vw);
     
      object-fit:cover;
      border-radius:14px;
      
    }

    .price-card{
      background:var(--white);
      color:#111827;
      padding:12px 18px;
      border-radius:12px;
      min-width:200px;
      text-align:center;
      box-shadow:0 8px 20px rgba(0,0,0,.15);
      display:flex;
      align-items:center;
      justify-content:center;
      gap:12px;
    }
    .price{font-size:1.6rem;font-weight:800;color:var(--accent);letter-spacing:.2px}
    .original{font-size:1rem;color:var(--muted);text-decoration:line-through;font-weight:600}

    .badge{
      position:absolute;top:18px;right:18px;
      background:var(--white);color:#111827;
      width:48px;height:48px;border-radius:999px;
      display:flex;align-items:center;justify-content:center;
      font-weight:800;font-size:1.1rem;box-shadow:0 10px 25px rgba(0,0,0,.2);
      user-select:none;
    }

    .add-wrap{
      position:relative;
      display:flex;
      gap:14px;
      align-items:center;
      justify-content:center;
    }
    .add-btn{
      background:rgba(255,255,255,.2);
      border:0;width:56px;height:56px;border-radius:999px;
      color:var(--white);font-size:28px;line-height:0;
      display:grid;place-items:center;cursor:pointer;
      transition:transform .2s ease, background .2s ease;
      backdrop-filter:saturate(140%) blur(2px);
    }
    .add-btn:hover{transform:scale(1.06);background:rgba(255,255,255,.28)}
    .add-btn:active{transform:scale(.98)}
    .qty-badge{
      position:absolute;right:-8px;top:-8px;
      width:26px;height:26px;border-radius:20px;
      background:#00000090;color:#fff;display:flex;align-items:center;justify-content:center;
      font-size:.9rem;font-weight:800;
      border:2px solid rgba(255,255,255,.55);
    }

    /* Indicador vertical con texto, se esconde cuando ese panel es activo (mobile) */
    .indicator{
      position:absolute;inset:0;display:flex;align-items:center;justify-content:center;
      font-weight:800;font-size:0.95rem;opacity:.9;user-select:none;pointer-events:none;
      transition:opacity .25s ease;
    }
    .indicator>span{writing-mode:vertical-rl;transform:rotate(180deg);letter-spacing:.6px}
    .panel.active .indicator{opacity:0}

    /* Mobile: 85% + 7.5% + 7.5% */
    @media (max-width:799.98px){
      .panel{width:7.5vw;flex:0 0 auto}
      .panel.active{width:85vw}
    }
    /* Desktop: 3 columnas iguales */
    @media (min-width:800px){
      .panel{width:33.3333%;flex:0 0 33.3333%}
      .panel:hover{transform:scale(1.02)}
      .content{opacity:1;transform:none}
      .indicator{display:none}
      
      .price{font-size:1.8rem}
      .original{font-size:1.0625rem}
    }

    /* Subtotal flotante */
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
            padding: 1px 8px;
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
    .subtotal-wrap{
      position:fixed;
      right:16px;
      bottom:16px;
      z-index:50;
      width:min(360px, 92vw);
    }
    .subtotal-card{
      display:flex;flex-direction:column;justify-content:center;align-items:center;gap:6px;
      padding:8px;border-radius:10px;min-width:280px;
      
    }
    .subtotal-row{
      display:flex;flex-direction:row;width:100%;justify-content:center;align-items:center;gap:6px;
    }
    .subtotal-row h5{color:#e3e3e3;;font-weight:100;font-size:14px;margin:0}
    .subtotal-input{
      text-align:center;color:#fff;background:none;border:none;appearance:none;
      width:35%;font-size:24px;
    }
    .btn{
      background:#b10000;padding: 14px 20px;border-radius:9px;color:#fff;border:none;cursor:pointer;width:100%
    }
    .btn[disabled]{opacity:.55;cursor:not-allowed;filter:grayscale(.2)}
    .btn-link{
      background:#b10000;padding:8px 20px;border-radius:6px;color:#fff;text-decoration:none;display:inline-block;
    }

    .hidden-input{position:absolute;left:-9999px;opacity:0;width:1px;height:1px}
  </style>
</head>
<body>
<a href="{{asset('/')}}" style="position:fixed;left:20px;top:20px;width:140px;z-index:99"><img src="{{asset('image/logo1_BN.png')}}" style="width:100%;filter:invert(1)"></a>
<form action="{{ route('adlerventa') }}" method="post">
  {{ csrf_field() }}

  <!-- Selector de mochilas con el nuevo diseño -->
  <div id="section1" class="stage">
    <!-- ROJA -->
    <section class="panel red active" data-color="red" data-label="RED BAG">
      

      <div class="content" aria-hidden="false">
        <img class="product-img" src="{{ asset('image/bagi.webp') }}" alt="Adler Backpack Roja" loading="eager">
        <div class="add-wrap">
          <button type="button" id="sub_red" class="add-btn" aria-label="Quitar mochila roja">−</button>
          <button type="button" id="add_red" class="add-btn" aria-label="Agregar mochila roja">+</button>
          <div class="qty-badge" id="qty_red">0</div>
        </div>
        <div class="price-card" role="group" aria-label="Precio mochila roja">
          <span class="price">S/ 59,90</span>
          <span class="original">S/ 89,90</span>
        </div>
        
      </div>

      <div class="indicator"><span>RED BAG</span></div>
      <input type="number" inputmode="numeric" min="0" id="red" name="red" value="{{$red}}" class="hidden-input">
    </section>

    <!-- AZUL -->
    <section class="panel blue" data-color="blue" data-label="BLUE BAG">
      

      <div class="content" aria-hidden="true">
        <img class="product-img" src="{{ asset('image/bagi3.webp') }}" alt="Adler Backpack Azul" loading="eager">
        <div class="add-wrap">
          <button type="button" id="sub_blue" class="add-btn" aria-label="Quitar mochila azul">−</button>
          <button type="button" id="add_blue" class="add-btn" aria-label="Agregar mochila azul">+</button>
          <div class="qty-badge" id="qty_blue">0</div>
        </div>
        <div class="price-card" role="group" aria-label="Precio mochila azul">
          <span class="price">S/ 59,90</span>
          <span class="original">S/ 89,90</span>
        </div>
        
      </div>

      <div class="indicator"><span>BLUE BAG</span></div>
      <input type="number" inputmode="numeric" min="0" id="blue" name="blue" value="{{$blue}}" class="hidden-input">
    </section>

    <!-- NEGRA -->
    <section class="panel dark" data-color="black" data-label="BLACK BAG">
      

      <div class="content" aria-hidden="true">
        <img class="product-img" src="{{ asset('image/bagi4.webp') }}" alt="Adler Backpack Negra" loading="eager">
        <div class="add-wrap">
          <button type="button" id="sub_black" class="add-btn" aria-label="Quitar mochila negra">−</button>
          <button type="button" id="add_black" class="add-btn" aria-label="Agregar mochila negra">+</button>
          <div class="qty-badge" id="qty_black">0</div>
        </div>
        <div class="price-card" role="group" aria-label="Precio mochila negra">
          <span class="price">S/ 79,90</span>
          <span class="original">S/ 99,90</span>
        </div>
        
      </div>

      <div class="indicator"><span>BLACK BAG</span></div>
      <input type="number" inputmode="numeric" min="0" id="black" name="black" value="{{$black}}" class="hidden-input">
    </section>
  </div>

  <!-- SUBTOTAL flotante -->
  <div class="bottom-nav">
    <div class="subtotal-card elemento">
      <div class="subtotal-row" style="display:flex;flex-direction:column">
        <h5>Subtotal</h5>
        <div style=" font-size: 32px;font-weight: 700; color: #1f2937;  display: flex; align-items: center;  justify-content: center; gap: 8px;">
            <span style="    font-size: 20px; color: #6b7280;" >S/</span>
            <input id="total" value="0.00" class="subtotal-input" style="font-size: 32px; font-weight: 700;  color: #1f2937;" readonly>
        </div>
      </div>
      {{ csrf_field() }}
      <div class="subtotal-row">
        @if (Session::has('cart'))
          <button id="botonContinuar" type="submit" class="btn">Modificar</button>
          <a href="{{ url('adler-venta-detalle') }}" class="btn-link">Continuar</a>
        @else
          <button id="botonContinuar" type="submit" class="btn">Continuar</button>
        @endif
      </div>
    </div>
  </div>

  <!-- Campos backend -->
  <input type="hidden" id="total_cents" name="total_cents" value="0">
  <input type="hidden" id="red_c"   name="red_c"   value="0">
  <input type="hidden" id="blue_c"  name="blue_c"  value="0">
  <input type="hidden" id="black_c" name="black_c" value="0">
</form>

<script>
  /* Interacción de paneles */
  (function(){
    const panels = Array.from(document.querySelectorAll('.panel'));
    function setActive(i){
      panels.forEach((p,idx)=>{
        p.classList.toggle('active', idx===i);
        const c = p.querySelector('.content');
        if (c) c.setAttribute('aria-hidden', idx===i ? 'false' : 'true');
      });
    }
    setActive(0);
    panels.forEach((p,i)=> p.addEventListener('click', ()=> setActive(i), {passive:true}));
    window.addEventListener('resize', ()=> {
      const current = panels.findIndex(p=>p.classList.contains('active'));
      setActive(current >= 0 ? current : 0);
    });
  })();
</script>

<script>
  // Lógica de + y −, subtotal y habilitar botón
  document.addEventListener('DOMContentLoaded', () => {
    const $ = id => document.getElementById(id);
    const fmt = cents => (cents/100).toFixed(2);

    const backpacks = { red: 0, blue: 0, black: 0 };
    const priceCents = { red: 5990, blue: 5990, black: 7990 };

    // Inicial desde Blade
    ['red','blue','black'].forEach(color=>{
      const input = $(color);
      const v = parseInt(input?.value || '0',10);
      backpacks[color] = isNaN(v) ? 0 : Math.max(0,v);
      const badge = $(`qty_${color}`);
      if (badge) badge.textContent = backpacks[color];
    });

    function totalBackpacks(){
      return backpacks.red + backpacks.blue + backpacks.black;
    }

    function updateSubtotal(){
      let total = backpacks.red*priceCents.red + backpacks.blue*priceCents.blue + backpacks.black*priceCents.black;

      if ($('total')) $('total').value = fmt(total);
      if ($('total_cents')) $('total_cents').value = total;

      if ($('red_c'))  $('red_c').value  = backpacks.red;
      if ($('blue_c')) $('blue_c').value = backpacks.blue;
      if ($('black_c'))$('black_c').value= backpacks.black;

      if ($('red'))  $('red').value  = backpacks.red;
      if ($('blue')) $('blue').value = backpacks.blue;
      if ($('black'))$('black').value= backpacks.black;

      const btn = $('botonContinuar');
      if (btn) btn.disabled = totalBackpacks() === 0;

      const qR=$('qty_red'), qB=$('qty_blue'), qK=$('qty_black');
      if(qR) qR.textContent = backpacks.red;
      if(qB) qB.textContent = backpacks.blue;
      if(qK) qK.textContent = backpacks.black;
    }

    // Botones +
    const mapAdd = { red:'add_red', blue:'add_blue', black:'add_black' };
    Object.entries(mapAdd).forEach(([color, btnId])=>{
      const btn = $(btnId);
      if(!btn) return;
      btn.addEventListener('click', e=>{
        e.stopPropagation();
        backpacks[color]++;
        updateSubtotal();
        btn.animate([{transform:'scale(1)'},{transform:'scale(1.12)'},{transform:'scale(1)'}],{duration:220,easing:'ease-out'});
      });
    });

    // Botones −
    const mapSub = { red:'sub_red', blue:'sub_blue', black:'sub_black' };
    Object.entries(mapSub).forEach(([color, btnId])=>{
      const btn = $(btnId);
      if(!btn) return;
      btn.addEventListener('click', e=>{
        e.stopPropagation();
        backpacks[color] = Math.max(0, backpacks[color]-1);
        updateSubtotal();
        btn.animate([{transform:'scale(1)'},{transform:'scale(0.92)'},{transform:'scale(1)'}],{duration:190,easing:'ease-out'});
      });
    });

    // Inputs ocultos por si cambias por código
    ['red','blue','black'].forEach(color=>{
      const input = $(color);
      if(!input) return;
      input.addEventListener('input', ()=>{
        const v = parseInt(input.value || '0',10);
        backpacks[color] = isNaN(v) ? 0 : Math.max(0,v);
        updateSubtotal();
      });
    });

    updateSubtotal();
  });
</script>
</body>
</html>
