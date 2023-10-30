<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //

    public function getRandomString($panjang = 4)
    {
        $karakter = '0123456789';
        $panjang_karakter = strlen($karakter);
        $randomString = '';
        for ($i = 0; $i < $panjang; $i++) {
            $randomString .= $karakter[rand(0, $panjang_karakter - 1)];
        }
        return $randomString;
    }


    public function register(Request $request)
    {
        $random = $this->getRandomString();
        $cekemail = User::where('email', $request->email)->first();

        if ($cekemail) {
            return response()->json([
                'message' => 'Email Sudah terdaftar'
            ]);
        } else {

            $data = [

                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'status' => '1',
                'otp' => $random,
                'role' => 'customer',
          
            ];


            if ($data) {
                $users = User::create($data);
                Customer::create([
                    'id_user' => $users->id,
                    'nama' => $request->nama,
                    'status' => '1',
                    'saldo'=>0,
                ]);
                $email = $users->email;
                $name = $users->name;
                $data = [
                    'name' => $name,
                    'body' => "Kepada Pengguna : $name. ",
                    'otp' => $users->otp,

                ];

                Mail::send('api.otp', $data, function ($message) use ($name, $email) {


                    $message->to($email, $name)->subject('Pemberitahuan UNMER ');
                });

                return response()->json([
                    'code' => '200',
                    'message' => "OTP terkirim, Silahkan Cek Email",
                    'user' => $users
                ]);
            } else {
                return response()->json([
                    'code' => '500',
                    'message' => 'Gagal'
                ]);
            }
        }
    }

    public function login(Request $request)
    {
        $random = $this->getRandomString();

        $cekemail = User::where('email', $request->email)->first();
     
        


        if ($cekemail) {
            $email = $cekemail->email;
            $req = [
                'otp' => $random,
            ];

            // return $req;

            $cekemail->update($req);

            $name = $cekemail->name;
            $data = [
                'name' => $name,
                'body' => "Kepada Pengguna : $name. ",
                'otp' => $cekemail->otp,

            ];

            Mail::send('api.otp', $data, function ($message) use ($name, $email) {


                $message->to($email, $name)->subject('Pemberitahuan UNMER ');
            });

            return response()->json([
                'code' => '200',
                'message' => "OTP terkirim, Silahkan Cek Email",
               
            ]);
        } else {

            return response()->json([
                'code' => '500',
                'message' => "Email Tidak Terdaftar, Silahkan Daftar Akun",
            ]);
        }
    }

    public function otp(Request $request)
    {

        $cekotp = User::where('otp', $request->otp)->first();
       

        if ($cekotp) {

            $req = [
                'otp' => '',
            ];
            $cekotp->update($req);
            // return $cekotp->id;

            $data = DB::table('customers')->leftJoin('users','customers.id_user','users.id')
            ->select('users.*','users.id as id_user','customers.*','customers.id as id_customer')->where('users.id',$cekotp->id)->first();
            // return $data;
    

            return response()->json([
                'code' => '200',
                'message' => "OTP berhasil",
                'user'=>$data,
                // 'id'=>$data
            ]);
        } else {

            return response()->json([
                'code' => '500',
                'message' => "OTP gagal",
            ]);
        }
    }

    public function create_pin(Request $request)
    {

        $cek = User::where('id', $request->id)->first();


        if ($cek) {

            $req = [
                'pin' => $request->pin,
            ];

            // return $req;

            $cek->update($req);


            return response()->json([
                'code' => '200',
                'message' => "PIN berhasil dibuat",
            ]);
        } else {

            return response()->json([
                'code' => '500',
                'message' => "PIN gagal",
            ]);
        }
    }

    public function pin(Request $request)
    {

        $cekpin = User::where('pin', $request->pin)->first();


        if ($cekpin) {

            $req = [
                'pin' => '',
            ];

            // return $req;

            $cekpin->update($req);


            return response()->json([
                'code' => '200',
                'message' => "PIN berhasil",
            ]);
        } else {

            return response()->json([
                'code' => '500',
                'message' => "PIN gagal",
            ]);
        }
    }

    public function ubah_password(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user) {
            $user->update([
                // 'password' => bcrypt($request->password)
            ]);
            return response()->json([
                'message' => 'berhasil update password'
            ]);
        } else {

            return response()->json([
                'message' => 'gagal update password'
            ]);
        }
    }

    public function ubah_profil(Request $request)
    {
        $users =  User::where('id', $request->id)->first();
        $customer = Customer::where('id_user', $users->id)->first();



        if ($users && $customer) {
            $users->update([
                'no_telp' => $request->no_telp,
            ]);
            $customer->update([
                'alamat' => $request->alamat,
                'nik' => $request->nik,
                'nama' => $request->nama,
            ]);

            return response()->json([
                'code' => '200',
                'user' => [$users, $customer]
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'message' => 'gagal update profil'
            ]);
        }
    }
    public function get_profil($id)
    {
        $users =  DB::table('customers')
            ->leftjoin('users', 'users.id', 'customers.id_user')
            ->select('customers.*', 'customers.id as id_customer', 'users.*', 'users.id as idnya_user')->where('users.id', $id)->first();
        if ($users) {


            return response()->json([
                'code' => '200',
                'user' => $users
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'message' => 'Gagal'
            ]);
        }
    }
}
