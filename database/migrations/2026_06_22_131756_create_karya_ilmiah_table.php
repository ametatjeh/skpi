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
        Schema::create('karya_ilmiah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mahasiswa_id')->index('karya_ilmiah_mahasiswa_id_foreign');
            $table->string('judul');
            $table->string('jenis')->nullable();
            $table->string('tahun')->nullable();
            $table->string('link_publikasi')->nullable();
            $table->string('file_bukti')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karya_ilmiah');
    }
};
