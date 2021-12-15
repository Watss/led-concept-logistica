<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('products/search', [ProductController::class,'searchProduct'])->name('products.search');
Route::get('clients/search', [ClientController::class,'searchClient'])->name('clients.search');
Route::get('budget_get/{id}', [BudgetController::class,'getBBudget'])->name('budget.get');
// Route::delete('budget/{id}', [BudgetController::class,'deleteProduct'])->name('budget.delete');

Route::delete('budget/products/{id}', [BudgetController::class,'deleteProduct'])->name('budget.product.delete');

