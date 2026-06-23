<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

DB::statement('ALTER TABLE mahasiswa MODIFY user_id bigint unsigned NULL');
echo "user_id is now nullable.\n";
