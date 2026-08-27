<?php

namespace Database\Factories;

use App\Models\Bookmark;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bookmark>
 */
class BookmarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 2),
            'collection_id' => $this->faker->numberBetween(1, 2),
            'url' => $this->faker->url(),
            'title' => $this->faker->words(4, true),
            'description' => $this->faker->paragraph(),
            'favicon_url' => $this->faker->imageUrl(512, 512, 'icono'),
            'is_favorite' => $this->faker->boolean(30),
            'click_count' => $this->faker->randomNumber(),
            'last_clicked_at' => $this->faker->date()
        ];
    }
}
