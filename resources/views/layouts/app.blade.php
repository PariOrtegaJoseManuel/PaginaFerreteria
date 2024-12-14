<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Ferretería El Esmeril" style="height: 40px;"> Ferretería "El Esmeril"
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @can('categorias.index')
                        <li class="nav-item">
                            <a href="{{route("categorias.index")}}" class="nav-link">Categorias</a>
                        </li>
                        @endcan
                        @can('unidades.index')
                        <li class="nav-item">
                            <a href="{{route("unidades.index")}}" class="nav-link">Unidades</a>
                        </li>
                        @endcan
                        @can('articulos.index')
                        <li class="nav-item">
                            <a href="{{route("articulos.index")}}" class="nav-link">Articulos</a>
                        </li>
                        @endcan
                        @can('ventas.index')
                        <li class="nav-item">
                            <a href="{{route("ventas.index")}}" class="nav-link">Ventas</a>
                        </li>
                        @endcan
                        @can('clientes.index')
                        <li class="nav-item">
                            <a href="{{route("clientes.index")}}" class="nav-link">Clientes</a>
                        </li>
                        @endcan
                        @can('users.index')
                        <li class="nav-item">
                            <a href="{{route("users.index")}}" class="nav-link">Usuarios</a>
                        </li>
                        @endcan
                        @can('users.index')
                        <li class="nav-item">
                            <a href="{{route("detalles.index")}}" class="nav-link">Detalles</a>
                        </li>
                        @endcan
                        @can('roles.index')
                        <li class="nav-item">
                            <a href="{{route("roles.index")}}" class="nav-link">Roles</a>
                        </li>
                        @endcan
                        @can('users.index')
                        <li class="nav-item">
                            <a href="{{route("entregas.index")}}" class="nav-link">Entregas</a>
                        </li>
                        @endcan
                        @can('encargos.index')
                        <li class="nav-item">
                            <a href="{{route("encargos.index")}}" class="nav-link">Encargos</a>
                        </li>
                        @endcan
                        @can('metodo_pagos.index')
                        <li class="nav-item">
                            <a href="{{route("metodo_pagos.index")}}" class="nav-link">Metodo de Pagos</a>
                        </li>
                        @endcan
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        <li class="nav-item d-flex align-items-center">
                            <div class="form-check form-switch ms-3">
                                <input class="form-check-input" type="checkbox" id="theme-toggle" role="switch">
                                <label class="form-check-label" for="theme-toggle">
                                    <i class="fas fa-moon" id="theme-icon"></i>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggle = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');

        // Cargar tema guardado
        const currentTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', currentTheme);

        // Establecer estado inicial del switch
        if (currentTheme === 'dark') {
            themeToggle.checked = true;
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        }

        // Escuchar cambios en el switch
        themeToggle.addEventListener('change', () => {
            const newTheme = themeToggle.checked ? 'dark' : 'light';

            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            if (newTheme === 'dark') {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        });
    });
    </script>
</body>
</html>
