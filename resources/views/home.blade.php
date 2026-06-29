@extends('mahasiswa.layouts.app')

@section('content')
    <style>
        :root {
            --ink: #0f172a;
            --muted: #475569;
            --brand: #16a34a;
            --brand-dark: #15803d;
            --brand-light: #22c55e;
            --card: #ffffff;
            --border: #e2e8f0;
            --ring: rgba(34, 197, 94, .35);
            --bg: #f8fafc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: var(--bg);
            color: var(--ink);
            line-height: 1.6;
        }

        .dashboard-container {
            min-height: 100vh;
            position: relative;
            padding: 40px 20px;
        }

        .dashboard-container::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url('{{ asset('images/logo_unida.jpg') }}');
            background-size: 200px auto;
            background-repeat: space;
            background-position: center;
            background-origin: content-box;
            opacity: 0.08;
            z-index: 0;
            pointer-events: none;
        }

        .dashboard-container>* {
            position: relative;
            z-index: 1;
        }

        /* Header */
        .dashboard-header {
            max-width: 1200px;
            margin: 0 auto 40px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .06);
            backdrop-filter: blur(12px);
            animation: fadeInDown .6s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .main-title {
            font-size: clamp(1.5rem, 3vw, 2rem);
            font-weight: 800;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
        }

        .logout-button {
            padding: 10px 20px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .3s ease;
            box-shadow: 0 4px 12px rgba(239, 68, 68, .25);
        }

        .logout-button:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(239, 68, 68, .35);
        }

        .subtitle {
            color: var(--muted);
            font-size: 1rem;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .status-card {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .status-icon {
            font-size: 1.5rem;
            color: var(--brand);
        }

        .status-text {
            font-weight: 800;
            color: var(--brand-dark);
            font-size: 1.05rem;
        }

        .status-detail {
            color: var(--muted);
            font-size: 0.95rem;
            font-weight: 600;
            flex: 1;
            min-width: 200px;
        }

        /* Alerts */
        .alert-session {
            max-width: 1200px;
            margin: 0 auto 20px;
            padding: 16px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            animation: slideInRight .5s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
        }

        .alert-warning {
            background: #fef3c7;
            border: 1px solid #fde047;
            color: #854d0e;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }

        .alert-icon {
            font-size: 1.25rem;
        }

        /* Category Grid */
        .category-grid {
            max-width: 1200px;
            margin: 0 auto 40px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 24px;
        }

        .category-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            text-decoration: none;
            color: var(--ink);
            transition: all .3s ease;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .04);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(12px);
            animation: fadeInUp .6s ease backwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .category-card:nth-child(1) { animation-delay: .1s; }
        .category-card:nth-child(2) { animation-delay: .2s; }
        .category-card:nth-child(3) { animation-delay: .3s; }
        .category-card:nth-child(4) { animation-delay: .4s; }
        .category-card:nth-child(5) { animation-delay: .5s; }
        .category-card:nth-child(6) { animation-delay: .6s; }

        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--brand) 0%, var(--brand-light) 100%);
            transform: scaleX(0);
            transition: transform .3s ease;
        }

        .category-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, .1);
            border-color: rgba(22, 163, 74, .3);
        }

        .category-card:hover::before {
            transform: scaleX(1);
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 16px;
            display: block;
        }

        .icon-blue   { color: #3b82f6; }
        .icon-yellow { color: #f59e0b; }
        .icon-green  { color: #10b981; }
        .icon-red    { color: #ef4444; }
        .icon-purple { color: #8b5cf6; }
        .icon-orange { color: #f97316; }

        .card-title {
            font-size: 1.15rem;
            font-weight: 800;
            margin-bottom: 8px;
            color: var(--ink);
        }

        .card-description {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        /* Action Buttons */
        .action-button-group {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
            align-items: center;
        }

        .alert-box {
            width: 100%;
            padding: 16px 24px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            text-align: left;
        }

        .alert-blue  { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }
        .alert-green { background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; }
        .alert-red   { background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; }

        .submit-button {
            padding: 16px 32px;
            background: linear-gradient(135deg, var(--brand) 0%, var(--brand-light) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 800;
            font-size: 1.05rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all .3s ease;
            box-shadow: 0 12px 28px rgba(22, 163, 74, .3);
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 36px rgba(22, 163, 74, .4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-container { padding: 20px 16px; }
            .dashboard-header { padding: 24px 20px; }
            .header-top { flex-direction: column; align-items: flex-start; }
            .category-grid { grid-template-columns: 1fr; }
            .status-card { flex-direction: column; align-items: flex-start; }
            .dashboard-container::before { padding: 80px; background-size: 150px auto; }
        }
    </style>

    <div class="dashboard-container">

        <!-- Message Alerts -->
        @if (session('success'))
            <div class="alert-session alert-success">
                <i class="fas fa-check-circle alert-icon"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert-session alert-warning">
                <i class="fas fa-exclamation-triangle alert-icon"></i>
                {{ session('warning') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-session alert-error">
                <i class="fas fa-times-circle alert-icon"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Header -->
        <header class="dashboard-header">
            <div class="header-top">
                <h1 class="main-title">Dashboard Pengisian SKPI Mahasiswa</h1>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>

            <p class="subtitle">
                Selamat datang, <strong>{{ Auth::user()->name ?? 'Mahasiswa' }}</strong>.
                Silakan lengkapi data non-akademik Anda sesuai dengan Petunjuk Teknis SKPI UNIDA 2025.
            </p>

            <div class="status-card">
                <i class="fas fa-check-circle status-icon"></i>
                <span class="status-text">
                    Status Data:
                    {{ $jumlahKategoriTerisi == 6 ? 'Lengkap' : 'Belum Lengkap' }}
                </span>
                <span class="status-detail">
                    Anda telah mengisi {{ $jumlahKategoriTerisi }} dari 6 kategori data.
                </span>
            </div>
        </header>

        <!-- Grid Kategori SKPI -->
        <div class="category-grid">
            <a href="{{ url('/skpi/sertifikasi') }}" class="category-card">
                <i class="fas fa-award card-icon icon-blue"></i>
                <h3 class="card-title">1. Sertifikasi Kompetensi</h3>
                <p class="card-description">Kelola sertifikat keahlian, profesi, atau kursus yang relevan.</p>
            </a>

            <a href="{{ url('/skpi/prestasi') }}" class="category-card">
                <i class="fas fa-trophy card-icon icon-yellow"></i>
                <h3 class="card-title">2. Prestasi Akademik &amp; Non-Akademik</h3>
                <p class="card-description">Input data lomba, penghargaan, atau pencapaian tingkat regional/nasional.</p>
            </a>

            <a href="{{ url('/skpi/organisasi') }}" class="category-card">
                <i class="fas fa-users card-icon icon-green"></i>
                <h3 class="card-title">3. Organisasi dan Kepanitiaan</h3>
                <p class="card-description">Catat pengalaman organisasi atau kepanitiaan Anda.</p>
            </a>

            <a href="{{ url('/skpi/karya-ilmiah') }}" class="category-card">
                <i class="fas fa-book-open card-icon icon-red"></i>
                <h3 class="card-title">4. Karya Ilmiah/Publikasi</h3>
                <p class="card-description">Data publikasi jurnal, prosiding, atau karya ilmiah lainnya.</p>
            </a>

            <a href="{{ url('/skpi/pkm') }}" class="category-card">
                <i class="fas fa-hands-helping card-icon icon-purple"></i>
                <h3 class="card-title">5. Pengabdian kepada Masyarakat (PKM)</h3>
                <p class="card-description">Rekam kegiatan sosial atau proyek kemanusiaan Anda.</p>
            </a>

            <a href="{{ url('/skpi/penghargaan') }}" class="category-card">
                <i class="fas fa-graduation-cap card-icon icon-orange"></i>
                <h3 class="card-title">6. Penghargaan dan Beasiswa</h3>
                <p class="card-description">Dokumentasikan beasiswa dan penghargaan non-akademik yang diterima.</p>
            </a>
        </div>

        <!-- Tombol Pengajuan SKPI -->
        <div class="action-button-group">
            @if (isset($verifikasi) && $verifikasi->status === 'diajukan')
                <div class="alert-box alert-blue">
                    <i class="fas fa-spinner fa-spin"></i> Pengajuan Anda sedang diproses oleh Prodi.
                </div>
            @elseif(isset($verifikasi) && $verifikasi->status === 'disetujui_prodi')
                <div class="alert-box alert-green">
                    <i class="fas fa-check-circle"></i> SKPI Anda telah diverifikasi oleh Prodi.
                </div>
            @elseif(isset($verifikasi) && $verifikasi->status === 'ditolak_prodi')
                <div class="alert-box alert-red">
                    <i class="fas fa-times-circle"></i> Pengajuan ditolak oleh Prodi.
                    @if ($verifikasi->catatan)
                        <br><small><strong>Catatan:</strong> {{ $verifikasi->catatan }}</small>
                    @endif
                </div>
                <form method="POST" action="{{ route('skpi.ajukan') }}">
                    @csrf
                    <button type="submit" class="submit-button">
                        <i class="fas fa-paper-plane"></i> Ajukan Ulang SKPI
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('skpi.ajukan') }}">
                    @csrf
                    <button type="submit" class="submit-button">
                        <i class="fas fa-paper-plane"></i> Ajukan SKPI ke Prodi
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection

