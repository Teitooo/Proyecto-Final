<nav>
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="fas fa-hospital"></i> Medical Supplies
        </a>
        
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" 
                   href="{{ route('home') }}">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('catalog') ? 'active' : '' }}" 
                   href="{{ route('catalog') }}">Catálogo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" 
                   href="{{ route('about') }}">Acerca de</a>
            </li>
            
            <li class="nav-item dropdown">
                @auth
                    <button class="nav-link dropdown-toggle" style="border: none; background: none; cursor: pointer;">
                        <i class="fas fa-user"></i> {{auth()->user()->name}}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('perfil.pedidos')}}">
                            <i class="fas fa-box"></i> Mis pedidos
                        </a></li>
                        <li><hr style="margin: 0.5rem 0;"></li>
                        <li><a class="dropdown-item" href="{{route('perfil.edit')}}">
                            <i class="fas fa-cog"></i> Mi perfil
                        </a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="padding: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item w-100 text-start" style="border: none; background: none;">
                                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                @else
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                    </a>
                @endauth
            </li>
        </ul>

        <a href="{{route('carrito.mostrar')}}" class="btn-outline-dark" style="position: relative; display: inline-block;">
            <i class="fas fa-shopping-cart"></i> Carrito
            <span id="cartBadge" class="badge">
                {{ session('carrito') ? array_sum(array_column(session('carrito'), 'cantidad')) : 0 }}
            </span>
        </a>
    </div>
</nav>