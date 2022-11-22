<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list_user(Request $request)
    {
        $search = $request->search;


        $users = User::where('name', 'LIKE', "%{$search}%")

            ->orWhere('email', 'LIKE', "%{$search}%")
            ->paginate(3);
        $users->appends(['search' => $search]);


        return view('list_user', [
            'users' => $users,
            'search' => $search
        ]);
    }
}
