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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign(['fakultas_id'])->references(['id'])->on('fakultas')->onUpdate('restrict')->onDelete('set null');
            $table->foreign(['prodi_id'])->references(['id'])->on('prodi')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_fakultas_id_foreign');
            $table->dropForeign('users_prodi_id_foreign');
        });
    }
};
