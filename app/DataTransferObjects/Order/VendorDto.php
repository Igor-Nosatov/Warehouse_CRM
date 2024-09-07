<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Order;

use App\Http\Requests\Api\V1\Order\VendorRequest;
use App\Enums\VendorType;

class VendorDto
{
    public function __construct(
        public string $company_name,
        public string $vendor_first_name,
        public string $vendor_last_name,
        public string $email,
        public string $phone,
        public string $location,
        public ?string $website,
        public ?string $remark,
        public bool $status,
        public VendorType $vendor_type,
        public ?int $receivables,
        public ?int $used_credits,
    ) {}

    public static function fromVendorRequest(VendorRequest $request): VendorDto
    {
        $validatedData = $request->validated();
        return new self(
            $validatedData['company_name'],
            $validatedData['vendor_first_name'],
            $validatedData['vendor_last_name'],
            $validatedData['email'],
            $validatedData['phone'],
            $validatedData['location'],
            $validatedData['website'] ?? null,
            $validatedData['remark'] ?? null,
            $validatedData['status'],
            VendorType::from($validatedData['vendor_type']),
            $validatedData['receivables'] ?? null,
            $validatedData['used_credits'] ?? null
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
