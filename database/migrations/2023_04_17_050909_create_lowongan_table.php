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
            $table->text('deskripsi_pekerjaan');
            $table->text('deskripsi_perusahaan');
            $table->text('lokasi');
            $table->string('gaji');
            $table->date('tgl_upload');
            $table->bigInteger('id_dudi')->unsigned();
            $table->bigInteger('id_kategoti_pekerjaan')->unsigned();
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
