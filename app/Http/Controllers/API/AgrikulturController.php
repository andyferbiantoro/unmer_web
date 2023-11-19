<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\DetailMarketAgrikulture;
use App\Models\DetailTransaksiAgrikulture;
use App\Models\KategoriProdukAgrikulture;
use App\Models\Keranjang;
use App\Models\MarketAgrikulture;
use App\Models\ProdukAgrikulture;
use App\Models\TransaksiAgrikulture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nette\Utils\Json;
use Termwind\Components\Raw;

class AgrikulturController extends Controller
{
    //
    public function ip(Request $request){
        return $request->ip();
    }
        
    public function list_market()
    {

        $market = MarketAgrikulture::get();
        foreach($market as $m){
            $m->detail_market =DetailMarketAgrikulture::get();
        }

        if ($market) {

            return response()->json([
                'code' => '200',
                'data' => $market
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }

    public function list_produk_market($id_market)
    {

        $produk = ProdukAgrikulture::where('id_market', $id_market)->orderBy('id', 'desc')->get();
        // $produk = DB::table('produk_agrikultures')
        // ->leftjoin('kategori_produk_agrikultures','produk_agrikultures.id_kategori_produk','kategori_produk_agrikultures.id')
        // ->select('kategori_produk_agrikultures.*','produk_agrikultures.*')
        // ->where('id_market', $id_market)->orderBy('produk_agrikultures.id', 'desc')->get();
        foreach ($produk as $v) {
            $v->foto = asset('Image/agrikultur/' . $v->foto);
        }

        if ($produk) {

            return response()->json([
                'code' => '200',
                'data' => $produk
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }
    public function list_kategori_produk_agri()
    {

        $produk = KategoriProdukAgrikulture::orderBy('id', 'desc')->get();
 
    
        if ($produk) {

            return response()->json([
                'code' => '200',
                'data' => $produk
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }

    public function keranjang(Request $request)
    {
        $keranjangcek = Keranjang::where('id_user', $request->id_user)->where('id_produk_agrikulture', $request->id_produk_agrikulture)->first();


        $kuantitas = $request->kuantitas;
        $harga = $request->harga;
        $id_produk_agrikulture = $request->id_produk_agrikulture;

        if ($keranjangcek) {
            // return 'update';
            //  =$kuantitas+$keranjangcek->kuantitas;
            $kuantitasbaru = intval($kuantitas) + $keranjangcek->kuantitas;
            // return $kuantitasbaru;
            $keranjangcek->update([
                'kuantitas' =>  $kuantitasbaru,

            ]);
            // return $keranjangcek;
            return response()->json([
                'code' => 200,
                'message' => 'Berhasil Menambahkan kuantitas di Keranjang'
            ]);
        } else {
            // return 'baru';

            Keranjang::create($request->all());
            // return $k;
            return response()->json([
                'code' => 200,
                'message' => 'Berhasil Menambahkan di Keranjang'
            ]);
        }
    }

    public function hapus_keranjang(Request $request)
    {
        Keranjang::where('id_user', $request->id_user)->where('id_produk_agrikulture', $request->id_produk_agrikulture)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Berhasil Menghapus produk di Keranjang'
        ]);
    }

    function cektransaksi() {
        
    }

    public function create_transaki_market(Request $request)
    {
        $produkIds = [8,9,10];

        //  return $request->id_product;


// return $harga_produk;
        $saldoawal = Customer::where('id_user', $request->id_user)->first();
  
        $transaksi = TransaksiAgrikulture::create([
            'id_user' => $request->id_user,
            'status_pemesanan' => 'menunggu_pembayaran',
            'status_pembayaran' => 'sukses',
            'tanggal_pengiriman' => $request->tanggal_pengiriman,
            'waktu_pengiriman' => $request->waktu_pengiriman,
            // 'nominal' => $request->nominal,
            'kode_transaksi' =>  strtoupper(Str::random(8)),
            'catatan'=>$request->catatan,
            'alamat'=>$request->alamat,
            'metode_pengiriman'=>$request->metode_pengiriman
        ]);

        $id_prduc = json_decode($request->id_product);
        $kuantitas = json_decode($request->kuantitas);
        $harga_produk = ProdukAgrikulture::whereIn('id', $id_prduc)->get();
        $total=0;
        foreach($harga_produk as $n=>$p){
            $qty = $kuantitas[$n];
            $tt=$qty*$p->harga_produk;
            // return $tt;
            $total = $total+$tt;

            $req_detail =[
                'id_transaksi_agrikulture'=>$transaksi->id,
                'id_produk_agrikulture'=>$p->id,
                'kuantitas'=>$qty,
                'total'=>$tt
            ];
            $detail = DetailTransaksiAgrikulture::create($req_detail);
        }
        Keranjang::where('id_user', $request->id_user)->whereIn('id_produk_agrikulture',$id_prduc)->delete();
        TransaksiAgrikulture::where('id',$transaksi->id)->update([
            'nominal'=>$total
        ]);

        $saldokahir = ($saldoawal->saldo - intval($total));
        $saldoawal->update([
            'saldo' => $saldokahir
        ]);
        return response()->json([  'code' => '200',
        'data' => $transaksi->kode_transaksi]);
    

    


        // if ($transaksi) {

        //     return response()->json([
        //         'code' => '200',
        //         'message' => 'Berhasil Membuat Pesanan, Pesanan Dikemas'
        //     ]);
        // } else {
        //     return response()->json([
        //         'code' => '500',
        //         'message' => 'Gagal'
        //     ]);
        // }
    }



    public function list_transaki_market($id_user)
    {


        $transaksi = TransaksiAgrikulture::with('detail_transaksi.produk_agrikultures')->where('id_user', $id_user)
            ->orderBy('id', 'desc')->get();


        if ($transaksi) {

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
    public function list_keranjang(Request $request)
    {
        $keranjang = DB::table('keranjangs')
            ->leftJoin('produk_agrikultures', 'keranjangs.id_produk_agrikulture', 'produk_agrikultures.id')
            ->leftJoin('market_agrikultures', 'produk_agrikultures.id_market', 'market_agrikultures.id')
            ->select('produk_agrikultures.*', 'market_agrikultures.*', DB::Raw('CAST(keranjangs.id_produk_agrikulture AS UNSIGNED) as id'))
            ->where('id_user', $request->id_user)->where('id_market', $request->id_market)->get();

        foreach ($keranjang as $k) {
            $k->foto = asset('uploads/produk_agrikulture/' . $k->foto);
        }

        // Keranjang::where('id_user', $id_user)->orderBy('id', 'desc')->get();
        // return $keranjang;
        // foreach ($keranjang as $k) {
        //     $market = ProdukAgrikulture::where('id', $k->id_produk_agrikulture)->orderBy('id', 'desc')->get();
        //     return $market;
        // }



        if ($keranjang) {

            return response()->json([
                'code' => '200',
                'data' => $keranjang
            ]);
        } else {
            return response()->json([
                'code' => '500',
                'data' => []
            ]);
        }
    }

    public function total_keranjang($id_user)
    {
        $total = Keranjang::where('id_user', $id_user)->count();
        if ($total) {

            return response()->json([
                'code' => '200',
                'data' => $total
            ]);
        } else {
            return response()->json([
                'code' => '200',
                'data' => 0
            ]);
        }
    }
    public function cek_kode_transaksi($kode_transkasi)
    {
        // $cek = TransaksiAgrikulture::where('kode_transaksi', $kode_transkasi)->first();
        $cek = TransaksiAgrikulture::with('detail_transaksi.produk_agrikultures')->where('kode_transaksi', $kode_transkasi)
        ->orderBy('id', 'desc')->first();
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
