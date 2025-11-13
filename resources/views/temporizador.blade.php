<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporizador Premium</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 25%, #2d1b69 50%, #11998e 75%, #38ef7d 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow-x: hidden;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .main-content {
            text-align: center;
            z-index: 1;
            opacity: 0;
            animation: fadeInUp 1.2s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .main-content h1 {
            font-size: clamp(2rem, 5vw, 4rem);
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #fff 0%, #a8edea 50%, #fed6e3 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .main-content p {
            font-size: clamp(1rem, 2vw, 1.3rem);
            font-weight: 300;
            opacity: 0.8;
            letter-spacing: 0.5px;
        }

        .timer-widget {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: rgba(15, 15, 15, 0.85);
            backdrop-filter: blur(40px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 32px 28px;
            box-shadow: 
                0 20px 60px rgba(0, 0, 0, 0.4),
                0 8px 32px rgba(255, 255, 255, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            z-index: 1000;
            min-width: 320px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            opacity: 0;
            transform: translateY(100px) scale(0.9);
            animation: slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.5s forwards;
        }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .timer-widget:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 
                0 32px 80px rgba(0, 0, 0, 0.5),
                0 12px 40px rgba(56, 239, 125, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        .timer-display {
            text-align: center;
            margin-bottom: 28px;
        }

        .time-circle {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: conic-gradient(from 0deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #f5576c 75%, #4facfe 100%);
            background-size: 200% 200%;
            animation: rotateGradient 8s linear infinite;
            padding: 4px;
            margin: 0 auto 20px;
            position: relative;
            filter: drop-shadow(0 8px 32px rgba(118, 75, 162, 0.3));
        }

        @keyframes rotateGradient {
            0% { background-position: 0% 50%; }
            100% { background-position: 360% 50%; }
        }

        .time-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.08) 0%, rgba(0, 0, 0, 0.9) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: 600;
            color: white;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .time-inner::before {
            content: '';
            position: absolute;
            top: 10%;
            left: 20%;
            width: 30%;
            height: 30%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(10px);
        }

        .time-inputs {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            justify-content: center;
        }

        .input-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .time-input {
            width: 64px;
            height: 48px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            color: white;
            text-align: center;
            font-size: 1.1rem;
            font-weight: 500;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .time-input:focus {
            outline: none;
            border-color: #4facfe;
            background: rgba(79, 172, 254, 0.1);
            box-shadow: 
                0 0 20px rgba(79, 172, 254, 0.3),
                0 4px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .time-input::placeholder {
            color: rgba(255, 255, 255, 0.4);
            font-weight: 400;
        }

        .input-label {
            font-size: 0.75rem;
            font-weight: 500;
            opacity: 0.6;
            margin-top: 8px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .timer-controls {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .control-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.3px;
            position: relative;
            overflow: hidden;
        }

        .control-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .control-btn:hover::before {
            left: 100%;
        }

        .control-btn.start {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
        }

        .control-btn.start:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.6);
        }

        .control-btn.stop {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            box-shadow: 0 4px 15px rgba(245, 87, 108, 0.4);
        }

        .control-btn.stop:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(245, 87, 108, 0.6);
        }

        .control-btn.reset {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.4);
        }

        .control-btn.reset:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(118, 75, 162, 0.6);
        }

        .control-btn:active {
            transform: translateY(-1px);
        }

        .timer-status {
            text-align: center;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            padding: 8px 16px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .status-running {
            background: rgba(79, 172, 254, 0.1);
            border-color: rgba(79, 172, 254, 0.3);
            color: #4facfe;
        }

        .status-paused {
            background: rgba(240, 147, 251, 0.1);
            border-color: rgba(240, 147, 251, 0.3);
            color: #f093fb;
        }

        .status-finished {
            background: rgba(245, 87, 108, 0.1);
            border-color: rgba(245, 87, 108, 0.3);
            color: #f5576c;
            animation: statusPulse 2s ease-in-out infinite;
        }

        @keyframes statusPulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.8; }
        }

        @keyframes timerFinished {
            0%, 100% { transform: scale(1) rotate(0deg); }
            25% { transform: scale(1.1) rotate(-5deg); }
            75% { transform: scale(1.1) rotate(5deg); }
        }

        .timer-finished {
            animation: timerFinished 0.8s ease-in-out infinite;
        }

        .progress-circle {
            position: absolute;
            top: 4px;
            left: 4px;
            width: calc(100% - 8px);
            height: calc(100% - 8px);
            pointer-events: none;
        }

        .progress-circle circle {
            fill: none;
            stroke: rgba(255, 255, 255, 0.2);
            stroke-width: 2;
            stroke-dasharray: 377;
            stroke-dashoffset: 377;
            transform: rotate(-90deg);
            transform-origin: center;
            transition: stroke-dashoffset 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        @media (max-width: 480px) {
            .timer-widget {
                bottom: 20px;
                right: 20px;
                left: 20px;
                min-width: unset;
                padding: 28px 24px;
            }
            
            .time-circle {
                width: 120px;
                height: 120px;
            }
            
            .time-inner {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="floating-particles" id="particles"></div>
    
    <div class="main-content">
        <h1>Temporizador Premium</h1>
        <p>Experiencia minimalista y sofisticada</p>
    </div>

    <div class="timer-widget">
        <div class="timer-display">
            <div class="time-circle" id="timeCircle">
                <svg class="progress-circle">
                    <circle cx="66" cy="66" r="60" id="progressCircle"></circle>
                </svg>
                <div class="time-inner" id="timeDisplay">00:00</div>
            </div>
        </div>
        
        <div class="time-inputs">
            <div class="input-group">
                <input type="number" class="time-input" id="minutesInput" placeholder="00" min="0" max="59">
                <div class="input-label">minutos</div>
            </div>
            <div class="input-group">
                <input type="number" class="time-input" id="secondsInput" placeholder="00" min="0" max="59">
                <div class="input-label">segundos</div>
            </div>
        </div>

        <div class="timer-controls">
            <button class="control-btn start" id="startBtn">Iniciar</button>
            <button class="control-btn stop" id="stopBtn" style="display: none;">Pausar</button>
            <button class="control-btn reset" id="resetBtn">Reset</button>
        </div>

        <div class="timer-status" id="timerStatus">Configura tu tiempo</div>
    </div>

    <script>
        let timerInterval;
        let totalSeconds = 0;
        let remainingSeconds = 0;
        let isRunning = false;

        const minutesInput = document.getElementById('minutesInput');
        const secondsInput = document.getElementById('secondsInput');
        const timeDisplay = document.getElementById('timeDisplay');
        const startBtn = document.getElementById('startBtn');
        const stopBtn = document.getElementById('stopBtn');
        const resetBtn = document.getElementById('resetBtn');
        const timerStatus = document.getElementById('timerStatus');
        const timeCircle = document.getElementById('timeCircle');
        const progressCircle = document.getElementById('progressCircle');

        // Crear partículas flotantes
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            
            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (15 + Math.random() * 10) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        function formatTime(seconds) {
            const mins = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        function updateProgressCircle() {
            if (totalSeconds > 0) {
                const progress = ((totalSeconds - remainingSeconds) / totalSeconds) * 377;
                progressCircle.style.strokeDashoffset = 377 - progress;
                
                if (remainingSeconds <= 30) {
                    progressCircle.style.stroke = '#f5576c';
                    progressCircle.style.filter = 'drop-shadow(0 0 8px rgba(245, 87, 108, 0.6))';
                } else if (remainingSeconds <= 60) {
                    progressCircle.style.stroke = '#f093fb';
                    progressCircle.style.filter = 'drop-shadow(0 0 8px rgba(240, 147, 251, 0.4))';
                } else {
                    progressCircle.style.stroke = '#4facfe';
                    progressCircle.style.filter = 'drop-shadow(0 0 8px rgba(79, 172, 254, 0.4))';
                }
            }
        }

        function updateDisplay() {
            timeDisplay.textContent = formatTime(remainingSeconds);
            updateProgressCircle();
        }

        function createNotificationSound() {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
            oscillator.frequency.exponentialRampToValueAtTime(400, audioContext.currentTime + 0.1);
            
            gainNode.gain.setValueAtTime(0.3, audioContext.currentTime);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.5);
            
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 0.5);
        }

        function startTimer() {
            if (!isRunning && remainingSeconds === 0) {
                const minutes = parseInt(minutesInput.value) || 0;
                const seconds = parseInt(secondsInput.value) || 0;
                
                if (minutes === 0 && seconds === 0) {
                    minutesInput.style.borderColor = '#f5576c';
                    secondsInput.style.borderColor = '#f5576c';
                    setTimeout(() => {
                        minutesInput.style.borderColor = 'rgba(255, 255, 255, 0.15)';
                        secondsInput.style.borderColor = 'rgba(255, 255, 255, 0.15)';
                    }, 1000);
                    return;
                }

                totalSeconds = minutes * 60 + seconds;
                remainingSeconds = totalSeconds;
            }

            isRunning = true;
            startBtn.style.display = 'none';
            stopBtn.style.display = 'inline-block';
            timerStatus.textContent = 'En progreso';
            timerStatus.className = 'timer-status status-running';
            
            timerInterval = setInterval(() => {
                remainingSeconds--;
                updateDisplay();

                if (remainingSeconds <= 0) {
                    clearInterval(timerInterval);
                    isRunning = false;
                    startBtn.style.display = 'inline-block';
                    stopBtn.style.display = 'none';
                    timerStatus.textContent = '¡Completado!';
                    timerStatus.className = 'timer-status status-finished';
                    timeCircle.classList.add('timer-finished');
                    
                    try {
                        createNotificationSound();
                    } catch (e) {
                        console.log('Audio no disponible');
                    }
                    
                    if (Notification.permission === 'granted') {
                        new Notification('⏰ Temporizador Completado', {
                            body: 'Tu tiempo ha terminado. ¡Es hora de continuar!',
                            icon: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGRlZnM+CjxsaW5lYXJHcmFkaWVudCBpZD0iZ3JhZCIgeDE9IjAlIiB5MT0iMCUiIHgyPSIxMDAlIiB5Mj0iMTAwJSI+CjxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9IiM0ZmFjZmUiLz4KPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjMDBmMmZlIi8+CjwvbGluZWFyR3JhZGllbnQ+CjwvZGVmcz4KPHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiByeD0iMzIiIGZpbGw9InVybCgjZ3JhZCkiLz4KPHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHg9IjE2IiB5PSIxNiIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IndoaXRlIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+CjxjaXJjbGUgY3g9IjEyIiBjeT0iMTIiIHI9IjEwIi8+Cjxwb2x5bGluZSBwb2ludHM9IjEyLDYgMTIsMTIgMTYsMTQiLz4KPC9zdmc+CjwvZGVmcz4KPC9zdmc+',
                            badge: 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iOCIgY3k9IjgiIHI9IjgiIGZpbGw9IiM0ZmFjZmUiLz4KPC9zdmc+'
                        });
                    }
                    
                    setTimeout(() => {
                        timeCircle.classList.remove('timer-finished');
                    }, 5000);
                }
            }, 1000);
        }

        function stopTimer() {
            clearInterval(timerInterval);
            isRunning = false;
            startBtn.style.display = 'inline-block';
            stopBtn.style.display = 'none';
            timerStatus.textContent = 'Pausado';
            timerStatus.className = 'timer-status status-paused';
        }

        function resetTimer() {
            clearInterval(timerInterval);
            isRunning = false;
            remainingSeconds = 0;
            totalSeconds = 0;
            startBtn.style.display = 'inline-block';
            stopBtn.style.display = 'none';
            timerStatus.textContent = 'Configura tu tiempo';
            timerStatus.className = 'timer-status';
            timeCircle.classList.remove('timer-finished');
            progressCircle.style.strokeDashoffset = 377;
            progressCircle.style.stroke = 'rgba(255, 255, 255, 0.2)';
            progressCircle.style.filter = 'none';
            updateDisplay();
            minutesInput.value = '';
            secondsInput.value = '';
        }

        // Event listeners
        startBtn.addEventListener('click', startTimer);
        stopBtn.addEventListener('click', stopTimer);
        resetBtn.addEventListener('click', resetTimer);

        // Solicitar permisos de notificación
        if (Notification.permission === 'default') {
            Notification.requestPermission();
        }

        // Validación y efectos en inputs
        minutesInput.addEventListener('input', function() {
            if (this.value > 59) this.value = 59;
            if (this.value < 0) this.value = 0;
        });

        secondsInput.addEventListener('input', function() {
            if (this.value > 59) this.value = 59;
            if (this.value < 0) this.value = 0;
        });

        // Efectos de sonido en botones
        document.querySelectorAll('.control-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                try {
                    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                    const oscillator = audioContext.createOscillator();
                    const gainNode = audioContext.createGain();
                    
                    oscillator.connect(gainNode);
                    gainNode.connect(audioContext.destination);
                    
                    oscillator.frequency.setValueAtTime(600, audioContext.currentTime);
                    gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
                    gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 0.1);
                    
                    oscillator.start(audioContext.currentTime);
                    oscillator.stop(audioContext.currentTime + 0.1);
                } catch (e) {
                    // Silently fail if audio is not supported
                }
            });
        });

        // Inicializar
        createParticles();
        updateDisplay();
    </script>
</body>
</html>