<?php

declare(strict_types=1);

namespace App\Observers\Other;

use App\Models\Other\SupportTicket;
use App\Traits\LogsModelActions;

class SupportTicketObserver
{
    use LogsModelActions;
    /**
     * Handle the SupportTicket "created" event.
     */
    public function created(SupportTicket $supportTicket): void
    {
        $this->logCreate($supportTicket);
    }

    /**
     * Handle the SupportTicket "updated" event.
     */
    public function updated(SupportTicket $supportTicket): void
    {
        $this->logUpdate($supportTicket);
    }

    /**
     * Handle the SupportTicket "deleted" event.
     */
    public function deleted(SupportTicket $supportTicket): void
    {
        $this->logDelete($supportTicket);
    }

    /**
     * Handle the SupportTicket "restored" event.
     */
    public function restored(SupportTicket $supportTicket): void
    {
        $this->logRestore($supportTicket);
    }
}
