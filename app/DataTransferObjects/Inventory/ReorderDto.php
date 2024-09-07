<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Inventory;

use App\Http\Requests\Api\V1\Inventory\ReorderRequest;

class ReorderDto
{
    public function __construct(
        public string $name
    ) {}

    public static function fromRoleRequest(ReorderRequest $request): ReorderDto
    {
        return new self(
            name: $request->validated('name')
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
