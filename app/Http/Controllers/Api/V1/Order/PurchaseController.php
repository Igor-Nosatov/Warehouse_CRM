<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Order;

use App\DataTransferObjects\Order\PurchaseDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Order\PurchaseRequest;
use App\Models\Order\Purchase;
use App\Services\Order\PurchaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PurchaseController extends ApiController
{
    public function __construct(
        private PurchaseService $purchaseService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Purchase::class);
        $data = $this->purchaseService->index($request);
        return $this->sendSuccessResponse($data);
    }

    public function show(Purchase $purchase): JsonResponse
    {
        $this->authorize('view', $purchase);
        $data = $this->purchaseService->show($purchase);
        return $this->sendSuccessResponse($data);
    }

    public function getPurchaseFilters()
    {
        $this->authorize('viewAny', Purchase::class);
        $data = $this->purchaseService->getPurchaseFilters();
        return $this->sendSuccessResponse($data);
    }

    public function store(PurchaseRequest $request): JsonResponse
    {
        $this->authorize('create', Purchase::class);
        $data = $this->purchaseService->store(
            PurchaseDto::fromPurchaseRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(PurchaseRequest $request, Purchase $purchase): JsonResponse
    {
        $this->authorize('update', $purchase);
        $data = $this->purchaseService->update(
            PurchaseDto::fromPurchaseRequest($request),
            $purchase,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(Purchase $purchase): JsonResponse
    {
        $this->authorize('delete', $purchase);
        $this->purchaseService->destroy($purchase);
        return $this->sendDeleteResponse('Data deleted successfully');
    }
}
