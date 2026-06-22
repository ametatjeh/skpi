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
        Schema::create('prestasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mahasiswa_id')->index('prestasi_mahasiswa_id_foreign');
            $table->string('judul_prestasi');
            $table->enum('tingkat', ['lokal', 'nasional', 'internasional'])->nullable();
            $table->string('penyelenggara')->nullable();
            $table->date('tanggal_perolehan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('file_path')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};
