<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

use App\Http\Requests\CollectionRequests\StoreCollectionRequest;
use App\Http\Requests\CollectionRequests\UpdateCollectionRequest;
use App\Models\Collection;

class CollectionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $collections = $user->collections()->latest()->paginate(6);

        return view('collections.index', compact('collections'));
    }

    public function store(StoreCollectionRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->collections()->create($request->validated());

        return redirect()->route('collections.index')->with('success', 'Guardado con éxito');
    }

    public function show(Request $request, Collection $collection)
    {
        Gate::authorize('view', $collection);

        $user = $request->user();
        $bookmarks = $user->bookmarks()
            ->where('collection_id', $collection->id)
            ->filteredAndPaginated(
                filters: $request->only(['recent', 'oldest', 'alphaDesc', 'alphaAsc']),
                relations: ['tags'],
                perPage: 4
            );

        return view('collections.show', compact('collection', 'bookmarks'));
    }

    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        Gate::authorize('update', $collection);

        $collection->update($request->validated());

        return redirect()->route(
            'collections.show',
            parameters: ['collection' => $collection]
        )->with('success', "La colección '$collection->name' se actualizó correctamente.");
    }

    public function destroy(Collection $collection)
    {
        Gate::authorize('delete', $collection);

        $collection->delete();

        return redirect()->route('collections.index')
            ->with('success', "Se eliminó la colección '$collection->name'. Puede verlo en la Papelera.");
    }
}
