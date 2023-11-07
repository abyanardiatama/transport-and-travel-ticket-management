<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\SuratPerintahKerjaController;
use App\Http\Controllers\SuratPermintaanTiketDinasController;
use App\Http\Controllers\SuratPermintaanTransportController;
use App\Http\Controllers\UserController;
use App\Models\SuratPerintahKerja;
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
Route::resource('/dashboard/perintahkerja', SuratPerintahKerjaController::class)->middleware('auth');

//Atasan Approve
Route::get('/dashboard/permintaantransport/{id}/approveatasan', [SuratPermintaanTransportController::class, 'approveAtasan'])->middleware('auth');
//Atasan Tolak
Route::get('/dashboard/permintaantransport/{id}/tolakatasan', [SuratPermintaanTransportController::class, 'tolakAtasan'])->middleware('auth');

//Admin Lengkapi data
Route::get('/dashboard/permintaantransport/{id}/lengkapidata', [SuratPermintaanTransportController::class, 'lengkapiData'])->name('permintaantransport.lengkapidata')->middleware('auth');
Route::post('/dashboard/permintaantransport/{id}/lengkapidata', [SuratPermintaanTransportController::class, 'updateLengkapiData'])->middleware('auth');
//Admin Buat Surat Perintah Kerja
Route::post('/dashboard/perintahkerja/store', [SuratPerintahKerjaController::class, 'store'])->name('perintahkerja.store')->middleware('auth');
//Admin Hapus Surat Perintah Kerja
Route::get('/dashboard/perintahkerja/{id}/delete', [SuratPerintahKerjaController::class, 'deletePerintahKerja'])->middleware('auth');


//Admin Delete Surat Transport
Route::get('/dashboard/permintaantransport/{id}/delete', [SuratPermintaanTransportController::class, 'deleteTransport'])->middleware('auth');
//Admin Delete Surat Tiket Dinas
Route::get('/dashboard/permintaantiketdinas/{id}/delete', [SuratPermintaanTiketDinasController::class, 'deleteTiketDinas'])->middleware('auth');
//Surat Tiket Dinas
//Atasan Approve
Route::get('/dashboard/permintaantiketdinas/{id}/atasanapprove', [SuratPermintaanTiketDinasController::class, 'atasanApprove'])->middleware('auth');
//Atasan Tolak
Route::get('/dashboard/permintaantiketdinas/{id}/atasantolak', [SuratPermintaanTiketDinasController::class, 'atasanTolak'])->middleware('auth');

//Admin Review Data Tiket Dinas
Route::get('/dashboard/permintaantiketdinas/{id}/review', [SuratPermintaanTiketDinasController::class, 'reviewData'])->middleware('auth');

//User
Route::resource('/dashboard/user', UserController::class)->middleware('auth');
Route::get('/dashboard/user/{id}/delete', [UserController::class, 'deleteUser'])->middleware('auth');
Route::put('/dashboard/user/{id}/edit', [UserController::class, 'update'])->middleware('auth')->name('user.edit');
//Kendaraan
Route::resource('/dashboard/kendaraan', KendaraanController::class)->middleware('auth');
Route::get('/dashboard/kendaraan/{id}/delete', [KendaraanController::class, 'deleteKendaraan'])->middleware('auth');
Route::put('/dashboard/kendaraan/{id}/edit', [KendaraanController::class, 'update'])->middleware('auth')->name('kendaraan.edit');

//Log Activity
Route::get('/dashboard/log', [DashboardController::class, 'logActivity'])->middleware('auth');