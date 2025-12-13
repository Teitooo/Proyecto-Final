@extends('web.app')

@section('titulo', 'Catálogo de Productos - Medical Supplies')

@push('estilos')
    <link href="{{ asset('css/catalog-styles.css') }}" rel="stylesheet" />
@endpush

@section('contenido')
<!-- Catalog Header -->
<div class="catalog-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('home') }}"><i class="fas fa-home"></i> Inicio</a>
            <i class="fas fa-chevron-right"></i>
            <span>Catálogo</span>
        </div>
        <h1>Catálogo de Productos</h1>
        <p class="catalog-subtitle">Descubre nuestra completa gama de equipos médicos de alta calidad</p>
    </div>
</div>

<!-- Catalog Main Content -->
<div class="catalog-main">
    <div class="container">
        <div class="catalog-layout">
            <!-- Sidebar -->
            <aside class="catalog-sidebar">
                <!-- Search -->
                <div class="sidebar-section">
                    <div class="search-box-catalog">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Buscar productos...">
                    </div>
                </div>

                <!-- Categories Filter -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">
                        <i class="fas fa-filter"></i>
                        Categorías
                    </h3>
                    <div class="filter-options">
                        <label class="filter-checkbox">
                            <input type="checkbox" value="all" checked>
                            <span>Todos los productos</span>
                            <span class="filter-count">12</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="diagnostico">
                            <span>Diagnóstico</span>
                            <span class="filter-count">6</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="cirugia">
                            <span>Cirugía</span>
                            <span class="filter-count">1</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="urgencias">
                            <span>Urgencias</span>
                            <span class="filter-count">2</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="laboratorio">
                            <span>Laboratorio</span>
                            <span class="filter-count">1</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="rehabilitacion">
                            <span>Rehabilitación</span>
                            <span class="filter-count">1</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="imagenologia">
                            <span>Imagenología</span>
                            <span class="filter-count">1</span>
                        </label>
                    </div>
                </div>

                <!-- Price Range -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">
                        <i class="fas fa-dollar-sign"></i>
                        Rango de Precio
                    </h3>
                    <div class="price-range">
                        <div class="price-inputs">
                            <input type="number" id="priceMin" placeholder="Min" value="0">
                            <span>-</span>
                            <input type="number" id="priceMax" placeholder="Max" value="20000">
                        </div>
                        <input type="range" class="price-slider" min="0" max="20000" value="0">
                    </div>
                </div>

                <!-- Brands -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">
                        <i class="fas fa-trademark"></i>
                        Marcas
                    </h3>
                    <div class="filter-options">
                        <label class="filter-checkbox">
                            <input type="checkbox">
                            <span>Philips</span>
                            <span class="filter-count">3</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox">
                            <span>3M</span>
                            <span class="filter-count">2</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox">
                            <span>Medtronic</span>
                            <span class="filter-count">3</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox">
                            <span>Siemens</span>
                            <span class="filter-count">2</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox">
                            <span>GE Healthcare</span>
                            <span class="filter-count">2</span>
                        </label>
                    </div>
                </div>
            </aside>

            <!-- Products Section -->
            <div class="catalog-products">
                <!-- Toolbar -->
                <div class="catalog-toolbar">
                    <div class="results-info">
                        Mostrando <span>12</span> de <span>12</span> productos
                    </div>
                    <div class="toolbar-actions">
                        <div class="view-toggle">
                            <button class="view-btn active" data-view="grid" title="Vista en grilla">
                                <i class="fas fa-th"></i>
                            </button>
                            <button class="view-btn" data-view="list" title="Vista en lista">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                        <select class="sort-select">
                            <option value="default">Ordenar por: Recomendados</option>
                            <option value="price-low">Menor precio</option>
                            <option value="price-high">Mayor precio</option>
                            <option value="name">Nombre (A-Z)</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="catalog-products-grid view-grid" id="productsGrid">
                    <!-- Monitor de Signos Vitales -->
                    <div class="product-card" data-category="diagnostico" data-price="2500">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1584820927498-cfe5bfb1f1e7?w=500&q=80" alt="Monitor">
                            <span class="product-badge new">Nuevo</span>
                            <button class="product-compare-btn" onclick="toggleCompare(1)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Diagnóstico</span>
                            <h3 class="product-name">Monitor de Signos Vitales</h3>
                            <p class="product-brand">Philips</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★★</span>
                                <span class="product-reviews">(18 reseñas)</span>
                            </div>
                            <div class="product-price">$2,500.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(1)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Estetoscopio -->
                    <div class="product-card" data-category="diagnostico" data-price="180">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1603398938378-e54eab446dde?w=500&q=80" alt="Estetoscopio">
                            <button class="product-compare-btn" onclick="toggleCompare(2)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Diagnóstico</span>
                            <h3 class="product-name">Estetoscopio Cardiology IV</h3>
                            <p class="product-brand">3M</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★☆</span>
                                <span class="product-reviews">(24 reseñas)</span>
                            </div>
                            <div class="product-price">$180.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(2)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Desfibrilador -->
                    <div class="product-card" data-category="urgencias" data-price="4800">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?w=500&q=80" alt="Desfibrilador">
                            <span class="product-badge sale">-20%</span>
                            <button class="product-compare-btn" onclick="toggleCompare(3)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Urgencias</span>
                            <h3 class="product-name">Desfibrilador Automático</h3>
                            <p class="product-brand">Medtronic</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★★</span>
                                <span class="product-reviews">(32 reseñas)</span>
                            </div>
                            <div class="product-price">$4,800.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(3)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Microscopio -->
                    <div class="product-card" data-category="laboratorio" data-price="1850">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1582719471155-d0b76e43cd55?w=500&q=80" alt="Microscopio">
                            <button class="product-compare-btn" onclick="toggleCompare(4)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Laboratorio</span>
                            <h3 class="product-name">Microscopio Binocular</h3>
                            <p class="product-brand">Siemens</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★★</span>
                                <span class="product-reviews">(15 reseñas)</span>
                            </div>
                            <div class="product-price">$1,850.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(4)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Set Quirúrgico -->
                    <div class="product-card" data-category="cirugia" data-price="3200">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1631815588090-d4bfec5b1ccb?w=500&q=80" alt="Set Quirúrgico">
                            <span class="product-badge new">Nuevo</span>
                            <button class="product-compare-btn" onclick="toggleCompare(5)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Cirugía</span>
                            <h3 class="product-name">Set Instrumental Quirúrgico</h3>
                            <p class="product-brand">GE Healthcare</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★★</span>
                                <span class="product-reviews">(12 reseñas)</span>
                            </div>
                            <div class="product-price">$3,200.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(5)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Oxímetro -->
                    <div class="product-card" data-category="diagnostico" data-price="85">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?w=500&q=80" alt="Oxímetro">
                            <button class="product-compare-btn" onclick="toggleCompare(6)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Diagnóstico</span>
                            <h3 class="product-name">Oxímetro de Pulso</h3>
                            <p class="product-brand">Medtronic</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★☆</span>
                                <span class="product-reviews">(28 reseñas)</span>
                            </div>
                            <div class="product-price">$85.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(6)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Camilla -->
                    <div class="product-card" data-category="urgencias" data-price="1200">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=500&q=80" alt="Camilla">
                            <button class="product-compare-btn" onclick="toggleCompare(7)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Urgencias</span>
                            <h3 class="product-name">Camilla de Exploración</h3>
                            <p class="product-brand">Philips</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★★</span>
                                <span class="product-reviews">(20 reseñas)</span>
                            </div>
                            <div class="product-price">$1,200.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(7)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ECG -->
                    <div class="product-card" data-category="diagnostico" data-price="3500">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1530026405186-ed1f139313f8?w=500&q=80" alt="ECG">
                            <button class="product-compare-btn" onclick="toggleCompare(8)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Diagnóstico</span>
                            <h3 class="product-name">Electrocardiografo</h3>
                            <p class="product-brand">GE Healthcare</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★★</span>
                                <span class="product-reviews">(19 reseñas)</span>
                            </div>
                            <div class="product-price">$3,500.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(8)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Ultrasonido -->
                    <div class="product-card" data-category="imagenologia" data-price="15000">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1551076805-e1869033e561?w=500&q=80" alt="Ultrasonido">
                            <span class="product-badge new">Nuevo</span>
                            <button class="product-compare-btn" onclick="toggleCompare(9)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Imagenología</span>
                            <h3 class="product-name">Equipo de Ultrasonido</h3>
                            <p class="product-brand">Siemens</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★★</span>
                                <span class="product-reviews">(25 reseñas)</span>
                            </div>
                            <div class="product-price">$15,000.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(9)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mesa Rehabilitación -->
                    <div class="product-card" data-category="rehabilitacion" data-price="950">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&q=80" alt="Mesa">
                            <button class="product-compare-btn" onclick="toggleCompare(10)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Rehabilitación</span>
                            <h3 class="product-name">Mesa de Rehabilitación</h3>
                            <p class="product-brand">3M</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★☆</span>
                                <span class="product-reviews">(16 reseñas)</span>
                            </div>
                            <div class="product-price">$950.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(10)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Termómetro -->
                    <div class="product-card" data-category="diagnostico" data-price="45">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1584515933487-779824d29309?w=500&q=80" alt="Termómetro">
                            <button class="product-compare-btn" onclick="toggleCompare(11)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Diagnóstico</span>
                            <h3 class="product-name">Termómetro Infrarrojo</h3>
                            <p class="product-brand">Medtronic</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★★</span>
                                <span class="product-reviews">(35 reseñas)</span>
                            </div>
                            <div class="product-price">$45.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(11)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Tensiómetro -->
                    <div class="product-card" data-category="diagnostico" data-price="120">
                        <div class="product-image">
                            <img src="https://images.unsplash.com/photo-1615486511484-92e172cc4fe0?w=500&q=80" alt="Tensiómetro">
                            <button class="product-compare-btn" onclick="toggleCompare(12)">
                                <i class="fas fa-exchange-alt"></i>
                            </button>
                        </div>
                        <div class="product-info">
                            <span class="product-category">Diagnóstico</span>
                            <h3 class="product-name">Tensiómetro Digital</h3>
                            <p class="product-brand">Philips</p>
                            <div class="product-rating">
                                <span class="product-stars">★★★★☆</span>
                                <span class="product-reviews">(22 reseñas)</span>
                            </div>
                            <div class="product-price">$120.00</div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-add-to-cart" onclick="addToCart(12)">
                                    <i class="fas fa-shopping-cart"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="catalog-pagination">
                    <button class="pagination-btn" onclick="goToPage(1)">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Categories -->
