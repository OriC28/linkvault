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

        $filters = $request->only(['is_favorite', 'without_collection', 'recent', 'oldest', 'alphaDesc', 'alphaAsc']) + ['search' => $keyword];

        if ($type === 'bookmarks') {
            $bookmarks = $user->bookmarks()->filteredAndPaginated(
                filters: $filters,
                relations: ['tags', 'collection']
            );

            $collections = $user->collections()->get();
            $tags = $user->present()->tagsWithId();

            return view('bookmarks.index', compact('bookmarks', 'collections', 'tags'));
        }

        if ($type === 'collection') {
            $collection = $user->collections()->findOrFail($request->collection_id);
            $bookmarks = $collection->bookmarks()->filteredAndPaginated(
                filters: $filters,
                relations: ['tags'],
                perPage: 4
            );

            return view('collections.show', compact('collection', 'bookmarks'));
        }
    }
}
