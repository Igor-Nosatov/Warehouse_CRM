<?php

declare(strict_types=1);

namespace App\Services\Inventory;

use App\DataTransferObjects\Inventory\ProductHistoryDto;
use App\Models\Inventory\ProductHistory;
use Illuminate\Database\Eloquent\Collection;

class ProductHistoryService
{
    public function index(): Collection
    {
        return ProductHistory::all();
    }

    public function show($productHistory): ?ProductHistory
    {
        return ProductHistory::find($productHistory);
    }

    public function store(ProductHistoryDto $dto): ProductHistory
    {
        return ProductHistory::create($dto->toArray());
    }

    public function update(ProductHistoryDto $dto, ProductHistory $productHistory): ProductHistory
    {
        $productHistory->update($dto->toArray());
        return $productHistory;
    }

    public function destroy(ProductHistory $productHistory): void
    {
        $productHistory->delete();
    }
}
