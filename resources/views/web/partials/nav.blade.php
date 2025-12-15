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
                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Acerca
                    de</a>
            </li>

            <li class="nav-item dropdown">
                @auth
                <button id="dropdownToggle" class="nav-link dropdown-toggle" style="border: none; background: none; cursor: pointer;">
                     <i class="fas fa-user"></i> {{auth()->user()->name}}
                </button>
                <ul id="dropdownMenu" class="dropdown-menu" style="display: none; position: absolute; background: white; border: 1px solid #ddd; border-radius: 4px; min-width: 200px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 1000;">
                    @if(auth()->user()->hasRole('admin'))
                    <li><a class="dropdown-item" href="{{ route('pedidos.admin') }}" style="display: block; padding: 10px 15px; color: #333; text-decoration: none;">
                            <i class="fas fa-box"></i> Todos los pedidos
                        </a></li>
                    @else
                    <li><a class="dropdown-item" href="{{ route('perfil.pedidos') }}" style="display: block; padding: 10px 15px; color: #333; text-decoration: none;">
                            <i class="fas fa-box"></i> Mis pedidos
                        </a></li>
                    @endif
                    <li>
                        <hr style="margin: 0.5rem 0;">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('perfil.edit') }}" style="display: block; padding: 10px 15px; color: #333; text-decoration: none;">
                            <i class="fas fa-cog"></i> Mi perfil
                        </a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="padding: 0;">
                            @csrf
                            <button type="submit" class="dropdown-item w-100 text-start"
                                style="border: none; background: none; padding: 10px 15px; text-align: left; cursor: pointer; display: block; width: 100%;">
                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
                @else
                <a class="nav-link" href="{{ route('login') }}" style="border: none; cursor: pointer;">
                    <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                </a>
                @endauth
            </li>
        </ul>

        <a href="{{route('carrito.mostrar')}}" class="btn-outline-dark" style="text-decoration: none;"
            style="position: relative; display: inline-block;">
            <i class="fas fa-shopping-cart"></i> Carrito
        </a>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggle = document.getElementById('dropdownToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');

        if (dropdownToggle && dropdownMenu) {
            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const isVisible = dropdownMenu.style.display !== 'none';
                dropdownMenu.style.display = isVisible ? 'none' : 'block';
            });

            // Permitir clicks en el dropdown menu sin cerrarlo
            dropdownMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            // Cerrar dropdown cuando se hace click fuera
            document.addEventListener('click', function(e) {
                if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.style.display = 'none';
                }
            });
        }
    });
</script>