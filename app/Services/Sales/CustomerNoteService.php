<?php

declare(strict_types=1);

namespace App\Services\Sales;

use App\DataTransferObjects\Sales\CustomerNoteDto;
use App\Models\Sales\CustomerNote;
use Illuminate\Database\Eloquent\Collection;

class CustomerNoteService
{
    public function index(): Collection
    {
        return CustomerNote::all();
    }

    public function show($customerNote): ?CustomerNote
    {
        return CustomerNote::find($customerNote);
    }

    public function store(CustomerNoteDto $dto): CustomerNote
    {
        return CustomerNote::create($dto->toArray());
    }

    public function update(CustomerNoteDto $dto, CustomerNote $customerNote): CustomerNote
    {
        $customerNote->update($dto->toArray());
        return $customerNote;
    }

    public function destroy(CustomerNote $customerNote): void
    {
        $customerNote->delete();
    }
}
