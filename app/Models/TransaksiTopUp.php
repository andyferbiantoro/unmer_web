<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiTopUp extends Model
{
    use HasFactory;
    protected $table = 'transaksi_top_ups';
	protected $guarded = [];
}
