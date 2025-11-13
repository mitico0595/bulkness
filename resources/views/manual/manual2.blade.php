{{-- resources/views/manual/manual2.blade.php --}}
<div data-manual-block="2" style="display:none;">

    {{-- PÁGINA 1: PORTADA ZOMBIE --}}
    <section id="m2-portada" class="a6-page"
        style="background:radial-gradient(ellipse at center, hsl(0deg 0% 0%) 0%, hsl(0deg 0% 6.22%) 44%, hsl(0deg 0% 0%) 100%);color:#fff;">
        <div class="a6-inner" style="justify-content:center;align-items:center;text-align:center;gap:.5rem;">
            <div style="display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem;">
                <img src="{{asset('image/logo1_BN.webp')}}" alt="" style="width:100%">
            </div>
            <p style="letter-spacing:.35rem;font-size:.55rem;text-transform:uppercase;opacity:.45;margin:0;font-weight:bold;color:white">MANUAL APOCALIPSIS ZOMBIE</p>
            <div style="letter-spacing:.35rem;font-size:.55rem;text-transform:uppercase;opacity:.45;margin:0;font-weight:bold;color:white">ante pandemias</div>
        </div>
        <div class="page-footer">1</div>
    </section>

    {{-- PÁGINA 2: ADVERTENCIA --}}
<section id="m2-advertencia" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#fef2f2;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M12 3 2 20h20L12 3Z" stroke="#b10000" stroke-width="1.4" stroke-linejoin="round"/>
                    <path d="M12 9v5" stroke="#b10000" stroke-width="1.4" stroke-linecap="round"/>
                    <circle cx="12" cy="15.5" r=".8" fill="#b10000"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Advertencia</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Uso para escenarios de colapso.</p>
            </div>
        </div>

        <div style="margin-top:.6rem;background:#fff7ed;border-left:3px solid #f97316;border-radius:.5rem;padding:.45rem .55rem;font-size:.6rem;line-height:1.3;">
            Esta guía <strong>no</strong> es oficial. Úsala solo cuando:
            <ol style="margin:.35rem 0 0 1.1rem;padding:0;font-size:.6rem;line-height:1.25;">
                <li>105 / 116 / 106 no responden o están saturadas.</li>
                <li>Los medios dan información confusa o contradictoria.</li>
                <li>Hay reportes de “mordidas” que vuelven agresiva a la víctima.</li>
            </ol>
        </div>

        <p style="font-size:.6rem;margin-top:.5rem;">Objetivos mínimos en las primeras 72 h:</p>
        <ol style="margin:.25rem 0 0 1.1rem;padding:0;font-size:.6rem;line-height:1.25;">
            <li>Proteger tu integridad y la de tu grupo inmediato.</li>
            <li>Evitar exposición a sangre, saliva o mordidas.</li>
            <li>Conseguir agua, comida y refugio silencioso.</li>
            <li>Definir un punto de reunión y un canal de comunicación.</li>
        </ol>

        <p style="font-size:.6rem;margin-top:.45rem;">Si confirmas un brote, procede así:</p>
        <ol style="margin:.25rem 0 0 1.1rem;padding:0;font-size:.6rem;line-height:1.25;">
            <li>Cierra accesos principales (puertas, rejas, ventanas bajas).</li>
            <li>Eleva tus recursos (piso 2 o azotea).</li>
            <li>Silencia teléfonos y radios (solo vibración).</li>
            <li>Revisa a todos por heridas/mordidas (brazos, cuello, piernas).</li>
            <li>Anota hora de cualquier herida sospechosa.</li>
        </ol>

        
    </div>
    <div class="page-footer">2</div>
</section>

    {{-- PÁGINA 3: ÍNDICE GENERAL --}}
<section id="m2-indice" class="a6-page">
    <div class="a6-inner" style="display:flex;flex-direction:column;gap:.35rem;">
        <h2 style="font-size:1.05rem;margin-bottom:.4rem;text-align:center;letter-spacing:.08em;margin-top:100px;">
            ÍNDICE
        </h2>

        <div style="display:flex;flex-direction:column;gap:.25rem;text-align:center;font-size:.72rem;font-weight:600;">
            <div>PORTADA - 1</div>
            <div>ADVERTENCIA - 2</div>
            <div>ÍNDICE - 3</div>
            <div>TIPOS DE BROTE / ZOMBIE - 4</div>
            <div>OTROS TIPOS DE ZOMBIE - 5</div>
            <div>FASES DEL APOCALIPSIS - 6</div>
            <div>COMUNICACIÓN Y MOVIMIENTO - 7</div>
            <div>KIT MÍNIMO 72 H - 8</div>
            <div>ALIMENTACIÓN Y AGUA - 9</div>
            <div>REFUGIOS Y LUGARES A EVITAR - 10</div>
            <div>CONTACTO CON OTROS GRUPOS - 11</div>
            <div>TABLA RÁPIDA - 12</div>

            <div style="margin-top:.25rem;">EXPANSIÓN 13</div>
            <div>PROTECCIÓN Y LIMPIEZA - 14</div>
            <div>DEFENSA PERIMETRAL - 15</div>
            <div>ESTABLECER COLONIA - 16</div>
        </div>

        
    </div>
    <div class="page-footer">3</div>
