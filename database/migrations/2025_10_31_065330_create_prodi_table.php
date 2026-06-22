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
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fakultas_id')->constrained('fakultas')->cascadeOnDelete();
            $table->string('nama_prodi');
            $table->string('kaprodi')->nullable();
            $table->string('akreditasi')->nullable();
            $table->string('no_sk')->nullable();
            $table->string('jenjang_kkni')->nullable();
            $table->string('bahasa_pengantar')->default('Indonesia');
            
            // SKPI Specific Fields
            $table->string('status_akreditasi')->nullable();
            $table->string('nomor_sk_akreditasi')->nullable();
            $table->string('akses_lanjut')->nullable();
            $table->string('status_profesi')->nullable();
            $table->string('jenis_jenjang')->nullable();
            $table->string('nama_prodi_en')->nullable();
            $table->string('kkni_level')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodi');
    }
};
