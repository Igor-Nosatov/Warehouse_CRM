<?php

namespace App\Providers;

use App\Models\Inventory\AdjustStock;
use App\Models\Inventory\Product;
use App\Models\Order\Purchase;
use App\Models\Order\Vendor;
use App\Models\Other\SupportTicket;
use App\Models\Sales\Customer;
use App\Models\Sales\SalesOrder;
use App\Policies\API\V1\Inventory\AdjustStockPolicy;
use App\Policies\API\V1\Inventory\ProductPolicy;
use App\Policies\API\V1\Order\PurchasePolicy;
use App\Policies\API\V1\Order\VendorPolicy;
use App\Policies\API\V1\Other\SupportTicketPolicy;
use App\Policies\API\V1\Sales\CustomerPolicy;
use App\Policies\API\V1\Sales\SalesOrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        AdjustStock::class => AdjustStockPolicy::class,
        Product::class => ProductPolicy::class,
        Purchase::class => PurchasePolicy::class,
        Vendor::class => VendorPolicy::class,
        SupportTicket::class => SupportTicketPolicy::class,
        Customer::class => CustomerPolicy::class,
        SalesOrder::class => SalesOrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
