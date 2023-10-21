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

	//routing untuk mengelola agrikulture
	Route::get('/superadmin_market_agrikulture', [SuperadminController::class, 'superadmin_market_agrikulture'])->name('superadmin_market_agrikulture');
	Route::post('/market_add', [SuperadminController::class, 'market_add'])->name('market_add');
	Route::post('/market_update/{id}', [SuperadminController::class, 'market_update'])->name('market_update');
	Route::post('/market_delete/{id}', [SuperadminController::class, 'market_delete'])->name('market_delete');

	Route::get('/superadmin_agrikulture', [SuperadminController::class, 'superadmin_agrikulture'])->name('superadmin_agrikulture');
	Route::post('/produk_agrikulture_add', [SuperadminController::class, 'produk_agrikulture_add'])->name('produk_agrikulture_add');


	//routing untuk mengelola koperasi
	Route::get('/superadmin_koperasi', [SuperadminController::class, 'superadmin_koperasi'])->name('superadmin_koperasi');

	//routing untuk mengelola transaksi
	Route::get('/superadmin_kelola_transaksi', [SuperadminController::class, 'superadmin_kelola_transaksi'])->name('superadmin_kelola_transaksi');




	//routing untuk broadcast
	Route::get('/superadmin_kelola_broadcast', [SuperadminController::class, 'superadmin_kelola_broadcast'])->name('superadmin_kelola_broadcast');


	Route::get('/logout_superadmin', [AuthController::class, 'logout_superadmin'])->name('logout_superadmin');
});	