</section>


    {{-- PÁGINA 4: TIPOS DE BROTE/ZOMBIE --}}
<section id="m2-tipos" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#fee2e2;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M6 21v-5l3-3" stroke="#b10000" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M18 21v-5l-3-3" stroke="#b10000" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <circle cx="12" cy="8" r="3.3" stroke="#b10000" stroke-width="1.3"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Tipos de brote/zombie</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Identificar = sobrevivir.</p>
            </div>
        </div>

        <p style="font-size:.6rem;margin-top:.45rem;">
            Clasifica primero el <strong>comportamiento</strong> (lento / rápido / en grupo / sensible a sonido) y luego eliges táctica.
        </p>

        {{-- BLOQUE CLÁSICOS --}}
        <div style="background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.05);overflow:hidden;margin-top:.4rem;">
            <table style="width:100%;border-collapse:collapse;font-size:.58rem;">
                <thead style="background:#fee2e2;">
                    <tr>
                        <th style="text-align:left;padding:.25rem .4rem;">Variante</th>
                        <th style="text-align:left;padding:.25rem .4rem;">Comportamiento</th>
                        <th style="text-align:left;padding:.25rem .4rem;">Ref.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding:.28rem .4rem;font-weight:600;">Clásico lento</td>
                        <td style="padding:.28rem .4rem;">Torpe, caníbal, no corre, cabeza = off.</td>
                        <td style="padding:.28rem .4rem;">Romero, 1968</td>
                    </tr>
                    <tr style="background:rgba(0,0,0,.015);">
                        <td style="padding:.28rem .4rem;font-weight:600;">Infectado rápido</td>
                        <td style="padding:.28rem .4rem;">Corre, muerde, rabia viral.</td>
                        <td style="padding:.28rem .4rem;">Boyle, 2002</td>
                    </tr>
                    <tr>
                        <td style="padding:.28rem .4rem;font-weight:600;">Fúngico / parásito</td>
                        <td style="padding:.28rem .4rem;">Se guía por sonido, deformado.</td>
                        <td style="padding:.28rem .4rem;">Druckmann, 2013</td>
                    </tr>
                    <tr style="background:rgba(0,0,0,.015);">
                        <td style="padding:.28rem .4rem;font-weight:600;">Inteligente</td>
                        <td style="padding:.28rem .4rem;">Usa objetos, recuerda.</td>
                        <td style="padding:.28rem .4rem;">Romero, 1985</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- BLOQUE VARIANTES MODERNAS --}}
        <div style="margin-top:.45rem;background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.04);padding:.4rem .45rem;">
            <p style="font-size:.6rem;font-weight:600;margin:0 0 .25rem 0;">Variantes modernas (alto riesgo):</p>
            <ol style="margin:0 0 0 1.1rem;padding:0;font-size:.58rem;line-height:1.2;">
                <li><strong>Enjambre veloz:</strong> se mueven en masa, trepan y aplastan por cantidad. Defensa: altura, fuego, cerrar accesos. Ref.: <em>World War Z</em>, 2013.</li>
                <li><strong>Corredor asiático:</strong> similar a infectado rápido, pero con ataques en vagones/bus, reacciona a visión directa. Ref.: <em>Train to Busan</em>, 2016.</li>
                <li><strong>Jerárquico / alfa:</strong> horda obedece a 1 individuo más consciente; si eliminas al alfa, baja la agresividad. Ref.: <em>Army of the Dead</em>, 2021.</li>
                <li><strong>Niño-vector:</strong> pequeño, rápido, parece no infectado; altísimo riesgo porque rompe defensas sociales. Ref.: <em>The Girl with All the Gifts</em>, 2016.</li>
                <li><strong>Semiconsciente histórico:</strong> infectado que conserva recuerdos y caza de forma estratégica. Ref.: <em>Kingdom</em>, 2019.</li>
            </ol>
        </div>

        

        
    </div>
    <div class="page-footer">4</div>
