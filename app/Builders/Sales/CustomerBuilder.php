<?php

declare(strict_types=1);

namespace App\Builders\Sales;

use Illuminate\Database\Eloquent\Builder;

class CustomerBuilder extends Builder
{
    public function __construct($query)
    {
        parent::__construct($query);
    }

    public function search(?string $search)
    {
        return $this->when($search !== null, function ($q) use ($search) {
            $terms = explode(' ', $search);

            $q->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where('first_name', 'LIKE', '%' . $term . '%')
                        ->orWhere('last_name', 'LIKE', '%' . $term . '%');
                }
            });

            $q->orWhereRaw('CONCAT_WS(" ", `first_name`, `last_name`) LIKE ?', ['%' . $search . '%']);

            if (count($terms) > 1) {
                $q->orWhere(function ($query) use ($terms) {
                    $query->where(function ($query) use ($terms) {
                        $query->where('first_name', 'LIKE', '%' . $terms[0] . '%')
                            ->where('last_name', 'LIKE', '%' . $terms[1] . '%');
                    });

                    if (count($terms) > 2) {
                        for ($i = 2; $i < count($terms); $i++) {
                            $query->orWhere(function ($query) use ($terms, $i) {
                                $query->where('first_name', 'LIKE', '%' . $terms[$i] . '%')
                                    ->where('last_name', 'LIKE', '%' . $terms[1] . '%');
                            });
                        }
                    }
                });
            }
        });
    }

    public function filterByCustomerType($customerType)
    {
        return $this->when($customerType != null, function ($q) use ($customerType) {
            $q->where('customer_type', $customerType);
        });
    }

    public function filterByCustomerStatus($customerStatus)
    {
        return $this->when($customerStatus != null, function ($q) use ($customerStatus) {
            $q->where('customer_status', $customerStatus);
        });
    }

    public function orderByFilter($orderByColumName, $orderByParam)
    {
        return $this->when($orderByColumName !== null && $orderByParam !== null, function ($q) use ($orderByColumName, $orderByParam) {
            $q->orderBy($orderByColumName, $orderByParam);
        });
    }

    public function filterByTotalPurchases($minTotalPurchases, $maxTotalPurchases)
    {
        return $this->when($minTotalPurchases !== null && $maxTotalPurchases !== null, function ($q) use ($minTotalPurchases, $maxTotalPurchases) {
            $q->whereBetween('total_purchases', [$minTotalPurchases, $maxTotalPurchases]);
        });
    }

    public function filterByReceivables($minReceivables, $maxReceivables)
    {
        return $this->when($minReceivables !== null && $maxReceivables !== null, function ($q) use ($minReceivables, $maxReceivables) {
            $q->whereBetween('receivables', [$minReceivables, $maxReceivables]);
        });
    }
}
