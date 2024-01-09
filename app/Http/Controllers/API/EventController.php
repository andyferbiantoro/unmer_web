<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\DetailEvent;
use App\Models\Event;
use App\Models\TiketEvent;
use DateTime;
use Illuminate\Http\Request;
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

    
    // public function create_transaki_tiket(Request $request)
    // {
    //     $produkIds = [8, 9, 10];

    //     //  return $request->id_product;


    //     // return $harga_produk;
    //     $saldoawal = Customer::where('id_user', $request->id_user)->first();

    //     $transaksi = Transaksi::create([
    //         'id_user' => $request->id_user,
    //         'kode_transaksi' =>  strtoupper(Str::random(8)),
    //         'biaya_layanan'=>$request->biaya_layanan
    //     ]);

    //     $id_prduc = json_decode($request->id_product);
    //     $kuantitas = json_decode($request->kuantitas);
       
    //     $harga_produk = TiketEvent::whereIn('id', $id_prduc)->get();
      
    //     $total = 0;
    //     foreach ($harga_produk as $n => $p) {
    //         $qty = $kuantitas[$n];
    //         $tt = $qty * $p->harga_produk;
    //         // return $tt;
    //         $total = $total + $tt;

    //         $req_detail = [
    //             'id_transaksi_tiket' => $transaksi->id,
    //             'id_tiket_event' => $p->id,
    //             'id_event' => $request->id_event,
    //             'kuantitas' => $qty,
    //             'total' => $tt
    //         ];
    //         Detail::create($req_detail);
    //     }
    //     // Keranjang::where('id_user', $request->id_user)->whereIn('id_produk_agrikulture', $id_prduc)->delete();
    //     Transaksi::where('id', $transaksi->id)->update([
    //         'nominal' => $total,
    //         'id_market_agrikulture'=>$harga_produk[0]->id_market
    //     ]);

    //     $saldokahir = ($saldoawal->saldo - intval($total+$transaksi->biaya_layanan+$transaksi->biaya_ongkir));
    //     $saldoawal->update([
    //         'saldo' => $saldokahir
    //     ]);

    //     $adm =   Admin::where('role_admin','superadmin')->first();
    //     $akhir = $adm->saldo +$transaksi->biaya_layanan;
    //     // return $akhir;
    //     $adm->update([
    //         'saldo'=>$akhir
    //     ]);

    //     return response()->json([
    //         'code' => '200',
    //         'data' => $transaksi->kode_transaksi
    //     ]);

    // }
}
