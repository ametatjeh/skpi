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
        Schema::create('laporan_monev', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('periode')->nullable();
            $table->unsignedBigInteger('prodi_id')->nullable()->index('laporan_monev_prodi_id_foreign');
            $table->unsignedBigInteger('fakultas_id')->nullable()->index('laporan_monev_fakultas_id_foreign');
            $table->integer('total_pengajuan')->default(0);
            $table->integer('total_disetujui')->default(0);
            $table->integer('total_ditolak')->default(0);
            $table->double('rata_rata_waktu_proses')->default(0);
            $table->text('catatan_evaluasi')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->unsignedBigInteger('dibuat_oleh')->nullable()->index('laporan_monev_dibuat_oleh_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_monev');
    }
};
