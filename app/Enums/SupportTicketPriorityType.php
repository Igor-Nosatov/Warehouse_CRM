<?php

declare(strict_types=1);

namespace App\Enums;

enum SupportTicketPriorityType: string
{
    case LOW = 'Low';
    case MEDIUM = 'Medium';
    case HIGH = 'High';

    public static function all(): array
    {
        return [
            self::LOW->value,
            self::MEDIUM->value,
            self::HIGH->value,
        ];
    }

    /**
     * Get a random enum case.
     *
     * @return SupportTicketPriorityType
     */
    public static function random(): SupportTicketPriorityType
    {
        $types = self::cases();
        return $types[array_rand($types)];
    }
}
