<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKoperasiOffline extends Model
{
    use HasFactory;
    protected $table = 'transaksi_koperasi_offlines';
	protected $guarded = [];
}
