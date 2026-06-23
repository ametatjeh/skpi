<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Request;

$file = 'dummy_mahasiswa_dengan_email.xlsx';

if (file_exists($file)) {
    try {
        $import = new MahasiswaImport();
        Excel::import($import, $file, null, \Maatwebsite\Excel\Excel::XLSX);
        echo "Berhasil import " . $import->getImportedCount() . " data mahasiswa.\n";
        echo "Skipped: " . $import->getSkippedCount() . "\n";
        print_r($import->getErrors());
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
} else {
    echo "File not found\n";
}
