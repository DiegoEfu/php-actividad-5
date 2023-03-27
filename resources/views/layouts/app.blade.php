<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Químicos del Zulia</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <style>
        body{
            background: rgb(255,255,255);
            background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(84,57,148,1) 0%, rgba(28,125,203,1) 47%, rgba(93,175,166,1) 100%);
        }

        canvas{
            background: white;
            border-radius: 15px;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Químicos del Zulia
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if(auth()->user()->cargo == 'ALMACENISTA')
                            <li class="nav-item"><a class="nav-link" href="{{route('produccions.index')}}">Producción</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('insumos.index')}}">Insumos</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('productos.index')}}">Productos</a></li>
                        @endif

                        @if(auth()->user()->cargo == 'GESTOR DE COMPRAS')
                            <li class="nav-item"><a class="nav-link" href="{{route('proveedoras.index')}}">Proveedoras</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('compras.index')}}">Compras</a></li>
                        @endif

                        @if(auth()->user()->cargo == 'ADMIN')
                            <li class="nav-item"><a class="nav-link" href="{{route('produccions.index')}}">Producción</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('insumos.index')}}">Insumos</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('productos.index')}}">Productos</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('proveedoras.index')}}">Proveedoras</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('compras.index')}}">Compras</a></li>
                        @endif
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
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        {{ __('Cerrar Sesión') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
