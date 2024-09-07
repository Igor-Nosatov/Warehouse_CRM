<?php

declare(strict_types=1);

namespace Tests\Feature\Dashboard;

use Tests\TestCase;
use Tests\Traits\AuthenticatesUsers;

class DashboardTest extends TestCase
{
    use AuthenticatesUsers, DashboardJsonStructure;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticateUserWithEnvCredentials();
    }

    public function test_return_dashboard_data_with_correct_structure()
    {
        $response = $this->withHeaders($this->getAuthHeaders())
                         ->getJson(self::GET_DASHBOARD_DATA);

        $response->assertStatus(self::STATUS_CODE_OK)
                 ->assertJsonStructure($this->getDashboardJsonStructure());
    }

    public function test_unauthorized_access_to_dashboard_data()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer InvalidToken',
        ])->getJson(self::GET_DASHBOARD_DATA);

        $response->assertStatus(self::STATUS_METHOD_NOT_ALLOWED);
        $response->assertJson([
            'status' => 'error',
            'message' => self::ERROR_UNAUTHORIZED,
        ]);
    }

    public function test_accessing_non_existent_route()
    {
        $response = $this->withHeaders($this->getAuthHeaders())
                         ->getJson(self::GET_DASHBOARD_DATA . '/' . self::NON_EXIST_ROUTE);

        $response->assertStatus(self::STATUS_NOT_FOUND);
        $response->assertJson([
            'status' => 'error',
            'message' => self::ERROR_NOT_FOUND,
        ]);
    }

    public function test_incorrect_http_method()
    {
        $response = $this->withHeaders($this->getAuthHeaders())
                         ->postJson(self::GET_DASHBOARD_DATA);

        $response->assertStatus(self::STATUS_METHOD_NOT_ALLOWED);
        $response->assertJson([
            'status' => 'error',
            'message' => self::ERROR_METHOD_NOT_ALLOWED,
        ]);
    }

    public function test_invalid_query_parameters()
    {
        $response = $this->withHeaders($this->getAuthHeaders())
                         ->getJson(self::GET_DASHBOARD_DATA . '?invalid_param=invalid');

        $response->assertStatus(self::STATUS_BAD_REQUEST);
        $response->assertJson([
            'status' => 'error',
            'message' => self::ERROR_INVALID_PARAMETERS,
        ]);
    }
}
