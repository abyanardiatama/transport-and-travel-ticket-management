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
use Illuminate\Support\Facades\Auth;
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

Route::resource('/dashboard/permintaantransport', SuratPermintaanTransportController::class)
    ->middleware(['auth', 'role:pegawai,admin,atasan1,atasan2']);
Route::resource('/dashboard/permintaantiketdinas', SuratPermintaanTiketDinasController::class)
    ->middleware(['auth', 'role:pegawai,admin,atasan1,atasan2']);
Route::resource('/dashboard/perintahkerja', SuratPerintahKerjaController::class)
    ->middleware(['auth','role:admin,driver']);

//Admin Lengkapi data surat permintaan trasnport
Route::get('/dashboard/permintaantransport/{id}/lengkapidata', [SuratPermintaanTransportController::class, 'lengkapiData'])->name('permintaantransport.lengkapidata')
    ->middleware(['auth','role:admin']);
Route::post('/dashboard/permintaantransport/{id}/lengkapidata', [SuratPermintaanTransportController::class, 'updateLengkapiData'])
    ->middleware(['auth','role:admin']);
//Admin Buat Surat Perintah Kerja
Route::post('/dashboard/perintahkerja/store', [SuratPerintahKerjaController::class, 'store'])->name('perintahkerja.store')
    ->middleware(['auth','role:admin']);
//Admin Hapus Surat Perintah Kerja
Route::get('/dashboard/perintahkerja/{id}/delete', [SuratPerintahKerjaController::class, 'deletePerintahKerja'])
    ->middleware(['auth','role:admin']);

//Admin Delete Surat Transport
Route::get('/dashboard/permintaantransport/{id}/delete', [SuratPermintaanTransportController::class, 'deleteTransport'])
    ->middleware(['auth','role:admin']);
//Admin Delete Surat Tiket Dinas
Route::get('/dashboard/permintaantiketdinas/{id}/delete', [SuratPermintaanTiketDinasController::class, 'deleteTiketDinas'])
    ->middleware(['auth','role:admin']);

//User
Route::resource('/dashboard/user', UserController::class)
    ->middleware(['auth','role:admin']);
Route::get('/dashboard/user/{id}/delete', [UserController::class, 'deleteUser'])
    ->middleware(['auth','role:admin']);
Route::put('/dashboard/user/{id}/edit', [UserController::class, 'update'])->name('user.edit')
    ->middleware(['auth','role:admin']);
//Kendaraan
Route::resource('/dashboard/kendaraan', KendaraanController::class)
    ->middleware(['auth','role:admin']);
Route::get('/dashboard/kendaraan/{id}/delete', [KendaraanController::class, 'deleteKendaraan'])
    ->middleware(['auth','role:admin']);
Route::put('/dashboard/kendaraan/{id}/edit', [KendaraanController::class, 'update'])->name('kendaraan.edit')
    ->middleware(['auth','role:admin']);

//Log Activity
Route::get('/dashboard/log', [DashboardController::class, 'logActivity'])->name('logActivity.index')
    ->middleware(['auth','role:admin']);

//Atasan Approve
Route::get('/dashboard/permintaantransport/{id}/approveatasan', [SuratPermintaanTransportController::class, 'approveAtasan'])
    ->middleware(['auth','role:atasan1,atasan2']);
//Atasan Tolak
Route::get('/dashboard/permintaantransport/{id}/tolakatasan', [SuratPermintaanTransportController::class, 'tolakAtasan'])
    ->middleware(['auth','role:atasan1,atasan2']);

//Surat Tiket Dinas
//Atasan Approve
Route::get('/dashboard/permintaantiketdinas/{id}/atasanapprove', [SuratPermintaanTiketDinasController::class, 'atasanApprove'])
    ->middleware(['auth','role:atasan1,atasan2']);
//Atasan Tolak
Route::get('/dashboard/permintaantiketdinas/{id}/atasantolak', [SuratPermintaanTiketDinasController::class, 'atasanTolak'])
    ->middleware(['auth','role:atasan1,atasan2']);

//Download Surat Permintaaan Transport
Route::get('/dashboard/permintaantransport/{id}/download', [SuratPermintaanTransportController::class, 'downloadTransport'])
    ->middleware(['auth','role:admin,pegawai']);
//Download Surat Tiket Dinas
Route::get('/dashboard/permintaantiketdinas/{id}/download', [SuratPermintaanTiketDinasController::class, 'downloadTiketDinas'])
    ->middleware(['auth','role:admin,pegawai']);
