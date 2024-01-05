<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Event;
use App\Models\TiketEvent;
use App\Models\DetailEvent;
use File;
use PDF;
use DB;
use Auth;

class AdminEventController extends Controller
{
    //
	public function admin_event_dashboard()
	{

		return view('admin_event.index');
	}


	public function admin_kelola_event()
	{
		$id_admin = Admin::where('id_user',Auth::user()->id)->first();

		$event = Event::where('id_admin', $id_admin->id)->orderBy('id', 'DESC')->get();

		return view('admin_event.event.index', compact('event'));
	}



	public function admin_event_add(Request $request)
	{

		
		$id_admin = Admin::where('id_user',Auth::user()->id)->first();

		$data_add = new Event();

		
		$data_add->id_admin = $id_admin->id;
		$data_add->judul_event = $request->input('judul_event');
		$data_add->deskripsi = $request->input('deskripsi');
		$data_add->lokasi = $request->input('lokasi');
		$data_add->tanggal_event = $request->input('tanggal_event');
		$data_add->jam_mulai = $request->input('jam_mulai');
		$data_add->jam_selesai = $request->input('jam_selesai');
		$data_add->status = '1';
		

		if ($request->hasFile('foto_event')) {
			$file = $request->file('foto_event');
			$filename = $file->getClientOriginalName();
			$file->move('public/uploads/event/', $filename);
			$data_add->foto_event = $filename;
		} else {
			echo "Gagal upload gambar";
		}
		

		$data_add->save();
		

	// return $cek_keranjang;

		return redirect()->back()->with('success', 'Event Berhasil Ditambahkan');
	}


	public function admin_event_delete($id)
	{


		$cek_event = Event::where('id', $id)->first();

		$delete_tiket = TiketEvent::where('id_event', $cek_event->id)->get();

		foreach ($delete_tiket as $key) {
			File::delete('uploads/tiket_event/' . $key->foto_tiket);
			$key->delete();
		}

		$delete_fasilitas = DetailEvent::where('id_event', $cek_event->id)->get();

		foreach ($delete_fasilitas as $key) {
			$key->delete();
		}

		$delete = Event::findOrFail($id);
		$delete->delete();

		return redirect()->back()->with('success', 'Data Berhasil Dihapus');
	}


	public function admin_tiket_event_delete($id)
	{

		$delete_tiket = TiketEvent::where('id', $id)->first();
		File::delete('public/uploads/tiket_event/' . $delete_tiket->foto_tiket);
		$delete_tiket->delete();
		
		return redirect()->back()->with('success', 'Tiket Berhasil Dihapus');
	}



	public function admin_lihat_detail_event($id)
	{
		
		$event = Event::where('id', $id)->get();

		$detail_event = DetailEvent::where('id_event', $id)->orderBy('id', 'DESC')->get();


		return view('admin_event.event.detail', compact('detail_event','event'));
	}



	public function admin_lihat_tiket_event($id)
	{
		

		$tiket_event = TiketEvent::where('id_event', $id)->orderBy('id', 'DESC')->get();
		$event = Event::where('id', $id)->get();


		return view('admin_event.event.tiket', compact('tiket_event','event'));
	}


	public function admin_fasilitas_event_add(Request $request)
	{

		$data_add = new DetailEvent();

	
		$data_add->id_event = $request->input('id_event');
		$data_add->fasilitas = $request->input('fasilitas');
		

		// return $data_add;	
		$data_add->save();
		

	// return $cek_keranjang;

		return redirect()->back()->with('success', 'Failitas Berhasil Ditambahkan');
	}

	public function admin_tiket_event_add(Request $request)
	{

	

		$data_add = new TiketEvent();

	
		$data_add->id_event = $request->input('id_event');
		$data_add->judul = $request->input('judul');
		$data_add->keterangan = $request->input('keterangan');
		$data_add->deskripsi = $request->input('deskripsi');
		$data_add->harga = $request->input('harga');
		$data_add->stok = $request->input('stok');
		$data_add->sold = '0';
		
		

		if ($request->hasFile('foto_tiket')) {
			$file = $request->file('foto_tiket');
			$filename = $file->getClientOriginalName();
			$file->move('public/uploads/tiket_event/', $filename);
			$data_add->foto_tiket = $filename;
		} else {
			echo "Gagal upload gambar";
		}
		

		$data_add->save();
		

	// return $cek_keranjang;

		return redirect()->back()->with('success', 'Tiket Berhasil Ditambahkan');
	}



	// ======================================================================================================================

	public function admin_kelola_wisata()
	{

		return view('admin_event.wisata.index');
	}

}
