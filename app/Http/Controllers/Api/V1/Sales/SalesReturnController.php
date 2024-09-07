<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Sales;

use App\DataTransferObjects\Sales\SalesReturnDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Sales\SalesReturnRequest;
use App\Http\Resources\Api\V1\Sales\SalesReturnResource;
use App\Models\Sales\SalesReturn;
use App\Services\Sales\SalesReturnService;
use Illuminate\Http\JsonResponse;

final class SalesReturnController extends ApiController
{
    public function __construct(
        private SalesReturnService $salesReturnService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->salesReturnService->index();
        return $this->sendSuccessResponse(SalesReturnResource::collection($data));
    }

    public function show($salesReturn): JsonResponse
    {
        $data = $this->salesReturnService->show($salesReturn);
        return $this->sendSuccessResponse($data);
    }

    public function store(SalesReturnRequest $request): JsonResponse
    {
        $data = $this->salesReturnService->store(
            SalesReturnDto::fromSalesReturnRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(SalesReturnRequest $request, SalesReturn $salesReturn): JsonResponse
    {
        $data = $this->salesReturnService->update(
            SalesReturnDto::fromSalesReturnRequest($request),
            $salesReturn,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(SalesReturn $salesReturn): JsonResponse
    {
        $this->salesReturnService->destroy($salesReturn);
        return $this->sendDeleteResponse('Data deleted successfully');
    }
}
