<?php

namespace App\Actions;

use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\User;

class GetMergedModelsAction
{
    public function __invoke(User $user,  int $perPage = 5): LengthAwarePaginator
    {
        $bookmarks = $user->bookmarks()->with('collection')->onlyTrashed()->get();
        $collections = $user->collections()->onlyTrashed()->get();

        $data = $bookmarks->concat($collections)->sortByDesc('deleted_at');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $data->slice(($currentPage - 1) * $perPage, $perPage)->values();

        return new LengthAwarePaginator(
            $currentItems,
            $data->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
    }
}
