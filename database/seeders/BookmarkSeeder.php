<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Bookmark;
use App\Models\User;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::with(['tags', 'collections'])->get();

        foreach ($users as $user) {

            $bookmarks = Bookmark::factory(10)->create([
                'user_id' => $user->id
            ]);

            $userTags = $user->tags;
            $userCollections = $user->collections;

            foreach ($bookmarks as $index => $bookmark) {

                if ($index < 7 && $userCollections->isNotEmpty()) {
                    $bookmark->collection_id = $userCollections->random()->id;
                    $bookmark->save();
                }

                if ($userTags->isNotEmpty()) {
                    $randomTagsIds = $userTags->random(rand(1, 3))->pluck('id')->toArray();
                    $bookmark->tags()->attach($randomTagsIds);
                }
            }
        }

        // Sincronizar el conteo real de marcadores en las colecciones
        $collections = \App\Models\Collection::withCount('bookmarks')->get();
        foreach ($collections as $collection) {
            \Illuminate\Support\Facades\DB::table('collections')
                ->where('id', $collection->id)
                ->update(['bookmarks_count' => $collection->bookmarks_count]);
        }
    }
}
