<!DOCTYPE html>
<html lang="id">

<head>
    <title>Aktivasi Akun SKPI - UNIDA</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
            background:
                linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('../images/bg.webp') center/cover no-repeat;
            padding: 16px;
            color: #fff;
        }

        .activation-wrapper {
            width: 100%;
            max-width: 900px;
            min-height: 480px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 18px 55px rgba(0, 0, 0, 0.45);
            overflow: hidden;
        }

        /* LEFT: FORM */
        .form-side {
            padding: 40px 40px 32px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
            color: #111827;
        }

        .form-title {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 10px;
            color: #0d47a1;
            display: flex;
            align-items: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .form-title i {
            color: #0d47a1;
        }

        .user-info {
            font-size: .95rem;
            color: #374151;
            margin-bottom: 18px;
        }

        .user-info span {
            color: #0d47a1;
            font-weight: 600;
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            font-size: .9rem;
            font-weight: 600;
            color: #111827;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5f5;
            border-radius: 6px;
            font-size: .95rem;
            color: #111827;
            background: #f9fafb;
            transition: border-color .18s, box-shadow .18s, background .18s;
            outline: none;
        }

        input:focus {
            border-color: #0d47a1;
            background: #fff;
            box-shadow: 0 0 0 2px rgba(13, 71, 161, .25);
        }

        .error {
            color: #b91c1c;
            font-size: .8rem;
            margin-top: 4px;
            display: block;
        }

        button {
            width: 100%;
            margin-top: 16px;
            padding: 11px 0;
            border: none;
            border-radius: 6px;
            background: #0050a0;
            color: #fff;
            font-size: .95rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-transform: uppercase;
            letter-spacing: .8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .35);
            transition: background .18s, transform .12s, box-shadow .12s;
        }

        button:hover {
            background: #0d47a1;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, .45);
        }

        .back-login {
            margin-top: 16px;
            font-size: .9rem;
        }

        .back-login a {
            color: #0d47a1;
            font-weight: 600;
            text-decoration: none;
        }

        .back-login a:hover {
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

        .redirect-countdown {
            font-size: 0.85rem;
            color: #9ca3af;
            margin-top: 15px;
        }

        /* RESPONSIVE */
        @media(max-width:968px) {
            body {
                padding: 12px;
            }

            .activation-wrapper {
                grid-template-columns: 1fr;
                max-width: 480px;
            }

            .image-side {
                display: none;
            }

            .form-side {
                padding: 32px 24px;
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
                padding: 24px 16px;
            }

            .form-title {
                font-size: 1.35rem;
            }
        }
    </style>
</head>

<body>
    <div class="activation-wrapper" role="main">
        <!-- Left: Form -->
        <div class="form-side">
            <div class="form-title">
                <i class="fa-solid fa-user-check"></i>
                Aktivasi Akun SKPI
            </div>
            <div class="user-info">
                Halo <span>{{ $user->name }}</span>, silakan buat password untuk mengaktifkan akun SKPI Anda.
            </div>

            <form method="POST" action="{{ route('activation.activate', $user->activation_token) }}">
                @csrf
                <label for="password">Password Baru</label>
                <input type="password" name="password" id="password" placeholder="Buat password baru" required />
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror

                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    placeholder="Ulangi password" required />

                <button type="submit">
                    <i class="fa-solid fa-check"></i> Aktivasi Akun
                </button>
            </form>

            <div class="back-login">
                Sudah punya akun?
                <a href="{{ route('login') }}">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i> Login di sini
                </a>
            </div>
        </div>

        <!-- Right: Illustration -->
        <div class="image-side">
            <div class="image-content">
                <i class="fa-solid fa-user-shield"></i>
                <h3>Aktivasi Akun SKPI</h3>
                <p>Amankan dan lengkapi profil Anda untuk mulai mengelola SKPI secara digital.</p>
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
            <h3 class="modal-title">Aktivasi Berhasil!</h3>
            <p class="modal-message" id="successMessage">
                Akun Anda berhasil diaktifkan. Silakan login dengan email dan password yang telah dibuat.
            </p>
            <button class="modal-btn" onclick="redirectToLogin()">
                <i class="fa-solid fa-arrow-right"></i> Ke Halaman Login
            </button>
            <p class="redirect-countdown">Redirect otomatis dalam <span id="countdown">5</span> detik...</p>
        </div>
    </div>

    <script>
        const loginUrl = "{{ route('mahasiswa.login') }}";
        let countdownInterval;

        function showSuccessModal(message) {
            if (message) {
                document.getElementById('successMessage').textContent = message;
            }
            document.getElementById('successModal').classList.add('active');
            startCountdown();
        }

        function redirectToLogin() {
            clearInterval(countdownInterval);
            window.location.href = loginUrl + '?activated=1';
        }

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

        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showSuccessModal("{{ session('success') }}");
            @endif
        });
    </script>
</body>

</html>
