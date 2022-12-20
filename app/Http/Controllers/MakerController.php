<?php

namespace App\Http\Controllers;


use App\Enums\UserRoleEnum;
use App\Exports\MakersDataExport;
use App\Http\Requests\Maker\StoreRequest;

use App\Models\Maker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class MakerController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $role = UserRoleEnum::getRoleByValue(auth()->user()->role);

            View::share('role', $role);

            return $next($request);
        });

        $routeName = Route::currentRouteName();
        $arr = explode('.', $routeName);
        $arr = array_map('ucfirst', $arr);
        $title = implode(' - ', $arr);
        View::share('title', $title);
    }


    public function index(Request $request)
    {
//        $number = $request->show_item;


        $makers = Maker::sortable()->paginate(5);

        if ($request->ajax()) {
            return view('maker.item', [
                'makers' => $makers,
            ]);
        }

        return view('maker.index', [
            'makers' => $makers,
        ]);
    }

    public function detail($id)
    {
        $maker = Maker::find($id);
        $user = User::query()
            ->where('id', $maker->created_user)
            ->first();
        return view('maker.detail', ['maker' => $maker, 'user' => $user]);
    }

    public function create()
    {
        return view('maker.create');
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {

            $data = $request->validated();
            $imageName = uniqid() . time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('images/maker'), $imageName);
            $data['logo'] = $imageName;
            Maker::query()->create($data);
            DB::commit();
            return redirect()->route('makers.index')
                ->with('success', 'Maker created successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $editMaker = Maker::find($id);
        $user = User::query()
            ->where('id', $editMaker->updated_user)
            ->first();
        return view('maker.edit', ['editMaker' => $editMaker, 'user' => $user]);
    }
    public function show()
    {
    }

    public function update(StoreRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $object = Maker::find($id);
            $object->fill($request->validated());

            if ($request->hasFile('logo')) {
                $imageName = uniqid() . time() . '.' . $request->logo->extension();
                $request->logo->move(public_path('images/maker'), $imageName);
                $object['logo'] = $imageName;
            }
            $object->save();
            DB::commit();

            return redirect()->route('makers.index')->with('success', 'Cập nhật thành công');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $maker = Maker::find($id);
        $maker->delete();
        return redirect()->route('makers.index');
    }

}
