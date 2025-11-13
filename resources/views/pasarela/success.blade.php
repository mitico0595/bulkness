<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success @include ('global.name')</title>
    @include ('global.icon')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Partículas de fondo */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
                opacity: 0.8;
            }
        }

        /* Contenedor principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        /* Header con animación */
        .success-header {
            text-align: center;
            margin-bottom: 50px;
            opacity: 0;
            transform: translateY(-50px);
            animation: slideInDown 1s ease-out 0.5s forwards;
        }

        .success-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: linear-gradient(45deg, #00ff88, #00cc6a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 40px rgba(0, 255, 136, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        .success-icon svg {
            width: 60px;
            height: 60px;
            fill: white;
            animation: checkDraw 1s ease-out 1s forwards;
            opacity: 0;
        }

        .main-title {
            font-size: 3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 15px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .subtitle {
            font-size: 1.3rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 300;
            margin-bottom: 10px;
        }

        .order-number {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.1);
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            backdrop-filter: blur(10px);
            margin-top: 20px;
        }

        /* Card principal */
        .main-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(20px);
            opacity: 0;
            transform: translateY(50px);
            animation: slideInUp 1s ease-out 1s forwards;
        }

        /* Información de compra */
        .purchase-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-section h3 {
            color: #333;
            font-size: 1.2rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
            color: #666;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-value {
            font-weight: 600;
            color: #333;
        }

        /* Productos adquiridos */
        .products-section {
            margin-top: 40px;
        }

        .section-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: '🛍️';
            font-size: 1.3rem;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: #f8f9ff;
            border-radius: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateX(-30px);
            animation: slideInLeft 0.8s ease-out forwards;
        }

        .product-card:nth-child(1) { animation-delay: 1.5s; }
        .product-card:nth-child(2) { animation-delay: 1.7s; }
        .product-card:nth-child(3) { animation-delay: 1.9s; }
        .product-card:nth-child(4) { animation-delay: 2.1s; }

        .product-card:hover {
            border-color: #667eea;
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.2);
        }

        .product-image {
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .product-info {
            flex: 1;
        }

        .product-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
            font-size: 1rem;
        }

        .product-details {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .product-price {
            font-weight: 700;
            color: #667eea;
            font-size: 1.1rem;
        }

        /* Total destacado */
        .total-section {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-top: 30px;
            text-align: center;
            opacity: 0;
            transform: scale(0.9);
            animation: zoomIn 0.8s ease-out 2.3s forwards;
        }

        .total-amount {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .total-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Botones de acción */
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeIn 1s ease-out 2.5s forwards;
        }

        .btn {
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #00ff88, #00cc6a);
            color: white;
            box-shadow: 0 5px 15px rgba(0, 255, 136, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 255, 136, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.9);
            color: #333;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .btn-secondary:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Animaciones */
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes checkDraw {
            to {
                opacity: 1;
            }
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2rem;
            }
            
            .purchase-info {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .main-card {
                padding: 25px;
                margin: 20px;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                min-width: 200px;
                justify-content: center;
            }
        }
        
        .products-section {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .paquete-group {
            background: white;
            border-radius: 16px;
            margin-bottom: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
        }

        .paquete-header {
            background: #f8f9fa;
            padding: 16px 20px;
            font-size: 16px;
            font-weight: 600;
            color: #495057;
            border-bottom: 1px solid #e9ecef;
        }

        .products-list {
            padding: 0;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            border-bottom: 1px solid #f1f3f4;
            transition: background-color 0.2s ease;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-item:hover {
            background-color: #f8f9fa;
        }

        .product-image {
            width: 60px;
            height: 60px;
            background: #f8f9fa;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 16px;
            flex-shrink: 0;
            border: 1px solid #e9ecef;
        }

        .product-main-info {
            flex-grow: 1;
            min-width: 0;
        }

        .product-name {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .product-description {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 6px;
        }

        .product-details {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            color: #6c757d;
        }

        .product-id {
            background: #e9ecef;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
        }

        .product-qty {
            background: #007bff;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 12px;
        }

        .product-price-section {
            text-align: right;
            flex-shrink: 0;
            margin-left: 16px;
        }

        .product-unit-price {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 2px;
        }

        .product-total-price {
            font-size: 16px;
            font-weight: 600;
            color: #28a745;
        }

        .paquete-total {
            background: #f8f9fa;
            padding: 16px 20px;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .paquete-total-label {
            font-size: 14px;
            color: #495057;
            font-weight: 500;
        }

        .paquete-total-amount {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .products-section {
                padding: 12px;
            }
            
            .product-item {
                padding: 12px 16px;
            }
            
            .product-image {
                width: 50px;
                height: 50px;
                font-size: 20px;
                margin-right: 12px;
            }
            
            .product-name {
                font-size: 15px;
            }
            
            .product-price-section {
                margin-left: 8px;
            }
        }

        @media (max-width: 480px) {
            .product-details {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }
        }
    </style>
</head>
<body>
    <!-- Partículas de fondo -->
    <div class="particles" id="particles"></div>
    @php
    $venta   = $receipt['venta']   ?? [];
    $cliente = $receipt['cliente'] ?? [];
    $grupos  = $receipt['grupos']  ?? [];
    $envio   = $cliente['envio']   ?? [];
    $mon = fn($n) => number_format((float)$n, 2);
    @endphp    
    <div class="container">
        <!-- Header de éxito -->
        <div class="success-header">
            <div class="success-icon">
                <svg viewBox="0 0 100 100">
                    <path class="check-path" d="M25 50 L40 65 L75 30" stroke="#ffffff" stroke-width="6" fill="none"/>
                </svg>
            </div>
            <h1 class="main-title">¡Compra Exitosa!</h1>
            <p class="subtitle">Tu pedido ha sido procesado correctamente</p>
            <div class="order-number">Orden #{{ $venta['codigo'] ?? '' }}</div>
        </div>

        <!-- Card principal -->
        <div class="main-card">
            <!-- Información de compra -->
            <div class="purchase-info">
                <div class="info-section">
                    <h3>Información del Pedido</h3>
                    <div class="info-item">
                        <span>Fecha de compra:</span>
                        <span class="info-value">{{ $venta['fecha'] ?? '' }}</span>
                    </div>
                    <div class="info-item">
                        <span>Método de pago:</span>
                        <span class="info-value">Visa •••• 4242</span>
                    </div>
                    <div class="info-item">
                        <span>Estado:</span>
                        <span class="info-value" style="color: #00cc6a;">✓ Confirmado</span>
                    </div>
                </div>

                <div class="info-section">
                    <h3>Información de @if(($cliente['tipo'] ?? 0) == 1) Entrega @else Recojo @endif</h3>
                    <div class="info-item">
                        <span>Dirección:</span>
                        @if(($cliente['tipo'] ?? 0) == 1)
                        <span class="info-value">{{ $envio['domicilio'] ?? '' }} , {{ $envio['departamento'] ?? '' }} </span>
                        @else<span class="info-value">Calle Margarita Praxedes 120</span>
                        @endif
                    </div>
                    
                    <div class="info-item">
                        <span>Tiempo estimado:</span>
                        <span class="info-value">0-2 días hábiles</span>
                    </div>
                    <div class="info-item">
                        <span>Envío:</span>
                        <span class="info-value">Express <span style="background:#00cc6a;padding:4px;border-radius:4px;color:white">S/ {{ $mon($venta['cargo_envio'] ?? 0) }}</span></span>
                    </div>
                </div>
            </div>

            @php
  $grupos  = $receipt['grupos'] ?? [];
  $catalog = $catalog ?? []; // opcional: [id => ['name'=>..., 'description'=>..., 'image'=>...]]
  $mon = fn($n) => number_format((float)$n, 2);
@endphp

<div class="products-section">
  <h2 class="section-title">Productos Adquiridos</h2>

  @foreach($grupos as $idsub => $lineas)
    @php $totalPaquete = 0; @endphp

    <div class="paquete-group">
      <div class="paquete-header">Paquete {{ $idsub }}</div>

      <div class="products-list">
        @foreach($lineas as $line)
          @php
            $id       = (int) $line['idarticulo'];
            $qty      = (int) $line['qty'];
            $precio   = (float) $line['precio'];
            $subtotal = (float) $line['subtotal'];
            $totalPaquete += $subtotal;

            $prod = $catalog[$id] ?? null;
            $name = $line['name'];
            $desc = $prod['description'] ?? ($prod['desc'] ?? null);
            $img  = $line['image'] ?? null;
            $emoji = $img ? null : ($id >= 1 && $id <= 5 ? '🎒' : ($id >= 20 ? '🧴' : '📦'));
          @endphp

          <div class="product-item">
            <div class="product-image">
              @if($img)
                <img src="{{ asset('image/productos/'.$img) }}" alt="{{ $name }}" style="max-width:100%;height:auto;border-radius:8px;">
              @else
                {{ $emoji }}
              @endif
            </div>

            <div class="product-main-info">
              <div class="product-name">{{ $name }}</div>
              @if($desc)
                <div class="product-description">{{ $desc }}</div>
              @endif
              <div class="product-details">
                <span class="product-id">ART{{ str_pad($id, 3, '0', STR_PAD_LEFT) }}</span>
                <span class="product-qty">x{{ $qty }}</span>
              </div>
            </div>

            <div class="product-price-section">
              <div class="product-unit-price">S/ {{ $mon($precio) }} c/u</div>
              <div class="product-total-price">S/ {{ $mon($subtotal) }}</div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="paquete-total">
        <span class="paquete-total-label">Total del Paquete:</span>
        <span class="paquete-total-amount">S/ {{ $mon($totalPaquete) }}</span>
      </div>
    </div>
  @endforeach
</div>

            <!-- Total -->
            <div class="total-section">
                <div class="total-amount">S/ {{ $mon($venta['total'] ?? 0) }}</div>
                <div class="total-label">Total Pagado (incluye impuestos)</div>
            </div>

            <!-- Botones de acción -->
            <div class="action-buttons">
                <a href="#" class="btn btn-primary">
                    📧 Ver Recibo por Email
                </a>
                <a href="#" class="btn btn-secondary">
                    📦 Rastrear Pedido
                </a>
                <a href="{{asset('/')}}" class="btn btn-secondary">
                    🏠 Ir al Inicio
                </a>
            </div>
        </div>
    </div>

    <script>
        // Crear partículas animadas
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 20;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Posición y tamaño aleatorios
                const size = Math.random() * 10 + 5;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 4) + 's';
                
                particlesContainer.appendChild(particle);
            }
        }

        // Funciones para los botones
        function downloadReceipt() {
            alert('¡Recibo enviado a tu email!');
        }

        function trackOrder() {
            alert('Redirigiendo al seguimiento de pedido...');
        }

        function goHome() {
            alert('Redirigiendo al inicio...');
        }

        // Inicializar al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
        });

        // Efecto de confeti al hacer clic en el ícono de éxito
        document.querySelector('.success-icon').addEventListener('click', function() {
            // Crear más partículas temporales
            for (let i = 0; i < 10; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'particle';
                confetti.style.background = `hsl(${Math.random() * 360}, 70%, 60%)`;
                confetti.style.width = '8px';
                confetti.style.height = '8px';
                confetti.style.position = 'fixed';
                confetti.style.left = '50%';
                confetti.style.top = '30%';
                confetti.style.transform = `translate(-50%, -50%)`;
                confetti.style.animation = `float 2s ease-out forwards`;
                confetti.style.zIndex = '1000';
                
                document.body.appendChild(confetti);
                
                // Animar hacia afuera
                setTimeout(() => {
                    confetti.style.transform = `translate(${(Math.random() - 0.5) * 400}px, ${Math.random() * 200 + 100}px)`;
                    confetti.style.opacity = '0';
                }, 100);
                
                // Remover después de la animación
                setTimeout(() => {
                    confetti.remove();
                }, 2000);
            }
        });
    </script>
</body>
</html>