<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>@include ('global.name') - {{ $activeCampaignName ?? 'Temporada' }}</title>
    @include('global.icon')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:"Kantumruy Pro",system-ui,-apple-system,sans-serif;
            font-weight:300
        }

        body {
            font-family: "Kantumruy Pro", system-ui, -apple-system, sans-serif;
            background: #f5f5f5;
            overflow-x: hidden;
            color: #111827;
        }

        /* NAVBAR */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            position: sticky;
            top: 0;
            z-index: 50;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .nav-logo img {
            width: 50px;
        }

        .nav-links {
            display: flex;
            gap: 32px;
            
        }

        .nav-links h1 {
            font-size: 15px;
            letter-spacing: 1px;
            cursor: pointer;
            
        }

        .nav-links h1:hover {
            text-decoration: underline;
        }

        .nav-actions {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .material-symbols-outlined {
            cursor: pointer;
        }

        /* Botón sandwich (mobile) */
        .nav-toggle {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            border-radius: 999px;
        }

        .nav-toggle:hover {
            background: #f3f4f6;
        }

        /* Main Container */
        .container {
            margin-top: 24px;
            padding: 40px;
            display: flex;
            gap: 30px;
            height: calc(100vh - 120px);
            min-height: 520px;
        }

        /* Left Section */
        .left-section {
            flex: 0 0 260px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 20px;
            position: absolute;
        }

        .title {
            font-size: 24px;
            font-weight: 300;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #333;
            margin-bottom: 10px;
        }

        .description {
            font-size: 12px;
            line-height: 1.6;
            color: #666;
            margin-bottom: 20px;
        }

        .look-number {
            font-size: 32px;
            font-weight: 300;
            color: #333;
            letter-spacing: 2px;
        }

        .look-label {
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #999;
        }

        /* Center Section - Custom Slider */
        .center-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            overflow: hidden;
            position: relative;
            cursor: grab;
            user-select: none;
        }

        .center-section.grabbing {
            cursor: grabbing;
        }

        .images-container {
            position: relative;
            width: 100%;
            height: 500px;
            z-index: 1;
        }

        .image-item {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 200px;
            height: 500px;
            transform-origin: center center;
            transition:
                transform 0.9s cubic-bezier(0.23, 0.7, 0.25, 1),
                filter 0.9s cubic-bezier(0.23, 0.7, 0.25, 1),
                opacity 0.9s ease;
        }

        .image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 4px;
        }

        .image-item::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 4px;
            pointer-events: none;
            transition: background 0.4s ease;
        }

        /* Right Section - Vertical "related" slider */
        .right-section {
            flex: 0 0 210px;
            overflow: hidden;
            padding: 8px;
            position: relative;
        }

        .right-inner {
            display: flex;
            flex-direction: column;
            gap: 24px;
            animation: slideIn 0.35s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .product-item {
            cursor: pointer;
            transition: transform 0.3s;
            font-size: 11px;
        }

        .product-item:hover {
            transform: translateX(-5px);
        }

        .product-images {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 10px;
        }

        .product-images img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            
            transition: box-shadow 0.3s;
            border-radius:15px;
        }

        

        .product-info {
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 4px;
        }

        .product-price {
            font-size: 12px;
            color: #333;
            font-weight: 500;
        }

        /* Heart & Add Button */
        .heart-icon {
            width: 26px;
            height: 26px;
            border: 1px solid #ddd;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-bottom: 8px;
            transition: all 0.3s;
            border-radius: 999px;
        }

        .heart-icon:hover {
            border-color: #ff4444;
        }

        .heart-icon::before {
            content: '♡';
            font-size: 14px;
            color: #666;
        }

        .heart-icon.active::before {
            content: '♥';
            color: #ff4444;
        }

        .add-button {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin-top: 8px;
            transition: all 0.3s;
            border-radius: 999px;
            position: relative;
        }

        .add-button:hover {
            background: #333;
            border-color: #333;
        }

        .add-button::before,
        .add-button::after {
            content: '';
            position: absolute;
            background: #666;
            transition: background 0.3s;
        }

        .add-button::before {
            width: 12px;
            height: 2px;
        }

        .add-button::after {
            width: 2px;
            height: 12px;
        }

        .add-button:hover::before,
        .add-button:hover::after {
            background: white;
        }

        .right-section::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .right-section::-webkit-scrollbar-track {
            background: #f0f0f0;
        }

        .right-section::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }

        /* TABLET: reorganizar a columnas apiladas, lateral debajo como horizontal */
        @media (max-width: 1024px) {
            .container {
                flex-direction: column;
                height: auto;
                padding: 24px 20px 28px;
                gap: 20px;
            }

            .left-section {
                flex: 0 0 auto;
                flex-direction: row;
                align-items: flex-end;
                justify-content: space-between;
                gap: 16px;
            }

            .center-section {
                margin-top: 10px;
                order: 2;
                justify-content: center;
            }

            .images-container {
                height: 420px;
            }

            .image-item {
                width: 170px;
                height: 420px;
            }

            /* Lateral pasa a ser abajo y horizontal */
            .right-section {
                order: 3;
                flex-basis: auto;
                padding-right: 0;
                overflow-x: auto;
                overflow-y: hidden;
                margin-top: 4px;
            }

            .right-inner {
                flex-direction: row;
                gap: 16px;
                animation: slideIn 0.35s ease;
                padding-bottom: 4px;
                min-width: max-content;
                justify-content: center;
            }

            .product-item {
                min-width: 180px;
                transform: none;
            }

            .product-item:hover {
                transform: translateY(-4px);
            }
        }

        /* MOBILE */
        @media (max-width: 640px) {
            nav {
                padding: 12px 16px;
            }

            .container {
                padding: 20px 16px 24px;
            }

            .left-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .title {
                font-size: 18px;
                letter-spacing: 2px;
            }

            .look-number {
                font-size: 26px;
            }

            .images-container {
                height: 360px;
            }

            .image-item {
                width: 140px;
                height: 360px;
            }

            .right-section {
                margin-top: 8px;
            }

            .product-item {
                min-width: 160px;
            }
        }

        /* NAV: versión mobile (logo + sandwich) */
        @media (max-width: 768px) {
            .nav-links {
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: white;
                flex-direction: column;
                gap: 16px;
                padding: 16px 24px 20px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.08);
                display: none;
                height:100vh
            }
            .nav-links h1 {font-size:28px; text-align:center}
            .nav-links.active {
                display: flex;
            }

            .nav-actions {
                display: none;
            }

            .nav-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }
        a{text-decoration:none}
        h1{color:black}
        span{color:black}
    </style>
