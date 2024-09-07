<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Other;

use App\Enums\SupportTicketCategoryType;
use App\Enums\SupportTicketPriorityType;
use App\Enums\SupportTicketStatusType;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ValidationExceptionTrait;

class SupportTicketRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'status' => ['required', 'string', 'in:' . implode(',', SupportTicketStatusType::all())],
            'priority' => ['required', 'string', 'in:' . implode(',', SupportTicketPriorityType::all())],
            'category' => ['nullable', 'string', 'in:' . implode(',', SupportTicketCategoryType::all())],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'closed_at' => ['nullable', 'date_format:Y-m-d H:i:s'],
        ];
    }
}
