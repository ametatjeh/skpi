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

        <!-- FOOTER INFO -->
        <footer style="background: #0050a0; padding: 30px 0; border-top: none; margin-top: auto;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="{{ asset('images/skpi_logo.png') }}" alt="SKPI Logo" style="height: 45px; filter: brightness(0) invert(1);">
                    <div>
                        <div style="font-weight: 800; font-size: 1.35rem; color: #ffffff; line-height: 1.1; font-family: 'Poppins', sans-serif;">UNIDA Aceh</div>
                        <div style="font-size: 0.8rem; color: #e2e8f0; font-family: 'Poppins', sans-serif;">SKPI UNIDA Digital Certificate System</div>
                    </div>
                </div>

                <div style="display: flex; flex-wrap: wrap; gap: 28px; font-family: 'Poppins', sans-serif;">
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 0.8rem; color: #e2e8f0;">
                        <i class="fas fa-phone" style="font-size: 1.1rem; color: #ffffff;"></i>
                        <div>
                            <strong style="display: block; font-size: 0.8rem; color: #ffffff;">CALL US</strong>
                            +62 123 456 789
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 0.8rem; color: #e2e8f0;">
                        <i class="fas fa-envelope" style="font-size: 1.1rem; color: #ffffff;"></i>
                        <div>
                            <strong style="display: block; font-size: 0.8rem; color: #ffffff;">EMAIL US</strong>
                            skpi@unida-aceh.ac.id
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-size: 0.8rem; color: #e2e8f0;">
                        <i class="fas fa-location-dot" style="font-size: 1.1rem; color: #ffffff;"></i>
                        <div>
                            <strong style="display: block; font-size: 0.8rem; color: #ffffff;">LOCATE US</strong>
                            Kampus UNIDA, Indonesia
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
