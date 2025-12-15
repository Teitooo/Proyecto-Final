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

                            <!-- Success Message -->
                            @if (session('mensaje'))
                                <div class="alert-success">
                                    {{ session('mensaje') }}
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
                                        min="1" value="1" required/>
                                </div>

                                <!-- Action Buttons -->
                                <div class="action-buttons">
                                    <button class="btn-add-cart" type="submit">
                                        <i class="bi-cart-fill me-1"></i>
                                        Agregar al carrito
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