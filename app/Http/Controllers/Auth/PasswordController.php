<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
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

    public function changePassword()
    {
        return view('profile.change_password');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults()],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully');
    }
}
