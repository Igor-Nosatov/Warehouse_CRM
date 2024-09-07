<?php

declare(strict_types=1);

namespace App\Observers\Order;

use App\Models\Order\Purchase;
use App\Notifications\PurchaseNotification;
use App\Traits\LogsModelActions;
use App\Traits\NotifiesAdmin;

class PurchaseObserver
{
    use LogsModelActions, NotifiesAdmin;
    /**
     * Handle the Purchase "created" event.
     */
    public function created(Purchase $purchase): void
    {
        $this->logCreate($purchase);
        $this->notifyAdmin(PurchaseNotification::class, [
            'action' => 'created',
            'modelClass' => Purchase::class,
        ]);
    }

    /**
     * Handle the Purchase "updated" event.
     */
    public function updated(Purchase $purchase): void
    {
        $this->logUpdate($purchase);
        $this->notifyAdmin(PurchaseNotification::class, [
            'action' => 'created',
            'modelClass' => Purchase::class,
        ]);
    }

    /**
     * Handle the Purchase "deleted" event.
     */
    public function deleted(Purchase $purchase): void
    {
        $this->logDelete($purchase);
        $this->notifyAdmin(PurchaseNotification::class, [
            'action' => 'created',
            'modelClass' => Purchase::class,
        ]);
    }

    /**
     * Handle the Purchase "restored" event.
     */
    public function restored(Purchase $purchase): void
    {
        $this->logRestore($purchase);
        $this->notifyAdmin(PurchaseNotification::class, [
            'action' => 'created',
            'modelClass' => Purchase::class,
        ]);
    }
}
