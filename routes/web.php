<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AuthController;


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

	//routing untuk mengelola marketagrikulture
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


	//routing untuk mengelola koperasi
	Route::get('/superadmin_koperasi', [SuperadminController::class, 'superadmin_koperasi'])->name('superadmin_koperasi');
	Route::post('/produk_koperasi_add', [SuperadminController::class, 'produk_koperasi_add'])->name('produk_koperasi_add');
	Route::get('/produk_koperasi_detail{id}', [SuperadminController::class, 'produk_koperasi_detail'])->name('produk_koperasi_detail');
	Route::get('/produk_koperasi_edit{id}', [SuperadminController::class, 'produk_koperasi_edit'])->name('produk_koperasi_edit');
	Route::post('/produk_koperasi_update/{id}', [SuperadminController::class, 'produk_koperasi_update'])->name('produk_koperasi_update');
	Route::post('/produk_koperasi_update_size/{id}', [SuperadminController::class, 'produk_koperasi_update_size'])->name('produk_koperasi_update_size');
	Route::post('/produk_koperasi_update_warna/{id}', [SuperadminController::class, 'produk_koperasi_update_warna'])->name('produk_koperasi_update_warna');
	Route::post('/produk_koperasi_delete/{id}', [SuperadminController::class, 'produk_koperasi_delete'])->name('produk_koperasi_delete');



	//routing untuk mengelola transaksi
	Route::get('/superadmin_kelola_transaksi', [SuperadminController::class, 'superadmin_kelola_transaksi'])->name('superadmin_kelola_transaksi');




	//routing untuk broadcast
	Route::get('/superadmin_kelola_broadcast', [SuperadminController::class, 'superadmin_kelola_broadcast'])->name('superadmin_kelola_broadcast');
	Route::get('/superadmin_kelola_broadcast_detail{id}', [SuperadminController::class, 'superadmin_kelola_broadcast_detail'])->name('superadmin_kelola_broadcast_detail');
	Route::post('/superadmin_kelola_broadcast_add', [SuperadminController::class, 'superadmin_kelola_broadcast_add'])->name('superadmin_kelola_broadcast_add');
	Route::post('/superadmin_kelola_broadcast_delete/{id}', [SuperadminController::class, 'superadmin_kelola_broadcast_delete'])->name('superadmin_kelola_broadcast_delete');

	Route::get('/logout_superadmin', [AuthController::class, 'logout_superadmin'])->name('logout_superadmin');
});	


