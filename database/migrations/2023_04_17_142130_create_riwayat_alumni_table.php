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
        Schema::create('riwayat_alumni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nisn');
            $table->string('nama_instansi');
            $table->string('jenis_pendidikan');
            $table->float('nilai_rata_rata');
            $table->string('nama_perusahaan');
            $table->string('jenis_pekerjaan');
            $table->string('bidang');
            $table->string('awal_bekerja');
            $table->string('akhir_bekerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat');
    }
};
