<?php

namespace Database\Seeders;

use App\Models\Inventory\AdjustStock;
use Illuminate\Database\Seeder;

class AdjustStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdjustStock::factory()->count(1000)->create();
    }
}
