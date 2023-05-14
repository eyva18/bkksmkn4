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
        Schema::create('riwayat_pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nisn')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->foreignId('jenis_pekerjaan')->nullable();
            $table->string('bidang')->nullable();
            $table->string('awal_bekerja')->nullable();
            $table->string('akhir_bekerja')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayatpekerjaan');
    }
};
