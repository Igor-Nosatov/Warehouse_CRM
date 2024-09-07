<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Sales;

use App\Enums\CustomerStatus;
use App\Enums\CustomerType;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidationExceptionTrait;

class CustomerRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'customer_photo_url' => ['nullable', 'string'],
            'customer_type' => ['required', 'string', 'in:' . implode(',', CustomerType::all())],
            'customer_status' => ['required', 'string', 'in:' . implode(',', CustomerStatus::all())],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'remark' => ['nullable', 'string'],
            'total_purchases' => ['nullable', 'integer', 'min:0'],
            'receivables' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
