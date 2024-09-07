<?php

declare(strict_types=1);

namespace Tests\Feature\Order\Vendor;

trait VendorJsonStructure
{
    public function getVendorFiltersJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'vendor_status' => [
                    '*' => [
                        'name',
                        'count',
                    ],
                ],
                'vendor_type' => [
                    '*' => [
                        'name',
                        'count',
                    ],
                ],
            ],
        ];
    }

    public function getDeleteVendorJsonStructure(): array
    {
        return [
            'status',
            'message',
        ];
    }

    public function getCreateVendorJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'id',
                'company_name',
                'vendor_first_name',
                'vendor_last_name',
                'email',
                'phone',
                'location',
                'website',
                'remark',
                'vendor_type',
                'receivables',
                'used_credits',
                'created_at',
                'updated_at',
            ],
        ];
    }
}
