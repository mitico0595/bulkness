{{-- resources/views/manual/manual1.blade.php --}}
<div data-manual-block="1" style="display:none;">

    {{-- PÁGINA 1: PORTADA --}}
    <section id="m1-portada" class="a6-page"
        style="background:radial-gradient(ellipse at center, hsla(2,68%,45%,1) 0%,hsla(359,61%,42%,1) 44%,hsla(356,58%,36%,1) 100%);color:#fff;">
        <div class="a6-inner" style="justify-content:center;align-items:center;text-align:center;gap:.5rem;">
            <div style="display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem;">
                <img src="{{asset('image/logo1_BN.webp')}}" alt="" style="width:100%">
            </div>
            <p style="letter-spacing:.35rem;font-size:.55rem;text-transform:uppercase;opacity:.45;margin:0;font-weight:bold">MANUAL DE EMERGENCIA</p>
            <div style="letter-spacing:.35rem;font-size:.55rem;text-transform:uppercase;opacity:.45;margin:0;font-weight:bold">ante desastres</div>
        </div>
        <div class="page-footer">1</div>
    </section>

    {{-- PÁGINA 2: NÚMEROS DE EMERGENCIA --}}
    <section id="m1-numeros" class="a6-page">
        <div class="a6-inner">
            <h2 style="font-size:1rem;margin-bottom:.4rem;color:#b10000;">Números de emergencia</h2>
            <p style="font-size:.68rem;opacity:.75;margin-bottom:.6rem;">Perú · Lima Metropolitana</p>

            <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.35rem;font-size:.7rem;">
                <li style="display:flex;justify-content:space-between;gap:1rem;">
                    <span>Policía Nacional del Perú (PNP)</span><strong>105</strong>
                </li>
                <li style="display:flex;justify-content:space-between;gap:1rem;">
                    <span>Cuerpo de Bomberos Voluntarios</span><strong>116</strong>
                </li>
                <li style="display:flex;justify-content:space-between;gap:1rem;">
                    <span>SAMU (Atención Médica de Urgencia)</span><strong>106</strong>
                </li>
                <li style="display:flex;justify-content:space-between;gap:1rem;">
                    <span>Ambulancias EsSalud</span><strong>117</strong>
                </li>
                <li style="display:flex;justify-content:space-between;gap:1rem;">
                    <span>Defensa Civil – INDECI</span><strong>115</strong>
                </li>
                <li style="display:flex;justify-content:space-between;gap:1rem;">
                    <span>Emergencia en desastres (mensajería)</span><strong>119</strong>
                </li>
                <li style="display:flex;justify-content:space-between;gap:1rem;">
                    <span>Policía de Carreteras</span><strong>110</strong>
                </li>
                <li style="display:flex;justify-content:space-between;gap:1rem;">
                    <span>Cruz Roja Perú</span><strong>(01) 266 0481</strong>
                </li>
            </ul>

            <div style="margin-top:.75rem;">
                <h3 style="font-size:.75rem;margin-bottom:.35rem;">Hospitales de emergencia (Lima)</h3>
                <div style="border:1px solid rgba(0,0,0,.08);border-radius:.4rem;overflow:hidden;">
                    <table style="width:100%;border-collapse:collapse;font-size:.62rem;">
                        <thead style="background:#fee2e2;">
                        <tr>
                            <th style="text-align:left;padding:.3rem .4rem;">Hospital</th>
                            <th style="text-align:left;padding:.3rem .4rem;">Zona</th>
                            <th style="text-align:left;padding:.3rem .4rem;">Teléfono</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="padding:.3rem .4rem;">José Casimiro Ulloa</td>
                            <td style="padding:.3rem .4rem;">Miraflores</td>
                            <td style="padding:.3rem .4rem;">(01) 204-0900</td>
                        </tr>
                        <tr style="background:rgba(0,0,0,.015);">
                            <td style="padding:.3rem .4rem;">Arzobispo Loayza</td>
                            <td style="padding:.3rem .4rem;">Cercado</td>
                            <td style="padding:.3rem .4rem;">(01) 614-4646</td>
                        </tr>
                        <tr>
                            <td style="padding:.3rem .4rem;">Dos de Mayo</td>
                            <td style="padding:.3rem .4rem;">Cercado</td>
                            <td style="padding:.3rem .4rem;">(01) 328-0028</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <p style="font-size:.6rem;opacity:.65;margin-top:.45rem;">
                    En sismo o tsunami estas líneas pueden saturarse. Usa punto de reunión.
                </p>
            </div>
        </div>
        <div class="page-footer">2</div>
    </section>

    {{-- PÁGINA 3: ÍNDICE --}}
