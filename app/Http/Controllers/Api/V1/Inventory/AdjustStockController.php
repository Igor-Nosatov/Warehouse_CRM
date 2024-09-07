<?php

declare (strict_types = 1);

namespace App\Http\Controllers\Api\V1\Inventory;

use App\DataTransferObjects\Inventory\AdjustStockDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Inventory\AdjustStockRequest;
use App\Models\Inventory\AdjustStock;
use App\Services\Inventory\AdjustStockService;
use Illuminate\Http\JsonResponse;

final class AdjustStockController extends ApiController
{
    public function __construct(
        private AdjustStockService $adjustStockService
    ) {}

    public function show(int $productId): JsonResponse
    {
        $this->authorize('view', AdjustStock::class);
        $data = $this->adjustStockService->show($productId);
        return $this->sendSuccessResponse($data);
    }

    public function store(AdjustStockRequest $request): JsonResponse
    {
        $this->authorize('create', AdjustStock::class);
        $data = $this->adjustStockService->store(
            AdjustStockDto::fromAdjustStockRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }
}
