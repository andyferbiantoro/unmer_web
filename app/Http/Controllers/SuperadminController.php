<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\Admin;
use App\Models\TransaksiKoperasi;
use App\Models\ProdukKoperasi;
use App\Models\TransaksiAgrikulture;
use App\Models\MarketAgrikulture;
use App\Models\ProdukAgrikulture;
use App\Models\DetailTransaksiAgrikulture;
use App\Models\Size;
use App\Models\Warna;
use App\Models\ListSize;
use App\Models\ListWarna;
use App\Models\Customer;
use App\Models\KategoriProdukAgrikulture;
use App\Models\KategoriProdukKoperasi;
use App\Models\Broadcast;
use App\Models\DetailBroadcast;
use App\Models\TransaksiTopUp;
use App\Models\TransaksiKirimSaldo;
use App\Models\BiayaLayanan;
use App\Models\StatusMenu;
use App\Models\KontakBantuan;
use File;
use PDF;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class SuperadminController extends Controller
{
	//
	public function superadmin_dashboard()
	{
		$total_pengguna =Customer::count();
		$belum_ver =Customer::where('status',0)->count();
		$sudah_ver =Customer::where('status',1)->count();

		$total_partner = Customer::where('status_partner','partner')->count();
		$total_partner_laki = Customer::where('status_partner','partner')->where('jenis_kelamin','L')->count();
		$total_partner_perempuan = Customer::where('status_partner','partner')->where('jenis_kelamin','P')->count();
		

		return view('super_admin.index', compact('total_pengguna','belum_ver','sudah_ver','total_partner','total_partner_laki','total_partner_perempuan'));
	}

	public function register(Request $request)
	{

		$user = User::create([
			'email' => $request->email,
			'password' =>  bcrypt($request->password),
			'otp' => $request->otp,
			'nid_unmer' => $request->nid_unmer,
			'role' => $request->role,
			'status' => $request->status

		]);


		if ($user) {

			$out = [
				"message" => "register_success",
				"user" => $user,
				"code"    => 201,
			];
		} else {
			$out = [
				"message" => "failed_regiser",
				"code"   => 400,
			];
		}

		return response()->json($out, $out['code']);
	}

	public function superadmin_kelola_admin()
	{
		$admin = Admin::orderby('id', 'DESC')->where('role_admin', 'Admin Penginapan')->get();

		return view('super_admin.kelola_admin.index', compact('admin'));
	}

	public function superadmin_admin_kasir()
	{
		$admin = Admin::orderby('id', 'DESC')->where('role_admin', 'Admin Kasir')->get();

		return view('super_admin.kelola_admin.tabel_admin.admin_kasir', compact('admin'));
	}

	public function superadmin_admin_pendidikan()
	{
		$admin = Admin::orderby('id', 'DESC')->where('role_admin', 'Admin Pendidikan')->get();

		return view('super_admin.kelola_admin.tabel_admin.admin_pendidikan', compact('admin'));
	}


	public function superadmin_admin_event()
	{
		$admin = Admin::orderby('id', 'DESC')->where('role_admin', 'Admin Event')->get();

		return view('super_admin.kelola_admin.tabel_admin.admin_event', compact('admin'));
	}


	public function admin_add(Request $request)
	{

		$data = ([
			'email' => $request['email'],
			'nid_unmer' => $request['nid_unmer'],
			'no_telp' => $request['no_telp'],
			'password' => Hash::make($request['password']),
			'role' => $request['role'],
			'status' => '1',
		]);

		$lastid = User::create($data)->id;


		$data_add = new Admin();
		$data_add->id_user = $lastid;
		$data_add->nama = $request->input('nama');
		$data_add->nik = $request->input('nik');
		$data_add->tempat_lahir = $request->input('tempat_lahir');
		$data_add->tanggal_lahir = $request->input('tanggal_lahir');
		$data_add->status = 'Aktif';
		$data_add->role_admin = $request->input('role_admin');


		$data_add->save();

		return redirect()->back()->with('success', 'Admin Berhasil Ditambahkan');
	}


	public function admin_update(Request $request, $id)
	{

		$data_update = Admin::where('id', $id)->first();

		$input = [
			'nama' => $request->nama,
			'nik' => $request->nik,
			'tempat_lahir' => $request->tempat_lahir,
			'tanggal_lahir' => $request->tanggal_lahir,
			'role_admin' => $request->role_admin,

		];

		$data_update->update($input);


		return redirect()->back()->with('success', 'Data Berhasil Diupdate');
	}


	public function admin_delete($id)
	{


		$cekadmin = Admin::where('id', $id)->first();

		$delete_user_admin = User::where('id', $cekadmin->id_user)->first();
		$delete_user_admin->delete();

		$delete = Admin::findOrFail($id);
		$delete->delete();

		return redirect()->back()->with('success', 'Data Berhasil Dihapus');
	}

	// ===============================================================================================


	public function superadmin_kelola_user()
	{
		$data_user = Customer::orderby('id', 'DESC')->get();
		
		return view('super_admin.kelola_user.index', compact('data_user'));
	}

	public function superadmin_jadikan_partner($id)
	{


		$data_update = Customer::where('id', $id)->first();

		$input = [
			'status_partner' => 'partner',	
		];

		$data_update->update($input);

		return redirect()->back()->with('success', 'Berhasil Menjadikan Partner');
	}

// ==================================================================================================

	public function superadmin_kelola_partner()
	{
		$data_partner = Customer::orderby('id', 'DESC')->where('status_partner','partner')->get();
		
		return view('super_admin.kelola_user.partner', compact('data_partner'));
	}


	public function superadmin_detail_partner($id)
	{
		$detail_partner = DB::table('produk_koperasis')
			->join('customers', 'produk_koperasis.id_partner', '=', 'customers.id')
			->select('produk_koperasis.*', 'customers.nama')
			->orderBy('produk_koperasis.id', 'DESC')
			->where('produk_koperasis.id_partner', $id)
			->get();

		$nama_partner = DB::table('produk_koperasis')
			->join('customers', 'produk_koperasis.id_partner', '=', 'customers.id')
			->select('customers.nama','customers.saldo')
			->where('produk_koperasis.id_partner', $id)
			->first();
			
		
		return view('super_admin.kelola_user.detail_partner', compact('detail_partner','nama_partner'));
	}

	// ==================================================================================================================


	public function superadmin_agrikulture(Request $request)
	{

		$kategori_produk = $request->kategori_produk;

		if ($kategori_produk == null) {
			$produk_agrikulture = DB::table('produk_agrikultures')
			->join('market_agrikultures', 'produk_agrikultures.id_market', '=', 'market_agrikultures.id')
			->select('produk_agrikultures.*', 'market_agrikultures.nama_toko')
			->orderBy('produk_agrikultures.id', 'DESC')
			->get();
			# code...
		}else{
			$produk_agrikulture = DB::table('produk_agrikultures')
			->join('market_agrikultures', 'produk_agrikultures.id_market', '=', 'market_agrikultures.id')
			->select('produk_agrikultures.*', 'market_agrikultures.nama_toko')
			->orderBy('produk_agrikultures.id', 'DESC')
			->where('produk_agrikultures.kategori_produk',$kategori_produk)
			->get();
		}


		$market = MarketAgrikulture::all();
		//return $produk_agrikulture;
		$kat = KategoriProdukAgrikulture::all();
		return view('super_admin.agrikulture.kelola_produk', compact('produk_agrikulture', 'market','kat'));
	}

	public function superadmin_produk_agrikulture_edit($id)
	{
		$produk_agrikulture = DB::table('produk_agrikultures')
		->join('market_agrikultures', 'produk_agrikultures.id_market', '=', 'market_agrikultures.id')
		->select('produk_agrikultures.*', 'market_agrikultures.nama_toko')
		->where('produk_agrikultures.id', $id)
		->orderBy('produk_agrikultures.id', 'DESC')
		->get();

		$market = MarketAgrikulture::all();
		$kat = KategoriProdukAgrikulture::all();
		return view('super_admin.agrikulture.edit.edit_produk', compact('produk_agrikulture', 'market','kat'));
	}

	public function produk_agrikulture_add(Request $request)
	{

		$kode_produk = mt_rand(1000000000, 9999999999);
		$data_add = new ProdukAgrikulture();

		$data_add->id_market = $request->input('id_market');
		$data_add->nama_produk = $request->input('nama_produk');
		$data_add->kategori_produk = $request->input('kategori_produk');
		$data_add->harga_produk = $request->input('harga_produk');
		$data_add->kode_produk = $kode_produk;
		$data_add->stok = $request->input('stok');;
		$data_add->status = '1';

		if ($request->hasFile('foto')) {
			$file = $request->file('foto');
			$filename = $file->getClientOriginalName();
			$file->move('uploads/produk_agrikulture/', $filename);
			$data_add->foto = $filename;
		} else {
			echo "Gagal upload gambar";
		}

		$data_add->save();

		return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan');
	}



	public function produk_agrikulture_update(Request $request, $id)
	{


		$data_update = ProdukAgrikulture::where('id', $id)->first();

		$input = [
			'nama_produk' => $request->nama_produk,
			'kategori_produk' => $request->kategori_produk,
			'harga_produk' => $request->harga_produk,
			'stok' => $request->stok,

		];
		// return $input;
		// return $input;
		if ($file = $request->file('foto')) {
			if ($data_update->foto) {
				File::delete('uploads/produk_agrikulture/' . $data_update->foto);
			}
			$nama_file = $file->getClientOriginalName();
			$file->move(public_path() . '/uploads/produk_agrikulture/', $nama_file);
			$input['foto'] = $nama_file;
		}

		$data_update->update($input);


		return redirect()->back()->with('success', 'Produk Berhasil Diupdate');
	}





	public function produk_agrikulture_delete($id)
	{

		$data_agrikulture = ProdukAgrikulture::findOrFail($id);
		File::delete('uploads/produk_agrikulture/' . $data_agrikulture->foto);
		$data_agrikulture->delete();

		return redirect()->back()->with('success', 'Produk Agrikulture Berhasil Dihapus');
	}


	// ============================================================================================================


	public function superadmin_market_agrikulture()

	{
		$market_agrikulture = DB::table('market_agrikultures')
		->join('admins', 'market_agrikultures.id_admin', '=', 'admins.id')
		->select('market_agrikultures.*', 'admins.nama')
		->orderBy('market_agrikultures.id', 'DESC')
		->get();

		$admin = Admin::where('role_admin', 'Admin Kasir')->get();
		
		return view('super_admin.agrikulture.kelola_market', compact('market_agrikulture', 'admin'));
	}


	public function superadmin_market_agrikulture_edit($id)

	{
		$market_agrikulture = DB::table('market_agrikultures')
		->join('admins', 'market_agrikultures.id_admin', '=', 'admins.id')
		->select('market_agrikultures.*', 'admins.nama')
		->where('market_agrikultures.id', $id)
		->orderBy('market_agrikultures.id', 'DESC')
		->get();
		// return $market_agrikulture;
		$admin = Admin::where('role_admin', 'Admin Kasir')->get();

		return view('super_admin.agrikulture.edit.edit_market', compact('market_agrikulture', 'admin'));
	}

	public function superadmin_tampil_peta_market($id)

	{
		$tampil_peta =MarketAgrikulture::where('id', $id)->get();
		// return $tampil_peta;
		return view('super_admin.agrikulture.tampil_peta_market', compact('tampil_peta'));
	}


	public function market_add(Request $request)
	{


		$data_add = new MarketAgrikulture();

		$data_add->id_admin = $request->input('id_admin');
		$data_add->nama_toko = $request->input('nama_toko');
		$data_add->status_buka = $request->input('status_buka');
		$data_add->longitude = $request->input('longitude');
		$data_add->latitude = $request->input('latitude');



		$data_add->save();

		return redirect()->back()->with('success', 'Market Agrikulture Berhasil Ditambahkan');
	}

	public function market_update(Request $request, $id)
	{
		$long = $request->longitude;
		$lat = $request->latitude;

		if ($long == null && $lat == null) {
			$data_update = MarketAgrikulture::where('id', $id)->first();

			$input = [
				'nama_toko' => $request->nama_toko,
				'longitude' => $data_update->longitude,
				'latitude' => $data_update->latitude,

			];

			$data_update->update($input);

		}else{
			$data_update = MarketAgrikulture::where('id', $id)->first();

			$input = [
				'nama_toko' => $request->nama_toko,
				'longitude' => $request->longitude,
				'latitude' => $request->latitude,

			];

			$data_update->update($input);
		}
		


		return redirect()->back()->with('success', 'Market Berhasil Diupdate');
	}

	public function market_delete($id)
	
	{
		$produk_agrikulture = ProdukAgrikulture::where('id_market', $id)->get();
		foreach ($produk_agrikulture as $key) {
			File::delete('uploads/produk_agrikulture/' . $key->foto);
			$key->delete();
		}


		$data_agrikulture = MarketAgrikulture::findOrFail($id);
		$data_agrikulture->delete();

		return redirect()->back()->with('success', 'Market Agrikulture Berhasil Dihapus');
	}


	// ======================================================================================================================

	//Transaksi di Superadmin
	public function superadmin_transaksi_agrikulture()
	{
		// $transaksi_agrikulture = TransaksiAgrikulture::orderby('id', 'DESC')->get();
		$transaksi_agrikulture = DB::table('transaksi_agrikultures')
		->join('customers', 'transaksi_agrikultures.id_user', '=', 'customers.id_user')
		->select('transaksi_agrikultures.*', 'customers.nama')
		->orderBy('transaksi_agrikultures.id', 'DESC')
		->get();

		// return $transaksi_agrikulture;

		return view('super_admin.agrikulture.transaksi_agrikulture.index', compact('transaksi_agrikulture'));
	}


	public function superadmin_transaksi_agrikulture_detail($id)
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
		->join('transaksi_agrikultures', 'detail_transaksi_agrikultures.id_transaksi_agrikulture', '=', 'transaksi_agrikultures.id')
		->select('detail_transaksi_agrikultures.*', 'produk_agrikultures.nama_produk', 'produk_agrikultures.kode_produk', 'produk_agrikultures.kategori_produk', 'produk_agrikultures.harga_produk')
		->orderBy('detail_transaksi_agrikultures.id', 'DESC')
		->where('transaksi_agrikultures.id', $id)
		->get();
		

		
		return view('super_admin.agrikulture.transaksi_agrikulture.detail_transaksi_agrikulture', compact('transaksi_agrikulture','detail_produk'));
	}


	//Biaya Layanan Agrikulture
	public function superadmin_biaya_layanan_agrikulture()
	{
		$layanan_agrikulture = BiayaLayanan::where('kategori_layanan','agrikulture')->get();
		$cek_layanan_agrikulture = BiayaLayanan::where('kategori_layanan','agrikulture')->count();
		// return $cek_layanan_agrikulture;
		return view('super_admin.agrikulture.biaya_layanan.index',compact('layanan_agrikulture','cek_layanan_agrikulture'));
	}


	public function biaya_layanan_agrikulture_add(Request $request)
	{

		$data_add = new BiayaLayanan();

		$data_add->biaya_layanan = $request->input('biaya_layanan');
		$data_add->ongkir = $request->input('ongkir');
		$data_add->kategori_layanan = 'agrikulture';


		$data_add->save();

		return redirect()->back()->with('success', 'Biaya Layanan Berhasil Ditambahkan');
	}


	public function biaya_layanan_agrikulture_update(Request $request, $id)
	{


		$data_update = BiayaLayanan::where('id', $id)->first();

		$input = [
			'biaya_layanan' => $request->biaya_layanan,
			'ongkir' => $request->ongkir,
			
		];
		
		$data_update->update($input);


		return redirect()->back()->with('success', 'Biaya Layanan Berhasil Diupdate');
	}


	public function biaya_layanan_agrikulture_delete($id)
	
	{
		
		$biaya_layanan_delete = BiayaLayanan::findOrFail($id);
		$biaya_layanan_delete->delete();

		return redirect()->back()->with('success', 'Biaya Layanan Berhasil Dihapus');
	}

	// ================================================================================================================





	// =============================================================================================================
	public function superadmin_koperasi()
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

		return view('super_admin.koperasi.kelola_produk', compact('produk_koperasi', 'admin','partner','kat','list_size','list_warna'));
	}


	public function produk_koperasi_detail($id)
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

		return view('super_admin.koperasi.detail.detail_produk', compact('produk_koperasi_detail', 'get_size','get_warna','partner'));
	}


	public function produk_koperasi_edit($id)
	{
		$produk_koperasi = DB::table('produk_koperasis')
		->join('admins', 'produk_koperasis.id_admin', '=', 'admins.id')
		->select('produk_koperasis.*', 'admins.nama')
		->orderBy('produk_koperasis.id', 'DESC')
		->where('produk_koperasis.id',$id)
		->get();

		
		$admin = Admin::where('role_admin', 'Admin Kasir')->get();
		$partner = Customer::where('status_partner', 'partner')->get();
		$kat = KategoriProdukKoperasi::all();
		$list_size =ListSize::all();
		$list_warna =ListWarna::all();


		$get_produk =ProdukKoperasi::where('id', $id)->first();
		$get_size = Size::where('id_produk_koperasi', $get_produk->id)->get();
		$get_warna = Warna::where('id_produk_koperasi', $get_produk->id)->get();

		// return $kat;
		return view('super_admin.koperasi.edit.edit_produk', compact('produk_koperasi', 'admin','partner','kat','list_size','list_warna', 'get_size','get_warna'));
	}



	public function produk_koperasi_add(Request $request)
	{

		$kode_produk = mt_rand(10000, 99999);
		$data = ([
			'id_admin' => $request['id_admin'],
			'id_partner' => $request['id_partner'],
			'nama_produk' => $request['nama_produk'],
			'deskripsi_produk' => $request['deskripsi_produk'],
			'kode_produk' => $kode_produk,
			'kategori_produk' => $request['kategori_produk'],
			'harga' => $request['harga'],
			'stok' => $request['stok'],
			'sold' => '0',
			'status' => $request['status'],


		]);

		if ($file = $request->file('foto')) {
			$nama_file = $file->getClientOriginalName();
			$file->move(public_path() . '/uploads/produk_koperasi/', $nama_file);
			$data['foto'] = $nama_file;
		}
		// return $data;
		$lastid = ProdukKoperasi::create($data)->id;

		$cek_kategori = ProdukKoperasi::where('id',$lastid)->first();
		if ($cek_kategori->kategori_produk == 'Pakaian') {
			# code...
		// return $array;
			$data_size = $request->input('size');
		// return $data_size;
			foreach ($data_size as $data) {

				$simpan_size = new Size();

				$simpan_size->id_produk_koperasi = $lastid;
				$simpan_size->size = $data;

				$simpan_size->save();
			}

			$data_warna = $request->input('warna');
		// return $data_warna;
			foreach ($data_warna as $data) {

				$simpan_warna = new Warna();

				$simpan_warna->id_produk_koperasi = $lastid;
				$simpan_warna->warna = $data;

				$simpan_warna->save();
			}
		}

		return redirect()->back()->with('success', 'Produk Koperasi Berhasil Ditambahkan');
	}


	public function produk_koperasi_update(Request $request, $id)
	{


		$data_update = ProdukKoperasi::where('id', $id)->first();

		$input = [
			'nama_produk' => $request->nama_produk,
			'kode_produk' => $request->kode_produk,
			'kategori_produk' => $request->kategori_produk,
			'harga' => $request->harga,
			'stok' => $request->stok,

			

		];
		// return $input;
		if ($file = $request->file('foto')) {
			if ($data_update->foto) {
				File::delete('uploads/produk_koperasi/' . $data_update->foto);
			}
			$nama_file = $file->getClientOriginalName();
			$file->move(public_path() . '/uploads/produk_koperasi/', $nama_file);
			$input['foto'] = $nama_file;
		}

		$data_update->update($input);



		return redirect()->back()->with('success', 'Produk Berhasil Diupdate');
	}


	public function produk_koperasi_update_size(Request $request, $id)
	{

		// proses update size
		$delete_size = Size::where('id_produk_koperasi', $id)->get();
		
		foreach ($delete_size as $key) {
			$key->delete();
		}

		$data_update_size = $request->input('size');
		// return $data_update_size;
		foreach ($data_update_size as $data) {

			$update_size = new Size();
			$update_size->id_produk_koperasi = $id;
			$update_size->size = $data;

			$update_size->save();
			
		}

		return redirect()->back()->with('success', 'Size Berhasil Diupdate');
	}



	public function produk_koperasi_update_warna(Request $request, $id)
	{

		// proses update size
		$delete_warna = Warna::where('id_produk_koperasi', $id)->get();
		
		foreach ($delete_warna as $key) {
			$key->delete();
		}

		$data_update_warna = $request->input('warna');
		// return $data_update_warna;
		foreach ($data_update_warna as $data) {

			$update_warna = new Warna();
			$update_warna->id_produk_koperasi = $id;
			$update_warna->warna = $data;

			$update_warna->save();
			
		}

		return redirect()->back()->with('success', 'Warna Berhasil Diupdate');
	}



	public function produk_koperasi_delete($id)
	{

		$Delete_size = Size::where('id_produk_koperasi', $id)->get();
		foreach ($Delete_size as $key) {
			$key->delete();
		}

		$Delete_warna = Warna::where('id_produk_koperasi', $id)->get();
		foreach ($Delete_warna as $key) {
			$key->delete();
		}

		$Delete_produk_koperasi = ProdukKoperasi::findOrFail($id);
		$Delete_produk_koperasi->delete();

		return redirect()->back()->with('success', 'Produk Berhasil Dihapus');
	}


	//Biaya Layanan Koperasi
	public function superadmin_biaya_layanan_koperasi()
	{
		$layanan_koperasi = BiayaLayanan::where('kategori_layanan','koperasi')->get();
		$cek_layanan_koperasi = BiayaLayanan::where('kategori_layanan','koperasi')->count();
		// return $cek_layanan_koperasi;
		return view('super_admin.koperasi.biaya_layanan.index',compact('layanan_koperasi','cek_layanan_koperasi'));
	}


	public function biaya_layanan_koperasi_add(Request $request)
	{

		$data_add = new BiayaLayanan();

		$data_add->biaya_layanan = $request->input('biaya_layanan');
		$data_add->ongkir = $request->input('ongkir');
		$data_add->kategori_layanan = 'koperasi';


		$data_add->save();

		return redirect()->back()->with('success', 'Biaya Layanan Berhasil Ditambahkan');
	}


	public function biaya_layanan_koperasi_update(Request $request, $id)
	{


		$data_update = BiayaLayanan::where('id', $id)->first();

		$input = [
			'biaya_layanan' => $request->biaya_layanan,
			'ongkir' => $request->ongkir,
			
		];
		
		$data_update->update($input);


		return redirect()->back()->with('success', 'Biaya Layanan Berhasil Diupdate');
	}


	public function biaya_layanan_koperasi_delete($id)
	
	{
		
		$biaya_layanan_delete = BiayaLayanan::findOrFail($id);
		$biaya_layanan_delete->delete();

		return redirect()->back()->with('success', 'Biaya Layanan Berhasil Dihapus');
	}

	// ====================================================================================================================


	//Transaksi Koperasi di Superadmin
	public function superadmin_transaksi_koperasi()
	{
		// $transaksi_agrikulture = TransaksiAgrikulture::orderby('id', 'DESC')->get();
		$transaksi_koperasi = DB::table('transaksi_koperasis')
		->join('customers', 'transaksi_koperasis.id_user', '=', 'customers.id_user')
		->select('transaksi_koperasis.*', 'customers.nama')
		->orderBy('transaksi_koperasis.id', 'DESC')
		->get();


		return view('super_admin.koperasi.transaksi_koperasi.index', compact('transaksi_koperasi'));
	}


	public function superadmin_transaksi_koperasi_detail($id)
	{
		// $transaksi_agrikulture = TransaksiAgrikulture::orderby('id', 'DESC')->get();
		$transaksi_koperasi = DB::table('transaksi_koperasis')
		->join('customers', 'transaksi_koperasis.id_user', '=', 'customers.id_user')
		->select('transaksi_koperasis.*', 'customers.nama')
		->orderBy('transaksi_koperasis.id', 'DESC')
		->where('transaksi_koperasis.id', $id)
		->get();


		$detail_produk = DB::table('detail_transaksi_koperasis')
		->join('produk_koperasis', 'detail_transaksi_koperasis.id_produk_koperasi', '=', 'produk_koperasis.id')
		->select('detail_transaksi_koperasis.*', 'produk_koperasis.nama_produk', 'produk_koperasis.kode_produk', 'produk_koperasis.kategori_produk', 'produk_koperasis.harga')
		->orderBy('detail_transaksi_koperasis.id', 'DESC')
		->where('detail_transaksi_koperasis.id_transaksi_koperasi', $id)
		->get();
		
		
		return view('super_admin.koperasi.transaksi_koperasi.detail_transaksi_koperasi', compact('transaksi_koperasi','detail_produk'));
	}

	// ==============================================================================================================
	

	public function superadmin_kost()
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

		return view('super_admin.koperasi.kelola_produk', compact('produk_koperasi', 'admin','partner','kat','list_size','list_warna'));
	}




	// ======================================================================================================================


	public function superadmin_kelola_topup()
	{
		// $transaksi_topup = TransaksiTopUp::orderby('id', 'DESC')->get();
		$transaksi_topup = DB::table('transaksi_top_ups')
		->join('customers', 'transaksi_top_ups.id_user', '=', 'customers.id_user')
		->select('transaksi_top_ups.*', 'customers.nama')
		->orderBy('transaksi_top_ups.id', 'DESC')
		->get();

		return view('super_admin.transaksi.kelola_topup.index', compact('transaksi_topup'));
	}


	public function superadmin_konfirmasi_topup(Request $request, $id)
	{


		$data_update = TransaksiTopUp::where('id', $id)->first();

		$input = [
			'status_topup' => 'dikonfirmasi',	
		];

		$data_update->update($input);


		$update_saldo = Customer::where('id_user', $data_update->id_user)->first();
		
		$input = [
			'saldo' => $update_saldo->saldo + $data_update->nominal,	
		];

		$update_saldo->update($input);


		return redirect()->back()->with('success', 'Produk Berhasil Diupdate');
	}

	// ===============================================================================================


	public function superadmin_transfer_bank()
	{
		// $transaksi_topup = TransaksiTopUp::orderby('id', 'DESC')->get();
		$transfer_bank = DB::table('transaksi_kirim_saldos')
		->join('customers', 'transaksi_kirim_saldos.id_user_pengirim', '=', 'customers.id_user')
		->select('transaksi_kirim_saldos.*', 'customers.nama')
		->orderBy('transaksi_kirim_saldos.id', 'DESC')
		->where('transaksi_kirim_saldos.jenis_kirim_saldo','bank')
		->get();

		return view('super_admin.transaksi.transfer_bank.index', compact('transfer_bank'));
	}

	public function superadmin_konfirmasi_transfer_bank(Request $request, $id)
	{


		$data_update = TransaksiKirimSaldo::where('id', $id)->first();

		$input = [
			'status' => 'berhasil',	
		];

		$data_update->update($input);


		$update_saldo_pengirim = Customer::where('id_user', $data_update->id_user_pengirim)->first();
		
		$input = [
			'saldo' => $update_saldo_pengirim->saldo - $data_update->total,	
		];

		$update_saldo_pengirim->update($input);

		//update saldo superadmn
		$update_saldo_superadmin = Admin::where('role_admin', 'superadmin')->first();
		
		$input = [
			'saldo' => $update_saldo_superadmin->saldo + $data_update->biaya_layanan,	
		];

		$update_saldo_superadmin->update($input);



		return redirect()->back()->with('success', 'Transfer Berhasil');
	}

	// =====================================================================================================================


	public function superadmin_kelola_broadcast()
	{

		// $broadcast = DB::table('detail_broadcasts')
		// ->join('broadcasts', 'detail_broadcasts.id_broadcast', '=', 'broadcasts.id')
		// ->join('customers', 'detail_broadcasts.id_user_penerima', '=', 'customers.id_user')
		// ->select('detail_broadcasts.*', 'customers.nama','broadcasts.isi_pesan')
		// ->orderBy('broadcasts.id', 'DESC')
		// ->get();

		$broadcast = Broadcast::orderby('id', 'DESC')->get();
		$customer = Customer::orderby('id', 'DESC')->get();
		return view('super_admin.broadcast.index', compact('broadcast','customer'));
	}

	public function superadmin_kelola_broadcast_detail($id)
	{

		$penerima = DB::table('detail_broadcasts')
		->join('customers', 'detail_broadcasts.id_user_penerima', '=', 'customers.id_user')
		->select('detail_broadcasts.*', 'customers.nama')
		->where('detail_broadcasts.id_broadcast',$id)
		->get();

		$pesan = Broadcast::where('id',$id)->first();
		// $broadcast = Broadcast::orderby('id', 'DESC')->get();
		$customer = Customer::orderby('id', 'DESC')->get();
		return view('super_admin.broadcast.detail_broadcast', compact('penerima','customer','pesan'));
	}


	public function superadmin_kelola_broadcast_add(Request $request)
	{

		
		$data = ([
			'id_user_pengirim' => $request['id_user_pengirim'],
			'isi_pesan' => $request['isi_pesan'],
			
		]);

		// return $data;
		$lastid = Broadcast::create($data)->id;


		$data_penerima = $request->input('id_user_penerima');
		// return $data_size;
		foreach ($data_penerima as $data) {

			$simpan_penerima = new DetailBroadcast();

			$simpan_penerima->id_broadcast = $lastid;
			$simpan_penerima->id_user_penerima = $data;

			$simpan_penerima->save();
		}


		return redirect()->back()->with('success', 'Pesan Broadcast Berhasil Dikirm');
	}

	public function superadmin_kelola_broadcast_delete($id)
	{

		$delete_penerima = DetailBroadcast::where('id_broadcast', $id)->get();
		foreach ($delete_penerima as $key) {
			$key->delete();
		}

		$delete_broadcast = Broadcast::findOrFail($id);
		$delete_broadcast->delete();

		return redirect()->back()->with('success', 'Pesan Berhasil Dihapus');
	}


	// =======================================================================================================
	//kelola status menu
	public function superadmin_kelola_tambahan()
	{

		$status_menu = StatusMenu::all();
	
		return view('super_admin.kelola_tambahan.index',compact('status_menu'));
	}



	public function superadmin_aktifkan_menu($id)
	{

		$data_update = StatusMenu::where('id', $id)->first();

		$input = [
			'status' => 'aktif',
		];
		
		$data_update->update($input);

		return redirect()->back()->with('success', 'Menu Telah diAktifkan Kembali');
	}


	public function superadmin_non_aktifkan_menu($id)
	{

		$data_update = StatusMenu::where('id', $id)->first();

		$input = [
			'status' => 'nonaktif',
		];
		
		$data_update->update($input);

		return redirect()->back()->with('danger', 'Menu Telah diNon-Aktifkan');
	}

	//kelola kontak bantuan
	public function superadmin_kelola_kontak_bantuan()
	{

		$kontak_bantuan = KontakBantuan::all();
	
		return view('super_admin.kelola_tambahan.kontak_bantuan',compact('kontak_bantuan'));
	}


	public function superadmin_kelola_kontak_bantuan_add(Request $request)
	{

		$data_add = new KontakBantuan();

		$data_add->no_telp = $request->input('no_telp');
		
		$data_add->save();

		return redirect()->back()->with('success', 'Kontak Bantuan Berhasil Ditambahkan');
	}


	public function superadmin_kelola_kontak_bantuan_update(Request $request, $id)
	{

		$data_update = KontakBantuan::where('id', $id)->first();

		$input = [
			'no_telp' => $request['no_telp'],
		];
		
		$data_update->update($input);

		return redirect()->back()->with('success', 'Kontak Berhasil Diperbarui');
	}


	public function superadmin_kelola_kontak_bantuan_delete($id)
	{

		$delete = KontakBantuan::findOrFail($id);
		$delete->delete();

		return redirect()->back()->with('success', 'Kontak Berhasil Dihapus');
	}


}
