<?php

declare(strict_types=1);

namespace Tests\Feature\Dashboard;

trait DashboardJsonStructure
{
    protected function getDashboardJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'stockLevel' => [
                    'LowLevelStock' => [
                        'percentage',
                        'totalQty',
                    ],
                    'AverageLevelStock' => [
                        'percentage',
                        'totalQty',
                    ],
                    'HighLevelStock' => [
                        'percentage',
                        'totalQty',
                    ],
                    'MaxLevelStock' => [
                        'percentage',
                        'totalQty',
                    ],
                ],
                'bestSellingProducts' => [
                    '*' => [
                        'id',
                        'is_returnable',
                        'is_have_variant',
                        'core_product_id',
                        'title',
                        'sku',
                        'barcode',
                        'retail_price',
                        'wholesale_price',
                        'cost',
                        'is_draft',
                        'product_type_id',
                        'product_status_id',
                        'category_id',
                        'brand_id',
                        'user_id',
                        'product_attribute_id',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'sales_orders_count',
                    ],
                ],
                'salesOrderCounts' => [
                    'totalProductPacked' => [
                        'qty',
                        'percentage',
                    ],
                    'totalProductToBeProcessing' => [
                        'qty',
                        'percentage',
                    ],
                    'totalProductShipped' => [
                        'qty',
                        'percentage',
                    ],
                    'totalSalesProductDelivered' => [
                        'qty',
                        'percentage',
                    ],
                ],
                'activeWorkOrder' => [
                    '*' => [
                        'id',
                        'status',
                        'total_amount',
                        'total_quantity',
                        'date_time_of_placement',
                        'date_time_of_delivery',
                        'delivery_location',
                        'product_id',
                        'customer_id',
                        'sales_transaction_id',
                        'created_at',
                        'updated_at',
                        'deleted_at',
                        'payment_status_id',
                        'product' => [
                            'id',
                            'is_returnable',
                            'is_have_variant',
                            'core_product_id',
                            'title',
                            'sku',
                            'barcode',
                            'retail_price',
                            'wholesale_price',
                            'cost',
                            'is_draft',
                            'product_type_id',
                            'product_status_id',
                            'category_id',
                            'brand_id',
                            'user_id',
                            'product_attribute_id',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ],
                    ],
                ],
                'salesOrderSummary' => [
                    '2024-Aug' => [
                        'salesOrder',
                        'salesReturn',
                    ],
                    '2024-Jul' => [
                        'salesOrder',
                        'salesReturn',
                    ],
                    '2024-Jun' => [
                        'salesOrder',
                        'salesReturn',
                    ],
                    '2024-May' => [
                        'salesOrder',
                        'salesReturn',
                    ],
                    '2024-Apr' => [
                        'salesOrder',
                        'salesReturn',
                    ],
                    '2024-Mar' => [
                        'salesOrder',
                        'salesReturn',
                    ],
                ],
            ],
        ];
    }
}
