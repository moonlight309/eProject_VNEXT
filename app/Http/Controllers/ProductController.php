<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Enums\UserRoleEnum;
use App\Models\Product;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Maker;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $role = UserRoleEnum::getRoleByValue(auth()->user()->role);
            View::share('role', $role);

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $products = Product::orderByDesc('id')->paginate(5);
        if ($request->ajax()) {
            return view('product.item', [
                'products' => $products,
            ]);
        }
        return view('product.index', [
            'products' => $products,
        ]);
    }


    public function create()
    {
        $maker = Maker::all();
        $category = Category::all();

        return view('product.create', ['maker' => $maker, 'category' => $category,]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => ['required', 'max:255', 'min:2', 'unique:products,code,NULL,id,deleted_at,NULL'],
            'name' => ['required', 'min:2', 'max:30'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            // 'image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'color' => ['required'],
            'price' => ['required', 'integer', 'min:0', 'not_in:0'],
            'maker_id' => ['required'],
            'category_id' => ['required']
        ]);

        if ($validator->passes()) {
            $image = [];
            if ($files = $request->file('image')) {
                foreach ($files as $file) {
                    $ext = strtolower($file->getClientOriginalExtension());
                    $fileName = rand() . '.' . $ext;
                    Storage::putFileAs('public/products', $file, $fileName);
                    // $extension = $file->extension();
                    // $fileName = time() . '.' . $extension;
                    //$file->move('images/products', $fileName);
                    $image[] = $fileName;
                }
            }

            if ($product = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'image' => $image,
                'color' => $request->color,
                'price' => $request->price,
                'description' => $request->description,
                'maker_id' => $request->maker_id
            ])) {
                $product_id = $product->id;
                foreach ($request->category_id as $category_id) {
                    CategoryProduct::create([
                        'category_id' => $category_id,
                        'product_id' => $product_id
                    ]);
                }
            }

            return response()->json(['success' => 'Added new product.']);
        } else {
            return response()->json(['error' => $validator->errors()->toArray()]);
        }
    }

    public function show($id)
    {
        $product = Product::find($id);
        $maker = Maker::all();
        $category = Category::all();
        $categoryProduct = CategoryProduct::where('product_id', $id)->get();

        return view('product.detail', ["product" => $product, 'maker' => $maker, 'category' => $category, 'categoryProduct' => $categoryProduct]);
    }

    public function edit($id)
    {
        $maker = Maker::all();
        $category = Category::all();
        $product = Product::find($id);
        $categoryProduct = CategoryProduct::all();
        $count = $categoryProduct->count();
        //dd($count);
        return view('product.update', ['maker' => $maker, 'category' => $category, 'product' => $product, 'categoryProduct' => $categoryProduct, 'count' => $count]);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product_edit = Product::find($id);
        $image = [];
        if ($files = $request->file('image')) {
            if ($product_edit->image != "") {
                foreach ($product_edit->image as $file) {
                    if (isset($file) && file_exists('storage/products/' . $file) && $file != "") {
                        unlink('storage/products/' . $file);
                    }
                    // if (isset($file) && Storage::exists('public/products', $file) && $file != "") {
                    //     Storage::delete('public/products/' . $file);
                    // }
                }
            }
            foreach ($files as $file) {
                $ext = strtolower($file->getClientOriginalExtension());
                $fileName = rand() . '.' . $ext;
                Storage::putFileAs('public/products', $file, $fileName);
                // $file->move('images/products', $fileName);
                $image[] = $fileName;
            }
        }

        if ($request->file('image')) {
            $product_edit->image = $image;
        }

        if ($request->photo != '') {
            foreach ($product_edit->image as $file) {
                if (isset($file) && file_exists('storage/products/' . $file) && $file != "") {
                    unlink('storage/products/' . $file);
                }
                // if (isset($file) && Storage::exists('public/products', $file) && $file != "") {
                //     Storage::delete('public/products/' . $file);
                // }
            }
            $product_edit->image = [];
        }

        $product_edit->code = $request->input('code');
        $product_edit->name = $request->input('name');
        $product_edit->color = $request->input('color');
        $product_edit->price = $request->input('price');
        $product_edit->description = $request->input('description');
        $product_edit->maker_id = $request->input('maker_id');
        $product_edit->save();

        CategoryProduct::where("product_id", $id)->delete();

        foreach ($request->category_id as $category_id) {
            CategoryProduct::upsert(
                [
                    'category_id' => $category_id,
                    'product_id' => $id
                ],
                ['product_id']
            );
        }

        return redirect()->route('products.show', $id);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->image) {
            foreach ($product->image as $file) {
                if (isset($file) && file_exists('storage/products/' . $file) && $file != "") {
                    unlink('storage/products/' . $file);
                }
            }
        }
        $product->delete();
        CategoryProduct::where('product_id', $id)->delete();

        return redirect()->route('products.index');
    }
}
