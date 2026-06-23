<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$m = App\Models\Mahasiswa::find(35);
if ($m) {
    echo "ID: " . $m->id . "\n";
    echo "Nama: " . $m->nama . "\n";
    echo "Status: " . $m->status_mahasiswa . "\n";
} else {
    echo "Mahasiswa 35 not found.\n";
}
