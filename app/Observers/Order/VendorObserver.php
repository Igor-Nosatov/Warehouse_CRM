<?php

declare(strict_types=1);

namespace App\Observers\Order;

use App\Models\Order\Vendor;
use App\Notifications\VendorNotification;
use App\Traits\LogsModelActions;
use App\Traits\NotifiesAdmin;

class VendorObserver
{
    use LogsModelActions, NotifiesAdmin;
    /**
     * Handle the Vendor "created" event.
     */
    public function created(Vendor $vendor): void
    {
        $this->logCreate($vendor);
        $this->notifyAdmin( VendorNotification::class, [
            'action' => 'created',
            'modelClass' =>  Vendor::class,
        ]);
    }

    /**
     * Handle the Vendor "updated" event.
     */
    public function updated(Vendor $vendor): void
    {
        $this->logUpdate($vendor);
        $this->notifyAdmin( VendorNotification::class, [
            'action' => 'created',
            'modelClass' =>  Vendor::class,
        ]);
    }

    /**
     * Handle the Vendor "deleted" event.
     */
    public function deleted(Vendor $vendor): void
    {
        $this->logDelete($vendor);
        $this->notifyAdmin( VendorNotification::class, [
            'action' => 'created',
            'modelClass' =>  Vendor::class,
        ]);
    }

    /**
     * Handle the Vendor "restored" event.
     */
    public function restored(Vendor $vendor): void
    {
        $this->logRestore($vendor);
        $this->notifyAdmin( VendorNotification::class, [
            'action' => 'created',
            'modelClass' =>  Vendor::class,
        ]);
    }
}
