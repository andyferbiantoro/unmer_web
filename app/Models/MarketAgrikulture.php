<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketAgrikulture extends Model
{
    use HasFactory;
    protected $table = 'market_agrikultures';
	protected $guarded = [];

    public function detail_market()
    {
        return $this->hasMany(DetailMarketAgrikulture::class,'id_market');
    }
}
