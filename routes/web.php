<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SiswaController;
use App\Models\UtsPayment;
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
    return view('beranda');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('siswa')->group(function () {
    Route::resource('/siswa',  SiswaController::class)->middleware('siswa');
    Route::resource('/pembayaran',  PaymentController::class)->middleware('siswa');
});


Route::middleware('admin')->group(function () {
    Route::resource('/admin', AdminController::class)->middleware('admin');

    Route::get('/dashboard/siswa',  [AdminController::class, 'semuaSiswa'])->name('admin.semuaSiswa');
    Route::get('/dashboard/tambah-siswa',  [AdminController::class, 'tambahSiswa'])->name('admin.tambahSiswa');
    Route::post('/dashboard/tambah-siswa',  [AdminController::class, 'simpanSiswa'])->name('admin.simpanSiswa');
    Route::put('/dashboard/siswa/{siswa}',  [AdminController::class, 'updateSiswa'])->name('admin.updateSiswa');
    Route::get('/dashboard/siswa/{siswa}',  [AdminController::class, 'tampilSiswa'])->name('admin.tampilSiswa');
    Route::get('/dashboard/siswa/{siswa}/edit',  [AdminController::class, 'editSiswa'])->name('admin.editSiswa');

    Route::get('/dashboard/pembayaran',  [AdminController::class, 'semuaPembayaran'])->name('admin.semuaPembayaran');

    // PDF
    Route::get('/dashboard/exportExcell',  [AdminController::class, 'exportExcell'])->name('admin.exportExcell');
    Route::get('/dashboard/exportPDF',  [AdminController::class, 'exportPDF'])->name('admin.exportPDF');
    Route::resource('/dashboard/jurusan',  JurusanController::class);
});

require __DIR__ . '/auth.php';
