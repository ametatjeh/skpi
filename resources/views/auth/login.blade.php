<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SKPI Digital UNIDA</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        :root {
            /* Palette yang lebih modern dan deep */
            --primary: #0f172a;
            /* Dark Blue/Navy for main elements */
            --primary-light: #1e293b;
            /* Slightly lighter for bg contrast */
            --accent: #3b82f6;
            /* Bright Blue for emphasis */
            --accent-hover: #2563eb;
            --white: #ffffff;
            /* Gradient yang lebih halus dan elegan */
            --gradient-bg: linear-gradient(135deg, #1e3a8a 0%, #0c4a6e 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* MEMASTIKAN TIDAK ADA SCROLL PADA DESKTOP */
        html,
        body {
            min-height: 100vh;
            font-family: 'Outfit', sans-serif;
            background: var(--gradient-bg);
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* ========================================
           NAVBAR - MINIMALIS & GLASSMORPHIC
           ======================================== */

        .navbar {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            padding: 14px 0;
            z-index: 100;
            /* Glassmorphism lebih halus */
            background: rgba(15, 23, 42, 0.25);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-inner {
            max-width: 1200px;
            margin: auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo-group {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            /* Make the logo group clickable (optional) */
        }

        .logo-img {
            height: 40px;
            /* Logo lebih kecil, lebih elegan */
        }

        .logo-title {
            font-weight: 800;
            font-size: 1.25rem;
            color: var(--white);
            letter-spacing: 0.5px;
        }

        .menu {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        /* Dropdown button - lebih flat dan elegan */

        .dropdown-toggle {
            color: var(--primary);
            background: var(--white);
            font-weight: 700;
            min-width: 175px;
            padding: 10px 24px;
            border-radius: 999px;
            border: none;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: inherit;
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .dropdown-toggle i {
            font-size: 0.85rem;
        }

        .dropdown-toggle:hover,
        .dropdown-toggle:focus {
            background: var(--accent);
            color: var(--white);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
            outline: none;
        }

        .menu-dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 120%;
            background: var(--white);
            min-width: 230px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border-radius: 12px;
            padding: 8px;
            z-index: 99;
            /* Animasi masuk */
            animation: fadeIn 0.2s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        .dropdown-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            color: var(--primary);
            font-size: 0.92rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.15s ease;
        }

        .dropdown-link i {
            width: 20px;
            text-align: center;
            color: var(--accent);
        }

        .dropdown-link:hover {
            background: var(--accent);
            color: var(--white);
        }

        .dropdown-link:hover i {
            color: var(--white);
        }

        /* Hamburger & mobile menu */

        .hamburger {
            display: none;
            font-size: 24px;
            color: var(--white);
            cursor: pointer;
        }

        .mobile-menu {
            display: none;
            flex-direction: column;
            gap: 8px;
            padding: 12px 20px 14px;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(8px);
        }

        .mobile-menu a {
            background: var(--white);
            color: var(--primary);
            padding: 10px 14px;
            text-align: left;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mobile-menu a:hover {
            background: #e5e5e5;
        }

        .mobile-menu.show {
            display: flex;
            animation: fadeDown 0.25s ease-out;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 820px) {
            .menu {
                display: none;
            }

            .hamburger {
                display: block;
            }
        }

        /* ========================================
           HERO SECTION - FULL SCREEN
           ======================================== */

        .hero {
            /* Memastikan Hero mengambil sisa tinggi layar */
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: var(--white);
            padding: 40px 20px;
            position: relative;
            min-height: calc(100vh - 160px);
        }

        /* Desktop Fit to Screen */
        @media (min-width: 900px) {
            html,
            body {
                height: 100vh;
                overflow: hidden;
            }
            .hero {
                min-height: 0;
                height: 100%;
                padding: 0 20px;
            }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.4);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 20px;
            backdrop-filter: blur(5px);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .hero-title {
            font-size: 3.5rem;
            /* Ukuran yang lebih besar */
            font-weight: 900;
            margin-bottom: 16px;
            max-width: 800px;
            line-height: 1.1;
            text-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
        }

        .hero-title span {
            background: linear-gradient(90deg, #93c5fd, #ffffff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-desc {
            font-size: 1.2rem;
            opacity: 0.95;
            max-width: 700px;
            line-height: 1.6;
            margin-bottom: 40px;
            font-weight: 400;
        }

        .hero-desc strong {
            font-weight: 700;
            color: #fff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        /* Call to Action Button */
        .cta-btn {
            background: var(--accent);
            color: var(--white);
            padding: 14px 40px;
            border-radius: 999px;
            font-size: 1.05rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            /* Box Shadow yang lebih menonjol */
            box-shadow: 0 12px 34px rgba(0, 0, 0, 0.4);
            transition: all 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            /* Smooth transition */
            border: 2px solid transparent;
            /* Untuk efek hover */
        }

        .cta-btn i {
            font-size: 1.1rem;
        }

        .cta-btn:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5);
            background: var(--accent-hover);
            border: 2px solid var(--white);
        }

        /* Small helper text under CTA */

        .hero-hint {
            margin-top: 15px;
            font-size: 0.9rem;
            opacity: 0.8;
            font-weight: 300;
        }

        /* Menghilangkan Wave untuk tampilan yang lebih clean */
        .wave {
            display: none;
        }

        @media (max-width: 900px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-desc {
                font-size: 1rem;
                max-width: 550px;
            }
        }

        @media (max-width: 700px) {
            .hero {
                padding-top: 100px;
            }

            .hero-title {
                font-size: 2.1rem;
            }

            .hero-desc {
                font-size: 0.9rem;
            }

            .cta-btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .navbar-inner {
                padding: 0 16px;
            }

            .logo-img {
                height: 36px;
            }
        }
    </style>
    @include('partials.styles')
</head>

<body>

    @include('partials.header')

    <main style="flex: 1; display: flex; flex-direction: column;">

    <section class="hero">
        <div class="hero-badge">
            <i class="fas fa-certificate"></i>
            Sistem Digital SKPI (Surat Keterangan Pendamping Ijazah)
        </div>

        <h1 class="hero-title">
            Verifikasi dan Akses <span>SKPI Digital</span> UNIDA
        </h1>

        <p class="hero-desc">
            Sistem terintegrasi untuk penerbitan dan verifikasi SKPI digital yang kredibel dan diakui secara
            internasional.
            Silakan aktifkan email Anda untuk memulai proses penerbitan.
        </p>

        <a href="{{ route('email.registration.form') }}" class="cta-btn">
            <i class="fa-solid fa-envelope-open-text"></i>
            Registrasi Email SKPI
        </a>
        <div class="hero-hint">
            Sudah terdaftar? Gunakan menu <strong>Login</strong> di kanan atas untuk masuk sesuai peran Anda.
        </div>

        </section>
    </main>

    @include('partials.footer')

    @include('partials.particles')
</body>

</html>
