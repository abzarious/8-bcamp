<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
       

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

       $categories = collect(['Electronics', 'Fashion', 'Home', 'Toys']);

        $categories->each(function ($categoryName) {
            Category::factory()
                ->hasProducts(5) // Otomatis membuat 5 produk untuk kategori ini
                ->create(['name' => $categoryName]);
        });
    }
}
