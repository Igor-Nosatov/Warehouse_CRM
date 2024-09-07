<?php

declare(strict_types=1);

namespace Tests\Feature\Inventory\Product;

trait ProductJsonStructure
{
    protected function getFilterJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'brands' => [
                    '*' => [
                        'id',
                        'name',
                        'products_count',
                    ],
                ],
                'categories' => [
                    '*' => [
                        'id',
                        'name',
                        'products_count',
                    ],
                ],
                'product_type' => [
                    '*' => [
                        'id',
                        'name',
                        'products_count',
                    ],
                ],
                'product_status' => [
                    '*' => [
                        'id',
                        'name',
                        'products_count',
                    ],
                ],
            ],
        ];
    }

    protected function getDeleteProductJsonStructure(): array
    {
        return [
            'status',
            'message',
        ];
    }
}
