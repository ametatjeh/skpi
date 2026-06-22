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
        Schema::create('pengabdian_masyarakat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mahasiswa_id')->index('pengabdian_masyarakat_mahasiswa_id_foreign');
            $table->string('judul_pkm');
            $table->string('pendanaan')->nullable();
            $table->string('tahun_pelaksanaan')->nullable();
            $table->string('anggota_tim')->nullable();
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
        Schema::dropIfExists('pengabdian_masyarakat');
    }
};
