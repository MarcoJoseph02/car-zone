<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'supplier_id' => \App\Models\Supplier::inRandomOrder()->first()->id ?? \App\Models\Supplier::factory()->create()->id,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? \App\Models\Category::factory()->create()->id,
            'brand_id' => \App\Models\Brand::inRandomOrder()->first()->id ?? \App\Models\Brand::factory()->create()->id,
            'model'=>fake()->word(),
            'year'=>fake()->year(),
            'price'=>fake()->randomFloat(2,2000,21474),
            'description'=>fake()->text(),
        ];
    }
}
