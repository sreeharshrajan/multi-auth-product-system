<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductImportController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the application and are prefixed with /admin.
| They use the 'admin' guard for authentication.
|
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes (for non-authenticated admins)
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    });

    // Authenticated admin routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Product management routes
        Route::get('/products/import', [ProductImportController::class, 'showImportForm'])->name('products.import');
        Route::post('/products/import', [ProductImportController::class, 'import'])->name('products.import.submit');
        Route::resource('products', ProductController::class);

        //Customer management routes
        Route::resource('customers', CustomerController::class);
    });
});
