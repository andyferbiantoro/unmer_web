<?php

use App\Http\Controllers\API\AgrikulturController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\KoperasiController;
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
Route::post('customer/profil/update',[AuthController::class,'ubah_profil']);
Route::post('customer/update-user-profile',[AuthController::class,'updateUserProfile']);

//
Route::get('customer/getno_bantuan',[AuthController::class,'getno_bantuan']);
Route::get('customer/getstatus_menu_apk',[AuthController::class,'getstatus_menu_apk']);
Route::get('customer/total_pemasukan_bulan/{id}',[AuthController::class,'total_pemasukan_bulan']);
Route::get('customer/total_pengeluaran_bulan',[AuthController::class,'total_pengeluaran_bulan']);


//saldo topup
Route::get('customer/saldo/{id}',[SaldoController::class,'saldo']);
Route::post('customer/topup_saldo',[SaldoController::class,'topup']);
Route::get('customer/history_saldo/{id_user}',[SaldoController::class,'history_saldo']);
Route::get('customer/history_saldo_first/{id}',[SaldoController::class,'history_saldo_first']);
Route::post('customer/unggah_bukti_topup',[SaldoController::class,'unggah_bukti']);
Route::post('customer/batal_topup',[SaldoController::class,'batal_topup']);
Route::get('customer/tranksaski_saldo/{id_user}',[SaldoController::class,'transaksi_saldo_terakhir']);
Route::get('customer/bank',[SaldoController::class,'bank']);

//kirimsaldo

Route::get('customer/cek_penerima',[SaldoController::class,'getdatapenerima']);
Route::post('customer/kirimsaldo',[SaldoController::class,'kirimsaldo']);
Route::get('customer/getkirimsaldo_last',[SaldoController::class,'getkirimsaldo_last']);
Route::get('customer/history_kirim_saldo/{id}',[SaldoController::class,'history_kirim_saldo']);
Route::get('customer/getkirimsaldo_detail/{id}',[SaldoController::class,'getkirimsaldo_detail']);




//agrikulture
Route::get('customer/list_market',[AgrikulturController::class,'list_market']);
Route::get('customer/list_kategori_produk_agri',[AgrikulturController::class,'list_kategori_produk_agri']);
Route::get('customer/list_produk_market/{id_market}',[AgrikulturController::class,'list_produk_market']);
Route::post('customer/keranjang',[AgrikulturController::class,'keranjang']);
Route::post('customer/create_transaksi_market',[AgrikulturController::class,'create_transaki_market']);
Route::get('customer/list_transaksi_market/{id_user}',[AgrikulturController::class,'list_transaki_market']);
Route::post('customer/list_keranjang',[AgrikulturController::class,'list_keranjang']);
Route::get('customer/total_keranjang/{id_user}',[AgrikulturController::class,'total_keranjang']);
Route::post('customer/hapus_keranjang',[AgrikulturController::class,'hapus_keranjang']);
Route::get('customer/cek_kode_transaksi/{kode_transkasi}',[AgrikulturController::class,'cek_kode_transaksi']);
Route::get('customer/biaya_layanan',[AgrikulturController::class,'biaya_layanan']);
Route::get('customer/scan_driver_kode',[AgrikulturController::class,'scan_driver_kode']);
Route::get('customer/list_orderan_agrikultur',[AgrikulturController::class,'list_orderan_agrikultur']);
Route::get('customer/list_orderan_agrikultur/{kode}',[AgrikulturController::class,'list_orderan_agrikultur_kode']);



//koperasi
Route::get('customer/kategori_produk_koperasi',[KoperasiController::class,'kategori_produk_koperasi']);
Route::get('customer/list_produk_koperasi',[KoperasiController::class,'list_produk_koperasi']);
Route::get('customer/detail_produk_koperasi/{id_produk}',[KoperasiController::class,'detail_produk_koperasi']);
Route::post('customer/tambah_keranjang_koperasi',[KoperasiController::class,'keranjang_koperasi']);
Route::post('customer/koperasi/hapus_keranjang',[KoperasiController::class,'hapus_keranjang']);
Route::post('customer/koperasi/list_keranjang',[KoperasiController::class,'list_keranjang']);
Route::post('customer/koperasi/create_transaksi',[KoperasiController::class,'create_transaksi_koperasi']);

//event
Route::get('customer/list_event',[EventController::class,'list_event']);
Route::get('customer/fasilitas/{id_event}',[EventController::class,'fasilitas']);
Route::get('customer/list_tiket/{id_event}',[EventController::class,'list_tiket_event']);
Route::get('customer/foto_event/{id_event}',[EventController::class,'list_foto_event']);
Route::get('customer/cek_kode_tiket',[EventController::class,'cektiket']);
Route::get('customer/registrasi_tiket',[EventController::class,'registrasi_tiket']);
Route::post('customer/create_transaki_tiket',[EventController::class,'create_transaki_tiket']);
Route::get('customer/list_transaki_tiket/{id_user}',[EventController::class,'list_transaksi_tiket']);
Route::get('customer/list_transaki_tiket_first/{id}',[EventController::class,'list_transaksi_tiket_first']);







Route::get('notif_saldo',[AuthController::class,'notif']);


