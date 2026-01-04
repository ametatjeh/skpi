<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

$admin = AdminUser::where('email', 'admin@gmail.com')->first();

if ($admin) {
    // Update password dengan hash yang benar
    $admin->password = Hash::make('Password123');
    $admin->save();
    
    echo "Password updated successfully!\n";
    echo "Email: " . $admin->email . "\n";
    echo "New password: Password123\n";
    
    // Verify
    $adminFresh = AdminUser::find($admin->id);
    echo "Verification: " . (Hash::check('Password123', $adminFresh->password) ? 'MATCH ✓' : 'NO MATCH ✗') . "\n";
} else {
    echo "Admin not found\n";
}
