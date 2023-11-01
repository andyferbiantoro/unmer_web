<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiAgrikulture extends Model
{
    use HasFactory;
    protected $table = 'transaksi_agrikultures';
    protected $fillable =[
        'id_market_agrikulture','status_pembayaran',
        'status_pemesanan','catatan','jenis_pembayaran','nominal','id_user','kode_transaksi'
    ];
	protected $guarded = [];
    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksiAgrikulture::class,'id_transaksi_agrikulture');
    }
}
