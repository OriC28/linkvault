<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

use App\Exceptions\TransactionFailedException;
use App\Actions\EmptyAllRegistersAction;
use App\Actions\GetMergedModelsAction;

class TrashController extends Controller
{
    public function index(Request $request, GetMergedModelsAction $getMergedModelsAction)
    {
        $dataPaginated = $getMergedModelsAction(
            user: $request->user()
        );

        return view('trash.index', compact('dataPaginated'));
    }

    public function restore(string $type, object $item)
    {
        Gate::authorize('restore', $item);

        $item->restore();
        return redirect()->route('trash.index');
    }

    public function destroy(string $type, object $item)
    {
        Gate::authorize('forceDelete', $item);

        $item->forceDelete();
        return redirect()->route('trash.index');
    }

    public function empty(Request $request, EmptyAllRegistersAction $emptyAllRegistersAction)
    {
        try {

            $trashed_count = $emptyAllRegistersAction(
                user: $request->user()
            );

            return redirect()->route('trash.index')->with([
                'collections_trashed' => $trashed_count['collections'],
                'bookmarks_trashed' => $trashed_count['bookmarks']
            ]);
        } catch (TransactionFailedException $e) {
            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }
}
