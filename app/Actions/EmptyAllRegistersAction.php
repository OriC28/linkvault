<?php

namespace App\Actions;

use Illuminate\Support\Facades\DB;

use App\Exceptions\NoChangesDetectedException;
use App\Exceptions\TransactionFailedException;
use App\Models\User;

class EmptyAllRegistersAction
{
    public function __invoke(User $user): array
    {
        $bookmarks_to_trash = $user->bookmarks()->onlyTrashed()->count();
        $collections_to_trash = $user->collections()->onlyTrashed()->count();

        return DB::transaction(
            function () use ($user, $bookmarks_to_trash, $collections_to_trash) {
                $bookmarks_trashed = 0;
                $collections_trashed = 0;

                if ($bookmarks_to_trash === 0 && $collections_to_trash === 0) {
                    throw new NoChangesDetectedException("No se detectó ningún registro para eliminar.");
                }

                $user->collections()->onlyTrashed()->chunkById(1000, function ($collections) use (&$collections_trashed) {
                    foreach ($collections as $coll) {
                        $coll->forceDelete();
                        $collections_trashed++;
                    }
                });

                $user->bookmarks()->onlyTrashed()->chunkById(1000, function ($bookmarks) use (&$bookmarks_trashed) {
                    foreach ($bookmarks as $book) {
                        $book->forceDelete();
                        $bookmarks_trashed++;
                    }
                });
                if (
                    $bookmarks_trashed != $bookmarks_to_trash
                    ||
                    $collections_trashed != $collections_to_trash
                ) {
                    throw new TransactionFailedException(
                        "Ocurrió un problema al vaciar la papelera. Inténtalo de nuevo."
                    );
                }

                return [
                    'bookmarks' => $bookmarks_trashed,
                    'collections' => $collections_trashed
                ];
            }
        );
    }
}
