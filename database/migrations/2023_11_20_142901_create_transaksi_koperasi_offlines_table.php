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
        Schema::create('transaksi_koperasi_offlines', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_admin_kasir');
            $table->integer('id_partner');
            $table->integer('nominal_barang');
            $table->integer('nominal_bayar');
            $table->integer('nominal_kembalian');
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
        Schema::dropIfExists('transaksi_koperasi_offlines');
    }
};
