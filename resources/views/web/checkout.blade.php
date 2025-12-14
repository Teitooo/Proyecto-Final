@extends('web.app')
@section('contenido')
<!-- Checkout Section -->
<section class="checkout-section" style="padding: 40px 0;">
    <div class="container px-4 px-lg-5">
        <div class="mb-5">
            <h1 class="fw-bold mb-2" style="color: var(--primary-color);">
                <i class="fas fa-credit-card me-3"></i>Finalizar Compra
            </h1>
            <p class="text-muted">Selecciona el tipo de envío y confirma tu pedido</p>
        </div>

        <div class="row g-4">
            <!-- Shipping Options -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header" style="background-color: var(--primary-color); color: white;">
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
                                    <div class="form-check" style="padding: 20px; border: 2px solid #e5e7eb; border-radius: 8px; cursor: pointer;">
                                        <input class="form-check-input shipping-option" type="radio" name="tipo_envio" id="envio_standar" value="standar" required>
                                        <label class="form-check-label w-100" for="envio_standar" style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">Envío Estándar</h6>
                                                    <small class="text-muted">5-7 días hábiles</small>
                                                </div>
                                                <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">$0.00</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Envío Express -->
                                <div class="col-12">
                                    <div class="form-check" style="padding: 20px; border: 2px solid #e5e7eb; border-radius: 8px; cursor: pointer;">
                                        <input class="form-check-input shipping-option" type="radio" name="tipo_envio" id="envio_express" value="express" required>
                                        <label class="form-check-label w-100" for="envio_express" style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">Envío Express</h6>
                                                    <small class="text-muted">2-3 días hábiles</small>
                                                </div>
                                                <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">$15.00</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Envío Priority -->
                                <div class="col-12">
                                    <div class="form-check" style="padding: 20px; border: 2px solid #e5e7eb; border-radius: 8px; cursor: pointer;">
                                        <input class="form-check-input shipping-option" type="radio" name="tipo_envio" id="envio_priority" value="priority" required>
                                        <label class="form-check-label w-100" for="envio_priority" style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">Envío Priority</h6>
                                                    <small class="text-muted">Entrega al día siguiente (antes de 12 PM)</small>
                                                </div>
                                                <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">$35.00</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Retiro en Tienda -->
                                <div class="col-12">
                                    <div class="form-check" style="padding: 20px; border: 2px solid #e5e7eb; border-radius: 8px; cursor: pointer;">
                                        <input class="form-check-input shipping-option" type="radio" name="tipo_envio" id="envio_tienda" value="tienda" required>
                                        <label class="form-check-label w-100" for="envio_tienda" style="cursor: pointer;">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">Retiro en Tienda</h6>
                                                    <small class="text-muted">Disponible en 24 horas</small>
                                                </div>
                                                <span style="color: var(--primary-color); font-weight: bold; font-size: 1.1rem;">Gratis</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="mt-4">
                                <h6>Notas especiales (opcional)</h6>
                                <textarea class="form-control" name="notas" rows="3" placeholder="Agrega instrucciones especiales para el envío..."></textarea>
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
                <div class="card" style="position: sticky; top: 20px;">
                    <div class="card-header" style="background-color: var(--primary-color); color: white;">
                        <h6 class="mb-0">Resumen de Compra</h6>
                    </div>
                    <div class="card-body">
                        <div style="max-height: 300px; overflow-y: auto;">
                            @forelse($carrito as $id => $item)
                                <div class="d-flex justify-content-between mb-2" style="font-size: 0.9rem;">
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

                        <div class="d-flex justify-content-between mb-0" style="font-size: 1.1rem; font-weight: bold;">
                            <span>Total</span>
                            <span id="totalAmount">${{ number_format($subtotal, 2) }}</span>
                        </div>

                        <!-- Info Box -->
                        <div style="background-color: #f0f7ff; padding: 12px; border-radius: 6px; margin-top: 15px; border-left: 4px solid var(--primary-color);">
                            <small style="color: #333;">
                                <i class="fas fa-info-circle me-2" style="color: var(--primary-color);"></i>
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
