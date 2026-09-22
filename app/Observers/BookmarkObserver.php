<?php

namespace App\Observers;

use App\Models\Bookmark;
use App\Models\Collection;

use App\Services\MetadataExtractorService;

class BookmarkObserver
{
    public function __construct(protected MetadataExtractorService $extractor) {}

    /**
     * Handle the Bookmark "creating" event.
     */
    public function creating(Bookmark $bookmark): void
    {
        $bookmark->favicon_url = $this->extractor->getFaviconToURL($bookmark->url);
    }

    /**
     * Handle the Bookmark "created" event.
     */
    public function created(Bookmark $bookmark): void
    {
        $bookmark->collection?->increment('bookmarks_count', 1);
    }

    /**
     * Handle the Bookmark "updated" event.
     */
    public function updated(Bookmark $bookmark): void
    {
        if ($bookmark->isDirty('collection_id')) {

            $oldCollectionId = $bookmark->getOriginal('collection_id');

            if ($oldCollectionId) {
                Collection::where('id', $oldCollectionId)
                    ->where('bookmarks_count', '>', 0)
                    ->decrement('bookmarks_count', 1);
            }

            if ($bookmark->collection_id) {
                Collection::where('id', $bookmark->collection_id)?->increment('bookmarks_count', 1);
            }
        }
    }

    /**
     * Handle the Bookmark "deleted" event.
     */
    public function deleted(Bookmark $bookmark): void
    {
        if (!$bookmark->isForceDeleting()) {
            Collection::withTrashed()
                ->where('id', $bookmark->collection_id)
                ->where('bookmarks_count', '>', 0)
                ->decrement('bookmarks_count', 1);
        }
    }

    /**
     * Handle the Bookmark "restored" event.
     */
    public function restored(Bookmark $bookmark): void
    {
        $bookmark->collection?->increment('bookmarks_count', 1);
    }

    /**
     * Handle the Bookmark "force deleted" event.
     */
    public function forceDeleted(Bookmark $bookmark): void {}
}
