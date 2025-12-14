@extends('web.app')
@section('contenido')
<!-- Cart Section -->
<section class="cart-section">
    <div class="container px-4 px-lg-5 my-5">
        <div background-color: class="cart-header mb-4">
        <div class="mb-5">
            <h1 class="fw-bold mb-2" style="color: var(--primary-color);">
                <i class="fas fa-shopping-cart me-3" ></i>Tu Carrito de Compras
            </h1>
            <p class="text-muted" style="color: var(--primary-color);">Revisa y confirma tus productos antes de realizar el pedido</p>
        </div>
        </div>
        <div class="row g-4">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="cart-items-container">
                    <table class="cart-items-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Precio</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($carrito as $id => $item)
                            <tr class="cart-item">
                                <!-- Product -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="cart-product-img">
                                            <img src="{{ asset('uploads/productos/' . $item['imagen']) }}" 
                                            alt="{{ $item['nombre'] }}">
                                        </div>
                                        <div class="cart-product-info">
                                            <h6>{{ $item['nombre'] }}</h6>
                                            <small>Código: {{ $item['codigo'] }}</small>
                                        </div>
                                    </div>
                                </td>
                                <!-- Price -->
                                <td class="text-center">
                                    <span class="price-display">${{ number_format($item['precio'], 2) }}</span>
                                </td>
                                <!-- Quantity -->
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <div class="quantity-controls">
                                            <a class="btn btn-sm" href="{{ route('carrito.restar', ['producto_id' => $id]) }}">
                                                <i class="fas fa-minus"></i>
                                            </a>
                                            <input type="text" class="form-control text-center" value="{{ $item['cantidad'] }}" readonly>
                                            <a class="btn btn-sm" href="{{ route('carrito.sumar', ['producto_id' => $id]) }}">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <!-- Subtotal -->
                                <td class="text-end">
                                    <span class="price-display">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                                </td>
                                <!-- Delete -->
                                <td class="text-center">
                                    <a class="cart-delete-btn" href="{{ route('carrito.eliminar', $id) }}" title="Eliminar producto">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-cart-container">
                                        <i class="fas fa-shopping-basket empty-cart-icon"></i>
                                        <p class="empty-cart-text">Tu carrito está vacío</p>
                                        <a href="{{ route('home') }}" class="checkout-btn">
                                            <i class="fas fa-arrow-left"></i>Volver a comprar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (session('mensaje'))
                    <div class="cart-alert cart-alert-success mt-3" role="alert">
                        <i class="fas fa-check-circle"></i>{{ session('mensaje') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="cart-alert cart-alert-error mt-3" role="alert">
                        <i class="fas fa-exclamation-circle"></i>{{ session('error') }}
                    </div>
                @endif

                @if(count($carrito) > 0)
                <div class="cart-footer">
                    <a class="clear-cart-btn" href="{{route('carrito.vaciar')}}">
                        <i class="fas fa-trash me-2"></i>Vaciar carrito
                    </a>
                </div>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="order-summary">
                    <div class="cart-header">
                        <h5><i class="fas fa-receipt"></i>Resumen del Pedido</h5>
                    </div>
                    <div class="summary-body">
                        @php
                            $total = 0;
                            foreach ($carrito as $item) {
                                $total += $item['precio'] * $item['cantidad'];
                            }
                        @endphp
                        
                        <div class="summary-line">
                            <span>Subtotal:</span>
                            <span id="orderSubtotal">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="summary-line">
                            <span>Envío:</span>
                            <span id="orderShipping">Gratis</span>
                        </div>

                        <div class="summary-total">
                            <span class="summary-total-label">Total</span>
                            <span class="summary-total-value" id="orderTotal">${{ number_format($total, 2) }}</span>
                        </div>
                        
                        @if(count($carrito) > 0)
                        <!-- Checkout Button -->
                        <form action="{{route('pedido.realizar')}}" method="POST">
                            @csrf
                            <button type="submit" class="checkout-btn" id="checkout">
                                <i class="fas fa-credit-card"></i>Realizar Pedido
                            </button>
                        </form>
                        @endif
                        
                        <!-- Continue Shopping -->
                        <a href="{{ route('home') }}" class="continue-shopping-btn d-block">
                            <i class="fas fa-arrow-left"></i>Continuar Comprando
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection