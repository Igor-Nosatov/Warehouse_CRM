<?php

declare (strict_types = 1);

namespace App\Builders\Inventory;

use Illuminate\Database\Eloquent\Builder;

class ProductBuilder extends Builder
{
    public function __construct($query)
    {
        parent::__construct($query);
    }

    public function filterByCategory($categoryId)
    {
        return $this->when($categoryId != null, function ($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        });
    }

    public function filterByBrand($brandId)
    {
        return $this->when($brandId != null, function ($q) use ($brandId) {
            $q->where('brand_id', $brandId);
        });
    }

    public function filterByProductType($productTypeId)
    {
        return $this->when($productTypeId != null, function ($q) use ($productTypeId) {
            $q->where('product_type_id', $productTypeId);
        });
    }

    public function filterByProductStatus($productStatusId)
    {
        return $this->when($productStatusId != null, function ($q) use ($productStatusId) {
            $q->where('product_status_id', $productStatusId);
        });
    }

    public function orderByFilter($orderByColumName, $orderByParam)
    {
        return $this->when($orderByColumName !== null && $orderByParam !== null, function ($q) use ($orderByColumName, $orderByParam) {
            $q->orderBy($orderByColumName, $orderByParam);
        });
    }

    public function search(?string $search)
    {
        return $this->when($search != null, function ($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('sku', 'like', '%' . $search . '%')
                ->orWhere('barcode', 'like', '%' . $search . '%');
        });
    }

    public function byPriceRange($minPrice, $maxPrice)
    {
        return $this->when($minPrice !== null && $maxPrice !== null, function ($q) use ($minPrice, $maxPrice) {
            $q->whereBetween('cost', [$minPrice, $maxPrice]);
        });
    }
}
