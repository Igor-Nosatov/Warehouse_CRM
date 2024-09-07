<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Inventory\Product;

use App\Http\Requests\Api\V1\Inventory\Product\ProductRequest;

class ProductDto
{
    public function __construct(
        public readonly ?bool $is_returnable,
        public readonly ?bool $is_have_variant,
        public readonly ?int $core_product_id,
        public readonly ?string $title,
        public readonly ?int $retail_price,
        public readonly ?int $wholesale_price,
        public readonly int $cost,
        public readonly ?bool $is_draft,
        public readonly ?int $product_type_id,
        public readonly ?int $product_status_id,
        public readonly ?int $category_id,
        public readonly ?int $brand_id,
        public readonly ?int $user_id,
        public readonly ?string $size,
        public readonly ?int $width,
        public readonly ?int $height,
        public readonly ?int $weight,
        public readonly ?string $color,
        public readonly ?string $material,
        public mixed $image
    ) {}

    public static function fromProductRequest(ProductRequest $request): ProductDto
    {
        $validatedData = $request->validated();

        return new self(
            is_returnable: isset($validatedData['is_returnable']) ? filter_var($validatedData['is_returnable'], FILTER_VALIDATE_BOOLEAN) : null,
            is_have_variant: isset($validatedData['is_have_variant']) ? filter_var($validatedData['is_have_variant'], FILTER_VALIDATE_BOOLEAN) : null,
            core_product_id: isset($validatedData['core_product_id']) ? (int)$validatedData['core_product_id'] : null,
            title: $validatedData['title'] ?? null,
            retail_price: isset($validatedData['retail_price']) ? (int)$validatedData['retail_price'] : null,
            wholesale_price: isset($validatedData['wholesale_price']) ? (int)$validatedData['wholesale_price'] : null,
            cost: (int)$validatedData['cost'],
            is_draft: isset($validatedData['is_draft']) ? filter_var($validatedData['is_draft'], FILTER_VALIDATE_BOOLEAN) : null,
            product_type_id: isset($validatedData['product_type_id']) ? (int)$validatedData['product_type_id'] : null,
            product_status_id: isset($validatedData['product_status_id']) ? (int)$validatedData['product_status_id'] : null,
            category_id: isset($validatedData['category_id']) ? (int)$validatedData['category_id'] : null,
            brand_id : isset($validatedData['brand_id']) ? (int)$validatedData['brand_id'] : null,
            user_id: isset($validatedData['user_id']) ? (int)$validatedData['user_id'] : null,
            size: isset($validatedData['size']) ? $validatedData['size'] : null,
            width: isset($validatedData['width']) ? (int)$validatedData['width'] : null,
            height: isset($validatedData['height']) ? (int)$validatedData['height'] : null,
            weight: isset($validatedData['weight']) ? (int)$validatedData['weight'] : null,
            color: isset($validatedData['color']) ? $validatedData['color'] : null,
            material: isset($validatedData['material']) ? $validatedData['material'] : null,
            image:$request->validated('image'),
        );
    }
}
