<?php

declare(strict_types=1);

namespace App\Services\Order;

use App\DataTransferObjects\Order\PurchaseDto;
use App\Enums\SalesOrderStatus;
use App\Models\Order\Purchase;
use App\Models\Order\PurchaseTransaction;
use App\Models\Sales\PaymentStatus;
use Illuminate\Support\Facades\DB;

class PurchaseService
{
    public function index($request): array
    {
        $searchTerm = $request->input('search');
        $salesOrderStatusParam = $request->input('purchase_sales_order_status');
        $paymentStatusParam = $request->input('purchase_status');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $minPurchaseQuantity = $request->input('min_purchase_qty');
        $maxPurchaseQuantity = $request->input('max_purchase_qty');
        $orderByColumnName = $request->input('order_by_name');
        $orderByParam = $request->input('order_by_param');

        $purchasesQuery = Purchase::with(['vendor', 'product', 'paymentStatus'])
            ->search($searchTerm)
            ->filterBySalesOrderStatus($salesOrderStatusParam)
            ->filterByPaymentStatus($paymentStatusParam)
            ->orderByFilter($orderByColumnName, $orderByParam)
            ->filterByPriceRange($minPrice, $maxPrice)
            ->filterByProductQuantity($minPurchaseQuantity, $maxPurchaseQuantity);

        $perPage = $request->input('per_page', 5);
        $purchases = $purchasesQuery->paginate($perPage);

        return [
            'purchase_data' => $purchases->items(),
            'meta' => [
                'current_page' => $purchases->currentPage(),
                'per_page' => $purchases->perPage(),
                'total' => $purchases->total(),
                'last_page' => $purchases->lastPage(),
            ],
        ];
    }

    public function getPurchaseFilters(): array
    {
        $statuses = [
            SalesOrderStatus::PACKED,
            SalesOrderStatus::PROCESSING,
            SalesOrderStatus::SHIPPED,
            SalesOrderStatus::DELIVERED,
        ];

        $purchaseFilters = array_map(function ($status) {
            return [
                'name' => $status,
                'status_count' => Purchase::where('status', $status)->count(),
            ];
        }, $statuses);

        $paymentStatuses = PaymentStatus::withCount(['purchases as purchase_count' => function ($query) {
            $query->select(DB::raw('count(*)'));
        }])->get(['id', 'name', 'purchase_count'])->makeHidden(['created_at', 'updated_at', 'deleted_at'])->toArray();

        return [
            'purchase_status' => $purchaseFilters,
            'payment_status' => $paymentStatuses,
        ];
    }
    public function show($purchase)
    {
        return Purchase::with(['vendor', 'product', 'paymentStatus'])->find($purchase);
    }

    public function store(PurchaseDto $dto)
    {
        try {
            DB::beginTransaction();
            $purchaseTransactionId = PurchaseTransaction::factory()->create()->id; // This functionality will be developed in the future
            $data = array_merge($dto->toArray(), ['sales_transaction_id' => $purchaseTransactionId]);
            $purchase = Purchase::create($data);
            DB::commit();
            return $purchase;
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }
    }

    public function update(PurchaseDto $dto, Purchase $purchase): Purchase
    {
        $purchase->update((array)$dto);
        return $purchase;
    }

    public function destroy(Purchase $purchase): void
    {
        $purchase->delete();
    }
}
