<?php

declare(strict_types=1);

namespace App\Observers\Order;

use App\Models\Order\PurchaseTransaction;
use App\Notifications\PurchaseTransactionNotification;
use App\Traits\LogsModelActions;
use App\Traits\NotifiesAdmin;

class PurchaseTransactionObserver
{
    use LogsModelActions, NotifiesAdmin;
    /**
     * Handle the PurchaseTransaction "created" event.
     */
    public function created(PurchaseTransaction $purchaseTransaction): void
    {
        $this->logCreate($purchaseTransaction);
        $this->notifyAdmin(PurchaseTransactionNotification::class, [
            'action' => 'created',
            'modelClass' => PurchaseTransaction::class,
        ]);
    }

    /**
     * Handle the PurchaseTransaction "updated" event.
     */
    public function updated(PurchaseTransaction $purchaseTransaction): void
    {
        $this->logUpdate($purchaseTransaction);
        $this->notifyAdmin(PurchaseTransactionNotification::class, [
            'action' => 'created',
            'modelClass' => PurchaseTransaction::class,
        ]);
    }

    /**
     * Handle the PurchaseTransaction "deleted" event.
     */
    public function deleted(PurchaseTransaction $purchaseTransaction): void
    {
        $this->logDelete($purchaseTransaction);
        $this->notifyAdmin(PurchaseTransactionNotification::class, [
            'action' => 'created',
            'modelClass' => PurchaseTransaction::class,
        ]);
    }

    /**
     * Handle the PurchaseTransaction "restored" event.
     */
    public function restored(PurchaseTransaction $purchaseTransaction): void
    {
        $this->logRestore($purchaseTransaction);
        $this->notifyAdmin(PurchaseTransactionNotification::class, [
            'action' => 'created',
            'modelClass' => PurchaseTransaction::class,
        ]);
    }
}
