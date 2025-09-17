<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductWarehouseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WarehouseController;
use App\Models\ProductWarehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('dashboard')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('customer', CustomerController::class);
    Route::apiResource('suppliers', SupplierController::class);
    Route::apiResource('warehouse', WarehouseController::class);
    Route::apiResource('p-warehouse', ProductWarehouseController::class);
    Route::apiResource('invoice', InvoiceController::class);


    // Route::apiResource('transaction', TransactionController::class);
    Route::controller(TransactionController::class)->group(function () {
        Route::get('transactions', 'index');
        Route::post('transactions', 'store');
    });
});
