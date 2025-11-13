@extends('search')
@section('cont')
  
  
<style>
/* ====== Checkout UI (sin Tailwind) ====== */
.co-container{max-width:1200px;margin:40px auto;padding:0 24px;}
.co-title{font-size:40px;font-weight:300;color:#111;margin:12px 0 6px;}
.co-sub{color:#6b7280;margin-bottom:24px;}
.co-grid{display:grid;grid-template-columns:2fr 1fr;gap:32px;}
@media (max-width:980px){.co-grid{grid-template-columns:1fr;}}

.co-card{border:1px solid #f1f5f9;border-radius:16px;padding:15px;box-shadow:0 1px 0 rgba(17,24,39,.03);}
.co-card h3{font-size:20px;color:#111827;margin:0 0 18px;font-weight:600;}

.co-items{display:flex;flex-direction:column;gap:16px;}
.co-item{display:flex;align-items:center;gap:10px;padding:14px;background:#f8fafc;border-radius:12px;}
.co-img{width:64px;height:64px;border-radius:10px;object-fit:cover;}
.co-grow{flex:1;}
.co-name{font-weight:600;color:#111827;display: -webkit-box;font-size:13px;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical; overflow: hidden;
  text-overflow: ellipsis;}
.co-cat{font-size:13px;color:#6b7280;display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical; overflow: hidden;
  text-overflow: ellipsis;}
.co-price{font-weight:700;color:#111827;margin-top:2px;}

.co-qty{display:flex;align-items:center;}
.co-qty a{display:inline-flex;align-items:center;justify-content:center;width:28px;height:28px;border-radius:999px;border:1px solid #e5e7eb;color:#374151;text-decoration:none;transition:.15s background;}
.co-qty a:hover{background:#e5e7eb;}
.co-qty-num{width:32px;text-align:center;font-weight:600;}
.co-remove{display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:999px;text-decoration:none;color:#94a3b8;}
.co-remove:hover{background:#fee2e2;color:#ef4444;}
.co-link{display:inline-block;margin-top:16px;color:#4b5563;text-decoration:none;}
.co-link:hover{color:#111827;}

.co-summary .row{display:flex;align-items:center;justify-content:space-between;color:#4b5563;font-size:15px;}
.co-summary .row + .row{margin-top:10px;}
.co-summary hr{border:0;border-top:1px solid #f1f5f9;margin:16px 0;}
.co-summary .total{display:flex;align-items:center;justify-content:space-between;font-size:20px;font-weight:700;color:#111827;}

.co-pay{width:100%;display:flex;align-items:center;justify-content:center;gap:8px;margin-top:18px;background:#111827;color:#fff;border:0;border-radius:12px;padding:14px 18px;text-decoration:none;font-weight:600;}
.co-pay:hover{background:#0f172a;}

.co-guarantee{margin-top:18px;background:#ecfdf5;border:1px solid #bbf7d0;padding:14px;border-radius:12px;}
.co-guarantee h4{margin:0 0 8px;color:#065f46;font-weight:700;}
.co-guarantee p{margin:0;font-size:13px;color:#065f46;}
.cont {
            background: white;
            border-radius: 24px;
            padding: 60px 40px;
            
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cont::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 113px;
            background: #b10000;
        }

        .icon-container {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: black;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .cart-icon {
            width: 60px;
            height: 60px;
            position: relative;
        }

        .cart-icon::before {
            content: '🛒';
            font-size: 60px;
            display: block;
            filter: grayscale(0.3);
            opacity: 0.9;
        }

        h1 {
            font-size: 28px;
            color: #2d3748;
            margin-bottom: 12px;
            font-weight: 600;
            letter-spacing: -0.5px;
        }

        p {
            font-size: 16px;
            color: #718096;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            background: #b10000;
            color: white;
            padding: 16px 48px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(238, 90, 111, 0.3);
            border: none;
            cursor: pointer;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(238, 90, 111, 0.4);
        }

        .button:active {
            transform: translateY(0);
        }

        @media (max-width: 480px) {
            .cont {
                padding: 40px 30px;
            }

            h1 {
                font-size: 24px;
            }

            .icon-container {
                width: 100px;
                height: 100px;
            }

            .cart-icon::before {
                font-size: 50px;
            }
        }
</style>

@if(Session::has('carto'))

<div class="co-container">
  <div>
    <h2 class="co-title">Checkout</h2>
    <p class="co-sub">Completa tu pedido</p>
  </div>

  <div class="co-grid">
    <!-- Columna izquierda: productos -->
    <div>
      <div class="co-card">
        <h3>Productos</h3>

        <div class="co-items">
          @foreach ($searches as $search)
            <div class="co-item">
              <img class="co-img" src="{{ asset('image/productos/'.$search['item']['image']) }}" alt="{{ $search['item']['name'] }}">
              <div class="co-grow">
                <div class="co-name">{{ $search['item']['name'] }}</div>
                <div class="co-cat">{{ $search['item']['categoria'] }}</div>
                <div class="co-price">S/. {{ number_format($search['item']['precio'],2) }}</div>
              </div>

              <div class="co-qty">
                <a href="{{ route('product.reduceCarto',['id'=>$search['item']['id']]) }}" aria-label="Disminuir cantidad">
                  <span class="material-symbols-outlined" style="font-size:18px">remove</span>
                </a>
                <span class="co-qty-num">{{ $search['qty'] }}</span>
                <a href="{{ route('product.addToCarto',['id'=>$search['item']['id']]) }}" aria-label="Aumentar cantidad">
                  <span class="material-symbols-outlined" style="font-size:18px">add</span>
                </a>
              </div>

              <a class="co-remove" href="{{ route('product.removeCarto',['id'=>$search['item']['id']]) }}" aria-label="Eliminar del carrito">
                <span class="material-symbols-outlined" style="font-size:18px">close</span>
              </a>
            </div>
          @endforeach
        </div>

        <a href="{{ url('buscando') }}" class="co-link">← Continuar comprando</a>
      </div>
    </div>

    <!-- Columna derecha: resumen -->
    <aside style="position: sticky; bottom: 8px;background: rgba(256, 256, 256, .7);border-radius: 15px; backdrop-filter: blur(3px);">
        <div class="co-card co-summary" style="position:sticky;top:32px">
          <h3>Resumen</h3>

          <div class="row">
            <span>
              Subtotal ({{ Session::has('carto') ? Session::get('carto')->totalQty : '0' }}
              {{ (Session::has('carto') && Session::get('carto')->totalQty == 1) ? 'producto' : 'productos' }})
            </span>
            <span>S/. {{ number_format($totalPrice ?? 0,2) }}</span>
          </div>

          <div class="row" id="row-coupon" style="display: {{ ($cupon_descuento ?? 0) > 0 ? 'flex' : 'none' }};">
            <span>Descuento cupón</span>
            <span id="coupon_discount_val">- S/. {{ number_format($cupon_descuento ?? 0,2) }}</span>
          </div>

          <div class="row">
            <span>Envío</span>
            <span>Gratis</span>
          </div>

          <hr>

          <div class="total">
            <span>Total</span>
            <span id="total_net_val">S/. {{ number_format($totalNet ?? ($totalPrice ?? 0),2) }}</span>
          </div>

          {{-- Caja de cupón --}}
          <div style="margin-top:14px;padding-top:12px;border-top:1px solid #f1f5f9">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div style="display:flex;gap:8px;align-items:center">
              <input id="coupon_code" type="text" placeholder="Código de cupón" style="width:50%;flex:1;padding:10px;border:1px solid #e5e7eb;border-radius:10px">
              <button id="btnApplyCoupon" class="co-pay" style="margin:0;padding:10px 14px;border-radius:10px;width:25%">Aplicar</button>
              <button id="btnRemoveCoupon" class="co-pay" style="margin:0;padding:10px 14px;border-radius:10px;background:#64748b;width:25%">Quitar</button>
            </div>
            <small id="coupon_msg" style="display:block;margin-top:6px;color:#b10000">
              @if(!empty($cupon_codigo)) Cupón activo: {{ $cupon_codigo }} @endif
            </small>

            <div id="coupon_timer_wrap" style="display: {{ !empty($cupon_expires) ? 'flex' : 'none' }}; gap:6px; align-items:center; color:#6b7280; font-size:13px; margin-top:6px;">
              <span class="material-symbols-outlined" style="font-size:16px">nest_clock_farsight_analog</span>
              <strong id="coupon_timer" data-expires="{{ $cupon_expires ?? '' }}"></strong>
            </div>
          </div>

          <a href="{{ asset('carto/delivery') }}" class="co-pay" style="margin-top:16px">
            <span class="material-symbols-outlined" style="font-size:20px">credit_card</span>
            <span>Proceder al pago</span>
          </a>

          
        </div>
    </aside>

  </div>
</div>

@else
<div class="cont">
        <div class="icon-container">
            <div class="cart-icon"></div>
        </div>
        
        <h1>Tu carrito está vacío</h1>
        <p>Parece que aún no has agregado productos. ¡Descubre nuestra colección y encuentra lo que buscas!</p>
        
        <a href="{{url('buscando')}}" class="button" >Continuar Comprando</a>
    </div>
@endif
<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function startTimer(iso){
  const el = document.getElementById('coupon_timer');
  const wrap = document.getElementById('coupon_timer_wrap');
  if (!iso || !el) return;
  wrap.style.display = 'flex';
  const end = new Date(iso).getTime();
  function tick(){
    const now = Date.now();
    let diff = Math.max(0, Math.floor((end - now)/1000));
    const m = String(Math.floor(diff/60)).padStart(2,'0');
    const s = String(diff%60).padStart(2,'0');
    el.textContent = `${m}:${s}`;
    if (diff <= 0) {
      fetch(`{{ route('cupon.remove.carto') }}`, {method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF}})
        .finally(()=> location.reload());
      return;
    }
    setTimeout(tick, 1000);
  }
  tick();
}

// Validar estado al cargar
(function(){
  const expires = document.getElementById('coupon_timer')?.dataset?.expires;
  fetch(`{{ route('cupon.validate.carto') }}`, { method:'POST', headers:{'X-CSRF-TOKEN':CSRF}})
    .then(r=>r.json()).then(j=>{
      if (j.active && j.expires_at) startTimer(j.expires_at);
      else if (expires) startTimer(expires);
    }).catch(()=>{ if (expires) startTimer(expires); });
})();

document.getElementById('btnApplyCoupon')?.addEventListener('click', function(){
  const code = document.getElementById('coupon_code').value.trim();
  if (!code) return;
  this.disabled = true;

  fetch(`{{ route('cupon.apply.carto') }}`, {
    method: 'POST',
    headers: {'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
    body: JSON.stringify({code})
  })
  .then(r=>r.json().then(j=>({ok:r.ok, status:r.status, j})))
  .then(({ok,status,j})=>{
    const msg = document.getElementById('coupon_msg');
    if (!ok) {
      msg.textContent = j.msg || 'No se pudo aplicar.';
      this.disabled = false;
      return;
    }
    msg.textContent = `Cupón aplicado: ${j.code}`;
    // Mostrar fila de descuento y actualizar total neto
    document.getElementById('row-coupon').style.display = 'flex';
    document.getElementById('coupon_discount_val').textContent = '- S/. ' + j.discount;
    document.getElementById('total_net_val').textContent   = 'S/. ' + j.new_total;

    const timer = document.getElementById('coupon_timer');
    if (timer) timer.dataset.expires = j.expires_at;
    startTimer(j.expires_at);
    this.disabled = false;
  })
  .catch(()=>{
    document.getElementById('coupon_msg').textContent='Error de red.';
    this.disabled=false;
  });
});

document.getElementById('btnRemoveCoupon')?.addEventListener('click', function(){
  fetch(`{{ route('cupon.remove.carto') }}`, {method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF}})
    .then(()=> location.reload());
});
</script>

@endsection