</section>
{{-- PÁGINA 12: OTROS TIPOS (GALERÍA) --}}
<section id="m2-otros" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:50px;height:50px;background:#0f172a0d;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
                    <path d="M12 3 3 8v8l9 5 9-5V8l-9-5Z" stroke="#b10000" stroke-width="1.2" stroke-linejoin="round"/>
                    <path d="M9 12.5 11 14l4-4" stroke="#b10000" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Otros tipos</h2>
                <p style="font-size:.58rem;opacity:.7;margin:0;">Referencias visuales</p>
            </div>
        </div>

        <div style="margin-top:.55rem;display:grid;grid-template-columns:1fr 1fr;gap:.5rem;width:70%;margin:auto">
            {{-- 1. Chasqueador (The Last of Us) --}}
            <div style="background:#fff;border:1px solid rgba(0,0,0,.04);border-radius:.6rem;overflow:hidden;display:flex;flex-direction:column;">
                <div style="width:100%;aspect-ratio:3/4;background:#e2e8f0;display:flex;align-items:center;justify-content:center;font-size:.55rem;color:#475569;">
                    <img src="{{asset('image/manual/zombie3.png')}}" alt=""style="width:100%">
                </div>
                <div style="padding:.35rem .4rem;">
                    <div style="font-size:.6rem;font-weight:600;">Chasqueador</div>
                    <div style="font-size:.53rem;opacity:.7;">The Last of Us (2013 / 2023)</div>
                    
                </div>
            </div>

            {{-- 2. Rat King (TLOU Part II) --}}
            <div style="background:#fff;border:1px solid rgba(0,0,0,.04);border-radius:.6rem;overflow:hidden;display:flex;flex-direction:column;">
                <div style="width:100%;aspect-ratio:3/4;background:#e2e8f0;display:flex;align-items:center;justify-content:center;font-size:.55rem;color:#475569;">
                    <img src="{{asset('image/manual/zombie4.png')}}" alt=""style="width:100%">
                </div>
                <div style="padding:.35rem .4rem;">
                    <div style="font-size:.6rem;font-weight:600;">Rat King</div>
                    <div style="font-size:.53rem;opacity:.7;">The Last of Us Part II (2020)</div>
                   
                </div>
            </div>

            {{-- 3. Licker (Resident Evil) --}}
            <div style="background:#fff;border:1px solid rgba(0,0,0,.04);border-radius:.6rem;overflow:hidden;display:flex;flex-direction:column;">
                <div style="width:100%;aspect-ratio:3/4;background:#e2e8f0;display:flex;align-items:center;justify-content:center;font-size:.55rem;color:#475569;">
                    <img src="{{asset('image/manual/zombie5.png')}}" alt=""style="width:100%">
                </div>
                <div style="padding:.35rem .4rem;">
                    <div style="font-size:.6rem;font-weight:600;">Licker</div>
                    <div style="font-size:.53rem;opacity:.7;">Resident Evil (saga, 2002–)</div>
                    
                </div>
            </div>

            {{-- 4. Híbrida H5 (All of Us Are Dead) --}}
            <div style="background:#fff;border:1px solid rgba(0,0,0,.04);border-radius:.6rem;overflow:hidden;display:flex;flex-direction:column;">
                <div style="width:100%;aspect-ratio:3/4;background:#e2e8f0;display:flex;align-items:center;justify-content:center;font-size:.55rem;color:#475569;">
                    <img src="{{asset('image/manual/zombie6.png')}}" alt=""style="width:100%">
                </div>
                <div style="padding:.35rem .4rem;">
                    <div style="font-size:.6rem;font-weight:600;">Volátil nocturno </div>
                    <div style="font-size:.53rem;opacity:.7;">Dying Light (2015)</div>
                    
                </div>
            </div>
        </div>

        <p style="font-size:.52rem;opacity:.6;margin-top:.4rem;text-align:center;">
            Estas imágenes son solo referencia visual para reconocimiento rápido en campo.
        </p>
    </div>
    <div class="page-footer">5</div>
</section>


    {{-- PÁGINA 6: FASES DEL APOCALIPSIS --}}
<section id="m2-fases" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#eff6ff;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M4 7h16" stroke="#0f172a" stroke-width="1.2" stroke-linecap="round"/>
                    <path d="M4 12h10" stroke="#0f172a" stroke-width="1.2" stroke-linecap="round"/>
                    <path d="M4 17h6" stroke="#0f172a" stroke-width="1.2" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Fases del apocalipsis</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Del brote a la colonia.</p>
            </div>
        </div>

        {{-- opcional: fase 0 --}}
        <p style="font-size:.56rem;margin-top:.4rem;opacity:.75;">
            (0) Rumores / vigilancia: noticias raras, videos cortos, ataques aislados. Aún puedes moverte en ciudad.
        </p>

        <div style="margin-top:.35rem;display:flex;flex-direction:column;gap:.4rem;">
            <div style="background:#fff;border-radius:.5rem;border:1px solid rgba(0,0,0,.04);padding:.35rem .5rem;">
                <h3 style="font-size:.63rem;margin:0 0 .2rem 0;">1. Brote inicial</h3>
                <p style="font-size:.6rem;margin:0;">Info confusa. No exponerte. Reunir grupo, agua, botiquín, mapas.</p>
            </div>
            <div style="background:#fff;border-radius:.5rem;border:1px solid rgba(0,0,0,.04);padding:.35rem .5rem;">
                <h3 style="font-size:.63rem;margin:0 0 .2rem 0;">2. Caos / pánico</h3>
                <p style="font-size:.6rem;margin:0;">Saqueos, incendios, tráfico. Evita hospitales/comisarías. Escoge refugio 24–48 h.</p>
            </div>
            <div style="background:#fff;border-radius:.5rem;border:1px solid rgba(0,0,0,.04);padding:.35rem .5rem;">
                <h3 style="font-size:.63rem;margin:0 0 .2rem 0;">3. Colapso</h3>
                <p style="font-size:.6rem;margin:0;">Sin Estado. Sobrevive localmente. Células de 4–8, turnos de guardia, control de entradas.</p>
            </div>
            <div style="background:#fff7ed;border-radius:.5rem;border:1px solid rgba(248,113,113,.35);padding:.35rem .5rem;">
                <h3 style="font-size:.63rem;margin:0 0 .2rem 0;">4. Asentamiento</h3>
                <p style="font-size:.6rem;margin:0;">Agua estable, huerto, defensa perimetral, normas internas. Pensar en intercambio.</p>
            </div>
        </div>

        <p style="font-size:.54rem;margin-top:.35rem;">
            Señal de cambio de fase: <strong>cantidad de gente en la calle</strong>, <strong>respuestas oficiales</strong>, <strong>ruido nocturno</strong>.
        </p>

        <p style="font-size:.53rem;margin-top:.15rem;opacity:.7;">
            Error común: actuar como si siguiera la fase 1 cuando ya estás en fase 3 (te expones por ir “a comprar”).
        </p>

        
    </div>
    <div class="page-footer">6</div>
