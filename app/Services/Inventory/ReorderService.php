<?php

declare(strict_types=1);

namespace App\Services\Inventory;

use App\DataTransferObjects\Inventory\ReorderDto;
use App\Models\Inventory\Reorder;
use Illuminate\Database\Eloquent\Collection;

class ReorderService
{
    public function index(): Collection
    {
        return Reorder::all();
    }

    public function show($reorder): ?Reorder
    {
        return Reorder::find($reorder);
    }

    public function store(ReorderDto $dto): Reorder
    {
        return Reorder::create($dto->toArray());
    }

    public function update(ReorderDto $dto, Reorder $reorder): Reorder
    {
        $reorder->update($dto->toArray());
        return $reorder;
    }

    public function destroy(Reorder $reorder): void
    {
        $reorder->delete();
    }
}
