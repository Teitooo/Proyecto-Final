@extends('plantilla.app')
@section('contenido')
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            @if($inventario->id ?? false)
                                Editar Inventario
                            @else
                                Crear Inventario
                            @endif
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    @if($inventario->id ?? false)
                        <form action="{{route('inventarios.update', $inventario->id)}}" method="post">
                        @method('PUT')
                    @else
                        <form action="{{route('inventarios.store')}}" method="post">
                    @endif
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="producto_id">Producto <span class="text-danger">*</span></label>
                                <select class="form-control @error('producto_id') is-invalid @enderror" id="producto_id" name="producto_id" required>
                                    <option value="">-- Seleccione un producto --</option>
                                    @foreach($productos as $prod)
                                        <option value="{{$prod->id}}" @if(old('producto_id') == $prod->id || ($inventario->id ?? false) && $inventario->producto_id == $prod->id) selected @endif>
                                            {{$prod->codigo}} - {{$prod->nombre}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('producto_id')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cantidad_disponible">Cantidad Disponible <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('cantidad_disponible') is-invalid @enderror" 
                                       id="cantidad_disponible" name="cantidad_disponible" 
                                       value="{{ old('cantidad_disponible') ?? $inventario->cantidad_disponible ?? 0 }}" 
                                       required min="0">
                                @error('cantidad_disponible')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="cantidad_minima">Cantidad Mínima <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('cantidad_minima') is-invalid @enderror" 
                                       id="cantidad_minima" name="cantidad_minima" 
                                       value="{{ old('cantidad_minima') ?? $inventario->cantidad_minima ?? 0 }}" 
                                       required min="0">
                                @error('cantidad_minima')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ubicacion">Ubicación</label>
                                <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" 
                                       id="ubicacion" name="ubicacion" 
                                       value="{{ old('ubicacion') ?? $inventario->ubicacion ?? '' }}" 
                                       placeholder="Ej: Almacén A, Estante 5">
                                @error('ubicacion')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="estado_activo" name="estado" value="activo" 
                                           @if(old('estado') == 'activo' || ($inventario->id ?? false) && $inventario->estado == 'activo' || !($inventario->id ?? false)) checked @endif>
                                    <label class="form-check-label" for="estado_activo">Activo</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="estado_inactivo" name="estado" value="inactivo" 
                                           @if(old('estado') == 'inactivo' || ($inventario->id ?? false) && $inventario->estado == 'inactivo') checked @endif>
                                    <label class="form-check-label" for="estado_inactivo">Inactivo</label>
                                </div>
                                @error('estado')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{route('inventarios.index')}}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
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
