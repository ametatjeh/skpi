<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- SEO Meta Tags --}}
    <title>SKEMA - SKPI UNIDA | Universitas Iskandar Muda</title>
    <meta name="description" content="Skema Sertifikasi SKPI (Surat Keterangan Pendamping Ijazah) Universitas Iskandar Muda.">
    <meta name="keywords" content="SKPI, UNIDA, Skema, Universitas Iskandar Muda">
    <meta name="author" content="Universitas Iskandar Muda">
    <meta name="robots" content="index, follow">
    <meta name="language" content="Indonesian">
    <link rel="canonical" href="{{ url('skema') }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=2">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}?v=2">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #f5f5f5;
            color: #111827;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
        }
    </style>
    @include('partials.styles')
</head>

<body>

    @include('partials.header')
    <!-- CONTENT SECTION -->
    <section style="position: relative; flex: 1; min-height: calc(100vh - 200px); display: flex; flex-direction: column; align-items: center; justify-content: center; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%); padding: 40px 20px; font-family: 'Poppins', sans-serif; color: #ffffff; overflow: hidden;">
        <!-- Decorative blobs for glassmorphism effect -->
        <div style="position: absolute; top: -100px; left: -100px; width: 400px; height: 400px; background: #3b82f6; border-radius: 50%; filter: blur(120px); opacity: 0.4; z-index: 0;"></div>
        <div style="position: absolute; bottom: -150px; right: -50px; width: 500px; height: 500px; background: #8b5cf6; border-radius: 50%; filter: blur(150px); opacity: 0.3; z-index: 0;"></div>

        <style>
            .header-skema {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
                border-radius: 16px;
                padding: 18px 50px;
                margin-bottom: 50px;
                text-align: center;
                font-weight: 700;
                font-size: 1.4rem;
                letter-spacing: 2px;
                position: relative;
                z-index: 10;
            }

            .flow-container {
                display: flex;
                flex-direction: row;
                align-items: flex-start;
                gap: 24px;
                width: 100%;
                max-width: 1200px;
                overflow-x: auto;
                padding-bottom: 30px;
                position: relative;
                z-index: 10;
            }

            .flow-container::-webkit-scrollbar {
                height: 8px;
            }

            .flow-container::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.05);
                border-radius: 10px;
            }

            .flow-container::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.2);
                border-radius: 10px;
            }

            .step-wrapper {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .box {
                background: rgba(255, 255, 255, 0.07);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.15);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
                border-radius: 16px;
                padding: 12px 16px;
                min-width: 160px;
                margin-top: 10px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .box:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.4);
                border: 1px solid rgba(255, 255, 255, 0.25);
            }

            .box-title {
                text-align: center;
                font-weight: 700;
                margin-bottom: 12px;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: #e2e8f0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding-bottom: 8px;
            }

            .box ul {
                margin: 0;
                padding-left: 20px;
                font-size: 0.95rem;
                color: #cbd5e1;
            }

            .box ul li {
                margin-bottom: 6px;
            }

            .arrow-right {
                display: flex;
                align-items: center;
                font-size: 28px;
                margin: 55px -10px 0 -10px;
                color: rgba(255, 255, 255, 0.5);
                text-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
            }

            .arrow-down {
                font-size: 24px;
                margin: 12px 0 2px 0;
                color: rgba(255, 255, 255, 0.5);
            }

            .status-box {
                background: rgba(0, 0, 0, 0.2);
                border: 1px dashed rgba(255, 255, 255, 0.3);
                margin-top: 0;
            }

            .status-box ul {
                list-style-type: "- ";
                padding-left: 10px;
            }

            /* Table Styles */
            .table-container {
                width: 100%;
                max-width: 900px;
                margin-top: 50px;
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
                border-radius: 16px;
                overflow: hidden;
                position: relative;
                z-index: 10;
            }

            .table-container table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
                color: #e2e8f0;
            }

            .table-container th,
            .table-container td {
                padding: 16px 24px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .table-container th {
                background: rgba(255, 255, 255, 0.1);
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: #ffffff;
            }

            .table-container tr:last-child td {
                border-bottom: none;
            }

            .table-container tbody tr {
                transition: background 0.3s ease;
            }

            .table-container tbody tr:hover {
                background: rgba(255, 255, 255, 0.08);
            }
        </style>

        <div class="header-skema">
            ALUR PENERBITAN SKPI
        </div>

        <div class="flow-container">

            <div class="step-wrapper">
                <div class="box">
                    <div class="box-title">Mahasiswa</div>
                    <ul>
                        <li>Input Data</li>
                        <li>Upload Dokumen</li>
                        <li>Submit</li>
                    </ul>
                </div>
            </div>

            <div class="arrow-right">➔</div>

            <div class="step-wrapper">
                <div class="box">
                    <div class="box-title">Prodi</div>
                    <ul>
                        <li>Verifikasi</li>
                        <li>Buat Draft</li>
                        <li>Submit ke Fakultas</li>
                    </ul>
                </div>
                <div class="arrow-down">⬇</div>
                <div class="box status-box">
                    <div class="box-title">Status:</div>
                    <ul>
                        <li>Pending</li>
                        <li>Approved</li>
                        <li>Rejected</li>
                        <li>Revision</li>
                    </ul>
                </div>
            </div>

            <div class="arrow-right">➔</div>

            <div class="step-wrapper">
                <div class="box">
                    <div class="box-title">Fakultas</div>
                    <ul>
                        <li>Review Draft SKPI</li>
                        <li>Approve/Reject</li>
                    </ul>
                </div>
            </div>

            <div class="arrow-right">➔</div>

            <div class="step-wrapper">
                <div class="box">
                    <div class="box-title">Pusat Bahasa</div>
                    <ul>
                        <li>Verifikasi Terjemahan</li>
                        <li>Ringkasan ID/EN</li>
                    </ul>
                </div>
            </div>

            <div class="arrow-right">➔</div>

            <div class="step-wrapper">
                <div class="box">
                    <div class="box-title">Akademik</div>
                    <ul>
                        <li>QR Code</li>
                        <li>Print</li>
                        <li>Arsip</li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Tabel Kategori -->

        <div class="table-container" style="margin-top: 45px;">
            <table>
                <thead>
                    <tr>
                        <th>Peran</th>
                        <th>Deskripsi Tugas dan Tanggung Jawab</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Mahasiswa</strong></td>
                        <td>Input data kegiatan, upload dokumen pendukung, lihat status verifikasi</td>
                    </tr>
                    <tr>
                        <td><strong>Prodi</strong></td>
                        <td>Verifikasi kegiatan mahasiswa, buat draft SKPI, kelola CPL</td>
                    </tr>
                    <tr>
                        <td><strong>Fakultas</strong></td>
                        <td>Review draft SKPI dari prodi, verifikasi lanjutan, arsip</td>
                    </tr>
                    <tr>
                        <td><strong>Pusat Bahasa</strong></td>
                        <td>Verifikasi ringkasan bilingual (ID/EN), terjemahan</td>
                    </tr>
                    <tr>
                        <td><strong>Akademik</strong></td>
                        <td>Manajemen QR code, nomor surat, print blanko SKPI, serah terima berkas, arsip</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    @include('partials.footer')
</body>

</html>