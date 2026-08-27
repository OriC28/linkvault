<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        $bookmarks = Bookmark::filter($request->only(['is_favorite', 'without_collection']))
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('bookmarks.index', compact('bookmarks'));
    }

    public function create(Request $request)
    {
        $collections = $request->user()->collections()->get();
        return view('bookmarks.create', compact('collections'));
    }

}
