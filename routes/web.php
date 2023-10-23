<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratPermintaanTiketDinasController;
use App\Http\Controllers\SuratPermintaanTransportController;
use App\Models\SuratPermintaanTransport;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login.index');
});
// Login dan Logut
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);
Route::get('/dashboard',[DashboardController::class, 'index'])->middleware('auth');

// Dashboard
Route::resource('/dashboard/permintaantransport', SuratPermintaanTransportController::class)->middleware('auth');
Route::resource('/dashboard/permintaantiketdinas', SuratPermintaanTiketDinasController::class)->middleware('auth');

//Surat Permintaan Transport
Route::resource('/dashboard/permintaantransport', SuratPermintaanTransportController::class)->middleware('auth');

//Surat Permintaan Tiket Dinas
Route::resource('/dashboard/permintaantiketdinas', SuratPermintaanTiketDinasController::class)->middleware('auth');

//Surat Perintah Kerja
Route::resource('/dashboard/perintahkerja', SuratPermintaanTiketDinasController::class)->middleware('auth');

