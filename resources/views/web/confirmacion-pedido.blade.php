@extends('web.app')
@section('contenido')
<!-- Confirmation Section -->
<section class="confirmation-section" style="padding: 60px 0;">
    <div class="container px-4 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Success Card -->
                <div class="card text-center" style="border: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <div class="card-body p-5">
                        <!-- Success Icon -->
                        <div style="margin-bottom: 30px;">
                            <div style="display: inline-block; width: 80px; height: 80px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check" style="font-size: 2.5rem; color: white;"></i>
                            </div>
                        </div>

                        <!-- Main Message -->
                        <h2 class="fw-bold mb-3" style="color: var(--primary-color);">
                            ¡Su pedido fue tomado exitosamente!
                        </h2>
                        <p class="text-muted mb-4" style="font-size: 1.1rem;">
                            Muchas gracias por preferirnos
                        </p>

                        <!-- Order Details -->
                        <div style="background: #f9fafb; padding: 20px; border-radius: 8px; margin-bottom: 30px; text-align: left;">
                            <h6 class="fw-bold mb-3">Detalles del Pedido</h6>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Número de Pedido:</span>
                                <span class="fw-bold">{{ $pedido->id }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Fecha:</span>
                                <span>{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Estado:</span>
                                <span class="badge" style="background-color: var(--primary-color);">{{ ucfirst($pedido->estado) }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Tipo de Envío:</span>
                                <span class="fw-bold text-capitalize">{{ $pedido->tipo_envio ?? 'Estándar' }}</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <span class="text-muted fw-bold">Total a Pagar:</span>
                                <span class="fw-bold" style="color: var(--primary-color); font-size: 1.2rem;">${{ number_format($pedido->total, 2) }}</span>
                            </div>
                        </div>

                        <!-- Items Summary -->
                        <div style="background: #f9fafb; padding: 20px; border-radius: 8px; margin-bottom: 30px; text-align: left;">
                            <h6 class="fw-bold mb-3">Productos Ordenados</h6>
                            
                            @forelse($pedido->detalles as $detalle)
                                <div class="d-flex justify-content-between mb-2">
                                    <span>{{ $detalle->producto->nombre }}</span>
                                    <span>
                                        <small class="text-muted">{{ $detalle->cantidad }}x</small>
                                        <span class="fw-bold">${{ number_format($detalle->precio * $detalle->cantidad, 2) }}</span>
                                    </span>
                                </div>
                            @empty
                                <p class="text-muted">No hay productos</p>
                            @endforelse
                        </div>

                        <!-- Info Messages -->
                        <div style="background: #e0f2fe; padding: 12px; border-radius: 6px; border-left: 4px solid var(--primary-color); margin-bottom: 20px; text-align: left;">
                            <small style="color: #0369a1;">
                                <i class="fas fa-envelope me-2"></i>Te hemos enviado un correo de confirmación con los detalles del pedido
                            </small>
                        </div>

                        <div style="background: #f0fdf4; padding: 12px; border-radius: 6px; border-left: 4px solid #10b981; margin-bottom: 20px; text-align: left;">
                            <small style="color: #166534;">
                                <i class="fas fa-truck me-2"></i>Tu pedido será preparado y despachado en las próximas 24 horas
                            </small>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2">
                            <a href="{{ route('perfil.pedidos') }}" class="btn btn-primary" style="flex: 1;">
                                <i class="fas fa-list me-2"></i>Ver Mis Pedidos
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary" style="flex: 1;">
                                <i class="fas fa-home me-2"></i>Volver al Inicio
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Secondary Message -->
                <div style="text-align: center; margin-top: 30px;">
                    <p class="text-muted">
                        ¿Preguntas? Contáctanos en <strong>contacto@medicalsupplies.com</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
