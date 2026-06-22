<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penghargaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            $table->string('nama_penghargaan');
            $table->string('tingkat')->nullable();
            $table->string('pemberi_penghargaan')->nullable();
            $table->integer('tahun_perolehan')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('file_path')->nullable();
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penghargaan');
    }
};
