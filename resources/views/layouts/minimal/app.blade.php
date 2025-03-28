<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Añade esto -->
    <!-- Metaetiquetas dinámicas -->
    @yield('meta_social')
    @yield('meta')
    <link rel="icon" href="{{ asset('img/logo.svg') }}" type="image/x-icon">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @yield('css')
    @yield('schema')
    @yield('google')
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row mb-3">
            <x-minimal.navbar :cartItems="$cartItems" />
        </div>
    </div>

    <nav>
        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('cart.view') }}">Carrito</a>
        @auth
            <form action="{{-- {{ route('logout') }} --}}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        @else
            <a href="{{-- {{ route('login') }} --}}">Iniciar sesión</a>
            <a href="{{-- {{ route('register') }} --}}">Registrarse</a>
        @endauth
    </nav>

    <div class="container shadow-lg p-3 bg-body rounded-4 pb-5 my-4">
        @yield('content')
    </div>

    <x-minimal.footer />
    <x-minimal.footerSticky :cartItems="$cartItems" />

    @yield('js')

    @if (session('success'))
        <script>
            window.Laravel = @json(['success' => session('success')]);
        </script>
    @endif
    @if (session('error'))
        <script>
            window.Laravel = @json(['error' => session('error')]);
        </script>
    @endif

</body>
</html>