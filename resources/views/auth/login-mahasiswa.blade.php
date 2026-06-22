<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Mahasiswa - SKPI UNIDA</title>
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
            font-weight: 800;
            font-size: 1.6rem;
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

        /* ALERT STYLES */
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

        /* WARNING ALERT - Cek Email */
        .alert-warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            border-radius: 10px;
            padding: 16px 18px;
            font-size: .9rem;
            margin-bottom: 18px;
            border-left: 4px solid #f59e0b;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            animation: slideDown 0.4s ease;
        }

        .alert-warning i {
            font-size: 1.3rem;
            color: #f59e0b;
            margin-top: 2px;
        }

        .alert-warning-content {
            flex: 1;
        }

        .alert-warning-title {
            font-weight: 700;
            margin-bottom: 4px;
            color: #78350f;
        }

        .alert-warning-text {
            line-height: 1.5;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-size: .9rem;
            font-weight: 600;
            margin-bottom: 6px;
            color: #111827;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5f5;
            border-radius: 6px;
            font-size: .95rem;
            color: #111827;
            background: #f9fafb;
            outline: none;
            transition: border-color .18s, box-shadow .18s;
        }

        .form-group input:focus {
            border-color: #0d47a1;
            box-shadow: 0 0 0 2px rgba(13, 71, 161, .25);
        }

        .btn {
            width: 100%;
            padding: 11px 0;
            border-radius: 6px;
            font-size: .95rem;
            font-weight: 700;
            background: #0050a0;
            color: #fff;
            border: none;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
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

        .form-footer {
            margin-top: 14px;
            text-align: left;
            font-size: .9rem;
        }

        .form-footer a {
            color: #0d47a1;
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* RIGHT: PANEL (MATCH HERO THEME) */
        .image-side {
            position: relative;
            background:
                linear-gradient(135deg, rgba(0, 80, 160, .9), rgba(13, 71, 161, .9));
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 38px;
            overflow: hidden;
        }

        .image-side::before {
            content: '';
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .08);
            top: -80px;
            right: -80px;
        }

        .image-side::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
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

        /* ========== MODAL STYLES ========== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-box {
            background: #fff;
            border-radius: 20px;
            padding: 40px 50px;
            text-align: center;
            max-width: 420px;
            width: 90%;
            transform: scale(0.7) translateY(-30px);
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-overlay.active .modal-box {
            transform: scale(1) translateY(0);
        }

        .modal-icon {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 45px;
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: #fff;
            animation: bounceIn 0.6s ease;
        }

        @keyframes bounceIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .checkmark {
            width: 45px;
            height: 45px;
        }

        .checkmark__circle {
            stroke: #fff;
            stroke-width: 2;
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark__check {
            stroke: #fff;
            stroke-width: 3;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.4s forwards;
        }

        @keyframes stroke {
            100% { stroke-dashoffset: 0; }
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 12px;
            color: #059669;
        }

        .modal-message {
            font-size: 0.95rem;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .modal-btn {
            padding: 12px 35px;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        .modal-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
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

            .modal-box {
                padding: 30px 25px;
            }
        }

        @media(max-width:480px) {
            body {
                padding: 10px;
            }

            .form-side {
                padding: 26px 18px;
            }

            .login-header h2 {
                font-size: 1.3rem;
            }
        }
        /* LOADING OVERLAY */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.75);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            backdrop-filter: blur(4px);
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.2);
            border-top: 4px solid #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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

    <div class="login-wrapper" role="main" style="position: relative; z-index: 10;">
        <div class="form-side">
            <div class="login-header">
                <h2><i class="fa-solid fa-graduation-cap"></i> Login Mahasiswa</h2>
                <p>Silakan login menggunakan akun SKPI Mahasiswa UNIDA.</p>
            </div>

            {{-- Warning: Cek Email setelah registrasi --}}
            @if(request()->has('from_registration'))
                <div class="alert-warning">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <div class="alert-warning-content">
                        <div class="alert-warning-title">Cek Email Anda!</div>
                        <div class="alert-warning-text">
                            Link aktivasi telah dikirim ke email Anda. Silakan cek <strong>inbox</strong> atau <strong>folder spam</strong>. 
                            Refresh halaman jika email belum masuk.
                        </div>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('mahasiswa.login') }}">
                @csrf
                <div class="form-group">
                    <label for="login">Email atau NIM</label>
                    <input type="text" id="login" name="login" value="{{ old('login') }}"
                        placeholder="Masukkan Email atau NIM" required autofocus />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required />
                </div>
                <button type="submit" class="btn">
                    <i class="fa-solid fa-right-to-bracket"></i> Login Mahasiswa
                </button>
            </form>

            <div class="form-footer" style="display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('home') }}">← Kembali</a>
                <a href="{{ route('password.request') }}" style="color: #64748b; font-size: 0.9rem;">Lupa Password?</a>
            </div>
        </div>

        <div class="image-side">
            <div class="image-content">
                <i class="fa-solid fa-user-graduate"></i>
                <h3>Portal SKPI Mahasiswa</h3>
                <p>Kelola SKPI, prestasi, dan sertifikasi Anda secara digital, kapan saja dan di mana saja.</p>
            </div>
        </div>
    </div>

    <!-- SUCCESS MODAL -->
    <div class="modal-overlay" id="successModal">
        <div class="modal-box">
            <div class="modal-icon">
                <svg class="checkmark" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <h3 class="modal-title">Berhasil!</h3>
            <p class="modal-message" id="successMessage"></p>
            <button class="modal-btn" onclick="closeSuccessModal()">
                OK, Mengerti
            </button>
        </div>
    </div>

    <!-- ERROR MODAL -->
    <div class="modal-overlay" id="errorModal">
        <div class="modal-box">
            <div class="modal-icon error" style="background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);">
                <i class="fas fa-times" style="font-size: 45px; color: white;"></i>
            </div>
            <h3 class="modal-title" style="color: #ef4444;">Gagal!</h3>
            <p class="modal-message" id="errorMessage"></p>
            <button class="modal-btn" onclick="closeErrorModal()" style="background: linear-gradient(135deg, #ef4444 0%, #f87171 100%); box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);">
                Tutup
            </button>
        </div>
    </div>

    <script>
        function showSuccessModal(message) {
            if (message) {
                document.getElementById('successMessage').textContent = message;
            }
            document.getElementById('successModal').classList.add('active');
        }

        function closeSuccessModal() {
            document.getElementById('successModal').classList.remove('active');
        }

        function showErrorModal(message) {
            if (message) {
                document.getElementById('errorMessage').textContent = message;
            }
            document.getElementById('errorModal').classList.add('active');
        }

        function closeErrorModal() {
            document.getElementById('errorModal').classList.remove('active');
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if(session('activation_success'))
                showSuccessModal("{{ session('activation_success') }}");
            @endif

            @if(session('success'))
                showSuccessModal("{{ session('success') }}");
            @endif

            @if(session('status'))
                showSuccessModal("{{ session('status') }}");
            @endif

            @if(session('error'))
                showErrorModal("{{ session('error') }}");
            @endif
        });
    </script>
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
            const btn = this.querySelector('button[type="submit"]');
            btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> MEMPROSES...';
            btn.style.opacity = '0.7';
            document.getElementById('loadingOverlay').classList.add('active');

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
