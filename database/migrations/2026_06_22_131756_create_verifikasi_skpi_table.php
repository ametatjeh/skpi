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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mahasiswa_id')->nullable()->index('verifikasi_skpi_mahasiswa_id_foreign');
            $table->unsignedBigInteger('prodi_id')->nullable()->index('verifikasi_skpi_prodi_id_foreign');
            $table->string('verifiable_type')->nullable();
            $table->unsignedBigInteger('verifiable_id')->nullable();
            $table->string('level_verifikasi')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('verifikator_id')->nullable()->index('verifikasi_skpi_verifikator_id_foreign');
            $table->string('verifikator_role')->nullable();
            $table->timestamp('tanggal_pengajuan')->nullable();
            $table->timestamp('tanggal_verifikasi')->nullable();
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
