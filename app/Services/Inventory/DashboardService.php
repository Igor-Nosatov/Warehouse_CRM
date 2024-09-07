<?php

declare(strict_types=1);

namespace App\Services\Inventory;

use App\Enums\SalesOrderStatus;
use App\Helpers\ProductStockLevel;
use App\Models\Inventory\Product;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesReturn;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardService
{
    public function index():array
    {
        return  [
            'stockLevel' => $this->stockLevel(),
            'bestSellingProducts' => $this->bestSellingProducts(),
            'salesOrderCounts' => $this->inventoryCounts(),
            'activeWorkOrder' => $this->activeWorkOrder(),
            'salesOrderSummary' => $this->salesOrderSummary(),
        ];
    }

    private function productQuery()
    {
        return Product::query();
    }

    private function stockLevel():array
    {
        $products = $this->productQuery()
            ->with(['stockProducts' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }])
            ->get();

        $stockLevelsCount = [
            'LowLevelStock' => ['totalQty' => 0],
            'AverageLevelStock' => ['totalQty' => 0],
            'HighLevelStock' => ['totalQty' => 0],
            'MaxLevelStock' => ['totalQty' => 0],
        ];

        $totalQty = 0;

        foreach ($products as $product) {
            if ($product->stockProducts->isEmpty()) {
                continue;
            }

            $latestStockProduct = $product->stockProducts->first();
            $productQty = $latestStockProduct->product_qty;
            $totalQty += $productQty;

            if ($productQty <= ProductStockLevel::LOW_LEVEL_STOCK) {
                $stockLevelsCount['LowLevelStock']['totalQty'] += $productQty;
            } elseif ($productQty <= ProductStockLevel::AVERAGE_LEVEL_STOCK) {
                $stockLevelsCount['AverageLevelStock']['totalQty'] += $productQty;
            } elseif ($productQty <= ProductStockLevel::HIGH_LEVEL_STOCK) {
                $stockLevelsCount['HighLevelStock']['totalQty'] += $productQty;
            } else {
                $stockLevelsCount['MaxLevelStock']['totalQty'] += $productQty;
            }
        }

        $stockLevelsPercentage = [];
        foreach ($stockLevelsCount as $stockLevel => $data) {
            $percentage = $totalQty > 0 ? ($data['totalQty'] / $totalQty) * 100 : 0;
            $stockLevelsPercentage[$stockLevel] = [
                'percentage' => round($percentage, 2),
                'totalQty' => $data['totalQty']
            ];
        }

        return $stockLevelsPercentage;
    }

    private function bestSellingProducts():Collection
    {
        return $this->productQuery()->withCount('salesOrders')
            ->orderBy('sales_orders_count', 'desc')
            ->latest('created_at')
            ->limit(4)
            ->get();
    }

    private function inventoryCounts(): array
    {
        $inventoryCounts = [];

        $totalProductPacked = SalesOrder::where('status', SalesOrderStatus::PACKED)->count();
        $totalProductToBeProcessing = SalesOrder::where('status', SalesOrderStatus::PROCESSING)->count();
        $totalProductShipped = SalesOrder::where('status', SalesOrderStatus::SHIPPED)->count();
        $totalQuantityDelivered = SalesOrder::where('status', SalesOrderStatus::DELIVERED)->count();

        $totalSalesOrders = $totalProductPacked + $totalProductToBeProcessing + $totalProductShipped + $totalQuantityDelivered;

        $packedPercentage = $totalSalesOrders > 0 ? ($totalProductPacked / $totalSalesOrders) * 100 : 0;
        $processingPercentage = $totalSalesOrders > 0 ? ($totalProductToBeProcessing / $totalSalesOrders) * 100 : 0;
        $shippedPercentage = $totalSalesOrders > 0 ? ($totalProductShipped / $totalSalesOrders) * 100 : 0;
        $deliveredPercentage = $totalSalesOrders > 0 ? ($totalQuantityDelivered / $totalSalesOrders) * 100 : 0;

        $inventoryCounts = [
            'totalProductPacked' => [
                'qty' => $totalProductPacked,
                'percentage' => round($packedPercentage, 2)
            ],
            'totalProductToBeProcessing' => [
                'qty' => $totalProductToBeProcessing,
                'percentage' => round($processingPercentage, 2)
            ],
            'totalProductShipped' => [
                'qty' => $totalProductShipped,
                'percentage' => round($shippedPercentage, 2)
            ],
            'totalSalesProductDelivered' => [
                'qty' => $totalQuantityDelivered,
                'percentage' => round($deliveredPercentage, 2)
            ],
        ];

        return $inventoryCounts;
    }

    private function salesOrderSummary(): array
    {
        $countsByMonth = [];

        for ($i = 0; $i < 6; $i++) {
            $startDate = Carbon::now()->subMonths($i)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();

            $salesOrderCount = SalesOrder::whereBetween('date_time_of_placement', [$startDate, $endDate])->count();
            $salesReturnCount = SalesReturn::whereBetween('return_date', [$startDate, $endDate])->count();

            $countsByMonth[$startDate->format('Y-M')] = [
                'salesOrder' => $salesOrderCount,
                'salesReturn' => $salesReturnCount,
            ];
        }

        return $countsByMonth;
    }

    private function activeWorkOrder():Collection
    {
        return SalesOrder::with('product')
            ->whereNotIn('status', [SalesOrderStatus::DELIVERED])
            ->latest()
            ->limit(3)
            ->get();
    }
}
