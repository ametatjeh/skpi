<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Email - SKPI</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">

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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
            color: #fff;
            position: relative;
            overflow-x: hidden;
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
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 1px;
            margin-bottom: 20px;
            color: #60a5fa;
            backdrop-filter: blur(10px);
        }

        .hero-title {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.15;
            margin-bottom: 24px;
            color: #fff;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .wrapper {
            width: 100%;
            max-width: 480px;
            min-height: clamp(380px, 60vh, 520px);
            background: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            box-shadow: 0 18px 55px rgba(0, 0, 0, .45);
            overflow: hidden;
        }

        /* Form Side */
        .form-side {
            padding: clamp(20px, 4vh, 40px) clamp(20px, 4vw, 46px);
            background: transparent;
            color: #f8fafc;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: .8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info {
            background: rgba(255, 255, 255, 0.1);
            color: #e2e8f0;
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 20px;
            border-left: 4px solid #60a5fa;
            font-size: .9rem;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            color: #e2e8f0;
            font-size: .9rem;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            font-size: .95rem;
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

        button {
            width: 100%;
            padding: 12px 0;
            background: #2563eb;
            color: white;
            font-weight: 700;
            border-radius: 6px;
            border: none;
            margin-top: 8px;
            cursor: pointer;
            letter-spacing: .8px;
            text-transform: uppercase;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.35);
            transition: .18s;
        }

        button:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45);
        }

        .login-link {
            margin-top: 18px;
            font-size: .9rem;
            color: #e2e8f0;
            font-weight: 600;
        }

        .login-link a {
            color: #60a5fa;
            text-decoration: none;
            font-weight: 700;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Right Panel */
        .image-side {
            background: linear-gradient(135deg, rgba(0, 80, 160, .9), rgba(13, 71, 161, .9));
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 38px;
            position: relative;
            overflow: hidden;
            color: white;
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
            z-index: 5;
            max-width: 260px;
            text-align: center;
        }

        .image-content i {
            font-size: 80px;
            margin-bottom: 18px;
        }

        .image-content h3 {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: .6px;
        }

        .image-content p {
            font-size: .9rem;
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
        }

        /* Success Icon */
        .modal-icon.success {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: #fff;
            animation: bounceIn 0.6s ease;
        }

        /* Error Icon */
        .modal-icon.error {
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            color: #fff;
            animation: shake 0.5s ease;
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

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-8px);
            }

            40%,
            80% {
                transform: translateX(8px);
            }
        }

        /* Checkmark Animation */
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
            color: #111827;
        }

        .modal-title.success {
            color: #059669;
        }

        .modal-title.error {
            color: #dc2626;
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
        }

        .modal-btn.success {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        .modal-btn.success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
        }

        .modal-btn.error {
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }

        .modal-btn.error:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5);
        }

        .redirect-countdown {
            font-size: 0.85rem;
            color: #9ca3af;
            margin-top: 15px;
        }

        /* Responsive */
        @media(max-width:968px) {
            .main-container {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .hero-text {
                display: none;
            }

            .wrapper {
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
            <div class="hero-sub">Belum Registrasi Email Untuk Login?</div>
            <h1 class="hero-title">Aktivasi Email Untuk Login<br>SKPI UNIDA</h1>
        </div>

        <!-- Box Form Kanan -->
        <div class="wrapper">
            <div class="form-side">
                <div style="text-align: center;">
                    <i class="fa-solid fa-envelope-circle-check" style="font-size: clamp(2.5rem, 8vh, 4rem); color: #ffffff; margin-bottom: clamp(5px, 2vh, 15px);"></i>
                    <h2 style="justify-content: center; font-size: clamp(1.3rem, 4vh, 1.8rem); margin-bottom: clamp(5px, 2vh, 15px);">PORTAL PENDAFTARAN</h2>
                </div>

                <div class="info">
                    <b>Petunjuk Registrasi:</b><br>
                    1. Isi NIM<br>
                    2. Masukkan Email Mahasiswa UNIDA<br>
                    3. Cek Email Aktivasi<br>
                    4. Buat Password & Login
                </div>

                <form method="POST" action="{{ route('email.registration.submit') }}">
                    @csrf

                    <input type="hidden" name="role" value="mahasiswa" />

                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="nim" placeholder="2025150031" value="{{ old('nim') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email UNIDA</label>
                        <input type="email" name="email" placeholder="nama@unida-aceh.ac.id" value="{{ old('email') }}" required>
                    </div>

                    <button type="submit">
                        <i class="fa-solid fa-paper-plane"></i> DAFTAR
                    </button>
                </form>

                <div class="login-link" style="display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ route('home') }}" style="color: #ffffff; font-weight: 600; text-decoration: none;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    <div>
                        Sudah punya akun?
                        <a href="{{ route('mahasiswa.login') }}">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        </main>

    @include('partials.footer')

    <!-- SUCCESS MODAL -->
    <div class="modal-overlay" id="successModal">
        <div class="modal-box">
            <div class="modal-icon success">
                <svg class="checkmark" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                </svg>
            </div>
            <h3 class="modal-title success">Pendaftaran Berhasil!</h3>
            <p class="modal-message" id="successMessage">
                Link aktivasi telah dikirim ke email Anda, cek inbox atau folder spam.
            </p>
            <button class="modal-btn success" onclick="redirectToLogin()">
                <i class="fa-solid fa-arrow-right"></i> Ke Halaman Login
            </button>
            <p class="redirect-countdown" id="countdownText">Redirect otomatis dalam <span id="countdown">5</span> detik...</p>
        </div>
    </div>

    <!-- ERROR MODAL -->
    <div class="modal-overlay" id="errorModal">
        <div class="modal-box">
            <div class="modal-icon error">
                <i class="fa-solid fa-times"></i>
            </div>
            <h3 class="modal-title error">Pendaftaran Gagal!</h3>
            <p class="modal-message" id="errorMessage">
                Terjadi kesalahan saat registrasi.
            </p>
            <button class="modal-btn error" onclick="closeErrorModal()">
                <i class="fa-solid fa-redo"></i> Coba Lagi
            </button>
        </div>
    <!-- Session Flash Data -->
    <div id="sessionFlashData"
        data-success="{{ session('success') }}"
        data-error="{{ count($errors) > 0 ? $errors->first() : '' }}"
        style="display: none;"></div>

    <script>
        const loginUrl = "{{ route('mahasiswa.login') }}";
        let countdownInterval;

        // Show Success Modal
        function showSuccessModal(message) {
            if (message) {
                document.getElementById('successMessage').textContent = message;
            }
            document.getElementById('successModal').classList.add('active');
            startCountdown();
        }

        // Show Error Modal
        function showErrorModal(message) {
            if (message) {
                document.getElementById('errorMessage').textContent = message;
            }
            document.getElementById('errorModal').classList.add('active');
        }

        // Close Error Modal
        function closeErrorModal() {
            document.getElementById('errorModal').classList.remove('active');
        }

        // Redirect to Login with from_registration flag
        function redirectToLogin() {
            clearInterval(countdownInterval);
            window.location.href = loginUrl + '?from_registration=1';
        }

        // Countdown Timer
        function startCountdown() {
            let seconds = 5;
            const countdownEl = document.getElementById('countdown');

            countdownInterval = setInterval(() => {
                seconds--;
                countdownEl.textContent = seconds;

                if (seconds <= 0) {
                    clearInterval(countdownInterval);
                    redirectToLogin();
                }
            }, 1000);
        }

        // Check for Laravel session messages
        document.addEventListener('DOMContentLoaded', function() {
            const flashData = document.getElementById('sessionFlashData');
            if (!flashData) return;

            const success = flashData.getAttribute('data-success');
            const error = flashData.getAttribute('data-error');

            if (success) {
                showSuccessModal(success);
            }
            if (error) {
                showErrorModal(error);
            }
        });
    </script>

    @include('partials.particles')
</body>

</html>