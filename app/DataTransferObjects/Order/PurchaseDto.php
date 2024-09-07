<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Order;

use App\Http\Requests\Api\V1\Order\PurchaseRequest;

class PurchaseDto
{
    public function __construct(
        public readonly string $status,
        public readonly int $total_amount,
        public readonly int $total_quantity,
        public readonly \DateTime $date_time_of_placement,
        public readonly ?\DateTime $date_time_of_delivery,
        public readonly ?string $delivery_location,
        public readonly int $product_id,
        public readonly int $customer_id, // Ensure this line is present
        public readonly int $vendor_id,
        public readonly int $payment_status_id
    ) {}

    public static function fromPurchaseRequest(PurchaseRequest $request): PurchaseDto
    {
        $validatedData = $request->validated();
        return new self(
            $validatedData['status'],
            $validatedData['total_amount'],
            $validatedData['total_quantity'],
            new \DateTime($validatedData['date_time_of_placement']),
            isset($validatedData['date_time_of_delivery']) ? new \DateTime($validatedData['date_time_of_delivery']) : null,
            $validatedData['delivery_location'] ?? null,
            $validatedData['product_id'],
            $validatedData['customer_id'], // Ensure this line is present
            $validatedData['vendor_id'],
            $validatedData['payment_status_id']
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
