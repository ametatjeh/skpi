<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pusat Bahasa | SKPI')</title>

    <!-- Font Family -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    {{-- Dashboard Content Styles --}}
    <style>
        /* ============ DASHBOARD PUSAT BAHASA ============ */
        .pusat-dashboard-header {
            margin-bottom: 24px;
        }
        
        .pusat-title-main {
            font-size: 24px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 4px;
        }
        
        .pusat-title-desc {
            font-size: 14px;
            color: #6b7280;
        }
        
        /* Summary Row Cards */
        .pusat-summary-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }
        
        .pusat-sum-card {
            background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
            border-radius: 16px;
            padding: 20px 24px;
            color: #fff;
            box-shadow: 0 4px 20px rgba(8, 145, 178, 0.25);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .pusat-sum-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 28px rgba(8, 145, 178, 0.35);
        }
        
        .pusat-sum-card.green {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            box-shadow: 0 4px 20px rgba(16, 185, 129, 0.25);
        }
        
        .pusat-sum-card.green:hover {
            box-shadow: 0 8px 28px rgba(16, 185, 129, 0.35);
        }
        
        .pusat-sum-card.red {
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            box-shadow: 0 4px 20px rgba(239, 68, 68, 0.25);
        }
        
        .pusat-sum-card.red:hover {
            box-shadow: 0 8px 28px rgba(239, 68, 68, 0.35);
        }
        
        .pusat-sum-card.yellow {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            box-shadow: 0 4px 20px rgba(245, 158, 11, 0.25);
        }
        
        .pusat-sum-card.yellow:hover {
            box-shadow: 0 8px 28px rgba(245, 158, 11, 0.35);
        }
        
        .pusat-sum-title {
            font-size: 13px;
            font-weight: 600;
            opacity: 0.9;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .pusat-sum-title i {
            font-size: 16px;
        }
        
        .pusat-sum-value {
            font-size: 36px;
            font-weight: 800;
        }
        
        /* Section Title */
        .pusat-section-title {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* Draft Table Area */
        .pusat-draft-tbl-area {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }
        
        .pusat-draft-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        
        .pusat-draft-table thead {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        
        .pusat-draft-table thead th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 700;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
            white-space: nowrap;
        }
        
        .pusat-draft-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #4b5563;
        }
        
        .pusat-draft-table tbody tr {
            transition: background 0.2s;
        }
        
        .pusat-draft-table tbody tr:hover {
            background: #f0fdfa;
        }
        
        .pusat-draft-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        /* Status Badges */
        .pusat-badge-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .pusat-badge-draft {
            background: #f3f4f6;
            color: #6b7280;
        }
        
        .pusat-badge-final {
            background: #dcfce7;
            color: #15803d;
        }
        
        .pusat-badge-revisi {
            background: #fee2e2;
            color: #b91c1c;
        }
        
        .pusat-badge-pending {
            background: #fef3c7;
            color: #92400e;
        }
        
        /* Bilingual Dot */
        .pusat-bilingual-dot {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            font-size: 10px;
            font-weight: 700;
        }
        
        .pusat-bilingual-dot.green {
            background: #dcfce7;
            color: #15803d;
        }
        
        .pusat-bilingual-dot.red {
            background: #fee2e2;
            color: #b91c1c;
        }
        
        /* Link Detail */
        .pusat-link-detail {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 14px;
            background: linear-gradient(135deg, #0891b2 0%, #06b6d4 100%);
            color: #fff;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: transform 0.15s, box-shadow 0.15s;
        }
        
        .pusat-link-detail:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(8, 145, 178, 0.35);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .pusat-summary-row {
                grid-template-columns: 1fr;
            }
            
            .pusat-draft-tbl-area {
                overflow-x: auto;
            }
            
            .pusat-draft-table {
                min-width: 700px;
            }
        }
    </style>
    
    @stack('styles')
    @yield('extra-css')
</head>

<body style="margin:0;font-family:'Inter',sans-serif;background:#f8fafc;">

    {{-- SIDEBAR FIXED --}}
    @include('pusat.components.sidebar')

    {{-- MAIN AREA (NAVBAR + CONTENT) --}}
    <div class="pusat-main">
        @include('pusat.components.navbar')

        <div class="pusat-page-content">
            {{-- Flash message --}}
            @if ($errors->any())
                <div style="background:#fee2e2;border:1px solid #ef4444;color:#991b1b;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
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
                <div style="background:#dcfce7;border:1px solid #22c55e;color:#166534;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('warning'))
                <div style="background:#fef3c7;border:1px solid #facc15;color:#92400e;padding:12px 16px;border-radius:8px;margin-bottom:16px;display:flex;align-items:center;gap:10px;">
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

