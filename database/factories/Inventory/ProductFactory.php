<?php

declare(strict_types=1);

namespace Database\Factories\Inventory;

use App\Enums\SalesOrderStatus;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductAttribute;
use App\Models\Inventory\ProductImage;
use App\Models\Inventory\StockProduct;
use App\Models\Order\Purchase;
use App\Models\Order\PurchaseTransaction;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesTransaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'is_returnable' => $this->faker->boolean,
            'is_have_variant' => $this->faker->boolean,
            'core_product_id' => $this->faker->optional()->numberBetween(1, 90),
            'title' => $this->faker->sentence,
            'sku' => $this->faker->unique()->regexify('[A-Z0-9]{10}'),
            'barcode' => $this->faker->unique()->ean13,
            'retail_price' => $this->faker->numberBetween(1000, 1200),
            'wholesale_price' => $this->faker->numberBetween(800, 900),
            'cost' => $this->faker->numberBetween(50, 500),
            'is_draft' => $this->faker->boolean,
            'product_type_id' => $this->faker->numberBetween(1, 2),
            'product_status_id' => $this->faker->numberBetween(1, 3),
            'category_id' => $this->faker->numberBetween(1, 5),
            'brand_id' => $this->faker->numberBetween(1, 3),
            'product_attribute_id' => ProductAttribute::factory()->create()->id,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $uniqueSalesOrderData = $this->getUniqueOrderData();
            SalesOrder::factory()->create(array_merge($uniqueSalesOrderData, [
                'status' => $this->faker->randomElement(SalesOrderStatus::all()),
                'customer_id' => $this->faker->numberBetween(1, 5),
                'product_id' => $product->id,
                'payment_status_id' => 4,
                'sales_transaction_id'=> SalesTransaction::factory()->create()->id,
            ]));

            $uniquePurchaseData = $this->getUniqueOrderData();
            Purchase::factory()->create(array_merge($uniquePurchaseData, [
                'status' => $this->faker->randomElement(SalesOrderStatus::all()),
                'vendor_id' => $this->faker->numberBetween(1, 5),
                'customer_id'=> $this->faker->numberBetween(1, 5),
                'product_id' => $product->id,
                'purchase_transaction_id'=> PurchaseTransaction::factory()->create()->id,
            ]));

            ProductImage::factory()->create([
                'name' => $this->faker->word,
                'file_name' => $this->faker->word . '.jpg',
                'mime_type' => 'image/jpg',
                'path' => 'product_images/' . $this->faker->word . '.jpg',
                'disk' => 'local',
                'url' => $this->faker->url,
                'size' => $this->faker->randomNumber(5),
                'product_id' => $product->id,
            ]);

            StockProduct::factory()->create([
                'product_received_qty' => $this->faker->numberBetween(500, 5000),
                'product_shipment_qty' => $this->faker->numberBetween(500, 5000),
                'product_qty' => $this->faker->numberBetween(500, 5000),
                'description' => $this->faker->sentence(),
                'product_id' => $product->id,
                'adjust_stock_id' => AdjustStockFactory::factory()->create()->id,
            ]);
        });
    }

    private function getUniqueOrderData()
    {
        $startDate = Carbon::create(2024, 1, 1, 0, 0, 0);
        $endDate = Carbon::create(2024, 7, 31, 23, 59, 59);

        $faker = $this->faker->unique();
        return [
            'total_amount' => $faker->numberBetween(10, 99999),
            'total_quantity' => $faker->numberBetween(10, 99999),
            'date_time_of_placement' => $faker->dateTimeBetween($startDate, $endDate),
            'date_time_of_delivery' => $faker->dateTimeBetween($startDate, $endDate),
            'delivery_location' => $faker->address,
        ];
    }
}