<section id="m1-indice" class="a6-page">
    <div class="a6-inner" style="display:flex;flex-direction:column;gap:.35rem;">
        <h2 style="font-size:1.05rem;margin-bottom:.4rem;text-align:center;letter-spacing:.08em;margin-top:120px">ÍNDICE</h2>

        <div style="display:flex;flex-direction:column;gap:.25rem;text-align:center;font-size:.72rem;font-weight:600;">
            <div>PORTADA - 1</div>
            <div>NÚMEROS DE EMERGENCIA - 2</div>
            <div>ÍNDICE - 3</div>
            <div>INDICACIONES BÁSICAS - 4</div>
            <div>PRIMEROS AUXILIOS EXPRÉS - 5</div>
            <div>QUÉ HACER ANTE UN TERREMOTO - 6</div>
            <div>INCENDIO EN EL HOGAR - 7</div>
            <div>TSUNAMI U OLEAJE ANÓMALO - 8</div>
            <div>HUAICO, INUNDACIONES, LLUVIAS - 9</div>

            <div style="margin-top:.25rem;">PARTE II (CAMPING) - 10</div>
            <div>CAMPING Y SUPERVIVENCIA LIGERA - 11</div>
            <div>CAMPING Y SUPERVIVENCIA LIGERA (CONT.) - 12</div>

            <div style="margin-top:.25rem;">ANEXO: MOCHILA DE EMERGENCIA - 13</div>
            <div>ANEXO: TARJETA FAMILIAR - 14</div>
        </div>

        
    </div>
    <div class="page-footer">3</div>
</section>

     {{-- PÁGINA 4: INDICACIONES BÁSICAS --}}
