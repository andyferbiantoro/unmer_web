<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    //
    public function index()
	{

		return view('super_admin.index');
	}
}
