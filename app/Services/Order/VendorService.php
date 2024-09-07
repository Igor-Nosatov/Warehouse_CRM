<?php

declare (strict_types = 1);

namespace App\Services\Order;

use App\DataTransferObjects\Order\VendorDto;
use App\Enums\VendorStatus;
use App\Enums\VendorType;
use App\Models\Order\Vendor;
use Illuminate\Support\Facades\Log;

class VendorService
{
    public function index($request): array
    {
        $searchTerm = $request->input('search');
        $vendorStatus = $request->input('vendor_status');
        $vendorType = $request->input('vendor_type');
        $minReceivables = $request->input('min_price');
        $maxReceivables = $request->input('max_price');
        $minUsedCredits = $request->input('min_used_credits');
        $maxUsedCredits = $request->input('max_used_credits');
        $orderByColumnName = $request->input('order_by_name');
        $orderByParam = $request->input('order_by_param');
        Log::info($vendorStatus);
        $vendorsQuery = Vendor::query()
            ->search($searchTerm)
            ->filterByVendorStatus($vendorStatus)
            ->filterByVendorType($vendorType)
            ->orderByFilter($orderByColumnName, $orderByParam)
            ->filterByReceivables($minReceivables, $maxReceivables)
            ->filterByUsedCredits($minUsedCredits, $maxUsedCredits);

        $perPage = $request->input('per_page', 4);
        $vendors = $vendorsQuery->paginate($perPage);

        return [
            'vendor_data' => $vendors->items(),
            'meta' => [
                'current_page' => $vendors->currentPage(),
                'per_page' => $vendors->perPage(),
                'total' => $vendors->total(),
                'last_page' => $vendors->lastPage(),
            ],
        ];
    }

    public function getVendorFilters(): array
    {
        $vendorStatusCounts = VendorStatus::all();
        $vendorTypeCounts = VendorType::all();

        $vendorFilters = [
            'vendor_status' => [],
            'vendor_type' => []
        ];

        foreach ($vendorStatusCounts as $status) {
            $statusName = $status;
            $statusCount = Vendor::where('vendor_status', $status)->count();
            $vendorFilters['vendor_status'][] = [
                'name' => $statusName,
                'count' => $statusCount,
            ];
        }

        foreach ($vendorTypeCounts as $type) {
            $typeName = $type;
            $typeCount = Vendor::where('vendor_type', $type)->count();
            $vendorFilters['vendor_type'][] = [
                'name' => $typeName,
                'count' => $typeCount,
            ];
        }

        return $vendorFilters;
    }

    public function show($vendor)
    {
        return Vendor::find($vendor);
    }

    public function store(VendorDto $dto): Vendor
    {
        return Vendor::create([
            'company_name' => $dto->company_name,
            'vendor_first_name' => $dto->vendor_first_name,
            'vendor_last_name' => $dto->vendor_last_name,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'location' => $dto->location,
            'website' => $dto->website,
            'remark' => $dto->remark,
            'status' => $dto->status,
            'vendor_type' => $dto->vendor_type,
            'receivables' => $dto->receivables,
            'used_credits' => $dto->used_credits,
        ]);
    }

    public function update(VendorDto $dto, Vendor $vendor): Vendor
    {
        $vendor->update((array) $dto);
        return $vendor;
    }

    public function destroy(Vendor $vendor): void
    {
        $vendor->delete();
    }
}
