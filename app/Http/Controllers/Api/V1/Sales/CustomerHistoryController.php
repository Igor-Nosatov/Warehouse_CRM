<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Sales;

use App\DataTransferObjects\Sales\CustomerHistoryDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Sales\CustomerHistoryRequest;
use App\Http\Resources\Api\V1\Sales\CustomerHistoryResource;
use App\Models\Sales\CustomerHistory;
use App\Services\Sales\CustomerHistoryService;
use Illuminate\Http\JsonResponse;

final class CustomerHistoryController extends ApiController
{
    public function __construct(
        private CustomerHistoryService $customerHistoryService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->customerHistoryService->index();
        return $this->sendSuccessResponse(CustomerHistoryResource::collection($data));
    }

    public function store(CustomerHistoryRequest $request): JsonResponse
    {
        $data = $this->customerHistoryService->store(
            CustomerHistoryDto::fromCustomerHistoryRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(CustomerHistoryRequest $request, CustomerHistory $customerHistory): JsonResponse
    {
        $data = $this->customerHistoryService->update(
            CustomerHistoryDto::fromCustomerHistoryRequest($request),
            $customerHistory,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(CustomerHistory $customerHistory): JsonResponse
    {
        $this->customerHistoryService->destroy($customerHistory);
        return $this->sendDeleteResponse('Data deleted successfully');
    }
}
