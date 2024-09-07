<?php

namespace Database\Factories\Sales;

use App\Models\Sales\SalesTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'payment_system' => $this->faker->randomElement(['PayPal', 'Stripe', 'Square']),
            'transaction_id' => $this->faker->unique()->uuid,
            'payment_details' => [
                'amount' => $this->faker->randomFloat(2, 1, 1000),
                'currency' => $this->faker->currencyCode,
                'status' => $this->faker->randomElement(['completed', 'pending', 'failed']),
                'transaction_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            ],
        ];
    }
}
