<?php

declare(strict_types=1);

namespace App\Enums;

enum CustomerType: string
{
    case RETAIL = 'Retail';
    case WHOLESALE = 'Wholesale';
    case CORPORATE = 'Corporate';

    public static function all(): array
    {
        return [
            self::RETAIL->value,
            self::WHOLESALE->value,
            self::CORPORATE->value,
        ];
    }

    public static function random(): self
    {
        return self::cases()[array_rand(self::cases())];
    }
}
