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
                        <h3 class="card-title">Productos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div>
                            <form action="{{route('productos.index')}}" method="get">
                                <div class="input-group">
                                    <input name="texto" type="text" class="form-control" value="{{$texto}}"
                                        placeholder="Ingrese texto a buscar">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i>
                                            Buscar</button>
                                        @can('producto-create')
                                        <a href="{{route('productos.create')}}" class="btn btn-primary"> Nuevo</a>
                                        @endcan
                                    </div>
                                </div>
                            </form>
                        </div>
                        @can('producto-delete')
                        <div class="mt-3">
                            <button type="button" class="btn btn-danger btn-sm" id="btnEliminarSeleccion" disabled 
                                    data-bs-toggle="modal" data-bs-target="#modal-eliminar-masivo">
                                <i class="fas fa-trash"></i> Eliminar Seleccionados
                            </button>
                            <button type="button" class="btn btn-warning btn-sm" id="btnSeleccionarTodo">
                                <i class="fas fa-check-square"></i> Seleccionar Todo
                            </button>
                            <button type="button" class="btn btn-info btn-sm" id="btnDeseleccionarTodo">
                                <i class="fas fa-square"></i> Deseleccionar Todo
                            </button>
                            <span id="contadorSeleccion" class="ms-2 text-muted">(0 seleccionados)</span>
                        </div>
                        @endcan
                        @if(Session::has('mensaje'))
                        <div class="alert alert-info alert-dismissible fade show mt-2">
                            {{Session::get('mensaje')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                        </div>
                        @endif
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 40px">
                                            <input type="checkbox" id="checkAll" class="form-check-input" style="cursor: pointer;">
                                        </th>
                                        <th style="width: 150px">Opciones</th>
                                        <th style="width: 20px">ID</th>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Marca</th>
                                        <th>Categoría</th>
                                        <th>Imagen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($registros)<=0)
                                        <tr>
                                            <td colspan="6">No hay registros que coincidan con la búsqueda</td>
                                        </tr>
                                    @else
                                        @foreach($registros as $reg)
                                            <tr class="align-middle">
                                                <td>
                                                    <input type="checkbox" name="productos[]" value="{{$reg->id}}" class="form-check-input checkbox-producto" style="cursor: pointer;">
                                                </td>
                                                <td>
                                                    @can('producto-edit')
                                                    <a href="{{route('productos.edit', $reg->id)}}" class="btn btn-info btn-sm"><i class="bi bi-pencil-fill"></i></a>&nbsp;
                                                    @endcan
                                                    @can('producto-delete')
                                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                            data-bs-target="#modal-eliminar-{{$reg->id}}"><i class="bi bi-trash-fill"></i>
                                                    </button>
                                                    @endcan
                                                </td>
                                                <td>{{$reg->id}}</td>
                                                <td>{{$reg->codigo}}</td>
                                                <td>{{$reg->nombre}}</td>
                                                <td>{{$reg->precio}}</td>
                                                <td>{{$reg->marca}}</td>
                                                <td>
                                                    <span class="badge bg-secondary">{{$reg->categoria ?? 'Sin categoría'}}</span>
                                                </td>
                                                <td>
                                                @if($reg->imagen)
                                                    <img src="{{ asset('uploads/productos/' . $reg->imagen) }}" alt="{{ $reg->nombre }}" style="max-width: 150px; height: auto;">
                                                @else
                                                    <span>Sin imagen</span>
                                                @endif
                                                </td>
                                            </tr>
                                            @can('producto-delete')
                                                @include('producto.delete')
                                            @endcan
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{$registros->appends(["texto"=>$texto])}}
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

<!-- Modal para eliminación masiva -->
@can('producto-delete')
<div class="modal fade" id="modal-eliminar-masivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content bg-danger">
            <form id="formEliminarMasivo" action="{{route('productos.eliminar-masivo')}}" method="post">
                @csrf
                @method('POST')
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar productos seleccionados</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de eliminar <strong id="modalContador">0</strong> producto(s)?</p>
                    <p class="text-warning">Esta acción no se puede deshacer.</p>
                    <div id="productosAEliminar"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-light">Eliminar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endcan
@endsection
@push('scripts')
<script>
    document.getElementById('mnuAlmacen').classList.add('menu-open');
    document.getElementById('itemProducto').classList.add('active');

    // Seleccionar todos los checkboxes
    document.getElementById('btnSeleccionarTodo').addEventListener('click', function() {
        document.querySelectorAll('.checkbox-producto').forEach(checkbox => {
            checkbox.checked = true;
        });
        actualizarContador();
    });

    // Deseleccionar todos los checkboxes
    document.getElementById('btnDeseleccionarTodo').addEventListener('click', function() {
        document.querySelectorAll('.checkbox-producto').forEach(checkbox => {
            checkbox.checked = false;
        });
        actualizarContador();
    });

    // Check all cuando se marca el checkbox "Seleccionar todo"
    document.getElementById('checkAll').addEventListener('change', function() {
        document.querySelectorAll('.checkbox-producto').forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        actualizarContador();
    });

    // Actualizar contador y estado del botón
    document.querySelectorAll('.checkbox-producto').forEach(checkbox => {
        checkbox.addEventListener('change', actualizarContador);
    });

    function actualizarContador() {
        const seleccionados = document.querySelectorAll('.checkbox-producto:checked').length;
        document.getElementById('contadorSeleccion').textContent = '(' + seleccionados + ' seleccionados)';
        document.getElementById('btnEliminarSeleccion').disabled = seleccionados === 0;
    }

    // Cuando se abre el modal, agregar los inputs hidden con los IDs seleccionados
    const modalEliminar = document.getElementById('modal-eliminar-masivo');
    if (modalEliminar) {
        modalEliminar.addEventListener('show.bs.modal', function() {
            const seleccionados = document.querySelectorAll('.checkbox-producto:checked');
            const form = document.getElementById('formEliminarMasivo');
            
            // Limpiar inputs hidden anteriores
            form.querySelectorAll('input[name="productos[]"]').forEach(input => input.remove());
            
            // Agregar inputs hidden para cada producto seleccionado
            seleccionados.forEach(checkbox => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'productos[]';
                input.value = checkbox.value;
                form.appendChild(input);
            });

            // Actualizar contador en el modal
            document.getElementById('modalContador').textContent = seleccionados.length;
        });
    }
</script>
@endpush