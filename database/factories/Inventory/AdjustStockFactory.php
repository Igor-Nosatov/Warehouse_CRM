<?php

declare(strict_types=1);

namespace Database\Factories\Inventory;

use App\Enums\AdjustmentType;
use App\Enums\ReasonInventoryType;
use App\Models\Auth\User;
use App\Models\Inventory\AdjustStock;
use App\Models\Inventory\Product;
use App\Models\Inventory\Warehouse;
use App\Models\Order\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory\AdjustStock>
 */
class AdjustStockFactory extends Factory
{
    protected $model = AdjustStock::class;

    public function definition(): array
    {
        $userId = User::inRandomOrder()->first()->id;
        $productId = Product::inRandomOrder()->first()->id;
        $warehouseId = Warehouse::inRandomOrder()->first()->id;
        $vendorId = Vendor::inRandomOrder()->first()->id;

        return [
            'payment_status' => $this->faker->randomElement(AdjustmentType::all()),
            'adjust_stock_date' => $this->faker->date(),
            'reason_for_inventory' => $this->faker->randomElement(ReasonInventoryType::all()),
            'quantity_available' => $this->faker->numberBetween(100, 500),
            'new_quantity' => $this->faker->numberBetween(500, 1000),
            'description' => $this->faker->optional()->sentence(),
            'product_id' => $productId,
            'warehouse_id' => $warehouseId,
            'vendor_id' => $vendorId,
            'user_id' => $userId,
        ];
    }

    public static function factory(): AdjustStockFactory
    {
        return new AdjustStockFactory();
    }
}
