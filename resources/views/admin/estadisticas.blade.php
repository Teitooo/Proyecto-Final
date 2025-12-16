@extends('plantilla.app')
@section('contenido')
<div class="app-content">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="fw-bold mb-2">
                    <i class="fas fa-chart-bar me-3"></i>Estadísticas del Sistema
                </h1>
                <p class="text-muted">Análisis de interacción y actividad de usuarios</p>
            </div>
        </div>

        <!-- Estadísticas Generales -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">
                            <i class="fas fa-users fa-2x text-primary mb-2"></i>
                        </h3>
                        <h2 class="fw-bold">{{ \App\Models\User::count() }}</h2>
                        <p class="text-muted">Usuarios totales</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">
                            <i class="fas fa-shopping-cart fa-2x text-success mb-2"></i>
                        </h3>
                        <h2 class="fw-bold">{{ \App\Models\Pedido::count() }}</h2>
                        <p class="text-muted">Total de pedidos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">
                            <i class="fas fa-box fa-2x text-warning mb-2"></i>
                        </h3>
                        <h2 class="fw-bold">{{ \App\Models\Producto::count() }}</h2>
                        <p class="text-muted">Productos activos</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="card-title">
                            <i class="fas fa-cubes fa-2x text-info mb-2"></i>
                        </h3>
                        <h2 class="fw-bold">{{ \App\Models\Inventario::count() }}</h2>
                        <p class="text-muted">Items en inventario</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas de Pedidos -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-pie me-2"></i>Estado de Pedidos
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Estado</th>
                                        <th>Cantidad</th>
                                        <th>Porcentaje</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $totalPedidos = \App\Models\Pedido::count();
                                        $estados = ['pendiente', 'en espera', 'enviado', 'entregado', 'cancelado', 'anulado', 'devuelto'];
                                    ?>
                                    @foreach($estados as $estado)
                                        <?php 
                                            $count = \App\Models\Pedido::where('estado', $estado)->count();
                                            $porcentaje = $totalPedidos > 0 ? round(($count / $totalPedidos) * 100, 2) : 0;
                                        ?>
                                        <tr>
                                            <td>
                                                <span class="badge bg-secondary">{{ ucfirst($estado) }}</span>
                                            </td>
                                            <td><strong>{{ $count }}</strong></td>
                                            <td>{{ $porcentaje }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-users-cog me-2"></i>Actividad de Usuarios
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Métrica</th>
                                        <th>Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Usuarios activos</td>
                                        <td><strong>{{ \App\Models\User::where('activo', true)->count() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Usuarios inactivos</td>
                                        <td><strong>{{ \App\Models\User::where('activo', false)->count() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Administradores</td>
                                        <td><strong>{{ \App\Models\User::role('admin')->count() }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Clientes</td>
                                        <td><strong>{{ \App\Models\User::role('cliente')->count() }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Productos por Categoría -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-tags me-2"></i>Productos por Categoría
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Categoría</th>
                                        <th>Cantidad</th>
                                        <th>Precio Promedio</th>
                                        <th>Precio Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $categorias = ['diagnostico', 'cirugia', 'urgencias', 'laboratorio', 'rehabilitacion', 'imagenologia'];
                                    ?>
                                    @foreach($categorias as $categoria)
                                        <?php 
                                            $productos = \App\Models\Producto::where('categoria', $categoria)->get();
                                            $cantidad = $productos->count();
                                            $precioPromedio = $cantidad > 0 ? round($productos->avg('precio'), 2) : 0;
                                            $precioTotal = round($productos->sum('precio'), 2);
                                        ?>
                                        <tr>
                                            <td><strong>{{ ucfirst(str_replace('_', ' ', $categoria)) }}</strong></td>
                                            <td>{{ $cantidad }}</td>
                                            <td>${{ number_format($precioPromedio, 2) }}</td>
                                            <td>${{ number_format($precioTotal, 2) }}</td>
                                        </tr>
                                    @endforeach
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
    </script>
@endpush