</section>


    {{-- PÁGINA 7: COMUNICACIÓN Y MOVIMIENTO --}}
<section id="m2-comunicacion" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#fef9c3;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M8 3v3a2 2 0 0 0 2 2h1l2 3v-3h1a2 2 0 0 0 2-2V3" stroke="#92400e" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 17h12" stroke="#92400e" stroke-width="1.2" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Comunicación y movimiento</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Menos ruido = más vida.</p>
            </div>
        </div>

        <ul style="font-size:.62rem;line-height:1.3;margin-top:.5rem;margin-left:1rem;">
            <li><strong>Señas preacordadas:</strong> mano arriba = stop; 2 toques = seguro; 3 toques = peligro.</li>
            <li><strong>Radio baja:</strong> volumen mínimo, mensajes de 5 palabras o menos (“llegamos azotea sur”).</li>
            <li><strong>Caminar en 2–3:</strong> más es ruidoso, menos es vulnerable.</li>
            <li><strong>Rutas escalonadas:</strong> si te siguen, cambia de altura (puentes, azoteas, pasadizos).</li>
            <li><strong>De noche:</strong> solo si conoces la zona o hay luna.</li>
        </ul>

        <p style="font-size:.58rem;margin-top:.4rem;">
            Patrón recomendado: <strong>punta</strong> (ve primero y marca), <strong>carga</strong> (lleva suministros), <strong>cierre</strong> (mira atrás).
        </p>

        <p style="font-size:.58rem;margin-top:.25rem;">
            Distracción segura: lanza piedra/lata en dirección contraria → te mueves cuando miran hacia el sonido.
        </p>

        <div style="margin-top:.4rem;background:#eff6ff;border-left:3px solid #0f172a;border-radius:.4rem;padding:.35rem .45rem;font-size:.58rem;">
            Evita armas de fuego en zonas urbanas cerradas. El disparo atrae zombis <em>y</em> grupos hostiles. Usa filo/contundente primero.
        </div>

        
    </div>
    <div class="page-footer">7</div>
</section>

    {{-- PÁGINA 8: KIT MÍNIMO 72 H --}}
<section id="m2-kit" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#dbeafe;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M5 19h14V9H5v10Z" stroke="#1d4ed8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M10 13h4" stroke="#1d4ed8" stroke-width="1.2" stroke-linecap="round"/>
                    <path d="M12 11v4" stroke="#1d4ed8" stroke-width="1.2" stroke-linecap="round"/>
                    <path d="M9 9V7a3 3 0 0 1 3-3v0a3 3 0 0 1 3 3v2" stroke="#1d4ed8" stroke-width="1.2" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Kit mínimo 72 h</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Portátil, silencioso, útil.</p>
            </div>
        </div>

        {{-- Grid principal --}}
        <div style="margin-top:.5rem;display:grid;grid-template-columns:1fr 1fr;gap:.4rem;">
            <div style="background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.04);padding:.35rem .4rem;font-size:.6rem;">
                <strong>Agua</strong>
                <p style="margin:.2rem 0 0 0;">2 L/día/persona. Pastillas o filtro.</p>
            </div>
            <div style="background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.04);padding:.35rem .4rem;font-size:.6rem;">
                <strong>Comida</strong>
                <p style="margin:.2rem 0 0 0;">Barras, latas, frutos secos, alto kcal.</p>
            </div>
            <div style="background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.04);padding:.35rem .4rem;font-size:.6rem;">
                <strong>Botiquín</strong>
                <p style="margin:.2rem 0 0 0;">Gasas, vendas, desinfectante, guantes.</p>
            </div>
            <div style="background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.04);padding:.35rem .4rem;font-size:.6rem;">
                <strong>Herramientas</strong>
                <p style="margin:.2rem 0 0 0;">Multiherramienta, linterna, encendedor.</p>
            </div>
        </div>

        {{-- Extras tácticos --}}
        <div style="margin-top:.45rem;display:grid;grid-template-columns:1fr 1fr;gap:.4rem;">
            <div style="background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.02);padding:.35rem .4rem;font-size:.58rem;">
                <strong>Documentos</strong>
                <p style="margin:.2rem 0 0 0;">DNI, efectivo, contactos, en ziplock.</p>
            </div>
            <div style="background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.02);padding:.35rem .4rem;font-size:.58rem;">
                <strong>Defensa</strong>
                <p style="margin:.2rem 0 0 0;">Contundente corto (bate corto / martillo).</p>
            </div>
        </div>

        <p style="font-size:.58rem;margin-top:.35rem;">
            Añade ropa gruesa (dificulta mordida), manta térmica, mapa físico y silbato para señal.
        </p>
        <p style="font-size:.56rem;opacity:.75;margin-top:.25rem;">
            Regla de peso: no más del <strong>15% de tu peso</strong> → si pesa más, quita algo.
        </p>

        <p style="font-size:.54rem;margin-top:.3rem;">
            Imagen sugerida: <em>“flat survival bug out bag, 72 hour kit, line drawing, labeled items, white background”</em>
        </p>

        <p style="font-size:.58rem;margin-top:.35rem;background:#eff6ff;border-left:3px solid #1d4ed8;border-radius:.35rem;padding:.3rem .4rem;">
            Usa nuestra <strong>mochila de emergencia KIT SURVIVOR</strong>, incrementarás posibilidad de supervivencia.
        </p>
    </div>
    <div class="page-footer">8</div>
