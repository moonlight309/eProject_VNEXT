<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public $per_page = 2;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $role = UserRoleEnum::getRoleByValue(auth()->user()->role);

            View::share('role', $role);

            return $next($request);
        });
    }

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
