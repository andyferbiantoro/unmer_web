<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoritKoperasi extends Model
{
    use HasFactory;
    protected $table = 'favorit_koperasis';
	protected $guarded = [];
}
