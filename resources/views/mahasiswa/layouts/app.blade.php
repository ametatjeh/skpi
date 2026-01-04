<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Mahasiswa') - Sistem SKPI</title>

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1f2937;
        }

        /* ===== LAYOUT STRUCTURE ===== */
        .mahasiswa-main {
            margin-left: 260px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        .mahasiswa-page-content {
            padding: 28px 32px;
            min-height: calc(100vh - 64px);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .mahasiswa-main {
                margin-left: 0;
            }

            .mahasiswa-page-content {
                padding: 20px 16px;
            }
        }

        /* ===== CARD STYLES ===== */
        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid #e5e7eb;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-title {
            font-size: 16px;
            font-weight: 700;
            color: #111827;
        }

        .card-body {
            padding: 24px;
        }

        /* ===== BUTTON STYLES ===== */
        .btn {
            padding: 10px 18px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.35);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            color: white;
        }

        /* ===== FORM STYLES ===== */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.2s;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        /* ===== BADGE STYLES ===== */
        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-primary {
            background: #e0f2fe;
            color: #0369a1;
        }

        .badge-success {
            background: #dcfce7;
            color: #15803d;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-danger {
            background: #fee2e2;
            color: #b91c1c;
        }

        /* ===== ALERT STYLES ===== */
        .alert {
            padding: 14px 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
        }

        .alert-success {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #15803d;
            border: 1px solid #86efac;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #b91c1c;
            border: 1px solid #f87171;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            border: 1px solid #fcd34d;
        }

        /* ===== TABLE STYLES ===== */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead th {
            padding: 14px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: #f8fafc;
            border-bottom: 2px solid #e5e7eb;
        }

        .table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
            color: #374151;
        }

        .table tbody tr:hover {
            background: #f0f9ff;
        }
    </style>

    @stack('styles')
</head>

<body>
    {{-- SIDEBAR FIXED --}}
    @include('mahasiswa.components.sidebar')

    {{-- MAIN AREA (NAVBAR + CONTENT) --}}
    <div class="mahasiswa-main">
        @include('mahasiswa.components.navbar')

        <div class="mahasiswa-page-content">
            {{-- Flash messages --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-times-circle"></i>
                    <div>
                        <strong>Error!</strong>
                        <ul style="margin: 4px 0 0 16px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>{{ session('warning') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>

</html>
