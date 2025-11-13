<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loader Elegante</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #0f0f23, #1a1a2e, #16213e);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
            font-family: 'Arial', sans-serif;
        }

        .loader-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .logo-wrapper {
            position: relative;
            z-index: 10;
        }

        .logo-svg {
            width: 200px;
            height: auto;
            filter: drop-shadow(0 0 20px rgba(99, 102, 241, 0.5));
        }

        /* Animaciones para las letras */
        .letter-1 {
            animation: letterPulse 2s ease-in-out infinite;
            animation-delay: 0s;
            transform-origin: center;
        }

        .letter-2 {
            animation: letterPulse 2s ease-in-out infinite;
            animation-delay: 0.2s;
            transform-origin: center;
        }

        .letter-3 {
            animation: letterPulse 2s ease-in-out infinite;
            animation-delay: 0.4s;
            transform-origin: center;
        }

        .letter-4 {
            animation: letterPulse 2s ease-in-out infinite;
            animation-delay: 0.6s;
            transform-origin: center;
        }

        .letter-5 {
            animation: letterPulse 2s ease-in-out infinite;
            animation-delay: 0.8s;
            transform-origin: center;
        }

        /* Círculos orbitales */
        .orbital-ring {
            position: absolute;
            border: 2px solid rgba(99, 102, 241, 0.3);
            border-radius: 50%;
            animation: rotate 8s linear infinite;
        }

        .ring-1 {
            width: 280px;
            height: 280px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .ring-2 {
            width: 320px;
            height: 320px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-direction: reverse;
            animation-duration: 12s;
            border-color: rgba(168, 85, 247, 0.3);
        }

        .ring-3 {
            width: 360px;
            height: 360px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-duration: 15s;
            border-color: rgba(34, 197, 94, 0.3);
        }

        /* Partículas orbitales */
        .orbital-dot {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: linear-gradient(45deg, #6366f1, #8b5cf6);
            box-shadow: 0 0 10px rgba(99, 102, 241, 0.8);
        }

        .dot-1 {
            top: -4px;
            left: 50%;
            transform: translateX(-50%);
            animation: orbitDot 8s linear infinite;
        }

        .dot-2 {
            top: -4px;
            left: 50%;
            transform: translateX(-50%);
            animation: orbitDot 12s linear infinite reverse;
            background: linear-gradient(45deg, #a855f7, #ec4899);
            box-shadow: 0 0 10px rgba(168, 85, 247, 0.8);
        }

        .dot-3 {
            top: -4px;
            left: 50%;
            transform: translateX(-50%);
            animation: orbitDot 15s linear infinite;
            background: linear-gradient(45deg, #22c55e, #10b981);
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.8);
        }

        /* Barras de progreso elegantes */
        .progress-container {
            margin-top: 60px;
            width: 300px;
        }

        .progress-bar {
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, 
                #6366f1 0%, 
                #8b5cf6 25%, 
                #a855f7 50%, 
                #ec4899 75%, 
                #22c55e 100%);
            border-radius: 2px;
            animation: progressFill 3s ease-in-out infinite;
            position: relative;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(255, 255, 255, 0.3) 50%, 
                transparent 100%);
            animation: progressShine 2s ease-in-out infinite;
        }

        /* Texto de carga */
        .loading-text {
            margin-top: 30px;
            color: #ffffff;
            font-size: 18px;
            font-weight: 300;
            letter-spacing: 2px;
            text-align: center;
            opacity: 0.8;
            animation: textFade 2s ease-in-out infinite alternate;
        }

        .loading-dots {
            animation: dots 1.5s linear infinite;
        }

        /* Efecto de resplandor de fondo */
        .glow-bg {
            position: absolute;
            width: 500px;
            height: 500px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, 
                rgba(99, 102, 241, 0.1) 0%, 
                rgba(168, 85, 247, 0.05) 30%, 
                transparent 70%);
            animation: glowPulse 4s ease-in-out infinite;
            border-radius: 50%;
        }

        /* Partículas flotantes */
        .floating-particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: floatUp 6s linear infinite;
        }

        .particle-1 { left: 10%; animation-delay: 0s; }
        .particle-2 { left: 20%; animation-delay: 1s; }
        .particle-3 { left: 30%; animation-delay: 2s; }
        .particle-4 { left: 70%; animation-delay: 1.5s; }
        .particle-5 { left: 80%; animation-delay: 0.5s; }
        .particle-6 { left: 90%; animation-delay: 2.5s; }

        /* Keyframes */
        @keyframes letterPulse {
            0%, 100% { 
                transform: scale(1); 
                fill: #6366f1;
                filter: drop-shadow(0 0 5px rgba(99, 102, 241, 0.5));
            }
            50% { 
                transform: scale(1.05); 
                fill: #8b5cf6;
                filter: drop-shadow(0 0 15px rgba(139, 92, 246, 0.8));
            }
        }

        @keyframes rotate {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        @keyframes orbitDot {
            0% { transform: translateX(-50%) rotate(0deg) translateX(140px) rotate(0deg); }
            100% { transform: translateX(-50%) rotate(360deg) translateX(140px) rotate(-360deg); }
        }

        @keyframes progressFill {
            0% { transform: scaleX(0); transform-origin: left; }
            50% { transform: scaleX(1); transform-origin: left; }
            51% { transform: scaleX(1); transform-origin: right; }
            100% { transform: scaleX(0); transform-origin: right; }
        }

        @keyframes progressShine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        @keyframes textFade {
            0% { opacity: 0.5; }
            100% { opacity: 1; }
        }

        @keyframes dots {
            0%, 20% { content: ''; }
            40% { content: '.'; }
            60% { content: '..'; }
            80%, 100% { content: '...'; }
        }

        @keyframes glowPulse {
            0%, 100% { 
                transform: translate(-50%, -50%) scale(1); 
                opacity: 0.3; 
            }
            50% { 
                transform: translate(-50%, -50%) scale(1.1); 
                opacity: 0.1; 
            }
        }

        @keyframes floatUp {
            0% {
                transform: translateY(100vh) translateX(0px);
                opacity: 0;
            }
            10% { opacity: 0.8; }
            90% { opacity: 0.8; }
            100% {
                transform: translateY(-100px) translateX(20px);
                opacity: 0;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .logo-svg { width: 150px; }
            .progress-container { width: 250px; }
            .ring-1 { width: 220px; height: 220px; }
            .ring-2 { width: 250px; height: 250px; }
            .ring-3 { width: 280px; height: 280px; }
        }
    </style>
</head>
<body>
    <div class="loader-container">
        <div class="glow-bg"></div>
        
        <!-- Anillos orbitales -->
        <div class="orbital-ring ring-1">
            <div class="orbital-dot dot-1"></div>
        </div>
        <div class="orbital-ring ring-2">
            <div class="orbital-dot dot-2"></div>
        </div>
        <div class="orbital-ring ring-3">
            <div class="orbital-dot dot-3"></div>
        </div>

        <!-- Logo SVG animado -->
        <div class="logo-wrapper">
            <svg class="logo-svg" version="1.0" xmlns="http://www.w3.org/2000/svg" 
                 width="200" height="112" viewBox="0 0 1863.000000 1047.000000" 
                 preserveAspectRatio="xMidYMid meet">
                <g transform="translate(0.000000,1047.000000) scale(0.100000,-0.100000)" 
                   fill="#6366f1" stroke="none">
                    
                    <path class="letter-1" d="M4310 9459 c-30 -5 -60 -15 -66 -22 -6 -6 -34 -70 -63 -142 -62 -155
                    -65 -163 -79 -195 -6 -14 -81 -198 -167 -410 -178 -437 -168 -413 -189 -462
                    -9 -20 -16 -39 -16 -42 0 -3 -9 -25 -19 -49 -11 -23 -83 -199 -161 -392 -78
                    -192 -148 -364 -156 -382 -8 -17 -14 -34 -14 -37 0 -3 -9 -25 -19 -49 -14 -31
                    -274 -667 -360 -882 -5 -11 -13 -31 -19 -45 -6 -14 -66 -160 -132 -325 -160
                    -395 -164 -403 -201 -423 -349 -190 -527 -475 -506 -810 6 -87 13 -126 58
                    -284 l13 -46 -84 -204 c-216 -528 -349 -780 -494 -935 -157 -168 -271 -220
                    -644 -294 -68 -13 -77 -24 -70 -90 l3 -34 1090 0 1090 0 3 49 c2 27 -1 53 -5
                    57 -5 5 -67 20 -138 34 -453 89 -613 168 -659 329 -41 142 4 338 203 886 83
                    230 119 328 197 538 20 53 51 141 70 195 19 54 45 122 59 153 23 52 28 57 97
                    88 180 81 350 135 568 179 133 27 367 60 379 53 4 -3 1 -73 -7 -158 -9 -101
                    -11 -231 -8 -383 6 -260 16 -365 51 -546 89 -454 266 -769 530 -944 148 -97
                    285 -138 470 -138 145 -1 211 11 375 66 l125 42 -45 8 c-124 23 -222 51 -287
                    81 -487 231 -781 888 -819 1829 l-7 167 64 0 c195 -1 682 -42 770 -66 9 -3 24
                    -26 34 -52 41 -114 119 -320 145 -387 5 -11 24 -63 43 -115 19 -52 51 -138 70
                    -190 19 -52 56 -153 82 -225 26 -71 57 -159 70 -195 13 -36 31 -85 39 -110 8
                    -25 34 -97 56 -160 130 -365 190 -564 190 -629 0 -72 -41 -145 -105 -187 -79
                    -53 -226 -99 -425 -134 -117 -21 -115 -20 -115 -81 l0 -54 1173 -3 1172 -2 0
                    59 0 59 -47 11 c-27 6 -82 17 -123 26 -347 69 -494 145 -624 322 -65 87 -168
                    283 -226 428 -17 44 -35 89 -40 100 -26 65 -64 165 -105 275 -25 69 -57 152
                    -70 185 -13 33 -44 116 -70 185 -26 69 -57 152 -70 185 -13 33 -44 116 -70
                    185 -26 69 -51 136 -57 150 -26 63 -57 154 -53 158 4 4 359 -116 478 -162 37
                    -14 67 -24 67 -21 0 8 -205 119 -374 202 -94 46 -182 89 -196 96 -28 14 -39
                    34 -74 127 -75 203 -181 487 -201 540 -7 19 -34 90 -59 158 -25 67 -67 177
                    -92 245 -25 67 -52 138 -59 157 -16 42 -89 237 -138 370 -69 189 -167 454
                    -212 575 -52 139 -190 513 -215 583 -13 34 -27 61 -31 60 -8 -3 -67 -103 -209
                    -354 -311 -551 -560 -1218 -684 -1836 -14 -70 -26 -130 -26 -133 0 -3 -66 -5
                    -147 -5 -178 0 -437 -22 -588 -50 -60 -11 -115 -20 -121 -20 -21 0 -1 78 57
                    215 4 11 40 103 80 205 89 231 119 310 129 335 5 11 41 106 80 210 103 269
                    110 288 190 500 39 105 75 199 80 210 9 23 46 117 84 218 14 37 26 76 26 86 0
                    10 16 59 36 108 20 48 40 98 45 111 5 12 13 32 18 45 5 12 33 81 61 152 29 72
                    58 144 65 160 8 17 23 55 34 85 12 30 26 64 30 75 5 11 37 90 71 175 63 159
                    73 183 90 223 5 12 32 81 60 152 29 72 57 144 64 160 7 17 23 56 35 87 l23 57
                    -22 58 c-22 58 -37 84 -49 82 -3 -1 -31 -5 -61 -10z m221 -2450 c17 -46 44
                    -120 60 -164 17 -44 50 -134 74 -200 24 -66 59 -163 80 -215 20 -52 43 -115
                    51 -140 9 -25 42 -115 74 -200 32 -85 68 -184 79 -220 45 -146 59 -200 52
                    -200 -4 0 -65 13 -137 30 -163 37 -370 75 -496 90 -79 10 -98 16 -98 29 1 117
                    57 548 101 780 30 153 105 477 116 494 8 13 10 8 44 -84z"/>
                    
                    <path class="letter-2" d="M10135 6929 c-118 -45 -467 -115 -700 -139 -89 -9 -114 -19 -115 -42
                    0 -17 34 -38 62 -38 45 0 156 -20 208 -37 124 -40 164 -88 186 -221 11 -72 14
                    -196 12 -623 l-3 -534 -25 2 c-14 1 -63 9 -110 17 -102 18 -409 21 -513 5
                    -163 -24 -340 -80 -481 -150 -376 -189 -667 -537 -737 -883 -44 -214 -47 -264
                    -24 -393 35 -197 68 -301 136 -424 152 -277 383 -459 704 -555 161 -48 233
                    -45 389 14 155 59 430 198 583 295 77 49 76 51 68 -152 -6 -138 -4 -180 5
                    -186 8 -5 16 -1 21 8 5 8 48 27 96 42 49 15 102 31 118 36 28 8 193 47 295 69
                    73 15 212 39 250 42 30 3 35 7 38 32 4 37 -7 43 -88 52 -134 13 -222 45 -264
                    95 -61 72 -60 68 -64 509 -2 343 15 2915 21 3109 1 36 -2 65 -8 67 -5 1 -32
                    -7 -60 -17z m-883 -1769 c29 -6 78 -15 108 -21 129 -25 258 -83 348 -156 84
                    -69 77 7 74 -848 l-4 -760 -31 -27 c-70 -60 -210 -121 -383 -167 -50 -13 -279
                    -15 -320 -2 -16 5 -49 14 -74 22 -57 16 -169 70 -229 111 -70 48 -171 154
                    -227 239 -141 211 -203 497 -176 809 15 176 48 307 109 430 85 173 251 310
                    423 350 30 7 69 16 85 21 45 11 236 10 297 -1z"/>
                    
                    <path class="letter-3" d="M11555 6923 c-128 -49 -415 -117 -584 -139 -119 -16 -141 -24 -141 -53 0 -26 21 -41 54 -41 32 0 72 -9 164 -36 104 -31 145 -90 163 -235 16 -125
                    4 -3041 -13 -3139 -27 -162 -100 -216 -338 -249 -42 -6 -45 -8 -48 -38 l-3
                    -33 590 0 591 0 0 30 c0 23 -5 31 -22 34 -101 20 -218 51 -243 63 -72 37 -102
                    90 -115 206 -9 80 6 3358 17 3555 5 104 5 105 -72 75z"/>
                    
                    <path class="letter-4" d="M15475 5320 c-160 -76 -438 -163 -617 -194 -37 -7 -52 -25 -42 -50 3
                    -8 35 -21 72 -31 95 -23 165 -58 190 -93 44 -60 45 -95 38 -882 -3 -410 -10
                    -772 -15 -806 -19 -131 -67 -180 -212 -213 -50 -12 -101 -21 -114 -21 -27 0
                    -48 -30 -39 -54 6 -14 71 -16 621 -16 l614 0 -3 33 c-3 30 -6 32 -48 38 -248
                    33 -339 73 -383 167 l-22 47 1 678 2 677 43 68 c62 96 220 250 293 287 69 34
                    154 44 220 25 24 -6 75 -36 112 -66 96 -75 120 -87 159 -80 74 14 163 111 205
                    222 16 45 18 58 8 81 -25 58 -71 110 -125 144 -56 34 -59 34 -173 34 -112 0
                    -117 -1 -194 -38 -44 -21 -109 -58 -144 -84 -87 -62 -242 -218 -321 -323 -35
                    -47 -68 -87 -74 -89 -7 -2 -8 28 -4 90 4 52 10 178 13 282 8 208 11 200 -61
                    167z"/>
                    
                    <path class="letter-5" d="M13415 5319 c-134 -15 -292 -73 -454 -167 -158 -90 -326 -249 -430
                    -406 -241 -363 -271 -883 -74 -1268 75 -147 159 -251 281 -349 133 -107 241
                    -157 455 -213 197 -52 277 -51 441 6 150 51 283 118 404 205 111 79 312 268
                    312 292 0 10 -9 26 -20 36 -22 20 -14 23 -113 -53 -139 -109 -307 -178 -487
                    -202 -82 -11 -111 -11 -207 4 -318 46 -549 214 -691 501 -70 142 -104 280
                    -123 504 -11 131 -10 145 5 156 11 9 82 13 234 14 528 4 1288 43 1379 72 38
                    12 53 48 53 131 0 257 -169 518 -420 647 -169 87 -335 114 -545 90z m105 -155
                    c212 -49 361 -202 406 -414 19 -93 15 -187 -10 -205 -10 -7 -61 -17 -114 -21
                    -122 -10 -1058 -11 -1067 -2 -11 11 23 146 59 233 87 212 225 345 416 402 91
                    27 215 30 310 7z"/>
                </g>
            </svg>
        </div>

        <!-- Barra de progreso -->
        <div class="progress-container">
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>

        <!-- Texto de carga -->
        <div class="loading-text">
            CARGANDO<span class="loading-dots"></span>
        </div>

        <!-- Partículas flotantes -->
        <div class="floating-particle particle-1"></div>
        <div class="floating-particle particle-2"></div>
        <div class="floating-particle particle-3"></div>
        <div class="floating-particle particle-4"></div>
        <div class="floating-particle particle-5"></div>
        <div class="floating-particle particle-6"></div>
    </div>
</body>
</html>



























































@extends('search')
@section('cont')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<script src="{{asset('js/splide.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/splide.min.css')}}">
<style type="text/css">
    .splide__slide img {
  width: 100%;
  height: auto;
}
.splide__slide {
  opacity: 0.3;
}

.splide__slide.is-active {
  opacity: 1;
  border:none;
}
.splide__track--nav>.splide__list>.splide__slide.is-active {
    border:none; 
}
   .checkmark__circle {
  stroke-dasharray: 166;
  stroke-dashoffset: 166;
  stroke-width: 2;
  stroke-miterlimit: 10;
  stroke: #b10000;
  fill: none;
  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  display: block;
  stroke-width: 2;
  stroke: #fff;
  stroke-miterlimit: 10;
  margin: 10% auto;
  box-shadow: inset 0px 0px 0px #b10000;
  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
}

.checkmark__check {
  transform-origin: 50% 50%;
  stroke-dasharray: 48;
  stroke-dashoffset: 48;
  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}
@keyframes scale {
  0%, 100% {
    transform: none;
  }
  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}
@keyframes fill {
  100% {
    box-shadow: inset 0px 0px 0px 30px #b10000;
  }
}
</style>
             <style type="text/css">
             	.imagen{
             		width: 100%;
             		padding: 20px;
             		box-sizing: border-box;
             	}
             	select:focus{
             		outline: 0;
             	}
             </style>
             <script>
                 window.addEventListener('load', function(){
                    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
                    var url = "http://127.0.0.1:8000/finde/"+{{$searches->id}}
                    if (isMobile) {
                    window.location.replace(url);

                    }
                    else {
                    console.log("Es una pc");
                    document.getElementById("body").style.display= "block";
            }
        })

             </script>
@if (session()->has('success'))
<div style="position: absolute;width: 100%;height: 100vh;z-index: 9999;top:0px;left: 0px;" id="notificacion"  class="content" >
    <div style="position:relative;display: block;margin: auto;width: 55%;background:white;top:120px;padding:20px;box-sizing:border-box;border-radius: 10px;border: 1px solid #808080">
        <h5 style="position: absolute; top: 0; font-size: 17px;font-family: 'Kanit'; font-weight: 100;color: black;">Tu producto se agregó al carrito:</h5>
        <div style="position: relative;width:100%;display:inline-block;height:270px;">
        <div style="position:relative;display:inline-block;float:left;height:120px;width:200px;;margin-top:70px;">

            <img src="{{asset('images/'.$searches->image)}}" class="" style="width: 100%">
        </div>
        <div style="position:relative;display:inline-block;float:left;height:120px;width:250px;margin-top:70px;margin-left:20px;">
            <h5 style="padding:0;margin:0">{{$searches->name}} </h5>
            <h5 style="padding:0;margin:0; font-weight:100;margin-top:20px;">Cantidad: x1</h5>
            <div style="display: inline-block;vertical-align: middle;margin-right: .16rem;text-decoration: line-through;color:#808080;font-size: 15px;"> Precio: S/. {{$searches -> preciof}}
            </div>
            <div style="display: inline-block;vertical-align: middle;color: blue;">{{FLOOR(number_format( 100-($searches->precio*100/$searches->preciof),2 ))}}% OFF
            </div>
            <h5 style="padding:0;margin:0;font-family:'Kanit';font-size: 17px;margin-top:20px;color: #b10000">PRECIO DESCUENTO: S/. {{$searches -> precio}}</h5>
        </div>

        </div>
        <a href="{{route('product.carro-compras')}}"><h6 style="position: relative;width:100%;display:inline-block;margin: 0;text-align: center;font-size: 15px;font-family: 'Kanit';background: #b10000;padding: 3px;box-sizing: border-box;
        color: white;">Ir al carrito</h6></a>
        <a href="{{url('busco')}}"><h6 style="position: relative;width:100%;display:inline-block;margin: 0;text-align: center;font-size: 15px;font-family: 'Kanit';padding: 3px;box-sizing: border-box;
            color:#b10000;margin-top:10px ">Continuar comprando</h6></a>
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" style="position: absolute; margin: 0px;top: 20px;right:20px">
            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
        </svg>

        <h6 style="font-size: 20px;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;position: relative;/* width: 100%; */margin: 0px;font-weight: 100;margin-top: 10px;color: white;margin-left: 40px;/* padding-left: 20px; */float: left;top: 7px;">{{session('success') }} </h6>


    </div>
</div>
@endif

                <div class="" style="width: 100%;position: relative;display: block;background: #ededed;padding-top: 50px;margin-bottom: 100px;margin-top:20px;">
                @if ($searches->tipo == '1')
                
                <div style="background: @if ($searches->id == '1') #b10000 @else @if($searches->id == '2')#243cb1 @else #282828 @endif @endif ;color:white;display:flex;width:100%;padding:10px;margin-bottom:10px;box-sizing:border-box;justify-content: space-between;">
                    <div style="display:flex;flex-direction:row;align-items:center;justify-content:center;">
                        <span class="material-symbols-outlined" style="font-size:25px;font-weight:100;">personal_bag</span>
                        <span class="material-symbols-outlined" style="font-size:25px;font-weight:100;margin-left:10px;">ecg</span>
                        <span class="material-symbols-outlined"  style="font-size:25px;font-weight:100;margin-left:10px;">water_bottle</span>
                        <span class="material-symbols-outlined"  style="font-size:25px;font-weight:100;margin-left:10px;">laptop_mac</span>
                        <span class="material-symbols-outlined"  style="font-size:25px;font-weight:100;margin-left:10px;">medical_services</span>
                        <span class="material-symbols-outlined"  style="font-size:25px;font-weight:100;margin-left:10px;">personal_injury</span>
                        
                    </div>
                    <h3 style="font-size:15px;font-weight:100;margin:0">BACK PACK ADLER EMERGENCY </h3>
                    
                </div>
                @endif
                	<div style="width: 80%;min-width: 1200px;position: relative;display: flex;margin: auto;background: white;;box-shadow: 5px 5px 25px #dbdbdb">
                    

                		<div style="width: 50%;box-sizing: border-box;position: relative;display: inline-block;float:left;">
                        <section id="main-carousel" class="splide"  aria-label="Beautiful Images">
                            <div class="splide__track">
                                    <ul class="splide__list">
                                        <li class="splide__slide">
                                            @if ($searches->tipo == '1')
                                            <img src="{{asset('image/'.$searches->thumb )}}" class="imagen">
                                            @else
                                                @if ($searches->tipo == '2')
                                                <img src="{{asset('images/kits'.$searches->thumb )}}" class="imagen">
                                                @else
                                                <img src="{{asset('images/'.$searches->image )}}" class="imagen">
                                                @endif
                                            @endif
                                        </li>
                                        
                                        
                                    </ul>
                            </div>
                        </section>
                		<section id="thumbnail-carousel" class="splide" style="margin-left:20px;">
                            <div class="splide__track">
                                    <ul class="splide__list">
                                        <li class="splide__slide">
                                            @if ($searches->tipo == '1')
                                            <img src="{{asset('image/'.$searches->thumb )}}" class="imagen">
                                            @else
                                                @if ($searches->tipo == '2')
                                                <img src="{{asset('images/kits'.$searches->thumb )}}" class="imagen">
                                                @else
                                                <img src="{{asset('images/'.$searches->image )}}" class="imagen">
                                                @endif
                                            @endif
                                        </li>
                                                                        
                                    </ul>
                            </div>
                        </section>
                        
                        <div style="width: 100%;position: relative;display: block;margin: auto;background: white;padding-left: 50px;height: auto;">
                                    <div style="padding:20px; background: none;margin-top: 10px;padding-bottom: 70px;position: relative;display: block; ">
                                        <h5 style="font-size: 25px;font-weight: 100;font-family:'Dosis';margin:0px;position: relative;display: block; ">DESCRIPCION:</h5>
                                            <div style="position: relative;margin-top: 20px;position: relative;display: block;margin-bottom:20px;">
                                                {!! nl2br(e($searches->description)) !!}
                                            </div>
                                        @if($searches->image1 != NULL)
                                          <img src="{{asset('images/'.$searches->image1)}} " style="width: 85%;position: relative;margin: auto;display: block;">
                                          @endif
                                          @if($searches->image2 != NULL)
                                          <img src="{{asset('images/'.$searches->image2)}} " style="width: 85%;position: relative;margin: auto;display: block;">
                                          @endif
                                            @if($searches->image3 != NULL)
                                          <img src="{{asset('images/'.$searches->image3)}} " style="width: 85%;position: relative;margin: auto;display: block;">
                                          @endif
                                    </div>
                        </div>
                        <div style="width: 100%;position: relative;display: block;margin: auto;background: white;margin-top: 20px;padding-left: 50px;box-sizing: border-box;padding-top: 50px;padding-right: 50px;padding-bottom: 100px;">
                        <h5 style="font-size: 20px;font-weight: 100;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;margin:0px;">Opiniones sobre el producto:</h5>
                        @foreach ($calificaciones as $cal )

                        @if ($searches->id == $cal->id)
                        @if ($cal->promedio == NULL)
                        <div style="position: relative;display:block;height:90px;margin-top:20px">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 0px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 35px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Kanit';top:-20px;">0.0 </h5>
                            </div>

                                <div style="width:100%;height:100px;background:rgba(0,0,0,.1);margin-top:30px;border-radius:10px;padding:20px;box-sizing:border-box;line-height:55px;position: relative;display:block " >
                                    No hay calificaciones disponibles por el momento
                                </div>
                        @endif
                        @endif


                        @endforeach
                        @if ($califica == null)
                        <div style="position: relative;display:block;height:90px;margin-top:20px">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 0px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 35px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Kanit';top:-20px;">0.0 </h5>
                            </div>

                                <div style="width:100%;height:100px;background:rgba(0,0,0,.1);margin-top:30px;border-radius:10px;padding:20px;box-sizing:border-box;line-height:55px;position: relative;display:block " >
                                    No hay calificaciones disponibles por el momento
                                </div>
                        @endif
                        <div style="width: 200px;margin-top: 10px;padding-bottom: 7px;position:relative;display: inline-block;float: left;margin-left: 35px;margin-top: 40px;margin-bottom:90px">
                            @foreach ($calificaciones as $cal )

                            @if ($searches->id == $cal->id)
                            @if ($cal->promedio <= 5 && $cal->promedio > 4.50 )
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 0px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 35px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Poiret One';top:-20px;">{{number_format($cal->promedio,1 )}} </h5>
                            @endif
                            @if ($cal->promedio <= 4.5 && $cal->promedio >4.0 )
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 0px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 35px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Poiret One';top:-20px;">{{number_format($cal->promedio,1 )}} </h5>
                            @endif
                            @if ($cal->promedio <= 4 && $cal->promedio >3.5 )
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 0px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 35px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Poiret One';top:-20px;">{{number_format($cal->promedio,1 )}} </h5>
                            @endif
                            @if ($cal->promedio <= 3.5 && $cal->promedio >3 )
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 0px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 35px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">
                            <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Poiret One';top:-20px;">{{number_format($cal->promedio,1 )}} </h5>
                            @endif
                            @if ($cal->promedio <= 3 && $cal->promedio >2.5 )
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 0px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 35px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">

                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Poiret One';top:-20px;">{{number_format($cal->promedio,1 )}} </h5>
                            @endif
                            @if ($cal->promedio<= 2.5 && $cal->promedio >2 )
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 0px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 35px;">

                            <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Poiret One';top:-20px;">{{number_format($cal->promedio,1 )}} </h5>
                            @endif
                            @if ($cal->promedio <= 2 && $cal->promedio>1.5 )
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 0px;">
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 35px;">

                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Poiret One';top:-20px;">{{number_format($cal->promedio,1 )}} </h5>
                            @endif
                            @if ($cal->promedio <= 1.5 && $cal->promedio >1 )
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:50px;left: 0px;">
                            <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 252px;top:50px;left: 35px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Poiret One';top:-20px;">{{number_format($cal->promedio,1 )}} </h5>
                            @endif
                            @if ($cal->promedio <= 1 && $cal->promedio >0.5 )
                            <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 25px;top:0px;left: 0px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 35px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 70px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 105px;">
                            <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 25px;top:50px;left: 140px;">
                            <h5 style="position: absolute;width: 18px;top:0px;left: 80px;margin:0px;font-weight: 100;font-size: 65px;font-family:'Poiret One';top:-20px;">{{number_format($cal->promedio,1 )}} </h5>
                            @endif


                            @endif


                            @endforeach

                            </div>





    @foreach( $valoras as $val)
    @if($val->valoracion != NULL)
    @if ($searches->id == $val->idarticulo)
        <div style="position: relative;width: 100%;display: block;margin-top: 10px;padding-bottom: 30px;border-bottom: 1px solid #ededed;padding-top: 30px;">
            <div style="width: 100%;position: relative;display:inline-block;">
            <div style="position: relative;width:50%;float: left;display: inline-block;">
                <h3 style="font-family: 'Kanit';font-size: 15px; font-weight: 100;margin: 0px;padding-left: 20px; ">{!! substr(($val->name),0,3) !!}***  </h3> </div>
                <div style="position: relative;width: 100px;display: block;float: right;">
                    @if ($val->valoracion <= 5 && $val->valoracion > 4.50 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">

                    @endif
                    @if ($val->valoracion <= 4.5 && $val->valoracion >4.0 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">

                    @endif
                    @if ($val->valoracion <= 4 && $val->valoracion >3.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">

                    @endif
                    @if ($val->valoracion <= 3.5 && $val->valoracion >3 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">

                    @endif
                    @if ($val->valoracion <= 3 && $val->valoracion >2.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">

                    @endif
                    @if ($val->valoracion<= 2.5 && $val->valoracion >2 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">

                    @endif
                    @if ($val->valoracion <= 2 && $val->valoracion>1.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">

                    @endif
                    @if ($val->valoracion <= 1.5 && $val->valoracion >1 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">

                    @endif
                    @if ($val->valoracion <= 1 && $val->valoracion >0.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">

                    @endif
                </div>
                </div>


                <div style="display: block;position: relative;width: 100%;margin: auto; padding:0px 20px;text-align: justify;font-size: 15px;">
                    {{$val->opinion}}
                </div>
        </div>

    @endif
    @endif
    @endforeach
                   </div>
                		</div>




                		<div style="width: 50%;box-sizing: border-box;display: flex;flex-direction:column;align-items:flex-end">
                		    
                				<div style="padding: 20px;position: relative;display: block;border:1px solid rgba(0,0,0,.1);margin: 15px;border-radius: 8px;width: 380px;float: right;">
                				    <!-- PREVENTA----------------------------------------------------------->
                                    @if($searches->preventab == 1)
                				    <div style="width:100%;text-align:center;padding:4px 0px;background:rgb(248, 168, 102);color:white;font-size:12px;position:absolute;top:0px;left:0px;border-radius:5px 5px 0px 0px " >Compra en preventa al mejor precio!</div>
                				    <div style="width: 100%;position: relative;display: block;line-height:60px;position:absolute;top:24px;left:0px">
                <img src="{{asset('image/preventa.jpg')}} " alt="" style="position: absolute;left:0px;top:0px;width:100%">
                <div style="position:absolute;right:10px; width:80px;height:60px">
                    <div style="position:relative;display:flex;justify-content:center;align-items:center;flex-direction:column">
                        <div style="color:white;font-size:11px;line-height:12px;text-align:center;margin-top:12px">Preventa termina en:</div>

                        <div style="margin-top: 5px">
                            <div style="position:relative;display:flex;justify-content:center;align-items:center;line-height:12px;color:white">
                                <span id="dd" style="display:flex;margin-right:10px;">
                                    <span id="days" style="text-align: center;font-size:14px"></span>
                                     <span style="text-align: center;font-size:9px;margin-left:3px">d</span>
                                 </span>
                                 <span id="" style="display:flex;margin-right:2px;flex-direction: column;">
                                     <div style="display:flex;justify-content:center;align-items:center;">
                                         <span id="dig" style="text-align: center;font-size:14px">0</span>
                                         <span id="hours" style="text-align: center;font-size:14px"></span>
                                     </div>

                                  </span>
                                  <span>:</span>
                                  <span id="" style="display:flex;margin-right:2px;flex-direction: column;margin-left:2px">
                                     <div style="display:flex;justify-content:center;align-items:center;">
                                         <span id="digil" style="text-align: center;font-size:14px">0</span>
                                         <span id="minutes" style="text-align: center;font-size:14px"></span>
                                     </div>

                                  </span>
                                  <span>:</span>
                                  <span id="" style="display:flex;margin-right:2px;flex-direction: column;margin-left:2px">
                                     <div style="display:flex;justify-content:center;align-items:center;">
                                         <span id="digi" style="text-align: center;font-size:14px">0</span>
                                         <span id="seconds" style="text-align: center;font-size:14px"></span>
                                     </div>

                                  </span>


                             </div>
                        </div>
                    </div>
                </div>
                <div style="width: 90%;margin:auto; position: relative;display: block;">

                    <div class="" style="width: 140px;font-size: 25px;font-family: Open Sans,Roboto,Arial,Helvetica,sans-serif,SimSun;color:#fff;display: inline-block;vertical-align: middle;">S/. {{$searches -> precio}}
                    </div>
                    <div style="display: inline-block;vertical-align: middle;margin-right: .16rem;text-decoration: line-through;color:rgb(148, 148, 148)">{{$searches -> preciof}}
                    </div>
                    <div style="display: inline-block;vertical-align: middle;color: rgb(255, 195, 195);">-{{FLOOR(number_format( 100-($searches->precio*100/$searches->preciof),2 ))}}%
                    </div>
                </div>
    		</div>
    		                        <h4 style="margin: 0px;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;color:#808080; font-size: 12px;font-weight: 100;padding-left: 20px;margin-bottom: 15px;margin-top:90px">{{$searches->categoria}} </h4>
                					<h4 style="    color: #000;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;letter-spacing: 0;line-height: 20px; display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; font-size: 20px;padding: 0 4px 4px 20px;margin:0px;font-weight: 100">{{$searches->name}} </h4>
                                    
    		                        @else
                					<h4 style="margin: 0px;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;color:#808080; font-size: 12px;font-weight: 100;padding-left: 20px;margin-bottom: 15px;">{{$searches->categoria}} </h4>
                					<h4 style="    color: #000;font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;letter-spacing: 0;line-height: 20px; display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden; font-size: 20px;padding: 0 4px 4px 20px;margin:0px;font-weight: 100">{{$searches->name}} </h4>
                                    <div style="width: 90%;margin:auto; position: relative;display: block;">

                    <div class="" style="width: 140px;font-size: 25px;font-family: Open Sans,Roboto,Arial,Helvetica,sans-serif,SimSun;color:#000;display: inline-block;vertical-align: middle;">S/. {{$searches -> precio}}
                    </div>
                    <div style="display: inline-block;vertical-align: middle;margin-right: .16rem;text-decoration: line-through;color:#808080">{{$searches -> preciof}}
                    </div>
                    <div style="display: inline-block;vertical-align: middle;color: red;">-{{FLOOR(number_format( 100-($searches->precio*100/$searches->preciof),2 ))}}%
                    </div>
                </div>
                                     @endif   
            
    	
            <!--   END preventa -->
    				<!-- CALIFICACIONES-------------------------------- -->

    				<div style="width: 200px;margin-top: 10px;padding-bottom: 7px;position:relative;display: inline-block;float: left;margin-left: 35px;margin-top: 20px;">
                    @foreach ($calificaciones as $cal )

                    @if ($searches->id == $cal->id)
                    @if ($cal->promedio <= 5 && $cal->promedio > 4.50 )
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
    				<img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
    				<h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 4.5 && $cal->promedio >4.0 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 4 && $cal->promedio >3.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 3.5 && $cal->promedio >3 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 3 && $cal->promedio >2.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio<= 2.5 && $cal->promedio >2 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 2 && $cal->promedio>1.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 1.5 && $cal->promedio >1 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/rating.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @if ($cal->promedio <= 1 && $cal->promedio >0.5 )
                    <img src="{{asset('image/svg/star-yellow.svg')}}" style="position: absolute;width: 18px;top:0px;left: 0px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 20px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 40px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 60px;">
                    <img src="{{asset('image/svg/star.svg')}}" style="position: absolute;width: 18px;top:0px;left: 80px;">
                    <h5 style="position: absolute;width: 18px;top:0px;left: 110px;margin:0px;font-weight: 100;font-size: 15px;font-family:'Kanit';top:-2px">{{$cal->promedio}} </h5>
                    @endif
                    @endif
                    @endforeach

    				</div>

    				<!-- FIN CALIFICACIONES ------------------------>

    								<div style="position: relative;display: inline-block;width: 100%;margin: 0px;margin-top: 15px;margin-left: 20px;margin-top: 25px;">
    									<h5 style="position: relative;float:left;width: 70px;padding-left: 20px;font-family:'Dosis';font-weight: 100;margin: 0px ">Cantidad: </h5>
    									<select name="cantidad" style="position: relative;display: inline-block;float: left;border:none;">
    										<option value="1">1</option>
    										<option value="2">2</option>
    										<option value="3">3</option>
    										<option value="4">4</option>
    										<option value="5">5</option>
    										<option value="6">6</option>
    									</select>
    								</div>
                                    
                                     @if($searches->stock == "0")

                                    @if ($searches->preventa == "0" || $searches->preventa == NULL)
                                    <h5 style="background: #808080;border-radius: 25px;font-size: 14px;position: relative;display: block;margin: auto;width: 150px;text-align: center;line-height: 30px;margin-top: 15px;color:white">Agotado </h5>
                                    
                                    @else
                                    @if($searches->preventab == 1)
                                    <a href="{{route('product.addToCarto',['id'=>$searches->id] )}} " style="background: #b10000;border-radius: 25px;font-size: 14px;position: relative;display: block;margin: auto;width: 150px;text-align: center;line-height: 30px;margin-top: 15px;color:white">Preventa + <img src="{{asset('image/svg/supermercado.svg')}}" style="width: 20px;position: absolute;top:5px;"></a>
                                    @endif
                                    @endif
                
                                    @else

                                    @if ($searches->tipo == '1')
                                    <a href="{{url('adler-venta')}} " style="background: #b10000;border-radius: 5px;font-size: 14px;position: relative;display: block;margin: auto;width: 150px;text-align: center;line-height: 30px;margin-top: 15px;color:white;box-shadow:2px 2px 4px #282828">Comprar BagPack <img src="{{asset('image/svg/supermercado.svg')}}" style="width: 20px;position: absolute;top:5px;"></a>
                                       @else
                                        @if ($searches->tipo == '2')
                                        <a href="{{url('adler-venta')}} " style="background: #b10000;border-radius: 5px;font-size: 14px;position: relative;display: block;margin: auto;width: 150px;text-align: center;line-height: 30px;margin-top: 15px;color:white,box-shadow:2px 2px 4px #282828">Comprar Kit<img src="{{asset('image/svg/supermercado.svg')}}" style="width: 20px;position: absolute;top:5px;"></a>
                                        @else
                                        <a href="{{route('product.addToCarto',['id'=>$searches->id] )}} " style="background: #b10000;border-radius: 25px;font-size: 14px;position: relative;display: block;margin: auto;width: 150px;text-align: center;line-height: 30px;margin-top: 15px;color:white">Agregar + <img src="{{asset('image/svg/supermercado.svg')}}" style="width: 20px;position: absolute;top:5px;"></a>

                                        @endif
                                    @endif
                                    
                                   @endif   
                                    
                                   
    								<h4 style="font-size: 15px;font-family:'Dosis-extra';margin-left: 40px;border-bottom: 1px dashed #808080;width: 70px;text-align: center; ">ver detalles</h4>
    								<img src="{{asset('image/svg/participacion.svg')}}" style="bottom:-10px;width: 20px;margin-left: 40px;">
    								<img src="{{asset('image/svg/corazon_black.svg')}}" style="position: absolute;bottom:20px;width: 25px;margin-left: 40px;left:60px;">
                				</div>
                                <div style="padding: 20px;position: sticky;display: block;border:1px solid rgba(0,0,0,.1);margin: 15px;border-radius: 8px;width: 380px;float: right;top:50px;">
                                    <div style="padding: 20px;display: block;border-radius: 8px;background:white;margin-top:15px;">
                                        <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 20px;margin:0px;color:#808080">Garantía</h5>
                                        <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 15px;margin:0px;color:#282828;margin-top: 20px;">Compra procesada y garantia 12 meses por Grupo Oberlu</h5>
                                        <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 12px;margin:0px;color:#808080;margin-top: 20px;text-align: justify;">Toda compra es procesada por Grupo Oberlu, desde la confirmacion de pago hasta la entrega del producto, brindando adicionalmente el servicio de garantía procesada por Grupo Oberlu,cumpliendo los <a href="">terminos y condiciones de garantia.</a></h5>
                                        <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 15px;margin:0px;color:#282828;margin-top:20px;">Compra protegida con Adler Emergency</h5>
                                        <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 12px;margin:0px;color:#808080;margin-top: 20px;text-align: justify;border-bottom:1px solid #d1d1d1;padding-bottom: 20px;">Los pagos realizados a traves del dominio www.adleremergency.com son procesados y verificados por Adler Emergency, quien administra los pagos que usted realice mediante cualquier metodo de pago. Verifique los <a href="">terminos y condiciones Adler Emergency.</a></h5>
                                        <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 20px;margin:0px;color:#808080;margin-top: 20px;">Medios de pago</h5>
                                        <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 15px;margin:0px;color:#282828;margin-top: 20px;">Tarjeta de debito y credito | Compra online</h5>
                                        <div style="width:100%;position: relative;float: left;">
                                            <img src="{{asset('image/svg/visa.svg')}} " style="width:15%;position:relative;float: left;display: inline-block;">
                                            <img src="{{asset('image/svg/tarjeta-mastercard.svg')}} " style="width:15%;position:relative;float: left;display: inline-block;margin-left: 15px;">
                                        </div>
                                        <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 15px;margin:0px;color:#282828;margin-top: 20px;">Transferencia directa Banco - Banco</h5>
                                        <div style="width:100%;position: relative;float: left;">
                                            <img src="{{asset('image/logo-interbank.png')}} " style="width:20%;position:relative;float: left;display: inline-block;margin-top: 10px;">
                                            <img src="{{asset('image/bcp.jpg')}} " style="width:20%;position:relative;float: left;display: inline-block;margin-left: 15px;margin-top:5px;">
                                            <img src="{{asset('image/scotiabank.png')}} " style="width:20%;position:relative;float: left;display: inline-block;margin-left: 15px;margin-top:15px;">


                                        </div>
                                        <h5 style="font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-weight: 100;font-size: 15px;margin:0px;color:#282828;margin-top: 20px;">Transferencia rapida</h5>
                                        <div style="width:100%;position: relative;float: left;margin-top: 10px;">

                                            <img src="{{asset('image/plin.png')}} " style="width:100px;position:relative;float: left;display: inline-block;margin-left: 15px;margin-top:0px;">
                                            <img src="{{asset('image/yape.png')}} " style="width:40px;position:relative;float: left;display: inline-block;margin-left: 15px;margin-top:0px;">
                                        </div>
                                    </div>  
                                </div>
                		</div>

                	</div>
                   <div style="position:relative;width: 80%;display: block;margin: auto;min-width: 1200px;padding-left:50px">
                    <h5 style="margin: 0px;font-family:Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;font-size: 25px;font-weight: 200;margin-top: 50px;margin-bottom: 20px;">Ultimos agregados seguro te gusta</h5>
                    <div style="display:flex;flex-wrap:wrap;flex-direction:row;gap:20px">
                    @foreach ($sear as $search)

                        <a href="{{asset('busco/'.$search->id)}} " class="" style="width:20%" >
                            <div class="firststyle" onmouseover ="getElementById('heart{{$search->id}}').style.display = 'block'; getElementById('cart{{$search->id}}').style.display = 'block' "  onmouseout ="getElementById('heart{{$search->id}}').style.display = 'none'; getElementById('cart{{$search->id}}').style.display = 'none' " style="display:flex;flex-direction:column">
                            @if ($search->tipo == '1')
                            <img src="{{asset('image/'.$search->thumb )}}" style="border-radius: 10px;background:none" class="imagenp">
                            @else
                                @if ($search->tipo == '2')
                                <img src="{{asset('images/kits'.$search->thumb )}}" style="border-radius: 10px;background:none" class="imagenp">
                                @else
                                <img src="{{asset('image/productos/'.$search->image )}}" style="border-radius: 20px;background:none;width:100%" class="imagenp">
                                @endif
                            @endif
                            
                            @if (100-(($search->precio*100)/$search->preciof) > 20 )
                            <img src="{{asset('image/oferta.png' )}} " class="oferta" style="right:-10px;">

                            @endif
                            <h4 style="height:40px;color: #000; letter-spacing: 0;line-height: 20px;display: -webkit-box;    -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-size: 17px;margin: 0px;margin-top:20px;width: 200px;padding-left:20px">{{$search->name }}</h4>

                            <span class="price">S/. {{$search->precio }}</span>
                            <div style="width:min-content;color:black;padding:2px;font-weight:bold;font-size:13px;background:#e7e6e6;margin-top:15px">Oferta</div>
                            <div style="width:max-content;color:black;padding:2px;font-weight:bold;font-size:13px;background:#e7e6e6;margin-top:10px">Envio en pack</div>
                            <div style="display:flex;justify-content:center;align-items:center;margin:0">
                                <h3 style="width:40%;padding:7px; color:black;font-size:15px;border-radius:5px;border: 2px solid black;text-align:center;margin-top:30px">COMPRAR</h3>                            
                            </div>





                        </div>
                        </a>
                    @endforeach
                    </div>
                  </div>



                </div>
                <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
                <script type="text/javascript">
                                $(document).ready(function() {
                                    setTimeout(function() {
                                        $(".content").fadeOut(1500);
                                    },10000);
                                });
                </script>
                @if ($d != 0)
                <input type="text" value="{{ $d }}" id="datetime" style="display: none">

                <script src="{{asset('js/clock.js')}} "></script>
                @endif                                   
                <script>
                    document.addEventListener( 'DOMContentLoaded', function () {
                    var main = new Splide( '#main-carousel', {
                        type      : 'fade',
                        rewind    : true,
                        pagination: false,
                        arrows    : false,
                    } );


                    var thumbnails = new Splide( '#thumbnail-carousel', {
                        fixedWidth  : 100,
                        fixedHeight : 100,
                        gap         : 10,
                        rewind      : true,
                        pagination  : false,
                        isNavigation: true,
                        arrows    : false,
                        
                        breakpoints : {
                        600: {
                            fixedWidth : 60,
                            fixedHeight: 60,
                        },
                        },
                    } );

                       
                    main.sync( thumbnails );
                    
                    main.mount();
                    thumbnails.mount();
                    } );
                </script>

@endsection

























<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adler - Productos de Calidad</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #8B0000 0%, #DC143C 100%);
            min-height: 100vh;
            color: white;
        }

        .container {
            max-width: 420px;
            margin: 0 auto;
            min-height: 100vh;
            background: rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo {
            font-size: 28px;
            font-weight: 300;
            letter-spacing: 2px;
            color: white;
        }

        .nav-links {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .nav-link {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-weight: 300;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: white;
            transform: translateY(-1px);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 1px;
            background: white;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .user-icon {
            width: 24px;
            height: 24px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
            cursor: pointer;
        }

        .user-icon:hover {
            opacity: 1;
        }

        /* Search Bar */
        .search-container {
            padding: 24px;
            position: relative;
        }

        .search-bar {
            width: 100%;
            padding: 16px 20px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 25px;
            color: white;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .search-bar::placeholder {
            color: rgba(255,255,255,0.6);
        }

        .search-bar:focus {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.4);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        .search-icon {
            position: absolute;
            right: 36px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            opacity: 0.7;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .search-icon:hover {
            opacity: 1;
        }

        /* Hero Product */
        .hero-product {
            padding: 40px 24px;
            text-align: center;
            position: relative;
        }

        .product-image-container {
            position: relative;
            margin: 20px 0 40px;
            transform: perspective(1000px) rotateY(-5deg);
            transition: transform 0.6s ease;
        }

        .product-image-container:hover {
            transform: perspective(1000px) rotateY(0deg) translateY(-10px);
        }

        .product-image {
            width: 280px;
            height: 350px;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
            filter: brightness(1.1) contrast(1.1);
            transition: all 0.6s ease;
        }

        .product-image:hover {
            box-shadow: 0 35px 70px rgba(0,0,0,0.5);
            transform: scale(1.05);
        }

        .product-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: pulse 3s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.3; transform: translate(-50%, -50%) scale(1); }
            50% { opacity: 0.6; transform: translate(-50%, -50%) scale(1.1); }
        }

        /* Section Title */
        .section-title {
            font-size: 24px;
            font-weight: 300;
            margin-bottom: 30px;
            padding: 0 24px;
            position: relative;
        }

        .section-title::before {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 24px;
            width: 60px;
            height: 2px;
            background: linear-gradient(90deg, white, transparent);
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            padding: 0 24px 40px;
        }

        .product-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.15);
            transition: all 0.4s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            transition: left 0.6s ease;
        }

        .product-card:hover::before {
            left: 100%;
        }

        .product-card:hover {
            transform: translateY(-8px) scale(1.02);
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.3);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        .product-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 16px;
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.1);
        }

        .product-name {
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 8px;
            color: rgba(255,255,255,0.9);
        }

        .product-price {
            font-size: 16px;
            font-weight: 600;
            color: #FFD700;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }

        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            max-width: 380px;
            width: calc(100% - 40px);
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid transparent;
            background-clip: padding-box;
            border-radius: 24px;
            display: flex;
            justify-content: space-around;
            padding: 12px 8px;
            box-shadow: 
                0 8px 32px rgba(0,0,0,0.3),
                inset 0 1px 0 rgba(255,255,255,0.2),
                inset 0 -1px 0 rgba(255,255,255,0.1);
            position: relative;
            overflow: hidden;
        }

        .bottom-nav::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 24px;
            padding: 1px;
            background: linear-gradient(
                135deg, 
                rgba(255,255,255,0.3) 0%, 
                rgba(255,255,255,0.1) 25%, 
                rgba(255,64,129,0.2) 50%, 
                rgba(33,150,243,0.2) 75%, 
                rgba(255,255,255,0.1) 100%
            );
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: xor;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            pointer-events: none;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 10px 12px;
            border-radius: 16px;
            position: relative;
            background: transparent;
            border: 1px solid transparent;
        }

        .nav-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 16px;
            background: rgba(255,255,255,0.05);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .nav-item:hover::before {
            opacity: 1;
        }

        .nav-item:hover {
            transform: translateY(-3px) scale(1.05);
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            box-shadow: 
                0 8px 25px rgba(0,0,0,0.25),
                inset 0 1px 0 rgba(255,255,255,0.2);
        }

        .nav-item.active {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            transform: translateY(-2px);
            box-shadow: 
                0 6px 20px rgba(255,215,0,0.3),
                inset 0 1px 0 rgba(255,255,255,0.3),
                inset 0 -1px 0 rgba(255,215,0,0.2);
        }

        .nav-item.active::before {
            background: linear-gradient(135deg, 
                rgba(255,215,0,0.1) 0%, 
                rgba(255,193,7,0.05) 100%);
            opacity: 1;
        }

        .nav-icon {
            width: 22px;
            height: 22px;
            opacity: 0.8;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 0 8px rgba(255,255,255,0.1));
        }

        .nav-item:hover .nav-icon,
        .nav-item.active .nav-icon {
            opacity: 1;
            transform: scale(1.1);
            filter: drop-shadow(0 0 12px rgba(255,255,255,0.3));
        }

        .nav-item.active .nav-icon {
            filter: drop-shadow(0 0 15px rgba(255,215,0,0.5));
        }

        .nav-label {
            font-size: 11px;
            font-weight: 500;
            opacity: 0.7;
            transition: all 0.3s ease;
            text-shadow: 0 0 8px rgba(255,255,255,0.1);
        }

        .nav-item.active .nav-label {
            opacity: 1;
            font-weight: 600;
            color: #FFD700;
            text-shadow: 0 0 12px rgba(255,215,0,0.4);
        }

        .nav-item:hover .nav-label {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        /* Floating Action Button */
        .fab {
            position: fixed;
            bottom: 100px;
            right: 24px;
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border: none;
            border-radius: 50%;
            color: #8B0000;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .fab:hover {
            transform: scale(1.1) translateY(-2px);
            box-shadow: 0 12px 35px rgba(255, 215, 0, 0.6);
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                max-width: 100%;
            }
            
            .header {
                padding: 16px 20px;
            }
            
            .search-container {
                padding: 20px;
            }
            
            .product-image {
                width: 240px;
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="logo">Adler</div>
            <nav class="nav-links">
                <a href="#" class="nav-link">Explorar</a>
                <svg class="user-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </nav>
        </header>

        <!-- Search Bar -->
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Buscar producto">
            <svg class="search-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
        </div>

        <!-- Hero Product -->
        <section class="hero-product">
            <div class="product-image-container">
                <div class="product-glow"></div>
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 280 350'%3E%3Crect width='280' height='350' fill='%23333'/%3E%3Cpath d='M70 100h140v150H70z' fill='%23555'/%3E%3Cpath d='M90 120h100v20H90zm0 30h100v20H90zm0 30h100v20H90z' fill='%23777'/%3E%3Ctext x='140' y='290' text-anchor='middle' fill='%23999' font-family='Arial' font-size='16'%3EAdler%3C/text%3E%3C/svg%3E" alt="Producto Principal" class="product-image">
            </div>
        </section>

        <!-- Recommended Products -->
        <h2 class="section-title">Te va a gustar</h2>
        
        <div class="product-grid">
            <div class="product-card">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 80 80'%3E%3Crect width='80' height='80' fill='%23e8f4fd'/%3E%3Ccircle cx='40' cy='25' r='15' fill='%23ff6b6b'/%3E%3Crect x='30' y='40' width='20' height='30' fill='white' stroke='%23ddd' stroke-width='2'/%3E%3Ctext x='40' y='55' text-anchor='middle' font-family='Arial' font-size='8' fill='%23666'%3E70%25%3C/text%3E%3C/svg%3E" alt="Alcohol desinfectante">
                <div class="product-name">Alcohol desinfectante 70%</div>
                <div class="product-price">S/. 4.50</div>
            </div>
            
            <div class="product-card">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 80 80'%3E%3Crect width='80' height='80' fill='%23f8f9fa'/%3E%3Crect x='20' y='20' width='40' height='30' rx='5' fill='%23fff' stroke='%23ddd' stroke-width='2'/%3E%3Crect x='25' y='25' width='10' height='20' fill='%23333'/%3E%3Crect x='45' y='25' width='10' height='20' fill='%23333'/%3E%3Ctext x='40' y='60' text-anchor='middle' font-family='Arial' font-size='6' fill='%23666'%3EDIGITAL%3C/text%3E%3C/svg%3E" alt="Termómetro digital">
                <div class="product-name">Termómetro digital</div>
                <div class="product-price">S/. 24.50</div>
            </div>
        </div>

        <!-- Floating Action Button -->
        <button class="fab">+</button>

        <!-- Bottom Navigation -->
        <nav class="bottom-nav">
            <div class="nav-item active">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
                <span class="nav-label">Inicio</span>
            </div>
            
            <div class="nav-item">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                <span class="nav-label">Categorías</span>
            </div>
            
            <div class="nav-item">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                </svg>
                <span class="nav-label">Cart</span>
            </div>
            
            <div class="nav-item">
                <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                <span class="nav-label">Mi cuenta</span>
            </div>
        </nav>
    </div>

    <script>
        // Smooth interactions
        document.querySelectorAll('.product-card, .nav-item, .fab').forEach(element => {
            element.addEventListener('click', function(e) {
                // Create ripple effect
                const ripple = document.createElement('div');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: rgba(255,255,255,0.2);
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    pointer-events: none;
                `;
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Search functionality
        const searchBar = document.querySelector('.search-bar');
        searchBar.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        searchBar.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });

        // Navigation active state
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Add CSS animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>




