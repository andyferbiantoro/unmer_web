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
        Schema::create('detail_market_agrikultures', function (Blueprint $table) {
            $table->id();
            $table->integer('id_market');
            $table->integer('jam_pengiriman_awal');
            $table->integer('jam_pengiriman_akhir');
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
        Schema::dropIfExists('detail_market_agrikultures');
    }
};
