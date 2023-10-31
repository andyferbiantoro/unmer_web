<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPenginapanController extends Controller
{
    //
     public function admin_penginapan_dashboard()
	{

		return view('admin_penginapan.index');
	}
}
