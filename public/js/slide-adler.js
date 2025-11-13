const contentContainer = document.getElementById('scroll-index');
        const scrollContent = document.getElementById('scroll-content');
        const sliderContainer = document.getElementById('slider-container');
        const sliderThumb = document.getElementById('slider-thumb');
        const sliderProgress = document.getElementById('slider-progress');

        // Variables para el movimiento del slider
        let isDragging = false;

        // Manejar el inicio del arrastre
        sliderThumb.addEventListener('mousedown', (event) => {
            isDragging = true;
            document.body.style.userSelect = 'none'; // Evitar selección de texto al arrastrar
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            document.body.style.userSelect = ''; // Restaurar selección de texto
        });

        document.addEventListener('mousemove', (event) => {
            if (!isDragging) return;

            // Calcula la posición del slider
            const sliderContainerRect = sliderContainer.getBoundingClientRect();
            const newTop = Math.min(Math.max(0, event.clientY - sliderContainerRect.top - sliderThumb.clientHeight / 2), sliderContainerRect.height - sliderThumb.clientHeight);

            // Actualiza la posición del slider
            sliderThumb.style.top = `${newTop}px`;

            // Actualiza la barra de progreso
            sliderProgress.style.height = `${newTop + sliderThumb.clientHeight / 2}px`;

            // Calcula el porcentaje de desplazamiento
            const scrollPercentage = newTop / (sliderContainerRect.height - sliderThumb.clientHeight);

            // Desplaza el contenido
            scrollContent.style.transform = `translateY(-${scrollPercentage * (scrollContent.scrollHeight - contentContainer.clientHeight)}px)`;
        });

        // Opcional: Soporte para dispositivos táctiles
        sliderThumb.addEventListener('touchstart', (event) => {
            isDragging = true;
            document.body.style.userSelect = 'none'; // Evitar selección de texto al arrastrar
        });

        document.addEventListener('touchend', () => {
            isDragging = false;
            document.body.style.userSelect = ''; // Restaurar selección de texto
        });

        document.addEventListener('touchmove', (event) => {
            if (!isDragging) return;

            const touch = event.touches[0];

            // Calcula la posición del slider
            const sliderContainerRect = sliderContainer.getBoundingClientRect();
            const newTop = Math.min(Math.max(0, touch.clientY - sliderContainerRect.top - sliderThumb.clientHeight / 2), sliderContainerRect.height - sliderThumb.clientHeight);

            // Actualiza la posición del slider
            sliderThumb.style.top = `${newTop}px`;

            // Actualiza la barra de progreso
            sliderProgress.style.height = `${newTop + sliderThumb.clientHeight / 2}px`;

            // Calcula el porcentaje de desplazamiento
            const scrollPercentage = newTop / (sliderContainerRect.height - sliderThumb.clientHeight);

            // Desplaza el contenido
            scrollContent.style.transform = `translateY(-${scrollPercentage * (scrollContent.scrollHeight - contentContainer.clientHeight)}px)`;
        });

        // Agregar el manejo del scroll del mouse
        contentContainer.addEventListener('wheel', (event) => {
            event.preventDefault(); // Evitar el desplazamiento predeterminado

            const delta = event.deltaY / 5; // Ajusta este valor para cambiar la velocidad del scroll
            const sliderContainerRect = sliderContainer.getBoundingClientRect();
            const thumbHeight = sliderThumb.clientHeight;
            const maxTop = sliderContainerRect.height - thumbHeight;
            const currentTop = parseFloat(sliderThumb.style.top) || 0;
            const newTop = Math.min(Math.max(0, currentTop + delta), maxTop);

            // Actualiza la posición del slider
            sliderThumb.style.top = `${newTop}px`;

            // Actualiza la barra de progreso
            sliderProgress.style.height = `${newTop + thumbHeight / 2}px`;

            // Calcula el porcentaje de desplazamiento
            const scrollPercentage = newTop / maxTop;

            // Desplaza el contenido
            scrollContent.style.transform = `translateY(-${scrollPercentage * (scrollContent.scrollHeight - contentContainer.clientHeight)}px)`;
        });