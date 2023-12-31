<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiAgrikulture extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi_agrikultures';
	protected $guarded = [];

    public function produk_agrikultures()
{
    return $this->belongsTo(ProdukAgrikulture::class, 'id_produk_agrikulture');
}
}
