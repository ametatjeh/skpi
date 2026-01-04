<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('verifikasi_skpi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skpi_id')->constrained('skpi')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('tahapan', ['prodi', 'fakultas', 'pusat_bahasa', 'biro_akademik', 'bpm', 'rektorat']);
            $table->enum('status', ['pending', 'valid', 'tidak_valid'])->default('pending');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_skpi');
    }
};
