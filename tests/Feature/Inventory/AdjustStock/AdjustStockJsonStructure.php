<?php

declare(strict_types=1);

namespace Tests\Feature\Inventory\AdjustStock;

trait AdjustStockJsonStructure
{
    protected function getRetrieveAdjustStockJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'stock' => [
                    '*' => [
                        'id',
                        'product_quantity',
                        'warehouse_id',
                        'warehouse' => [
                            'id',
                            'name',
                            'location',
                        ],
                    ],
                ],
                'latest_adjustment' => [
                    '*' => [
                        'id',
                        'payment_status',
                        'reason_for_inventory',
                        'adjust_stock_date',
                        'quantity_available',
                        'new_quantity',
                        'vendor_id',
                        'vendor' => [
                            'id',
                            'company_name',
                        ],
                    ],
                ],
                'warehouse_data' => [
                    '*' => [
                        'id',
                        'name',
                    ],
                ],
                'vendors' => [
                    '*' => [
                        'id',
                        'company_name',
                    ],
                ],
            ],
        ];
    }

    protected function getCreateAdjustStockJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'payment_status',
                'adjust_stock_date',
                'reason_for_inventory',
                'quantity_available',
                'new_quantity',
                'description',
                'product_id',
                'warehouse_id',
                'vendor_id',
                'user_id',
                'updated_at',
                'created_at',
                'id'
            ]
        ];
    }
}
