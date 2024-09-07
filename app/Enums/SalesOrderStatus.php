<?php

declare(strict_types=1);

namespace App\Enums;

enum SalesOrderStatus: string
{
    case PACKED = 'Packed';
    case PROCESSING = 'Processing';
    case SHIPPED = 'Shipped';
    case DELIVERED = 'Delivered';

    public static function all(): array
    {
        return [
            self::PACKED->value,
            self::PROCESSING->value,
            self::SHIPPED->value,
            self::DELIVERED->value,
        ];
    }

    public static function getStatusExceptDelivered(): array
    {
        return [
            self::PACKED->value,
            self::PROCESSING->value,
            self::SHIPPED->value,
        ];
    }
}

