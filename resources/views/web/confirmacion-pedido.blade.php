@extends('web.app')

@section('contenido')
<!-- Confirmation Section -->
<section class="confirmation-section">
    <div class="container px-4 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Success Card -->
                <div class="confirmation-card text-center">
                    <div class="card-body">
                        <!-- Success Icon -->
                        <div class="success-icon">
                            <i class="fas fa-check"></i>
                        </div>

                        <!-- Main Message -->
                        <h2 class="confirmation-title">
                            ¡Su pedido fue tomado exitosamente!
                        </h2>
                        <p class="confirmation-subtitle">
                            Muchas gracias por preferirnos
                        </p>

                        <!-- Order Details -->
                        <div class="details-box">
                            <h6>Detalles del Pedido</h6>
                            
                            <div class="detail-row">
                                <span class="detail-label">Número de Pedido:</span>
                                <span class="detail-value">{{ $pedido->id }}</span>
                            </div>

                            <div class="detail-row">
                                <span class="detail-label">Fecha:</span>
                                <span class="detail-value">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                            </div>

                            <div class="detail-row">
                                <span class="detail-label">Estado:</span>
                                <span class="detail-value" style="background-color;">{{ ucfirst($pedido->estado) }}</span>
                            </div>

                            <div class="detail-row">
                                <span class="detail-label">Tipo de Envío:</span>
                                <span class="detail-value text-capitalize">{{ $pedido->tipo_envio ?? 'Estándar' }}</span>
                            </div>

                            <div class="detail-row">
                                <span class="detail-label fw-bold">Total a Pagar:</span>
                                <span class="detail-value total">${{ number_format($pedido->total, 2) }}</span>
                            </div>
                        </div>

                        <!-- Items Summary -->
                        <div class="items-list">
                            <h6>Productos Ordenados</h6>
                            
                            @forelse($pedido->detalles as $detalle)
                                <div class="item-row">
                                    <span class="item-name">{{ $detalle->producto->nombre }}</span>
                                    <span class="item-price">
                                        <small class="item-quantity">{{ $detalle->cantidad }}x</small>
                                        <span class="item-total">${{ number_format($detalle->precio * $detalle->cantidad, 2) }}</span>
                                    </span>
                                </div>
                            @empty
                                <p class="text-muted">No hay productos</p>
                            @endforelse
                        </div>

                        <!-- Info Messages -->
                        <div class="info-message email-info">
                            <i class="fas fa-envelope"></i>
                            <span>Te hemos enviado un correo de confirmación con los detalles del pedido</span>
                        </div>

                        <div class="info-message delivery-info">
                            <i class="fas fa-truck"></i>
                            <span>Tu pedido será preparado y despachado en las próximas 24 horas</span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            <a href="{{ route('perfil.pedidos') }}" class="btn-primary-action">
                                <i class="fas fa-list"></i>Ver Mis Pedidos
                            </a>
                            <a href="{{ route('home') }}" class="btn-secondary-action">
                                <i class="fas fa-home"></i>Volver al Inicio
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
