<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SKPI UNIDA</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            color: #fff;
            position: relative;
            overflow-x: hidden;
        }

        .login-wrapper {
            width: 100%;
            max-width: 480px;
            min-height: clamp(380px, 60vh, 520px);
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            box-shadow: 0 18px 55px rgba(0, 0, 0, 0.45);
            overflow: hidden;
        }

        /* LEFT: FORM */
        .form-side {
            padding: clamp(20px, 4vh, 40px) clamp(20px, 4vw, 46px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: transparent;
            color: #f8fafc;
        }

        .login-header {
            margin-bottom: 22px;
        }

        .login-header h2 {
            font-size: clamp(1.2rem, 4vh, 1.6rem);
            font-weight: 800;
            color: #60a5fa;
            margin-bottom: clamp(2px, 1vh, 4px);
            display: flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .login-header h2 i {
            color: #60a5fa;
        }

        .login-header p {
            color: #cbd5e1;
            font-size: .95rem;
        }

        .alert-danger {
            background: #fee2e2;
            color: #b91c1c;
            border-radius: 6px;
            padding: 10px 14px;
            font-size: .85rem;
            margin-bottom: 16px;
        }

        .alert-danger ul {
            margin-left: 18px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: .9rem;
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            font-size: .95rem;
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
            transition: border-color .18s, box-shadow .18s, background .18s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #60a5fa;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.25);
        }

        .btn {
            width: 100%;
            padding: 11px 0;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: .95rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 6px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .2);
            transition: .2s;
        }

        .btn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .3);
        }

        .form-footer {
            margin-top: 18px;
            font-size: .9rem;
            text-align: left;
        }

        .form-footer a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* RIGHT: PANEL */
        .image-side {
            background: linear-gradient(135deg, rgba(0, 80, 160, .9), rgba(13, 71, 161, .9));
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 38px;
            position: relative;
            overflow: hidden;
            color: #fff;
        }

        .image-side::before {
            content: '';
            position: absolute;
            width: 260px;
            height: 260px;
            background: rgba(255, 255, 255, .08);
            border-radius: 50%;
            top: -80px;
            right: -80px;
        }

        .image-side::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, .06);
            border-radius: 50%;
            bottom: -60px;
            left: -60px;
        }

        .image-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 260px;
        }

        .image-content i {
            font-size: 70px;
            margin-bottom: 18px;
        }

        .image-content h3 {
            font-size: 1.3rem;
            font-weight: 800;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .image-content p {
            font-size: .9rem;
            line-height: 1.6;
            opacity: .95;
        }

        /* RESPONSIVE */
        @media(max-width:968px) {
            body {
                padding: 12px;
            }

            .login-wrapper {
                grid-template-columns: 1fr;
                max-width: 480px;
            }

            .image-side {
                display: none;
            }

            .form-side {
                padding: 32px 26px;
            }
        }

        @media(max-width:640px) {
            .form-side {
                padding: 28px 20px;
            }

            .login-header h2 {
                font-size: 1.4rem;
            }
        }

        @media(max-width:480px) {
            body {
                padding: 10px;
            }

            .form-side {
                padding: 24px 16px;
            }

            .form-group {
                margin-bottom: 16px;
            }
        }

        /* LOADING OVERLAY NEW (LOGO THEMED + DOTS) */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            /* Sedikit lebih gelap */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(8px);
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .loading-logo {
            width: 90px;
            height: auto;
            margin-bottom: 20px;
            animation: pulse-logo 2s infinite ease-in-out;
            filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.2));
        }

        /* DOTS ANIMATION */
        .loading-dots {
            display: flex;
            gap: 10px;
            margin-bottom: clamp(5px, 2vh, 15px);
        }

        .loading-dots span {
            width: 10px;
            height: 10px;
            background-color: #fff;
            border-radius: 50%;
            display: inline-block;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .loading-dots span:nth-child(1) {
            animation-delay: -0.32s;
        }

        .loading-dots span:nth-child(2) {
            animation-delay: -0.16s;
        }

        .loading-text {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 0.95rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            animation: fadeText 2s infinite ease-in-out;
            margin-top: 5px;
        }

        @keyframes pulse-logo {
            0% {
                transform: scale(0.95);
                opacity: 0.9;
            }

            50% {
                transform: scale(1.05);
                opacity: 1;
            }

            100% {
                transform: scale(0.95);
                opacity: 0.9;
            }
        }

        @keyframes fadeText {

            0%,
            100% {
                opacity: 0.6;
            }

            50% {
                opacity: 1;
            }
        }

        @keyframes bounce {

            0%,
            80%,
            100% {
                transform: scale(0);
                opacity: 0.5;
            }

            40% {
                transform: scale(1);
                opacity: 1;
            }
        }

    </style>
    @include('partials.styles')
</head>

<body>

    @include('partials.header')

    <main style="overflow: hidden; position: relative; flex: 1; min-height: calc(100vh - 200px); display: flex; align-items: center; justify-content: center; width: 100%; padding: clamp(10px, 3vh, 40px) 16px;">
        <!-- Particles container -->
        <div id="particles-js" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: -2;"></div>
        <!-- Decorative blobs for glassmorphism effect -->
        <div style="position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: #3b82f6; border-radius: 50%; filter: blur(120px); opacity: 0.4; z-index: -1;"></div>
        <div style="position: absolute; bottom: -150px; right: -50px; width: 500px; height: 500px; background: #8b5cf6; border-radius: 50%; filter: blur(150px); opacity: 0.3; z-index: -1;"></div>


        <div class="login-wrapper" style="position: relative; z-index: 10;">
            <!-- Left Side: Login Form Admin -->
            <div class="form-side">
                <div class="login-header" style="text-align: center;">
                    <i class="fa-solid fa-computer" style="font-size: clamp(2.5rem, 8vh, 4rem); color: #ffffff; margin-bottom: clamp(5px, 2vh, 15px);"></i>
                    <h2 style="justify-content: center;">AKADEMIK UNIDA</h2>
                    <p>Masuk ke panel SKPI sebagai Akademik.</p>
                    <br>
                </div>

                @if ($errors->any())
                <div class="alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="nama@unida-aceh.ac.id" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
                    </div>

                    <button type="submit" class="btn">
                        <i class="fa-solid fa-right-to-bracket"></i> Masuk
                    </button>
                </form>

                <div class="form-footer">
                    <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda</a>
                </div>
            </div>


        </div>

        <!-- LOADING OVERLAY (LOGO + DOTS) -->
        <div class="loading-overlay" id="loadingOverlay">
            <img src="{{ asset('images/skpi_loading.png') }}" class="loading-logo" alt="Loading...">

            <!-- Three Bouncing Dots -->
            <div class="loading-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="loading-text">MEMPROSES MASUK...</div>
        </div>

        <script>
            document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault();
                document.getElementById('loadingOverlay').classList.add('active');

                // Disable button
                const btn = this.querySelector('button[type="submit"]');
                btn.style.opacity = '0.7';
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Loading...';

                setTimeout(() => {
                    this.submit();
                }, 1500);
            });
        </script>





    </main>

    @include('partials.footer')

    @include('partials.particles')
</body>

</html>