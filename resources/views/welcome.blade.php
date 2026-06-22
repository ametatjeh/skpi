<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    
    {{-- SEO Meta Tags --}}
    <title>SKPI UNIDA - Sistem Surat Keterangan Pendamping Ijazah | Universitas Iskandar Muda</title>
    <meta name="description" content="Sistem Informasi SKPI (Surat Keterangan Pendamping Ijazah) Universitas Iskandar Muda. Kelola prestasi, sertifikasi, dan dokumen akademik mahasiswa secara digital.">
    <meta name="keywords" content="SKPI, UNIDA, Universitas Iskandar Muda, Surat Keterangan Pendamping Ijazah, Diploma Supplement, Prestasi Mahasiswa, Sertifikasi Kompetensi, Sistem Akademik">
    <meta name="author" content="Universitas Iskandar Muda">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <meta name="revisit-after" content="7 days">
    <link rel="canonical" href="{{ url('/') }}">
    
    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="SKPI UNIDA - Sistem Surat Keterangan Pendamping Ijazah">
    <meta property="og:description" content="Sistem Informasi SKPI Universitas Iskandar Muda. Kelola prestasi, sertifikasi, dan dokumen akademik mahasiswa secara digital.">
    <meta property="og:image" content="{{ asset('images/skpi_logo.png') }}">
    <meta property="og:site_name" content="SKPI UNIDA">
    <meta property="og:locale" content="id_ID">
    
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url('/') }}">
    <meta name="twitter:title" content="SKPI UNIDA - Sistem Surat Keterangan Pendamping Ijazah">
    <meta name="twitter:description" content="Sistem Informasi SKPI Universitas Iskandar Muda. Kelola prestasi, sertifikasi, dan dokumen akademik mahasiswa.">
    <meta name="twitter:image" content="{{ asset('images/skpi_logo.png') }}">
    
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/skpi_logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/skpi_logo.png') }}">

    {{-- Structured Data / JSON-LD --}}
    @verbatim
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "Universitas Iskandar Muda",
        "alternateName": "UNIDA",
        "url": "https://skpi.unida-aceh.ac.id",
        "logo": "/images/skpi_logo.png",
        "description": "Sistem Informasi SKPI (Surat Keterangan Pendamping Ijazah) untuk mengelola prestasi dan sertifikasi mahasiswa.",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Parepare",
            "addressRegion": "Sulawesi Selatan",
            "addressCountry": "ID"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "customer service",
            "availableLanguage": "Indonesian"
        }
    }
    </script>
    @endverbatim

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #f5f5f5;
            color: #111827;
        }

        a {
            text-decoration: none;
        }

        /* ======= TOP SOCIAL BAR ======= */
        .top-social {
            background: #0d47a1;
            color: #fff;
            font-size: 13px;
            padding: 6px 0;
        }

        .top-social-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: flex-end;
            gap: 14px;
        }

        .top-social-inner a {
            color: #fff;
            transition: color .2s;
        }

        .top-social-inner a:hover {
            color: #bbdefb;
        }

        /* ======= HEADER INFO BAR ======= */
        .header-info {
            background: #fff;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .header-info-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo-box {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-box i {
            font-size: 2.4rem;
            color: #0d47a1;
        }

        .logo-text-main {
            font-weight: 800;
            font-size: 1.35rem;
            color: #0d47a1;
            line-height: 1.1;
        }

        .logo-text-sub {
            font-size: 0.8rem;
            color: #555;
        }

        .info-columns {
            display: flex;
            gap: 28px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.8rem;
            color: #555;
        }

        .info-item i {
            font-size: 1.1rem;
            color: #0d47a1;
        }

        .info-item strong {
            display: block;
            font-size: 0.8rem;
            color: #111;
        }

        /* ======= NAVBAR BLUE ======= */
        .nav-bar {
            background: #0050a0;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 52px;
        }

        .nav-brand {
            color: #fff;
            font-weight: 700;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .nav-brand img {
            height: 45px;
        }

        .nav-menu {
            display: flex;
            gap: 0;
            list-style: none;
        }

        .nav-menu>li {
            position: relative;
        }

        .nav-menu>li>a,
        .nav-menu>li>span {
            display: block;
            padding: 12px 18px;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .nav-menu>li:hover {
            background: #003f7a;
        }

        .nav-menu li .dropdown {
            position: absolute;
            left: 0;
            top: 100%;
            background: #fff;
            color: #333;
            min-width: 200px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .18);
            display: none;
            z-index: 60;
        }

        .nav-menu li:hover .dropdown {
            display: block;
        }

        .dropdown a {
            display: block;
            padding: 10px 16px;
            font-size: 13px;
            color: #333;
        }

        .dropdown a:hover {
            background: #f5f5f5;
            color: #0d47a1;
        }

        /* ========= HAMBURGER & MOBILE NAV ========= */
        .hamburger {
            display: none;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
        }

        .mobile-nav-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.55);
            display: none;
            z-index: 70;
        }

        .mobile-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: #0050a0;
            transform: translateY(-100%);
            transition: transform .25s ease-out;
            z-index: 80;
        }

        .mobile-nav-header {
            padding: 10px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #fff;
        }

        .mobile-nav-links a {
            display: block;
            padding: 12px 18px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            border-top: 1px solid rgba(255, 255, 255, 0.18);
        }

        .mobile-dropdown-btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            background: none;
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.18);
            padding: 12px 18px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            text-align: left;
            font-family: inherit;
            cursor: pointer;
        }

        .mobile-dropdown-content {
            display: none;
            background: rgba(0, 0, 0, 0.1);
        }

        .mobile-dropdown-content.show {
            display: block;
        }

        .mobile-dropdown-content a {
            padding-left: 36px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-weight: 400;
        }

        .mobile-nav.open {
            transform: translateY(0);
        }

        .mobile-nav-backdrop.show {
            display: block;
        }

        /* ======= HERO ======= */
        .hero {
            position: relative;
            min-height: calc(100vh - 56px);
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            overflow: hidden;
        }

        .hero-inner {
            max-width: 1200px;
            width: 100%;
            padding: 40px 20px 40px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(0, 0.9fr);
            gap: 32px;
            align-items: center;
        }

        .hero-text {
            max-width: 640px;
        }

        .hero-sub {
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .hero-title {
            font-size: 3.4rem;
            font-weight: 900;
            line-height: 1.1;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .hero-btn {
            display: inline-block;
            margin-top: 5px;
            padding: 10px 26px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: #0050a0;
            color: #fff;
            border-radius: 2px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .35);
            transition: .2s;
        }

        .hero-btn:hover {
            background: #0d47a1;
            transform: translateY(-2px);
        }

        /* ======= CARDS DI SAMPING KANAN ======= */
        .hero-cards-col {
            display: flex;
            justify-content: flex-start;
            /* cards nempel kiri area kanan */
        }

        .cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            max-width: 320px;
        }

        .card {
            background: rgba(2, 6, 23, 0.92);
            color: #fff;
            padding: 14px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 12px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #0050a0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .card-icon i {
            font-size: 18px;
        }

        .card-text h4 {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .card-text span {
            font-size: 11px;
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 1024px) {
            .info-columns {
                display: none;
            }

            .nav-inner {
                padding: 0 16px;
            }

            .nav-menu {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .hero-inner {
                grid-template-columns: minmax(0, 1fr);
                padding: 32px 16px 40px;
            }

            .hero-cards-col {
                justify-content: flex-start;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.4rem;
            }

            .hero-inner {
                padding: 28px 16px 36px;
            }

            .cards {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR BLUE -->
    <nav class="nav-bar">
        <div class="nav-inner">
            <div class="nav-brand">
                <i class="fas fa-graduation-cap" style="font-size: 28px; color: #fff;"></i>
                <span>SKPI UNIDA</span>
            </div>

            <!-- MENU DESKTOP -->
            <ul class="nav-menu">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('skema') }}">Skema</a></li>
                <!-- <li><a href="#about">About us</a></li> -->
                <li><a href="http://127.0.0.1:8000/register-email">Registrasi</a></li>
                <li>
                    <span>
                        Login
                        <i class="fa-solid fa-chevron-down" style="font-size:10px;margin-left:4px;"></i>
                    </span>
                    <div class="dropdown">
                        <a href="{{ route('mahasiswa.login') }}">Mahasiswa</a>
                        <a href="{{ route('prodi.login') }}">Prodi</a>
                        <a href="{{ route('pusat.login') }}">Pusat Bahasa</a>
                        <a href="{{ route('fakultas.login') }}">Fakultas</a>
                        <a href="{{ route('admin.login') }}">Admin</a>
                    </div>
                </li>
                <!-- <li><a href="#contact">Contact us</a></li> -->
            </ul>

            <!-- HAMBURGER BUTTON (MOBILE) -->
            <div class="hamburger" id="navToggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </nav>

    <!-- MOBILE NAV OVERLAY -->
    <div class="mobile-nav-backdrop" id="mobileBackdrop"></div>
    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-header">
            <span>Menu</span>
            <button id="mobileClose" style="background:none;border:none;color:#fff;font-size:20px;cursor:pointer;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mobile-nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('skema') }}">Skema</a>
            <a href="http://127.0.0.1:8000/register-email">Registrasi</a>
            <button class="mobile-dropdown-btn" id="mobileLoginBtn">
                Login <i class="fas fa-chevron-down"></i>
            </button>
            <div class="mobile-dropdown-content" id="mobileLoginContent">
                <a href="{{ route('mahasiswa.login') }}">Mahasiswa</a>
                <a href="{{ route('prodi.login') }}">Prodi</a>
                <a href="{{ route('pusat.login') }}">Pusat Bahasa</a>
                <a href="{{ route('fakultas.login') }}">Fakultas</a>
                <a href="{{ route('admin.login') }}">Admin</a>
            </div>
        </div>
    </div>

    <!-- HERO + CARDS KANAN -->
    <section class="hero">
        <!-- Particles container -->
        <div id="particles-js" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 1;"></div>
        <!-- Decorative blobs for glassmorphism effect -->
        <div style="position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: #3b82f6; border-radius: 50%; filter: blur(120px); opacity: 0.4; z-index: 0;"></div>
        <div style="position: absolute; bottom: -150px; right: -50px; width: 500px; height: 500px; background: #8b5cf6; border-radius: 50%; filter: blur(150px); opacity: 0.3; z-index: 0;"></div>
        
        <div class="hero-inner" style="position: relative; z-index: 10;">
            <div class="hero-text">
                <div class="hero-sub">Belum Registrasi Email Untuk Login?</div>
                <h1 class="hero-title">Activasi Email Untuk Login<br>SKPI Unida</h1>
                <a href="{{ route('email.registration.form') }}" class="hero-btn">
                    Registrasi Email
                </a>
            </div>
            {{-- 
            <div class="hero-cards-col">
                <div class="cards">
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="card-text">
                            <h4>Standar DIKTI</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-plane"></i>
                        </div>
                        <div class="card-text">
                            <h4>International</h4>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-icon">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <div class="card-text">
                            <h4>Cloud Base</h4>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    <!-- FOOTER INFO -->
    <footer style="background: #0050a0; padding: 30px 0; border-top: none;">
        <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div class="logo-box">
                <img src="{{ asset('images/skpi_logo.png') }}" alt="SKPI Logo" style="height: 45px; filter: brightness(0) invert(1);">
                <div>
                    <div class="logo-text-main" style="color: #ffffff;">UNIDA Aceh</div>
                    <div class="logo-text-sub" style="color: #e2e8f0;">SKPI UNIDA Digital Certificate System</div>
                </div>
            </div>

            <div style="display: flex; flex-wrap: wrap; gap: 28px;">
                <div class="info-item" style="color: #e2e8f0;">
                    <i class="fas fa-phone" style="color: #ffffff;"></i>
                    <div>
                        <strong style="color: #ffffff;">CALL US</strong>
                        +62 123 456 789
                    </div>
                </div>
                <div class="info-item" style="color: #e2e8f0;">
                    <i class="fas fa-envelope" style="color: #ffffff;"></i>
                    <div>
                        <strong style="color: #ffffff;">EMAIL US</strong>
                        skpi@unida-aceh.ac.id
                    </div>
                </div>
                <div class="info-item" style="color: #e2e8f0;">
                    <i class="fas fa-location-dot" style="color: #ffffff;"></i>
                    <div>
                        <strong style="color: #ffffff;">LOCATE US</strong>
                        Kampus UNIDA, Indonesia
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const navToggle = document.getElementById('navToggle');
        const mobileNav = document.getElementById('mobileNav');
        const mobileClose = document.getElementById('mobileClose');
        const backdrop = document.getElementById('mobileBackdrop');

        function openMobileNav() {
            mobileNav.classList.add('open');
            backdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileNav() {
            mobileNav.classList.remove('open');
            backdrop.classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        if (navToggle) navToggle.addEventListener('click', openMobileNav);
        if (mobileClose) mobileClose.addEventListener('click', closeMobileNav);
        if (backdrop) backdrop.addEventListener('click', closeMobileNav);

        const mobileLoginBtn = document.getElementById('mobileLoginBtn');
        const mobileLoginContent = document.getElementById('mobileLoginContent');
        if (mobileLoginBtn && mobileLoginContent) {
            mobileLoginBtn.addEventListener('click', function(e) {
                e.preventDefault();
                mobileLoginContent.classList.toggle('show');
                const icon = this.querySelector('i');
                if (mobileLoginContent.classList.contains('show')) {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                } else {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });
        }
    </script>

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
