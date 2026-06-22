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
        Schema::create('dokumen_pendukung', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mahasiswa_id')->index('dokumen_pendukung_mahasiswa_id_foreign');
            $table->string('nama_dokumen')->nullable();
            $table->string('jenis_dokumen')->nullable();
            $table->string('file_path')->nullable();
            $table->string('ukuran_file')->nullable();
            $table->string('tipe_file')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_pendukung');
    }
};
