<?php

namespace Database\Seeders;

use App\Models\Sales\CustomerNote;
use Illuminate\Database\Seeder;

class CustomerNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerNote::factory()->count(1000)->create();
    }
}
