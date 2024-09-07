<?php

namespace Tests;

use App\Console\Kernel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Response;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;
   // Status Codes
   const STATUS_CODE_OK = Response::HTTP_OK;
   const STATUS_NOT_FOUND = Response::HTTP_NOT_FOUND;
   const STATUS_METHOD_NOT_ALLOWED = Response::HTTP_METHOD_NOT_ALLOWED;
   const STATUS_BAD_REQUEST = Response::HTTP_BAD_REQUEST;

   // Routes
   const POST_LOGIN = '/api/login';
   const ADJUST_STOCK_BASE_URL = '/api/v1/dashboard/inventory/adjust-stock';
   const GET_DASHBOARD_DATA = '/api/v1/dashboard';
   const PRODUCT_NOTES_BASE_URL = '/api/v1/dashboard/inventory/notes/';
   const PURCHASE_FILTERS_URL = '/api/v1/dashboard/order/purchase-filters';
   const PURCHASE_BASE_URL = '/api/v1/dashboard/order/purchase/';
   const VENDOR_FILTERS_URL = '/api/v1/dashboard/order/vendor-filters';
   const VENDOR_BASE_URL = '/api/v1/dashboard/order/vendor';
   const SUPPORT_TICKET_CREATE_URL = '/api/v1/dashboard/other/support-tickets';
   const SUCCESS_SUPPORT_TICKET_CREATED_MESSAGE = 'Support ticket created successfully.';
   const CUSTOMER_FILTERS_URL = '/api/v1/dashboard/sales/customer/filters';
   const CUSTOMER_BASE_URL = '/api/v1/dashboard/sales/customer';
   const SALES_ORDER_FILTERS_URL = '/api/v1/dashboard/sales/order-filter';
   const SALES_ORDER_URL = '/api/v1/dashboard/sales/order';

   // Error Messages
   const ERROR_UNAUTHORIZED = 'Unauthorized';
   const ERROR_NOT_FOUND = 'Not Found';
   const ERROR_METHOD_NOT_ALLOWED = 'Method Not Allowed';
   const ERROR_INVALID_PARAMETERS = 'Invalid parameters';
   const ERROR_DOCTOR_NOT_FOUND = 'Doctor not found';
   const SUCCESS_MESSAGE = 'Success';
   const DATA_DELETED_SUCCESSFULLY_MESSAGE = 'Data deleted successfully';
   const NON_EXIST_ROUTE = 'non-exist-route';
   const ERROR_PATIENT_NOT_FOUND = 'Patient not found';

    // Constants for testing
    const INTEGER_FOR_TEST_STATUS_NOT_FOUND = 9999;

    protected function refreshTestDatabase()
    {
        if (! RefreshDatabaseState::$migrated) {
            $this->artisan('migrate:fresh');

            $this->generateDefaultData();

            $this->app[Kernel::class]->setArtisan(null);

            RefreshDatabaseState::$migrated = true;
        }

        $this->beginDatabaseTransaction();
    }

    private function generateDefaultData(): void
    {
        Artisan::call('db:seed', ['--class' => 'TestDatabaseSeeder']);
    }
}
