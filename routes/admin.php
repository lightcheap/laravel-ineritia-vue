<?php
use App\Http\Controllers\Member\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth:admin'])->group(function() {
        Route::get('/dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';
});
