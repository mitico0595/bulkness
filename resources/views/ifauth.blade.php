
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @include ('global.name')  - sesion iniciada</title>
    @include ('global.icon')  
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: radial-gradient(ellipse at center, hsl(51.64deg 95.96% 77.65%) 0%, hsl(47.33deg 100% 79.58%) 44%, hsl(57.36deg 54.67% 63.47%) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
		a{
			text-decoration:none;
		}
        /* Fondo animado con partículas */
        .background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.3; }
            50% { transform: translateY(-20px) rotate(180deg); opacity: 0.8; }
        }

        /* Contenedor principal */
        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 60px 50px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.2);
            text-align: center;
            max-width: 420px;
            width: 90%;
            position: relative;
            z-index: 1;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Icono superior */
        .icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, hsl(49.83deg 100% 75.87%), hsl(54.85deg 58% 36%));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s ease-in-out infinite;
            position: relative;
            box-shadow: 0 8px 25px rgba(243, 217, 17, 0.3);
        }

        .icon::before {
            content: '✓';
            color: white;
            font-size: 36px;
            font-weight: bold;
        }

        .icon::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, hsl(54.85deg 68% 45%), hsl(54.85deg 58% 36%));
            opacity: 0.3;
            animation: ripple 2s ease-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes ripple {
            0% { transform: scale(1); opacity: 0.3; }
            100% { transform: scale(1.5); opacity: 0; }
        }

        /* Título */
        .title {
            font-size: 28px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 12px;
            background: linear-gradient(135deg, hsl(57.36deg 68% 45%), hsl(57.36deg 45.18% 55.65%));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Subtítulo */
        .subtitle {
            font-size: 16px;
            color: #718096;
            margin-bottom: 40px;
            line-height: 1.5;
        }

        /* Botón */
        .btn {
            background: linear-gradient(135deg, hsl(59.87deg 68% 45%) 0%, hsl(54.85deg 51.71% 47.74%) 100%);
            color: white;
            border: none;
            padding: 16px 40px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            min-width: 180px;
            box-shadow: 0 8px 25px rgba(186, 174, 85, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(186, 174, 85, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        /* Efectos de carga */
        .loading-dots {
            display: none;
            margin-top: 20px;
        }

        .dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: hsla(2,68%,45%,1);
            margin: 0 3px;
            animation: loadingDots 1.4s ease-in-out infinite both;
        }

        .dot:nth-child(1) { animation-delay: -0.32s; }
        .dot:nth-child(2) { animation-delay: -0.16s; }

        @keyframes loadingDots {
            0%, 80%, 100% {
                transform: scale(0);
                opacity: 0.5;
            }
            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 40px 30px;
                margin: 20px;
            }
            
            .title {
                font-size: 24px;
            }
            
            .icon {
                width: 60px;
                height: 60px;
                margin-bottom: 20px;
            }
            
            .icon::before {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="background" id="background"></div>
    
    <div class="container">
        <div class="icon"></div>
        <h1 class="title">Sesión iniciada</h1>
        <p class="subtitle">¡Bienvenido de vuelta! Tu sesión se ha iniciado correctamente y ya puedes continuar.</p>
		@if (auth()->user()->type == "1")
        <a href="{{url('admin/productos')}}" class="btn" onclick="handleContinue()">Ingresar</a>
		@endif
		@if (auth()->user()->type == "0")
		<a href="{{url('usuario')}}" class="btn" onclick="handleContinue()">Ingresar</a>
		@endif
		@if (auth()->user()->type == "2")
			<a href="{{url('supplier')}}" class="btn" onclick="handleContinue()">Ingresar</a>
		@endif
		
        <div class="loading-dots" id="loadingDots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div>
    </div>

    <script>
        // Crear partículas de fondo
        function createParticles() {
            const background = document.getElementById('background');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 4 + 4) + 's';
                background.appendChild(particle);
            }
        }

        // Manejar click del botón
        function handleContinue() {
            const btn = document.querySelector('.btn');
            const loadingDots = document.getElementById('loadingDots');
            
            btn.style.opacity = '0.7';
            btn.style.pointerEvents = 'none';
            btn.textContent = 'Cargando...';
            loadingDots.style.display = 'block';
            
            // Simular carga
            setTimeout(() => {
                // Aquí irían las acciones reales de navegación
                btn.textContent = '¡Listo!';
                loadingDots.style.display = 'none';
                
                setTimeout(() => {
                    // Resetear botón
                    btn.style.opacity = '1';
                    btn.style.pointerEvents = 'auto';
                    btn.textContent = 'Ingresar';
                }, 1000);
            }, 2000);
        }

        // Inicializar
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
        });

        // Efecto de cursor (opcional)
        document.addEventListener('mousemove', function(e) {
            const cursor = document.createElement('div');
            cursor.style.position = 'fixed';
            cursor.style.width = '4px';
            cursor.style.height = '4px';
            cursor.style.background = 'rgba(255, 255, 255, 0.7)';
            cursor.style.borderRadius = '50%';
            cursor.style.pointerEvents = 'none';
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
            cursor.style.zIndex = '9999';
            cursor.style.animation = 'fadeOut 1s ease-out forwards';
            
            document.body.appendChild(cursor);
            
            setTimeout(() => {
                cursor.remove();
            }, 1000);
        });

        // Animación de fadeOut para el cursor
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                0% { opacity: 1; transform: scale(1); }
                100% { opacity: 0; transform: scale(2); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>