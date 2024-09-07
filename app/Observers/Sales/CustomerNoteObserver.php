<?php

declare(strict_types=1);

namespace App\Observers\Sales;

use App\Models\Sales\CustomerNote;
use App\Traits\LogsModelActions;

class CustomerNoteObserver
{
    use LogsModelActions;
    /**
     * Handle the CustomerNote "created" event.
     */
    public function created(CustomerNote $customerNote): void
    {
        $this->logCreate($customerNote);
    }

    /**
     * Handle the CustomerNote "updated" event.
     */
    public function updated(CustomerNote $customerNote): void
    {
        $this->logUpdate($customerNote);
    }

    /**
     * Handle the CustomerNote "deleted" event.
     */
    public function deleted(CustomerNote $customerNote): void
    {
        $this->logDelete($customerNote);
    }

    /**
     * Handle the CustomerNote "restored" event.
     */
    public function restored(CustomerNote $customerNote): void
    {
        $this->logRestore($customerNote);
    }
}
