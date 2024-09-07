<?php

declare(strict_types=1);

namespace App\Services\Sales;

use App\DataTransferObjects\Sales\SalesOrderDto;
use App\Models\Sales\PaymentStatus;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalesOrderService
{
    public function index(Request $request): array
    {
        $salesOrderStatusParam = $request->input('sales_order_status');
        $paymentStatusParam = $request->input('payment_status');
        $minPriceParam = $request->input('min_price');
        $maxPriceParam = $request->input('max_price');
        $minProductQuantityParam = $request->input('min_product_quantity');
        $maxProductQuantityParam = $request->input('max_product_quantity');
        $orderByColumnName = $request->input('order_by_name', 'created_at');
        $orderByParam = $request->input('order_by_param', 'desc');

        $salesOrderQuery = SalesOrder::with(['product', 'paymentStatus','customer'])
            ->filterBySalesOrderStatus($salesOrderStatusParam)
            ->filterByPaymentStatus($paymentStatusParam)
            ->filterByPriceRange($minPriceParam, $maxPriceParam)
            ->filterByProductQuantity($minProductQuantityParam, $maxProductQuantityParam)
            ->orderByFilter($orderByColumnName, $orderByParam);

        $salesOrder = $salesOrderQuery->paginate(5);

        return [
            'sales_order_data' => $salesOrder->items(),
            'meta' => [
                'current_page' => $salesOrder->currentPage(),
                'per_page' => $salesOrder->perPage(),
                'total' => $salesOrder->total(),
                'last_page' => $salesOrder->lastPage(),
            ],
        ];
    }

    public function getSalesOrderFilters()
    {
        $salesOrderCounts = SalesOrder::query()
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statuses = [
            'Packed' => 0,
            'Processing' => 0,
            'Shipped' => 0,
            'Delivered' => 0,
        ];
        foreach ($salesOrderCounts as $status => $count) {
            if (array_key_exists($status, $statuses)) {
                $statuses[$status] = $count;
            }
        }

        $paymentStatuses = PaymentStatus::withCount(['purchases as purchase_count' => function ($query) {
            $query->select(DB::raw('count(*)'));
        }])->get(['id', 'name', 'purchase_count'])->makeHidden(['created_at', 'updated_at', 'deleted_at'])->toArray();

        return [
            'sales_order_status' => array_map(function ($name, $count) {
                return ['name' => $name, 'count' => $count];
            }, array_keys($statuses), $statuses),
            'payment_status' => $paymentStatuses,
        ];
    }

    public function show($salesOrder): ?SalesOrder
    {
        return SalesOrder::find($salesOrder);
    }

    public function store(SalesOrderDto $dto)
    {
        try {
            DB::beginTransaction();
            $salesTransactionId = SalesTransaction::factory()->create()->id; //This functionality will be developed in the future
            $data = array_merge($dto->toArray(), ['sales_transaction_id' => $salesTransactionId]);
            $salesOrder = SalesOrder::create($data);
            DB::commit();
            return $salesOrder;
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
        }
    }

    public function update(SalesOrderDto $dto, int $salesOrderId): SalesOrder
    {
        $salesOrder = SalesOrder::findOrFail($salesOrderId);
        $salesOrder->update($dto->toArray());
        return $salesOrder;
    }

    public function destroy(int $id): void
    {
        $salesOrder = SalesOrder::find($id);
        $salesOrder->delete();
    }
}
