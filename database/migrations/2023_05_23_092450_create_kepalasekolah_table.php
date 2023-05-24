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
        Schema::create('kepala_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('kutipan')->nullable();
            $table->string('tahun_jabatan')->nullable();
            $table->foreignId('jenis_kelamin')->nullable();
            $table->bigInteger('no_telp')->nullable(); 
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepalasekolah');
    }
};
