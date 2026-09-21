<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

use App\Http\Requests\BookmarkRequests\StoreBookmarkRequest;
use App\Http\Requests\BookmarkRequests\UpdateBookmarkRequest;
use App\Exceptions\NoChangesDetectedException;
use App\Actions\SaveBookmarkWithTagsAction;
use App\Models\Bookmark;

class BookmarkController extends Controller
{

    public function index(Request $request)
    {

        $user = $request->user();

        $bookmarks = $user->bookmarks()->filteredAndPaginated(
            filters: $request->only(['is_favorite', 'without_collection', 'recent', 'oldest']),
            relations: ['tags', 'collection']
        );
        $collections = $user->collections()->get();
        $tags = $user->present()->tagsWithId();

        return view('bookmarks.index', compact('bookmarks', 'collections', 'tags'));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $collections = $user->collections()->get();
        $tags = $user->present()->tagsWithId();
        return view('bookmarks.create', compact('collections', 'tags'));
    }

    public function store(StoreBookmarkRequest $request, SaveBookmarkWithTagsAction $saveWithTagsAction)
    {
        $saveWithTagsAction(
            user: $request->user(),
            bookmark: new Bookmark(),
            data: $request->except('tags'),
            tags: $request->tags
        );
        return redirect()->route('bookmarks.index')->with('success', 'Guardado con éxito');
    }

    public function update(UpdateBookmarkRequest $request, Bookmark $bookmark, SaveBookmarkWithTagsAction $saveWithTagsAction)
    {
        Gate::authorize('update', $bookmark);
        try {

            $saveWithTagsAction(
                user: $request->user(),
                bookmark: $bookmark,
                data: $request->except('tags'),
                tags: $request->tags
            );
            return redirect()->route('bookmarks.index');
        } catch (NoChangesDetectedException  $e) {
            return redirect()->back()
                ->with('warning', $e->getMessage())
                ->with('edit_bookmark_id', $bookmark->id)
                ->withInput();
        }
    }

    public function destroy(Bookmark $bookmark)
    {
        Gate::authorize('delete', $bookmark);
        $bookmark->delete();
        return redirect()->route('bookmarks.index');
    }
}
