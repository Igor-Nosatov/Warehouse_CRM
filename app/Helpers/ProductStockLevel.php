<?php

declare(strict_types=1);

namespace App\Helpers;

class ProductStockLevel
{
    public const LOW_LEVEL_STOCK = 500;
    public const AVERAGE_LEVEL_STOCK = 1000;
    public const HIGH_LEVEL_STOCK = 1500;
    public const MAX_LEVEL_STOCK = 2000;

    public static function getLowLevelStock(): int
    {
        return self::LOW_LEVEL_STOCK;
    }

    public static function getAverageLevelStock(): int
    {
        return self::AVERAGE_LEVEL_STOCK;
    }

    public static function getHighLevelStock(): int
    {
        return self::HIGH_LEVEL_STOCK;
    }

    public static function getMaxLevelStock(): int
    {
        return self::MAX_LEVEL_STOCK;
    }
}
