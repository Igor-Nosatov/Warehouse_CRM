<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Sales;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Traits\ValidationExceptionTrait;

class SalesOrderRequest extends FormRequest
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
            'status' => ['required', 'string', Rule::in(['Packed', 'Processing', 'Shipped', 'Delivered'])],
            'total_amount' => ['required', 'integer'],
            'total_quantity' => ['required', 'integer'],
            'date_time_of_placement' => ['required', 'date'],
            'date_time_of_delivery' => ['required', 'date'],
            'delivery_location' => ['required', 'string'],
            'product_id' => ['required', 'exists:products,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'payment_status_id' => ['required', 'integer']
        ];
    }
}
