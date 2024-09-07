<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Sales;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Sales\CustomerTransactionRequest;
use App\Http\Resources\Api\V1\Sales\CustomerTransactionResource;
use App\Models\Sales\CustomerTransaction;
use App\Services\Sales\CustomerTransactionService;
use Illuminate\Http\JsonResponse;

final class CustomerTransactionController extends ApiController
{
    public function __construct(
        private CustomerTransactionService $customerTransactionService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->customerTransactionService->index();
        return $this->sendSuccessResponse(CustomerTransactionResource::collection($data));
    }

    public function store(CustomerTransactionRequest $request): JsonResponse
    {
        $data = $this->customerTransactionService->store(
            CustomerTransactionDto::fromCustomerTransactionRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(CustomerTransactionRequest $request, CustomerTransaction $customerTransaction): JsonResponse
    {
        $data = $this->customerTransactionService->update(
            CustomerTransactionDto::fromCustomerTransactionRequest($request),
            $customerTransaction,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(CustomerTransaction $customerTransaction): JsonResponse
    {
        $this->customerTransactionService->destroy($customerTransaction);
        return $this->sendDeleteResponse('Data deleted successfully');
    }
}
