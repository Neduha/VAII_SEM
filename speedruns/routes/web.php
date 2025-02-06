<?php

use App\Http\Controllers\SpeedrunController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GamesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', [PageController::class, 'home'])->name('home');

// Games Routes
Route::get('/games', [GamesController::class, 'index'])->name('games.index');
Route::get('/games/search', [GamesController::class, 'search'])->name('games.search');
Route::get('/games/{game}', [GamesController::class, 'show'])->name('games.show');
Route::get('/games/{game}/speedruns', [GamesController::class, 'filterSpeedruns'])->name('games.speedruns');


// Other PageController Routes
Route::get('/not-implemented', [PageController::class, 'notImplemented'])->name('notImplemented');
Route::get('/settings', [PageController::class, 'settings'])->name('settings');
Route::get('/speedruns/recent', [SpeedrunController::class, 'recent'])->name('speedruns.recent');

// Speedruns Resource Routes
Route::resource('speedruns', SpeedrunController::class);

// Admin Routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/speedruns/unverified', [AdminController::class, 'unverifiedSpeedruns'])->name('admin.speedruns.unverified');
    Route::post('/admin/speedruns/{speedrun}/verify', [AdminController::class, 'verifySpeedrun'])->name('admin.speedruns.verify');
    // Admin User Management
    Route::get('/admin/users/search', [AdminController::class, 'searchUsers'])->name('admin.users.search');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::post('/admin/users/{user}/make-admin', [AdminController::class, 'makeAdmin'])->name('admin.users.makeAdmin');
    Route::get('/admin/users', [AdminController::class, 'indexUsers'])->name('admin.users.index');
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
    Route::get('/profile/speedruns/filter', [ProfileController::class, 'filterSpeedruns'])->name('profile.speedruns.filter');
});


Route::fallback(function () {
    return response()->json([
        'error' => 'Route not found',
        'uri' => request()->path()
    ], 404);
});
require __DIR__ . '/auth.php';


