<?php

use App\Enum\FieldEnum;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


Route::group(['middleware' => 'auth:sanctum', 'prefix' => 'wallet'], function () {
    Route::post(FieldEnum::create->value, [WalletController::class, 'create']);
    Route::post(FieldEnum::deposit->value, [WalletController::class, 'deposit']);
    Route::post(FieldEnum::withdraw->value, [WalletController::class, 'withdraw']);
    Route::get(FieldEnum::balance->value.'/{walletId}', [WalletController::class, 'balance']);
});
