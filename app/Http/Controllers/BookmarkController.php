<?php

namespace App\Http\Controllers;

use App\Actions\Bookmarks\CreateBookmarkWithTagsAction;
use App\Actions\Bookmarks\UpdateBookmarkWithTagsAction;
use App\Http\Requests\BookmarkRequests\StoreBookmarkRequest;
use App\Http\Requests\BookmarkRequests\UpdateBookmarkRequest;

use App\Repositories\BookmarkRepository;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function __construct(
        protected BookmarkRepository $bookmarkRepository
    ) {}

    public function index(Request $request)
    {
        $bookmarks = $this->bookmarkRepository->getFilteredAndPaginated(
            filters: $request->only(['is_favorite', 'without_collection', 'desc', 'asc']),
            perPage: 6
        );
        $collections = $request->user()->collections()->get();
        $tags = $request->user()->tags->map(function ($tag) {
            return [
                'id' => $tag->id,
                'value' => $tag->name,
            ];
        })->toArray();
        return view('bookmarks.index', compact('bookmarks', 'collections', 'tags'));
    }

    public function create(Request $request)
    {
        $collections = $request->user()->collections()->get();
        $tags = $request->user()->tags->map(function ($tag) {
            return [
                'id' => $tag->id,
                'value' => $tag->name,
            ];
        })->toArray();
        return view('bookmarks.create', compact('collections', 'tags'));
    }

    public function store(StoreBookmarkRequest $request, CreateBookmarkWithTagsAction $createBookmarkWithTagsAction)
    {
        $createBookmarkWithTagsAction(
            $request->user(),
            $request->except('tags'),
            $request->tags
        );
        return redirect()->route('bookmarks.index')->with('success', 'Guardado con éxito');
    }

    public function update(UpdateBookmarkRequest $request, int $id, UpdateBookmarkWithTagsAction $updateBookmarkWithTagsAction)
    {
        try {
            $updateBookmarkWithTagsAction(
                user: $request->user(),
                bookmark_data: $request->except('tags'),
                id: $id,
                tags: $request->tags
            );
            return redirect()->route('bookmarks.index');
        } catch (\Throwable $e) {
            return redirect()->back()
                ->with('warning', $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(int $id)
    {
        $this->bookmarkRepository->delete($id);
        return redirect()->route('bookmarks.index');
    }
}
