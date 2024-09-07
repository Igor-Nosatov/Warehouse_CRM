<?php

declare(strict_types=1);

namespace Tests\Feature\Order\Purchase;

use App\Models\Order\Purchase;
use Tests\TestCase;
use Tests\Traits\AuthenticatesUsers;

class PurchaseTest extends TestCase
{
    use AuthenticatesUsers, PurchaseJsonStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateUserWithEnvCredentials();
    }

    public function test_get_purchase_filters()
    {
        $response = $this->withHeaders($this->getAuthHeaders())->getJson(self::PURCHASE_FILTERS_URL);

        $response->assertStatus(self::STATUS_CODE_OK)
                 ->assertJsonStructure($this->getPurchaseFiltersJsonStructure());
    }

    public function test_delete_purchase()
    {
        $purchase = Purchase::factory()->create();

        $response = $this->withHeaders($this->getAuthHeaders())->deleteJson(self::PURCHASE_BASE_URL."/{$purchase->id}");

        $response->assertStatus(self::STATUS_CODE_OK)
                 ->assertJsonStructure($this->getDeletePurchaseJsonStructure());

        $this->assertDatabaseMissing('purchases', [
            'id' => $purchase->id,
        ]);
    }
}
