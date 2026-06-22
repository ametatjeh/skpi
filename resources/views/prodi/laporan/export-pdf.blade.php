<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Verifikasi SKPI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #1f2937;
            line-height: 1.5;
        }
        
        .container {
            padding: 20px 30px;
        }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2563eb;
        }
        
        .header h1 {
            font-size: 20px;
            color: #1e40af;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .header h2 {
            font-size: 14px;
            color: #374151;
            font-weight: normal;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 11px;
            color: #6b7280;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }
        
        .stats-row {
            display: table-row;
        }
        
        .stat-card {
            display: table-cell;
            width: 20%;
            padding: 10px;
            text-align: center;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
        }
        
        .stat-card:first-child {
            border-radius: 8px 0 0 8px;
        }
        
        .stat-card:last-child {
            border-radius: 0 8px 8px 0;
        }
        
        .stat-value {
            font-size: 22px;
            font-weight: bold;
            color: #111827;
        }
        
        .stat-label {
            font-size: 10px;
            color: #6b7280;
            margin-top: 3px;
        }
        
        .stat-card.blue { background: #dbeafe; }
        .stat-card.blue .stat-value { color: #2563eb; }
        
        .stat-card.yellow { background: #fef3c7; }
        .stat-card.yellow .stat-value { color: #d97706; }
        
        .stat-card.green { background: #dcfce7; }
        .stat-card.green .stat-value { color: #16a34a; }
        
        .stat-card.red { background: #fee2e2; }
        .stat-card.red .stat-value { color: #dc2626; }
        
        .stat-card.purple { background: #f3e8ff; }
        .stat-card.purple .stat-value { color: #7c3aed; }
        
        /* Info Section */
        .info-section {
            margin-bottom: 25px;
            padding: 15px;
            background: #eff6ff;
            border-radius: 8px;
            border-left: 4px solid #2563eb;
        }
        
        .info-section h3 {
            font-size: 12px;
            color: #1e40af;
            margin-bottom: 8px;
        }
        
        .info-grid {
            display: table;
            width: 100%;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-item {
            display: table-cell;
            padding: 5px 10px;
            width: 33%;
        }
        
        .info-label {
            font-size: 9px;
            color: #6b7280;
            text-transform: uppercase;
        }
        
        .info-value {
            font-size: 12px;
            font-weight: bold;
            color: #111827;
        }
        
        /* Section Title */
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #111827;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #e5e7eb;
        }
        
        /* Table */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table.data-table thead th {
            background: #2563eb;
            color: #ffffff;
            padding: 10px 8px;
            font-size: 10px;
            font-weight: bold;
            text-align: left;
            text-transform: uppercase;
        }
        
        table.data-table thead th:first-child {
            border-radius: 6px 0 0 0;
        }
        
        table.data-table thead th:last-child {
            border-radius: 0 6px 0 0;
        }
        
        table.data-table tbody td {
            padding: 8px;
            font-size: 10px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }
        
        table.data-table tbody tr:nth-child(even) {
            background: #f9fafb;
        }
        
        table.data-table tbody tr:last-child td:first-child {
            border-radius: 0 0 0 6px;
        }
        
        table.data-table tbody tr:last-child td:last-child {
            border-radius: 0 0 6px 0;
        }
        
        /* Status Badge */
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }
        
        .badge-pending {
            background: #fef3c7;
            color: #92400e;
        }
        
        .badge-approved {
            background: #dcfce7;
            color: #166534;
        }
        
        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .badge-revision {
            background: #dbeafe;
            color: #1e40af;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            font-size: 9px;
            color: #6b7280;
            text-align: center;
        }
        
        /* Per Kategori */
        .kategori-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .kategori-item {
            display: table-cell;
            padding: 8px 12px;
            text-align: center;
            background: #f8fafc;
            border: 1px solid #e5e7eb;
        }
        
        .kategori-value {
            font-size: 16px;
            font-weight: bold;
            color: #2563eb;
        }
        
        .kategori-label {
            font-size: 9px;
            color: #6b7280;
        }
        
        /* Page Break */
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header --}}
        <div class="header">
            <h1>Laporan Verifikasi SKPI</h1>
            <h2>{{ $prodi->nama_prodi ?? 'Program Studi' }}</h2>
            <p>Tahun {{ $tahun }} | Dicetak: {{ $tanggalCetak }}</p>
        </div>
        
        {{-- Stats Cards --}}
        <div class="stats-grid">
            <div class="stats-row">
                <div class="stat-card blue">
                    <div class="stat-value">{{ $stats['total'] }}</div>
                    <div class="stat-label">Total Pengajuan</div>
                </div>
                <div class="stat-card yellow">
                    <div class="stat-value">{{ $stats['pending'] }}</div>
                    <div class="stat-label">Menunggu</div>
                </div>
                <div class="stat-card green">
                    <div class="stat-value">{{ $stats['approved'] }}</div>
                    <div class="stat-label">Disetujui</div>
                </div>
                <div class="stat-card red">
                    <div class="stat-value">{{ $stats['rejected'] }}</div>
                    <div class="stat-label">Ditolak</div>
                </div>
                <div class="stat-card purple">
                    <div class="stat-value">{{ $approvalRate }}%</div>
                    <div class="stat-label">Tingkat Approval</div>
                </div>
            </div>
        </div>
        
        {{-- Info Section --}}
        <div class="info-section">
            <h3>Ringkasan Laporan</h3>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-item">
                        <div class="info-label">Program Studi</div>
                        <div class="info-value">{{ $prodi->nama_prodi ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Periode</div>
                        <div class="info-value">Tahun {{ $tahun }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Jumlah Mahasiswa</div>
                        <div class="info-value">{{ $verifikasi->pluck('mahasiswa_id')->unique()->count() }} Orang</div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Per Kategori --}}
        @if($perKategori->count() > 0)
        <div class="section-title">Pengajuan per Kategori</div>
        <div class="kategori-grid">
            @php
                $kategoriMap = [
                    'App\Models\SertifikasiKompetensi' => 'Sertifikasi',
                    'App\Models\Prestasi' => 'Prestasi',
                    'App\Models\Organisasi' => 'Organisasi',
                    'App\Models\PengabdianMasyarakat' => 'PKM',
                    'App\Models\KaryaIlmiah' => 'Karya Ilmiah',
                    'App\Models\Penghargaan' => 'Penghargaan',
                ];
            @endphp
            @foreach($perKategori as $type => $count)
            <div class="kategori-item">
                <div class="kategori-value">{{ $count }}</div>
                <div class="kategori-label">{{ $kategoriMap[$type] ?? class_basename($type) }}</div>
            </div>
            @endforeach
        </div>
        @endif
        
        {{-- Data Table --}}
        <div class="section-title">Detail Pengajuan Verifikasi</div>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th style="width: 70px;">NIM</th>
                    <th style="width: 120px;">Nama</th>
                    <th style="width: 80px;">Kategori</th>
                    <th>Achievement</th>
                    <th style="width: 65px;">Status</th>
                    <th style="width: 65px;">Tgl Ajuan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($verifikasi as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                    <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $kategoriMap[$item->verifiable_type] ?? class_basename($item->verifiable_type) }}</td>
                    <td>{{ $item->achievement_name ?? '-' }}</td>
                    <td>
                        @switch($item->status)
                            @case('pending')
                                <span class="badge badge-pending">Menunggu</span>
                                @break
                            @case('approved')
                                <span class="badge badge-approved">Disetujui</span>
                                @break
                            @case('rejected')
                                <span class="badge badge-rejected">Ditolak</span>
                                @break
                            @case('revision_required')
                                <span class="badge badge-revision">Revisi</span>
                                @break
                            @default
                                <span class="badge badge-pending">{{ ucfirst($item->status) }}</span>
                        @endswitch
                    </td>
                    <td>{{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px; color: #9ca3af;">
                        Tidak ada data pengajuan verifikasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        {{-- Footer --}}
        <div class="footer">
            <p>Dokumen ini digenerate secara otomatis oleh Sistem SKPI UNIDA</p>
            <p>{{ $tanggalCetak }} | Halaman 1</p>
        </div>
    </div>
</body>
</html>

