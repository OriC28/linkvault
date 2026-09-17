<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionRequests\StoreCollectionRequest;
use App\Http\Requests\CollectionRequests\UpdateCollectionRequest;
use App\Models\Bookmark;
use App\Models\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $collections = $user->collections()->paginate(6);

        return view('collections.index', compact('collections'));
    }

    public function store(StoreCollectionRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->collections()->create($request->validated());

        return redirect()->route('collections.index');
    }

    public function show(Request $request, Collection $collection)
    {
        $bookmarks = Bookmark::where('collection_id', $collection->id)
            ->with('tags')
            ->filter($request->only(['dateDesc', 'dateAsc', 'orderDesc', 'orderAsc']))
            ->paginate(4)
            ->withQueryString();

        return view('collections.show', compact('collection', 'bookmarks'));
    }

    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        $collection->update($request->validated());

        return redirect()->route('collections.show', parameters: ['collection' => $collection]);
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();

        return redirect()->route('collections.index');
    }
}
