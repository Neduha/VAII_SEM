<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profile', [PageController::class, 'notImplemented'])->name('profile');
Route::get('/settings', [PageController::class, 'notImplemented'])->name('settings');
Route::get('/not-implemented', [PageController::class, 'notImplemented'])->name('notImplemented');
Route::get('/games', [PageController::class, 'games'])->name('games');
Route::get('/login', [PageController::class, 'login'])->name('login');
