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
                        <form action="{{ isset($registro)?route('productos.update', $registro->id) : route('productos.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($registro))
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="codigo" class="form-label">Código</label>
                                    <input type="text" class="form-control @error('codigo') is-invalid @enderror"
                                     id="codigo" name="codigo" value="{{old('codigo', $registro->codigo ??'')}}" required>
                                     @error('codigo')
                                        <small class="text-danger">{{$message}}</small>
                                     @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="nombre" class="form-label">nombre</label>
                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                     id="nombre" name="nombre" value="{{old('nombre',  $registro->nombre ??'')}}" required>
                                     @error('nombre')
                                        <small class="text-danger">{{$message}}</small>
                                     @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="precio" class="form-label">Precio</label>
                                    <input type="text" class="form-control @error('precio') is-invalid @enderror"
                                     id="precio" name="precio" value="{{old('precio',  $registro->precio ??'')}}" required>
                                     @error('precio')
                                        <small class="text-danger">{{$message}}</small>
                                     @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="marca" class="form-label">Marca</label>
                                    <select class="form-control @error('marca') is-invalid @enderror"
                                     id="marca" name="marca">
                                        <option value="">-- Selecciona una marca --</option>
                                        @foreach($marcas ?? [] as $marca)
                                            <option value="{{ $marca }}" {{ old('marca', $registro->marca ?? '') == $marca ? 'selected' : '' }}>
                                                {{ $marca }}
                                            </option>
                                        @endforeach
                                    </select>
                                     @error('marca')
                                        <small class="text-danger">{{$message}}</small>
                                     @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="categoria" class="form-label">Categoría</label>
                                    <select class="form-control select-categoria @error('categoria') is-invalid @enderror"
                                     id="categoria" name="categoria">
                                        <option value="">-- Selecciona una categoría --</option>
                                        <option value="Musculoesquelético" {{ old('categoria', $registro->categoria ?? '') == 'Musculoesquelético' ? 'selected' : '' }}>Musculoesquelético</option>
                                        <option value="Respiratorio" {{ old('categoria', $registro->categoria ?? '') == 'Respiratorio' ? 'selected' : '' }}>Respiratorio</option>
                                        <option value="Cardiovascular" {{ old('categoria', $registro->categoria ?? '') == 'Cardiovascular' ? 'selected' : '' }}>Cardiovascular</option>
                                        <option value="Neurológico" {{ old('categoria', $registro->categoria ?? '') == 'Neurológico' ? 'selected' : '' }}>Neurológico</option>
                                        <option value="Digestivo" {{ old('categoria', $registro->categoria ?? '') == 'Digestivo' ? 'selected' : '' }}>Digestivo</option>
                                        <option value="Renal y urinario" {{ old('categoria', $registro->categoria ?? '') == 'Renal y urinario' ? 'selected' : '' }}>Renal y urinario</option>
                                        <option value="Hematológico" {{ old('categoria', $registro->categoria ?? '') == 'Hematológico' ? 'selected' : '' }}>Hematológico</option>
                                        <option value="Endocrino y metabólico" {{ old('categoria', $registro->categoria ?? '') == 'Endocrino y metabólico' ? 'selected' : '' }}>Endocrino y metabólico</option>
                                        <option value="Inmunológico" {{ old('categoria', $registro->categoria ?? '') == 'Inmunológico' ? 'selected' : '' }}>Inmunológico</option>
                                        <option value="Infeccioso" {{ old('categoria', $registro->categoria ?? '') == 'Infeccioso' ? 'selected' : '' }}>Infeccioso</option>
                                        <option value="Materno" {{ old('categoria', $registro->categoria ?? '') == 'Materno' ? 'selected' : '' }}>Materno</option>
                                        <option value="Obstétrico" {{ old('categoria', $registro->categoria ?? '') == 'Obstétrico' ? 'selected' : '' }}>Obstétrico</option>
                                        <option value="Neonatal" {{ old('categoria', $registro->categoria ?? '') == 'Neonatal' ? 'selected' : '' }}>Neonatal</option>
                                        <option value="Pediátrico" {{ old('categoria', $registro->categoria ?? '') == 'Pediátrico' ? 'selected' : '' }}>Pediátrico</option>
                                        <option value="Sensorial" {{ old('categoria', $registro->categoria ?? '') == 'Sensorial' ? 'selected' : '' }}>Sensorial</option>
                                        <option value="Oftalmológico" {{ old('categoria', $registro->categoria ?? '') == 'Oftalmológico' ? 'selected' : '' }}>Oftalmológico</option>
                                        <option value="Otorrinolaringológico" {{ old('categoria', $registro->categoria ?? '') == 'Otorrinolaringológico' ? 'selected' : '' }}>Otorrinolaringológico</option>
                                        <option value="Odontológico" {{ old('categoria', $registro->categoria ?? '') == 'Odontológico' ? 'selected' : '' }}>Odontológico</option>
                                        <option value="Quirúrgico" {{ old('categoria', $registro->categoria ?? '') == 'Quirúrgico' ? 'selected' : '' }}>Quirúrgico</option>
                                        <option value="Anestesiología" {{ old('categoria', $registro->categoria ?? '') == 'Anestesiología' ? 'selected' : '' }}>Anestesiología</option>
                                        <option value="Diagnóstico por imágenes" {{ old('categoria', $registro->categoria ?? '') == 'Diagnóstico por imágenes' ? 'selected' : '' }}>Diagnóstico por imágenes</option>
                                        <option value="Imagenología" {{ old('categoria', $registro->categoria ?? '') == 'Imagenología' ? 'selected' : '' }}>Imagenología</option>
                                        <option value="Radiológico" {{ old('categoria', $registro->categoria ?? '') == 'Radiológico' ? 'selected' : '' }}>Radiológico</option>
                                        <option value="Medicina nuclear" {{ old('categoria', $registro->categoria ?? '') == 'Medicina nuclear' ? 'selected' : '' }}>Medicina nuclear</option>
                                        <option value="Laboratorio clínico" {{ old('categoria', $registro->categoria ?? '') == 'Laboratorio clínico' ? 'selected' : '' }}>Laboratorio clínico</option>
                                        <option value="Banco de sangre" {{ old('categoria', $registro->categoria ?? '') == 'Banco de sangre' ? 'selected' : '' }}>Banco de sangre</option>
                                        <option value="Rehabilitación" {{ old('categoria', $registro->categoria ?? '') == 'Rehabilitación' ? 'selected' : '' }}>Rehabilitación</option>
                                        <option value="Fisioterapia" {{ old('categoria', $registro->categoria ?? '') == 'Fisioterapia' ? 'selected' : '' }}>Fisioterapia</option>
                                        <option value="Enfermería" {{ old('categoria', $registro->categoria ?? '') == 'Enfermería' ? 'selected' : '' }}>Enfermería</option>
                                        <option value="Atención primaria" {{ old('categoria', $registro->categoria ?? '') == 'Atención primaria' ? 'selected' : '' }}>Atención primaria</option>
                                        <option value="Terapia intensiva" {{ old('categoria', $registro->categoria ?? '') == 'Terapia intensiva' ? 'selected' : '' }}>Terapia intensiva</option>
                                        <option value="Urgencias" {{ old('categoria', $registro->categoria ?? '') == 'Urgencias' ? 'selected' : '' }}>Urgencias</option>
                                        <option value="Hospitalización" {{ old('categoria', $registro->categoria ?? '') == 'Hospitalización' ? 'selected' : '' }}>Hospitalización</option>
                                        <option value="Esterilización" {{ old('categoria', $registro->categoria ?? '') == 'Esterilización' ? 'selected' : '' }}>Esterilización</option>
                                        <option value="Bioseguridad" {{ old('categoria', $registro->categoria ?? '') == 'Bioseguridad' ? 'selected' : '' }}>Bioseguridad</option>
                                        <option value="Vacunación" {{ old('categoria', $registro->categoria ?? '') == 'Vacunación' ? 'selected' : '' }}>Vacunación</option>
                                        <option value="Farmacéutico" {{ old('categoria', $registro->categoria ?? '') == 'Farmacéutico' ? 'selected' : '' }}>Farmacéutico</option>
                                        <option value="Dispositivos médicos" {{ old('categoria', $registro->categoria ?? '') == 'Dispositivos médicos' ? 'selected' : '' }}>Dispositivos médicos</option>
                                        <option value="Equipos biomédicos" {{ old('categoria', $registro->categoria ?? '') == 'Equipos biomédicos' ? 'selected' : '' }}>Equipos biomédicos</option>
                                    </select>
                                     @error('categoria')
                                        <small class="text-danger">{{$message}}</small>
                                     @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea name="descripcion" class="form-control" id="descripcion" 
                                    rows="4">{{ old('descripcion', $registro->descripcion ?? '') }}</textarea>
                                     @error('descripcion')
                                        <small class="text-danger">{{$message}}</small>
                                     @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="imagen" class="form-label">Imagen</label>
                                    <input type="file" class="form-control @error('imagen') is-invalid @enderror"
                                     id="imagen" name="imagen" value="{{old('imagen')}}">
                                     @error('imagen')
                                        <small class="text-danger">{{$message}}</small>
                                     @enderror
                                     @if(isset($registro) && $registro->imagen)
                                        <div class="mt-2">
                                            <img src="{{ asset('uploads/productos/' . $registro->imagen) }}" 
                                            alt="Imagen actual" style="max-width: 150px; height: auto; border-radius: 8px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-secondary me-md-2"
                                    onclick="window.location.href='{{route('productos.index')}}'">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
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
    document.getElementById('mnuAlmacen').classList.add('menu-open');
    document.getElementById('itemProducto').classList.add('active');
</script>
@endpush