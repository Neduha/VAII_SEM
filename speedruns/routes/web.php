<?php

use App\Http\Controllers\SpeedrunController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GamesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

// Games Routes
Route::get('/games', [GamesController::class, 'index'])->name('games');
Route::get('/games/{game}', [GamesController::class, 'show'])->name('games.show');

// Other PageController Routes
Route::get('/not-implemented', [PageController::class, 'notImplemented'])->name('notImplemented');
Route::get('/settings', [PageController::class, 'settings'])->name('settings');

// Speedruns Resource Routes
Route::resource('speedruns', SpeedrunController::class);

// Admin Routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/speedruns/unverified', [AdminController::class, 'unverifiedSpeedruns'])->name('admin.speedruns.unverified');
    Route::post('/admin/speedruns/{speedrun}/verify', [AdminController::class, 'verifySpeedrun'])->name('admin.speedruns.verify');

    // Admin Game Management
    Route::get('/admin/games/create', [GamesController::class, 'create'])->name('admin.games.create');
    Route::post('/admin/games', [GamesController::class, 'store'])->name('admin.games.store');
});

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
