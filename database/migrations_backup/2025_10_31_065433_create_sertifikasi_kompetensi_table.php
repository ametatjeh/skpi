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
        Schema::create('sertifikasi_kompetensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->cascadeOnDelete();
            $table->string('nama_sertifikasi');
            $table->string('nomor_sertifikat')->nullable();
            $table->string('penerbit')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->date('tanggal_kadaluarsa')->nullable();
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
        Schema::dropIfExists('sertifikasi_kompetensi');
    }
};
