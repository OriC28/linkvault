<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ToggleBookmarkFavoriteController;
use App\Http\Controllers\MovingBookmarkController;
use App\Http\Controllers\LinkTrackerController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TrashController;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    // Authentication routes
    Route::get('/login', fn() => view('auth.login'))->name('login');

    Route::middleware('throttle:10,1')->controller(GoogleController::class)
        ->prefix('auth')->name('auth.')->group(function () {
            Route::get('/redirect', 'redirect')->name('redirect');
            Route::get('/google/callback', 'callback')->name('callback');
        });
});

Route::middleware('auth')->group(function () {
    // General routes
    Route::get('/search', SearchController::class)->name('search');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Dashboard routes
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Bookmark routes
    Route::resource('bookmarks', BookmarkController::class)->except(['show', 'edit']);
    Route::prefix('bookmarks')->name('bookmarks.')->group(function () {
        Route::patch('/{bookmark}/favorite', ToggleBookmarkFavoriteController::class)->name('favorite');
        Route::patch('/{bookmark}/collection', MovingBookmarkController::class)->name('collection');
        Route::get('/{bookmark}/go', LinkTrackerController::class)->name('go');
    });

    // Collection routes
    Route::resource('collections', CollectionController::class)->parameters([
        'collection' => 'collection:slug'
    ])->except(['edit', 'create']);

    // Trash routes
    Route::controller(TrashController::class)->prefix('trash')->name('trash.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::delete('/', 'empty')->name('empty');
        Route::patch('/{type}/{combined_item}', 'restore')->name('restore');
        Route::delete('/{type}/{combined_item}', 'destroy')->name('destroy');
    });
});
