<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\Spa\LoginController;
use App\Http\Controllers\Api\Auth\Spa\LogoutController;
use App\Http\Controllers\Api\Auth\Spa\RegisterController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\VoucherController;
use App\Http\Controllers\Api\PaymentController;

Route::prefix('auth/spa')->group(function () {
    Route::post('login', LoginController::class)->middleware('guest');
});

Route::post('/auth/logout', [LogoutController::class, '__invoke'])->middleware('auth:sanctum');
Route::get('/auth/me', function (Request $request) {
    return response()->json(['user' => $request->user()]);
})->middleware('auth:sanctum');
Route::post('/auth/register', [RegisterController::class, 'register']);
Route::get('/games', [GameController::class, 'index']);
Route::get('/games/{id}', [GameController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
    Route::post('/voucher/apply', [VoucherController::class, 'applyVoucher']);
    Route::post('/payments/midtrans', [PaymentController::class, 'createPayment']);
    Route::post('/payments/handle-notification', [PaymentController::class, 'handleNotification']);
});


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
