<?php

declare(strict_types=1);

namespace App\Enums;

enum CustomerStatus: string
{
    case ACTIVE = 'Active';
    case SUSPENDED = 'Suspended';
    case OVERDUE = 'Overdue';
    case NEW = 'New';

    public static function all(): array
    {
        return [
            self::ACTIVE->value,
            self::SUSPENDED->value,
            self::OVERDUE->value,
            self::NEW->value,
        ];
    }

    public static function random(): self
    {
        return self::cases()[array_rand(self::cases())];
    }
}
