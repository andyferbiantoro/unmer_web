<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\TransaksiKoperasi;
use App\Models\ProdukKoperasi;
use App\Models\TransaksiAgrikulture;
use App\Models\MarketAgrikulture;
use App\Models\ProdukAgrikulture;
use App\Models\Warna;
use App\Models\ListSize;
use App\Models\ListWarna;
use App\Models\Customer;
use App\Models\KategoriprodukAgrikulture;
use App\Models\KategoriprodukKoperasi;
use App\Models\KeranjangOffline;
use App\Models\TransaksiAgrikultureOffline;
use App\Models\DetailTransaksiAgrikulture;
use File;
use PDF;
use DB;
use Auth;

class AdminKasirController extends Controller
{
    //
	public function admin_kasir_dashboard()
	{

		return view('admin_kasir.index');
	}




	public function admin_kasir_agrikulture(request $request)
	{
		$kode_produk = $request->kode_produk;

		if ($kode_produk == null) {
			$cari_produk = ProdukAgrikulture::where('id','0')->get();
		}else{
			$cari_produk = ProdukAgrikulture::where('kode_produk',$kode_produk)->get();
		}

		// $keranjang_offline = KeranjangOffline::where('id_user_admin_kasir',Auth::user()->id)->get();
		$keranjang_offline = DB::table('keranjang_offlines')
		->join('produk_agrikultures', 'keranjang_offlines.id_produk_agrikulture', '=', 'produk_agrikultures.id')
		->select('keranjang_offlines.*', 'produk_agrikultures.nama_produk')
		->orderBy('keranjang_offlines.id', 'DESC')
		->where('keranjang_offlines.id_user_admin_kasir',Auth::user()->id)
		->get();


		$total_belanja = KeranjangOffline::where('id_user_admin_kasir',Auth::user()->id)->sum('total_harga');

		

		// return $get_id_market;
		return view('admin_kasir.agrikulture.kasir_agrikulture.index', compact('cari_produk','keranjang_offline','total_belanja'));
	}


	public function kasir_keranjang_add(Request $request, $id)
	{

		// return $id;
		$cek_keranjang = KeranjangOffline::where('id_produk_agrikulture',$id)->where('id_market',$request->input('id_market'))->first();


		if ($cek_keranjang == null) {
			$data_add = new KeranjangOffline();

			$data_add->id_user_admin_kasir = Auth::user()->id;
			$data_add->id_market = $request->input('id_market');
			$data_add->id_produk_agrikulture = $id;
			$data_add->kuantitas = '1';
			$data_add->total_harga = $request->input('total_harga');

			$data_add->save();
		}else{

			$data_update = KeranjangOffline::where('id_produk_agrikulture', $id)->first();	

			$input = [
				'kuantitas' => $data_update->kuantitas + '1' ,
				'total_harga' =>  $data_update->total_harga + $request->total_harga,
			];

			$data_update->update($input);
		}

	// return $cek_keranjang;

		return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan');
	}

	public function kasir_transaksi_offline_add(Request $request)
	{

		$get_keranjang_offline = KeranjangOffline::where('id_user_admin_kasir',Auth::user()->id)->get();
		$id_market=KeranjangOffline::where('id_user_admin_kasir',Auth::user()->id)->first();
		 	
		$data = ([
			'id_user_admin_kasir' => Auth::user()->id,
			'id_market_agrikulture' => $id_market->id_market,
			'nominal_barang' => $request['nominal_barang'],
			'nominal_bayar' => $request['nominal_bayar'],
			'nominal_kembalian' => $request['nominal_kembalian'],
			
		]);

		$lastid = TransaksiAgrikultureOffline::create($data)->id;

		foreach ($get_keranjang_offline as $data) {

			$detail_transaksi_offline = new DetailTransaksiAgrikulture();

			$detail_transaksi_offline->id_transaksi_agrikulture = $lastid;
			$detail_transaksi_offline->id_produk_agrikulture = $data->id_produk_agrikulture;
			$detail_transaksi_offline->kuantitas = $data->kuantitas;
			$detail_transaksi_offline->total_harga = $data->total_harga;

			$detail_transaksi_offline->save();
		}
		
		$delete_keranjang = KeranjangOffline::where('id_user_admin_kasir',Auth::user()->id)->get();

		foreach ($delete_keranjang as $key) {
			$key->delete();
		}

		return redirect()->back()->with('success', 'Transaksi Berhasil');
	}


}
