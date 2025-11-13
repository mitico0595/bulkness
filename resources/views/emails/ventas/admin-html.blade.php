@php
    $venta     = $receipt['venta']   ?? [];
    $cliente   = $receipt['cliente'] ?? [];
    $grupos    = $receipt['grupos']  ?? [];
    $isDelivery = ($cliente['tipo'] ?? 1) == 1;

    $subtotal = (float)($venta['subtotal'] ?? 0);
    $envio    = (float)($venta['cargo_envio'] ?? 0);
    $total    = (float)($venta['total'] ?? 0);
    $bruto    = $subtotal + $envio;
    $descuento = max(0, $bruto - $total);

    // intentar sacar cupón de varias fuentes
    $couponCode = $venta['coupon_code']
        ?? ($venta['cupon'] ?? null)
        ?? ($venta['coupon'] ?? null);

    // a veces lo mandas en venta['detalle'] como JSON {"coupon_code":"TODOGOOD", ...}
    if (!$couponCode && !empty($venta['detalle'])) {
        $detRaw = $venta['detalle'];
        if (is_string($detRaw)) {
            $detJson = json_decode($detRaw, true);
            if (is_array($detJson) && !empty($detJson['coupon_code'])) {
                $couponCode = $detJson['coupon_code'];
            }
        } elseif (is_array($detRaw) && !empty($detRaw['coupon_code'])) {
            $couponCode = $detRaw['coupon_code'];
        }
    }

    $mon = function($n){
        return 'S/ '.number_format((float)$n, 2, '.', '');
    };
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva venta - Amigurumis.pe</title>
    <meta name="color-scheme" content="light">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;background:#f5f5f5;padding:40px 20px;line-height:1.6;}
        .email-container{max-width:600px;margin:0 auto;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.08);}
        .header{background:#f9e7b1;padding:38px 20px;text-align:center;}
        .logo{font-size:32px;font-weight:300;letter-spacing:3px;color:#fff;}
        .logo span{font-style:italic;}
        .content{padding:48px 38px;}
        .confirmation-text{text-align:center;color:#666;margin-bottom:36px;font-size:15px;}
        .info-grid{display:grid;gap:20px;margin-bottom:44px;}
        .info-item{display:flex;justify-content:space-between;padding-bottom:14px;border-bottom:1px solid #f0f0f0;}
        .info-label{font-size:12px;text-transform:uppercase;letter-spacing:.5px;color:#999}
        .info-value{font-size:14px;color:#333;font-weight:500}
        .section-title{font-size:13px;text-transform:uppercase;letter-spacing:1px;color:#8B0000;margin:34px 0 20px 0;font-weight:600;}
        .client-info{background:#fafafa;padding:22px;border-radius:4px;margin-bottom:32px;}
        .client-detail{margin-bottom:7px;font-size:13.5px;color:#555}
        .client-detail strong{display:inline-block;min-width:90px;color:#333}
        table{border-collapse:collapse;width:100%}
        .products-table{margin-bottom:26px} 
        .products-table th{text-align:left;font-size:11.5px;text-transform:uppercase;letter-spacing:.5px;color:#999;font-weight:500;padding-bottom:14px;border-bottom:2px solid #f0f0f0;}
        .products-table td{padding:16px 0;font-size:13.5px;color:#333;border-bottom:1px solid #f5f5f5;}
        .products-table th:last-child,.products-table td:last-child{text-align:right;}
        .products-table th:nth-child(2),.products-table td:nth-child(2){text-align:center;}
        .total-section{text-align:right;padding-top:20px;border-top:2px solid #f0f0f0;margin-top:14px;}
        .resume-line{display:flex;justify-content:space-between;gap:10px;margin-bottom:5px;font-size:13px;color:#333}
        .resume-line small{color:#999}
        .resume-line.descuento{color:#b22222;font-weight:500}
        .total-label{font-size:12px;text-transform:uppercase;letter-spacing:1px;color:#999;margin:10px 0 6px 0}
        .total-amount{font-size:26px;color:#8B0000;font-weight:600}
        .note{background:#f9f9f9;padding:18px;border-left:3px solid #8B0000;margin-top:32px;font-size:12.5px;color:#666;}
        .footer{background:#1a1a1a;padding:34px 20px;text-align:center;}
        .footer-title{color:#fff;font-size:13px;margin-bottom:14px;font-weight:500}
        .social-links{display:flex;justify-content:center;gap:20px;margin-bottom:14px}
        .social-links a{color:#999;text-decoration:none;font-size:12px}
        .footer-text{color:#666;font-size:11px;margin-top:14px}
        @media(max-width:600px){.content{padding:34px 20px;}.info-item{flex-direction:column;align-items:flex-start;gap:3px}}
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <div class="logo"><span>A</span>migurumis</div>
    </div>
    <div class="content">
        <p class="confirmation-text">Se registró una nueva venta.</p>

        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Código</span>
                <span class="info-value">{{ $venta['codigo'] ?? '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Fecha</span>
                <span class="info-value">{{ $venta['fecha'] ?? now()->toDateTimeString() }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Modalidad</span>
                <span class="info-value">{{ $isDelivery ? 'ENVÍO' : 'RECOJO' }}</span>
            </div>
        </div>

        <div class="section-title">Cliente</div>
        <div class="client-info">
            <div class="client-detail"><strong>Nombre:</strong> {{ trim(($cliente['nombre'] ?? '').' '.($cliente['apellido'] ?? '')) ?: '-' }}</div>
            <div class="client-detail"><strong>Email:</strong> {{ $cliente['email'] ?? '-' }}</div>
            <div class="client-detail"><strong>DNI:</strong> {{ $cliente['dni'] ?? '-' }}</div>
            <div class="client-detail"><strong>Celular:</strong> {{ $cliente['celular'] ?? '-' }}</div>
            @if($isDelivery)
                <div class="client-detail"><strong>Dirección:</strong> {{ $cliente['envio']['domicilio'] ?? '-' }}</div>
                <div class="client-detail"><strong>Distrito / Prov.:</strong> {{ $cliente['envio']['distrito'] ?? '-' }} / {{ $cliente['envio']['provincia'] ?? '-' }}</div>
                <div class="client-detail"><strong>Depto.:</strong> {{ $cliente['envio']['departamento'] ?? '-' }}</div>
            @endif
        </div>

        @foreach($grupos as $idsub => $lineas)
            <div class="section-title">Paquete {{ $idsub }}</div>
            <table class="products-table">
                <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th>P.U</th>
                    <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lineas as $l)
                    <tr>
                        <td class="product-name">{{ $l['name'] ?? 'Artículo' }}</td>
                        <td>{{ $l['qty'] ?? 1 }}</td>
                        <td>{{ $mon($l['precio'] ?? 0) }}</td>
                        <td>{{ $mon($l['subtotal'] ?? 0) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach

        {{-- RESUMEN AL FINAL EN LA MISMA TABLA --}}
        <table class="products-table" style="margin-top:6px">
            <tbody>
            <tr>
                <td colspan="3" style="text-align:right;font-size:13px;color:#333;padding-top:14px;border:none">
                    Subtotal
                </td>
                <td style="text-align:right;font-size:13px;color:#333;padding-top:14px;border:none">
                    {{ $mon($subtotal) }}
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;font-size:13px;color:#333;border:none">
                    Envío
                </td>
                <td style="text-align:right;font-size:13px;color:#333;border:none">
                    {{ $mon($envio) }}
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;font-size:13px;color:#b22222;border:none">
                    Descuento{{ $couponCode ? ' ('.strtoupper($couponCode).')' : '' }}

                </td>
                <td style="text-align:right;font-size:13px;color:#b22222;border:none">
                    -{{ $mon($descuento ?: 0) }}
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:right;font-size:12px;text-transform:uppercase;letter-spacing:1px;color:#999;border-top:2px solid #f0f0f0;padding-top:14px">
                    Total pagado
                </td>
                <td style="text-align:right;font-size:26px;color:#8B0000;font-weight:600;border-top:2px solid #f0f0f0;padding-top:10px">
                    {{ $mon($total) }}
                </td>
            </tr>
            </tbody>
        </table>


        <div class="note">
            Puedes verlo también en el panel de administración.
        </div>
    </div>
    <div class="footer">
        <div class="footer-title">Amigurumis.pe • Amigurumis personalizados</div>
        <div class="social-links" style="display:block">
            <a href="{{ env('MAIL_WHATSAPP_URL', '#') }}">WhatsApp - </a>
            <a href="{{ env('MAIL_INSTAGRAM_URL', '#') }}">- Instagram - </a>
            <a href="{{ env('MAIL_FACEBOOK_URL', '#') }}">- Facebook</a>
        </div>
        <div class="footer-text">{{ date('Y') }} Amigurumis.pe. Todos los derechos reservados.</div>
    </div>
</div>
</body>
</html>
