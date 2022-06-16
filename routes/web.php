<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SiswaController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/siswa',  SiswaController::class)->middleware('siswa');
Route::resource('/pembayaran',  PaymentController::class)->middleware('siswa');

Route::middleware('admin')->group(function () {
    Route::resource('/admin', AdminController::class)->middleware('admin');
    Route::get('/dashboard/getAllSiswa',  [AdminController::class, 'getAllSiswa'])->name('admin.allSiswa');
    Route::get('/tampilSiswa/{siswa}',  [AdminController::class, 'tampilSiswa'])->name('admin.tampilSiswa');
    Route::get('/dashboard/allPembayaran',  [AdminController::class, 'allPembayaran'])->name('admin.allPembayaran');
    Route::get('/dashboard/allJurusan',  [AdminController::class, 'allJurusan'])->name('admin.jurusan');
    Route::get('/dashboard/tampilJurusan/{jurusan}',  [AdminController::class, 'tampilJurusan'])->name('admin.tampilJurusan');
    Route::put('/dashboard/editJurusan/{jurusan}',  [AdminController::class, 'editJurusan'])->name('admin.editJurusan');
    Route::resource('/jurusan',  JurusanController::class);
});

require __DIR__ . '/auth.php';
