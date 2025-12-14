<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('home') }}">Medical Supplies</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
<<<<<<< HEAD
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Inicio</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('catalog') ? 'active' : '' }}" href="{{ route('catalog') }}">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Acerca de</a></li>
=======
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Sobre Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tienda</a></li>
>>>>>>> 00fdd652baaea189ca4008f8eda782f8447020a3
                
                <li class="nav-item dropdown">
                    @auth
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">{{auth()->user()->name}}</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('perfil.pedidos')}}">Mis pedidos</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="{{route('perfil.edit')}}">Mi perfil</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    @endauth
                </li>

            </ul>
            <a href="{{route('carrito.mostrar')}}" class="btn btn-outline-dark">
                <i class="bi-cart-fill me-1"></i>
                Pedido
                <span class="badge bg-dark text-white ms-1 rounded-pill">
                {{ session('carrito') ? array_sum(array_column(session('carrito'), 'cantidad')) : 0 }}
                </span>
            </a>
        </div>
    </div>
</nav>