<?php

declare(strict_types=1);

namespace Tests\Feature\Inventory\AdjustStock;

use App\Models\Inventory\AdjustStock;
use Tests\TestCase;
use Tests\Traits\AuthenticatesUsers;

class AdjustStockTest extends TestCase
{
    use AuthenticatesUsers, AdjustStockJsonStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateUserWithEnvCredentials();
    }

    public function it_can_retrieve_adjust_stock_data()
    {
        $adjustStock = AdjustStock::factory()->create();
        $response = $this->withHeaders($this->getAuthHeaders())
                         ->getJson(self::ADJUST_STOCK_BASE_URL . '/' . $adjustStock->id);

        $response->assertStatus(self::STATUS_CODE_OK)
                 ->assertJsonStructure($this->getRetrieveAdjustStockJsonStructure());
    }

    public function test_can_create_adjust_stock_entry()
    {
        $adjustStock = AdjustStock::factory()->create();

        $postData = [
            'payment_status' => $adjustStock->payment_status,
            'adjust_stock_date' => $adjustStock->adjust_stock_date->toDateString(),
            'reason_for_inventory' => $adjustStock->reason_for_inventory,
            'quantity_available' => $adjustStock->quantity_available,
            'new_quantity' => $adjustStock->new_quantity,
            'description' => $adjustStock->description,
            'product_id' => $adjustStock->product_id,
            'warehouse_id' => $adjustStock->warehouse_id,
            'vendor_id' => $adjustStock->vendor_id,
            'user_id' => $adjustStock->user_id
        ];

        $response = $this->withHeaders($this->getAuthHeaders())
                         ->postJson(self::ADJUST_STOCK_BASE_URL, $postData);

        $response->assertStatus(self::STATUS_CODE_OK)
                 ->assertJsonStructure($this->getCreateAdjustStockJsonStructure());

        $responseData = $response->json('data');
        $this->assertEquals($postData['payment_status'], $responseData['payment_status']);
        $this->assertEquals($postData['adjust_stock_date'], $responseData['adjust_stock_date']);
        $this->assertEquals($postData['reason_for_inventory'], $responseData['reason_for_inventory']);
        $this->assertEquals($postData['quantity_available'], $responseData['quantity_available']);
        $this->assertEquals($postData['new_quantity'], $responseData['new_quantity']);
        $this->assertEquals($postData['description'], $responseData['description']);
        $this->assertEquals($postData['product_id'], $responseData['product_id']);
        $this->assertEquals($postData['warehouse_id'], $responseData['warehouse_id']);
        $this->assertEquals($postData['vendor_id'], $responseData['vendor_id']);
        $this->assertEquals($postData['user_id'], $responseData['user_id']);
    }
}
