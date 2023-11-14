<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKoperasi extends Model
{
    use HasFactory;
    protected $table = 'produk_koperasis';
	protected $guarded = [];

    public function size()
    {
        return $this->hasMany(Size::class,'id_produk_koperasi');
    }
}
