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
        Schema::create('status_alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->nullable();
            $table->foreignId('jurusan')->nullable();
            $table->foreignId('tahun_lulus')->nullable();
            $table->foreignId('status_bekerja')->nullable();
            $table->foreignId('status_pendidikan')->nullable();
            $table->string('universitas')->nullable();
            $table->string('perusahaan')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statusalumni');
    }
};
