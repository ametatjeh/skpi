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
        Schema::create('draft_skpi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mahasiswa_id')->index('draft_skpi_mahasiswa_id_foreign');
            $table->unsignedBigInteger('prodi_id')->nullable()->index('draft_skpi_prodi_id_foreign');
            $table->string('nomor_skpi')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->string('status')->default('draft');
            $table->date('tanggal_pengesahan')->nullable();
            $table->string('file_path')->nullable();
            $table->text('catatan')->nullable();
            $table->text('ringkasan_id')->nullable();
            $table->text('ringkasan_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draft_skpi');
    }
};
