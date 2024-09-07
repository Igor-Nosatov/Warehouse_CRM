<?php

declare(strict_types=1);

namespace App\Enums;

enum ProductStatus: string
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';
    case DRAFT = 'Draft';

    public static function all(): array
    {
        return [
            self::ACTIVE->value,
            self::INACTIVE->value,
            self::DRAFT->value,
        ];
    }
}
