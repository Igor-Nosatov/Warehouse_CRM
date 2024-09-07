<?php

namespace Database\Seeders;

use App\Models\Inventory\VendorStockProduct;
use Illuminate\Database\Seeder;

class VendorStockProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VendorStockProduct::factory()->existingData()->count(100)->create();
    }
}
