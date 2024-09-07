<?php

declare (strict_types = 1);

namespace App\Enums;

enum ProductTypePrice: string {
    case RETAIL_AND_WHOLESALE = 'Retail and Wholesale';
    case RETAIL = 'Retail';
    case WHOLESALE = 'Wholesale';

    public static function all(): array
    {
        return [
            self::RETAIL_AND_WHOLESALE->value,
            self::RETAIL->value,
            self::WHOLESALE->value,
        ];
    }

    public static function random(): self
    {
        return self::cases()[array_rand(self::cases())];
    }
}
