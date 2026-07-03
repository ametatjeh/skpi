<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Buat password nullable (user belum set password saat registrasi awal)
            $table->string('password')->nullable()->change();

            // Tambah kolom aktivasi jika belum ada
            if (!Schema::hasColumn('users', 'is_activated')) {
                $table->boolean('is_activated')->default(false)->after('role');
            }
            if (!Schema::hasColumn('users', 'activation_token')) {
                $table->string('activation_token', 100)->nullable()->after('is_activated');
            }
            if (!Schema::hasColumn('users', 'activation_token_expires_at')) {
                $table->timestamp('activation_token_expires_at')->nullable()->after('activation_token');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable(false)->change();

            if (Schema::hasColumn('users', 'is_activated')) {
                $table->dropColumn('is_activated');
            }
            if (Schema::hasColumn('users', 'activation_token')) {
                $table->dropColumn('activation_token');
            }
            if (Schema::hasColumn('users', 'activation_token_expires_at')) {
                $table->dropColumn('activation_token_expires_at');
            }
        });
    }
};
