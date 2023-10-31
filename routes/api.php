<?php

use App\Http\Controllers\API\AgrikulturController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\SaldoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuperadminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/register', [SuperadminController::class, 'register'])->name('register');

//auth
Route::post('customer/login',[AuthController::class,'login']);
Route::post('customer/otp',[AuthController::class,'otp']);
Route::post('customer/pin',[AuthController::class,'pin']);
Route::post('customer/register',[AuthController::class,'register']);
Route::post('customer/pin/tambah',[AuthController::class,'create_pin']);

Route::get('customer/profil/{id}',[AuthController::class,'get_profil']);
Route::post('customer/profil/update/{id}',[AuthController::class,'ubah_profil']);

Route::get('customer/saldo/{id}',[SaldoController::class,'saldo']);

Route::post('customer/topup_saldo/{id_user}',[SaldoController::class,'topup']);

Route::get('customer/history/{id_user}',[SaldoController::class,'history_saldo']);

Route::get('customer/list_market',[AgrikulturController::class,'list_market']);
Route::get('customer/list_produk_market/{id_market}',[AgrikulturController::class,'list_produk_market']);
Route::post('customer/keranjang',[AgrikulturController::class,'keranjang']);
Route::post('customer/create_transaksi_market',[AgrikulturController::class,'create_transaki_market']);

Route::get('customer/list_transaksi_market/{id_user}',[AgrikulturController::class,'list_transaki_market']);

Route::get('customer/list_keranjang/{id_user}',[AgrikulturController::class,'list_keranjang']);
Route::get('customer/total_keranjang/{id_user}',[AgrikulturController::class,'total_keranjang']);
Route::post('customer/hapus_keranjang',[AgrikulturController::class,'hapus_keranjang']);

