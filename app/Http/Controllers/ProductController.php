<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Maker;
use Illuminate\Database\DBAL\TimestampType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public function index()
    {
        // $maker = Maker::all();
        // return view('product.create', ['maker' => $maker]);
    }


    public function create()
    {
        $maker = Maker::all();
        $category = Category::all();
        // $product = Product::all();
        // foreach ($product as $key) {
        // }
        // $image = json_decode($key->image);
        return view('product.create', ['maker' => $maker, 'category' => $category]);
    }


    public function store(Request $request)
    {
        $image = [];
        if ($files = $request->file('image')) {
            foreach ($files as $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                $fileName = rand() . '.' . $ext;
                $file->move('images/products', $fileName);
                $image[] = $fileName;
            }
        }
        if ($product = Product::create([
            'code' => $request->code,
            'name' => $request->name,
            'image' => json_encode($image),
            'color' => json_encode($request->color),
            'price' => $request->price,
            'description' => $request->description,
            'maker_id' => $request->maker_id
        ])) {
            $product_id = $product->id;
            CategoryProduct::create([
                'category_id' => $request->category_id,
                'product_id' => $product_id
            ]);
        }

        return redirect()->route('product.create')->with('sucess', 'Thêm thành công');
    }


    public function show($id)
    {
        $maker = Maker::all();
        $category = Category::all();
        $product = Product::find($id);
        $categoryProduct = CategoryProduct::where('product_id', $id)->first();
        // $product = Product::all();
        // foreach ($product as $key) {
        // }
        // $image = json_decode($key->image);
        //dd($categoryProduct);
        return view('product.update', ['maker' => $maker, 'category' => $category, 'product' => $product, 'categoryProduct' => $categoryProduct]);
    }


    public function edit(Request $request, $id)
    {
        $product_edit = Product::find($id);
        $image = [];
        if ($files = $request->file('image')) {
            // foreach ($files as $file) {
            //     if (isset($product_edit->image) && file_exists('images/products' . $product_edit->image) && $product_edit->image != "") {
            //         unlink('images/products' . $product_edit->image);
            //     }
            // }
            foreach ($files as $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                $fileName = rand() . '.' . $ext;
                $file->move('images/products', $fileName);
                $image[] = $fileName;
            }
        }

        $product_edit->code = $request->input('code');
        $product_edit->name = $request->input('name');
        $product_edit->image = json_encode($image);
        $product_edit->color = json_encode($request->input('color'));
        $product_edit->price = $request->input('price');
        $product_edit->description = $request->input('description');
        $product_edit->maker_id = $request->input('maker_id');
        $product_edit->save();
        CategoryProduct::where('product_id', $id)->update(['category_id' => $request->input('category_id')]);
        return redirect()->route('home');
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        CategoryProduct::where('product_id', $id)->delete();
        return redirect()->route('home');
    }
    public function detail($id)
    {
        $product = Product::find($id);
        return view('product.detail', ["product" => $product]);
    }
}
