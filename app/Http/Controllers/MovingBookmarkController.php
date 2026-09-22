<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

use App\Http\Requests\BookmarkRequests\MovingBookmarkRequest;
use App\Models\Bookmark;

class MovingBookmarkController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(MovingBookmarkRequest $request, Bookmark $bookmark)
    {
        Gate::authorize('update', $bookmark);

        $bookmark->update(['collection_id' => $request->collection_id]);

        return redirect()->route('bookmarks.index');
    }
}
