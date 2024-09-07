<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_statuses')->insert([
            ['name' => 'Pending'],
            ['name' => 'Cancelled'],
            ['name' => 'Unpaid'],
            ['name' => 'Paid'],
        ]);
    }
}
