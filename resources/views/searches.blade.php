<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@include ('global.name') Tienda</title>
    @include ('global.icon')
    <link rel="stylesheet" href="{{asset('css/tienda.css')}}">
    <style>
   
    </style>
</head>

<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <a href="#" class="top-bar-link">Protección del comprador</a>
                <a href="#" class="top-bar-link">Ayuda</a>
                <a href="{{asset('login')}}" class="top-bar-link">Mi cuenta</a>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="header" style="background:white">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <div class="logo"><a href="{{asset('/')}}"><img src="{{asset('image/logo.webp')}}" alt="" style="width:80px;"></a></div>

                <!-- Search Bar -->
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Buscar productos..." class="search-input">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Header Actions -->
                <div class="header-actions">
                    <div class="cart-container" style="display:flex">
                        
                     <!-- Bag   <a  href="{{route('product.pasarela-pago')}} " class="icon-btn carrito" aria-label="Carrito" style="position:relative">
           
                        <svg class="cart-icon" fill="black" viewBox="0 0 24 24">
                            <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                        </svg>
                        <span class="cart-badge" style="background: #000000bd;border-radius: 13px; height: 20px; position: absolute; top: 14px;left: 8px; width: 20px; text-align: center;  color: white; font-size: 13px;">{{Session::has('carto') ? Session::get('carto')->totalQty : '0' }} </span>
                        </a>-->
                    </div>
                    <a href="{{asset('login')}}"  class="user-icon"><svg fill="none" stroke="black" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg></a>
                    
                </div>
            </div>

            <!-- Mobile Search -->
            <div class="mobile-search">
                <div class="search-contain">
                    <input type="text" id="mobileSearchInput" placeholder="Buscar productos..." class="search-input">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-content">
                <a href="#" class="breadcrumb-link">Home</a>
                <span> › </span>
                <span class="breadcrumb-current">Búsqueda</span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main-layout">
            <!-- Sidebar Filters -->
            <aside class="sidebar" id="filterSidebar">
                <div class="filter-card">
                    <div class="filter-header">
                        <h3 class="filter-title">Filtros</h3>
                        <svg width="20" height="20" fill="none" stroke="#9ca3af" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                    </div>
                     
                    <!-- Categories -->
                    <div class="filter-section">
                        <h4>Categorías</h4>
                        <div class="filter-options">
                            <div class="filter-option">
                                <input type="radio" name="category" value="Todos" id="cat-all" checked>
                                <label for="cat-all">Todos</label>
                            </div>
                            <div class="filter-option">
                                <input type="radio" name="category" value="paquete" id="cat-medical">
                                <label for="cat-medical">Temporada</label>
                            </div>
                            <div class="filter-option">
                                <input type="radio" name="category" value="Camping" id="cat-camping">
                                <label for="cat-camping">Ofertas</label>
                            </div>
                        </div>
                    </div>

                    <!-- Clear Filters -->
                    <button class="clear-filters" id="clearFilters">Limpiar filtros</button>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="main-content">
                <!-- Controls -->
                <div class="controls">
                    <button class="toggle-filters" id="toggleFilters">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filtros
                    </button>
                    
                    <div class="sort-controls">
                        <span class="product-count" id="productCount">6 productos encontrados</span>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <span>Ordenar por:</span>
                            <select class="sort-select" id="sortSelect">
                                <option value="Más relevantes">Más relevantes</option>
                                <option value="Precio: menor a mayor">Precio: menor a mayor</option>
                                <option value="Precio: mayor a menor">Precio: mayor a menor</option>
                                <option value="Mejor valorados">Mejor valorados</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="products-grid" id="productsGrid">
                    <!-- Products will be rendered here by JavaScript -->
                </div>

                <!-- No Results -->
                <div class="no-results" id="noResults">
                    <svg class="no-results-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <h3>No se encontraron productos</h3>
                    <p>Intenta cambiar tus filtros o buscar algo diferente</p>
                </div>
            </main>
        </div>
    </div>
    <nav class="bottom-nav">
            <a href="{{asset('/')}}"><div class="nav-item" style="position: relative; overflow: hidden;">
                <svg class="nav-icon" fill="black" viewBox="0 0 24 24">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path>
                </svg>
                <span class="nav-label">Inicio</span>
            </div></a>
            
         <!--   <a href=""><div class="nav-item" style="position: relative; overflow: hidden;">
                <svg class="nav-icon" fill="black" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <span class="nav-label">Ofertas</span>
            </div></a>
