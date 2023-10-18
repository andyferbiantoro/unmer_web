<?php

use App\Http\Controllers\API\AuthController;
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

