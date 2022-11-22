<?php

namespace App\Http\Controllers;


use App\Http\Requests\Maker\StoreRequest;

use App\Models\Maker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MakerController extends Controller
{

    public function list_maker(Request $request)
    {
        $search = $request->search;

        $makers = Maker::where('name', 'LIKE', "%$search%")
            ->orWhere('code', 'LIKE', "%$search%")
            ->paginate(3);
        $makers->appends(['search' => $search]);

        return view('list_maker', [
            'makers' => $makers,
            'search' => $search
        ]);

    }



    public function detail()
    {
//        $maker = Maker::find($id);
//        return view('maker.detail', compact('maker'));
        return view('maker.detail');
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
            return redirect()->back();
//            return redirect()->route('home')
//                ->with('success', 'Maker created successfully.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show()
    {
//        $allStudent = User::query()
//            ->orderBy('id', 'desc')
//            ->get();
//
//        return view('users/index')
//            ->with(compact('allStudent'));
    }

    public function edit()
    {
//        $editMaker = Maker::find($id);
//        return view('maker.edit', compact('editMaker'));
        return view('maker.edit');

    }

    public function update(StoreRequest $request, $id)
    {
        $object = Maker::find($id);
        $object->fill($request->validated());
        $object->save();

        return redirect()->route('list-maker')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        Maker::query()
            ->where('id', $id)
            ->delete();

        return Redirect::to('/');
    }

}


