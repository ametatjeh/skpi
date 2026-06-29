@extends('admin.layouts.app')

@section('title', 'Preview SKPI - ' . ($draftSkpi->mahasiswa->nama ?? ''))
@section('page_title', 'Preview SKPI')
@section('page_icon', 'file-alt')

@section('content')

    <style>
        /* ========================================
           PREVIEW SKPI - TEMA HIJAU
           ======================================== */

        .content-wrapper {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .breadcrumb-nav {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .breadcrumb-nav a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .breadcrumb-nav a:hover {
            color: #059669;
            text-decoration: underline;
        }

        .breadcrumb-nav .separator {
            color: #cbd5e1;
        }

        .breadcrumb-nav .current {
            color: #1e293b;
            font-weight: 600;
        }

        /* Action Bar */
        .action-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 28px;
            padding: 16px 24px;
            background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
            border: 1px solid #bbf7d0;
            border-radius: 14px;
        }

        .action-bar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .action-bar-left .icon-box {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #10b981, #34d399);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
        }

        .action-bar-left h2 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .action-bar-left p {
            font-size: 13px;
            color: #64748b;
            margin: 2px 0 0;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
        }

        .btn-back {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .btn-back:hover {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-pdf {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
        }

        .btn-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
        }

        .btn-print {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.35);
        }

        /* SKPI Preview Container */
        .skpi-preview {
            background: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 40px;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
        }

        /* Section Styles */
        .skpi-section {
            margin-bottom: 28px;
        }

        .skpi-section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 14px;
            padding-bottom: 8px;
            border-bottom: 2px solid #10b981;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .skpi-section-title i {
            color: #10b981;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-label {
            font-size: 12px;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
        }

        /* Data Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .data-table thead th {
            padding: 12px 14px;
            text-align: left;
            font-weight: 700;
            color: #374151;
            border-bottom: 2px solid #e5e7eb;
            background: #f8fafc;
            white-space: nowrap;
        }

        .data-table tbody td {
            padding: 10px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #4b5563;
        }

        .data-table tbody tr:hover {
            background: #f0fdf4;
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* CPL List */
        .cpl-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cpl-item {
            padding: 10px 14px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            gap: 12px;
        }

        .cpl-item:last-child {
            border-bottom: none;
        }

        .cpl-code {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 60px;
            height: 28px;
            background: linear-gradient(135deg, #10b981, #34d399);
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            border-radius: 6px;
            flex-shrink: 0;
        }

        .cpl-desc {
            font-size: 13px;
            color: #4b5563;
            line-height: 1.5;
        }

        /* Ringkasan Bilingual */
        .bilingual-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
        }

        .bilingual-label {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .bilingual-text {
            font-size: 14px;
            color: #1e293b;
            line-height: 1.7;
            white-space: pre-line;
        }

        /* No Data */
        .no-data {
            text-align: center;
            padding: 24px;
            color: #9ca3af;
            font-style: italic;
            font-size: 13px;
        }

        /* Print Styles */
        @media print {
            .breadcrumb-nav,
            .action-bar {
                display: none !important;
            }

            .content-wrapper {
                box-shadow: none;
                padding: 0;
            }

            .skpi-preview {
                border: none;
                box-shadow: none;
                padding: 0;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-bar {
                flex-direction: column;
                text-align: center;
            }

            .action-buttons {
                justify-content: center;
            }

            .skpi-preview {
                padding: 20px;
            }
        }
    </style>

    <div class="content-wrapper">
        <!-- Breadcrumb -->
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
            <span class="separator">/</span>
            <a href="{{ url('/admin/skpi/draft') }}">Draft SKPI</a>
            <span class="separator">/</span>
            <span class="current">Preview</span>
        </div>

        <!-- Action Bar -->
        <div class="action-bar">
            <div class="action-bar-left">
                <div class="icon-box">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div>
                    <h2>Preview SKPI - {{ $draftSkpi->mahasiswa->nama ?? '' }}</h2>
                    <p>{{ $draftSkpi->nomor_skpi ?? 'Nomor belum ditetapkan' }} &bull; Status: {{ ucfirst(str_replace('_', ' ', $draftSkpi->status ?? '-')) }}</p>
                </div>
            </div>
            <div class="action-buttons">
                <a href="javascript:history.back()" class="btn-action btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                @if($draftSkpi->status === 'final_issued')
                    <a href="{{ url('/admin/skpi/final/' . $draftSkpi->id . '/pdf') }}" class="btn-action btn-pdf">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                @endif
                <button onclick="window.print()" class="btn-action btn-print">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>
        </div>

        <!-- SKPI Preview -->
        <div class="skpi-preview">
            <!-- Bagian 1: Data Mahasiswa -->
            <div class="skpi-section">
                <div class="skpi-section-title">
                    <i class="fas fa-user-graduate"></i>
                    Informasi Pemilik SKPI
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $draftSkpi->mahasiswa->nama ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">NIM</span>
                        <span class="info-value">{{ $draftSkpi->mahasiswa->nim ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Program Studi</span>
                        <span class="info-value">{{ $draftSkpi->mahasiswa->prodi->nama_prodi ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fakultas</span>
                        <span class="info-value">{{ $draftSkpi->mahasiswa->prodi->fakultas->nama_fakultas ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tempat, Tanggal Lahir</span>
                        <span class="info-value">{{ $draftSkpi->mahasiswa->tempat_tanggal_lahir ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Masuk</span>
                        <span class="info-value">{{ $draftSkpi->mahasiswa->tanggal_masuk ? $draftSkpi->mahasiswa->tanggal_masuk->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Lulus</span>
                        <span class="info-value">{{ $draftSkpi->mahasiswa->tanggal_lulus ? $draftSkpi->mahasiswa->tanggal_lulus->format('d M Y') : '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nomor Ijazah</span>
                        <span class="info-value">{{ $draftSkpi->mahasiswa->no_ijazah ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Bagian 2: Capaian Pembelajaran Lulusan (CPL) -->
            <div class="skpi-section">
                <div class="skpi-section-title">
                    <i class="fas fa-book"></i>
                    Capaian Pembelajaran Lulusan (CPL)
                </div>
                @if(isset($cplData) && count($cplData) > 0)
                    <ul class="cpl-list">
                        @foreach($cplData as $cpl)
                            <li class="cpl-item">
                                <span class="cpl-code">{{ $cpl['kode'] ?? $cpl->kode_cpl ?? '-' }}</span>
                                <span class="cpl-desc">{{ $cpl['deskripsi'] ?? $cpl->deskripsi_id ?? '-' }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="no-data">Belum ada data CPL</div>
                @endif
            </div>

            <!-- Bagian 3: Sertifikasi Kompetensi -->
            <div class="skpi-section">
                <div class="skpi-section-title">
                    <i class="fas fa-certificate"></i>
                    Sertifikasi Kompetensi
                </div>
                @if(isset($sertifikasi) && $sertifikasi->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sertifikasi</th>
                                <th>Lembaga Penerbit</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sertifikasi as $i => $sert)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $sert->nama_sertifikasi ?? '-' }}</td>
                                    <td>{{ $sert->lembaga_penerbit ?? '-' }}</td>
                                    <td>{{ $sert->tahun ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-data">Tidak ada data sertifikasi</div>
                @endif
            </div>

            <!-- Bagian 4: Prestasi -->
            <div class="skpi-section">
                <div class="skpi-section-title">
                    <i class="fas fa-trophy"></i>
                    Prestasi
                </div>
                @if(isset($prestasi) && $prestasi->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Prestasi</th>
                                <th>Tingkat</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prestasi as $i => $pres)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $pres->nama_prestasi ?? '-' }}</td>
                                    <td>{{ $pres->tingkat ?? '-' }}</td>
                                    <td>{{ $pres->tahun ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-data">Tidak ada data prestasi</div>
                @endif
            </div>

            <!-- Bagian 5: Organisasi -->
            <div class="skpi-section">
                <div class="skpi-section-title">
                    <i class="fas fa-users"></i>
                    Pengalaman Organisasi
                </div>
                @if(isset($organisasi) && $organisasi->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Organisasi</th>
                                <th>Jabatan</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organisasi as $i => $org)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $org->nama_organisasi ?? '-' }}</td>
                                    <td>{{ $org->jabatan ?? '-' }}</td>
                                    <td>{{ $org->tahun ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-data">Tidak ada data organisasi</div>
                @endif
            </div>

            <!-- Bagian 6: Pengabdian Masyarakat -->
            <div class="skpi-section">
                <div class="skpi-section-title">
                    <i class="fas fa-hands-helping"></i>
                    Pengabdian Kepada Masyarakat
                </div>
                @if(isset($pkm) && $pkm->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Peran</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pkm as $i => $p)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $p->nama_kegiatan ?? '-' }}</td>
                                    <td>{{ $p->peran ?? '-' }}</td>
                                    <td>{{ $p->tahun ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-data">Tidak ada data pengabdian masyarakat</div>
                @endif
            </div>

            <!-- Bagian 7: Penghargaan -->
            <div class="skpi-section">
                <div class="skpi-section-title">
                    <i class="fas fa-award"></i>
                    Penghargaan
                </div>
                @if(isset($penghargaan) && $penghargaan->count() > 0)
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penghargaan</th>
                                <th>Pemberi</th>
                                <th>Tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penghargaan as $i => $ph)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $ph->nama_penghargaan ?? '-' }}</td>
                                    <td>{{ $ph->pemberi ?? '-' }}</td>
                                    <td>{{ $ph->tahun ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-data">Tidak ada data penghargaan</div>
                @endif
            </div>

            <!-- Bagian 8: Ringkasan -->
            @if($draftSkpi->ringkasan_id || $draftSkpi->ringkasan_en)
                <div class="skpi-section">
                    <div class="skpi-section-title">
                        <i class="fas fa-align-left"></i>
                        Ringkasan / Summary
                    </div>
                    <div style="display:flex;flex-direction:column;gap:16px;">
                        @if($draftSkpi->ringkasan_id)
                            <div class="bilingual-section">
                                <div class="bilingual-label">Bahasa Indonesia</div>
                                <div class="bilingual-text">{{ $draftSkpi->ringkasan_id }}</div>
                            </div>
                        @endif
                        @if($draftSkpi->ringkasan_en)
                            <div class="bilingual-section">
                                <div class="bilingual-label">English</div>
                                <div class="bilingual-text">{{ $draftSkpi->ringkasan_en }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
