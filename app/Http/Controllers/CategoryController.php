<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Maker;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list_category(Request $request)
    {
        $search = $request->search;

        $categories = Category::where('name', 'LIKE', "%$search%")
            ->orWhere('code', 'LIKE', "%$search%")
            ->paginate(3);
        $categories->appends(['search' => $search]);

        return view('list_category', [
            'categories' => $categories,
            'search' => $search
        ]);

    }
}
