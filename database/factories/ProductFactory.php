<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'price' => 500000.00,
            'image_url' => "products\Pv5fOPUUMlIYnFHuD12kuMZO9nHuX8L7h0ARMio9.jpg",
        ];
    }
}
