<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Auth;

use App\Http\Requests\Api\V1\Auth\ProfileRequest;

class ProfileDto
{
    public function __construct(
        public ?string $first_name,
        public ?string $last_name,
        public ?string $address,
        public ?string $city,
        public ?string $postal_code,
        public ?string $country,
        public ?string $tax_id,
        public ?string $ic_num,
        public ?string $img_path,
        public ?int $status,
        public ?string $remarks,
        public int $user_id
    ) {}

    public static function fromProfileRequest(ProfileRequest $request): ProfileDto
    {
        return new self(
            first_name: $request->validated('first_name'),
            last_name: $request->validated('last_name'),
            address: $request->validated('address'),
            city: $request->validated('city'),
            postal_code: $request->validated('postal_code'),
            country: $request->validated('country'),
            tax_id: $request->validated('tax_id'),
            ic_num: $request->validated('ic_num'),
            img_path: $request->validated('img_path'),
            status: $request->validated('status'),
            remarks: $request->validated('remarks'),
            user_id: $request->validated('user_id')
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
