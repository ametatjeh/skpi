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
        Schema::table('penerjemahan', function (Blueprint $table) {
            $table->foreign(['diterjemahkan_oleh'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('set null');
            $table->foreign(['nim'])->references(['nim'])->on('mahasiswa')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penerjemahan', function (Blueprint $table) {
            $table->dropForeign('penerjemahan_diterjemahkan_oleh_foreign');
            $table->dropForeign('penerjemahan_nim_foreign');
        });
    }
};
