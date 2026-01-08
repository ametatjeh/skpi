@extends('prodi.layouts.app')

@section('title', 'SLA Monitoring - Prodi')
@section('page_title', 'SLA Monitoring')

@push('styles')
    <style>
        :root {
            --brand: #1e40af;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --muted: #9ca3af;
            --border: #e5e7eb;
            --card-bg: #ffffff;
            --success: #16a34a;
            --danger: #ef4444;
        }

        body {
            overflow-x: hidden;
        }

        /* Stat mini di atas */
        .sla-stat-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        .sla-stat-card {
            border-radius: 12px;
            padding: 14px 16px;
            text-align: center;
            border: 2px solid transparent;
            background: #f9fafb;
        }

        .sla-stat-value {
            font-size: 26px;
            font-weight: 800;
            margin: 6px 0;
        }

        .sla-stat-label {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .sla-stat-desc {
            font-size: 12px;
            color: var(--muted);
        }

        .sla-stat-ok {
            background: #f0fdf4;
            border-color: #06b6d4;
        }

        .sla-stat-ok .sla-stat-value,
        .sla-stat-ok .sla-stat-label {
            color: #06b6d4;
        }

        .sla-stat-bad {
            background: #fef2f2;
            border-color: #ef4444;
        }

        .sla-stat-bad .sla-stat-value,
        .sla-stat-bad .sla-stat-label {
            color: #ef4444;
        }

        /* Tabel: scroll hanya di container */
        .sla-table-container {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            border-radius: 16px;
        }

        .sla-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            min-width: 600px;
        }

        .sla-table thead {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .sla-table thead th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 700;
            font-size: 13px;
            color: var(--text-secondary);
            text-transform: uppercase;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        .sla-table tbody td {
            padding: 12px 10px;
            border-bottom: 1px solid #f1f5f9;
            color: var(--text-secondary);
            vertical-align: middle;
            white-space: nowrap;
        }

        .sla-table tbody tr:hover {
            background: #f9fafb;
        }

        @media (max-width: 768px) {
            .sla-table {
                font-size: 13px;
                min-width: 520px;
            }

            .sla-table thead th,
            .sla-table tbody td {
                padding: 10px 8px;
            }
        }

        @media (max-width: 480px) {
            .sla-table {
                font-size: 12px;
                min-width: 480px;
            }

            .sla-table thead th,
            .sla-table tbody td {
                padding: 8px 6px;
            }
        }
    </style>
@endpush

@section('content')

    <!-- Status Info -->
    <div class="sla-stat-row">
        <div class="sla-stat-card sla-stat-ok">
            <div class="sla-stat-value">{{ $stats['dalam_sla'] ?? 0 }}</div>
            <div class="sla-stat-label">Dalam SLA</div>
            <div class="sla-stat-desc">
                Masih aman ({{ $stats['sla_hari'] ?? 0 }} hari)
            </div>
        </div>

        <div class="sla-stat-card sla-stat-bad">
            <div class="sla-stat-value">{{ $stats['melebihi_sla'] ?? 0 }}</div>
            <div class="sla-stat-label">Melebihi SLA</div>
            <div class="sla-stat-desc">
                Urgent - segera proses!
            </div>
        </div>
    </div>

    <!-- Pengajuan Melebihi SLA -->
    <div class="card" style="margin-bottom: 24px;">
        <div class="card-header">
            <h3 class="card-title">⚠️ Pengajuan Melebihi SLA</h3>
        </div>

        <div class="sla-table-container">
            <table class="table sla-table">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Hari Menunggu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($melebihiSla as $item)
                        <tr>
                            <td><strong>{{ $item->mahasiswa->nim }}</strong></td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
                                <strong style="color: var(--danger);">
                                    {{ $item->created_at->diffInDays(now()) }} hari
                                </strong>
                            </td>
                            <td>
                                <a href="{{ route('prodi.verifikasi.detail', $item->id) }}" class="btn btn-danger btn-sm">
                                    <i class="fas fa-exclamation-triangle"></i> Proses Segera
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 32px; text-align: center; color: var(--success);">
                                <i class="fas fa-check-circle"
                                    style="font-size: 32px; margin-bottom: 8px; display: block;"></i>
                                <strong>Semua pengajuan dalam SLA!</strong>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pengajuan Dalam SLA -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">✅ Pengajuan Dalam SLA</h3>
        </div>

        <div class="sla-table-container">
            <table class="table sla-table">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Sisa Waktu</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dalamSla as $item)
                        <tr>
                            <td><strong>{{ $item->mahasiswa->nim }}</strong></td>
                            <td>{{ $item->mahasiswa->nama }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
                                @php
                                    $hari = ($stats['sla_hari'] ?? 0) - $item->created_at->diffInDays(now());
                                @endphp
                                <strong style="color: var(--success);">{{ $hari }} hari</strong>
                            </td>
                            <td>
                                <div
                                    style="background:#f1f5f9;border-radius:4px;height:8px;overflow:hidden;max-width:140px;">
                                    @php
                                        $total = max($stats['sla_hari'] ?? 1, 1);
                                        $progress = (($total - $hari) / $total) * 100;
                                    @endphp
                                    <div
                                        style="
                                        background: linear-gradient(90deg, var(--success) 0%, var(--brand) 100%);
                                        height:100%;
                                        width: {{ min($progress, 100) }}%;
                                    ">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 32px; text-align: center; color: var(--muted);">
                                Tidak ada pengajuan yang sedang diproses
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

