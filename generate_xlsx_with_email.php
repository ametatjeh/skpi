<?php
require 'vendor/autoload.php';

// Bootstrap Laravel so we can access Models and DB
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use App\Models\Prodi;

$spreadsheet = new Spreadsheet();

// 1. Create Reference Sheet for Prodi
$refSheet = $spreadsheet->createSheet();
$refSheet->setTitle('Referensi');

$prodis = Prodi::orderBy('nama_prodi')->pluck('nama_prodi')->toArray();
$prodiCount = count($prodis);

// Put prodi data into the Reference sheet (Column A)
$row = 1;
foreach ($prodis as $prodiName) {
    $refSheet->setCellValue('A' . $row, $prodiName);
    $row++;
}

// Put gelar data into the Reference sheet (Column B)
$gelarList = ['S.Sos', 'ST', 'S.Pd'];
$gelarCount = count($gelarList);
$row = 1;
foreach ($gelarList as $gelarName) {
    $refSheet->setCellValue('B' . $row, $gelarName);
    $row++;
}

// Put status mahasiswa data into the Reference sheet (Column C)
$statusList = ['Aktif', 'Cuti', 'Lulus', 'DO (Drop Out)', 'Mengundurkan Diri'];
$statusCount = count($statusList);
$row = 1;
foreach ($statusList as $statusName) {
    $refSheet->setCellValue('C' . $row, $statusName);
    $row++;
}
// Optionally hide the reference sheet
// $refSheet->setSheetState(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet::SHEETSTATE_HIDDEN);

// 2. Main Sheet
$spreadsheet->setActiveSheetIndex(0);
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Data Mahasiswa');

// Set Header
$sheet->setCellValue('A1', 'nim*');
$sheet->setCellValue('B1', 'nama*');
$sheet->setCellValue('C1', 'prodi*');
$sheet->setCellValue('D1', 'email');
$sheet->setCellValue('E1', 'nik');
$sheet->setCellValue('F1', 'jenis_kelamin');
$sheet->setCellValue('G1', 'agama');
$sheet->setCellValue('H1', 'alamat');
$sheet->setCellValue('I1', 'tahun_masuk');
$sheet->setCellValue('J1', 'angkatan');
$sheet->setCellValue('K1', 'tanggal_masuk');
$sheet->setCellValue('L1', 'status_mahasiswa*');
$sheet->setCellValue('M1', 'tempat_tanggal_lahir');
$sheet->setCellValue('N1', 'tanggal_lulus');
$sheet->setCellValue('O1', 'gelar');
$sheet->setCellValue('P1', 'nomor_ijazah');

// Set Data
$sheet->setCellValue('A2', '215100037');
$sheet->setCellValue('B2', 'Nama Mahasiswa 37');
$sheet->setCellValue('C2', $prodiCount > 0 ? $prodis[0] : 'Pembangunan Sosial');
$sheet->setCellValue('D2', '215100037@unida-aceh.ac.id');
$sheet->setCellValue('E2', '1234567890123037');
$sheet->setCellValue('F2', 'Laki-laki');
$sheet->setCellValue('G2', 'Islam');
$sheet->setCellValue('H2', 'Jl. Contoh Alamat');
$sheet->setCellValue('I2', '2021');
$sheet->setCellValue('J2', '2021');
$sheet->setCellValue('K2', '2021-08-01');
$sheet->setCellValue('L2', 'Aktif');
$sheet->setCellValue('M2', 'Banda Aceh, 01 Januari 2003');
$sheet->setCellValue('N2', '2025-08-01');
$sheet->setCellValue('O2', 'S.Sos');
$sheet->setCellValue('P2', 'IJZ/12345/2025');

// Set Data Validation for Jenis Kelamin (Column F)
$validationJK = $sheet->getCell('F2')->getDataValidation();
$validationJK->setType(DataValidation::TYPE_LIST);
$validationJK->setErrorStyle(DataValidation::STYLE_INFORMATION);
$validationJK->setAllowBlank(true);
$validationJK->setShowDropDown(true);
$validationJK->setFormula1('"Laki-laki,Perempuan"');

