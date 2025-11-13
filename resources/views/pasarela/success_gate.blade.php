<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adler Emergency - Acceso</title>
    @include('global.icon')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Avenir', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #ffeda8;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 0;
            padding: 0;
            max-width: 1000px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .left-section {
            background: #fff5c5;
            padding: 60px 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .backpack-image {
            width: 100%;
            max-width: 350px;
            height: auto;
            opacity: 0.9;
        }

        .right-section {
            background: white;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            font-size: 32px;
            font-weight: 300;
            color: #a78b00;
            margin-bottom: 8px;
            letter-spacing: 2px;
        }

        .logo-subtitle {
            font-size: 11px;
            letter-spacing: 4px;
            color: #a78b00;
            text-transform: uppercase;
            margin-bottom: 50px;
            font-weight: 400;
        }

        h1 {
            font-size: 24px;
            font-weight: 400;
            color: #2d2d2d;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }

        .subtitle {
            font-size: 14px;
            color: #8a8a8a;
            margin-bottom: 40px;
            line-height: 1.6;
            font-weight: 300;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 400;
            color: #6a6a6a;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            font-size: 14px;
            border: 1px solid #e8d0d0;
            border-radius: 0;
            transition: all 0.3s ease;
            outline: none;
            background: #fafafa;
            color: #2d2d2d;
        }

        input:focus {
            border-color: #d8d690ff;
            background: white;
            box-shadow: 0 0 0 2px rgba(216, 144, 144, 0.1);
        }

        .btn {
            width: 100%;
            padding: 16px;
            font-size: 12px;
            font-weight: 500;
            color: white;
            background: #a78b00;
            border: none;
            border-radius: 0;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .btn:hover {
            background: #c9bf7a;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(216, 205, 144, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #a0a0a0;
            font-weight: 300;
        }

        .footer-text a {
            color: #c9a689;
            text-decoration: none;
            font-weight: 400;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
            }

            .left-section {
                display: none;
            }

            .right-section {
                padding: 50px 40px;
            }
        }

        @media (max-width: 600px) {
            .right-section {
                padding: 40px 30px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="{{asset('image/amigulogo.png')}}" alt="Amigurumis.pe" class="backpack-image">
        </div>

        <div class="right-section">
            <div class="logo"><a href="/" class="logo" style="text-decoration:none">Amigurumis</a> </div>
            <div class="logo-subtitle">Peru</div>

            <h1>Accede a tus productos</h1>
            <p class="subtitle">Inicia sesión con el correo electrónico que utilizaste para realizar tu compra</p>

            <form id="loginForm">
                

                <a href="{{url('login')}}"type="submit" class="btn">Iniciar sesión</a>
            </form>

            <p class="footer-text">
                ¿No encuentras tus productos? <a href="#">Contáctanos</a>
            </p>
        </div>
    </div>

    <script>
        const form = document.getElementById('loginForm');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Aquí iría la lógica de autenticación
            console.log('Intentando iniciar sesión con:', email);
            alert('Funcionalidad de inicio de sesión - Conectar con tu backend');
        });
    </script>
</body>
</html>