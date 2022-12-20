<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
{
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
        $categories = Category::query()
            ->orderBy('id', 'DESC')
            ->with('children')
            ->whereNull('parent_id')
            ->get();

        return view('category.index', [
            'categories' => $categories,
        ]);
    }

    public function add()
    {
        $category = Category::orderBy('name', 'ASC')->get();

        return view('category.add', [
            'category' => $category,
        ]);
    }

    public function create($id)
    {
        $category = Category::orderBy('name', 'ASC')->get();
        $cat = Category::find($id);
        if (!$cat){
            abort(404);
        }
        return view('category.create', [
            'category' => $category,
            'cat' => $cat
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|max:255',
            'name' => 'required|max:255',
        ]);

        if ($request->parent_id == 0)
        {
            Category::create([
                'code' => $request->code,
                'name' => $request->name,
                'parent_id' => null
            ]);
        }else{
            Category::create($request->all());
        }

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category){
            abort(404);
        }
        return view('category.detail', [
            'category' => $category,
        ]);
    }

    public function edit($id)
    {
        $cat = Category::orderBy('name', 'ASC')->get();
        $category = Category::find($id);
        if (!$category){
            abort(404);
        }
        return view('category.edit', [
            'category' => $category,
            'cat' => $cat
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->offsetUnset('_token');
        $request->offsetUnset('_method');

        $request->validate([
            'code' => 'required|max:255',
            'name' => 'required|max:255',
        ]);

        $category = Category::find($id);
        if ($request->parent_id == 0)
        {
            $category->code = $request->input('code');
            $category->name = $request->input('name');
            $category->parent_id = null;
            $category->save();
        }else{
            $category->code = $request->input('code');
            $category->name = $request->input('name');
            $category->parent_id = $request->input('parent_id');
            $category->save();
        }

        return redirect()->route('categories.index')->with('success', 'Category update successfully.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category delete successfully.');
    }
}
