<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    //
     public function admin_event_dashboard()
	{

		return view('admin_event.index');
	}
}
