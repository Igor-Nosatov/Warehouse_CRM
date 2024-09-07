<?php

declare(strict_types=1);

namespace App\Services\Inventory;

use App\DataTransferObjects\Inventory\ProductNoteDto;
use App\Models\Inventory\ProductNote;

class ProductNoteService
{
    public function show($productId)
    {
        return ProductNote::with('user')
            ->select(['id', 'notes', 'user_id', 'product_id', 'created_at'])
            ->where('product_id', $productId)
            ->get();
    }

    public function store(ProductNoteDto $dto): ProductNote
    {
        return ProductNote::create($dto->toArray());
    }
}
