<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
     public function index()
    {
        $collections = Collection::paginate(3);
        return view('collections.index', compact('collections'));
    }
}
