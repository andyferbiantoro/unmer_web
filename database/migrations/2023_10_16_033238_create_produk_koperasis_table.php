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
        Schema::create('produk_koperasis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_admin');
            $table->string('nama_produk');
            $table->string('kode_produk');
            $table->string('kategori_produk');
            $table->string('size');
            $table->string('warna');
            $table->integer('harga');
            $table->integer('stok');
            $table->integer('sold');
            $table->string('foto');
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
        Schema::dropIfExists('produk_koperasis');
    }
};
