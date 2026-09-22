<?php

namespace App\Actions;

use App\Models\Bookmark;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Exceptions\NoChangesDetectedException;

class SaveBookmarkWithTagsAction
{
    public function __invoke(User $user, Bookmark $bookmark, array $data, Collection $tags)
    {

        return DB::transaction(
            function () use ($user, $bookmark, $data, $tags) {
                $isUpdate = $bookmark->exists;
                $pivotData = [];

                foreach ($tags as $tag) {
                    if (isset($tag['id']) && $tag['id'] != null) {
                        $tagId = $tag['id'];
                    } else {
                        $newTag = $user->tags()->firstOrCreate([
                            'name' => $tag['value'],
                            'slug' => Str::slug($tag['value'])
                        ]);
                        $tagId = $newTag->id;
                    }
                    $pivotData[] = $tagId;
                }

                $bookmark->fill($data);
                $bookmark->user()->associate($user);
                $bookmarkHasChanges = $bookmark->isDirty();
                $bookmark->save();

                $changes = collect($bookmark->tags()->sync($pivotData));

                if ($isUpdate && !$bookmarkHasChanges && $changes->flatten()->isEmpty()) {
                    throw new NoChangesDetectedException('No ingresaste datos nuevos.');
                }

                return $bookmark;
            }
        );
    }
}