// Set Data Validation for Agama (Column G)
$validationAgama = $sheet->getCell('G2')->getDataValidation();
$validationAgama->setType(DataValidation::TYPE_LIST);
$validationAgama->setErrorStyle(DataValidation::STYLE_INFORMATION);
$validationAgama->setAllowBlank(true);
$validationAgama->setShowDropDown(true);
$validationAgama->setFormula1('"Islam,Kristen,Katolik,Hindu,Buddha,Konghucu"');

// Set Data Validation for Prodi (Column C) from Reference sheet
$validationProdi = $sheet->getCell('C2')->getDataValidation();
$validationProdi->setType(DataValidation::TYPE_LIST);
$validationProdi->setErrorStyle(DataValidation::STYLE_INFORMATION);
$validationProdi->setAllowBlank(true);
$validationProdi->setShowDropDown(true);
$validationProdi->setErrorTitle('Input Error');
$validationProdi->setError('Prodi tidak ditemukan. Silakan pilih dari dropdown.');
$validationProdi->setPromptTitle('Pilih Prodi');
$validationProdi->setPrompt('Silakan pilih prodi dari dropdown.');
// Excel formula for sheet reference: 'Referensi'!$A$1:$A$50
if ($prodiCount > 0) {
    $validationProdi->setFormula1('\'Referensi\'!$A$1:$A$' . $prodiCount);
}

// Set Data Validation for Gelar (Column O) from Reference sheet
$validationGelar = $sheet->getCell('O2')->getDataValidation();
$validationGelar->setType(DataValidation::TYPE_LIST);
$validationGelar->setErrorStyle(DataValidation::STYLE_INFORMATION);
$validationGelar->setAllowBlank(true);
$validationGelar->setShowDropDown(true);
$validationGelar->setErrorTitle('Input Error');
$validationGelar->setError('Gelar tidak ditemukan. Silakan pilih dari dropdown.');
$validationGelar->setPromptTitle('Pilih Gelar');
$validationGelar->setPrompt('Silakan pilih gelar dari dropdown.');
if ($gelarCount > 0) {
    $validationGelar->setFormula1('\'Referensi\'!$B$1:$B$' . $gelarCount);
}

// Set Data Validation for Status Mahasiswa (Column L) from Reference sheet
$validationStatus = $sheet->getCell('L2')->getDataValidation();
$validationStatus->setType(DataValidation::TYPE_LIST);
$validationStatus->setErrorStyle(DataValidation::STYLE_INFORMATION);
$validationStatus->setAllowBlank(true);
$validationStatus->setShowDropDown(true);
$validationStatus->setErrorTitle('Input Error');
$validationStatus->setError('Status tidak valid. Silakan pilih dari dropdown.');
$validationStatus->setPromptTitle('Pilih Status Mahasiswa');
$validationStatus->setPrompt('Silakan pilih status dari dropdown.');
if ($statusCount > 0) {
    $validationStatus->setFormula1('\'Referensi\'!$C$1:$C$' . $statusCount);
}

// Apply validations to rows 2 to 100
for ($i = 2; $i <= 100; $i++) {
    $sheet->getCell("C{$i}")->setDataValidation(clone $validationProdi);
    $sheet->getCell("F{$i}")->setDataValidation(clone $validationJK);
    $sheet->getCell("G{$i}")->setDataValidation(clone $validationAgama);
    $sheet->getCell("L{$i}")->setDataValidation(clone $validationStatus);
    $sheet->getCell("O{$i}")->setDataValidation(clone $validationGelar);
}

$writer = new Xlsx($spreadsheet);
$writer->save('dummy_mahasiswa_terbaru.xlsx');
echo "dummy_mahasiswa_terbaru.xlsx created successfully with prodi reference sheet.\n";
