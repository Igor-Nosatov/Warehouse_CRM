<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Sales;

use App\DataTransferObjects\Sales\SalesOrderDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Sales\SalesOrderRequest;
use App\Http\Resources\Api\V1\Sales\SalesOrderResource;
use App\Services\Sales\SalesOrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class SalesOrderController extends ApiController
{
    public function __construct(
        private SalesOrderService $salesOrderService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $data = $this->salesOrderService->index($request);
        return $this->sendSuccessResponse(SalesOrderResource::collection($data));
    }

    public function show($salesOrder): JsonResponse
    {
        $data = $this->salesOrderService->show($salesOrder);
        return $this->sendSuccessResponse($data);
    }

    public function getSalesOrderFilters()
    {
        $data = $this->salesOrderService->getSalesOrderFilters();
        return $this->sendSuccessResponse($data);
    }

    public function store(SalesOrderRequest $request): JsonResponse
    {
        $data = $this->salesOrderService->store(
            SalesOrderDto::fromSalesOrderRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(SalesOrderRequest $request, int $salesOrderId)
    {
        $data = $this->salesOrderService->update(
            SalesOrderDto::fromSalesOrderRequest($request),
            $salesOrderId,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(int $id): JsonResponse
    {
       $this->salesOrderService->destroy($id);
       return $this->sendDeleteResponse('Data deleted successfully');
    }
}
