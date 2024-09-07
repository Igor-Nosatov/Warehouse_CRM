<?php

declare(strict_types=1);

namespace Tests\Feature\Sales\SalesOrder;

trait SalesOrderJsonStructure
{
    public function getOrderFilterJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'sales_order_status' => [
                    '*' => [
                        'name',
                        'count',
                    ],
                ],
                'payment_status' => [
                    '*' => [
                        'id',
                        'name',
                        'purchase_count',
                    ],
                ],
            ],
        ];
    }

    public function getSalesOrderJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'sales_order_data' => [
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
                        'payment_status' => [
                            'id',
                            'name',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                        ],
                        'customer' => [
                            'id',
                            'first_name',
                            'last_name',
                            'customer_photo_url',
                            'customer_type',
                            'email',
                            'phone',
                            'remark',
                            'created_at',
                            'updated_at',
                            'deleted_at',
                            'customer_status',
                            'total_purchases',
                            'receivables',
                        ],
                    ],
                ],
            ],
        ];
    }

    public function getSalesOrderByIdJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
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
            ],
        ];
    }

    public function getCreateSalesOrderJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'status',
                'total_amount',
                'total_quantity',
                'date_time_of_placement',
                'date_time_of_delivery',
                'delivery_location',
                'customer_id',
                'payment_status_id',
                'product_id',
                'sales_transaction_id',
                'created_at',
                'updated_at',
                'id'
            ],
        ];
    }
}
