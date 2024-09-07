<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('warehouses')->insert([
            [
                'name' => 'Warehouse *BDG',
                'location' => '1501 Industrial Park Road, Springfield, IL 62703',
            ],
            [
                'name' => 'Warehouse *JKT',
                'location' => '4800 Warehouse Lane, Phoenix, AZ 85034',
            ],
            [
                'name' => 'Warehouse *MLG',
                'location' => '322 Riverbend Drive, Baton Rouge, LA 70802',
            ],
            [
                'name' => 'Warehouse *SBY',
                'location' => '7500 Northfield Rd, Denver, CO 80239',
            ],
            [
                'name' => 'Warehouse *DPK',
                'location' => '2650 Eastgate Blvd, Columbus, OH 43219',
            ],
        ]);
    }
}
