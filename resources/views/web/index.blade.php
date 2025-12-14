@extends('web.app')

<<<<<<< HEAD
@section('titulo', 'Productos - Medical Supplies')

@section('contenido')
<!-- Search and Filter Section -->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5">
        <form method="GET" action="{{route('home')}}" class="mb-4">
            <div class="row g-3">
                <!-- Search Box -->
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control form-control-lg" id="searchInput" 
                               placeholder="Buscar productos..." name="search" 
                               value="{{request('search')}}">
                        <button class="btn btn-primary" type="submit" id="searchButton">
                            Buscar
                        </button>
                    </div>
                </div>

                <!-- Sort Dropdown -->
                <div class="col-md-4">
                    <div class="input-group">
                        <label class="input-group-text">Ordenar:</label>
                        <select class="form-select" id="sortSelect" name="sort" onchange="this.form.submit()">
                            <option value="">-- Seleccionar --</option>
                            <option value="priceAsc" {{ request('sort') == 'priceAsc' ? 'selected' : '' }}>
                                Precio: menor a mayor
                            </option>
                            <option value="priceDesc" {{ request('sort') == 'priceDesc' ? 'selected' : '' }}>
                                Precio: mayor a menor
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Products Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5">
        @if($productos->count() > 0)
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                @foreach($productos as $producto)
                    <div class="col mb-5">
                        <div class="card h-100 shadow-sm border-0">
                            <!-- Product Image -->
                            <div class="position-relative overflow-hidden bg-light" style="height: 250px;">
                                <img class="card-img-top w-100 h-100" 
                                     src="{{asset('uploads/productos/'. $producto->imagen) }}"
                                     alt="{{$producto->nombre}}"
                                     style="object-fit: cover;">
                            </div>

                            <!-- Product Details -->
                            <div class="card-body text-center p-4">
                                <h5 class="card-title fw-bold mb-2">{{$producto->nombre}}</h5>
                                <p class="card-text text-muted small mb-3">{{Str::limit($producto->descripcion ?? '', 50)}}</p>
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <span class="h4 fw-bold text-primary mb-0">
                                        ${{ number_format($producto->precio, 2) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Actions -->
                            <div class="card-footer bg-white border-top p-4 pt-0">
                                <div class="d-grid gap-2">
                                    <a class="btn btn-outline-primary btn-sm" 
                                       href="{{route('web.show', $producto->id)}}">
                                        <i class="bi bi-eye"></i> Ver Producto
                                    </a>
                                    <button class="btn btn-primary btn-sm" 
                                            onclick="addToCart({{$producto->id}})">
                                        <i class="bi bi-cart-plus"></i> Agregar al Carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $productos->appends(['search' => request('search'), 'sort' => request('sort')])->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <h3 class="mt-3 text-muted">No se encontraron productos</h3>
                <p class="text-muted">Intenta con otra búsqueda o categoría</p>
                <a href="{{route('home')}}" class="btn btn-primary mt-3">
                    <i class="bi bi-arrow-left"></i> Volver al inicio
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
=======
@push('estilos')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles2.css') }}">
@endpush

@section('contenido')
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="banner-bg"></div>
        <div class="container banner-content">
            <div class="welcome-message">
                <div class="icon-wrapper">
                    <i class="fas fa-sparkles"></i>
                </div>
                <div>
                    <div class="welcome-title">¡Bienvenido a Medical Supplies!</div>
                    <p class="welcome-subtitle">Tu socio confiable en equipamiento médico</p>
                </div>
            </div>
            <div class="banner-divider"></div>
            <div class="promo-messages">
                <div class="promo-item">
                    <i class="fas fa-trending-up"></i>
                    <span>Envío GRATIS en compras +$500</span>
                </div>
                <div class="promo-item">
                    <i class="fas fa-award"></i>
                    <span>Productos 100% Certificados</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section id="inicio" class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <div class="hero-badge">✨ Calidad y Confianza en Equipos Médicos</div>
                <h1>Equipos Médicos de <span class="text-blue">Alta Calidad</span> para Profesionales de la Salud</h1>
                <p class="hero-description">Suministramos los mejores equipos y productos médicos con certificaciones internacionales. Innovación, precisión y confiabilidad para tu práctica médica.</p>
                <div class="hero-features">
                    <div class="feature-item"><i class="fas fa-shield-alt"></i><span>Garantía y certificaciones</span></div>
                    <div class="feature-item"><i class="fas fa-truck"></i><span>Envíos y logística eficiente</span></div>
                    <div class="feature-item"><i class="fas fa-headset"></i><span>Soporte técnico especializado</span></div>
                </div>
                <div class="hero-buttons">
                    <a href="{{ route('web.index') }}#productos" class="btn btn-primary btn-lg">Ver Catálogo</a>
                    <a href="{{ route('web.contact') ?? '#contacto' }}" class="btn btn-outline btn-lg">Contáctanos</a>
                </div>
            </div>

            <div class="hero-image">
                <div class="image-bg-decoration"></div>
                <div class="image-wrapper">
                    <img src="https://images.unsplash.com/photo-1631217868264-e5b90bb7e133?w=800&q=80" alt="Equipos médicos de alta calidad">
                </div>
                <div class="stat-card stat-card-left"><div class="stat-number">500+</div><div class="stat-label">Productos Disponibles</div></div>
                <div class="stat-card stat-card-right"><div class="stat-number">15+</div><div class="stat-label">Años de Experiencia</div></div>
            </div>
        </div>
        <div class="hero-decoration hero-decoration-top"></div>
        <div class="hero-decoration hero-decoration-bottom"></div>
    </section>

    <!-- Categories Section -->
    <section id="categorias" class="categories-section">
        <div class="container">
            <div class="section-header">
                <h2>Categorías de Productos</h2>
                <p>Encuentra los equipos médicos que necesitas</p>
            </div>

            <div class="categories-grid">
                <div class="category-card" onclick="filterByCategory('diagnostico')">
                    <div class="category-icon"><i class="fas fa-stethoscope"></i></div>
                    <div>
                        <h3>Diagnóstico</h3>
                        <p>Monitores, estetoscopios, oxímetros</p>
                    </div>
                    <div class="category-badge">Ver</div>
                </div>
                <div class="category-card" onclick="filterByCategory('cirugia')">
                    <div class="category-icon"><i class="fas fa-procedures"></i></div>
                    <div>
                        <h3>Cirugía</h3>
                        <p>Instrumental y mesas quirúrgicas</p>
                    </div>
                    <div class="category-badge">Ver</div>
                </div>
                <div class="category-card" onclick="filterByCategory('laboratorio')">
                    <div class="category-icon"><i class="fas fa-flask"></i></div>
                    <div>
                        <h3>Laboratorio</h3>
                        <p>Microscopios y equipos de análisis</p>
                    </div>
                    <div class="category-badge">Ver</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Catalog -->
    <section id="productos" class="product-catalog">
        <div class="container">
            <div class="section-header">
                <h2>Catálogo de Productos</h2>
                <p>Explora nuestra amplia selección de equipos médicos</p>
            </div>

            <!-- Search and Filters -->
            <form method="GET" action="{{ route('web.index') }}">
                <div class="search-filters">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="searchInput" name="search" placeholder="Buscar productos..." value="{{ request('search') }}">
                    </div>

                    <div class="filter-group">
                        <select id="categoryFilter" name="category" onchange="this.form.submit()">
                            <option value="">Todas las categorías</option>
                            <option value="diagnostico" {{ request('category')=='diagnostico' ? 'selected' : '' }}>Diagnóstico</option>
                            <option value="cirugia" {{ request('category')=='cirugia' ? 'selected' : '' }}>Cirugía</option>
                            <option value="laboratorio" {{ request('category')=='laboratorio' ? 'selected' : '' }}>Laboratorio</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <select id="sortSelect" name="sort" onchange="this.form.submit()">
                            <option value="">Ordenar</option>
                            <option value="priceAsc" {{ request('sort')=='priceAsc' ? 'selected' : '' }}>Precio: menor a mayor</option>
                            <option value="priceDesc" {{ request('sort')=='priceDesc' ? 'selected' : '' }}>Precio: mayor a menor</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <button type="submit" class="btn btn-outline">Aplicar</button>
                    </div>
                </div>
            </form>

            <!-- Products Grid -->
            <div class="products-grid">
                @if($productos->count() == 0)
                    <p>No se encontraron productos.</p>
                @endif

                @foreach($productos as $producto)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('uploads/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                        </div>
                        <div class="product-info">
                            <span class="product-category">{{ $producto->categoria ?? 'Producto' }}</span>
                            <h3 class="product-name">{{ $producto->nombre }}</h3>
                            <p class="product-brand">{{ $producto->marca ?? '' }}</p>
                            <div class="product-price">$ {{ number_format($producto->precio, 2) }}</div>
                            <div class="product-actions">
                                <a href="{{ route('web.show', $producto->id) }}" class="btn btn-outline">Ver</a>
                                <button class="btn btn-primary btn-add-to-cart" onclick="event.preventDefault(); addToCart({{ $producto->id }});">Agregar</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="card-footer clearfix mt-3">
                {{ $productos->appends(request()->except('page'))->links() }}
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-header">
                <h2>Lo Que Dicen Nuestros Clientes</h2>
                <p>Testimonios de profesionales de la salud</p>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <div class="testimonial-text">Excelente calidad en equipos, atención rápida y soporte técnico especializado.</div>
                    <div class="testimonial-author"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt=""> <div><div class="author-name">Dr. Juan Pérez</div><div class="author-role">Cardiólogo</div></div></div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <div class="testimonial-text">Recomendados para clínicas y hospitales. Productos certificados y entrega segura.</div>
                    <div class="testimonial-author"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt=""> <div><div class="author-name">Dra. María López</div><div class="author-role">Médico General</div></div></div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-stars">★★★★★</div>
                    <div class="testimonial-text">Buena relación calidad-precio y excelente servicio postventa.</div>
                    <div class="testimonial-author"><img src="https://randomuser.me/api/portraits/men/65.jpg" alt=""> <div><div class="author-name">Ing. Carlos Ruiz</div><div class="author-role">Administrador Clínico</div></div></div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{ asset('js/scripts2.js') }}"></script>
    @endpush
@endsection
>>>>>>> 00fdd652baaea189ca4008f8eda782f8447020a3
