<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\Saldo;
use App\Models\TransaksiTopUp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        
        $bukti = TransaksiTopUp::where('id_user',$request->id_user)->update([
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
}