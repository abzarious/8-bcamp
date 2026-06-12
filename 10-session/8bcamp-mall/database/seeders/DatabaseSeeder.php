<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
       

        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@babakery.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);


       Category::factory(3)->create();
       Product::factory(20)->create();

    }
}
