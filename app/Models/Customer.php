<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
	protected $guarded = [];
    // protected $fillable =[
    //     'saldo','id_user','nama','nik','alamat','status',
    // ];

    public function user()
    {
        return $this->hasOne(User::class,'id_user');
    }
}
