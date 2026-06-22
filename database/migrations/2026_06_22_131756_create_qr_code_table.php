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
        Schema::create('qr_code', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('skpi_id')->nullable()->index('qr_code_skpi_id_foreign');
            $table->unsignedBigInteger('mahasiswa_id')->nullable()->index('qr_code_mahasiswa_id_foreign');
            $table->text('qr_code_string')->nullable();
            $table->string('qr_image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qr_code');
    }
};
