<?php

declare(strict_types=1);

namespace Tests\Feature\Order\Vendor;

use App\Models\Order\Vendor;
use Tests\TestCase;
use Tests\Traits\AuthenticatesUsers;

class VendorTest extends TestCase
{
    use AuthenticatesUsers, VendorJsonStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateUserWithEnvCredentials();
    }

    public function test_get_vendor_filters()
    {
        $response = $this->withHeaders($this->getAuthHeaders())->getJson(self::VENDOR_FILTERS_URL);

        $response->assertStatus(self::STATUS_CODE_OK)
            ->assertJsonStructure($this->getVendorFiltersJsonStructure());
    }

    public function test_delete_vendor()
    {
        $vendor = Vendor::factory()->create();

        $response = $this->withHeaders($this->getAuthHeaders())->deleteJson(self::VENDOR_BASE_URL."/{$vendor->id}");

        $response->assertStatus(self::STATUS_CODE_OK)
            ->assertJsonStructure($this->getDeleteVendorJsonStructure());

        $this->assertDatabaseMissing('vendors', [
            'id' => $vendor->id,
        ]);
    }

    public function test_create_vendor()
    {
        $vendorData = Vendor::factory()->make()->toArray();

        $response = $this->withHeaders($this->getAuthHeaders())->postJson(self::VENDOR_BASE_URL, $vendorData);

        $response->assertStatus(self::STATUS_CODE_OK)
            ->assertJsonStructure($this->getCreateVendorJsonStructure())
            ->assertJsonFragment([
                'company_name' => $vendorData['company_name'],
                'vendor_first_name' => $vendorData['vendor_first_name'],
                'vendor_last_name' => $vendorData['vendor_last_name'],
                'email' => $vendorData['email'],
                'phone' => $vendorData['phone'],
                'location' => $vendorData['location'],
                'website' => $vendorData['website'],
                'remark' => $vendorData['remark'],
                'vendor_type' => $vendorData['vendor_type'],
                'receivables' => $vendorData['receivables'],
                'used_credits' => $vendorData['used_credits'],
            ]);
    }
}
