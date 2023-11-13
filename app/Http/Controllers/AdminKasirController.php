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
		//filter produk  menggunkana kode produk
		$kode_produk = $request->kode_produk;

		if ($kode_produk == null) {
			$cari_produk = ProdukAgrikulture::where('id','0')->get();
		}else{
			$cari_produk = ProdukAgrikulture::where('kode_produk',$kode_produk)->get();
		}

		//get data keranjang offline
		$keranjang_offline = DB::table('keranjang_offlines')
		->join('produk_agrikultures', 'keranjang_offlines.id_produk_agrikulture', '=', 'produk_agrikultures.id')
		->select('keranjang_offlines.*', 'produk_agrikultures.nama_produk')
		->orderBy('keranjang_offlines.id', 'DESC')
		->where('keranjang_offlines.id_user_admin_kasir',Auth::user()->id)
		->get();

		//total belanja pada keranjang offline
		$total_belanja = KeranjangOffline::where('id_user_admin_kasir',Auth::user()->id)->sum('total_harga');

		

		// return $get_id_market;
		return view('admin_kasir.agrikulture.kasir_agrikulture.index', compact('cari_produk','keranjang_offline','total_belanja'));
	}


	public function kasir_keranjang_add(Request $request, $id)
	{

		
		$cek_keranjang = KeranjangOffline::where('id_produk_agrikulture',$id)->where('id_market',$request->input('id_market'))->first();

		//proses add data pada keranjang offline, jika belum ada maka data diinputkan ke tabel
		if ($cek_keranjang == null) {
			$data_add = new KeranjangOffline();

			$data_add->id_user_admin_kasir = Auth::user()->id;
			$data_add->id_market = $request->input('id_market');
			$data_add->id_produk_agrikulture = $id;
			$data_add->kuantitas = '1';
			$data_add->total_harga = $request->input('total_harga');

			$data_add->save();
		}else{
			//jika data sudah ada, maka hanya menambahkan kuantitas dan total harga
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
		//add data ke tabel transaksi agrikulture offline
		$get_keranjang_offline = KeranjangOffline::where('id_user_admin_kasir',Auth::user()->id)->get();
		$id_market = KeranjangOffline::where('id_user_admin_kasir',Auth::user()->id)->first();

		$data = ([
			'id_user_admin_kasir' => Auth::user()->id,
			'id_market_agrikulture' => $id_market->id_market,
			'nominal_barang' => $request['nominal_barang'],
			'nominal_bayar' => $request['nominal_bayar'],
			'nominal_kembalian' => $request['nominal_kembalian'],
			
		]);

		$lastid = TransaksiAgrikultureOffline::create($data)->id;

		//get data dari keranjang offline dan dimasukkan ke tabel detail transaksi agrikulture
		foreach ($get_keranjang_offline as $data) {

			$detail_transaksi_offline = new DetailTransaksiAgrikulture();

			$detail_transaksi_offline->id_transaksi_agrikulture_offline = $lastid;
			$detail_transaksi_offline->id_produk_agrikulture = $data->id_produk_agrikulture;
			$detail_transaksi_offline->kuantitas = $data->kuantitas;
			$detail_transaksi_offline->total_harga = $data->total_harga;

			$detail_transaksi_offline->save();
		}


		//ubah stok dan sold produk
		foreach ($get_keranjang_offline as $key ) {
			
			$update_stok = ProdukAgrikulture::where('id', $key->id_produk_agrikulture)->first();	

			$input = [
				'stok' => $update_stok->stok - $key->kuantitas ,
				'sold' => $update_stok->sold + $key->kuantitas ,
			];

			$update_stok->update($input);
		}
		

		//hapus data keranjang offline
		$delete_keranjang = KeranjangOffline::where('id_user_admin_kasir',Auth::user()->id)->get();

		foreach ($delete_keranjang as $key) {
			$key->delete();
		}



		return redirect()->route('admin_kasir_transaksi_agrikulture_selesai')->with('success', 'Transaksi Berhasil');
	}

	public function kasir_batalkan_produk($id)
	{
		
		$batalkan_produk = KeranjangOffline::findOrFail($id);
		$batalkan_produk->delete();

		return redirect()->back()->with('error', 'Produk Telah Dibatalkan');
	}


	public function admin_kasir_transaksi_agrikulture_selesai()
	{

		$transaksi_offline = TransaksiAgrikultureOffline::where('id_user_admin_kasir',Auth::user()->id)->orderBy('id', 'DESC')->first();

		// $detail_transaksi = DetailTransaksiAgrikulture::where('id_transaksi_agrikulture',$transaksi_offline->id)->get();

		$detail_transaksi = DB::table('detail_transaksi_agrikultures')
		->join('transaksi_agrikulture_offlines', 'detail_transaksi_agrikultures.id_transaksi_agrikulture', '=', 'transaksi_agrikulture_offlines.id')
		->join('produk_agrikultures', 'detail_transaksi_agrikultures.id_produk_agrikulture', '=', 'produk_agrikultures.id')
		->select('detail_transaksi_agrikultures.*', 'produk_agrikultures.nama_produk','produk_agrikultures.harga_produk',)
		->orderBy('detail_transaksi_agrikultures.id', 'DESC')
		->where('id_transaksi_agrikulture',$transaksi_offline->id)
		->get();

		 // return $transaksi_offline;

		return view('admin_kasir.agrikulture.kasir_agrikulture.transaksi_selesai',compact('transaksi_offline','detail_transaksi'));
	}


	public function admin_kelola_agrikulture()
	{
		$produk_agrikulture = DB::table('produk_agrikultures')
		->join('market_agrikultures', 'produk_agrikultures.id_market', '=', 'market_agrikultures.id')
		->select('produk_agrikultures.*', 'market_agrikultures.nama_toko')
		->orderBy('produk_agrikultures.id', 'DESC')
		->get();

		$market = MarketAgrikulture::all();
		//return $produk_agrikulture;
		$kat = KategoriprodukAgrikulture::all();
		return view('admin_kasir.agrikulture.produk_agrikulture.index', compact('produk_agrikulture', 'market','kat'));
	}


	public function admin_kasir_ubah_stok_agrikulture(Request $request, $id)
	{

		$data_update = ProdukAgrikulture::where('id',$id)->first();	

		$input = [
			'stok' => $request->stok,
		];

		$data_update->update($input);

		return redirect()->back()->with('success', 'Stok Produk Berhasil Diperbarui');
	}



}
