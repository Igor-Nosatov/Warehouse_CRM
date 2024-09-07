<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Inventory;

use App\Http\Requests\Api\V1\Inventory\AdjustStockRequest;

class AdjustStockDto
{
    public function __construct(
        public string $payment_status,
        public string $adjust_stock_date,
        public string $reason_for_inventory,
        public int $quantity_available,
        public int $new_quantity,
        public ?string $description,
        public int $product_id,
        public int $warehouse_id,
        public ?int $vendor_id,
        public ?int $user_id
    ) {
        if (empty($payment_status) || empty($adjust_stock_date) || empty($reason_for_inventory)) {
            throw new \InvalidArgumentException('Required fields cannot be null');
        }
    }

    public static function fromAdjustStockRequest(AdjustStockRequest $request): AdjustStockDto
    {
        return new self(
            payment_status: $request->validated('payment_status'),
            adjust_stock_date: $request->validated('adjust_stock_date'),
            reason_for_inventory: $request->validated('reason_for_inventory'),
            quantity_available: $request->validated('quantity_available'),
            new_quantity: $request->validated('new_quantity'),
            description: $request->validated('description'),
            product_id: $request->validated('product_id'),
            warehouse_id: $request->validated('warehouse_id'),
            vendor_id: $request->validated('vendor_id'),
            user_id: $request->validated('user_id')
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
