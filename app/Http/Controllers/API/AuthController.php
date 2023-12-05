<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\KontakBantuan;
use App\Models\StatusMenu;
use App\Models\TransaksiAgrikulture;
use App\Models\TransaksiKirimSaldo;
use App\Models\TransaksiKoperasi;
use App\Models\TransaksiTopUp;
use App\Models\User;
use Carbon\Carbon;
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

    public function random_id_unmer($panjang = 16)
    {
        $karakter = '0123456789';
        $panjang_karakter = strlen($karakter);
        $randomString = '';
        for ($i = 0; $i < $panjang; $i++) {
            $randomString .= $karakter[rand(0, $panjang_karakter - 1)];
        }
        return $randomString;
    }

    public function random_no_unmer($panjang = 10)
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
        $randomid = $this->random_id_unmer();
        $randomno = $this->random_no_unmer();
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
                'id_unmer'=>$randomid,
                'no_unmer'=>$randomno,
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

            if($cekemail->role='driver'){
                $cekemail->update([
                    'otp'=>1234
                ]);
                
            return response()->json([
                'code' => '200',
                'message' => "OTP Driver berhasil di set",
               
            ]);
            }else{

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

            }
         

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
            if($cekotp->role=='driver'){
                $data = DB::table('drivers')->leftJoin('users','drivers.id_user','users.id')
            ->select('users.*','users.id as id_user','drivers.*','drivers.id as id_driver')->where('users.id',$cekotp->id)->first();
            $data->foto= asset('uploads/profil/'.$data->foto);

            }else{
                $data = DB::table('customers')->leftJoin('users','customers.id_user','users.id')
            ->select('users.*','users.id as id_user','customers.*','customers.id as id_customer')->where('users.id',$cekotp->id)->first();
            $data->foto= asset('uploads/profil/'.$data->foto);

            }

            
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
        $data = $request->except(['no_telp','id','email','latitude','longitude']);
        $datac = $request->except(['alamat','nama','nik','id']);



        if ($users && $customer) {
            $users->update($datac);
            $customer->update($data);
            
            $data = DB::table('customers')->leftJoin('users','customers.id_user','users.id')
            ->select('users.*','users.id as id_user','customers.*','customers.id as id_customer')->where('users.id',$request->id)->first();
            $data->foto= asset('uploads/profil/'.$data->foto);

            return response()->json([
                'code' => '200',
                'user' => $data
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

public function updateUserProfile(Request $request)
{
  
    if ($request->hasFile('foto')) {

        $user = User::where('id', $request->id)->first();
        // return $user;

        $oldPhoto = $user->foto;

        if($oldPhoto!='default.jpg'){

      
        if (!empty($oldPhoto)) {
            $oldPhotoPath = public_path('uploads/profil') . '/' . $oldPhoto;
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
    }
      
        $image = $request->file('foto');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/profil'), $imageName);

        
        User::where('id',$request->id)->update([
            'foto'=>$imageName
        ]);

        $userlast=DB::table('customers')
        ->leftjoin('users', 'users.id', 'customers.id_user')
        ->select('customers.*', 'customers.id as id_customer', 'users.*', 'users.id as idnya_user')->where('users.id', $request->id)->first();

        $userlast->foto= asset('uploads/profil/'.$userlast->foto);
        return response()->json([
            'code' => '200',
            'foto'=>$userlast->foto,
            'message' => 'Profil pengguna berhasil diperbarui'
        ]);


    }else{

        return response()->json([
            'code' => '500',
            'message' => 'Profil pengguna gagal diperbarui'
        ]);
    }

       

 
}

//no auth
public function getno_bantuan(){
    $no = '6285186680098';
    $k = KontakBantuan::first();
            
        return response()->json([
            'code' => '200',
            'data' =>  ['nomor' => $k->no_telp]
        ]);
}

public function getstatus_menu_apk(Request $request){
    $status =StatusMenu::where('menu',$request->menu)->first();
    return response()->json([
        'code' => '200',
        'data' => $status
    ]);

}


public function total_pemasukan_bulan($id){
    $startDate = Carbon::now()->subMonth(); // Tanggal mulai 1 bulan yang lalu
    $endDate = Carbon::now(); // Tanggal sekarang

    $carbonDate = Carbon::parse($startDate);
    $carbonDate2 = Carbon::parse($endDate);

$bulan = $carbonDate->format('F');
$tanggal = $carbonDate->format('d'); 
$tahun = $carbonDate->format('Y'); 

$bulan2 = $carbonDate2->format('F');
$tanggal2 = $carbonDate2->format('d'); 
$tahun2 = $carbonDate2->format('Y'); 
$start = $tanggal.'-'.$bulan.'-'.$tahun;
$end = $tanggal2.'-'.$bulan2.'-'.$tahun2;



    $total_pemasukan1 = TransaksiKirimSaldo::whereBetween('updated_at', [$startDate, $endDate])->where('id_user_penerima',$id)->sum('nominal_kirim');
    $total_pemasukan = intval($total_pemasukan1);

    $total1 = TransaksiAgrikulture::whereBetween('updated_at', [$startDate, $endDate])->where('id_user',$id)->sum('nominal');
    $total2 = TransaksiKoperasi::whereBetween('updated_at', [$startDate, $endDate])->where('id_user',$id)->sum('nominal');
    $total3 = TransaksiTopUp::whereBetween('updated_at', [$startDate, $endDate])->where('status_topup','berhasil')->where('id_user',$id)->sum('nominal');
    $total_pengeluaran = $total1+$total2+$total3;

    return response()->json([
        'code' => '200',
        'data' =>  ['pemasukan' =>$total_pemasukan,'pengeluaran' =>$total_pengeluaran,
        'start' =>$start,'end' =>$end,]
    ]);


}


}
