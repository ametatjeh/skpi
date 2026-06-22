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
        Schema::table('laporan_monev', function (Blueprint $table) {
            $table->foreign(['dibuat_oleh'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('set null');
            $table->foreign(['fakultas_id'])->references(['id'])->on('fakultas')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['prodi_id'])->references(['id'])->on('prodi')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_monev', function (Blueprint $table) {
            $table->dropForeign('laporan_monev_dibuat_oleh_foreign');
            $table->dropForeign('laporan_monev_fakultas_id_foreign');
            $table->dropForeign('laporan_monev_prodi_id_foreign');
        });
    }
};
