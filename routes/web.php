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

	Route::get('/superadmin_kelola_admin', [SuperadminController::class, 'superadmin_kelola_admin'])->name('superadmin_kelola_admin');

	Route::get('/superadmin_kelola_produk', [SuperadminController::class, 'superadmin_kelola_produk'])->name('superadmin_kelola_produk');

	Route::get('/superadmin_kelola_transaksi', [SuperadminController::class, 'superadmin_kelola_transaksi'])->name('superadmin_kelola_transaksi');

	Route::get('/superadmin_kelola_broadcast', [SuperadminController::class, 'superadmin_kelola_broadcast'])->name('superadmin_kelola_broadcast');

	Route::get('/logout_superadmin', [AuthController::class, 'logout_superadmin'])->name('logout_superadmin');
});	


