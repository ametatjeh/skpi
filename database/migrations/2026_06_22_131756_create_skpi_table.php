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
        Schema::create('skpi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mahasiswa_id')->index('skpi_mahasiswa_id_foreign');
            $table->string('nomor_skpi')->nullable();
            $table->enum('status', ['diajukan', 'diverifikasi_prodi', 'divalidasi_fakultas', 'diterjemahkan', 'disahkan', 'dicetak', 'selesai', 'ditolak'])->default('diajukan');
            $table->text('catatan')->nullable();
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_pengesahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skpi');
    }
};
