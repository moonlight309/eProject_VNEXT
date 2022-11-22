<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    function store(Request $request)
    {
        $news = new News();
        $news->title = $request->title;
        $news->content = $request->content;
        // $news->created_user = $request->created_user;
        // $news->updated_user = $request->updated_user;
        // $news->deleted_user = $request->deleted_user;
        // $news->created_at = $request->created_at;
        // $news->updated_at = $request->updated_at;
        $news->save();
        return redirect()->route('news.create');
    }
    function addNews(Request $request)
    {
        return view('news.create');
    }
}
