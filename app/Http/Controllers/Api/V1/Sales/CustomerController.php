<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Sales;

use App\DataTransferObjects\Sales\CustomerDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Sales\CustomerRequest;
use App\Http\Resources\Api\V1\Sales\CustomerResource;
use App\Models\Sales\Customer;
use App\Services\Sales\CustomerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class CustomerController extends ApiController
{
    public function __construct(
        private CustomerService $customerService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Customer::class);
        $data = $this->customerService->index($request);
        return $this->sendSuccessResponse(CustomerResource::collection($data));
    }

    public function show($CustomerId): JsonResponse
    {
        $Customer = Customer::findOrFail($CustomerId);
        $this->authorize('view', $Customer);
        $data = $this->customerService->show($Customer);
        return $this->sendSuccessResponse($data);
    }

    public function getCustomerFilters(): JsonResponse
    {
        $this->authorize('viewAny', Customer::class);
        $data = $this->customerService->getCustomerFilters();
        return $this->sendSuccessResponse($data);
    }

    public function store(CustomerRequest $request): JsonResponse
    {
        $this->authorize('create', Customer::class);
        $data = $this->customerService->store(
            CustomerDto::fromCustomerRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(CustomerRequest $request, int $customerId): JsonResponse
    {
        $Customer = Customer::findOrFail($customerId);
        $this->authorize('update', $Customer);
        $data = $this->customerService->update(
            CustomerDto::fromCustomerRequest($request),
            $customerId,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(int $id): JsonResponse
    {
        $Customer = Customer::findOrFail($id);
        $this->authorize('delete', $Customer);
        $this->customerService->destroy($id);
        return $this->sendDeleteResponse('Data deleted successfully');
    }
}
