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
        Schema::create('transaksi_koperasis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('nominal');
            $table->string('jenis_pembayaran');
            $table->text('catatan');
            $table->string('kode_transaksi');
            $table->string('status_pemesanan');
            $table->string('status_pembayaran');
            $table->string('metode_pengiriman');
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
        Schema::dropIfExists('transaksi_koperasis');
    }
};
