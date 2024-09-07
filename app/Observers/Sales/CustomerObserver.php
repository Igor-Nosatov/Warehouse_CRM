<?php

declare(strict_types=1);

namespace App\Observers\Sales;

use App\Models\Sales\Customer;
use App\Notifications\CustomerNotification;
use App\Traits\LogsModelActions;
use App\Traits\NotifiesAdmin;

class CustomerObserver
{
    use LogsModelActions, NotifiesAdmin;
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        $this->logCreate($customer);
        $this->notifyAdmin(CustomerNotification::class, [
            'action' => 'created',
            'modelClass' => Customer::class,
        ]);
    }

    /**
     * Handle the Customer "updated" event.
     */
    public function updated(Customer $customer): void
    {
        $this->logUpdate($customer);
        $this->notifyAdmin(CustomerNotification::class, [
            'action' => 'created',
            'modelClass' => Customer::class,
        ]);
    }

    /**
     * Handle the Customer "deleted" event.
     */
    public function deleted(Customer $customer): void
    {
        $this->logDelete($customer);
        $this->notifyAdmin(CustomerNotification::class, [
            'action' => 'created',
            'modelClass' => Customer::class,
        ]);
    }

    /**
     * Handle the Customer "restored" event.
     */
    public function restored(Customer $customer): void
    {
        $this->logRestore($customer);
        $this->notifyAdmin(CustomerNotification::class, [
            'action' => 'created',
            'modelClass' => Customer::class,
        ]);
    }
}
