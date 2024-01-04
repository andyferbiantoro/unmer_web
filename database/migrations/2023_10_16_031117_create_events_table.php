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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->integer('id_admin');
            $table->string('judul_event');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->date('tanggal_event');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('htm_event');
            $table->string('status');
            $table->string('foto_event');
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
        Schema::dropIfExists('events');
    }
};
