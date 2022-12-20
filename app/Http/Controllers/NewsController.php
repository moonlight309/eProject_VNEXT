<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\News\StoreRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{
    use ResponseTrait;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $role = UserRoleEnum::getRoleByValue(auth()->user()->role);

            View::share('role', $role);

            return $next($request);
        });

        $routeName = Route::currentRouteName();
        $arr       = explode('.', $routeName);
        $arr       = array_map('ucfirst', $arr);
        $title     = implode(' - ', $arr);

        View::share('title', $title);
    }

    public function index(Request $request)
    {
        $news = News::orderByDesc('id')->paginate(5);
        if ($request->ajax()) {
            return view('news.item', [
                'news' => $news,
            ]);
        }
        return view('news.index', [
            'news' => $news,
        ]);
    }

    public function create(Request $request)
    {
        return view('news.create');
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            News::create($request->all());

            DB::commit();

            return $this->successResponse();
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->errorResponse();
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            News::where('id', $id)->update($request->all());

            DB::commit();

            return $this->successResponse();
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        News::find($id)->delete();

        return redirect()->route('news.index')->with('success', 'Delete news successfully!');
    }

    public function detail($id)
    {
        $news = News::find($id);

        $user = User::query()
            ->where('id', $news->created_user)
            ->first();

        return view('news.detail', [
            'news' => $news,
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $news = News::find($id);

        $user = User::query()
            ->where('id', $news->updated_user)
            ->first();

        return view('news.edit', [
            'news' => $news,
            'user' => $user
        ]);
    }
}
