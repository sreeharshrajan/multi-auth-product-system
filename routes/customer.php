<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\DashboardController;

Route::middleware(['auth:customer'])->group(function () {
    Route::get('/dashboard', DashboardController::class);
});
