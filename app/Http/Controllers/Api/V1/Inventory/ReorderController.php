<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Inventory;

use App\DataTransferObjects\Inventory\ReorderDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Inventory\ReorderRequest;
use App\Http\Resources\Api\V1\Inventory\ReorderResource;
use App\Models\Inventory\Reorder;
use App\Services\Inventory\ReorderService;
use Illuminate\Http\JsonResponse;

final class ReorderController extends ApiController
{
    public function __construct(
        private ReorderService $reorderService
    ) {}

    public function index(): JsonResponse
    {
        $data = $this->reorderService->index();
        return $this->sendSuccessResponse(ReorderResource::collection($data));
    }

    public function store(ReorderRequest $request): JsonResponse
    {
        $data = $this->reorderService->store(
            ReorderDto::fromReorderRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(ReorderRequest $request, Reorder $reorder): JsonResponse
    {
        $data = $this->reorderService->update(
            ReorderDto::fromReorderRequest($request),
            $reorder,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(Reorder $reorder): JsonResponse
    {
        $this->reorderService->destroy($reorder);
        return $this->sendDeleteResponse('Data deleted successfully');
    }
}
