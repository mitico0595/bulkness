@extends('search')
@section('cont')

    <link rel="stylesheet" href="{{asset('css/pagos.css')}}">

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
                                .id-card{ flex-direction:column; padding:18px; gap:16px; width:100%;}
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

    <div class="container">
        <!-- Header -->
        <div class="header">
            
        </div>

        <!-- Progress Steps -->
        <div class="progress-container">
            <div class="progress-steps">
                <div class="step completed">
                    <div class="step-circle">✓</div>
                    <a href="{{asset('pasarela-pago')}}" style="z-index:99"><div class="step-label">Carrito</div></a>
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
                        Método de Entrega
                    </h2>
                    <div class="delivery-options">
                        <div class="delivery-option" id="recojo">
                            <div class="delivery-option-header">
                                <div class="delivery-icon pickup-icon">🏪</div>
                                <div>
                                    <div class="delivery-title">Recoger en Tienda</div>
                                    <div class="delivery-subtitle">Plaza San Miguel - Gratis<br>Listo en 24-48 horas</div>
                                </div>
                            </div>
                        </div>
                        <div class="delivery-option" id="delivery">
                            <div class="delivery-option-header">
                                <div class="delivery-icon delivery-icon-home">🚚</div>
                                <div>
                                    <div class="delivery-title">Envío a Domicilio</div>
                                    <div class="delivery-subtitle">Lima y provincias<br>Entrega en 2-5 días</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Form -->
                
                <div class="section" id="delivery-content">
                    
                    <form id="deliveryForm" method="POST" action="{{ route('cliente.carto.delivery') }}">
                    @csrf         
                    <div id="add-email">
                      <h2 class="section-title" id="">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                          <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" fill="#ea6666ff"/>
                          <path d="M22 6L12 13L2 6" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        Ingrese correo electronico e-mail
                      </h2>
                        <input type="text" class="form-input" name="f-email" id="f-email">
                        <div style="display:flex;justify-content:flex-end">      
                          <div style="display:flex;justify-content:flex-end">      
                              <button id="f-email-button" type="button" class="button-save" style="width: 200px;padding: 8px;border-radius: 8px;text-align: center;cursor:pointer;margin-top:20px;">
                                  <div class="button-fill"></div>
                                  <span class="button-text">Guardar</span>
                              </button>
                          </div>
                        </div>
                    </div> 
                    <h2 class="section-title" id="section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22S19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z" fill="#ea6666ff"/>
                        </svg>
                        Dirección de Envío
                    </h2>

                    <div class="" id="id-card" style="padding: 20px;  border-radius: 12px; cursor: pointer;width: 100%;">
                                              
                              <article class="id-card" role="region" aria-label="Documento de identidad">
                                <!-- left column -->
                                <div class="left">
                                  <div class="photo" aria-hidden="true">
                                    <!-- simple silhouette placeholder -->
                                    <img src="{{asset('image/thumb/delivery.jpg')}}" alt="" style="width:100%">
                                  </div>

                                  <div style="display:flex;flex-direction:column;gap:10px;flex:1;justify-content:center;">
                                    <div class="logo-strip" aria-hidden="true">
                                      <svg width="34" height="34" viewBox="0 0 24 24" fill="none" style="flex-shrink:0">
                                        <rect x="1" y="1" width="22" height="22" rx="5" fill="#eaf2ff"/>
                                        <path d="M6 12h12M6 8h12M6 16h8" stroke="#2b6df6" stroke-width="1.6" stroke-linecap="round"/>
                                      </svg>
                                      <div class="brand">
                                        <span class="title">REGISTRO</span>
                                        <span class="sub">Completado</span>
                                      </div>
                                    </div>

                                    <div style="padding:10px;border-radius:10px;background:linear-gradient(180deg,#fff,#fbfcff);border:1px solid rgba(18,32,80,0.03)">
                                      <div class="caps">Estado</div>
                                      <div class="muted" style="margin-top:6px">Registrado · Fecha: <strong>2025-08-20</strong></div>
                                    </div>
                                  </div>
                                </div>

                                <!-- right column -->
                                <div class="right">
                                  <div class="card-header">
                                    <div>
                                      <div class="id-title">Delivery</div>
                                      <div class="meta" id="cardCorreo">Formato digital</div>
                                    </div>

                                    <div class="qr" aria-hidden="true">
                                      <div style="text-align:right">
                                        <div class="muted">Tipo</div>
                                        <div style="font-weight:700;color:#13284f">ADDRESS</div>
                                      </div>
                                      <div class="barcode" role="img" aria-hidden="true"></div>
                                    </div>
                                  </div>

                                  <section class="fields" aria-labelledby="datos-personales">
                                    <!-- Nombre -->
                                    <div class="field">
                                      <label class="label" for="nombre">Nombre completo</label>
                                      <div id="cardNombre" class="value">-</div>
                                    </div>

                                    <!-- DNI -->
                                    <div class="field">
                                      <label class="label" for="dni">DNI</label>
                                      <div id="cardDni" class="value">09512345</div>
                                    </div>

                                    <!-- Direccion full width -->
                                    <div class="field full">
                                      <label class="label" for="direccion">Dirección</label>
                                      <div id="cardDireccion" class="value">-</div>
                                    </div>

                                    <!-- Celular -->
                                    <div class="field">
                                      <label class="label" for="cel">Número de celular</label>
                                      <div class="value" id="cardCelular">-</div>
                                    </div>

                                    <!-- distrito / provincia / departamento as triplet -->
                                    <div class="triplet" style="grid-column:1 / -1;">
                                      <div class="field">
                                        <label class="label">Distrito</label>
                                        <div class="value" id="cardDistrito">Miraflores</div>
                                      </div>
                                      <div class="field">
                                        <label class="label">Provincia</label>
                                        <div class="value" id="cardProvincia">Lima</div>
                                      </div>
                                      <div class="field">
                                        <label class="label">Departamento</label>
                                        <div class="value" id="cardCiudad">-</div>
                                      </div>
                                    </div>
                                  </section>

                                  <div class="footer">
                                    <div>Verificar informacion . Hacer clic para editar</div>
                                    <div class="muted">ID: <strong>AF-2025-000123</strong></div>
                                  </div>
                                </div>
                              </article>




                    </div>  

                  <div id="address">
                    <div class="form-group" style="margin-top:50px">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email"  id ="email" name="email" class="form-input" value="" placeholder="tu@email.com">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nombres</label>
                            <input type="text" id="nombres" name="nombres" class="form-input" placeholder="Ingresa tu nombre">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Apellidos</label>
                            <input type="text" id="apellidos" name="apellidos" class="form-input" placeholder="Ingresa tus apellidos">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">DNI / CE</label>
                            <input type="text" id="dni" name="dni" class="form-input" value="" placeholder="Documento" inputmode="numeric" maxlength="8" pattern="\d{8}" oninput="this.value = this.value.replace(/\D/g,'').slice(0,8)">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Celular</label>
                            <input type="tel" id="celular" name="celular"   class="form-input" placeholder="999 999 999">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Dirección</label>
                        <input type="text" id="direccion" name="direccion" class="form-input" placeholder="Calle, número, urbanización">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Ciudad</label>
                            
                            <select name="ciudad" id="ciudad" name="ciudad" class="form-input" style="border-radius:5px" onchange="cambia()" required>
                                <option value="">Seleccione una opcion</option>
                                      <option value="Lima">Lima</option>                
                                      <option value="Amazonas">Amazonas</option>
                                      <option value="Ancash">Ancash</option>
                                      <option value="Apurimac">Apurimac</option>
                                      <option value="Arequipa">Arequipa</option>
                                      <option value="Ayacucho">Ayacucho</option>
                                      <option value="Cajamarca">Cajamarca</option>
                                      <option value="Cusco">Cusco</option>
                                      <option value="Huancavelica">Huancavelica</option>
                                      <option value="Huanuco">Huanuco</option>
                                      <option value="Ica">Ica</option>
                                      <option value="Junin">Junin</option>
                                      <option value="La_Libertad">La Libertad</option>
                                      <option value="Lambayeque">Lambayeque</option>
                                      <option value="Loreto">Loreto</option>
                                      <option value="Madre_de_Dios">Madre de Dios</option>
                                      <option value="Moquegua">Moquegua</option>
                                      <option value="Pasco">Pasco</option>
                                      <option value="Piura">Piura</option>
                                      <option value="Pasco">Pasco</option>
                                      <option value="Piura">Piura</option>
                                      <option value="Puno">Puno</option>
                                      <option value="San_Martin">San Martin</option>
                                      <option value="Tacna">Tacna</option>
                                      <option value="Tumbes">Tumbes</option>
                                      <option value="Ucayali">Ucayali</option>      
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Provincia</label>
                            <select name="provincia" id="provincia" class="form-input" style="border-radius:5px" onchange="cambiaDistrito()" required>
                              <option value="">Provincia</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Distrito</label>
                            <select name="distrito" id="distrito" class="form-input" style="border-radius:5px" required>
                              <option value="">Distrito</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" name="referencia">Referencias (Opcional)</label>
                        <input type="text" class="form-input" id="referencia" name="referencia" placeholder="Entre calles, frente a, cerca de...">
                    </div>

                    <!-- Botón/aviso gris (inicial) -->
                    <div id="rowGuardarGris" style="width:100%;display:flex;flex-direction:row;padding:20px;justify-content:right;">
                      <h5 style="background: #949494;width: 200px;padding: 12px 15px;border-radius: 5px; color: white; text-align: center;">
                        Guardar datos para envio
                      </h5>
                    </div>

                    <!-- Botón ROJO (cuando todo está válido) -->
                    <div id="rowGuardarRojo" style="display:none;width:100%;display:flex;flex-direction:row;padding:20px;justify-content:right;">
                      <button id="btnGuardarEnabled" type="button"
                              style="background: #e53935;width: 200px;padding:12px 15px;border-radius: 5px; color: white; text-align: center; cursor:pointer;border:none;">
                        Guardar datos para envio
                      </button>
                    </div>
                  </div>              
                </div>
                </form>
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

                    <!-- Coupon -->
                    

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
                    <div class="action-buttons" id="pagando">
                        <a href="{{asset('carto/delivery')}} " class="btn btn-secondary">← Volver</a>
                        <a href="{{asset('pasarela/pagos')}} "  class="btn btn-primary">
                            Pagar
                            <span style="margin-left: 10px;">→</span>
                            </a>
                    </div>

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
        // Delivery Option Selection
        document.querySelectorAll('.delivery-option').forEach(option => {
            option.addEventListener('click', function() {
                document.querySelectorAll('.delivery-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });

        // Form Validation Highlights
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.value.trim() === '' && this.hasAttribute('required')) {
                    this.style.borderColor = '#f44336';
                } else {
                    this.style.borderColor = '#ddd';
                }
            });
        });

        // Continue Button Animation
        // Continue Button Animation
