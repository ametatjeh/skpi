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
        Schema::table('approval_log', function (Blueprint $table) {
            $table->foreign(['approver_id'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('set null');
            $table->foreign(['draft_skpi_id'])->references(['id'])->on('draft_skpi')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['verifikasi_skpi_id'])->references(['id'])->on('verifikasi_skpi')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('approval_log', function (Blueprint $table) {
            $table->dropForeign('approval_log_approver_id_foreign');
            $table->dropForeign('approval_log_draft_skpi_id_foreign');
            $table->dropForeign('approval_log_verifikasi_skpi_id_foreign');
        });
    }
};
