<?php

declare(strict_types=1);

namespace Tests\Feature\Sales\Customer;

trait CustomerJsonStructure
{
    public function getFiltersJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'customer_type' => [
                    '*' => [
                        'name',
                        'count',
                    ],
                ],
                'customer_status' => [
                    '*' => [
                        'name',
                        'count',
                    ],
                ],
            ],
        ];
    }

    public function getCreateCustomerJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'first_name',
                'last_name',
                'customer_photo_url',
                'customer_type',
                'customer_status',
                'email',
                'phone',
                'remark',
                'total_purchases',
                'receivables',
                'updated_at',
                'created_at',
                'id',
            ],
        ];
    }
}
