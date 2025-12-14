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
                <button id="dropdownToggle" class="nav-link dropdown-toggle" style="border: none; background: none; cursor: pointer;">
                    <i class="fas fa-user"></i> Admin
                </button>
                <ul id="dropdownMenu" class="dropdown-menu" style="display: none;">
                    <li><a class="dropdown-item" href="http://127.0.0.1:8000/perfil/pedidos">
                            <i class="fas fa-box"></i> Mis pedidos
                        </a></li>
                    <li>
                        <hr style="margin: 0.5rem 0;">
                    </li>
                    <li><a class="dropdown-item" href="http://127.0.0.1:8000/perfil">
                            <i class="fas fa-cog"></i> Mi perfil
                        </a></li>
                    <li>
                        <form action="http://127.0.0.1:8000/logout" method="POST" style="padding: 0;">
                            <input type="hidden" name="_token" value="kpoKa8AqTuJ64hZvnyhQCWVH5jNgU2EbNHlXwzSd"
                                autocomplete="off"> <button type="submit" class="dropdown-item w-100 text-start"
                                style="border: none; background: none;">
                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

        <a href="{{route('carrito.mostrar')}}" class="btn-outline-dark"
            style="position: relative; display: inline-block;">
            <i class="fas fa-shopping-cart"></i> Carrito
            <span id="cartBadge" class="badge">
                {{ session('carrito') ? array_sum(array_column(session('carrito'), 'cantidad')) : 0 }}
            </span>
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
                const isVisible = dropdownMenu.style.display !== 'none';
                dropdownMenu.style.display = isVisible ? 'none' : 'block';
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