-->
            <a href="{{env('SUPPORT_WHATSAPP')}}"><div class="nav-item" style="position: relative; overflow: hidden;">
                <img src="{{asset('image/svg/whatsappn.svg')}}" alt="" style="width:20px">
                <!--<svg class="nav-icon" fill="black" viewBox="0 0 24 24">
                    <path d="M7 18c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12L8.1 13h7.45c.75 0 1.41-.41 1.75-1.03L21.7 4H5.21l-.94-2H1zm16 16c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"></path>
                </svg>-->
                <span class="nav-label">Whatsapp</span>
            </div></a>
            
            <a href="{{asset('login')}}"><div class="nav-item" style="position: relative; overflow: hidden;">
                <svg class="nav-icon" fill="black" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                </svg>
                <span class="nav-label">Mi cuenta</span>
            </div></a>
    </nav>
    <script>
       
        let products = @json($allProductsJs, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);


        let searchQuery = '';
        let selectedCategory = 'Todos';
        let sortBy = 'Más relevantes';
        let cartItems = 0;
        (function seedAndClean() {
            const params = new URLSearchParams(window.location.search);
            const q = params.get('name') || params.get('q') || '';
            if (q) {
                searchQuery = q;
                const inputs = [document.getElementById('searchInput'), document.getElementById('mobileSearchInput')];
                inputs.forEach(el => el && (el.value = q));
            }
            // Limpiar la query (?_token, ?name, etc.) para que no te "encierre" en reload
            if (window.location.search) {
                history.replaceState(null, '', window.location.pathname);
            }
            })();
        // DOM elements
        const searchInput = document.getElementById('searchInput');
        const mobileSearchInput = document.getElementById('mobileSearchInput');
        const productsGrid = document.getElementById('productsGrid');
        const noResults = document.getElementById('noResults');
        const productCount = document.getElementById('productCount');
        const cartCount = document.getElementById('cartCount');
        const categoryInputs = document.querySelectorAll('input[name="category"]');
        const clearFilters = document.getElementById('clearFilters');
        const sortSelect = document.getElementById('sortSelect');
        const toggleFilters = document.getElementById('toggleFilters');
        const filterSidebar = document.getElementById('filterSidebar');

        // Create star rating HTML
        function createStars(rating) {
            let stars = '';
            for (let i = 0; i < 5; i++) {
                if (i < Math.floor(rating)) {
                    stars += '<svg class="star star-filled" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
                } else {
                    stars += '<svg class="star star-empty" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>';
                }
            }
            return stars;
        }

        // Filter products
        function filterProducts() {
            return products.filter(product => {
                const matchesSearch = product.name.toLowerCase().includes(searchQuery.toLowerCase());
                const matchesCategory = selectedCategory === 'Todos' || product.category === selectedCategory;
                return matchesSearch && matchesCategory;
            });
        }

        // Sort products
        function sortProducts(filteredProducts) {
            switch (sortBy) {
                case 'Precio: menor a mayor':
                    return [...filteredProducts].sort((a, b) => a.price - b.price);
                case 'Precio: mayor a menor':
                    return [...filteredProducts].sort((a, b) => b.price - a.price);
                case 'Mejor valorados':
                    return [...filteredProducts].sort((a, b) => b.rating - a.rating);
                default:
                    return filteredProducts;
            }
        }

        // Render products
        function renderProducts() {
            const filteredProducts = filterProducts();
            const sortedProducts = sortProducts(filteredProducts);

            productCount.textContent = `${filteredProducts.length} productos encontrados`;

            if (sortedProducts.length === 0) {
                productsGrid.style.display = 'none';
                noResults.style.display = 'block';
                return;
            }

            productsGrid.style.display = 'grid';
            noResults.style.display = 'none';
            
            productsGrid.innerHTML = sortedProducts.map(product => `
                <a class="product-card" href="{{ url('busco') }}/${product.id}">
  <!-- Product Image -->
  <div class="product-image-container">
    <img src="${product.image}" alt="${product.name}" class="product-image" />
    ${product.isOffer ? `<div class="offer-badge">Oferta</div>` : ''}
    ${!product.inStock ? `
      <div class="out-of-stock-overlay">
        <span class="out-of-stock-badge">Agotado</span>
      </div>` : ''
    }
  </div>

  <!-- Product Info -->
  <div class="product-info">
    <h3 class="product-name">${product.name}</h3>

    <div class="rating-container">
      <div class="stars">${createStars(product.rating)}</div>
      <span class="reviews-count">(${product.reviews})</span>
    </div>

    <div class="price-container">
      <span class="price">S/. ${product.price.toFixed(2)}</span>
      ${product.originalPrice ? `<span class="original-price">S/. ${product.originalPrice.toFixed(2)}</span>` : ''}
    </div>

    <!-- Botón visible solo en hover (mismo link que el card) -->
    <span class="buy-button ${!product.inStock ? 'is-disabled' : ''}">
      ${product.inStock ? 'COMPRAR' : 'AGOTADO'}
    </span>

    ${product.inStock ? `<p class="shipping-info">En stock</p>` : ''}
  </div>
</a>

            `).join('');
        }

        // Add to cart function
        function addToCart() {
            cartItems++;
            cartCount.textContent = cartItems;
            cartCount.style.display = 'flex';
        }

        // Event listeners
        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value;
            renderProducts();
        });

        mobileSearchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value;
            renderProducts();
        });

        categoryInputs.forEach(input => {
            input.addEventListener('change', (e) => {
                selectedCategory = e.target.value;
                renderProducts();
            });
        });

        clearFilters.addEventListener('click', () => {
            searchQuery = '';
            selectedCategory = 'Todos';
            searchInput.value = '';
            mobileSearchInput.value = '';
            categoryInputs.forEach(input => {
                input.checked = input.value === 'Todos';
            });
            renderProducts();
        });

        sortSelect.addEventListener('change', (e) => {
            sortBy = e.target.value;
            renderProducts();
        });

        toggleFilters.addEventListener('click', () => {
            filterSidebar.classList.toggle('show');
        });

        // Close filters when clicking outside
        filterSidebar.addEventListener('click', (e) => {
            if (e.target === filterSidebar) {
                filterSidebar.classList.remove('show');
            }
        });

        // Initial render
        renderProducts();
    </script>
    
</body>
</html>



















