<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\Saldo;
use App\Models\TransaksiTopUp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
Use App\Models\Notif;
use App\Models\TransaksiKirimSaldo;
use Illuminate\Support\Facades\DB;

class SaldoController extends Controller
{
    //

    public function bank(){
        $bank = Bank::all();
        foreach($bank as $b){
            $b->logo = asset('uploads/bank/'.$b->logo);
        }
        if($bank){
            
            return response()->json([
                'code' => '200',
                'bank' => $bank
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }

    }
    public function topup(Request $request){

        $nominal = intval($request->nominal);
       
        $req = $request->all();
        $req['status_topup']='pending';
        $req['kode_transaksi']=strtoupper(Str::random(6));
        $req['id_user']=$request->id_user;
        $req['total_bayar']=2000+$nominal;
        $req['timer_transfer']=5;
        // $req['tanggal_topup']=date('Y-m-d');
        // return $req;
       $saldo = TransaksiTopUp::create($req);

       
        
        if($saldo){
            
            return response()->json([
                'code' => '200',
                'message' => 'Berhasil melakukan TopUp.Silahkan Kirim Bukti Tranfer'
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'message' => 'Gagal'
            ]);
        }

    }

    public function unggah_bukti(Request $request){

      
        $image = $request->file('bukti_transfer');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads/bukti_transfer_topup'), $imageName);

        
        $bukti = TransaksiTopUp::where('id_user',$request->id_user)->where('status_topup','pending')->orderBy('id','desc')->first()->update([
            'bukti_transfer'=>$imageName,
            'status_topup'=>'menunggu_konfirmasi'

        ]);
          
        if($bukti){
            
            return response()->json([
                'code' => '200',
                'message' => 'Berhasil mengirim Bukti Transfer. Menunggu Konfirmasi Admin'
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'message' => 'Gagal'
            ]);
        }


        
    }
    public function batal_topup(Request $request){

        $bukti = TransaksiTopUp::where('id_user',$request->id_user)->orderBy('id','desc')->first()->update([
       
            'status_topup'=>'batal'

        ]);
          
        if($bukti){
            
            return response()->json([
                'code' => '200',
                'message' => 'Transaksi Dibatalkan Oleh Sistem'
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'message' => 'Gagal'
            ]);
        }

    }



    public function saldo($id_user){
        $saldo =Customer::where('id_user',$id_user)->first();

        if($saldo){
            
            return response()->json([
                'code' => '200',
                'saldo' => $saldo->saldo
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }

    }


    public function history_saldo($id_user){
        $transaksi =TransaksiTopUp::where('id_user',$id_user)->orderBy('id','desc')->whereIn('status_topup',['menunggu_konfirmasi','berhasil','batal'])->get();
        foreach ($transaksi as $t){
            $t->bukti_transfer= asset('uploads/bukti_transfer_topup/'.$t->bukti_transfer);
        }

        if($transaksi){
            
            return response()->json([
                'code' => '200',
                'data' => $transaksi
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }

    }
    public function history_saldo_first($id){
        $transaksi =TransaksiTopUp::where('id',$id)->orderBy('id','desc')->first();
       
        $createdAt = $transaksi->updated_at;

        list($date, $time) = explode(' ', $createdAt);
        $timePart = $time;
        $carbonDate = Carbon::parse($date);
        $formattedDate = $carbonDate->translatedFormat('d-F-Y');

        $transaksi->bukti_transfer= asset('uploads/bukti_transfer_topup/'.$transaksi->bukti_transfer);
        $transaksi->tanggal=$formattedDate ;
        $transaksi->jam= $timePart;


        if($transaksi){
            
            return response()->json([
                'code' => '200',
                'data' => $transaksi
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }

    }

    
    public function transaksi_saldo_terakhir($id_user){
        $transaksi =TransaksiTopUp::where('id_user',$id_user)->orderBy('id','desc')->first();
        $createdAt = $transaksi->updated_at;

                list($date, $time) = explode(' ', $createdAt);
                $datePart = $date;
                $timePart = $time;
                $carbonDate = Carbon::parse($date);

                // Mengonversi tanggal ke format yang diinginkan
                $formattedDate = $carbonDate->translatedFormat('d-F-Y');
      
            $transaksi->bukti_transfer= asset('uploads/bukti_transfer_topup/'.$transaksi->bukti_transfer);
            $transaksi->tanggal=$formattedDate ;
            $transaksi->jam= $timePart;
       
        

        if($transaksi){
            
            return response()->json([
                'code' => '200',
                'data' => $transaksi
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }

    }

    // public function pesan_notifikasi(){
    //     $notif = new Notif;
    //     $token_device = '';
    //     $notif->sendNotifSaldo($token_device, "Saldo anda berhasil ditambah", "Notifikasi Saldo" );
           


    // }


    //kirim saldo
    public function getdatapenerima(Request $request){
        // $user =User::where('role','customer')->where('id_unmer',$request->id_unmer)->first();
        $userlast=DB::table('customers')
        ->leftjoin('users', 'users.id', 'customers.id_user')
        ->select('customers.nama', 'customers.id as id_customer', 'users.id_unmer', 'users.id as idnya_user')
        ->where('role','customer')->where('id_unmer',$request->id_unmer)->first();

        if($userlast){
            return response()->json([
                'code' => '200',
                'data' => $userlast
            ]);
    
        }else{
            return response()->json([
                'code' => '500',
                'data' => ['nama'=>'Penerima Tidak Tersedia']
            ]);
    

        }

     
       
    }

    public function kirimsaldo(Request $request){
        $req = $request->all();
        $req['kode_transaksi']=strtoupper(Str::random(6));

        if($request->jenis_kirim_saldo=='sesama'){
            $req['status'] ='berhasil';
            $transaksi = TransaksiKirimSaldo::create($req);
            $adm =   Admin::where('role_admin','superadmin')->first();
            $akhir = $adm->saldo +$transaksi->biaya_layanan;
            // return $akhir;
            $adm->update([
                'saldo'=>$akhir
            ]);
            $cust = Customer::where('id_user',$transaksi->id_user_pengirim)->first();
            $sisa = $cust->saldo - $transaksi->total;
            $cust->update([
                'saldo'=>$sisa
            ]);

            return response()->json([
                'code' => '200',
                'message' => 'Transaksi Kirim Saldo Berhasil Ke sesama Unmer'
            ]);

        }else{
            $req['bank'] =$request->bank;
            $req['rekening_bank'] =$request->rekening_bank;
            $req['status'] ='pending';
            $transaksi = TransaksiKirimSaldo::create($req);
            $adm =   Admin::where('role_admin','superadmin')->first();
            $akhir = $adm->saldo +$transaksi->biaya_layanan;
            // return $akhir;
            $adm->update([
                'saldo'=>$akhir
            ]);
            return response()->json([
                'code' => '201',
                'message' => 'Transaksi Kirim Saldo Berhasil Ke Bank'
            ]);

        }
    }

    public function getkirimsaldo_last(Request $request){

        $ks = TransaksiKirimSaldo::where('id_user_pengirim',$request->id)->where('status',$request->status)->orderBy('id','desc')->first();
        $pengirim = Customer::where('id_user',$ks->id_user_pengirim)->first();
        $ks->pengirim =$pengirim->nama;
        if($ks->id_user_penerima!=null){
            $penerima = Customer::where('id_user',$ks->id_user_penerima)->first();
            $ks->penerima =$penerima->nama;
        }
        else{
            $ks->id_user_penerima =0;
        }
        $createdAt = $ks->updated_at;

        list($date, $time) = explode(' ', $createdAt);
        $timePart = $time;
        $carbonDate = Carbon::parse($date);
        $formattedDate = $carbonDate->translatedFormat('d-F-Y');
        $ks->tanggal=$formattedDate ;
        $ks->jam= $timePart;

        if($ks){
            return response()->json([
                'code' => '200',
                'data' => $ks
            ]);
    
        }else{
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
    

        }
            
    }

    
    public function getkirimsaldo_detail($id){

        $ks = TransaksiKirimSaldo::where('id',$id)->orderBy('id','desc')->first();
        $pengirim = Customer::where('id_user',$ks->id_user_pengirim)->first();
        $ks->pengirim =$pengirim->nama;
        if($ks->id_user_penerima!=null){
        $penerima = Customer::where('id_user',$ks->id_user_penerima)->first();
        $ks->penerima =$penerima->nama;
        }else{
            $ks->id_user_penerima =0;
        }
       
        $createdAt = $ks->updated_at;

        list($date, $time) = explode(' ', $createdAt);
        $timePart = $time;
        $carbonDate = Carbon::parse($date);
        $formattedDate = $carbonDate->translatedFormat('d-F-Y');
        $ks->tanggal=$formattedDate ;
        $ks->jam= $timePart;

        if($ks){
            return response()->json([
                'code' => '200',
                'data' => $ks
            ]);
    
        }else{
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
    

        }
            
    }

    public function history_kirim_saldo($id){
        $ks = TransaksiKirimSaldo::where('id_user_pengirim',$id)->orderBy('id','desc')->get();
        // $ks = DB::table('transaksi_kirim_saldos')
        // ->leftJoin('customers as pengirim','transaksi_kirim_saldos.id_user_pengirim','pengirim.id_user')
        // ->leftJoin('customers as penerima','transaksi_kirim_saldos.id_user_penerima','penerima.id_user')
        // ->select('pengirim.nama as pengirim','penerima.nama as penerima','transaksi_kirim_saldos.*')
        // ->where('transaksi_kirim_saldos.id_user_pengirim',$id)->orderBy('id','desc')->get();
        foreach ($ks as $k){
            $pengirim = Customer::where('id_user',$k->id_user_pengirim)->first();
            if($k->id_user_penerima!=null){
                $penerima = Customer::where('id_user',$k->id_user_penerima)->first();
                $k->penerima =$penerima->nama;
            }else{
                $k->id_user_penerima =0;
            }
           
            // return[$pengirim,$penerima];
            $k->pengirim =$pengirim->nama;
            
            $createdAt = $k->updated_at;

            list($date, $time) = explode(' ', $createdAt);
            $timePart = $time;
            $carbonDate = Carbon::parse($date);
            $formattedDate = $carbonDate->translatedFormat('d-F-Y');
            $k->tanggal=$formattedDate ;
            $k->jam= $timePart;

        }
        if($ks){
            return response()->json([
                'code' => '200',
                'data' => $ks
            ]);
    
        }else{
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
    

        }

    }

}
