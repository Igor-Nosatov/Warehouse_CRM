<?php

namespace Database\Seeders;

use App\Models\Sales\SalesOrder;
use Illuminate\Database\Seeder;

class SalesOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesOrder::factory()->count(1000)->create();
    }
}
