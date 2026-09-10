<?php

namespace App\Actions\Bookmarks;

use App\Models\Bookmark;
use App\Models\User;
use App\Repositories\BookmarkRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Exceptions\NoChangesDetectedException;

class UpdateBookmarkWithTagsAction
{
    public function __construct(protected BookmarkRepository $bookmarkRepository) {}
    /**
     * Undocumented function
     *
     * @param User $user
     * @param array $bookmark_data
     * @param Collection $tags
     * @return Bookmark
     */
    public function __invoke(User $user, array $bookmark_data, int $id, Collection $tags): Bookmark
    {
        return DB::transaction(
            function () use ($user, $bookmark_data, $id, $tags) {
                $pivotData = [];

                if (!empty($tags)) {

                    $bookmark = $this->bookmarkRepository->update($bookmark_data, $id);

                    if (!$bookmark) {
                        throw new NoChangesDetectedException('No ingresaste datos nuevos.');
                    }

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

                    return $bookmark;
                }
            }

        );
    }
}
