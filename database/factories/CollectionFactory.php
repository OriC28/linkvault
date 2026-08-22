<?php

namespace Database\Factories;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Collection>
 */
class CollectionFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $name =  $this->faker->words(4, true);

        return [
            'user_id' => $this->faker->numberBetween(1, 2),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'is_public' => $this->faker->boolean(50),
            'bookmarks_count' => $this->faker->numberBetween(10, 90),
            'sort_order' => $this->faker->numberBetween(1, 20),
        ];
    }
}
