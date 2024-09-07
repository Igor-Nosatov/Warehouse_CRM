<?php

namespace Database\Factories\Order;

use App\Models\Inventory\Product;
use App\Models\Order\PurchaseTransaction;
use App\Models\Order\Vendor;
use App\Models\Sales\Customer;
use App\Models\Sales\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order\Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paymentStatusId =  PaymentStatus::inRandomOrder()->first()->id;
        $productId = Product::inRandomOrder()->first()->id;
        $vendorId = Customer::inRandomOrder()->first()->id;
        $customerId = Vendor::inRandomOrder()->first()->id;

        return [
            'status' => $this->faker->randomElement(['Packed','Processing','Shipped','Delivered']),
            'total_amount' => $this->faker->numberBetween(100, 10000),
            'total_quantity' => $this->faker->numberBetween(1, 100),
            'date_time_of_placement' => $this->faker->dateTime,
            'date_time_of_delivery' => $this->faker->dateTime,
            'delivery_location' => $this->faker->address,
            'product_id' => $productId,
            'customer_id' => $customerId,
            'vendor_id' => $vendorId,
            'payment_status_id' => $paymentStatusId,
            'purchase_transaction_id'=> PurchaseTransaction::factory()->create()->id,
        ];
    }
}
