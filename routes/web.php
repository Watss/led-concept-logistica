<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BudgetStatusController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\ProductsConfigTable;
use App\Models\Budget;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('reports.all-by-dates');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('download-template-products', [ReportController::class, 'downloadExcel'])
        ->name('download-template-products');
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('users', UserController::class);
    Route::get('/products-config', ProductsConfigTable::class)->name('products-config.index');
    Route::get('reporte/generar', [ReportController::class, 'index'])->name('reports.all-by-dates');
    Route::get('get-reports', [ReportController::class, 'getReports'])->name('reports.get');
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.get');
    Route::get('document-types', [CompanyController::class, 'documentsIndex'])->name('documents.get');
    Route::get('reporte/generar-excel', [ReportController::class, 'all_by_dates'])->name('reports.excel.all-by-dates');
});
