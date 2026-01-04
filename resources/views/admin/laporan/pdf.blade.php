<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan SKPI</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 20px;
            margin: 0 0 5px 0;
            color: #1e40af;
        }
        .header p {
            margin: 0;
            color: #64748b;
            font-size: 11px;
        }
        .stats {
            display: flex;
            margin-bottom: 20px;
        }
        .stat-item {
            background: #f8fafc;
            padding: 10px 15px;
            margin-right: 10px;
            border-left: 3px solid #3b82f6;
        }
        .stat-item strong {
            font-size: 16px;
            display: block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background: #1e40af;
            color: white;
            padding: 10px 8px;
            text-align: left;
            font-size: 11px;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }
        tr:nth-child(even) {
            background: #f8fafc;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #64748b;
        }
        .badge {
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
        }
        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN SKPI</h1>
        <p>Surat Keterangan Pendamping Ijazah</p>
        <p>Tanggal: {{ now()->format('d F Y') }}</p>
    </div>

    <div>
        <strong>Total SKPI:</strong> {{ $skpi->count() }} data
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Program Studi</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($skpi as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->mahasiswa->nim ?? '-' }}</td>
                    <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $item->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                    <td>
                        @if ($item->status == 'approved')
                            <span class="badge badge-success">Disetujui</span>
                        @elseif ($item->status == 'final_issued' || $item->status == 'final')
                            <span class="badge badge-success">Final</span>
                        @elseif($item->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @else
                            {{ ucfirst($item->status) }}
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d F Y H:i:s') }}
    </div>
</body>
</html>
