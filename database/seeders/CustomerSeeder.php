<?php

namespace Database\Seeders;

use App\Models\Sales\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(100)->create();
    }
}