<section id="m1-indicaciones" class="a6-page" >
    <div class="a6-inner" style="gap:.1rem">
        <div style="display:flex;gap:.6rem;align-items:center;">
            {{-- imagen/ícono --}}
            <div style="width:64px;height:64px;background:#fee2e2;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="38" height="38" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="12" r="9" stroke="#b10000" stroke-width="1.5"/>
                    <path d="M8 11.5h8" stroke="#b10000" stroke-width="1.4" stroke-linecap="round"/>
                    <path d="M8 15h4" stroke="#b10000" stroke-width="1.4" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Indicaciones básicas</h2>
                <p style="font-size:.62rem;opacity:.7;margin:0;">Orden para no paniquear.</p>
            </div>
        </div>

        {{-- ORDEN PRINCIPAL --}}
        <p style="font-size:.64rem;margin-top:.6rem;margin-bottom:.35rem;">
            1) Protégete. 2) Mira si hay heridos. 3) Sal por ruta segura. 4) Reúnete en punto acordado. 5) Comunica.
        </p>

        {{-- BLOQUE 1: QUÉ HACER --}}
        <ul style="font-size:.63rem;line-height:1.25;margin:.4rem 0 0 1rem;">
            <li>Ten un <strong>punto de reunión</strong>: puerta, esquina o parque cercano.</li>
            <li>En edificio usa <strong>escaleras</strong>, nunca ascensor.</li>
            <li>Si manejas, detente lejos de postes, puentes y muros viejos.</li>
            <li>No regreses por mochilas u objetos si no es seguro.</li>
        </ul>

        {{-- BLOQUE 2: ROLES RÁPIDOS --}}
        <div style="margin-top:.5rem;display:flex;gap:.4rem;">
            <div style="flex:1;display:flex;gap:.35rem;align-items:flex-start;">
                <div style="width:20px;height:20px;background:#0f172a;border-radius:7px;display:flex;align-items:center;justify-content:center;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14"></path><path d="m5 12 7-7 7 7"></path>
                    </svg>
                </div>
                <div style="font-size:.6rem;">
                    <strong>Adulto 1:</strong> saca a niños y mayores.
                </div>
            </div>
            <div style="flex:1;display:flex;gap:.35rem;align-items:flex-start;">
                <div style="width:20px;height:20px;background:#0f172a;border-radius:7px;display:flex;align-items:center;justify-content:center;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle><path d="M12 2v2"></path><path d="M12 20v2"></path>
                    </svg>
                </div>
                <div style="font-size:.6rem;">
                    <strong>Adulto 2:</strong> corta luz/gas si es seguro.
                </div>
            </div>
        </div>

        {{-- BLOQUE 3: PARA NIÑOS --}}
        <div style="margin-top:.5rem;background:#eff6ff;border-left:3px solid #0f172a;border-radius:.35rem;padding:.35rem .45rem;font-size:.58rem;">
            Para niños: “si tiembla me agacho, después camino con adulto, después digo dónde estoy”.
        </div>

        {{-- BLOQUE 4: CHECKLIST --}}
        <div style="margin-top:.45rem;display:flex;gap:.4rem;flex-wrap:wrap;">
            <div style="flex:1;min-width:115px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:.5rem;padding:.3rem .4rem;">
                <p style="font-size:.58rem;margin:0 0 .25rem 0;font-weight:600;">Checklist rápido</p>
                <p style="font-size:.56rem;margin:0;">☑ Teléfonos
                    <br>☑ Llaves
                    <br>☑ Mochila
                    <br>☑ Niño/mayor ubicado
                </p>
            </div>
            <div style="flex:1;min-width:115px;background:#fff7ed;border:1px solid #fed7aa;border-radius:.5rem;padding:.3rem .4rem;">
                <p style="font-size:.58rem;margin:0 0 .25rem 0;font-weight:600;">No hacer</p>
                <p style="font-size:.56rem;margin:0;">✖ No correr gritando
                    <br>✖ No usar ascensor
                    <br>✖ No llamar si no es urgente
                </p>
            </div>
        </div>

        {{-- TEXTO FINAL --}}
        <p style="font-size:.56rem;margin-top:.4rem;opacity:.7;">
            Guarda copia de DNI, contacta a 1 familiar fuera de la zona y mantén esta ruta pegada en la pared.
        </p>

        

        {{-- IMAGEN 2: PUNTO DE REUNIÓN --}}
        <div style="margin-top:.35rem;display:flex;gap:.4rem;align-items:flex-start;">
            <div style="width:148px;height:78px;display:flex;align-items:center;justify-content:center;">
                <img src="{{asset('image/manual/punto.png')}}" alt="planocasa" style="width:100%;max-height:80px;object-fit:contain;margin-top:.4rem;  border-radius: 6px; border: 1px dashed;">
           </div>
            <p style="flex:1;font-size:.54rem;margin:0;">
                Usen una impresion o sticker con esta imagen para mantener un punto de reunion ante un evento fortuito, recuerden identificar un punto seguro.
            </p>
        </div>
    </div>
    <div class="page-footer">4</div>
    </section>


    {{-- PÁGINA 5: PRIMEROS AUXILIOS EXPRÉS --}}
<section id="m1-primerosaux" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.6rem;align-items:center;">
            <div style="width:64px;height:64px;background:#fee2e2;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                    <rect x="3" y="5" width="18" height="14" rx="2.5" stroke="#b10000" stroke-width="1.5"/>
                    <path d="M12 9v6" stroke="#b10000" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M9 12h6" stroke="#b10000" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Primeros auxilios exprés</h2>
                <p style="font-size:.62rem;opacity:.7;margin:0;">ABCD en menos de 1 minuto.</p>
            </div>
        </div>

        <ol style="font-size:.65rem;line-height:1.25;margin:.6rem 0 0 1rem;">
            <li><strong>A.</strong> Abrir vía aérea (cabeza atrás, mentón arriba).</li>
            <li><strong>B.</strong> Mirar si respira. Si no, 2 ventilaciones.</li>
            <li><strong>C.</strong> 30 compresiones si no hay pulso.</li>
            <li><strong>D.</strong> Detectar hemorragias visibles.</li>
        </ol>

        <p style="font-size:.63rem;margin-top:.4rem;">
            <strong>Fractura:</strong> no enderezar. Inmovilizar con cartón o tabla y amarrar.
        </p>

        <p style="font-size:.63rem;margin-top:.3rem;">
            <strong>Crisis nerviosa:</strong> llevar a zona tranquila, hablar claro, no dar líquidos si está desorientada.
        </p>

        <p style="font-size:.6rem;margin-top:.3rem;">
            <strong>Kit mínimo:</strong> guantes, gasas, vendas elásticas, suero fisiológico, tijera punta roma.
        </p>

        <div style="margin-top:.35rem;background:#eff6ff;border-left:3px solid #0f172a;border-radius:.35rem;padding:.35rem .45rem;font-size:.6rem;">
            Niño inconsciente o adulto que no responde = llamar y empezar RCP. No esperar a que “se le pase”.
        </div>

        <div style="margin-top:.3rem;background:#fff7ed;border-left:3px solid #f97316;border-radius:.35rem;padding:.35rem .45rem;font-size:.6rem;">
            Llama si: sangrado que no cede, quemadura en cara/pecho, caída de altura, niño o gestante comprometidos, pérdida de conciencia.
        </div>
    </div>
    <div class="page-footer">5</div>
