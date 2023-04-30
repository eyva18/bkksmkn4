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
            $table->bigInteger('nisn_alumni')->unsigned();
            $table->bigInteger('tahun_lulus')->unsigned();
            $table->bigInteger('id_jurusan')->unsigned();
            $table->enum('bekerja', ['bekerja', 'tidak bekerja']);
            $table->enum('pendidikan', ['melanjutkan pendidikan', 'tidak melanjutkan pendidikan']);
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
