<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Read from dummy_mahasiswa.csv
$file = fopen('dummy_mahasiswa.csv', 'r');
$row = 1;
while (($data = fgetcsv($file)) !== FALSE) {
    // If it's reading the whole line as one string because of delimiter, we can explode it.
    // However, fgetcsv with comma delimiter should work perfectly since the file uses commas.
    $col = 'A';
    foreach ($data as $cellValue) {
        $sheet->setCellValue($col . $row, $cellValue);
        $col++;
    }
    $row++;
}
fclose($file);

$writer = new Xlsx($spreadsheet);
$writer->save('dummy_mahasiswa.xlsx');
echo "dummy_mahasiswa.xlsx created successfully.\n";