</section>


   {{-- PÁGINA 9: ALIMENTACIÓN Y AGUA --}}
<section id="m2-alimentacion" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#ecfdf3;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M7 3v9" stroke="#166534" stroke-width="1.2" stroke-linecap="round"/>
                    <path d="M11 3v9" stroke="#166534" stroke-width="1.2" stroke-linecap="round"/>
                    <path d="M5 21h8" stroke="#166534" stroke-width="1.2" stroke-linecap="round"/>
                    <path d="M15 7c1.5.5 3 .5 4.5 0 0 6-1 9.5-4.5 11" stroke="#166534" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Alimentación y agua</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">No te enfermes por beber.</p>
            </div>
        </div>

        <ul style="font-size:.62rem;line-height:1.25;margin-top:.5rem;margin-left:1rem;">
            <li>Hervir el agua 2–3 min o usar filtro/tabletas.</li>
            <li>Prioriza enlatados, sellados, deshidratados.</li>
            <li>No comas carne expuesta o de origen desconocido.</li>
            <li>Ración mínima: 1 200–1 600 kcal/día en movimiento.</li>
            <li>Agua mínima: 1.5 L/día (ideal 2 L); con calor o fiebre, más.</li>
        </ul>

        <p style="font-size:.58rem;margin-top:.4rem;">
            Secuencia segura de consumo: <strong>1)</strong> agua → <strong>2)</strong> enlatados abiertos → <strong>3)</strong> secos → <strong>4)</strong> lo que puedas cocinar.
        </p>

        <div style="margin-top:.4rem;background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.03);overflow:hidden;">
            <table style="width:100%;border-collapse:collapse;font-size:.58rem;">
                <thead style="background:#dcfce7;">
                    <tr>
                        <th style="text-align:left;padding:.28rem .4rem;">Recurso</th>
                        <th style="text-align:left;padding:.28rem .4rem;">Duración</th>
                        <th style="text-align:left;padding:.28rem .4rem;">Riesgo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding:.25rem .4rem;">Agua embotellada</td>
                        <td style="padding:.25rem .4rem;">Alta</td>
                        <td style="padding:.25rem .4rem;">Bajo</td>
                    </tr>
                    <tr style="background:rgba(0,0,0,.015);">
                        <td style="padding:.25rem .4rem;">Río / acequia</td>
                        <td style="padding:.25rem .4rem;">Variable</td>
                        <td style="padding:.25rem .4rem;color:#b10000;">Alto</td>
                    </tr>
                    <tr>
                        <td style="padding:.25rem .4rem;">Latas</td>
                        <td style="padding:.25rem .4rem;">Media</td>
                        <td style="padding:.25rem .4rem;">Bajo</td>
                    </tr>
                    <tr style="background:rgba(0,0,0,.015);">
                        <td style="padding:.25rem .4rem;">Deshidratados</td>
                        <td style="padding:.25rem .4rem;">Media/alta</td>
                        <td style="padding:.25rem .4rem;">Bajo (si hay agua)</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p style="font-size:.56rem;margin-top:.35rem;">
            Vigilancia: sed intensa, boca seca, orina muy amarilla o poca = deshidratación → prioriza agua sobre comida.
        </p>

        
    </div>
    <div class="page-footer">9</div>
</section>


    {{-- PÁGINA 10: REFUGIOS Y LUGARES A EVITAR --}}
<section id="m2-refugios" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#e2e8f0;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M4 11 12 4l8 7" stroke="#0f172a" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 10v8h4v-4h4v4h4v-8" stroke="#0f172a" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Refugios y lugares a evitar</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Seguro ≠ vistoso.</p>
            </div>
        </div>

        {{-- buenos vs malos --}}
        <div style="margin-top:.55rem;display:grid;grid-template-columns:1fr 1fr;gap:.35rem;">
            <div style="background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.03);padding:.35rem .4rem;font-size:.6rem;">
                <strong>Buenos</strong>
                <ul style="margin:.35rem 0 0 1rem;">
                    <li>Pisos altos</li>
                    <li>Azoteas con escalera</li>
                    <li>Casas de 1 acceso</li>
                    <li>Locales industriales chicos</li>
                </ul>
            </div>
            <div style="background:#fee2e2;border-radius:.45rem;border:1px solid rgba(177,0,0,.2);padding:.35rem .4rem;font-size:.6rem;">
                <strong>Malos</strong>
                <ul style="margin:.35rem 0 0 1rem;">
                    <li>Hosp./malls</li>
                    <li>Comisarías</li>
                    <li>Túneles</li>
                    <li>Terminales / mercados</li>
                </ul>
            </div>
        </div>

        {{-- checklist de selección rápida --}}
        <p style="font-size:.58rem;margin-top:.4rem;">Checklist rápido de refugio:</p>
        <ol style="font-size:.58rem;line-height:1.25;margin-left:1.1rem;">
            <li>¿Tiene 2 vías de salida? (puerta + azotea / ventana alta)</li>
            <li>¿Puedes cerrar en menos de 1 min? (trancas, muebles, cuerdas)</li>
            <li>¿Hay agua cerca? (tanque, cisterna, acequia)</li>
            <li>¿Puedes observar la calle sin que te vean?</li>
        </ol>

        {{-- pasos de fortificación --}}
        <div style="margin-top:.4rem;background:#fff7ed;border-left:3px solid #f97316;border-radius:.4rem;padding:.35rem .45rem;font-size:.56rem;">
            <strong>Pasos de fortificación rápida (10–15 min):</strong>
            <ol style="margin:.25rem 0 0 1rem;">
                <li>Cerrar puerta principal con mueble pesado.</li>
                <li>Bloquear ventanas bajas con tablas/cartón/colchón.</li>
                <li>Hacer punto de observación en piso alto.</li>
                <li>Definir ruta de escape y dejarla libre.</li>
            </ol>
        </div>

        <p style="font-size:.56rem;margin-top:.35rem;">
            Mantén 1 refugio “caliente” (ocupado) y 1 “frío” (de respaldo) por si te encuentran.
        </p>

        
    </div>
    <div class="page-footer">10</div>
