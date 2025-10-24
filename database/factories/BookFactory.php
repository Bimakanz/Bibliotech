<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);

        return [
            'title' => $title,
            'slug' => Str::slug($title.' '.fake()->unique()->numberBetween(1, 9999)),
            'author' => fake()->name(),
            'category' => fake()->randomElement(['Novel', 'Reference', 'Technology', 'Science', 'History']),
            'cover_image_path' => null,
            'quantity' => fake()->numberBetween(1, 12),
            'description' => fake()->paragraphs(3, true),
        ];
    }
}
