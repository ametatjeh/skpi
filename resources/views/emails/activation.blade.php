<!DOCTYPE html>
<html>

<head>
    <title>Aktivasi Akun SKPI</title>
</head>

<body>
    <h2>Halo {{ $name }}</h2>
    <p>Selamat datang di Sistem SKPI Kampus!</p>
    {{-- Hapus atau komentar baris NIM jika belum di-pass dari mail --}}
    {{-- <p>NIM Anda: <strong>{{ $nim }}</strong></p> --}}
    <p>Untuk mengaktifkan akun Anda, silakan klik tombol di bawah ini untuk membuat password:</p>
    <a href="{{ $activationUrl }}"
        style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; display: inline-block;">
        Aktivasi Akun
    </a>
    <p>Atau copy link berikut ke browser Anda:</p>
    <p>{{ $activationUrl }}</p>
    <p>Link ini akan kadaluarsa dalam 7 hari.</p>
    <p>Jika Anda tidak merasa mendaftar, abaikan email ini.</p>
</body>

</html>
