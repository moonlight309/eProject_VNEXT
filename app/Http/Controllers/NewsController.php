<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {


        $search = $request->search;
        $news = News::where('title', 'LIKE', "%$search%")
            ->paginate(3);
        $news->appends(['search' => $search]);


        return view('new.index', [
            'news' => $news,
            'search' => $search
        ]);
    }
}
