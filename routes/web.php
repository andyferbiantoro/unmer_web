<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminKasirController;
use App\Http\Controllers\AdminPenginapanController;
use App\Http\Controllers\AdminPendidikanController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\WebViewAndroidController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'cek_nid'])->name('cek_nid');
Route::post('/proses_cek_nid', [AuthController::class, 'proses_cek_nid'])->name('proses_cek_nid');

Route::get('/cek_otp', [AuthController::class, 'cek_otp'])->name('cek_otp');
Route::post('/proses_cek_otp', [AuthController::class, 'proses_cek_otp'])->name('proses_cek_otp');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/proses_login', [AuthController::class, 'proses_login'])->name('proses_login');

//webveiw
Route::get('/keuntungan_transaksi_view', [WebViewAndroidController::class, 'keuntungan_transaksi_view'])->name('keuntungan_transaksi_view');
Route::get('/buku_panduan_view', [WebViewAndroidController::class, 'buku_panduan_view'])->name('buku_panduan_view');
Route::get('/syarat_dan_ketentuan_view', [WebViewAndroidController::class, 'syarat_dan_ketentuan_view'])->name('syarat_dan_ketentuan_view');
Route::get('/kebijakan_privasi_view', [WebViewAndroidController::class, 'kebijakan_privasi_view'])->name('kebijakan_privasi_view');





Route::middleware(['auth', 'superadmin'])->group(function () {
	Route::get('/superadmin_dashboard', [SuperadminController::class, 'superadmin_dashboard'])->name('superadmin_dashboard');

	//routing untuk mengelola admin
	Route::get('/superadmin_kelola_admin', [SuperadminController::class, 'superadmin_kelola_admin'])->name('superadmin_kelola_admin');
	Route::get('/superadmin_admin_event', [SuperadminController::class, 'superadmin_admin_event'])->name('superadmin_admin_event');
	Route::get('/superadmin_admin_pendidikan', [SuperadminController::class, 'superadmin_admin_pendidikan'])->name('superadmin_admin_pendidikan');
	Route::get('/superadmin_admin_kasir', [SuperadminController::class, 'superadmin_admin_kasir'])->name('superadmin_admin_kasir');
	Route::post('/admin_add', [SuperadminController::class, 'admin_add'])->name('admin_add');
	Route::post('/admin_update/{id}', [SuperadminController::class, 'admin_update'])->name('admin_update');
	Route::post('/admin_delete/{id}', [SuperadminController::class, 'admin_delete'])->name('admin_delete');


	// =================================================AGRIKULUTRE-=========================================================

	//routing untuk mengelola market agrikulture
	Route::get('/superadmin_market_agrikulture', [SuperadminController::class, 'superadmin_market_agrikulture'])->name('superadmin_market_agrikulture');
	Route::get('/superadmin_market_agrikulture_edit{id}', [SuperadminController::class, 'superadmin_market_agrikulture_edit'])->name('superadmin_market_agrikulture_edit');
	Route::get('/superadmin_tampil_peta_market{id}', [SuperadminController::class, 'superadmin_tampil_peta_market'])->name('superadmin_tampil_peta_market');
	Route::post('/market_add', [SuperadminController::class, 'market_add'])->name('market_add');
	Route::post('/market_update/{id}', [SuperadminController::class, 'market_update'])->name('market_update');
	Route::post('/market_delete/{id}', [SuperadminController::class, 'market_delete'])->name('market_delete');

    //routing mengelola produk Agrikulture
	Route::get('/superadmin_agrikulture', [SuperadminController::class, 'superadmin_agrikulture'])->name('superadmin_agrikulture');
	Route::get('/superadmin_produk_agrikulture_edit{id}', [SuperadminController::class, 'superadmin_produk_agrikulture_edit'])->name('superadmin_produk_agrikulture_edit');
	Route::post('/produk_agrikulture_add', [SuperadminController::class, 'produk_agrikulture_add'])->name('produk_agrikulture_add');
	Route::post('/produk_agrikulture_update/{id}', [SuperadminController::class, 'produk_agrikulture_update'])->name('produk_agrikulture_update');
	Route::post('/produk_agrikulture_delete/{id}', [SuperadminController::class, 'produk_agrikulture_delete'])->name('produk_agrikulture_delete');

	//transaksi agrikulture
	Route::get('/superadmin_transaksi_agrikulture', [SuperadminController::class, 'superadmin_transaksi_agrikulture'])->name('superadmin_transaksi_agrikulture');
	Route::get('/superadmin_transaksi_agrikulture_detail{id}', [SuperadminController::class, 'superadmin_transaksi_agrikulture_detail'])->name('superadmin_transaksi_agrikulture_detail');




	// =================================================END AGRIKULTURE===========================================

	//routing untuk mengelola koperasi
	Route::get('/superadmin_koperasi', [SuperadminController::class, 'superadmin_koperasi'])->name('superadmin_koperasi');
	Route::post('/produk_koperasi_add', [SuperadminController::class, 'produk_koperasi_add'])->name('produk_koperasi_add');
	Route::get('/produk_koperasi_detail{id}', [SuperadminController::class, 'produk_koperasi_detail'])->name('produk_koperasi_detail');
	Route::get('/produk_koperasi_edit{id}', [SuperadminController::class, 'produk_koperasi_edit'])->name('produk_koperasi_edit');
	Route::post('/produk_koperasi_update/{id}', [SuperadminController::class, 'produk_koperasi_update'])->name('produk_koperasi_update');
	Route::post('/produk_koperasi_update_size/{id}', [SuperadminController::class, 'produk_koperasi_update_size'])->name('produk_koperasi_update_size');
	Route::post('/produk_koperasi_update_warna/{id}', [SuperadminController::class, 'produk_koperasi_update_warna'])->name('produk_koperasi_update_warna');
	Route::post('/produk_koperasi_delete/{id}', [SuperadminController::class, 'produk_koperasi_delete'])->name('produk_koperasi_delete');

	//transaksi Koperasi
	Route::get('/superadmin_transaksi_koperasi', [SuperadminController::class, 'superadmin_transaksi_koperasi'])->name('superadmin_transaksi_koperasi');
	Route::get('/superadmin_transaksi_koperasi_detail{id}', [SuperadminController::class, 'superadmin_transaksi_koperasi_detail'])->name('superadmin_transaksi_koperasi_detail');


	//routing untuk mengelola Kost
	Route::get('/superadmin_kost', [SuperadminController::class, 'superadmin_kost'])->name('superadmin_kost');



	//routing untuk mengelola Top Up
	Route::get('/superadmin_kelola_topup', [SuperadminController::class, 'superadmin_kelola_topup'])->name('superadmin_kelola_topup');
	Route::post('/superadmin_konfirmasi_topup/{id}', [SuperadminController::class, 'superadmin_konfirmasi_topup'])->name('superadmin_konfirmasi_topup');



	//routing untuk broadcast
	Route::get('/superadmin_kelola_broadcast', [SuperadminController::class, 'superadmin_kelola_broadcast'])->name('superadmin_kelola_broadcast');
	Route::get('/superadmin_kelola_broadcast_detail{id}', [SuperadminController::class, 'superadmin_kelola_broadcast_detail'])->name('superadmin_kelola_broadcast_detail');
	Route::post('/superadmin_kelola_broadcast_add', [SuperadminController::class, 'superadmin_kelola_broadcast_add'])->name('superadmin_kelola_broadcast_add');
	Route::post('/superadmin_kelola_broadcast_delete/{id}', [SuperadminController::class, 'superadmin_kelola_broadcast_delete'])->name('superadmin_kelola_broadcast_delete');

	Route::get('/logout_superadmin', [AuthController::class, 'logout_superadmin'])->name('logout_superadmin');



});	
// ===========================================================================================================================


