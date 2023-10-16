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
        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->integer('id_amin');
            $table->string('judul_festival');
            $table->string('deskripsi');
            $table->string('lokasi');
            $table->date('tanggal_festival');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('htm_festival');
            $table->string('status');
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
        Schema::dropIfExists('festivals');
    }
};
