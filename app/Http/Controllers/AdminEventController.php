<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Event;
use App\Models\TiketEvent;
use App\Models\DetailEvent;
use App\Models\TransaksiEvent;
use App\Models\FotoEvent;
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

		$id_event = Event::where('id_admin', $id_admin->id)->orderBy('id', 'DESC')->first();
		$detail_event = DetailEvent::where('id_event', $id_event->id)->orderBy('id', 'DESC')->get();
		$foto_event = FotoEvent::where('id_event', $id_event->id)->orderby('id','DESC')->get();

		return view('admin_event.event.index', compact('event','detail_event','foto_event'));
	}


	public function admin_event_lokasi_event($id)
	{
		
		$event = Event::where('id', $id)->get();


		return view('admin_event.event.lokasi', compact('event'));
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
		$data_add->longitude = $request->input('longitude');
		$data_add->latitude = $request->input('latitude');
		

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



	public function admin_lihat_tiket_event()
	{
		$id_admin = Admin::where('id_user',Auth::user()->id)->first();
		$id_event = Event::where('id_admin', $id_admin->id)->first();

		
		$tiket_event = TiketEvent::where('id_event', $id_event->id)->orderBy('id', 'DESC')->get();
		$event = Event::where('id', $id_event->id)->get();


		return view('admin_event.scan_tiket.tiket', compact('tiket_event','event'));
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


	public function admin_fasilitas_event_delete($id)
	{

		$delete_fasilitas = DetailEvent::where('id', $id)->first();
		$delete_fasilitas->delete();

		return redirect()->back()->with('success', 'Fasilitas Berhasil Dihapus');
	}



	public function admin_tiket_event_add(Request $request)
	{

		$kode_tiket = mt_rand(10000, 99999);

		$data_add = new TiketEvent();


		$data_add->id_event = $request->input('id_event');
		$data_add->judul = $request->input('judul');
		$data_add->keterangan = $request->input('keterangan');
		$data_add->deskripsi = $request->input('deskripsi');
		$data_add->harga = $request->input('harga');
		$data_add->stok = $request->input('stok');
		$data_add->sold = '0';
		$data_add->kode_tiket = $kode_tiket;
		
		$data_add->save();
		

	// return $cek_keranjang;

		return redirect()->back()->with('success', 'Tiket Berhasil Ditambahkan');
	}



	public function admin_event_edit($id)
	{
		
		$event = Event::where('id', $id)->get();

		$detail_event = DetailEvent::where('id_event', $id)->orderBy('id', 'DESC')->get();


		return view('admin_event.event.edit', compact('detail_event','event'));
	}


	public function admin_event_update(Request $request, $id)
	{
		$long = $request->longitude;
		$lat = $request->latitude;
		$data_update = Event::where('id',$id)->first();	

		if ($long == null && $lat == null) {
			$input = [
				'judul_event' => $request->judul_event,
				'deskripsi' => $request->deskripsi,
				'lokasi' => $request->lokasi,
				'tanggal_event' => $request->tanggal_event,
				'jam_mulai' => $request->jam_mulai,
				'jam_selesai' => $request->jam_selesai,
				'longitude' => $data_update->longitude,
				'latitude' => $data_update->latitude,

			];

			if ($file = $request->file('foto_event')) {
				if ($data_update->foto_event) {
					File::delete('uploads/event/' . $data_update->foto_event);
				}
				$nama_file = $file->getClientOriginalName();
				$file->move(public_path() . '/uploads/event/', $nama_file);
				$input['foto_event'] = $nama_file;
			}

			$data_update->update($input);

		}else{
			$input = [
				'judul_event' => $request->judul_event,
				'deskripsi' => $request->deskripsi,
				'lokasi' => $request->lokasi,
				'tanggal_event' => $request->tanggal_event,
				'jam_mulai' => $request->jam_mulai,
				'jam_selesai' => $request->jam_selesai,
				'longitude' => $request->longitude,
				'latitude' => $request->latitude,

			];

			if ($file = $request->file('foto_event')) {
				if ($data_update->foto_event) {
					File::delete('uploads/event/' . $data_update->foto_event);
				}
				$nama_file = $file->getClientOriginalName();
				$file->move(public_path() . '/uploads/event/', $nama_file);
				$input['foto_event'] = $nama_file;
			}

			$data_update->update($input);

		}
		

		return redirect()->back()->with('success', 'Event Berhasil Diperbarui');
	}


// ===============================================================================================================



	public function admin_kelola_transaksi_event()
	{

		$event = Event::OrderBy('id', 'DESC')->get();


		return view('admin_event.transaksi.index', compact('event'));
	}



	public function admin_pembelian_tiket($id)
	{

		$pembelian_tiket = DB::table('transaksi_events')
			->join('customers', 'transaksi_events.id_customer', '=', 'customers.id')
			->join('events', 'transaksi_events.id_event', '=', 'events.id')
			->join('tiket_events', 'transaksi_events.id_tiket', '=', 'tiket_events.id')
			->select('transaksi_events.*', 'customers.nama','events.judul_event','tiket_events.judul','tiket_events.harga','tiket_events.kode_tiket')
			->orderBy('transaksi_events.id', 'DESC')
			->where('transaksi_events.id_event', $id)
			->where('transaksi_events.status', 'valid')
			->get();
		
		// /return $pembelian_tiket;

		return view('admin_event.transaksi.pembelian_tiket', compact('pembelian_tiket'));
	}




// ================================================================================================================

	public function admin_scan_tiket_event(Request $request)
	{

		$kode_transaksi = $request->kode_transaksi;

		if ($kode_transaksi == null) {
			$cari_tiket = DB::table('transaksi_events')
			->join('customers', 'transaksi_events.id_customer', '=', 'customers.id')
			->join('events', 'transaksi_events.id_event', '=', 'events.id')
			->join('tiket_events', 'transaksi_events.id_tiket', '=', 'tiket_events.id')
			->select('transaksi_events.*', 'customers.nama','events.judul_event','tiket_events.judul','tiket_events.harga','tiket_events.kode_tiket')
			->orderBy('transaksi_events.id', 'DESC')
			->where('transaksi_events.kode_transaksi','0')
			->get();


		}else{
			// $cari_tiket = ProdukKoperasi::where('kode_transaksi',$kode_transaksi)->get();

			$cari_tiket = DB::table('transaksi_events')
			->join('customers', 'transaksi_events.id_customer', '=', 'customers.id')
			->join('events', 'transaksi_events.id_event', '=', 'events.id')
			->join('tiket_events', 'transaksi_events.id_tiket', '=', 'tiket_events.id')
			->select('transaksi_events.*', 'customers.nama','events.judul_event','tiket_events.judul','tiket_events.harga','tiket_events.kode_tiket')
			->orderBy('transaksi_events.id', 'DESC')
			->where('transaksi_events.kode_transaksi',$kode_transaksi)
			->get();
		}

		return view('admin_event.scan_tiket.index',compact('cari_tiket'));
	}



	public function admin_update_status_tiket_event(Request $request, $id)
	{

		$data_update = TransaksiEvent::where('id',$id)->first();	
		
		
		$input = [
			'status' => 'valid',
		];

		$data_update->update($input);

		return redirect()->back()->with('success', 'Tiket Berhasil Diverifikasi');
	}


// ==================================================================================================================

public function admin_foto_event_edit($id)
	{
		
		$foto_event = FotoEvent::where('id_event', $id)->get();
		$event = Event::where('id', $id)->first();



		return view('admin_event.event.lihat_foto', compact('foto_event','event'));
	}


	public function admin_foto_event_add(Request $request)
	{

		
		
		$get_count = FotoEvent::where('id_event',$request->input('id_event'))->count();

		$add_foto = new FotoEvent();

		$add_foto->id_event = $request->input('id_event');
		$add_foto->indeks = $get_count+1;

		if ($request->hasFile('foto_event')) {
			$file = $request->file('foto_event');
			$filename = $file->getClientOriginalName();
			$file->move('public/uploads/event/', $filename);
			$add_foto->foto_event = $filename;
		} else {
			echo "Gagal upload gambar";
		}

		$add_foto->save();
			# code...
		

		

	    // return $cek_keranjang;

		return redirect()->back()->with('success', 'Event Berhasil Ditambahkan');
	}

	public function admin_foto_event_delete($id)
	{

		$delete_foto = FotoEvent::where('id', $id)->first();
		File::delete('public/uploads/event/' . $delete_foto->foto_event);
		$delete_foto->delete();
		
		return redirect()->back()->with('success', 'Foto Berhasil Dihapus');
	}

}

