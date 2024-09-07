<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\PermissionController;
use App\Http\Controllers\Api\V1\Auth\RoleController;
use App\Http\Controllers\Api\V1\Inventory\AdjustStockController;
use App\Http\Controllers\Api\V1\Inventory\DashboardController;
use App\Http\Controllers\Api\V1\Inventory\ProductController;
use App\Http\Controllers\Api\V1\Inventory\ProductHistoryController;
use App\Http\Controllers\Api\V1\Inventory\ProductNoteController;
use App\Http\Controllers\Api\V1\Inventory\ReorderController;
use App\Http\Controllers\Api\V1\Order\PurchaseController;
use App\Http\Controllers\Api\V1\Order\VendorController;
use App\Http\Controllers\Api\V1\Other\DocumentController;
use App\Http\Controllers\Api\V1\Other\ReportController;
use App\Http\Controllers\Api\V1\Sales\CustomerController;
use App\Http\Controllers\Api\V1\Sales\CustomerHistoryController;
use App\Http\Controllers\Api\V1\Sales\CustomerNoteController;
use App\Http\Controllers\Api\V1\Sales\CustomerTransactionController;
use App\Http\Controllers\Api\V1\Sales\SalesOrderController;
use App\Http\Controllers\Api\V1\Sales\SalesReturnController;
use App\Http\Controllers\Api\V1\Other\SupportTicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::post('register', [AuthController::class, 'register']); // /** @see \App\Http\Controllers\Api\V1\Auth\AuthController::register() */
Route::post('login', [AuthController::class, 'login']); // /** @see \App\Http\Controllers\Api\V1\Auth\AuthController::login() */

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']); // /** @see \App\Http\Controllers\Api\V1\Auth\AuthController::logout() */
        /** @see \App\Http\Controllers\Api\V1\Auth\AuthController::index() */
        Route::get('users', [AuthController::class, 'index']);
        /** @see \App\Http\Controllers\Api\V1\Auth\AuthController::show() */
        Route::get('users/{id}', [AuthController::class, 'show']);

        // Admin routes
        Route::prefix('admin')->group(function () {
            /** @see \App\Http\Controllers\Api\V1\Auth\RoleController */
            Route::apiResource('roles', RoleController::class);

            /** @see \App\Http\Controllers\Api\V1\Auth\PermissionController */
            Route::apiResource('permissions', PermissionController::class);
        });

        // Dashboard routes
        Route::prefix('dashboard')->group(function () {
            /** @see \App\Http\Controllers\Api\V1\Inventory\DashboardController::index() */
            Route::apiResource('', DashboardController::class, ['only' => ['index']]);

            // Inventory management routes
            Route::prefix('inventory')->group(function () {
                /** @see \App\Http\Controllers\Api\V1\Inventory\ProductController::getProductFilters() */
                Route::get('filter', [ProductController::class, 'getProductFilters']);

                /** @see \App\Http\Controllers\Api\V1\Inventory\ProductController */
                Route::apiResource('products', ProductController::class);

                /** @see \App\Http\Controllers\Api\V1\Inventory\ProductHistoryController */
                Route::apiResource('history', ProductHistoryController::class);

                /** @see \App\Http\Controllers\Api\V1\Inventory\ProductNoteController */
                Route::apiResource('notes', ProductNoteController::class)->only(['show', 'store']);

                /** @see \App\Http\Controllers\Api\V1\Inventory\AdjustStockController */
                Route::apiResource('adjust-stock', AdjustStockController::class)->only(['show', 'store']);

                /** @see \App\Http\Controllers\Api\V1\Inventory\ReorderController */
                Route::apiResource('reorder', ReorderController::class);
            });

            // Sales management routes
            Route::prefix('sales')->group(function () {
                /** @see \App\Http\Controllers\Api\V1\Sales\CustomerController::getCustomerFilters() */
                Route::get('customer/filters', [CustomerController::class, 'getCustomerFilters']);

                /** @see \App\Http\Controllers\Api\V1\Sales\CustomerController */
                Route::apiResource('customer', CustomerController::class);

                /** @see \App\Http\Controllers\Api\V1\Sales\CustomerHistoryController */
                Route::apiResource('customer/history', CustomerHistoryController::class);

                /** @see \App\Http\Controllers\Api\V1\Sales\CustomerNoteController */
                Route::apiResource('customer/notes', CustomerNoteController::class);

                /** @see \App\Http\Controllers\Api\V1\Sales\CustomerTransactionController */
                Route::apiResource('customer/transaction', CustomerTransactionController::class);

                /** @see \App\Http\Controllers\Api\V1\Sales\SalesOrderController::destroy() */
                Route::delete('order/{salesOrder}', [SalesOrderController::class, 'destroy']);

                /** @see \App\Http\Controllers\Api\V1\Sales\SalesOrderController */
                Route::apiResource('order', SalesOrderController::class);

                /** @see \App\Http\Controllers\Api\V1\Sales\SalesOrderController::getSalesOrderFilters() */
                Route::get('order-filter', [SalesOrderController::class, 'getSalesOrderFilters']);

                /** @see \App\Http\Controllers\Api\V1\Sales\SalesReturnController::getSalesOrderReturnFilters() */
                Route::get('order-return-filter', [SalesReturnController::class, 'getSalesOrderReturnFilters']);

                /** @see \App\Http\Controllers\Api\V1\Sales\SalesReturnController */
                Route::apiResource('order-return', SalesReturnController::class);
            });

            // Order management routes
            Route::prefix('order')->group(function () {
                /** @see \App\Http\Controllers\Api\V1\Order\PurchaseController::getPurchaseFilters() */
                Route::get('purchase-filters', [PurchaseController::class, 'getPurchaseFilters']);

                /** @see \App\Http\Controllers\Api\V1\Order\PurchaseController */
                Route::apiResource('purchase', PurchaseController::class);

                /** @see \App\Http\Controllers\Api\V1\Order\VendorController::getVendorFilters() */
                Route::get('vendor-filters', [VendorController::class, 'getVendorFilters']);

                /** @see \App\Http\Controllers\Api\V1\Order\VendorController */
                Route::apiResource('vendor', VendorController::class);
            });

            // Other routes for reports, documents, and support tickets
            Route::prefix('other')->group(function () {
                /** @see \App\Http\Controllers\Api\V1\Other\ReportController */
                Route::apiResource('report', ReportController::class);

                /** @see \App\Http\Controllers\Api\V1\Other\DocumentController */
                Route::apiResource('document', DocumentController::class);

                /** @see \App\Http\Controllers\Other\SupportTicketController */
                Route::post('support-tickets', [SupportTicketController::class, 'store']);
            });
        });
    });
});
