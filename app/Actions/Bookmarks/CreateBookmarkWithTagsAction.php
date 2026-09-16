<?php

namespace App\Actions\Bookmarks;

use App\Models\Bookmark;
use App\Models\User;
use App\Repositories\BookmarkRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CreateBookmarkWithTagsAction
{
    public function __construct(protected BookmarkRepository $bookmarkRepository) {}
    /**
     * Undocumented function
     *
     * @param User $user
     * @param array $bookmarkData
     * @param Collection $tags
     * @return Bookmark
     */
    public function __invoke(User $user, array $bookmarkData, Collection $tags): Bookmark
    {
        return DB::transaction(
            function () use ($user, $bookmarkData, $tags) {
                $pivotData = [];

                $bookmark = $this->bookmarkRepository->createForUser($user, $bookmarkData);

                foreach ($tags as $tag) {
                    if (isset($tag['id']) && $tag['id'] != null) {
                        $tagId = $tag['id'];
                    } else {
                        // Crear repository de Tag para esta logica
                        $newTag = $user->tags()->create([
                            'name' => $tag['value'],
                            'slug' => Str::slug($tag['value'])
                        ]);
                        $tagId = $newTag->id;
                    }
                    $pivotData[] = $tagId;
                }
                $bookmark->tags()->sync($pivotData);
                $bookmark->collection()->increment('bookmarks_count', 1);

                return $bookmark;
            }
        );
    }
}
