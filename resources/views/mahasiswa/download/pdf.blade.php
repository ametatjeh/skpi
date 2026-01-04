<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>SKPI - {{ $arsip->mahasiswa->nama ?? '' }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11.6px;
            margin: 38px 55px;
            color: #1f1f1f;
        }

        .kop-wrap {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 8px;
        }

        .kop-logo {
            width: 72px;
            height: auto;
        }

        .kop-title {
            font-size: 17px;
            font-weight: 700;
            color: #14244c;
        }

        .kop-address {
            font-size: 11px;
            margin-top: 2px;
            line-height: 1.4;
        }

        .nomor-kanan-box {
            margin-left: auto;
            background: #0f2f80;
            color: #fff;
            padding: 5px 22px;
            border-radius: 2px;
            font-size: 12.8px;
            font-weight: 600;
            width: fit-content;
        }

        .hr-bold {
            border-bottom: 2.3px solid #13367f;
            margin-top: 10px;
            margin-bottom: 18px;
        }

        .judul {
            text-align: left;
            font-size: 18.5px;
            font-weight: 900;
            margin-bottom: 2px;
            line-height: 1.2;
        }

        .subjudul {
            font-size: 12.2px;
            font-style: italic;
            margin-bottom: 12px;
        }

        .desc {
            font-size: 11.4px;
            margin-bottom: 6px;
        }

        .desc-italic {
            font-size: 10.9px;
            font-style: italic;
            margin-bottom: 15px;
        }

        .section-title {
            font-size: 12.7px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .section-subtitle {
            font-size: 10.8px;
            font-style: italic;
            margin-bottom: 8px;
        }

        .table-form4 {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #dcdcdc;
        }

        .table-form4 td {
            border: 1px solid #dcdcdc;
            padding: 6px 10px;
            vertical-align: top;
        }

        .gray-bg {
            background: #f7f9ff;
        }

        .label-cell {
            font-weight: 700;
            font-size: 12px;
        }

        .en-label {
            font-size: 10.5px;
            font-style: italic;
        }

        .value-bg {
            margin-top: 2px;
            padding: 5px 6px;
            background: #f2f6ff;
            font-weight: 600;
            border-radius: 2px;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="kop-wrap">
        <img src="{{ public_path('images/logo_umpar-removebg-preview.png') }}" class="kop-logo">

        <div>
            <div class="kop-title">{{ $templateSkpi->nama_pt ?? 'UNIVERSITAS MUHAMMADIYAH PAREPARE' }}</div>
            <div class="kop-address">
                {{ $templateSkpi->alamat_pt ?? 'Jl. Jend. Ahmad Yani KM. 6 Parepare 91131 Sulawesi Selatan, Indonesia' }}<br>
                Tel: (0421) 22757 - Website: www.umpar.ac.id
            </div>
        </div>
    </div>

    <div class="nomor-kanan-box">
        Nomor : {{ $arsip->nomor_skpi ?? 'SKPI/UMPAR/2025/FT-00001' }}
    </div>

    <div class="hr-bold"></div>

    <!-- TITLE -->
    <div class="judul">
        SURAT KETERANGAN<br>PENDAMPING IJAZAH
    </div>
    <div class="subjudul">Diploma Supplement</div>

    <div class="desc">
        Surat Keterangan Pendamping Ijazah (SKPI) ini mengacu pada Kerangka Kualifikasi Nasional Indonesia (KKNI) dan
        Konvensi Unesco tentang pengakuan studi, ijazah dan gelar pendidikan tinggi. Tujuan dari SKPI ini adalah menjadi
        dokumen yang menyatakan kemampuan kerja, penguasaan pengetahuan, dan sikap/moral pemegangnya.
    </div>

    <div class="desc-italic">
        This Diploma Supplement refers to the Indonesian Qualification Framework and UNESCO Convention on the
        Recognition of Studies, Diplomas and Degrees in Higher Education. The purpose of the supplement is to provide a
        description of the nature, level, context and status of the studies that were pursued and successfully completed
        by the individual named on the original qualification to which this supplement is appended.
    </div>

    <!-- SECTION 1 -->
    <div class="section-title">1. INFORMASI TENTANG IDENTITAS DIRI PEMEGANG SKPI</div>
    <div class="section-subtitle">Information Identifying the Holder of Diploma Supplement</div>

    <table class="table-form4">
        <tr>
            <td class="gray-bg">
                <span class="label-cell">NAMA LENGKAP</span> <span class="en-label">/ Full Name</span><br>
                <div class="value-bg">{{ $arsip->mahasiswa->nama ?? '-' }}</div>
            </td>
            <td class="gray-bg">
                <span class="label-cell">TANGGAL LULUS</span> <span class="en-label">/ Date of Completion</span><br>
                <div class="value-bg">
                    {{ $arsip->mahasiswa->tanggal_lulus ? $arsip->mahasiswa->tanggal_lulus->format('d M Y') : '-' }}
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <span class="label-cell">TEMPAT DAN TANGGAL LAHIR</span>
                <span class="en-label">/ Place and Date of Birth</span><br>
                <div class="value-bg">{{ $arsip->mahasiswa->tempat_tanggal_lahir ?? '-' }}</div>
            </td>
            <td>
                <span class="label-cell">NOMOR IJAZAH</span> <span class="en-label">/ Diploma Number</span><br>
                <div class="value-bg">{{ $arsip->mahasiswa->no_ijazah ?? '-' }}</div>
            </td>
        </tr>
        <tr class="gray-bg">
            <td>
                <span class="label-cell">NOMOR INDUK MAHASISWA</span>
                <span class="en-label">/ Student Identification Number</span><br>
                <div class="value-bg">{{ $arsip->mahasiswa->nim ?? '-' }}</div>
            </td>
            <td>
                <span class="label-cell">GELAR</span> <span class="en-label">/ Name of Qualification</span><br>
                <div class="value-bg">
                    {{ $arsip->mahasiswa->gelar ?? '-' }}<br>
                    <span class="en-label">{{ $arsip->mahasiswa->gelar_en ?? '' }}</span>
                </div>
            </td>
        </tr>
    </table>

    <!-- SECTION 2 -->
    <br>
    <div class="section-title">2. INFORMASI TENTANG IDENTITAS PENYELENGGARA PROGRAM</div>
    <div class="section-subtitle">Information Identifying the Awarding Institution</div>

    <table class="table-form4">
        {{-- Baris 1: SK pendirian & persyaratan penerimaan --}}
        <tr class="gray-bg">
            <td>
                <span class="label-cell">SK PENDIRIAN PERGURUAN TINGGI</span><br>
                <span class="en-label">Awarding Institution’s License</span><br>
                <div class="value-bg">{{ $templateSkpi->sk_pendirian ?? '-' }}</div>
            </td>
            <td>
                <span class="label-cell">PERSYARATAN PENERIMAAN</span><br>
                <span class="en-label">Entry Requirements</span><br>
                <div class="value-bg">{{ $templateSkpi->persyaratan_penerimaan ?? '-' }}</div>
            </td>
        </tr>

        {{-- Baris 2: Nama PT & Bahasa pengantar --}}
        <tr>
            <td>
                <span class="label-cell">NAMA PERGURUAN TINGGI</span>
                <span class="en-label">/ Name of Institution</span><br>
                <div class="value-bg">{{ $templateSkpi->nama_pt ?? 'Universitas Muhammadiyah Parepare' }}</div>
            </td>
            <td>
                <span class="label-cell">BAHASA PENGANTAR KULIAH</span><br>
                <span class="en-label">Language of Instruction</span><br>
                <div class="value-bg">{{ $templateSkpi->bahasa_pengantar ?? 'Indonesia' }}</div>
            </td>
        </tr>

        {{-- Baris 3: Status akreditasi PT & sistem penilaian --}}
        <tr class="gray-bg">
            <td>
                <span class="label-cell">STATUS AKREDITASI PERGURUAN TINGGI</span><br>
                <span class="en-label">Institution Accreditation Status</span><br>
                <div class="value-bg">{{ $templateSkpi->status_akreditasi ?? '-' }}</div>
            </td>
            <td>
                <span class="label-cell">SISTEM PENILAIAN</span><br>
                <span class="en-label">Grading System</span><br>
                <div class="value-bg">
                    {{ $templateSkpi->sistem_penilaian ?? 'Skala 1–4; A=4, B=3, C=2, D=1.' }}
                </div>
            </td>
        </tr>

        {{-- Baris 4: Nomor SK akreditasi PT & lama studi reguler --}}
        <tr>
            <td>
                <span class="label-cell">NOMOR SK AKREDITASI PERGURUAN TINGGI</span><br>
                <span class="en-label">Institution Accreditation’s Licence Number</span><br>
                <div class="value-bg">{{ $templateSkpi->nomor_sk_akreditasi ?? '-' }}</div>
            </td>
            <td>
                <span class="label-cell">LAMA STUDI REGULER</span><br>
                <span class="en-label">Regular Length of Study</span><br>
                <div class="value-bg">{{ $templateSkpi->lama_studi_reguler ?? '-' }}</div>
            </td>
        </tr>

        {{-- Baris 5: Nama program studi & jenjang kualifikasi (KKNI) --}}
        <tr class="gray-bg">
            <td>
                <span class="label-cell">NAMA PROGRAM STUDI</span><br>
                <span class="en-label">Name of Study Program</span><br>
                <div class="value-bg">
                    {{ $arsip->mahasiswa->prodi->nama_prodi ?? '-' }}<br>
                    <span class="en-label">{{ $arsip->mahasiswa->prodi->nama_prodi_en ?? '' }}</span>
                </div>
            </td>
            <td>
                <span class="label-cell">JENJANG KUALIFIKASI SESUAI KKNI</span><br>
                <span class="en-label">Level of Qualification in the National Qualification Framework</span><br>
                <div class="value-bg">
                    {{ $arsip->mahasiswa->prodi->kkni_level ?? 'Level 6' }}
                </div>
            </td>
        </tr>

        {{-- Baris 6: Status akreditasi prodi & jenis/jenjang pendidikan lanjutan --}}
        <tr>
            <td>
                <span class="label-cell">STATUS AKREDITASI PROGRAM STUDI</span><br>
                <span class="en-label">Study Program Accreditation Status</span><br>
                <div class="value-bg">
                    {{ $arsip->mahasiswa->prodi->status_akreditasi ?? '-' }}
                </div>
            </td>
            <td>
                <span class="label-cell">JENIS DAN JENJANG PENDIDIKAN LANJUTAN (BILA ADA)</span><br>
                <span class="en-label">Access and Further Study</span><br>
                <div class="value-bg">
                    {{ $arsip->mahasiswa->prodi->akses_lanjut ?? '-' }}
                </div>
            </td>
        </tr>

        {{-- Baris 7: Nomor SK akreditasi prodi & status profesi (bila ada) --}}
        <tr class="gray-bg">
            <td>
                <span class="label-cell">NOMOR SK AKREDITASI PROGRAM STUDI</span><br>
                <span class="en-label">Study Program Accreditation’s Licence Number</span><br>
                <div class="value-bg">
                    {{ $arsip->mahasiswa->prodi->nomor_sk_akreditasi ?? '-' }}
                </div>
            </td>
            <td>
                <span class="label-cell">STATUS PROFESI (BILA ADA)</span><br>
                <span class="en-label">Professional Status (If Any)</span><br>
                <div class="value-bg">
                    {{ $arsip->mahasiswa->prodi->status_profesi ?? '-' }}
                </div>
            </td>
        </tr>

        {{-- Baris 8: Jenis dan jenjang pendidikan --}}
        <tr>
            <td>
                <span class="label-cell">JENIS DAN JENJANG PENDIDIKAN</span><br>
                <span class="en-label">Type and Level of Education</span><br>
                <div class="value-bg">
                    {{ $arsip->mahasiswa->prodi->jenis_jenjang ?? 'Akademik (S1) / Academic and Bachelor Degree' }}
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>

</body>

</html>
