<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerjemahTable extends Migration
{
    public function up(): void
    {
        Schema::create('penerjemahan', function (Blueprint $table) {
            $table->id();
            $table->string('nim'); // relasi ke mahasiswa
            $table->string('bagian'); // contoh: 'sertifikat', 'prestasi', 'organisasi'
            $table->text('teks_asli'); // versi Bahasa Indonesia
            $table->text('teks_terjemahan'); // versi Bahasa Inggris
            $table->unsignedBigInteger('diterjemahkan_oleh')->nullable(); // id user penerjemah
            $table->timestamps();

            // Optional relasi
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('diterjemahkan_oleh')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penerjemahan');
    }
}
