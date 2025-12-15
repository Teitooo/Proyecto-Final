@extends('plantilla.app')

@section('contenido')
<div class="app-content">
    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-5">
            <h1 class="fw-bold mb-2">
                <i class="fas fa-box me-3"></i>Pedidos
            </h1>
            <p class="text-muted">Visualiza el estado de tus pedidos y los detalles de cada uno</p>
        </div>

        @if(session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Search -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form method="GET" action="{{ route('perfil.pedidos') }}" class="input-group">
                    <input type="text" name="texto" class="form-control" 
                           placeholder="Buscar por ID o estado..." value="{{ request('texto') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        @if($pedidos->count() > 0)
            <!-- Pedidos List -->
            <div class="row g-4">
                @foreach($pedidos as $pedido)
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- Header -->
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <h6 class="mb-1">Pedido #{{ $pedido->id }}</h6>
                                        <small>{{ $pedido->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                    <div class="col-md-3">
                                        <strong>${{ number_format($pedido->total, 2) }}</strong>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="badge" style="background-color: 
                                            @if($pedido->estado === 'pendiente') #fbbf24
                                            @elseif($pedido->estado === 'enviado') #10b981
                                            @elseif($pedido->estado === 'cancelado') #ef4444
                                            @elseif($pedido->estado === 'anulado') #6b7280
                                            @else #3b82f6
                                            @endif
                                        ;">
                                            {{ ucfirst($pedido->estado) }}
                                        </span>
                                    </div>
                                    <div class="col-md-3 text-end">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#pedido-{{ $pedido->id }}">
                                            <i class="fas fa-chevron-down"></i> Ver Detalles
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Details (Collapsible) -->
                            <div class="collapse" id="pedido-{{ $pedido->id }}">
                                <div class="card-body">
                                    <!-- Shipping Info -->
                                    <div class="row mb-4 pb-3" style="border-bottom: 1px solid #e5e7eb;">
                                        <div class="col-md-4">
                                            <h6>Tipo de Envío</h6>
                                            <p class="text-muted">{{ ucfirst($pedido->tipo_envio ?? 'No especificado') }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6>Usuario</h6>
                                            <p class="text-muted">{{ $pedido->user->name }}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{ $pedido->user->email }}</p>
                                        </div>
                                    </div>

                                    <!-- Notas -->
                                    @if($pedido->notas)
                                        <div class="notes-box">
                                            <h6>
                                                <i class="fas fa-sticky-note me-2"></i>Notas Especiales
                                            </h6>
                                            <p>{{ $pedido->notas }}</p>
                                        </div>
                                    @endif

                                    <!-- Productos -->
                                    <h6 style="margin-bottom: 15px;">
                                        <i class="fas fa-box me-2"></i>Productos Ordenados
                                    </h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Producto</th>
                                                    <th class="text-center">Cantidad</th>
                                                    <th class="text-center">Precio Unitario</th>
                                                    <th class="text-end">Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pedido->detalles as $detalle)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $detalle->producto->nombre }}</strong>
                                                            <br><small>{{ $detalle->producto->codigo }}</small>
                                                        </td>
                                                        <td class="text-center">{{ $detalle->cantidad }}</td>
                                                        <td class="text-center">${{ number_format($detalle->precio, 2) }}</td>
                                                        <td class="text-end"><strong>${{ number_format($detalle->cantidad * $detalle->precio, 2) }}</strong></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Total -->
                                    <div class="row mt-3">
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <div class="total-box">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Subtotal:</span>
                                                    <span>${{ number_format($pedido->total * 0.9, 2) }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between mb-2">
                                                    <span>Envío:</span>
                                                    <span>${{ number_format($pedido->total * 0.1, 2) }}</span>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span>Total:</span>
                                                    <span>${{ number_format($pedido->total, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="mt-4 pt-3">
                                        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-home me-2"></i>Volver al Inicio
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-5 d-flex justify-content-center">
                {{ $pedidos->links('pagination::bootstrap-5') }}
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <h4>No tienes pedidos aún</h4>
                <p>Comienza a comprar nuestros productos ahora mismo</p>
                <a href="{{ route('catalog') }}" class="btn btn-primary">
                    <i class="fas fa-shopping-bag me-2"></i>Ver Catálogo
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
