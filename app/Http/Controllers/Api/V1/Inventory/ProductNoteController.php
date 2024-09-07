<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Inventory;

use App\DataTransferObjects\Inventory\ProductNoteDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Inventory\ProductNoteRequest;
use App\Services\Inventory\ProductNoteService;
use Illuminate\Http\JsonResponse;

final class ProductNoteController extends ApiController
{
    public function __construct(
        private ProductNoteService $productNoteService
    ) {}

    public function show(int $productId): JsonResponse
    {
        $data = $this->productNoteService->show($productId);
        return $this->sendSuccessResponse($data);
    }

    public function store(ProductNoteRequest $request): JsonResponse
    {
        $data = $this->productNoteService->store(
            ProductNoteDto::fromProductNoteRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }
}