//Routing untuk role Admin Kasir
Route::middleware(['auth', 'admin_kasir'])->group(function () {
	Route::get('/admin_kasir_dashboard', [AdminKasirController::class, 'admin_kasir_dashboard'])->name('admin_kasir_dashboard');

	//Kasir agrikulture
	Route::get('/admin_kasir_agrikulture', [AdminKasirController::class, 'admin_kasir_agrikulture'])->name('admin_kasir_agrikulture');
	Route::post('/kasir_keranjang_add/{id}', [AdminKasirController::class, 'kasir_keranjang_add'])->name('kasir_keranjang_add');
	Route::post('/kasir_batalkan_produk/{id}', [AdminKasirController::class, 'kasir_batalkan_produk'])->name('kasir_batalkan_produk');
	Route::post('/kasir_transaksi_offline_add', [AdminKasirController::class, 'kasir_transaksi_offline_add'])->name('kasir_transaksi_offline_add');
	Route::get('/admin_kasir_transaksi_agrikulture_selesai', [AdminKasirController::class, 'admin_kasir_transaksi_agrikulture_selesai'])->name('admin_kasir_transaksi_agrikulture_selesai');


	// Kelola Produk Agrikulture
	Route::get('/admin_kelola_agrikulture', [AdminKasirController::class, 'admin_kelola_agrikulture'])->name('admin_kelola_agrikulture');
	Route::post('/admin_kasir_ubah_stok_agrikulture/{id}', [AdminKasirController::class, 'admin_kasir_ubah_stok_agrikulture'])->name('admin_kasir_ubah_stok_agrikulture');

	// Kelola Produk Koperasi
	Route::get('/admin_kelola_koperasi', [AdminKasirController::class, 'admin_kelola_koperasi'])->name('admin_kelola_koperasi');

	//logout admin s
	Route::get('/admin_kasir_logout', [AuthController::class, 'admin_kasir_logout'])->name('admin_kasir_logout');
});	

// ===========================================================================================================================

//Routing untuk role Admin Penginapan
Route::middleware(['auth', 'admin_penginapan'])->group(function () {
	Route::get('/admin_penginapan_dashboard', [AdminPenginapanController::class, 'admin_penginapan_dashboard'])->name('admin_penginapan_dashboard');


	Route::get('/admin_penginapan_logout', [AuthController::class, 'admin_penginapan_logout'])->name('admin_penginapan_logout');
});	

// ===========================================================================================================================


//Routing untuk role Admin pendidikan
Route::middleware(['auth', 'admin_pendidikan'])->group(function () {
	Route::get('/admin_pendidikan_dashboard', [AdminPendidikanController::class, 'admin_pendidikan_dashboard'])->name('admin_pendidikan_dashboard');



	Route::get('/admin_pendidikan_logout', [AuthController::class, 'admin_pendidikan_logout'])->name('admin_pendidikan_logout');

});	
// ===========================================================================================================================


//Routing untuk role Admin Event
Route::middleware(['auth', 'admin_event'])->group(function () {
	Route::get('/admin_event_dashboard', [AdminEventController::class, 'admin_event_dashboard'])->name('admin_event_dashboard');



	Route::get('/admin_event_logout', [AuthController::class, 'admin_event_logout'])->name('admin_event_logout');

});	








