<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    function store(Request $request)
    {
    }

    function addNews(Request $request)
    {
        return view('news.create');
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $news   = News::where('title', 'LIKE', "%$search%")
            ->paginate(3);
        $news->appends(['search' => $search]);

        return view('news.index', [
            'news'   => $news,
            'search' => $search
        ]);
    }
}
