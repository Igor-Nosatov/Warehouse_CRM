<?php

namespace Database\Seeders;

use App\Models\Sales\CustomerHistory;
use Illuminate\Database\Seeder;

class CustomerHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerHistory::factory()->count(100)->create();
    }
}
