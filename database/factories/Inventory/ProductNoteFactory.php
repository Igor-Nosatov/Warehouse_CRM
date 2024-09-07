<?php

declare(strict_types=1);

namespace Database\Factories\Inventory;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductNoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'notes' => $this->faker->sentence,
            'product_id' => $this->faker->numberBetween(1, 90),
            'user_id' => $this->faker->numberBetween(1, 15),
        ];
    }
}
