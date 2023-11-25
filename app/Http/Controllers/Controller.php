<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Admin;
use Auth;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {

       $saldo_superadmin = Admin::where('role_admin','superadmin')->first();
       $saldo_admin_kasir = Admin::where('role_admin','Admin Kasir')->first();
       $saldo_admin_Penginapan = Admin::where('role_admin','Admin Penginapan')->first();
       $saldo_admin_event = Admin::where('role_admin','Admin Event')->first();
       $saldo_amdin_pendidikan = Admin::where('role_admin','Admin Pendidikan')->first();

       
      
       View::share ( 'saldo_superadmin', $saldo_superadmin );
       View::share ( 'saldo_admin_kasir', $saldo_admin_kasir );
       View::share ( 'saldo_admin_Penginapan', $saldo_admin_Penginapan );
       View::share ( 'saldo_admin_event', $saldo_admin_event );
       View::share ( 'saldo_amdin_pendidikan', $saldo_amdin_pendidikan );
      
    }  
}
