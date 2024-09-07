<?php

declare(strict_types=1);

namespace App\Services\Inventory;

use App\DataTransferObjects\Inventory\AdjustStockDto;
use App\Models\Inventory\AdjustStock;
use App\Models\Inventory\VendorStockProduct;
use App\Models\Inventory\Warehouse;
use App\Models\Order\Vendor;

class AdjustStockService
{
    public function show(int $productId): array
    {
        $stock = VendorStockProduct::select(['id', 'product_quantity', 'warehouse_id'])
            ->with(['warehouse:id,name,location'])
            ->where('product_id', $productId)
            ->get();

        $latestAdjustment = AdjustStock::select([
            'id',
            'payment_status',
            'reason_for_inventory',
            'adjust_stock_date',
            'quantity_available',
            'new_quantity',
            'vendor_id'
        ])
            ->with(['vendor:id,company_name'])
            ->where('product_id', $productId)
            ->latest('adjust_stock_date')
            ->limit(2)
            ->get();

        $warehouseData = Warehouse::select(['id', 'name'])->get();
        $vendors = Vendor::select(['id', 'company_name'])->get();

        return [
            'stock' => $stock,
            'latest_adjustment' => $latestAdjustment,
            'warehouse_data' => $warehouseData,
            'vendors' => $vendors
        ];
    }

    public function store(AdjustStockDto $dto): AdjustStock
    {
        return AdjustStock::create($dto->toArray());
    }
}