</section>

    {{-- PÁGINA 11: CONTACTO CON OTROS GRUPOS --}}
<section id="m2-contacto" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#f3e8ff;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <circle cx="9" cy="8" r="2.5" stroke="#6b21a8" stroke-width="1.2"/>
                    <circle cx="16" cy="12" r="2.5" stroke="#6b21a8" stroke-width="1.2"/>
                    <path d="M4 19c.4-2.2 2.2-3.7 4.5-3.7 1.3 0 2.4.4 3.3 1.2" stroke="#6b21a8" stroke-width="1.2" stroke-linecap="round"/>
                    <path d="M11.8 18.9c.5-.6 1.3-.9 2.2-.9 1.8 0 3.3 1 3.8 2.5" stroke="#6b21a8" stroke-width="1.2" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.9rem;margin:0;">Contacto con otros grupos</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Confía, pero verifica.</p>
            </div>
        </div>

        <ul style="font-size:.62rem;line-height:1.25;margin-top:.5rem;margin-left:1rem;">
            <li>Acércate visible, manos libres, sin apuntar.</li>
            <li>Pide ver brazos, cuello y piernas (mordidas ocultas).</li>
            <li>No des ubicación real en el 1er contacto.</li>
            <li>Ofrece intercambio pequeño (agua, info, vendas) para mostrar intención.</li>
        </ul>

        <p style="font-size:.58rem;margin-top:.35rem;">Cómo no dar tu ubicación real:</p>
        <ol style="font-size:.58rem;line-height:1.25;margin-left:1.1rem;">
            <li>Di un punto de referencia amplio (“al sur del mercado”, “cerca del by-pass”).</li>
            <li>Usa un lugar neutro para la 1ra reunión (plaza chica, azotea, puente).</li>
            <li>Llega 10–15 min antes y observa si vienen más de los que dijeron.</li>
            <li>Si vienen armados o demasiados, te retiras sin mostrar de dónde llegaste.</li>
        </ol>

        <div style="margin-top:.4rem;background:#fff7ed;border-left:3px solid #f97316;border-radius:.4rem;padding:.35rem .45rem;font-size:.58rem;">
            Si no hay reglas claras, el grupo se vuelve peligroso. Define mínimo:
            <ol style="margin:.25rem 0 0 1rem;">
                <li>Guardia 24/7 (turnos de 2 h).</li>
                <li>Reparto de comida según trabajo.</li>
                <li>Castigo por robar o atraer zombis.</li>
            </ol>
        </div>

        <p style="font-size:.56rem;margin-top:.35rem;">
            Señal de grupo hostil: no muestran mochilas, no enseñan brazos, preguntan demasiado por tu refugio.
        </p>

        
    </div>
    <div class="page-footer">11</div>
</section>


   {{-- PÁGINA 12: TABLA RÁPIDA --}}
