<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'pin',
        'nid_unmer',
        'no_telp',
        'otp',
        'role',
        'status',
        'longitude',
        'latitude','foto','id_unmer','no_unmer',
        'nama_admin'
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isSuperAdmin(){

        if($this->role == 'superadmin'){

            return true;
        }
        return false;
    }

    public function isAdminKasir(){

        if($this->role == 'Admin Kasir'){

            return true;
        }
        return false;
    }

    public function isAdminPenginapan(){

        if($this->role == 'Admin Penginapan'){

            return true;
        }
        return false;
    }

    public function isAdminPendidikan(){

        if($this->role == 'Admin Pendidikan'){

            return true;
        }
        return false;
    }

    public function isAdminEvent(){

        if($this->role == 'Admin Event'){

            return true;
        }
        return false;
    }

    public function isAdminWisata(){

        if($this->role == 'Admin Wisata'){

            return true;
        }
        return false;
    }
}
