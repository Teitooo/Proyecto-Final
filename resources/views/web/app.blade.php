<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="title" content="Medical Supplies" />
    <meta name="author" content="Medical Supplies" />
    <meta name="description" content="Equipos médicos de alta calidad"/>
    <meta name="keywords" content="Medical, Supplies, Equipos Médicos"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('titulo', 'Inicio - Medical Supplies')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.png') }}" />
    
    <!-- Bootstrap 5 CSS - IMPORTANTE -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUarbnLVrZ3PtaPvzLewajvsF+Yp2a8bTKolRJejhZfD7EM6HOf" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    
    <!-- Custom Styles -->
    <link href="{{ asset('css/home-styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/item-styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/carrito-styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/confirmacion-styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/checkout-styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/mis-pedidos-styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/footer-styles.css') }}" rel="stylesheet" />
    
    @stack('estilos')
</head>
<body>
    <!-- Navigation-->
    @include('web.partials.nav')
    
    <!-- Header Section (opcional) -->
    @if(View::hasSection('header'))
        @include('web.partials.header')
    @endif
    
    <!-- Main Content -->
    @yield('contenido')
    
    <!-- Footer-->
    @include('web.partials.footer')
    
    <!-- Bootstrap Bundle JS - IMPORTANTE (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWbSxccPQtF3EpF3fnJHog6LaEVF6141f0VCu23KPvhnOM2Cx" crossorigin="anonymous"></script>
    
    <!-- Main App JS -->
    <script src="{{ asset('js/main-app.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
