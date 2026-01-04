<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

$admin = AdminUser::where('email', 'admin@gmail.com')->first();

if ($admin) {
    echo "Admin found!\n";
    echo "Email: " . $admin->email . "\n";
    echo "Name: " . $admin->name . "\n";
    echo "Password hash length: " . strlen($admin->password) . "\n";
    echo "First 10 chars of hash: " . substr($admin->password, 0, 10) . "\n";
    echo "Hash check with 'Password123': " . (Hash::check('Password123', $admin->password) ? 'MATCH ✓' : 'NO MATCH ✗') . "\n";
} else {
    echo "Admin with email admin@gmail.com NOT FOUND in database\n";
    
    // Show all admins
    $allAdmins = AdminUser::all();
    if ($allAdmins->count() > 0) {
        echo "\nExisting admins in database:\n";
        foreach ($allAdmins as $a) {
            echo "- " . $a->email . " (ID: " . $a->id . ")\n";
        }
    } else {
        echo "No admins in database at all.\n";
    }
}
