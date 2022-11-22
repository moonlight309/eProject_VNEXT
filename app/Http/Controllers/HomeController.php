<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use App\Models\User;

class HomeController extends Controller
{
    public $per_page = 5;

    public function index()
    {
        $topTenNews     = News::query()
            ->orderBy('created_at', 'desc')
            ->paginate($this->per_page);
        $topTenProducts = Product::query()
            ->orderBy('created_at', 'desc')
            ->paginate($this->per_page);
        $topTenUsers    = User::query()
            ->orderBy('created_at', 'desc')
            ->paginate($this->per_page);
        return view('home')
            ->with('topTenNews', $topTenNews)
            ->with('topTenProducts', $topTenProducts)
            ->with('topTenUsers', $topTenUsers);
    }
}