const btnPago = document.querySelector('.btn-primary');
if (btnPago) {
    btnPago.addEventListener('click', function(e) {
        e.preventDefault();
        this.classList.add('loading');
        this.innerHTML = '<span>Procesando...</span>';
        
        setTimeout(() => {
            this.classList.remove('loading');
            this.innerHTML = 'Continuar al Pago <span style="margin-left: 10px;">→</span>';
            window.location.href = "{{ asset('pasarela/pago') }}";
        }, 1500);
    });
}

// Coupon Application (solo si existe)
const btnCupon = document.querySelector('.coupon-btn');
if (btnCupon) {
    btnCupon.addEventListener('click', function() {
        const couponInput = document.querySelector('.coupon-input');
        if (couponInput && couponInput.value.trim() !== '') {
            this.textContent = '✓ Aplicado';
            this.style.background = '#4caf50';
            this.style.borderColor = '#4caf50';
            this.style.color = 'white';
            setTimeout(() => {
                this.textContent = 'Aplicar';
                this.style.background = 'white';
                this.style.borderColor = '#ea6666ff';
                this.style.color = '#ea6666ff';
                couponInput.value = '';
            }, 2000);
        }
    });
}

    </script>
    <script src="{{asset('js/district.js')}} "></script>
  <!-- ===== SCRIPT ===== -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const RUTA = "{{ route('cliente.carto.delivery') }}";

  // ================== helpers ==================
  // lee el descuento que ya está pintado en el DOM
  function leerDescuentoDOM() {
    const el = document.getElementById('cardDescuento');
    if (!el) return 0;

    let txt = (el.textContent || '').trim();
    if (!txt) return 0;

    // sacar "S/.", "S/", "soles", espacios, etc.
    // nos quedamos con el PRIMER número que aparezca
    const m = txt.replace(/,/g, '.').match(/-?\d+(\.\d+)?/);
    if (!m) return 0;

    const val = parseFloat(m[0]);
    return isNaN(val) ? 0 : Math.abs(val);
  }

  // ================== referencias DOM ==================
  const email         = document.getElementById('email');
  const ciudad        = document.getElementById('ciudad');
  const provincia     = document.getElementById('provincia');
  const distrito      = document.getElementById('distrito');
  const dni           = document.getElementById('dni');
  const nombres       = document.getElementById('nombres');
  const apellidos     = document.getElementById('apellidos');
  const celular       = document.getElementById('celular');
  const referencia    = document.getElementById('referencia');
  const direccion     = document.getElementById('direccion');

  const fEmail        = document.getElementById('f-email');
  const fEmailButton  = document.getElementById('f-email-button');

  const sectionTitle  = document.getElementById('section-title');
  const addEmailForm  = document.getElementById('add-email');
  const idCard        = document.getElementById('id-card');
  const addressSection= document.getElementById('address');
  const pagandoSection= document.getElementById('pagando');
  const deliveryForm  = document.getElementById('deliveryForm');
  const deliveryContent = document.getElementById('delivery-content');

  const recojoBtn     = document.getElementById('recojo');
  const deliveryBtn   = document.getElementById('delivery');

  // card
  const cardCorreo    = document.getElementById('cardCorreo');
  const cardDni       = document.getElementById('cardDni');
  const cardCelular   = document.getElementById('cardCelular');
  const cardNombre    = document.getElementById('cardNombre');
  const cardCiudad    = document.getElementById('cardCiudad');
  const cardProvincia = document.getElementById('cardProvincia');
  const cardDistrito  = document.getElementById('cardDistrito');
  const cardDireccion = document.getElementById('cardDireccion');
  const cardReferencia= document.getElementById('cardReferencia');
  const cardCosto     = document.getElementById('cardCosto');

  const rowGris       = document.getElementById('rowGuardarGris');
  const rowRojo       = document.getElementById('rowGuardarRojo');

  // resumen
  const subtotalEl    = document.getElementById('subtotal');
  const totalFinalEl  = document.getElementById('totalFinal');

  // ================== estado ==================
  let tipoSeleccionado = null;   // 0 = recojo, 1 = delivery
  let datosGuardados   = null;   // lo que viene del back en /cliente.carto.delivery
  let ultimoResumen    = null;   // lo que venga de /carto/resumen (subtotal, envio, descuento, total)

  // ================== funciones de UI ==================
  function emailOk(v) {
    return v && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
  }

  function inicializarUI() {
    if (sectionTitle)   sectionTitle.style.display   = 'none';
    if (addEmailForm)   addEmailForm.style.display   = 'none';
    if (idCard)         idCard.style.display         = 'none';
    if (addressSection) addressSection.style.display = 'none';
    if (pagandoSection) pagandoSection.style.display = 'none';
    if (deliveryContent)deliveryContent.style.display= 'none';
    agregarValidacionTiempoReal();
  }

  function actualizarBotones() {
    if (recojoBtn)   recojoBtn.classList.toggle('active', tipoSeleccionado === 0);
    if (deliveryBtn) deliveryBtn.classList.toggle('active', tipoSeleccionado === 1);
  }

  // 👇 esta es la clave: mostramos según tipo + según si está completo
  function actualizarUI() {
    if (tipoSeleccionado === 0) {
      // RECOJO
      if (addEmailForm)   addEmailForm.style.display   = 'block';
      if (sectionTitle)   sectionTitle.style.display   = 'none';
      if (idCard)         idCard.style.display         = 'none';
      if (addressSection) addressSection.style.display = 'none';
      if (deliveryContent)deliveryContent.style.display= 'block';

      const tieneEmailRecojo = datosGuardados && datosGuardados['f-email'];
      if (pagandoSection) {
        pagandoSection.style.display = tieneEmailRecojo ? 'flex' : 'none';
      }

    } else if (tipoSeleccionado === 1) {
      // DELIVERY
      if (addEmailForm)   addEmailForm.style.display   = 'none';
      if (sectionTitle)   sectionTitle.style.display   = 'block';
      if (deliveryContent)deliveryContent.style.display= 'block';

      const completo = datosGuardados &&
        emailOk(datosGuardados.email) &&
        datosGuardados.ciudad &&
        datosGuardados.provincia &&
        datosGuardados.distrito &&
        datosGuardados.dni && datosGuardados.dni.length === 8 &&
        datosGuardados.celular && datosGuardados.celular.length === 9 &&
        datosGuardados.nombres && datosGuardados.nombres.trim() &&
        datosGuardados.apellidos && datosGuardados.apellidos.trim() &&
        datosGuardados.direccion && datosGuardados.direccion.trim() &&
        datosGuardados.referencia && datosGuardados.referencia.trim();

      if (completo) {
        if (idCard)         idCard.style.display         = 'block';
        if (addressSection) addressSection.style.display = 'none';
        if (pagandoSection) pagandoSection.style.display = 'flex';
      } else {
        if (idCard)         idCard.style.display         = 'none';
        if (addressSection) addressSection.style.display = 'block';
        if (pagandoSection) pagandoSection.style.display = 'none';
      }
    }

    validarCamposDelivery();
    aplicarTipoAlResumen(); // 👈 recalcula total pero SIN volver a descontar
  }

  // ================== resumen ==================
  // pinta lo que viene del back y lo guarda en ultimoResumen
  function pintarResumen(s) {
    const num = v => Number(v || 0);

    const subtotal = num(s.subtotal);
    const envio    = num(s.envio);
    // si el back manda descuento, lo usamos, si no, usamos lo que ya haya en el DOM
    const descBack = (typeof s.descuento !== 'undefined') ? num(s.descuento) : 0;
    const descDom  = leerDescuentoDOM();
    const descuentoFinal = descBack > 0 ? descBack : descDom;

    // si el back ya trae total, lo usamos tal cual
    const totalBack = (typeof s.total !== 'undefined')
      ? num(s.total)
      : (subtotal - descuentoFinal + envio);

    // guardamos el resumen crudo
    ultimoResumen = {
      subtotal: subtotal,
      envio: envio,
      descuento: descuentoFinal,
      total: totalBack
    };

    // pintamos
    if (subtotalEl) {
      subtotalEl.textContent = `S/. ${subtotal.toFixed(2)}`;
    }
    if (cardCosto) {
      cardCosto.textContent = envio === 0 ? 'Gratis' : `S/. ${envio.toFixed(2)}`;
    }
    const descEl = document.getElementById('cardDescuento');
    if (descEl) {
      descEl.textContent = `- S/. ${descuentoFinal.toFixed(2)}`;
    }

    // 👇 ojo: NO pintamos directamente totalBack aquí, lo hará aplicarTipoAlResumen()
    aplicarTipoAlResumen();
  }

  // aplica el tipo (recojo/delivery) sobre el último resumen REAL del back
  function aplicarTipoAlResumen() {
    if (!ultimoResumen) {
      // si no tenemos nada del back aún, calculamos con lo que veamos
      recalcularTotalLocalDesdeDOM();
      return;
    }

    const { subtotal, envio, descuento } = ultimoResumen;
    let totalMostrar = 0;

    if (tipoSeleccionado === 0) {
      // RECOJO: envío siempre 0
      totalMostrar = subtotal - descuento;
      if (cardCosto) cardCosto.textContent = 'Gratis';
    } else {
      // DELIVERY: usamos el envío que vino del back (o 0 si no vino)
      const envioReal = Number(ultimoResumen.envio || 0);
      totalMostrar = subtotal - descuento + envioReal;
      if (cardCosto) {
        cardCosto.textContent = envioReal === 0 ? 'Gratis' : `S/. ${envioReal.toFixed(2)}`;
      }
    }

    if (totalFinalEl) {
      totalFinalEl.textContent = `S/. ${totalMostrar.toFixed(2)}`;
    }
  }

  // fallback si todavía no tenemos ultimoResumen
  function recalcularTotalLocalDesdeDOM() {
    const num = v => Number(v || 0);
    let subtotal = 0;
    if (subtotalEl) {
      const txt = subtotalEl.textContent.replace(/[^0-9,.\-]/g, '').replace(',', '.');
      subtotal = num(parseFloat(txt));
    }
    const descuento = leerDescuentoDOM();
    let envio = 0;
    if (tipoSeleccionado === 1 && cardCosto) {
      const txtEnv = cardCosto.textContent;
      if (!/gratis/i.test(txtEnv)) {
        envio = num(parseFloat(txtEnv.replace(/[^0-9,.\-]/g, '').replace(',', '.')));
      }
    }
    const total = subtotal - descuento + envio;
    if (totalFinalEl) {
      totalFinalEl.textContent = `S/. ${total.toFixed(2)}`;
    }
  }

  // pide resumen al back (GET)
  async function refrescarResumen(prefetched) {
    if (prefetched && typeof prefetched === 'object') {
      pintarResumen(prefetched);
      return;
    }

    const posibles = [
      "{{ route('carto.resumen') }}",
      "{{ url('carto/resumen') }}",
      window.location.pathname + '?summary=1'
    ].filter(Boolean);

    for (const url of posibles) {
      try {
        const res = await fetch(url, {
          headers: {
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest"
          },
          credentials: "same-origin"
        });
        if (!res.ok) continue;
        const j = await res.json();
        const s = j.summary || j;
        if (s && (s.subtotal !== undefined || s.total !== undefined)) {
          pintarResumen(s);
          return;
        }
      } catch (e) {
        // sigue con la siguiente
      }
    }
    // si ninguna ruta devolvió, al menos recalculamos con DOM
    recalcularTotalLocalDesdeDOM();
  }

  // ================== validación delivery ==================
  function validarCamposDelivery() {
    if (tipoSeleccionado !== 1) return;

    const campos = {
      email: email?.value?.trim(),
      nombres: nombres?.value?.trim(),
      apellidos: apellidos?.value?.trim(),
      dni: dni?.value?.trim(),
      celular: celular?.value?.trim(),
      direccion: direccion?.value?.trim(),
      ciudad: ciudad?.value,
      provincia: provincia?.value,
      distrito: distrito?.value,
      referencia: referencia?.value?.trim()
    };

    const emailValido = emailOk(campos.email);
    const completos =
      campos.nombres &&
      campos.apellidos &&
      campos.dni && campos.dni.length === 8 &&
      campos.celular && campos.celular.length === 9 &&
      campos.direccion &&
      campos.ciudad &&
      campos.provincia &&
      campos.distrito &&
      campos.referencia;

    const ok = emailValido && completos;

    if (rowGris) rowGris.style.display = ok ? 'none' : 'flex';
    if (rowRojo) rowRojo.style.display = ok ? 'flex' : 'none';
  }

  function agregarValidacionTiempoReal() {
    const campos = [email, nombres, apellidos, dni, celular, direccion, ciudad, provincia, distrito, referencia];
    campos.forEach(c => {
      if (!c) return;
      ['input', 'change', 'blur'].forEach(ev => {
        c.addEventListener(ev, () => {
          validarCamposDelivery();
          // si ya hay resumen, actualizamos vista
          aplicarTipoAlResumen();
        });
      });
    });
  }

  // ================== guardar datos (POST) ==================
  async function guardarDatos() {
    const meta  = document.querySelector('meta[name="csrf-token"]');
    const csrf  = meta ? meta.getAttribute('content') : (document.querySelector('#deliveryForm input[name="_token"]')?.value || '');
    if (!csrf) {
      alert('Falta CSRF token');
      return false;
    }

    const formData = new FormData();
    formData.append('_token', csrf);
    formData.append('tipo', String(tipoSeleccionado));

    if (tipoSeleccionado === 0) {
      if (fEmail && fEmail.value) {
        formData.append('f-email', fEmail.value);
      }
    } else {
      // delivery
      [email, ciudad, provincia, distrito, dni, celular, nombres, apellidos, direccion, referencia].forEach(campo => {
        if (campo && campo.value) {
          formData.append(campo.name || campo.id, campo.value);
        }
      });
    }

    const res = await fetch(RUTA, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrf,
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: formData,
      credentials: 'same-origin'
    });

    if (!res.ok) {
      console.error(await res.text());
      alert('No se pudo guardar');
      return false;
    }

    const json = await res.json();
    if (json.ok && json.delivery) {
      // si el back no mandó descuento pero en el DOM ya había uno, lo respetamos
      const domDesc = leerDescuentoDOM();
      if ((Number(json.delivery.descuento || 0) === 0) && domDesc > 0) {
        json.delivery.descuento = domDesc;
      }

      datosGuardados = json.delivery;
      actualizarCard(datosGuardados);
      actualizarUI();

      // ahora sincronizamos resumen
      await refrescarResumen(json.summary || json.resumen || json.cart || null);
      return true;
    }

    alert('No se pudo guardar');
    return false;
  }

  // ================== card ==================
  function actualizarCard(data) {
    if (!data) return;
    const emailMostrar = data['f-email'] || data.email || '—';
    if (cardCorreo)    cardCorreo.textContent    = emailMostrar;
    if (cardDni)       cardDni.textContent       = data.dni || '—';
    if (cardCelular)   cardCelular.textContent   = data.celular || '—';

    const nombreCompleto = [data.nombres, data.apellidos].filter(Boolean).join(' ');
    if (cardNombre)    cardNombre.textContent    = nombreCompleto || '—';
    if (cardCiudad)    cardCiudad.textContent    = data.ciudad || '—';
    if (cardProvincia) cardProvincia.textContent = data.provincia || '—';
    if (cardDistrito)  cardDistrito.textContent  = data.distrito || '—';
    if (cardDireccion) cardDireccion.textContent = data.direccion || '—';
    if (cardReferencia)cardReferencia.textContent= data.referencia || '—';

    // costo mostrado en la tarjeta, pero el que manda es el del resumen
    if (cardCosto) {
      if (data.tipo === 0 || Number(data.costo || 0) === 0) {
        cardCosto.textContent = 'Gratis';
      } else {
        cardCosto.textContent = `S/. ${Number(data.costo || 0).toFixed(2)}`;
      }
    }
  }

  // ================== listeners ==================
  if (recojoBtn) {
    recojoBtn.addEventListener('click', () => {
      tipoSeleccionado = 0;
      actualizarBotones();
      actualizarUI();
    });
  }

  if (deliveryBtn) {
    deliveryBtn.addEventListener('click', () => {
      tipoSeleccionado = 1;
      actualizarBotones();
      actualizarUI();
    });
  }

  if (fEmailButton) {
    fEmailButton.addEventListener('click', async (e) => {
      e.preventDefault();
      if (tipoSeleccionado !== 0) return;

      if (!fEmail || !emailOk(fEmail.value)) {
        alert('Ingresa un email válido');
        return;
      }

      const btnText = fEmailButton.querySelector('.button-text');
      fEmailButton.disabled = true;
      fEmailButton.classList.add('animating');

      setTimeout(() => {
        if (btnText) btnText.textContent = '✔ Guardado';
      }, 2000);

      const ok = await guardarDatos();

      setTimeout(() => {
        fEmailButton.classList.remove('animating');
        fEmailButton.disabled = false;
        if (btnText) btnText.textContent = 'Guardar';
      }, 800);

      if (ok) {
        // si fue recojo y ya hay mail → mostrar pagar
        if (pagandoSection) pagandoSection.style.display = 'flex';
        aplicarTipoAlResumen();
      }
    });
  }

  if (idCard) {
    idCard.addEventListener('click', () => {
      if (tipoSeleccionado === 1) {
        if (idCard)         idCard.style.display         = 'none';
        if (addressSection) addressSection.style.display = 'block';
        if (pagandoSection) pagandoSection.style.display = 'none';
      }
    });
  }

  if (deliveryForm) {
    deliveryForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (tipoSeleccionado === 1) {
        await guardarDatos();
      }
    });
  }

  const btnGuardarEnabled = document.getElementById('btnGuardarEnabled');
  if (btnGuardarEnabled) {
    btnGuardarEnabled.addEventListener('click', async (e) => {
      e.preventDefault();
      if (tipoSeleccionado === 1) {
        await guardarDatos();
      }
    });
  }

  // ================== carga inicial ==================
  async function cargarDatosIniciales() {
    try {
      const res = await fetch(RUTA, {
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        }
      });
      if (!res.ok) return;

      const json = await res.json();
      if (json.delivery) {
        datosGuardados = json.delivery;

        // si vino tipo, lo usamos
        if (typeof datosGuardados.tipo !== 'undefined') {
          tipoSeleccionado = parseInt(datosGuardados.tipo);
        } else {
          // si no vino, por defecto delivery
          tipoSeleccionado = 1;
        }

        // llenar inputs
        for (const [k, v] of Object.entries(datosGuardados)) {
          if (k === 'f-email') continue;
          const el = document.querySelector(`[name="${k}"]`);
          if (el && v) el.value = v;
        }
        if (datosGuardados['f-email'] && fEmail) {
          fEmail.value = datosGuardados['f-email'];
        }

        actualizarCard(datosGuardados);
        actualizarBotones();
        actualizarUI();

        // ahora pedimos resumen real
        await refrescarResumen(json.summary || json.resumen || json.cart || null);
      } else {
        // si no hay nada guardado, por defecto delivery pero oculto
        tipoSeleccionado = 1;
        actualizarBotones();
        actualizarUI();
        await refrescarResumen();
      }
    } catch (err) {
      console.error('Error cargando datos iniciales:', err);
      // al menos calculamos con DOM
      recalcularTotalLocalDesdeDOM();
    }
  }

  // init
  inicializarUI();
  cargarDatosIniciales();
});
</script>


@endsection
