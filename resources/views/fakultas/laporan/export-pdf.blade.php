<!DOCTYPE html>
<html>

<head>
    <title>Laporan SKPI</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
        }

        table th {
            background: #f0f0f0;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        .date {
            text-align: center;
            margin-bottom: 15px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <h2>Laporan Verifikasi SKPI Fakultas</h2>
    <p class="date">Tanggal Cetak: {{ now()->format('d/m/Y H:i:s') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Tgl Pengajuan</th>
                <th>Tgl Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($datas as $index => $v)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $v->mahasiswa->nim ?? '-' }}</td>
                    <td>{{ $v->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $v->mahasiswa->prodi->nama_prodi ?? '-' }}</td>
                    <td>{{ class_basename($v->verifiable_type) ?? '-' }}</td>
                    <td>{{ ucfirst($v->status) }}</td>
                    <td>{{ $v->tanggal_pengajuan?->format('d/m/Y') ?? '-' }}</td>
                    <td>{{ $v->tanggal_verifikasi?->format('d/m/Y') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
