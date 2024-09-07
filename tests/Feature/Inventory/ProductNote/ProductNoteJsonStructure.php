<?php

declare(strict_types=1);

namespace Tests\Feature\ProductNoteJsonStructure;

trait ProductNoteJsonStructure
{
    public function getCreateNoteJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                'notes',
                'product_id',
                'user_id',
                'updated_at',
                'created_at',
                'id',
            ],
        ];
    }

    public function getGetNotesJsonStructure(): array
    {
        return [
            'status',
            'message',
            'data' => [
                '*' => [
                    'id',
                    'notes',
                    'user_id',
                    'product_id',
                    'created_at',
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'role_id',
                    ],
                ],
            ],
        ];
    }
}
