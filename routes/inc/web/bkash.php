<?php

use App\Http\Controllers\BkashController;
use Illuminate\Support\Facades\Route;




Route::prefix('bkash')->middleware(['auth'])->group(function () {
    Route::post('token', [BkashController::class, 'token'])->name('bkash.token');
    Route::post('token/refresh', [BkashController::class, 'refresh_token'])->name('bkash.token.refresh');

    Route::get('payment/create', [BkashController::class, 'create_payment'])->name('bkash.payment.create');
    Route::get('payment/execute', [BkashController::class, 'execute_payment'])->name('bkash.payment.execute');
});
