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
        Schema::create('template_skpi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pt')->nullable();
            $table->string('alamat_pt')->nullable();
            $table->string('bahasa_pengantar')->nullable();
            $table->string('sk_pendirian')->nullable();
            $table->string('status_akreditasi')->nullable();
            $table->string('nomor_sk_akreditasi')->nullable();
            $table->string('nomor_sk_pt')->nullable();
            $table->text('persyaratan_penerimaan')->nullable();
            $table->text('sistem_penilaian')->nullable();
            $table->string('lama_studi_reguler')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_skpi');
    }
};
