<?php

declare(strict_types=1);

namespace Tests\Feature\Other\SupportTicket;

trait SupportTicketJsonStructure
{
    public function getCreateSupportTicketJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'title',
                'description',
                'status',
                'priority',
                'category',
                'user_id',
                'closed_at',
                'updated_at',
                'created_at',
                'id',
            ],
        ];
    }
}
