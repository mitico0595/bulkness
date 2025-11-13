

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos Adler</title>
    <link rel="stylesheet" href="{{asset('css/pagos.css')}}">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     @include ('global.icon')
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
</style>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo"><img src="{{asset('image/logo1_BN.png')}}" alt="" style="width:100px; filter: invert(1);"></div>
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
                    <a href=""><div class="step-label">Carrito</div></a>
                </div>
                <div class="step active">
                    <div class="step-circle">2</div>
                    <div class="step-label">Envío</div>
                </div>
                <div class="step">
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
                  
                              <div id="result" style="display:none;margin-top:19px;">
  <div id="statusLine" style="font-size:17px;font-weight:600;color:#7531cb;"></div>
  <div id="extra" style="margin-top:9px;font-size:14px;"></div>
</div>

                </div>
            </div>                  
             
                
             
                    
                   

                   

            <!-- Right Section - Order Summary -->
            <div class="right-section">
                <div class="order-summary">
                    <h3 class="summary-title">Resumen de Compra</h3>
                    
                    <!-- Products -->
                    <div class="product-item">
                        <div class="product-image"><img src="{{asset('image/thumb/bagred.png')}} " alt="" style="width:80%"></div>
                        <div class="product-info">
                            <div class="product-name">Mochilas de Emergencia</div>
                            <div class="product-quantity">Bag Adler</div>
                        </div>
                        <div class="product-price">S/. {{ number_format($totalmochila, 2) }}</div>
                    </div>

                    <div class="product-item">
                        <div class="product-image"><img src="{{asset('image/thumb/kit.png')}} " alt="" style="width:80%"></div>
                        <div class="product-info">
                            <div class="product-name">Kits</div>
                            <div class="product-quantity">Adler kit</div>
                        </div>
                        <div class="product-price">S/. {{ number_format($totalkit, 2) }}</div>
                    </div>

                    <div class="product-item">
                        <div class="product-image">📦</div>
                        <div class="product-info">
                            <div class="product-name">Artículos Adicionales</div>
                            <div class="product-quantity">Productos</div>
                        </div>
                        <div class="product-price">S/. {{ number_format($totalarticulo, 2) }}</div>
                    </div>

                    <!-- Coupon -->
                    <div class="coupon-section">
                        <input type="text" class="coupon-input" placeholder="Código de cupón">
                        <button class="coupon-btn">Aplicar</button>
                    </div>

                    <!-- Totals -->
                    <div class="summary-totals">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="subtotal">S/. {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Envío</span>
                            <span style="color: #4caf50; font-weight: 500;" id="cardCosto">Gratis</span>
                        </div>
                        <div class="summary-row">
                            <span>Descuento</span>
                            <span style="color: #f44336;" id="cardDescuento">- S/. 0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="totalFinal"></span>
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
    

<script src="https://sdk.mercadopago.com/js/v2"></script>
  <script>
 const mp = new MercadoPago("{{ env('MP_TEST_API_KEY') }}", { locale: 'es-PE' });
  const bricksBuilder = mp.bricks();

async function renderPaymentBrick() {
  const settings = {
    initialization: {
      amount: Number(@json($amount)),
      payer: { firstName: '', lastName: '', email: '', entityType: 'individual' },
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
        // Brick listo, puedes poner algún loader si quieres
      },
      onSubmit: ({ selectedPaymentMethod, formData }) => {
  const csrf = document.querySelector('meta[name="csrf-token"]').content;
  console.log("onSubmit llamado. formData:", formData);
  return new Promise((resolve, reject) => {
    fetch(@json(route('mp.process')), {
      method: 'POST',
      headers: { 'Content-Type':'application/json','X-CSRF-TOKEN': csrf },
      body: JSON.stringify(formData)
    })
    .then(r => {
      console.log("FETCH STATUS:", r.status);
      return r.ok ? r.json() : r.json().then(Promise.reject);
    })
    .then(res => {
      console.log("RESPUESTA FINAL:", res);
      const result = document.getElementById('result');
      const statusLine = document.getElementById('statusLine');
      const extra = document.getElementById('extra');
      if (result && statusLine && extra) {
        result.style.display = 'block';
        statusLine.textContent = "Debug JSON:";
        extra.innerHTML = `<pre>${JSON.stringify(res, null, 2)}</pre>`;
      } else {
        console.warn("Algún div no existe.");
      }
      resolve();
    })
    .catch(err => { 
      console.error("Error en la petición:", err);
      reject();
    });
  });
},
      onError: (e) => console.error('Brick error', e),
    }
  };

  window.paymentBrickController = await bricksBuilder.create('payment', 'paymentBrick_container', settings);
}
renderPaymentBrick();

  </script>




</body>

</html>