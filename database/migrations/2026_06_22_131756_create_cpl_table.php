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
        Schema::create('cpl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('prodi_id')->index('cpl_prodi_id_foreign');
            $table->string('kode')->nullable();
            $table->enum('kategori', ['sikap', 'pengetahuan', 'keterampilan_umum', 'keterampilan_khusus']);
            $table->text('deskripsi');
            $table->boolean('status')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpl');
    }
};
