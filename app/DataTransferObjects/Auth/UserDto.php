<?php

declare (strict_types = 1);

namespace App\DataTransferObjects\Auth;

use App\Http\Requests\Api\V1\Auth\LoginRequest;

class UserDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}

    public static function fromLoginRequest(LoginRequest $request): UserDto
    {
        return new self(
            email: $request->validated('email'),
            password: $request->validated('password'),
        );
    }
}
