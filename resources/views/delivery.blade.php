<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos Adler</title>
    @include ('global.icon')  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/pagos.css')}}">
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
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <a href="{{asset('/')}}"><div class="logo"><img src="{{asset('image/logo1_BN.png')}}" alt="" style="width:100px; filter: invert(1);"></div></a>
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
                    <a href="{{asset('adler-venta-detalle')}}" class="step-label"><div >Carrito</div></a>
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
                    
                    <form id="deliveryForm" method="POST" action="{{ route('cliente.delivery') }}">
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
                            
                            <select name="ciudad" id="ciudad" class="form-input" style="border-radius:5px" onchange="cambia()" required>
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
                    

                    <!-- Totals -->
                    <div class="summary-totals">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="subtotal">S/. {{ number_format($total, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Envío</span>
                            <span id="cardCosto" style="color: #4caf50; font-weight: 500;">
                                {{ $costo_envio > 0 ? 'S/. '.number_format($costo_envio,2) : 'Gratis' }}
                            </span>
                        </div>

                        @if($descuento > 0)
                            <div class="summary-row">
                                <span>Descuento</span>
                                <span id="cardDescuento" style="color: #f44336;">- S/. {{ number_format($descuento, 2) }}</span>
                            </div>
                        @else
                            <div class="summary-row" id="rowDescuento" style="display:none">
                                <span>Descuento</span>
                                <span id="cardDescuento" style="color: #f44336;">- S/. 0.00</span>
                            </div>
                        @endif

                        <div class="summary-row total">
                            <span>Total</span>
                            <span id="totalFinal">S/. {{ number_format($total_final, 2) }}</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons" id="pagando">
                        <a href="{{asset('adler-venta')}} " class="btn btn-secondary">← Volver</a>
                        <a href="{{asset('pago')}} "  class="btn btn-primary">
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
        document.querySelector('.btn-primary').addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.add('loading');
            this.innerHTML = '<span>Procesando...</span>';
            
            setTimeout(() => {
                this.classList.remove('loading');
                this.innerHTML = 'Continuar al Pago <span style="margin-left: 10px;">→</span>';
                window.location.href = "{{ asset('pago') }}";
            }, 1500);
        });

        
    </script>
    <script src="{{asset('js/district.js')}} "></script>
  <!-- ===== SCRIPT ===== -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  const RUTA = "{{ route('cliente.delivery') }}";

  // Inputs principales
  const email = document.getElementById('email');
  const ciudad = document.getElementById('ciudad');
  const provincia = document.getElementById('provincia');
  const distrito = document.getElementById('distrito');
  const dni = document.getElementById('dni');
  const nombres = document.getElementById('nombres');
  const apellidos = document.getElementById('apellidos');
  const celular = document.getElementById('celular');
  const referencia = document.getElementById('referencia');
  const direccion = document.getElementById('direccion');
  
  // Input para recojo
  const fEmail = document.getElementById('f-email');
  const fEmailButton = document.getElementById('f-email-button');

  // UI elementos principales 
  const sectionTitle = document.getElementById('section-title');
  const addEmailForm = document.getElementById('add-email');
  const idCard = document.getElementById('id-card');
  const addressSection = document.getElementById('address');
  const pagandoSection = document.getElementById('pagando');
  
  // Botones de selección
  const recojoBtn = document.getElementById('recojo');
  const deliveryBtn = document.getElementById('delivery');
  
  // Elementos del formulario delivery
  const deliveryForm = document.getElementById('deliveryForm');
  const deliveryContent = document.getElementById('delivery-content');

  // Card elementos para mostrar datos
  const cardCorreo = document.getElementById('cardCorreo');
  const cardDni = document.getElementById('cardDni');
  const cardCelular = document.getElementById('cardCelular');
  const cardNombre = document.getElementById('cardNombre');
  const cardCiudad = document.getElementById('cardCiudad');
  const cardProvincia = document.getElementById('cardProvincia');
  const cardDistrito = document.getElementById('cardDistrito');
  const cardDireccion = document.getElementById('cardDireccion');
  
  const cardCosto = document.getElementById('cardCosto');

  function leerDescuentoDOM() {
    // #cardDescuento suele ser "- S/. 15.00" o "S/. 15.00"
    const el = document.getElementById('cardDescuento');
    if (!el) return 0;
    const txt = el.textContent || '';
    // quito todo lo que no es número, punto o coma
    const num = txt.replace(/[^0-9,.\-]/g, '').replace(',', '.');
    const val = parseFloat(num);
    return isNaN(val) ? 0 : Math.abs(val);
    }

    function normalizaJs(s = '') {
    return s
      .toLowerCase()
      .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
      .replace(/[^a-z0-9\s]/g, '')
      .replace(/\s+/g, ' ')
      .trim();
  }

  function calcularCostoFront(data = {}) {
    const ci = normalizaJs(data.ciudad || '');
    const pr = normalizaJs(data.provincia || '');
    const di = normalizaJs(data.distrito || '');

    const base10 = [
      'san miguel','pueblo libre','magdalena','san isidro',
      'miraflores','san borja','lince','brena','lima'
    ];

    if (ci === 'lima' && pr === 'lima') {
      return base10.includes(di) ? 10 : 18;
    }
    return 29;
  }

  // Estado actual
  let tipoSeleccionado = null; // null = nada, 0 = recojo, 1 = delivery
  let datosGuardados = null; // Almacenar datos del servidor
 // Subtotal, Descuento y Total final (desde cookie)
const elSubtotal   = document.getElementById('subtotal');
const elDesc       = document.getElementById('cardDescuento');
const elTotalFinal = document.getElementById('totalFinal');
    // ¿tengo un delivery completo ya guardado?
  function tieneDeliveryCompleto(data) {
    if (!data) return false;
    return data.email && data.ciudad && data.provincia && data.distrito &&
           data.dni && data.dni.length === 8 &&
           data.celular && data.celular.length === 9 &&
           data.nombres && data.apellidos &&
           data.direccion ;
  }

  // pinta el resumen derecho (subtotal, descuento, envío, total)
          function pintarResumenDesde(data) {
          if (!data) data = {};

          // 1) subtotal
          const sub = Number(
            data.subtotal ??
            datosGuardados?.subtotal ??
            {{ $total ?? 0 }}
          );

          // 2) descuento
          const descDOM = leerDescuentoDOM(); // 👈 lo que ya se ve en pantalla
          let desc = 0;

          if (typeof data.descuento !== 'undefined') {
            const d = Number(data.descuento);
            if (d > 0) {
              // si el back sí mandó descuento > 0, le creemos al back
              desc = d;
            } else if (descDOM > 0) {
              // el back mandó 0, pero en el DOM había descuento → usamos DOM
              desc = descDOM;
            } else if (typeof (datosGuardados?.descuento) !== 'undefined') {
              // último fallback
              desc = Number(datosGuardados.descuento) || 0;
            }
          } else if (typeof (datosGuardados?.descuento) !== 'undefined' && Number(datosGuardados.descuento) > 0) {
            desc = Number(datosGuardados.descuento);
          } else {
            // no vino nada → lo que ve el usuario
            desc = descDOM;
          }

          // 3) costo envío
          const costo = Number(
            data.costo ??
            datosGuardados?.costo ??
            0
          );

          // pintar subtotal
          if (elSubtotal) {
            elSubtotal.textContent = 'S/. ' + sub.toFixed(2);
          }

          // pintar descuento
          const rowDesc = document.getElementById('rowDescuento');
          if (desc > 0) {
            if (rowDesc) rowDesc.style.display = 'flex';
            if (elDesc) elDesc.textContent = '- S/. ' + desc.toFixed(2);
          } else {
            if (rowDesc) rowDesc.style.display = 'none';
          }

          // pintar envío
          if (cardCosto) {
            cardCosto.textContent = costo > 0
              ? 'S/. ' + costo.toFixed(2)
              : 'Gratis';
          }

          // 4) total = sub - desc + envío
          const totalCalc = sub - desc + costo;
          if (elTotalFinal) {
            elTotalFinal.textContent = 'S/. ' + totalCalc.toFixed(2);
          }
        }


  // pequeño merge sin perder lo que ya vino del server
  function mergeDatos(nuevos) {
    datosGuardados = Object.assign({}, datosGuardados || {}, nuevos || {});
  }


  function emailOk(v) { 
    return v && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); 
  }

  function inicializarUI() {
    // Ocultar todo al inicio
    if (sectionTitle) sectionTitle.style.display = 'none';
    if (addEmailForm) addEmailForm.style.display = 'none';
    if (idCard) idCard.style.display = 'none';
    if (addressSection) addressSection.style.display = 'none';
    if (pagandoSection) pagandoSection.style.display = 'none';
    if (deliveryContent) deliveryContent.style.display = 'none';
    agregarValidacionTiempoReal();
  }

      function actualizarUI() {
        if (tipoSeleccionado === 0) {
          if (addEmailForm) addEmailForm.style.display = 'block';
          if (idCard) idCard.style.display = 'none';
          if (addressSection) addressSection.style.display = 'none';
          if (deliveryContent) deliveryContent.style.display = 'block';
          if (sectionTitle) sectionTitle.style.display = 'none';

          pintarResumenDesde({
            subtotal: datosGuardados?.subtotal,
            descuento: datosGuardados?.descuento,
            costo: 0
          });

          const tieneEmailRecojo = datosGuardados && datosGuardados['f-email'];
          if (pagandoSection) {
            pagandoSection.style.display = tieneEmailRecojo ? 'flex' : 'none';
          }

        } else if (tipoSeleccionado === 1) {
          if (addEmailForm) addEmailForm.style.display = 'none';
          if (sectionTitle) sectionTitle.style.display = 'block';

          const datosCompletos = tieneDeliveryCompleto(datosGuardados);

          if (datosCompletos) {
            if (idCard) idCard.style.display = 'block';
            if (pagandoSection) pagandoSection.style.display = 'flex';
            if (addressSection) addressSection.style.display = 'none';
          } else {
            if (idCard) idCard.style.display = 'none';
            if (pagandoSection) pagandoSection.style.display = 'none';
            if (addressSection) addressSection.style.display = 'block';
          }
          if (deliveryContent) deliveryContent.style.display = 'block';

          // pinta lo que haya
          pintarResumenDesde(datosGuardados || { costo: 0 });
        }

        validarCamposDelivery();
      }


  function actualizarBotones() {
    if (recojoBtn && deliveryBtn) {
      recojoBtn.classList.toggle('active', tipoSeleccionado === 0);
      deliveryBtn.classList.toggle('active', tipoSeleccionado === 1);
    }
  }

  function llenarInputs(data) {
    if (!data) return;
    
    // Llenar inputs normales
    for (const [key, value] of Object.entries(data)) {
      if (key === 'f-email') continue; // Manejar f-email por separado
      const element = document.querySelector(`[name="${key}"]`);
      if (element && value) element.value = value;
    }
    
    // Llenar f-email si existe
    if (data['f-email'] && fEmail) {
      fEmail.value = data['f-email'];
    }
    
    // Restaurar tipo si existe
    if (typeof data.tipo !== 'undefined') {
      tipoSeleccionado = parseInt(data.tipo);
      actualizarBotones();
    }
  }


  // Función para validar todos los campos del formulario de delivery
