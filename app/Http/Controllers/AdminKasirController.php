<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminKasirController extends Controller
{
    //
    public function admin_kasir_dashboard()
	{

		return view('admin_kasir.index');
	}
}
