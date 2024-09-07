<?php

namespace Database\Seeders;

use App\Models\Order\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendor::factory()->count(100)->create();
    }
}
