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
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->text('nama');
            $table->text('deskripsi_pekerjaan')->nullable();
            $table->text('deskripsi_perusahaan')->nullable();
            $table->text('lokasi')->nullable();
            $table->string('gaji')->nullable();
            $table->date('tgl_upload')->nullable();
            $table->bigInteger('id_dudi')->unsigned();
            $table->bigInteger('id_kategoti_pekerjaan')->unsigned()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
