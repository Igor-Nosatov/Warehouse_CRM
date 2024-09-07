<?php

declare(strict_types=1);

namespace App\Builders\Order;

use Illuminate\Database\Eloquent\Builder;

class PurchaseBuilder extends Builder
{
    public function __construct($query)
    {
        parent::__construct($query);
    }

    public function search(?string $search)
    {
        return $this->when($search !== null, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->whereHas('vendor', function ($query) use ($search) {
                    $query->where('company_name', 'LIKE', '%' . $search . '%')
                          ->orWhere('email', 'LIKE', '%' . $search . '%');
                });
            });
        });
    }

    public function filterBySalesOrderStatus($status)
    {
        return $this->when($status !== null, function ($q) use ($status) {
            $q->where('status', $status);
        });
    }

    public function filterByPaymentStatus($paymentStatusId)
    {
        return $this->when($paymentStatusId !== null, function ($q) use ($paymentStatusId) {
            $q->where('payment_status_id', $paymentStatusId);
        });
    }

    public function orderByFilter($orderByColumName, $orderByParam)
    {
        return $this->when($orderByColumName !== null && $orderByParam !== null, function ($q) use ($orderByColumName, $orderByParam) {
            $q->orderBy($orderByColumName, $orderByParam);
        });
    }

    public function filterByPriceRange($minPrice, $maxPrice)
    {
        return $this->when($minPrice !== null && $maxPrice !== null, function ($q) use ($minPrice, $maxPrice) {
            $q->whereBetween('total_amount', [$minPrice, $maxPrice]);
        });
    }

    public function filterByProductQuantity($minQuantity, $maxQuantity)
    {
        return $this->when($minQuantity !== null && $maxQuantity !== null, function ($q) use ($minQuantity, $maxQuantity) {
            $q->whereBetween('total_quantity', [$minQuantity, $maxQuantity]);
        });
    }
}
