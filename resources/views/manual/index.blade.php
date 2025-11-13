{{-- resources/views/manual/index.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Manuales de Emergencia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('global.icon')
    <style>
        :root{
            --bg:#0f172a;
            --a6-w: min(620px, 90vw);   /* ancho máximo del “pdf” */
            --sidebar-w: 230px;
        }
        *{box-sizing:border-box;}
        body{
            margin:0;
            background: radial-gradient(circle at top, #ff6d6d 0%, #020617 100%);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color:#e2e8f0;
        }
        .screen{
            min-height:100vh;
            display:flex;
            flex-direction:column;
        }

        /* ------------- vista inicial dividida ------------- */
        .choice{
            flex:1;
            display:flex;
            min-height:100vh;
        }
        .choice-btn{
            flex:1;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            gap:.75rem;
            color:#fff;
            text-align:center;
            cursor:pointer;
            position:relative;
            overflow:hidden;
            transition:transform .3s ease;
        }
        .choice-btn::after{
            content:"";
            position:absolute;
            inset:-20%;
            background:radial-gradient(circle,rgba(255,255,255,.18),transparent 55%);
            filter:blur(35px);
            opacity:0;
            transition:opacity .4s ease;
        }
        .choice-btn:hover{transform:translateY(-4px);}
        .choice-btn:hover::after{opacity:1;}
        .choice-1{background:#5a0808;}
        .choice-2{background:#000;}
        .choice-title{
            font-size:clamp(1.5rem, 2.8vw, 2rem);
            font-weight:700;
            letter-spacing:.04em;
        }
        .choice-sub{
            font-size:.85rem;
            opacity:.8;
            max-width:270px;
        }

        /* ------------- layout de lectura ------------- */
        .layout{
            display:none;
            min-height:100vh;
        }
        .layout.active{
            display:flex;
            min-height:100vh;
        }
        .sidebar{
            
            background:linear-gradient(180deg, rgba(2,6,23,.4) 0%, rgba(2,6,23,0) 100%);
            backdrop-filter: blur(12px);
            border-right:1px solid rgba(255,255,255,.05);
            padding:1rem .75rem 1.25rem;
            display:flex;
            flex-direction:column;
            gap:.75rem;
        }
        .logo{font-weight:700;margin-bottom:.25rem;}
        .side-title{font-size:.7rem;text-transform:uppercase;letter-spacing:.18em;opacity:.6;}
        .nav-list{display:flex;flex-direction:column;gap:.45rem;}
        .nav-item{
            font-size:.8rem;
            padding:.4rem .5rem;
            border-radius:.5rem;
            cursor:pointer;
            transition:background .2s;
        }
        .nav-item.active,
        .nav-item:hover{
            background:rgba(248,250,252,.06);
        }

        /* área donde va el A6 y donde debe scrollear */
        .content-area{
            flex:1;
            height:100vh;             /* esto es clave para que el scroll esté aquí */
            display:flex;
            justify-content:center;
            align-items:center;
            padding:1.25rem;
            overflow:hidden;          /* no scroll aquí, el scroll es del body interno */
        }
        .page-wrap{
            width:var(--a6-w);
            height:100%;
            max-height:100%;
            display:flex;
        }
        .page-body{
            flex:1;
            height:100%;
            overflow-y:auto;          /* aquí sí hay scroll */
            display:flex;
            flex-direction:column;
            gap:1rem;
            scroll-behavior:smooth;
            padding-right:.35rem;
        }

        /* ------------- cada página A6 ------------- */
        .a6-page{
            width:100%;
            aspect-ratio: 1 / 1.414;   /* todas mismas proporciones */
            background:linear-gradient(180deg,#fefefe 0%, #f9fafb 48%, #ecf3ff 100%);
            border-radius:16px;
            box-shadow:0 24px 50px rgba(0,0,0,.15);
            border:1px solid rgba(255,255,255,.6);
            overflow:hidden;
            position:relative;
            display:flex;
            margin-top:10px
        }
        .a6-inner{
            flex:1;
            padding:1.1rem 1rem 1.2rem 1.1rem;
            display:flex;
            flex-direction:column;
            gap:.6rem;
            color:#0f172a;
        }
        .page-footer{
            position:absolute;
            bottom:.4rem;
            right:.7rem;
            font-size:.55rem;
            opacity:.4;
            color:#727272;
        }

        /* scrollbar bonito, porque sí */
        .page-body::-webkit-scrollbar{
            width:6px;
        }
        .page-body::-webkit-scrollbar-thumb{
            background:rgba(255,255,255,.3);
            border-radius:999px;
        }

        /* -------- responsive -------- */
        @media(max-width:900px){
            .layout.active{
                flex-direction:column;
            }
            .sidebar{
                width:100%;
                flex-direction:row;
                flex-wrap:wrap;
                gap:.5rem;
                align-items:center;
            }
            .content-area{
                height:calc(100vh - 140px);
                padding:1rem .5rem 5rem;
            }
            .page-wrap{
                width:100%;
                max-width:430px;
            }
        }
        @media(max-width:650px){
            .choice{flex-direction:column;}
            .choice-btn{min-height:45vh;}
        }
        .manual-switch{
    position:fixed;
    bottom:14px;
    left:calc(var(--sidebar-w) + 1.25rem);
    display:flex;
    gap:.5rem;
    z-index:40;
}
.manual-switch button{
    background:rgba(2,6,23,.65);
    border:1px solid rgba(248,250,252,.12);
    color:#e2e8f0;
    padding:.35rem .8rem;
    border-radius:.5rem;
    font-size:.7rem;
    cursor:pointer;
    backdrop-filter:blur(6px);
}
.manual-switch button:hover{
    background:rgba(248,250,252,.08);
}
@media(max-width:900px){
    .manual-switch{
        left:1rem;
        right:1rem;
        justify-content:center;
    }
}
.manual-switch button.active{
    background:#b10000;
    border-color:rgba(248,250,252,.4);
}
.sidebar{
    
    background:linear-gradient(180deg, rgba(2,6,23,.4) 0%, rgba(2,6,23,0) 100%);
    backdrop-filter: blur(12px);
    border-right:1px solid rgba(255,255,255,.05);
    padding:1rem .75rem 1.25rem;
    display:flex;
    flex-direction:column;
    gap:.75rem;
}

.side-other{
    margin-top:auto;               /* esto lo manda al fondo */
    padding-top:.5rem;
    border-top:1px solid rgba(255,255,255,.03);
    font-size:.68rem;
    text-transform:uppercase;
    letter-spacing:.18em;
    opacity:.6;
    cursor:pointer;
}
.side-other strong{
    display:block;
    font-size:.75rem;
    text-transform:none;
    letter-spacing:0;
    opacity:1;
    color:#fff;
}
.side-other:hover{
    opacity:1;
}
@media(max-width:900px){
    .side-other{
        margin-top:0;
        border-top:none;
    }
}

    </style>
</head>
<body>
<div class="screen" id="appManual">
    
    {{-- pantalla de selección --}}
    <div class="choice" id="choiceView">
        
        <div class="choice-btn choice-1" onclick="selectManual(1)">
            <div class="choice-title" style="letter-spacing:.35rem;font-size:1.2rem;text-transform:uppercase;opacity:.45;margin:0;font-weight:bold">Manual de emergencia</div>
            <img src="{{asset('image/manual/backmanual1.png')}}" alt="" style="width:100%">
            <div class="choice-sub">Desastres naturales, primeros auxilios y camping.</div>
        </div>
        <div class="choice-btn choice-2" onclick="selectManual(2)">
            <div class="choice-title" style="letter-spacing:.35rem;font-size:1.2rem;text-transform:uppercase;opacity:.45;margin:0;font-weight:bold">Manual Apocalipsis Zombie</div>
            <img src="{{asset('image/manual/zombie.png')}}" alt="" style="width:100%">
            <div class="choice-sub">Qué hacer ante un apocalipsis zombie.</div>
        </div>
    </div>

    {{-- layout de lectura --}}
    <div class="layout" id="layoutView">
        
        <aside class="sidebar" id="sidebarMenu">
            <a href="/" style="width:100px"><img src="{{asset('image/logo1_BN.webp')}}" alt="" style="width:100%"></a>
            <div>
                <div class="logo">Manuales</div>
                <div class="side-title" id="sideLabel">Manual seleccionado</div>
            </div>
            <div class="nav-list" id="navList"></div>
             <div class="side-other" id="sideOther"></div>
        </aside>

        <main class="content-area">
            <div class="page-wrap">
                <div class="page-body" id="pageBody">
                    {{-- los dos manuales van aquí, solo se muestra uno por vez --}}
                    @include('manual.manual1')
                    @include('manual.manual2')
                </div>
            </div>
        </main>
        <div class="manual-switch" id="manualSwitch">
            <a href="/" style="background: rgb(161 32 32 / 65%);  border: 1px solid rgba(248, 250, 252, .12);  color: #e2e8f0;  padding: .35rem .8rem;
    border-radius: .5rem;  font-size: .7rem;   cursor: pointer;  backdrop-filter: blur(6px);text-decoration:none">INICIO</a>
        <button type="button" onclick="selectManual(1)">Manual 1</button>
        <button type="button" onclick="selectManual(2)">Manual 2</button>
    </div>
    </div>
</div>

<script>
    const choiceView = document.getElementById('choiceView');
    const layoutView = document.getElementById('layoutView');
    const navList    = document.getElementById('navList');
    const sideLabel  = document.getElementById('sideLabel');

    // índices de cada manual
    const manualIndexes = {
        1: [
        {id:'m1-portada',     label:'Portada'},
        {id:'m1-numeros',     label:'Números'},
        {id:'m1-indice',      label:'Índice'},
        {id:'m1-indicaciones',label:'Indicaciones Básicas'},
        {id:'m1-primerosaux', label:'1ros auxilios'},
        {id:'m1-terremoto',   label:'Sismo'},
        {id:'m1-incendio',    label:'Incendio'},
        {id:'m1-tsunami',     label:'Tsunami'},
        {id:'m1-huaico',      label:'Huaico'},
        {id:'m1-parte2',      label:'Parte 2: Camping'},
        {id:'m1-camping-1',      label:'Camping'},
        {id:'m1-camping2',      label:'Camping 2'},
        {id:'m1-anexo-mochila',      label:'Anexo Mochila'},
        {id:'anexo-tarjeta',      label:'Tarjeta Familiar'},
        
        ],
        2: [
        {id:'m2-portada',      label:'Portada'},
        {id:'m2-advertencia',  label:'Advertencias'},
        {id:'m2-indice',       label:'Índice'},
        {id:'m2-tipos',        label:'Tipos de brote'},
        {id:'m2-fases',        label:'Fases del apocalipsis'},
        {id:'m2-comunicacion', label:'Comunicacion y Move'},
        {id:'m2-kit',          label:'Kit minimo 72h'},
        {id:'m2-alimentacion', label:'Alimentacion y agua'},
        {id:'m2-refugios',     label:'Refugios'},
        {id:'m2-contacto',     label:'Contacto con otros'},
        {id:'m2-tabla',        label:'Tabla rapida'},
        {id:'m2-expansion',    label:'Parte 2: expansion'},
        {id:'m2-proteccion',   label:'Proteccion y limpieza'},
        {id:'m2-defensa',      label:'Defensa perimetral'},
        {id:'m2-colonia',      label:'Establecer Colonia'},
        ]
    };

    function selectManual(num){
        // oculto pantalla inicial
        choiceView.style.display = 'none';
        // muestro layout
        layoutView.classList.add('active');

        // mostrar solo el manual elegido
        document.querySelectorAll('[data-manual-block]').forEach(el=>{
            if (el.getAttribute('data-manual-block') == num.toString()) {
                el.style.display = 'block';
            } else {
                el.style.display = 'none';
            }
        });

        // título lateral
        sideLabel.textContent = num === 1 ? 'Desastres naturales' : 'Apocalipsis zombie';
        const sideOther = document.getElementById('sideOther');
        if (num === 1) {
            sideOther.innerHTML = 'APOCALIPSIS ZOMBIE<br><strong>Ver manual 2</strong>';
            sideOther.onclick = () => selectManual(2);
        } else {
            sideOther.innerHTML = 'DESASTRES NATURALES<br><strong>Ver manual 1</strong>';
            sideOther.onclick = () => selectManual(1);
        }

        // armar índice lateral
        navList.innerHTML = '';
        manualIndexes[num].forEach((item, idx)=>{
            const li = document.createElement('div');
            li.className = 'nav-item' + (idx===0 ? ' active' : '');
            li.textContent = item.label;
            li.onclick = ()=>scrollToSection(item.id, li);
            navList.appendChild(li);
        });

        // scrolleo inicial a la portada del manual elegido
        scrollToSection(num === 1 ? 'm1-portada' : 'm2-portada');
    }

    function scrollToSection(id, el){
        const target = document.getElementById(id);
        if(!target) return;
        target.scrollIntoView({behavior:'smooth', block:'start'});
        if(el){
            document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
            el.classList.add('active');
        }
    }
    
</script>
</body>
</html>
