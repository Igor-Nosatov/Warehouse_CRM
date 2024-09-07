<?php

declare(strict_types=1);

namespace App\Enums;

enum SupportTicketCategoryType: string
{
    case BUG = 'Bug';
    case FEATURE_REQUEST = 'Feature_request';
    case GENERAL = 'General';

    public static function all(): array
    {
        return [
            self::BUG->value,
            self::FEATURE_REQUEST->value,
            self::GENERAL->value,
        ];
    }

    /**
     * Get a random enum case.
     *
     * @return SupportTicketCategoryType
     */
    public static function random(): SupportTicketCategoryType
    {
        $types = self::cases();
        return $types[array_rand($types)];
    }
}
