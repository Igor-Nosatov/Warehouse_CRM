<?php

declare(strict_types=1);

namespace App\Observers\Inventory;

use App\Models\Inventory\StockProduct;
use App\Notifications\StockProductNotification;
use App\Traits\LogsModelActions;
use App\Traits\NotifiesAdmin;

class StockProductObserver
{
    use LogsModelActions, NotifiesAdmin;
    /**
     * Handle the StockProduct "created" event.
     */
    public function created(StockProduct $stockProduct): void
    {
        $this->logCreate($stockProduct);
        $this->notifyAdmin(StockProductNotification::class, [
            'action' => 'created',
            'modelClass' => StockProduct::class,
        ]);
    }

    /**
     * Handle the StockProduct "updated" event.
     */
    public function updated(StockProduct $stockProduct): void
    {
        $this->logUpdate($stockProduct);
        $this->notifyAdmin(StockProductNotification::class, [
            'action' => 'created',
            'modelClass' => StockProduct::class,
        ]);
    }

    /**
     * Handle the StockProduct "deleted" event.
     */
    public function deleted(StockProduct $stockProduct): void
    {
        $this->logDelete($stockProduct);
        $this->notifyAdmin(StockProductNotification::class, [
            'action' => 'created',
            'modelClass' => StockProduct::class,
        ]);
    }

    /**
     * Handle the StockProduct "restored" event.
     */
    public function restored(StockProduct $stockProduct): void
    {
        $this->logRestore($stockProduct);
        $this->notifyAdmin(StockProductNotification::class, [
            'action' => 'created',
            'modelClass' => StockProduct::class,
        ]);
    }
}
