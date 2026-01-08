<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Prodi') - Sistem SKPI</title>
    <link rel="icon" type="image/png" href="{{ asset('images/skpi_logo.png') }}">

    <!-- Font & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @stack('styles')
</head>

<body style="margin:0;font-family:'Inter',sans-serif;background:#f8fafc;">

    {{-- SIDEBAR FIXED --}}
    @include('prodi.components.sidebar')

    {{-- MAIN AREA (NAVBAR + CONTENT) --}}
    <div class="prodi-main">
        @include('prodi.components.navbar')

        <div class="prodi-page-content">
            {{-- Flash message (opsional, bisa kamu sesuaikan) --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    @stack('scripts')
</body>

</html>