</head>
<body>
    <!-- NAV -->
    <nav>
        <div class="nav-logo">
            <img src="{{asset('image/logo.webp')}}" alt="Logo">
        </div>

        <div class="nav-links">
            <div><h1>HOME</h1></div>
            <div><a href="{{asset('busco')}}"><h1>PRODUCTOS</h1></a></div>
            
            <div><h1>NOSOTROS</h1></div>
        </div>

        <div class="nav-actions">
            <a href="{{asset('login')}}"><span class="material-symbols-outlined" >person</span></a>
         <!--   <a href="{{asset('pasarela-pago')}}"><span class="material-symbols-outlined">shopping_cart</span></a> -->
        </div>

        <button class="nav-toggle" id="navToggle" aria-label="Abrir menú">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </nav>

    <div class="container">
        <div class="left-section">
            <div>
                <div class="title">{{ $activeCampaignName ?? 'SPRING SUMMER 2026' }}</div>
            </div>
            <div>
                <div class="look-number" id="lookNumber">LOOK 01</div>
                <div class="look-label">SHOP THE LOOK</div>
            </div>
        </div>

        <div class="center-section" id="centerSection">
            <div class="images-container" id="imagesContainer">
                <!-- Slides creadas por JS -->
            </div>
        </div>

        <div class="right-section">
            <div class="right-inner" id="rightInner">
                <!-- Productos relacionados generados por JS -->
            </div>
        </div>
    </div>

    <script>
    // Arrays enviados desde el controlador
    const mainImages = @json($mainImages->pluck('image_url')); // array de URLs de imagen principal
    const relatedProductsByLook = @json($relatedProductsByLook); // array paralelo con productos
    const baseProductUrl = "{{ url('busco') }}/";    
    const imagesContainer = document.getElementById('imagesContainer');
    const rightInner = document.getElementById('rightInner');
    const lookNumberEl = document.getElementById('lookNumber');
    const centerSection = document.getElementById('centerSection');

    const slides = [];

    let slotConfig = [];

    function updateSlotConfig() {
        const w = window.innerWidth;

        if (w > 1200) {
            slotConfig = [
                { x: -320, scale: 0.6,  opacity: 0.3,  blur: 5, gray: 100 },
                { x: -140, scale: 0.69, opacity: 0.35, blur: 2, gray: 100 },
                { x:   40, scale: 0.85, opacity: 0.5,  blur: 1, gray: 100 },
                { x:  340, scale: 1.3,  opacity: 1.0,  blur: 0.0, gray: 0 }
            ];
        } else if (w > 768) {
            slotConfig = [
                { x: -220, scale: 0.65, opacity: 0.32, blur: 4, gray: 100 },
                { x:  -80, scale: 0.78, opacity: 0.45, blur: 2, gray: 100 },
                { x:   80, scale: 0.9,  opacity: 0.6,  blur: 1, gray: 100 },
                { x:  220, scale: 1.15, opacity: 1.0,  blur: 0, gray:  0 }
            ];
        } else {
            slotConfig = [
                { x: -140, scale: 0.7, opacity: 0.35, blur: 3, gray: 100 },
                { x:  -40, scale: 0.82, opacity: 0.5,  blur: 2, gray: 100 },
                { x:   40, scale: 0.9,  opacity: 0.7,  blur: 1, gray: 100 },
                { x:  140, scale: 1.0, opacity: 1.0,  blur: 0, gray: 0 }
            ];
        }
    }

    let activeIndex = 0;

    function circularIndex(i, length) {
        return ((i % length) + length) % length;
    }

    function createSlides() {
        if (!mainImages.length) return;

        mainImages.forEach((src, i) => {
            const item = document.createElement('div');
            item.classList.add('image-item');

            const img = document.createElement('img');
            img.src = src;
            img.alt = `Look ${i + 1}`;

            item.appendChild(img);
            imagesContainer.appendChild(item);

            slides.push({ el: item, idx: i });

            item.addEventListener('click', () => {
                setActiveIndex(i);
            });
        });
    }

    function layoutSlides() {
        const len = mainImages.length;
        if (!len) return;

        slides.forEach(slide => {
            const el = slide.el;
            const i  = slide.idx;

            let offset = (i - activeIndex + len) % len;

            if (offset >= 0 && offset <= 3) {
                const slot = 3 - offset;
                const cfg  = slotConfig[slot];

                el.classList.toggle('main', slot === 3);

                el.style.transform =
                    `translate(-50%, -50%) translate(${cfg.x}px, 0) scale(${cfg.scale})`;
                el.style.opacity = cfg.opacity;
                el.style.filter =
                    `grayscale(${cfg.gray}%) blur(${cfg.blur}px)`;
                el.style.zIndex = String(100 + slot);
                el.style.pointerEvents = 'auto';
                el.style.visibility = 'visible';
            } else {
                const half = Math.floor(len / 2);
                const goLeft = offset <= half;
                const xOff = goLeft ? -450 : 450;

                el.classList.remove('main');
                el.style.transform =
                    `translate(-50%, -50%) translate(${xOff}px, 0) scale(0.6)`;
                el.style.opacity = 0;
                el.style.filter = 'grayscale(100%) blur(4px)';
                el.style.zIndex = '10';
                el.style.pointerEvents = 'none';
                el.style.visibility = 'visible';
            }
        });

        lookNumberEl.textContent = `LOOK ${String(activeIndex + 1).padStart(2, '0')}`;
        renderRightSection();
    }

    function renderRightSection() {
    rightInner.innerHTML = '';
    rightInner.style.animation = 'none';
    void rightInner.offsetWidth;
    rightInner.style.animation = '';

    const related = relatedProductsByLook[activeIndex] || [];
    const itemsToShow = related.slice(0, 3); // máx 3 relacionados

    itemsToShow.forEach(prod => {
        const wrapper = document.createElement('div');
        wrapper.classList.add('product-item');

        // Corazón
        const heart = document.createElement('div');
        heart.classList.add('heart-icon');
        heart.addEventListener('click', (e) => {
            e.stopPropagation();
            heart.classList.toggle('active');
        });

        // LINK hacia busco/{id}
        const link = document.createElement('a');
        link.href = baseProductUrl + prod.id;      // <-- usa prod.id
        link.style.textDecoration = 'none';
        link.style.color = 'inherit';

        // Contenedor de imágenes
        const imagesWrap = document.createElement('div');
        imagesWrap.classList.add('product-images');

        const img = document.createElement('img');
        img.src = prod.img;
        img.alt = prod.title;
        imagesWrap.appendChild(img);

        // Info
        const info = document.createElement('div');
        info.classList.add('product-info');
        info.textContent = prod.title;

        const price = document.createElement('div');
        price.classList.add('product-price');
        price.textContent = `$${prod.price}`;

        // Metemos imagen + info + precio dentro del <a>
        link.appendChild(imagesWrap);
        link.appendChild(info);
        link.appendChild(price);

        // Botón de añadir (fuera del link)
        const addBtn = document.createElement('div');
        addBtn.classList.add('add-button');
        addBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            addBtn.style.transform = 'scale(0.9)';
            setTimeout(() => {
                addBtn.style.transform = 'scale(1)';
            }, 200);
        });

        // Estructura final del item
        wrapper.appendChild(heart);
        wrapper.appendChild(link);   // <--- el link envuelve imagen+texto
        wrapper.appendChild(addBtn);

        rightInner.appendChild(wrapper);
    });
}


    function setActiveIndex(newIndex) {
        const len = mainImages.length;
        if (!len) return;
        activeIndex = circularIndex(newIndex, len);
        layoutSlides();
    }

    // Drag / swipe
    let isDown = false;
    let startX = 0;
    let diffX = 0;

    function onPointerDown(pageX) {
        isDown = true;
        startX = pageX;
        diffX = 0;
        centerSection.classList.add('grabbing');
    }

    function onPointerMove(pageX) {
        if (!isDown) return;
        diffX = pageX - startX;
    }

    function onPointerUp() {
        if (!isDown) return;
        isDown = false;
        centerSection.classList.remove('grabbing');

        const threshold = 40;
        if (diffX < -threshold) {
            setActiveIndex(activeIndex + 1);
        } else if (diffX > threshold) {
            setActiveIndex(activeIndex - 1);
        }
    }

    centerSection.addEventListener('mousedown', e => onPointerDown(e.pageX));
    centerSection.addEventListener('mousemove', e => onPointerMove(e.pageX));
    window.addEventListener('mouseup', onPointerUp);

    centerSection.addEventListener('touchstart', e => {
        const t = e.touches[0];
        onPointerDown(t.pageX);
    }, { passive: true });

    centerSection.addEventListener('touchmove', e => {
        const t = e.touches[0];
        onPointerMove(t.pageX);
    }, { passive: true });

    centerSection.addEventListener('touchend', onPointerUp);

    // Scroll rueda / trackpad
    let wheelAccum = 0;
    let wheelTimeout = null;

    centerSection.addEventListener('wheel', (e) => {
        e.preventDefault();
        const delta = Math.abs(e.deltaX) > Math.abs(e.deltaY) ? e.deltaX : e.deltaY;
        wheelAccum += delta;

        const step = 60;
        if (wheelAccum > step) {
            setActiveIndex(activeIndex + 1);
            wheelAccum = 0;
        } else if (wheelAccum < -step) {
            setActiveIndex(activeIndex - 1);
            wheelAccum = 0;
        }

        clearTimeout(wheelTimeout);
        wheelTimeout = setTimeout(() => {
            wheelAccum = 0;
        }, 150);
    }, { passive: false });

    // Teclas
    window.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') setActiveIndex(activeIndex + 1);
        if (e.key === 'ArrowLeft')  setActiveIndex(activeIndex - 1);
    });

    // NAV mobile
    const navToggle = document.getElementById('navToggle');
    const navLinks = document.querySelector('.nav-links');

    navToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });

    document.querySelectorAll('.nav-links h1').forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                navLinks.classList.remove('active');
            }
        });
    });

    // Init
    updateSlotConfig();
    createSlides();
    layoutSlides();

    window.addEventListener('resize', () => {
        updateSlotConfig();
        layoutSlides();
    });
</script>

</body>
</html>
