<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'author_id' => Author::factory(),
            'isbn' => fake()->unique()->numerify('#############'),
            'title' => fake()->sentence(3),
            'published_year' => fake()->numberBetween(1900, 2024),
            'is_reference' => fake()->boolean(15),
        ];
    }
}