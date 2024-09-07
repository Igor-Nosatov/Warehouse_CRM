<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Sales;

use App\Http\Requests\Api\V1\Sales\SalesReturnRequest;

class SalesReturnDto
{
    public function __construct(
        public string $reason,
        public string $return_date,
        public string $status,
        public int $sales_order_id,
        public int $customer_id
    ) {}

    public static function fromSalesReturnRequest(SalesReturnRequest $request): SalesReturnDto
    {
        return new self(
            reason: $request->validated('reason'),
            return_date: $request->validated('return_date'),
            status: $request->validated('status'),
            sales_order_id: $request->validated('sales_order_id'),
            customer_id: $request->validated('customer_id')
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
