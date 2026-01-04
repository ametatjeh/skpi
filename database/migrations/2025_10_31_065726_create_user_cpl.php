<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cpl', function (Blueprint $table) {
            $table->id();
            $table->string('kode_cpl', 10)->unique(); // Contoh: CPL1, CPL2
            $table->string('prodi'); // Nama Program Studi
            $table->text('deskripsi_id'); // Deskripsi Bahasa Indonesia
            $table->text('deskripsi_en'); // Deskripsi Bahasa Inggris
            $table->enum('kategori', ['Sikap', 'Pengetahuan', 'Keterampilan Umum', 'Keterampilan Khusus']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cpl');
    }
};
