<?php

declare(strict_types=1);

namespace Tests\Feature\Sales\SalesOrder;

use App\Models\Inventory\Product;
use App\Models\Sales\Customer;
use App\Models\Sales\PaymentStatus;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesTransaction;
use Tests\TestCase;
use Tests\Traits\AuthenticatesUsers;

class SalesOrderTest extends TestCase
{
    use AuthenticatesUsers, SalesOrderJsonStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateUserWithEnvCredentials();
    }

    public function test_get_order_filter()
    {
        $response = $this->withHeaders($this->getAuthHeaders())->getJson(self::SALES_ORDER_FILTERS_URL);

        $response->assertStatus(self::STATUS_CODE_OK);

        $response->assertJsonStructure($this->getOrderFilterJsonStructure());
    }

    public function test_get_sales_order()
    {
        $response = $this->withHeaders($this->getAuthHeaders())->getJson(self::SALES_ORDER_URL);

        $response->assertStatus(self::STATUS_CODE_OK);

        $response->assertJsonStructure($this->getSalesOrderJsonStructure());
    }

    public function test_get_a_sales_order_by_id()
    {
        $salesOrder = SalesOrder::factory()->create();

        $response = $this->withHeaders($this->getAuthHeaders())->getJson(self::SALES_ORDER_URL . "/{$salesOrder->id}");

        $response->assertStatus(self::STATUS_CODE_OK);

        $response->assertJsonStructure($this->getSalesOrderByIdJsonStructure());
    }

    public function test_delete_a_sales_order_by_id()
    {
        $salesOrder = SalesOrder::factory()->create();

        $response = $this->withHeaders($this->getAuthHeaders())->deleteJson(self::SALES_ORDER_URL . "/{$salesOrder->id}");

        $response->assertStatus(self::STATUS_CODE_OK);

        $response->assertJsonStructure([
            'status',
            'message',
        ]);

        $this->assertDatabaseMissing('sales_orders', [
            'id' => $salesOrder->id,
        ]);
    }

    public function test_update_sales_order()
    {
        $customer = Customer::factory()->create();
        $paymentStatus = PaymentStatus::factory()->create();
        $product = Product::factory()->create();
        $salesOrder = SalesOrder::factory()->create();

        $updateData = [
            'status' => 'Packed',
            'total_amount' => 50000000,
            'total_quantity' => 150,
            'date_time_of_placement' => '2024-09-01T12:00:00',
            'date_time_of_delivery' => '2024-09-05T15:00:00',
            'delivery_location' => '123 Test Street, Test City',
            'customer_id' => $customer->id,
            'payment_status_id' => $paymentStatus->id,
            'product_id' => $product->id,
        ];

        $response = $this->withHeaders($this->getAuthHeaders())->putJson(self::SALES_ORDER_URL . "/{$salesOrder->id}", $updateData);

        $response->assertStatus(self::STATUS_CODE_OK);

        $response->assertJsonStructure($this->getCreateSalesOrderJsonStructure());

        $response->assertJson([
            'status' => self::STATUS_CODE_OK,
            'message' => self::SUCCESS_MESSAGE,
            'data' => $updateData + [
                'product_id' => $product->id,
                'customer_id' => $customer->id,
                'payment_status_id' => $paymentStatus->id,
            ],
        ]);
    }

    public function test_create_sales_order()
    {
        $customer = Customer::factory()->create();
        $paymentStatus = PaymentStatus::factory()->create();
        $product = Product::factory()->create();
        $salesTransaction = SalesTransaction::factory()->create();

        $postData = SalesOrder::factory()->make([
            'product_id' => $product->id,
            'customer_id' => $customer->id,
            'payment_status_id' => $paymentStatus->id
        ]);

        $response = $this->withHeaders($this->getAuthHeaders())->postJson(self::SALES_ORDER_URL, $postData->toArray());

        $response->assertStatus(self::STATUS_CODE_OK);

        $response->assertJsonStructure($this->getCreateSalesOrderJsonStructure());

        $response->assertJson([
            'status' => self::STATUS_CODE_OK,
            'message' => self::SUCCESS_MESSAGE,
            'data' => [
                'status' => $postData->status,
                'total_amount' => $postData->total_amount,
                'total_quantity' => $postData->total_quantity,
                'date_time_of_placement' => $postData->date_time_of_placement,
                'date_time_of_delivery' => $postData->date_time_of_delivery,
                'delivery_location' => $postData->delivery_location,
                'customer_id' => $customer->id,
                'payment_status_id' => $paymentStatus->id,
                'product_id' => $product->id,
                'sales_transaction_id' => $salesTransaction->id,
            ],
        ]);
    }
}
