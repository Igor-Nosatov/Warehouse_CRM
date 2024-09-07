<?php

declare(strict_types=1);

namespace Tests\Feature\Other\SupportTicket;

use App\Models\Auth\User;
use App\Models\Other\SupportTicket;
use Tests\TestCase;
use Tests\Traits\AuthenticatesUsers;

class SupportTicketTest extends TestCase
{
    use AuthenticatesUsers, SupportTicketJsonStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateUserWithEnvCredentials();
    }

    public function test_create_support_ticket()
    {
        $user = User::factory()->create();

        $supportTicketData = SupportTicket::factory()->make([
            'user_id' => $user->id,
        ])->toArray();

        $response = $this->withHeaders($this->getAuthHeaders())->postJson(self::SUPPORT_TICKET_CREATE_URL, $supportTicketData);

        $response->assertStatus(self::STATUS_CODE_OK);

        $response->assertJsonStructure($this->getCreateSupportTicketJsonStructure());

        $response->assertJson([
            'status' => self::STATUS_CODE_OK,
            'message' => self::SUCCESS_SUPPORT_TICKET_CREATED_MESSAGE,
            'data' => [
                'title' => $supportTicketData['title'],
                'description' => $supportTicketData['description'],
                'status' => $supportTicketData['status'],
                'priority' => $supportTicketData['priority'],
                'category' => $supportTicketData['category'],
                'user_id' => $supportTicketData['user_id'],
                'closed_at' => $supportTicketData['closed_at'],
            ],
        ]);
    }
}
