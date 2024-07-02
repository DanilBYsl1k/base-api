<?php

use App\Http\Controllers\api\V1\VehicleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('auth')->name('auth.')->group(function () {

    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::put('reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');
});

Route::get('vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
Route::get('vehicle/{id}', [VehicleController::class, 'show'])->name('vehicle.show');

Route::group(["middleware" => ['auth:api']], function () {
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('refresh-token', [AuthController::class, 'refresh'])->name('refresh');

    Route::group(["prefix" => "vehicles"], function () {

        Route::post('create', [VehicleController::class, 'create'])->name('create');
    })->name('vehicles.');
});

