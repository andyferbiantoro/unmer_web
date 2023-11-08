<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangOffline extends Model
{
    use HasFactory;
    protected $table = 'keranjang_offlines';
	protected $guarded = [];
}
