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
use App\Models\KategoriProdukAgrikulture;
use App\Models\KategoriProdukKoperasi;
use App\Models\KeranjangOffline;
use App\Models\KeranjangKoperasiOffline;
use App\Models\TransaksiAgrikultureOffline;
use App\Models\DetailTransaksiAgrikulture;
use App\Models\DetailTransaksiKoperasi;
use App\Models\TransaksiKoperasiOffline;
use App\Models\Size;
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
			$detail_transaksi_offline->total = $data->total_harga;

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
		->join('transaksi_agrikulture_offlines', 'detail_transaksi_agrikultures.id_transaksi_agrikulture_offline', '=', 'transaksi_agrikulture_offlines.id')
		->join('produk_agrikultures', 'detail_transaksi_agrikultures.id_produk_agrikulture', '=', 'produk_agrikultures.id')
		->select('detail_transaksi_agrikultures.*', 'produk_agrikultures.nama_produk','produk_agrikultures.harga_produk',)
		->where('detail_transaksi_agrikultures.id_transaksi_agrikulture_offline',$transaksi_offline->id)
		->orderBy('detail_transaksi_agrikultures.id', 'DESC')
		->get();

		 // return $transaksi_offline;
		  // return $detail_transaksi;

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
		$kat = KategoriProdukAgrikulture::all();
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



	public function admin_kasir_lihat_pesanan_agrikulture_diantar()
	{	

		$pesanan_diantar = DB::table('transaksi_agrikultures')
		->join('customers', 'transaksi_agrikultures.id_user', '=', 'customers.id_user')
		->select('transaksi_agrikultures.*', 'customers.nama')
		->orderBy('transaksi_agrikultures.id', 'DESC')
		->where('transaksi_agrikultures.metode_pengiriman','diantar')
		->get();

		
		
		return view('admin_kasir.agrikulture.lihat_pesanan.pesanan_diantar', compact('pesanan_diantar'));
	}


	public function admin_kasir_lihat_pesanan_agrikulture_diambil()
	{	

		$pesanan_diambil = DB::table('transaksi_agrikultures')
		->join('customers', 'transaksi_agrikultures.id_user', '=', 'customers.id_user')
		->select('transaksi_agrikultures.*', 'customers.nama')
		->orderBy('transaksi_agrikultures.id', 'DESC')
		->where('transaksi_agrikultures.metode_pengiriman','diambil')
		->get();
		
		return view('admin_kasir.agrikulture.lihat_pesanan.pesanan_diambil', compact('pesanan_diambil'));
	}


	public function admin_kasir_lihat_pesanan_agrikulture_offline()
	{	

		$pesanan_offline = TransaksiAgrikultureOffline::where('id_user_admin_kasir',Auth::user()->id )->orderBy('id', 'DESC')->get();
		
		return view('admin_kasir.agrikulture.lihat_pesanan.pesanan_offline', compact('pesanan_offline'));
	}


	public function detail_pesanan_offline($id)
	{

		$transaksi_offline = TransaksiAgrikultureOffline::where('id', $id)->orderBy('id', 'DESC')->first();

		// $detail_transaksi = DetailTransaksiAgrikulture::where('id_transaksi_agrikulture',$transaksi_offline->id)->get();

		$detail_transaksi = DB::table('detail_transaksi_agrikultures')
		->join('transaksi_agrikulture_offlines', 'detail_transaksi_agrikultures.id_transaksi_agrikulture_offline', '=', 'transaksi_agrikulture_offlines.id')
		->join('produk_agrikultures', 'detail_transaksi_agrikultures.id_produk_agrikulture', '=', 'produk_agrikultures.id')
		->select('detail_transaksi_agrikultures.*', 'produk_agrikultures.nama_produk','produk_agrikultures.harga_produk',)
		->where('detail_transaksi_agrikultures.id_transaksi_agrikulture_offline',$transaksi_offline->id)
		->orderBy('detail_transaksi_agrikultures.id', 'DESC')
		->get();

		 // return $transaksi_offline;
		  //return $detail_transaksi;

		return view('admin_kasir.agrikulture.lihat_pesanan.detail_offline',compact('transaksi_offline','detail_transaksi'));
	}


	public function admin_detail_pesanan_agrikulture($id)
	{
		// $transaksi_agrikulture = TransaksiAgrikulture::orderby('id', 'DESC')->get();
		$transaksi_agrikulture = DB::table('transaksi_agrikultures')
		->join('customers', 'transaksi_agrikultures.id_user', '=', 'customers.id_user')
		->join('market_agrikultures', 'transaksi_agrikultures.id_market_agrikulture', '=', 'market_agrikultures.id')
		->select('transaksi_agrikultures.*', 'customers.nama','market_agrikultures.nama_toko')
		->orderBy('transaksi_agrikultures.id', 'DESC')
		->where('transaksi_agrikultures.id', $id)
		->get();
 

		$detail_produk = DB::table('detail_transaksi_agrikultures')
		->join('produk_agrikultures', 'detail_transaksi_agrikultures.id_produk_agrikulture', '=', 'produk_agrikultures.id')
		->select('detail_transaksi_agrikultures.*', 'produk_agrikultures.nama_produk', 'produk_agrikultures.kode_produk', 'produk_agrikultures.kategori_produk', 'produk_agrikultures.harga_produk')
		->join('transaksi_agrikultures', 'detail_transaksi_agrikultures.id_transaksi_agrikulture', '=', 'transaksi_agrikultures.id')
		->orderBy('detail_transaksi_agrikultures.id', 'DESC')
		->where('transaksi_agrikultures.id', $id)
		->get();
		
		
		return view('admin_kasir.agrikulture.lihat_pesanan.detail_pesanan_agrikulture', compact('transaksi_agrikulture','detail_produk'));
	}




	public function admin_lokasi_pembeli($id)

	{
		// $tampil_peta =MarketAgrikulture::where('id', $id)->get();
		$lokasi_pembeli = DB::table('transaksi_agrikultures')
		->join('users', 'transaksi_agrikultures.id_user', '=', 'users.id')
		->join('customers', 'transaksi_agrikultures.id_user', '=', 'customers.id_user')
		->select('transaksi_agrikultures.*', 'users.longitude', 'users.latitude','customers.nama')
		->orderBy('transaksi_agrikultures.id', 'DESC')
		->where('transaksi_agrikultures.id', $id)
		->get();
		// return $tampil_peta;
		return view('admin_kasir.agrikulture.lokasi_pembeli.index', compact('lokasi_pembeli'));
	}


