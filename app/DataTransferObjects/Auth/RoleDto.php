<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Auth;


use JsonSerializable;
class RoleDto implements JsonSerializable
{
    public function __construct(
        public string $name
    ) {}



    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
