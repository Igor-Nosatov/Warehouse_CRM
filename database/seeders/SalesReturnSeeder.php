<?php

namespace Database\Seeders;

use App\Models\Sales\SalesReturn;
use Illuminate\Database\Seeder;

class SalesReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesReturn::factory()->count(140)->create();
    }
}
