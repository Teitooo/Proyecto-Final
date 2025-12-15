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
