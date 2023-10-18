<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class SuperadminController extends Controller
{
    //
    public function superadmin_dashboard()
	{

		return view('super_admin.index');
	}

	public function register(Request $request){

		$user = User::create([
			'email' => $request->email,
			'password' =>  bcrypt($request->password),
			'otp' => $request->otp,
			'nid_unmer' => $request->nid_unmer,
			'role' => $request->role,
			'status' => $request->status

		]);


		if ($user) {
			
			$out = [
				"message" => "register_success",
				"user" => $user,
				"code"    => 201,
			];
		} else {
			$out = [
				"message" => "failed_regiser",
				"code"   => 400,
			];
		}

		return response()->json($out, $out['code']);
	}

	public function superadmin_kelola_admin()
	{

		return view('super_admin.kelola_admin.index');
	}


	public function superadmin_kelola_produk()
	{

		return view('super_admin.kelola_produk.index');
	}

	public function superadmin_kelola_transaksi()
	{

		return view('super_admin.kelola_transaksi.index');
	}
}
