<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\DetailEvent;
use App\Models\Event;
use App\Models\TiketEvent;
use App\Models\TransaksiEvent;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventController extends Controller
{
    //
    
    public function list_event(){
        $k = Event::orderBy('id','desc')->get();
        foreach($k as $v){
            $tanggalObj = new DateTime($v->tanggal_event);

            $namaBulan = $tanggalObj->format("F");
            
            $v->nama_bulan = $namaBulan;
            $v->foto = asset('uploads/event/' . $v->foto_event);
        }
        if ($k) {

            return response()->json([
                'code' => '200',
                'data' => $k
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }

    public function list_tiket_event($id_event){
        $k = TiketEvent::where('id_event',$id_event)->orderBy('id','desc')->get();
        foreach($k as $v){
            
            $v->foto = asset('uploads/event/' . $v->foto_event);
        }
        if ($k) {

            return response()->json([
                'code' => '200',
                'data' => $k
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }

    }

    public function fasilitas($id_event){
        $k = DetailEvent::where('id_event',$id_event)->orderBy('id','desc')->get();
        
        if ($k) {

            return response()->json([
                'code' => '200',
                'data' => $k
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }
    

    
    public function create_transaki_tiket(Request $request)
    {
        $produkIds = [8, 9, 10];

        //  return $request->id_product;


        // return $harga_produk;
        $saldoawal = Customer::where('id_user', $request->id_user)->first();

        $transaksi = TransaksiEvent::create([
            'id_customer' => $request->id_user,
            'kode_transaksi' =>  strtoupper(Str::random(8)),
            'biaya_layanan'=>$request->biaya_layanan,
            'id_event'=>$request->id_event,
            'id_tiket'=>$request->id_tiket,
            'nominal'=>$request->nominal,
            'status'=>'pending'

        ]);

        // $id_prduc = json_decode($request->id_product);
        // $kuantitas = json_decode($request->kuantitas);
       
        // $harga_produk = TiketEvent::whereIn('id', $id_prduc)->get();
      
        // $total = 0;
        // foreach ($harga_produk as $n => $p) {
        //     $qty = $kuantitas[$n];
        //     $tt = $qty * $p->harga_produk;
        //     // return $tt;
        //     $total = $total + $tt;

        //     $req_detail = [
        //         'id_transaksi_tiket' => $transaksi->id,
        //         'id_tiket_event' => $p->id,
        //         'id_event' => $request->id_event,
        //         'kuantitas' => $qty,
        //         'total' => $tt
        //     ];
        //     Detail::create($req_detail);
        // }
        // Keranjang::where('id_user', $request->id_user)->whereIn('id_produk_agrikulture', $id_prduc)->delete();
        // Transaksi::where('id', $transaksi->id)->update([
        //     'nominal' => $total,
        //     'id_market_agrikulture'=>$harga_produk[0]->id_market
        // ]);

        $saldokahir = ($saldoawal->saldo - intval($transaksi->nominal));
        $saldoawal->update([
            'saldo' => $saldokahir
        ]);

        $adm =   Admin::where('role_admin','superadmin')->first();
        $akhir = $adm->saldo +$transaksi->biaya_layanan;
        // return $akhir;
        $adm->update([
            'saldo'=>$akhir
        ]);

        return response()->json([
            'code' => '200',
            'data' => $transaksi->kode_transaksi
        ]);

    }

    public function cektiket(Request $request){
        // $cek = TransaksiEvent::where('kode_transaksi', $request->kode_transaksi)
        // ->orderBy('id', 'desc')->first();

        $cek = DB::table('transaksi_events')
        ->leftJoin('events','transaksi_events.id_event','events.id')
        ->leftJoin('customers','transaksi_events.id_customer','customers.id')
        ->select('customers.nama','events.judul_event','transaksi_events.*')
        ->where('kode_transaksi', $request->kode_transaksi)
        ->orderBy('transaksi_events.id', 'desc')->first();



        if ($cek) {

            if($cek->status=='pending'){
        

                return response()->json([
                    'code' => 200,
                    'message' => 'Tiket Ada',
                    'data'=>$cek
                    
                ]);
            }else{
                return response()->json([
                    'code' => 400,
                    'message' => 'Tiket Kadaluwarsa',
                    // 'data'=>$cek
                    
                ]);
            }
           


        }else{
            return response()->json([
                'code' => 500,
                'message' => 'Kode Tiket Tidak Ditemukan'
            ]);

        }

    }

    
    public function registrasi_tiket(Request $request){
        $cek = TransaksiEvent::where('kode_transaksi', $request->kode_transaksi)
        ->orderBy('id', 'desc')->first();

        if ($cek) {

            if($cek->status=='pending'){
            $cek->update([
                'status'=>'valid'
            ]);

                return response()->json([
                    'code' => 200,
                    'message' => 'Tiket Berhasil Registrasi',
                    
                ]);

            }else{
                return response()->json([
                    'code' => 400,
                    'message' => 'Tiket Kadaluwarsa',
                    
                ]);
            }
           
           


        }else{
            return response()->json([
                'code' => 500,
                'message' => 'Kode Tiket Tidak Ditemukan'
            ]);

        }

    }


    public function list_transaksi_tiket($id_user){

        $cek = DB::table('transaksi_events')
        ->leftJoin('events','transaksi_events.id_event','events.id')
        ->leftJoin('customers','transaksi_events.id_customer','customers.id')
        ->leftJoin('tiket_events','transaksi_events.id_tiket','tiket_events.id')
        ->select('customers.nama','events.*','tiket_events.*','transaksi_events.*')
        ->where('transaksi_events.id_customer',$id_user)
        ->orderBy('transaksi_events.id', 'desc')->get();

        if ($cek) {

            return response()->json([
                'code' => '200',
                'data' => $cek
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }

    
    public function list_transaksi_tiket_first($id){

        $cek = DB::table('transaksi_events')
        ->leftJoin('events','transaksi_events.id_event','events.id')
        ->leftJoin('customers','transaksi_events.id_customer','customers.id')
        ->leftJoin('tiket_events','transaksi_events.id_tiket','tiket_events.id')
        ->select('customers.nama','events.*','tiket_events.*','transaksi_events.*')
        ->where('transaksi_events.id',$id)
        ->orderBy('transaksi_events.id', 'desc')->get();

        if ($cek) {

            return response()->json([
                'code' => '200',
                'data' => $cek
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }
}
