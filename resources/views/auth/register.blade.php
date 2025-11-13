




<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Crear cuenta | @include ('global.name')</title>
@include ('global.icon')
<style>
  :root{
    --bg1:#f6f7fb;
    --bg2:#ffffff;
    --text:#111827;
    --muted:#6b7280;
    --line:#e5e7eb;
    --input-bg:#f3f4f6;
    --white:#fff;
    --brand:#f9e7b1;
    --brand-700:#f6eed7;
    --ring:0 0 0 3px rgba(220,38,38,.18);
    --card-shadow:0 12px 30px rgba(0,0,0,.08);
    --blur-bg:rgba(255,255,255,.72);
    --border-glass:rgba(255,255,255,.22);
    --radius:18px;
    --transition:all .2s ease;
  }

  *{box-sizing:border-box}
  html,body{height:100%}

  /* Vista estable: nada de centrar con flex que corta en móviles */
  body{
    margin:0;
    /* fallback viejo + unidades modernas que respetan la barra del navegador */
    min-height:100vh;
    min-height:100svh;
    min-height:100dvh;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, Arial;
    color:var(--text);
    background:
      radial-gradient(700px 400px at 80% 10%, rgba(220,38,38,.08), transparent 60%),
      linear-gradient(135deg, var(--bg1), var(--bg2));
    /* padding que respeta el notch y da respiro arriba/abajo */
    padding-top: max(24px, env(safe-area-inset-top));
    padding-right: max(16px, env(safe-area-inset-right));
    padding-bottom: max(24px, env(safe-area-inset-bottom));
    padding-left: max(16px, env(safe-area-inset-left));
    overflow-x:hidden;
  }

  .wrap{
    width:100%;
    max-width: 480px;
    margin: 0 auto;        /* centrado horizontal */
  }

  .header{ text-align:center; margin-bottom:24px }
  .logo{
    width:64px; height:64px; border-radius:16px; background:var(--brand);
    display:inline-flex; align-items:center; justify-content:center;
    box-shadow: var(--card-shadow); margin-bottom:12px;
  }
  .logo svg{ width:32px; height:32px; color:#fff }
  .title{ font-size:clamp(1.25rem, 2.5vw, 1.75rem); font-weight:800; margin:0 0 6px }
  .subtitle{ color:#6b7280; margin:0 }

  .card{
    background:var(--blur-bg); backdrop-filter: blur(8px);
    border:1px solid var(--border-glass);
    border-radius: var(--radius); box-shadow: var(--card-shadow);
    padding:20px;
  }
  @media(min-width:640px){ .card{ padding:28px } }

  .socials{ display:grid; gap:12px; margin-bottom:18px }
  .btn{
    width:100%; display:flex; align-items:center; justify-content:center; gap:10px;
    padding:12px 14px; border:1px solid var(--line); border-radius:12px;
    background:#fff; color:#374151; font-weight:600; cursor:default;
  }
  .btn svg{ width:20px; height:20px }
  .btn:hover{ background:#f9fafb }

  .divider{ position:relative; margin:18px 0 }
  .divider::before{ content:""; position:absolute; inset:0; height:1px; background:var(--line); top:50% }
  .divider span{ position:relative; display:inline-block; padding:0 10px; background:#fff; color:#6b7280; left:50%; transform:translateX(-50%) }

  form{ display:grid; gap:14px }
  .grid{ display:grid; gap:12px }
  @media(min-width:640px){ .grid--2{ grid-template-columns: 1fr 1fr } }

  label{ display:block; font-size:.92rem; font-weight:700; color:#374151; margin-bottom:6px }
  .input-wrap{ position:relative }
  .icon-left{
    position:absolute; left:10px; top:50%; transform:translateY(-50%);
    color:#9ca3af; width:18px; height:18px;
  }
  input[type="text"], input[type="email"], input[type="password"]{
    width:100%; font-size:1rem;
    padding:12px 14px 12px 40px;
    border:1px solid var(--line); border-radius:12px;
    background: var(--input-bg); transition:var(--transition);
  }
  input:focus{ outline:none; border-color:transparent; box-shadow: var(--ring); background:#fff }

  .hint{ font-size:.8rem; color:#6b7280; margin-top:4px }
  .error{ color:#b91c1c; font-size:.85rem; margin-top:6px }

  .cta{ display:flex; flex-direction:column; gap:12px; margin-top:6px }
  .btn-primary{
    background:var(--brand); color:#fff; border:1px solid var(--brand);
    border-radius: 12px; padding:12px 14px; font-weight:700; text-align:center;
  }
  .btn-primary:hover{ background:var(--brand-700) }
  .btn-primary:disabled{ background:#f87171 }

  .toggle{ text-align:center; margin-top:6px }
  .toggle a{ color:var(--brand); font-weight:700; text-decoration:none }
  .toggle a:hover{ color:var(--brand-700); text-decoration:underline }

  .terms{
    margin-top:18px; font-size:.78rem; color:#6b7280; text-align:center; line-height:1.6
  }
  .terms a{ color:var(--brand); font-weight:700; text-decoration:underline }
</style>
</head>
<body style="background:none">
  <main class="wrap">
    <header class="header">
      <a href="{{asset('/')}}"><div class="logo" aria-hidden="true"><img src="{{asset('image/logop.webp')}}" alt="" style="width:100%"></div></a>
      <h1 class="title">Crea tu cuenta</h1>
      <p class="subtitle">Únete a Amigurumis.pe</p>
    </header>

    <section class="card" style="background: none;  box-shadow: none;" >
      <div class="socials">
        <a href="{{ route('google.redirect') }}" class="btn" type="button">
          <svg xmlns="http://www.w3.org/2000/svg" class="provider-icon" width="20" height="30" viewBox="0 0 256 262" aria-label="Logotipo">
            <path fill="#4285F4" d="M255.85 133.45c0-10.41-.94-20.42-2.71-30.01H130.5v56.81h70.51c-3.04 16.47-12.38 30.42-26.38 39.78v33.09h42.7c25.01-23.05 39.42-57.01 39.42-99.67z"/>
            <path fill="#34A853" d="M130.5 261.1c35.55 0 65.38-11.74 87.18-31.97l-42.7-33.09c-11.85 7.96-27.01 12.64-44.48 12.64-34.17 0-63.08-23.05-73.45-54.06H13.3v33.89c21.7 43.1 66.26 72.59 117.2 72.59z"/>
            <path fill="#FBBC05" d="M57.05 154.62c-2.74-8.25-4.31-17.01-4.31-26.12s1.57-17.87 4.31-26.12V68.49H13.3C4.75 86.44 0 106.32 0 128.5s4.75 42.06 13.3 60.01l43.75-33.89z"/>
            <path fill="#EA4335" d="M130.5 50.95c19.37 0 36.83 6.67 50.56 19.78l37.93-37.93C195.88 12.22 166.05 0 130.5 0 79.56 0 34.99 29.49 13.3 72.59l43.75 33.89c10.37-31.02 39.28-54.07 73.45-54.07z"/>
        </svg>
          <span>Continuar con Google</span>
        </a>
        <button class="btn" type="button">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <path fill="#1877F2" d="M24 12.073C24 5.406 18.627 0 12 0S0 5.406 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078V12.07h3.047V9.412c0-3.007 1.792-4.668 4.533-4.668 1.313 0 2.686.235 2.686.235v2.953h-1.514c-1.492 0-1.955.928-1.955 1.88v2.257h3.328l-.532 3.493h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/>
          </svg>
          <span>Continuar con Facebook</span>
        </button>
        <button class="btn" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512" role="img" aria-label="Apple logo">
            <path fill="#000000" d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"/>
            <path fill="#000000" d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"/>
        </svg>
          <span>Continuar con Apple</span>
        </button>
      </div>

      <div class="divider" aria-hidden="true"><span>o continúa con email</span></div>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="grid grid--2">
          <div>
            <label for="first_name">Nombre</label>
            <div class="input-wrap">
              <svg class="icon-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              <input id="name" name="name" type="text" placeholder="Tu nombre" value="{{ old('first_name') }}" required autocomplete="given-name" />
            </div>
            @error('name') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div>
            <label for="last_name">Apellido</label>
            <div class="input-wrap">
              <svg class="icon-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
              </svg>
              <input id="lastname" name="lastname" type="text" placeholder="Tu apellido" value="{{ old('last_name') }}" required autocomplete="family-name" />
            </div>
            @error('lastname') <div class="error">{{ $message }}</div> @enderror
          </div>
        </div>

        <div>
          <label for="email">Correo electrónico</label>
          <div class="input-wrap">
            <svg class="icon-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" ry="2"></rect>
              <path d="M3 7l9 6 9-6"></path>
            </svg>
            <input id="email" name="email" type="email" placeholder="tu@email.com" value="{{ old('email') }}" required autocomplete="email" />
          </div>
          @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
          <label for="password">Contraseña</label>
          <div class="input-wrap">
            <svg class="icon-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <rect x="3" y="11" width="18" height="10" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <input id="password" name="password" type="password" placeholder="Tu contraseña" minlength="8" required autocomplete="new-password" />
          </div>
          <div class="hint">Mínimo 8 caracteres.</div>
          @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div>
          <label for="password_confirmation">Confirmar contraseña</label>
          <div class="input-wrap">
            <svg class="icon-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <rect x="3" y="11" width="18" height="10" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <input id="password-confirm" name="password_confirmation" type="password" placeholder="Confirma tu contraseña" minlength="8" required autocomplete="new-password" />
          </div>
          @error('password_confirmation') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="cta">
          <button type="submit" class="btn-primary" style="cursor:pointer">Crear cuenta</button>
          <div class="toggle">
            ¿Ya tienes cuenta?
            <a href="{{ route('login') }}">Inicia sesión</a>
          </div>
        </div>
      </form>

      <p class="terms">
        Al crear una cuenta, aceptas nuestros
        <a href="{{ url('terminos') }}">Términos de Servicio</a> y
        <a href="{{ url('privacidad') }}">Política de Privacidad</a>.
      </p>
    </section>
  </main>
</body>
</html>









