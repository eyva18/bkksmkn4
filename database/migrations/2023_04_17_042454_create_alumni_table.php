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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nisn');
            $table->bigInteger('nis');
            $table->string('nama');
            $table->bigInteger('no_hp')->nullable();
            $table->text('biografi')->nullable();
            $table->foreignId('agamaId')->nullable();
            $table->foreignId('jenis_kelaminId')->nullable();
            $table->text('alamat')->nullable();
            $table->text('tempatTanggalLahir')->nullable();
            $table->text('photo_profile')->nullable();
            $table->text('transkrip_nilai')->nullable();
            $table->foreignId('kode_jurusanId')->nullable();
            $table->foreignId('kode_lulusId')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