<section id="m2-tabla" class="a6-page">
    <div class="a6-inner">
        <h2 style="font-size:.9rem;margin-bottom:.4rem;">Tabla rápida</h2>

        <div style="background:#fff;border-radius:.5rem;border:1px solid rgba(0,0,0,.03);overflow:hidden;">
            <table style="width:100%;border-collapse:collapse;font-size:.58rem;">
                <thead style="background:#fee2e2;">
                    <tr>
                        <th style="padding:.3rem .4rem;text-align:left;">HACER</th>
                        <th style="padding:.3rem .4rem;text-align:left;">EVITAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding:.28rem .4rem;">Apuntar a la cabeza</td>
                        <td style="padding:.28rem .4rem;">Disparar al torso</td>
                    </tr>
                    <tr style="background:rgba(0,0,0,.015);">
                        <td style="padding:.28rem .4rem;">Moverse de día</td>
                        <td style="padding:.28rem .4rem;">Explorar de noche sin mapa</td>
                    </tr>
                    <tr>
                        <td style="padding:.28rem .4rem;">Viajar ligero</td>
                        <td style="padding:.28rem .4rem;">Cargar demasiado</td>
                    </tr>
                    <tr style="background:rgba(0,0,0,.015);">
                        <td style="padding:.28rem .4rem;">Purificar agua</td>
                        <td style="padding:.28rem .4rem;">Beber agua sucia</td>
                    </tr>
                    <tr>
                        <td style="padding:.28rem .4rem;">Fortificar con salida</td>
                        <td style="padding:.28rem .4rem;">Encerrarse sin escape</td>
                    </tr>
                    <tr style="background:rgba(0,0,0,.015);">
                        <td style="padding:.28rem .4rem;">Revisar mordidas al entrar</td>
                        <td style="padding:.28rem .4rem;">Dejar entrar sin revisión</td>
                    </tr>
                    <tr>
                        <td style="padding:.28rem .4rem;">Rotar guardias</td>
                        <td style="padding:.28rem .4rem;">Quedarte solo vigilando</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- segunda tarjeta: señales --}}
        <div style="margin-top:.45rem;background:#eff6ff;border-left:3px solid #0f172a;border-radius:.4rem;padding:.35rem .45rem;font-size:.56rem;">
            <strong>Señales rápidas:</strong>
            <ol style="margin:.25rem 0 0 1rem;">
                <li>2 toques = zona limpia.</li>
                <li>3 toques = peligro / horda.</li>
                <li>Cruz en puerta = no entrar / infectado.</li>
            </ol>
        </div>

        <p style="font-size:.53rem;margin-top:.35rem;opacity:.7;">
            Imprímela o guárdala en el celular offline. Úsala para instruir a niños o personas nuevas.
        </p>
        
    </div>
    <div class="page-footer">12</div>
</section>
{{-- PÁGINA 13: EXPANSIÓN --}}
<section id="m2-expansion" class="a6-page">
    <div class="a6-inner" style="display:flex;flex-direction:column;justify-content:center;align-items:center;gap:.55rem;">
        <p style="letter-spacing:.35rem;font-size:.55rem;text-transform:uppercase;opacity:.45;margin:0;">MANUAL DE EXPANSIÓN</p>
        <h1 style="font-size:1.45rem;margin:0;color:#0f172a;">PARTE II</h1>
        <p style="font-size:.7rem;opacity:.7;text-align:center;max-width:240px;margin:0;">
            Contenidos opcionales para grupos establecidos y defensa prolongada.
        </p>

        <div style="width:168px;border-radius:.7rem;;display:flex;align-items:center;justify-content:center;text-align:center;">
            
            <div style="width:100%;aspect-ratio:3/2;border-radius:.65rem;display:flex;align-items:center;justify-content:center;font-size:.55rem;color:#475569;">
                <img src="{{asset('image/manual/expand.png')}}" alt="" style="width:100%">
            </div>
        </div>

        
    </div>
    <div class="page-footer">13</div>
</section>

{{-- PÁGINA 14: PROTECCIÓN Y LIMPIEZA --}}
<section id="m2-proteccion" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#ecfdf3;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M12 3 5 6v5c0 3.5 2.8 5.9 7 8 4.2-2.1 7-4.5 7-8V6l-7-3Z" stroke="#166534" stroke-width="1.25" stroke-linejoin="round"/>
                    <path d="M10 12.5 11.7 14 15 10.5" stroke="#166534" stroke-width="1.15" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.88rem;margin:0;">Protección y limpieza</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Evitar infección secundaria.</p>
            </div>
        </div>

        <p style="font-size:.6rem;margin-top:.45rem;">
            Meta: que nadie muera por una herida tonta o por no lavarse.
        </p>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.35rem;margin-top:.4rem;">
            <div style="background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.03);padding:.35rem .4rem;font-size:.58rem;">
                <strong>Equipo básico</strong>
                <ol style="margin:.25rem 0 0 1rem;">
                    <li>Guantes.</li>
                    <li>Mascarilla.</li>
                    <li>Bolsas rojas.</li>
                    <li>Cloro/jabón.</li>
                </ol>
            </div>
            <div style="background:#fff7ed;border-radius:.45rem;border:1px solid rgba(248,113,113,.25);padding:.35rem .4rem;font-size:.58rem;">
                <strong>Fluidossospechosos</strong>
                <ol style="margin:.25rem 0 0 1rem;">
                    <li>No tocar sin guantes.</li>
                    <li>Rociar cloro 0.5%.</li>
                    <li>Quemar trapos usados.</li>
                </ol>
            </div>
        </div>

        <p style="font-size:.6rem;margin-top:.4rem;">Procedimiento rápido de limpieza (5 pasos):</p>
        <ol style="font-size:.58rem;line-height:1.25;margin-left:1.1rem;">
            <li>Aislar área (nadie pisa).</li>
            <li>Ponerte guantes y mascarilla.</li>
            <li>Recolectar restos en bolsa sellada.</li>
            <li>Desinfectar piso y manijas.</li>
            <li>Lavar manos y brazos hasta codo.</li>
        </ol>

        <p style="font-size:.55rem;margin-top:.35rem;">
            Ropa con sangre/zombie: hervir 10 min o quemar. No guardar “por si acaso”.
        </p>

        
    </div>
    <div class="page-footer">14</div>
</section>

