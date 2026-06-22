<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="SKPI UNIDA - Sistem Surat Keterangan Pendamping Ijazah Universitas Iskandar Muda">
    <meta name="author" content="Universitas Iskandar Muda">

    <title>{{ config('app.name', 'SKPI UNIDA') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/skpi_logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/skpi_logo.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Ikon (Tambahkan Font Awesome agar ikon di Login berfungsi) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Scripts (Ini akan memuat resources/css/app.css) -->
    <!-- Custom CSS (Manual) -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}} 
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">








</head>

<body>
    <div id="app">
        <!-- Navigasi Dihapus sesuai permintaan user -->
        <!--
        <nav class="main-nav">
            <div class="container-nav">
                <a class="nav-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                
                <div class="nav-menu">
                    <ul class="nav-list">
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
                                                                                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                                                                                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                    </ul>
                </div>
            </div>
        </nav>
        -->

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
