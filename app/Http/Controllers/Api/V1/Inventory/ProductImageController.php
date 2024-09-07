<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Inventory;

use App\DataTransferObjects\Inventory\ProductImageDTO;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Inventory\ProductImageRequest;
use App\Services\Inventory\ProductImageService;
use Illuminate\Http\JsonResponse;

final class ProductImageController extends ApiController
{
    public function __construct(
        private ProductImageService $productImageService
    ) {}

    public function store(ProductImageRequest $request): JsonResponse
    {
        $data = $this->productImageService->store(
            ProductImageDTO::fromProductImageRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }
}
