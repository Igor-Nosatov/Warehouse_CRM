<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Order;

use App\DataTransferObjects\Order\VendorDto;
use App\Http\Controllers\ApiController;
use App\Http\Requests\Api\V1\Order\VendorRequest;
use App\Models\Order\Vendor;
use App\Services\Order\VendorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class VendorController extends ApiController
{
    public function __construct(
        private VendorService $vendorService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Vendor::class);
        $data = $this->vendorService->index($request);
        return $this->sendSuccessResponse($data);
    }

    public function show(Vendor $vendor): JsonResponse
    {
        $this->authorize('view', $vendor);
        $data = $this->vendorService->show($vendor);
        return $this->sendSuccessResponse($data);
    }

    public function getVendorFilters()
    {
        $this->authorize('viewAny', Vendor::class);
        $data = $this->vendorService->getVendorFilters();
        return $this->sendSuccessResponse($data);
    }

    public function store(VendorRequest $request): JsonResponse
    {
        $this->authorize('create', Vendor::class);
        $data = $this->vendorService->store(
            VendorDto::fromVendorRequest($request),
        );
        return $this->sendSuccessResponse($data);
    }

    public function update(VendorRequest $request, Vendor $vendor): JsonResponse
    {
        $this->authorize('update', $vendor);
        $data = $this->vendorService->update(
            VendorDto::fromVendorRequest($request),
            $vendor,
        );
        return $this->sendSuccessResponse($data);
    }

    public function destroy(Vendor $vendor): JsonResponse
    {
        $this->authorize('delete', $vendor);
        $this->vendorService->destroy($vendor);
        return $this->sendDeleteResponse('Data deleted successfully');
    }
}
