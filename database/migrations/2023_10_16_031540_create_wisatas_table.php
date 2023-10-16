<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisatas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_admin');
            $table->string('nama_tempat_wisata');
            $table->text('Deskripsi');
            $table->integer('htm_wisata');
            $table->string('hari_operasional_awal');
            $table->string('hari_operasional_akhir');
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->string('alamat');
            $table->string('status');
            $table->string('longitude');
            $table->string('latitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wisatas');
    }
};
