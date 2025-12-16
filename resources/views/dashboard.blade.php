@extends('plantilla.app')
@section('contenido')
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Panel de Control</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h4 class="mb-4">Bienvenido, {{ Auth::user()->name }}</h4>
                            @if(Auth::user()->hasRole('admin'))
                            <div class="row">
                                <!-- Tarjeta: Pedidos Nuevos -->
                                <div class="col-md-3">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3>{{ $newOrders }}</h3>
                                            <p> Pedidos nuevos</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="{{ route('pedidos.admin') }}" class="small-box-footer">Ver detalles <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- Tarjeta: Estadísticas -->
                                <div class="col-md-3">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3>{{ $bounceRate }}<sup style="font-size: 20px">%</sup></h3>
                                            <p> Interacción del usuario</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <a href="{{ route('admin.estadisticas') }}" class="small-box-footer"> Ver estadísticas <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- Tarjeta: Usuarios Registrados -->
                                <div class="col-md-3">
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3>{{ $userRegistrations }}</h3>
                                            <p>👤 Usuarios registrados</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                        <a href="{{ route('usuarios.index') }}" class="small-box-footer"> Ver usuarios<i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- Tarjeta: Accesos Recientes -->
                                <div class="col-md-3">
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3>{{ $uniqueVisitors }}</h3>
                                            <p> Accesos recientes</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="{{ route('admin.accesos') }}" class="small-box-footer"> Ver accesos <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="small-box bg-primary">
                                        <div class="inner">
                                            <h3>{{ $userOrders }}</h3>
                                            <p>Mis Pedidos</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <a href="{{ route('perfil.pedidos') }}" class="small-box-footer">Ver Pedidos <i
                                                class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(Session::has('mensaje'))
                                <div class="alert alert-info alert-dismissible fade show mt-2">
                                    {{Session::get('mensaje')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('mnuDashboard').classList.add('active');
    </script>
@endpush