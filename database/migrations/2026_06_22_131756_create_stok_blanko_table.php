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
        Schema::create('stok_blanko', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tanggal_pengadaan')->nullable();
            $table->integer('jumlah_masuk')->default(0);
            $table->integer('jumlah_keluar')->default(0);
            $table->integer('stok_tersisa')->default(0);
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('petugas_id')->nullable()->index('stok_blanko_petugas_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_blanko');
    }
};
