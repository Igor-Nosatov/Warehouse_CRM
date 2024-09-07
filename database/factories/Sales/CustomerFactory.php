<?php

namespace Database\Factories\Sales;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'customer_photo_url' => $this->faker->imageUrl(),
            'customer_type' => $this->faker->randomElement(['Retail', 'Wholesale']),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'remark' => $this->faker->sentence,
            'total_purchases' => $this->faker->numberBetween(100, 10000),
            'receivables' => $this->faker->numberBetween(100, 10000),
        ];
    }
}
