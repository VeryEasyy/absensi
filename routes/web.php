<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;

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

Route::middleware(['guest:karyawan'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

     Route::post('/proseslogin', [AuthController::class,'proseslogin'] );

     //register
     Route::get('/auth/register', [AuthController::class,'register'] );
     Route::post('/auth/register', [AuthController::class,'prosesregister'] );

     //lupaa password
     Route::get('/editpassword', [AuthController::class, 'editpassword'] );
     Route::post('/editpassword/{nuptk}/updatepass', [AuthController::class, 'updatepass']);
     Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.reset');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset.form');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

     

});

//admin
Route::middleware(['guest:user'])->group(function () {
    Route::get('/admin', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/prosesloginadmin', [AuthController::class,'prosesloginadmin'] );

    //registeradmin
    Route::get('/admin/auth/registeradmin', [AuthController::class,'registeradmin'] );
    Route::post('/admin/auth/registeradmin', [AuthController::class,'prosesregisteradmin'] );
    
});

Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'homeUser'] );
    Route::get('/logout', [AuthController::class,'logout'] );

    //absensi
    Route::get('/absensi/masuk', [AbsensiController::class, 'masuk'] );
    Route::post('/absensi/masuk', [AbsensiController::class, 'store']);
    Route::post('/absensi/store', [AbsensiController::class, 'store']);

    //profile
    Route::get('/profile', [AbsensiController::class, 'profile'] );
    

    //editprofile
    Route::get('/editprofile', [AbsensiController::class, 'editprofile'] );
    Route::post('/absensi/{nuptk}/updateprofile', [AbsensiController::class, 'updateprofile']);
   

    //histori
    Route::get('/absensi/histori', [AbsensiController::class, 'histori'] );
    Route::post('/gethistori', [AbsensiController::class, 'gethistori'] );

    //izin
    Route::get('/absensi/izin', [AbsensiController::class, 'izin'] );
    Route::get('/absensi/formizin', [AbsensiController::class, 'formizin'] );
    Route::post('/absensi/formizin', [AbsensiController::class, 'storeizin']);
    Route::post('/absensi/storeizin', [AbsensiController::class, 'storeizin'] );
    Route::get('/absensi/dataizin', [AbsensiController::class, 'dataizin'] );
    Route::get('/absensi/historyizin', [AbsensiController::class, 'historyizin'] );
    Route::post('/gethistoryizin', [AbsensiController::class, 'gethistoryizin'] );

    //dinas luar
    Route::get('/absensi/formdinas', [AbsensiController::class, 'formdinas'] );
    Route::post('/absensi/formdinas', [AbsensiController::class, 'storedinas']);
    Route::post('/absensi/storedinas', [AbsensiController::class, 'storedinas'] );
    //lokasi
    Route::get('/absensi/lokasi', [AbsensiController::class, 'lokasi'] );
    
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/admin/dashboardadmin', [DashboardController::class, 'homeAdmin'] );
    Route::get('/logoutadmin', [AuthController::class,'logoutadmin'] );

    //Guru
    Route::get('/guru', [GuruController::class,'index'] ); 
    Route::post('/guru/edit', [GuruController::class,'edit'] );
    Route::post('/guru/{nuptk}/update', [GuruController::class,'update'] );
    Route::post('/guru/{nuptk}/delete', [GuruController::class,'delete'] );    

    
    //monitoring absensi
    Route::get('/absensi/monitoring', [AbsensiController::class,'monitoring'] );
    Route::post('/getmonitoring', [AbsensiController::class, 'getmonitoring'] );
    
    //laporan absensi
    Route::get('/absensi/absensiguru', [AbsensiController::class,'absensiguru'] );
    Route::post('/getabsensi', [AbsensiController::class,'getabsensi'] );
    Route::get('/absensi/rekapguru', [AbsensiController::class,'rekapguru'] );
    Route::post('/getrekap', [AbsensiController::class,'getrekap'] );

    //data pengajuan izin sakit
    Route::get('/absensi/datapengajuan', [AbsensiController::class,'datapengajuan'] );
    Route::post('/absensi/approveizinsakit', [AbsensiController::class,'approveizinsakit'] );
    Route::get('/absensi/{id}/batalizinsakit', [AbsensiController::class,'batalizinsakit'] );
    //data pengajuan dinas
    Route::get('/absensi/pengajuandinas', [AbsensiController::class,'pengajuandinas'] );
    Route::post('/absensi/approveizindinas', [AbsensiController::class,'approveizindinas'] );
    Route::get('/absensi/{id}/batalizindinas', [AbsensiController::class, 'batalizindinas']);
});
