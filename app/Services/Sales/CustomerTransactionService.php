<?php

declare(strict_types=1);

namespace App\Services\Sales;

use App\Models\Sales\CustomerTransaction;
use Illuminate\Database\Eloquent\Collection;

class CustomerTransactionService
{
    public function index(): Collection
    {
        return CustomerTransaction::all();
    }

    public function show($customerTransaction): ?CustomerTransaction
    {
        return CustomerTransaction::find($customerTransaction);
    }

    public function store(array $data): CustomerTransaction
    {
        return CustomerTransaction::create($data);
    }

    public function update(array $data, CustomerTransaction $customerTransaction): CustomerTransaction
    {
        $customerTransaction->update($data);
        return $customerTransaction;
    }

    public function destroy(CustomerTransaction $customerTransaction): void
    {
        $customerTransaction->delete();
    }
}
