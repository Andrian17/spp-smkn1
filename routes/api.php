<?php

use App\Http\Controllers\MidtransNotifController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::post('/pembayaran', [PaymentController::class, 'store'])->middleware('auth');

Route::post('/pembayaran/notification',  [MidtransNotifController::class, 'notification']);
Route::put('/pembayaran/snap',  [MidtransNotifController::class, 'updateSnap'])->name('updateSnap.update');
// Route::get('/pembayaran/notification', [MidtransNotifController::class, 'coba']);
