<?php

namespace Database\Seeders;

use App\Models\Bookmark;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::with('tags')->get();

        foreach ($users as $user) {

            $bookmarks = Bookmark::factory(10)->create([
                'user_id' => $user->id
            ]);

            $userTags = $user->tags;

            if ($userTags->isNotEmpty()) {
                foreach ($bookmarks as $bookmark) {

                    $randomTagsIds = $userTags->random(rand(1, 3))->pluck('id')->toArray();

                    $bookmark->tags()->attach($randomTagsIds);
                }
            }
        }
    }
}
