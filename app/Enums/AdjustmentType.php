<?php

declare(strict_types=1);

namespace App\Enums;

enum AdjustmentType: string
{
    case QUANTITY_ADJUSTMENT = 'Quantity Adjustment';
    case VALUE_ADJUSTMENT = 'Value Adjustment';

    public static function all(): array
    {
        return [
            self::QUANTITY_ADJUSTMENT->value,
            self::VALUE_ADJUSTMENT->value,
        ];
    }

    /**
     * Get a random enum case.
     *
     * @return AdjustmentType
     */
    public static function random(): AdjustmentType
    {
        $types = self::cases();
        return $types[array_rand($types)];
    }
}