</section>

{{-- PÁGINA 6: QUÉ HACER ANTE UN TERREMOTO --}}
<section id="m1-terremoto" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.6rem;align-items:center;">
            <div style="width:64px;height:64px;background:#fee2e2;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none">
                    <path d="M3 20h18" stroke="#b10000" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M5 20 10 5l2.2 6 1.6-3.5L19 20" stroke="#b10000" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Terremoto</h2>
                <p style="font-size:.62rem;opacity:.7;margin:0;">“Me agacho, me cubro, me agarro”.</p>
            </div>
        </div>

        <h3 style="font-size:.64rem;margin-top:.5rem;margin-bottom:.25rem;">Si estás dentro</h3>
        <ul style="font-size:.64rem;line-height:1.25;margin-left:1rem;">
            <li>Refúgiate bajo mesa resistente o al lado de un mueble sólido.</li>
            <li>Aléjate de ventanas, espejos y vitrinas.</li>
            <li>Si hay humo/polvo, cúbrete nariz y boca.</li>
        </ul>

        <h3 style="font-size:.64rem;margin-top:.4rem;margin-bottom:.25rem;">Si estás fuera</h3>
        <ul style="font-size:.64rem;line-height:1.25;margin-left:1rem;">
            <li>No te pegues a muros ni postes.</li>
            <li>Evita cables y vidrios.</li>
        </ul>

        <h3 style="font-size:.64rem;margin-top:.4rem;margin-bottom:.25rem;">Si estás en vehículo</h3>
        <ul style="font-size:.63rem;line-height:1.2;margin-left:1rem;">
            <li>Detente en zona abierta.</li>
            <li>No estaciones bajo puentes ni al lado de muros.</li>
            <li>Permanece dentro hasta que pase lo fuerte.</li>
        </ul>

        <div style="margin-top:.35rem;background:#eff6ff;border-left:3px solid #0f172a;border-radius:.35rem;padding:.35rem .45rem;font-size:.6rem;">
            Costa: sismo fuerte + te cuesta mantenerte en pie = evacúa a zona alta sin esperar alarma.
        </div>

        <p style="font-size:.6rem;margin-top:.35rem;opacity:.75;">
            Checklist rápido: heridos, fuga de gas, electricidad, ruta de salida, punto de reunión.
        </p>
    </div>
    <div class="page-footer">6</div>
</section>

    {{-- PÁGINA 7: INCENDIO EN EL HOGAR --}}
    <section id="m1-incendio" class="a6-page">
        <div class="a6-inner">
            <div style="display:flex;gap:.6rem;align-items:center;">
                <div style="width:64px;height:64px;background:#fee2e2;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                        <path d="M12 3s1.5 2 1.5 3.8c0 1.3-.6 1.9-1.3 2.6-.8.7-1.7 1.6-1.7 3.6 0 1.9 1.4 3.5 3.5 3.5 2.1 0 3.5-1.6 3.5-3.5 0-1.7-.6-2.6-.6-3.7 0-2.2 1.1-3.3 1.1-3.3s-4.7-.6-6.5-2z" stroke="#b10000" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div>
                    <h2 style="font-size:.9rem;margin:0;">Incendio en el hogar</h2>
                    <p style="font-size:.62rem;opacity:.7;margin:0;">Salir, avisar, no volver.</p>
                </div>
            </div>

            <p style="font-size:.63rem;margin-top:.5rem;">
                1. Avisa a todos. 2. Corta luz/gas si está cerca. 3. Sal en fila agachada. 4. Reúnete afuera y pasa lista.
            </p>
            <p style="font-size:.63rem;margin-top:.5rem;">
                Si antes del incendio identificas una fuga de gas no enciendas nada, ni el celular, cualquier punto de ignicion puede generar una explosion.
            </p>
            <p style="font-size:.63rem;margin-top:.25rem;">
                Si el fuego es pequeño y tienes extintor ABC, úsalo. Si ya avanzó por techo o muebles, evacúa.
            </p>

            <ul style="font-size:.62rem;line-height:1.25;margin-top:.35rem;margin-left:1rem;">
                <li>Puerta caliente = no abrir.</li>
                <li>Humo denso = gatear.</li>
                <li>Cabello o ropa en llamas = parar, tirarse, rodar.</li>
            </ul>

            <div style="margin-top:.35rem;background:#fee2e2;border-left:3px solid #b10000;border-radius:.35rem;padding:.35rem .45rem;font-size:.6rem;">
                Practica salida con niños 1 vez al mes.
            </div>
        </div>
        <div class="page-footer">7</div>
    </section>

    {{-- PÁGINA 8: TSUNAMI U OLEAJE ANÓMALO --}}
