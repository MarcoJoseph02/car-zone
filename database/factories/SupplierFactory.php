<?php

namespace Database\Factories;

use app\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'fname'=>fake()->firstName(),
            'lname'=>fake()->lastName(),
            'phone_no'=>fake()->phoneNumber(),
            'address'=>fake()->address(),
        ];
    }
}
