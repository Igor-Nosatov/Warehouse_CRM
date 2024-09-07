<?php

declare(strict_types=1);

namespace App\Enums;

enum SupportTicketStatusType: string
{
    case OPEN = 'Open';
    case IN_PROGRESS = 'In_progress';
    case CLOSED = 'Closed';

    public static function all(): array
    {
        return [
            self::OPEN->value,
            self::IN_PROGRESS->value,
            self::CLOSED->value,
        ];
    }

    /**
     * Get a random enum case.
     *
     * @return SupportTicketStatusType
     */
    public static function random(): SupportTicketStatusType
    {
        $types = self::cases();
        return $types[array_rand($types)];
    }
}
