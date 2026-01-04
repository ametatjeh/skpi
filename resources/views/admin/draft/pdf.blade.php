<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SKPI - {{ $draftSkpi->mahasiswa->nama ?? '' }}</title>
    <style>
        /* ============================================================
           SKPI PREMIUM DESIGN - NAVY BLUE & GOLD THEME
           Elegant, Professional, Academic Excellence
           ============================================================ */
        
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 9pt;
            margin: 20px 35px;
            color: #1a1a2e;
            line-height: 1.5;
        }

        /* ========== PREMIUM HEADER ========== */
        .header-container {
            border-bottom: 4px solid #1e3a5f;
            padding-bottom: 12px;
            margin-bottom: 18px;
            position: relative;
        }

        .header-container::after {\n            display: none;\n        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
            border: none;
            padding: 0;
        }

        .logo-cell {
            width: 75px;
        }

        .logo-img {
            width: 65px;
            height: auto;
        }

        .header-text {
            padding-left: 15px;
        }

        .univ-tagline {
            font-size: 8pt;
            color: #d4af37;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 2px;
        }

        .univ-name {
            font-size: 15pt;
            font-weight: 900;
            color: #1e3a5f;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .univ-address {
            font-size: 8pt;
            color: #4a5568;
            line-height: 1.4;
        }

        .skpi-number-box {
            text-align: right;
            vertical-align: bottom;
            width: 200px;
            padding-bottom: 0;
        }

        .skpi-badge {
            background: #1e3a5f;
            color: #d4af37;
            padding: 10px 16px;
            font-size: 9pt;
            font-weight: 800;
            letter-spacing: 0.3px;
            margin-top: 65px;
            border-left: 4px solid #d4af37;
        }

        /* ========== DOCUMENT TITLE ========== */
        .doc-title {
            text-align: center;
            margin: 22px 0 18px;
        }

        .doc-title h1 {
            font-size: 17pt;
            font-weight: 900;
            color: #1e3a5f;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .doc-title .subtitle {
            font-size: 11pt;
            font-style: italic;
            color: #4a5568;
        }

        .doc-title-line {
            width: 80px;
            height: 3px;
            background: #d4af37;
            margin: 10px auto 0;
        }

        /* ========== INTRO TEXT ========== */
        .intro-text {
            font-size: 9pt;
            text-align: justify;
            margin-bottom: 8px;
            line-height: 1.6;
            color: #2d3748;
            padding: 10px 14px;
            background: #fafbfc;
            border-left: 3px solid #1e3a5f;
        }

        .intro-text.english {
            font-style: italic;
            color: #5a6a7c;
            border-left-color: #a0aec0;
            margin-bottom: 18px;
        }

        /* ========== SECTION STYLING ========== */
        .section {
            margin-bottom: 14px;
        }

        .section-header {
            background: #1e3a5f;
            color: #fff;
            padding: 9px 14px;
            font-size: 10pt;
            font-weight: 700;
            margin-bottom: 0;
            position: relative;
            border-left: 5px solid #d4af37;
        }

        .section-header .english {
            font-weight: 400;
            font-style: italic;
            font-size: 8.5pt;
            opacity: 0.9;
            margin-left: 8px;
        }

        /* ========== DATA TABLE MODERN ========== */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            border: 1px solid #d1d5db;
            border-top: none;
        }

        .data-table td {
            border: 1px solid #e5e7eb;
            padding: 10px 12px;
            vertical-align: top;
            font-size: 9pt;
        }

        .data-table tr:nth-child(odd) td {
            background: #fafbfc;
        }

        .data-table tr:nth-child(even) td {
            background: #fff;
        }

        .field-label {
            font-weight: 700;
            color: #1e3a5f;
            font-size: 8.5pt;
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .field-label-en {
            font-size: 7pt;
            font-style: italic;
            color: #718096;
            font-weight: 400;
            text-transform: none;
        }

        .field-value {
            margin-top: 5px;
            padding: 5px 10px;
            background: #e8f0f8;
            border-left: 3px solid #1e3a5f;
            font-weight: 600;
            color: #1a202c;
        }

        /* ========== SUBSECTION (CPL) ========== */
        .subsection-title {
            font-size: 10pt;
            font-weight: 700;
            color: #1e3a5f;
            margin: 12px 0 5px 0;
            padding-bottom: 4px;
            border-bottom: 2px solid #d4af37;
            display: inline-block;
        }

        .subsection-title .en {
            font-weight: 400;
            font-style: italic;
            font-size: 8.5pt;
            color: #718096;
        }

        .cpl-content {
            font-size: 9pt;
            line-height: 1.6;
            text-align: justify;
            margin-bottom: 12px;
            padding: 10px 14px;
            background: #f8fafc;
            border-left: 4px solid #1e3a5f;
        }

        /* ========== ACTIVITIES SECTION ========== */
        .activities-container {
            border: 2px solid #1e3a5f;
            overflow: hidden;
            margin-bottom: 14px;
        }

        .activities-header {
            background: #1e3a5f;
            color: #fff;
            padding: 9px 14px;
            font-size: 10pt;
            font-weight: 700;
            border-left: 5px solid #d4af37;
        }

        .activities-header .gold {
            color: #d4af37;
        }

        .activities-body {
            padding: 14px 16px;
            background: #fff;
        }

        .activity-category {
            margin-bottom: 12px;
        }

        .activity-title {
            font-weight: 700;
            font-size: 9pt;
            color: #1e3a5f;
            margin-bottom: 5px;
            padding-bottom: 3px;
            border-bottom: 2px solid #d4af37;
            display: inline-block;
        }

        .activity-title-en {
            font-weight: 600;
            font-style: italic;
            color: #5a6a7c;
            font-size: 8.5pt;
            margin-bottom: 5px;
        }

        .activity-list {
            font-size: 8.5pt;
            line-height: 1.6;
            padding-left: 12px;
            color: #2d3748;
        }

        .activity-item {
            margin-bottom: 3px;
            padding-left: 10px;
            position: relative;
        }

        .activity-item::before {
            content: '●';
            position: absolute;
            left: 0;
            color: #d4af37;
            font-size: 6pt;
        }

        /* ========== INFO BOX ========== */
        .info-box {
            background: #fef9e7;
            border: 1px solid #d4af37;
            padding: 12px 16px;
            font-size: 9pt;
            margin-bottom: 12px;
        }

        .info-box.english {
            font-style: italic;
            background: #f8f9fa;
            border-color: #c9ccd1;
        }

        /* ========== SIGNATURE SECTION ========== */
        .signature-section {
            margin-top: 10px;
            page-break-inside: avoid;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            vertical-align: top;
            padding: 10px;
        }

        .signature-right {
            text-align: left;
            width: 45%;
        }

        .sig-location {
            font-size: 9pt;
            margin-bottom: 3px;
            color: #1a202c;
        }

        .sig-location-en {
            font-size: 8pt;
            font-style: italic;
            color: #5a6a7c;
            margin-bottom: 10px;
        }

        .sig-title {
            font-size: 10pt;
            font-weight: 700;
            color: #1e3a5f;
        }

        .sig-title-en {
            font-size: 8pt;
            font-style: italic;
            color: #5a6a7c;
        }

        .sig-space {
            height: 40px;
        }

        .sig-name {
            font-size: 10pt;
            font-weight: 800;
            text-decoration: underline;
            color: #1e3a5f;
        }

        /* ========== NOTES SECTION ========== */
        .notes-section {
            border-top: 3px solid #1e3a5f;
            margin-top: 10px;
            padding-top: 8px;
        }

        .notes-table {
            width: 100%;
            border-collapse: collapse;
        }

        .notes-table td {
            vertical-align: top;
            padding: 5px 8px;
            font-size: 7.5pt;
            line-height: 1.4;
        }

        .notes-title {
            font-weight: 700;
            font-size: 8pt;
            color: #1e3a5f;
            margin-bottom: 4px;
            padding-bottom: 2px;
            border-bottom: 2px solid #d4af37;
            display: inline-block;
        }

        .notes-list {
            color: #4a5568;
            font-size: 7.5pt;
        }

        .contact-box {
            background: #f0f5fa;
            padding: 8px;
            border: 1px solid #1e3a5f;
        }

        .contact-name {
            font-weight: 800;
            font-size: 8pt;
            color: #1e3a5f;
            margin-bottom: 2px;
        }

        .contact-name-en {
            font-style: italic;
            font-size: 7pt;
            color: #5a6a7c;
            margin-bottom: 5px;
        }

        /* ========== APPROVAL PAGE ========== */
        .approval-page {
            padding-top: 25px;
            margin-top: 20px;
        }

        .approval-badge {
            display: inline-block;
            background: #1e3a5f;
            color: #d4af37;
            padding: 10px 20px;
            font-size: 10pt;
            font-weight: 800;
            border-left: 5px solid #d4af37;
        }

        .approval-title {
            text-align: center;
            font-size: 20pt;
            font-weight: 900;
            color: #1e3a5f;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 25px;
        }

        .approval-title-line {
            display: none;
        }

        .approval-table {
            width: 100%;
            border-collapse: collapse;
            border: 3px solid #1e3a5f;
        }

        .approval-table td {
            border: 1px solid #d1d5db;
            padding: 12px 14px;
            vertical-align: top;
            font-size: 9pt;
        }

        .approval-label {
            width: 25%;
            font-weight: 700;
            background: #f0f5fa;
            color: #1e3a5f;
        }

        .approval-content {
            width: 75%;
            background: #fff;
        }

        .approval-role {
            font-weight: 600;
            font-size: 9pt;
            color: #4a5568;
            margin-bottom: 70px;
        }

        .approval-name {
            font-weight: 800;
            font-size: 10pt;
            text-decoration: underline;
            color: #1e3a5f;
        }

        .approval-nip {
            font-size: 8.5pt;
            color: #4a5568;
            margin-top: 4px;
        }

        /* ========== PAGE BREAK ========== */
        .page-break {
            page-break-after: always;
        }

        @page {
            margin: 18mm 12mm;
            size: A4;
        }

        /* Prevent orphans */
        .section, .activity-category, .cpl-content {
            page-break-inside: avoid;
        }
    </style>
</head>

<body>

    <!-- ========== HEADER ========== -->
    <div class="header-container">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <img src="{{ public_path('images/logo_umpar-removebg-preview.png') }}" alt="Logo" class="logo-img">
                </td>
                <td class="header-text">
                    <div class="univ-name">Universitas Muhammadiyah Parepare</div>
                    <div class="univ-address">
                        Jl. Jend. Ahmad Yani KM. 6 Parepare 91131, Sulawesi Selatan, Indonesia<br>
                        Tel: (0421) 22757 • Fax: (0421) 22757 • www.umpar.ac.id
                    </div>
                </td>
                <td class="skpi-number-box">
                    <div class="skpi-badge">
                        {{ $draftSkpi->nomor_skpi ?? 'SKPI/UMPAR/2025/FT-00001' }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- ========== DOCUMENT TITLE ========== -->
    <div class="doc-title">
        <h1>Surat Keterangan Pendamping Ijazah</h1>
        <div class="subtitle">Diploma Supplement</div>
    </div>

    <!-- ========== INTRO ========== -->
    <div class="intro-text">
        Surat Keterangan Pendamping Ijazah (SKPI) ini mengacu pada Kerangka Kualifikasi Nasional Indonesia (KKNI) dan
        Konvensi UNESCO tentang pengakuan studi, ijazah dan gelar pendidikan tinggi. Tujuan dari SKPI ini adalah menjadi
        dokumen yang menyatakan kemampuan kerja, penguasaan pengetahuan, dan sikap/moral pemegangnya.
    </div>

    <div class="intro-text english">
        This Diploma Supplement refers to the Indonesian Qualification Framework and UNESCO Convention on the
        Recognition of Studies, Diplomas and Degrees in Higher Education. The purpose of the supplement is to provide a
        description of the nature, level, context and status of the studies that were pursued and successfully completed
        by the individual named on the original qualification to which this supplement is appended.
    </div>

    <!-- ========== SECTION 1: IDENTITY ========== -->
    <div class="section">
        <div class="section-header">
            1. INFORMASI TENTANG IDENTITAS DIRI PEMEGANG SKPI
            <span class="english">/ Information Identifying the Holder</span>
        </div>
        <table class="data-table">
            <tr>
                <td style="width: 50%;">
                    <div class="field-label">NAMA LENGKAP <span class="field-label-en">/ Full Name</span></div>
                    <div class="field-value">{{ $draftSkpi->mahasiswa->nama ?? '-' }}</div>
                </td>
                <td style="width: 50%;">
                    <div class="field-label">TANGGAL LULUS <span class="field-label-en">/ Date of Completion</span></div>
                    <div class="field-value">
                        {{ $draftSkpi->mahasiswa->tanggal_lulus ? $draftSkpi->mahasiswa->tanggal_lulus->format('d M Y') : '-' }}
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">TEMPAT & TANGGAL LAHIR <span class="field-label-en">/ Place and Date of Birth</span></div>
                    <div class="field-value">{{ $draftSkpi->mahasiswa->tempat_tanggal_lahir ?? '-' }}</div>
                </td>
                <td>
                    <div class="field-label">NOMOR IJAZAH <span class="field-label-en">/ Diploma Number</span></div>
                    <div class="field-value">{{ $draftSkpi->mahasiswa->no_ijazah ?? '-' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">NOMOR INDUK MAHASISWA <span class="field-label-en">/ Student ID Number</span></div>
                    <div class="field-value">{{ $draftSkpi->mahasiswa->nim ?? '-' }}</div>
                </td>
                <td>
                    <div class="field-label">GELAR <span class="field-label-en">/ Name of Qualification</span></div>
                    <div class="field-value">
                        {{ $draftSkpi->mahasiswa->gelar ?? '-' }}
                        @if(!empty($draftSkpi->mahasiswa->gelar_en))
                            <br><span class="field-label-en">{{ $draftSkpi->mahasiswa->gelar_en }}</span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- ========== SECTION 2: INSTITUTION ========== -->
    <div class="section">
        <div class="section-header">
            2. INFORMASI TENTANG IDENTITAS PENYELENGGARA PROGRAM
            <span class="english">/ Information Identifying the Awarding Institution</span>
        </div>
        <table class="data-table">
            <tr>
                <td style="width: 50%;">
                    <div class="field-label">SK PENDIRIAN PT <span class="field-label-en">/ Institution's License</span></div>
                    <div class="field-value">{{ $templateSkpi->sk_pendirian ?? '-' }}</div>
                </td>
                <td>
                    <div class="field-label">PERSYARATAN PENERIMAAN <span class="field-label-en">/ Entry Requirements</span></div>
                    <div class="field-value">{{ $templateSkpi->persyaratan_penerimaan ?? '-' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">NAMA PERGURUAN TINGGI <span class="field-label-en">/ Name of Institution</span></div>
                    <div class="field-value">{{ $templateSkpi->nama_pt ?? 'Universitas Muhammadiyah Parepare' }}</div>
                </td>
                <td>
                    <div class="field-label">BAHASA PENGANTAR <span class="field-label-en">/ Language of Instruction</span></div>
                    <div class="field-value">{{ $templateSkpi->bahasa_pengantar ?? 'Indonesia' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">STATUS AKREDITASI PT <span class="field-label-en">/ Institution Accreditation</span></div>
                    <div class="field-value">{{ $templateSkpi->status_akreditasi ?? '-' }}</div>
                </td>
                <td>
                    <div class="field-label">SISTEM PENILAIAN <span class="field-label-en">/ Grading System</span></div>
                    <div class="field-value">{{ $templateSkpi->sistem_penilaian ?? 'Skala 1–4; A=4, B=3, C=2, D=1' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">NO. SK AKREDITASI PT <span class="field-label-en">/ Accreditation Decree Number</span></div>
                    <div class="field-value">{{ $templateSkpi->nomor_sk_akreditasi ?? '-' }}</div>
                </td>
                <td>
                    <div class="field-label">LAMA STUDI REGULER <span class="field-label-en">/ Regular Length of Study</span></div>
                    <div class="field-value">{{ $templateSkpi->lama_studi_reguler ?? '-' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">NAMA PROGRAM STUDI <span class="field-label-en">/ Study Program</span></div>
                    <div class="field-value">
                        {{ $draftSkpi->mahasiswa->prodi->nama_prodi ?? '-' }}
                        @if(!empty($draftSkpi->mahasiswa->prodi->nama_prodi_en))
                            <br><span class="field-label-en">{{ $draftSkpi->mahasiswa->prodi->nama_prodi_en }}</span>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="field-label">JENJANG KKNI <span class="field-label-en">/ KKNI Level</span></div>
                    <div class="field-value">{{ $draftSkpi->mahasiswa->prodi->kkni_level ?? 'Level 6' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">STATUS AKREDITASI PRODI <span class="field-label-en">/ Program Accreditation</span></div>
                    <div class="field-value">{{ $draftSkpi->mahasiswa->prodi->status_akreditasi ?? '-' }}</div>
                </td>
                <td>
                    <div class="field-label">PENDIDIKAN LANJUTAN <span class="field-label-en">/ Further Study</span></div>
                    <div class="field-value">{{ $draftSkpi->mahasiswa->prodi->akses_lanjut ?? '-' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="field-label">NO. SK AKREDITASI PRODI <span class="field-label-en">/ Program Accreditation Decree</span></div>
                    <div class="field-value">{{ $draftSkpi->mahasiswa->prodi->nomor_sk_akreditasi ?? '-' }}</div>
                </td>
                <td>
                    <div class="field-label">STATUS PROFESI <span class="field-label-en">/ Professional Status</span></div>
                    <div class="field-value">{{ $draftSkpi->mahasiswa->prodi->status_profesi ?? '-' }}</div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="field-label">JENIS DAN JENJANG PENDIDIKAN <span class="field-label-en">/ Type and Level of Education</span></div>
                    <div class="field-value">{{ $draftSkpi->mahasiswa->prodi->jenis_jenjang ?? 'Akademik (S1) / Academic and Bachelor Degree' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- ========== SECTION 3: LEARNING OUTCOMES ========== -->
    <div class="section">
        <div class="section-header">
            3. INFORMASI TENTANG KUALIFIKASI DAN HASIL YANG DICAPAI
            <span class="english">/ Information on Qualification and Outcomes</span>
        </div>

        <div class="subsection-title">
            A. Capaian Pembelajaran <span class="en">/ Learning Outcomes</span>
        </div>

        <div class="subsection-title" style="font-size: 9pt; border-bottom: 1px solid #e2e8f0;">
            Sikap <span class="en">/ Attitude</span>
        </div>
        <div class="cpl-content">{{ $cplData['sikap'] ?? '-' }}</div>

        <div class="subsection-title" style="font-size: 9pt; border-bottom: 1px solid #e2e8f0;">
            Pengetahuan <span class="en">/ Knowledge</span>
        </div>
        <div class="cpl-content">{{ $cplData['pengetahuan'] ?? '-' }}</div>

        <div class="subsection-title" style="font-size: 9pt; border-bottom: 1px solid #e2e8f0;">
            Keterampilan Umum <span class="en">/ General Skills</span>
        </div>
        <div class="cpl-content">{{ $cplData['keterampilan_umum'] ?? '-' }}</div>

        <div class="subsection-title" style="font-size: 9pt; border-bottom: 1px solid #e2e8f0;">
            Keterampilan Khusus <span class="en">/ Specific Skills</span>
        </div>
        <div class="cpl-content">{{ $cplData['keterampilan_khusus'] ?? '-' }}</div>
    </div>

    <!-- ========== SECTION 3B: ACTIVITIES ========== -->
    <div class="activities-container">
        <div class="activities-header">
            B. Aktivitas, Prestasi dan Penghargaan <span class="gold">/ Activity, Achievement and Award</span>
        </div>
        <div class="activities-body">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; vertical-align: top; padding-right: 15px;">
                        <!-- Indonesian -->
                        <div class="activity-category">
                            <div class="activity-title">1. Sertifikasi Kompetensi</div>
                            <div class="activity-list">
                                @if ($sertifikasi && $sertifikasi->count() > 0)
                                    @foreach ($sertifikasi as $item)
                                        <div class="activity-item">• {{ $item->nama_sertifikasi ?? '-' }}</div>
                                    @endforeach
                                @else
                                    <div class="activity-item">-</div>
                                @endif
                            </div>
                        </div>

                        <div class="activity-category">
                            <div class="activity-title">2. Pengembangan Sikap dan Tanggung Jawab</div>
                            <div class="activity-list">
                                @if ($pkm && $pkm->count() > 0)
                                    @foreach ($pkm as $item)
                                        <div class="activity-item">• {{ $item->judul_pkm ?? '-' }}</div>
                                    @endforeach
                                @else
                                    <div class="activity-item">-</div>
                                @endif
                            </div>
                        </div>

                        <div class="activity-category">
                            <div class="activity-title">3. Prestasi dan Penghargaan</div>
                            <div class="activity-list">
                                @php
                                    $prestasiDanPenghargaan = collect();
                                    if ($prestasi) $prestasiDanPenghargaan = $prestasiDanPenghargaan->merge($prestasi);
                                    if (isset($penghargaan) && $penghargaan) $prestasiDanPenghargaan = $prestasiDanPenghargaan->merge($penghargaan);
                                @endphp
                                @if ($prestasiDanPenghargaan->count() > 0)
                                    @foreach ($prestasiDanPenghargaan as $item)
                                        <div class="activity-item">• {{ $item->nama_kegiatan ?? ($item->nama_penghargaan ?? '-') }}</div>
                                    @endforeach
                                @else
                                    <div class="activity-item">-</div>
                                @endif
                            </div>
                        </div>

                        <div class="activity-category">
                            <div class="activity-title">4. Pengalaman Organisasi</div>
                            <div class="activity-list">
                                @if ($organisasi && $organisasi->count() > 0)
                                    @foreach ($organisasi as $item)
                                        <div class="activity-item">• {{ $item->nama_organisasi ?? '-' }}</div>
                                    @endforeach
                                @else
                                    <div class="activity-item">-</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="width: 50%; vertical-align: top; padding-left: 15px; border-left: 1px solid #e2e8f0;">
                        <!-- English -->
                        <div class="activity-category">
                            <div class="activity-title-en">1. Competency Certification</div>
                            <div class="activity-list" style="font-style: italic;">
                                @if ($sertifikasi && $sertifikasi->count() > 0)
                                    @foreach ($sertifikasi as $item)
                                        <div class="activity-item">• {{ $item->nama_sertifikasi_en ?? ($item->nama_sertifikasi ?? '-') }}</div>
                                    @endforeach
                                @else
                                    <div class="activity-item">-</div>
                                @endif
                            </div>
                        </div>

                        <div class="activity-category">
                            <div class="activity-title-en">2. Attitude Development and Responsibility</div>
                            <div class="activity-list" style="font-style: italic;">
                                @if ($pkm && $pkm->count() > 0)
                                    @foreach ($pkm as $item)
                                        <div class="activity-item">• {{ $item->judul_pkm_en ?? ($item->judul_pkm ?? '-') }}</div>
                                    @endforeach
                                @else
                                    <div class="activity-item">-</div>
                                @endif
                            </div>
                        </div>

                        <div class="activity-category">
                            <div class="activity-title-en">3. Achievement and Accolades</div>
                            <div class="activity-list" style="font-style: italic;">
                                @if ($prestasiDanPenghargaan->count() > 0)
                                    @foreach ($prestasiDanPenghargaan as $item)
                                        <div class="activity-item">• {{ $item->nama_kegiatan_en ?? ($item->nama_penghargaan_en ?? ($item->nama_kegiatan ?? ($item->nama_penghargaan ?? '-'))) }}</div>
                                    @endforeach
                                @else
                                    <div class="activity-item">-</div>
                                @endif
                            </div>
                        </div>

                        <div class="activity-category">
                            <div class="activity-title-en">4. Organizational Experience</div>
                            <div class="activity-list" style="font-style: italic;">
                                @if ($organisasi && $organisasi->count() > 0)
                                    @foreach ($organisasi as $item)
                                        <div class="activity-item">• {{ $item->nama_organisasi_en ?? ($item->nama_organisasi ?? '-') }}</div>
                                    @endforeach
                                @else
                                    <div class="activity-item">-</div>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- ========== PAGE BREAK ========== -->
    <div class="page-break"></div>

    <!-- ========== SECTION 4: KKNI INFO ========== -->
    <div class="section">
        <div class="section-header">
            4. INFORMASI TENTANG SISTEM PENDIDIKAN TINGGI DAN KKNI
            <span class="english">/ Information on Higher Education System</span>
        </div>
        <div class="info-box">
            Informasi tentang sistem pendidikan tinggi dan Kerangka Kualifikasi Nasional Indonesia (KKNI) dapat
            dilihat di http://umpar.ac.id/kkni/
        </div>
        <div class="info-box english">
            The information on the Higher Education System and the Indonesian National Qualification Framework can
            be accessed at http://umpar.ac.id/kkni/
        </div>
    </div>

    <!-- ========== SECTION 5: LEGALIZATION ========== -->
    <div class="section">
        <div class="section-header">
            5. PENGESAHAN SKPI
            <span class="english">/ Diploma Supplement Legalization</span>
        </div>
    </div>

    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td style="width: 55%;"></td>
                <td class="signature-right">
                    <div class="sig-location">
                        Parepare, {{ $draftSkpi->tanggal_pengesahan ? \Carbon\Carbon::parse($draftSkpi->tanggal_pengesahan)->locale('id')->translatedFormat('d F Y') : now()->locale('id')->translatedFormat('d F Y') }}
                    </div>
                    <div class="sig-location-en">
                        Parepare, {{ $draftSkpi->tanggal_pengesahan ? \Carbon\Carbon::parse($draftSkpi->tanggal_pengesahan)->format('F d, Y') : now()->format('F d, Y') }}
                    </div>
                    <br>
                    <div class="sig-title">DEKAN FAKULTAS</div>
                    <div class="sig-title-en">Dean of Faculty</div>
                    <div class="sig-space"></div>
                    <div class="sig-name">{{ $draftSkpi->mahasiswa->prodi->fakultas->dekan ?? 'Dekan Fakultas' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <!-- ========== NOTES & CONTACT (SAME PAGE AS SECTION 5) ========== -->
    <div class="notes-section">
        <table class="notes-table">
            <tr>
                <td style="width: 55%; vertical-align: top;">
                    <div class="notes-title">Catatan Resmi</div>
                    <div class="notes-list">
                        • SKPI dikeluarkan oleh institusi pendidikan tinggi yang berwenang.<br>
                        • SKPI hanya diterbitkan setelah mahasiswa dinyatakan lulus secara resmi.<br>
                        • SKPI diterbitkan dalam Bahasa Indonesia dan Bahasa Inggris.<br>
                        • SKPI asli diterbitkan menggunakan kertas khusus (barcode/hologram).<br>
                        • Penerima SKPI dicantumkan dalam situs resmi Perguruan Tinggi.
                    </div>
                    <br>
                    <div class="notes-title" style="font-style: italic;">Official Notes</div>
                    <div class="notes-list" style="font-style: italic;">
                        • This Diploma Supplement is issued by UMPAR University.<br>
                        • Issued after the student is officially declared a graduate.<br>
                        • Written in both Bahasa Indonesia and English.<br>
                        • Original copy is on barcoded/hologram security paper.<br>
                        • Awardee is officially listed in the University's website.
                    </div>
                </td>
                <td style="width: 45%; vertical-align: top;">
                    <div class="contact-box">
                        <div class="notes-title">ALAMAT <span style="font-weight: 400; font-style: italic;">/ Contact Details</span></div>
                        <br>
                        <div class="contact-name">UNIVERSITAS MUHAMMADIYAH PAREPARE</div>
                        <div class="contact-name-en">Muhammadiyah University of Parepare</div>
                        <div class="notes-list">
                            Jl. Jend. Ahmad Yani KM. 6<br>
                            Parepare 91131<br>
                            Sulawesi Selatan, Indonesia<br><br>
                            Tel: (0421) 22757<br>
                            Website: www.umpar.ac.id<br>
                            Email: umpar@umpar.ac.id
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>