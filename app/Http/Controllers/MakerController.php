<?php

namespace App\Http\Controllers;

use App\Models\Maker;
use Illuminate\Http\Request;

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


}


