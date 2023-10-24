<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\Admin;
use App\Models\TransaksiAgrikulture;
use App\Models\TransaksiKoperasi;
use App\Models\MarketAgrikulture;
use App\Models\ProdukAgrikulture;
use App\Models\ProdukKoperasi;
use App\Models\Size;
use App\Models\Warna;
use App\Models\Customer;
use App\Models\KategoriprodukAgrikulture;
use App\Models\KategoriprodukKoperasi;
use File;
use PDF;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperadminController extends Controller
{
	//
	public function superadmin_dashboard()
	{

		return view('super_admin.index');
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
			'role' => 'admin',
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

	// ==================================================================================================================


	public function superadmin_agrikulture()
	{
		$produk_agrikulture = DB::table('produk_agrikultures')
		->join('market_agrikultures', 'produk_agrikultures.id_market', '=', 'market_agrikultures.id')
		->select('produk_agrikultures.*', 'market_agrikultures.nama_toko')
		->orderBy('produk_agrikultures.id', 'DESC')
		->get();

		$market = MarketAgrikulture::all();
		//return $produk_agrikulture;
		$kat = KategoriprodukAgrikulture::all();
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
		$kat = KategoriprodukAgrikulture::all();
		return view('super_admin.agrikulture.edit.edit_produk', compact('produk_agrikulture', 'market','kat'));
	}

	public function produk_agrikulture_add(Request $request)
	{


		$data_add = new ProdukAgrikulture();

		$data_add->id_market = $request->input('id_market');
		$data_add->nama_produk = $request->input('nama_produk');
		$data_add->jenis_produk = $request->input('jenis_produk');
		$data_add->harga_produk = $request->input('harga_produk');
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
			'jenis_produk' => $request->jenis_produk,
			'harga_produk' => $request->harga_produk,

		];
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
		File::delete('uploads/produk_agrikulture/' . $data_agrikulture->foto_pengumuman);
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

		$data_agrikulture = MarketAgrikulture::findOrFail($id);
		$data_agrikulture->delete();

		return redirect()->back()->with('success', 'Market Agrikulture Berhasil Dihapus');
	}



	// ================================================================================================================
	public function superadmin_koperasi()
	{
		$produk_koperasi = DB::table('produk_koperasis')
		->join('admins', 'produk_koperasis.id_admin', '=', 'admins.id')
		->select('produk_koperasis.*', 'admins.nama')
		->orderBy('produk_koperasis.id', 'DESC')
		->get();

		$admin = Admin::where('role_admin', 'Admin Kasir')->get();
		$partner = Customer::where('status_partner', 'partner')->get();
		$kat = KategoriprodukKoperasi::all();
		return view('super_admin.koperasi.kelola_produk', compact('produk_koperasi', 'admin','partner','kat'));
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
		$kat = KategoriprodukKoperasi::all();
		// return $kat;
		return view('super_admin.koperasi.edit.edit_produk', compact('produk_koperasi', 'admin','partner','kat'));
	}



	public function produk_koperasi_add(Request $request)
	{


		$data = ([
			'id_admin' => $request['id_admin'],
			'id_partner' => $request['id_partner'],
			'nama_produk' => $request['nama_produk'],
			'kode_produk' => $request['kode_produk'],
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


	// ====================================================================================================================
	public function superadmin_kelola_transaksi()
	{
		$transaksi_agrikulture = TransaksiAgrikulture::orderby('id', 'DESC')->get();

		// $transaksi_koperasi = TransaksiKoperasi::orderby('id', DESC)->get();
		$transaksi_koperasi = DB::table('transaksi_koperasis')
		->join('customers', 'transaksi_koperasis.id_user', '=', 'customers.id_user')
		->join('produk_agrikultures', 'transaksi_koperasis.id_produk_koperasi', '=', 'produk_agrikultures.id')
		->select('transaksi_koperasis.*', 'customers.nama', 'produk_agrikultures.nama_produk')
		->orderBy('transaksi_koperasis.id', 'DESC')
		->get();

		return view('super_admin.kelola_transaksi.index', compact('transaksi_koperasi', 'transaksi_agrikulture'));
	}
}