<section id="m1-tsunami" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.6rem;align-items:center;">
            <div style="width:64px;height:64px;background:#e0f2fe;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none">
                    <path d="M3 16c1.2-.8 2.1-1.1 3.4-.3 1.2.7 2 .7 3.2 0 1.2-.8 2.2-.5 3.4.3 1 .6 1.7.8 2.7.2 1.2-.7 2.3-.5 3.3.2" stroke="#0f172a" stroke-width="1.3" stroke-linecap="round"/>
                    <path d="M13 5c1.6.2 3.1 1.4 3.1 3.5 0 1.4-.6 2.2-1.2 3" stroke="#0f172a" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Tsunami u oleaje</h2>
                <p style="font-size:.62rem;opacity:.7;margin:0;">Evacuar primero, preguntar después.</p>
            </div>
        </div>

        <h3 style="font-size:.64rem;margin-top:.5rem;margin-bottom:.25rem;">1. Antes (si vives en costa)</h3>
        <ul style="font-size:.62rem;line-height:1.25;margin-left:1rem;">
            <li>Ten identificada la ruta a zona alta (mín. 30 m o 3-4 cuadras).</li>
            <li>Guarda mochila ligera lista para cargar.</li>
            <li>Enséñale a la familia qué hacer si están separados.</li>
        </ul>

        <h3 style="font-size:.64rem;margin-top:.4rem;margin-bottom:.25rem;">2. Durante</h3>
        <ol style="font-size:.62rem;line-height:1.25;margin-left:1rem;">
            <li>Sismo fuerte en la costa = evacúa sin esperar sirena.</li>
            <li>Camina rápido, no corras, no uses auto (atascos).</li>
            <li>Aléjate de riberas, puentes y malecones.</li>
            <li>Ayuda a niños y adultos mayores primero.</li>
        </ol>

        <h3 style="font-size:.64rem;margin-top:.35rem;margin-bottom:.25rem;">3. Después</h3>
        <p style="font-size:.61rem;line-height:1.25;">
            Quédate en zona segura hasta que la autoridad diga que terminó la alerta.
            Pueden venir <strong>varias olas</strong> y la primera no siempre es la más grande.
        </p>

        <div style="margin-top:.35rem;background:#eff6ff;border-left:3px solid #0f172a;border-radius:.35rem;padding:.35rem .45rem;font-size:.58rem;">
            Explicación para niños: “el mar puede entrar, subimos al lugar alto, esperamos juntos y después bajamos”.
        </div>

        <p style="font-size:.58rem;margin-top:.3rem;opacity:.7;">
            Si estás en bote: aléjate mar adentro siguiendo indicaciones de capitanía; no vuelvas al muelle.
        </p>
    </div>
    <div class="page-footer">8</div>
</section>

