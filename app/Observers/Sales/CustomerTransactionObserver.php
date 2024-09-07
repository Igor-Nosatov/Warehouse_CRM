<?php

declare(strict_types=1);

namespace App\Observers\Sales;

use App\Models\Sales\CustomerTransaction;
use App\Traits\LogsModelActions;

class CustomerTransactionObserver
{
    use LogsModelActions;
    /**
     * Handle the CustomerTransaction "created" event.
     */
    public function created(CustomerTransaction $customerTransaction): void
    {
        $this->logCreate($customerTransaction);
    }

    /**
     * Handle the CustomerTransaction "updated" event.
     */
    public function updated(CustomerTransaction $customerTransaction): void
    {
        $this->logUpdate($customerTransaction);
    }

    /**
     * Handle the CustomerTransaction "deleted" event.
     */
    public function deleted(CustomerTransaction $customerTransaction): void
    {
        $this->logDelete($customerTransaction);
    }

    /**
     * Handle the CustomerTransaction "restored" event.
     */
    public function restored(CustomerTransaction $customerTransaction): void
    {
        $this->logRestore($customerTransaction);
    }
}
