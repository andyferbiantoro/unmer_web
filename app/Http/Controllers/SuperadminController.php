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

	public function register(Request $request){

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
		$admin = Admin::orderby('id','DESC')->where('role_admin','Admin Penginapan')->get();

		return view('super_admin.kelola_admin.index',compact('admin'));
	}

	public function superadmin_admin_kasir()
	{
		$admin = Admin::orderby('id','DESC')->where('role_admin','Admin Kasir')->get();

		return view('super_admin.kelola_admin.tabel_admin.admin_kasir',compact('admin'));
	}

	public function superadmin_admin_pendidikan()
	{
		$admin = Admin::orderby('id','DESC')->where('role_admin','Admin Pendidikan')->get();

		return view('super_admin.kelola_admin.tabel_admin.admin_pendidikan',compact('admin'));
	}


	public function superadmin_admin_event()
	{
		$admin = Admin::orderby('id','DESC')->where('role_admin','Admin Event')->get();

		return view('super_admin.kelola_admin.tabel_admin.admin_event',compact('admin'));
	}
	

	public function admin_add(Request $request){

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


		$cekadmin = Admin::where('id',$id)->first();

		$delete_user_admin = User::where('id',$cekadmin->id_user)->first();
		$delete_user_admin->delete();

		$delete = Admin::findOrFail($id);
		$delete->delete();

		return redirect()->back()->with('success', 'Data Berhasil Dihapus');
	}
	
	// ==================================================================================================================


	public function superadmin_agrikulture()
	{
		$produk_agrikulture = DB::table('produk_agrikultures')
		->join('market_agrikultures' , 'produk_agrikultures.id_market', '=' , 'market_agrikultures.id')
		->select('produk_agrikultures.*','market_agrikultures.nama_toko')
		->orderBy('produk_agrikultures.id','DESC')
		->get();

		$market = MarketAgrikulture::all();

		return view('super_admin.agrikulture.kelola_produk',compact('produk_agrikulture','market'));
	}

	public function produk_agrikulture_add(Request $request){


		$data_add = new ProdukAgrikulture();

		$data_add->id_market = $request->input('id_market');
		$data_add->nama_produk = $request->input('nama_produk');
		$data_add->jenis_produk = $request->input('jenis_produk');
		$data_add->harga_produk = $request->input('harga_produk');
		$data_add->status = '1';
		
		if($request->hasFile('foto')){
			$file = $request->file('foto');
			$filename = $file->getClientOriginalName();
			$file->move('uploads/foto_agrikulture/', $filename);
			$data_add->foto = $filename;


		}else{
			echo "Gagal upload gambar";
		}

		$data_add->save();

		return redirect()->back()->with('success', 'Produk Berhasil Ditambahkan');
	}




	public function superadmin_market_agrikulture()

	{
		$market_agrikulture = DB::table('market_agrikultures')
		->join('admins' , 'market_agrikultures.id_admin', '=' , 'admins.id')
		->select('market_agrikultures.*','admins.nama')
		->orderBy('market_agrikultures.id','DESC')
		->get();

		$admin = Admin::where('role_admin','Admin Kasir')->get();

		return view('super_admin.agrikulture.kelola_market',compact('market_agrikulture','admin'));
	}


	public function market_add(Request $request){


		$data_add = new MarketAgrikulture();

		$data_add->id_admin = $request->input('id_admin');
		$data_add->nama_toko = $request->input('nama_toko');
		$data_add->status_buka = $request->input('status_buka');
		$data_add->longitude = $request->input('longitude');
		$data_add->latitude = $request->input('latitude');
		
		

		$data_add->save();

		return redirect()->back()->with('success', 'Market Agrikulture Berhasil Ditambahkan');
	}






	// ================================================================================================================
	public function superadmin_koperasi()
	{
		$produk_koperasi = DB::table('produk_koperasis')
		->join('admins' , 'produk_koperasis.id_admin', '=' , 'admins.id')
		->select('produk_koperasis.*','admins.nama')
		->orderBy('produk_koperasis.id','DESC')
		->get();

		return view('super_admin.koperasi.kelola_produk',compact('produk_koperasi'));
	}

	


	// ====================================================================================================================
	public function superadmin_kelola_transaksi()
	{
		$transaksi_agrikulture = TransaksiAgrikulture::orderby('id', 'DESC')->get();

		// $transaksi_koperasi = TransaksiKoperasi::orderby('id', DESC)->get();
		$transaksi_koperasi = DB::table('transaksi_koperasis')
		->join('customers' , 'transaksi_koperasis.id_user', '=' , 'customers.id_user')
		->join('produk_agrikultures' , 'transaksi_koperasis.id_produk_koperasi', '=' , 'produk_agrikultures.id')
		->select('transaksi_koperasis.*','customers.nama','produk_agrikultures.nama_produk')
		->orderBy('transaksi_koperasis.id','DESC')
		->get();

		return view('super_admin.kelola_transaksi.index',compact('transaksi_koperasi','transaksi_agrikulture'));
	}
}
