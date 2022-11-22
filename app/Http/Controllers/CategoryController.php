<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Maker;


use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
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

//    public function index()
//    {
//        $category = Category::paginate(5);
//        return view('category.index', [
//            'category' => $category,
//        ]);
//    }

    public function create()
    {
        $category = Category::where('parent_id', 0)->get();
        return view('category.create', [
            'category' => $category,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        $model = Category::find($id);
        return view('category.detail', [
            'model' => $model,
        ]);
    }

    public function edit($id)
    {
        $model = Category::find($id);
        return view('category.edit', [
            'model' => $model,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->offsetUnset('_token');
        $request->offsetUnset('_method');
        Category::where(['id'=>$id])->update($request->all());
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {


    }
}
