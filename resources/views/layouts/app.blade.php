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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}?v=2">

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

<body style="position: relative; min-height: 100vh; display: flex; flex-direction: column; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); font-family: 'Poppins', sans-serif; overflow-x: hidden;">
    <!-- Particles container -->
    <div id="particles-js" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: -2;"></div>
    <!-- Decorative blobs for glassmorphism effect -->
    <div style="position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: #3b82f6; border-radius: 50%; filter: blur(120px); opacity: 0.4; z-index: -1;"></div>
    <div style="position: absolute; bottom: -150px; right: -50px; width: 500px; height: 500px; background: #8b5cf6; border-radius: 50%; filter: blur(150px); opacity: 0.3; z-index: -1;"></div>

    <div id="app" style="position: relative; z-index: 10; display: flex; flex-direction: column; min-height: 100vh;">
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

        <main class="py-4" style="flex: 1;">
            @yield('content')
        </main>

        <!-- FOOTER INFO -->
        <footer style="background: #0050a0; padding: 15px 0; border-top: none; margin-top: auto;">
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="{{ asset('images/logo_unida-removebg-preview.png') }}" alt="SKPI Logo" style="height: 40px;">
                    <div>
                        <div style="font-weight: 800; font-size: 1.35rem; color: #ffffff; line-height: 1.1; font-family: 'Poppins', sans-serif;">UNIDA ACEH</div>
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

    <!-- Particles JS -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        if(document.getElementById('particles-js')) {
            particlesJS("particles-js", {
                "particles": {
                    "number": {"value": 80,"density": {"enable": true,"value_area": 800}},
                    "color": {"value": "#ffffff"},
                    "shape": {"type": "circle","stroke": {"width": 0,"color": "#000000"},"polygon": {"nb_sides": 5},"image": {"src": "img/github.svg","width": 100,"height": 100}},
                    "opacity": {"value": 0.5,"random": false,"anim": {"enable": false,"speed": 1,"opacity_min": 0.1,"sync": false}},
                    "size": {"value": 3,"random": true,"anim": {"enable": false,"speed": 40,"size_min": 0.1,"sync": false}},
                    "line_linked": {"enable": true,"distance": 150,"color": "#ffffff","opacity": 0.4,"width": 1},
                    "move": {"enable": true,"speed": 1,"direction": "none","random": false,"straight": false,"out_mode": "out","bounce": false,"attract": {"enable": true,"rotateX": 600,"rotateY": 1200}}
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {"enable": true,"mode": "repulse"},
                        "onclick": {"enable": true,"mode": "push"},
                        "resize": true
                    },
                    "modes": {
                        "grab": {"distance": 400,"line_linked": {"opacity": 1}},
                        "bubble": {"distance": 400,"size": 40,"duration": 2,"opacity": 8,"speed": 3},
                        "repulse": {"distance": 200,"duration": 0.4},
                        "push": {"particles_nb": 4},
                        "remove": {"particles_nb": 2}
                    }
                },
                "retina_detect": true
            });
        }
    </script>
</body>

</html>
