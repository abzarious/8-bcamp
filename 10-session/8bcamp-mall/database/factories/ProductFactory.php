<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(3, true);
        return [
            
            'name' => ucfirst($name),
            'slug' => Str::slug($name), 
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(50000, 500000),
            'stock' => fake()->numberBetween(1, 100),
            'image' => 'product.webp',

            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
        ];
    }
}
