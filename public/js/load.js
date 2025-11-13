document.addEventListener('DOMContentLoaded', function() {
    const loadingDiv = document.getElementById('loadingDiv');
    const minimumLoadTime = 1500; // 1.5 segundos

    // Marcar la hora de inicio
    const startTime = Date.now();

    // Función para ocultar el div de carga
    function hideLoadingDiv() {
        const elapsedTime = Date.now() - startTime;
        if (elapsedTime < minimumLoadTime) {
            // Si no ha pasado suficiente tiempo, esperar el tiempo restante
            setTimeout(fadeOut, minimumLoadTime - elapsedTime);
        } else {
            // Si ya pasó el tiempo mínimo, empezar a desvanecer inmediatamente
            fadeOut();
        }
    }

    // Función para desvanecer el div de carga
    function fadeOut() {
        loadingDiv.style.opacity = '0'; // Inicia la transición de opacidad
        // Evento que se activa al finalizar la transición
        loadingDiv.addEventListener('transitionend', function() {
            loadingDiv.style.display = 'none'; // Establece display en 'none' después de la transición
        }, { once: true }); // Asegura que el evento solo se dispare una vez
    }

    // Ocultar el div de carga una vez que la página esté completamente cargada
    window.onload = hideLoadingDiv;
});


