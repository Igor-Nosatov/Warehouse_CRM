<?php

declare(strict_types=1);

namespace Tests\Feature\Order\Purchase;

trait PurchaseJsonStructure
{
    public function getPurchaseFiltersJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'purchase_status' => [
                    '*' => [
                        'name',
                        'status_count',
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

    public function getDeletePurchaseJsonStructure(): array
    {
        return [
            'status',
            'message',
        ];
    }
}
