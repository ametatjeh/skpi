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
            $table->id();
            $table->foreignId('mahasiswa_id')->nullable()->constrained('mahasiswa')->onDelete('cascade');
            $table->foreignId('prodi_id')->nullable()->constrained('prodi')->onDelete('cascade');
            $table->string('verifiable_type')->nullable();
            $table->unsignedBigInteger('verifiable_id')->nullable();
            $table->string('level_verifikasi')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('verifikator_id')->nullable()->constrained('users')->onDelete('set null');
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
