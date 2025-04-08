<?php

use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the EveryBits: Money Manager API',
        'version' => '1.0.0',
    ]);
});

Route::apiResource('wallets', WalletController::class);
