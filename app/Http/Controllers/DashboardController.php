<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        $data = Cache::remember("dashboard_user_{$user->id}", 3600, function () use ($user) {
            $user->loadCount([
                'bookmarks as total_bookmarks',
                'collections as total_collections',
                'bookmarks as total_favorites' => fn($query) => $query->where('is_favorite', true)
            ]);

            $tags = $user->tags()->latest()->limit(10)->get();

            $recent_bookmarks = $user->bookmarks()
                ->with('tags')
                ->latest()
                ->limit(4)
                ->get();

            $start_week = Carbon::now()->startOfWeek();
            $end_week = Carbon::now()->endOfWeek();

            $this_week = $user->bookmarks()->totalThisWeek([$start_week, $end_week])
                + $user->collections()->totalThisWeek([$start_week, $end_week]);

            return [
                'total_bookmarks' => $user->total_bookmarks,
                'total_collections' => $user->total_collections,
                'total_favorites' => $user->total_favorites,
                'this_week' => $this_week,
                'recent_bookmarks' => $recent_bookmarks,
                'tags' => $tags
            ];
        });

        return view('dashboard.index', $data);
    }
}
