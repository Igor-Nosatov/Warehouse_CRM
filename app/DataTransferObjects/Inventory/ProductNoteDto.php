<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Inventory;

use App\Http\Requests\Api\V1\Inventory\ProductNoteRequest;

class ProductNoteDto
{
    public function __construct(
        public string $notes,
        public int $product_id,
        public ?int $user_id
    ) {}

    public static function fromProductNoteRequest(ProductNoteRequest $request): ProductNoteDto
    {
        return new self(
            notes: $request->validated('notes'),
            product_id: $request->validated('product_id'),
            user_id: $request->validated('user_id')
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
