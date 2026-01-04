<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Fakultas') - Sistem SKPI</title>

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @stack('styles')

</head>

<body style="margin:0;font-family:'Inter',sans-serif;background:#f8fafc;">

    {{-- SIDEBAR FIXED --}}
    @include('fakultas.components.sidebar')

    {{-- MAIN AREA (NAVBAR + CONTENT) --}}
    <div class="fakultas-main">
        @include('fakultas.components.navbar')

        <div class="fakultas-page-content">
            {{-- Flash message --}}
            @if ($errors->any())
                <div class="alert alert-danger" style="background:#fee2e2;border:1px solid #ef4444;color:#991b1b;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
                    <i class="fas fa-times-circle"></i>
                    <div>
                        <strong>Error!</strong>
                        <ul style="margin:4px 0 0 16px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success" style="background:#dcfce7;border:1px solid #22c55e;color:#166534;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning" style="background:#fef3c7;border:1px solid #facc15;color:#92400e;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
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

