<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
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

        $roles = UserRoleEnum::getArrayView();

        View::share('title', $title);
        View::share('roles', $roles);
    }

    public function index(Request $request)
    {
        $users = User::orderByDesc('id')->paginate(5);
        if ($request->ajax()) {
            return view('user.item', [
                'users' => $users,
            ]);
        }
        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function importCsv(Request $request)
    {
        // try {
        //     $file = $request->file('file');
        //
        //     Excel::import(new UsersImport(), $file);
        //
        //     return $this->successResponse();
        // } catch (\Throwable $e) {
        //     return $this->errorResponse();
        // }

        try {
            $file = $request->file('file');

            $query = "LOAD DATA LOCAL INFILE '" . addslashes($file) . "'
            INTO TABLE users
            FIELDS TERMINATED BY ','
            OPTIONALLY ENCLOSED BY '\"'
            LINES TERMINATED BY '\n'
            IGNORE 1 LINES
            (@dummy, name, email, password, phone, birthday)
            SET created_at = CURRENT_TIMESTAMP, updated_at = CURRENT_TIMESTAMP
            ";

            DB::connection()->getpdo()->exec($query);

            return $this->successResponse();
        } catch (\Throwable $e) {
            dd($e);
        }
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(StoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $user             = $request->validated();
            $user['password'] = Hash::make($user['password']);

            // $extension                 = $request->file('avatar')->extension();
            // $fileName                  = time() . '.' . $extension;
            // $user['avatar']            = $fileName;
            // Storage::disk('public')->putFileAs('avatars', $request->file('avatar'), $fileName);

            if ($request->hasFile('avatar')) {
                $pathFile       = $request->file('avatar');
                $extension      = $request->file('avatar')->extension();
                $data           = file_get_contents($pathFile);
                $base64Image    = 'data:image/' . $extension . ';base64,' . base64_encode($data);
                $user['avatar'] = $base64Image;
            }

            if ($user['role'] == UserRoleEnum::ADMIN) {
                $user['email_verified_at'] = now();
            }

            User::create($user);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('user.detail', [
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($request->id);
            $user->fill($request->validated());

            if ($request->hasFile('avatar')) {
                // $extension                 = $request->file('avatar')->extension();
                // $fileName                  = time() . '.' . $extension;
                // $user['avatar']            = $fileName;
                // Storage::disk('public')->putFileAs('avatars', $request->file('avatar'), $fileName);

                $pathFile       = $request->file('avatar');
                $extension      = $request->file('avatar')->extension();
                $data           = file_get_contents($pathFile);
                $base64Image    = 'data:image/' . $extension . ';base64,' . base64_encode($data);
                $user['avatar'] = $base64Image;
            }

            $user->save();

            DB::commit();

            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
