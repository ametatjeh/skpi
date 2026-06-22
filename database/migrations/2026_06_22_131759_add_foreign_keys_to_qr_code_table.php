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
        Schema::table('qr_code', function (Blueprint $table) {
            $table->foreign(['mahasiswa_id'])->references(['id'])->on('mahasiswa')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['skpi_id'])->references(['id'])->on('draft_skpi')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('qr_code', function (Blueprint $table) {
            $table->dropForeign('qr_code_mahasiswa_id_foreign');
            $table->dropForeign('qr_code_skpi_id_foreign');
        });
    }
};
