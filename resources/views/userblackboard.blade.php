<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy"   content="img-src 'self' data: https://lh3.googleusercontent.com https://*.googleusercontent.com">

    <title>Amigurumis - usuario</title>
    @include ('global.icon')
    <link rel="stylesheet" href="{{asset('css/user.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    .btn, .support-btn {
        position: relative;
        overflow: hidden;
    }
    
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .nav-link.active {
        background-color: rgba(220, 178, 38, 0.8);
        padding-left: 16px;
        padding-right: 16px;
        border-radius: 4px;
    }
</style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <div class="logo" >
                    <a href="{{url('/')}} " style="display:flex"><img src="{{asset('image/logo.webp')}}" style="width: 140px;"></a>
                </div>

                <!-- Search Bar -->
                 <form action="{{ route('item') }}" method="GET" style="width:100%;display:flex;justify-content:center" >
                            @csrf
                    <div class="search-container">
                        <div class="search-box">
                            <input type="text" id="searchid" name="name" placeholder="Buscar productos..." class="search-input">
                            <button class="fas fa-search search-icon" style="border:none;background:none"></button>
                        </div>
                    </div>
                </form>

                <!-- User Greeting -->
                <div class="users">
                    <span class="meta">Hola,</span>
                    <strong class="users-name">{{ $user->name ?? 'Cliente' }}</strong>
                    <div class="avatars">{{ strtoupper(substr($user->name ?? 'C',0,1)) }}</div>

                    <div class="users-menu" aria-hidden="true">
                    <div class="users-menu__item"><a href="{{asset('usuario')}}" style="color:white;">Mi perfil</a></div>
                    <div class="users-menu__item"><a href="" style="color:white;">Mis pedidos</a></div>
                    <div class="users-menu__item">
                        <form method="POST" action="{{ route('logout') }}">
                                @csrf
                            <button type="submit" style="background:none;border:none;color:#b10000;font-size:15px;cursor:pointer" >
                                Cerrar sesion
                            </button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="navigation">
        <div class="container">
            <div class="nav-links">
                <a href="{{asset('compras')}}" class="nav-link">
                    <i class="fas fa-box"></i>
                    <span>Mis Pedidos</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-comments"></i>
                    <span>Mensajes</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-heart"></i>
                    <span>Lista de Deseos</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="content-grid">
                
                <!-- Profile Sidebar -->
                <div class="profile-sidebar">
                    <!-- Profile Card -->
                    <div class="profile-card">
                        <!-- Profile Header -->
                        <div class="profile-header">
                            <div class="avatar-container">
                                <div class="avatar" style="overflow:hidden;box-shadow:none">
                                    <img src="{{ Auth::user()->avatar ?: asset('images/avatar-default.png') }}"   referrerpolicy="no-referrer" crossorigin="anonymous" alt="">
                                </div>
                                <button class="camera-btn">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                            
                            <h2 class="profile-name">{{Auth::user()->name}} {{Auth::user()->lastname}}</h2>
                            <div class="profile-meta">
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>Miembro desde 2024</span>
                                </div>
                            </div>
                            
                            <div class="status-badge">
                                <span class="status-dot"></span>
                                CLIENTE VERIFICADO
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <button class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                                <span>Editar Perfil</span>
                            </button>
                            <button class="btn btn-secondary">
                                <i class="fas fa-bell"></i>
                                <span>Notificar</span>
                            </button>
                        </div>

                        <!-- Quick Stats -->
                        <div class="quick-stats">
                            <div class="stat-item">
                                <p class="stat-number stat-red">0</p>
                                <p class="stat-label">Pedidos</p>
                            </div>
                            <div class="stat-item">
                                <p class="stat-number stat-blue">0</p>
                                <p class="stat-label">Reseñas</p>
                            </div>
                            <div class="stat-item">
                                <p class="stat-number stat-green">-</p>
                                <p class="stat-label">Rating</p>
                            </div>
                        </div>
                    </div>

                    <!-- Support Card -->
                    <div class="support-card">
                        <div class="support-content">
                            <div class="support-icon">
                                <i class="fas fa-question-circle"></i>
                            </div>
                            <h3 class="support-title">¿Necesitas ayuda?</h3>
                            <p class="support-text">
                                Si necesitas editar tu información de contacto, contacta con soporte técnico.
                            </p>
                             <a href="{{url('soporte')}}" class="support-btn">
                            
                               <span>Soporte Técnico</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="main-area">
                    <!-- Personal Information -->
                    <div class="info-card">
                        <div class="card-header">
                            <h3 class="card-title">Información Personal</h3>
                            <p class="card-subtitle">Gestiona tu información personal y preferencias</p>
                        </div>
                        
                        <div class="card-content">
                            <div class="info-grid">
                                <div class="info-item">
                                    <label class="info-label">Nombre Completo</label>
                                    <div class="info-field">
                                        <i class="fas fa-user"></i>
                                        <span>{{Auth::user()->name}} {{Auth::user()->lastname}}</span>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <label class="info-label">DNI/Identificación</label>
                                    <div class="info-field">
                                        <span>{{$clientes->dni}}</span>
                                        <button class="edit-btn">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <label class="info-label">Email</label>
                                    <div class="info-field">
                                        <i class="fas fa-envelope"></i>
                                        <span>{{$clientes->email}}</span>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <label class="info-label">Celular</label>
                                    <div class="info-field">
                                        <i class="fas fa-phone"></i>
                                        <span>{{$clientes->cell}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div class="info-card">
                        <div class="card-header">
                            <div class="header-with-action">
                                <div>
                                    <h3 class="card-title">Direcciones</h3>
                                    <p class="card-subtitle">Gestiona tus direcciones de envío</p>
                                </div>
                                <button class="btn btn-primary">Añadir Dirección</button>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <div class="address-item">
                                <div class="address-content">
                                    <i class="fas fa-map-marker-alt address-icon"></i>
                                    <div class="address-details">
                                        <div class="address-header">
                                            <span class="address-title">Dirección Principal</span>
                                            <div class="address-actions">
                                                <span class="badge badge-green">Principal</span>
                                                <button class="edit-btn">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <p class="address-text">
                                            Calle Principal, 123<br>
                                            28001 Madrid, España
                                        </p>
                                        <div class="shipping-badge">
                                            <span class="shipping-dot"></span>
                                            ENVÍO TERCIARIZADO
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="add-address-btn">
                                + Añadir nueva dirección
                            </button>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="info-card">
                        <div class="card-header">
                            <h3 class="card-title">Actividad Reciente</h3>
                            <p class="card-subtitle">Tus pedidos y actividad más reciente</p>
                        </div>
                        
                        <div class="card-content">
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-icon activity-success">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div class="activity-details">
                                        <p class="activity-title">Pedido #12345 enviado</p>
                                        <p class="activity-time">Hace 2 horas</p>
                                    </div>
                                    <i class="fas fa-chevron-right activity-arrow"></i>
                                </div>
                                
                                <div class="activity-item">
                                    <div class="activity-icon activity-info">
                                        <i class="fas fa-comments"></i>
                                    </div>
                                    <div class="activity-details">
                                        <p class="activity-title">Nuevo mensaje recibido</p>
                                        <p class="activity-time">Hace 1 día</p>
                                    </div>
                                    <i class="fas fa-chevron-right activity-arrow"></i>
                                </div>
                                
                                <div class="activity-item">
                                    <div class="activity-icon activity-warning">
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="activity-details">
                                        <p class="activity-title">Reseña publicada</p>
                                        <p class="activity-time">Hace 3 días</p>
                                    </div>
                                    <i class="fas fa-chevron-right activity-arrow"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <button class="hamburger" onclick="toggleMenu()" style="position:absolute">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <div class="menu-panel" id="menuPanel">
        <div class="menu-options">
            <a href="#" class="menu-option">Inicio</a>
            <a href="{{asset('compras')}}" class="menu-option">Mis Pedidos</a>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
        <button type="submit" class="logout-btn" >
            Logout
        </button>
        </form>
    </div>
    <script src="{{asset('js/user.js')}}"></script>
    <script>
        function toggleMenu() {
            const hamburger = document.querySelector('.hamburger');
            const menuPanel = document.getElementById('menuPanel');
            
            hamburger.classList.toggle('active');
            menuPanel.classList.toggle('active');
        }

        function logout() {
            alert('Cerrando sesión...');
            // Aquí puedes agregar la lógica de logout
        }

        // Cerrar menú al hacer clic fuera del botón
        document.addEventListener('click', function(event) {
            const hamburger = document.querySelector('.hamburger');
            const menuPanel = document.getElementById('menuPanel');
            
            if (!hamburger.contains(event.target) && !menuPanel.contains(event.target)) {
                hamburger.classList.remove('active');
                menuPanel.classList.remove('active');
            }
        });
    </script>
<script>
    (function(){
      function setupUserMenu(userEl){
        if(!userEl) return;
        const nameEl   = userEl.querySelector('.users-name');
        const avatarEl = userEl.querySelector('.avatars');
        const menuEl   = userEl.querySelector('.users-menu');

        const open = () => {
          userEl.classList.add('is-open');
          if(menuEl) menuEl.setAttribute('aria-hidden','false');
        };
        const close = () => {
          userEl.classList.remove('is-open');
          if(menuEl) menuEl.setAttribute('aria-hidden','true');
        };
        const toggle = () => {
          userEl.classList.contains('is-open') ? close() : open();
        };

        // Abrir/cerrar con clic en nombre o avatar
        [nameEl, avatarEl].forEach(el=>{
          if(!el) return;
          el.addEventListener('click', toggle);
          el.setAttribute('role','button');
          el.setAttribute('tabindex','0');
          el.addEventListener('keydown', e=>{
            if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); toggle(); }
          });
        });

        // Cerrar al hacer clic fuera
        document.addEventListener('click', e=>{
          if(!userEl.contains(e.target)) close();
        });

        // Cerrar con Escape
        document.addEventListener('keydown', e=>{
          if(e.key === 'Escape') close();
        });
      }

      document.querySelectorAll('.users').forEach(setupUserMenu);
    })();
</script>
</body>
</html>