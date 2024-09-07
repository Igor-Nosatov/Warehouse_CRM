<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Sales;

use App\Http\Requests\Api\V1\Sales\CustomerNoteRequest;

class CustomerNoteDto
{
    public function __construct(
        public string $notes,
        public int $customer_id,
        public int $user_id
    ) {}

    public static function fromCustomerNoteRequest(CustomerNoteRequest $request): CustomerNoteDto
    {
        return new self(
            notes: $request->validated('notes'),
            customer_id: $request->validated('customer_id'),
            user_id: $request->validated('user_id')
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
