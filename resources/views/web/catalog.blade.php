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
                            <span class="filter-count">{{ $categoryCounts['all'] ?? 0 }}</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="diagnostico">
                            <span>Diagnóstico</span>
                            <span class="filter-count">{{ $categoryCounts['diagnostico'] ?? 0 }}</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="cirugia">
                            <span>Cirugía</span>
                            <span class="filter-count">{{ $categoryCounts['cirugia'] ?? 0 }}</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="urgencias">
                            <span>Urgencias</span>
                            <span class="filter-count">{{ $categoryCounts['urgencias'] ?? 0 }}</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="laboratorio">
                            <span>Laboratorio</span>
                            <span class="filter-count">{{ $categoryCounts['laboratorio'] ?? 0 }}</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="rehabilitacion">
                            <span>Rehabilitación</span>
                            <span class="filter-count">{{ $categoryCounts['rehabilitacion'] ?? 0 }}</span>
                        </label>
                        <label class="filter-checkbox">
                            <input type="checkbox" value="imagenologia">
                            <span>Imagenología</span>
                            <span class="filter-count">{{ $categoryCounts['imagenologia'] ?? 0 }}</span>
                        </label>
                    </div>
                </div>

                <!-- Brands -->
                <div class="sidebar-section">
                    <h3 class="sidebar-title">
                        <i class="fas fa-trademark"></i>
                        Marcas
                    </h3>
                    <div class="filter-options">
                        @php
                            $marcas = \App\Models\Producto::whereNotNull('marca')
                                ->distinct()
                                ->pluck('marca')
                                ->sort();
                        @endphp
                        @forelse($marcas as $marca)
                            @php
                                $count = \App\Models\Producto::where('marca', $marca)->count();
                            @endphp
                            <label class="filter-checkbox">
                                <input type="checkbox" value="{{ $marca }}" class="brand-filter">
                                <span>{{ $marca }}</span>
                                <span class="filter-count">{{ $count }}</span>
                            </label>
                        @empty
                            <p style="color: #999; padding: 10px 0;">No hay marcas disponibles</p>
                        @endforelse
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
                    @if($productos->count() > 0)
                        @foreach($productos as $producto)
                            <div class="product-card" data-price="{{ $producto->precio }}">
                                <div class="product-image">
                                    <img src="{{ asset('uploads/productos/'. $producto->imagen) }}" alt="{{ $producto->nombre }}">
                                    @if($producto->inventario)
                                        <span class="stock-badge {{ $producto->inventario->cantidad_disponible <= 0 ? 'out-of-stock' : ($producto->inventario->cantidad_disponible <= $producto->inventario->cantidad_minima ? 'low-stock' : '') }}">
                                            {{ $producto->inventario->cantidad_disponible > 0 ? 'Stock: ' . $producto->inventario->cantidad_disponible : 'Sin Stock' }}
                                        </span>
                                    @endif
                                    <button class="product-compare-btn" onclick="toggleCompare({{ $producto->id }})">
                                        <i class="fas fa-exchange-alt"></i>
                                    </button>
                                </div>
                                <div class="product-info">
                                    <h3 class="product-name">{{ $producto->nombre }}</h3>
                                    <p class="product-brand">{{ $producto->codigo }}</p>
                                    <div class="product-description" style="font-size: 0.9rem; color: #666; margin-bottom: 10px;">
                                        {{ Str::limit($producto->descripcion ?? '', 60) }}
                                    </div>
                                    <div class="product-price">${{ number_format($producto->precio, 2) }}</div>
                                    @if($producto->inventario)
                                        <div style="font-size: 0.85rem; color: {{ $producto->inventario->cantidad_disponible > 0 ? '#10b981' : '#ef4444' }}; margin-top: 5px;">
                                            <i class="bi bi-archive"></i>
                                            {{ $producto->inventario->cantidad_disponible > 0 ? 'Disponible' : 'Agotado' }}
                                        </div>
                                    @endif
                                    <div class="product-actions" style="margin-top: 10px;">
                                        <a href="{{ route('web.show', $producto->id) }}" class="btn btn-outline" style="flex: 1; margin-right: 5px;">
                                            <i class="bi bi-eye"></i> Ver
                                        </a>
                                        <button class="btn btn-primary btn-add-to-cart" 
                                                onclick="addToCart({{ $producto->id }})"
                                                {{ $producto->inventario && $producto->inventario->cantidad_disponible <= 0 ? 'disabled' : '' }}
                                                style="{{ $producto->inventario && $producto->inventario->cantidad_disponible <= 0 ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
                                            <i class="fas fa-shopping-cart"></i>
                                            {{ $producto->inventario && $producto->inventario->cantidad_disponible <= 0 ? 'Sin Stock' : 'Agregar' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <h3 style="margin-top: 15px; color: #999;">No se encontraron productos</h3>
                            <p style="color: #bbb;">Intenta ajustando los filtros o busca otros términos</p>
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                <div class="catalog-pagination">
                    {{ $productos->links('pagination::bootstrap-4') }}
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
