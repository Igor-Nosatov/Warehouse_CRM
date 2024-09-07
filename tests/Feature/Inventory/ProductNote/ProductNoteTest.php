<?php

declare(strict_types=1);

namespace Tests\Feature\Inventory;

use App\Models\Auth\User;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductNote;
use Tests\TestCase;
use Tests\Traits\AuthenticatesUsers;
use Tests\Feature\ProductNoteJsonStructure\ProductNoteJsonStructure;

class ProductNoteTest extends TestCase
{
    use AuthenticatesUsers, ProductNoteJsonStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateUserWithEnvCredentials();
    }

    public function test_can_create_note()
    {
        $note = ProductNote::factory()->create();

        $postData = [
            'notes' => $note->notes,
            'product_id' => $note->product_id,
            'user_id' => $note->user_id,
        ];

        $response = $this->withHeaders($this->getAuthHeaders())->postJson(self::PRODUCT_NOTES_BASE_URL, $postData);

        $response->assertStatus(self::STATUS_CODE_OK)
            ->assertJsonStructure($this->getCreateNoteJsonStructure())
            ->assertJsonFragment([
                'notes' => $postData['notes'],
                'product_id' => $postData['product_id'],
                'user_id' => $postData['user_id'],
            ]);
    }

    public function test_can_get_notes()
    {
        $users = User::factory()->create();
        $product = Product::factory()->create();

        $specialNote = ProductNote::factory()->create([
            'product_id' => $product->id,
            'user_id' => $users->id,
            'notes' => 'test',
            'created_at' => now(),
        ]);

        $response = $this->withHeaders($this->getAuthHeaders())->getJson(self::PRODUCT_NOTES_BASE_URL . $product->id);

        $response->assertStatus(self::STATUS_CODE_OK)
            ->assertJsonStructure($this->getGetNotesJsonStructure())
            ->assertJsonFragment([
                'notes' => 'test',
                'product_id' => $product->id,
                'user_id' => $specialNote->user_id,
            ]);
    }
}
