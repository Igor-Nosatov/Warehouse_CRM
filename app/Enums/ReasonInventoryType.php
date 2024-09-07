<?php

declare(strict_types=1);

namespace App\Enums;

enum ReasonInventoryType: string
{
    case STOLEN_GOODS = 'Stolen Goods';
    case MISSING_GOODS = 'Missing Goods';
    case ACCIDENT = 'Accident';
    case OTHER = 'Other';

    public static function all(): array
    {
        return [
            self::STOLEN_GOODS->value,
            self::MISSING_GOODS->value,
            self::ACCIDENT->value,
            self::OTHER->value,
        ];
    }

    /**
     * Get a random enum case.
     *
     * @return AdjustmentType
     */
    public static function random(): ReasonInventoryType
    {
        $types = self::cases();
        return $types[array_rand($types)];
    }
}
