<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Prodi - SKPI UNIDA</title>
    <link rel="icon" type="image/png" href="{{ asset('images/skpi_logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            padding: 16px;
            color: #fff;
            position: relative;
            overflow-x: hidden;
        }

        .login-wrapper {
            width: 100%;
            max-width: 980px;
            min-height: 520px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 18px 55px rgba(0, 0, 0, 0.45);
            overflow: hidden;
        }

        /* LEFT: FORM */
        .form-side {
            padding: 40px 46px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
            color: #111827;
        }

        .login-header {
            margin-bottom: 22px;
        }

        .login-header h2 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #0d47a1;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .login-header h2 i {
            color: #0d47a1;
        }

        .login-header p {
            color: #6b7280;
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
            color: #111827;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5f5;
            border-radius: 6px;
            font-size: .95rem;
            font-family: 'Poppins', sans-serif;
            color: #111827;
            background: #f9fafb;
            transition: border-color .18s, box-shadow .18s, background .18s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #0d47a1;
            background: #fff;
            box-shadow: 0 0 0 2px rgba(13, 71, 161, .25);
        }

        .btn {
            width: 100%;
            padding: 11px 0;
            background: #0050a0;
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
            text-transform: uppercase;
            letter-spacing: .8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .35);
            transition: background .18s, transform .12s, box-shadow .12s;
        }

        .btn:hover {
            background: #0d47a1;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .45);
        }

        .btn:active {
            transform: translateY(0);
        }

        .form-footer {
            margin-top: 18px;
            font-size: .9rem;
            text-align: left;
        }

        .form-footer a {
            color: #0d47a1;
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
            background: rgba(0, 0, 0, 0.9); /* Sedikit lebih gelap */
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
            filter: drop-shadow(0 0 15px rgba(255,255,255,0.2));
        }

        /* DOTS ANIMATION */
        .loading-dots {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .loading-dots span {
            width: 10px;
            height: 10px;
            background-color: #fff;
            border-radius: 50%;
            display: inline-block;
            animation: bounce 1.4s infinite ease-in-out both;
        }

        .loading-dots span:nth-child(1) { animation-delay: -0.32s; }
        .loading-dots span:nth-child(2) { animation-delay: -0.16s; }

        .loading-text {
            color: rgba(255,255,255,0.9);
            font-weight: 500;
            font-size: 0.95rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            animation: fadeText 2s infinite ease-in-out;
            margin-top: 5px;
        }

        @keyframes pulse-logo {
            0% { transform: scale(0.95); opacity: 0.9; }
            50% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(0.95); opacity: 0.9; }
        }

        @keyframes fadeText {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        @keyframes bounce {
            0%, 80%, 100% { transform: scale(0); opacity: 0.5; }
            40% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>

<body>
    <!-- Particles container -->
    <div id="particles-js" style="position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: -2;"></div>
    <!-- Decorative blobs for glassmorphism effect -->
    <div style="position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: #3b82f6; border-radius: 50%; filter: blur(120px); opacity: 0.4; z-index: -1;"></div>
    <div style="position: absolute; bottom: -150px; right: -50px; width: 500px; height: 500px; background: #8b5cf6; border-radius: 50%; filter: blur(150px); opacity: 0.3; z-index: -1;"></div>

    <div class="login-wrapper" style="position: relative; z-index: 10;">
        <!-- Left Side: Login Form -->
        <div class="form-side">
            <div class="login-header">
                <h2><i class="fa-solid fa-user-tie"></i> Login Prodi</h2>
                <p>Masuk ke sistem SKPI sebagai admin program studi.</p>
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

            <form method="POST" action="{{ route('prodi.login.submit') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="nama@university.ac.id" required autofocus>
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
                <a href="{{ route('home') }}">← Kembali ke Beranda</a>
            </div>
        </div>

        <!-- Right Side: Illustration -->
        <div class="image-side">
            <div class="image-content">
                <i class="fa-solid fa-building-columns"></i>
                <h3>Portal Prodi SKPI</h3>
                <p>Kelola verifikasi dan persetujuan SKPI mahasiswa secara terintegrasi di tingkat program studi.</p>
            </div>
        </div>
    </div>

    <!-- LOADING OVERLAY -->
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
