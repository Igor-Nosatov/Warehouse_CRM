<?php

declare(strict_types=1);

namespace Tests\Feature\Sales\Customer;

use App\Models\Sales\Customer;
use Tests\TestCase;
use Tests\Traits\AuthenticatesUsers;

class CustomerTest extends TestCase
{
    use AuthenticatesUsers, CustomerJsonStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateUserWithEnvCredentials();
    }

    public function test_get_customer_filters()
    {
        $response = $this->withHeaders($this->getAuthHeaders())->getJson(self::CUSTOMER_FILTERS_URL);

        $response->assertStatus(self::STATUS_CODE_OK);

        $response->assertJsonStructure($this->getFiltersJsonStructure());
    }

    public function test_delete_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->withHeaders($this->getAuthHeaders())->deleteJson(self::CUSTOMER_BASE_URL . "/{$customer->id}");

        $response->assertStatus(self::STATUS_CODE_OK);

        $response->assertJsonStructure([
            'status',
            'message',
        ]);

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
        ]);
    }

    public function test_create_customer()
    {
        $customerData = Customer::factory()->make()->toArray();

        $response = $this->withHeaders($this->getAuthHeaders())->postJson(self::CUSTOMER_BASE_URL, $customerData);

        $response->assertStatus(self::STATUS_CODE_OK);

        $response->assertJsonStructure($this->getCreateCustomerJsonStructure());

        $response->assertJson([
            'status' => self::STATUS_CODE_OK,
            'message' => self::SUCCESS_MESSAGE,
            'data' => [
                'first_name' => $customerData['first_name'],
                'last_name' => $customerData['last_name'],
                'customer_photo_url' => $customerData['customer_photo_url'],
                'customer_type' => $customerData['customer_type'],
                'customer_status' => $customerData['customer_status'] ?? null,
                'email' => $customerData['email'],
                'phone' => $customerData['phone'],
                'remark' => $customerData['remark'],
                'total_purchases' => $customerData['total_purchases'],
                'receivables' => $customerData['receivables'],
            ],
        ]);
    }
}
