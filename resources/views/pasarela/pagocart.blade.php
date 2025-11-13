@extends('search')
@section('cont')

     <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/pagos.css')}}">
    <link rel="stylesheet" href="{{asset('css/yape.css')}}">
     <script src="https://sdk.mercadopago.com/js/v2"></script>
</head>
<style>
 
                              :root{
                                --bg:#f4f7fb;
                                --card:#ffffff;
                                --accent:#2b6df6;
                                --muted:#7b8aa3;
                                --shadow: 0 10px 30px rgba(32,41,63,0.08);
                                --radius:14px;
                                --small-radius:8px;
                                --glass: rgba(255,255,255,0.6);
                                font-family: Inter, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
                              }
                              body{padding:0;background:var(--bg);}
.button-save {
    position: relative;
    overflow: hidden;
    border: 2px solid #e53935;
    background: white;
    color: #e53935;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.button-save:disabled {
    cursor: not-allowed;
    opacity: 0.8;
}

.button-fill {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 0;
    background-color: #e53935;
    transition: width 2s ease-in-out;
    z-index: 1;
}

.button-text {
    position: relative;
    z-index: 2;
}

.button-save.animating .button-fill {
    width: 100%;
}

.button-save.animating .button-text {
    color: white;
}

                              /* Card container */
                              .id-card{
                               
                                background: linear-gradient(180deg, rgba(255,255,255,0.98), var(--card));
                                border-radius:var(--radius);
                                box-shadow: var(--shadow);
                                display:flex;
                                gap:13px;
                                padding:13px;
                                align-items:stretch;
                                border:1px solid rgba(36,55,90,0.04);
                              }

                              /* left column: photo + summary */
                              .left{
                                width:30%;
                                
                                display:flex;
                                flex-direction:column;
                                gap:12px;
                              }

                              .photo{
                                height:114px;
                                border-radius:10px;
                                background:
                                  linear-gradient(135deg, rgba(43,109,246,0.10), rgba(123,95,255,0.06)),
                                  linear-gradient(0deg, #eef6ff, #ffffff);
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                position:relative;
                                overflow:hidden;
                                box-shadow: 0 6px 18px rgba(43,109,246,0.06) inset;
                                border:1px solid rgba(43,109,246,0.06);
                              }

                              /* placeholder silhouette */
                              .photo svg{ width:46%; height:auto; opacity:0.92; }

                              .logo-strip{
                                display:flex;
                                align-items:center;
                                gap:12px;
                                padding:10px 12px;
                                border-radius:8px;
                                background: linear-gradient(90deg, rgba(43,109,246,0.06), rgba(123,95,255,0.03));
                                border:1px solid rgba(43,109,246,0.035);
                                box-shadow: 0 4px 10px rgba(32,41,63,0.03);
                              }

                              .brand{
                                display:flex;
                                flex-direction:column;
                                line-height:1;
                              }
                              .brand .title{ color:var(--accent); font-weight:700; font-size:11px; }
                              .brand .sub{ color:var(--muted); font-size:8px; margin-top:2px; }

                              /* right column: details */
                              .right{
                                flex:1;
                                display:flex;
                                flex-direction:column;
                                gap:9px;
                              }

                              .card-header{
                                display:flex;
                                align-items:center;
                                justify-content:space-between;
                                gap:12px;
                              }

                              .id-title{
                                font-size:12px;
                                font-weight:700;
                                color:#102040;
                                letter-spacing:0.2px;
                              }

                              .meta{
                                color:var(--muted);
                                font-size:8px;
                                display:flex;
                                gap:10px;
                                align-items:center;
                              }

                              .fields{
                                display:grid;
                                grid-template-columns: 1fr 1fr;
                                gap:5px 5px;
                                
                              }

                              .field{
                                background: linear-gradient(180deg, rgba(240,244,255,0.6), rgba(255,255,255,0.8));
                                padding:5px 6px;
                                border-radius:10px;
                                border:1px solid rgba(18,32,80,0.03);
                              }

                              .label{
                                font-size:9px;
                                color:var(--muted);
                                display:block;
                              }

                              .value{
                                font-weight:600;
                                color:#0f2a5a;
                                font-size:11px;
                                word-break:break-word;
                              }

                              /* full width field (direccion) */
                              .field.full{
                                grid-column:1 / -1;
                              }

                              /* group for distrito/provincia/departamento */
                              .triplet{
                                display:flex;
                                gap:10px;
                              }
                              .triplet .field{ flex:1; padding:6px; }

                              .qr{
                                margin-left:auto;
                                display:flex;
                                align-items:center;
                                gap:10px;
                              }

                              .barcode{
                                width:160px;
                                height:36px;
                                border-radius:6px;
                                background: repeating-linear-gradient(90deg, #0f2a5a 0 4px, transparent 4px 6px);
                                opacity:0.08;
                                transform:skewX(-8deg);
                              }

                              /* small foot */
                              .footer{
                                margin-top:10px;
                                display:flex;
                                align-items:center;
                                justify-content:space-between;
                                color:var(--muted);
                                font-size:8px;
                              }

                              /* responsive */
                              @media (max-width:720px){
                                .id-card{ flex-direction:column; padding:18px; gap:16px; width:92vw;}
                                .left{ width:100%; flex-direction:row; gap:14px; align-items:center; }
                                .photo{flex:0 0 120px; height:120px;}
                                .right{ width:100%;}
                                .fields{ grid-template-columns: 1fr; }
                                .triplet{ flex-direction:column; }
                                .barcode{ display:none; }
                              }

                              /* small utilities */
                              .muted{ color:var(--muted); font-size:9px; }
                              .caps{ text-transform:uppercase; font-size:11px; letter-spacing:0.9px; color:var(--muted); font-weight:700; }
                              .loader-container {
            position: relative;
            width: 120px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            position: absolute;
            width: 80px;
            height: 80px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            opacity: 1;
            transform: scale(1);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .check {
            position: absolute;
            opacity: 0;
            transform: scale(0);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .check svg {
            width: 80px;
            height: 80px;
            fill: none;
            stroke: #ffffff;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .check-path {
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
        }

        .success-text {
            position: absolute;
            top: 100px;
            color: #ffffff;
            font-size: 14px;
            font-weight: 300;
            letter-spacing: 0.5px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            text-align: center;
        }

        .redirect-text {
            position: absolute;
            top: -40px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 500;
            letter-spacing: 1px;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            text-align: center;
        }

        .progres-container {
            position: absolute;
            top: 20px;
            width: 200px;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            overflow: hidden;
            opacity: 0;
            transform: scaleX(0);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #ffffff, #f0f0f0);
            border-radius: 2px;
            width: 0%;
            transition: width 0.1s ease-out;
        }

        /* Estados de la animación */
        .loader-container.phase-loading .loader {
            opacity: 1;
            transform: scale(1);
        }

        .loader-container.phase-check .loader {
            opacity: 0;
            transform: scale(0);
            animation: none;
        }

        .loader-container.phase-check .check {
            opacity: 1;
            transform: scale(1);
        }

        .loader-container.phase-check .check-path {
            animation: checkmark 0.6s ease-in-out forwards;
        }

        .loader-container.phase-check .success-text {
            opacity: 1;
            transform: translateY(0);
        }

        .loader-container.phase-progress .loader {
            opacity: 0;
            transform: scale(0);
            animation: none;
        }

        .loader-container.phase-progress .check {
            opacity: 0;
            transform: scale(0);
        }

        .loader-container.phase-progress .success-text {
            opacity: 0;
            transform: translateY(10px);
        }

        .loader-container.phase-progress .redirect-text {
            opacity: 1;
            transform: translateY(0);
        }

        .loader-container.phase-progress .progres-container {
            opacity: 1;
            transform: scaleX(1);
        }

        /* Animaciones */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes checkmark {
            0% {
                stroke-dashoffset: 100;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }

        /* Efecto de pulsación sutil en el fondo */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 0.3;
                transform: scale(1);
            }
            50% {
                opacity: 0.1;
                transform: scale(1.05);
            }
        }
.loader-overlay{
  position: fixed; inset: 0;
  display: none;
  align-items: center; justify-content: center;
  z-index: 2147483647;
  background: rgb(15 15 15 / 69%);
  backdrop-filter: blur(5px);
}
.loader-overlay.show{ display:flex; }
                             
</style>

                        
                            
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo"><a href="{{asset('/')}}"><img src="{{asset('image/logo1_BN.png')}}" alt="" style="width:100px; filter: invert(1);"></a></div>
            <div style="color: #666; font-size: 14px;">
                <span style="margin-right: 20px;">🔒 Compra Segura</span>
                <span>📞 Ayuda</span>
            </div>
        </div>

        <!-- Progress Steps -->
        <div class="progress-container">
            <div class="progress-steps">
                <div class="step completed">
                    <div class="step-circle">✓</div>
                    <a href="{{asset('pasarela-pago')}}" style="z-index:99"><div class="step-label">Carrito</div></a>
                </div>
                <div class="step completed">
                    <div class="step-circle">✓</div>
                    <a href="{{asset('carto/delivery')}}" style="z-index:99"><div class="step-label">Envío</div></a>
                </div>
                <div class="step active">
                    <div class="step-circle">3</div>
                    <div class="step-label">Pago</div>
                </div>
                <div class="step">
                    <div class="step-circle">4</div>
                    <div class="step-label">Confirmación</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Left Section -->
            <div class="left-section">
                <!-- Delivery Options -->
                <div class="section">
                    <h2 class="section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M20 7H4C2.9 7 2 7.9 2 9V20C2 21.1 2.9 22 4 22H20C21.1 22 22 21.1 22 20V9C22 7.9 21.1 7 20 7ZM20 20H4V13H20V20Z" fill="#ea6666ff"/>
                            <path d="M9 4H15V7H9V4Z" fill="#ea6666ff"/>
                        </svg>
                        Medios de pago
                    </h2>
                    <div id="paymentBrick_container"></div>
                    <!-- MODAL de Yape -->
                     <div class="modal-overlay" id="yapeModal" >
                            <div class="modal">
                                <div class="modal-header">
                                    <button class="close-btn" id="closeYapeModal">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                    <div class="yape-logo"><img src="{{asset('image/svg/yape.svg')}}" alt="" style="width:100%"></div>
                                    <h2 class="modal-title">Pagar con Yape</h2>
                                    <p class="modal-subtitle">Completa tu pago de forma segura</p>
                                </div>

                                <div class="modal-body">
                                    <form id="form-yape">
                                        <div class="amount-display">
                                            <div class="currency">MONTO A PAGAR</div>
                                            <div class="amount">S/. {{ number_format($amount, 2) }}</div>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-input" id="form-checkout__payerPhone" placeholder=" "  maxlength="9"pattern="[0-9]{9}" required>
                                            <label class="floating-label" for="form-checkout__payerPhone">Celular (Yape)</label>
                                        </div>

                                        <div class="input-group">
                                            <div class="form-group">
                                                <input   type="text"  class="form-input"  id="form-checkout__payerOTP"  placeholder=" " maxlength="6" pattern="[0-9]{6}" >
                                                <label class="floating-label" for="form-checkout__payerOTP">Código OTP</label>
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="email" class="form-input"id="form-checkout__email" placeholder="" value="{{$email}}" required  >
                                                <label class="floating-label" for="form-checkout__email">Email</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="pay-button">
                                            <span>Confirmar Pago</span>
                                        </button>

                                        <div class="security-info">
                                            <div class="security-icon">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                                    <polyline points="20,6 9,17 4,12"></polyline>
                                                </svg>
                                            </div>
                                            <div class="security-text">
                                                Tu información está protegida con encriptación SSL de 256 bits
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> 


                        
                    <button class="yape-option-btn" id="openYapeModal" type="button">
                        <span class="custom-radio"></span>
                        <span class="yape-icon">
                            <!-- Ícono SVG de Yape, puedes cambiar por el oficial -->
                            <img src="https://images.seeklogo.com/logo-png/38/2/yape-logo-png_seeklogo-381640.png" alt="" style="width:30px;border-radius:20px">
                        </span>
                        <span>
                            <div class="pay-title">Pagar con Yape</div>
                            <div class="pay-desc">Sin comisiones, rápido y seguro</div>
                        </span>
                    </button>
           


                              
   
                </div>
            </div>                  
             
                
             
                    
                   

                   

            <!-- Right Section - Order Summary -->
            <div class="right-section">
                <div class="order-summary">
                    <h3 class="summary-title">Resumen de Compra</h3>
                    
                    <!-- Products -->
                    

                    

                    <div class="product-item">
                        <div class="product-image">📦</div>
                        <div class="product-info">
                            <div class="product-name">Artículos Adicionales</div>
                            <div class="product-quantity">Productos</div>
                        </div>
                        <div class="product-price">S/. {{ number_format($total, 2) }}</div>
                    </div>

                    <!-- Coupon 
                    <div class="coupon-section">
                        <input type="text" class="coupon-input" placeholder="Código de cupón">
                        <button class="coupon-btn">Aplicar</button>
                    </div>-->

                    <!-- Totals -->
                    <div class="summary-totals">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="subtotal">S/. {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Envío</span>
                            <span style="color: #4caf50; font-weight: 500;" id="cardCosto">S/. {{number_format($envio, 2)}}</span>
                        </div>
                        <div class="summary-row">
                            <span>Descuento</span>
                            <span style="color: #f44336;" id="cardDescuento">- S/. {{ number_format($cupon_descuento ?? 0, 2) }}</span>
                        </div>
                        <div id="coupon_timer_wrap"
                            style="display:none;margin:4px 0 10px 0;background:#fff7e6;
                                    border:1px solid #ffe2b8;padding:4px 8px;border-radius:6px;
                                    font-size:12px;color:#b45309;display:none;align-items:center;gap:6px;justify-content:center">
                            <span>Cupón activo · expira en</span>
                            <strong id="coupon_timer"
                                    data-expires="{{ $coupon_expires_at_iso ?? '' }}"
                                    style="letter-spacing:1px">--:--</strong>
                        </div>
  
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="totalFinal">S/. {{number_format($amount, 2)}} </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    
                    <!-- Security Badge -->
                    <div class="security-badge">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM10 17L6 13L7.41 11.59L10 14.17L16.59 7.58L18 9L10 17Z"/>
                        </svg>
                        <span>Compra 100% segura y protegida</span>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <script>
// ---- MercadoPago UNA SOLA VEZ
const mp = new MercadoPago("{{ config('services.mercadopago.public_key') }}", { locale: 'es-PE' });
  const bricksBuilder = mp.bricks();
window.currentAmount = Number({{ json_encode($amount) }});
async function renderPaymentBrick() {
  const settings = {
    initialization: {
      amount: Number(Number(window.currentAmount).toFixed(2)),
      payer: { firstName: '', lastName: '', email: '{{$email}}', entityType: 'individual' },
    },
    customization: {
      visual: { 
        hideFormTitle: true,
        style: { theme: 'bootstrap' }
      },
      paymentMethods: {
        creditCard: 'all',
        debitCard: 'all',
        maxInstallments: 1
      }
    },
    callbacks: {
      onReady: () => {
        // opcional: aquí no toques el loader
      },

      // >>>>> AQUI VA LA MAGIA
      onSubmit: ({ selectedPaymentMethod, formData }) => {
        const csrf = document.querySelector('meta[name="csrf-token"]').content;
        loaderUI.start(); // mostrar overlay de inmediato
        
        // armamos la promesa del pago (fetch)
        const pagoPromise = fetch(@json(route('mp.processpay')), {
          method: 'POST',
          headers: { 'Content-Type':'application/json','X-CSRF-TOKEN': csrf },
          body: JSON.stringify(formData)
        })
        .then(r => r.ok ? r.json() : r.json().then(Promise.reject));

        // el Brick exige que retornes una Promise
        return new Promise(async (resolve, reject) => {
          try {
            // mínimo 3s de spinner aunque el server vuele
            const res = await minDelay(3000, pagoPromise);

            // si tu backend manda redirect en éxito, corremos flow bonito y navegamos
            if (res.redirect || res.status === 'approved') {

              await loaderUI.successFlow();      // check -> "REDIRIGIENDO" + barra
              window.location.href = res.redirect || @json(route('yape.success'));
              
              return;
            }

            // si no hay redirect, al menos mostramos el debug si tienes esos nodos
            const result = document.getElementById('result');
            const statusLine = document.getElementById('statusLine');
            const extra = document.getElementById('extra');
            if (result && statusLine && extra) {
              result.style.display = 'block';
              statusLine.textContent = "Debug JSON:";
              extra.innerHTML = `<pre>${JSON.stringify(res, null, 2)}</pre>`;
            }

            loaderUI.stop();  // ocultar overlay si nos quedamos en la misma vista
            resolve();        // avisar al Brick que terminamos bien

          } catch (err) {
            console.error('Error en la petición:', err);
            loaderUI.stop();  // no tortures al usuario si falló
            reject(err);      // el Brick mostrará su estado de error
          }
        });
      },

      onError: (e) => console.error('Brick error', e),
    }
  };

  window.paymentBrickController = await bricksBuilder.create('payment', 'paymentBrick_container', settings);
}
renderPaymentBrick();
// --- Modal Yape
const yapeModal = document.getElementById('yapeModal');
const openYapeModalBtn = document.getElementById('openYapeModal');
const closeYapeModalBtn = document.getElementById('closeYapeModal');

// Abrir modal
openYapeModalBtn.onclick = () => {
  yapeModal.classList.add('active');
    document.body.style.overflow = 'hidden';  
  document.getElementById('form-checkout__payerPhone').focus();
};
// Cerrar modal
closeYapeModalBtn.onclick = () => {yapeModal.classList.remove('active');document.body.style.overflow = '';  }
yapeModal.onclick = (e) => { if (e.target === yapeModal) yapeModal.classList.remove('active'); };

// Enviar pago Yape (sin recargar)
document.getElementById('form-yape').addEventListener('submit', async (e) => {
  e.preventDefault();
  const btn = e.submitter || document.querySelector('#form-yape .pay-button');
    btn.disabled = true;

  const phoneNumber = document.getElementById("form-checkout__payerPhone").value.trim();
  const otp         = document.getElementById("form-checkout__payerOTP").value.trim();
  const email       = document.getElementById("form-checkout__email").value.trim();
  const amount      = parseFloat('{{$amount}}');
    
  loaderUI.start();

    try {
      const pagoPromise = (async () => {
        const yape = mp.yape({ phoneNumber, otp });
        const yapeToken = await yape.create();

        const res = await fetch("{{ route('mp.ya') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({
            transactionAmount: amount,
            paymentMethodId: "yape",
            token: yapeToken.id,
            email
          })
        });

        const data = await res.json();
        if (!res.ok) {
          const err = new Error(data?.message || 'Error en pago Yape');
          err.payload = data;
          throw err;
        }
        return data;
      })();

      // Mantén el spinner al menos 3 s
      const data = await minDelay(3000, pagoPromise);

      if (data.redirect) {
        // Éxito real: corre fases y luego navega
        await loaderUI.successFlow();
        window.location.href = data.redirect;
        return;
      }

      // Sin redirect: informar y cerrar
      alert(`Estado: ${data.status} (${data.status_detail})`);
      loaderUI.stop();

    } catch (err) {
      console.error("Error Yape:", err);
      loaderUI.stop();
      btn.disabled = false;
      alert("No se pudo procesar el pago con Yape.");
    }
  });
</script>

<script>
  const sleep = (ms) => new Promise(r => setTimeout(r, ms));
  const minDelay = async (ms, promise) => {
    const [res] = await Promise.all([promise, sleep(ms)]);
    return res;
  };

  const loaderUI = (() => {
    let overlay, container, progressBar, progressInterval;

    function init(){
      overlay = document.getElementById('loaderOverlay');
      container = document.getElementById('loaderContainer');
      progressBar = document.getElementById('progressBar');
    }
    function setPhase(name){
      container.className = `loader-container ${name}`;
    }
    function animateProgress() {
            if (!progressBar) {
                console.error('progressBar no existe');
                return;
            }
            
            let progress = 0;
            progressBar.style.width = '0%';
            
            clearInterval(progressInterval);
            progressInterval = setInterval(() => {
                if (!progressBar) {
                    clearInterval(progressInterval);
                    return;
                }
                
                progress += Math.random() * 3 + 1;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(progressInterval);
                }
                progressBar.style.width = progress + '%';
            }, 50);
        }

    return {
      start(){
        if (!document.getElementById('loaderOverlay')) init();
        if (!overlay) init();
        overlay.classList.add('show');
        setPhase('phase-loading');
        document.body.style.overflow = 'hidden'; 
      },
      async successFlow(){
        setPhase('phase-check');
        await sleep(2500);
        setPhase('phase-progress');
        animateProgress();
        await sleep(1200);
      },
      stop(){
        clearInterval(progressInterval);
        if (!overlay) return;
        overlay.classList.remove('show');
        setPhase('phase-loading');
        if (progressBar) progressBar.style.width = '0%';
      }
    };
  })();
