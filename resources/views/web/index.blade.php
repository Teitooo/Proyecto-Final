@extends('web.app')

@section('titulo', 'Productos - Medical Supplies')

@section('contenido')
<!-- Search and Filter Section -->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5">
        <form method="GET" action="{{route('home')}}" class="mb-4">
            <div class="row g-3">
                <!-- Search Box -->
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control form-control-lg" id="searchInput" 
                               placeholder="Buscar productos..." name="search" 
                               value="{{request('search')}}">
                        <button class="btn btn-primary" type="submit" id="searchButton">
                            Buscar
                        </button>
                    </div>
                </div>

                <!-- Sort Dropdown -->
                <div class="col-md-4">
                    <div class="input-group">
                        <label class="input-group-text">Ordenar:</label>
                        <select class="form-select" id="sortSelect" name="sort" onchange="this.form.submit()">
                            <option value="">-- Seleccionar --</option>
                            <option value="priceAsc" {{ request('sort') == 'priceAsc' ? 'selected' : '' }}>
                                Precio: menor a mayor
                            </option>
                            <option value="priceDesc" {{ request('sort') == 'priceDesc' ? 'selected' : '' }}>
                                Precio: mayor a menor
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Products Section -->
<section class="py-5">
    <div class="container px-4 px-lg-5">
        @if($productos->count() > 0)
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                @foreach($productos as $producto)
                    <div class="col mb-5">
                        <div class="card h-100 shadow-sm border-0">
                            <!-- Product Image -->
                            <div class="position-relative overflow-hidden bg-light" style="height: 250px;">
                                <img class="card-img-top w-100 h-100" 
                                     src="{{asset('uploads/productos/'. $producto->imagen) }}"
                                     alt="{{$producto->nombre}}"
                                     style="object-fit: cover;">
                            </div>

                            <!-- Product Details -->
                            <div class="card-body text-center p-4">
                                <h5 class="card-title fw-bold mb-2">{{$producto->nombre}}</h5>
                                <p class="card-text text-muted small mb-3">{{Str::limit($producto->descripcion ?? '', 50)}}</p>
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <span class="h4 fw-bold text-primary mb-0">
                                        ${{ number_format($producto->precio, 2) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Product Actions -->
                            <div class="card-footer bg-white border-top p-4 pt-0">
                                <div class="d-grid gap-2">
                                    <a class="btn btn-outline-primary btn-sm" 
                                       href="{{route('web.show', $producto->id)}}">
                                        <i class="bi bi-eye"></i> Ver Producto
                                    </a>
                                    <button class="btn btn-primary btn-sm" 
                                            onclick="addToCartAjax({{$producto->id}}, event)">
                                        <i class="bi bi-cart-plus"></i> Agregar al Carrito
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $productos->appends(['search' => request('search'), 'sort' => request('sort')])->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <h3 class="mt-3 text-muted">No se encontraron productos</h3>
                <p class="text-muted">Intenta con otra búsqueda o categoría</p>
                <a href="{{route('home')}}" class="btn btn-primary mt-3">
                    <i class="bi bi-arrow-left"></i> Volver al inicio
                </a>
            </div>
        @endif
    </div>
</section>
@endsection

