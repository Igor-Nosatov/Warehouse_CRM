<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_statuses')->insert([
            [
                'name' => 'Active',
            ],
            [
                'name' => 'Inactive',
            ],
            [
                'name' => 'Draft',
            ],
        ]);
    }
}
