<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'price' => 500000.00,
            'image_url' => "products\hRxaC1aNJ78aMU1Xg0MeqsapE12VDBqtDhAHbnvk.png",
        ];
    }
}
