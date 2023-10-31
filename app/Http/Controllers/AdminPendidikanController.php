<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPendidikanController extends Controller
{
    //
     public function admin_pendidikan_dashboard()
	{

		return view('admin_pendidikan.index');
	}
}
