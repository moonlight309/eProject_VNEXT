<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list_product(Request $request)
    {
        $search = $request->search;
        $products = Product::where('name', 'LIKE', "%$search%")
            ->orWhere('code', 'LIKE', "%$search%")
            ->paginate(3);
        $products->appends(['search' => $search]);


        return view('list_product', [
            'products' => $products,
            'search' => $search
        ]);
    }

}
