<?php

declare(strict_types=1);

namespace App\Builders\Order;

use Illuminate\Database\Eloquent\Builder;

class VendorBuilder extends Builder
{
    public function __construct($query)
    {
        parent::__construct($query);
    }
    public function search(?string $search)
    {
        return $this->when($search !== null, function ($q) use ($search) {
            $terms = preg_split('/[\s-]+/', $search);

            $q->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->orWhere('company_name', 'LIKE', '%' . $term . '%');
                }
            });
        });
    }

    public function filterByVendorStatus($vendorStatus)
    {
        return $this->when($vendorStatus !== null, function ($q) use ($vendorStatus) {
            $q->where('vendor_status', $vendorStatus);
        });
    }

    public function filterByVendorType($vendorType)
    {
        return $this->when($vendorType !== null, function ($q) use ($vendorType) {
            $q->where('vendor_type', $vendorType);
        });
    }

    public function orderByFilter($orderByColumName, $orderByParam)
    {
        return $this->when($orderByColumName !== null && $orderByParam !== null, function ($q) use ($orderByColumName, $orderByParam) {
            $q->orderBy($orderByColumName, $orderByParam);
        });
    }

    public function filterByReceivables($minReceivables, $maxReceivables)
    {
        return $this->when($minReceivables !== null && $maxReceivables !== null, function ($q) use ($minReceivables, $maxReceivables) {
            $q->whereBetween('receivables', [$minReceivables, $maxReceivables]);
        });
    }

    public function filterByUsedCredits($minUsedCredits, $maxUsedCredits)
    {
        return $this->when($minUsedCredits !== null && $maxUsedCredits !== null, function ($q) use ($minUsedCredits, $maxUsedCredits) {
            $q->whereBetween('used_credits', [$minUsedCredits, $maxUsedCredits]);
        });
    }
}
