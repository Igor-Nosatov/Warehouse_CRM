<?php

declare(strict_types=1);

namespace App\Observers\Sales;

use App\Models\Sales\SalesTransaction;
use App\Notifications\SalesTransactionNotification;
use App\Traits\LogsModelActions;
use App\Traits\NotifiesAdmin;

class SalesTransactionObserver
{
    use LogsModelActions, NotifiesAdmin;
    /**
     * Handle the SalesTransaction "created" event.
     */
    public function created(SalesTransaction $salesTransaction): void
    {
        $this->logCreate($salesTransaction);
        $this->notifyAdmin(SalesTransactionNotification::class, [
            'action' => 'created',
            'modelClass' => SalesTransaction::class,
        ]);
    }

    /**
     * Handle the SalesTransaction "updated" event.
     */
    public function updated(SalesTransaction $salesTransaction): void
    {
        $this->logUpdate($salesTransaction);
        $this->notifyAdmin(SalesTransactionNotification::class, [
            'action' => 'created',
            'modelClass' => SalesTransaction::class,
        ]);
    }

    /**
     * Handle the SalesTransaction "deleted" event.
     */
    public function deleted(SalesTransaction $salesTransaction): void
    {
        $this->logDelete($salesTransaction);
        $this->notifyAdmin(SalesTransactionNotification::class, [
            'action' => 'created',
            'modelClass' => SalesTransaction::class,
        ]);
    }

    /**
     * Handle the SalesTransaction "restored" event.
     */
    public function restored(SalesTransaction $salesTransaction): void
    {
        $this->logRestore($salesTransaction);
        $this->notifyAdmin(SalesTransactionNotification::class, [
            'action' => 'created',
            'modelClass' => SalesTransaction::class,
        ]);
    }
}
