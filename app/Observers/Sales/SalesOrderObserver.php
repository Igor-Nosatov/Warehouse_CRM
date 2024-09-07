<?php

declare(strict_types=1);

namespace App\Observers\Sales;

use App\Models\Sales\SalesOrder;
use App\Notifications\SalesOrderNotification;
use App\Traits\LogsModelActions;
use App\Traits\NotifiesAdmin;

class SalesOrderObserver
{
    use LogsModelActions, NotifiesAdmin;
    /**
     * Handle the SalesOrder "created" event.
     */
    public function created(SalesOrder $salesOrder): void
    {
        $this->logCreate($salesOrder);
        $this->notifyAdmin(SalesOrderNotification::class, [
            'action' => 'created',
            'modelClass' => SalesOrder::class,
        ]);
    }

    /**
     * Handle the SalesOrder "updated" event.
     */
    public function updated(SalesOrder $salesOrder): void
    {
        $this->logUpdate($salesOrder);
        $this->notifyAdmin(SalesOrderNotification::class, [
            'action' => 'created',
            'modelClass' => SalesOrder::class,
        ]);
    }

    /**
     * Handle the SalesOrder "deleted" event.
     */
    public function deleted(SalesOrder $salesOrder): void
    {
        $this->logDelete($salesOrder);
        $this->notifyAdmin(SalesOrderNotification::class, [
            'action' => 'created',
            'modelClass' => SalesOrder::class,
        ]);
    }

    /**
     * Handle the SalesOrder "restored" event.
     */
    public function restored(SalesOrder $salesOrder): void
    {
        $this->logRestore($salesOrder);
        $this->notifyAdmin(SalesOrderNotification::class, [
            'action' => 'created',
            'modelClass' => SalesOrder::class,
        ]);
    }
}
