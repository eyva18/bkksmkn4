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
        Schema::create('sertifikasi_lomba', function (Blueprint $table) {
            $table->id();
            $table->string('nama_juara_kompetensi');
            $table->foreignId('tingkat_perlombaan');
            $table->string('tanggal_terbit');
            $table->string('tanggal_kadaluarsa');
            $table->string('file_sertifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikasi_lombas');
    }
};
