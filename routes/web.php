<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\RfidController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('/members',MemberController::class);
Route::resource('/rfid',RfidController::class);
Route::post('/tambah_kode_rfid',[MemberController::class,'tambah_kode']);