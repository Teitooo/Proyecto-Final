@extends('plantilla.app')
@section('contenido')
<div class="app-content">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="fw-bold mb-2">
                    <i class="fas fa-history me-3"></i>Accesos Recientes
                </h1>
                <p class="text-muted">Historial de acceso y actividad de usuarios</p>
            </div>
        </div>

        <!-- Resumen Rápido -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center bg-light">
                    <div class="card-body">
                        <h3 class="card-title">
                            <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                        </h3>
                        <h2 class="fw-bold">{{ \App\Models\User::where('updated_at', '>=', now()->subDay())->count() }}</h2>
                        <p class="text-muted">Accesos hoy</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-light">
                    <div class="card-body">
                        <h3 class="card-title">
                            <i class="fas fa-user-check fa-2x text-success mb-2"></i>
                        </h3>
                        <h2 class="fw-bold">{{ \App\Models\User::where('activo', true)->count() }}</h2>
                        <p class="text-muted">Usuarios en línea</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-light">
                    <div class="card-body">
                        <h3 class="card-title">
                            <i class="fas fa-user-times fa-2x text-danger mb-2"></i>
                        </h3>
                        <h2 class="fw-bold">{{ \App\Models\User::where('activo', false)->count() }}</h2>
                        <p class="text-muted">Usuarios inactivos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center bg-light">
                    <div class="card-body">
                        <h3 class="card-title">
                            <i class="fas fa-shield-alt fa-2x text-primary mb-2"></i>
                        </h3>
                        <h2 class="fw-bold">{{ \App\Models\User::role('admin')->count() }}</h2>
                        <p class="text-muted">Administradores</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Últimos Usuarios Activos -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>Usuarios Recientes
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Estado</th>
                                        <th>Último acceso</th>
                                        <th>Registrado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(\App\Models\User::orderBy('updated_at', 'desc')->limit(20)->get() as $user)
                                        <tr>
                                            <td><strong>#{{ $user->id }}</strong></td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->hasRole('admin'))
                                                    <span class="badge bg-danger">Admin</span>
                                                @else
                                                    <span class="badge bg-info">Cliente</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->activo)
                                                    <span class="badge bg-success">Activo</span>
                                                @else
                                                    <span class="badge bg-secondary">Inactivo</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $user->updated_at->format('d/m/Y H:i') }}
                                                </small>
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $user->created_at->format('d/m/Y') }}
                                                </small>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                No hay registros disponibles
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actividad de Pedidos Recientes -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-shopping-cart me-2"></i>Pedidos Recientes
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Pedido</th>
                                        <th>Usuario</th>
                                        <th>Estado</th>
                                        <th>Total Items</th>
                                        <th>Fecha del Pedido</th>
                                        <th>Última Actualización</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(\App\Models\Pedido::with('user')->orderBy('updated_at', 'desc')->limit(15)->get() as $pedido)
                                        <tr>
                                            <td><strong>#{{ $pedido->id }}</strong></td>
                                            <td>{{ $pedido->user->name ?? 'N/A' }}</td>
                                            <td>
                                                @switch($pedido->estado)
                                                    @case('pendiente')
                                                        <span class="badge bg-warning">Pendiente</span>
                                                        @break
                                                    @case('en espera')
                                                        <span class="badge bg-info">En Espera</span>
                                                        @break
                                                    @case('enviado')
                                                        <span class="badge bg-primary">Enviado</span>
                                                        @break
                                                    @case('entregado')
                                                        <span class="badge bg-success">Entregado</span>
                                                        @break
                                                    @case('cancelado')
                                                        <span class="badge bg-danger">Cancelado</span>
                                                        @break
                                                    @case('anulado')
                                                        <span class="badge bg-dark">Anulado</span>
                                                        @break
                                                    @case('devuelto')
                                                        <span class="badge bg-secondary">Devuelto</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">{{ ucfirst($pedido->estado) }}</span>
                                                @endswitch
                                            </td>
                                            <td>{{ $pedido->detalles->count() ?? 0 }}</td>
                                            <td>
                                                <small>{{ $pedido->created_at->format('d/m/Y H:i') }}</small>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $pedido->updated_at->format('d/m/Y H:i') }}</small>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                No hay pedidos disponibles
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón de retorno -->
        <div class="row mt-4">
            <div class="col-md-12">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Volver al Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        document.getElementById('mnuDashboard').classList.add('active');
        
        // Auto-actualizar cada 30 segundos (opcional)
        // setInterval(function() {
        //     location.reload();
        // }, 30000);
    </script>
@endpush
