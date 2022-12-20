<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ProfileController extends Controller
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

    public function index()
    {
        $user = Auth::user();

        return view('profile.index', [
            'user' => $user,
        ]);
    }

    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
