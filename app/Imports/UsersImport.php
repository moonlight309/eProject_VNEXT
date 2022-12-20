<?php

namespace App\Imports;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToArray, WithHeadingRow
{
    public function array(array $array)
    {
        foreach ($array as $each) {
            try {
                User::updateOrCreate([
                    'email' => $each['email'],
                ], [
                    'name'       => $each['name'],
                    'password'   => Hash::make($each['password']),
                    'birthday'   => $each['birthday'],
                    'role'       => $each['role'],
                    'phone'      => $each['phone'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Throwable $e) {
                dd($each, $e);
            }
        }
    }
}
