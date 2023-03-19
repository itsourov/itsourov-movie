<?php




use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\MovieController;


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return redirect(route('admin.movies.index'));
    })->name('admin');

    Route::prefix('movies')->group(function () {
        Route::get('/', [MovieController::class, 'index'])->name('admin.movies.index');
        Route::get('/create', [MovieController::class, 'create'])->name('admin.movies.create');
    });
});
