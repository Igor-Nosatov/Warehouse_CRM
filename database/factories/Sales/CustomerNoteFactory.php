<?php

namespace Database\Factories\Sales;

use App\Models\Auth\User;
use App\Models\Sales\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales\CustomerNote>
 */
class CustomerNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomCustomerId = Customer::inRandomOrder()->first()->id;
        $randomUserId = User::inRandomOrder()->first()->id;

        return [
            'notes' => $this->faker->paragraph,
            'customer_id' => $randomCustomerId,
            'user_id' => $randomUserId,
        ];
    }
}
