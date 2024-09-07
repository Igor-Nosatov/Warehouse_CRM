<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Sales;

use App\DataTransferObjects\Sales\CustomerNoteDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Sales\CustomerNoteRequest;
use App\Http\Resources\Api\V1\Sales\CustomerNoteResource;
use App\Models\Sales\CustomerNote;
use App\Services\Sales\CustomerNoteService;
use Illuminate\Http\JsonResponse;

final class CustomerNoteController extends ApiController
{
    public function __construct(
        private CustomerNoteService $customerNoteService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->customerNoteService->index();
        return $this->sendSuccessResponse(CustomerNoteResource::collection($data));
    }

    public function store(CustomerNoteRequest $request): JsonResponse
    {
        $data = $this->customerNoteService->store(
            CustomerNoteDto::fromCustomerNoteRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(CustomerNoteRequest $request, CustomerNote $customerNote): JsonResponse
    {
        $data = $this->customerNoteService->update(
            CustomerNoteDto::fromCustomerNoteRequest($request),
            $customerNote,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(CustomerNote $customerNote): JsonResponse
    {
        $this->customerNoteService->destroy($customerNote);
        return $this->sendDeleteResponse('Data deleted successfully');
    }
}
