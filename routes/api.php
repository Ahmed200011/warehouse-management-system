<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WarehouseController;
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

    // Route::apiResource('transaction', TransactionController::class);
    Route::controller(TransactionController::class)->group(function () {
        Route::get('transactions', 'index');
        Route::post('transactions', 'store');
        // Route::get('transactions-by-customer/{customer}', 'getTransactionsByCustomer');
        // Route::get('transactions-by-supplier/{supplier}', 'getTransactionsBySupplier');
    });
});
