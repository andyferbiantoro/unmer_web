<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Wisata;
use App\Models\TiketWisata;
use App\Models\DetailWisata;
use File;
use PDF;
use DB;
use Auth;

class AdminWisataController extends Controller
{
    //

    public function admin_wisata_dashboard()
	{

		return view('admin_wisata.index');
	}


	public function admin_kelola_wisata()
	{
		$id_admin = Admin::where('id_user',Auth::user()->id)->first();

		$wisata = Wisata::where('id_admin', $id_admin->id)->orderBy('id', 'DESC')->get();

		return view('admin_wisata.wisata.index', compact('wisata'));
	}


	public function admin_wisata_lokasi_wisata($id)
	{
		
		$wisata = Wisata::where('id', $id)->get();

		return view('admin_wisata.wisata.lokasi', compact('wisata'));
	}


	public function admin_wisata_add(Request $request)
	{

		
		$id_admin = Admin::where('id_user',Auth::user()->id)->first();

		$data_add = new Wisata();

		
		$data_add->id_admin = $id_admin->id;
		$data_add->nama_tempat_wisata = $request->input('nama_tempat_wisata');
		$data_add->deskripsi = $request->input('deskripsi');
		$data_add->hari_operasional_awal = $request->input('hari_operasional_awal');
		$data_add->hari_operasional_akhir = $request->input('hari_operasional_akhir');
		$data_add->jam_buka = $request->input('jam_buka');
		$data_add->jam_tutup = $request->input('jam_tutup');
		$data_add->alamat = $request->input('alamat');
		$data_add->status = '1';
		$data_add->longitude = $request->input('longitude');
		$data_add->latitude = $request->input('latitude');
		

		if ($request->hasFile('foto_wisata')) {
			$file = $request->file('foto_wisata');
			$filename = $file->getClientOriginalName();
			$file->move('public/uploads/wisata/', $filename);
			$data_add->foto_wisata = $filename;
		} else {
			echo "Gagal upload gambar";
		}
		

		$data_add->save();
		

	// return $cek_keranjang;

		return redirect()->back()->with('success', 'Wisata Berhasil Ditambahkan');
	}



	public function admin_wisata_edit($id)
	{
		
		$wisata = Wisata::where('id', $id)->get();

		$detail_wisata = DetailWisata::where('id_wisata', $id)->orderBy('id', 'DESC')->get();


		return view('admin_wisata.wisata.edit', compact('detail_wisata','wisata'));
	}


	public function admin_wisata_update(Request $request, $id)
	{
		$long = $request->longitude;
		$lat = $request->latitude;
		$data_update = Wisata::where('id',$id)->first();	

		if ($long == null && $lat == null) {
			$input = [
				'nama_tempat_wisata' => $request->nama_tempat_wisata,
				'deskripsi' => $request->deskripsi,
				'hari_operasional_awal' => $request->hari_operasional_awal,
				'hari_operasional_akhir' => $request->hari_operasional_akhir,
				'jam_buka' => $request->jam_buka,
				'jam_tutup' => $request->jam_tutup,
				'alamat' => $request->alamat,
				'longitude' => $data_update->longitude,
				'latitude' => $data_update->latitude,
				

			];

			if ($file = $request->file('foto_wisata')) {
				if ($data_update->foto_wisata) {
					File::delete('uploads/wisata/' . $data_update->foto_wisata);
				}
				$nama_file = $file->getClientOriginalName();
				$file->move(public_path() . '/uploads/wisata/', $nama_file);
				$input['foto_wisata'] = $nama_file;
			}

			
			$data_update->update($input);

		}else{
			$input = [
				'nama_tempat_wisata' => $request->nama_tempat_wisata,
				'deskripsi' => $request->deskripsi,
				'hari_operasional_awal' => $request->hari_operasional_awal,
				'hari_operasional_akhir' => $request->hari_operasional_akhir,
				'jam_buka' => $request->jam_buka,
				'jam_tutup' => $request->jam_tutup,
				'alamat' => $request->alamat,
				'longitude' => $request->longitude,
				'latitude' => $request->latitude,

			];

			if ($file = $request->file('foto_wisata')) {
				if ($data_update->foto_wisata) {
					File::delete('uploads/wisata/' . $data_update->foto_wisata);
				}
				$nama_file = $file->getClientOriginalName();
				$file->move(public_path() . '/uploads/wisata/', $nama_file);
				$input['foto_wisata'] = $nama_file;
			}

			$data_update->update($input);

		}
		

		return redirect()->back()->with('success', 'wisata Berhasil Diperbarui');
	}





	public function admin_lihat_detail_wisata($id)
	{
		
		$wisata = Wisata::where('id', $id)->get();

		$detail_wisata = DetailWisata::where('id_wisata', $id)->orderBy('id', 'DESC')->get();


		return view('admin_wisata.wisata.detail', compact('detail_wisata','wisata'));
	}


	public function admin_fasilitas_wisata_add(Request $request)
	{

		$data_add = new DetailWisata();

	
		$data_add->id_wisata = $request->input('id_wisata');
		$data_add->fasilitas = $request->input('fasilitas');
		

		// return $data_add;	
		$data_add->save();
		

	// return $cek_keranjang;

		return redirect()->back()->with('success', 'Failitas Berhasil Ditambahkan');
	}


	public function admin_fasilitas_wisata_delete($id)
	{

		$delete_fasilitas = DetailWisata::where('id', $id)->first();
		$delete_fasilitas->delete();
		
		return redirect()->back()->with('success', 'Fasilitas Berhasil Dihapus');
	}




	public function admin_wisata_delete($id)
	{


		$cek_wisata = Wisata::where('id', $id)->first();

		$delete_tiket = TiketWisata::where('id_wisata', $cek_wisata->id)->get();

		foreach ($delete_tiket as $key) {
			File::delete('uploads/tiket_wisata/' . $key->foto_tiket);
			$key->delete();
		}

		$delete_fasilitas = DetailWisata::where('id_wisata', $cek_wisata->id)->get();

		foreach ($delete_fasilitas as $key) {
			$key->delete();
		}

		$delete = Wisata::findOrFail($id);
		$delete->delete();

		return redirect()->back()->with('success', 'Data Berhasil Dihapus');
	}


	public function admin_lihat_tiket_wisata($id)
	{
		

		$tiket_wisata = TiketWisata::where('id_wisata', $id)->orderBy('id', 'DESC')->get();
		$wisata = Wisata::where('id', $id)->get();


		return view('admin_wisata.wisata.tiket', compact('tiket_wisata','wisata'));
	}


	public function admin_tiket_wisata_add(Request $request)
	{

		$data_add = new TiketWisata();
	
		$data_add->id_wisata = $request->input('id_wisata');
		$data_add->judul = $request->input('judul');
		$data_add->keterangan = $request->input('keterangan');
		$data_add->deskripsi = $request->input('deskripsi');
		$data_add->harga = $request->input('harga');
		$data_add->stok = $request->input('stok');
		$data_add->sold = '0';
		
		

		

		$data_add->save();
		

	// return $cek_keranjang;

		return redirect()->back()->with('success', 'Tiket Berhasil Ditambahkan');
	}


	public function admin_tiket_wisata_delete($id)
	{

		$delete_tiket = TiketWisata::where('id', $id)->first();
		File::delete('public/uploads/tiket_wisata/' . $delete_tiket->foto_tiket);
		$delete_tiket->delete();
		
		return redirect()->back()->with('success', 'Tiket Berhasil Dihapus');
	}





}
