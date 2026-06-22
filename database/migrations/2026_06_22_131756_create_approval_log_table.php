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
        Schema::create('approval_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('draft_skpi_id')->nullable()->index('approval_log_draft_skpi_id_foreign');
            $table->unsignedBigInteger('verifikasi_skpi_id')->nullable()->index('approval_log_verifikasi_skpi_id_foreign');
            $table->unsignedBigInteger('approver_id')->nullable()->index('approval_log_approver_id_foreign');
            $table->string('approver_role')->nullable();
            $table->string('action')->nullable();
            $table->string('status_from')->nullable();
            $table->string('status_to')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approval_log');
    }
};
