<?php

declare(strict_types=1);

namespace Database\Factories\Inventory;

use App\Models\Inventory\Product;
use App\Models\Inventory\VendorStockProduct;
use App\Models\Inventory\Warehouse;
use App\Models\Order\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorStockProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VendorStockProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_quantity' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * Define a state that selects existing data for product_id, warehouse_id, and vendor_id.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function existingData()
    {
        return $this->state(function (array $attributes) {
            return [
                'product_id' => Product::inRandomOrder()->value('id'),
                'warehouse_id' => Warehouse::inRandomOrder()->value('id'),
                'vendor_id' => Vendor::inRandomOrder()->value('id'),
            ];
        });
    }
}
