<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Inventory\Product;

use App\Http\Requests\Api\V1\Inventory\Product\ProductUpdateRequest;

class ProductUpdateDto
{
    public function __construct(
        public readonly ?bool $is_returnable,
        public readonly ?bool $is_have_variant,
        public readonly string $title,
        public readonly ?int $retail_price,
        public readonly ?int $wholesale_price,
        public readonly int $cost,
        public readonly ?int $product_type_id,
        public readonly ?int $product_status_id,
        public readonly ?int $category_id,
        public readonly ?int $brand_id,
        public readonly ?int $product_attribute_id,
        public readonly ?int $width,
        public readonly ?int $height,
        public readonly ?int $weight,
        public readonly ?string $size,
        public readonly ?string $color,
        public readonly ?string $material,
    ) {}

    public static function fromProductUpdateRequest(ProductUpdateRequest $request): ProductUpdateDto
    {
        $fields = $request->keys();
        $data = [];
        foreach ($fields as $field) {
            $data[$field] = $request->validated($field);
        }
        return new self(
            ...array_values($data)
        );
    }
}
