<?php

namespace Database\Seeders;

use App\Models\Order\Purchase;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Purchase::factory()->count(1000)->create();
    }
}
