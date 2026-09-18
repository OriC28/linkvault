<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request)
    {
        $keyword = $request->keyword;
        $type = $request->type;
        $user = $request->user();

        if (empty(trim($keyword))) {
            if ($type === 'bookmarks') return redirect()->route('bookmarks.index');
            if ($type === 'collection') return redirect()->route('collections.show', $request->collection_slug);
        }

        $filters = $request->only(['is_favorite', 'without_collection', 'desc', 'asc', 'dateDesc', 'dateAsc', 'orderDesc', 'orderAsc']) + ['search' => $keyword];

        if ($type === 'bookmarks') {
            $bookmarks = $user->bookmarks()
                ->with(['tags', 'collection'])
                ->filter($filters)
                ->paginate(6)
                ->withQueryString();

            $collections = $user->collections()->get();
            $tags = $user->tags()->get();

            return view('bookmarks.index', compact('bookmarks', 'collections', 'tags'));
        }

        if ($type === 'collection') {
            $collection = $user->collections()->findOrFail($request->collection_id);
            $bookmarks = $collection->bookmarks()
                ->with('tags')
                ->filter($filters)
                ->paginate(4)
                ->withQueryString();

            return view('collections.show', compact('collection', 'bookmarks'));
        }
    }
}
