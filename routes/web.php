<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CarController, TagController, AdminController, HomeController};

Route::get('/', [HomeController::class, 'index']);

Route::resource('cars', CarController::class)->middleware('auth')
    ->except(['index', 'show']);
Route::resource('cars', CarController::class)->only(['index', 'show']);

Route::middleware('isAdmin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::resource('tags', TagController::class);
});
