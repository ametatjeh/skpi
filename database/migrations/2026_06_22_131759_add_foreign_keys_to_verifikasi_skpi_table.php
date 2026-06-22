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
        Schema::table('verifikasi_skpi', function (Blueprint $table) {
            $table->foreign(['mahasiswa_id'])->references(['id'])->on('mahasiswa')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['prodi_id'])->references(['id'])->on('prodi')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['verifikator_id'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('verifikasi_skpi', function (Blueprint $table) {
            $table->dropForeign('verifikasi_skpi_mahasiswa_id_foreign');
            $table->dropForeign('verifikasi_skpi_prodi_id_foreign');
            $table->dropForeign('verifikasi_skpi_verifikator_id_foreign');
        });
    }
};
