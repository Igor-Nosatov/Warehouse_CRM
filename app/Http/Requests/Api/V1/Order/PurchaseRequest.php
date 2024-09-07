<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Order;

use App\Enums\SalesOrderStatus;
use App\Models\Inventory\Product;
use App\Models\Order\Vendor;
use App\Models\Sales\Customer;
use App\Models\Sales\PaymentStatus;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidationExceptionTrait;

class PurchaseRequest extends FormRequest
{
    use ValidationExceptionTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'in:' . implode(',', SalesOrderStatus::all())],
            'total_amount' => ['required', 'integer', 'min:0'],
            'total_quantity' => ['required', 'integer', 'min:0'],
            'date_time_of_placement' => ['required', 'date'],
            'date_time_of_delivery' => ['nullable', 'date'],
            'delivery_location' => ['nullable', 'string'],
            'product_id' => ['required', 'exists:' . Product::class . ',id'],
            'customer_id' => ['required', 'exists:' . Customer::class . ',id'],
            'vendor_id' => ['required', 'exists:' . Vendor::class . ',id'],
            'payment_status_id' => ['required', 'exists:' . PaymentStatus::class . ',id'],
        ];
    }
}
