<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetStatusController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard',[DashboardController::class,'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('budget', BudgetController::class)->except('show');

Route::resource('clients', ClientController::class)->except('show');

Route::resource('products', ProductController::class)->except('show');

Route::resource('brands', BrandController::class)->except('update', 'show');

Route::resource('users',UserController::class);

Route::resource('budget-status',BudgetStatusController::class);
Route::DELETE('budget-status/restore/{id}',[BudgetStatusController::class,'restore'])->name('budget-status.restore');


Route::get('reports',[ReportsController::class,'index'])->name('reports.index');

Route::get('reports/budget',[ReportsController::class,'budgetReport'])->name('reports.budget');

Route::get('reports/client',[ReportsController::class,'clientReport'])->name('reports.client');
