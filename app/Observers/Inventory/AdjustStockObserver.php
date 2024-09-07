<?php

declare(strict_types=1);

namespace App\Observers\Inventory;

use App\Models\Inventory\AdjustStock;
use App\Notifications\AdjustStockNotification;
use App\Traits\LogsModelActions;
use App\Traits\NotifiesAdmin;

class AdjustStockObserver
{
    use LogsModelActions, NotifiesAdmin;
    /**
     * Handle the AdjustStock "created" event.
     */
    public function created(AdjustStock $adjustStock): void
    {
        $this->logCreate($adjustStock);
        $this->notifyAdmin(AdjustStockNotification::class, [
            'action' => 'created',
            'modelClass' => AdjustStock::class,
        ]);
    }

    /**
     * Handle the AdjustStock "updated" event.
     */
    public function updated(AdjustStock $adjustStock): void
    {
        $this->logUpdate($adjustStock);
        $this->notifyAdmin(AdjustStockNotification::class, [
            'action' => 'created',
            'modelClass' => AdjustStock::class,
        ]);
    }

    /**
     * Handle the AdjustStock "deleted" event.
     */
    public function deleted(AdjustStock $adjustStock): void
    {
        $this->logDelete($adjustStock);
        $this->notifyAdmin(AdjustStockNotification::class, [
            'action' => 'created',
            'modelClass' => AdjustStock::class,
        ]);
    }

    /**
     * Handle the AdjustStock "restored" event.
     */
    public function restored(AdjustStock $adjustStock): void
    {
        $this->logRestore($adjustStock);
        $this->notifyAdmin(AdjustStockNotification::class, [
            'action' => 'created',
            'modelClass' => AdjustStock::class,
        ]);
    }
}
