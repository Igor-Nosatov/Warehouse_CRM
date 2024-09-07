<?php

namespace App\Http\Requests\Api\V1\Inventory;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidationExceptionTrait;

class AdjustStockRequest extends FormRequest
{
    use ValidationExceptionTrait;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_status' => ['required', 'string'],
            'adjust_stock_date' => ['required', 'date'],
            'reason_for_inventory' => ['required', 'string'],
            'quantity_available' => ['required', 'integer'],
            'new_quantity' => ['required', 'integer'],
            'description' => ['nullable', 'string'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'warehouse_id' => ['required', 'integer', 'exists:warehouses,id'],
            'vendor_id' => ['nullable', 'integer', 'exists:vendors,id'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
