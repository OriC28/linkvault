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

    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::get('/bookmarks/create', [BookmarkController::class, 'create'])->name('bookmarks.create');
    Route::post('/bookmark/store', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/bookmark/destroy/{id}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');

    Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
    Route::get('/collections/show/{collection:slug}', [CollectionController::class, 'show'])->name('collections.show');
    Route::put('/collections/show/{collection:slug}', [CollectionController::class, 'update'])->name('collections.update');
    Route::post('/collections/store', [CollectionController::class, 'store'])->name('collections.store');
    Route::delete('/collections/destroy/{collection:slug}', [CollectionController::class, 'destroy'])->name('collections.destroy');

    Route::get('/trash', [TrashController::class, 'index'])->name('trash');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});


