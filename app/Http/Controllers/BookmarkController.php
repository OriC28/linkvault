<?php

namespace App\Http\Controllers;

use App\Actions\Bookmarks\CreateBookmarkWithTagsAction;
use App\Http\Requests\StoreBookmarkRequest;
use App\Repositories\BookmarkRepository;
use Illuminate\Http\Request;


class BookmarkController extends Controller
{
    public function __construct(protected BookmarkRepository $bookmarkRepository){}

    public function index(Request $request)
    {
        $bookmarks = $this->bookmarkRepository->getFilteredAndPaginated(
            filters: $request->only(['is_favorite', 'without_collection']),
            perPage: 6
        );

        return view('bookmarks.index', compact('bookmarks'));
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
            return redirect()->route('bookmarks')->with('success', 'Guardado con éxito');
    }
}
