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
            $table->id();
            $table->foreignId('draft_skpi_id')->nullable()->constrained('draft_skpi')->onDelete('cascade');
            $table->foreignId('verifikasi_skpi_id')->nullable()->constrained('verifikasi_skpi')->onDelete('cascade');
            $table->foreignId('approver_id')->nullable()->constrained('users')->onDelete('set null');
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
