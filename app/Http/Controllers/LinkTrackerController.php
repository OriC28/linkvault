<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

use App\Models\Bookmark;

class LinkTrackerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Bookmark $bookmark)
    {
        Gate::authorize('update', $bookmark);

        $bookmark->increment('click_count', 1, [
            'last_clicked_at' => now()
        ]);

        return redirect()->away($bookmark->url);
    }
}
