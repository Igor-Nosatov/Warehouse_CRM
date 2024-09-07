<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Inventory;

use App\DataTransferObjects\Inventory\ProductHistoryDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Inventory\ProductHistoryRequest;
use App\Http\Resources\Api\V1\Inventory\ProductHistoryResource;
use App\Models\Inventory\ProductHistory;
use App\Services\Inventory\ProductHistoryService;
use Illuminate\Http\JsonResponse;

final class ProductHistoryController extends ApiController
{
    public function __construct(
        private ProductHistoryService $productHistoryService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->productHistoryService->index();
        return $this->sendSuccessResponse(ProductHistoryResource::collection($data));
    }

    public function store(ProductHistoryRequest $request): JsonResponse
    {
        $data = $this->productHistoryService->store(
            ProductHistoryDto::fromProductHistoryRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(ProductHistoryRequest $request, ProductHistory $productHistory): JsonResponse
    {
        $data = $this->productHistoryService->update(
            ProductHistoryDto::fromProductHistoryRequest($request),
            $productHistory,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(ProductHistory $productHistory): JsonResponse
    {
        $this->productHistoryService->destroy($productHistory);
        return $this->sendDeleteResponse('Data deleted successfully');
    }
}
