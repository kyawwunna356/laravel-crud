<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $addressArray = ['Yangon','Mandalay','Pyin Oo Lwin', "Bagan", "Kalaw"];
        return [
            'title' => fake()->sentence(8),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(1000,10000),
            'address' => fake()->randomElement($addressArray),
            'rating' => fake()->numberBetween(1,5),
        ];
    }
}
