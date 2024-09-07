<?php

declare(strict_types=1);

namespace Tests\Feature\Inventory\Product;

use App\Models\Inventory\Product;
use Tests\TestCase;
use Tests\Traits\AuthenticatesUsers;

class ProductTest extends TestCase
{
    use AuthenticatesUsers, ProductJsonStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateUserWithEnvCredentials();
    }

    public function test_get_inventory_filter()
    {
        $response = $this->withHeaders($this->getAuthHeaders())
                         ->getJson(self::ADJUST_STOCK_BASE_URL . '/filter');

        $response->assertStatus(self::STATUS_CODE_OK);
        $response->assertJsonStructure($this->getFilterJsonStructure());
    }

    public function test_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->withHeaders($this->getAuthHeaders())
                         ->deleteJson(self::ADJUST_STOCK_BASE_URL . "/products/{$product->id}");

        $response->assertStatus(self::STATUS_CODE_OK);
        $response->assertJsonStructure($this->getDeleteProductJsonStructure());

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
