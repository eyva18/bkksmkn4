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
        Schema::create('sertifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sertifikasi');
            $table->string('nama_instansi_penerbit');
            $table->string('tanggal_terbit');
            $table->string('tanggal_kadaluarsa');
            $table->string('kode_sertifikasi')->nullable();
            $table->string('link_sertifikasi')->nullable();
            $table->string('file_sertifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikasis');
    }
};
