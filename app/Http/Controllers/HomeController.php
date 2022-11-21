<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $per_page = 2;

    public function load() {
        $this->per_page += 5;
    }

    public function index()
    {
        $topTenNews = News::query()
            ->paginate($this->per_page);
        $topTenProducts = Product::query()
            ->paginate($this->per_page);
        $topTenUsers = User::query()
            ->paginate($this->per_page);
        return view('home')
            ->with('topTenNews', $topTenNews)
            ->with('topTenProducts', $topTenProducts)
            ->with('topTenUsers', $topTenUsers)
            ;
    }
}
