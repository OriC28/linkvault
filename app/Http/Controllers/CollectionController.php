<?php

namespace App\Http\Controllers;

use App\Http\Requests\CollectionRequests\StoreCollectionRequest;
use App\Http\Requests\CollectionRequests\UpdateCollectionRequest;
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

    public function show(Collection $collection)
    {
        return view('collections.show', compact('collection'));
    }

    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        $collection->update($request->validated());
        return view('collections.show', compact('collection'));
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();
        return redirect()->route('collections.index');
    }
}
