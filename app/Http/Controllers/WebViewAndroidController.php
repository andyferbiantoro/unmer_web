<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebViewAndroidController extends Controller
{
    //
     public function keuntungan_transaksi_view()
	{

		return view('webview_android.keuntungan_transaksi');
	}

	 public function buku_panduan_view()
	{

		return view('webview_android.buku_panduan');
	}

	 public function syarat_dan_ketentuan_view()
	{

		return view('webview_android.syarat_dan_ketentuan');
	}

	 public function kebijakan_privasi_view()
	{

		return view('webview_android.kebijakan_privasi');
	}
}
