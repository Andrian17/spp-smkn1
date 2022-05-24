<?php

use App\Http\Controllers\StudentController;
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
    return view('student.studentContainer');
});

Route::get('/siswa/profile', function () {
    return view('student.studentDetail');
});

Route::resource('/siswa', StudentController::class);

Route::get('/login', function () {
    return view('login');
});
