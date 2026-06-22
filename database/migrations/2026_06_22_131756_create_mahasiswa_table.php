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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('mahasiswa_user_id_foreign');
            $table->unsignedBigInteger('prodi_id')->index('mahasiswa_prodi_id_foreign');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('nik')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('agama')->nullable();
            $table->text('alamat')->nullable();
            $table->string('tempat_tanggal_lahir')->nullable();
            $table->string('tahun_masuk')->nullable();
            $table->string('angkatan')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('status_mahasiswa')->nullable();
            $table->date('tanggal_lulus')->nullable();
            $table->string('gelar')->nullable();
            $table->string('no_ijazah')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
