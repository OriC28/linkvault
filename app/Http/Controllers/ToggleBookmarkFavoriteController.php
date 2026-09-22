<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

use App\Http\Requests\BookmarkRequests\ToggleFavoriteRequest;
use App\Models\Bookmark;

class ToggleBookmarkFavoriteController extends Controller
{
    /**
     * Toogle bookmook like favorite or not.
     */
    public function __invoke(ToggleFavoriteRequest $request, Bookmark $bookmark)
    {
        Gate::authorize('update', $bookmark);

        $bookmark->update(['is_favorite' => $request->is_favorite]);

        return redirect()->route('bookmarks.index');
    }
}
