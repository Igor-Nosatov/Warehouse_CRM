<?php

declare(strict_types=1);

namespace Database\Factories\Inventory;

use App\Models\Inventory\Product;
use App\Models\Inventory\ProductAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory\ProductAttribute>
 */
class ProductAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'width' => $this->faker->numberBetween(5, 15),
            'height' => $this->faker->numberBetween(20, 50),
            'weight' => $this->faker->numberBetween(200, 2000),
            'color' => $this->faker->safeColorName(),
            'material' => $this->faker->word(),
        ];
    }
}
