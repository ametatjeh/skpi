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
        Schema::table('draft_skpi', function (Blueprint $table) {
            $table->foreign(['mahasiswa_id'])->references(['id'])->on('mahasiswa')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['prodi_id'])->references(['id'])->on('prodi')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('draft_skpi', function (Blueprint $table) {
            $table->dropForeign('draft_skpi_mahasiswa_id_foreign');
            $table->dropForeign('draft_skpi_prodi_id_foreign');
        });
    }
};
