<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bookmark::factory()
            ->count(15)
            ->hasAttached(
                Tag::factory()->count(3)
        )->create();
    }
}
