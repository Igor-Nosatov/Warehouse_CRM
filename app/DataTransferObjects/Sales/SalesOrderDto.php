<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Sales;

use App\Http\Requests\Api\V1\Sales\SalesOrderRequest;
use Illuminate\Support\Carbon;

class SalesOrderDto
{
    public function __construct(
        public string $status,
        public int $total_amount,
        public int $total_quantity,
        public Carbon $date_time_of_placement,
        public ?Carbon $date_time_of_delivery,
        public string $delivery_location,
        public int $customer_id,
        public int $payment_status_id,
        public int $product_id,
    ) {}

    public static function fromSalesOrderRequest(SalesOrderRequest $request): SalesOrderDto
    {
        return new self(
            status: $request->validated('status'),
            total_amount: $request->validated('total_amount'),
            total_quantity: $request->validated('total_quantity'),
            date_time_of_placement: Carbon::parse($request->validated('date_time_of_placement')),
            date_time_of_delivery: $request->validated('date_time_of_delivery') ? Carbon::parse($request->validated('date_time_of_delivery')) : null,
            delivery_location: $request->validated('delivery_location'),
            customer_id: $request->validated('customer_id'),
            payment_status_id: $request->validated('payment_status_id'),
            product_id: $request->validated('product_id'),
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
