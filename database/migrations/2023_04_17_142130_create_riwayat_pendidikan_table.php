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
        Schema::create('riwayat_pendidikan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nisn');
            $table->string('nama_instansi');
            $table->foreignId('jenis_pendidikan');
            $table->float('nilai_rata_rata');
            $table->string('tahun_awal_pendidikan');
            $table->string('tahun_akhir_pendidikan');
            $table->foreignId('user_id');
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
