@extends('web.app')
@section('contenido')
<!-- Item Section -->
<section class="item-section">
    <div class="container px-4 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Item Product Card -->
                <div class="item-card">
                    <form action="{{route('carrito.agregar')}}" method="POST">
                        @csrf
                        <!-- Image Container -->
                        <div class="item-image-container">
                            <img class="card-img-top"
                                src="{{asset('uploads/productos/'. $producto->imagen) }}" 
                                alt="{{$producto->nombre}}"/>
                        </div>

                        <!-- Product Info -->
                        <div class="item-info-container">
                            <!-- SKU -->
                            <div class="product-sku">SKU: {{$producto->codigo}}</div>

                            <!-- Title -->
                            <h1 class="product-title">{{$producto->nombre}}</h1>

                            <!-- Price Box -->
                            <div class="product-price-container">
                                <div class="product-price-label">Precio</div>
                                <div class="product-price">${{$producto->precio}}</div>
                            </div>

                            <!-- Description -->
                            <p class="product-description">{{$producto->descripcion}}</p>

                            <!-- Disponibilidad -->
                            @if($producto->inventario)
                                <div style="margin: 15px 0; padding: 10px; background-color: {{ $producto->inventario->estado === 'activo' && $producto->inventario->cantidad_disponible > 0 ? '#ecfdf5' : '#fef2f2' }}; border-left: 4px solid {{ $producto->inventario->estado === 'activo' && $producto->inventario->cantidad_disponible > 0 ? '#10b981' : '#ef4444' }}; border-radius: 4px;">
                                    <strong style="color: {{ $producto->inventario->estado === 'activo' && $producto->inventario->cantidad_disponible > 0 ? '#10b981' : '#ef4444' }};">
                                        @if($producto->inventario->estado !== 'activo')
                                            <i class="bi bi-exclamation-circle me-2"></i>Producto no disponible en este momento
                                        @elseif($producto->inventario->cantidad_disponible > 0)
                                            <i class="bi bi-check-circle me-2"></i>En stock: {{ $producto->inventario->cantidad_disponible }} unidades disponibles
                                        @else
                                            <i class="bi bi-exclamation-triangle me-2"></i>Producto agotado
                                        @endif
                                    </strong>
                                </div>
                            @endif

                            <!-- Success Message -->
                            @if (session('mensaje'))
                                <div class="alert-success">
                                    {{ session('mensaje') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Error Message -->
                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <!-- Action Section -->
                            <div class="action-section">
                                <input type="hidden" name="producto_id" value="{{$producto->id}}">

                                <!-- Quantity Selection -->
                                <div class="quantity-container">
                                    <label for="inputQuantity" class="quantity-label">Cantidad:</label>
                                    <input id="inputQuantity" type="number" name="cantidad" 
                                        min="1" value="1" max="{{ $producto->inventario ? $producto->inventario->cantidad_disponible : 1 }}" required/>
                                </div>

                                <!-- Action Buttons -->
                                <div class="action-buttons">
                                    <button class="btn-add-cart" type="submit"
                                            {{ (!$producto->inventario || $producto->inventario->estado !== 'activo' || $producto->inventario->cantidad_disponible <= 0) ? 'disabled' : '' }}
                                            style="{{ (!$producto->inventario || $producto->inventario->estado !== 'activo' || $producto->inventario->cantidad_disponible <= 0) ? 'opacity: 0.5; cursor: not-allowed;' : '' }}">
                                        <i class="bi-cart-fill me-1"></i>
                                        @if(!$producto->inventario || $producto->inventario->estado !== 'activo')
                                            No disponible
                                        @elseif($producto->inventario->cantidad_disponible <= 0)
                                            Agotado
                                        @else
                                            Agregar al carrito
                                        @endif
                                    </button>
                                    <a class="btn-back" href="javascript:history.back()">
                                        <i class="bi-arrow-left me-1"></i>
                                        Regresar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection