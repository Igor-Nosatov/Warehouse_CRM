<?php

declare(strict_types=1);

namespace App\Services\Sales;

use App\DataTransferObjects\Sales\SalesReturnDto;
use App\Models\Sales\SalesReturn;
use Illuminate\Database\Eloquent\Collection;

class SalesReturnService
{
    public function index(): Collection
    {
        return SalesReturn::all();
    }

    public function show($salesReturn): ?SalesReturn
    {
        return SalesReturn::find($salesReturn);
    }

    public function store(SalesReturnDto $dto): SalesReturn
    {
        return SalesReturn::create($dto->toArray());
    }

    public function update(SalesReturnDto $dto, SalesReturn $salesReturn): SalesReturn
    {
        $salesReturn->update($dto->toArray());
        return $salesReturn;
    }

    public function destroy(SalesReturn $salesReturn): void
    {
        $salesReturn->delete();
    }
}
