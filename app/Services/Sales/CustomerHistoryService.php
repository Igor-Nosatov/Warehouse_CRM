<?php

declare(strict_types=1);

namespace App\Services\Sales;

use App\DataTransferObjects\Sales\CustomerHistoryDto;
use App\Models\Sales\CustomerHistory;
use Illuminate\Database\Eloquent\Collection;

class CustomerHistoryService
{
    public function index(): Collection
    {
        return CustomerHistory::all();
    }

    public function show($customerHistory): ?CustomerHistory
    {
        return CustomerHistory::find($customerHistory);
    }

    public function store(CustomerHistoryDto $dto): CustomerHistory
    {
        return CustomerHistory::create($dto->toArray());
    }

    public function update(CustomerHistoryDto $dto, CustomerHistory $customerHistory): CustomerHistory
    {
        $customerHistory->update($dto->toArray());
        return $customerHistory;
    }

    public function destroy(CustomerHistory $customerHistory): void
    {
        $customerHistory->delete();
    }
}
