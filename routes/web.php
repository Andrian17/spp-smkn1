<?php

use App\Http\Controllers\AdminController;
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
    Route::resource('/admin', AdminController::class);
    Route::get('/getAllSiswa',  [AdminController::class, 'getAllSiswa'])->name('admin.allsiswa');
    Route::get('/tampilSiswa/{siswa}',  [AdminController::class, 'tampilSiswa'])->name('admin.tampilSiswa');
});


require __DIR__ . '/auth.php';
