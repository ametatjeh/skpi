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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['mahasiswa', 'prodi', 'fakultas', 'pusat_bahasa', 'biro_akademik', 'bpm', 'rektorat']);
            $table->string('signature_path')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('prodi_id')->nullable()->index('users_prodi_id_foreign');
            $table->unsignedBigInteger('fakultas_id')->nullable()->index('users_fakultas_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
