<?php

declare(strict_types=1);

namespace App\Observers\Inventory;

use App\Models\Inventory\Product;
use App\Notifications\ProductNotification;
use App\Traits\LogsModelActions;
use App\Traits\NotifiesAdmin;

class ProductObserver
{
    use LogsModelActions, NotifiesAdmin;
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        $this->logCreate($product);
        $this->notifyAdmin(ProductNotification::class, [
            'action' => 'created',
            'modelClass' => Product::class,
        ]);
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        $this->logUpdate($product);
        $this->notifyAdmin(ProductNotification::class, [
            'action' => 'created',
            'modelClass' => Product::class,
        ]);
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $this->logDelete($product);
        $this->notifyAdmin(ProductNotification::class, [
            'action' => 'created',
            'modelClass' => Product::class,
        ]);
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        $this->logRestore($product);
        $this->notifyAdmin(ProductNotification::class, [
            'action' => 'created',
            'modelClass' => Product::class,
        ]);
    }
}
