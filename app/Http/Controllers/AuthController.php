<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //
	public function cek_nid()
	{

		return view('auth.cek_nid');
	}

	public function proses_cek_nid(Request $request){


		$cek_nid = User::where('nid_unmer', $request->nid_unmer)->first();
		// return $cek_nid;
		if ($cek_nid) {

			$update_otp = User::where('nid_unmer', $cek_nid->nid_unmer)->first();
			
			$kode_otp = mt_rand(100000, 999999);
			$input = [
				'otp' => $kode_otp,
			];

			$update_otp->update($input);
			$get_id = User::where('nid_unmer', $request->nid_unmer)->pluck('id');
			// return $get_id;
			$this->received($get_id);
			return redirect('/cek_otp')->with('success', 'Kami telah mengirimkan kode OTP, Silahkan masukkan kode otp anda');
		}else{
			return redirect()->back()->with('error', 'NID belum terdaftar');

		}       
	}


	public function received($get_id)
	{

		$send_otp= User::where('id', $get_id)->first();

        //$catin = CalonPengantin::where('id',$id_catin)->first();

		$this->_sendEmail($send_otp);

	}

	public function _sendEmail($send_otp)
	{
		$message = new \App\Mail\KirimOtp($send_otp);
		\Mail::to($send_otp->email)->send($message);
	}



	public function cek_otp()
	{

		return view('auth.cek_otp');
	}

	public function proses_cek_otp(Request $request){


		$cek_otp = User::where('otp', $request->otp)->first();
		// return $cek_otp;
		if ($cek_otp) {

			$hapus_otp = User::where('otp', $cek_otp->otp)->first();
			
			
			$input = [
				'otp' => null,
			];

			$hapus_otp->update($input);

			return redirect('/login')->with('success', 'Silahkan masukkan password anda');
		}else{
			return redirect()->back()->with('error', 'Kode OTP Salah');

		}       
	}


	public function login()
	{

		return view('auth.login');
	}

	public function proses_login(Request $request){
        //remember
        $ingat = $request->remember ? true : false; //jika di ceklik true jika tidak gfalse
        //akan ingat selama 5 tahun jika tidak logout

        //auth()->attempt buat proses login  request input username dan password,  request input  sama kayak $request->password dan usernamenya, ditambah $ingat jika pengen ingat
        if(auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $ingat)){
            //auth->user() untuk memanggil data user yang sudah login
        if(auth()->user()->role == "superadmin"){
            return redirect()->route('superadmin_dashboard')->with('success', 'Anda Berhasil Login');
        }else if(auth()->user()->role == "Admin Kasir"){
            return redirect()->route('admin_kasir_dashboard')->with('success', 'Anda Berhasil Login');
        }else if(auth()->user()->role == "Admin Penginapan"){
            return redirect()->route('admin_penginapan_dashboard')->with('success', 'Anda Berhasil Login');
        }else if(auth()->user()->role == "Admin Pendidikan"){
            return redirect()->route('admin_pendidikan_dashboard')->with('success', 'Anda Berhasil Login');
        }else if(auth()->user()->role == "Admin Event"){
            return redirect()->route('admin_event_dashboard')->with('success', 'Anda Berhasil Login');
        }

    }else{
       
            return redirect()->route('login')->with('error', 'Email / Password anda salah'); //route itu isinya name dari route di web.php

        }
    }

    public function logout_superadmin(){

        auth()->logout(); //logout
        
        return redirect()->route('cek_nid')->with('success', 'Anda Berhasil Logout');
        
    }

    public function admin_kasir_logout(){

        auth()->logout(); //logout
        
        return redirect()->route('cek_nid')->with('success', 'Anda Berhasil Logout');
        
    }

    public function admin_penginapan_logout(){

        auth()->logout(); //logout
        
        return redirect()->route('cek_nid')->with('success', 'Anda Berhasil Logout');
        
    }

    public function admin_pendidikan_logout(){

        auth()->logout(); //logout
        
        return redirect()->route('cek_nid')->with('success', 'Anda Berhasil Logout');
        
    }

    public function admin_event_logout(){

        auth()->logout(); //logout
        
        return redirect()->route('cek_nid')->with('success', 'Anda Berhasil Logout');
        
    }


}
