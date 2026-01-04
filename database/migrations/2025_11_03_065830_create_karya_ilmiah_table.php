<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karya_ilmiah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('judul');
            $table->string('jenis')->nullable(); // jurnal, prosiding, dll
            $table->string('tahun')->nullable();
            $table->string('link_publikasi')->nullable();
            $table->string('file_bukti')->nullable(); // bisa path ke file PDF atau gambar
            $table->timestamps();

            // Relasi ke tabel mahasiswa (kalau sudah ada)
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karya_ilmiah');
    }
};
