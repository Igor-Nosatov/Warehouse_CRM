<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Sales;

use App\Enums\SalesReturnStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Traits\ValidationExceptionTrait;

class SalesReturnRequest extends FormRequest
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
            'reason' => ['required', 'string'],
            'return_date' => ['required', 'date'],
            'status' => ['required', Rule::in(SalesReturnStatus::all())],
            'sales_order_id' => ['required', 'integer', 'exists:sales_orders,id'],
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
        ];
    }
}
