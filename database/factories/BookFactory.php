<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'          => $this->faker->sentence(3),
            'author'         => $this->faker->name(),
            'pages'          => $this->faker->numberBetween(100, 800),
            'published_year' => $this->faker->numberBetween(1950, 2023),
        ];
    }
}
