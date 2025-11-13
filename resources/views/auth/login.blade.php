<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>@include ('global.name') — LOGIN</title>
   @include ('global.icon')
<style>
  :root{
    --bg-start:#f9fafb;
    --bg-end:#ffffff;
    --text:#111827;   /* gray-900 */
    --muted:#6b7280;  /* gray-500/600 */
    --line:#d1d5db;   /* gray-300 */
    --input-bg:#f3f4f6; /* gray-100/50 */
    --white:#fff;
    --card-shadow:0 10px 25px rgba(0,0,0,.06);
    --brand: #f9e7b1;  /* red-600 */
    --brand-700: #f6eed7ff; /* red-700 */
    --ring:0 0 0 3px rgba(220,38,38,.2);
    --radius:12px;
    --radius-sm:10px;
    --radius-lg:16px;
    --transition:all .2s ease;
  }

  *{box-sizing:border-box}
  html,body{height:100%}
  a{text-decoration:none}
  body{
    margin:0;
    min-height:100vh;
    font-family: ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji","Segoe UI Emoji";
    color:var(--text);
    background: linear-gradient(135deg, var(--bg-start), var(--bg-end));
    display:flex;
    align-items:center;
    justify-content:center;
    padding:2rem 1rem;
  }

  .auth-wrap{
    width:100%;
    max-width: 420px;
  }

  .logo{
    width:80px;height:80px;border-radius:999px;
    background:var(--brand);
    display:flex;align-items:center;justify-content:center;
    margin:0 auto 1rem;
    box-shadow:var(--card-shadow);
  }
  .logo span{color:#fff;font-weight:800;font-size:32px;font-family:ui-serif, Georgia, "Times New Roman", Times, serif}

  .center{text-align:center}
  .title{font-size:1.5rem;font-weight:800;margin:0 0 .25rem}
  .subtitle{color:#4b5563;margin:0 0 1.5rem}

  /* Buttons */
  .btn{
    width:100%;
    display:flex;align-items:center;justify-content:center;
    padding:.85rem 1rem;
    border:1px solid var(--line);
    border-radius: var(--radius-sm);
    background:var(--white);
    color:#374151;
    font-weight:600;
    cursor:pointer;
    transition:var(--transition);
    gap:.6rem;
  }
  .btn:hover{background:#f9fafb}
  .btn:disabled{opacity:.55;cursor:not-allowed}

  .btn-primary{
    background:var(--brand);
    border-color:var(--brand);
    color:#fff;
  }
  .btn-primary:hover{background:var(--brand-700)}
  .btn-outline-red{
    background:transparent;
    color:var(--brand);
    border-color:var(--brand);
  }
  .btn-outline-red:hover{background:rgba(220, 208, 38, 0.06)}
  .btn:focus-visible{outline:none;box-shadow:var(--ring)}

  .provider-icon{
    width:20px;height:20px;display:inline-flex;align-items:center;justify-content:center;
  }

  /* Spinner */
  .spinner{
    width:20px;height:20px;border:2px solid #d1d5db;border-top-color:#4b5563;border-radius:999px;
    animation:spin 1s linear infinite;
  }
  .spinner--white{
    border-color: rgba(255,255,255,.6);
    border-top-color: rgba(255,255,255,1);
  }
  @keyframes spin {to{transform:rotate(360deg)}}

  /* Divider */
  .divider{position:relative;margin:1.5rem 0}
  .divider::before{
    content:"";position:absolute;inset:0;height:1px;background:var(--line);top:50%;
  }
  .divider span{
    position:relative;display:inline-block;padding:0 .75rem;background:var(--white);color:#6b7280;font-weight:600;
    left:50%;transform:translateX(-50%);
  }

  /* Form */
  form{display:grid;gap:1rem}
  label{display:block;font-size:.9rem;font-weight:600;color:#374151;margin:0 0 .5rem}
  .input-wrap{position:relative}
  .icon-left{
    position:absolute;left:.75rem;top:50%;transform:translateY(-50%);
    color:#9ca3af; /* gray-400 */
    width:20px;height:20px;
  }
  .icon-right-btn{
    position:absolute;right:.6rem;top:50%;transform:translateY(-50%);
    color:#9ca3af;background:transparent;border:0;cursor:pointer;padding:.25rem;border-radius:8px;
  }
  .icon-right-btn:hover{color:#6b7280}
  input[type="email"], input[type="password"], input[type="text"]{
    width:100%;padding:.85rem 2.8rem .85rem 2.6rem;border:1px solid var(--line);border-radius:var(--radius-sm);
    background: var(--input-bg); transition:var(--transition); font-size:1rem;
  }
  input:focus{outline:none;border-color:transparent;box-shadow:var(--ring);background:#fff}

  .text-right{text-align:right}
  .link{
    color:var(--brand);font-weight:600;text-decoration:none;
  }
  .link:hover{color:var(--brand-700);text-decoration:underline}

  .row{display:flex;gap:1rem}
  .row > *{flex:1}

  /* Terms */
  .terms{
    margin-top:1.5rem;text-align:center;color:#6b7280;font-size:.78rem;line-height:1.6
  }
  .terms .link{font-weight:700}

  /* Card feel for the center area */
  .card{
    background:var(--white);
    border:1px solid #eef2f7;
    border-radius: var(--radius);
    padding:1.25rem;
    box-shadow: var(--card-shadow);
  }

  /* Layout */
  .screen{
    width:100%;
    display:flex;align-items:center;justify-content:center;
  }

  /* Responsive tweaks */
  @media(min-width:480px){
    .card{padding:1.5rem}
  }
  @media(min-width:640px){
    .card{padding:2rem}
  }
</style>
</head>
<body>
  <main class="auth-wrap">
    <!-- Header / Logo -->
    <section class="center" aria-label="Bienvenida">
      <a href="{{asset('/')}}"><div class="logo" aria-hidden="true"><img src="{{asset('image/logop.webp')}}" alt="" style="width:100%"></div></a>
      <h1 class="title">Bienvenido</h1>
      <p class="subtitle">Inicia sesión en tu cuenta</p>
    </section>

    <!-- Card wrapper to get the same Tailwind look -->
    <section class="card" aria-label="Acceso" style="box-shadow:none;border:none;background:none">
      <!-- Social buttons -->
      <div style="display:grid;gap:.75rem;margin-bottom:1rem">
        <!-- Google -->
        <a href="{{ route('google.redirect') }}" class="btn" type="button" id="btn-google">
          
          <svg xmlns="http://www.w3.org/2000/svg" class="provider-icon" width="20" height="30" viewBox="0 0 256 262" aria-label="Logotipo">
              <path fill="#4285F4" d="M255.85 133.45c0-10.41-.94-20.42-2.71-30.01H130.5v56.81h70.51c-3.04 16.47-12.38 30.42-26.38 39.78v33.09h42.7c25.01-23.05 39.42-57.01 39.42-99.67z"/>
              <path fill="#34A853" d="M130.5 261.1c35.55 0 65.38-11.74 87.18-31.97l-42.7-33.09c-11.85 7.96-27.01 12.64-44.48 12.64-34.17 0-63.08-23.05-73.45-54.06H13.3v33.89c21.7 43.1 66.26 72.59 117.2 72.59z"/>
              <path fill="#FBBC05" d="M57.05 154.62c-2.74-8.25-4.31-17.01-4.31-26.12s1.57-17.87 4.31-26.12V68.49H13.3C4.75 86.44 0 106.32 0 128.5s4.75 42.06 13.3 60.01l43.75-33.89z"/>
              <path fill="#EA4335" d="M130.5 50.95c19.37 0 36.83 6.67 50.56 19.78l37.93-37.93C195.88 12.22 166.05 0 130.5 0 79.56 0 34.99 29.49 13.3 72.59l43.75 33.89c10.37-31.02 39.28-54.07 73.45-54.07z"/>
          </svg>

          <span>Continuar con Google</span>
        </a>

        <!-- Facebook -->
        <button class="btn" type="button" id="btn-facebook">
          <svg class="provider-icon" viewBox="0 0 24 24" aria-hidden="true">
            <path fill="#1877F2" d="M24 12.073C24 5.406 18.627 0 12 0S0 5.406 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078V12.07h3.047V9.412c0-3.007 1.792-4.668 4.533-4.668 1.313 0 2.686.235 2.686.235v2.953h-1.514c-1.492 0-1.955.928-1.955 1.88v2.257h3.328l-.532 3.493h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/>
          </svg>
          <span>Continuar con Facebook</span>
        </button>

        <!-- Apple -->
        <button class="btn" type="button" id="btn-apple">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512" role="img" aria-label="Apple logo">
            <path fill="#000000" d="M349.13,136.86c-40.32,0-57.36,19.24-85.44,19.24C234.9,156.1,212.94,137,178,137c-34.2,0-70.67,20.88-93.83,56.45-32.52,50.16-27,144.63,25.67,225.11,18.84,28.81,44,61.12,77,61.47h.6c28.68,0,37.2-18.78,76.67-19h.6c38.88,0,46.68,18.89,75.24,18.89h.6c33-.35,59.51-36.15,78.35-64.85,13.56-20.64,18.6-31,29-54.35-76.19-28.92-88.43-136.93-13.08-178.34-23-28.8-55.32-45.48-85.79-45.48Z"/>
            <path fill="#000000" d="M340.25,32c-24,1.63-52,16.91-68.4,36.86-14.88,18.08-27.12,44.9-22.32,70.91h1.92c25.56,0,51.72-15.39,67-35.11C333.17,85.89,344.33,59.29,340.25,32Z"/>
        </svg>

          <span>Continuar con Apple</span>
        </button>
      </div>

      <!-- Divider -->
      <div class="divider" aria-hidden="true"><span>o</span></div>

      <!-- Email form -->
      <form method="POST" action="{{ route('login') }}">
         @csrf
        <!-- Email -->
        <div>
          <label for="email">Correo electrónico</label>
          <div class="input-wrap">
            <svg class="icon-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" ry="2"></rect>
              <path d="M3 7l9 6 9-6"></path>
            </svg>
            <input id="email" name="email" type="email" placeholder="tu@email.com" required />
          </div>
        </div>

        <!-- Password -->
        <div>
          <label for="password">Contraseña</label>
          <div class="input-wrap">
            <svg class="icon-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <rect x="3" y="11" width="18" height="10" rx="2" ry="2"></rect>
              <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <input id="password" name="password" type="password" placeholder="••••••••" required />
            <button class="icon-right-btn" type="button" id="toggle-password" aria-label="Mostrar u ocultar contraseña">
              <!-- eye (default) -->
              <svg id="eye" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"></path>
                <circle cx="12" cy="12" r="3"></circle>
              </svg>
              <!-- eye-off (hidden by default) -->
              <svg id="eye-off" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" style="display:none">
                <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20C5 20 1 12 1 12a18.49 18.49 0 0 1 5.06-5.94"></path>
                <path d="M10.58 10.58A3 3 0 0 0 12 15a3 3 0 0 0 2.42-4.42"></path>
                <path d="M1 1l22 22"></path>
              </svg>
            </button>
          </div>
          @error('password')
            <div style="color:#b91c1c;font-size:.85rem;margin-top:.35rem">{{ $message }}</div>
          @enderror
        </div>

        <div class="text-right">
          <a href="#" class="link">¿Olvidaste tu clave?</a>
        </div>

        <div class="row" style="padding-top:.5rem">
          <a href="{{asset('register')}}" class="btn btn-outline-red">Crear Cuenta</a>
          <button type="submit" id="btn-submit" class="btn btn-primary">
            <span class="btn-text">Ingresar</span>
            <span class="spinner spinner--white" style="display:none" aria-hidden="true"></span>
          </button>
        </div>
      </form>

      <!-- Terms -->
      <p class="terms">
        Al iniciar sesión aceptas los <a class="link" href="#">términos y condiciones</a> de Oberiu,
        para mayor información <a class="link" href="#">clic aquí</a>.
      </p>
    </section>
  </main>

<script>
  // Toggle de contraseña, porque a veces la gente quiere ver lo que escribe.
  (function(){
    const pwd = document.getElementById('password');
    const toggle = document.getElementById('toggle-password');
    const eye = document.getElementById('eye');
    const eyeOff = document.getElementById('eye-off');

    toggle.addEventListener('click', function(){
      const show = pwd.getAttribute('type') === 'password';
      pwd.setAttribute('type', show ? 'text' : 'password');
      eye.style.display = show ? 'none' : 'inline';
      eyeOff.style.display = show ? 'inline' : 'none';
    });

    // Demo de “loading” al enviar. Quítalo cuando conectes backend.
    const form = document.querySelector('form');
     if (form) {
      const submitBtn = form.querySelector('button[type="submit"]');
      const spinner = submitBtn ? submitBtn.querySelector('.spinner') : null;
      const btnText = submitBtn ? submitBtn.querySelector('.btn-text') : null;

      form.addEventListener('submit', function(){
        if (submitBtn) submitBtn.disabled = true;
        if (spinner) spinner.style.display = 'inline-block';
        if (btnText) btnText.style.display = 'none';
        // Dejar que el navegador haga el POST a Laravel.
      });
    }

    // Social buttons demo
    
    document.getElementById('btn-facebook').addEventListener('click', ()=>alert('Desactivado'));
    document.getElementById('btn-apple').addEventListener('click', ()=>alert('Desactivado'));
  })();
</script>
</body>
</html>