<section class="related-categories">
    <div class="container">
        <h2>Explora Más Categorías</h2>
        <div class="categories-quick-access">
            <a href="#" class="category-quick-card">
                <i class="fas fa-heartbeat"></i>
                <span>Diagnóstico</span>
            </a>
            <a href="#" class="category-quick-card">
                <i class="fas fa-hospital"></i>
                <span>Urgencias</span>
            </a>
            <a href="#" class="category-quick-card">
                <i class="fas fa-flask"></i>
                <span>Laboratorio</span>
            </a>
            <a href="#" class="category-quick-card">
                <i class="fas fa-scalpel"></i>
                <span>Cirugía</span>
            </a>
            <a href="#" class="category-quick-card">
                <i class="fas fa-microscope"></i>
                <span>Imagenología</span>
            </a>
            <a href="#" class="category-quick-card">
                <i class="fas fa-wheelchair"></i>
                <span>Rehabilitación</span>
            </a>
        </div>
    </div>
</section>

<!-- Sidebar Toggle Button (Mobile) -->
<button class="sidebar-toggle" onclick="toggleSidebar()">
    <i class="fas fa-sliders-h"></i>
</button>
@endsection

@push('scripts')
    <script src="{{ asset('js/catalog-script.js') }}"></script>
@endpush
