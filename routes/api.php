<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

//
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

Route::group(["middleware" => ['auth:api']], function () {
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('refreshToken', [AuthController::class, 'refreshToken'])->name('refreshToken');
    Route::put('resetPassword', [AuthController::class, 'resetPassword'])->name('resetPassword');
});

Route::fallback(function () {
    return response()->json(['message' => 'url not found'], 404);
});

