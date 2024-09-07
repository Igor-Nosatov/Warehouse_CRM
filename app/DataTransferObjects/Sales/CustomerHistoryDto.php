<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Sales;

use App\Http\Requests\Api\V1\Sales\CustomerHistoryRequest;

class CustomerHistoryDto
{
    public function __construct(
        public int $customer_id,
        public int $user_id
    ) {}

    public static function fromCustomerHistoryRequest(CustomerHistoryRequest $request): CustomerHistoryDto
    {
        return new self(
            customer_id: $request->validated('customer_id'),
            user_id: $request->validated('user_id')
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
