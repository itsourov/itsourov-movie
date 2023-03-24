<?php

use App\Http\Controllers\Admin\BkashTransactionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\MovieController;


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return redirect(route('admin.movies.index'));
    })->name('admin');

    Route::prefix('movies')->group(function () {
        Route::get('/', [MovieController::class, 'index'])->name('admin.movies.index');
        Route::get('/create', [MovieController::class, 'create'])->name('admin.movies.create');
        Route::get('/{movie}', [MovieController::class, 'edit'])->name('admin.movies.edit');
        Route::post('/{movie}', [MovieController::class, 'update'])->name('admin.movies.update');
    });
    Route::prefix('bkash-transactions')->group(function () {
        Route::get('/', [BkashTransactionController::class, 'index'])->name('admin.bt.index');
        Route::get('/{bkash_transaction}', [BkashTransactionController::class, 'show'])->name('admin.bt.show');
    });
});
