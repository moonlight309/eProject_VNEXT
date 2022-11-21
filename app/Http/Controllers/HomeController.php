<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $topTenNews = News::query()
            ->orderBy('id', 'desc')
            ->limit(2)
            ->get();
        $topTenProducts = Product::query()
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        $topTenUsers = User::query()
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        return view('home')
            ->with('topTenNews', $topTenNews)
            ->with('topTenProducts', $topTenProducts)
            ->with('topTenUsers', $topTenUsers)
            ;
    }
}