// ========================================== KOPERASI ===================================================


	public function admin_kasir_koperasi(request $request)
	{
		//filter produk  menggunkana kode produk
		$kode_produk = $request->kode_produk;

		if ($kode_produk == null) {
			$cari_produk = ProdukKoperasi::where('id','0')->get();
			

			$size_produk = Size::where('id_produk_koperasi', '0')->get(); 
			$warna_produk = Warna::where('id_produk_koperasi', '0')->get();

		}else{
			$cari_produk = ProdukKoperasi::where('kode_produk',$kode_produk)->get();
			$get_id_produk = ProdukKoperasi::where('kode_produk',$kode_produk)->first();

			$size_produk = Size::where('id_produk_koperasi', $get_id_produk->id)->get(); 
			$warna_produk = Warna::where('id_produk_koperasi', $get_id_produk->id)->get();

		}

		//get data keranjang offline
		$keranjang_koperasi_offline = DB::table('keranjang_koperasi_offlines')
		->join('produk_koperasis', 'keranjang_koperasi_offlines.id_produk_koperasi', '=', 'produk_koperasis.id')
		->select('keranjang_koperasi_offlines.*', 'produk_koperasis.nama_produk','produk_koperasis.kategori_produk')
		->orderBy('keranjang_koperasi_offlines.id', 'DESC')
		->where('keranjang_koperasi_offlines.id_user_admin_kasir',Auth::user()->id)
		->get();

		//total belanja pada keranjang offline
		$total_belanja = KeranjangKoperasiOffline::where('id_user_admin_kasir',Auth::user()->id)->sum('total_harga');
		// return $keranjang_offline;
		

		// return $get_id_market;
		return view('admin_kasir.koperasi.kasir_koperasi.index', compact('cari_produk','keranjang_koperasi_offline','total_belanja','size_produk','warna_produk'));
	}


	public function kasir_keranjang_koperasi_add(Request $request, $id)
	{

		
		$cek_keranjang = KeranjangKoperasiOffline::where('id_produk_koperasi',$id)->where('size',$request->input('size'))->where('warna',$request->input('warna'))->first();

		//proses add data pada keranjang offline, jika belum ada maka data diinputkan ke tabel
		if ($cek_keranjang == null) {
			$data_add = new KeranjangKoperasiOffline();

			$data_add->id_user_admin_kasir = Auth::user()->id;
			$data_add->id_produk_koperasi = $id;
			$data_add->kuantitas = '1';
			$data_add->total_harga = $request->input('total_harga');
			$data_add->size = $request->input('size');
			$data_add->warna = $request->input('warna');

			$data_add->save();
		}else{
			//jika data sudah ada, maka hanya menambahkan kuantitas dan total harga
			$data_update = KeranjangKoperasiOffline::where('id_produk_koperasi', $id)->first();	

			$input = [
				'kuantitas' => $data_update->kuantitas + '1' ,
				'total_harga' =>  $data_update->total_harga + $request->total_harga,
			];

			$data_update->update($input);
		}

	// return $cek_keranjang;

		return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan');
	}


	public function kasir_batalkan_produk_koperasi($id)
	{
		
		$batalkan_produk = KeranjangKoperasiOffline::findOrFail($id);
		$batalkan_produk->delete();

		return redirect()->back()->with('error', 'Produk Telah Dibatalkan');
	}



	public function kasir_transaksi_offline_koperasi_add(Request $request)
	{
		//add data ke tabel transaksi agrikulture offline
		$get_keranjang_offline = KeranjangKoperasiOffline::where('id_user_admin_kasir',Auth::user()->id)->get();
		
		$id_partner = DB::table('keranjang_koperasi_offlines')
		->join('produk_koperasis', 'keranjang_koperasi_offlines.id_produk_koperasi', '=', 'produk_koperasis.id')
		->select('keranjang_koperasi_offlines.*', 'produk_koperasis.id_partner')
		->orderBy('keranjang_koperasi_offlines.id', 'DESC')
		->where('keranjang_koperasi_offlines.id_user_admin_kasir',Auth::user()->id)
		->first();

		// $id_partner = KeranjangKoperasiOffline::where('id_user_admin_kasir',Auth::user()->id)->first();

		$data = ([
			'id_user_admin_kasir' => Auth::user()->id,
			'id_partner' => $id_partner->id_partner,
			'nominal_barang' => $request['nominal_barang'],
			'nominal_bayar' => $request['nominal_bayar'],
			'nominal_kembalian' => $request['nominal_kembalian'],
			
		]);

		// return $data;
		$lastid = TransaksiKoperasiOffline::create($data)->id;

		//get data dari keranjang offline dan dimasukkan ke tabel detail transaksi agrikulture
		foreach ($get_keranjang_offline as $data) {

			$detail_transaksi_offline = new DetailTransaksiKoperasi();

			$detail_transaksi_offline->id_transaksi_koperasi_offline = $lastid;
			$detail_transaksi_offline->id_produk_koperasi = $data->id_produk_koperasi;
			$detail_transaksi_offline->kuantitas = $data->kuantitas;
			$detail_transaksi_offline->total_harga = $data->total_harga;
			$detail_transaksi_offline->size = $data->size;
			$detail_transaksi_offline->warna = $data->warna;
			$detail_transaksi_offline->save();
		}


		//ubah stok dan sold produk
		foreach ($get_keranjang_offline as $value ) {
			
			$update_stok = ProdukKoperasi::where('id', $value->id_produk_koperasi)->first();	

			$input = [
				'stok' => $update_stok->stok - $value->kuantitas ,
				'sold' => $update_stok->sold + $value->kuantitas ,
			];

			$update_stok->update($input);
		}
		

		//hapus data keranjang offline
		$delete_keranjang = KeranjangKoperasiOffline::where('id_user_admin_kasir',Auth::user()->id)->get();

		foreach ($delete_keranjang as $key) {
			$key->delete();
		}

		// return $detail_transaksi_offline;

		return redirect()->route('admin_kasir_transaksi_koperasi_selesai')->with('success', 'Transaksi Berhasil');
	}


	public function admin_kasir_transaksi_koperasi_selesai()
	{

		$transaksi_offline = TransaksiKoperasiOffline::where('id_user_admin_kasir',Auth::user()->id)->orderBy('id', 'DESC')->first();

		// $detail_transaksi = DetailTransaksiAgrikulture::where('id_transaksi_agrikulture',$transaksi_offline->id)->get();

		$detail_transaksi = DB::table('detail_transaksi_koperasis')
		->join('transaksi_koperasi_offlines', 'detail_transaksi_koperasis.id_transaksi_koperasi_offline', '=', 'transaksi_koperasi_offlines.id')
		->join('produk_koperasis', 'detail_transaksi_koperasis.id_produk_koperasi', '=', 'produk_koperasis.id')
		->select('detail_transaksi_koperasis.*', 'produk_koperasis.nama_produk','produk_koperasis.harga','produk_koperasis.kategori_produk')
		->where('detail_transaksi_koperasis.id_transaksi_koperasi_offline',$transaksi_offline->id)
		->orderBy('detail_transaksi_koperasis.id', 'DESC')
		->get();

		 // return $transaksi_offline;
		  // return $detail_transaksi;

		return view('admin_kasir.koperasi.kasir_koperasi.transaksi_selesai',compact('transaksi_offline','detail_transaksi'));
	}


	public function admin_kelola_koperasi()
	{
		$produk_koperasi = DB::table('produk_koperasis')
		->join('admins', 'produk_koperasis.id_admin', '=', 'admins.id')
		->select('produk_koperasis.*', 'admins.nama')
		->orderBy('produk_koperasis.id', 'DESC')
		->get();

		$admin = Admin::where('role_admin', 'Admin Kasir')->get();
		$partner = Customer::where('status_partner', 'partner')->get();
		$kat = KategoriProdukKoperasi::all();

		$list_size =ListSize::all();
		$list_warna =ListWarna::all();

		return view('admin_kasir.koperasi.produk_koperasi.index', compact('produk_koperasi', 'admin','partner','kat','list_size','list_warna'));
	}


	public function admin_kelola_detaiL_koperasi($id)
	{
		$produk_koperasi_detail = DB::table('produk_koperasis')
		->join('customers', 'produk_koperasis.id_partner', '=', 'customers.id')
		->select('produk_koperasis.*', 'customers.nama')
		->where('produk_koperasis.id',$id)
		->orderBy('produk_koperasis.id', 'DESC')
		->get();
			// return $produk_koperasi_detail;

		$get_produk =ProdukKoperasi::where('id', $id)->first();
		$get_size = Size::where('id_produk_koperasi', $get_produk->id)->get();
		$get_warna = Warna::where('id_produk_koperasi', $get_produk->id)->get();
		
		
		$partner = Customer::where('status_partner', 'partner')->get();

		return view('admin_kasir.koperasi.produk_koperasi.detail', compact('produk_koperasi_detail', 'get_size','get_warna','partner'));
	}


	public function admin_kasir_ubah_stok_koperasi(Request $request, $id)
	{

		$data_update = ProdukKoperasi::where('id',$id)->first();	

		$input = [
			'stok' => $request->stok,
		];

		$data_update->update($input);

		return redirect()->back()->with('success', 'Stok Produk Berhasil Diperbarui');
	}
}
