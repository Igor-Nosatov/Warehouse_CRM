<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Inventory;

use App\Http\Requests\Api\V1\Inventory\ProductAttributeRequest;

class ProductAttributeDto
{
    public function __construct(
        public ?string $size,
        public ?string $width,
        public ?string $color,
        public ?string $material,
        public int $product_id,
        public int $user_id
    ) {}

    public static function fromProductAttributeRequest(ProductAttributeRequest $request): ProductAttributeDto
    {
        return new self(
            size: $request->validated('size'),
            width: $request->validated('width'),
            color: $request->validated('color'),
            material: $request->validated('material'),
            product_id: $request->validated('product_id'),
            user_id: $request->validated('user_id')
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
