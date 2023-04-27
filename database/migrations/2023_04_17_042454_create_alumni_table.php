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
            $table->bigInteger('NISN');
            $table->bigInteger('NIS');
            $table->string('nama');
            $table->integer('no_hp');
            $table->text('biografi');
            $table->string('agama');
            $table->enum('jk', ['laki-laki', 'perempuan']);
            $table->text('alamat');
            $table->text('TTL');
            $table->text('photo_profile');
            $table->text('transkrif_nilai');
            $table->bigInteger('kode_jurusan')->unsigned();
            $table->bigInteger('kode_lulus')->unsigned();
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