{{-- PÁGINA 9: HUAICO, INUNDACIONES, LLUVIAS --}}
<section id="m1-huaico" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.6rem;align-items:center;">
            <div style="width:64px;height:64px;background:#fff7ed;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="34" height="34" viewBox="0 0 24 24" fill="none">
                    <path d="M4 5h16" stroke="#0f172a" stroke-width="1.3" stroke-linecap="round"/>
                    <path d="M6 5v3.5c0 .6-.2 1-.6 1.4L4 11.5" stroke="#0f172a" stroke-width="1.3" stroke-linecap="round"/>
                    <path d="M10 14c1.4-1 2.3-1.2 3.4-.4 1.1.8 2.1.9 3.6 0 1.2-.7 2.1-.6 3 .1" stroke="#0f172a" stroke-width="1.3" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Huaico, inundaciones</h2>
                <p style="font-size:.62rem;opacity:.7;margin:0;">Agua + lodo = te arrastra.</p>
            </div>
        </div>

        <h3 style="font-size:.63rem;margin-top:.5rem;margin-bottom:.25rem;">1. Si estás en casa</h3>
        <ul style="font-size:.62rem;line-height:1.25;margin-left:1rem;">
            <li>Sube documentos, medicinas y comida al nivel más alto.</li>
            <li>Desconecta electrodomésticos bajos.</li>
            <li>Si el agua entra con fuerza, evacúa a casa vecina más alta.</li>
        </ul>

        <h3 style="font-size:.63rem;margin-top:.35rem;margin-bottom:.25rem;">2. Si estás en la calle</h3>
        <ul style="font-size:.62rem;line-height:1.25;margin-left:1rem;">
            <li>No cruces si el agua pasa el tobillo y corre fuerte.</li>
            <li>Evita puentes pequeños o alcantarillas desbordadas.</li>
            <li>Aléjate del cauce: el huaico baja rápido y con piedras.</li>
        </ul>

        <h3 style="font-size:.63rem;margin-top:.35rem;margin-bottom:.25rem;">3. Si estás en auto</h3>
        <ul style="font-size:.6rem;line-height:1.2;margin-left:1rem;">
            <li>No intentes cruzar. 30 cm de agua pueden mover el vehículo.</li>
            <li>Detente en zona alta y espera que baje el nivel.</li>
        </ul>

        <div style="margin-top:.35rem;background:#fee2e2;border-left:3px solid #b10000;border-radius:.35rem;padding:.35rem .45rem;font-size:.58rem;">
            No acampar en quebradas secas, cauces ni al pie de cerros empapados. Si hay pronóstico de lluvia en sierra → evacua antes.
        </div>

        <p style="font-size:.56rem;margin-top:.3rem;opacity:.7;">
            Para niños: “el agua está fuerte, caminamos por arriba y esperamos al adulto”.
        </p>
    </div>
    <div class="page-footer">9</div>
</section>

{{-- PÁGINA X: PARTE II --}}
<section id="m1-parte2" class="a6-page">
    <div class="a6-inner" style="display:flex;flex-direction:column;justify-content:center;align-items:center;gap:.5rem;">
        <p style="letter-spacing:.35rem;font-size:.55rem;text-transform:uppercase;opacity:.45;margin:0;">MANUAL DE CAMPING</p>
        <h1 style="font-size:1.5rem;margin:0;color:#0f172a;">PARTE II</h1>
        <p style="font-size:.7rem;opacity:.7;text-align:center;max-width:240px;">
            Actividades al aire libre, camping responsable y qué llevar para no depender de la suerte.
        </p>

        <div style="width:168px;border-radius:.7rem;outline:1px dashed rgba(255,255,255,.35);display:flex;align-items:center;justify-content:center;text-align:center;color:white;font-size:.6rem;line-height:1.1;">
            <img src="{{asset('image/thumb/bagicon.png')}}" alt="" style="width:100%">
        </div>
        
    </div>
    <div class="page-footer">10</div>
