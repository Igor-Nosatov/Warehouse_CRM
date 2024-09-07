<?php

namespace Database\Seeders;

use App\Models\Inventory\ProductNote;
use Illuminate\Database\Seeder;

class ProductNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductNote::factory()->count(1000)->create();
    }
}
