<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Email - SKPI</title>

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
            justify-content: center;
            align-items: center;
            padding: 16px;
            background:
                linear-gradient(rgba(0, 0, 0, .55), rgba(0, 0, 0, .55)),
                url('../images/bg.webp') center/cover no-repeat;
            color: #fff;
        }

        .wrapper {
            width: 100%;
            max-width: 980px;
            min-height: 520px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 18px 55px rgba(0, 0, 0, .45);
            overflow: hidden;
        }

        /* Form Side */
        .form-side {
            padding: 40px 46px;
            background: #fff;
            color: #111827;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 {
            font-size: 1.6rem;
            font-weight: 800;
            color: #0d47a1;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: .8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info {
            background: #e3f2fd;
            color: #0d47a1;
            border-radius: 8px;
            padding: 14px 16px;
            margin-bottom: 20px;
            border-left: 4px solid #0d47a1;
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
            color: #111827;
            font-size: .9rem;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5f5;
            border-radius: 6px;
            font-size: .95rem;
            background: #f9fafb;
            color: #111827;
            transition: .18s;
        }

        .form-group input:focus {
            border-color: #0d47a1;
            background: #fff;
            outline: none;
            box-shadow: 0 0 0 2px rgba(13, 71, 161, .25);
        }

        button {
            width: 100%;
            padding: 12px 0;
            background: #0050a0;
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, .35);
            transition: .18s;
        }

        button:hover {
            background: #0d47a1;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .45);
        }

        .login-link {
            margin-top: 18px;
            font-size: .9rem;
            color: #0d47a1;
            font-weight: 600;
        }

        .login-link a {
            color: #0050a0;
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
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-8px); }
            40%, 80% { transform: translateX(8px); }
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
            100% { stroke-dashoffset: 0; }
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 12px;
            color: #111827;
        }

        .modal-title.success { color: #059669; }
        .modal-title.error { color: #dc2626; }

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
</head>

<body>
    <div class="wrapper">

        <div class="form-side">
            <h2><i class="fa-solid fa-envelope-circle-check"></i> Registrasi Email</h2>

            <div class="info">
                <b>Petunjuk Registrasi:</b><br>
                1. Isi NIM<br>
                2. Masukkan Email Aktif<br>
                3. Cek Email Aktivasi<br>
                4. Buat Password & Login
            </div>

            <form method="POST" action="{{ route('email.registration.submit') }}">
                @csrf

                <input type="hidden" name="role" value="mahasiswa" />

                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" placeholder="1220110001" value="{{ old('nim') }}" required>
                </div>

                <div class="form-group">
                    <label>Email Aktif</label>
                    <input type="email" name="email" placeholder="nama@email.com" value="{{ old('email') }}" required>
                </div>

                <button type="submit">
                    <i class="fa-solid fa-paper-plane"></i> Daftar Email
                </button>
            </form>

            <div class="login-link">
                Sudah punya akun?
                <a href="{{ route('mahasiswa.login') }}">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                </a>
            </div>
        </div>

        <div class="image-side">
            <div class="image-content">
                <i class="fa-solid fa-graduation-cap"></i>
                <h3>Sistem Informasi SKPI</h3>
                <p>Platform manajemen pencapaian mahasiswa terintegrasi.</p>
            </div>
        </div>

    </div>

    <!-- SUCCESS MODAL -->
    <div class="modal-overlay" id="successModal">
        <div class="modal-box">
            <div class="modal-icon success">
                <svg class="checkmark" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <h3 class="modal-title success">Registrasi Berhasil!</h3>
            <p class="modal-message" id="successMessage">
                Link aktivasi telah dikirim ke email Anda. Silakan cek inbox atau folder spam.
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
            <h3 class="modal-title error">Registrasi Gagal!</h3>
            <p class="modal-message" id="errorMessage">
                Terjadi kesalahan saat registrasi.
            </p>
            <button class="modal-btn error" onclick="closeErrorModal()">
                <i class="fa-solid fa-redo"></i> Coba Lagi
            </button>
        </div>
    </div>

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
            @if(session('success'))
                showSuccessModal("{{ session('success') }}");
            @endif

            @if($errors->any())
                showErrorModal("{{ $errors->first() }}");
            @endif
        });
    </script>
</body>

</html>
