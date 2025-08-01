<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(100)->create();
        // User::factory()->create([
        //     'name' => 'Super Admin',
        //     'email' => 'superadmin@gmail.com',
        //     'password' => Hash::make('Admin@123'),
        // ]);
    }
}
