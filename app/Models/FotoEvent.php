<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoEvent extends Model
{
    use HasFactory;
    protected $table = 'foto_events';
	protected $guarded = [];
}
