<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TrashController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user();
        $bookmarks = $user->bookmarks()->with('collection')->onlyTrashed()->get();
        $collections = $user->collections()->onlyTrashed()->get();

        $data = $bookmarks->concat($collections)->sortByDesc('deleted_at');

        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $data->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $dataPaginated = new LengthAwarePaginator(
            $currentItems,
            $data->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );

        return view('trash.index', compact('dataPaginated'));
    }

    public function restore(string $type, object $item)
    {
        if ($item) {
            $item->restore();
            return redirect()->route('trash.index');
        }
    }

    public function destroy(string $type, object $item)
    {
        if ($item) {
            $item->forceDelete();
            return redirect()->route('trash.index');
        }
    }
}
