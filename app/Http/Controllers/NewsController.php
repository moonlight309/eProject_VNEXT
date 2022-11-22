<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
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

    function addNews(Request $request)
    {
        return view('news.create');
    }

    function store(Request $request)
    {
        $data            = [];
        $data['title']   = $request->title;
        $data['content'] = $request->content;

        News::create($data);

        return redirect()->route('news.index');
    }

    function detail($id)
    {
        $news = News::find($id);

        return view('news.detail', [
            'news' => $news
        ]);
    }

    function edit($id)
    {
        $news = News::find($id);

        return view('news.edit', [
            'news' => $news
        ]);
    }

}
