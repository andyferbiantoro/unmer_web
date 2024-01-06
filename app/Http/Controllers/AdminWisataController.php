<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Wisata;
use App\Models\DetailWisata;
use File;
use PDF;
use DB;
use Auth;

class AdminWisataController extends Controller
{
    //

    public function admin_wisata_dashboard()
	{

		return view('admin_wisata.index');
	}
}
