<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi SKPI - Universitas Iskandar Muda</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            max-width: 500px;
            width: 90%;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .header {
            padding: 24px;
            text-align: center;
            border-bottom: 1px solid #e5e7eb;
            background: #f8fafc;
        }
        .header img {
            width: 80px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 18px;
            margin: 0;
            color: #111827;
            font-weight: 700;
        }
        .header p {
            font-size: 14px;
            color: #6b7280;
            margin: 5px 0 0;
        }
        .content {
            padding: 30px 24px;
            text-align: center;
        }
        
        .status-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
        }
        
        .status-title {
            font-size: 24px;
            font-weight: 800;
            margin: 0 0 10px;
        }
        
        .status-message {
            font-size: 15px;
            color: #4b5563;
            line-height: 1.5;
            margin-bottom: 24px;
        }
        
        /* Valid */
        .valid .status-icon {
            background-color: #dcfce7;
            color: #16a34a;
        }
        .valid .status-title { color: #16a34a; }
        
        /* Not Found / Error */
        .error .status-icon {
            background-color: #fee2e2;
            color: #dc2626;
        }
        .error .status-title { color: #dc2626; }
        
        /* Warning */
        .warning .status-icon {
            background-color: #fef3c7;
            color: #d97706;
        }
        .warning .status-title { color: #d97706; }
        
        .details {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            text-align: left;
            margin-top: 20px;
        }
        
        .detail-item {
            margin-bottom: 15px;
        }
        .detail-item:last-child {
            margin-bottom: 0;
        }
        .detail-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }
        .detail-value {
            font-size: 15px;
            color: #111827;
            font-weight: 600;
        }
        
        .footer {
            padding: 16px 24px;
            background: #1e293b;
            text-align: center;
            color: #cbd5e1;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="{{ asset('images/logo_unida-removebg-preview.png') }}" alt="Logo UNIDA">
        <h1>Sistem Verifikasi SKPI</h1>
        <p>Universitas Iskandar Muda</p>
    </div>
    
    <div class="content {{ $status === 'valid' ? 'valid' : ($status === 'not_found' ? 'error' : 'warning') }}">
        @if($status === 'valid')
            <div class="status-icon">
                <i class="fas fa-check"></i>
            </div>
            <h2 class="status-title">DOKUMEN VALID</h2>
            <p class="status-message">Surat Keterangan Pendamping Ijazah (SKPI) ini sah dan terdaftar dalam sistem Universitas Iskandar Muda.</p>
            
            <div class="details">
                <div class="detail-item">
                    <div class="detail-label">Nomor SKPI</div>
                    <div class="detail-value">{{ $skpi->nomor_skpi }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Nama Mahasiswa</div>
                    <div class="detail-value">{{ $skpi->mahasiswa->nama }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">NIM</div>
                    <div class="detail-value">{{ $skpi->mahasiswa->nim }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Program Studi</div>
                    <div class="detail-value">{{ $skpi->mahasiswa->prodi->nama_prodi ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Tanggal Pengesahan</div>
                    <div class="detail-value">{{ $skpi->tanggal_pengesahan ? \Carbon\Carbon::parse($skpi->tanggal_pengesahan)->translatedFormat('d F Y') : '-' }}</div>
                </div>
            </div>
            
        @else
            <div class="status-icon">
                <i class="fas {{ $status === 'not_found' ? 'fa-times' : 'fa-exclamation-triangle' }}"></i>
            </div>
            <h2 class="status-title">{{ $status === 'not_found' ? 'TIDAK DITEMUKAN' : 'AKSES DITOLAK' }}</h2>
            <p class="status-message">{{ $message }}</p>
        @endif
    </div>
    
    <div class="footer">
        &copy; {{ date('Y') }} Universitas Iskandar Muda. All rights reserved.
    </div>
</div>

</body>
</html>
