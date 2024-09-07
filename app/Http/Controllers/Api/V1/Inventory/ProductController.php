<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Inventory;

use App\DataTransferObjects\Inventory\Product\ProductDto;
use App\DataTransferObjects\Inventory\Product\ProductUpdateDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Inventory\Product\ProductRequest;
use App\Http\Requests\Api\V1\Inventory\Product\ProductUpdateRequest;
use App\Models\Inventory\Product;
use App\Services\Inventory\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ProductController extends ApiController
{
    public function __construct(
        private ProductService $productService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Product::class);
        $data = $this->productService->index($request);
        return $this->sendSuccessResponseWithPagination($data);
    }

    public function getProductFilters()
    {
        $this->authorize('viewAny', Product::class);
        $data = $this->productService->getProductFilters();
        return $this->sendSuccessResponse($data);
    }

    public function show(Product $product)
    {
        $this->authorize('view', $product);
        $data = $this->productService->show($product);
        return $this->sendSuccessResponse($data);
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $this->authorize('create', Product::class);
        $data = $this->productService->store(
            ProductDto::fromProductRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        $this->authorize('update', $product);
        $data = $this->productService->update(
            ProductUpdateDto::fromProductUpdateRequest($request),
            $product,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product);
        $this->productService->destroy($product);
        return $this->sendDeleteResponse('Data deleted successfully');
    }
}
