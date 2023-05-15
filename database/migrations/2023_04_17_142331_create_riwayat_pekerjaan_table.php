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
            $table->foreignId('nisn');
            $table->string('nama_perusahaan');
            $table->foreignId('jenis_pekerjaan');
            $table->string('bidang');
            $table->string('tahun_awal_pekerjaan');
            $table->string('tahun_akhir_pekerjaan');
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