</section>
{{-- PÁGINA X+1: CAMPING Y SUPERVIVENCIA LIGERA (1/2) --}}
<section id="m1-camping-1" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.55rem;align-items:center;">
            <div style="width:58px;height:58px;background:#dcfce7;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="#166534" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 20 7-12 7 12"></path>
                    <path d="M5 17h10"></path>
                    <path d="m14 9 2-3 2 3"></path>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.85rem;margin:0;">Camping y supervivencia ligera</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Ir al campo sin convertirlo en rescate.</p>
            </div>
        </div>

        <p style="font-size:.62rem;margin-top:.55rem;margin-bottom:.3rem;">
            Objetivo: pasar 1-3 días fuera con carga mínima pero segura.
        </p>

        {{-- Antes de salir --}}
        <p style="font-size:.6rem;font-weight:600;margin:.35rem 0 .25rem;">Antes de salir</p>
        <ul style="font-size:.6rem;line-height:1.25;margin:0 0 0 1rem;">
            <li>Avisa a alguien: destino, ruta y hora de regreso.</li>
            <li>Revisa clima y altura. Lleva capa si hay lluvia.</li>
            <li>Mapa o captura offline (no solo señal).</li>
        </ul>

        {{-- Equipo base --}}
        <p style="font-size:.6rem;font-weight:600;margin:.55rem 0 .25rem;">Equipo base (mínimo)</p>
        <div style="display:flex;gap:.4rem;flex-wrap:wrap;">
            <div style="flex:1;min-width:110px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:.45rem;padding:.3rem .4rem;">
                <p style="font-size:.58rem;margin:0 0 .25rem 0;font-weight:600;">Portar</p>
                <p style="font-size:.56rem;margin:0;">
                    • Mochila 20-30L<br>
                    • Agua 1-2 L<br>
                    • Snack denso<br>
                    • Navaja/multiusos
                </p>
            </div>
            <div style="flex:1;min-width:110px;background:#fff7ed;border:1px solid #fed7aa;border-radius:.45rem;padding:.3rem .4rem;">
                <p style="font-size:.58rem;margin:0 0 .25rem 0;font-weight:600;">Seguridad</p>
                <p style="font-size:.56rem;margin:0;">
                    • Linterna frontal<br>
                    • Encendedor x2<br>
                    • Silbato<br>
                    • Vendas/curitas
                </p>
            </div>
        </div>

        {{-- Reglas de oro --}}
        <p style="font-size:.6rem;font-weight:600;margin:.55rem 0 .25rem;">Reglas de oro</p>
        <ul style="font-size:.58rem;line-height:1.25;margin:0 0 0 1rem;">
            <li>Si alguien se queda atrás, todo el grupo se queda.</li>
            <li>No acampes en cauces secos ni al pie de quebrada.</li>
            <li>Si oscurece y no ves la ruta, te quedas y señalas.</li>
        </ul>

        {{-- Imagen 1 --}}
        <div style="margin-top:.45rem;display:flex;gap:.4rem;align-items:center;justify-content:center">
            <div style="width:148px;border-radius:.6rem;outline:1px dashed rgba(255,255,255,.35);display:flex;align-items:center;justify-content:center;">
                <img src="{{asset('image/productos/kitbasic.webp')}}" alt="" style="width:100%">
            </div>
            <p style="font-size:12px">Usa nuestra mochila CAMPING</p>
            
        </div>
    </div>
    <div class="page-footer">11</div>
    

</section>
{{-- PÁGINA X+2: CAMPING Y SUPERVIVENCIA LIGERA (2/2) --}}
<section id="m1-camping2" class="a6-page">
    <div class="a6-inner">
        <h2 style="font-size:.8rem;margin:0 0 .2rem 0;">Camping y supervivencia ligera (cont.)</h2>
        <p style="font-size:.6rem;opacity:.7;margin:0 0 .4rem 0;">Operar si te quedas de noche o te pierdes.</p>

        {{-- Fuego --}}
        <p style="font-size:.6rem;font-weight:600;margin:.35rem 0 .2rem;">Fuego seguro</p>
        <ul style="font-size:.58rem;line-height:1.25;margin:0 0 0 1rem;">
            <li>Base de piedras o piso despejado.</li>
            <li>Nunca debajo de ramas secas.</li>
            <li>Apagar con agua y tierra hasta que esté frío.</li>
        </ul>

        {{-- Agua --}}
        <p style="font-size:.6rem;font-weight:600;margin:.55rem 0 .2rem;">Agua</p>
        <p style="font-size:.58rem;margin:0;">
            Hervir 3-5 min o usar pastillas. Evita tomar directo de quebradas con ganado.
        </p>

        {{-- Refugio rápido --}}
        <p style="font-size:.6rem;font-weight:600;margin:.55rem 0 .2rem;">Refugio rápido</p>
        <p style="font-size:.58rem;margin:0 0 .3rem 0;">
            Lona + soga + 2 puntos de apoyo. Piso aislado con hojas o mochila. Proteger del viento primero.
        </p>

        {{-- Señalización --}}
        <div style="margin-top:.4rem;background:#eff6ff;border-left:3px solid #0f172a;border-radius:.4rem;padding:.35rem .45rem;">
            <p style="font-size:.58rem;margin:0;">
                Señal de rescate: 3 silbidos seguidos o 3 destellos cada 30 s. Mantenerse en zona abierta.
            </p>
        </div>

        
    </div>
    <div class="page-footer">12</div>
