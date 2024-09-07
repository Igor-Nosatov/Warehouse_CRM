<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Sales;

use App\Http\Requests\Api\V1\Sales\CustomerRequest;

class CustomerDto
{
    public function __construct(
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly ?string $customer_photo_url,
        public readonly string $customer_type,
        public readonly string $customer_status,
        public readonly ?string $email,
        public readonly ?string $phone,
        public readonly ?string $remark,
        public readonly ?int $total_purchases,
        public readonly ?int $receivables
    ) {}

    public static function fromCustomerRequest(CustomerRequest $request): CustomerDto
    {
        $validatedData = $request->validated();
        return new self(
            $validatedData['first_name'] ?? null,
            $validatedData['last_name'] ?? null,
            $validatedData['customer_photo_url'] ?? null,
            $validatedData['customer_type'] ?? null,
            $validatedData['customer_status'] ?? null,
            $validatedData['email'] ?? null,
            $validatedData['phone'] ?? null,
            $validatedData['remark'] ?? null,
            $validatedData['total_purchases'] ?? null,
            $validatedData['receivables'] ?? null,
        );
    }
}
