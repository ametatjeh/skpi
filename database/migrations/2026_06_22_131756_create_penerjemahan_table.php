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
        Schema::create('penerjemahan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nim')->index('penerjemahan_nim_foreign');
            $table->string('bagian');
            $table->text('teks_asli');
            $table->text('teks_terjemahan');
            $table->unsignedBigInteger('diterjemahkan_oleh')->nullable()->index('penerjemahan_diterjemahkan_oleh_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerjemahan');
    }
};
