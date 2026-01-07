<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\ProductController;

// Guest routes (for non-authenticated customers)
Route::middleware('customer.guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('customer.login');
    Route::post('/login', [AuthController::class, 'login'])->name('customer.login.submit');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('customer.register');
    Route::post('/register', [AuthController::class, 'register'])->name('customer.register.submit');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

// Authenticated customer routes
Route::middleware('customer.auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('customer.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('customer.logout');
});
