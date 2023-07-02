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
            $table->string('nisn');
            $table->string('nama_instansi')->nullable();
            $table->foreignId('jenis_pendidikan')->nullable();
            $table->float('nilai_rata_rata')->nullable();
            $table->string('tahun_awal_pendidikan')->nullable();
            $table->string('tahun_akhir_pendidikan')->nullable();
            $table->foreignId('user_id')->nullable();
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
