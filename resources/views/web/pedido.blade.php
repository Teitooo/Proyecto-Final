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
                                            <button type="button" class="btn btn-sm btn-qty-decrease" data-producto-id="{{ $id }}">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control text-center cantidad-input" value="{{ $item['cantidad'] }}" readonly data-producto-id="{{ $id }}">
                                            <button type="button" class="btn btn-sm btn-qty-increase" data-producto-id="{{ $id }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <!-- Subtotal -->
                                <td class="text-end">
                                    <span class="price-display">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                                </td>
                                <!-- Delete -->
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-delete-product" data-producto-id="{{ $id }}" title="Eliminar producto">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
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
                    <button type="button" class="clear-cart-btn" id="btn-clear-cart">
                        <i class="fas fa-trash me-2"></i>Vaciar carrito
                    </button>
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
                        <form action="{{route('pedido.checkout')}}" method="GET">
                            @csrf
                            <button type="submit" class="checkout-btn" id="checkout">
                                <i class="fas fa-credit-card"></i>Proceder al Pago
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Sumar cantidad
    document.querySelectorAll('.btn-qty-increase').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productoId = this.getAttribute('data-producto-id');
            actualizarCantidad(productoId, 'sumar', token);
        });
    });

    // Restar cantidad
    document.querySelectorAll('.btn-qty-decrease').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productoId = this.getAttribute('data-producto-id');
            actualizarCantidad(productoId, 'restar', token);
        });
    });

    // Eliminar producto
    document.querySelectorAll('.btn-delete-product').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productoId = this.getAttribute('data-producto-id');
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                eliminarProducto(productoId, token);
            }
        });
    });

    // Vaciar carrito
    const btnClear = document.getElementById('btn-clear-cart');
    if (btnClear) {
        btnClear.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('¿Estás seguro de que deseas vaciar el carrito?')) {
                vaciarCarrito(token);
            }
        });
    }
});

function actualizarCantidad(productoId, accion, token) {
    const url = accion === 'sumar' 
        ? `/carrito/sumar/${productoId}`
        : `/carrito/restar/${productoId}`;

    fetch(url, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en la solicitud');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            actualizarVista(data.carrito);
            mostrarNotificacion('Cantidad actualizada', 'success');
        } else {
            mostrarNotificacion(data.message || 'Error al actualizar', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarNotificacion('Error al actualizar la cantidad', 'error');
    });
}

function eliminarProducto(productoId, token) {
    fetch(`/carrito/eliminar/${productoId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Respuesta del servidor:', data);
        if (data.success) {
            // Verificar si el carrito está vacío
            if (!data.carrito || Object.keys(data.carrito).length === 0) {
                location.reload();
            } else {
                // Actualizar la vista con el carrito modificado
                actualizarVista(data.carrito);
                mostrarNotificacion('Producto eliminado correctamente', 'success');
            }
        } else {
            mostrarNotificacion(data.message || 'Error al eliminar el producto', 'error');
        }
    })
    .catch(error => {
        console.error('Error completo:', error);
        mostrarNotificacion('Error al eliminar el producto. Por favor intenta de nuevo.', 'error');
    });
}

function vaciarCarrito(token) {
    fetch('/carrito/vaciar', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en la solicitud');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarNotificacion('Error al vaciar el carrito', 'error');
    });
}

function actualizarVista(carrito) {
    const tbody = document.querySelector('.cart-items-table tbody');
    if (!tbody) return;

    // Limpiar la tabla
    const filas = tbody.querySelectorAll('tr.cart-item');
    filas.forEach(fila => fila.remove());

    let total = 0;

    // Recrear las filas con los datos actualizados
    Object.keys(carrito).forEach(id => {
        const item = carrito[id];
        const subtotal = item.precio * item.cantidad;
        total += subtotal;

        const row = document.createElement('tr');
        row.className = 'cart-item';
        row.innerHTML = `
            <td>
                <div class="d-flex align-items-center">
                    <div class="cart-product-img">
                        <img src="/uploads/productos/${item.imagen}" alt="${item.nombre}">
                    </div>
                    <div class="cart-product-info">
                        <h6>${item.nombre}</h6>
                        <small>Código: ${item.codigo}</small>
                    </div>
                </div>
            </td>
            <td class="text-center">
                <span class="price-display">$${parseFloat(item.precio).toFixed(2)}</span>
            </td>
            <td class="text-center">
                <div class="d-flex justify-content-center">
                    <div class="quantity-controls">
                        <button type="button" class="btn btn-sm btn-qty-decrease" data-producto-id="${id}">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="text" class="form-control text-center cantidad-input" value="${item.cantidad}" readonly data-producto-id="${id}">
                        <button type="button" class="btn btn-sm btn-qty-increase" data-producto-id="${id}">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </td>
            <td class="text-end">
                <span class="price-display">$${parseFloat(subtotal).toFixed(2)}</span>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-delete-product" data-producto-id="${id}" title="Eliminar producto">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        `;

        tbody.appendChild(row);
    });

    // Re-registrar los event listeners
    document.querySelectorAll('.btn-qty-increase').forEach(btn => {
        btn.addEventListener('click', function() {
            const productoId = this.getAttribute('data-producto-id');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            actualizarCantidad(productoId, 'sumar', token);
        });
    });

    document.querySelectorAll('.btn-qty-decrease').forEach(btn => {
        btn.addEventListener('click', function() {
            const productoId = this.getAttribute('data-producto-id');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            actualizarCantidad(productoId, 'restar', token);
        });
    });

    document.querySelectorAll('.btn-delete-product').forEach(btn => {
        btn.addEventListener('click', function() {
            const productoId = this.getAttribute('data-producto-id');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                eliminarProducto(productoId, token);
            }
        });
    });

    // Actualizar resumen
    document.getElementById('orderSubtotal').textContent = `$${parseFloat(total).toFixed(2)}`;
    document.getElementById('orderTotal').textContent = `$${parseFloat(total).toFixed(2)}`;
}

function mostrarNotificacion(mensaje, tipo) {
    const alertClass = tipo === 'success' ? 'cart-alert-success' : 'cart-alert-error';
    const icon = tipo === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    
    const alert = document.createElement('div');
    alert.className = `cart-alert ${alertClass}`;
    alert.innerHTML = `<i class="fas ${icon}"></i>${mensaje}`;
    
    const container = document.querySelector('.cart-items-container');
    container.insertAdjacentElement('afterend', alert);

    setTimeout(() => {
        alert.remove();
    }, 3000);
}
</script>
@endsection