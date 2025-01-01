<?php

use App\Http\Controllers\SpeedrunController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/games', [PageController::class, 'games'])->name('games');
Route::get('/not-implemented', [PageController::class, 'notImplemented'])->name('notImplemented');
Route::get('/settings', [PageController::class, 'settings'])->name('settings');

Route::resource('speedruns', SpeedrunController::class);

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/speedruns/unverified', [AdminController::class, 'unverifiedSpeedruns'])->name('admin.speedruns.unverified');
    Route::post('/admin/speedruns/{speedrun}/verify', [AdminController::class, 'verifySpeedrun'])->name('admin.speedruns.verify');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
