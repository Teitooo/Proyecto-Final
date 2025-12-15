@extends('web.app')
@section('contenido')
<!-- Checkout Section -->
<section class="checkout-section">
    <div class="container px-4 px-lg-5">
        <div class="mb-5">
            <h1 class="fw-bold mb-2">
                <i class="fas fa-credit-card me-3"></i>Finalizar Compra
            </h1>
            <p class="text-muted">Selecciona el tipo de envío y confirma tu pedido</p>
        </div>

        <div class="row g-4">
            <!-- Shipping Options -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-truck me-2"></i>Tipo de Envío
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="checkoutForm" method="POST" action="{{ route('pedido.realizar') }}">
                            @csrf
                            
                            <div class="row g-3">
                                <!-- Envío Estándar -->
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shipping-option" type="radio" name="tipo_envio" id="envio_standar" value="standar" required>
                                        <label class="form-check-label w-100" for="envio_standar">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">Envío Estándar</h6>
                                                    <small class="text-muted">5-7 días hábiles</small>
                                                </div>
                                                <span>$0.00</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Envío Express -->
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shipping-option" type="radio" name="tipo_envio" id="envio_express" value="express" required>
                                        <label class="form-check-label w-100" for="envio_express">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">Envío Express</h6>
                                                    <small class="text-muted">2-3 días hábiles</small>
                                                </div>
                                                <span>$15.00</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Envío Priority -->
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shipping-option" type="radio" name="tipo_envio" id="envio_priority" value="priority" required>
                                        <label class="form-check-label w-100" for="envio_priority">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">Envío Priority</h6>
                                                    <small class="text-muted">Entrega al día siguiente (antes de 12 PM)</small>
                                                </div>
                                                <span>$35.00</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Retiro en Tienda -->
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input shipping-option" type="radio" name="tipo_envio" id="envio_tienda" value="tienda" required>
                                        <label class="form-check-label w-100" for="envio_tienda">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">Retiro en Tienda</h6>
                                                    <small class="text-muted">Disponible en 24 horas</small>
                                                </div>
                                                <span>Gratis</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="mt-4" style="margin-left: -28px; margin-right: -28px; padding: 24px 28px; background: rgba(14, 165, 233, 0.03); border-radius: 12px;">
                                <h6 style="margin-top: 0;">
                                    <i class="fas fa-sticky-note me-2" style="color: var(--primary);"></i>Notas especiales (opcional)
                                </h6>
                                <textarea class="form-control" name="notas" rows="6" placeholder="Agrega instrucciones especiales para el envío, recomendaciones de entrega, horarios preferidos, etc..."></textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex gap-2 mt-4">
                                <a href="{{ route('carrito.mostrar') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>Volver al Carrito
                                </a>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <i class="fas fa-check me-2"></i>Confirmar Pedido
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Resumen de Compra</h6>
                    </div>
                    <div class="card-body">
                        <div>
                            @forelse($carrito as $id => $item)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $item['nombre'] }} ({{ $item['cantidad'] }})</span>
                                    <span>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                                </div>
                            @empty
                                <p class="text-muted text-center">El carrito está vacío</p>
                            @endforelse
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Envío</span>
                            <span id="shippingCost">$0.00</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-0">
                            <span>Total</span>
                            <span id="totalAmount">${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <!-- Info Box -->
                        <div>
                            <small>
                                <i class="fas fa-info-circle me-2"></i>
                                Al confirmar tu pedido, aceptas nuestros términos y condiciones
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const shippingCosts = {
        'standar': 0,
        'express': 15,
        'priority': 35,
        'tienda': 0
    };

    const subtotal = {{ $subtotal }};

    document.querySelectorAll('.shipping-option').forEach(option => {
        option.addEventListener('change', function() {
            const cost = shippingCosts[this.value];
            const total = subtotal + cost;
            
            document.getElementById('shippingCost').textContent = '$' + cost.toFixed(2);
            document.getElementById('totalAmount').textContent = '$' + total.toFixed(2);
        });
    });

    // Set default value
    if (document.getElementById('envio_standar')) {
        document.getElementById('envio_standar').checked = true;
        document.getElementById('shippingCost').textContent = '$0.00';
    }
</script>
@endsection
