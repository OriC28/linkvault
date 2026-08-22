<?php

use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrashController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    // Auth google routes
    Route::get('/auth/redirect', [GoogleController::class, 'redirect'])->name('auth.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.callback');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks');
    Route::get('/collections', [CollectionController::class, 'index'])->name('collections');
    Route::get('/trash', [TrashController::class, 'index'])->name('trash');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});


