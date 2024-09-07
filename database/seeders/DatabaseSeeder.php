<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CustomerSeeder::class,
            PaymentStatusSeeder::class,
            WarehouseSeeder::class,
            VendorSeeder::class,
            ProductTypeSeeder::class,
            ProductStatusSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductHistorySeeder::class,
            ProductNoteSeeder::class,
            VendorStockProductSeeder::class,
            SalesReturnSeeder::class,
            CustomerNoteSeeder::class,
            CustomerHistorySeeder::class,
            SalesReturnSeeder::class,
            AdjustStockSeeder::class,
        ]);
    }
}