</script>
<script>
async function refreshResumenPago(){
  try{
    const res = await fetch(@json(route('pasarela.resumen')), { credentials:'same-origin' });
    const { summary } = await res.json();

    // Actualiza DOM
    const fmt = (n)=> 'S/. ' + Number(n).toFixed(2);
    document.getElementById('subtotal').textContent     = fmt(summary.subtotal);
    document.getElementById('cardCosto').textContent    = fmt(summary.envio);
    document.getElementById('cardDescuento').textContent= '- ' + fmt(summary.descuento).replace('S/. ','');
    document.getElementById('totalFinal').textContent   = fmt(summary.total);

    // Si el total cambió, re-renderiza el Brick con el nuevo monto
    const newTotal = Number(summary.total);
    if (!Number.isNaN(newTotal) && newTotal !== Number(window.currentAmount)) {
      window.currentAmount = newTotal;

      // desmonta y vuelve a montar el Brick
      try { await window.paymentBrickController?.unmount(); } catch(e){}
      await renderPaymentBrick();
    }
  } catch(e){
    console.warn('No se pudo refrescar resumen:', e);
  }
}

// Refresca al cargar, al volver al tab y cada 20s (si quieres)
document.addEventListener('DOMContentLoaded', refreshResumenPago);
document.addEventListener('visibilitychange', ()=>{ if(!document.hidden) refreshResumenPago(); });
setInterval(refreshResumenPago, 20000);
</script>
<script>
(function(){
  const CSRF   = document.querySelector('meta[name="csrf-token"]').content;
  const wrap   = document.getElementById('coupon_timer_wrap');
  const timerEl= document.getElementById('coupon_timer');
  const descEl = document.getElementById('cardDescuento');
  const totalEl= document.getElementById('totalFinal');

  // 1) modal igual al del otro blade
  function showCouponExpiredModal(){
    let m = document.getElementById('couponExpiredModal');
    if (!m) {
      m = document.createElement('div');
      m.id = 'couponExpiredModal';
      m.style.position = 'fixed';
      m.style.inset = '0';
      m.style.display = 'flex';
      m.style.alignItems = 'center';
      m.style.justifyContent = 'center';
      m.style.background = 'rgba(0,0,0,.4)';
      m.style.backdropFilter = 'blur(4px)';
      m.style.zIndex = '999999';
      m.innerHTML = `
        <div style="background:white;border-radius:14px;padding:20px 26px;max-width:360px;width:92%;text-align:center;box-shadow:0 15px 35px rgba(0,0,0,.25)">
          <div style="font-size:36px;margin-bottom:6px;">⏰</div>
          <h3 style="margin:0 0 4px 0;">Cupón expirado</h3>
          <p style="margin:0 0 14px 0;font-size:13px;color:#555">El descuento ya no está disponible.</p>
          <p style="margin:0;font-size:13px;">Actualizando en <span id="couponExpiredCountdown">3</span>…</p>
        </div>
      `;
      document.body.appendChild(m);
    } else {
      m.style.display = 'flex';
    }

    let c = 3;
    const ce = document.getElementById('couponExpiredCountdown');
    const iv = setInterval(() => {
      c--;
      if (ce) ce.textContent = c;
      if (c <= 0) {
        clearInterval(iv);
        // 1) refresca resumen (para que traiga total SIN cupón)
        if (typeof refreshResumenPago === 'function') {
          refreshResumenPago();
        }
        // 2) y luego recarga toda la vista para no dejar el Brick con monto viejo
        location.reload();
      }
    }, 1000);
  }

  // 2) función que arranca el contador mm:ss
  function startTimer(iso){
    if (!iso || !wrap || !timerEl) return;
    wrap.style.display = 'flex';
    const end = new Date(iso).getTime();

    const intv = setInterval(() => {
      const now  = Date.now();
      let diff   = Math.floor((end - now)/1000);
      if (diff < 0) diff = 0;

      const m = String(Math.floor(diff/60)).padStart(2,'0');
      const s = String(diff%60).padStart(2,'0');
      timerEl.textContent = `${m}:${s}`;

      if (diff <= 0) {
        clearInterval(intv);
        // cuando ya se venció → borro cupón en backend
        fetch(@json(route('cupon.remove')), {
          method:'DELETE',
          headers:{'X-CSRF-TOKEN': CSRF}
        }).finally(() => {
          showCouponExpiredModal();
        });
      }
    }, 1000);
  }

  // 3) al cargar preguntamos al backend si el cupón sigue vivo
  fetch(@json(route('cupon.validate')), {
    method:'POST',
    headers:{
      'X-CSRF-TOKEN': CSRF,
      'Accept':'application/json'
    }
  })
  .then(r => r.json())
  .then(j => {
    // si NO está activo → dejamos descuento en 0 y no mostramos timer
    if (!j || !j.active) {
      if (descEl)  descEl.textContent = '- S/. 0.00';
      if (wrap)    wrap.style.display = 'none';
      return;
    }

    // sí está activo → pintamos descuento y total si vienen
    if (typeof j.discount !== 'undefined') {
      const soles = j.discount > 100 ? (j.discount/100) : j.discount;
      if (descEl) descEl.textContent = '- S/. ' + Number(soles).toFixed(2);
    }

    if (typeof j.new_total !== 'undefined') {
      const tot = j.new_total > 100 ? (j.new_total/100) : j.new_total;
      if (totalEl) totalEl.textContent = 'S/. ' + Number(tot).toFixed(2);
      // MUY IMPORTANTE: si cambió total, también actualizamos el Brick
      if (!Number.isNaN(tot) && typeof window.currentAmount !== 'undefined' && tot !== window.currentAmount) {
        window.currentAmount = Number(tot);
        // desmontar y montar de nuevo
        (async () => {
          try { await window.paymentBrickController?.unmount(); } catch(e){}
          await renderPaymentBrick();
        })();
      }
    }

    // arrancar timer con la fecha que diga el backend
    if (j.expires_at) {
      startTimer(j.expires_at);
    } else if (timerEl && timerEl.dataset.expires) {
      // plan B: lo trajo el blade
      startTimer(timerEl.dataset.expires);
    }
  })
  .catch(() => {
    // si la validación falló pero el blade traía data-expires, lo usamos
    if (timerEl && timerEl.dataset.expires) {
      startTimer(timerEl.dataset.expires);
    }
  });
})();
</script>

<div id="loaderOverlay" class="loader-overlay" aria-hidden="true">

  <div class="loader-container" id="loaderContainer">
    <div class="loader"></div>

    <div class="check">
      <svg viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="45" stroke="rgba(255,255,255,0.3)" stroke-width="3" fill="none"/>
        <path class="check-path" d="M25 50 L40 65 L75 30" stroke="#ffffff" stroke-width="4" fill="none"/>
      </svg>
    </div>

    <div class="success-text">Pago exitoso</div>
    <div class="redirect-text">REDIRIGIENDO</div>

    <div class="progres-container">
      <div class="progress-bar" id="progressBar"></div>
    </div>
  </div>
  
</div>

@endsection

















