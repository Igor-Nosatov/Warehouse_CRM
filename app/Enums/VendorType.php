<?php

declare(strict_types=1);

namespace App\Enums;

enum VendorType: string
{
    case WHOLESALER = 'Wholesaler';
    case MANUFACTURER = 'Manufacturer';
    case INDIVIDUAL = 'Individual';


    public static function all(): array
    {
        return [
            self::WHOLESALER->value,
            self::MANUFACTURER->value,
            self::INDIVIDUAL->value,
        ];
    }

}
