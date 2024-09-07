<?php

namespace App\Providers;

use App\Models\Inventory\AdjustStock;
use App\Models\Inventory\Product;
use App\Models\Inventory\StockProduct;
use App\Models\Order\Purchase;
use App\Models\Order\PurchaseTransaction;
use App\Models\Order\Vendor;
use App\Models\Other\SupportTicket;
use App\Models\Sales\Customer;
use App\Models\Sales\CustomerNote;
use App\Models\Sales\CustomerTransaction;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesTransaction;
use App\Observers\Inventory\AdjustStockObserver;
use App\Observers\Inventory\ProductObserver;
use App\Observers\Inventory\StockProductObserver;
use App\Observers\Order\PurchaseObserver;
use App\Observers\Order\PurchaseTransactionObserver;
use App\Observers\Order\VendorObserver;
use App\Observers\Other\SupportTicketObserver;
use App\Observers\Sales\CustomerNoteObserver;
use App\Observers\Sales\CustomerObserver;
use App\Observers\Sales\CustomerTransactionObserver;
use App\Observers\Sales\SalesOrderObserver;
use App\Observers\Sales\SalesTransactionObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AdjustStock::observe(AdjustStockObserver::class);
        Product::observe(ProductObserver::class);
        StockProduct::observe(StockProductObserver::class);
        Purchase::observe(PurchaseObserver::class);
        PurchaseTransaction::observe(PurchaseTransactionObserver::class);
        Vendor::observe(VendorObserver::class);
        SupportTicket::observe(SupportTicketObserver::class);
        CustomerNote::observe(CustomerNoteObserver::class);
        Customer::observe(CustomerObserver::class);
        CustomerTransaction::observe(CustomerTransactionObserver::class);
        SalesOrder::observe(SalesOrderObserver::class);
        SalesOrder::observe(SalesOrderObserver::class);
        SalesTransaction::observe(SalesTransactionObserver::class);
    }
}
