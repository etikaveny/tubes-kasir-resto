<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController; // Will create next
use App\Http\Controllers\ProductController;   // Will create next
use App\Http\Controllers\PosController;       // Will create next

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [\App\Http\Controllers\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [\App\Http\Controllers\RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Manager Routes
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
});

// Cashier Routes
Route::middleware(['auth', 'role:cashier'])->prefix('cashier')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\PosController::class, 'index'])->name('cashier.dashboard');
    // API for POS logic
    Route::post('/order', [App\Http\Controllers\PosController::class, 'storeOrder'])->name('cashier.order.store');
    Route::get('/history', [App\Http\Controllers\PosController::class, 'history'])->name('cashier.history');
    Route::get('/profile', [App\Http\Controllers\PosController::class, 'profile'])->name('cashier.profile');
});

// Common Profile Action
Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->middleware('auth')->name('profile.destroy');
