<?php

declare (strict_types = 1);

namespace App\Http\Requests\Api\V1\Inventory\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidationExceptionTrait;

class ProductUpdateRequest extends FormRequest
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
            'is_returnable' => ['nullable', 'boolean'],
            'is_have_variant' => ['nullable', 'boolean'],
            'title' => ['required', 'string','min:1', 'max:255'],
            'retail_price' => ['nullable', 'numeric', 'min:1'],
            'wholesale_price' => ['nullable', 'numeric', 'min:1'],
            'cost' => ['required', 'numeric', 'min:1'],
            'is_draft' => ['nullable', 'boolean'],
            'product_type_id' => ['nullable', 'exists:product_types,id'],
            'product_status_id' => ['nullable', 'exists:product_statuses,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'product_attribute_id' => ['exists:product_attributes,id'],
            'width' => ['nullable', 'numeric', 'min:1'],
            'height' => ['nullable', 'numeric', 'min:1'],
            'weight' => ['nullable', 'numeric', 'min:1'],
            'size' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
            'material' => ['nullable', 'string'],
        ];
    }
}
