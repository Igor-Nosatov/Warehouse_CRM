<?php

namespace Database\Seeders;

use App\Models\Inventory\ProductHistory;
use Illuminate\Database\Seeder;

class ProductHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductHistory::factory()->count(1000)->create();
    }
}