function validarCamposDelivery() {
    if (tipoSeleccionado !== 1) return; // Solo para delivery
    
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
    
    // Validar que todos los campos requeridos estén llenos
    const emailValido = emailOk(campos.email);
    const camposCompletos = campos.nombres && 
                           campos.apellidos && 
                           campos.dni && campos.dni.length === 8 &&
                           campos.celular && campos.celular.length === 9 &&
                           campos.direccion &&
                           campos.ciudad &&
                           campos.provincia &&
                           campos.distrito ;
    
    const todoValido = emailValido && camposCompletos;
    
    // Elementos de los botones
    const rowGris = document.getElementById('rowGuardarGris');
    const rowRojo = document.getElementById('rowGuardarRojo');
    
    if (todoValido) {
        // Mostrar botón rojo, ocultar gris
        if (rowGris) rowGris.style.display = 'none';
        if (rowRojo) rowRojo.style.display = 'flex';
    } else {
        // Mostrar botón gris, ocultar rojo
        if (rowGris) rowGris.style.display = 'flex';
        if (rowRojo) rowRojo.style.display = 'none';
    }
    }

    // Event listeners para validar en tiempo real
    function agregarValidacionTiempoReal() {
        const camposAValidar = [email, nombres, apellidos, dni, celular, direccion, ciudad, provincia, distrito, referencia];
        
        camposAValidar.forEach(campo => {
            if (campo) {
                campo.addEventListener('input', validarCamposDelivery);
                campo.addEventListener('change', validarCamposDelivery);
                campo.addEventListener('blur', validarCamposDelivery);
            }
        });
    }
    const btnGuardarEnabled = document.getElementById('btnGuardarEnabled');
  if (btnGuardarEnabled) {
      btnGuardarEnabled.addEventListener('click', async (e) => {
          e.preventDefault();
          
          if (tipoSeleccionado === 1) {
              // Aquí puedes agregar la animación también si quieres
              const guardado = await guardarDatos();
              // No necesitas hacer nada más, guardarDatos() ya actualiza la UI
          }
      });
  }
  function actualizarCard(data) {
    if (!data) return;

    // correo (si es recojo, usa f-email)
    const emailMostrar = data['f-email'] || data.email || '—';
    if (cardCorreo) cardCorreo.textContent = emailMostrar;

    if (cardDni) cardDni.textContent = data.dni ? data.dni : '—';
    if (cardCelular) cardCelular.textContent = data.celular ? data.celular : '—';

    const nombreCompleto = [data.nombres, data.apellidos].filter(Boolean).join(' ');
    if (cardNombre) cardNombre.textContent = nombreCompleto || '—';

    if (cardCiudad) cardCiudad.textContent = data.ciudad ? data.ciudad : '—';
    if (cardProvincia) cardProvincia.textContent = data.provincia ? data.provincia : '—';
    if (cardDistrito) cardDistrito.textContent = data.distrito ? data.distrito : '—';
    if (cardDireccion) cardDireccion.textContent = data.direccion ? data.direccion : '—';

    // envío
    if (cardCosto) {
        const costo = Number(data.costo || 0);
        cardCosto.textContent = costo > 0 ? `S/. ${costo.toFixed(2)}` : 'Gratis';
    }

    // resumen derecha
    if (typeof data.subtotal !== 'undefined') {
        const el = document.getElementById('subtotal');
        if (el) el.textContent = `S/. ${Number(data.subtotal).toFixed(2)}`;
    }

    if (typeof data.descuento !== 'undefined') {
        const rowDesc = document.getElementById('rowDescuento');
        const el = document.getElementById('cardDescuento');
        const desc = Number(data.descuento);
        if (desc > 0) {
            if (rowDesc) rowDesc.style.display = 'flex';
            if (el) el.textContent = `- S/. ${desc.toFixed(2)}`;
        } else {
            if (rowDesc) rowDesc.style.display = 'none';
        }
    }

    if (typeof data.total_complete !== 'undefined') {
        const el = document.getElementById('totalFinal');
        if (el) el.textContent = `S/. ${Number(data.total_complete).toFixed(2)}`;
    }
}


    async function guardarDatos(opciones = {}) {
    const meta = document.querySelector('meta[name="csrf-token"]');
    const csrf = meta ? meta.getAttribute('content')
                      : (document.querySelector('#deliveryForm input[name="_token"]')?.value || '');

    if (!csrf) {
      console.error('CSRF token no encontrado');
      alert('Error de seguridad: falta CSRF token.');
      return false;
    }

    const forzarTipo = typeof opciones.forzarTipo !== 'undefined'
      ? opciones.forzarTipo
      : null;
    const noLeerInputs = opciones.noLeerInputs === true;

    try {
      const formData = new FormData();
      formData.append('_token', csrf);

      // tipo final
      const tipoParaEnviar = forzarTipo !== null ? forzarTipo : tipoSeleccionado;
      formData.append('tipo', tipoParaEnviar.toString());

      if (tipoParaEnviar === 0) {
        // RECOJO: solo email de recojo si hay
        if (fEmail && fEmail.value) {
          formData.append('f-email', fEmail.value);
        }
      } else {
        // DELIVERY
        if (!noLeerInputs) {
          // leo del DOM
          const campos = [email, ciudad, provincia, distrito, dni, celular,
                          nombres, apellidos, direccion, referencia];
          campos.forEach(campo => {
            if (campo && campo.value) {
              formData.append(campo.name || campo.id, campo.value);
            }
          });
        } else {
          // no quiero leer inputs, uso lo que ya tenía
          if (datosGuardados) {
            Object.entries(datosGuardados).forEach(([k,v]) => {
              // no mandes estos porque el controller los recalcula
              if (['subtotal','descuento','neto','total_complete'].includes(k)) return;
              formData.append(k, v);
            });
          }
        }
      }

      const response = await fetch(RUTA, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': csrf,
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: formData,
        credentials: 'same-origin'
      });

      if (!response.ok) {
        const errorText = await response.text();
        console.error('POST no OK:', response.status, errorText);
        alert('No se pudo guardar (ver consola).');
        return false;
      }

      const json = await response.json();
      if (json.ok && json.delivery) {
        const domDesc = leerDescuentoDOM();
          if ((Number(json.delivery.descuento || 0) === 0) && domDesc > 0) {
            json.delivery.descuento = domDesc;
          }
        mergeDatos(json.delivery);
        // pinto card + resumen
        actualizarCard(datosGuardados);
        pintarResumenDesde(datosGuardados);
        // y actualizo la UI
        actualizarUI();
        return true;
      } else {
        alert('No se pudo guardar.');
        return false;
      }
    } catch (error) {
      console.error('Error en fetch:', error);
      alert('Error de red/JS (ver consola).');
      return false;
    }
  }


  // Event listeners para botones de tipo
    if (recojoBtn) {
    recojoBtn.addEventListener('click', async () => {
      tipoSeleccionado = 0;
      actualizarBotones();

      // 1) fuerza costo = 0 en UI
      const copia = Object.assign({}, datosGuardados || {}, {
        tipo: 0,
        costo: 0
      });
      pintarResumenDesde(copia);

      // 2) refresca paneles
      actualizarUI();

      // 3) opcional: persiste en el backend que ahora es RECOJO
      //    (para que el paso de pago ya encuentre tipo=0)
      await guardarDatos({ forzarTipo: 0 });
    });
  }

      if (deliveryBtn) {
        deliveryBtn.addEventListener('click', async () => {
          // 1) seteo estado
          tipoSeleccionado = 1;
          actualizarBotones();

          const hayDelivery = tieneDeliveryCompleto(datosGuardados);

          if (hayDelivery) {
            // 2) CALCULO el costo aquí mismo (igual que en PHP)
           const costoFront = calcularCostoFront(datosGuardados);
            const descDom = leerDescuentoDOM();

            datosGuardados = Object.assign({}, datosGuardados, {
              tipo: 1,
              costo: costoFront,
              descuento: (typeof datosGuardados?.descuento !== 'undefined')
                          ? datosGuardados.descuento
                          : descDom
            });


            // 4) pinto TODO al toque
            actualizarCard(datosGuardados);
            pintarResumenDesde(datosGuardados);
            actualizarUI();

            // 5) y recién sincronizo con el backend (este ya recalcula otra vez)
            try {
              await guardarDatos({ forzarTipo: 1, noLeerInputs: true });
            } catch (e) {
              console.warn('No se pudo sincronizar, pero el front ya pintó.', e);
            }

          } else {
            // no hay datos → solo muestra el form
            actualizarUI();
          }
        });
      }





  // Event listener para botón de email de recojo
  if (fEmailButton) {
    fEmailButton.addEventListener('click', async (e) => {
        e.preventDefault();
        
        if (tipoSeleccionado === 0) {
            if (!fEmail || !emailOk(fEmail.value)) {
                alert('Por favor ingrese un email válido con @');
                return;
            }
            // Elementos para animación
            const buttonText = fEmailButton.querySelector('.button-text');
            
            if (buttonText) {
                // Deshabilitar y animar
                fEmailButton.disabled = true;
                fEmailButton.classList.add('animating');
                
                // Cambiar texto
                setTimeout(() => {
                    buttonText.textContent = "✔ Guardado";
                }, 2000);
            }

            // Tu función existente (sin recargar)
            const guardado = await guardarDatos();
            
            // Reset de animación
            if (buttonText && guardado) {
                setTimeout(() => {
                    fEmailButton.classList.remove('animating');
                    fEmailButton.disabled = false;
                    buttonText.textContent = "Guardar";
                }, 800);
            }
        }
    });
}

  // Event listener para hacer click en id-card (mostrar address)
  if (idCard) {
    idCard.addEventListener('click', () => {
      if (tipoSeleccionado === 1) {
        if (idCard) idCard.style.display = 'none';
        if (addressSection) addressSection.style.display = 'block';
        if (pagandoSection) pagandoSection.style.display = 'none';
      }
    });
  }

  // Event listeners para formulario de delivery
  if (deliveryForm) {
    deliveryForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      if (tipoSeleccionado === 1) {
        const guardado = await guardarDatos();
        // No es necesario recargar, la UI se actualiza automáticamente
      }
    });
  }

  // Event listener para formulario de email (recojo)
  

  // Cargar datos existentes al iniciar
  async function cargarDatosIniciales() {
    try {
      const response = await fetch(RUTA, { 
        headers: { 
          'Accept': 'application/json', 
          'X-Requested-With': 'XMLHttpRequest' 
        } 
      });

      if (response.ok) {
        const json = await response.json();
        if (json.delivery) {
          datosGuardados = json.delivery;
          console.log(datosGuardados);
          llenarInputs(datosGuardados);
          actualizarCard(datosGuardados);
          
        }
      }
          // si la cookie ya traía tipo, úsalo
    if (datosGuardados && typeof datosGuardados.tipo !== 'undefined') {
        tipoSeleccionado = parseInt(datosGuardados.tipo);
      } else {
        tipoSeleccionado = 0; // por defecto recojo
      }

    // pinta resumen con lo que vino del server (subtotal, descuento, costo)
    pintarResumenDesde(datosGuardados);

    // y actualiza la UI para que ya se vea la opción
    actualizarUI();

    } catch (error) {
      console.error('Error cargando datos iniciales:', error);
    }
  }

  
  inicializarUI();
  cargarDatosIniciales();
});
</script>

</body>
</html>