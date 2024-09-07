<?php

declare(strict_types=1);

namespace App\Enums;

enum SalesReturnStatus: string
{
    case PROCESSING = 'Processing';
    case INSPECTING = 'Inspecting';
    case RETURNING = 'Returning';
    case COMPLETED = 'Completed';

    public static function all(): array
    {
        return [
            self::PROCESSING->value,
            self::INSPECTING->value,
            self::RETURNING->value,
            self::COMPLETED->value,
        ];
    }
}
