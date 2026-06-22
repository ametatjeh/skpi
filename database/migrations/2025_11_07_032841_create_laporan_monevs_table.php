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
            $table->id();
            $table->string('periode')->nullable();
            $table->foreignId('prodi_id')->nullable()->constrained('prodi')->onDelete('cascade');
            $table->foreignId('fakultas_id')->nullable()->constrained('fakultas')->onDelete('cascade');
            $table->integer('total_pengajuan')->default(0);
            $table->integer('total_disetujui')->default(0);
            $table->integer('total_ditolak')->default(0);
            $table->float('rata_rata_waktu_proses')->default(0);
            $table->text('catatan_evaluasi')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->onDelete('set null');
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
