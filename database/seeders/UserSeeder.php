<?php

namespace Database\Seeders;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => env('ADMIN_NAME', 'defaultAdminName'),
                'email' => env('ADMIN_EMAIL', 'defaultAdminEmail@gmail.com'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'defaultPassword')),
                'role_id' => Role::where('name','admin')->first()->id,
            ],
        ]);
        User::factory()->count(20)->create();
    }
}