</section>
{{-- PÁGINA X+3: ANEXO · MOCHILA DE EMERGENCIA --}}
<section id="m1-anexo-mochila" class="a6-page">
    <div class="a6-inner">
        <h2 style="font-size:.82rem;margin:0 0 .2rem 0;">ANEXO · Mochila de emergencia</h2>
        <p style="font-size:.6rem;opacity:.7;margin:0 0 .5rem 0;">Modelos disponibles.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(110px,1fr));gap:.4rem;">
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:.5rem;padding:.3rem .4rem;">
                <p style="font-size:.6rem;font-weight:600;margin:0 0 .15rem 0;">1. Básica</p>
                <p style="font-size:.55rem;margin:0;">Agua, barritas, linterna, curitas, silbato.</p>
            </div>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:.5rem;padding:.3rem .4rem;">
                <p style="font-size:.6rem;font-weight:600;margin:0 0 .15rem 0;">2. Esencial</p>
                <p style="font-size:.55rem;margin:0;">+ manta térmica, guantes, vendas, medicación ligera.</p>
            </div>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:.5rem;padding:.3rem .4rem;">
                <p style="font-size:.6rem;font-weight:600;margin:0 0 .15rem 0;">3. Camping</p>
                <p style="font-size:.55rem;margin:0;">+ cuerda, encendedores, poncho, foco recargable.</p>
            </div>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:.5rem;padding:.3rem .4rem;">
                <p style="font-size:.6rem;font-weight:600;margin:0 0 .15rem 0;">4. Médico</p>
                <p style="font-size:.55rem;margin:0;">Botiquín completo, soluciones, gasas estériles.</p>
            </div>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:.5rem;padding:.3rem .4rem;">
                <p style="font-size:.6rem;font-weight:600;margin:0 0 .15rem 0;">5. Supervivencia</p>
                <p style="font-size:.55rem;margin:0;">+ pastillas potabilizadoras, kit fuego, navaja, cinta.</p>
            </div>
        </div>

        <p style="font-size:.56rem;margin-top:.45rem;">
            Todas pensadas para 1 persona/72 h. Para familia multiplicar agua y alimentación.
        </p>

        <div style="margin-top:.4rem;display:flex;gap:.4rem;align-items:flex-start;">
            <div style="width:100%;height:78px;display:flex;align-items:center;justify-content:center;">
                <img src="{{asset('image/manual/mochilastodas.png')}}" alt="" style="width:100%;    border-radius: 17px; margin-top: 120px; border: 6px dashed #000000;">
            </div>
            
        </div>
    </div>
    <div class="page-footer">13</div>
</section>
{{-- PÁGINA X+4: ANEXO · TARJETA FAMILIAR --}}
<section id="anexo-tarjeta" class="a6-page">
    <div class="a6-inner">
        <h2 style="font-size:.82rem;margin:0 0 .2rem 0;">ANEXO · Tarjeta familiar</h2>
        <p style="font-size:.6rem;opacity:.7;margin:0 0 .45rem 0;">Para pegar en la mochila o cartera.</p>

        <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:.6rem;padding:.4rem .5rem;">
            <p style="font-size:.58rem;margin:0;"><strong>Familia:</strong> _____________</p>
            <p style="font-size:.58rem;margin:.15rem 0 0 0;"><strong>Dirección:</strong> __________________________</p>
            <p style="font-size:.58rem;margin:.15rem 0 0 0;"><strong>Punto de reunión:</strong> parque / colegio / esquina</p>
            <p style="font-size:.58rem;margin:.15rem 0 0 0;"><strong>Contacto 1:</strong> ( ) ___________</p>
            <p style="font-size:.58rem;margin:.15rem 0 0 0;"><strong>Contacto 2 (fuera de ciudad):</strong> ___________</p>
            <p style="font-size:.58rem;margin:.15rem 0 0 0;"><strong>Alergias / medicación:</strong> _______________</p>
        </div>

        <p style="font-size:.56rem;margin-top:.4rem;">
            Imprimir a color, laminar y colgar en la mochila de cada miembro. Enseñar a niños a decir “mi punto es ___”.
        </p>

        {{-- Imagen ejemplo tarjeta --}}
        <div style="margin-top:.35rem;display:flex;gap:.4rem;">
            <div style="width:100%;height:78px;display:flex;align-items:center;justify-content:center;">
                <img src="{{asset('image/manual/tarjetafamiliar.png')}}" alt="" style="width:100%;    border-radius: 17px; margin-top: 120px;">
            </div>
            
        </div>

        {{-- Imagen icono familia --}}
        
    </div>
    <div class="page-footer">14</div>
</section>

</div>
