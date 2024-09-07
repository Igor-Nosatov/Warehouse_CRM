<?php

declare(strict_types=1);

namespace App\Services\Sales;

use App\DataTransferObjects\Sales\CustomerDto;
use App\Models\Sales\Customer;
use Illuminate\Support\Facades\DB;

class CustomerService
{
    public function index($request): array
    {
        $searchTerm = $request->input('search');
        $customerTypeParam = $request->input('customer_type');
        $customerStatusParam = $request->input('customer_status');
        $orderByColumnName = $request->input('order_by_name');
        $orderByParam = $request->input('order_by_param');
        $totalPurchasesMinAmount = $request->input('purchases_min_amount');
        $totalPurchasesMaxAmount = $request->input('purchases_max_amount');
        $receivablesMinAmount = $request->input('receivables_min_amount');
        $receivablesMaxAmount = $request->input('receivables_max_amount');

        $customers = Customer::query()
            ->search($searchTerm)
            ->filterByCustomerType($customerTypeParam)
            ->filterByCustomerStatus($customerStatusParam)
            ->orderByFilter($orderByColumnName, $orderByParam)
            ->filterByTotalPurchases($totalPurchasesMinAmount, $totalPurchasesMaxAmount)
            ->filterByReceivables($receivablesMinAmount, $receivablesMaxAmount)
            ->paginate(8);

        $meta = [
            'total' => $customers->total(),
            'per_page' => $customers->perPage(),
            'current_page' => $customers->currentPage(),
            'last_page' => $customers->lastPage(),
            'from' => $customers->firstItem(),
            'to' => $customers->lastItem(),
        ];

        return [
            'customer_data' => $customers->items(),
            'meta' => $meta,
        ];
    }

    public function getCustomerFilters(): array
    {
        $customerFilters = [
            'customer_type' => $this->getCustomerTypeFilter(),
            'customer_status' => $this->getCustomerStatusFilter(),
        ];
        return $customerFilters;
    }

    private function getCustomerTypeFilter(): array
    {
        $customerQuery = Customer::query();

        $customerTypeCounts = $customerQuery->select('customer_type', DB::raw('count(*) as count'))
            ->groupBy('customer_type')
            ->pluck('count', 'customer_type')
            ->toArray();

        $customerTypeFilter = [
            [
                'name' => 'Retail',
                'count' => 0
            ],
            [
                'name' => 'Wholesale',
                'count' => 0
            ],
            [
                'name' => 'Corporate',
                'count' => 0
            ]
        ];

        foreach ($customerTypeCounts as $type => $count) {
            foreach ($customerTypeFilter as &$item) {
                if ($item['name'] === $type) {
                    $item['count'] = $count;
                    break;
                }
            }
        }

        return $customerTypeFilter;
    }

    private function getCustomerStatusFilter(): array
    {
        $customerQuery = Customer::query();

        $customerStatusCounts = $customerQuery->select('customer_status', DB::raw('count(*) as count'))
            ->groupBy('customer_status')
            ->pluck('count', 'customer_status')
            ->toArray();

        $customerStatusFilter = [
            [
                'name' => 'Active',
                'count' => 0
            ],
            [
                'name' => 'Suspended',
                'count' => 0
            ],
            [
                'name' => 'New',
                'count' => 0
            ],
            [
                'name' => 'Overdue',
                'count' => 0
            ]
        ];

        foreach ($customerStatusCounts as $status => $count) {
            foreach ($customerStatusFilter as &$item) {
                if ($item['name'] === $status) {
                    $item['count'] = $count;
                    break;
                }
            }
        }

        return $customerStatusFilter;
    }

    public function show($customer)
    {
        return Customer::with(['salesOrders', 'salesReturns', 'customerNotes', 'customerHistories'])->find($customer->id);
    }

    public function store(CustomerDto $dto): Customer
    {
        return Customer::create([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'customer_photo_url' => $dto->customer_photo_url,
            'customer_type' => $dto->customer_type,
            'customer_status' => $dto->customer_status,
            'email' => $dto->email,
            'phone' => $dto->phone,
            'remark' => $dto->remark,
            'total_purchases' => $dto->total_purchases,
            'receivables' => $dto->receivables,
        ]);
    }

    public function update(CustomerDto $dto, Customer $customer): Customer
    {
        $customer->update((array) $dto);
        return $customer;
    }

    public function destroy(Customer $customer): void
    {
        $customer->delete();
    }
}

