<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetStatusController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
use App\Models\Budget;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('dashboard');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('users', UserController::class);
});
