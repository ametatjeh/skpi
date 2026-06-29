<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Mahasiswa - SKPI UNIDA</title>
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
            font-weight: 800;
            font-size: clamp(1.2rem, 4vh, 1.6rem);
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
            margin-bottom: clamp(2px, 1vh, 4px);
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
            color: #e2e8f0;
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
            margin-top: 14px;
            text-align: left;
            font-size: .9rem;
        }

        .form-footer a {
            color: #ffffff;
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
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
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
            100% {
                stroke-dashoffset: 0;
            }
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 12px;
            color: #059669;
        }

        .modal-message {
            font-size: 0.95rem;
            color: #cbd5e1;
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
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

        .main-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1100px;
            gap: 40px;
            position: relative;
            z-index: 10;
        }

        .hero-text {
            flex: 1;
            max-width: 500px;
        }

        .hero-sub {
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 8px 18px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 20px;
            color: #60a5fa;
            backdrop-filter: blur(10px);
        }

        .hero-title {
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 800;
            line-height: 1.25;
            margin-bottom: 28px;
            color: #fff;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 26px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.5px;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.6);
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
        }

        .btn-hero-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
        }

        .btn-hero-secondary:hover {
            transform: translateY(-3px);
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        @media(max-width:968px) {
            .main-container {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .hero-text {
                max-width: 100%;
                margin-bottom: 20px;
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

        
        <div class="main-container">
            <!-- Hero Text Kiri -->
            <div class="hero-text">
                <div class="hero-sub">Skema & Data</div>
                <h1 class="hero-title">Pelajari skema penerbitan SKPI & jenis data yang diverifikasi.</h1>
                <div class="hero-buttons">
                    <a href="{{ url('skema') }}" class="btn-hero btn-hero-primary">
                        <i class="fa-solid fa-layer-group"></i> SKEMA
                    </a>
                    <a href="{{ url('capaian') }}" class="btn-hero btn-hero-secondary">
                        <i class="fa-solid fa-award"></i> ACHIEVEMENT
                    </a>
                </div>
            </div>

            <!-- Login Box Kanan -->
            <div class="login-wrapper" role="main" style="position: relative; z-index: 10;">
            <div class="form-side">
            <div class="login-header" style="text-align: center;">
                <i class="fa-solid fa-user-graduate" style="font-size: clamp(2.5rem, 8vh, 4rem); color: #60a5fa; margin-bottom: clamp(5px, 2vh, 15px);"></i>
                <h2 style="justify-content: center;">Portal Mahasiswa</h2>
                <p>Login menggunakan NIM/e-mail Mahasiswa</p>
                <br>
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
                    <i class="fa-solid fa-right-to-bracket"></i> MASUK
                </button>
            </form>

            <div class="form-footer" style="display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('home') }}">← Kembali</a>
                <a href="{{ route('password.request') }}" style="color: #64748b; font-size: 0.9rem;">Lupa Password?</a>
            </div>
        </div>
    </div>
    </div>

    <!-- SUCCESS MODAL -->
    <div class="modal-overlay" id="successModal">
        <div class="modal-box">
            <div class="modal-icon">
                <svg class="checkmark" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
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

    <!-- Session Flash Data -->
    <div id="sessionFlashData"
        data-activation-success="{{ session('activation_success') }}"
        data-success="{{ session('success') }}"
        data-status="{{ session('status') }}"
        data-error="{{ session('error') }}"
        style="display: none;"></div>

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
            const flashData = document.getElementById('sessionFlashData');
            if (!flashData) return;

            const activationSuccess = flashData.getAttribute('data-activation-success');
            const success = flashData.getAttribute('data-success');
            const status = flashData.getAttribute('data-status');
            const error = flashData.getAttribute('data-error');

            if (activationSuccess) {
                showSuccessModal(activationSuccess);
            } else if (success) {
                showSuccessModal(success);
            } else if (status) {
                showSuccessModal(status);
            }

            if (error) {
                showErrorModal(error);
            }
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

        

    

        </main>

    @include('partials.footer')

    @include('partials.particles')
</body>

</html>