
{{-- resources/views/support.blade.php --}}
@php
    $continueUrl = (string) config('support.continue_url');

    $phoneRaw = (string) config('support.phone');
    // Para tel: limpiamos a dígitos y +
    $phoneTel = preg_replace('/[^+\d]/', '', $phoneRaw ?? '');

    // Número "bonito" para mostrar: intenta formatear (+51) 983 814 992 si es peruano
    $pretty = $phoneTel;
    if (Str::startsWith($phoneTel, ['+51','51'])) {
        $digits = preg_replace('/\D+/', '', $phoneTel);
        $digits = ltrim($digits, '51'); // quita prefijo 51 si está duplicado
        if (strlen($digits) === 9) {
            $pretty = '(+51) ' . substr($digits,0,3) . ' ' . substr($digits,3,3) . ' ' . substr($digits,6,3);
        }
    }

    // WhatsApp
    $waNumberRaw = (string) data_get(config('support.whatsapp'), 'number');
    $waNumber = preg_replace('/\D+/', '', $waNumberRaw ?? ''); // wa.me exige solo dígitos
    $waMsg = (string) data_get(config('support.whatsapp'), 'message');
    $waUrl = $waNumber ? 'https://wa.me/' . $waNumber . '?text=' . urlencode($waMsg) : null;

    // Facebook
    $fbHandle = (string) data_get(config('support.facebook'), 'page');
    $fbUrl = $fbHandle ? 'https://www.facebook.com/' . ltrim($fbHandle, '/') : null;
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención al Cliente</title>
    @include ('global.icon')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, sans-serif; background: linear-gradient(to bottom right, #f9fafb, #e5e7eb); min-height: 100vh; }
        .container { max-width: 1280px; margin: 0 auto; padding: 2rem 1rem; }
        @media (min-width: 768px) { .container { padding: 4rem 1rem; } }
        .card-wrapper { max-width: 56rem; margin: 0 auto; }
        .card { background: #fff; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,.1), 0 10px 10px -5px rgba(0,0,0,.04); overflow: hidden; border: 1px solid #f3f4f6; }
        .card-content { padding: 1.5rem; }
        @media (min-width: 768px) { .card-content { padding: 3rem; } }
        .header { display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 3rem; }
        @media (min-width: 768px) { .header { flex-direction: row; align-items: flex-start; justify-content: space-between; } }
        .btn-primary { display:inline-flex; align-items:center; justify-content:center; padding:.875rem 2rem; background:#fff; border:2px solid #dc2626; color:#dc2626; border-radius:9999px; font-weight:600; font-size:1rem; cursor:pointer; transition:all .25s ease; box-shadow:0 1px 2px rgba(0,0,0,.05); text-decoration:none; }
        .btn-primary:hover { background:#dc2626; color:#fff; box-shadow:0 4px 6px -1px rgba(0,0,0,.1), 0 2px 4px -1px rgba(0,0,0,.06); }
        .header-title { text-align:right; }
        .header-title h2 { font-size:1.125rem; font-weight:600; color:#111827; }
        .sections { display:flex; flex-direction:column; gap:3rem; }
        .section h3 { font-size:1.5rem; font-weight:700; color:#111827; margin-bottom:1.25rem; }
        .section.subtitle h3 { font-size:1.125rem; font-weight:600; color:#6b7280; }
        .phone-link { display:inline-flex; align-items:center; gap:1rem; text-decoration:none; transition: transform .25s ease; }
        .phone-link:hover { transform: translateX(.25rem); }
        .icon-wrapper { width:3rem; height:3rem; display:flex; align-items:center; justify-content:center; border-radius:1rem; background:#fee2e2; transition: background-color .25s ease; }
        .phone-link:hover .icon-wrapper { background:#fecaca; }
        .icon-red { width:1.5rem; height:1.5rem; color:#dc2626; }
        .phone-number { font-size:1.25rem; color:#dc2626; font-weight:700; }
        .info-card { display:flex; align-items:flex-start; gap:1rem; background:#f9fafb; border-radius:.75rem; padding:1.25rem; }
        .icon-wrapper-gray { width:2.75rem; height:2.75rem; min-width:2.75rem; display:flex; align-items:center; justify-content:center; border-radius:.75rem; background:#fff; }
        .icon-gray { width:1.25rem; height:1.25rem; color:#374151; }
        .info-text p:first-child { font-weight:600; color:#111827; margin-bottom:.25rem; }
        .info-text p:last-child { color:#4b5563; }
        .virtual-channels { display:flex; flex-direction:column; gap:1.5rem; }
        .label-text { font-size:.875rem; color:#6b7280; margin-bottom:1rem; }
        .whatsapp-wrapper { display:inline-flex; align-items:center; justify-content:center; width:3rem; height:3rem; border-radius:1rem; background:#6fc68d; cursor:pointer;padding:10px; transition: background-color .25s ease; position:relative; }
        .whatsapp-wrapper:hover { background:#bbf7d0; }
        .icon-green { width:2rem; height:2rem; color:#16a34a; }
        .qr { position:absolute; top:110%; left:50%; transform:translateX(-50%); background:#fff; border:1px solid #e5e7eb; border-radius:.75rem; padding:.75rem; box-shadow:0 10px 20px rgba(0,0,0,.08); display:none; }
        .whatsapp-wrapper:focus .qr, .whatsapp-wrapper:hover .qr { display:block; }
        .facebook-link { display:inline-flex; align-items:center; gap:.75rem; text-decoration:none; transition: transform .25s ease; }
        .facebook-link:hover { transform: translateX(.25rem); }
        .icon-wrapper-blue { width:3rem; height:3rem; display:flex; align-items:center; justify-content:center; border-radius:1rem; background:#dbeafe; transition: background-color .25s ease; }
        .facebook-link:hover .icon-wrapper-blue { background:#bfdbfe; }
        .icon-blue { width:1.5rem; height:1.5rem; color:#2563eb; }
        .facebook-text { color:#2563eb; font-weight:600; }
        .facebook-link:hover .facebook-text { text-decoration:underline; }
        .muted { color:#6b7280; font-size:.75rem; margin-top:.5rem; }
        .row { display:grid; grid-template-columns: 1fr; gap:1.25rem; }
        @media (min-width: 768px) { .row { grid-template-columns: 1fr 1fr; } }
        .hidden { display:none !important; }
    </style>
</head>
<body>
<div class="container">
  <div class="card-wrapper">
    <div class="card">
      <div class="card-content">
        <div class="header">
          <a class="btn-primary" href="{{ $continueUrl }}">Continuar comprando</a>
          <div class="header-title">
            <h2>{{ config('support.texts.callcenter_title') }}</h2>
          </div>
        </div>

        <div class="sections">
          {{-- Teléfono --}}
          @if($phoneTel)
          <section class="section">
            <h3>Número empresa:</h3>
            <a href="tel:{{ $phoneTel }}" class="phone-link" aria-label="Llamar por teléfono">
              <div class="icon-wrapper">
                <svg class="icon-red" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
              </div>
              <span class="phone-number">{{ $pretty }}</span>
            </a>
            <p class="muted">En móvil abrirá el marcador; en escritorio dependerá de tus apps asociadas.</p>
          </section>
          @endif

          {{-- Horario callcenter --}}
          <section class="section subtitle">
            <h3>{{ config('support.texts.callcenter_sched_title') }}</h3>
            <div class="info-card">
              <div class="icon-wrapper-gray">
                <svg class="icon-gray" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <div class="info-text">
                <p>{{ config('support.texts.callcenter_sched_l1') }}</p>
                <p>{{ config('support.texts.callcenter_sched_l2') }}</p>
              </div>
            </div>
          </section>

          {{-- Virtuales --}}
          <section class="section subtitle">
            <h3>{{ config('support.texts.virtual_title') }}</h3>
            <div class="virtual-channels">
              <div class="info-card">
                <div class="icon-wrapper-gray">
                  <svg class="icon-gray" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </div>
                <div class="info-text">
                  <p>{{ config('support.texts.virtual_sched_l1') }}</p>
                  <p>{{ config('support.texts.virtual_sched_l2') }}</p>
                </div>
              </div>

              <div class="row">
                {{-- WhatsApp --}}
                <div>
                  <p class="label-text">WhatsApp: Has clic aqui para continuar</p>
                  <a @if($waUrl) href="{{ $waUrl }}" @endif class="whatsapp-wrapper" aria-label="Abrir chat de WhatsApp" target="_blank" rel="noopener">
                    <img src="{{asset('image/svg/whatsapp.svg')}}" alt="">
                    <div id="qr" class="qr" aria-hidden="true"></div>
                  </a>
                  <p class="muted">Mensaje prellenado: “{{ $waMsg }}”</p>
                </div>

                {{-- Facebook --}}
                @if($fbUrl)
                <div>
                  <p class="label-text">Facebook: Comunícate con nuestros agentes o con el bot</p>
                  <a href="{{ $fbUrl }}" target="_blank" rel="noopener" class="facebook-link" aria-label="Ir a Facebook">
                    <div class="icon-wrapper-blue">
                      <svg class="icon-blue" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                      </svg>
                    </div>
                    <span class="facebook-text">facebook.com/{{ $fbHandle }}</span>
                  </a>
                </div>
                @endif
              </div>

            </div>
          </section>
        </div>

      </div>
    </div>
  </div>
</div>

{{-- QR simple para el enlace de WhatsApp --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-MBK4VQIj1GQ3e1u0M4mHKP+0zH3v9U0yTFI2T9qVqOeW1oQ1uUxw3nVv7QzU3i0z1xz0zVtnZxU9F4hQX2S1bA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  (function(){
    var wa = @json($waUrl);
    if(!wa) return;
    var el = document.getElementById('qr');
    if(!el) return;
    new QRCode(el, { text: wa, width: 148, height: 148, correctLevel: QRCode.CorrectLevel.M });
  })();
</script>
</body>
</html>
