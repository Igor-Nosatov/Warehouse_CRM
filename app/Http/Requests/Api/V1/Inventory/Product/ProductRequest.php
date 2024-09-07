<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Inventory\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidationExceptionTrait;

class ProductRequest extends FormRequest
{
    use ValidationExceptionTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_returnable' => ['nullable', 'boolean'],
            'is_have_variant' => ['nullable', 'boolean'],
            'core_product_id' => ['nullable', 'numeric'],
            'title' => ['required', 'string', 'min:8', 'max:255'],
            'retail_price' => ['nullable', 'integer'],
            'wholesale_price' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'is_draft' => ['nullable', 'boolean'],
            'product_type_id' => ['nullable', 'exists:product_types,id'],
            'product_status_id' => ['nullable', 'exists:product_statuses,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'size' => ['required', 'string', 'min:1', 'max:10'],
            'width' => ['required', 'integer'],
            'height' => ['required', 'integer'],
            'weight' => ['required', 'integer'],
            'color' => ['required', 'string', 'min:1', 'max:150'],
            'material' => ['required', 'string', 'min:1', 'max:150'],
            'image' => ['required', 'file', 'mimes:jpeg,png,pdf', 'max:2048'],
        ];
    }
}