//Download Surat Perintah Kerja
Route::get('/dashboard/perintahkerja/{id}/download', [SuratPerintahKerjaController::class, 'downloadPerintahKerja'])
    ->middleware(['auth','role:admin,driver']);

/*
Route::resource('/dashboard/permintaantransport', SuratPermintaanTransportController::class)->middleware(['auth','pegawai','admin']);
Route::resource('/dashboard/permintaantiketdinas', SuratPermintaanTiketDinasController::class)->middleware(['auth','admin','atasan','pegawai']);
Route::resource('/dashboard/perintahkerja', SuratPerintahKerjaController::class)->middleware(['auth','admin','driver']);

//Admin Lengkapi data surat permintaan trasnport
Route::get('/dashboard/permintaantransport/{id}/lengkapidata', [SuratPermintaanTransportController::class, 'lengkapiData'])->name('permintaantransport.lengkapidata')->middleware(['auth','admin']);
Route::post('/dashboard/permintaantransport/{id}/lengkapidata', [SuratPermintaanTransportController::class, 'updateLengkapiData'])->middleware(['auth','admin']);
//Admin Buat Surat Perintah Kerja
Route::post('/dashboard/perintahkerja/store', [SuratPerintahKerjaController::class, 'store'])->name('perintahkerja.store')->middleware(['auth','admin']);
//Admin Hapus Surat Perintah Kerja
Route::get('/dashboard/perintahkerja/{id}/delete', [SuratPerintahKerjaController::class, 'deletePerintahKerja'])->middleware('auth','admin');
//Download Surat Perintah Kerja
Route::get('/dashboard/perintahkerja/{id}/download', [SuratPerintahKerjaController::class, 'downloadPerintahKerja'])->middleware(['auth','admin','driver']);

//Admin Delete Surat Transport
Route::get('/dashboard/permintaantransport/{id}/delete', [SuratPermintaanTransportController::class, 'deleteTransport'])->middleware(['auth','admin']);
//Admin Delete Surat Tiket Dinas
Route::get('/dashboard/permintaantiketdinas/{id}/delete', [SuratPermintaanTiketDinasController::class, 'deleteTiketDinas'])->middleware(['auth','admin']);

//User
Route::resource('/dashboard/user', UserController::class)->middleware(['auth','admin']);
Route::get('/dashboard/user/{id}/delete', [UserController::class, 'deleteUser'])->middleware(['auth','admin']);
Route::put('/dashboard/user/{id}/edit', [UserController::class, 'update'])->middleware(['auth','admin'])->name('user.edit');
//Kendaraan
Route::resource('/dashboard/kendaraan', KendaraanController::class)->middleware(['auth','admin']);
Route::get('/dashboard/kendaraan/{id}/delete', [KendaraanController::class, 'deleteKendaraan'])->middleware(['auth','admin']);
Route::put('/dashboard/kendaraan/{id}/edit', [KendaraanController::class, 'update'])->middleware(['auth','admin'])->name('kendaraan.edit');

//Log Activity
Route::get('/dashboard/log', [DashboardController::class, 'logActivity'])->middleware(['auth','admin'])->name('logActivity.index');

//Atasan Approve
Route::get('/dashboard/permintaantransport/{id}/approveatasan', [SuratPermintaanTransportController::class, 'approveAtasan'])->middleware(['auth','atasan']);
//Atasan Tolak
Route::get('/dashboard/permintaantransport/{id}/tolakatasan', [SuratPermintaanTransportController::class, 'tolakAtasan'])->middleware(['auth','atasan']);

//Surat Tiket Dinas
//Atasan Approve
Route::get('/dashboard/permintaantiketdinas/{id}/atasanapprove', [SuratPermintaanTiketDinasController::class, 'atasanApprove'])->middleware(['auth','atasan']);
//Atasan Tolak
Route::get('/dashboard/permintaantiketdinas/{id}/atasantolak', [SuratPermintaanTiketDinasController::class, 'atasanTolak'])->middleware(['auth','atasan']);

//Download Surat Permintaaan Transport
Route::get('/dashboard/permintaantransport/{id}/download', [SuratPermintaanTransportController::class, 'downloadTransport'])->middleware(['auth','pegawai','admin']);
//Download Surat Tiket Dinas
Route::get('/dashboard/permintaantiketdinas/{id}/download', [SuratPermintaanTiketDinasController::class, 'downloadTiketDinas'])->middleware(['auth','admin','pegawai']);
//Download Surat Perintah Kerja
Route::get('/dashboard/perintahkerja/{id}/download', [SuratPerintahKerjaController::class, 'downloadPerintahKerja'])->middleware(['auth','admin','driver']);
*/