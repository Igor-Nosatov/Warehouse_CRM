<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Order;

use App\Enums\VendorType;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidationExceptionTrait;

class VendorRequest extends FormRequest
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
            'company_name' => ['required', 'string'],
            'vendor_first_name' => ['required', 'string'],
            'vendor_last_name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string'],
            'location' => ['required', 'string'],
            'website' => ['nullable', 'string'],
            'remark' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
            'vendor_type' => ['required', 'string', 'in:' . implode(',', VendorType::all())],
            'receivables' => ['nullable', 'integer'],
            'used_credits' => ['nullable', 'integer'],
        ];
    }
}
