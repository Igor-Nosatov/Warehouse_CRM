<?php

declare(strict_types=1);

namespace App\Services\Inventory;

use App\DataTransferObjects\Inventory\ProductImageDto;
use App\DataTransferObjects\Inventory\Product\ProductDto;
use App\DataTransferObjects\Inventory\Product\ProductUpdateDto;
use App\Models\Inventory\Brand;
use App\Models\Inventory\Category;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductAttribute;
use App\Models\Inventory\ProductStatus;
use App\Models\Inventory\ProductType;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ProductService
{
    public function index($request): array
    {
        $searchTerm = $request->input('search');
        $categoryParam = $request->input('category');
        $brandParam = $request->input('brand');
        $productTypeParam = $request->input('product_type');
        $productStatusParam = $request->input('product_status');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $orderByColumnName = $request->input('order_by_name');
        $orderByParam = $request->input('order_by_param');

        $productsQuery = Product::with(['category', 'brand', 'productImages', 'productType', 'productStatus'])
            ->search($searchTerm)
            ->filterByCategory($categoryParam)
            ->filterByBrand($brandParam)
            ->filterByProductType($productTypeParam)
            ->filterByProductStatus($productStatusParam)
            ->orderByFilter($orderByColumnName, $orderByParam)
            ->byPriceRange($minPrice, $maxPrice);

        $perPage = $request->input('per_page', 9);
        $products = $productsQuery->paginate($perPage);

        return [
            'products' => $products->items(),
            'meta' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
            ],
        ];
    }

    public function getProductFilters(): array
    {
        $productFilters = [
            'brands' => $this->mapEntityData(Brand::withCount('products')->get()),
            'categories' => $this->mapEntityData(Category::withCount('products')->get()),
            'product_type' => $this->mapEntityData(ProductType::withCount('products')->get()),
            'product_status' => $this->mapEntityData(ProductStatus::withCount('products')->get()),
        ];

        return $productFilters;
    }

    private function mapEntityData(Collection $entities): Collection
    {
        return $entities->map(function ($entity) {
            return [
                'id' => $entity->id,
                'name' => $entity->name,
                'products_count' => $entity->products_count,
            ];
        });
    }

    public function show(Product $product): ?Product
    {
        return Product::with(
            [
                'category',
                'brand',
                'productImages',
                'productType',
                'productStatus',
                'vendorStockProducts',
                'attribute',
                'productHistories.user',
            ]
        )->find($product['id']);
    }

    public function store(ProductDto $dto): Product
    {
        $productAttribute = ProductAttribute::create([
            'size' => $dto->size,
            'width' => $dto->width,
            'height' => $dto->height,
            'weight' => $dto->weight,
            'color' => $dto->color,
            'material' => $dto->material,
        ]);

        $product = Product::create([
            'is_returnable' => $dto->is_returnable,
            'is_have_variant' => $dto->is_have_variant,
            'core_product_id' => $dto->core_product_id,
            'title' => $dto->title,
            'sku' => Product::generateUniqueSku(),
            'barcode' => Product::generateUniqueBarcode(),
            'retail_price' => $dto->retail_price,
            'wholesale_price' => $dto->wholesale_price,
            'cost' => $dto->cost,
            'is_draft' => $dto->is_draft,
            'product_type_id' => $dto->product_type_id,
            'product_status_id' => $dto->product_status_id,
            'category_id' => $dto->category_id,
            'brand_id' => $dto->brand_id,
            'user_id' => $dto->user_id,
            'product_attribute_id' => $productAttribute->id
        ]);

        $this->saveProductImage($product, $dto->image);
        return $product;
    }

    private function saveProductImage($product, $image): void
    {
        $path = 'images/' . Str::random();
        if (!Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory($path, 0755, true);
        }
        $name = Str::random() . '.' . $image->getClientOriginalExtension();
        $image->storeAs($path, $name, 'public');
        $relativePath = $path . '/' . $name;
        $productImageDto = new ProductImageDto(
            $name,
            $image->getClientOriginalName(),
            $image->getClientMimeType(),
            $relativePath,
            'public',
            URL::to(Storage::url($relativePath)),
            $image->getSize(),
            $product->id
        );
        $product->productImages()->create($productImageDto->toArray());
    }
    public function update(ProductUpdateDto $dto, Product $product): Product
    {
        $product->update((array) $dto);
        if ($dto->product_attribute_id !== null) {
            $productAttribute = ProductAttribute::find($dto->product_attribute_id);
            if ($productAttribute) {
                $productAttribute->update([
                    'width' => $dto->width,
                    'height' => $dto->height,
                    'weight' => $dto->weight,
                    'size' => $dto->size,
                    'color' => $dto->color,
                    'material' => $dto->material,
                ]);
            }
        }
        return $product;
    }

    public function destroy(Product $product): void
    {
        $product->delete();
    }
}
