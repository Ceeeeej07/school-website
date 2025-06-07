<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'is_featured' => $this->faker->boolean(),
            'image' => $this->faker->imageUrl(640, 480, 'news', true),
            'description' => $this->faker->paragraph(),
            'content' => $this->faker->text(500),
            'author' => $this->faker->name(),
            'category' => $this->faker->randomElement(['Technology', 'Business', 'Sports', 'Entertainment']),
            'status' => $this->faker->randomElement(['Published', 'Draft']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
