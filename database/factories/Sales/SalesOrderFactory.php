<?php

namespace Database\Factories\Sales;

use App\Enums\SalesOrderStatus;
use App\Models\Inventory\Product;
use App\Models\Sales\Customer;
use App\Models\Sales\PaymentStatus;
use App\Models\Sales\SalesTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales\SalesOrder>
 */
class SalesOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $customerId = Customer::inRandomOrder()->first()->id;
        return [
            'status' => $this->faker->randomElement(SalesOrderStatus::all()),
            'total_amount' => $this->faker->numberBetween(100, 10000),
            'total_quantity' => $this->faker->numberBetween(1, 100),
            'date_time_of_placement' => $this->faker->dateTime,
            'date_time_of_delivery' => $this->faker->optional()->dateTimeBetween('now +2 days', 'now +10 days'),
            'delivery_location' => $this->faker->address,
            'customer_id' => Customer::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'payment_status_id' => PaymentStatus::inRandomOrder()->first()->id,
            'sales_transaction_id'=> SalesTransaction::factory()->create()->id,
        ];
    }
}
