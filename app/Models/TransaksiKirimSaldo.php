<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKirimSaldo extends Model
{
    use HasFactory;
    protected $table = 'transaksi_kirim_saldos';
    protected $guarded = [];
}