{{-- PÁGINA 15: DEFENSA PERIMETRAL --}}
<section id="m2-defensa" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#fee2e2;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M4 10.5 12 4l8 6.5" stroke="#b10000" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6 11v7h4v-4h4v4h4v-7" stroke="#b10000" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3 19h18" stroke="#b10000" stroke-width="1.1" stroke-linecap="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.88rem;margin:0;">Defensa perimetral</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Que no lleguen a la puerta.</p>
            </div>
        </div>

        <p style="font-size:.58rem;margin-top:.45rem;">
            Objetivo: detectar, frenar y desviar sin gastar munición.
        </p>

        <div style="margin-top:.4rem;background:#fff;border-radius:.45rem;border:1px solid rgba(0,0,0,.03);overflow:hidden;">
            <table style="width:100%;border-collapse:collapse;font-size:.55rem;">
                <thead style="background:rgba(177,0,0,.08);">
                    <tr>
                        <th style="text-align:left;padding:.28rem .4rem;">Nivel</th>
                        <th style="text-align:left;padding:.28rem .4rem;">Qué poner</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding:.25rem .4rem;">1. Lejano</td>
                        <td style="padding:.25rem .4rem;">Latas con piedra, botellas colgantes.</td>
                    </tr>
                    <tr style="background:rgba(0,0,0,.015);">
                        <td style="padding:.25rem .4rem;">2. Medio</td>
                        <td style="padding:.25rem .4rem;">Obstáculos, sillas, tablas, alambre.</td>
                    </tr>
                    <tr>
                        <td style="padding:.25rem .4rem;">3. Entrada</td>
                        <td style="padding:.25rem .4rem;">Mueble pesado, barra, cadena.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p style="font-size:.58rem;margin-top:.35rem;">Pasos (10 min):</p>
        <ol style="font-size:.57rem;line-height:1.25;margin-left:1.1rem;">
            <li>Marcar perímetro con ruido.</li>
            <li>Bloquear acceso directo al portón.</li>
            <li>Designar punto alto de observación.</li>
            <li>Dejar ruta de escape libre.</li>
        </ol>

        
    </div>
    <div class="page-footer">15</div>
</section>

{{-- PÁGINA 16: ESTABLECER COLONIA --}}
<section id="m2-colonia" class="a6-page">
    <div class="a6-inner">
        <div style="display:flex;gap:.5rem;align-items:center;">
            <div style="width:54px;height:54px;background:#dbeafe;border-radius:14px;display:flex;align-items:center;justify-content:center;">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
                    <path d="M4 20v-7l8-6 8 6v7" stroke="#1d4ed8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 20v-5h3v5" stroke="#1d4ed8" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15 20v-3h2v3" stroke="#1d4ed8" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div>
                <h2 style="font-size:.88rem;margin:0;">Establecer colonia</h2>
                <p style="font-size:.6rem;opacity:.7;margin:0;">Pensar a semanas, no a horas.</p>
            </div>
        </div>

        <p style="font-size:.6rem;margin-top:.45rem;">
            Colonia = 12–30 personas, agua cercana, defensa, producción de comida.
        </p>

        <div style="margin-top:.4rem;display:grid;grid-template-columns:1fr 1fr;gap:.35rem;">
            <div style="background:#fff;border-radius:.4rem;border:1px solid rgba(0,0,0,.03);padding:.35rem .4rem;font-size:.57rem;">
                <strong>Roles base</strong>
                <ol style="margin:.25rem 0 0 1rem;">
                    <li>Seguridad</li>
                    <li>Agua/comida</li>
                    <li>Salud</li>
                    <li>Logística</li>
                </ol>
            </div>
            <div style="background:#eff6ff;border-radius:.4rem;border:1px solid rgba(29,78,216,.15);padding:.35rem .4rem;font-size:.57rem;">
                <strong>Recursos</strong>
                <ol style="margin:.25rem 0 0 1rem;">
                    <li>Tanque o pozo</li>
                    <li>Huerto o patio</li>
                    <li>Taller básico</li>
                </ol>
            </div>
        </div>

        <p style="font-size:.58rem;margin-top:.35rem;">Reglas mínimas (escritas):</p>
        <ol style="font-size:.56rem;line-height:1.25;margin-left:1.1rem;">
            <li>Ingreso controlado (revisión médica).</li>
            <li>Turnos de guardia obligatorios.</li>
            <li>Reparto según trabajo.</li>
        </ol>
        <p style="margin:0">ATENCION</p>
        <div style="    font-size: .6rem;  margin-top: .45rem; background: #ffa1a1;  padding: 10px;  border-radius: 15px; border: 1px solid #ec4e4e;" >
        <p >Recuerde que la reproduccion en un apocalipsis zombie debe ser considerado con extremo cuidado, si ya estableciste todos los requerimientos basicos 
            podemos establecer recien un plan de reproduccion para la comunidad. Ademas realizate las siguientes preguntas:</p> 
            <li style="list-style:none">- Es justo traer otro ser vivo en un mundo devastado?</li>
            <li style="list-style:none">- Los sonidos del bebe que podria conllevar los primeros años estaran bien prevenidos? (*Depende del tipo de zombie que exista)</li>
            <li style="list-style:none">- Y sobre todo: No lo estas concibiendo por fines egoistas?</li>
             
        </div>
        
    </div>
    <div class="page-footer">16</div>
</section>


</div>
