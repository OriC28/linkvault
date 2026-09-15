<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookmarkRequests\MovingBookmarkToCollectionRequest;
use App\Models\Bookmark;

class MovingBookmarkToCollection extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(MovingBookmarkToCollectionRequest $request, Bookmark $bookmark)
    {
        $bookmark->update(['collection_id' => $request->collection_id]);

        return redirect()->route('bookmarks.index');
    }
}
