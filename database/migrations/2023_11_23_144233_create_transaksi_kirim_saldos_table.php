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
        Schema::create('transaksi_kirim_saldos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_pengirim');
            $table->integer('id_user_penerima');
            $table->string('id_unmer_penerima');
            $table->integer('nominal_kirim');
            $table->integer('biaya_layanan');
            $table->integer('total');
            $table->string('jenis_kirim_saldo');
            $table->string('catatan');
            $table->string('bank');
            $table->string('rekening_bank');
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
        Schema::dropIfExists('transaksi_kirim_saldos');
    }
};
