<?php

namespace Database\Factories\Sales;

use App\Enums\SalesReturnStatus;
use App\Models\Sales\SalesOrder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales\SalesOrder>
 */
class SalesReturnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $salesOrder = SalesOrder::inRandomOrder()->first();
        $productDateOfPlacement = $salesOrder->date_time_of_placement->addDays(2);

        return [
            'reason' => $this->faker->sentence,
            'return_date' => $productDateOfPlacement,
            'status' => $this->faker->randomElement(SalesReturnStatus::all()),
            'sales_order_id' => $this->faker->numberBetween(10, 40),
            'customer_id' => $this->faker->numberBetween(10, 40),
        ];
    }
}
