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
            $table->bigInteger('no_hp');
            $table->text('biografi');
            $table->foreignId('agamaId');
            $table->foreignId('jenis_kelaminId');
            $table->text('alamat');
            $table->text('tempatTanggalLahir');
            $table->text('photo_profile');
            $table->text('transkrip_nilai');
            $table->foreignId('kode_jurusanId');
            $table->foreignId('kode_lulusId');
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
